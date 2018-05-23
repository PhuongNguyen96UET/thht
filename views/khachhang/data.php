
<tbody>
    <?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
    <?php
    $no 	= 1;
    foreach ($users as $item){ ?>
    <tr class="clickName"  />
    <td><?php echo $item['Code']; ?></td>
    <td><?php echo $item['Name']; ?></td>
    <td><?php echo $item['date_of_birth']; ?></td>
    <td><?php echo $item['phone_number']; ?></td>
    <td><?php echo $item['email']; ?></td>
    <td><?php echo $item['Address']; ?></td>
    <td><?php echo $item['subcription']; ?></td>
    <?php if (is_supper_admin()){ ?>
    <td>
        <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="color: blue"><i class="fa fa-cog"   aria-hidden="true"></i></button>
            <ul class="dropdown-menu" style="position: absolute;">
                <li>
                    <!-- xem dịch vụ khách hàng đang sử dụng -->
                    <a type="text" class="btn-submit dropdown-item" data-toggle="modal" href='#modal-info<?php echo $item['id'] ?>' style="float: left; margin-right: 10px;" onclick="window.open('?controller=khachhang&action=process&<?php echo 'Code='.$item['Code']; ?>','popUpWindow','height=400,width=800,left=10,top=10,,scrollbars=yes,menubar=no'); return false;"><i class="fa fa-info"> Chi tiết</i></a>
                </li>
                <li>
                    <!-- sửa -->
                    <form method="POST" action="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'editKH')); ?>">
                        <input type="hidden" name="kh_id" value="<?php echo $item['Code']; ?>"/>
                        <input type="hidden" name="request_name" value="edit_kh"/>
                        <a href="#" class="btn-submit dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                    </form>
                </li>
                <li>
                    <!-- xóa -->
                    <form method="POST" class="form-delete" action="<?php echo create_link(base_url(), array('controller' => 'khachhang', 'action' => 'delete_customer')); ?>">
                        <input type="hidden" name="kh_id" value="<?php echo $item['Code']; ?>"/>
                        <input type="hidden" name="request_name" value="delete_customer"/>
                        <a href="#" class="btn-submit dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                    </form>
                </li>
            </ul>

                <!-- <div class="dropdown-menu">
                </div> -->
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
            if (!confirm('Bạn có chắc muốn khách hàng này không?')){
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