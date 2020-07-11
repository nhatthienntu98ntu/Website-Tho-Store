<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/mau.php';?>
<?php
	$product = new product();
	if(!isset($_GET['productid']) && $_GET['productid'] == NULL){
        echo "<script>window.location = 'productlist.php'</script>";
    }else{
        $product_id = $_GET['productid'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $update_product = $product->update_product($product_id, $_POST, $_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa Sản Phẩm</h2>
        <div class="block">
        <?php
            if(isset($update_product)){
                echo $update_product;
            }
        ?>
        <?php
            $get_product_bt_id = $product->getproductbyId($product_id);
            if($get_product_bt_id){
                while($result_product = $get_product_bt_id->fetch_assoc()){
        ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName"  class="medium" value = "<?php echo $result_product['productName'] ?>" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>----Chọn danh mục----</option>
                            <?php
                                $cat = new category();
                                $catList = $cat->show_category();
                                if($catList){
                                    while ($result = $catList->fetch_assoc()) {
                            ?>
                            <option
                                    <?php if($result['catId'] == $result_product['catId']) echo "selected"  ?>    
                             value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                            <?php
                                    }}
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>---Chọn thương hiệu---</option>
                            <?php
                                $brand = new brand();
                                $brandList = $brand->show_brand();
                                if($brandList){
                                    while($result = $brandList->fetch_assoc()){
                            ?>
                            <option
                                <?php if($result['brandId'] == $result_product['brandId']) echo "selected"  ?>
                             value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
                            <?php }}?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Màu sắc</label>
                    </td>
                    <td>
                        <select id="select" name="mau">
                            <option>---Chọn màu sắc---</option>
                            <?php
                                $mau = new mau();
                                $maulist = $mau->show_mau();
                                if($maulist){
                                    while($result = $maulist->fetch_assoc()){
                            ?>
                            <option
                                <?php if($result['mauId'] == $result_product['mauId']) echo "selected"  ?>
                             value="<?php echo $result['mauId']?>"><?php echo $result['name']?></option>
                            <?php }}?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input name = "soLuong" type="text" value = "<?php echo $result_product['soLuong'] ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <input name = "moTa" type="text" placeholder="Mô tả..." class="medium"  value="<?php echo $result_product['moTa'] ?>"/>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Chi tiết sản phẩm</label>
                    </td>
                    <td>
                        <textarea name = "product_desc"  class="tinymce" ><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input name = "price" type="text" value = "<?php echo $result_product['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                    <img src="uploads/<?php echo $result_product['image'] ?>" width="90" alt=""></br>
                        <input name="image" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Kiểu sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Chọn kiểu</option>
                            <?php
                                if($result_product['type'] == 0){
                            ?>
                            <option value="1">Nổi bật</option>
                            <option selected value="0">Không nổi bật</option>
                            <?php
                                }else{
                            ?>
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


