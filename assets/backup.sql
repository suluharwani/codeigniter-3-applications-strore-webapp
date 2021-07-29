-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.21 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for arwani77
CREATE DATABASE IF NOT EXISTS `arwani77` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `arwani77`;

-- Dumping structure for table arwani77.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `level` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arwani77.admin: 1 rows
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`, `status`, `level`) VALUES
	(28, 'suluh', '$2a$08$e1vDxEIJiPPgS6hLrwHiB.NuUOFXzHrUuRo4jKJrTt1aXe9Nr6fQ6', '2021-07-23 10:39:22', NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table arwani77.content
CREATE TABLE IF NOT EXISTS `content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar_small` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar_big` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_admin` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `click` int NOT NULL DEFAULT '0',
  `ukuran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arwani77.content: 0 rows
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
/*!40000 ALTER TABLE `content` ENABLE KEYS */;

-- Dumping structure for table arwani77.label_link
CREATE TABLE IF NOT EXISTS `label_link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_content` int NOT NULL,
  `label` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arwani77.label_link: 0 rows
/*!40000 ALTER TABLE `label_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `label_link` ENABLE KEYS */;

-- Dumping structure for table arwani77.link
CREATE TABLE IF NOT EXISTS `link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_label` int NOT NULL,
  `link` varchar(5000) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `nama` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arwani77.link: 0 rows
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

-- Dumping structure for table arwani77.riwayat_login
CREATE TABLE IF NOT EXISTS `riwayat_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arwani77.riwayat_login: 5 rows
/*!40000 ALTER TABLE `riwayat_login` DISABLE KEYS */;
INSERT INTO `riwayat_login` (`id`, `ip_address`, `username`, `password`, `status`, `waktu`) VALUES
	(145, '::1', 'suluh', '$2a$08$uTKrKDDF.o6yVQEXKvWyzOzajjt.W1.KVBmy9kst7oU', 1, '2021-07-25 12:33:30'),
	(144, '::1', 'suluh', '$2a$08$ErRzoBFnlEI2laRRFlTChO7w.e73wdbcZQBrZ7kilpR', 1, '2021-07-24 00:31:23'),
	(143, '::1', 'suluh', '$2a$08$KI3HQBOBO66VY1b66acXgOP.0nbGAEAozY/IybQFqll', 1, '2021-07-24 00:25:30'),
	(142, '::1', 'suluh', '$2a$08$B8CJwgM9P2ERPWzwf761Tebv3kW5KAslc1a4AgD5a5B', 1, '2021-07-24 00:11:27'),
	(140, '::1', 'suluh', '$2a$08$s/DkWgYLvqdjVHUL9Qa/w.wmtxUcgXTk8dHclkbE745', 1, '2021-07-23 20:55:48');
/*!40000 ALTER TABLE `riwayat_login` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
