<?php
include '../config/functions.php';
$db = new database();
$db->auth_dashboard();
$session = $db->data_session();

if ($session['role'] != 'admin') {
    header("location: ../login.php");
}

if(isset($_REQUEST['id_delete'])){
    $id_delete = $_REQUEST['id_delete'];

    $response = $db->delete_guru($id_delete);
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
    <title>Data Guru</title>
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

                <!-- Modal -->
                <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="data-guru.php" id="ajax-delete">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                    <button type="button" class="btn-close btn_close_dialog" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn_close_dialog" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2><b>Data Guru</b></h2>
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
                            <table class="table table-hover table-bordered">
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
                                    $no = 1;
                                    foreach($guru as $row){ ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nuptk'] ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['tempat_lahir'] ?> / <?= $row['tanggal_lahir'] ?></td>
                                            <td>
                                                <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                        class="material-icons">&#xE417;</i></a>
                                                <a href="form-edit-guru.php?id=<?= $row['id_user'] ?>" class="edit"
                                                    title="Edit" data-toggle="tooltip"><i
                                                        class="material-icons">&#xE254;</i></a>
                                                <!-- Button delete modal -->
                                                <button type="button" class="btn_delete p-0 border-0 bg-transparent"
                                                    data-bs-toggle="modal" data-id="<?= $row['id_user'] ?>"
                                                    data-bs-target="#modalDelete">
                                                    <i class="material-icons">&#xE872;</i>
                                                </button>
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
        $(document).ready(function(){
            $('.table').on('click', '.btn_delete', function () {
                let id = $(this).data('id');
                let form = $('#ajax-delete');
                let row = $(this).closest('tr');
                form.attr('action', 'data-guru.php?id_delete='+id);
                form.data('row',row);
            });

            $('.btn_close_dialog').click(function () {
                let form = $('#ajax-delete');
                form.attr('action', 'data-guru.php');
            });

            $('#ajax-delete').submit(function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let row = $(this).data('row');
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    dataType: 'JSON',
                    beforeSend: function () {
                        $('#modalDelete').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            row.remove();
                            toastr.success(response.message, 'Success !', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });
                        } else {
                            toastr.error(response.message, 'Failed !', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 1500
                            });
                        }
                    },
                    error: function (response) {
                        toastr.error(response.responseJSON.message, 'Failed !', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 1500
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>