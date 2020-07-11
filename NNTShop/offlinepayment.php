<?php
ob_start();
include_once 'inc/header.php';
// include_once 'inc/slider.php';
?>
<?php
if (!$check_login) {
    header('Location:sign_in.php');
}

if (isset($_GET['oderid']) && $_GET['oderid'] == "oder") {
    $customer_id = Session::get("customer_id");
    $insert_oder = $ct->insert_oder($customer_id);
    echo $insert_oder;
}
?>
<div class="main">
    <div class="content">
        <form action="" method="post">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h3>THANH TOÁN OFFLINE</h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box_left">
                    <h3 style="text-align: center; padding-bottom: 5px; font-size: 16px; font-weight: bold">Thông tin giỏ hàng</h3>
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="35%">Tên sản phẩm</th>
                                <th width="10%">Màu</th>
                                <th width="20%">Giá</th>
                                <th width="10%">Số lượng</th>
                                <th width="20%">Tổng giá</th>
                            </tr>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                                $sub_total = 0;
                                $qty = 0;
                                $sum = 0;
                                $i = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                                    $i++;
                                    $qty += $result['quantity'];
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $result['productName'] ?></td>
                                        <td><?php echo $result['name'] ?></td>
                                        <td><?php echo $fm->format_price($result['price']) . '.đ' ?></td>
                                        <td><?php echo $result['quantity'] ?></td>
                                        <td><?php
                                            $total = $result['quantity'] * $result['price'];
                                            echo $fm->format_price($total) . '.đ';
                                            ?></td>
                                    </tr>
                                <?php
                                    $sub_total += $total;
                                }
                            }
                            if ($get_product_cart) {
                                ?>
                        </table>
                        <table class="tbl_subtotal">
                            <tr>
                                <th>Tổng giá : </th>
                                <td class="sub_total_right"><?php
                                                            echo $fm->format_price($sub_total) . ".đ";
                                                            ?></td>
                            </tr>
                            <!-- <tr>
                                <th>VAT : </th>
                                <td class="sub_total_right"><?php $vat = $sub_total * 0.1;
                                                            echo "+" . $fm->format_price($vat) . ".đ" ?></td>
                            </tr> -->
                            <tr>
                                <th class="can_phai_tra">Cần phải trả :</th>
                                <td class="sub_total_right"><?php
                                                            $sum = ($sub_total + $sub_total * 0.1);
                                                            echo "<span style='color: red; font-weight: bold'>{$fm->format_price($sub_total)}.đ</span>";
                                                            ?></td>
                            </tr>
                        </table>
                    <?php } ?>
                    </div>
                </div>
                <div class="box_right">
                    <h3 style="text-align: center; font-size: 16px; font-weight: bold">Thông tin khách hàng</h3>
                    <table class="tblone">
                        <?php
                        $id = Session::get("customer_id");
                        $customer = $cs->select_customerId($id);
                        if ($customer) {
                            while ($result = $customer->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td>Tên</td>
                                    <td>:</td>
                                    <td><?php echo $result['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tỉnh</td>
                                    <td>:</td>
                                    <td><?php echo $result['city'] ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>:</td>
                                    <td><?php echo $result['addRess'] ?></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>:</td>
                                    <td><?php echo $result['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $result['email'] ?></td>
                                </tr>
                        <?php }
                        } ?>
                        <tr>
                            <td colspan="3"><a href="editprofile.php?customerId=<?php echo $id ?>">Chỉnh sửa thông tin</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="oder">
                <center><a href="?oderid=oder" class="oder_submit" name="oder">ĐẶT HÀNG</a></center>
                <center><span style="display: inline-block; margin-top: 20px; ">Bạn có thể thanh toán sau khi nhận hàng</span></center>
            </div>
        </form>
    </div>
</div>
</div>
<?php
include_once 'inc/footer.php';
ob_end_flush();
?>