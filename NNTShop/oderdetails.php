<?php
ob_start();
include_once 'inc/header.php';
// include_once 'inc/slider.php';
?>
<?php
$customer_login = Session::get("customer_login");

if ($customer_login == false) {
	header('Location:sign_in.php');
}
?>

<?php
if (isset($_GET['deleteOrder'])) {
	$orderId = $_GET['deleteOrder'];
	$delete_product_oder = $ct->cancel_product_order($orderId);
}


if (isset($_GET['shipted'])) {
	$id = $_GET['shipted'];
	$update_product_oder = $ct->update_product_oder($id);
}
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>SẢN PHẨM ĐÃ ĐẶT</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="cartoption">
			<div class="cartpage">
				<?php
				$customer_id = Session::get("customer_id");
				$get_odered = $ct->get_odered($customer_id);
				if ($get_odered) {
					$i = 0;
					$sub_total = 0;
				?>
					<?php
					if (isset($delete_product_oder)) {
						echo $delete_product_oder;
					}
					?>
					<table class="tblone">
						<tr>
							<th width="5%">STT</th>
							<th width="20%">Tên sản phẩm</th>
							<th width="10%">Ảnh</th>
							<th width="10%">Số lượng</th>
							<th width="15%">Giá</th>
							<th width="20%">Ngày đặt</th>
							<th width="10%">Tình trạng</th>
							<th width="10%">Tác vụ</th>
						</tr>
						<?php
						while ($result = $get_odered->fetch_assoc()) {
							$i++;
							if ($result['status'] != 2) {
								$sub_total += $result['price'] * $result['quantity'];
							}
						?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" width="100" height="100"></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_price($result['price']) ?>đ</td>
								<td><?php echo $result['date_oder'] ?></td>
								<td><?php
									if ($result['status'] == 0) {
										echo "<span style='color: red; font-weight: bold'>Đang xử lý</span>";
									} elseif ($result['status'] == 1) {
										echo "<span style='color: green; font-weight: bold'>Đang giao...</span>";
									} else {
										echo "<span style='color: green; font-weight: bold'>Đã nhận hàng</span>";
									}
									?></td>
								<?php
								if ($result['status'] == 0 && $result['cancelOrder'] == 0) { ?>
									<td><a onclick="return confirm('Bạn muốn xóa!')" href="?deleteOrder=<?php echo $result['id'] ?>">Xóa</a></td>
								<?php
								} else if ($result['status'] == 1 && $result['cancelOrder'] == 0) { ?>
									<td><a onclick="return confirm('Xác nhận đã nhận được hàng!')" href='?shipted=<?php echo $result['id'] ?>'>Đã nhận</a></td>
								<?php
								} else {
								?>
									<td><a style="cursor: no-drop;">Empty</a></td>
								<?php } ?>
							</tr>
						<?php
						}
					}
					if ($get_odered) {
						?>
					</table>
				<?php } else {
						echo "<span class='error'>Bạn chưa đặt mua sản phẩm nào!</span>";
					} ?>
			</div>
			<?php
			if ($get_odered) {
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
						<th>Thuế VAT : </th>
						<td class="sub_total_right" style="padding-left: 30px"><?php $vat = $sub_total * 0.1;
																				echo "<span>+{$fm->format_price($vat)}đ</span>" ?></td>
					</tr>
					<tr>
						<th class="can_phai_tra">Cần thanh toán :</th>
						<td class="sub_total_right"><?php
													$sum = ($sub_total + $vat);
													echo "<span class='error'>{$fm->format_price($sum)}đ</span>";
													?></td>
					</tr>
				</table>
			<?php } ?>
		</div>
		<div class="shopping">
			<div class="shopleft">
				<a href="index.php"> <img src="images/shop.png" alt="" /></a>
			</div>
		</div>
		<div class="clear"></div>
		</>
	</div>
</div>
<?php
include 'inc/footer.php';
ob_end_flush();
?>