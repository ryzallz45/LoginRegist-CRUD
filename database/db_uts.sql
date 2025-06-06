-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_uts
CREATE DATABASE IF NOT EXISTS `db_uts` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_uts`;

-- Dumping structure for table db_uts.iuran
CREATE TABLE IF NOT EXISTS `iuran` (
  `id_iuran` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` decimal(20,6) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nrp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_iuran`),
  KEY `FK_iuran_mahasiswa` (`nrp`),
  CONSTRAINT `FK_iuran_mahasiswa` FOREIGN KEY (`nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_uts.iuran: ~0 rows (approximately)
DELETE FROM `iuran`;

-- Dumping structure for table db_uts.keanggotaan
CREATE TABLE IF NOT EXISTS `keanggotaan` (
  `id_anggota` int(11) NOT NULL,
  `nrp` int(11) DEFAULT NULL,
  `status` enum('Aktif','Tidak') DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `FK_keanggotaan_mahasiswa` (`nrp`),
  CONSTRAINT `FK_keanggotaan_mahasiswa` FOREIGN KEY (`nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_uts.keanggotaan: ~0 rows (approximately)
DELETE FROM `keanggotaan`;

-- Dumping structure for table db_uts.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nrp` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tmpt_Lahir` varchar(50) NOT NULL,
  `tgl_Lahir` date NOT NULL,
  `jekel` enum('Laki - Laki','Perempuan') NOT NULL,
  `jurusan` enum('Arsitektur','Teknik Informatika','Geodesi','Rekayasa Perangkat Lunak','Desain Komunikasi Visual','Teknik Mesin') NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`nrp`),
  KEY `FK_mahasiswa_user` (`id`),
  CONSTRAINT `FK_mahasiswa_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_uts.mahasiswa: ~4 rows (approximately)
DELETE FROM `mahasiswa`;
INSERT INTO `mahasiswa` (`nrp`, `nama`, `tmpt_Lahir`, `tgl_Lahir`, `jekel`, `jurusan`, `email`, `gambar`, `alamat`, `id`) VALUES
	(1, 'Rizal', 'Bandung', '2002-10-26', 'Laki - Laki', 'Teknik Informatika', 'aa@gmail.com', '673488f51046d.jpeg', 'dd', NULL),
	(2, 'Asep ', 'Jakarta', '2002-10-11', 'Laki - Laki', 'Arsitektur', 'asep@gmail.com', '', '', NULL),
	(3, 'Asap', 'Bali', '2004-11-14', 'Laki - Laki', 'Geodesi', 'asap@gmail.com', '', '', NULL);

-- Dumping structure for table db_uts.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_uts.user: ~5 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Admin', 'admin'),
	(2, 'admin', '$2y$10$vZMOvS.azO1BjGPExucPcOCVovwr6W3ME5uoBOaFNN6J7lOSE/4.y'),
	(3, 'aku', '$2y$10$TrpJm3T17BzCejwfZiltY..O2GPWbohPpVZbK2O/QcF55Ma2cj80e'),
	(4, 'akuu', '$2y$10$lKWKbEEGBe1s5oMg7Jf0t.VBAHGlweFyIRE59Fi4L02JXZyy6cDdW'),
	(5, 'keke', '$2y$10$ipjTsKCyKjhMOx//OtSKEe0RV1QXNqJ6hEI5Z0BCyL31W1E/bvzkS');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
