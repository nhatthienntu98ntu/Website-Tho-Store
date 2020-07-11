<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_category($catName)
        {
            $catName = $this->fm->validation($catName);  
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            
            if( empty($catName)){
                $alert = "<div class='div_error'><span class='error'>Category không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_category(catName) VALUE ('$catName') ";
                $result = $this->db->insert($query);
 
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Thêm danh mục sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm danh mục sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatbyId($catId){
            $query = "SELECT * FROM tbl_category WHERE catId = '$catId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($catId, $catName){
            $catName = $this->fm->validation($catName);  
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $catId = mysqli_real_escape_string($this->db->link, $catId);
            
            if( empty($catName)){
                $alert = "<div class='div_error'><span class='error'>Category không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$catId'";
                $result = $this->db->insert($query);
 
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Sửa danh mục sản phẩm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Sửa danh mục sản phẩm thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        public function del_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Xóa thành công!!!</span></div>";
                return $alert;
            }else{
                $alert = "<div class='div_error'><span class='error'>Xóa thất bại!!!</span></div>";
                return $alert;
            }
        }

        //FONTEND

        ///////////////////Show category
        public function show_category_frontend(){
            $query = "SELECT * FROM tbl_category order by catId asc";
            $result = $this->db->select($query);
            return $result;
        }

            /////////////////Show category by id
        public function show_name_by_id($catId){
            $query = "SELECT * FROM tbl_category WHERE catId = '$catId'";
            $result = $this->db->select($query);
            return $result;
        }


        

    }
    
?>