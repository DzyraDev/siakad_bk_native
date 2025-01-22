<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'admin') {
    header("location: ../index.php");
}

if (isset($_GET['logout'])) {
    $db->logout();
}

if (isset($_POST['username'])) {
    $id_user = isset($_POST['id_user']) ? strip_tags($_POST['id_user']) : '';
    $username = isset($_POST['username']) ? strip_tags($_POST['username']) : '';
    $password = isset($_POST['password']) ? strip_tags($_POST['password']) : '';
    $nuptk = isset($_POST['nuptk']) ? strip_tags($_POST['nuptk']) : '';
    $nama_lengkap = isset($_POST['nama_lengkap']) ? strip_tags($_POST['nama_lengkap']) : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? strip_tags($_POST['jenis_kelamin']) : '';
    $email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $tempat_lahir = isset($_POST['tempat_lahir']) ? strip_tags($_POST['tempat_lahir']) : '';

    $response = $db->edit_guru($id_user, $username, $password, $nama_lengkap, $jenis_kelamin, $email, $tanggal_lahir, $tempat_lahir);
    echo json_encode($response);
    exit;
}

$id_user = isset($_GET['id']) ? $_GET['id'] : '';

$data_guru = $db->form_edit_guru($id_user);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Guru</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/toastr.min.css">

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php
        include '../include/sidebar.php';
        ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            include '../include/header.php';
            ?>
            <!--  Header End -->
            <div class="container-fluid">

                <div class="container-fluid">
                    <div class="container-fluid">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-4">Edit Data Guru BK</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="form-edit-guru.php" method="POST" id="form_edit_guru">
                                            <input type="hidden" value="<?= $id_user ?>" name="id_user">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" value="<?= $data_guru['username'] ?>" name="username" id="username">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Masukkan password jika ingin mengganti" id="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nuptk" class="form-label">NUPTK</label>
                                                <input type="text" class="form-control" value="<?= $data_guru['nuptk'] ?>" name="nuptk" id="nuptk"
                                                    aria-describedby="emailHelp" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="<?= $data_guru['nama_lengkap'] ?>" name="nama_lengkap" id="nama">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Jenis
                                                    Kelamin</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="jenis_kelamin">
                                                    <option selected>PILIH JENIS KELAMIN</option>
                                                    <option value="L" <?= $data_guru['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki Laki</option>
                                                    <option value="P" <?= $data_guru['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" value="<?= $data_guru['email'] ?>" name="email" id="email">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="Tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" value="<?= $data_guru['tanggal_lahir'] ?>" name="tanggal_lahir"
                                                            id="Tanggal_lahir">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="tempat_lahir" class="form-label">Tempat
                                                            Lahir</label>
                                                        <input type="text" class="form-control" value="<?= $data_guru['tempat_lahir'] ?>" name="tempat_lahir"
                                                            id="tempat_lahir">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form_edit_guru').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let data = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: method,
                    processData: false,
                    contentType: false,
                    data: data,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, 'Success !', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });

                            setTimeout(function() {
                                if (response.redirect != "") {
                                    location.href = response.redirect;
                                }
                            }, 1800);
                        } else {
                            toastr.error(response.message, 'Failed !', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>