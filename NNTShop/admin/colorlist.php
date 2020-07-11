<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/mau.php' ?>
<?php
	$mau = new mau();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delmau = $mau->del_mau($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Mục Màu</h2>
                <div class="block">
					<?php
						if(isset($delmau)){
							echo $delmau;
						}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Màu</th>
							<th>Tác vụ</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show_mau = $mau->show_mau();
							if($show_mau){
								$i = 0;
								while ($result = $show_mau->fetch_assoc()) {
									$i++;	
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['name'] ?></td>
							<td><a href="mauEdit.php?mauid=<?php echo $result['mauId'] ?>"><i class="fa fa-edit"></i></a> || <a onclick="return confirm('Bạn muốn xóa?')" href="?delid=<?php echo $result['mauId']?>"><i class="fa fa-trash-alt"></i></a></td>
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

