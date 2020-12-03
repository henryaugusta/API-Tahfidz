<?php
include '../connect.php';
  $array = array();
  $array['info'] = "";
  $array['http_code'] = "";
  $array['response_code'] = "";
  $array['message'] = "";
  $array['size'] = 0;
  $array['motivation'] = [];
  $nowDate = date("Y-m-d H:i:s");

  $query = "SELECT * from motivation";
  $sql = mysqli_query($conn, $query);

  if ($sql) {
   
  }else{
    $array['info'] = "";
    $array['http_code'] = 200;
    $array['response_code'] = 3;
    $array['message'] = "";
  }

  while ($row = mysqli_fetch_array($sql)) {

      $array['motivation'][] = [
          'id' => $row['id'],
          'img' => $row['cover'],
          'title' => $row['title'],
          'content' => $row['content'],
      ];
      $array['size'] = count($array['motivation']);
  }
  if ($array['size'] == 0) {
      $array['info'] = "";
      $array['http_code'] = 200;
      $array['response_code'] = 3;
      $array['message'] = "";
  } else {
      $array['info'] = "";
      $array['http_code'] = 200;
      $array['response_code'] = 1;
      $array['message'] = "Berhasil Mengambil Data Motivation";
  }

  echo json_encode($array);


?>