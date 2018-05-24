<?php if (!defined('IN_SITE')) die ('The request not found');

function db_user_get_by_username($username){
    $username = addslashes($username);
    $sql = "SELECT * FROM tb_user where username = '{$username}'";
    return db_get_row($sql);
}


// Hàm validate dữ liệu bảng User
function db_user_validate($data)
{
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['username']) && $data['username'] == ''){
        $error['username'] = 'Bạn chưa nhập tên đăng nhập';
    }

    // Email
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập email';
    }
    if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['password']) && $data['password'] == ''){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }

    // Re-password
    if (isset($data['password']) && isset($data['re-password']) && $data['password'] != $data['re-password']){
        $error['re-password'] = 'Mật khẩu nhập lại không đúng';
    }

    // Level
    if (isset($data['level']) && !in_array($data['level'], array('1', '2'))){
        $error['level'] = 'Chọn loại người dùng';
    }

    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (isset($data['username']) && $data['username']!=''){
        $sql = "SELECT count(id) as counter FROM tb_user WHERE username='".addslashes($data['username'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['username'] = 'Tên đăng nhập này đã tồn tại';
        }
    }

    // Email
    if (isset($data['email']) && $data['email']!=''){
        $sql = "SELECT count(id) as counter FROM tb_user WHERE email='".addslashes($data['email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['email'] = 'Email này đã tồn tại';
        }
    }

    return $error;
}

function db_nv_validate($data)
{
    $jobs = array();
    $sql = "SELECT id,name FROM `jobs`";
    $exam = db_get_list($sql);

    foreach ($exam as $item){
    $jobs[]=$item['id'];
}
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['Code']) && $data['Code'] == ''){
        $error['Code'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Name']) && $data['Name'] == ''){
        $error['Name'] = 'Bạn chưa nhập tên';
    }
    if (isset($data['Email']) && $data['Email'] == ''){
        $error['Email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['Email']) && filter_var($data['Email'], FILTER_VALIDATE_EMAIL) === false){
        $error['Email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['Phone_Number']) && $data['Phone_Number'] == ''){
        $error['Phone_Number'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['Phone_Number']) && $data['Phone_Number'] !=''){
        if(!is_phone($data['Phone_Number']))
        $error['Phone_Number'] = 'Số điện thoại không hợp lệ';
    }

    if (isset($data['Address']) && $data['Address'] == ''){
        $error['Address'] = 'Bạn chưa nhập địa chỉ';
    }

    if (isset($data['job_id']) && !in_array($data['job_id'], $jobs)){
        $error['job_id'] = 'Level bạn chọn không tồn tại';
    }


    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (isset($data['Code']) && $data['Code']!=''){
        $sql = "SELECT count(Code) as counter FROM employees WHERE Code='".addslashes($data['Code'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Code'] = 'Mã nhân viên này đã tồn tại';
        }
    }

    // Email
    if (isset($data['Email']) && $data['Email']!=''){
        $sql = "SELECT count(Code) as counter FROM employees WHERE Email='".addslashes($data['Email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Email'] = 'Email này đã tồn tại';
        }
    }

    return $error;
}

function is_phone($phone) {
    $phone = preg_replace('/[^\d]+/', '', $phone);
    $num_digits = strlen($phone);
    if($num_digits == 10 || $num_digits == 11) {
        return $phone;
    } else {
        return FALSE;
    }
}

function db_nv_edit_validate($data,$field=array())
{
    $jobs = array();
    $sql = "SELECT id,name FROM `jobs`";
    $exam = db_get_list($sql);

    foreach ($exam as $item){
        $jobs[]=$item['id'];
    }
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['Code']) && $data['Code'] == ''){
        $error['Code'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Name']) && $data['Name'] == ''){
        $error['Name'] = 'Bạn chưa nhập tên';
    }
    if (isset($data['Email']) && $data['Email'] == ''){
        $error['Email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['Email']) && filter_var($data['Email'], FILTER_VALIDATE_EMAIL) === false){
        $error['Email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['Phone_Number']) && $data['Phone_Number'] == ''){
        $error['Phone_Number'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['Phone_Number']) && $data['Phone_Number'] !=''){
        if(!is_phone($data['Phone_Number']))
            $error['Phone_Number'] = 'Số điện thoại không hợp lệ';
    }

    if (isset($data['Address']) && $data['Address'] == ''){
        $error['Address'] = 'Bạn chưa nhập địa chỉ';
    }

    if (isset($data['job_id']) && !in_array($data['job_id'], $jobs)){
        $error['job_id'] = 'Level bạn chọn không tồn tại';
    }


    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if($data['Code']!=$field['Code']) {
        if (isset($data['Code']) && $data['Code_hidden'] != '') {
            $sql = "SELECT count(Code) as counter FROM employees WHERE Code='" . addslashes($data['Code']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Code'] = 'Mã nhân viên này đã tồn tại';
            }
        }
    }
    // Email
    if($data['Email']!=$field['Email']) {
        if (isset($data['Email']) && $data['Email'] != '') {
            $sql = "SELECT count(Code) as counter FROM employees WHERE Email='" . addslashes($data['Email']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Email'] = 'Email này đã tồn tại';
            }
        }
    }
    return $error;
}

function db_kh_validate($data)
{
    $jobs = array();
    $sql = "SELECT Code,Name FROM `subcription`";
    $exam = db_get_list($sql);

    foreach ($exam as $item){
        $jobs[]=$item['Code'];
    }
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username

    // Email
    if (isset($data['fullname']) && $data['fullname'] == ''){
        $error['fullname'] = 'Bạn chưa nhập tên khách hàng';
    }

    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['phone']) && $data['phone'] == ''){
        $error['phone'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['phone']) && $data['phone'] !=''){
        if(!is_phone($data['phone']))
            $error['phone'] = 'Số điện thoại không hợp lệ';
    }

    if (isset($data['username']) && $data['username'] == ''){
        $error['username'] = 'Bạn chưa nhập tên người dùng';
    }
    if (isset($data['address']) && $data['address'] == ''){
        $error['address'] = 'Bạn chưa nhập địa chỉ';
    }
    // Password
    if (isset($data['password']) && $data['password'] == ''){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }

    // Re-password
    if (isset($data['password']) && isset($data['re-password']) && $data['password'] != $data['re-password']){
        $error['re-password'] = 'Mật khẩu nhập lại không đúng';
    }

    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (isset($data['username']) && $data['username']!=''){
        $sql = "SELECT count(Code) as counter FROM users_cus WHERE username='".addslashes($data['username'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['username'] = 'Tài khoản này đã được đăng ký';
        }
    }


    if (isset($data['phone']) && $data['phone']!=''){
        $sql = "SELECT count(Code) as counter FROM users_cus WHERE phone_number='".addslashes($data['phone'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['phone'] = 'Số điện thoại này đã được đăng ký';
        }
    }

    // Email
    if (isset($data['email']) && $data['email']!=''){
        $sql = "SELECT count(id) as counter FROM users_cus WHERE email='".addslashes($data['email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['email'] = 'Email này đã tồn tại';
        }
    }

    return $error;
}

function db_kh_edit_validate($data,$field=array())
{
    $jobs = array();
    $sql = "SELECT Code,Name FROM `subcription`";
    $exam = db_get_list($sql);

    foreach ($exam as $item){
        $jobs[]=$item['Code'];
    }
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['Code']) && $data['Code'] == ''){
        $error['Code'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Name']) && $data['Name'] == ''){
        $error['Name'] = 'Bạn chưa nhập tên';
    }
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }
    if (isset($data['date_of_birth']) && $data['date_of_birth'] == '') {
        $error['date_of_birth'] = 'Bạn chưa nhập ngày sinh';
    }
    // Password
    if (isset($data['phone_number']) && $data['phone_number'] == ''){
        $error['phone_number'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['phone_number']) && $data['phone_number'] !=''){
        if(!is_phone($data['phone_number']))
            $error['phone_number'] = 'Số điện thoại không hợp lệ';
    }

    if (isset($data['Address']) && $data['Address'] == ''){
        $error['Address'] = 'Bạn chưa nhập địa chỉ';
    }

    if (isset($data['subscription_type']) && !in_array($data['subscription_type'], $jobs)){
        $error['subscription_type'] = 'Loại đăng ký không tồn tại';
    }


    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if($data['Code']!=$field['Code']) {
        if (isset($data['Code']) && $data['Code'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE Code='" . addslashes($data['Code']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Code'] = 'Khách hàng này đã tồn tại';
            }
        }
    }
    // Email
    if($data['email']!=$field['email']) {
        if (isset($data['email']) && $data['email'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE email='" . addslashes($data['email']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['email'] = 'Email này đã tồn tại';
            }
        }
    }
    if($data['phone_number']!=$field['phone_number']) {
        if (isset($data['phone_number']) && $data['phone_number'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE phone_number='" . addslashes($data['phone_number']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['phone_number'] = 'Số điện thoại đã được đăng ký';
            }
        }
    }
    return $error;
}

function db_dv_validate($data,$syntax)
{
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['Code']) && $data['Code'] == ''){
        $error['Code'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Name']) && $data['Name'] == ''){
        $error['Name'] = 'Bạn chưa nhập tên';
    }
    if (isset($data['status_id']) && $data['status_id'] == ''){
        $error['status_id'] = 'Bạn chưa nhập trạng thái';
    }
    if (isset($data['desciption']) && $data['desciption'] == ''){
        $error['desciption'] = 'Bạn chưa nhập mô tả';
    }

    // Password
    if (isset($data['Unit_price']) && $data['Unit_price'] == ''){
        $error['Unit_price'] = 'Bạn chưa nhập giá dịch vụ';
    }

    if (isset($data['Address']) && $data['Address'] == ''){
        $error['Address'] = 'Bạn chưa nhập địa chỉ';
    }

    if (isset($data['service_type_Id']) && $data['service_type_Id']==''){
        $error['service_type_Id'] = 'Bạn chưa nhập loại dịch vụ';
    }
    if (isset($syntax['syntax']) && $syntax['syntax']==''){
        $error['syntax'] = 'Bạn chưa nhập cú pháp';
    }

    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (isset($data['Code']) && $data['Code']!=''){
        $sql = "SELECT count(Code) as counter FROM services WHERE Code='".addslashes($data['Code'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Code'] = 'Mã dịch vụ này đã tồn tại';
        }
    }

    if (isset($data['Name']) && $data['Name']!=''){
        $sql = "SELECT count(Code) as counter FROM services WHERE Name='".addslashes($data['Name'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Name'] = 'Tên này đã tồn tại';
        }
    }

    if (isset($syntax['syntax']) && $syntax['syntax']!=''){
        $sql = "SELECT count(id) as counter FROM syntax WHERE syntax='".addslashes($syntax['syntax'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['syntax'] = 'Cú pháp đã được đăng ký';
        }
    }


    return $error;
}

function db_dv_edit_validate($data,$syntax,$field)
{
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['Code']) && $data['Code'] == ''){
        $error['Code'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Name']) && $data['Name'] == ''){
        $error['Name'] = 'Bạn chưa nhập tên';
    }
    if (isset($data['status_id']) && $data['status_id'] == ''){
        $error['status_id'] = 'Bạn chưa nhập trạng thái';
    }
    if (isset($data['desciption']) && $data['desciption'] == ''){
        $error['desciption'] = 'Bạn chưa nhập mô tả';
    }

    // Password
    if (isset($data['Unit_price']) && $data['Unit_price'] == ''){
        $error['Unit_price'] = 'Bạn chưa nhập giá dịch vụ';
    }

    if (isset($data['Address']) && $data['Address'] == ''){
        $error['Address'] = 'Bạn chưa nhập địa chỉ';
    }

    if (isset($data['service_type_Id']) && $data['service_type_Id']==''){
        $error['service_type_Id'] = 'Bạn chưa nhập loại dịch vụ';
    }
    if (isset($syntax['syntax']) && $syntax['syntax']==''){
        $error['syntax'] = 'Bạn chưa nhập cú pháp';
    }

    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username

    if($data['Code']!=$field['Code']) {
        if (isset($data['Code']) && $data['Code'] != '') {
            $sql = "SELECT count(Code) as counter FROM services WHERE Code='" . addslashes($data['Code']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Code'] = 'Mã dịch vụ này đã tồn tại';
            }
        }
    }

    if($data['Name']!=$field['Name']) {
        if (isset($data['Name']) && $data['Name'] != '') {
            $sql = "SELECT count(Code) as counter FROM services WHERE Name='" . addslashes($data['Name']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Name'] = 'Tên này đã tồn tại';
            }
        }
    }

    if($syntax['syntax']!=$field['syntax']) {
        if (isset($syntax['syntax']) && $syntax['syntax'] != '') {
            $sql = "SELECT count(id) as counter FROM syntax WHERE syntax='" . addslashes($syntax['syntax']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['syntax'] = 'Cú pháp đã được đăng ký';
            }
        }
    }

    return $error;
}
function db_dt_validate($data)
{
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['ID']) && $data['ID'] == ''){
        $error['ID'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Shortname']) && $data['Shortname'] == ''){
        $error['Shortname'] = 'Bạn chưa nhập tên viết tắt';
    }
    if (isset($data['Fullname']) && $data['Fullname'] == ''){
        $error['Fullname'] = 'Bạn chưa nhập tên đầy đủ';
    }
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['contact']) && $data['contact'] == ''){
        $error['contact'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['contact']) && $data['contact'] !=''){
        if(!is_phone($data['contact']))
            $error['contact'] = 'Số điện thoại không hợp lệ';
    }


    if (isset($data['start_date']) && $data['start_date']==''){
        $error['start_date'] = 'Bạn chưa nhập ngày bắt đầu';
    }
    if (isset($data['end_date']) && $data['end_date']!=''){
        if(strtotime($data['end_date'])<strtotime($data['start_date']))
        $error['end_date'] = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
    }
    if (isset($data['status_id']) && $data['status_id']==''){
        $error['status_id'] = 'Bạn chưa nhập trạng thái';
    }


    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (isset($data['ID']) && $data['ID']!=''){
        $sql = "SELECT count(ID) as counter FROM partner WHERE ID='".addslashes($data['ID'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['ID'] = 'Mã đối tác này đã tồn tại';
        }
    }

    if (isset($data['Shortname']) && $data['Shortname']!=''){
        $sql = "SELECT count(ID) as counter FROM partner WHERE Shortname='".addslashes($data['Shortname'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Shortname'] = 'Tên viết tắt đã được đăng ký';
        }
    }

    // Email
    if (isset($data['Fullname']) && $data['Fullname']!=''){
        $sql = "SELECT count(ID) as counter FROM partner WHERE Fullname='".addslashes($data['Fullname'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['Fullname'] = 'Tên này đã tồn tại';
        }
    }

    if (isset($data['email']) && $data['email']!=''){
        $sql = "SELECT count(ID) as counter FROM partner WHERE email='".addslashes($data['email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['email'] = 'Email này đã tồn tại';
        }
    }

    return $error;
}
function db_dt_edit_validate($data,$field)
{
    // Biến chứa lỗi
    $error = array();

    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['ID']) && $data['ID'] == ''){
        $error['ID'] = 'Bạn chưa nhập mã';
    }

    // Email
    if (isset($data['Shortname']) && $data['Shortname'] == ''){
        $error['Shortname'] = 'Bạn chưa nhập tên viết tắt';
    }
    if (isset($data['Fullname']) && $data['Fullname'] == ''){
        $error['Fullname'] = 'Bạn chưa nhập tên đầy đủ';
    }
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập Email';
    }
    else if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }

    // Password
    if (isset($data['contact']) && $data['contact'] == ''){
        $error['contact'] = 'Bạn chưa nhập số điện thoại';
    }
    if(isset($data['contact']) && $data['contact'] !=''){
        if(!is_phone($data['contact']))
            $error['contact'] = 'Số điện thoại không hợp lệ';
    }


    if (isset($data['start_date']) && $data['start_date']==''){
        $error['start_date'] = 'Bạn chưa nhập ngày bắt đầu';
    }
    if (isset($data['end_date']) && $data['end_date']!=''){
        if(strtotime($data['end_date'])<strtotime($data['start_date']))
            $error['end_date'] = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
    }
    if (isset($data['status_id']) && $data['status_id']==''){
        $error['status_id'] = 'Bạn chưa nhập trạng thái';
    }


    /* VALIDATE LIÊN QUAN CSDL */
    // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
//    if($data['Code']!=$field['Code_hidden']) {
        if (isset($data['Code']) && $data['Code'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE Code='" . addslashes($data['Code']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['Code'] = 'Mã khách hàng này đã tồn tại';
            }
        }
//    }

    if($data['phone_number']!=$field['phone_number_hidden']) {
        if (isset($data['phone_number']) && $data['phone_number'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE phone_number='" . addslashes($data['phone_number']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['phone_number'] = 'Số điện thoại này đã được đăng ký';
            }
        }
    }
    // Email

    if($data['email']!=$field['email_hidden']) {
        if (isset($data['email']) && $data['email'] != '') {
            $sql = "SELECT count(Code) as counter FROM customers WHERE email='" . addslashes($data['email']) . "'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0) {
                $error['email'] = 'Email này đã tồn tại';
            }
        }
    }
    return $error;
}
