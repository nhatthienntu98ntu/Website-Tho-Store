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
		$delete_product_history_order = $ct->delete_product_history_order($id);
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
				if(isset($delete_product_history_order)){
					echo $delete_product_history_order;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">STT</th>
						<th width="18%">Ngày đặt hàng</th>
						<th width="20%">Tên sản phẩm</th>
						<th width="8%">Màu</th>
						<th width="7%">Số lượng</th>
						<th width="10%">Tổng tiền</th>
						<th width="13%">Khách hàng</th>
						<th width="13%">Nhân viên</th>
						<th width="56%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$get_inbox_cart = $ct->get_history_order();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_price($result['price'] * $result['quantity'])  . ".đ" ?></td>
                                <td><a href="customer.php?customerId=<?php echo $result['customer_id']; ?>"><?php echo $result['customer_name'] ?></a></td>
                                <td><a href="nhanvien.php?adminId=<?php echo $result['adminId']; ?>"><?php echo $result['adminName'] ?></a></td>
								<td><a onclick="return confirm('Bạn muốn xóa?')" href="?delid=<?php echo $result['id']?>"><i class="fa fa-trash-alt"></i></a></td>
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
