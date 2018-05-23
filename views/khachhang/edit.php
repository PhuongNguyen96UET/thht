<h1>Sửa thông tin khách hàng</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'editKH')); ?>">
    <input type="hidden" name="request_name" value="edit_c"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Mã khách hàng</td>
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
            <td>Tên khách hàng</td>
            <td>
                <input type="text" class="form-control" name="Name" value="<?php echo $data['Name']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Name'); ?>
            </td>
        </tr>
        <tr>
            <td>Ngày sinh</td>
            <td>
                <input type="date" class="form-control" name="date_of_birth"   value="<?php echo $data['date_of_birth']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'date_of_birth'); ?>
            </td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>
                <input type="text" class="form-control" name="phone_number" value="<?php echo $data['phone_number']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'phone_number'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="phone_number_hidden" value="<?php echo $field['phone_number']; ?>"  />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'email'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="email_hidden" value="<?php echo $field['email']; ?>"  />
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
            <td>Loại đăng ký</td>
            <td>
                <select class="custom-select" name="subscription_type">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv as $item){ ?>

                        <option value="<?php echo $item['Code']; ?>" <?php if($data['subscription_type']==$item['Code']) echo 'selected="selected"' ?>><?php echo $item['Name']; ?></option>

                    <?php } ?>
                </select>
            </td>
            <td>
                <?php show_error($error, 'subscription_type'); ?>
            </td>
        </tr>
    </table>
    <div class="controls">
        <button form="main-form" type="submit" class="btn btn-default login">Lưu</button>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>