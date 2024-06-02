-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: ci4_inventaris
-- ------------------------------------------------------
-- Server version 	8.3.0
-- Date: Sun, 02 Jun 2024 18:04:32 +0000

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detail_peminjamans`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjamans` (
  `id_detail_peminjamans` int NOT NULL AUTO_INCREMENT,
  `id_inventaris` int DEFAULT NULL,
  `id_peminjaman` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  PRIMARY KEY (`id_detail_peminjamans`),
  KEY `FK__inventaris` (`id_inventaris`),
  KEY `FK__peminjamans` (`id_peminjaman`),
  CONSTRAINT `FK__inventaris` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`) ON DELETE CASCADE,
  CONSTRAINT `FK__peminjamans` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjamans` (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjamans`
--

LOCK TABLES `detail_peminjamans` WRITE;
/*!40000 ALTER TABLE `detail_peminjamans` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `detail_peminjamans` VALUES (1,4,1,1),(2,3,1,6),(3,2,2,10),(4,3,2,10);
/*!40000 ALTER TABLE `detail_peminjamans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `detail_peminjamans` with 4 row(s)
--

--
-- Table structure for table `inventaris`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventaris` (
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
  KEY `FK_inventaris_ruangans` (`id_ruangan`) USING BTREE,
  KEY `FK_inventaris_users` (`id_user`),
  CONSTRAINT `FK_inventaris_ruangans` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangans` (`id_ruangan`) ON DELETE CASCADE,
  CONSTRAINT `FK_inventaris_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventaris`
--

LOCK TABLES `inventaris` WRITE;
/*!40000 ALTER TABLE `inventaris` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `inventaris` VALUES (1,'INVT121312','Meja','Sonic','Meja Belajar','Baik',13,343000,'Dana',NULL,1,0),(2,'INV2312032','Meja','Inoac','Meja Belajar','Baik',20,98400,'Dana BOS','Dios - -Runaway- Official Music Video.mkv_snapshot_04.23.103.jpg',1,1),(3,'INV2312237','Kursi','Inoac','Kursi Belajar','Baik',14,87300,'Dana BOS','Dios - -Runaway- Official Music Video.mkv_snapshot_04.22.165.jpg',1,1),(4,'INV2312342','Meja Guru','-','Kayu Jati','Baik',0,124000,'Dana Bos','Dios - -Runaway- Official Music Video.mkv_snapshot_00.02.080.jpg',2,1);
/*!40000 ALTER TABLE `inventaris` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `inventaris` with 4 row(s)
--

--
-- Table structure for table `levels`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `levels` VALUES (1,'Administrator'),(2,'Operator'),(3,'Peminjam');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `levels` with 3 row(s)
--

--
-- Table structure for table `peminjamans`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjamans` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `status_peminjaman` enum('Dipinjam','Dikembalikan','Pinjaman Ditolak','Menunggu Persetujuan') DEFAULT 'Menunggu Persetujuan',
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `FK_peminjamans_users` (`id_user`),
  CONSTRAINT `FK_peminjamans_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjamans`
--

LOCK TABLES `peminjamans` WRITE;
/*!40000 ALTER TABLE `peminjamans` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `peminjamans` VALUES (1,'2024-06-02 00:00:00','2024-06-04 00:00:00','Dipinjam',1),(2,'2024-06-03 00:00:00','2024-06-05 00:00:00','Dipinjam',1);
/*!40000 ALTER TABLE `peminjamans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `peminjamans` with 2 row(s)
--

--
-- Table structure for table `ruangans`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruangans` (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(50) NOT NULL,
  `foto` text,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangans`
--

LOCK TABLES `ruangans` WRITE;
/*!40000 ALTER TABLE `ruangans` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `ruangans` VALUES (1,'Ruangan 11',NULL),(2,'Ruangan 12','Dios - -Runaway- Official Music Video.mkv_snapshot_00.03.221.jpg');
/*!40000 ALTER TABLE `ruangans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `ruangans` with 2 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text,
  `status` enum('Aktif','Non-Aktif') NOT NULL DEFAULT 'Aktif',
  `id_level` int NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_level` (`id_level`),
  CONSTRAINT `FK_users_level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Asep H','aseph','aseph@gmail.com','$2y$10$Fq.A1iLlCkHQvwkfDeB34OreLLHpU93TifeIdNjJb6XM1hl2TIlYa','Dios - -Runaway- Official Music Video.mkv_snapshot_00.03.221.jpg','Aktif',1),(2,'Athalal','athalal','athalal@gmail.com','$2y$10$vIvkppG4OxY8oQlFE00GNet9dLf/LpMV15yu6GmfezHVh4pbN.H4e',NULL,'Aktif',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sun, 02 Jun 2024 18:04:32 +0000
