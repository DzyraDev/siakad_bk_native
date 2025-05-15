<?php
include 'config/functions.php';

$db = new database();
$db->auth_login();

if (isset($_POST['username'])) {
  $username = isset($_POST['username']) ? strip_tags($_POST['username']) : '';
  $password = isset($_POST['password']) ? strip_tags($_POST['password']) : '';
  $response = $db->login($username, $password);
  echo json_encode($response);
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
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
          <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">

                <h1 class="text-center font-italic">SIAKAD SMK 2 BANDAR LAMPUNG</h1>
                <form action="index.php" method="POST" id="form_login">

                  <div class="mb-4 mt-5">
                    <label for="exampleInputPassword1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="username" />
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" />
                  </div>

                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum Punya Akun?</p>
                    <a class="text-primary fw-bold ms-2" href="register.php">Buat akun</a>
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
    $('#form_login').submit(function(e) {
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