<?php
include '../connect.php';
include 'student.php';

$id = mysqli_escape_string($conn, $_POST['student_id']);
$newPassword = mysqli_escape_string($conn, $_POST['new_password']);
$oldPassword = mysqli_escape_string($conn, $_POST['old_password']);


$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['student'] = [];
$nowDate = date("Y-m-d H:i:s");

$queryGetOldPass   = "SELECT * from student where id='$id' ";
$sqlGetOldPass = mysqli_query($conn, $queryGetOldPass);
$row = mysqli_fetch_array($sqlGetOldPass);

$oldPasswordReal = $row['password'];

if (password_verify($oldPassword, $oldPasswordReal)) {

    $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $sql = mysqli_query(
        $conn,
        " UPDATE `student` SET 
    password = '$newPassword' ,
    `updated_at`='$nowDate' WHERE id= $id "
    );

    if ($sql) {
        success(200, 1, "Success", "Berhasil Update Password", "OK");
    } else {
        failed(400, 0, "Failed", mysqli_error($conn), "NO");
    }
} else {
    failed(400,3,"Failed","Password Lama Tidak Sesuai","NO");
}

function failed($http, $code, $message, $info, $status)
{
    $array['info'] = $info;
    $array['http_code'] = $http;
    $array['response_code'] = $code;
    $array['message'] = $message;
    $array['size'] = 0;
    $array['status'] = $status;
    echo json_encode($array);
}

function success($http, $code, $message, $info, $status)
{
    $array['info'] = $info;
    $array['http_code'] = $http;
    $array['response_code'] = $code;
    $array['message'] = $message;
    $array['size'] = 0;
    $array['status'] = $status;
    echo json_encode($array);
}


