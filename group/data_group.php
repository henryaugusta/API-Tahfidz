<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Kelompok</title>

    <link rel="stylesheet" href="../css/table.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <style>
        .card {
            margin: 20px;
            padding: 10px;
        }

        .select2 {
            width: 100% !important;
        }
    </style>

    <!-- SELECT2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <!-- SWEET ALERT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <!-- DATA TABLES  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
</head>


<body>


    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({});

            //Custom Search Box
            oTable = $('#tabel-data').DataTable();
            $('#searchBox').keyup(function() {
                oTable.search($(this).val()).draw();
            });

            $("#select-student").select2({});

            function succesDialog(message) {
                swal({
                        title: message,
                        text: "Thank you for contacting us. We will get back to you soon!",
                        type: "success"
                    },
                    function() {
                        //event to perform on click of ok button of sweetalert
                    });
            }

            const insert = (msg) => {
                let btnVal = document.getElementById("btnInsert").value
                let textVal = document.getElementById("currentGroup").value
                document.getElementById("currentGroup").innerHTML = textVal + btnVal + "\n";
                // alert(btnVal);
            }

            $("#select-student").change(function() {
                // if ($(this).val().length > 13) {
                //     $(this).val(last_valid_selection);
                //     // alert("Maximal 13 Mentee")
                // } else {
                last_valid_selection = $(this).val();
                $('#counter').text($(this).val().length);
                // }

            });

        });
    </script>


    <nav class="navbar navbar-dark bg-primary d-none">
        <a class="navbar-brand" href="#">Buat Kelompok</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="card d-none">


        <form action="create_group.php" method="post">
            <div class="container">
                <?php
                include '../connect.php';
                $stat = false;
                if (isset($_POST['submit'])) {
                    $mentor = $_POST['mentor'];
                    $students = $_POST['student'];
                    $category = $_POST['category'];
                    $name = $_POST['name'];

                    $sqlCreate = mysqli_query($conn, "INSERT INTO `kelompok`(`id`, `name`, `id_mentor`, `category`) VALUES ('','$name',$mentor,'$category') ");
                    if ($sqlCreate) {
                        $last = mysqli_insert_id($conn);
                        foreach ($students as $student) {
                            $query = "UPDATE student set id_kelompok=$last where id=$student";
                            $sql = mysqli_query($conn, $query);
                            if ($sql) {
                                $stat = true;
                                echo "
                            <script>
                            Swal.fire('.'Ini adalah sweetalert Basic'.');
                            </script>
                            ";
                            } else {
                                $stat = false;
                            }
                        }
                    } else {
                    }

                    if ($stat) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil Menambah Kelompok!</strong> Cek Data Kelompok Disini .
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                    } else {
                        echo 'Gagal Input';
                    }
                }
                ?>

                </script>
                <h2>Buat Kelompok</h2>
                <div class="form-group">
                    <label for=""><strong> Nama Kelompok :</strong></label>
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Nama Kelompok">
                    <small id="helpId" class="form-text text-muted">Pastikan Nama Kelompok Berbeda Dengan Kelompok Lain</small>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Kategori Kelompok</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="exampleRadios1" value="L" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Ikhwan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="exampleRadios2" value="P">
                            <label class="form-check-label" for="exampleRadios2">
                                Akhwat
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Pembimbing Kelompok</label>
                        <select name="mentor" class="form-control" id="exampleFormControlSelect1">
                            <?php
                            $query = "SELECT * FROM mentor";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($user = mysqli_fetch_array($result)) {
                                    $id = $user['id'];
                                    $name = $user['name'];
                                    $gender = $user['gender'];
                                    echo "<option value=" . $user['id'] . '>' . "$id - $name" . '</option>';
                                }
                            } else {
                                echo "<option>Error</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <label>Untuk Memilih beberapa siswa sekaligus, tahan tombol ctrl + klik nama siswa</label><br>
                    <label><strong> Anggota Kelompok : </strong></label><br>
                    <select style="height: 200px" class="form-control" id="select-student" name="student[]" multiple="" required="">
                        <?php
                        $query = "SELECT * FROM student WHERE id_kelompok is null";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_array($result)) {
                                $id = $user['id'];
                                $name = $user['name'];
                                $gender = $user['gender'];
                                echo "<option value=" . $user['id'] . '>' . "$id - $name - $gender" . '</option>';
                            }
                        } else {
                            echo "<option>Error</option>";
                        }
                        ?>
                    </select>
                    <label>Siswa - Counter : <strong><span id="counter">0</span></strong></label><br>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <div class="">
                </div>
            </div>
            <!-- Button trigger modal -->
        </form>

    </div>

    <div class="container-fluid">
        <table id="tabel-data" class="table table-responsive  w-100 d-block d-md-table">
            <thead class="">
                <tr>
                    <th>Nomor</th>
                    <th>Nama Siswa</th>
                    <th>Kontak</th>
                    <th>Kelompok</th>
                    <th>Nama Kelompok</th>
                    <th>Musyrif</th>
                    <th>Kontak Guru</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $id = null;
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                } else if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
           
                if ($id != null) {
                    $query = "SELECT * FROM group_data_for_student where group_id='$id'";
                }else{
                    $query = "SELECT * FROM group_data_for_student";
                }


                $sql = mysqli_query($conn, $query);
                $nomor = 1;
                while ($row = mysqli_fetch_array($sql)) {
                ?>

                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['nisn']; ?></td>
                        <td><?php echo $row['group_id']; ?></td>
                        <td><?php echo $row['group_name']; ?></td>
                        <td><?php echo $row['mentor']; ?></td>
                        <td><?php echo $row['contact_mentor']; ?></td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>