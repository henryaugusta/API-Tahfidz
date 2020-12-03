<?php
include '../connect.php';

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$nowDate = date("Y-m-d H:i:s");

$group_id = $_POST['group_id'];
$title = $_POST['title'];
$gform = $_POST['gform_link'];
$desc = $_POST['desc'];

$query = "INSERT INTO `quiz`( `group_id`,`description`, `title`, `gform_link`) VALUES ('$group_id', '$desc' , '$title','$gform')";
$sql = mysqli_query($conn, $query);

if ($sql) {
    $array['info'] = "success";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Berhasil Membuat Quiz";
} else {
    echo mysqli_error($conn);
    $array['info'] = "error";
    $array['http_code'] = 406;
    $array['response_code'] = 0;
    $array['message'] = "Gagal Membuat Quiz";
}
echo json_encode($array);
