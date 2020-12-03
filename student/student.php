<?php
include_once '../connect.php';


$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['student'] = [];
$nowDate = date("Y-m-d H:i:s");



function getStudent($id, $conn)
{
    $queryX = "SELECT * from student where id ='$id'";
    $sql = mysqli_query($conn, $queryX);
    if ($row = mysqli_fetch_array($sql)) {
        $array['student'] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'nisn' => $row['nisn'],
            'email' => $row['email'],
            'kelas' => $row['kelas'],
            'contact' => $row['contact'],
            'url_profile' => $row['url_profile'],
            'gender' => $row['gender'],
            'kelompok' => $row['id_kelompok'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ];
        
        // echo getKelompokInfo($row['id_kelompok'],$conn);
        return ($array['student']);
    }
}

function getKelompokInfo($id,$conn){
    $queryx = "";
    if ($id==null) {
        $queryx = "SELECT * from kelompok_mentor where group_id<>0";
    }else{
        $queryx = "SELECT * from kelompok_mentor where group_id=$id";
    }
 
    $sqli = mysqli_query($conn, $queryx);
    if ($row = mysqli_fetch_array($sqli)) {
        $array['kelompok'] = [
            'id' => $row['group_id'],
            'announcement' => $row['announcement'],
            'mentor_id' => $row['mentor_id'],
            'group_name' => $row['group_name'],
            'mentor_name' => $row['name'],
            'mentor_contact' => $row['contact'],
            'total' => null,
        ];
        return ($array['kelompok']);
    }
}



function getAllStudent($conn)
{
    $array = array();
    $array['info'] = "";
    $array['http_code'] = "";
    $array['response_code'] = "";
    $array['message'] = "";
    $array['size'] = "";
    $array['student'] = [];
    $nowDate = date("Y-m-d H:i:s");
    $query = "SELECT * from student";
    $sql = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($sql)) {

        $array['student'][] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'nisn' => $row['nisn'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'gender' => $row['gender'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ];
        $array['size'] = count($array['student']);
        if ($array['size'] == 0) {
            $array['info'] = "";
            $array['http_code'] = 200;
            $array['response_code'] = 3;
            $array['message'] = "";
        } else {
            $array['info'] = "";
            $array['http_code'] = 200;
            $array['response_code'] = 1;
            $array['message'] = "Berhasil Mengambil Data Siswa";
        }
    }

    return json_encode($array);
}
