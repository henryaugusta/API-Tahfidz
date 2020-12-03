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

    <style>
        .container{
            margin-top: 20px;
        }
    </style>


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
            <h2>Data Siswa Tahfidz</h2>
        </center>


        <br>
        <table id="tabel-data" class="table table-responsive  w-100 d-block d-md-table">
            <thead class="">
                <tr>
                    <th>Nomor</th>
                    <th>Nama Siswa</th>
                    <th>Kontak</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Kelompok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../connect.php';
                $query = "SELECT * FROM student";
                $sql = mysqli_query($conn, $query);
                $nomor = 1;
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <!-- <td><?php echo $row['id']; ?></td> -->
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['nisn']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td style="text-align: center;"><?php echo $row['id_kelompok']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>