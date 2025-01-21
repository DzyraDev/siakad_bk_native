-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 03:43 PM
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
(2, 4, '32783278', 'Eko Prasetyo', 'L', 'eko@gmail.com', 'Natar', '1990-10-17'),
(3, 7, '3728378', 'admin', 'L', 'admin@gmail.com', 'Bandar Lampung', '1996-06-05'),
(4, 9, '37238923', 'Edy Sutarno', 'L', 'edy@gmail.com', 'Bandar Lampung', '1997-06-20');

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
  `hasil_kunjungan` text DEFAULT NULL,
  `tindak_lanjut` text DEFAULT NULL,
  `status` enum('pending','selesai') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_visit`
--

INSERT INTO `home_visit` (`id_home_visit`, `id_guru`, `id_siswa`, `tanggal_kunjungan`, `tujuan_kunjungan`, `hasil_kunjungan`, `tindak_lanjut`, `status`, `created_at`) VALUES
(6, 2, 2, '2025-01-25', 'Alpha sudah mencapai 7', NULL, NULL, 'pending', '2025-01-21 06:14:58'),
(7, 2, 4, '2025-01-28', 'Alpha sudah mencapai 4', NULL, NULL, 'pending', '2025-01-21 12:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `kepuasan_layanan`
--

CREATE TABLE `kepuasan_layanan` (
  `id_kepuasan` int(11) NOT NULL,
  `id_home_visit` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `rating` enum('buruk','cukup baik','baik','sangat baik') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepuasan_layanan`
--

INSERT INTO `kepuasan_layanan` (`id_kepuasan`, `id_home_visit`, `id_siswa`, `rating`, `created_at`) VALUES
(1, 6, 2, 'sangat baik', '2025-01-21 15:02:11'),
(2, 7, 4, 'baik', '2025-01-21 15:02:58');

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
(2, 2, '330846', 'Aris Hendradian', 'L', '082156743876', '10 RPL 2', 7, NULL, NULL),
(4, 8, '2372989', 'Ikhlasul Amal', 'L', '082156743876', '10 RPL 2', 4, NULL, NULL),
(5, 10, '3273728', 'M.Ridho Nuril Ibrahim', 'L', '085674345622', '10 RPL 2', NULL, NULL, 2);

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
(2, 'Aris', '$2y$10$jOpUNDcL01t34q7VChe7luv426y00UQP6qYcRSvhB9zIxiiAhIS3K', 'siswa', '2025-01-19 02:38:01'),
(3, 'Agus', '$2y$10$HUxVjkv4jonBmEHlc.PlS.VZyTMvuuIuNyzuJs1Q04t9fJgRNTe2a', 'guru_bk', '2025-01-19 13:26:07'),
(4, 'Eko', '$2y$10$zocKCxOpPhd4tePoGvwcIeitl2tnVmfGgghrpkmUo/ZXcM8VZEZiy', 'guru_bk', '2025-01-19 13:26:36'),
(7, 'admin', '$2y$10$JzC4vqizloHsSn1m/V/deOvpR7BBjbgTSrrgld3uP3SGBTYlRLsUK', 'admin', '2025-01-20 12:32:27'),
(8, 'ikhlas', '$2y$10$DrCGSJcm8mIRBOglM7lMJey2atChKCB2hZ0Py.VUbSZMXLuRdYanW', 'siswa', '2025-01-21 06:08:03'),
(9, 'Edy', '$2y$10$btZAwkqUd6SQhc4nF2Acu.rkHWFJG4ZBW84M8DUyOaeTpG7.bY7Pq', 'kepala_sekolah', '2025-01-21 13:08:11'),
(10, 'Ridho', '$2y$10$4tPwppn3U0lLwWpMLrSEEu6ZLgOQXHO5a6hNmk5qbcJA2q.xICW9.', 'siswa', '2025-01-21 13:21:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru_bk`
--
ALTER TABLE `guru_bk`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nuptk`),
  ADD KEY `guru_bk_ibfk_1` (`id_user`);

--
-- Indexes for table `home_visit`
--
ALTER TABLE `home_visit`
  ADD PRIMARY KEY (`id_home_visit`),
  ADD KEY `home_visit_ibfk_1` (`id_guru`),
  ADD KEY `home_visit_ibfk_2` (`id_siswa`);

--
-- Indexes for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  ADD PRIMARY KEY (`id_kepuasan`),
  ADD KEY `kepuasan_layanan_ibfk_1` (`id_home_visit`),
  ADD KEY `kepuasan_layanan_ibfk_2` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nisn`),
  ADD KEY `siswa_ibfk_1` (`id_user`);

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
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_visit`
--
ALTER TABLE `home_visit`
  MODIFY `id_home_visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  MODIFY `id_kepuasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru_bk`
--
ALTER TABLE `guru_bk`
  ADD CONSTRAINT `guru_bk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `home_visit`
--
ALTER TABLE `home_visit`
  ADD CONSTRAINT `home_visit_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru_bk` (`id_guru`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `home_visit_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `kepuasan_layanan`
--
ALTER TABLE `kepuasan_layanan`
  ADD CONSTRAINT `kepuasan_layanan_ibfk_1` FOREIGN KEY (`id_home_visit`) REFERENCES `home_visit` (`id_home_visit`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `kepuasan_layanan_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
