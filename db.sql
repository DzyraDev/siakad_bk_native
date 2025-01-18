-- Create database
CREATE DATABASE db_bimbingan_konseling;
USE db_bimbingan_konseling;

-- Table users (untuk autentikasi)
CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'guru_bk', 'siswa', 'kepala_sekolah') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table guru_bk
CREATE TABLE guru_bk (
    id_guru INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    nip VARCHAR(20) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    no_telp VARCHAR(15),
    alamat TEXT,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Table siswa
CREATE TABLE siswa (
    id_siswa INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    nis VARCHAR(20) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    kelas VARCHAR(10) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    tahun_masuk YEAR NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Table home_visit
CREATE TABLE home_visit (
    id_home_visit INT PRIMARY KEY AUTO_INCREMENT,
    id_guru INT,
    id_siswa INT,
    tanggal_kunjungan DATE NOT NULL,
    tujuan_kunjungan TEXT NOT NULL,
    hasil_kunjungan TEXT NOT NULL,
    tindak_lanjut TEXT,
    status ENUM('pending', 'selesai') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_guru) REFERENCES guru_bk(id_guru),
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);

-- Table kepuasan_layanan
CREATE TABLE kepuasan_layanan (
    id_kepuasan INT PRIMARY KEY AUTO_INCREMENT,
    id_home_visit INT,
    id_siswa INT,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    komentar TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_home_visit) REFERENCES home_visit(id_home_visit),
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);