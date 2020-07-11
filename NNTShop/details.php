<?php
ob_start();
include 'inc/header.php';
?>
<?php
////////////Lấy id sản phẩm
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['id'];
}

//////////////////Mua sản phẩm
$product = new product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$AddtoCart = $ct->add_to_cart($id, $quantity);
}
/////////////Lấy id người dùng
$customer_id = Session::get("customer_id");

/////////////////////////////Thêm sản phẩm ưa thích 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
	$insert_to_product_like = $product->insert_to_product_like($id, $customer_id);
}

/////////////////////////////Xóa sản phẩm ưa thích
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unlike'])) {
	$delete_product_like = $product->delete_product_like($id, $customer_id);
}

/////////////////////////Thêm đánh giá
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-report'])) {
	if (isset($customer_id) && $customer_id != null) {
		$evaluate = $_POST['evaluate'];
		$content = $_POST['fRContent'];
		$insert_report = $cs->insert_report($id, $customer_id, $content, $evaluate);
		if ($insert_report) {
			echo $insert_report;
		} else {
			echo "<script>alert('Gửi đánh giá thất bại!')</script>";
		}
	} else {
		echo "<script>alert('Bạn cần đăng nhập trước khi đánh giá!')</script>";
	}
}
?>

<?php
$getAllComment = $cs->getAllComment($id);
if ($getAllComment) {
	$total_star = 0;
	$soLuongComment = 0;
	$namSaos = 0;
	$bonSaos = 0;
	$baSaos = 0;
	$haiSaos = 0;
	$motSaos = 0;
	while ($result_comment = $getAllComment->fetch_assoc()) {
		$soLuongComment++;
		$total_star += $result_comment['evaluate'];
		if ($result_comment['evaluate'] == 1) {
			$motSaos++;
		} else if ($result_comment['evaluate'] == 2) {
			$haiSaos++;
		} else if ($result_comment['evaluate'] == 3) {
			$baSaos++;
		} else if ($result_comment['evaluate'] == 4) {
			$bonSaos++;
		} else {
			$namSaos++;
		}
	}
	$medium = round($total_star / $soLuongComment, 1);
} else {
	$total_star = 0;
	$soLuongComment = 0;
	$namSaos = 0;
	$bonSaos = 0;
	$baSaos = 0;
	$haiSaos = 0;
	$motSaos = 0;
	$medium = 0;
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getproductId = $product->product_details($id);
			if ($getproductId) {
				$action = 0;
				while ($result = $getproductId->fetch_assoc()) {
					$productName = $result['productName'];
					$catId = $result['catId'];
					echo "<div class='title_h1'>
							<h1>{$result['productName']}</h1>
						</div>";
			?>

					<hr width="98%">
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img class="img_by_cat" id="main-image" src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
							<ul class="detailsImg">
								<li class="imgItem"><img src="admin/uploads/<?php echo $result['image'] ?>" id="<?php echo $result['image'] ?>" alt="" onclick="changeImg('<?php echo $result['image'] ?>')"></li>
								<?php
								$getdetailsImg = $product->show_details_img($id);
								if ($getdetailsImg) {
									while ($result_details_img = $getdetailsImg->fetch_assoc()) {
								?>
										<li class="imgItem"><img src="admin/uploads/<?php echo $result_details_img['img'] ?>" id="<?php echo $result_details_img['img'] ?>" alt="" onclick="changeImg('<?php echo $result_details_img['img'] ?>')"></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
						<div class="desc span_3_of_2">
							<div class="chitiet_product">
								<div class="price">
									<p><span><?php echo $fm->format_price($result['price']) ?>đ</span></p>
									<div class="khuyenmai">
									</div>
									<div class="fk-boxs">
										<div id="km-detail">
											<p class="fk-tit">Khuyến mại đặc biệt (SL có hạn)</p>
											<div class="fk-main">
												<div class="fk-sales">
													<p class="tkmspcrb">Gi&aacute; đặc biệt khi mua Online đến 14/06: 7,490,000đ</p>
													<ul>
														<li>Trả góp 1% chỉ từ 699,000đ</li>
														<li>Trả góp 0%</li>
														<li>Thu cũ đổi mới tiết kiệm đến 14 triệu</li>
													</ul>

													<p class="tkmspbb">Kh&aacute;ch h&agrave;ng được khuyến mại th&ecirc;m:</p>

													<ul>
														<li>Tặng PMH 500,000đ mua Airpods</li>
													</ul>

													<ul>
														<li><?php echo $result['moTa'] ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="add-cart">
									<form action="" method="post">
										<input type="submit" class="buysubmit" name="submit" value="MUA NGAY" />
										<input style="width: 50px" type="number" class="buyfield" name="quantity" value="1" min="1" />
									</form>
									<?php
									if (isset($AddtoCart)) {
										echo "<span style='color: red; font-size: 18px; font-weight: bold; padding-top: 10px;'>$AddtoCart</span>";
									}
									?>
								</div>
								<?php
								if ($check_login) {
								?>
									<div class="add-cart">
										<form action="" method="post">
											<?php
											$check_product_like = $product->check_product_like($id, $customer_id);
											if ($check_product_like) {

											?>
												<input type="submit" class="buysubmit" name="unlike" value="Đã thích" />
											<?php } else { ?>
												<input type="submit" class="buysubmit" name="like" value="Thích" />
											<?php } ?>
											<?php
											if (isset($insert_to_product_like)) {
												echo $insert_to_product_like;
											}
											if (isset($delete_product_like)) {
												echo $delete_product_like;
											}
											?>
										</form>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="product-desc">

						</div>

					</div>
					<div class="rightsidebar span_3_of_1">
						<h2 class="title_parameter">Thông số kỹ thuật</h2>
						<p><?php echo $result['product_desc'] ?></p>
					</div>

			<?php }
			} else echo "<script>window.location = '404.php'</script>";
			?>
		</div>
		<div class="product-near">
			<div class="productNear">
				<h2 class="title_productNear">Các sản phẩm tương tự</h2>
			</div>
			<div class="row row_css">
				<?php
				$product_near = $product->get_product_near($catId, $id);
				if ($product_near) {
					while ($result = $product_near->fetch_assoc()) {
				?>
						<div class="product col-12 col-lg-3">
							<a href="details.php?id=<?php echo $result['productId'] ?>">
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
								<h2><?php echo $result['productName']	?></h2>
								<div class="group-price">
									<span class="price"><?php echo  $fm->format_price($result['price']) ?>đ</span>
									<span class="low-price"><?php echo  $fm->format_price($result['price'] - 500000) ?>đ</span>
								</div>
								<p><?php echo $result['moTa'] ?></p>
							</a>
						</div>
				<?php }
				} ?>
			</div>
		</div>
		<div class="comment span_1_of_2">
			<div class="productNear">
				<h2 class="title_productNear">Đánh giá <?php echo $productName ?></h2>
			</div>
			<div class="toprt">
				<div class="crt">
					<div class="lcrt ">
						<b><?php echo $medium ?> <i class="fa fa-star"></i></b>

					</div>
					<div class="rcrt">
						<div class="r">
							<span class="t">5 <i class="fa fa-star"></i></span>
							<div class="bgb">
								<div class="bgb-in" style="width: <?php echo $namSaos * 100 / $soLuongComment . "%" ?>"></div>
							</div>
							<span class="c" onclick="ratingCmtList(1,5)" data-buy="26"><strong><?php echo $namSaos ?></strong> đánh giá</span>
						</div>

						<div class="r">
							<span class="t">4 <i class="fa fa-star"></i></span>
							<div class="bgb">
								<div class="bgb-in" style="width: <?php echo $bonSaos * 100 / $soLuongComment . "%" ?>"></div>
							</div>
							<span class="c" onclick="ratingCmtList(1,4)" data-buy="8"><strong><?php echo $bonSaos ?></strong> đánh giá</span>
						</div>

						<div class="r">
							<span class="t">3 <i class="fa fa-star"></i></span>
							<div class="bgb">
								<div class="bgb-in" style="width: <?php echo $baSaos * 100 / $soLuongComment . "%" ?>"></div>
							</div>
							<span class="c" onclick="ratingCmtList(1,3)" data-buy="3"><strong><?php echo $baSaos ?></strong> đánh giá</span>
						</div>

						<div class="r">
							<span class="t">2 <i class="fa fa-star"></i></span>
							<div class="bgb">
								<div class="bgb-in" style="width: <?php echo $haiSaos * 100 / $soLuongComment . "%" ?>"></div>
							</div>
							<span class="c" onclick="ratingCmtList(1,2)" data-buy="2"><strong><?php echo $haiSaos ?></strong> đánh giá</span>
						</div>

						<div class="r">
							<span class="t">1 <i class="fa fa-star"></i></span>
							<div class="bgb">
								<div class="bgb-in" style="width: <?php echo $motSaos * 100 / $soLuongComment . "%" ?>"></div>
							</div>
							<span class="c" onclick="ratingCmtList(1,1)" data-buy="1"><strong><?php echo $motSaos ?></strong> đánh giá</span>
						</div>

					</div>
					<div class="bcrt">
						<a href="javascript:danhGia()">Gửi đánh giá của bạn</a>
					</div>
				</div>
				<div class="clr"></div>
				<form action="" method="post" class="input hide" name="fRatingComment">
					<input type="hidden" name="hdfStar" id="hdfStar" value="5" />
					<input type="hidden" name="hdfProductID" id="hdfProductID" value="190321" />
					<input type="hidden" name="hdfRatingImg" class="hdfRatingImg" />
					<div class="ips">
						<span>Chọn đánh giá của bạn</span>
						<span class="lStar">
							<i id="i1" class="fa fa-star" onmouseover="content(1)"></i>
							<i id="i2" class="fa fa-star" onmouseover="content(2)"></i>
							<i id="i3" class="fa fa-star" onmouseover="content(3)"></i>
							<i id="i4" class="fa fa-star" onmouseover="content(4)"></i>
							<i id="i5" class="fa fa-star" onmouseover="content(5)"></i>
						</span>
						<input id="evaluate" type="number" name="evaluate" value="5" class="hide">
						<span id="content" class="rsStar">Tuyệt vời</span>
					</div>
					<div class="clr"></div>
					<div class="ipt ">
						<div class="ct">
							<textarea name="fRContent" placeholder="Nhập đánh giá về sản phẩm"></textarea>
							<div class="extCt">
								<label onclick="javascript:void(0);" class="lnksimg btnRatingUpload"><i class="fa fa-camera"></i>Đính kèm ảnh</label>
								<span class="ckt"></span>
								<input id="hdFileRatingUpload" type="file" class="hide" accept="image/x-png, image/gif, image/jpeg" />
							</div>
						</div>
						<div class="if">
							<input class="report" type="submit" name="submit-report" value="GỬI ĐÁNH GIÁ" />
						</div>
						<div class="clr"></div>
						<ul class="resImg hide">

						</ul>
						<span class="lbMsgRt"></span>
					</div>
				</form>
			</div>
			<div class="list-comment">
				<div class="list">
					<ul class="ratingLst">
						<?php
						$getAllComment = $cs->getAllComment($id);
						if ($getAllComment) {
							$dem = 0;
							while ($result = $getAllComment->fetch_assoc()) {
								$dem++;
								if($dem < 3){
						?>
									<li id="r-41845296" class="par">
								<?php }else{ ?>
									<li id="r-41845296" class="par comment_hide hide">
								<?php } ?>
									<div class="rh">
										<span><?php echo  $result['name'] ?></span>
										<label class="sttB"><i class="fa fa-check-circle"></i>Đ&#227; mua tại nntstore.com</label>
									</div>
									<div class="rc">
										<p>
											<span>
												<?php $demSao = $result['evaluate'];
												$unDemSao = 5 - $demSao;
												while ($demSao > 0) { ?>
													<i class="fa fa-star"></i>
												<?php $demSao--;
												}
												while ($unDemSao > 0) { ?>
													<i class="fa fa-star color-star"></i>
												<?php $unDemSao--;
												} ?>
											</span>
											<i><?php echo $result['comment_content'] ?></i>
										</p>
									</div>

									<div class="ra">
										<a href="javascript:;" class="cmtr">Thảo luận</a>
										<span>• </span>
										<a href="javascript:;" class="cmtl" data-like="0"><i class="fas fa-thumbs-up"></i>Hữu &#237;ch</a><span> • </span>
										<a href="javascript:;" class="cmtd">1 tuần trước</a>
									</div>
								</li>
						<?php
							}
						}
						?>
					</ul>
					<div class="clr"></div>
				</div>
				<a id="xemcm" class="rtpLnk" href="javascript:comment_hide()">Xem tất cả đánh giá<span>›</span></a>
			</div>
		</div>
	</div>
</div>
<script src="js/detailsImg.js"></script>
<script>
	
	let demcm = 0;
	function comment_hide(){
		if(demcm%2 === 0){
			$('.comment_hide').removeClass('hide')
			document.getElementById('xemcm').innerHTML = "\<span\>< \</span\>Ẩn một số đánh giá";
			demcm++;
		}else{
			$('.comment_hide').addClass('hide')
			document.getElementById('xemcm').innerHTML = "Xem tất cả đánh giá\<span\>›\</span\>";
			demcm++;
		}
	}
	let dem = 1;
	let color = document.querySelectorAll('.color-star');
	color.style.color = "#ccc";

	function danhGia() {
		if (dem % 2 === 0) {
			$('.input').addClass('hide');
			dem++;
		} else {
			$('.input').removeClass('hide');
			dem++;
		}
	}

	function content(x) {
		if (x === 1) {
			document.getElementById('evaluate').value = "1";
			$('#content').removeClass('hide');
			document.getElementById('content').innerHTML = "Không thích";
			$('#i2').addClass('color-star');
			$('#i3').addClass('color-star');
			$('#i4').addClass('color-star');
			$('#i5').addClass('color-star');
		} else if (x === 2) {
			document.getElementById('evaluate').value = "2";
			$('#content').removeClass('hide');
			document.getElementById('content').innerHTML = "Tạm được";
			$('#i2').removeClass('color-star');
			$('#i3').addClass('color-star');
			$('#i4').addClass('color-star');
			$('#i5').addClass('color-star');
		} else if (x === 3) {
			document.getElementById('evaluate').value = "3";
			$('#content').removeClass('hide');
			document.getElementById('content').innerHTML = "Bình thường";
			$('#i2').removeClass('color-star');
			$('#i3').removeClass('color-star');
			$('#i4').addClass('color-star');
			$('#i5').addClass('color-star');
		} else if (x === 4) {
			document.getElementById('evaluate').value = "4";
			$('#content').removeClass('hide');
			document.getElementById('content').innerHTML = "Rất tốt";
			$('#i2').removeClass('color-star');
			$('#i3').removeClass('color-star');
			$('#i4').removeClass('color-star');
			$('#i5').addClass('color-star');
		} else {
			document.getElementById('evaluate').value = "5";
			$('#content').removeClass('hide');
			$('#i2').removeClass('color-star');
			$('#i3').removeClass('color-star');
			$('#i4').removeClass('color-star');
			$('#i5').removeClass('color-star');
			document.getElementById('content').innerHTML = "Tuyệt vời";
		}
	}
</script>
<?php
include 'inc/footer.php';
?>