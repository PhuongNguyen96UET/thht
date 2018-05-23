<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
    <form action="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'getData')); ?>" method="post">
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Mã công ty</label></div>
                        <div class="col-sm-8"><input type="text" name="ID" class="form-control" value="<?php echo input_post('ID') ?>"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Tên công ty</label></div>
                        <div class="col-sm-8"><input type="text" name="Shortname" class="form-control" value="<?php echo input_post('Shortname') ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-6" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Trạng thái</label></div>
                        <div class="col-sm-8" >
                            <select class="custom-select" name="status_id">
                                <option value="">-- Chọn --</option>
                                <?php foreach ($cv as $item){ ?>

                                    <option value="<?php echo $item['id']; ?>" <?php if(input_post('status_id')!=''&&input_post('status_id')==$item['id']) echo'selected="selected"' ?>><?php echo $item['name']; ?></option>

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
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'addDT')); ?>"><button class="btn btn-default login">Thêm</button></a>
    <?php } ?>
</div>
<table class="table table-striped" style="font-size: 14px;">
    <h3>Danh sách đối tác</h3>
    <thead>
    <tr>
        <td>Mã</td>
        <td>Viết tắt</td>
        <td>Tên đầy đủ</td>
        <td>Trạng thái</td>
        <td>Ngày bắt đầu</td>
        <td>Ngày KT</td>
        <td>Email</td>
        <td>Liên hệ</td>
        <td>Mô tả</td>
        <?php if (is_supper_admin()){ ?>
            <td>Hành động</td>
        <?php } ?>
    </tr>
    </thead>