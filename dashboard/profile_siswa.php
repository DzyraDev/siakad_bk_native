<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'siswa') {
    header("location: ../index.php");
}

if (isset($_GET['logout'])) {
    $db->logout();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Siswa</title>
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
                                <h5 class="card-title fw-semibold mb-4">Profil Siswa/i</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control"
                                                        value="<?= $session['username'] ?>" name="username"
                                                        id="username" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nisn" class="form-label">NISN</label>
                                                    <input type="number" class="form-control" value="<?= $session['nisn'] ?>"
                                                        name="nisn" id="nisn" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nama_lengkap" class="form-label">Nama
                                                        Lengkap</label>
                                                    <input type="text" class="form-control"
                                                        value="<?= $session['nama_lengkap'] ?>" name="nama_lengkap"
                                                        id="nama_lengkap" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="telepon" class="form-label">No Whatsapp</label>
                                                    <input type="text" class="form-control"
                                                        value="<?= $session['telepon'] ?>" name="telepon" id="telepon" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="exampleInputPassword1" class="form-label">Jenis
                                                        Kelamin</label>
                                                    <input type="text" class="form-control" value="<?= $session['jenis_kelamin'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="kelas" class="form-label">Kelas / Jurusan</label>
                                                    <input type="text" class="form-control" value="<?= $session['kelas'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="jumlah_alfa" class="form-label">Jumlah Alfa</label>
                                                    <input type="number" class="form-control" name="jumlah_alfa"
                                                        value="<?= $session['jumlah_alfa'] ?>" id="jumlah_alfa"
                                                        placeholder="0" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="jumlah_izin" class="form-label">Jumlah Izin</label>
                                                    <input type="number" class="form-control" name="jumlah_izin"
                                                        value="<?= $session['jumlah_izin'] ?>" id="jumlah_izin"
                                                        placeholder="0" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="jumlah_sakit" class="form-label">Jumlah Sakit</label>
                                                    <input type="number" class="form-control" name="jumlah_sakit"
                                                        value="<?= $session['jumlah_sakit'] ?>" id="jumlah_sakit"
                                                        placeholder="0" disabled>
                                                </div>
                                            </div>
                                        </div>
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
</body>

</html>