<?php 
include '../connect.php';
include 'mentor.php';

$contact = $_POST['username'];
$password = $_POST['password'];
$password = mysqli_escape_string($conn,$password);


$arrnull = array();

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['mentor'] = [];
$nowDate = date("Y-m-d H:i:s");

$query = "SELECT * FROM mentor where contact ='$contact'";
$sql = mysqli_query($conn,$query);
$cek = mysqli_num_rows($sql);

if ($cek==0) {
    $array['info'] = "Login Gagal";
    $array['http_code'] = 404;
    $array['response_code'] = 3;
    $array['message'] = "Nomor Whatsapp Tidak Ditemukan";
    $array['size'] = $cek;
}else{

    if ($row = mysqli_fetch_array($sql)) {
        $passwordHash = $row['password'];
        $id = $row['id'];
        if (password_verify($password, $passwordHash)) {
            $array['info'] = "Login Berhasil";
            $array['http_code'] = 200;
            $array['response_code'] = "";
            $array['message'] = "Login Success";
            $array['size'] = 1;
            $array['mentor'] = getMentor($id, $conn);
        } else {
            $array['info'] = "Login Gagal";
            $array['http_code'] = 403;
            $array['response_code'] = 3;
            $array['message'] = "Username dan Password Salah";
            $array['size'] = 0;
            $array['mentor'] = $arrnull;
            
        }
    }

}

echo json_encode($array);
