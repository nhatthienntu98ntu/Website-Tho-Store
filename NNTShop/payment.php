<?php	
    ob_start();
	include_once 'inc/header.php';
	// include_once 'inc/slider.php';
?>
<?php
    if(!$check_login){
        header('Location:sign_in.php?url=cart.php');
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Đặt Hàng Nhanh</h3>
                </div>
            <div class="clear"></div>
            </div>
            <div class="payment_href">
                <h3>Chọn hình thức thanh toán</h3>
                <span><a href="offlinepayment.php">Thanh toán Offline</a></span>
                <span><a href="onlinepayment.php">Thanh toán Online</a></span>
            </div>
        </div>
    </div>
</div>
<?php	
	include_once 'inc/footer.php';
    ob_end_flush(); 
?>