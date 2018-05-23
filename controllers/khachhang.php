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
    $sql = "SELECT Code,Name FROM `subcription`";
    $cv = db_get_list($sql);
    include_once('views/base/header.php');

// Nếu người dùng submit form
//if (is_submit('search_e')) {
    // Lấy danh sách dữ liệu từ form
    $data = array(
        'customers.Code' => input_post('Code'),
        'customers.Name' => input_post('Name'),
        'customers.phone_number' => input_post('phone_number'),
        'customers.subscription_type' => input_post('subscription_type'),
    );

// VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG
// Tìm tổng số records
    if(isset($data['Code']) && $data['Code'] == ''){unset($data['Code']);}
    if(isset($data['Name']) && $data['Name'] == ''){unset($data['Name']);}
    if(isset($data['phone_number']) && $data['phone_number'] == ''){unset($data['phone_number']);}
    if(isset($data['subscription_type']) && $data['subscription_type'] == ''){unset($data['subscription_type']);}
   $sql = db_create_sql('SELECT count(Code) as counter from customers {where}',$data);
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
    $sql =db_create_sql("SELECT customers.Code,customers.Name,customers.date_of_birth,customers.phone_number,customers.email,customers.Address,subcription.Name as subcription FROM customers LEFT JOIN subcription ON customers.subscription_type=subcription.Code {where} LIMIT {$paging['start']}, {$paging['limit']}",$data);
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

    $sql = "SELECT Code,Name FROM `subcription`";
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
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'date_of_birth'  => input_post('date_of_birth'),
            'phone_number'     => input_post('phone_number'),
            'email'  => input_post('email'),
            'Address'     => input_post('Address'),
            'subscription_type'     => input_post('subscription_type'),
        );

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_kh_validate($data);

        // Nếu validate không có lỗi
        if (!$error)
        {
//
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_insert('customers', $data)){
                $link= create_link(base_url(), array('controller' => 'khachhang', 'action' => 'getData'));
                echo"
            <script>
                alert('Thêm khách hàng thành công!');
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

            $sql = db_create_sql('DELETE FROM customers {where}', array(
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

    $sql = "SELECT Code,Name FROM `subcription`";
    $cv = db_get_list($sql);

// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    $field=array();

    if (is_submit('edit_kh')) {
        // Lấy danh sách dữ liệu từ form
        $codenv = input_post('kh_id');
        $sql = "select * from customers where Code='$codenv'";
        $data=db_get_row($sql);
        $field['Code']=$data['Code'];
        $field['phone_number']=$data['phone_number'];
        $field['email']=$data['email'];
    }

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('edit_c'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'Code'  => input_post('Code'),
            'Name'  => input_post('Name'),
            'date_of_birth'  => input_post('date_of_birth'),
            'phone_number'     => input_post('phone_number'),
            'email'  => input_post('email'),
            'Address'     => input_post('Address'),
            'subscription_type'     => input_post('subscription_type'),
        );
        $field['Code']=input_post('Code_hidden');
        $field['phone_number']=input_post('phone_number_hidden');
        $field['email']=input_post('email_hidden');
        $value=input_post('Code_hidden');

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_kh_edit_validate($data,$field);
//         Nếu validate không có lỗi
        if (!$error)
        {

//             Nếu insert thành công thì thông báo
//             và chuyển hướng về trang danh sách user
            if (db_update('customers', $data,'Code',$value)){
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
