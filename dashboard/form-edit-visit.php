<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'guru_bk') {
    header("location: ../index.php");
}

if (isset($_GET['logout'])) {
    $db->logout();
}

if (isset($_POST['siswa'])) {
    $id_visit = isset($_POST['id_visit']) ? strip_tags($_POST['id_visit']) : '';
    $tujuan_kunjungan = isset($_POST['tujuan_kunjungan']) ? strip_tags($_POST['tujuan_kunjungan']) : '';
    $siswa = isset($_POST['siswa']) ? strip_tags($_POST['siswa']) : '';
    $tanggal_kunjungan = isset($_POST['tanggal_kunjungan']) ? $_POST['tanggal_kunjungan'] : '';
    $status = isset($_POST['status']) ? strip_tags($_POST['status']) : '';
    $hasil_kunjungan = !empty($_POST['hasil_kunjungan']) ? strip_tags($_POST['hasil_kunjungan']) : null;
    $tindak_lanjut = !empty($_POST['tindak_lanjut']) ? strip_tags($_POST['tindak_lanjut']) : null;

    $response = $db->edit_visit($id_visit, $tujuan_kunjungan, $siswa, $tanggal_kunjungan, $status, $hasil_kunjungan, $tindak_lanjut);
    echo json_encode($response);
    exit;
}

$id_visit = isset($_GET['id']) ? $_GET['id'] : '';

$data_visit = $db->single_data_visit($id_visit);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Visit</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/toastr.min.css">
    <link rel="stylesheet" href="../assets/css/select2.min.css">

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
                                <h5 class="card-title fw-semibold mb-4">Edit Visit</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="form-edit-visit.php" method="POST" id="form_edit_visit">
                                            <input type="hidden" value="<?= $data_visit['id_home_visit'] ?>" name="id_visit">
                                            <div class="mb-3">
                                                <label for="tujuan_kunjungan" class="form-label">Tujuan Kunjungan</label>
                                                <input type="text" class="form-control" value="<?= $data_visit['tujuan_kunjungan'] ?>" name="tujuan_kunjungan" id="tujuan_kunjungan">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="siswa" class="form-label">Nama Siswa</label><br>
                                                        <select class="js-example-basic-single form-select p-5 w-100" name="siswa">
                                                            <option value="two" disabled="disabled" selected>Pilih Siswa</option>
                                                            <?php
                                                            $data_siswa = $db->data_siswa();
                                                            foreach ($data_siswa as $row) { ?>
                                                                <option value="<?= $row['id_siswa'] ?>" <?= $data_visit['id_siswa'] == $row['id_siswa'] ? 'selected' : '' ?>><?= $row['nama_lengkap']; ?> - <?= $row['kelas'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                                                        <input type="date" class="form-control" value="<?= $data_visit['tanggal_kunjungan'] ?>" name="tanggal_kunjungan" id="tanggal_kunjungan">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-select" aria-label="Default select example" name="status" id="status">
                                                            <option selected>PILIH STATUS</option>
                                                            <option value="selesai" <?= $data_visit['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                            <option value="pending" <?= $data_visit['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="hasil_kunjungan" class="form-label">Hasil Kunjungan</label>
                                                        <input type="text" class="form-control" value="<?= $data_visit['hasil_kunjungan'] ?>" name="hasil_kunjungan" id="hasil_kunjungan">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                                                        <input type="text" class="form-control" value="<?= $data_visit['tindak_lanjut'] ?>" name="tindak_lanjut" id="tindak_lanjut">
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
    <script src="../assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih Siswa",
                width: "resolve"
            });

            $('#form_edit_visit').submit(function(e) {
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