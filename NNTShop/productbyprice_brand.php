<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
if (isset($_GET['catId']) && $_GET['catId'] != NULL && isset($_GET['brandId']) && $_GET['brandId'] != NULL && isset($_GET['price']) && $_GET['price'] != NULL) {
    $catId = $_GET['catId'];
    $brandId = $_GET['brandId'];
    $price = $_GET['price'];   
    $tu = 0;
    $den = 0;
    if($price == "duoi3"){
        $priceName = "<3 triệu";
    }else if($price == "3den10"){
        $priceName = "3 triệu đến 10 triệu";
    }else if($price == "tren10"){
        $priceName = ">10 triệu";
    }else{
        $priceName = "";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_price'])){
    $catId = $_GET['catId'];
    $brandId = $_GET['brandId'];
    $tu = (int)$_POST['tu'];
    $den = (int)$_POST['den'];
    $priceName = "$tu -> $den";
    $price = "between";
}
else {
    echo "<script>window.location = '404.php'</script>";
}

?>
<div class="main">
    <div class="content">
        <div class="row cat_main">
            <?php
            $getCategory = $product->show_brand_by_cat();
            if ($getCategory) {
                while ($result = $getCategory->fetch_assoc()) {
            ?>
                <?php 
                    if($brandId == $result['brandId']){ $brandName = $result['brandName'] ?>
                        <a style="color: red; font-weight: bold; font-size: 20px;" href="productbyBrand.php?catId=<?php echo $catId ?>&brandId=<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></a>        
                    <?php }else { ?>
                <a href="productbyBrand.php?catId=<?php echo $catId ?>&brandId=<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></a>
                    <?php  } ?>
            <?php
                }
            } ?>
        </div>
        <div class="filter_price">
            <label>Chọn mức giá: </label>
            <a href="productbyprice_brand.php?brandId=<?php echo $brandId ?>&catId=<?php echo $catId ?>&price=duoi3">Dưới 3 triệu</a>
            <a href="productbyprice_brand.php?brandId=<?php echo $brandId ?>&catId=<?php echo $catId ?>&price=3den10">Từ 3 - 10 triệu</a>
            <a href="productbyprice_brand.php?brandId=<?php echo $brandId ?>&catId=<?php echo $catId ?>&price=tren10">Trên 10 triệu</a>
            <form class="form_price" action="productbyprice_brand.php?brandId=<?php echo $brandId ?>&catId=<?php echo $catId ?>" method="post">
				Từ <input type="number" name="tu" min="0">
				Đến <input type="number" name="den" min="0">
				<input type="submit" name="submit_price" value="Tìm kiếm"/>
			</form>
        </div>
        <div class="content_top">
            <div class="heading">
                <?php
                        $show_name_by_id = $cat->show_name_by_id($catId);
                        if ($show_name_by_id) {
                            while ($result_name = $show_name_by_id->fetch_assoc()) {
                        ?>
						<h5>
                            <a href="index.php">Trang chủ</a>
                            <i style='color: black; font-size: 16px; padding: 0 10px;' class='fa fa-arrow-right'></i>
                            <a href="productbycat.php?catId=<?php echo $catId ?>"> <?php echo $result_name['catName'] ?></a>
                            <i style='color: black; font-size: 16px; padding: 0 10px;' class='fa fa-arrow-right'></i>
                            <a href="productbyBrand.php?catId=<?php echo $catId ?>&brandId=<?php echo $brandId ?>"><?php echo $brandName ?></a>
                            <i style='color: black; font-size: 16px; padding: 0 10px;' class='fa fa-arrow-right'></i>
                            <a href="productbyprice_brand.php?catId=<?php echo $catId ?>&brandId=<?php echo $brandId ?>&price=<?php echo $price ?>"><?php echo $priceName ?></a>
                        </h5>
				<?php }
                        } ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="row">
            <?php
            $getproduct = $product->show_cate_by_price_brand($catId, $price, $brandId, $tu, $den);
            if ($getproduct) {
                while ($result = $getproduct->fetch_assoc()) {
            ?>
                    <div class="product col-12 col-lg-3">
                        <a href="details.php?id=<?php echo $result['productId'] ?>">
                            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="80%" height="200px" />
                            <h2><?php echo $result['productName']    ?></h2>
                            <div class="group-price">
                                <span class="price"><?php echo  $fm->format_price($result['price']) ?><span class="dong">đ</span></span>
								<span class="low-price"><?php echo  $fm->format_price($result['price'] + 500000) ?><span class="dong-low">đ</span></span>
							</div>
                            <p><?php echo $result['moTa'] ?></p>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<span style='color: red; font-size: 22px; font-weight: bold; display: inline-block;margin: 10px'>Hiện tại chưa có sản phẩm!<span>";
            }
            ?>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>