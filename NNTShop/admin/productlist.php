<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/fomat.php'; ?>
<?php
	$product = new product();
	$fm = new Format();
	if(isset($_GET['delid'])){
		$delete_product = $product->del_product($_GET['delid']);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh Sách Sản Phẩm</h2>
        <div class="block">
			<?php
				if(isset($delete_product)){
					echo $delete_product;
				}
			?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="4%">STT</th>
					<th width="21%">Tên sản phẩm</th>
					<th width="10%">Giá</th>
					<th width="10%">Số lượng</th>
					<th width="5%">Màu</th>
					<th width="10%">Danh mục</th>
					<th width="10%">Thương hiệu</th>
					<th width="10%">Hình ảnh</th>
					<th width="10%">Type</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$productlist = $product->show_product();
				if($productlist){
					$i = 0;
					while ($result = $productlist->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $fm->format_price($result['price'])."đ" ?></td>
					<td><?php echo $result['soLuong'] ?></td>
					<td><?php echo $result['name'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><a href="detailsImg.php?productId=<?php echo $result['productId'] ?>"><img src="uploads/<?php echo $result['image'] ?>" width="80" height="90" ></a></td>
					<td> <?php 
							if($result['type'] == 0){
								echo "không nổi bật";
							}else echo "Nổi bật";
					 ?></td>
					<td><a href="productEdit.php?productid=<?php echo $result['productId'] ?>"><i class="fa fa-edit"></i></a> || <a onclick="return confirm('Bạn muốn xóa?')" href="?delid=<?php echo $result['productId'] ?>"><i class="fa fa-trash-alt"></i></a></td>
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
