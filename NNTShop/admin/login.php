<?php
	include '../classes/adminlogin.php'
?>
<?php
	$class = new adminlogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminUser = $_POST['adminUser'];
		$adminPass = md5($_POST['adminPass']);
		
		$login_check = $class->login_admin($adminUser, $adminPass);
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
            <span class="form-heading">Đăng nhập</span>
            <form action="" method="post">
                <span id="error-username">
                    <?php if (isset($login_check)) {
                        echo $login_check;
                    } ?>
                </span>
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Tài khoản" required id="taiKhoan" name="adminUser">
                    <span class="bar"></span>
                </div>
                <span id="error-password"></span>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Mật khẩu" required id="matKhau" name="adminPass">
                    <span class="bar"></span>
                </div>
                <div class="login" id="logIn">
                    <button type="submit" name="submitLogin">
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