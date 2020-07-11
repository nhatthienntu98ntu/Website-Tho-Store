<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class cart
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }


        //////////////////Thêm sản phẩm vào cart
        public function add_to_cart($id, $quantity){
            $quantity = $this->fm->validation($quantity); 
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();
            $query = "SELECT * FROM tbl_product where productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            // $image = $result['image'];
            // $productName = $result['productName'];
            // $price = $result['price'];
            
            $check_cart = "SELECT * FROM tbl_cart where productId = '$id' AND sId = '$sId'";
            $checkCart = $this->db->select($check_cart);
            if($checkCart){
                $message = "<div class='div_error'><span class='error'>Sản phẩm đã có trong giỏ hàng!</span></div>";
                return $message;
            }else{
                $query_insert = "INSERT INTO tbl_cart(productId, sId,quantity) VALUE ('$id', 
                                    '$sId','$quantity') ";
                $insert_cart = $this->db->insert($query_insert);
                if($insert_cart){
                    header('Location:cart.php');
                }else{
                    header('Location:404.php');  
                }
            }
        }

        //////////Lấy danh sách sản phẩm trong cart
        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT c.*, p.productName, p.image, p.price, m.name
                            FROM tbl_cart as c 
                            inner join tbl_product as p on c.productId = p.productId
                            inner join tbl_mau as m on p.mauId = m.mauId
                      WHERE sId = '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }


        ////////////Update số lượng của sản phẩm
        public function update_quantity_cart($cartId, $quantity){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId' ";
            $result = $this->db->update($query);
            if($result){
                header('Location:cart.php'); 
            }   else{
                $mes = "<div class='div_error'><span class='error'>Cập nhật số lượng sản phẩm thất bại!</span>";
                return $mes;
            }         
        }


        ///////////////Delete Sản phẩm
        public function delete_cart($deleteId){
            $deleteId = mysqli_real_escape_string($this->db->link, $deleteId);
            $query = "DELETE FROM tbl_cart WHERE cartId = '$deleteId'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }else{
                $mes = "<div class='div_error'><span class='error'>Xóa không thành công!</span></div>";
                return $mes;
            }
        }


        //////////////Delete tất cả các sản phẩm trong cart
        public function delete_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart where sId = '$sId' ";
            $result = $this->db->delete($query);
        }


        ///////////Kiểm tra cart có sản phẩm hay không
        public function check_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }


        ///////////////Thêm sản phẩm vào oder
        public function insert_oder($customer_id){
            $sId = session_id();
            $query = "SELECT * from tbl_cart where sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $quantity = $result['quantity'];
                    $query_oder = "INSERT INTO tbl_oder(productId, customer_id, quantity, status, cancelOrder) VALUE ('$productId', 
                    '$customer_id', '$quantity', 0, 0)";
                    $result_oder = $this->db->insert($query_oder);
                    if(!$result_oder){
                        $mes = "<script>alert('Đặt hàng thất bại!'); window.location = 'oder.php'</script>";
                        return $mes;
                    }
                }
                $mes = "<script>alert('Đặt hàng thành công!'); window.location = 'oderdetails.php'</script>";
                $this->delete_all_data_cart();
                return $mes;
            }
        }


        /////////////Lấy danh sách sản phẩm từ tbl_oder theo customer_id
        public function get_odered($customer_id){
            $query = "SELECT o.*, p.productName, p.image, p.price 
                    FROM tbl_oder as o 
                    inner join tbl_product as p on o.productId = p.productId
                    WHERE customer_id = '$customer_id' and o.cancelOrder = 0
                    order by id desc";
            $result = $this->db->select($query);
            return $result;
        }


        /////////////Lấy danh sách oder trong Admin
        public function get_inbox_cart(){
            $query = "SELECT o.*, p.productName, p.price, m.name
                    FROM tbl_oder as o 
                    inner join tbl_product as p on o.productId = p.productId
                    inner join tbl_mau as m on p.mauId = m.mauId
                    order by date_oder desc";
            $result = $this->db->select($query);
            return $result;
        }

        /////////////Lấy danh sách lịch sử giao dịch
        public function get_history_order(){
            $query = "SELECT t.*, p.productName, p.price, m.name, c.name as customer_name, a.adminName
                    FROM tbl_transactionhistory as t 
                    inner join tbl_product as p on t.productId = p.productId
                    inner join tbl_mau as m on p.mauId = m.mauId
                    inner join tbl_customer as c on t.customer_id = c.customer_id
                    inner join tbl_admin as a on t.adminId = a.adminId
                    order by date_order desc";
            $result = $this->db->select($query);
            return $result;
        }



        ///////////////////ADD HISTORY ODER
        public function addHistory($customer_id, $adminId, $productId, $quantity){
            $query = "INSERT into tbl_transactionhistory(customer_id, productId, adminId, quantity) value ('$customer_id','$productId','$adminId','$quantity')";
            $result = $this->db->insert($query);
            return $result;
        }

        /////////////Kiểm tra customer đã login chưa >> 
        public function check_oder($customer_id){
            $query = "SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }


        ////////////////Update status của sản phẩm đã oder trong Admin
        public function actionProductOder($order_id){
            $order_id = mysqli_real_escape_string($this->db->link, $order_id);
            
            $query = "UPDATE tbl_oder SET status = '1' WHERE id = '$order_id'";
            $result = $this->db->update($query);
            if($result){
                $mes = "<div class='div_success'><span class='success'>Đã xử lý!</span></div>";
                return $mes;
            }   else{
                $mes = "<div class='div_error'><span class='error'>Xử lý không thành công!</span></div>";
                return $mes;
            }         
        }

        ////////////////Delete sản phẩm đã oder trong Admin
        public function delete_product_history_order($historyId){
            $historyId = mysqli_real_escape_string($this->db->link, $historyId);
            
            $query = "DELETE FROM tbl_transactionHistory WHERE id = '$historyId'";
            $result = $this->db->delete($query);
            if($result){
                $mes = "<div class='div_success'><span class='success'>Đã xóa!</span></div>";
                return $mes;
            }   else{
                $mes = "<div class='div_error'><span class='error'>Xóa không thành công!</span></div>";
                return $mes;
            }         
        }

        /////////Hủy Đơn Hàng 
        public function cancel_product_order($orderId){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);

            $query = "UPDATE tbl_oder set cancelOrder = 1 where id = '$orderId'";
            $result = $this->db->update($query);
            if($result){
                $mes = "<div class='div_success'><span class='success'>Đã xóa!</span></div>";
                return $mes;
            }else{
                $mes = "<div class='div_error'><span class='error'>Lỗi! Không xóa được!</span></div>";
                return $mes;
            }
        }
        /////////////////////////////DELETE ORDER INBOX ADMIN
        public function deleteProductOrder($orderId){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $query = "DELETE from tbl_oder where id = '$orderId'";
            $result = $this->db->delete($query);
            if($result){
                $mes = "<div class='div_success'><span class='success'>Đã xóa!</span></div>";
                return $mes;
            }   else{
                $mes = "<div class='div_error'><span class='error'>Xóa không thành công!</span></div>";
                return $mes;
            }
        }

        ////////////////Update status của sản phẩm đã oder của khách hàng
        public function update_product_oder($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            
            $query = "UPDATE tbl_oder SET status = '2' WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result){
                $mes = "<div class='div_success'><span class='success'>Đã xử lý!</span></div>";
                return $mes;
            }   else{
                $mes = "<div class='div_error'><span class='error'>Xử lý không thành công!</span></div>";
                return $mes;
            }         
        }


    }
    
?>