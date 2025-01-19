-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bimbingan_konseling`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru_bk`
--

CREATE TABLE `guru_bk` (
  `id_guru` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru_bk`
--

INSERT INTO `guru_bk` (`id_guru`, `id_user`, `nuptk`, `nama_lengkap`, `jenis_kelamin`, `email`, `tempat_lahir`, `tanggal_lahir`) VALUES
(1, 3, '2372832', 'Agus Subakti', 'L', 'Agus@gmail.com', 'Bandar Lampung', '1984-01-19'),
(2, 4, '32783278', 'Eko Prasetyo', 'L', 'eko@gmail.com', 'Natar', '1990-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `home_visit`
--

CREATE TABLE `home_visit` (
  `id_home_visit` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `tujuan_kunjungan` text NOT NULL,
  `hasil_kunjungan` text NOT NULL,
  `tindak_lanjut` text DEFAULT NULL,
  `status` enum('pending','selesai') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kepuasan_layanan`
--

CREATE TABLE `kepuasan_layanan` (
  `id_kepuasan` int(11) NOT NULL,
  `id_home_visit` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jumlah_alfa` int(20) DEFAULT NULL,
  `jumlah_izin` int(20) DEFAULT NULL,
  `jumlah_sakit` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user`, `nisn`, `nama_lengkap`, `jenis_kelamin`, `telepon`, `kelas`, `jumlah_alfa`, `jumlah_izin`, `jumlah_sakit`) VALUES
(1, 1, '9028392', 'M.Ridho Nuril Ibrahim', 'L', '089578953456', '10 RPL 2', NULL, NULL, NULL),
(2, 2, '330846', 'Aris Hendradian', 'L', '082156743876', '10 RPL 2', NULL, NULL, NULL),
(3, 5, '272893', 'Ikhlasul Amal', 'L', '08657353745', '10 RPL 2', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru_bk','siswa','kepala_sekolah') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Ridho', '$2y$10$yB5Qcgf4l8M5l3w2uOjgH.Ae9Y2e4NhJTDOxLQd7L8lstzVsahNES', 'admin', '2025-01-19 02:36:33'),
(2, 'Aris', '$2y$10$jOpUNDcL01t34q7VChe7luv426y00UQP6qYcRSvhB9zIxiiAhIS3K', 'siswa', '2025-01-19 02:38:01'),
(3, 'Agus', '$2y$10$HUxVjkv4jonBmEHlc.PlS.VZyTMvuuIuNyzuJs1Q04t9fJgRNTe2a', 'guru_bk', '2025-01-19 13:26:07'),
(4, 'Eko', '$2y$10$zocKCxOpPhd4tePoGvwcIeitl2tnVmfGgghrpkmUo/ZXcM8VZEZiy', 'guru_bk', '2025-01-19 13:26:36'),
(5, 'Ikhlas', '$2y$10$6qxe54mJykaRBZllZ4sMfebLV45o2Z4uDBeUsGu1eLdfRtxc0VQh.', 'siswa', '2025-01-19 14:03:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru_bk`
--
ALTER TABLE `guru_bk`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nuptk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `home_visit`
--
ALTER TABLE `home_visit`
  ADD PRIMARY KEY (`id_home_visit`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  ADD PRIMARY KEY (`id_kepuasan`),
  ADD KEY `id_home_visit` (`id_home_visit`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nisn`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru_bk`
--
ALTER TABLE `guru_bk`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_visit`
--
ALTER TABLE `home_visit`
  MODIFY `id_home_visit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  MODIFY `id_kepuasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru_bk`
--
ALTER TABLE `guru_bk`
  ADD CONSTRAINT `guru_bk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `home_visit`
--
ALTER TABLE `home_visit`
  ADD CONSTRAINT `home_visit_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru_bk` (`id_guru`),
  ADD CONSTRAINT `home_visit_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  ADD CONSTRAINT `kepuasan_layanan_ibfk_1` FOREIGN KEY (`id_home_visit`) REFERENCES `home_visit` (`id_home_visit`),
  ADD CONSTRAINT `kepuasan_layanan_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
