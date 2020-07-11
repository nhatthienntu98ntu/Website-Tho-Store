<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php'; ?>
<?php
$customer = new customer();
if(!isset($_GET['customer_id']) && $_GET['customer_id'] == NULL){
    echo "<script>window.location = 'customer_.php'</script>";
}else{
    $customer_id = $_GET['customer_id'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $update_customer = $customer->update_customer_admin($customer_id, $_POST);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chỉnh Sửa Tài Khoản</h2>
        <?php
                    if (isset($update_customer)) {
                        echo $update_customer;
                    }
                    ?>
        <div class="block">
            <?php
            $get_customer_id = $customer->select_customerId($customer_id);
            if ($get_customer_id) {
                while ($result = $get_customer_id->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Tên người dùng</label>
                                </td>
                                <td>
                                    <input type="text" name="name" class="medium" value="<?php echo $result['name'] ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Số điện thoại</label>
                                </td>
                                <td>
                                    <input name="phone" type="text" value="<?php echo $result['phone'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Thành phố</label>
                                </td>
                                <td>
                                    <input name="city" type="text" placeholder="Mô tả..." class="medium" value="<?php echo $result['city'] ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Địa chỉ</label>
                                </td>
                                <td>
                                    <input name="addRess" type="text" value="<?php echo $result['addRess'] ?>" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input name="email" type="text" value="<?php echo $result['email'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Mật khẩu</label>
                                </td>
                                <td>
                                    <input name="passWord" type="text" value="<?php echo $result['passWord'] ?>" class="medium" />
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