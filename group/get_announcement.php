<?php
    
    include '../connect.php';

    $array = array();
    $array['info'] = "";
    $array['http_code'] = "";
    $array['response_code'] = "";
    $array['message'] = "";
    $array['size'] = "";
    $array['announcement'] ="";
    $nowDate = date("Y-m-d H:i:s");

    $query = "SELECT * FROM kelompok";



    if (isset($_POST['group_id'])) {
        $group_id = $_POST['group_id'];
        $query = "SELECT * FROM kelompok where id=$group_id";
    }

    if (isset($_GET['group_id'])) {
        $group_id = $_GET['group_id'];
        $query = "SELECT * FROM kelompok where id=$group_id";
    }


    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($sql);
    $announcement = $row['announcement'];
            if ($sql) {
                success(200, 1, "Success", "Berhasil Fetch Quiz , ID Group = $group_id","Success",$announcement);
            }else{
               failed(200, 3, "Failed", "Berhasil Fetch Quiz , ID Group = $group_id","Failed");
            }
          
    function failed($http, $code, $message, $info, $status)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = 0;
        $array['status'] = $status;
        echo json_encode($array);
    }

    function success($http, $code, $message, $info, $status,$announcement)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['announcement'] = $announcement;
        $array['size'] = 0;
        $array['status'] = $status;
        echo json_encode($array);
    }
