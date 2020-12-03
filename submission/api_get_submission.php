 <?php
    include '../connect.php';
    include '../quran_index.php';

    $array = array();
    $array['info'] = "";
    $array['http_code'] = "";
    $array['response_code'] = "";
    $array['message'] = "";
    $array['size'] = "";
    $array['submission'][] ="";
    $nowDate = date("Y-m-d H:i:s");

    $query = "";

    $group_id = null;
    $student_id = null;

    if (isset($_POST['group_id'])) {
        $group_id = $_POST['group_id'];
        $query = "SELECT * FROM mentor_submission where group_id=$group_id order by id DESC";
    }

    if (isset($_GET['group_id'])) {
        $group_id = $_GET['group_id'];
        $query = "SELECT * FROM mentor_submission where group_id=$group_id  order by id DESC";
    }

    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
        $query = "SELECT * FROM mentor_submission where student_id=$student_id  order by id DESC";
    }
    if (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        $query = "SELECT * FROM mentor_submission where student_id=$student_id order by id DESC";
    }
    if ($group_id == null && $student_id == null) {
        $query = "SELECT * FROM mentor_submission";
    }
    $sql = mysqli_query($conn, $query);
    $sqlCheck = mysqli_query($conn, $query);

    if (mysqli_num_rows($sql) != 0) {
        if (mysqli_fetch_array($sqlCheck)) {
            while ($row = mysqli_fetch_array($sql)) {
              
                $start = $row['start'];
                $suratStart = explode(':', $start);
                $start = $quran_index[$suratStart[0]] . " : " . $suratStart[1];

                $end = $row['end'];
                $suratEnd = explode(':', $end);
                $end = $quran_index[$suratEnd[0]] . " : " . $suratEnd[1];

                $array['submission'][]= [
                    'id_submission' => $row['id'],
                    'id_student' => $row['student_id'],
                    'date' => $row['created_at'],
                    'student_name' => $row['name'],
                    'student_nisn' => $row['nisn'],
                    'status' => $row['status'],
                    'start' => $start,
                    'end' => $end,
                    'score' => $row['score'],
                    'correction' => $row['correction'],
                    'audio' => $row['audio_path'],
                ];
                $array['size'] = count($array['submission']);
            }
            if ($array['size'] == 0) {
                success(200, 3, "Success", "Berhasil Fetch Submission", "", $array['submission']);
            }else{
                success(200, 1, "Success", "Berhasil Fetch Submission", "", $array['submission']);
            }
          
        } else {
            failed(400, 0, "Failed", "Gagal Fetch Data Submission", "", "", null);
        }
    } else {
        failed(400, 2, "Failed", "Data Tidak Ditemukan", "", "", null);
    }


    function failed($http, $code, $message, $info, $status, $submission)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = 0;
        $array['status'] = $status;
        $array['submission'] = "$submission";
        echo json_encode($array);
    }

    function success($http, $code, $message, $info, $status, $submission)
    {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = 0;
        $array['status'] = $status;
        array_shift($submission);
        $array['submission'] = $submission;
        echo json_encode($array);
    }


    ?>