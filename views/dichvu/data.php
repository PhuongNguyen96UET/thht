
<tbody>
<?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
<?php
$no 	= 1;
foreach ($users as $item){ ?>
    <tr>
        <td><?php echo $item['Code']; ?></td>
        <td><?php echo $item['Name']; ?></td>
        <td><?php echo $item['status']; ?></td>
        <td><?php echo $item['Unit_price']; ?></td>
        <td><?php echo $item['type']; ?></td>
        <td><?php echo $item['syntax']; ?></td>
        <td><?php echo $item['register_number']; ?></td>
        <td><?php echo $item['desciption']; ?></td>
        <?php if (is_supper_admin()){ ?>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                        <form method="POST" action="<?php echo create_link(base_url(), array('controller' => 'dichvu', 'action' => 'editDV')); ?>">
                            <input type="hidden" name="dv_id" value="<?php echo $item['syntax_id']; ?>"/>
                            <input type="hidden" name="request_name" value="edit_dv"/>
                            <a href="#" class="btn-submit dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                        </form>
                        <!--                            <a class="dropdown-item" href="--><?php //echo create_link(base_url(), array('controller' => 'user', 'action' => 'edit', 'id' => $item['id'])); ?><!--">Sửa</a>-->
                        <form method="POST" class="form-delete" action="<?php echo create_link(base_url(), array('controller' => 'dichvu', 'action' => 'deleteDV')); ?>">
                            <input type="hidden" name="dv_id" value="<?php echo $item['syntax_id']; ?>"/>
                            <input type="hidden" name="request_name" value="delete_s"/>
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
            if (!confirm('Bạn có chắc muốn xóa dịch vụ này không?')){
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