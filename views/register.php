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
                    <div>
                        <h3>Đăng ký tài khoản</h3>
                    </div>
                    <form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'login', 'action' => 'register')); ?>">
                        <input type="hidden" name="request_name" value="add_c"/>
                        <div class="col-md-6">
                            <!-- name -->
                            <label for="fullname" class="control-label" >Tên khách hàng  <span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-12 form-control" name="fullname" value="<?php echo input_post('fullname'); ?>"/>
                            <span><?php show_error($error, 'fullname'); ?></span><br>

                            <!-- username -->
                            <label for="username" class="control-label" >Tên người dùng<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-12 form-control" name="username" value="<?php echo input_post('username'); ?>"/>
                            <span><?php show_error($error, 'username'); ?></span><br>

                            <!-- password -->
                            <label for="password" class="control-label" >Mật khẩu <span style="color:red;">*</span></label>
                            <input type="password" class="col-sm-12 form-control" name="password" value="<?php echo input_post('password'); ?>"/>
                            <span><?php show_error($error, 'password'); ?></span><br>

                            <!-- re-password -->
                            <label for="re-password" class="control-label" >Nhập lại mật khẩu <span style="color:red;">*</span></label>
                            <input type="password" class="col-sm-12 form-control" name="re-password" value="<?php echo input_post('re-password'); ?>"/>
                            <span><?php show_error($error, 're-password'); ?></span><br>

                            <!-- address -->
                            <label for="address" class="control-label" >Địa chỉ<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-12 form-control" name="address" value="<?php echo input_post('address'); ?>"/>
                            <span><?php show_error($error, 'address'); ?></span><br>

                            <!-- phone number -->
                            <label for="phone" class="control-label" >Số điện thoại  <span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-12 form-control" name="phone" value="<?php echo input_post('phone'); ?>"/>
                            <span><?php show_error($error, 'phone'); ?></span><br>

                            <!-- email -->
                            <label for="email" class="control-label" >Email <span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-12 form-control" name="email" value="<?php echo input_post('email'); ?>"/>
                            <span><?php show_error($error, 'email'); ?></span><br>

                        </div>
                        <div class="controls">
                            <button form="main-form" type="submit" style="width: 100px; margin-left: 15 px" class="btn btn-primary login">Lưu</button>
                            <a style="width: 100px;" class="button" href="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/index.js"></script>

    </body></html>