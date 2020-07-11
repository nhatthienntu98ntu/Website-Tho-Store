<?php
if (Session::get("level") == 0) {
?>
    <?php ob_start(); ?>
    <div class="grid_2">
        <div class="box sidemenu">
            <div class="block" id="section-menu">
                <ul class="section menu">
                    <li><a class="menuitem">Danh mục sản phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="catadd.php">Thêm danh mục</a> </li>
                            <li><a style="font-size: 13px;" href="catlist.php">Danh mục sản phẩm</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Thương hiệu sản phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="brandadd.php">Thêm thương hiệu</a> </li>
                            <li><a style="font-size: 13px;" href="brandlist.php">Danh mục thương hiệu</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Màu</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="coloradd.php">Thêm Màu</a> </li>
                            <li><a style="font-size: 13px;" href="colorlist.php">Danh mục màu</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Sản Phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="productadd.php">Thêm sản phẩm</a> </li>
                            <li><a style="font-size: 13px;" href="productlist.php">Liệt kê sản phẩm</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Slider</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="slideradd.php">Thêm Slider</a></li>
                            <li><a style="font-size: 13px;" href="sliderlist.php">Tất cả Slider</a></li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Tài khoản</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="admin_.php">Tài khoản quản trị</a></li>
                            <li><a style="font-size: 13px;" href="customer_.php">Tài khoản khách hàng</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php ob_end_flush(); ?>
<?php
} else {
?>
    <?php ob_start(); ?>
    <div class="grid_2">
        <div class="box sidemenu">
            <div class="block" id="section-menu">
                <ul class="section menu">
                    <li><a class="menuitem">Danh mục sản phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="erroradmin.php">Thêm danh mục</a> </li>
                            <li><a style="font-size: 13px;" href="erroradmin.php">Danh mục sản phẩm</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Thương hiệu sản phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="erroradmin.php">Thêm thương hiệu</a> </li>
                            <li><a style="font-size: 13px;" href="erroradmin.php">Danh mục thương hiệu</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Màu</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="erroradmin.php">Thêm Màu</a> </li>
                            <li><a style="font-size: 13px;" href="erroradmin.php">Danh mục màu</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Sản Phẩm</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="erroradmin.php">Thêm sản phẩm</a> </li>
                            <li><a style="font-size: 13px;" href="erroradmin.php">Liệt kê sản phẩm</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Slider</a>
                        <ul class="submenu">
                            <li><a style="font-size: 13px;" href="erroradmin.php">Thêm Slider</a></li>
                            <li><a style="font-size: 13px;" href="erroradmin.php">Tất cả Slider</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php ob_end_flush(); ?>
<?php
}
?>