<?php if (!defined('IN_SITE')) die('The request not found'); ?>
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
                Xin chào <?php echo get_current_username(); ?>
                    <a style="color: white;" href="<?php echo base_url('?controller=login&action=logout'); ?>">Đăng xuất</a>
            </span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1 col-sm-2" id="panel">

            <ul class="fordtreeview list-group">
                <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getQuery'))?>">Đặt vé máy bay</a></li>
                <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getQuery'))?>">Đặt phòng khách sạn</a></li>
                <li class="list-group-item"><a href="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getQuery'))?>">Quản lý tài khoản người dùng</a></li>
            </ul>
        </div>
        <div class="col-xs-11 col-sm-10" id="main">
