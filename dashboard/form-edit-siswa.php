<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'admin') {
    header("location: ../login.php");
}

if (isset($_GET['logout'])) {
    $db->logout();
}

if (isset($_POST['nisn'])) {
    $id_user = isset($_POST['id_user']) ? strip_tags($_POST['id_user']) : '';
    $username = isset($_POST['username']) ? strip_tags($_POST['username']) : '';
    $password = isset($_POST['password']) ? strip_tags($_POST['password']) : '';
    $nisn = isset($_POST['nisn']) ? strip_tags($_POST['nisn']) : '';
    $nama_lengkap = isset($_POST['nama_lengkap']) ? strip_tags($_POST['nama_lengkap']) : '';
    $telepon = isset($_POST['telepon']) ? strip_tags($_POST['telepon']) : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? strip_tags($_POST['jenis_kelamin']) : '';
    $kelas = isset($_POST['kelas']) ? strip_tags($_POST['kelas']) : '';
    $jumlah_alfa = !empty($_POST['jumlah_alfa']) ? strip_tags($_POST['jumlah_alfa']) : null;
    $jumlah_izin = !empty($_POST['jumlah_izin']) ? strip_tags($_POST['jumlah_izin']) : null;
    $jumlah_sakit = !empty($_POST['jumlah_sakit']) ? strip_tags($_POST['jumlah_sakit']) : null;

    $response = $db->edit_siswa($id_user, $username, $password, $nisn, $nama_lengkap, $telepon, $jenis_kelamin, $kelas, $jumlah_alfa, $jumlah_izin, $jumlah_sakit);
    echo json_encode($response);
    exit;
}

$id_user = isset($_GET['id']) ? $_GET['id'] : '';

$data_siswa = $db->form_edit_siswa($id_user);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
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
        $(document).ready(function () {
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
                                <h5 class="card-title fw-semibold mb-4">Edit Data Siswa/i</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="form-edit-siswa.php" method="POST" id="form_edit_siswa">
                                            <input type="hidden" name="id_user" value="<?= $data_siswa['id_user'] ?>">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" value="<?= $data_siswa['username'] ?>" name="username" id="username">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nisn" class="form-label">NISN</label>
                                                <input type="number" class="form-control" value="<?= $data_siswa['nisn'] ?>" name="nisn" id="nisn">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama
                                                    Lengkap</label>
                                                <input type="text" class="form-control" value="<?= $data_siswa['nama_lengkap'] ?>" name="nama_lengkap" id="nama_lengkap">
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon" class="form-label">No Whatsapp</label>
                                                <input type="text" class="form-control" value="<?= $data_siswa['telepon'] ?>" name="telepon" id="telepon">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-4">
                                                        <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                                            <option selected>PILIH JENIS KELAMIN</option>
                                                            <option value="L" <?= $data_siswa['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki Laki</option>
                                                            <option value="P" <?= $data_siswa['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-4">
                                                        <label for="kelas" class="form-label">Kelas / Jurusan</label>
                                                        <select class="form-select" aria-label="Default select example" id="kelas" name="kelas">
                                                            <option selected>PILIH KELAS</option>
                                                            <option value="10 RPL 1" <?= $data_siswa['kelas'] == '10 RPL 1' ? 'selected' : '' ?>>10 RPL 1</option>
                                                            <option value="10 RPL 2" <?= $data_siswa['kelas'] == '10 RPL 2' ? 'selected' : '' ?>>10 RPL 2</option>
                                                            <option value="10 TKJ 1" <?= $data_siswa['kelas'] == '10 TKJ 1' ? 'selected' : '' ?>>10 TKJ 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="jumlah_alfa" class="form-label">Jumlah Alfa</label>
                                                        <input type="number" class="form-control" name="jumlah_alfa" value="<?= $data_siswa['jumlah_alfa'] ?>" id="jumlah_alfa" placeholder="Kosongkan jika jumlahnya 0">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="jumlah_izin" class="form-label">Jumlah Izin</label>
                                                        <input type="number" class="form-control" name="jumlah_izin" value="<?= $data_siswa['jumlah_izin'] ?>" id="jumlah_izin" placeholder="Kosongkan jika jumlahnya 0">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="jumlah_sakit" class="form-label">Jumlah Sakit</label>
                                                        <input type="number" class="form-control" name="jumlah_sakit" value="<?= $data_siswa['jumlah_sakit'] ?>" id="jumlah_sakit" placeholder="Kosongkan jika jumlahnya 0">
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
        $(document).ready(function () {
            $('#form_edit_siswa').submit(function (e) {
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
                    success: function (response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, 'Success !', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });

                            setTimeout(function () {
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