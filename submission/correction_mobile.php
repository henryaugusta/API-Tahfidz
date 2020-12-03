<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Koreksi Hafalan Siswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: white;
    }

    .cardz {
      font-family: 'Quicksand', sans-serif;
      margin: 25px;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 0 25px #a8dda8;
      transition: all ease 1s;
    }

    .mp3-player {}

    /* Disable upload image */
    .note-group-select-from-files {
      display: none;
    }

    p {
      line-height: 16px;
      /* within paragraph */
      margin-bottom: 10px;
      /* between paragraphs */
    }
  </style>

</head>

<?php
// ini_set('display_errors', '1');
include '../connect.php';
sleep(3);
$id = $_GET['submission_id'];
$query = "SELECT * FROM mentor_submission where id=$id";
$sql = mysqli_query($conn, $query);

if ($row = mysqli_fetch_array($sql)) {
  $mp3 = $row['audio_path'];
  // echo $mp3;
} else {
  // echo mysqli_error($conn) ;
}
?>

<body>

  <div class="main-container">

    <div class="container">
      <?php
      // include '../connect.php';
      include './update_correct.php'; ?>
    </div>

    <div class="container">
      <div class="col-lg-12 mp3-player">
        <audio controls loop autoplay style="width: 100%;">
          <source src="<?php echo $mp3 ?>" type="audio/ogg">
          Your browser dose not Support the audio Tag
        </audio>
      </div>
    </div>

    <form action="correction_mobile.php?submission_id=<?= $_GET['submission_id'] ?>" method="post">
      <div class="container">
        <textarea id="summernote" name="correction" rows="10">
        <?= $row['correction'] ?>
      </textarea>
      </div>

      <div class="container">
        <div class="form-group">
          <label for="">Status</label>
          <select class="form-control" name="status">
            <option value="1">Sudah Dinilai</option>
            <option value="0">Menunggu Dinilai</option>
          </select>
        </div>
      </div>



      <input type="hidden" name="submission_id" value="<?= $_GET['submission_id'] ?>">
      <div class="container my-3">
        <div class="form-group">
          <label for="">Nilai Setoran</label>
          <input type="text" class="form-control" name="score" value="<?= $row['score'] ?>" id="" aria-describedby="helpId" placeholder="">
          <small class="form-text text-muted">Input/Ubah Nilai Setoran</small>
        </div>
      </div>

      <div class="container">
        <button type="submit" name="update_correct" class="btn btn-block btn-primary mb-4">Save changes</button>
        <div class="" id="collapseExample">
          <div class="card">
            <div class="card card-header">
              <h4>Ketentuan Koreksi Hafalan</h4>
            </div>
            <ul>
              <li>10-59 : Rosib</li>
              <li>60-69 : Maqbul</li>
              <li>70-89 : Jayyid</li>
              <li>80-89 : Jayyid Jiddan</li>
            </ul>
            <br>
          </div>
        </div>
        <br><br>
      </div>

    </form>
    <script>
      $(document).ready(function() {
        $('#summernote').summernote({
          height: 100,
        });
        $('#summernote').height($(window).height() * 0.9)
      });

      let summernoteOptions = {
        height: 300
      }

      $('#summernote').summernote(summernoteOptions);

      $(document).on('click', '#change', function() {

        summernoteOptions.height = 100;

        let content = $('#summernote').summernote('code');

        $('#summernote').summernote('destroy');
        $('#summernote').summernote(summernoteOptions);
        $('#summernote').summernote('code', content);

      });
    </script>
  </div>
  </div>
</body>

</html>