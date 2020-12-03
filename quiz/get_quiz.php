<?php
    include '../connect.php';
    include '../quran_index.php';

    $array = array();
    $array['info'] = "";
    $array['http_code'] = "";
    $array['response_code'] = "";
    $array['message'] = "";
    $array['size'] = "";
    $array['quiz'][] ="";
    $nowDate = date("Y-m-d H:i:s");

    $query = "";

    $group_id = null;
    $student_id = null;

    if (isset($_POST['group_id'])) {
        $group_id = $_POST['group_id'];
        $query = "SELECT * FROM quiz where group_id=$group_id";
    }

    if (isset($_GET['group_id'])) {
        $group_id = $_GET['group_id'];
        $query = "SELECT * FROM quiz where group_id=$group_id";
    }



    $sql = mysqli_query($conn, $query);
    
 
            while ($row = mysqli_fetch_array($sql)) {  
                $array['quiz'][]= [
                    'id_quiz' => $row['id'],
                    'group_id' => $row['group_id'],
                    'title' => $row['title'],
                    'desc' => $row['description'],
                    'gform_link' => $row['gform_link'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                ];
                $array['size'] = count($array['quiz']);
            }
            if ($array['size'] == 0) {
                success(200, 3, "Success", "Berhasil Fetch Quiz , ID Group = $group_id", "", $array['quiz']);
            }else{
                success(200, 1, "Success", "Berhasil Fetch Quiz, ID Group = $group_id", "", $array['quiz']);
            }
          



    function failed($http, $code, $message, $info, $status, $arrayz)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = count($array['quiz']);
        $array['status'] = $status;
        $array['quiz'] = "$arrayz";
        echo json_encode($array);
    }

    function success($http, $code, $message, $info, $status, $arrayz)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = count($arrayz);
        $array['status'] = $status;
        array_shift($arrayz);
        $array['quiz'] = $arrayz;
        echo json_encode($array);
    }


    ?>