<?php
function getUser()
{
    $error = array();

// BƯỚC 1: KIỂM TRA NẾU LÀ ADMIN THÌ REDIRECT
    if (is_logged()) {
        redirect(base_url('?controller=dashboard&action=getDashBoard'));
    }

// BƯỚC 2: NẾU NGƯỜI DÙNG SUBMIT FORM
    if (is_submit('login')) {
        // lấy tên đăng nhập và mật khẩu
        $username = input_post('username');
        $password = input_post('password');


        // Nếu không có lỗi
        if (!$error) {
            // include file xử lý database user
            include_once('models/user.php');

            // lấy thông tin user theo username
            $user = db_user_get_by_username($username);

            // Nếu không có kết quả
            if (empty($user)) {
                $error['username'] = 'Tên đăng nhập không đúng';
            } // nếu có kết quả nhưng sai mật khẩu
            else if ($user['password'] != md5($password)) {
                $error['password'] = 'Mật khẩu bạn nhập không đúng';
            }

            // nếu mọi thứ ok thì tức là đăng nhập thành công
            // nên thực hiện redirect sang trang chủ
            if (!$error) {
                set_logged($user['username'], $user['level']);
                redirect(base_url('?controller=dashboard&action=getDashBoard'));
            }
        }
    }
    require_once('views/Login.php');
}

function setting(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }


// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    // require file xử lý database cho user
    require_once('models/user.php');

    $user=db_user_get_1_by_username(get_current_username());
//    print_r($user);
// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_c'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(

            'fullname'  => input_post('fullname'),
            'username'  => input_post('username'),
            'phone'     => input_post('phone'),
            'email'  => input_post('email'),
            'address'     => input_post('address'),
        );

        $result=array_diff($data,$user);
//        print_r($result);
        // Thực hiện validate
        $error = db_kh_validate($result);

        // Nếu validate không có lỗi
        if (!$error)
        {
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_update('tb_user', $result,'username',get_current_username())){
                $link= create_link(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard'));
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
function logout(){
    // Xóa session login
    set_logout();

// Chuyển hướng sang trang login
    redirect(base_url('?cotroller=dashboard&action=getDashBoard'));
}
function register(){
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
            if (db_insert('tb_user', $data)){
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
    require_once('views/register.php');
}

function changepass(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }


// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

    // require file xử lý database cho user
    require_once('models/user.php');


//    print_r($user);
// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_c'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            "password"  => input_post("password"),
            're-password'  => input_post('re-password'),
        );


//        print_r($result);
        // Thực hiện validate
        $error = db_kh_validate($data);

        // Nếu validate không có lỗi
        if (!$error)
        {
            unset($data['re-password']);
            $data['password']=md5($data['password']);
//            // Nếu insert thành công thì thông báo
//            // và chuyển hướng về trang danh sách user
            if (db_update('tb_user', $data,'username',get_current_username())){
                $link= create_link(base_url(), array('controller' => 'dashboard', 'action' => 'getDashBoard'));
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

    include_once('views/khachhang/changepass.php');

    include_once('views/base/footer.php');
}

?>
