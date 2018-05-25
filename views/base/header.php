<?php if (!defined('IN_SITE')) die('The request not found'); ?>
<!DOCTYPE html><html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
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
                <a style="color: white;" href="<?php echo create_link(base_url(), array('controller' => 'list', 'action' => 'getList')); ?>">Quản lý Admin</a>
            <?php } ?>
                    </span>
                <span id="right">
                        <?php
                        if (is_logged()){ ?>
                            <div class="dropdown">
                                  <button style="right: 100px;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo get_current_username(); ?>
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu">
                                    <li><a style="color: black;margin-left: 10px;" href="<?php echo base_url('?controller=login&action=setting'); ?>">Cài đặt</a></li>
                                    <li><a style="color: black;margin-left: 10px;" href="<?php echo base_url('?controller=login&action=changepass'); ?>">Đổi mật khẩu</a></li>
                                    <li><a style="color: black;margin-left: 10px;" href="<?php echo base_url('?controller=login&action=logout'); ?>">Đăng xuất</a></li>
                                  </ul>
                            </div>
<!--                        Xin chào --><?php //echo get_current_username(); ?>
<!--                            <button class="btn btn-default"><a style="color: black;" href="--><?php //echo base_url('?controller=login&action=logout'); ?><!--">Đăng xuất</a></button>-->
                        <?php   }else{ ?>
                            <button class="btn btn-default"> <a style="color: black"  href="<?php echo base_url('?controller=login&action=getUser'); ?>">Đăng nhập</a></button>
                            <button class="btn btn-default"><a style="color: black" href="<?php echo base_url('?controller=login&action=register'); ?>">Đăng ký</a></button>
                        <?php } ?>
            </span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1 col-sm-2" style="background-color: #EDF3F7;min-height: 93vh;">

            <ul class="fordtreeview list-group">
                <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getQuery'))?>">Đặt vé máy bay</a></li>
                <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'getQuery'))?>">Đặt phòng khách sạn</a></li>
                <?php if (is_admin()){ ?>
                    <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'users_cus', 'action' => 'getQuery'))?>">Quản lý tài khoản người dùng</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-xs-11 col-sm-10" >
