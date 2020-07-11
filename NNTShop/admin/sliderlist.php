<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php' ?>

<?php
	$product = new product();
?>
<?php
	if(isset($_GET['sliderId']) && isset($_GET['type'])){
		$sliderId = $_GET['sliderId'];
		$type = $_GET['type'];
		$update_Action_Slider = $product->update_Action_Slider($sliderId, $type);
	}

	if(isset($_GET['deleteId'])){
		$deleteId = $_GET['deleteId'];
		$delete_slider = $product->delete_Slider($deleteId);
	}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<?php
				if(isset($update_Action_Slider)){
					echo $update_Action_Slider;
				}
			?>
			<?php
				if(isset($delete_slider)){
					echo $delete_slider;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tên Slider</th>
						<th>Ảnh</th>
						<th>Trạng thái</th>
						<th>Tác vụ</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$getAllSlider = $product->getAlllSlider();
				if($getAllSlider){
					$i = 0;
					while($result = $getAllSlider->fetch_assoc()){
						$i++;
						
			?>
					<tr class="odd gradeX">
						<td><?php echo $i ?></td>
						<td><?php echo $result['sliderName'] ?></td>
						<td><img src="uploads/<?php echo $result['sliderImage'] ?>" height="120px" width="200px" /></td>
						<td>
							<?php
						if($result['type'] == 1){
					?>
							<a href='?sliderId=<?php echo $result['sliderId'] ?>&type=<?php echo $result['type'] ?>' style="color: green">Đang mở </a>
							<?php
						}else{
					?>
							<a href='?sliderId=<?php echo $result['sliderId'] ?>&type=<?php echo $result['type'] ?>' style="color: red">Đang đóng </a>
							<?php }?>
						</td>
						<td>
						<a onclick="return confirm('Bạn muốn xóa?')" href="?deleteId=<?php echo $result['sliderId'] ?>"><i class="fa fa-trash-alt"></i></a>
						</td>
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