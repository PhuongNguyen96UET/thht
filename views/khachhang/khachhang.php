<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
    <form action="<?php echo create_link(base_url(), array('controller' => 'users_cus', 'action' => 'getData')); ?>" method="post" id="form1">
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Mã người dùng</label></div>
                        <div class="col-sm-8"><input type="text" name="id" value="<?php echo input_post('id') ?>" class="form-control" ></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;" ><label >Tên khách hàng</label></div>
                        <div class="col-sm-8" ><input type="text" name="fullname" value="<?php echo input_post('fullname') ?>" class="form-control"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số điện thoại</label></div>
                        <div class="col-sm-8"><input type="tel" name="phone" value="<?php echo input_post('phone') ?>" class="form-control" ></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;" ><label >Email</label></div>
                        <div class="col-sm-8"><input type="tel" name="email" value="<?php echo input_post('email') ?>" class="form-control" ></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: 100%;display: flex;justify-content: center;align-items: center;">

            <button id="search" type="submit" form="form1" style="position: relative;left:1%;" class="btn btn-primary" >Tìm kiếm</button>
        </div>
    </form>
</div>

<div class="row" style="height: 1%" ></div>

<div class="controls">
    <?php if (is_supper_admin()){ ?>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'users_cus', 'action' => 'addKH')); ?>"><button class="btn btn-default login">Thêm</button></a>
    <?php } ?>
</div>
<table class="table table-striped" style="font-size: 14px;">
    <h3>Danh sách người dùng</h3>
    <thead>
    <tr>
        <td>Mã</td>
        <td>Tên người dùng</td>
        <td>Tên tài khoản</td>
        <td>Số điện thoại</td>
        <td>Email</td>
        <td>Địa chỉ</td>
    </tr>
    </thead>