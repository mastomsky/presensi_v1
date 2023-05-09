-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 11:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti`
--

CREATE TABLE `tbl_cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `keperluan` enum('1','2') NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `mulai_kerja` date NOT NULL,
  `berkas` text DEFAULT NULL,
  `keterangan` text NOT NULL,
  `status_cuti` int(1) DEFAULT NULL,
  `diketahui` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cuti`
--

INSERT INTO `tbl_cuti` (`id_cuti`, `id_karyawan`, `keperluan`, `tgl_mulai`, `tgl_selesai`, `mulai_kerja`, `berkas`, `keterangan`, `status_cuti`, `diketahui`, `created_at`, `updated_at`) VALUES
(7, 10, '1', '2023-04-26', '2023-04-27', '2023-04-28', '10-2023-04-26-030747.png', 'dddd', 2, 1, '2023-04-26 03:07:47', '2023-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Karyawan'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nip` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `nama_karyawan` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `telpon` varchar(25) COLLATE utf8_swedish_ci DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_shift` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `foto_karyawan` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `status_karyawan` enum('0','1') COLLATE utf8_swedish_ci NOT NULL DEFAULT '1',
  `blokir_karyawan` enum('0','1') COLLATE utf8_swedish_ci NOT NULL DEFAULT '0',
  `salah_password` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nip`, `nama_karyawan`, `telpon`, `id_jabatan`, `id_lokasi`, `id_shift`, `username`, `password`, `foto_karyawan`, `status_karyawan`, `blokir_karyawan`, `salah_password`, `created_at`, `updated_at`) VALUES
(5, 'NIP15042300002', 'ada', '0813-3530-3310', 1, 1, 1, 'admin', '$2y$10$Z90cyCrxyiZj0By.P5VyQe7mIv/NZ9QFBcJrVs0XjSlT9rypRdJ3S', 'user_profile.png', '1', '1', 3, '2023-04-11 03:46:16', NULL),
(10, 'NIP16042300005', 'tomsky', '6281335303310', 1, 1, 1, 'tomsky', '$2y$10$25cVMt/wQGu6i/6jn0AiQebFuMLpFFsmE.jtjqXs2Gqt/BAK.g6iu', '10-20230426-053129.png', '1', '0', 0, '2023-04-13 05:45:48', NULL),
(12, 'NIP08052300007', 'tommy', '81335303310', 1, 1, 1, 'tommy', '$2y$10$fLe.xqlc1ZfcGQ8zxZcY0eI2DRhsGCdCYz74p51VczY9bUtOSL/HC', 'user_profile.png', '1', '0', 0, '2023-05-08 17:41:04', NULL),
(13, 'NIP08052300008', 'denis', '81335303310', 1, 1, 1, 'denis', '$2y$10$snSb.ApyePteeZYVcl.VJ.PnueCET35Ri/b086rJ/WyqlLZioWKme', 'user_profile.png', '1', '0', 0, '2023-05-08 17:41:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(150) NOT NULL,
  `alamat_lokasi` text NOT NULL,
  `lokasi_latlng` varchar(200) NOT NULL,
  `radius_lokasi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `nama_lokasi`, `alamat_lokasi`, `lokasi_latlng`, `radius_lokasi`) VALUES
(1, 'Kantor 1', 'manyar', '-7.127232495810981, 112.59115180396365', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_shift` int(11) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_in` time DEFAULT NULL,
  `jam_out` time DEFAULT NULL,
  `lokasi_in` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `lokasi_out` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `foto_in` text COLLATE utf8_swedish_ci DEFAULT NULL,
  `foto_out` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id_presensi`, `id_karyawan`, `id_shift`, `tgl_presensi`, `jam_in`, `jam_out`, `lokasi_in`, `lokasi_out`, `foto_in`, `foto_out`) VALUES
(27, 5, 6, '2023-04-08', '10:52:01', '11:49:48', '-7.127240646524999,112.59115644884731', '-7.127240646524999,112.59115644884731', '5-2023-04-08-105201.png', '5-2023-04-08-114948.png'),
(32, 10, 1, '2023-04-13', '20:02:02', '20:05:40', '-7.127240646524999,112.59115644884731', '-7.127240646524999,112.59115644884731', '10-2023-04-13-200202.png', '10-2023-04-13-200540.png'),
(33, 10, 1, '2023-04-14', '18:42:04', NULL, '-7.127241,112.591156', NULL, '10-2023-04-14-184204.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_kantor` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8_swedish_ci NOT NULL,
  `lokasi_kantor` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_kantor`, `alamat`, `lokasi_kantor`) VALUES
(1, 'Rozitech', 'Jl. Poros Leran', '-7.123586697256257, 112.59268703872615');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id_shift` int(11) NOT NULL,
  `nama_shift` varchar(50) NOT NULL,
  `start_in` time NOT NULL,
  `end_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id_shift`, `nama_shift`, `start_in`, `end_out`) VALUES
(1, 'Shift 1', '07:00:00', '15:00:00'),
(2, 'Shift 2', '15:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_user` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `foto_user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `status_user` enum('0','1') COLLATE utf8_swedish_ci NOT NULL,
  `blokir_user` int(1) NOT NULL DEFAULT 0,
  `salah_password` int(1) DEFAULT 0,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_jabatan`, `nama_user`, `username`, `password`, `foto_user`, `status_user`, `blokir_user`, `salah_password`, `updated_at`) VALUES
(1, 1, 'Mutamidul', 'admin', '$2y$10$rVSNSQ6fqckiG/xu4oP/cuBMEzQaf04pQmcKBf1.7Zzx2q1lAF6nW', 'user_profile.png', '1', 0, 0, NULL),
(2, 3, 'Dimas', 'dimas', '$2y$10$lpAhPOrvKSNODXzBTo71Due3WceI9QFlZvXFyZanHDYYw.M9rJaCi', 'user_profile.png', '1', 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `diketahui` (`diketahui`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_shift` (`id_shift`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_shift` (`id_shift`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  ADD CONSTRAINT `tbl_cuti_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cuti_ibfk_2` FOREIGN KEY (`diketahui`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD CONSTRAINT `tbl_karyawan_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `tbl_lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_karyawan_ibfk_2` FOREIGN KEY (`id_shift`) REFERENCES `tbl_shift` (`id_shift`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_karyawan_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  ADD CONSTRAINT `tbl_presensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_karyawan` (`id_karyawan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
