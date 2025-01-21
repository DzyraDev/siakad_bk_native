<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'guru_bk') {
    header("location: ../login.php");
}

if (isset($_GET['logout'])) {
    $db->logout();
}

$id_visit = isset($_GET['id']) ? $_GET['id'] : '';

$data_visit = $db->single_data_visit($id_visit);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Visit</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style2.css">

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
                                <h5 class="card-title fw-semibold mb-4">Detail Visit</h5>
                                <div class="card">
                                    <div class="card-body">
                                            <input type="hidden" value="<?= $data_visit['id_home_visit'] ?>" name="id_visit">
                                            <div class="mb-3">
                                                <label for="tujuan_kunjungan" class="form-label">Tujuan Kunjungan</label>
                                                <input type="text" class="form-control" value="<?= $data_visit['tujuan_kunjungan'] ?>" name="tujuan_kunjungan" id="tujuan_kunjungan" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                                                <input type="text" class="form-control" value="<?= $data_visit['tindak_lanjut'] ?>" name="tindak_lanjut" id="tindak_lanjut" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">Penilaian</label>
                                                <input type="text" class="form-control" value="<?= $data_visit['rating'] ?>" name="rating" id="rating" disabled>
                                            </div>
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
</body>

</html>