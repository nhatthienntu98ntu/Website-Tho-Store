<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class mau 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_mau($name)
        {
            $name = $this->fm->validation($name);  
            $name = mysqli_real_escape_string($this->db->link, $name);
            
            if( empty($name)){
                $alert = "<div class='div_error'><span class='error'>Tên màu không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_mau(name) VALUE ('$name') ";
                $result = $this->db->insert($query);
 
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Thêm màu thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm màu thất bại!!!</span></div>";
                    return $alert;
                }

            }
        }

        public function show_mau(){
            $query = "SELECT * FROM tbl_mau order by mauId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getmaubyId($mauId){
            $query = "SELECT * FROM tbl_mau WHERE mauId = '$mauId'";
            $result = $this->db->select($query);
            return $result;
        }

        

        public function del_mau($id){
            $query = "DELETE FROM tbl_mau WHERE mauId = '$id'";
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