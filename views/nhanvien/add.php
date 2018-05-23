<h1>Thêm nhân viên</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'addNV')); ?>">
    <input type="hidden" name="request_name" value="add_e"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Mã nhân viên</td>
            <td>
                <input type="text" class="form-control" name="Code" value="<?php echo input_post('Code'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Code'); ?>
            </td>
        </tr>
        <tr>
            <td>Tên nhân viên</td>
            <td>
                <input type="text" class="form-control" name="Name" value="<?php echo input_post('Name'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Name'); ?>
            </td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>
                <input type="text" class="form-control" name="Phone_Number"   value="<?php echo input_post('Phone_Number'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Phone_Number'); ?>
            </td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td>
                <input type="text" class="form-control" name="Address" value="<?php echo input_post('Address'); ?>"  />
            </td>
            <td>
                <?php show_error($error, 'Address'); ?>
            </td>
        </tr>
        <tr>
            <td>Công việc</td>
            <td>
                <select class="custom-select" name="job_id">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv as $item){ ?>

                    <option value="<?php echo $item['id']; ?>" <?php if(input_post('job_id')==$item['id']) echo 'selected="selected"' ?>><?php echo $item['name']; ?></option>

                    <?php } ?>
                </select>
            </td>
            <td>
                <?php show_error($error, 'job_id'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" class="form-control" name="Email" value="<?php echo input_post('Email'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Email'); ?>
            </td>
        </tr>
    </table>
    <div class="controls">
        <button type="submit" form="main-form" class="btn btn-default login">Lưu</button></a>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>