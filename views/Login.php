<!--<!DOCTYPE html>-->
<!--<html>-->
<!---->
<!--<head>-->
<!---->
<!--    <meta charset="UTF-8">-->
<!---->
<!--    <title>Đăng nhập </title>-->
<!---->
<!--    <link rel="stylesheet" href="css/reset.css">-->
<!---->
<!--    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />-->
<!---->
<!--</head>-->
<!---->
<!--<body>-->
<!--<form method="POST" class="form-control">-->
<!--    <div class="wrap col-md-6">-->
<!---->
<!--        <div class="">-->
<!--            <img src="images/logo2.png">-->
<!--        </div>-->
<!--        -->
<!--        <input type="text" name="username" placeholder="Tên đăng nhập" required>-->
<!--        <div class="bar">-->
<!--            <i></i>-->
<!--        </div>-->
<!--        <input type="password" name="password" placeholder="Mật khẩu" required>-->
<!--        <input type="hidden" name="request_name" value="login"/>-->
<!--        <input type="submit" name="login" value="Đăng nhập">-->
<!--        <div class="register">-->
<!--            <a href="#">Đăng ký tài khoản</a>-->
<!--        </div>-->
<!--        --><?php //show_error($error, 'username'); ?>
<!--        --><?php //show_error($error, 'password'); ?>
<!--        -->
<!--    </div>-->
<!--</form>-->
<!---->
<!---->
<!--</body>-->
<!---->
<!--</html>-->



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
</head><body>
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

            <h1>Đăng nhập</h1>

            <form id="main-form" method="post" ">
            <input type="hidden" name="request_name" value="login"/>
                <div class="col-md-6">
                    <!-- name -->
<!--                    <label for="username" class="control-label" >Tên đăng nhập  </label>-->
                    <input type="text" class="col-sm-10 form-control" name="username" placeholder="Tên đăng nhập" value="<?php echo input_post('username'); ?>"/>
                    <span><?php show_error($error, 'username'); ?></span><br>

                    <!-- username -->
<!--                    <label for="password" class="control-label" >Mật khẩu</label>-->
                    <input type="password" class="col-sm-10 form-control" name="password" placeholder="Mật khẩu" value="<?php echo input_post('password'); ?>"/>
                    <span><?php show_error($error, 'password'); ?></span><br>
                </div>
                <div class="col-md-6 controls">
                    <button form="main-form" type="submit" style="width: 100%;" class="col-sm-10 btn btn-primary login">Đăng nhập</button>
                   </div>

            </form>
        </div>
    </div>
</div>

<script src="js/index.js"></script>

</body></html>