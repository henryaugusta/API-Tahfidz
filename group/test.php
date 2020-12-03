<?php
 include '../connect.php';
 $sqlCreate = mysqli_query($conn, "INSERT INTO `kelompok`(`name`, `id_mentor`, `category`) VALUES ('Joko',3,'P')" or mysqli_error($conn));


 if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

 if ($sqlCreate) {
     echo 'Berhasil';
 }else{
     echo("Error description: " . mysqli_error($con));
     echo 'Gagal';
 }

?>