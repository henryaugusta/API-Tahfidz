<?php
include '../connect.php';

$array = array();

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
// $nowDate = time();
$nowDate = date("Y-m-d H:i:s");




$required = array('studentID');



$error = false;
if (!isset($_POST['student_id']) || empty($_FILES['uploaded_files']) || $_POST['student_id'] == null) {
    $error = true;
}

if ($error) {
    $array['info'] = "error";
    $array['http_code'] = 400;
    $array['response_code'] = 0;
    $array['message'] = "File Tidak Valid";
    $array['size'] = 0;
} else {

    $file = $_FILES['uploaded_files'];
    $file_name = $_FILES['uploaded_files']['name'];
    $file_type = $_FILES['uploaded_files']['type'];
    $file_size = $_FILES['uploaded_files']['size'];
    $file_temp_loc = $_FILES['uploaded_files']['tmp_name'];

    $studentID = $_POST['student_id'];
    $sql = mysqli_query($conn, "SELECT nisn from student where id=$studentID");
    $row = mysqli_fetch_array($sql);
    $studentNISN = $row['nisn'];

    $file_storeName = "./photo/$studentNISN" . ".png";
    $uploadStat =  move_uploaded_file($file_temp_loc, $file_storeName);

    if ($uploadStat) {
        $query = "UPDATE student SET url_profile='$file_storeName', updated_at='$nowDate' where id ='$studentID'";
        $e =  mysqli_query($conn, $query);
        if ($e) {
            $array['info'] = "success";
            $array['http_code'] = 200;
            $array['response_code'] = 1;
            $array['nama_file'] = $file_storeName;
            $array['message'] = "Berhasil Upload Profile";
            $array['size'] = $file_size;
        } else {
            echo mysqli_error($conn);
            $array['info'] = "error";
            $array['http_code'] = 406;
            $array['response_code'] = 0;
            $array['message'] = "Gagal Mengupload Foto Profile";
            $array['size'] = $file_size;
        }
    } else {
        $array['info'] = "error";
        $array['http_code'] = 403;
        $array['cause'] = $_FILES["inputSubmission"]["error"];
        $array['response_code'] = 0;
        $array['message'] = "Gagal Mengupload Foto Ke Folder Tujuan (Server)";
        $array['size'] = $file_size;
        // die("Cannot write to destination file");
    }
}
echo json_encode($array);
