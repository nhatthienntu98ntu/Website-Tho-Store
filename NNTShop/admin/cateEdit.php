<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $cat = new category();
    
    if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
        echo "<script>window.location='catlist.php'</script>";
    }else{
        $catId = $_GET['catid'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$catName = $_POST['catName'];
		$update = $cat->update_category($catId, $catName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Danh Mục Sản Phẩm</h2>
               <div class="block copyblock"> 
               
               <?php
                    if (isset($update)) {
                        echo $update;
                    }
                ?>
                <?php
                    $get_cat_name = $cat->getcatbyId($catId);
                    if($get_cat_name){
                        while ($result = $get_cat_name->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form" >					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']?>" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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