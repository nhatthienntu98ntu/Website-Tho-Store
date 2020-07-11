<?php include 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/user.php';?>
<?php
    $user = new user();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $adminId = Session::get("adminId");
        $changePass = $user->changePass($oldPass, $newPass, $adminId);
    }

?>
<script>
    $(document).ready(function(){
        $('#again_pass').blur(function(){
            if($('#again_pass').val() == $('#pass').val()){
                $('#error_pass').html("");
            }else{
                $('#error_pass').html("Mật khẩu mới không khớp!");
            }
        })
    });
</script>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">   
        <?php
        
            if(isset($changePass)){
                echo $changePass;
            }
        
        ?>            
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" required placeholder="Nhập mật khẩu cũ..."  name="oldPass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input id="pass" type="password" required placeholder="Nhập mật khẩu mới..." name="newPass" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nhập lại khẩu mới</label>
                    </td>
                    <td>
                        <input id="again_pass" type="password" required placeholder="Nhập lại mật khẩu mới..." name="newPass" class="medium" />
                        <span style="font-size: 13  px; color:red" id="error_pass"></span>
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>