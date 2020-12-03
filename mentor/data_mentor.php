<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Mentor</title>

    <link rel="stylesheet" href="../css/table.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
</head>

<body>

    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        });
        $('#tabel-data').dataTable({
            "pagingType": "scrolling",
            "paging": false
        });
        //Custom Search Box
        oTable = $('#tabel-data').DataTable();
        $('#searchBox').keyup(function() {
            oTable.search($(this).val()).draw();
        });
    </script>

    <div class="container">

        <center>
            <h2>Data Pembimbing Tahfidz</h2>
            <nav>
                <?php
                include_once '../connect.php';
                $batas = 10;
                // $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                // $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                // $previous = $halaman - 1;
                // $next = $halaman + 1;

                $data = mysqli_query($conn, "select * from mentor");
                $jumlah_data = mysqli_num_rows($data);
                // $total_halaman = ceil($jumlah_data / $batas);

                // $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                // $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                ?>
                <!-- <ul class="pagination justify-content-center">
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
                </ul> -->
            </nav>
        </center>


        <br>
        <table id="tabel-data" class="table table-responsive  w-100 d-block d-md-table">
            <thead class="">
                <tr>
                    <th>Nomor</th>
                    <th>Nama Pembimbing</th>
                    <th>Kontak</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $queryMentor = "SELECT * FROM mentor";
                $sqlMentor = mysqli_query($conn, "select * from mentor");
                $nomor = 1;
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