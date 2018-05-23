
<tbody>
<?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
<?php
$no 	= 1;

foreach ($users as $item){ ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $item['CustomerName']; ?></td>
        <td><?php echo $item['phone_number']; ?></td>
        <td><?php echo $item['ServiceName']; ?></td>
        <td><?php echo $item['start_date']; ?></td>
        <td><?php echo $item['end_date']; ?></td>
        <td><?php echo number_format($item['total'], 0, ",", "."); ?></td>
        <?php if (is_supper_admin()){ ?>
            <td>
                <a type="button" title="Chi tiết" class="btn btn-info" data-toggle="modal" href='#modal-info<?php echo $item['id'] ?>' style="float: left; margin-right: 10px;"><i class="fa fa-info-circle"></i></a>
                <div class="modal fade" id="modal-info<?php echo $item['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thông tin lịch sử chi tiết</h4>
                            </div>
                            <div class="modal-body">                                
                                <p><b>Khách hàng: </b><?php echo $item['CustomerName']; ?></p>
                                <p><b>Thuê bao: </b><?php echo $item['phone_number']; ?></p>
                                <p><b>Loại thuê bao: </b><?php echo $item['SubcriptionName']; ?></p>
                                <p><b>Dịch vụ: </b><?php echo $item['ServiceName']; ?></p>
                                <?php if (isset($item['received_phone'])) { ?>
                                    <p><b>SĐT nhận: </b><?php echo $item['received_phone']; ?></p>
                                <?php } ?>
                                <p><b>Bắt đầu: </b><?php echo $item['start_date']; ?></p>
                                <p><b>Kết thúc: </b><?php echo $item['end_date']; ?></p>
                                <?php if (isset($item['time_total'])) { ?>
                                    <p><b>Tổng thời gian gọi: </b><?php echo $item['time_total']; ?> giây</p>
                                <?php } ?>
                                <p><b>Cước phí: </b><?php echo number_format($item['total'], 0, ",", "."); ?> đồng</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" class="form-delete" action="<?php echo create_link('', array('controller' => 'lichsu', 'action' => 'delete_history')); ?>" style="float: left">
                    <input type="hidden" name="ls_id" value="<?php echo $item['id']; ?>"/>
                    <input type="hidden" name="request_name" value="delete_history"/>
                    <a href="#" title="Xóa" class="btn btn-danger btn-submit"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </form>
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