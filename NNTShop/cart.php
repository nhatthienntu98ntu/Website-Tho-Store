<?php
include_once 'inc/header.php';
include_once 'inc/slider.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$cartId = $_POST['cartId'];
	$update_quantity_cart = $ct->update_quantity_cart($cartId, $quantity);
}
if (isset($_GET['deleteCart']) && $_GET['deleteCart'] != null) {
	$deleteId = $_GET['deleteCart'];
	$delete_cart = $ct->delete_cart($deleteId);
}
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Giỏ hàng</h2>
				<?php
				$get_product_cart = $ct->get_product_cart();
				if ($get_product_cart) {
					$sub_total = 0;
					$qty = 0;
					$sum = 0;
				?>
					<table class="tblone">
						<tr>
							<th width="20%">Tên sản phẩm</th>
							<th width="10%">Ảnh</th>
							<th width="10%">Màu</th>
							<th width="10%">Giá</th>
							<th width="20%">Số lượng</th>
							<th width="20%">Tổng tiền</th>
							<th width="10%">Xóa</th>
						</tr>
						<?php
						while ($result = $get_product_cart->fetch_assoc()) {
							$qty += $result['quantity'];
						?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" width="100" height="100"></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $fm->format_price($result['price']) ?>đ</td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Cập nhật" />
									</form>
								</td>
								<td><?php
									$total = $result['quantity'] * $result['price'];
									echo "{$fm->format_price($total)}đ";
									?></td>
								<td><a onclick="return confirm('Bạn muốn xóa!')" href="?deleteCart=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
						<?php
							$sub_total += $total;
						}
					}
					if ($get_product_cart) {
						?>
					</table>
					<table class="tbl_subtotal">
						<tr>
							<th>Tổng giá : </th>
							<td class="sub_total_right"><?php
								echo "{$fm->format_price($sub_total)}đ";
								?></td>
						</tr>
						<tr>
							<th>VAT(10%) : </th>
							<td class="sub_total_right"><?php $vat = $sub_total * 0.1; echo "+{$fm->format_price($vat)}đ" ?></td>
						</tr>
						<tr>
							<th class="can_phai_tra">Cần phải trả :</th>
							<td class="sub_total_right"><?php
								$sum = ($sub_total + $sub_total * 0.1);
								echo "<span style='color: red; font-weight: bold'>{$fm->format_price($sum)}đ</span>";
								Session::set("sum", $sum);
								Session::set("qty", $qty);
								?></td>
						</tr>
					</table>
				<?php } else {
						echo "<span style='color: red; font-size: 18px'>Giỏ hàng trống!! Vui lòng mua thêm sản phẩm</span>";
					} ?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<?php if($ct->check_cart()){ ?>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>