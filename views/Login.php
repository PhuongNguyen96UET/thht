<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Đăng nhập </title>

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>
<form method="POST" class="form-control">
    <div class="wrap col-md-6">

        <div class="">
            <img src="images/logo2.png">
        </div>
        
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <div class="bar">
            <i></i>
        </div>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <input type="hidden" name="request_name" value="login"/>
        <input type="submit" name="login" value="Đăng nhập">
        <div class="register">
            <a href="#">Đăng ký tài khoản</a>
        </div>
        <?php show_error($error, 'username'); ?>
        <?php show_error($error, 'password'); ?>
        
    </div>
</form>


</body>

</html>