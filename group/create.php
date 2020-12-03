<!doctype html>
<html lang="en">

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
        //FOR DATA TABLE
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

    <script type="text/javascript">
        $(function() {
            $("#searchMusyrif").autocomplete({
                source: 'search_mentor.php',
            });

            $("#searchStudent").autocomplete({
                source: 'search_student.php',
                select: function(e, ui) {
                    const ad = ui;
                    alert(ad.item.label);
                },
            });
        });

        function addStudent() {
            $("#productTable tbody").append("<tr>" +
                "<td>My First Video</td>" +
                "<td>6/11/2015</td>" +
                "<td>www.pluralsight.com</td>" +
                "</tr>");
        }
    </script>

    <div class="container">
        <h2>Buat Kelompok</h2>
        <!-- <label for="" class="control-label"></label>
        <input id="searchMusyrif" class="form-control" placeholder="Ketikan Nama Pembimbing , Kemudian pilih dari daftar yang tersedia"> -->
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Pembimbing/Musyrif : </label>
            <select class="form-control" id="exampleFormControlSelect1">
                <?php
                include '../connect.php';
                $query = "SELECT * FROM mentor";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($user = mysqli_fetch_array($result)) {
                        $id = $user['id'];
                        $name = $user['name'];
                        echo "<option>$id - $name</option>";
                    }
                } else {
                    echo "<option>Error</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Input Siswa</label>
            <input type="text" class="form-control" name="" id="searchStudent" aria-describedby="helpId" placeholder="Ketikan Nama Siswa , Kemudian pilih dari daftar yang tersedia">
            <small id="helpId" class="form-text text-muted">Ketik Nama Siswa dan Pilih Dari Daftar dan klik Tambah Siswa</small>
            <a name="" id="" class="btn btn-primary" href="#" role="button">Tambah Siswa</a>
        </div>

        <div class="table-responsive">
            <table id="tabel-data" class="table">
                <thead class="">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Jenis Kelamin</th>
                        <th>Masukkan</th>
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

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</body>

</html>