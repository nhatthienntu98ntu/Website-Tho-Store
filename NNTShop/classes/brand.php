<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class brand
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_brand($brandName)
        {
            $brandName = $this->fm->validation($brandName);  
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            if( empty($brandName)){
                $alert = "<div class='div_error'><span class='error'>Brand không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_brand(brandName) VALUE ('$brandName') ";
                $result = $this->db->insert($query);
 
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Thêm thương hiệu sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm thương hiệu sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        public function show_brand(){
            $query = "SELECT * FROM tbl_brand order by brandId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getbrandbyId($brandId){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$brandId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_brand($brandId, $brandName){
            $brandName = $this->fm->validation($brandName);  
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $brandId = mysqli_real_escape_string($this->db->link, $brandId);
            
            if( empty($brandName)){
                $alert = "<div class='div_error'><span class='error'>Brand không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$brandId'";
                $result = $this->db->insert($query);
 
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Sửa thương hiệu sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Sửa thương hiệu sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        public function del_brand($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Xóa thành công!!!</span></div>";
                return $alert;
            }else{
                $alert = "<div class='div_error'><span class='error'>Xóa thất bại!!!</span></div>";
                return $alert;
            }
        }


        

    }
    
?>