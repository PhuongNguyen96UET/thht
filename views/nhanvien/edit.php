<h1>Sửa thông tin nhân viên</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'editNV')); ?>">
    <input type="hidden" name="request_name" value="edit_e"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td >Mã nhân viên</td>
            <td>
                <input type="text" class="form-control" disabled="true" name="Code" value="<?php echo $data['Code']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Code'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="Code_hidden" value="<?php echo $field['Code']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Tên nhân viên</td>
            <td>
                <input type="text" class="form-control" name="Name" value="<?php echo $data['Name']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Name'); ?>
            </td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>
                <input type="text" class="form-control" name="Phone_Number"   value="<?php echo $data['Phone_Number']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Phone_Number'); ?>
            </td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td>
                <input type="text" class="form-control" name="Address" value="<?php echo $data['Address']; ?>"  />
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
                        <option value="<?php echo $item['id']; ?>" <?php if($item['id']==$data['job_id']) echo 'selected="selected"' ?>><?php echo $item['name'];

                        ?></option>

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
                <input type="email" class="form-control" name="Email" value="<?php echo $data['Email']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Email'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="Email_hidden" value="<?php echo $field['Email']; ?>" />
            </td>
        </tr>
    </table>
    <div class="controls">
        <button type="submit" form="main-form" class="btn btn-default login">Lưu</button></a>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getData')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>