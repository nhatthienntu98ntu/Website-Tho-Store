<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/admin.php'; ?>
<?php
$admin = new admin();

if (!isset($_GET['adminId']) || $_GET['adminId'] == NULL) {
    echo "<script>window.location='historyOrder.php'</script>";
} else {
    $adminId = $_GET['adminId'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>THÔNG TIN NHÂN VIÊN XÁC NHẬN ĐƠN HÀNG</h2>
        <div class="hrf-card">
            <?php
            $getAdmin = $admin->getadminbyId($adminId);
            if ($getAdmin) {
                while ($result = $getAdmin->fetch_assoc()) {
            ?>
                    <div class="card">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <img class="card-img" src="uploads/avartar.jpg" alt="">
                        <div class="card-body">
                            <h3><?php echo $result['adminName'] ?></h3>
                            <?php
                            if ($result['level'] == 0) {
                            ?>
                                <h4> Quản trị viên</h4>
                            <?php
                            } else {

                            ?>
                                <h4>Nhân viên</h4>
                            <?php
                            }

                            ?>
                        </div>
                        <div class="card-icon">
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>