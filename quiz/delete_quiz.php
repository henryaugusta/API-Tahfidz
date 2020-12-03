<?php
include '../connect.php';

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$nowDate = date("Y-m-d H:i:s");

$id = $_POST['quiz_id'];

$query = "DELETE FROM quiz where id=$id";
$sql = mysqli_query($conn, $query);

if ($sql) {
    $array['info'] = "success";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Berhasil Menghapus Quiz";
} else {
    echo mysqli_error($conn);
    $array['info'] = "error";
    $array['http_code'] = 406;
    $array['response_code'] = 0;
    $array['message'] = "Gagal Menghapus Quiz";
}
echo json_encode($array);
