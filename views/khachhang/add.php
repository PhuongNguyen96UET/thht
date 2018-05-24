<h1>Đăng ký tài khoản</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'users_cus', 'action' => 'addKH')); ?>">
    <input type="hidden" name="request_name" value="add_c"/>
    <div class="col-md-6">
        <!-- name -->
       <label for="fullname" class="control-label" >Tên khách hàng  <span style="color:red;">*</span></label>
       <input type="text" class="col-sm-10 form-control" name="fullname" value="<?php echo input_post('fullname'); ?>"/>
       <span><?php show_error($error, 'fullname'); ?></span><br>

       <!-- username -->
       <label for="username" class="control-label" >Tên người dùng<span style="color:red;">*</span></label>
       <input type="text" class="col-sm-10 form-control" name="username" value="<?php echo input_post('username'); ?>"/>
       <span><?php show_error($error, 'username'); ?></span><br>

        <!-- password -->
        <label for="password" class="control-label" >Mật khẩu <span style="color:red;">*</span></label>
        <input type="password" class="col-sm-10 form-control" name="password" value="<?php echo input_post('password'); ?>"/>
        <span><?php show_error($error, 'password'); ?></span><br>

        <!-- re-password -->
        <label for="re-password" class="control-label" >Nhập lại mật khẩu <span style="color:red;">*</span></label>
        <input type="password" class="col-sm-10 form-control" name="re-password" value="<?php echo input_post('re-password'); ?>"/>
        <span><?php show_error($error, 're-password'); ?></span><br>

       <!-- address -->
       <label for="address" class="control-label" >Địa chỉ<span style="color:red;">*</span></label>
       <input type="text" class="col-sm-10 form-control" name="address" value="<?php echo input_post('address'); ?>"/>
       <span><?php show_error($error, 'address'); ?></span><br>

       <!-- phone number -->
       <label for="phone" class="control-label" >Số điện thoại  <span style="color:red;">*</span></label>
       <input type="text" class="col-sm-10 form-control" name="phone" value="<?php echo input_post('phone'); ?>"/>
       <span><?php show_error($error, 'phone'); ?></span><br>

       <!-- email -->
       <label for="email" class="control-label" >Email <span style="color:red;">*</span></label>
       <input type="text" class="col-sm-10 form-control" name="email" value="<?php echo input_post('email'); ?>"/>
       <span><?php show_error($error, 'email'); ?></span><br>

    </div>
    <div class="controls">
        <button form="main-form" type="submit" style="width: 100px;" class="btn btn-primary login">Lưu</button>
        <a style="width: 100px;" class="button" href="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>