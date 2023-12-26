-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2020 at 09:30 AM
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
-- Table structure for table `data_alkes`
--

CREATE TABLE `data_alkes` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `no_invent` varchar(100) DEFAULT NULL,
  `id_alat` int(11) NOT NULL DEFAULT '0',
  `merk` varchar(100) DEFAULT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `nomor_seri` varchar(100) DEFAULT NULL,
  `manufacture` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `sop` varchar(100) DEFAULT NULL,
  `id_ruangan` int(11) NOT NULL DEFAULT '0',
  `kondisi` varchar(50) DEFAULT NULL,
  `id_supplier` int(11) NOT NULL DEFAULT '0',
  `tahun_pengadaan` date DEFAULT NULL,
  `harga_beli` double NOT NULL,
  `id_sumber_dana` int(11) NOT NULL DEFAULT '0',
  `expected_life_time` int(11) NOT NULL DEFAULT '0',
  `present_year` varchar(50) DEFAULT NULL,
  `penyusutan_pertahun` double NOT NULL,
  `nilai_akumulasi` double NOT NULL,
  `nilai_buku` double NOT NULL,
  `sop_alat` varchar(30) DEFAULT NULL,
  `operating_manual` varchar(30) DEFAULT NULL,
  `service_manual` varchar(30) NOT NULL,
  `warranty_expired` date DEFAULT NULL,
  `id_kepemilikan` int(11) NOT NULL DEFAULT '0',
  `status` varchar(11) DEFAULT NULL,
  `daya_listrik` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_alkes`
--

INSERT INTO `data_alkes` (`id`, `kode`, `no_invent`, `id_alat`, `merk`, `tipe`, `nomor_seri`, `manufacture`, `gambar`, `sop`, `id_ruangan`, `kondisi`, `id_supplier`, `tahun_pengadaan`, `harga_beli`, `id_sumber_dana`, `expected_life_time`, `present_year`, `penyusutan_pertahun`, `nilai_akumulasi`, `nilai_buku`, `sop_alat`, `operating_manual`, `service_manual`, `warranty_expired`, `id_kepemilikan`, `status`, `daya_listrik`, `created_at`, `updated_at`) VALUES
(9, 'LAB003', NULL, 5, 'yamaha1', 'rtyy1', '388651', 'vietnam1', 'gambar_alat/1599707214.png', NULL, 5, 'Kurang baik', 3, '2020-09-10', 44441, 1, 45451, '4541', 34341, 656561, 22221, 'Tidak ada', 'Ada', 'Ada', '2020-09-10', 1, 'active', 561, '2020-09-09 19:51:47', '2020-09-09 20:13:02'),
(10, 'RAD001', NULL, 6, 'honda', 'jt9823', '23982038247', 'china', 'gambar_alat/1599792675.png', NULL, 5, 'Kurang baik', 4, '2020-09-09', 2344, 2, 6544, '347443', 5656, 5654, 65433, 'Tidak ada', 'Ada', 'Ada', '2020-09-04', 2, 'non active', 500, '2020-09-10 19:51:15', '2020-09-10 19:51:15'),
(11, 'LAB004', NULL, 7, 'yamaha', 'jyiprir', '30948934', 'indonesiaw', 'gambar_alat/1599792768.png', 'sop_alat/1600049489.pdf', 6, 'Rusak', 4, '2020-09-17', 132243, 1, 56, '5656', 656, 6565, 565, 'Tidak ada', 'Tidak ada', 'Tidak ada', '2020-09-26', 1, 'active', 5656, '2020-09-10 19:52:48', '2020-09-14 18:08:52'),
(12, 'RAD002', NULL, 5, 'suzuki', 'spion', '298372839', '2327y43n2', 'gambar_alat/1599792892.png', NULL, 5, 'Baik', 3, '2020-09-04', 5454, 1, 454, '45', 545, 454, 454545, 'Tidak ada', 'Ada', 'Ada', '2020-09-04', 1, 'active', 4554, '2020-09-10 19:54:52', '2020-09-10 19:54:52'),
(13, 'RAD003', NULL, 5, 'tespdf', '121212', '2498734983', 'jepang', 'gambar_alat/1600049128.png', 'sop_alat/1600049907.pdf', 5, 'Kurang baik', 3, '2020-09-03', 3423434, 1, 324343, '34', 45454523, 4545, 4545, 'Tidak ada', 'Tidak ada', 'Tidak ada', '2020-09-17', 1, 'non active', 4545, '2020-09-13 19:05:28', '2020-09-13 19:18:27'),
(14, 'LAB005', 'tes nomor1', 5, 'contoh merk', 'rtyy', '2323232', 'china', 'gambar_alat/1600136858.png', 'sop_alat/1600136858.png', 6, 'Kurang baik', 3, '2020-09-12', 400000, 1, 3, 'hongkong', 300, 600, 500, NULL, 'Tidak ada', 'Tidak ada', '2020-09-11', 1, 'non active', 4343, '2020-09-14 19:27:38', '2020-09-14 19:29:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_alkes`
--
ALTER TABLE `data_alkes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_alkes`
--
ALTER TABLE `data_alkes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
