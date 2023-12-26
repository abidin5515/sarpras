-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_alkes.jadwal_kalibrasi
CREATE TABLE IF NOT EXISTS `jadwal_kalibrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_alat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table db_alkes.jadwal_kalibrasi: ~12 rows (approximately)
/*!40000 ALTER TABLE `jadwal_kalibrasi` DISABLE KEYS */;
INSERT INTO `jadwal_kalibrasi` (`id`, `id_alat`, `tanggal`, `status`, `create_at`) VALUES
	(1, 'AL002', '2020-03-16', 1, NULL),
	(2, 'AL001', '2020-03-08', 1, NULL),
	(3, 'AL001', '2020-03-10', 1, NULL),
	(4, 'AL001', '2020-09-10', 1, NULL),
	(5, 'AL001', '2020-09-17', 1, NULL),
	(6, 'AL002', '2020-09-10', 1, NULL),
	(7, 'AL002', '2020-09-17', 1, NULL),
	(8, 'AL002', '2020-09-20', 1, NULL),
	(9, 'AL001', '2020-09-14', 1, NULL),
	(10, 'AL002', '2020-09-14', 1, NULL),
	(11, 'AL001', '2020-09-11', 1, NULL),
	(12, 'AL001', '2020-09-06', 1, NULL);
/*!40000 ALTER TABLE `jadwal_kalibrasi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
