<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/fomat.php');
?>
<?php 
    class user
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        ////////////////////CHANGE PASS
        
        public function changePass($oldPass, $newPass, $adminId){
            $oldPass = md5($this->fm->validation($oldPass));
            $newPass = md5($this->fm->validation($newPass));

            $query = "SELECT * from tbl_admin where adminId = $adminId";
            $result = $this->db->select($query);
            if($result){
                $admin = $result->fetch_assoc();
                if($oldPass == $admin['adminPass']){
                    $querychangePass = "UPDATE tbl_admin set adminPass = '$newPass'";
                    $result_change_pass = $this->db->update($querychangePass);
                    if($result_change_pass){
                        $alert = "<div class='div_success'><span class='success'>Thay đổi mật khẩu thành công!</span></div>";
                        return $alert;
                    }else{
                        $alert = "<div class='div_error'><span class='error'>Thay đổi mật khẩu thất bại!</span></div>";
                        return $alert;
                        }
                }else{
                    $alert = "<div class='div_error'><span class='error'>Mật khẩu cũ không chính xác!</span></div>";
                    return $alert;
                }
            }
        }

        ////////////////////////Profile Admin

        public function getAdmin($adminId){
            $adminId = $this->fm->validation($adminId);

            $query = "SELECT * from tbl_admin where adminId = '$adminId' limit 1";
            $result = $this->db->select($query);
            return $result;
        }


    }
    
?>