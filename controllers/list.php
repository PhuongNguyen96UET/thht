<?php if (!defined('IN_SITE')) die ('The request not found');
function getList(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard'));
}
 include_once('views/base/header.php');

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
$sql = db_create_sql('SELECT count(id) as counter from tb_user {where}');
$result = db_get_row($sql);
$total_records = $result['counter'];

// Lấy trang hiện tại
$current_page = input_get('page');

// Lấy limit
$limit = 10;

// Lấy link
$link = create_link(base_url(), array(
    'controller' => 'list',
    'action' => 'getList',
    'page' => '{page}'
));

// Thực hiện phân trang
$paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách User
$sql = db_create_sql("SELECT * FROM tb_user WHERE level=1 LIMIT {$paging['start']}, {$paging['limit']}");
$users = db_get_list($sql);
include_once('views/admin/list.php');
 include_once('views/base/footer.php');
}
?>