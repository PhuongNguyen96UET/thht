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

function logout(){
    // Xóa session login
    set_logout();

// Chuyển hướng sang trang login
    redirect(base_url('?cotroller=login&action=getUser'));
}
?>
