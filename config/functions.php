<?php
class database
{
    public $conn;

    function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "db_bimbingan_konseling");
        session_start();
    }

    function register_siswa($nisn, $telepon,  $nama, $jenis_kelamin, $kelas, $username, $password)
    {
        if ($nisn && $nama && $jenis_kelamin && $kelas && $username && $password != '') {

            $get_nisn = $this->conn->prepare("SELECT nisn FROM siswa WHERE nisn=?");
            $get_nisn->bind_param("i", $nisn);
            $get_nisn->execute();
            $results_nisn = $get_nisn->get_result();
            if ($results_nisn->num_rows < 1) {
                $check_username = $this->conn->prepare("SELECT username FROM users WHERE username=?");
                $check_username->bind_param("s", $username);
                $check_username->execute();
                $get_username = $check_username->get_result();

                if ($get_username->num_rows < 1) {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $role = "siswa";
                    $regis_user = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?,?,?)");
                    $regis_user->bind_param("sss", $username, $password_hash, $role);
                    $regis_user->execute();

                    $data_user = $this->conn->prepare("SELECT id_user FROM users WHERE username=?");
                    $data_user->bind_param("s", $username);
                    $data_user->execute();
                    $results_id = $data_user->get_result()->fetch_assoc();
                    $id_user = $results_id['id_user'];

                    $regis_siswa = $this->conn->prepare("INSERT INTO siswa (id_user, nisn, nama_lengkap, jenis_kelamin, telepon, kelas) VALUES (?,?,?,?,?,?)");
                    $regis_siswa->bind_param("iissss", $id_user, $nisn, $nama, $jenis_kelamin, $telepon, $kelas);
                    $regis_siswa->execute();

                    $response = [
                        'status' => 'success',
                        'message' => 'Anda Berhasil Mendaftar',
                        'redirect' => 'login.php'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Username Sudah Digunakan',
                        'redirect' => ''
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Nisn Anda Sudah Terdaftar',
                    'redirect' => ''
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Semua Data Wajib Diisi',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function login($username, $password)
    {
        if ($username && $password != '') {
            $check_username = $this->conn->prepare("SELECT id_user, username, password FROM users WHERE username=?");
            $check_username->bind_param("s", $username);
            $check_username->execute();
            $results_user = $check_username->get_result();
            $get_user = $results_user->fetch_assoc();

            if ($results_user->num_rows > 0) {
                if (password_verify($password, $get_user['password'])) {
                    $_SESSION['id_login'] = $get_user['id_user'];
                    $response = [
                        'status' => 'success',
                        'message' => 'Username dan password sesuai',
                        'redirect' => 'dashboard/index.php'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Username dan password tidak sesuai',
                        'redirect' => ''
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Username Belum Terdaftar',
                    'redirect' => ''
                ];
            }

        } else {
            $response = [
                'status' => 'error',
                'message' => 'Semua Field Wajib Diisi',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function data_session()
    {
        $stmt = $this->conn->prepare("SELECT role FROM users WHERE id_user=?");
        $stmt->bind_param("i", $_SESSION['id_login']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }

    function auth_login()
    {
        if (isset($_SESSION['id_login'])) {
            header("location: dashboard/index.php");
        }
    }

    function auth_dashboard()
    {
        if (!isset($_SESSION['id_login'])) {
            header("location: ../login.php");
        }
    }

    function logout()
    {
        session_unset();
        session_destroy();
        header("location: ../login.php");
    }

    function count_data(){
        $count_guru = $this->conn->prepare("SELECT id_guru FROM guru_bk");
        $count_guru->execute();
        $results_guru = $count_guru->get_result()->num_rows;

        $count_siswa = $this->conn->prepare("SELECT id_siswa FROM siswa");
        $count_siswa->execute();
        $results_siswa = $count_siswa->get_result()->num_rows;

        $count_visit = $this->conn->prepare("SELECT id_home_visit FROM home_visit");
        $count_visit->execute();
        $results_visit = $count_visit->get_result()->num_rows;

        $response = [
            'jumlah_guru' => $results_guru,
            'jumlah_siswa' => $results_siswa,
            'jumlah_visit' => $results_visit,
        ];

        return $response;
    }

    function data_guru()
    {
        $role = "guru_bk";
        $stmt = $this->conn->prepare("SELECT * FROM users INNER JOIN guru_bk ON users.id_user = guru_bk.id_user WHERE users.role=?");
        $stmt->bind_param("s",$role);
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $date = date_create($row['tanggal_lahir']);
                $response[] = [
                    'id_user' => $row['id_user'],
                    'nuptk' => $row['nuptk'],
                    'nama_lengkap' => $row['nama_lengkap'],
                    'email' => $row['email'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => date_format($date, "d-m-Y"),
                ];
            }
        } else {
            $response = [];
        }

        return $response;
    }

    function add_guru($username, $password, $nuptk, $nama_lengkap, $jenis_kelamin, $email, $tanggal_lahir, $tempat_lahir)
    {

        if ($username && $password && $nuptk && $nama_lengkap && $jenis_kelamin && $email && $tanggal_lahir && $tempat_lahir != '') {

            $get_nuptk = $this->conn->prepare("SELECT nuptk FROM guru_bk WHERE nuptk=?");
            $get_nuptk->bind_param("s", $nuptk);
            $get_nuptk->execute();
            $result_nuptk = $get_nuptk->get_result();

            if ($result_nuptk->num_rows < 1) {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $role = "guru_bk";
                $add_guru = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?,?,?)");
                $add_guru->bind_param("sss", $username, $password_hash, $role);
                $add_guru->execute();

                $data_guru = $this->conn->prepare("SELECT id_user FROM users WHERE username=?");
                $data_guru->bind_param("s", $username);
                $data_guru->execute();
                $results_id = $data_guru->get_result()->fetch_assoc();
                $id_user = $results_id['id_user'];

                $add_data_guru = $this->conn->prepare("INSERT INTO guru_bk (id_user, nuptk, nama_lengkap, jenis_kelamin, email, tempat_lahir, tanggal_lahir) VALUES (?,?,?,?,?,?,?)");
                $add_data_guru->bind_param("issssss", $id_user, $nuptk, $nama_lengkap, $jenis_kelamin, $email, $tempat_lahir, $tanggal_lahir);
                $add_data_guru->execute();

                $response = [
                    'status' => 'success',
                    'message' => 'Guru Berhasil Ditambahkan',
                    'redirect' => 'data-guru.php'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'NUPTK Sudah Terdaftar',
                    'redirect' => ''
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Semua Field Wajib Diisi',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function edit_guru($id_user, $username, $password, $nama_lengkap, $jenis_kelamin, $email, $tanggal_lahir, $tempat_lahir)
    {
        if ($username && $nama_lengkap && $jenis_kelamin && $email && $tanggal_lahir && $tempat_lahir != '') {

            if ($password != '') {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $edit_guru = $this->conn->prepare("UPDATE users SET username=?, password=? WHERE id_user=?");
                $edit_guru->bind_param("ssi", $username, $password_hash, $id_user);
                $edit_guru->execute();
            } else {
                $edit_guru = $this->conn->prepare("UPDATE users SET username=? WHERE id_user=?");
                $edit_guru->bind_param("si", $username, $id_user);
                $edit_guru->execute();
            }

            $edit_data_guru = $this->conn->prepare("UPDATE guru_bk SET nama_lengkap=?, jenis_kelamin=?, email=?, tempat_lahir=?, tanggal_lahir=? WHERE id_user=?");
            $edit_data_guru->bind_param("sssssi",  $nama_lengkap, $jenis_kelamin, $email, $tempat_lahir, $tanggal_lahir, $id_user);
            $edit_data_guru->execute();

            $response = [
                'status' => 'success',
                'message' => 'Guru Berhasil Diedit',
                'redirect' => 'data-guru.php'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Semua Field Wajib Diisi Selain Password',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function form_edit_guru($id_user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users INNER JOIN guru_bk ON users.id_user = guru_bk.id_user WHERE users.id_user=?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        } else {
            header("location: data-guru.php");
        }

        return $response;
    }

    function delete_guru($id_delete){

        if($id_delete != ''){
            $stmt = $this->conn->prepare("DELETE users FROM users INNER JOIN guru_bk ON users.id_user = guru_bk.id_user WHERE users.id_user=?");
            $stmt->bind_param("i", $id_delete);
            $stmt->execute();

            $response = [
                'status' => 'success',
                'message' => 'Guru Berhasil Dihapus'
            ];
        }else{
            $response = [
                'status' => 'error',
                'message' => 'Guru Tidak Ditemukan'
            ];

        }

        return $response;
    }

    function data_siswa(): array
    {
        $role = "siswa";
        $stmt = $this->conn->prepare("SELECT * FROM users INNER JOIN siswa ON users.id_user = siswa.id_user WHERE users.role=?");
        $stmt->bind_param("s",$role);
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $response[] = [
                    'id_user' => $row['id_user'],
                    'nisn' => $row['nisn'],
                    'nama_lengkap' => $row['nama_lengkap'],
                    'kelas' => $row['kelas'],
                    'telp' => $row['telepon'],
                    'jumlah_alfa' => $row['jumlah_alfa'] == null ? 0 : $row['jumlah_alfa'],
                    'jumlah_izin' => $row['jumlah_izin'] == null ? 0 : $row['jumlah_izin'],
                    'jumlah_sakit' => $row['jumlah_sakit'] == null ? 0 : $row['jumlah_sakit'],
                ];
            }
        } else {
            $response = [];
        }

        return $response;
    }

    function add_siswa($username, $password, $nisn, $nama_lengkap, $telepon, $jenis_kelamin, $kelas, $jumlah_alfa, $jumlah_izin, $jumlah_sakit){

        if($username && $password && $nisn && $nama_lengkap && $telepon && $jenis_kelamin && $kelas != ''){
            $get_nisn = $this->conn->prepare("SELECT nisn FROM siswa WHERE nisn=?");
            $get_nisn->bind_param("i", $nisn);
            $get_nisn->execute();
            $results_nisn = $get_nisn->get_result();

            if ($results_nisn->num_rows < 1) {
                $check_username = $this->conn->prepare("SELECT username FROM users WHERE username=?");
                $check_username->bind_param("s", $username);
                $check_username->execute();
                $get_username = $check_username->get_result();

                if ($get_username->num_rows < 1) {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $role = "siswa";
                    $regis_user = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?,?,?)");
                    $regis_user->bind_param("sss", $username, $password_hash, $role);
                    $regis_user->execute();

                    $data_user = $this->conn->prepare("SELECT id_user FROM users WHERE username=?");
                    $data_user->bind_param("s", $username);
                    $data_user->execute();
                    $results_id = $data_user->get_result()->fetch_assoc();
                    $id_user = $results_id['id_user'];

                    $regis_siswa = $this->conn->prepare("INSERT INTO siswa (id_user, nisn, nama_lengkap, jenis_kelamin, telepon, kelas, jumlah_alfa, jumlah_izin, jumlah_sakit) VALUES (?,?,?,?,?,?,?,?,?)");
                    $regis_siswa->bind_param("iissssiii", $id_user, $nisn, $nama_lengkap, $jenis_kelamin, $telepon, $kelas, $jumlah_alfa, $jumlah_izin, $jumlah_sakit);
                    $regis_siswa->execute();

                    $response = [
                        'status' => 'success',
                        'message' => 'Siswa Berhasil Ditambahkan',
                        'redirect' => 'data-siswa.php'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Username Sudah Terdaftar',
                        'redirect' => ''
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Nisn Sudah Terdaftar',
                    'redirect' => ''
                ];
            }
        }else{
            $response = [
                'status' => 'error',
                'message' => 'Semua Data Wajib Diisi',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function edit_siswa($id_user, $username, $password, $nisn, $nama_lengkap, $telepon, $jenis_kelamin, $kelas, $jumlah_alfa, $jumlah_izin, $jumlah_sakit){
        if ($username && $nisn && $nama_lengkap && $telepon && $jenis_kelamin && $kelas != '') {
            
            if ($password != '') {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $edit_guru = $this->conn->prepare("UPDATE users SET username=?, password=? WHERE id_user=?");
                $edit_guru->bind_param("ssi", $username, $password_hash, $id_user);
                $edit_guru->execute();
            } else {
                $edit_guru = $this->conn->prepare("UPDATE users SET username=? WHERE id_user=?");
                $edit_guru->bind_param("si", $username, $id_user);
                $edit_guru->execute();
            }

            $edit_data_guru = $this->conn->prepare("UPDATE siswa SET nama_lengkap=?, jenis_kelamin=?, telepon=?, kelas=?, jumlah_alfa=?, jumlah_izin=?, jumlah_sakit=?  WHERE id_user=?");
            $edit_data_guru->bind_param("ssssiiii",  $nama_lengkap, $jenis_kelamin, $telepon, $kelas, $jumlah_alfa, $jumlah_izin, $jumlah_sakit, $id_user);
            $edit_data_guru->execute();

            $response = [
                'status' => 'success',
                'message' => 'Siswa Berhasil Diedit',
                'redirect' => 'data-siswa.php'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Semua Field Wajib Diisi Selain Password',
                'redirect' => ''
            ];
        }

        return $response;
    }

    function form_edit_siswa($id_user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users INNER JOIN siswa ON users.id_user = siswa.id_user WHERE users.id_user=?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        } else {
            header("location: data-siswa.php");
        }

        return $response;
    }

    function delete_siswa($id_delete){

        if($id_delete != ''){
            $stmt = $this->conn->prepare("DELETE users FROM users INNER JOIN siswa ON users.id_user = siswa.id_user WHERE users.id_user=?");
            $stmt->bind_param("i", $id_delete);
            $stmt->execute();

            $response = [
                'status' => 'success',
                'message' => 'Siswa Berhasil Dihapus'
            ];
        }else{
            $response = [
                'status' => 'error',
                'message' => 'Siswa Tidak Ditemukan'
            ];

        }

        return $response;
    }
}
?>