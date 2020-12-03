<?php
include '../connect.php';
include 'student.php';

$id = mysqli_escape_string($conn, $_POST['student_id']);
$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$contact = mysqli_escape_string($conn, $_POST['contact']);

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['student'] = [];
$nowDate = date("Y-m-d H:i:s");

$sql = mysqli_query($conn, 
" UPDATE `student` SET 
`name`='$name',
`email`='$email',
`contact`='$contact',
`updated_at`='$nowDate' WHERE id= $id ");


if ($sql) {
    $array['info'] = "Update Berhasil";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Login Success";
    $array['size'] = 1;
    $array['student'] = getStudent($id, $conn);
    $array['group_data'] = getKelompokInfo($array['student']['kelompok'],$conn);
} else {
    $array['info'] = "Update Gagal";
    $array['http_code'] =400;
    $array['response_code'] = 0;
    $array['message'] = "Update Failed Success";
    $array['size'] = 0;
    $array['student'] = getStudent($id, $conn);
    $array['group_data'] = getKelompokInfo($array['student']['kelompok'],$conn);


}

echo json_encode($array);
