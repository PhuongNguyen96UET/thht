 <div class="row" id="nhanvien">
        <h3>Tìm kiếm</h3>
        <form action="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getData')); ?>" method="post">
            <div class="row" >
                <div class="col-sm-6" >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4" style="text-align: right;"><label >Mã nhân viên</label></div>
                            <div class="col-sm-8"><input type="text" name="Code" class="form-control" value="<?php echo input_post('Code') ?>"></div>
                        </div>
                     </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4" style="text-align: right;" ><label style="" >Tên nhân viên</label></div>
                            <div class="col-sm-8" ><input type="text" name="Name" class="form-control" value="<?php echo input_post('Name') ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 100%;display: flex;justify-content: center;align-items: center;">
                <input type="hidden" name="request_name" value="search_e"/>
                <button id="search" style="position: relative;left:1%;" class="btn btn-primary" >Tìm kiếm</button>
            </div>
        </form>
    </div>

<div class="row" style="height: 1%" ></div>

<div class="controls">
    <?php if (is_supper_admin()){ ?>
    <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'addNV')); ?>"><button class="btn btn-default login">Thêm</button></a>
    <?php } ?>
</div>
<table class="table table-striped" style="font-size: 14px;">
    <h3>Danh sách nhân viên</h3>
    <thead>
    <tr>
        <td>Mã</td>
        <td>Tên nhân viên</td>
        <td>Công việc</td>
        <td>Số điện thoại</td>
        <td>Địa chỉ</td>
        <td>Email</td>
        <?php if (is_supper_admin()){ ?>
            <td>Hành động</td>
        <?php } ?>
    </tr>
    </thead>