<?php
if (!defined('IN_SITE')) die ('The request not found');

// Biến lưu trữ kết nối
$conn = null;

// Hàm kết nối
function db_connect(){
    global $conn;
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'goicuoc3')
                or die ('Không thể kết nối CSDL');
        mysqli_set_charset($conn, 'utf8');
    }
}

// Hàm ngắt kết nối
function db_close(){
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}

// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
function db_get_list($sql){
    db_connect();
    global $conn;
    $data  = array();
    $result = mysqli_query($conn, $sql);
    if ($result){
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
    }

    return $data;
}

// Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
function db_get_row($sql){
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = array();
    if ($result){
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}

// Hàm thực thi câu truy  vấn insert, update, delete
function db_execute($sql){
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}


// Hàm tạo câu truy vấn có thêm điều kiện Where
function db_create_sql($sql, $filter = array())
{
    // Chuỗi where
    $where = '';

    // Lặp qua biến $filter và bổ sung vào $where
    foreach ($filter as $field => $value){
        if ($value != ''){
            $value = addslashes($value);
            $where .= "AND $field = '$value' ";
        }
    }

    // Remove chữ AND ở đầu
    $where = trim($where, 'AND');
    // Remove ký tự , ở cuối
//    $where = trim($where, ', ');

    // Nếu có điều kiện where thì nối chuỗi
    if ($where){
        $where = ' WHERE '.$where;
    }

    // Return về câu truy vấn
    return str_replace('{where}', $where, $sql);
}


// Hàm insert dữ liệu vào table
function db_insert($table, $data = array())
{
    // Hai biến danh sách fields và values
    $fields = '';
    $values = '';

    // Lặp mảng dữ liệu để nối chuỗi
    foreach ($data as $field => $value){
        $fields .= $field .',';
        $values .= "'".addslashes($value)."',";
    }

    // Xóa ký từ , ở cuối chuỗi
    $fields = trim($fields, ',');
    $values = trim($values, ',');

    // Tạo câu SQL
    $sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
//    echo $sql;
    // Thực hiện INSERT
    return db_execute($sql);
}
function queryData()
{
    db_connect();
    global $conn;
    $sql = 'SELECT * FROM login';

    $result = $conn->query($sql);

    if (!$result) {
        die ('SQL Error: ' . mysqli_error($conn));
    }
    return $result;
}

function db_update($table, $data = array(),$name,$gt)
{
    // Hai biến danh sách fields và values
    $string = '';

    // Lặp mảng dữ liệu để nối chuỗi
    foreach ($data as $field => $value){
        if($value==null){ $string .= $field ."=null,";}
        else
        $string .= $field ."='".addslashes($value)."',";
    }

    // Xóa ký từ , ở cuối chuỗi
    $string = trim($string, ',');
    // Tạo câu SQL
    $sql = "UPDATE $table SET $string WHERE $name = '$gt'";
//    // Thực hiện INSERT
    return db_execute($sql);
}


