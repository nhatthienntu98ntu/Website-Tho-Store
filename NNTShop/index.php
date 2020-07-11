<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<div class="main">
	<div class="content content_border">
		<div class="content_top">
			<div class="heading">
				<a href="productbycat.php?catId=19"><h3>Điện thoại nổi bật</h3></a>		
				<a class = "rtpLnkk" href="productbycat.php?catId=19">Xem thêm <span>></span></a>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="row row_css">
			<?php
			$getproduct = $product->show_dienthoai();
			if ($getproduct) {
				while ($result = $getproduct->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
							<h2><?php echo $result['productName']	?></h2>
							<div class="group-price">
								<span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 500000) ?><span class="dong-low">đ</span></span>
							</div>
							<p><?php echo $result['moTa'] ?></p>
						</a>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="main">
	<div class="content content_border">
		<div class="content_top">
			<div class="heading">
			<a href="productbycat.php?catId=20"><h3>Laptop nổi bật</h3></a>
				<a class = "rtpLnkk" href="productbycat.php?catId=20">Xem thêm <span>></span></a>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="row row_css">
			<?php
			$getproductnew = $product->show_laptop();
			if ($getproductnew) {
				while ($result = $getproductnew->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
							<h2><?php echo $result['productName']	?></h2>
							<div class="group-price">
								<span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 500000) ?><span class="dong-low">đ</span></span>
							</div>
							<p><?php echo $result['moTa'] ?></p>
						</a>
					</div>
			<?php
				}
			}else{
				echo "<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Hiện tại chưa có sản phẩm!<span>";
			}
			?>
		</div>
	</div>
</div>
<div class="main">
	<div class="content content_border">
		<div class="content_top">
			<div class="heading">
			<a href="productbycat.php?catId=26"><h3>iPad nổi bật</h3></a>
				<a class = "rtpLnkk" href="productbycat.php?catId=26">Xem thêm <span>></span></a>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="row row_css">
			<?php
			$getproductnew = $product->show_apple();
			if ($getproductnew) {
				while ($result = $getproductnew->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
							<h2><?php echo $result['productName']	?></h2>
							<div class="group-price">
								<span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 500000) ?><span class="dong-low">đ</span></span>
							</div>
							<p><?php echo $result['moTa'] ?></p>
						</a>
					</div>
			<?php
				}
			}else{
				echo "<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Hiện tại chưa có sản phẩm!<span>";
			}
			?>
		</div>
	</div>
</div>
<div class="main">
	<div class="content content_border">
		<div class="content_top">
			<div class="heading">
			<a href="productbycat.php?catId=27"><h3>Máy ảnh nổi bật</h3></a>
				<a class = "rtpLnkk" href="productbycat.php?catId=27">Xem thêm <span>></span></a>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="row row_css">
			<?php
			$getproductnew = $product->show_mayanh();
			if ($getproductnew) {
				while ($result = $getproductnew->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
							<h2><?php echo $result['productName']	?></h2>
							<div class="group-price">
								<span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 500000) ?><span class="dong-low">đ</span></span>
							</div>
							<p><?php echo $result['moTa'] ?></p>
						</a>
					</div>
			<?php
				}
			}else{
				echo "<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Hiện tại chưa có sản phẩm!<span>";
			}
			?>
		</div>
	</div>
</div>
<div class="main">
	<div class="content content_border">
		<div class="content_top">
			<div class="heading">
			<a href="productbycat.php?catId=28"><h3>Phụ kiện giá rẻ</h3></a>
				<a class = "rtpLnkk" href="productbycat.php?catId=28">Xem thêm <span>></span></a>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="row row_css">
			<?php
			$getproductnew = $product->show_phukien();
			if ($getproductnew) {
				while ($result = $getproductnew->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
							<h2><?php echo $result['productName']	?></h2>
							<div class="group-price">
								<span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 50000) ?><span class="dong-low">đ</span></span>
							</div>
							<p><?php echo $result['moTa'] ?></p>
						</a>
					</div>
			<?php
				}
			}else{
				echo "<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Hiện tại chưa có sản phẩm!<span>";
			}
			?>
		</div>
	</div>
</div>
</div>
</div>
<?php
include 'inc/footer.php';
?>