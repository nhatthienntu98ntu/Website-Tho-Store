<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/admin.php'; ?>
<?php
$admin = new admin();
if(!isset($_GET['adminId']) && $_GET['adminId'] == NULL){
    echo "<script>window.location = 'admin_.php'</script>";
}else{
    $adminId = $_GET['adminId'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $update_admin = $admin->update_admin($adminId, $_POST);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chỉnh Sửa Tài Khoản</h2>
        <div class="block">
            <?php
                    if (isset($update_admin)) {
                        echo $update_admin;
                    }
                    ?>
            <?php
            $get_admin_id = $admin->getadminbyId($adminId);
            if ($get_admin_id) {
                while ($result_admin = $get_admin_id->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Tên người dùng</label>
                                </td>
                                <td>
                                    <input type="text" name="adminName" class="medium" value="<?php echo $result_admin['adminName'] ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Mail</label>
                                </td>
                                <td>
                                    <input name="adminEmail" type="text" value="<?php echo $result_admin['adminEmail'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Tên tài khoản</label>
                                </td>
                                <td>
                                    <input name="adminUser" type="text" placeholder="Mô tả..." class="medium" value="<?php echo $result_admin['adminUser'] ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Mật khẩu</label>
                                </td>
                                <td>
                                    <input name="adminPass" type="text" value="<?php echo $result_admin['adminPass'] ?>" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>Cấp bậc</label>
                                </td>
                                <td>
                                    <select id="select" name="level">
                                        <option>Chọn kiểu</option>
                                        <?php
                                        if ($result_admin['level'] == 0) {
                                        ?>
                                            <option selected value="0">Admin</option>
                                            <option value="1">Quản lý</option>
                                            <option value="2">Nhân viên</option>
                                        <?php
                                        } else if ($result_admin['level'] == 1) {
                                        ?>
                                            <option  value="0">Admin</option>
                                            <option selected value="1">Quản lý</option>
                                            <option value="2">Nhân viên</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="0">Admin</option>
                                            <option value="1">Quản lý</option>
                                            <option selected value="2">Nhân viên</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Cập nhật" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>