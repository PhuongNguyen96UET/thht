<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập </title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <form id="login_form" method="POST" class="">
        <div class="login_control col-md-5" style="padding: 2%;border: 1px #ccc solid; background-color: #8fcbef;margin: 10% 30%">
            <div style="display: block; float: left">
                <img src="images/logo2.png">
            </div>
            <div style="display: inline-block; margin-top: 7%">
                <div>
                    <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập" required>  
                </div>
                <div>
                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                <input type="hidden" name="request_name" value="login"/>
                <div class="button-submit" style="margin-top: 5px; margin-bottom: 5px;">
                    <button class="btn btn-primary" type="submit" name="login" value="Đăng nhập">Đăng nhập</button>
                    <button form="login_form" type="reset" style="width: 100px;" class="btn btn-primary login">Thoát</button>
                </div>
                <?php show_error($error, 'username'); ?>
                <?php show_error($error, 'password'); ?>
                <div class="register">
                    <a href="#">Đăng ký tài khoản</a>
                </div>
                
            </div>


        </div>
    </form>


</body>

</html>