    <?php if (!defined('IN_SITE')) die ('The reqvertrigouest not found'); ?>
<?php
function addUser(){
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }


// Thiết lập font chữ UTF8 để khỏi bị lõi font
//    header('Content-Type: text/html; charset=utf-8');

// Biến chứa lỗi
    $error = array();

// VI TRI 1: CODE SUBMIT FORM
// Nếu người dùng submit form
    if (is_submit('add_user'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'username'  => input_post('username'),
            'password'  => input_post('password'),
            're-password'  => input_post('re-password'),
            // 'email'     => input_post('email'),
            'fullname'  => input_post('fullname'),
            'level'     => input_post('level'),
        );

        // require file xử lý database cho user
        require_once('models/user.php');

        // Thực hiện validate
        $error = db_user_validate($data);

        // Nếu validate không có lỗi
        if (!$error)
        {
            // Xóa key re-password ra khoi $data
            unset($data['re-password']);
            $data['password']=md5($data['password']);
            // Nếu insert thành công thì thông báo
            // và chuyển hướng về trang danh sách user
            if (db_insert('tb_user', $data)){
                $link= create_link(base_url(), array('controller' => 'list', 'action' => 'getList'));
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

    include_once('views/admin/add.php');

    include_once('views/base/footer.php');
}
function deleteUser(){
    // Thiết lập font chữ UTF8 để khỏi bị lõi font
    header('Content-Type: text/html; charset=utf-8');

// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url('admin'), array('controller' => 'login', 'action' => 'logout'));
    }

// Nếu người dùng submit delete user
    if (is_submit('delete_user'))
    {
        // Lấy ID và ép kiểu
        $id = (int)input_post('user_id');
        if ($id)
        {
            // Lấy thông tin người dùng
            $user = db_get_row(db_create_sql('SELECT * FROM tb_user {where}', array(
                'id' => $id
            )));

            // Kiểm tra có phải xóa admin hay không
            if ($user['username'] == 'Admin'){
                $ex=input_post('redirect');
                echo"
                    <script>
                        alert('Bạn không thể xóa Supper Admin được!');
                        window.location = '$ex';
                    </script>";
            }
            else
            {
                $sql = db_create_sql('DELETE FROM tb_user {where}', array(
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
        }
    }
    else{
        // Nếu không phải submit delete user thì chuyển về trang chủ
        redirect(base_url());
    }
}
function editUser(){
    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_supper_admin()){
        redirect(base_url('admin'), array('controller' => 'login', 'action' => 'logout'));
    }
    include_once('views/admin/edit.php');
}
?>