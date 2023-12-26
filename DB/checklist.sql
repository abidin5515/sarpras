-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2020 at 09:49 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alkes`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_kategori_checklist` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_alat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`id`, `nama`, `id_kategori_checklist`, `created_at`, `updated_at`, `id_alat`) VALUES
(1, 'Cek Kondisi Fisik Alat dari kerusakan', 1, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(2, 'Cek Kondisi dan kelengkapan asesoris', 1, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(3, 'cek tahanan ground', 2, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(4, 'cek kebocoran arus ground pada kondisi normal', 2, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(5, 'Bersihkan unit dari kotoran', 3, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(6, 'cek fungsi saklar ON- OFF', 3, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(7, 'hero', 2, '2020-09-09 22:42:11', '2020-09-09 22:42:11', 6),
(8, 'Cek kondisi fisik alat dari kerusakannya', 1, '2020-09-17 19:07:17', '2020-09-20 20:24:30', 8),
(9, 'Cek kondisi dan kelengkapan asesoris', 1, '2020-09-17 19:07:17', '2020-09-17 19:07:17', 8),
(10, 'Cek Ketahanan', 2, '2020-09-17 19:07:17', '2020-09-17 19:07:17', 8),
(11, 'Cek Kebocoran', 2, '2020-09-17 19:07:17', '2020-09-17 19:07:17', 8),
(12, 'Bersihkan unit', 3, '2020-09-17 19:07:17', '2020-09-17 19:07:17', 8),
(13, 'Cek Saklarnya', 3, '2020-09-17 19:07:17', '2020-09-20 20:24:39', 8),
(14, 'Cek Penunjukan', 3, '2020-09-17 19:07:17', '2020-09-17 19:07:17', 8),
(23, 'cek kebersihan', 1, '2020-09-20 19:58:21', '2020-09-20 20:33:13', 14),
(24, 'safetynya gimana', 2, '2020-09-20 19:58:21', '2020-09-20 20:33:23', 14),
(25, 'maintenancenya gimana', 3, '2020-09-20 19:58:21', '2020-09-20 20:33:32', 14),
(32, 'cek', 1, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(33, 'safety', 2, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(34, 'maintenance', 3, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(35, 'n jn', 1, '2020-09-20 21:45:54', '2020-09-20 21:45:54', 15),
(36, 'hjbjhb', 2, '2020-09-20 21:45:54', '2020-09-20 21:45:54', 15),
(37, 'jhbjhb', 3, '2020-09-20 21:45:54', '2020-09-20 21:45:54', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
