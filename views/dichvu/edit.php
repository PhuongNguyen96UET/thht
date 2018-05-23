<h1>Sửa thông tin dịch vụ</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'dichvu', 'action' => 'editDV')); ?>">
    <input type="hidden" name="request_name" value="edit_s"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Mã dịch vụ</td>
            <td>
                <input type="text" class="form-control" disabled="true" name="Code" value="<?php echo $data['Code']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Code'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="Code_hidden" value="<?php echo$field['Code']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Tên dịch vụ</td>
            <td>
                <input type="text" class="form-control" name="Name" value="<?php echo $data['Name']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Name'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="Name_hidden" value="<?php echo $field['Name']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Trạng thái</td>
            <td>
                <select class="custom-select" name="status_id">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv1 as $item){ ?>

                        <option value="<?php echo $item['id']; ?>" <?php if($data['status_id']!=''&&$data['status_id']==$item['id']) echo'selected="selected"' ?>><?php echo $item['name']; ?></option>

                    <?php } ?>
                </select>
            </td>
            <td>
                <?php show_error($error, 'status_id'); ?>
            </td>
        </tr>
        <tr>
            <td>Loại dịch vụ</td>
            <td>
                <select class="custom-select" name="service_type_Id">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv as $item){ ?>

                        <option value="<?php echo $item['Code']; ?>" <?php if ($data['service_type_Id']==$item['Code']) echo 'selected="selected"' ?>><?php echo $item['Name']; ?></option>

                    <?php } ?>
                </select>
            </td>
            <td>
                <?php show_error($error, 'service_type_Id'); ?>
            </td>
        </tr>
        <tr>
            <td>Giá</td>
            <td>
                <input type="number" class="form-control" name="Unit_price" value="<?php echo $data['Unit_price']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'Unit_price'); ?>
            </td>
        </tr>
        <tr>
            <td>Cú pháp</td>
            <td>
                <input type="text" class="form-control" name="syntax" value="<?php echo $syntax['syntax']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'syntax'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="register_number" value="0"  />
            </td>
            <td>
                <input type="hidden" class="form-control" name="syntax_hidden" value="<?php echo $field['syntax']; ?>"  />
            </td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td>
                <textarea class="form-control" name="desciption"><?php echo $data['desciption']; ?></textarea>
            </td>
            <td>
                <?php show_error($error, 'desciption'); ?>
            </td>
            <td>
                <input type="hidden" class="form-control" name="syntax_id" value="<?php echo $data['syntax_id']; ?>" />
            </td>
            <td>
                <input type="hidden" class="form-control" name="register_number" value="<?php echo $syntax['register_number']; ?>" />
            </td>
        </tr>
    </table>
    <div class="controls">
        <button form="main-form" type="submit" class="btn btn-default login">Lưu</button>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>