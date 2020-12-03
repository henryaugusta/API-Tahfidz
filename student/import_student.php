<!doctype html>
<html lang="en">

<head>
    <title>Upload Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container h-100">
        <div class="container h-100 justify-content-center align-items-center">
            <?php
            include_once '../connect.php';
            if (isset($_POST['submit'])) { //Script akan berjalan jika di tekan tombol submit..

                //Script Upload File..
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    echo "<h1>" . "File " . $_FILES['filename']['name'] . " Berhasil di Upload" . "</h1>";
                    echo "<h2>Menampilkan Hasil Upload : </h2>";
                }
                //Import uploaded file to Database, Letakan dibawah sini..
                $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $data[0] = mysqli_escape_string($conn, $data[0]); 
                    $data[1] = mysqli_escape_string($conn, $data[1]);
                    $data[2] = mysqli_escape_string($conn, $data[2]);
                    $data[3] = mysqli_escape_string($conn, $data[3]);
                    $data[4] = mysqli_escape_string($conn, $data[4]);
                    $data[5] = mysqli_escape_string($conn, $data[5]);
                    $password = password_hash("bismillah", PASSWORD_BCRYPT);
                    $import = ("INSERT into student (
                     id,
                    name,
                    nisn,
                    email,
                    contact,
                    gender,
                    password,
                    kelas) values(NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$password','$data[5]')"); //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
                    mysqli_query($conn, $import) or die(mysqli_error($conn)); //Melakukan Import
                }
                fclose($handle); //Menutup CSV file
                echo "<br><strong>Import data selesai.</strong>";
            } else { //Jika belum menekan tombol submit, form dibawah akan muncul.. 
            ?>

                <!-- Form Untuk Upload File CSV-->
                Silahkan masukan file csv yang ingin diupload<br />
                <form enctype='multipart/form-data' action='' method='post'>
                    Cari CSV File Murid :<br />
                    <input type='file' name='filename' size='100'>
                    <input type='submit' name='submit' value='Upload'></form>

            <?php }
            mysqli_close($conn); //Menutup koneksi SQL
            ?>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>