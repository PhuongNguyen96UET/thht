<h1>Đổi mật khẩu</h1>

<form id="main-form" method="post">
    <input type="hidden" name="request_name" value="add_c"/>
    <div class="col-md-6">
        <!-- password -->
        <label for="password" class="control-label" >Mật khẩu <span style="color:red;">*</span></label>
        <input type="password" class="col-sm-10 form-control" name="password" value="<?php echo input_post('password'); ?>"/>
        <span><?php show_error($error, 'password'); ?></span><br>

        <!-- re-password -->
        <label for="re-password" class="control-label" >Nhập lại mật khẩu <span style="color:red;">*</span></label>
        <input type="password" class="col-sm-10 form-control" name="re-password" value="<?php echo input_post('re-password'); ?>"/>
        <span><?php show_error($error, 're-password'); ?></span><br>

    </div>
    <div class= col-md-6 controls">
    <button form="main-form" type="submit" style="width: 100px;" class="btn btn-primary login">Lưu</button>
    <a style="width: 100px;" class="button" href="<?php echo create_link(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>