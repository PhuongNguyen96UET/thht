<h1>Danh sách thành viên</h1>
<div class="controls">
    <a class="button" href="<?php echo create_link(base_url(), array('controller' => 'user', 'action' => 'addUser')); ?>"><button class="btn btn-default login">Thêm</button></a>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <td>Tên tài khoản</td>
        <td>Họ tên</td>
        <?php if (is_supper_admin()){ ?>
            <td>Hành động</td>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
    <?php foreach ($users as $item){ ?>
        <tr>
            <td><?php echo $item['username']; ?></td>
            <td><?php echo $item['fullname']; ?></td>
            <?php if (is_supper_admin()){ ?>
                <td>
                    <form method="POST" class="form-delete" action="<?php echo create_link(base_url(), array('controller' => 'user', 'action' => 'deleteUser')); ?>">
                        <input type="hidden" name="user_id" value="<?php echo $item['id']; ?>"/>
                        <input type="hidden" name="request_name" value="delete_user"/>
                        <a href="#" class="btn-submit"><button class="btn btn-default login">Xóa</button></a>
                    </form>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="pagination">
    <?php // VỊ TRÍ 03: CODE HIỂN THỊ CÁC NÚT PHÂN TRANG
    echo $paging['html'];
    ?>
</div>

<script language="javascript">
    $(document).ready(function(){
        // Nếu người dùng click vào nút delete
        // Thì submit form
        $('.btn-submit').click(function(){
            $(this).parent().submit();
            return false;
        });

        // Nếu sự kiện submit form xảy ra thì hỏi người dùng có chắc không?
        $('.form-delete').submit(function(){
            if (!confirm('Bạn có chắc muốn xóa thành viên này không?')){
                return false;
            }

            // Nếu người dùng chắc chắn muốn xóa thì ta thêm vào trong form delete
            // một input hidden có giá trị là URL hiện tại, mục đích là giúp ở
            // trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa xong
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');

            // Thực hiện xóa
            return true;
        });
    });
</script>