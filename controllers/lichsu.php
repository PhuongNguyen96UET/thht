<?php if (!defined('IN_SITE')) die ('The request not found');
function getQuery(){
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $sql = "SELECT Code,Name FROM `services`";
    $cv = db_get_list($sql);
    include_once('views/base/header.php');
    include_once('views/lichsu/lichsu.php');
    include_once('views/base/footer.php');
}
function getData()
{

// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    include_once('views/base/header.php');
    $sql = "SELECT Code,Name FROM `services`";
    $cv = db_get_list($sql);

    $data = array(
        'c.Code' => input_post('Code'),
        'c.Name' => input_post('CustomerName'),
        'c.phone_number' => input_post('phone_number'),
        'h.service_id' => input_post('service_id'),
    );
    if(isset($data['c.Code']) && $data['c.Code'] == ''){unset($data['c.Code']);}
    if(isset($data['h.customer_id']) && $data['h.customer_id'] == ''){unset($data['h.customer_id']);}
    if(isset($data['c.phone_number']) && $data['c.phone_number'] == ''){unset($data['c.phone_number']);}
    if(isset($data['h.service_id']) && $data['h.service_id'] == ''){unset($data['h.service_id']);}
// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
    $sql = db_create_sql('SELECT count(id) as counter from history {where}');
    $result = db_get_row($sql);
    $total_records = $result['counter'];
    if($total_records = $result['counter']>20){$total_records = 20;}

// Lấy trang hiện tại
    $current_page = input_get('page');

// Lấy limit
    $limit = 10;

// Lấy link
    $link = create_link(base_url(), array(
        'controller' => 'lichsu',
        'action' => 'getData',
        'page' => '{page}'
    ));

// Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách các dịch vụ đã được sử dụng
    $sql = db_create_sql("
        Select h.id, c.Name as CustomerName, c.phone_number, sc.Name as SubcriptionName,
            s.Name as ServiceName, h.start_date, h.end_date, h.time_total, h.received_phone,
            if(h.time_total is null, 
                s.Unit_price, 
                h.time_total/60*(select b.unit_price from block_price b where b.service_id = h.service_id and (h.time_total between b.time_min and b.time_max))
            ) as total
    	FROM history h
    	LEFT join services s on h.service_id = s.Code
    	LEFT join customers c on h.customer_id = c.Code 
        INNER JOIN subcription sc on c.subscription_type = sc.Code
        {where} 
        ORDER BY h.start_date DESC 
        LIMIT {$paging['start']}, {$paging['limit']}"
    ,$data);

    $users = db_get_list($sql);
    include_once('views/lichsu/lichsu.php');
    include_once('views/lichsu/data.php');
    include_once('views/base/footer.php');
}
// xóa lịch sử
function delete_history(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_history'))
    {
        // Lấy ID và ép kiểu
        $id = input_post('ls_id');
        if ($id)
        {

            $sql = db_create_sql('DELETE FROM history {where}', array(
                'id' => $id
            ));

            if (db_execute($sql)){
                $ex=input_post('redirect');
                echo"
                    <script>
                        alert('Xóa thành công!');
                        window.location = '$ex';
                    </script>";
            }
            else{
                $ex=input_post('redirect');
                echo"
                    <script>
                        alert('Xóa thất bại!');
                        window.location = '$ex';
                    </script>";
            }
        }
        include_once('views/lichsu/lichsu.php');
        include_once('views/lichsu/data.php');
        include_once('views/base/footer.php');
    }
    else{
        // Nếu không phải submit delete user thì chuyển về trang chủ
        redirect(base_url());
    }
}

?>
