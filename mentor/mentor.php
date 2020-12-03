<?php
include_once '../connect.php';


$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['mentor'] = [];
$nowDate = date("Y-m-d H:i:s");

function getMentor($id, $conn)
{
    $queryX = "SELECT * from mentor where id ='$id'";
    $sql = mysqli_query($conn, $queryX);
    if ($row = mysqli_fetch_array($sql)) {
        $array['mentor'] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'gender' => $row['gender'],
            'mentor_photo' => $row['url_profile'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ];
        return ($array['mentor']);
    }
}

function getAllMentor($conn)
{
    $array = array();
    $array['info'] = "";
    $array['http_code'] = "";
    $array['response_code'] = "";
    $array['message'] = "";
    $array['size'] = 0;
    $array['mentor'] = [];
    $nowDate = date("Y-m-d H:i:s");

    $query = "SELECT * from mentor";
    $sql = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($sql)) {

        $array['mentor'][] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'gender' => $row['gender'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ];
        $array['size'] = count($array['mentor']);
    }
    if ($array['size'] == 0) {
        $array['info'] = "";
        $array['http_code'] = 200;
        $array['response_code'] = 3;
        $array['message'] = "";
    } else {
        $array['info'] = "";
        $array['http_code'] = 200;
        $array['response_code'] = 1;
        $array['message'] = "Berhasil Mengambil Data Guru";
    }



    echo json_encode($array);
}
