<?php
include '../connect.php';
$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['group_member'] = array();

$id = null;
$client = null;


$param = array('id', 'type');
$query = "SELECT * FROM group_data_from_student";

if (isset($_POST['group_id'])) {
    $id = $_POST['group_id'];
    $query = "SELECT * FROM group_data_for_student where group_id='$id'";
}

if (isset($_GET['group_id'])) {
    $id = $_GET['group_id'];
    $query = "SELECT * FROM group_data_for_student where group_id='$id'";
}

if (isset($_GET['mentor_id'])) {
    $id = $_GET['mentor_id'];
    $query = "SELECT * FROM group_data_for_student where mentor_id='$id'";
}

if (isset($_POST['mentor_id'])) {
    $id = $_POST['mentor_id'];
    $query = "SELECT * FROM group_data_for_student where mentor_id='$id'";
}

$sql = mysqli_query($conn, $query);
$total = 0;
while ($row = mysqli_fetch_array($sql)) {
    $total++;
    $array['group_member'][] = [
        'student_id' => $row['student_id'],
        'name' => $row['name'],
        'nisn' => $row['nisn'],
        'student_class' => $row['class'],
        'student_contact' => $row['student_contact'],
        'student_photo' => $row['student_photo'],
        'student_gender' => $row['student_gender'],
        'mentor_id' => $row['mentor_id'],
        'group_id' => $row['group_id'],
        'group_name' => $row['group_name'],
        'mentor_name' => $row['mentor'],
        'mentor_photo' => $row['mentor_photo'],
        'mentor_contact' => $row['contact_mentor'],
    ];
}

if ($total == 0) {
    $array['info'] = "Gagal Fetch Data Kelompok";
    $array['http_code'] = 400;
    $array['response_code'] = 3;
    $array['message'] = "Belum ada anggota kelompok";;
    $array['size'] = $total;
    $array['group_member'] = array();
} else {
    $array['info'] = "Berhasil Fetch Data Kelompok";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Berhasil Fetch Data Kelompok";;
    $array['size'] = $total;
}

echo json_encode($array);
