<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class customer
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = md5(mysqli_real_escape_string($this->db->link, $data['password']));
            $sId = session_id();
            if($name =="" || $city == "" || $email == "" || $address == "" || $phone == "" || $password == ""){
                $alert = "<span class='error'>Các trường không được dể trống!</span>";
                return $alert;
            }else{
                $check_email = "SELECT * from tbl_customer where email = '$email'";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email đã tồn tại!</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO `tbl_customer` (`sId`, `name`, `addRess`, `city`, `phone`, `email`, `passWord`)
                     VALUES ('$sId', '$name', '$address', '$city', '$phone', '$email', '$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<script>alert('Đăng ký thành công!'); window.location = 'index.php'</script>";
                        return $alert;
                    }else{
                        $alert = "<div class='div_error'><span class='error'>Đăng ký không thành công!</span></div>";
                        return $alert;
                    }
                }
            }
        }
        public function login_customer($data, $linkReload){
            $userName = mysqli_real_escape_string($this->db->link, $data['userName']);
            $password = md5(mysqli_real_escape_string($this->db->link, $data['passWord']));

            if($userName == "" || $password == ""){
                $alert = "<span class='error'>Các trường không được để trống!</span>";
                return $alert;
            }else{
                $query = "SELECT * from tbl_customer where email = '$userName' and passWord = '$password' LIMIT 1";
                $result = $this->db->select($query);
                if(!$result){
                    $alert = "<span class='error'>Sai tài khoản hoặc mật khẩu</span>";
                    return $alert;
                }else{
                    $value = $result->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_sid', $value['sId']);
                    Session::set('customer_id', $value['customer_id']);   
                    Session::set('customerName', $value['name']);
                    Session::set("emailCustomer", $value['email']);
                    return "<script>window.location = '$linkReload'</script>";              
                }
            }
        }
        

        public function select_customerId($id){
            $query = "SELECT * from tbl_customer where customer_id = '$id' limit 1 ";
            $result = $this->db->select($query);
            return $result;
        }

        ///////////////////// GET ALL CUSTOMER
        public function getAllCustomer(){
            $query = "SELECT * from tbl_customer";
            $result = $this->db->select($query);
            return $result;
        }


        /////////////////////// DELETE CUSTOMER
        public function delete_customer($customer_id){
            $query = "DELETE from tbl_customer where customer_id = $customer_id";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Xóa thành công!</span></div>";
                return $alert;
            }else{
                $alert = "<div class='div_error'><span class='error'>Xóa thất bại!</span></div>";
                return $alert;
            }
        }
        public function update_customer($data, $id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            if($name =="" || $city == "" || $email == "" || $address == "" || $phone == ""){
                $alert = "<span class='error'>Các trường không được dể trống!</span>";
                return $alert;
            }else{
                    $query =  "UPDATE tbl_customer SET name = '$name', city = '$city', email = '$email', addRess = '$address', phone = '$phone' where customer_id = '$id'";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<div class='div_success'><span class='success'>Chỉnh sửa thành công!</span></div>";
                        return $alert;
                    }else{
                        $alert = "<div class='div_error'><span class='error'>Chỉnh sửa thất bại!</span></div>";
                        return $alert;
                    }
                }
        }
        /////////////////////////////////UPDATE CUSTOMER ADMIN

        public function update_customer_admin($id, $data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['addRess']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $passWord = md5(mysqli_real_escape_string($this->db->link, $data['passWord']));
            if($name =="" || $city == "" || $email == "" || $address == "" || $phone == "" || $passWord==""){
                $alert = "<span class='error'>Các trường không được dể trống!</span>";
                return $alert;
            }else{
                    $query =  "UPDATE tbl_customer SET name = '$name', city = '$city', email = '$email', addRess = '$address', phone = '$phone', passWord = '$passWord' where customer_id = '$id'";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<div class='div_success'><span class='success'>Chỉnh sửa thành công!</span></div>";
                        return $alert;
                    }else{
                        $alert = "<div class='div_error'><span class='error'>Chỉnh sửa thất bại!</span></div>";
                        return $alert;
                    }
                }
        }


        //////////////////Insert Report

        public function insert_report($productId, $customer_id, $comment, $evaluate){
            $check_order = "SELECT * FROM tbl_transactionhistory where productId = '$productId' and customer_id = '$customer_id' limit 1";
            $check_order_content = $this->db->select($check_order);
            if($check_order_content){
                $query = "INSERT INTO `tbl_comment` (`productId`, `customer_id`, `comment_content`, `evaluate`) 
                    VALUES ( '$productId', '$customer_id', '$comment', '$evaluate')";
                $result = $this->db->insert($query);
                $mes = "<script>alert('Gửi đánh giá thành công')</script>";
                return $mes;
            }else{
                $mes = "<script>alert('Bạn cần mua hàng trước khi đánh giá!')</script>";
                return $mes;
            }
            
            
        }   


        /////////////Get All comment
        public function getAllComment($productId){
            $query = "SELECT cm.*, c.name from tbl_comment as cm
                        inner join tbl_customer as c on cm.customer_id = c.customer_id
             where cm.productId = '$productId'";
            $result = $this->db->select($query);
            return $result;
        }
    } 
?>