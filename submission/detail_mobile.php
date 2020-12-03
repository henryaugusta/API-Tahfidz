<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background: rgba(0, 0, 0, 0);
      opacity: 1;
    }

    .student-card {
      font-family: 'Quicksand', sans-serif;
      margin: 25px;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 0 25px #a8dda8;
      transition: all ease 1s;
    }

    .mp3-player {
      margin-top: 20px;
    }

    p {
      line-height: 16px;
      /* within paragraph */
      margin-bottom: 10px;
      /* between paragraphs */
    }
  </style>

  <link type="text/css" rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background-color:#1A8DFF;">

  <div class="container-fluid">
    <div class="w-100 mp3-player">
      <?php
      $mp3 = $_GET['url'];
      ?>
      <audio controls loop autoplay style="width: 100%;">
        <source src="<?php echo $mp3 ?>" type="audio/ogg">
        Your Application doesnt not Support the audio Tag
      </audio>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>