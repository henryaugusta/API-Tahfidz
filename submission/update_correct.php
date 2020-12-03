<?php
if (isset($_POST['update_correct'])) {
  $submission_id = $_POST['submission_id'];
  $score = $_POST['score'];
  $status = $_POST['status'];
  $correction = mysqli_escape_string($conn ,$_POST['correction']);

  if ($status=="") {
    $status="0";
  }
  $query = "UPDATE `setoran` SET score='$score',correction='$correction', status='$status' WHERE id='$submission_id'";
  $sql = mysqli_query($conn, $query);
  if ($sql) {
    $query = "SELECT * FROM mentor_submission where id=$id";
  $sqlz = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($sqlz); 
  $mp3 = $row['audio_path'];
    sleep(1);
    echo '<br>';
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil Mengubah Data Setoran</strong> <a href="correction_mobile.php?submission_id='.$submission_id.'">Refresh Halaman</a> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
  } else {
    sleep(1);
    echo '<br>';
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal Mengubah Nilai dan Koreksi Setoran, karena ' . $mysqli_error($conn) . '</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
  }
}else{

}
