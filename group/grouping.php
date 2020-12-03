<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tutorial Pagination - Malasngoding.com</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <center>
            <h2>Data Pembimbing</h2>
            <nav>
                <?php
                include_once '../connect.php';
                $batas = 10;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($conn, "select * from mentor");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                ?>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </center>
        <br>
        <table class="table table-bordered table-responsive  w-100 d-block d-md-table">
            <thead class="">
                <tr>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $queryMentor = "SELECT * FROM mentor";
                $sqlMentor = mysqli_query($conn, "select * from mentor limit $halaman_awal, $batas");
                $nomor = $halaman_awal + 1;
                while ($row = mysqli_fetch_array($sqlMentor)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <!-- <td><?php echo $row['id']; ?></td> -->
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>