
<!-- <<<<<<< HEAD
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

=======
-->

<!DOCTYPE html><html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="background-color: #074ea7">
            <div class="col-xs-1 col-sm-2 logo" >
                <a href="<?php echo create_link(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard'))?>" id="logo2" style="color: white;font-family: initial;font-size: 30px;margin-top: 10px;">TravelSmart</a>
            </div>
            <div class="col-xs-11 col-sm-10" >
                <div id="dndx">
                    <span>
                        <?php if (is_admin()){ ?>
                            <a style="color: white;" href="<?php echo create_link(base_url(), array('controller' => 'list', 'action' => 'getList')); ?>">Quản lý người dùng</a>
                        <?php } ?>
                    </span>
                    <span id="right">
                        <button class="btn btn-default"> <a style="color: black"  href="<?php echo base_url('?controller=login&action=getUser'); ?>">Đăng nhập</a></button>
                        <button class="btn btn-default"><a style="color: black" href="<?php echo base_url('?controller=login&action=register'); ?>">Đăng ký</a></button>
                    </span></div>
                </div>
            </div>
            <div class="row " style="height: 30px;"></div>
            <div class="row ">
                <div class="col-md-6 offset-md-4" id="main">
                    <h3>Đăng nhập</h3>
                    <form id="main-form" method="post" ">
                        <input type="hidden" name="request_name" value="login"/>
                        <div class="col-md-6">
                            <input type="text" class="col-sm-12 form-control" name="username" placeholder="Tên đăng nhập" value="<?php echo input_post('username'); ?>"/>
                            <span><?php show_error($error, 'username'); ?></span><br>
                            <input type="password" class="col-sm-12 form-control" name="password" placeholder="Mật khẩu" value="<?php echo input_post('password'); ?>"/>
                            <span><?php show_error($error, 'password'); ?></span><br>
                        </div>
                        <div class="col-md-6 controls">
                            <button form="main-form" type="submit" style="width: 40%;" class="btn btn-primary login">Đăng nhập</button>
                        </div>

                        <div style="margin-left: 15px">
                            <a href="#">Quên mật khẩu?</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/index.js"></script>

</body>
</html>