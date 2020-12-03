<?php


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



?>