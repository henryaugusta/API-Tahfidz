<?php
include '../connect.php';
$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['group'] = array();

$id = null;
$client = null;


$param = array('id', 'type');
$query = "SELECT * FROM mentor_grouping";


if (isset($_GET['mentor_id'])) {
    $id = $_GET['mentor_id'];
    $query = "SELECT * FROM mentor_grouping where mentor_id='$id'";
}

if (isset($_POST['mentor_id'])) {
    $id = $_POST['mentor_id'];
    $query = "SELECT * FROM mentor_grouping where mentor_id='$id'";
}

else{
    $query = "SELECT * FROM mentor_grouping";
}
$sql = mysqli_query($conn, $query);
$total = 0;
while ($row = mysqli_fetch_array($sql)) {
    $total++;
    $array['group'][] = [
        'send_data' => "$id",
        'group_id' => $row['group_id'],
        'group_name' => $row['group_name'],
        'group_category' => $row['category'],
        'mentor_id' => $row['mentor_id'],
        'mentor_name' => $row['name'],
        'mentor_contact' => $row['contact'],
    ];
}

if ($total == 0) {
    $array['info'] = "Gagal Fetch Data Kelompok";
    $array['http_code'] = 400;
    $array['response_code'] = 3;
    $array['message'] = "Belum ada anggota kelompok";;
    $array['size'] = $total;
    $array['group'] = array();
} else {
    $array['info'] = "Berhasil Fetch Data Kelompok";
    $array['http_code'] = 200;
    $array['response_code'] = 1;
    $array['message'] = "Berhasil Fetch Data Kelompok";;
    $array['size'] = $total;
}

echo json_encode($array);


?>