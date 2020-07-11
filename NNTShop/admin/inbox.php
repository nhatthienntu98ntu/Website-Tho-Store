<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/fomat.php');
$ct = new cart();
$fm = new Format();
?>
<?php
	if(isset($_GET['orderid'])){
		$adminId = Session::get("adminId"); 
		$customer_id = $_GET['customer_id'];
		$productId = $_GET['productId'];
		$quantity = $_GET['quantity'];
		$id = $_GET['orderid'];
		$actionProductOder = $ct->actionProductOder($id);
		$history = $ct->addHistory($customer_id, $adminId, $productId, $quantity);
	}

	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$deleteProductOrder = $ct->deleteProductOrder($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>ĐƠN HÀNG</h2>
		<div class="block">
			<?php
				if(isset($actionProductOder)){
					echo $actionProductOder;
				}
				if(isset($deleteProductOrder)){
					echo $deleteProductOrder;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">STT</th>
						<th width="15%">Ngày đặt hàng</th>
						<th width="20%">Tên sản phẩm</th>
						<th width="8%">Màu</th>
						<th width="7%">Số lượng</th>
						<th width="10%">Giá</th>
						<th width="15%">Khách hàng</th>
						<th width="10%">Tình trạng</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$get_inbox_cart = $ct->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->formatDate($result['date_oder']) ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_price($result['price'])  . ".đ" ?></td>
								<td><a href="customer.php?customerId=<?php echo $result['customer_id']; ?>">Xem khách hàng</a></td>
								<?php 
									if($result['cancelOrder'] == 0){
										echo "<td style='color: #12be4fc4; font-weight: bold' >Tốt</td>";
									}else{
										echo "<td style='color: red; font-weight: bold' >Đã hủy</td>";
									}
								?>
								<td>
									<?php
									
									if ($result['status'] == 0 && $result['cancelOrder'] == 0) { ?>
										<a href="?orderid=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>&customer_id=<?php echo $result['customer_id'] ?>&quantity=<?php echo $result['quantity'] ?>" style='color: red; font-weight: bold'>Chờ xử lý</a>
									
									<?php } else if($result['status'] == 1){ ?>
										<a onclick="return confirm('Bạn muốn xóa đơn hàng!')" href="?delid=<?php echo $result['id'] ?>" style='color: #12be4fc4; font-weight: bold'>Đang giao...</a>
									<?php } else { ?>
										<a href="?delid=<?php echo $result['id'] ?>" style='color: red; font-weight: bold'>Remove</a>
									
									<?php } ?>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>