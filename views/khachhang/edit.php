<h1>Thông tin tài khoản</h1>

<form id="main-form" method="post">
    <input type="hidden" name="request_name" value="add_c"/>
    <div class="col-md-6">
        <!-- name -->
        <label for="fullname" class="control-label" >Tên khách hàng  <span style="color:red;">*</span></label>
        <input type="text" class="col-sm-10 form-control" name="fullname" value="<?php echo $user['fullname']; ?>"/>
        <span><?php show_error($error, 'fullname'); ?></span><br>

        <!-- username -->
        <label for="username" class="control-label" >Tên người dùng<span style="color:red;">*</span></label>
        <input type="text" class="col-sm-10 form-control" name="username" value="<?php echo $user['username']; ?>"/>
        <span><?php show_error($error, 'username'); ?></span><br>

        <!-- address -->
        <label for="address" class="control-label" >Địa chỉ<span style="color:red;">*</span></label>
        <input type="text" class="col-sm-10 form-control" name="address" value="<?php echo $user['address']; ?>"/>
        <span><?php show_error($error, 'address'); ?></span><br>

        <!-- phone number -->
        <label for="phone" class="control-label" >Số điện thoại  <span style="color:red;">*</span></label>
        <input type="text" class="col-sm-10 form-control" name="phone" value="<?php echo $user['phone']; ?>"/>
        <span><?php show_error($error, 'phone'); ?></span><br>

        <!-- email -->
        <label for="email" class="control-label" >Email <span style="color:red;">*</span></label>
        <input type="text" class="col-sm-10 form-control" name="email" value="<?php echo $user['email']; ?>"/>
        <span><?php show_error($error, 'email'); ?></span><br>

    </div>
    <div class= col-md-6 controls">
        <button form="main-form" type="submit" style="width: 100px;" class="btn btn-primary login">Lưu</button>
        <a style="width: 100px;" class="button" href="<?php echo create_link(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>