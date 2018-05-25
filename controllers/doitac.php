<?php if (!defined('IN_SITE')) die ('The request not found');
function getQuery(){
//    if (!is_logged()) {
//        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
//    }


    include_once('views/base/header.php');
    include_once('views/doitac/doitac.php');
    include_once('views/base/footer.php');
}
function getData()
{
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $sql1 = "SELECT id,name FROM `status`";
    $cv = db_get_list($sql1);
    include_once('views/base/header.php');

// Nếu người dùng submit form
//if (is_submit('search_e')) {
    // Lấy danh sách dữ liệu từ form
    $data = array(
        'partner.ID' => input_post('ID'),
        'partner.Shortname' => input_post('Shortname'),
        'partner.status_id' => input_post('status_id'),
    );

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
    if(isset($data['ID']) && $data['ID'] == ''){unset($data['ID']);}
    if(isset($data['Shortname']) && $data['Shortname'] == ''){unset($data['Shortname']);}
    if(isset($data['status_id']) && $data['status_id'] == ''){unset($data['status_id']);}
    //if(isset($data['s.service_type_Id']) && $data['s.service_type_Id'] == ''){unset($data['s.service_type_Id']);}
    $sql = db_create_sql('SELECT count(ID) as counter from partner {where}',$data);
    $result = db_get_row($sql);
    $total_records = $result['counter'];

// Lấy trang hiện tại
    $current_page = input_get('page');

// Lấy limit
    $limit = 10;

// Lấy link
    $link = create_link(base_url(), array(
        'controller' => 'doitac',
        'action' => 'getData',
        'page' => '{page}'
    ));

// Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách User
    $sql =db_create_sql("SELECT p.*,status.name FROM partner p LEFT JOIN status ON p.status_id=status.id {where} ORDER BY p.ID ASC LIMIT {$paging['start']}, {$paging['limit']}",$data);
    $users = db_get_list($sql);
//}
    include_once('views/doitac/doitac.php');
    include_once('views/doitac/data.php');
    include_once('views/base/footer.php');
}
function addDT(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }


    $sql1 = 'SELECT id,name FROM `status`';
    $cv = db_get_list($sql1);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_p'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'ID'  => input_post('ID'),
            'Shortname'  => input_post('Shortname'),
            'Fullname'  => input_post('Fullname'),
            'Description'     => input_post('Description'),
            'start_date'  => input_post('start_date'),
            'end_date'     => input_post('end_date'),
            'status_id'     => input_post('status_id'),
            'email'     => input_post('email'),
            'contact'     => input_post('contact'),
        );

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_dt_validate($data);

        if (isset($data['end_date']) && $data['end_date'] == ''){
            unset($data['end_date']);
        }
        // Nếu validate không có lỗi
        if (!$error)
        {
//
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_insert('partner',$data)){
                $link= create_link(base_url(), array('controller' => 'doitac', 'action' => 'getData'));
                echo"
                <script>
                     alert('Thêm dịch vụ thành công!');
                     window.location = '$link';
                </script>";
                die();
            }
        }
    }

    include_once('views/base/header.php');

    include_once('views/doitac/add.php');

    include_once('views/base/footer.php');
}
function deleteDT(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_dt'))
    {
        // Lấy ID và ép kiểu
        $id = input_post('dt_id');
        if ($id)
        {

            $sql = db_create_sql('DELETE FROM partner {where}', array(
                'ID' => $id
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
    }
    else{
        // Nếu không phải submit delete user thì chuyển về trang chủ
        redirect(base_url());
    }
}
function editDT(){
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql1 = "SELECT id,name FROM `status`";
    $cv = db_get_list($sql1);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    $field=array();

    if (is_submit('edit_dt')) {
        // Lấy danh sách dữ liệu từ form
        $codenv = input_post('dt_id');
        $sql = "select * from partner where ID='$codenv'";
        $data=db_get_row($sql);
        $field['ID']=$data['ID'];
        $field['Shortname']=$data['Shortname'];
        $field['Fullname']=$data['Fullname'];
        $field['email']=$data['email'];
    }

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('edit_p'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'ID'  => input_post('ID'),
            'Shortname'  => input_post('Shortname'),
            'Fullname'  => input_post('Fullname'),
            'Description'     => input_post('Description'),
            'start_date'  => input_post('start_date'),
            'end_date'     => input_post('end_date'),
            'status_id'     => input_post('status_id'),
            'email'     => input_post('email'),
            'contact'     => input_post('contact'),
        );
        $field['ID']=input_post('ID_hidden');
        $field['Shortname']=input_post('Shortname_hidden');
        $field['Fullname']=input_post('Fullname_hidden');
        $field['email']=input_post('email_hidden');
        $value=input_post('ID_hidden');

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_dt_edit_validate($data,$field);
//         Nếu validate không có lỗi
        if (!$error)
        {
//            if (isset($data['end_date']) && $data['end_date'] == ''){unset($data['end_date']);}
//            if (isset($data['Description']) && $data['Description'] == ''){unset($data['Description']);}
//             Nếu insert thành công thì thông báo
//             và chuyển hướng về trang danh sách user
            if (db_update('partner', $data,'ID',$value)){
                $link= create_link(base_url(), array('controller' => 'doitac', 'action' => 'getData'));

                echo"
            <script>
                alert('Sửa thành công!');
                window.location = '$link';
            </script>";
                die();
            }
        }
    }
    include_once('views/base/header.php');
    include_once('views/doitac/edit.php');
    include_once('views/base/footer.php');
}
?>
