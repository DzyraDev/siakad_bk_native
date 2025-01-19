<?php 
    include '../config/functions.php';
    $db = new database();
    $db->auth_dashboard();
    $session = $db->data_session();

    if($session['role'] != 'admin'){
        header("location: ../login.php");
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
    <title>Data Guru</title>
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
                <div class="row">
                    <div class="col-lg-4 flex-column">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Yearly Breakup -->
                                <div class="card overflow-hidden">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-9 fw-semibold">Total Guru BK</h5>
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="fw-semibold mb-3">$36,358</h4>

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
                                                <h4 class="fw-semibold mb-3">$36,358</h4>

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
                                                <h4 class="fw-semibold mb-3">$36,358</h4>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2>Customer <b>Details</b></h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="search-box">
                                            <i class="material-icons">&#xE8B6;</i>
                                            <input type="text" class="form-control" placeholder="Search&hellip;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mt-3">
                                        <a href="form-guru.php" class="btn btn-primary m-1">Tambah Guru </a>
                                    </div>
                                </div>
                            </div>
                            <table class="table  table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NUPTK <i class="fa fa-sort"></i></th>
                                        <th>Nama Lengkap</th>
                                        <th>Email <i class="fa fa-sort"></i></th>
                                        <th>Tempat/Tgl Lahir</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $guru = $db->data_guru();
                                    ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $guru['nuptk'] ?></td>
                                        <td><?= $guru['nama_lengkap'] ?></td>
                                        <td><?= $guru['email'] ?></td>
                                        <td><?= $guru['tempat_lahir'] ?> / <?= $guru['tanggal_lahir'] ?></td>
                                        <td>
                                            <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                    class="material-icons">&#xE417;</i></a>
                                            <a href="form-edit-guru.php?id=<?= $guru['id_user'] ?>" class="edit" title="Edit" data-toggle="tooltip"><i
                                                    class="material-icons">&#xE254;</i></a>
                                            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                    class="material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

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