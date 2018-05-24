<?php if (!defined('IN_SITE')) die ('The request not found');
function getQuery(){
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $sql = "SELECT Code,Name FROM `subcription`";
    $cv = db_get_list($sql);
    include_once('views/base/header.php');
    include_once('views/khachhang/khachhang.php');
    include_once('views/base/footer.php');
}
function getData()
{
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $sql = "SELECT id,username FROM `subcription`";
    $cv = db_get_list($sql);
    include_once('views/base/header.php');

// Nếu người dùng submit form
//if (is_submit('search_e')) {
    // Lấy danh sách dữ liệu từ form
    $data = array(
        'customers.id' => input_post('id'),
        'customers.fullname' => input_post('fullname'),
        'customers.phone' => input_post('phone'),
        'customers.email' => input_post('email'),
    );

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
    if(isset($data['id']) && $data['id'] == ''){unset($data['id']);}
    if(isset($data['fullname']) && $data['fullname'] == ''){unset($data['fullname']);}
    if(isset($data['phone']) && $data['number'] == ''){unset($data['phone']);}
    if(isset($data['email']) && $data['email'] == ''){unset($data['email']);}
   $sql = db_create_sql('SELECT count(id) as counter from users_cus {where}',$data);
    $result = db_get_row($sql);
    $total_records = $result['counter'];

// Lấy trang hiện tại
    $current_page = input_get('page');

// Lấy limit
    $limit = 10;

// Lấy link
    $link = create_link(base_url(), array(
        'controller' => 'khachhang',
        'action' => 'getData',
        'page' => '{page}'
    ));

// Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

// Lấy danh sách User
    $sql =db_create_sql("SELECT users_cus.id,users_cus.fullname,users_cus.username,users_cus.phone,users_cus.email,users_cus.address FROM users_cus  {where} LIMIT {$paging['start']}, {$paging['limit']}",$data);
    $users = db_get_list($sql);
//}
    include_once('views/khachhang/khachhang.php');
    include_once('views/khachhang/data.php');
    include_once('views/base/footer.php');
}
function addKH(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql = "SELECT id,fullname FROM `subcription`";
    $cv = db_get_list($sql);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_c'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            // 'id'  => input_post('id'),
            'fullname'  => input_post('fullname'),
            'username'  => input_post('username'),
            'phone'     => input_post('phone'),
            'email'  => input_post('email'),
            'address'     => input_post('address'),
            "password"  => input_post("password"),
            're-password'  => input_post('re-password'),
        );

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_kh_validate($data);

        // Nếu validate không có lỗi
        if (!$error)
        {
            unset($data['re-password']);
            $data['password']=md5($data['password']);
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_insert('users_cus', $data)){
                $link= create_link(base_url(), array('controller' => 'users_cus', 'action' => 'getData'));
                echo"
            <script>
                alert('Thêm người dùng thành công!');
                window.location = '$link';
            </script>";
                die();
            }
        }
    }

    include_once('views/base/header.php');

    include_once('views/khachhang/add.php');

    include_once('views/base/footer.php');
}
function delete_customer(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_customer'))
    {
        // Lấy ID và ép kiểu
        $id = input_post('kh_id');
        if ($id)
        {

            $sql = db_create_sql('DELETE FROM users_cus {where}', array(
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
        include_once('views/khachhang/khachhang.php');
        include_once('views/khachhang/data.php');
        include_once('views/base/footer.php');
    }
    else{
        // Nếu không phải submit delete user thì chuyển về trang chủ
        redirect(base_url());
    }
}
function editKH(){
    if (!is_supper_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }

    $sql = "SELECT id,fullname FROM `subcription`";
    $cv = db_get_list($sql);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    $field=array();

    if (is_submit('edit_kh')) {
        // Lấy danh sách dữ liệu từ form
        $codenv = input_post('kh_id');
        $sql = "select * from users_cus where id='$codenv'";
        $data=db_get_row($sql);
        $field['id']=$data['id'];
        $field['phone']=$data['phone'];
        $field['email']=$data['email'];
    }

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('edit_c'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            // 'Code'  => input_post('Code'),
            'fullname'  => input_post('fullname'),
            // 'username'  => input_post('username'),
            'phone'     => input_post('phone'),
            'email'  => input_post('email'),
            'address'     => input_post('address'),
        );
        $field['id']=input_post('id_hidden');
        $field['phone']=input_post('phone_hidden');
        $field['email']=input_post('email_hidden');
        $value=input_post('id_hidden');

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_kh_edit_validate($data,$field);
//         Nếu validate không có lỗi
        if (!$error)
        {

//             Nếu insert thành công thì thông báo
//             và chuyển hướng về trang danh sách user
            if (db_update('users_cus', $data,'Code',$value)){
                $link= create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getData'));

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
    include_once('views/khachhang/edit.php');
    include_once('views/base/footer.php');
}
function process(){
    if (!is_logged()) {
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    $id=input_get("Code");
    $sql='SELECT s.Name,c.Name as customersName,st.Name as type,s.Unit_price,s.desciption,p.start_date
    FROM process p
    INNER JOIN customers c ON p.customer_id = c.Code
    INNER JOIN services s ON p.service_id=s.Code
    INNER JOIN service_types st ON s.service_type_Id=st.Code
    WHERE p.customer_id='.$id;
    $users=db_get_list($sql);
    include_once('views/khachhang/process.php');
};
?>
