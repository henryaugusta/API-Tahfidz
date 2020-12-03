<?php
include '../connect.php';
$submission_id = 0;

$array = array();
$array['info'] = "";
$array['http_code'] = "";
$array['response_code'] = "";
$array['message'] = "";
$array['size'] = "";
$array['status'] = "";

$submission_id = null;
//----------START OF CHECKING------------ 
if (isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];
}

if (isset($_GET['submission_id'])) {
    $submission_id = $_GET['submission_id'];
}
if ($submission_id == null) {
    failed(400, 0, "Gagal Hapus Data", "Input Tidak Valid", "Gagal",$submission_id);
    //--------------END OF CHECKING------------
} else {
    $query2 = "SELECT * FROM setoran where id=$submission_id";
    $sql2 = mysqli_query($conn, $query2);
    $resp = mysqli_num_rows($sql2);

    if ($resp == 0) { //If submision ID not found on server
        failed(400, 0, "Gagal Hapus Data", "Data Setoran Tidak Ditemukan di Database", "Gagal",$submission_id);
    } else {
        $row = mysqli_fetch_array($sql2);
        $audio_path = $row['audio_path'];
        //CHECK IF FILE EXIST
        if (file_exists($audio_path)) {
            //CHECK IF DELETE FILE SUCCESS
            if (unlink(realpath($audio_path))) {
                $query = "DELETE FROM setoran where id=$submission_id";
                $sql = mysqli_query($conn, $query);
                if ($sql) {
                    success(200, 1, "Success", "Success Hapus Data", "Success",$submission_id);
                } else {
                    failed(400, 0, "Gagal ", "Gagal", "Gagal",$submission_id);
                }
            } else {
                //IF DELETE FILE FAILED
                failed(400, 0, "Gagal ", "Gagal Hapus File Dari Server", "Gagal",$submission_id);
            }
        } else {
            //IF FILE DOESNT EXIST
            failed(400, 0, "Gagal Hapus Data", "Data Setoran Tidak Ditemukan di Server", "Gagal",$submission_id);
        }
    }
}


function failed($http, $code, $message, $info, $status,$submission_id)
{

    if (isset($_POST['source'])) {
        # code...
        echo '<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          </head>
          <body>
           
            <div class="container h-100 d-flex justify-content-center" style="padding: 50px;">
                <div>
                    <lottie-player  class="align-items-center h-100" src="https://assets4.lottiefiles.com/packages/lf20_ed9D2z.json" background="transparent"  speed="1"  style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                </div>     
            </div>
        
            <div class="container-fluid d-flex justify-content-center">
                <h4>Gagal Menghapus Setoran</h4><br>
            </div>
        
            <div class="d-flex justify-content-center">
                <a href="./get_submission_student.php">
                   <h5>Kembali</h5></a>
            </div>
              
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
            <!-- Lottie -->
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        </body>
        </html>';
    } else {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = 0;
        $array['status'] = $status;
        $array['sub_id'] = $submission_id;
        echo json_encode($array);
    }
}

function success($http, $code, $message, $info, $status,$submission_id)
{
    if (isset($_POST['source'])) {
        # code...
        echo '<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          </head>
          <body>
           
            <div class="container h-100 d-flex justify-content-center" style="padding: 50px;">
                <div>
                    <lottie-player  class="align-items-center h-100" src="https://assets6.lottiefiles.com/packages/lf20_PaEutX.json" background="transparent"  speed="1"  style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                </div>     
            </div>
        
            <div class="container-fluid d-flex justify-content-center">
                <h4>Berhasil Menghapus Setoran</h4><br>
            </div>
        
            <div class="d-flex justify-content-center">
                <a href="./get_submission_student.php">
                   <h5>Kembali</h5></a>
            </div>
              
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
            <!-- Lottie -->
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        </body>
        </html>';
    } else {
        $array['info'] = $info;
        $array['http_code'] = $http;
        $array['response_code'] = $code;
        $array['message'] = $message;
        $array['size'] = 0;
        $array['status'] = $status;
        $array['sub_id'] = $submission_id;
        echo json_encode($array);
    }
}
