
<tbody>
<?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
<?php
$no 	= 1;
foreach ($users as $item){ ?>
    <tr>
        <td><?php echo $item['ID']; ?></td>
        <td><?php echo $item['Shortname']; ?></td>
        <td><?php echo $item['Fullname']; ?></td>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['start_date']; ?></td>
        <td><?php echo $item['end_date']; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td><?php echo $item['contact']; ?></td>
        <td><?php echo $item['Description']; ?></td>
        <?php if (is_supper_admin()){ ?>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                        <form method="POST" action="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'editDT')); ?>">
                            <input type="hidden" name="dt_id" value="<?php echo $item['ID']; ?>"/>
                            <input type="hidden" name="request_name" value="edit_dt"/>
                            <a href="#" class="btn-submit dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                        </form>
                        <!--                            <a class="dropdown-item" href="--><?php //echo create_link(base_url(), array('controller' => 'user', 'action' => 'edit', 'id' => $item['id'])); ?><!--">Sửa</a>-->
                        <form method="POST" class="form-delete" action="<?php echo create_link(base_url(), array('controller' => 'doitac', 'action' => 'deleteDT')); ?>">
                            <input type="hidden" name="dt_id" value="<?php echo $item['ID']; ?>"/>
                            <input type="hidden" name="request_name" value="delete_dt"/>
                            <a href="#" class="btn-submit dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                        </form>
                    </div>
                </div>
            </td>
        <?php } ?>
    </tr>

<?php  }        ?>
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
            if (!confirm('Bạn có chắc muốn xóa nhân viên này không?')){
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