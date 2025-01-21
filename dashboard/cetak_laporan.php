<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'guru_bk' && $session['role'] != 'kepala_sekolah') {
    header("location: ../login.php");
}
$dari_tanggal = isset($_POST['dari_tanggal']) ? $_POST['dari_tanggal'] : '';
$sampai_tanggal = isset($_POST['sampai_tanggal']) ? $_POST['sampai_tanggal'] : '';

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Visit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style2.css">
</head>

<body>
    <!--  Header End -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
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
                        $guru = $db->cetak_laporan($dari_tanggal, $sampai_tanggal);
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
                                        class="<?= $row['status'] == 'pending' ? 'bg-danger' : 'bg-success' ?> py-2 px-3 text-white rounded-3"><?= $row['status'] ?></span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>