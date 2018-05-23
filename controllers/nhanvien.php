<?php if (!defined('IN_SITE')) die ('The request not found');
function getQuery(){
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    include_once('views/base/header.php');
    include_once('views/nhanvien/nhanvien.php');
    include_once('views/base/footer.php');
}
function getData()
{
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    include_once('views/base/header.php');

// Nếu người dùng submit form
//if (is_submit('search_e')) {
    // Lấy danh sách dữ liệu từ form
    $data = array(
        'Code' => input_post('Code'),
        'Name' => input_post('Name'),
    );

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
    $where=null;
    if($data['Code'] != NULL){
        if($data['Name'] != NULL){
            $where = 'where e.Code='.$data['Code'].'AND Name='.$data['Name'];
        }
        $where =  'where Code='.$data['Code'];
    }elseif ($data['Name'] != NULL)
    {
        $where = "where e.Name='".$data['Name']."'";
    }

    $sql ='SELECT count(Code) as counter from employees e'.$where.';';
    $result = db_get_row($sql);
    $total_records = $result['counter'];

// Lấy trang hiện tại
    $current_page = input_get('page');

// Lấy limit
    $limit = 10;

// Lấy link
    $link = create_link(base_url(), array(
        'controller' => 'nhanvien',
        'action' => 'getData',
        'page' => '{page}'
    ));

// Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách User
    $sql = "select e.Code,e.Name,j.name,e.Phone_Number,e.Address,e.Email from employees  e LEFT JOIN jobs j on e.job_id=j.id $where LIMIT {$paging['start']}, {$paging['limit']}";
    $users = db_get_list($sql);
//}
    include_once('views/nhanvien/nhanvien.php');
    include_once('views/nhanvien/data.php');
    include_once('views/base/footer.php');
}
function addNV(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql = "SELECT id,name FROM `jobs`";
    $cv = db_get_list($sql);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_e'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'Phone_Number'  => input_post('Phone_Number'),
            'Address'     => input_post('Address'),
            'job_id'  => input_post('job_id'),
            'Email'     => input_post('Email'),
        );

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_nv_validate($data);

        // Nếu validate không có lỗi
        if (!$error)
        {
//
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_insert('employees', $data)){
                $link= create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getData'));
                echo"
            <script>
                alert('Thêm nhân viên thành công!');
                window.location = '$link';
            </script>";
                die();
            }

        }
    }

    include_once('views/base/header.php');

    include_once('views/nhanvien/add.php');

    include_once('views/base/footer.php');
}
function deleteNV(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_nv'))
    {
        // Lấy ID và ép kiểu
        $id = input_post('nv_id');
        if ($id)
        {

                $sql = db_create_sql('DELETE FROM employees {where}', array(
                    'Code' => $id
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
function editNV(){
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql = "SELECT id,name FROM `jobs`";
    $cv = db_get_list($sql);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    $field=array();

if (is_submit('edit_nv')) {
    // Lấy danh sách dữ liệu từ form
    $codenv = input_post('nv_id');
    $sql = "select * from employees where Code='$codenv'";
    $data=db_get_row($sql);
    $field['Code']=$data['Code'];
    $field['Email']=$data['Email'];
}

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('edit_e'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'Phone_Number'  => input_post('Phone_Number'),
            'Address'     => input_post('Address'),
            'job_id'  => input_post('job_id'),
            'Email'     => input_post('Email'),
        );
        $field['Code']=input_post('Code_hidden');
        $field['Email']=input_post('Email_hidden');
        $value=input_post('Code_hidden');

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_nv_edit_validate($data,$field);
//         Nếu validate không có lỗi
        if (!$error)
        {

//             Nếu insert thành công thì thông báo
//             và chuyển hướng về trang danh sách user
            if (db_update('employees', $data,'Code',$value)){
                $link= create_link(base_url(), array('controller' => 'nhanvien', 'action' => 'getData'));

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
    include_once('views/nhanvien/edit.php');
    include_once('views/base/footer.php');
}
?>
