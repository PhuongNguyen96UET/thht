
<tbody>
    <?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
    <?php
    $no 	= 1;
    foreach ($users as $item){ ?>
    <tr class="clickName"  />
    <td><?php echo $item['id']; ?></td>
    <td><?php echo $item['fullname']; ?></td>
    <td><?php echo $item['username']; ?></td>
    <td><?php echo $item['phone']; ?></td>
    <td><?php echo $item['email']; ?></td>
    <td><?php echo $item['address']; ?></td>
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