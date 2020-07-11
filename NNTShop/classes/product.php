<?php
    $filepath = realpath(dirname(__FILE__));
    include_once (dirname(__FILE__).'/../lib/database.php');
    include_once (dirname(__FILE__).'/../helpers/fomat.php');
?>
<?php 
    class product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        ////////////////////THÊM SẢN PHẨM
        public function insert_product($data, $files)
        {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $mau = mysqli_real_escape_string($this->db->link, $data['mau']);
            $soLuong = mysqli_real_escape_string($this->db->link, $data['soLuong']);
            $moTa = mysqli_real_escape_string($this->db->link, $data['moTa']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào foder upload.
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
             
            if($productName == "" || $moTa == "" || $product_desc == "" || $price == "" || $type == "" || $brand == "" || $category == "" || $file_name == "" || $mau == "" || $soLuong == ""){
                $alert = "<div class='div_error'><span class='error'>Các trường không được để trống!</span></div>";
                return $alert;
            }else{
                if (in_array($file_ext, $permited) == false) {
                    $alert = "<div class='div_error'><span class='error'>Bạn chỉ có thể upload: -".implode(', ', $permited)."</span></div>";
                    return $alert;
                }
                if($file_size > 999999) {
                    $alert = "<div class='div_error'><span class='error'>File không được lớn quá 20MB!!!</span></div>";
                    return $alert;    
                }
                $query = "INSERT INTO tbl_product(productName, catId, brandId, mauId, soLuong, moTa, product_desc,type, price, image) VALUE ('$productName',
                 '$category', '$brand', '$mau', '$soLuong', '$moTa', '$product_desc','$type', '$price', '$unique_image') ";
                $result = $this->db->insert($query);
 
                if($result){
                    move_uploaded_file($file_temp, $uploaded_image);
                    $alert = "<div class='div_success'><span class='success'>Thêm sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        /////////////////////GET PRODUCT
        public function show_product(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            order by p.productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyId($productId){
            $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($query);
            return $result;
        }


        //////////////////UPDATE PRODUCT
        public function update_product($id, $data, $files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brandId = mysqli_real_escape_string($this->db->link, $data['brand']);
            $catId = mysqli_real_escape_string($this->db->link, $data['category']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $mau = mysqli_real_escape_string($this->db->link, $data['mau']);
            $moTa = mysqli_real_escape_string($this->db->link, $data['moTa']);
            $soLuong = mysqli_real_escape_string($this->db->link, $data['soLuong']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào foder upload.
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
             
            if($productName == "" || $moTa == "" || $product_desc == "" || $price == "" || $type == "" || $brandId == "" || $catId == "" || $mau == "" || $soLuong == ""){
                $alert = "<div class='div_error'><span class='error'>Các trường không được để trống!</span></div>";
                return $alert;
            }else{
                if(!empty($file_name)) {
                    if (in_array($file_ext, $permited) == false) {
                        $alert = "<div class='div_error'><span class='error'>Bạn chỉ có thể upload: -".implode(', ', $permited)."</span></div>";
                        return $alert;
                    }
                    if($file_size > 99999) {
                        $alert = "<div class='div_error'><span class='error'>File không được lớn quá 2MB!!!</span></div>";
                        return $alert;    
                    }
                    $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', brandId = '$brandId', moTa = '$moTa', product_desc = '$product_desc',type = '$type', price = '$price', image = '$unique_image', mauId = '$mau', soLuong = '$soLuong'
                              WHERE productId = '$id' ";
                    
                }else{
                    $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', brandId = '$brandId', moTa = '$moTa', product_desc = '$product_desc',type = '$type', price = '$price', mauId = '$mau', soLuong = '$soLuong'
                              WHERE productId = '$id' ";
                }
                $result = $this->db->insert($query);
                if($result){
                    move_uploaded_file($file_temp, $uploaded_image);
                    $alert = "<div class='div_success'><span class='success'>Sửa sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Sửa sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }
            }
        }

        public function del_product($id){
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Xóa thành công!!!</span></div>";
                return $alert;
            }else{
                $alert = "<div class='div_error'><span class='error'>Xóa thất bại!!!</span></div>";
                return $alert;
            }
        }

        /////////////////////////////////  Thêm Slider
        public function insert_slider($post, $files){

            $sliderName = mysqli_real_escape_string($this->db->link, $post['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $post['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $sliderImage = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào foder upload.
            $div = explode('.', $sliderImage);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
             
            if($sliderName == "" || $type == ""){
                $alert = "<div class='div_error'><span class='error'>Các trường không được để trống!</span></div>";
                return $alert;
            }else{
                if(!empty($sliderImage)) {
                    if (in_array($file_ext, $permited) == false) {
                        $alert = "<div class='div_error'><span class='error'>Bạn chỉ có thể upload: -'.implode(', ', $permited).'</span></div>";
                        return $alert;
                    }
                    if($file_size > 99999) {
                        $alert = "<div class='div_error'><span class='error'>File không được lớn quá 2MB!</span></div>";
                        return $alert;    
                    }
                    
                    $query = "INSERT into tbl_slider(sliderName, sliderImage, type) value ('$sliderName', '$unique_image', '$type')";
                    
                }else{
                    $alert = "<div class='div_error'><span class='error'>Hình ảnh không được để để trống!</span></div>";
                    return $alert;
                }
                $result = $this->db->insert($query);
                if($result){
                    move_uploaded_file($file_temp, $uploaded_image);
                    $alert = "<div class='div_success'><span class='success'>Thêm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm thất bại!!!</span></div>";
                    return $alert;
                }
            }
        }


        /////////////////// GET ALL SLIDER
        public function getAlllSlider(){
            $query = " SELECT * from tbl_slider";
            $result = $this->db->select($query);
            return $result;
        }


        //////////////////SHOW SLIDER IN CUSTOMER
        public function show_slider(){
            $query = "SELECT * from tbl_slider where type = 1";
            $result = $this->db->select($query);
            return $result;
        }

        //////////////////UPDATE ACTION TYPE SLIDER
        public function update_Action_Slider($sliderId, $type){
            
            $sliderId = mysqli_real_escape_string($this->db->link, $sliderId);
            $type = mysqli_real_escape_string($this->db->link, $type);
            if($type == 1){ 
                $query = "UPDATE tbl_slider Set type = 0 where sliderId = '$sliderId'";
                $result = $this->db->update($query);
                if(!$result){
                    $mes = "
                    <div class='div_error'>
                        <span class='error'>
                            Mở slider thất bại!
                        </span>
                    </div>";
                    return $mes; 
                }else{
                    $mes = "
                    <div class='div_success'>
                        <span class='success'>
                            Slider đã được đóng!
                        </span>
                    </div>";
                    return $mes;
                }
            }else{
                $query = "UPDATE tbl_slider Set type = 1 where sliderId = '$sliderId'";
                $result = $this->db->update($query);
                if(!$result){
                    $mes = "
                    <div class='div_error'>
                        <span class='error'>
                            Mở slider thất bại!
                        </span>
                    </div>";
                    return $mes; 
                }else{
                    $mes = "
                    <div class='div_success'>
                        <span class='success'>
                            Slider đã được mở!
                        </span>
                    </div>";
                    return $mes;
                }
            }
        }


        /////////////////// DELETE SLIDER

        public function delete_Slider($id){
            $sliderId = mysqli_real_escape_string($this->db->link, $id);

            $query = "DELETE from tbl_slider where sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $mes = "
                <div class='div_success'>
                    <span class='success'>
                        Đã xóa!
                    </span>
                </div>";
                return $mes; 
            }else{
                $mes = "
                <div class='div_error'>
                    <span class='error'>
                        Xóa thất bại!
                    </span>
                </div>";
                return $mes; 
            }
        }

        //END BACKEND

        public function get_product(){
            $query = "SELECT * FROM tbl_product WHERE type = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_productnew(){
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT 5 ";
            $result = $this->db->select($query);
            return $result;
        }

        public function product_details($id){
            $query = "SELECT p.*, c.catName, b.brandName 
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        ///////////////Lấy sản phẩm theo loại
        public function get_product_by_catid($cartId){
            $query = "SELECT * FROM tbl_product where catId = '$cartId' order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        ////////////////Lấy sản phẩm tương tự
        public function get_product_near($cartId, $id){
            $query = "SELECT * FROM tbl_product where catId = '$cartId' and productId != '$id' order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        /////////////////////// SELECT ALL PRODUCT LIKE
        public function get_product_like($customer_id){
            $query = "SELECT pl.*, p.productName, p.price, p.moTa, p.image
                    FROM tbl_product_like as pl
                    inner join tbl_product as p on pl.productId = p.productId
                    inner join tbl_customer as c on pl.customer_id = c.customer_id ";
            $result = $this->db->select($query);
            return $result;
        }
        //////////////////////////////////////

        ////////////// CHECK_PRODUCT_LIKE
        public function check_product_like($productId, $customer_id){
            $productId = $this->fm->validation($productId); 
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $check_product_like = "SELECT * FROM tbl_product_like where productId = '$productId' and customer_id = '$customer_id'";
            $checkproduct_like = $this->db->select($check_product_like);
            return $checkproduct_like;
        }
        ///////////////////////////////

        ///// ADD PRODUCT LIKE
        public function insert_to_product_like($productId, $customer_id){

            $productId = $this->fm->validation($productId); 
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $check_product_like = "SELECT * FROM tbl_product_like where productId = '$productId' and customer_id = '$customer_id'";
            $checkproduct_like = $this->db->select($check_product_like);
            if($checkproduct_like){
                $message = "<span class='success'>Đã thêm vào sản phẩm ưa thích!</span>";
                return $message;
            }else{

                $query_insert = "INSERT INTO tbl_product_like(productId, customer_id) VALUE ('$productId', '$customer_id') ";
                $insert_product_like = $this->db->insert($query_insert);
                if($insert_product_like){
                    $alert = "<span class='success'>Đã thêm vào sản phẩm ưa thích!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm thất bại!</span>";
                    return $alert;
                }
            }
        }
        //////////////////////////////////////

        //////////////DELETE PRODUCT_LIKE
        public function delete_product_like($productId, $customer_id){

            $productId = $this->fm->validation($productId); 
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $query = "DELETE FROM tbl_product_like where productId = '$productId' and customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Đã xóa khỏi sản phẩm ưa thích!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Xóa thất bại!</span>";
                    return $alert;
            }
        }


        /////////////////////////SEARCH PRODUCT
        public function search_product($search){

            $search = $this->fm->validation($search);

            $query = "SELECT * from tbl_product where productName like '%$search%'";
            $result = $this->db->select($query);
            return $result;
        }

        


        ////////////////SHOW CATEGORY BY ID AND PRICE
        public function show_cate_by_price($catId, $price, $tu, $den){
            if($price == "duoi3"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price <= 3000000";
            }else if($price == "3den10"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= 3000000 and price <= 10000000";
            }else if($price == "tren10"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= 10000000";
            }else if($price == "between"){    
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= $tu and price <= $den";
            }
            $result = $this->db->select($query);
            return $result;
                
        }
        

         ////////////////SHOW CATEGORY BY ID AND PRICE AND BRANDID
         public function show_cate_by_price_brand($catId, $price, $brandId, $tu, $den){
            if($price == "duoi3"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price <= 3000000 and brandId = '$brandId'";
            }else if($price == "3den10"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= 3000000 and price <= 10000000 and brandId = '$brandId'";
            }else if($price == "tren10"){
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= 10000000 and brandId = '$brandId'";
            }else{
                $query = "SELECT * from tbl_product where catId = '$catId' and price >= $tu and price <= $den and brandId = '$brandId'";
            }
            $result = $this->db->select($query);
            return $result;
                
        }

        /////////////////SHOW BRAND
        public function show_brand_by_cat(){
            $query = "SELECT * from tbl_brand limit 11";
            $result = $this->db->select($query);
            return $result;
        }

        ////////////////SHOW PRODUCT BY BRAND AND CATID
        public function show_product_by_brand_cat($catId, $brandId){
            $query = "SELECT * from tbl_product where catId = '$catId' and brandId = '$brandId'";
            $result = $this->db->select($query);
            return $result;
        }

        
        ///////////////////////SHOW LIST IMAGE DETAILS
        public function show_details_img($productId){
            $query = "SELECT * from tbl_detailsimg where productId = '$productId'";
            $result = $this->db->select($query);
            return $result;
        }


        //////////////////ADD IMAGE DETAILS PRODUCT IMG 
        public function addImgDetails($productId, $file){

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào foder upload.
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if (in_array($file_ext, $permited) == false) {
                $alert = "<div class='div_error'><span class='error'>Bạn chỉ có thể upload: -".implode(', ', $permited)."</span></div>";
                return $alert;
            }

            if($file_size > 999999) {
                $alert = "<div class='div_error'><span class='error'>File không được lớn quá 20MB!!!</span></div>";
                return $alert;    
            }
            $queryCheck = "SELECT * FROm tbl_detailsimg where productId = '$productId'";
            $checkSl = $this->db->select($queryCheck);
            if($checkSl){
                $i = 0;
                while($checkSl->fetch_assoc()){
                    $i++;
                }
                if($i == 3){
                    $alert = "<div class='div_error'><span class='error'>Tối đa chỉ được 3 ảnh!</span></div>";
                    return $alert;
                }
            }

            $query = "INSERT INTO tbl_detailsimg(productId, img) VALUE ('$productId', '$unique_image') ";
                $result = $this->db->insert($query);
 
                if($result){
                    move_uploaded_file($file_temp, $uploaded_image);
                    $alert = "<div class='div_success'><span class='success'>Thêm sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

        }


        /////////////////////DELETE IMAGE DETAILS PRODUCT IMG
        public function delete_img_details($imgId){
            $query = "DELETE from tbl_detailsimg where id = '$imgId'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Đã xóa khỏi sản phẩm ưa thích!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Xóa thất bại!</span></div>";
                    return $alert;
            }

        }

        /////////////////////DIEN THOAI NOI BAT 
        public function show_dienthoai(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            where c.catId = 19
            order by p.productId desc
            limit 4";
            $result = $this->db->select($query);
            return $result;
        }


        /////////////////////LAPTOP NOI BAT 
        public function show_laptop(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            where c.catId = 20
            order by p.productId desc
            limit 4";
            $result = $this->db->select($query);
            return $result;
        }



        /////////////////////APPLE NOI BAT 
        public function show_apple(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            where c.catId = 26
            order by p.productId desc
            limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        /////////////////////MAY ANH NOI BAT 
        public function show_mayanh(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            where c.catId = 27
            order by p.productId desc
            limit 4";
            $result = $this->db->select($query);
            return $result;
        }



         /////////////////////MAY ANH NOI BAT 
         public function show_phukien(){
            $query = "SELECT p.*, c.catName, b.brandName , m.name
            FROM tbl_product as p INNER JOIN tbl_category as c ON p.catId = c.catId
                                  INNER JOIN tbl_brand as b ON p.brandId = b.brandId
                                  inner join tbl_mau as m on p.mauId = m.mauId  
            where c.catId = 28
            order by p.productId desc
            limit 4";
            $result = $this->db->select($query);
            return $result;
        }


        /////////////////////THỐNG KÊ ADMIN
        ////////////////////////////////THỐNG KÊ SẢN PHẨM
        public function statisticalProduct(){
            $query = "SELECT t.productId, p.productName, m.name, p.image, p.price, sum(quantity) as totalProduct 
                        from tbl_transactionhistory as t
                        inner join tbl_product as p on t.productId = p.productId
                        inner join tbl_mau as m on p.mauId = m.mauId
                        group by t.productId, p.productName, p.image, m.name, p.price";
            $result = $this->db->select($query);
            return $result;
        }

        ////////////////////////////////THỐNG KHÁCH HÀNG
        public function statisticalCustomer(){
            $query = "SELECT t.customer_id, c.name, c.phone, sum(quantity*p.price) as totalProduct 
                        from tbl_transactionhistory as t
                        inner join tbl_customer as c on t.customer_id = c.customer_id
                        inner join tbl_product as p on t.productId = p.productId
                        group by t.customer_id, c.name, c.phone";
            $result = $this->db->select($query);
            return $result;
        }

        ////////////////////////////////THỐNG KÊ DOANH THU
        public function statisticalRevenue(){
            $query = "SELECT t.*, p.price  from tbl_transactionhistory as t
                        inner join tbl_product as p on t.productId = p.productId";
            $result = $this->db->select($query);
            return $result;
        }



    }
    
?>