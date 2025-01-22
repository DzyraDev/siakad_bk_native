<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'guru_bk' && $session['role'] != 'kepala_sekolah') {
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
    <title>Laporan Visit</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">

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
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="mb-4">
                                <h2><b>Laporan Home Visit</b></h2>
                            </div>
                            <form action="cetak_laporan.php" method="POST">
                                <div class="d-flex">
                                    <input type="date" name="dari_tanggal" class="form-control me-3" placeholder="Dari Tanggal" required>
                                    <input type="date" name="sampai_tanggal" class="form-control me-3" placeholder="Sampai Tanggal" required>
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </form>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Guru BK<i class="fa fa-sort"></i></th>
                                    <th>Siswa</th>
                                    <th>Tujuan Kunjungan <i class="fa fa-sort"></i></th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Hasil Kunjungan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $guru = $db->data_visit();
                                $no = 1;
                                foreach ($guru as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['guru'] ?></td>
                                        <td><?= $row['siswa'] ?></td>
                                        <td><?= $row['tujuan'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['hasil'] ?></td>
                                        <td>
                                            <span
                                                class="<?= $row['status'] == 'pending' ? 'bg-danger' : 'bg-success' ?> py-1 px-3 text-white rounded-3"><?= $row['status'] ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
</body>

</html>