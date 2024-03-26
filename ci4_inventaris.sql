-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2024 at 09:39 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.15

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

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id_level` int NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'Peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(120) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(120) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text,
  `status` enum('Aktif','Non-Aktif') NOT NULL DEFAULT 'Aktif',
  `id_level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `password`, `foto`, `status`, `id_level`) VALUES
(1, 'Asep H', 'aseph', 'aseph@gmail.com', '$2y$10$Fq.A1iLlCkHQvwkfDeB34OreLLHpU93TifeIdNjJb6XM1hl2TIlYa', NULL, 'Aktif', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_users_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
