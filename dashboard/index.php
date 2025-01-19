<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

$count_data = $db->count_data();

if (isset($_GET['logout'])) {
    $db->logout();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
                <!--  Row 1 -->
                <div class="row mt-4">
                    <div class="col-lg-4 flex-column">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Yearly Breakup -->
                                <div class="card overflow-hidden">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-9 fw-semibold">Total Guru BK</h5>
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="fw-semibold mb-3"><?= $count_data['jumlah_guru'] ?></h4>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-4 flex-column">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Yearly Breakup -->
                                <div class="card overflow-hidden">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-9 fw-semibold">Total Siswa</h5>
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="fw-semibold mb-3"><?= $count_data['jumlah_siswa'] ?></h4>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-4 flex-column">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Yearly Breakup -->
                                <div class="card overflow-hidden">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-9 fw-semibold">Total Home Visit</h5>
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="fw-semibold mb-3"><?= $count_data['jumlah_visit'] ?></h4>

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