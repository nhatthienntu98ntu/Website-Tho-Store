<?php
include 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/user.php' ?>
<?php
$adminId = Session::get('adminId');
$user = new user();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>THÔNG TIN ADMIN</h2>
        <div class="boder_customer">
            <table class="tbl_customer">
                <?php
                $getAdmin = $user->getAdmin($adminId);
                if ($getAdmin) {
                    while ($result = $getAdmin->fetch_assoc()) {
                ?>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Tên: </span></td>
                            <td style="text-align: left"><?php echo $result['adminName'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Email: </span></td>
                            <td style="text-align: left"><?php echo $result['adminEmail'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Tên tài khoản: </span></td>
                            <td style="text-align: left"><?php echo $result['adminUser'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Mật khẩu: </span></td>
                            <td style="text-align: left"><?php echo $result['adminPass']    ?></td>
                        </tr>

                        <?php
                        if ($result['level'] == 0) {
                        ?>
                            <tr>
                                <td width="50%" style="text-align: right"><span class="tbl_customer_content">Cấp bậc: </span></td>
                                <td style="text-align: left">Quản trị viên</td>
                            </tr>
                        <?php
                        } else if ($result['level'] == 1) {

                        ?>
                            <tr>
                                <td width="50%" style="text-align: right"><span class="tbl_customer_content">Cấp bậc: </span></td>
                                <td style="text-align: left">Quản lý</td>
                            </tr>
                        <?php
                        } else {

                        ?>
                            <tr>
                                <td width="50%" style="text-align: right"><span class="tbl_customer_content">Cấp bậc: </span></td>
                                <td style="text-align: left">Nhân viên</td>
                            </tr>
                        <?php
                        }
                        ?>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';
?>