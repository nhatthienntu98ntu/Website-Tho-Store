<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/customer.php'; ?>
<?php
$cs = new customer();

if (!isset($_GET['customerId']) || $_GET['customerId'] == NULL) {
    echo "<script>window.location='inbox.php'</script>";
} else {
    $customer_id = $_GET['customerId'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>THÔNG TIN KHÁCH HÀNG</h2>
        <div class="boder_customer">
            <table class="tbl_customer">
                <?php
                $customer = $cs->select_customerId($customer_id);
                if ($customer) {
                    while ($result = $customer->fetch_assoc()) {
                ?>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Tên: </span></td>
                            <td style="text-align: left"><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Tỉnh: </span></td>
                            <td style="text-align: left"><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Địa chỉ: </span></td>
                            <td style="text-align: left"><?php echo $result['addRess'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Số điện thoại: </span></td>
                            <td style="text-align: left"><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: right"><span class="tbl_customer_content">Email: </span></td>
                            <td style="text-align: left"><?php echo $result['email'] ?></td>
                        </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>