-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2020 at 09:54 AM
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
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(5, 'Pemotong rumput terbaru 2020', '2020-09-09 19:33:33', '2020-09-10 19:47:25'),
(6, 'Pendeteksi detak jantung', '2020-09-09 19:45:34', '2020-09-10 19:49:54'),
(7, 'Pemotong kuku kaki gajah', '2020-09-10 19:50:08', '2020-09-10 19:50:08'),
(8, 'Tensi Meter', '2020-09-17 18:59:55', '2020-09-17 18:59:55'),
(14, 'Pendeteksi Paru-paru', '2020-09-20 19:58:21', '2020-09-20 20:32:57'),
(15, 'sndf dn', '2020-09-20 21:45:54', '2020-09-20 21:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pemeliharaan`
--

CREATE TABLE `catatan_pemeliharaan` (
  `id` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `no_seri` varchar(100) NOT NULL,
  `no_invent` varchar(100) NOT NULL,
  `id_jenis_pekerjaan` int(11) NOT NULL,
  `teknisi_setempat` varchar(100) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `masa_kalibrasi` varchar(100) NOT NULL,
  `interval_pemeliharaan` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text NOT NULL,
  `tindakan` text NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bengkel_rujukan` varchar(100) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_pemeliharaan`
--

INSERT INTO `catatan_pemeliharaan` (`id`, `id_alkes`, `merek`, `model`, `no_seri`, `no_invent`, `id_jenis_pekerjaan`, `teknisi_setempat`, `id_vendor`, `mulai`, `selesai`, `id_ruang`, `masa_kalibrasi`, `interval_pemeliharaan`, `tahun`, `tanggal`, `keluhan`, `tindakan`, `jumlah_biaya`, `keterangan`, `created_at`, `updated_at`, `bengkel_rujukan`, `nama_user`) VALUES
(1, 10, 'Merk', '1A0', '10201o0', 'no invent', 3, 'abdul', 4, '2020-09-14', '2020-09-14', 5, 'masa kalibrasi', '2 bulan', 2020, '2020-09-14', 'keluhan', 'tindakan', 10000, 'keterangan', '2020-09-14 02:44:26', '2020-09-15 03:15:14', NULL, NULL),
(2, 10, 'Merk', '1A0', '10201o0', 'no invent', 3, 'abdul', 4, '2020-09-14', '2020-09-14', 6, 'masa kalibrasi', '2 bulan', 2020, '2020-09-14', 'keluhan', 'tindakan', 10000, 'keterangan', '2020-09-14 02:45:26', '2020-09-15 03:15:20', NULL, NULL),
(5, 10, 'Merk', '1A0', '10201o0', '912812u182u81u', 3, 'teknisi', 3, '2020-09-14', '2020-09-14', 5, '12912912', 'ok', 2020, '2020-09-15', 'okok', 'oko', 10, 'ok', '2020-09-14 06:02:55', '2020-09-15 03:16:52', NULL, NULL),
(6, 10, 'Merk', '1A0', '10201o0', '02.00.21', 2, 'Abdul', 3, '2020-09-15', '2020-09-23', 6, 'MASA KALIBRAIS', '1x setahun', 2020, '2020-09-15', 'Keluhan', 'ok', 10000, 'ok', '2020-09-15 01:42:02', '2020-09-15 03:16:55', 'Bengkel', NULL),
(7, 15, 'Riester', 'Nova', '040945694', '02.08.02.01.02.1334', 2, 'Rouf', 3, '2020-09-18', '2020-09-19', 6, '18/09/2020', '1 Tahun', 2020, '2020-09-18', 'Mancet bocor', 'Ganti mancet', 200000, '-', '2020-09-18 02:11:35', '2020-09-18 02:11:35', NULL, 'Eny');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pemeliharaan_checklist`
--

CREATE TABLE `catatan_pemeliharaan_checklist` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0: Default; 1: Baik; 2 Tidak Baik',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_pemeliharaan_checklist`
--

INSERT INTO `catatan_pemeliharaan_checklist` (`id`, `id_catatan_pemeliharaan`, `id_checklist`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(2, 1, 2, 2, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(3, 1, 4, 1, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(4, 1, 7, 2, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(5, 1, 3, 1, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(6, 1, 6, 2, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(7, 1, 5, 1, '2020-09-13 19:44:26', '2020-09-13 19:44:26'),
(8, 2, 1, 1, '2020-09-13 19:45:27', '2020-09-13 19:45:27'),
(9, 2, 2, 2, '2020-09-13 19:45:28', '2020-09-13 19:45:28'),
(10, 2, 4, 1, '2020-09-13 19:45:29', '2020-09-13 19:45:29'),
(11, 2, 7, 2, '2020-09-13 19:45:29', '2020-09-13 19:45:29'),
(12, 2, 3, 1, '2020-09-13 19:45:29', '2020-09-13 19:45:29'),
(13, 2, 6, 2, '2020-09-13 19:45:29', '2020-09-13 19:45:29'),
(14, 2, 5, 1, '2020-09-13 19:45:29', '2020-09-13 19:45:29'),
(27, 5, 1, 1, '2020-09-13 23:02:55', '2020-09-13 23:02:55'),
(28, 6, 1, 1, '2020-09-14 18:42:02', '2020-09-14 18:42:02'),
(29, 6, 2, 2, '2020-09-14 18:42:02', '2020-09-14 18:42:02'),
(30, 6, 4, 1, '2020-09-14 18:42:02', '2020-09-14 18:42:02'),
(31, 6, 7, 2, '2020-09-14 18:42:02', '2020-09-14 18:42:02'),
(32, 7, 8, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(33, 7, 9, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(34, 7, 10, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(35, 7, 11, 2, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(36, 7, 12, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(37, 7, 13, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35'),
(38, 7, 14, 1, '2020-09-17 19:11:35', '2020-09-17 19:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pemeliharaan_checklist_value`
--

CREATE TABLE `catatan_pemeliharaan_checklist_value` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan_checklist` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT 'periode/kurun waktu',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1:Baik,2:Tidak Baik',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `catatan_pemeliharaan_checklist_value`
--

INSERT INTO `catatan_pemeliharaan_checklist_value` (`id`, `id_catatan_pemeliharaan_checklist`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:39'),
(2, 1, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(3, 1, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(4, 2, 1, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:39'),
(5, 2, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(6, 2, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(7, 3, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(8, 3, 2, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:39'),
(9, 3, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(10, 4, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(11, 4, 2, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:39'),
(12, 4, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(13, 5, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(14, 5, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(15, 5, 3, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:39'),
(16, 6, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(17, 6, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(18, 6, 3, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(19, 7, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(20, 7, 2, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(21, 7, 3, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(22, 8, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(23, 8, 2, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(24, 8, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(25, 9, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(26, 9, 2, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(27, 9, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(28, 10, 1, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(29, 10, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(30, 10, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(31, 11, 1, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(32, 11, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(33, 11, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(34, 12, 1, 2, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(35, 12, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(36, 12, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(37, 13, 1, 1, '2020-09-21 21:36:11', '2020-09-21 22:17:40'),
(38, 13, 2, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11'),
(39, 13, 3, 0, '2020-09-21 21:36:11', '2020-09-21 21:36:11');

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
  `penyusutan_pertahun` int(11) DEFAULT '0',
  `nilai_akumulasi` int(11) DEFAULT '0',
  `nilai_buku` int(11) DEFAULT '0',
  `sop_alat` varchar(30) DEFAULT NULL,
  `operating_manual` varchar(100) DEFAULT NULL,
  `service_manual` varchar(100) DEFAULT NULL,
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
(9, 'LAB003', 'rrrr', 5, 'yamaha1', 'rtyy1', '388651', 'vietnam1', 'gambar_alat/1599707214.png', 'alat_image/sop_alat/sop1600400052.pdf', 5, 'Kurang baik', 3, '2020-09-10', 44441, 1, 45451, '4541', 34341, 656561, 22221, 'Tidak ada', 'alat_image/operating_manual/operating_manual1600400052.pdf', 'alat_image/service_manual/service_manual1600400052.pdf', '2020-09-10', 1, 'active', 561, '2020-09-09 19:51:47', '2020-09-17 20:34:12'),
(14, 'LAB005', 'tes nomor12', 5, 'contoh merk', 'rtyy', '2323232', 'china', 'gambar_alat/1600136858.png', 'alat_image/sop_alat/sop1600400289.pdf', 6, 'Kurang baik', 3, '2020-09-12', 400000, 1, 3, 'hongkong', 300, 600, 500, NULL, 'alat_image/operating_manual/operating_manual1600400289.pdf', 'alat_image/service_manual/service_manual1600400289.pdf', '2020-09-11', 1, 'non active', 4343, '2020-09-14 19:27:38', '2020-09-17 20:38:09'),
(15, 'LAB006', '02.08.02.01.02.1334', 8, 'Riester', 'Nova', '040945694', 'Jerman', 'alat_image/gambar_alat/gambar1600400185.png', 'alat_image/sop_alat/sop1600400185.pdf', 6, 'Baik', 4, '2020-09-01', 1500000, 1, 5, 'Jerman', 1200000, 1300000, 1400000, NULL, 'alat_image/operating_manual/operating_manual1600400185.pdf', 'alat_image/service_manual/service_manual1600400185.pdf', '2021-09-01', 1, 'active', 5000, '2020-09-17 19:04:42', '2020-09-17 20:36:25'),
(16, 'RAD004', '182718927912', 6, 'yamaha', 'rtyy', '2323232', '2327y43n2', 'alat_image/gambar_alat/1600398260.png', 'alat_image/sop_alat/sop1600399694.pdf', 5, 'Kurang baik', 3, '2020-09-25', 200000, 1, 3, NULL, NULL, NULL, NULL, NULL, 'alat_image/operating_manual/operating_manual1600399640.pdf', 'alat_image/service_manual/service_manual1600399578.pdf', '2020-09-19', 1, 'active', 200, '2020-09-17 20:04:20', '2020-09-17 20:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_tinjauan`
--

CREATE TABLE `hasil_tinjauan` (
  `id` int(11) NOT NULL,
  `oleh_instalasi_alkes` text,
  `oleh_seksi_penunjang_non_medik` text,
  `kesimpulan` varchar(100) DEFAULT NULL,
  `alasan_kesimpulan` text,
  `alat_diperbaiki_oleh` varchar(100) DEFAULT NULL COMMENT '1 =alkes, 2=pihak ketiga',
  `tanggal` date DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT '0',
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `rab` varchar(100) DEFAULT NULL,
  `proses_perbaikan_tanggal` date DEFAULT NULL,
  `mulai_dikerjakan` date DEFAULT NULL,
  `perkiraan_selesai` date DEFAULT NULL,
  `pelaksanaan_swakelola` varchar(100) DEFAULT NULL,
  `uji_coba` varchar(100) DEFAULT NULL,
  `kondisi_akhir` varchar(100) DEFAULT NULL,
  `waktu_jaminan` varchar(100) DEFAULT NULL,
  `catatan_tambahan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_permintaan_pelayanan` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_tinjauan`
--

INSERT INTO `hasil_tinjauan` (`id`, `oleh_instalasi_alkes`, `oleh_seksi_penunjang_non_medik`, `kesimpulan`, `alasan_kesimpulan`, `alat_diperbaiki_oleh`, `tanggal`, `id_teknisi`, `nama_perusahaan`, `alamat`, `rab`, `proses_perbaikan_tanggal`, `mulai_dikerjakan`, `perkiraan_selesai`, `pelaksanaan_swakelola`, `uji_coba`, `kondisi_akhir`, `waktu_jaminan`, `catatan_tambahan`, `created_at`, `updated_at`, `id_permintaan_pelayanan`) VALUES
(1, 'oleh instalasi alkes mosok', 'Oleh Seksi Penunjang Non Medik mosok', 'bisa', 'alasan', '1', '2020-09-25', 6, NULL, NULL, 'rab coba', '2020-10-10', '2020-10-10', '2020-10-10', 'rrr coba', 'uji coba', 'kondisi coba', 'waktu coba', 'catatan coba', '2020-09-29 18:54:56', '2020-09-29 19:43:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL DEFAULT '0',
  `bulan` int(11) DEFAULT '0',
  `tahun` year(4) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_petugas`, `bulan`, `tahun`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 4, 9, 2020, 'ini adalah keterangan', '2020-09-23 22:36:07', '2020-09-23 23:20:12'),
(9, 6, 9, 2020, 'jangan telat', '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(11, 7, 9, 2020, 'lakukan dengan baik', '2020-09-24 19:05:11', '2020-09-24 19:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_detail`
--

CREATE TABLE `jadwal_detail` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL DEFAULT '0',
  `minggu` int(11) NOT NULL DEFAULT '0',
  `id_ruangan` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_detail`
--

INSERT INTO `jadwal_detail` (`id`, `id_jadwal`, `minggu`, `id_ruangan`, `created_at`, `updated_at`) VALUES
(133, 8, 1, 6, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(134, 8, 1, 5, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(135, 8, 2, 6, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(136, 8, 2, 7, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(137, 8, 3, 6, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(138, 8, 3, 5, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(139, 8, 4, 6, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(140, 8, 4, 7, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(141, 8, 4, 5, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(142, 8, 4, 8, '2020-09-24 18:54:14', '2020-09-24 18:54:14'),
(143, 9, 1, 5, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(144, 9, 1, 6, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(145, 9, 1, 7, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(146, 9, 1, 8, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(147, 9, 2, 6, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(148, 9, 2, 7, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(149, 9, 3, 8, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(150, 9, 3, 5, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(151, 9, 4, 5, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(152, 9, 4, 6, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(153, 9, 4, 7, '2020-09-24 19:03:58', '2020-09-24 19:03:58'),
(179, 11, 1, 6, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(180, 11, 1, 5, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(181, 11, 1, 7, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(182, 11, 2, 5, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(183, 11, 2, 6, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(184, 11, 2, 7, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(185, 11, 3, 5, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(186, 11, 3, 6, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(187, 11, 3, 7, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(188, 11, 4, 5, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(189, 11, 4, 6, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(190, 11, 4, 7, '2020-09-24 19:05:37', '2020-09-24 19:05:37'),
(191, 11, 4, 8, '2020-09-24 19:05:37', '2020-09-24 19:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kalibrasi`
--

CREATE TABLE `jadwal_kalibrasi` (
  `id` int(11) NOT NULL,
  `id_alat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kalibrasi`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pekerjaan`
--

CREATE TABLE `jenis_pekerjaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pekerjaan`
--

INSERT INTO `jenis_pekerjaan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Kalibrasi Alat', '2020-09-13 19:14:31', '2020-09-13 19:14:31'),
(3, 'Inspection Alat', '2020-09-13 19:14:40', '2020-09-13 19:14:40'),
(4, 'Maintenance Alat', '2020-09-13 19:14:57', '2020-09-13 19:14:57'),
(5, 'Complain Alat', '2020-09-13 19:15:07', '2020-09-13 19:15:11'),
(6, 'Repair (Perbaikan) Alat', '2020-09-13 19:15:22', '2020-09-13 19:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_checklist`
--

CREATE TABLE `kategori_checklist` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_checklist`
--

INSERT INTO `kategori_checklist` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Visual Check', '2020-09-09 19:17:12', '2020-09-09 19:17:12'),
(2, 'Safety Check', '2020-09-09 19:17:37', '2020-09-09 19:17:37'),
(3, 'Maintenance', '2020-09-09 19:17:42', '2020-09-09 19:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `kepemilikan`
--

CREATE TABLE `kepemilikan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepemilikan`
--

INSERT INTO `kepemilikan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Rumah sakit', '2020-09-07 20:50:45', '2020-09-07 20:50:45'),
(2, 'orang tua', '2020-09-08 19:27:31', '2020-09-08 19:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_inspection`
--

CREATE TABLE `maintenance_inspection` (
  `id` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL DEFAULT '0',
  `ttd_teknisi` text,
  `tanggal` date DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_catatan_pemeliharaan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_inspection`
--

INSERT INTO `maintenance_inspection` (`id`, `id_teknisi`, `ttd_teknisi`, `tanggal`, `user`, `created_at`, `updated_at`, `id_catatan_pemeliharaan`) VALUES
(1, 4, 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-22', 'AHMAD IMAM', '2020-09-21 21:36:11', '2020-09-21 21:49:46', 1),
(2, 5, 'signs/320px-Greg_Koch_(signature).png', '2020-09-23', 'BADROL', '2020-09-21 21:36:11', '2020-09-21 21:36:11', 1),
(3, 4, 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-24', 'SUHAIMI', '2020-09-21 21:36:11', '2020-09-21 21:36:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `checklist_qty` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `checklist_qty`, `created_at`, `updated_at`) VALUES
(1, 3, '2020-09-19 01:35:43', '2020-09-19 02:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pelayanan`
--

CREATE TABLE `permintaan_pelayanan` (
  `id` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL DEFAULT '0',
  `kerusakan_alat` text,
  `id_alkes` int(11) NOT NULL DEFAULT '0',
  `merk` varchar(100) DEFAULT NULL,
  `no_seri` varchar(100) DEFAULT NULL,
  `lain_lain` text,
  `kerusakan_awal` text,
  `tanggal_ajuan` date DEFAULT NULL,
  `batas_waktu_perbaikan` date DEFAULT NULL,
  `data_kerusakan_tanggal` date DEFAULT NULL,
  `opsi_kerusakan` enum('Perbaikan','Pergantian') DEFAULT NULL,
  `catatan_tambahan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_pelayanan`
--

INSERT INTO `permintaan_pelayanan` (`id`, `id_ruang`, `kerusakan_alat`, `id_alkes`, `merk`, `no_seri`, `lain_lain`, `kerusakan_awal`, `tanggal_ajuan`, `batas_waktu_perbaikan`, `data_kerusakan_tanggal`, `opsi_kerusakan`, `catatan_tambahan`, `created_at`, `updated_at`) VALUES
(1, 34, 'ini adalah alat', 9, 'yamaha1', '388651', NULL, 'kerusakan awal', '2020-09-29', '2020-09-29', '2020-10-01', 'Perbaikan', 'catatna tambahan', '2020-09-28 21:27:48', '2020-09-28 21:39:15'),
(2, 5, 'tes kerusahan', 16, 'yamaha', '2323232', 'oooo', 'tess', '2020-09-29', '2020-09-30', '2020-09-30', 'Perbaikan', 'tttt', '2020-09-28 22:11:22', '2020-09-28 22:11:22'),
(3, 6, 'ganti baru', 14, 'contoh merk', '2323232', NULL, 'tidak diketahui', '2020-10-01', '2020-10-02', '2020-09-14', 'Pergantian', NULL, '2020-09-29 19:49:27', '2020-09-29 19:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_perpindahan`
--

CREATE TABLE `riwayat_perpindahan` (
  `id` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL DEFAULT '0',
  `id_ruangan` int(11) NOT NULL DEFAULT '0',
  `tgl_masuk` timestamp NULL DEFAULT NULL,
  `tgl_keluar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_perpindahan`
--

INSERT INTO `riwayat_perpindahan` (`id`, `id_alat`, `id_ruangan`, `tgl_masuk`, `tgl_keluar`) VALUES
(1, 8, 6, '2020-09-08 20:53:33', '2020-09-08 21:05:52'),
(2, 8, 5, '2020-09-08 21:05:27', '2020-09-08 21:05:52'),
(3, 8, 6, '2020-09-08 21:05:52', '2020-09-08 21:09:28'),
(4, 8, 5, '2020-09-08 21:09:28', '2020-09-08 21:10:11'),
(5, 8, 6, '2020-09-08 21:10:11', NULL),
(6, 9, 6, '2020-09-09 19:51:47', '2020-09-09 20:12:05'),
(7, 9, 5, '2020-09-09 20:12:05', NULL),
(8, 10, 5, '2020-09-10 19:51:15', NULL),
(9, 11, 6, '2020-09-10 19:52:48', NULL),
(10, 12, 5, '2020-09-10 19:54:52', NULL),
(11, 13, 5, '2020-09-13 19:05:28', NULL),
(12, 14, 6, '2020-09-14 19:27:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `awalan` varchar(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `awalan`, `created_at`, `updated_at`) VALUES
(5, 'Radiologi', 'RAD', '2020-09-07 18:47:13', '2020-09-07 18:47:13'),
(6, 'Laboratorium', 'LAB', '2020-09-07 18:49:21', '2020-09-07 18:49:21'),
(7, 'UGD', 'UGD', '2020-09-20 18:58:53', '2020-09-20 18:58:53'),
(8, 'ICU', 'ICU', '2020-09-24 18:54:00', '2020-09-24 18:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumber_dana`
--

INSERT INTO `sumber_dana` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'sekolah', '2020-09-07 18:12:57', '2020-09-07 18:12:57'),
(2, 'tambak', '2020-09-08 18:49:51', '2020-09-08 18:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 'PT. Anugrah Jaya Abadi', 'randu kuning', '2020-09-07 20:39:30', '2020-09-15 20:53:08'),
(4, 'PT. Bintang Terang Benderang', 'ngipik', '2020-09-08 19:28:21', '2020-09-15 20:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `ttd` varchar(100) DEFAULT NULL,
  `kepala` int(11) NOT NULL DEFAULT '0' COMMENT '1= true, 0= false',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `nama`, `hp`, `nip`, `ttd`, `kepala`, `created_at`, `updated_at`) VALUES
(4, 'Neymar Jr', '081567232245', '237238273 34734384 3 344', 'signs/320px-Dave_Bautista_signature.svg.png', 1, '2020-09-17 19:56:11', '2020-09-29 19:50:45'),
(5, 'Luis Suarez', '083569432225', '237238273 34734384 3 355', 'signs/320px-Greg_Koch_(signature).png', 0, '2020-09-17 19:56:55', '2020-09-29 19:50:45'),
(6, 'Leonel Messi', '083967232383', '237238972 39774386 3 300', 'signs/tanda tangan 1.jpg', 0, '2020-09-24 19:02:53', '2020-09-29 19:50:45'),
(7, 'Cristiano Ronaldo', '0894253782197', '237238277 34434384 3 300', 'signs/tanda tangan 2.jpeg', 0, '2020-09-24 19:03:11', '2020-09-29 19:50:45'),
(8, 'David Luiz', '089453782168', '237238273 34734384 3 312', 'signs/tanda tangan 1.jpg', 0, '2020-09-24 19:34:11', '2020-09-29 19:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$sD9sKVWkkrcgzUg4CzQQFuT6HI.RanqYHu1PJ.koLsKPgpZTywSJS', '2020-09-07 04:01:34', '2020-09-25 18:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_alkes`
--
ALTER TABLE `data_alkes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_tinjauan`
--
ALTER TABLE `hasil_tinjauan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_detail`
--
ALTER TABLE `jadwal_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_kalibrasi`
--
ALTER TABLE `jadwal_kalibrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_checklist`
--
ALTER TABLE `kategori_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepemilikan`
--
ALTER TABLE `kepemilikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_inspection`
--
ALTER TABLE `maintenance_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_perpindahan`
--
ALTER TABLE `riwayat_perpindahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `data_alkes`
--
ALTER TABLE `data_alkes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hasil_tinjauan`
--
ALTER TABLE `hasil_tinjauan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `jadwal_detail`
--
ALTER TABLE `jadwal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `jadwal_kalibrasi`
--
ALTER TABLE `jadwal_kalibrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kategori_checklist`
--
ALTER TABLE `kategori_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kepemilikan`
--
ALTER TABLE `kepemilikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `maintenance_inspection`
--
ALTER TABLE `maintenance_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `riwayat_perpindahan`
--
ALTER TABLE `riwayat_perpindahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
