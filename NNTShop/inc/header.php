<?php
ob_start();
include_once 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/fomat.php';
spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE php>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/css.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" rel="stylesheet" />

	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="css_header  ">
		<div class="header_top containerr">
			<div class="logo">
				<a style="text-decoration: none;" href="index.php"><img src="images/logo.jpg" alt="" width="50px" height="auto" style="float: left; border-radius: 50%;" />
					<h2 style="margin-top: 5px;">NNT STORE</h2>
				</a>

			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="post">
						<input style="background-color: azure;" type="text" placeholder="Tìm kiếm sản phẩm" required name="search">
						<input type="submit" value="Tìm kiếm" name="search_product">
					</form>
				</div>
				<div class="shopping_cart" onclick="return window.location = 'cart.php'">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product"><?php
														$check = $ct->check_cart();
														if ($check) {
															echo $fm->format_price(Session::get("sum")) . "<span class='dong-low'>đ</span>";
														} else {
															echo "Empty";
														}
														?></span>
						</a>
					</div>
					<div class="soLuongCart">
						<p><?php if (Session::get("sum") > 0) {
								echo Session::get("qty");
							} else {
								echo "0";
							} ?></p>
					</div>
				</div>
				<div class="login">
					<?php
					if (isset($_GET['action']) && $_GET['action'] == 'logout') {
						$dele_cart = $ct->delete_all_data_cart();
						Session::destroy();
						header('Location:index.php');
					}

					$check_login = Session::get('customer_login');
					$customer_id = Session::get("customer_id");
					$customerName = Session::get("customerName");
					$emailCustomer = Session::get("emailCustomer");

					if ($check_login) {
						$check_oder = $ct->check_oder($customer_id);  ?>
						<div onclick="showUser()" class="loginlike">
							<span class="name-user"><?php echo $customerName ?></span>
							<div class="navbar-1">
								<div class="dropdown-1">
									<button class="dropbtn-1">
										<i class="fa fa-user" aria-hidden="true"></i>
									</button>
									<div id="showUser" class="dropdown-content-1">
										<div class="header-cc">
											<img src="images/avartar.jpg" alt="">
											<span><?php echo $emailCustomer ?></span>
										</div>
										<ul>
											<li><a href='profile.php'><i class="fa fa-user-edit"></i>Thông tin</a> </li>
											<?php
											if ($check_oder) {
												echo "<li><a href='oderdetails.php'><i class='fa fa-cart-arrow-down'></i>Đơn hàng</a> </li>";
											} else {
												echo '';
											}
											?>
											<li><a href='productlike.php'><i class="fa fa-heart"></i>Sản phẩm ưa thích</a> </li>
											<li><a href='?action=logout'><i class="fa fa-sign-out-alt"></i>Đăng xuất</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php
					} else {
						$urlReload = substr($_SERVER['REQUEST_URI'], 9); ?>
						<a class="sign_in a" href='sign_up.php'>Đăng ký</a>
						<a class="sign_up a" href='sign_in.php?url=<?php echo $urlReload ?>'>Đăng nhập</a>
					<?php
					}
					?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="category">
		<div class="container">
			<div class="row cat_head">
				<?php
				$getCategory = $cat->show_category_frontend();
				if ($getCategory) {
					while ($result = $getCategory->fetch_assoc()) {
				?>
						<div class="category_header">
							<?php
							if (isset($_GET['catId'])) {
								$catId = $_GET['catId'];
								if ($catId == 19) {
									if ($result['catId'] == 19) {
										echo "<i style='color: #fed700; font-size:17px;' class=' fa fa-mobile-alt'></i>";
									} else  if ($result['catId'] == 20) {
										echo "<i class='fa fa-laptop'></i>";
									} else if ($result['catId'] == 26) {
										echo "<i class='fab fa-apple'></i>";
									} else if ($result['catId'] == 27) {
										echo "<i class='fa fa-camera-retro'></i>";
									} else {
										echo "<i class='fa fa-headphones-alt'></i>";
									}
								} else if ($catId == 20) {
									if ($result['catId'] == 19) {
										echo "<i class=' fa fa-mobile-alt'></i>";
									} else  if ($result['catId'] == 20) {
										echo "<i style='color: #fed700; font-size:17px;' class='  fa fa-laptop'></i>";
									} else if ($result['catId'] == 26) {
										echo "<i class='fab fa-apple'></i>";
									} else if ($result['catId'] == 27) {
										echo "<i class='fa fa-camera-retro'></i>";
									} else {
										echo "<i class='fa fa-headphones-alt'></i>";
									}
								} else if ($catId == 26) {
									if ($result['catId'] == 19) {
										echo "<i class=' fa fa-mobile-alt'></i>";
									} else  if ($result['catId'] == 20) {
										echo "<i class='fa fa-laptop'></i>";
									} else if ($result['catId'] == 26) {
										echo "<i style='color: #fed700; font-size:17px;' class=' fab fa-apple'></i>";
									} else if ($result['catId'] == 27) {
										echo "<i class='fa fa-camera-retro'></i>";
									} else {
										echo "<i class='fa fa-headphones-alt'></i>";
									}
								} else if ($catId == 27) {
									if ($result['catId'] == 19) {
										echo "<i class=' fa fa-mobile-alt'></i>";
									} else  if ($result['catId'] == 20) {
										echo "<i class='fa fa-laptop'></i>";
									} else if ($result['catId'] == 26) {
										echo "<i class='fab fa-apple'></i>";
									} else if ($result['catId'] == 27) {
										echo "<i style='color: #fed700; font-size:17px;' class=' fa fa-camera-retro'></i>";
									} else {
										echo "<i class='fa fa-headphones-alt'></i>";
									}
								} else {
									if ($result['catId'] == 19) {
										echo "<i class=' fa fa-mobile-alt'></i>";
									} else  if ($result['catId'] == 20) {
										echo "<i class='fa fa-laptop'></i>";
									} else if ($result['catId'] == 26) {
										echo "<i class='fab fa-apple'></i>";
									} else if ($result['catId'] == 27) {
										echo "<i class=' fa fa-camera-retro'></i>";
									} else {
										echo "<i style='color: #fed700; font-size:17px;' class=' fa fa-headphones-alt'></i>";
									}
								}
							} else {
								if ($result['catId'] == 19) {
									echo "<i class='fa fa-mobile-alt'></i>";
								} else  if ($result['catId'] == 20) {
									echo "<i class='fa fa-laptop'></i>";
								} else if ($result['catId'] == 26) {
									echo "<i class='fab fa-apple'></i>";
								} else if ($result['catId'] == 27) {
									echo "<i class='fa fa-camera-retro'></i>";
								} else {
									echo "<i class='fa fa-headphones-alt'></i>";
								}
							}
							?>
							<?php
							if (isset($_GET['catId'])) {
								$catId = $_GET['catId'];
								if ($catId == $result['catId']) { ?>
									<a style="color: #fed700; font-size:17px;" href="productbycat.php?catId=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a>
								<?php } else { ?>
									<a href="productbycat.php?catId=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a>
								<?php }
							} else { ?>
								<a href="productbycat.php?catId=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a>
							<?php } ?>
						</div>
				<?php
					}
				} ?>
			</div>
		</div>
	</div>
	<div class="wrap">