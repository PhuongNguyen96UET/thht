<h1>Sửa thông tin đối tác</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'editDT')); ?>">
    <input type="hidden" name="request_name" value="edit_p"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Mã đối tác</td>
            <td>
                <input type="number" class="form-control" disabled="true" name="ID" value="<?php echo $data['ID']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'ID'); ?>
            </td>
            <td>
                <input type="number" class="form-control" name="ID_hidden" value="<?php echo $field['ID']; ?>" />
            </td>
            <td>
        </tr>
        <tr>
            <td>Tên viết tắt</td>
            <td>
                <input type="text" class="form-control" name="Shortname" value="<?php echo $data['Shortname']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Shortname'); ?>
            </td>
            <td>
                <input type="text" class="form-control" name="Shortname_hidden" value="<?php echo $field['Shortname']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Tên đầy đủ</td>
            <td>
                <input type="text" class="form-control" name="Fullname" value="<?php echo $data['Fullname']; ?>" />
            </td>
            <td>
                <?php show_error($error, 'Fullname'); ?>
            </td>
            <td>
                <input type="text" class="form-control" name="Fullname_hidden" value="<?php echo $field['Fullname']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Trạng thái</td>
            <td>
                <select class="custom-select" name="status_id">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv as $item){ ?>

                        <option value="<?php echo $item['id']; ?>" <?php if($data['status_id']!=''&&$data['status_id']==$item['id']) echo'selected="selected"' ?>><?php echo $item['name']; ?></option>

                    <?php } ?>
                </select>
                </select>
            </td>
            <td>
                <?php show_error($error, 'status_id'); ?>
            </td>
        </tr>
        <tr>
            <td>Ngày bắt đầu</td>
            <td>
                <input type="date" class="form-control" name="start_date" value="<?php echo $data['start_date']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'start_date'); ?>
            </td>
        </tr>
        <tr>
            <td>Ngày kết thúc</td>
            <td>
                <input type="date" class="form-control" name="end_date" value="<?php echo $data['end_date']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'end_date'); ?>
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
                <input type="email" class="form-control" name="email_hidden" value="<?php echo $field['email']; ?>"  />
            </td>
        </tr>
        <tr>
            <td>Liên hệ</td>
            <td>
                <input type="text" class="form-control" name="contact" value="<?php echo $data['contact']; ?>"  />
            </td>
            <td>
                <?php show_error($error, 'contact'); ?>
            </td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td>
                <textarea class="form-control" name="Description"><?php echo $data['Description']; ?></textarea>
            </td>
            <td>
                <?php show_error($error, 'Description'); ?>
            </td>
        </tr>
    </table>
    <div class="controls">
        <button form="main-form" type="submit" class="btn btn-default login">Lưu</button>
        <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'getQuery')); ?>"><button type="button" class="btn btn-default login">Trở về</button></a>
    </div>
</form>