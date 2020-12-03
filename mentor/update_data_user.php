<?php
include '../connect.php';
include 'mentor.php';

$id = mysqli_escape_string($conn, $_POST['mentor_id']);
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
" UPDATE `mentor` SET 
`name`='$name',
`email`='$email',
`contact`='$contact',
`updated_at`='$nowDate' WHERE id= $id ");


if ($sql) {
    $array['info'] = "Update Berhasil";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Update Success";
    $array['size'] = 1;
    $array['id'] = $id;
    $array['student'] = getMentor($id, $conn);
} else {
    $array['info'] = "Update Gagal";
    $array['http_code'] =400;
    $array['response_code'] = 0;
    $array['message'] = mysqli_error($conn);
    $array['size'] = 0;
    $array['student'] = getMentor($id, $conn);
}

echo json_encode($array);
