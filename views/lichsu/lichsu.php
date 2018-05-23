<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
    <form action="<?php echo create_link('', array('controller' => 'lichsu', 'action' => 'getData')); ?>" method="post" id="form1">
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Mã khách hàng</label></div>
                        <div class="col-sm-8"><input type="text" name="Code" value="<?php echo input_post('Code') ?>" class="form-control" ></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Tên khách hàng</label></div>
                        <div class="col-sm-8" ><input type="text" name="CustomerName" value="<?php echo input_post('CustomerName') ?>" class="form-control"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số điện thoại</label></div>
                        <div class="col-sm-8"><input type="tel" name="phone_number" value="<?php echo input_post('phone_number') ?>" class="form-control" ></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Loại dịch vụ</label></div>
                        <div class="col-sm-8" >
                            <select class="custom-select" name="service_id">
                                <option value="">-- Chọn --</option>
                                <?php foreach ($cv as $item){ ?>

                                    <option value="<?php echo $item['Code']; ?>" <?php if(input_post('service_id')==$item['Code']) echo'selected="selected"' ?>><?php echo $item['Name']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
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

<table class="table table-striped" style="font-size: 14px;">
    <h3>Lịch sử khách hàng</h3>
    <thead>
    <tr>
        <td>No</td>
        <td>Tên khách hàng</td>
        <td>Số điện thoại</td>
        <td>Tên dịch vụ</td>
        <td>Ngày bắt đầu</td>
        <td>Ngày kết thúc</td>
        <td>Cước phí</td>
        <?php if (is_supper_admin()){ ?>
            <td>Hành động</td>
        <?php } ?>
    </tr>
    </thead>