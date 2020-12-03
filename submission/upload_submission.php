<?php
include '../connect.php';

$array = array();

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
// $nowDate = date("Y-m-dH:i:s");
$nowDate = time();



$studentName = null;
$studentID = null;
$group = null;
$start = null;
$end = null;

$required = array('studentName', 'studentID', 'group','start','end');

$error = false;
foreach ($required as $v) {
    if (!isset($_POST[$v]) || empty($_POST[$v])) {
        $error = true;
    }
}

if ($error) {
    $array['info'] = "error";
    $array['http_code'] = 400;
    $array['response_code'] = 0;
    $array['message'] = "File Tidak Valid";
    $array['size'] = 0;
} else {

    $studentName = mysqli_escape_string($conn, $_POST['studentName']);
    $studentID = mysqli_escape_string($conn, $_POST['studentID']);
    $group = mysqli_escape_string($conn, $_POST['group']);
    $start = mysqli_escape_string($conn, $_POST['start']);
    $end = mysqli_escape_string($conn, $_POST['end']);

    $fileMP3 = $_FILES['inputSubmission'];
    $fileMP3_name = $_FILES['inputSubmission']['name'];
    $fileMP3_type = $_FILES['inputSubmission']['type'];
    $fileMP3_size = $_FILES['inputSubmission']['size'];
    $fileMP3_temp_loc = $_FILES['inputSubmission']['tmp_name'];

    // $file_storeNameMP3 = "./file/$fileMP3_name";
    $file_storeNameMP3 = "./file/$nowDate-$studentName" . ".wav";
    $mp3Stat =  move_uploaded_file($fileMP3_temp_loc, $file_storeNameMP3);

    if ($mp3Stat) {
        $query = "INSERT INTO `setoran`(`student_id`, `kelompok_id`, `status`, `score`, `start`, `end`, `correction`, `audio_path`)
        VALUES ($studentID,$group,0,'','$start','$end','','$file_storeNameMP3')";

        $e =  mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($e) {
            $array['info'] = "success";
            $array['http_code'] = 200;
            $array['response_code'] = 1;
            $array['message'] = "Berhasil Upload";
            $array['size'] = $fileMP3_size;
        } else {
            $array['info'] = "error";
            $array['http_code'] = 406;
            $array['response_code'] = 0;
            $array['message'] = "Gagal Mengupload Setoran";
            $array['size'] = $fileMP3_size;
        }
    } else {
        $array['info'] = "error";
        $array['http_code'] = 403;
        $array['cause'] = $_FILES["inputSubmission"]["error"];
        $array['response_code'] = 0;
        $array['message'] = "Gagal Mengupload Setoran Ke Folder Tujuan (Server)";
        $array['size'] = $fileMP3_size;
        // die("Cannot write to destination file");
    }
}
echo json_encode($array);
