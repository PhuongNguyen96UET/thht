<?php if (!defined('IN_SITE')) die ('The request not found');
function getQuery(){
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $sql = "SELECT * FROM `service_types`";
    $cv = db_get_list($sql);
    $sql1 = "SELECT id,name FROM `status`";
    $cv1 = db_get_list($sql1);
    include_once('views/base/header.php');
    include_once('views/dichvu/dichvu.php');
    include_once('views/base/footer.php');
}
function getData()
{
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
        if (!is_logged()) {
            redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
        }
    $sql = "SELECT * FROM `service_types`";
    $cv = db_get_list($sql);
    $sql1 = "SELECT id,name FROM `status`";
    $cv1 = db_get_list($sql1);
        include_once('views/base/header.php');

// Nếu người dùng submit form
//if (is_submit('search_e')) {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            's.Code' => input_post('Code'),
            's.Name' => input_post('Name'),
            's.service_type_Id' => input_post('service_type_Id'),
            's.status_id' => input_post('status'),
        );

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
        if(isset($data['s.Code']) && $data['s.Code'] == ''){unset($data['s.Code']);}
        if(isset($data['s.Name']) && $data['s.Name'] == ''){unset($data['s.Name']);}
        if(isset($data['s.status_id']) && $data['s.status_id'] == ''){unset($data['s.status_id']);}
        if(isset($data['s.service_type_Id']) && $data['s.service_type_Id'] == ''){unset($data['s.service_type_Id']);}
        $sql = db_create_sql('SELECT count(Code) as counter from services {where}',$data);
        $result = db_get_row($sql);
        $total_records = $result['counter'];

// Lấy trang hiện tại
        $current_page = input_get('page');

// Lấy limit
        $limit = 10;

// Lấy link
        $link = create_link(base_url(), array(
            'controller' => 'dichvu',
            'action' => 'getData',
            'page' => '{page}'
        ));

// Thực hiện phân trang
        $paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách User
        $sql =db_create_sql("SELECT s.Code,s.Name,status.name as status, s.desciption,s.Unit_price,s.syntax_id, st.Name as type,syntax.syntax,syntax.register_number
                                FROM services s 
                                LEFT JOIN service_types st ON s.service_type_Id=st.Code
                                LEFT JOIN status ON s.status_id=status.id
                                LEFT JOIN syntax ON s.syntax_id= syntax.id {where} ORDER BY s.Code ASC LIMIT {$paging['start']}, {$paging['limit']}",$data);
        $users = db_get_list($sql);
//}
        include_once('views/dichvu/dichvu.php');
        include_once('views/dichvu/data.php');
        include_once('views/base/footer.php');
}
function addDV(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }


    $sql = "SELECT * FROM `service_types`";
    $cv = db_get_list($sql);
    $sql1 = "SELECT id,name FROM `status`";
    $cv1 = db_get_list($sql1);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_s'))
    {
        $setid='SELECT MAX(id)+1 as id from syntax';
        $id=db_get_row($setid);
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'status_id'  => input_post('status_id'),
            'desciption'     => input_post('desciption'),
            'Unit_price'  => input_post('Unit_price'),
            'service_type_Id'     => input_post('service_type_Id'),
            'syntax_id'     => $id['id'],
        );

        $syntax = array(
            'syntax'  => input_post('syntax'),
            'register_number'  => input_post('register_number'),
            'id'  => $id['id'],
            'desciption'  => '',
        );
        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_dv_validate($data,$syntax);

        // Nếu validate không có lỗi
        if (!$error)
        {
//
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_insert('syntax',$syntax)){
                if(db_insert('services', $data)){
                $link= create_link(base_url(), array('controller' => 'dichvu', 'action' => 'getData'));
                echo"
            <script>
                alert('Thêm dịch vụ thành công!');
                window.location = '$link';
            </script>";
                die();
                }
            }
        }
    }

    include_once('views/base/header.php');

    include_once('views/dichvu/add.php');

    include_once('views/base/footer.php');
}
function deleteDV(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_s'))
    {
        // Lấy ID và ép kiểu
        $id = input_post('dv_id');
        if ($id)
        {

            $sql = db_create_sql('DELETE FROM syntax {where}', array(
                'id' => $id
            ));
            $sql1 = db_create_sql('DELETE FROM services {where}', array(
                'syntax_id' => $id
            ));
            if (db_execute($sql1)){
                if (db_execute($sql)) {
                    $ex = input_post('redirect');
                    echo "
                        <script>
                            alert('Xóa thành công!');
                            window.location = '$ex';
                        </script>";
                }
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
function editDV(){
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql = "SELECT * FROM `service_types`";
    $cv = db_get_list($sql);
    $sql1 = "SELECT id,name FROM `status`";
    $cv1 = db_get_list($sql1);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    $field=array();

    if (is_submit('edit_dv')) {
        // Lấy danh sách dữ liệu từ form
        $codenv = input_post('dv_id');
        $sql = "SELECT s.Code,s.Name,s.status_id,s.desciption,s.Unit_price,s.service_type_Id,s.syntax_id,syntax.syntax,syntax.register_number FROM services s LEFT JOIN syntax ON s.syntax_id= syntax.id where s.syntax_id='$codenv'";
        $data=db_get_row($sql);
        $field['Code']=$data['Code'];
        $field['Name']=$data['Name'];
        $syntax['register_number']=$data['register_number'];
        $syntax['syntax']=$data['syntax'];
        $field['syntax']=$data['syntax'];
    }

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('edit_s'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'status_id'  => input_post('status_id'),
            'desciption'     => input_post('desciption'),
            'Unit_price'  => input_post('Unit_price'),
            'service_type_Id'     => input_post('service_type_Id'),
            'syntax_id'     => input_post('syntax_id'),
        );

        $syntax = array(
            'syntax'  => input_post('syntax'),
            'register_number'  => input_post('register_number'),
            'id'  => input_post('syntax_id'),
            'desciption'  => '',
        );
        $field['Code']=input_post('Code_hidden');
        $field['Name']=input_post('Name_hidden');
        $field['syntax']=input_post('syntax_hidden');
        $value=input_post('syntax_id');

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_dv_edit_validate($data,$syntax,$field);
//         Nếu validate không có lỗi
        if (!$error)
        {

//             Nếu insert thành công thì thông báo
//             và chuyển hướng về trang danh sách user
            if (db_update('services', $data,'syntax_id',$value)){
                if (db_update('syntax', $syntax,'id',$value)) {
                    $link= create_link(base_url(), array('controller' => 'dichvu', 'action' => 'getData'));

                    echo"
                <script>
                    alert('Sửa thành công!');
                    window.location = '$link';
                </script>";
                    die();
                }
            }
        }
    }
    include_once('views/base/header.php');
    include_once('views/dichvu/edit.php');
    include_once('views/base/footer.php');
}
?>
