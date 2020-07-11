<?php	
    ob_start();
	include_once 'inc/header.php';
	// include_once 'inc/slider.php';
?>
<?php
    if(!$check_login){
        header('Location:login.php');
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>THÔNG TIN KHÁCH HÀNG</h3>
                </div>
                <div class="clear"></div>
            </div>

            <table class="tblone">
                <?php
                    $id = Session::get("customer_id");
                    $customer = $cs->select_customerId($id);
                    if($customer){
                        while($result = $customer->fetch_assoc()){
                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Tỉnh</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['addRess'] ?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <?php }} ?>
                <tr>
                    <td colspan="3"><a href="editprofile.php?customerId=<?php echo $id ?>">Chỉnh sửa thông tin</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php	
	include_once 'inc/footer.php';
    ob_end_flush(); 
?>