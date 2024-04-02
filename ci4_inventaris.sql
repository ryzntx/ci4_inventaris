-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2024 at 10:34 PM
-- Server version: 8.3.0
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_inventaris`
--
CREATE DATABASE IF NOT EXISTS `ci4_inventaris` DEFAULT CHARACTER SET utf8mb4 ;
USE `ci4_inventaris`;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjamans`
--

CREATE TABLE IF NOT EXISTS `detail_peminjamans` (
  `id_detail_peminjamans` int NOT NULL AUTO_INCREMENT,
  `id_inventaris` int DEFAULT NULL,
  `id_peminjaman` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  PRIMARY KEY (`id_detail_peminjamans`),
  KEY `FK__inventaris` (`id_inventaris`),
  KEY `FK__peminjamans` (`id_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE IF NOT EXISTS `inventaris` (
  `id_inventaris` int NOT NULL AUTO_INCREMENT,
  `kode_inventaris` char(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `spesifikasi` text,
  `kondisi` enum('Baik','Rusak') NOT NULL DEFAULT 'Baik',
  `jumlah` int NOT NULL,
  `harga` int DEFAULT NULL,
  `sumber` varchar(50) DEFAULT NULL,
  `foto` text,
  `id_ruangan` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `FK_inventaris_users` (`id_user`),
  KEY `FK_inventaris_ruangans` (`id_ruangan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `kode_inventaris`, `nama`, `merek`, `spesifikasi`, `kondisi`, `jumlah`, `harga`, `sumber`, `foto`, `id_ruangan`, `id_user`) VALUES
(2, 'INVT121312', 'Meja', 'Sonic', 'Meja Belajar', 'Baik', 30, 343000, 'Dana', 'Dios - -Runaway- Official Music Video.mkv_snapshot_00.03.221_1.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id_level`, `nama_level`) VALUES
(1, 'Administrator'),
(2, 'Operator'),
(3, 'Peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE IF NOT EXISTS `peminjamans` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `status_peminjaman` enum('Dipinjam','Dikembalikan','Pinjaman Ditolak','Menunggu Persetujuan') DEFAULT 'Menunggu Persetujuan',
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `FK_peminjamans_users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE IF NOT EXISTS `ruangans` (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(50) NOT NULL,
  `foto` text,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id_ruangan`, `nama_ruangan`, `foto`) VALUES
(1, 'Ruangan 11', 'PXL_20210324_131213121.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(120) CHARACTER SET utf8mb4  NOT NULL,
  `username` varchar(120) CHARACTER SET utf8mb4  NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text,
  `status` enum('Aktif','Non-Aktif') NOT NULL DEFAULT 'Aktif',
  `id_level` int NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_level` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `password`, `foto`, `status`, `id_level`) VALUES
(1, 'Asep H', 'aseph', 'aseph@gmail.com', '$2y$10$Fq.A1iLlCkHQvwkfDeB34OreLLHpU93TifeIdNjJb6XM1hl2TIlYa', NULL, 'Aktif', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD CONSTRAINT `FK__inventaris` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`),
  ADD CONSTRAINT `FK__peminjamans` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjamans` (`id_peminjaman`);

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `FK_inventaris_ruangans` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangans` (`id_ruangan`),
  ADD CONSTRAINT `FK_inventaris_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `FK_peminjamans_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
