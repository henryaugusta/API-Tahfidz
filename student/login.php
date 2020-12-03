<?php
include '../connect.php';
include 'student.php';

$nis = mysqli_escape_string($conn, $_POST['username']);
$password = mysqli_escape_string($conn, $_POST['password']);
$password = mysqli_escape_string($conn, $password);


$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['student'] = [];
$nowDate = date("Y-m-d H:i:s");

$query = "SELECT * FROM student where nisn='$nis'";
$sql = mysqli_query($conn, "SELECT * FROM student where nisn='$nis'");
$cek = mysqli_num_rows($sql);

if ($cek < 1) {
    $array['info'] = "Login Gagal";
    $array['http_code'] = 404;
    $array['response_code'] = 0;
    $array['message'] = "NIS Tidak Ditemukan";
    $array['size'] = $cek;
    $array['group_data'] = array();
} else {

    if ($row = mysqli_fetch_array($sql)) {
        $passwordHash = $row['password'];
        $id = $row['id'];
        if (password_verify($password, $passwordHash)) {
            $array['info'] = "Login Berhasil";
            $array['http_code'] = 200;
            $array['response_code'] = "";
            $array['message'] = "Login Success";
            $array['size'] = 1;
            $array['student'] = getStudent($id, $conn);
            $array['group_data'] = getKelompokInfo($array['student']['kelompok'],$conn);
        } else {
            $array['info'] = "Login Gagal";
            $array['http_code'] = 403;
            $array['response_code'] = 0;
            $array['message'] = "Username dan Password Salah";
            $array['size'] = $cek;
            $array['student'] = getStudent($id, $conn);
            $array['group_data'] = getKelompokInfo($array['student']['kelompok'],$conn);
        }
    }
}

echo json_encode($array);
