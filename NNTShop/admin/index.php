<?php
include 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/user.php' ?>
<?php
$adminId = Session::get('adminId');
$user = new user();
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>THÔNG TIN ADMIN</h2>
    <div class="hrf-card">
      <?php
      $getAdmin = $user->getAdmin($adminId);
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
                <h4> Nhân viên</h4>
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
      <?php }} ?>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';
?>