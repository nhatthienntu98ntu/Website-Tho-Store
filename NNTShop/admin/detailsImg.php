<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php' ?>

<?php
$product = new product();
?>
<?php
if (isset($_GET['productId']) && $_GET['productId'] != null) {
    $productId = $_GET['productId'];
}else{
    echo "<script>window.location='productlist.php'</script>";
}


if(isset($_POST['submit'])){
    $addImgDetails = $product->addImgDetails($productId, $_FILES);
}

if (isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $delete_slider = $product->delete_img_details($deleteId);
}
?>


<div class="grid_10">
    <div class="box round grid">
        <h2>Thêm ảnh mô tả</h2>
        <div class="block copyblock">
            <?php
                if(isset($addImgDetails)){
                    echo $addImgDetails;
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Ảnh</label>
                        </td>
                        <td>
                            <input name="image" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách ảnh mô tả</h2>
        <div class="block">
            <?php
            if (isset($delete_slider)) {
                echo $delete_slider;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Ảnh mô tả</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getImgDetails = $product->show_details_img($productId);
                    if ($getImgDetails) {
                        $i = 0;
                        while ($result = $getImgDetails->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><img src="uploads/<?php echo $result['img'] ?>" height="auto" width="120px" /></td>
                                <td>
                                    <a onclick="return confirm('Bạn muốn xóa?')" href="?deleteId=<?php echo $result['id'] ?>"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
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