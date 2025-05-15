<?php
include 'config/functions.php';

$db = new database();
$db->auth_login();

if (isset($_POST['nisn'])) {
    $nisn = isset($_POST['nisn']) ? strip_tags($_POST['nisn']) : '';
    $telepon = isset($_POST['telepon']) ? strip_tags($_POST['telepon']) : '';
    $nama = isset($_POST['nama_lengkap']) ? strip_tags($_POST['nama_lengkap']) : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? strip_tags($_POST['jenis_kelamin']) : '';
    $kelas = isset($_POST['kelas']) ? strip_tags($_POST['kelas']) : '';
    $username = isset($_POST['username']) ? strip_tags($_POST['username']) : '';
    $password = isset($_POST['password']) ? strip_tags($_POST['password']) : '';

    $response = $db->register_siswa($nisn, $telepon,  $nama, $jenis_kelamin,  $kelas, $username, $password);
    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/style2.css" />
    <link rel="stylesheet" href="assets/css/toastr.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6">
                        <div class="card mb-0">
                            <div class="card-body">
                                <p class="text-center">PENDAFTARAN AKUN</p>
                                <form action="register.php" id="form_regis" method="POST">
                                    <div class="row mt-5">
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="nama_lengkap" />
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">NISN</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1" name="nisn"
                                                    aria-describedby="emailHelp" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="telepon" class="form-label">No Whatsapp</label>
                                                <input type="text" class="form-control" id="telepon"
                                                    name="telepon" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                                    <option selected>PILIH JENIS KELAMIN</option>
                                                    <option value="L">Laki Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label">Kelas / Jurusan</label>
                                                <select class="form-select" aria-label="Default select example" name="kelas">
                                                    <option selected>PILIH KELAS</option>
                                                    <option value="10 RPL 1">10 RPL 1</option>
                                                    <option value="10 RPL 2">10 RPL 2</option>
                                                    <option value="10 TKJ 1">10 TKJ 1</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    name="username" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    name="password" />
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Sudah Punya Akun?</p>
                                        <a class="text-primary fw-bold ms-2" href="index.php">Masuk</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form_regis').submit(function(e) {
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