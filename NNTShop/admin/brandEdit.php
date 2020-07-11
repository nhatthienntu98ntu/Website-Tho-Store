<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    $brand = new brand();
    
    if (!isset($_GET['brandid']) || $_GET['brandid']==NULL) {
        echo "<script>window.lobrandion='brandlist.php'</script>";
    }else{
        $brandId = $_GET['brandid'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$brandName = $_POST['brandName'];
		$update = $brand->update_brand($brandId, $brandName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Thương Hiệu</h2>
               <div class="block copyblock"> 
               
               <?php
                    if (isset($update)) {
                        echo $update;
                    }
                ?>
                <?php
                    $get_brand_name = $brand->getbrandbyId($brandId);
                    if($get_brand_name){
                        while ($result = $get_brand_name->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form" >					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']?>" placeholder="Sửa thương hiệu sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }}
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>