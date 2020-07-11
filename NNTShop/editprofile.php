<?php	
    ob_start();
	include_once 'inc/header.php';
	include_once 'inc/slider.php';
?>
<?php
    if(!$check_login){
        header('Location:login.php');
    }

    if (!isset($_GET['customerId']) || $_GET['customerId'] == NULL) {
        echo "<script>window.location='404.php'</script>";
    } else {
        $customer_id = $_GET['customerId'];
    }

    if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $update_customer = $cs->update_customer($_POST, $customer_id);
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Chỉnh Sửa Thông Tin</h3>
                </div>
                <div class="clear"></div>
            </div>
            <?php
                    if(isset($update_customer)){
                        echo "$update_customer";
                    }
                ?>
            <form action="" method="post">
            <table class="tblone">
                <?php
                    $customer = $cs->select_customerId($customer_id);
                    if($customer){
                        while($result = $customer->fetch_assoc()){
                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><input class="input_edit" type="text" name="name" value="<?php echo $result['name'] ?>"> </td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><input class="input_edit" type="text" name="address" value="<?php echo $result['addRess'] ?>"></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><input class="input_edit" type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><input class="input_edit" type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input class="input_edit" type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                </tr>
                <?php }} ?>
                <tr>
                    <td colspan="3"><button class="editprofile" name="submit" >Save</button></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php	
	include_once 'inc/footer.php';
    ob_end_flush(); 
?>