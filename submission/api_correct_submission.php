<?php
include '../connect.php';

$submission_id = null;
$score = null;
$correction = null;

if (isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];
    $score = $_POST['score'];
    $correction = $_POST['correction'];
}

if (isset($_GET['submissions_id'])) {
    $submission_id = $_GET['submission_id'];
    $score = $_GET['score'];
    $correction = $_GET['correction'];
}
if ($submission_id == null) {
    failed(404, 0, "Input Tidak Valid", "F", "", "", null);
} else {

      
    // echo error_reporting(E_ALL | E_STRICT);
    $query = "UPDATE `setoran` 
    SET score='$score',
     correction='$correction', 
     status='1' 
     WHERE id='$submission_id'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        success(200, 1, "Success", "Success Update Data", "Success");
    } else {
        // ini_set('display_errors', 'On');
        // echo mysqli_error($conn);
        // echo 'Error '.mysqli_error($sql).mysqli_errno($conn);
        failed(400, 2, "Failed", $query, "", "", null);
    }
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

function success($http, $code, $message, $info, $status)
{
    $array['info'] = $info;
    $array['http_code'] = $http;
    $array['response_code'] = $code;
    $array['message'] = $message;
    $array['size'] = 0;
    $array['status'] = $status;
    array_shift($submission);
    echo json_encode($array);
}
