<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	if($check_login){
		$customer_id = Session::get("customer_id");
	}else{
		echo "<script>window.location='index.php'</script>";
	}
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Sản phẩm ưa thích</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="row">
			<?php
			$getproduct_like = $product->get_product_like($customer_id);
			if ($getproduct_like) {
				while ($result = $getproduct_like->fetch_assoc()) {

			?>
					<div class="product col-12 col-lg-3">
						<a href="details.php?id=<?php echo $result['productId'] ?>">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="220px" />
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
				echo "<div class='error'>Chưa có sản phẩm ưa thích!</div>";
			}
			?>
		</div>
    </div>
</div>


<?php
include 'inc/footer.php';
?>