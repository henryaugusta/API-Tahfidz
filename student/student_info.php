<?php
include '../connect.php';
include 'student.php';

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['student'] = [];
$array['group_data'] = array();

$id = null;

if (isset($_POST['id'])) {
    $id = mysqli_escape_string($conn, $_POST['id']);
}

if (isset($_GET['id'])) {
    $id = mysqli_escape_string($conn, $_GET['id']);
}

if ($id == null) {
    $array['info'] = "Gagal Fetch Data";
    $array['http_code'] = 404;
    $array['response_code'] = 0;
    $array['message'] = "Gagal Fetch Data";
    $array['size'] = 0;
    $array['student'] = getStudent($id, $conn);
    $array['group_data'] = null ;
    $array['post_id'] = $id ;
} else {

    $query = "SELECT * FROM student where id=$id";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $id = $row['id'];
        $array['info'] = "Berhasil Fetch Data";
        $array['http_code'] = 200;
        $array['response_code'] = 1;
        $array['message'] = "Berhasil Fetch Data";
        $array['size'] = 1;
        $array['student'] = getStudent($id, $conn);
         $array['group_data'] = getKelompokInfo($array['student']['kelompok'],$conn);
    } else {

        $array['info'] = "Gagal Fetch Data";
        $array['http_code'] = 404;
        $array['response_code'] = 0;
        $array['message'] = "Gagal Fetch Data";
        $array['size'] = 0;
        $array['student'] = getStudent($id, $conn);
        $array['group_data'] = getKelompokInfo($array['student']['kelompok'], $conn);
    }
}

echo json_encode($array);
