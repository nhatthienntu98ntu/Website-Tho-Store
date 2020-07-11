</div>
<div class="footer">
	<div class="wrapper">
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<ul>
					<li><a href="#">Lịch sử mua hàng</a></li>
					<li><a href="#">Tìm hiểu về mua trả góp</a></li>
					<li><a href="#"><span>Chính sách bảo hành</span></a></li>
					<li><a href="#">Chính sách đổi trả</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<ul>
					<li><a href="#">Giới thiệu công ty</a></li>
					<li><a href="#">Tuyển dụng</a></li>
					<li><a href="#">Gửi góp ý, khiếu nại</a></li>
					<li><a href="#"><span>Tìm cửa hàng</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<ul>
					<li><a href="sign_in.php">Đăng nhập</a></li>
					<li><a href="cart.php">Xem giỏ hàng</a></li>
					<li><a href="productlike.php">Sản phẩm ưa thích</a></li>
					<li><a href="oderdetails.php">Đơn hàng đã đặt</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<ul>
					<p>Gọi mua hàng <a href="#">+84-0166588723</a></p>
					<p>Gọi bảo hành <a href="#">+84-0166588723</a></p>
					<p>Gọi kỹ thuật <a href="#">+84-0166588723</a></p>
				</ul>
				<div class="social-icons">
					<ul>
						<li class="facebook"><a href="#" target="_blank"> </a></li>
						<li class="twitter"><a href="#" target="_blank"> </a></li>
						<li class="googleplus"><a href="#" target="_blank"> </a></li>
						<li class="contact"><a href="#" target="_blank"> </a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="designed">
		<p>Website designed by Nguyen Nhat Thien, phone: 03658887**, gmail: nhatthienntu98@gmail.com</p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<!-- <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span></a> -->


	<div class="top">
		<i class="fa fa-chevron-up top_click"></i>
	</div>

<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
	$(function() {
		SyntaxHighlighter.all();
	});
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider) {
				$('body').removeClass('loading');
			}
		});
	});


	let domTopCLick = document.querySelector('.top_click')
	domTopCLick.onclick = function () {
		let domBody = document.querySelector('body');
		domBody.scrollTop = 0;
	}


	$(window).scroll(function () { 
		let vitri = $('body').scrollTop();

		if(vitri >= 180){
			$('i.top_click').addClass('active');
		}else if(vitri < 180){
			$('i.top_click').removeClass('active');
		}
	});
</script>
<script>
	let demUser = 0;
	function showUser(){
		if(demUser%2 === 0){
			document.getElementById('showUser').style.display = "block";
			demUser++;
		}else{
			document.getElementById('showUser').style.display = "none";
			demUser++;
		}
	}
</script>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>