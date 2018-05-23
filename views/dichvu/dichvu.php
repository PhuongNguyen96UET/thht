<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
    <form action="<?php echo create_link(base_url(), array('controller' => 'dichvu', 'action' => 'getData')); ?>" method="post">
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Mã dịch vụ</label></div>
                        <div class="col-sm-8"><input type="text" name="Code" class="form-control" value="<?php echo input_post('Code') ?>"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;" ><label >Tên dịch vụ</label></div>
                        <div class="col-sm-8" ><input type="text" name="Name" class="form-control" value="<?php echo input_post('Name') ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;" ><label >Loại dịch vụ</label></div>
                        <div class="col-sm-8" >
                            <select class="custom-select" name="service_type_Id">
                                <option value="">-- Chọn --</option>
                                <?php foreach ($cv as $item){ ?>

                                    <option value="<?php echo $item['Code']; ?>" <?php if(input_post('service_type_Id')==$item['Code']) echo'selected="selected"' ?>><?php echo $item['Name']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;" ><label >Trạng thái</label></div>
                        <div class="col-sm-8" >
                            <select class="custom-select" name="status">
                                <option value="">-- Chọn --</option>
                                <?php foreach ($cv1 as $item){ ?>

                                    <option value="<?php echo $item['id']; ?>" <?php if(input_post('status')!=''&&input_post('status')==$item['id']) echo'selected="selected"' ?>><?php echo $item['name']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
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
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'dichvu', 'action' => 'addDV')); ?>"><button class="btn btn-default login">Thêm</button></a>
    <?php } ?>
</div>
<table class="table table-striped" style="font-size: 14px;">
    <h3>Danh sách dịch vụ</h3>
    <thead>
    <tr>
        <td>Mã</td>
        <td>Tên dịch vụ</td>
        <td>Trạng thái</td>
        <td>Giá</td>
        <td>Loại</td>
        <td>Cú pháp</td>
        <td>Số người đăng ký</td>
        <td>Mô tả</td>
        <?php if (is_supper_admin()){ ?>
            <td>Hành động</td>
        <?php } ?>
    </tr>
    </thead>