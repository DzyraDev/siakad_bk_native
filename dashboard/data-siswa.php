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
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="../assets/css/style2.css">

    <script>
    $(document).ready(function(){
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
                          <div class="col-sm-8"><h2>Customer <b>Details</b></h2></div>
                          <div class="col-sm-4">
                              <div class="search-box">
                                  <i class="material-icons">&#xE8B6;</i>
                                  <input type="text" class="form-control" placeholder="Search&hellip;">
                              </div>
                          </div>
                          <div class="col-sm-2 mt-3">
                            <a href="form-siswa.html"  class="btn btn-primary m-1">Tambah Data</a>
                          </div>
                      </div>
                  </div>
                  <table class="table  table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NISN <i class="fa fa-sort"></i></th>
                            <th>Nama Lengkap</th>
                            <th>Kelas <i class="fa fa-sort"></i></th>
                            <th>Jurusan</th>
                            <th>Jumlah Alfa <i class="fa fa-sort"></i></th>
                            <th>No Handphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Thomas Hardy</td>
                            <td>89 Chiaroscuro Rd.</td>
                            <td>Portland</td>
                            <td>97219</td>
                            <td>97219</td>
                            <td>USA</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maria Anders</td>
                            <td>Obere Str. 57</td>
                            <td>Berlin</td>
                            <td>12209</td>
                            <td>12209</td>
                            <td>Germany</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Fran Wilson</td>
                            <td>C/ Araquil, 67</td>
                            <td>Madrid</td>
                            <td>28023</td>
                            <td>28023</td>
                            <td>Spain</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Dominique Perrier</td>
                            <td>25, rue Lauriston</td>
                            <td>Paris</td>
                            <td>75016</td>
                            <td>75016</td>
                            <td>France</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Martin Blank</td>
                            <td>Via Monte Bianco 34</td>
                            <td>Turin</td>
                            <td>10100</td>
                            <td>10100</td>
                            <td>Italy</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>        
                    </tbody>
                </table>
                  <div class="clearfix">
                      <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                      <ul class="pagination">
                          <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                          <li class="page-item"><a href="#" class="page-link">1</a></li>
                          <li class="page-item"><a href="#" class="page-link">2</a></li>
                          <li class="page-item active"><a href="#" class="page-link">3</a></li>
                          <li class="page-item"><a href="#" class="page-link">4</a></li>
                          <li class="page-item"><a href="#" class="page-link">5</a></li>
                          <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>  
      </div>   
        <!-- <div class="row">

          <div class="col-lg-12">
            <div class="table-responsive">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Guru Bk</h5>
                <button class="pr-5"> <a href="" class="badge bg-warning rounded-3 fw-semibold">Edit</a>
                </button>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">NIP</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Jenis Kelamin</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">No_Telp</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Alamat</h6>
                        </th>
                        <th class="border-bottom-0 p-6">
                          <h6 class="fw-semibold mb-0 pr-5">Aksi</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">1</h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                          <span class="fw-normal">Web Designer</span>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <a href="" class="badge bg-warning rounded-3 fw-semibold">Edit</a>
                            <a href="" class="badge bg-danger rounded-3 fw-semibold">Hapus</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">2</h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                          <span class="fw-normal">Project Manager</span>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                        </td>
                      </tr>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">3</h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                          <span class="fw-normal">Project Manager</span>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                        </td>
                      </tr>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">4</h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                          <span class="fw-normal">Frontend Engineer</span>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Hosting Press HTML</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->


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