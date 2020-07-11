<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
    include_once ($filepath.'/../lib/session.php');
    // Session::checkLogin();
?>
<?php 
    class admin 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }


        /////////////////////GET ALL ADMIN
        public function insert_admin($data){

            $adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
            $adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
            $adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
            $adminPass = mysqli_real_escape_string($this->db->link, $data['adminPass']);
            $level = mysqli_real_escape_string($this->db->link, $data['level']);

            if($adminName == "" || $adminEmail == "" || $adminUser == "" || $adminPass == "" || $level == "" ){
                $alert = "<div class='div_error'><span class='error'>Các trường không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_admin(adminName, adminEmail, adminUser, adminPass, level) VALUE ('$adminName',
                 '$adminEmail', '$adminUser', '$adminPass', '$level') ";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Thêm thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Thêm thất bại!!!</span></div>";
                    return $alert;
                }
        
            }

        }

        ////////////UPDATE ADMIN
        public function update_admin($adminId, $data){

            $adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
            $adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
            $adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
            $adminPass = mysqli_real_escape_string($this->db->link, $data['adminPass']);
            $level = mysqli_real_escape_string($this->db->link, $data['level']);

            if($adminName == "" || $adminEmail == "" || $adminUser == "" || $adminPass == "" || $level == "" ){
                $alert = "<div class='div_error'><span class='error'>Các trường không được để trống!</span></div>";
                return $alert;
            }else{

                $query = "UPDATE tbl_admin set adminName = '$adminName', adminEmail = '$adminEmail', adminUser = '$adminUser', adminPass = '$adminPass', level = '$level' where adminId = '$adminId'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<div class='div_success'><span class='success'>Cập nhật thành công!!!</span></div>";
                    return $alert;
                }else{
                    $alert = "<div class='div_error'><span class='error'>Cập nhật thất bại!!!</span></div>";
                    return $alert;
                }
            
            }
            
        }


        ////////////////DELETE ADMIN
        public function delete_admmin($adminId){
            $query = "DELETE from tbl_admin where adminId = '$adminId'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<div class='div_success'><span class='success'>Xóa thành công!!!</span></div>";
                return $alert;
            }else{
                $alert = "<div class='div_error'><span class='error'>Xóa thất bại!!!</span></div>";
                return $alert;
            }

        }


        //////////////////GET ADMIN BY ID

        public function getadminbyId($adminId){
            $query = "SELECT * from tbl_admin where adminId = '$adminId'";
            $getadmin = $this->db->select($query);
            return $getadmin;
        }
        


         /////////////////////GET ALL ADMIN
         public function getAllAdmin(){
            $query = "SELECT * from tbl_admin";
            $getadmin = $this->db->select($query);
            return $getadmin;
        }



        

    }
    
?>