<?php
include 'inc/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$search = $_POST['search'];
	$search_product = $product->search_product($search);
} else {
	echo "<script>window.location = 'index.php'</script>";
}
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h5>
					<a href="index.php">Trang chủ</a>
					<i style='color: black; font-size: 16px; padding: 0 10px;' class='fa fa-arrow-right'></i>
					<a href="search.php?search=<?php echo $search ?>"><?php echo $search ?></a>
				</h5>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="row row_css">
				<?php
				if ($search_product) {
					while ($result = $search_product->fetch_assoc()) {
				?>
						<div class="product col-12 col-lg-3">
							<a href="details.php?id=<?php echo $result['productId'] ?>">
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
								<h2><?php echo $result['productName']	?></h2>
								<span class="price"><?php echo  $fm->format_price($result['price']) ?>đ</span>
								<p><?php echo $result['moTa'] ?></p>
							</a>
						</div>
					<?php }
				} else {
					?>
					<div>
						<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Không tìm thấy sản phẩm phù hợp!<span>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>