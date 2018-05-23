<h1>Thêm đối tác</h1>

<form id="main-form" method="post" action="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'addDT')); ?>">
    <input type="hidden" name="request_name" value="add_p"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Mã đối tác</td>
            <td>
                <input type="number" class="form-control" name="ID" value="<?php echo input_post('ID'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'ID'); ?>
            </td>
        </tr>
        <tr>
            <td>Tên viết tắt</td>
            <td>
                <input type="text" class="form-control" name="Shortname" value="<?php echo input_post('Shortname'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Shortname'); ?>
            </td>
        </tr>
        <tr>
            <td>Tên đầy đủ</td>
            <td>
                <input type="text" class="form-control" name="Fullname" value="<?php echo input_post('Fullname'); ?>" />
            </td>
            <td>
                <?php show_error($error, 'Fullname'); ?>
            </td>
        </tr>
        <tr>
            <td>Trạng thái</td>
            <td>
                <select class="custom-select" name="status_id">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($cv as $item){ ?>

                        <option value="<?php echo $item['id']; ?>" <?php if(input_post('status_id')!=''&&input_post('status_id')==$item['id']) echo'selected="selected"' ?>><?php echo $item['name']; ?></option>

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
                <input type="date" class="form-control" name="start_date" value="<?php echo input_post('start_date'); ?>"  />
            </td>
            <td>
                <?php show_error($error, 'start_date'); ?>
            </td>
        </tr>
        <tr>
            <td>Ngày kết thúc</td>
            <td>
                <input type="date" class="form-control" name="end_date" value="<?php echo input_post('end_date'); ?>"  />
            </td>
            <td>
                <?php show_error($error, 'end_date'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" class="form-control" name="email" value="<?php echo input_post('email'); ?>"  />
            </td>
            <td>
                <?php show_error($error, 'email'); ?>
            </td>
        </tr>
        <tr>
            <td>Liên hệ</td>
            <td>
                <input type="text" class="form-control" name="contact" value="<?php echo input_post('contact'); ?>"  />
            </td>
            <td>
                <?php show_error($error, 'contact'); ?>
            </td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td>
                <textarea class="form-control" name="Description"><?php echo input_post('Description'); ?></textarea>
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