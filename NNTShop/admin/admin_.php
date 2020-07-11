<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/admin.php' ?>
<?php
	$admin = new admin();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$deleteAdmin = $admin->delete_admmin($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Sách Tài Khoản Quản Trị</h2>
                <div class="addAdmin">
                    <a href="#">Thêm tài khoản</a>
                </div>
                <div class="block">
					<!-- <?php
						if(isset($deleteAdmin)){
							echo $deleteAdmin;
						}
					?> -->
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên người dùng</th>
                            <th>Mail</th>
                            <th>Tên tài khoản</th>
                            <th>Mật khẩu</th>
                            <th>Cấp bậc</th>
                            <th>Tác vụ</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getallladmin = $admin->getAllAdmin();
							if($getallladmin){
								$i = 0;
								while ($result = $getallladmin->fetch_assoc()) {
									$i++;	
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
                            <td><?php echo $result['adminName'] ?></td>
                            <td><?php echo $result['adminEmail'] ?></td>
                            <td><?php echo $result['adminUser'] ?></td>
                            <td><?php echo $result['adminPass'] ?></td>
                            <?php
                                if($result['level'] == 0){
                                   echo "<td>Admin</td>";
                                }else{
                                    echo "<td>Nhân viên</td>";
                                }
                            ?>
							<td><a href="admin_edit.php?adminId=<?php echo $result['adminId'] ?>"><i class="fa fa-edit"></i></a> || <a onclick="return confirm('Bạn muốn xóa?')" href="?delid=<?php echo $result['adminId']?>"><i class="fa fa-trash-alt"></i></a></td>
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

