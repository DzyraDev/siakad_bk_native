<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'siswa') {
    header("location: ../index.php");
}

if (isset($_POST['rating'])) {
    $id_siswa = isset($_POST['id_siswa']) ? strip_tags($_POST['id_siswa']) : '';
    $id_visit = isset($_POST['id_visit']) ? strip_tags($_POST['id_visit']) : '';
    $rating = isset($_POST['rating']) ? strip_tags($_POST['rating']) : '';

    $response = $db->penilaian_visit($id_siswa, $id_visit, $rating);
    echo json_encode($response);
    exit;
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
    <title>Riwayat Kunjungan</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/toastr.min.css">
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
                                <h2><b>Riwayat Home Visit</b></h2>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Guru BK<i class="fa fa-sort"></i></th>
                                    <th>Tujuan Kunjungan <i class="fa fa-sort"></i></th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Hasil Kunjungan</th>
                                    <th>Status</th>
                                    <th>Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $guru = $db->riwayat_visit_siswa($session['id_siswa']);
                                $no = 1;
                                foreach ($guru as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['guru'] ?></td>
                                        <td><?= $row['tujuan'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['hasil'] ?></td>
                                        <td>
                                            <span class="<?= $row['status'] == 'pending' ? 'bg-danger' : 'bg-success' ?> py-1 px-3 text-white rounded-3"><?= $row['status'] ?></span>
                                        </td>
                                        <td>
                                            <form action="riwayat-kunjungan.php" method="POST" id="form_rating">
                                                <select class="form-select" aria-label="Default select example" name="rating" id="rating" data-visit="<?= $row['id_visit'] ?>" data-siswa="<?= $row['id_siswa'] ?>">
                                                    <option selected>Penilaian</option>
                                                    <option value="sangat baik" <?= $row['rating'] == 'sangat baik' ? 'selected' : '' ?>>Sangat Baik</option>
                                                    <option value="baik" <?= $row['rating'] == 'baik' ? 'selected' : '' ?>>Baik</option>
                                                    <option value="cukup baik" <?= $row['rating'] == 'cukup baik' ? 'selected' : '' ?>>Cukup baik</option>
                                                    <option value="buruk" <?= $row['rating'] == 'buruk' ? 'selected' : '' ?>>Buruk</option>
                                                </select>
                                            </form>
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
    <script src="../assets/js/toastr.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            $("#rating").change(function() {
                let form = $('#form_rating');
                let url = form.attr('action');
                let method = form.attr('method');
                let rating = $(this).val();
                let id_siswa = $(this).data('siswa');
                let id_visit = $(this).data('visit');

                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        rating: rating,
                        id_siswa: id_siswa,
                        id_visit: id_visit
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });
                        } else {
                            toastr.error(response.message, 'Failed!', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>