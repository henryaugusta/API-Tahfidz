<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Motivasi</title>

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
            // $('#tabel-data').DataTable({
            // });

            $('#tabel-data').dataTable({
                "columnDefs": [{
                    "width": "60%",
                    "targets": 3
                }],
                "columnDefs": [{
                    "width": "5%",
                    "targets": 2
                }]
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

            $('#my-modal').on('show.bs.modal', function(event) {
                var myVal = $(event.relatedTarget).data('val');
                $(this).find(".img-prev").attr("src", (myVal));
            });

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


    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Tambah Motivasi</a>
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

    <div class="card">
        <form action="create_motivation.php" method="post">
            <div class="container">
                </script>
                <h2>Tambah Motivasi</h2>

                <div class="form-group">
                    <?php
                    include '../connect.php';
                    if (isset($_POST['submitMot'])) {
                        $title =  mysqli_escape_string($conn, $_POST['name']);
                        $content = mysqli_escape_string($conn, $_POST['content']);
                        $cover = mysqli_escape_string($conn, $_POST['cover']);
                        //   $query = "INSERT INTO `motivation` (`title,`cover`,`content`) 

                        $query = "INSERT INTO `motivation`(`title`, `cover`, `content`) VALUES ('$title','$cover','$content')";
                        $sql = mysqli_query($conn, $query);
                        if ($sql) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Menambah Motivasi!</strong> Cek Daftar Motivasi pada tabel dibawah .
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                        } else {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Gagal Menambah Motivasik!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                        }
                    }

                    if (isset($_POST['deleteMot'])) {
                        // echo $_POST['deleteMot'];
                        $idDel = $_POST['deleteMot'];
                        $queryDel = "DELETE FROM `motivation` WHERE `id`=$idDel";
                        $sqlDel = mysqli_query($conn, $queryDel);
                        if (false === $sqlDel) {
                            printf("error: ", mysqli_error($conn));
                            printf("\n\n$queryDel");
                        }
                        if ($sqlDel) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Menghapus Motivasi!</strong> Cek Daftar Motivasi pada tabel dibawah .
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                        } else {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Gagal Menghapus Motivasi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                        }
                    }

                    ?>
                </div>
                <div class="form-group">
                    <label for=""><strong>Judul Motivasi</strong></label>
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Judul Motivasi" required>
                    <small id="helpId" class="form-text text-muted">Maximal 15 Character</small>
                </div>
                <div class="form-group">
                    <label for=""><strong>URL Cover Motivasi</strong></label>
                    <input type="text" class="form-control" name="cover" id="" aria-describedby="helpId" placeholder="Judul Motivasi" required>
                    <small id="helpId" class="form-text text-muted">Maximal 15 Character</small>
                </div>
                <div class="form-group">
                    <label>Masukkan Isi Motivasi</label>
                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="5" required></textarea>
                </div>

                <button type="submit" name="submitMot" class="btn btn-primary">Submit</button>
            </div>




            <!-- Button trigger modal -->

        </form>

    </div>

    <form action="create_motivation.php" method="post">
        <div class="container-fluid">
            <table id="tabel-data" class="table table-responsive  w-100 d-block d-md-table">
                <thead class="">
                    <tr>
                        <th>Nomor</th>
                        <th>Judul Motivasi</th>
                        <th>URL Gambar</th>
                        <th>Motivasi</th>
                        <th></th>
                    </tr>
                </thead>

                <?php
                $query = "select * from motivation";
                $sqlz = mysqli_query($conn, $query);
                $nomor = 1;
                while ($row = mysqli_fetch_array($sqlz)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td>
                            <a href="#" class="my_link btn btn-primary" data-val="<?php echo $row['cover'] ?>" data-toggle="modal" data-target="#my-modal">Lihat Gambar</a>
                        </td>
                        <td><?php echo $row['content']; ?></td>
                        <td>
                            <button type="submit" name="deleteMot" value="<?php echo $row['id'] ?>" id="" class="btn btn-warning btn-sm btn-block">Delete</button></td>
                    </tr>

                <?php
                }

                ?>
            </table>


            <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <img class="img-prev img-responsive img-thumbnail" src="" alt="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

    </form>

    </tbody>
    </table>
    </div>
</body>

</html>