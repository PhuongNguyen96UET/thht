<h1>Thêm thành viên</h1>


<form id="main-form" class="form" method="post"  accept-charset="utf-8">
    <input type="hidden" name="request_name" value="add_user"/>

    <div class="col-md-6">
       <label for="username" class="control-label" >Tên người dùng <span style="color:red;">*</span></label>

       <input type="text" class="col-sm-10 form-control" name="username" value="<?php echo input_post('username'); ?>"/>
       <span><?php show_error($error, 'username'); ?></span><br>

       <label for="password" class="control-label" >Mật khẩu <span style="color:red;">*</span></label>

       <input type="password" class="col-sm-10 form-control" name="password" value="<?php echo input_post('password'); ?>"/>
       <span><?php show_error($error, 'password'); ?></span><br>

       <label for="re-password" class="control-label" >Nhập lại mật khẩu <span style="color:red;">*</span></label>

       <input type="password" class="col-sm-10 form-control" name="re-password" value="<?php echo input_post('re-password'); ?>"/>
       <span><?php show_error($error, 're-password'); ?></span><br>

       <label for="fullname" class="control-label" >Họ tên <span style="color:red;">*</span></label>

       <input type="text" class="col-sm-10 form-control" name="fullname" value="<?php echo input_post('fullname'); ?>"/>
       <span><?php show_error($error, 'fullname'); ?></span><br>

       <label for="level" class="control-label" >Chọn loại người dùng <span style="color:red;">*</span></label>
       <select class="custom-select" name="level" class="col-sm-10 form-control">
        <option value="1" <?php echo (input_post('level') == 1) ? 'selected' : ''; ?>>Admin</option>
        </select>
        <br>
        <span><?php show_error($error, 'level'); ?></span><br>
    </div>
    <div class="controls">
        <button type="submit" form="main-form" class="btn btn-primary login" style="width: 100px;margin-left: 20px">Lưu</button>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'list', 'action' => 'getList')); ?>"><button class="btn btn-default login" style="width: 100px">Trở về</button></a>
    </div>
</form>
