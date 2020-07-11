<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php' ?>
<?php
	$customer = new customer();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$deleteCustomer = $customer->delete_customer($customer_id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Sách Tài Khoản Khách Hàng</h2>
                <div class="addAdmin">
                    <a href="#">Thêm tài khoản</a>
                </div>
                <div class="block">
					<!-- <?php
						if(isset($deleteCustomer)){
							echo $deleteCustomer;
						}
					?> -->
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Thành phố</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Tác vụ</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getAllCustomer = $customer->getAllCustomer();
							if($getAllCustomer){
								$i = 0;
								while ($result = $getAllCustomer->fetch_assoc()) {
									$i++;	
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
                            <td><?php echo $result['name'] ?></td>
                            <td><?php echo $result['phone'] ?></td>
                            <td><?php echo $result['city'] ?></td>
                            <td><?php echo $result['addRess'] ?></td>
                            <td><?php echo $result['email'] ?></td>
                            <td><?php echo $result['passWord'] ?></td>
							<td><a href="customer_edit.php?customer_id=<?php echo $result['customer_id'] ?>"><i class="fa fa-edit"></i></a> || <a onclick="return confirm('Bạn muốn xóa?')" href="?delid=<?php echo $result['customer_id']?>"><i class="fa fa-trash-alt"></i></a></td>
						</tr>
						<?php
								}}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();
	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

