<?php
include_once 'lib/session.php';
Session::init();

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});
$cs = new customer();
?>
<?php
$check_login = Session::get('customer_login');
if ($check_login) {
    header('Location:cart.php');
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insert_customer = $cs->insert_customer($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper">
        <div class="form-container">
            <span class="form-heading">Đăng ký</span>
            <form action="" method="post">
                <span id="error-username">
                    <?php if (isset($insert_customer)) {
                        echo $insert_customer;
                    } ?>
                </span>
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Tên" required id="taiKhoan" name="name">
                    <span class="bar"></span>
                </div>
                <span id="error-password"></span>
                <div class="input-group">
                    <i class="fa fa-city"></i>
                    <input type="text" placeholder="Thành phố" required name="city">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" placeholder="abc@gmail.com" required name="email">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fa fa-address-card"></i>
                    <input type="text" placeholder="Địa chỉ" required name="address">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fa fa-phone"></i>
                    <input type="tel" placeholder="0123456789" pattern="[0-9]{10}" required name="phone">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Mật khẩu" required id="matKhau" name="password">
                    <span class="bar"></span>
                </div>
                <div class="login" id="logIn">
                    <button type="submit" name="submit">
                        <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>
    <!-- <script src="js/Login.js"></script>   -->
</body>

</html>