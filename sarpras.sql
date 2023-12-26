-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2023 at 11:50 AM
-- Server version: 5.7.41-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `only_owned` tinyint(1) NOT NULL DEFAULT '0',
  `options` json DEFAULT NULL,
  `scope` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `name`, `title`, `entity_id`, `entity_type`, `only_owned`, `options`, `scope`, `created_at`, `updated_at`) VALUES
(1, 'teknisi', 'teknisi', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(2, 'ruangan', 'ruangan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(3, 'supplier', 'supplier', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(4, 'sumber-dana', 'sumber-dana', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(5, 'kepemilikan', 'kepemilikan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(6, 'alat', 'alat', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(7, 'kategori-checklist', 'kategori-checklist', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(8, 'jenis-pekerjaan', 'jenis-pekerjaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(9, 'data-alkes', 'data-alkes', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(10, 'jadwal-pemeliharaan', 'jadwal-pemeliharaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(11, 'catatan-pemeliharaan', 'catatan-pemeliharaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(12, 'jadwal', 'jadwal', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(13, 'cetak-label', 'cetak-label', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(14, 'permintaan-pelayanan', 'permintaan-pelayanan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(15, 'pengaturan_jabatan', 'pengaturan_jabatan', NULL, NULL, 0, NULL, NULL, '2020-10-09 14:23:04', '2020-10-09 14:23:04'),
(17, 'roles', 'roles', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(18, 'user', 'user', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(19, 'on', 'On', NULL, NULL, 0, NULL, NULL, '2020-10-11 13:13:31', '2020-10-11 13:13:31');

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
(6, 'Pendeteksi detak jantung1', '2020-09-09 19:45:34', '2020-10-01 18:33:36'),
(7, 'Pemotong kuku kaki gajah', '2020-09-10 19:50:08', '2020-09-10 19:50:08'),
(8, 'Tensi Meter1', '2020-09-17 18:59:55', '2020-10-01 18:34:01'),
(14, 'Pendeteksi Paru-paru', '2020-09-20 19:58:21', '2020-09-20 20:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restricted_to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restricted_to_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `role_id`, `entity_id`, `entity_type`, `restricted_to_id`, `restricted_to_type`, `scope`) VALUES
(2, 1, 3, 'App\\User', NULL, NULL, NULL),
(3, 2, 4, 'App\\User', NULL, NULL, NULL),
(4, 1, 1, 'App\\User', NULL, NULL, NULL),
(5, 2, 5, 'App\\User', NULL, NULL, NULL);

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
  `id_teknisi_setempat` int(11) NOT NULL DEFAULT '0',
  `id_vendor` int(11) NOT NULL DEFAULT '0',
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL,
  `id_ruang` int(11) NOT NULL,
  `masa_kalibrasi` date DEFAULT NULL,
  `interval_pemeliharaan` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text,
  `tindakan` text,
  `jumlah_biaya` int(11) NOT NULL DEFAULT '0',
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bengkel_rujukan` varchar(100) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `id_permintaan_pelayanan` int(11) DEFAULT '0',
  `nomor` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_pemeliharaan`
--

INSERT INTO `catatan_pemeliharaan` (`id`, `id_alkes`, `merek`, `model`, `no_seri`, `no_invent`, `id_jenis_pekerjaan`, `id_teknisi_setempat`, `id_vendor`, `mulai`, `selesai`, `id_ruang`, `masa_kalibrasi`, `interval_pemeliharaan`, `tahun`, `tanggal`, `keluhan`, `tindakan`, `jumlah_biaya`, `keterangan`, `created_at`, `updated_at`, `bengkel_rujukan`, `nama_user`, `id_permintaan_pelayanan`, `nomor`) VALUES
(1, 16, 'yamaha', 'rtyy', '2323232', '182718927912', 4, 5, 0, '2020-10-22', '2020-10-13', 7, '2020-10-05', '1 tahun', 2020, '2021-10-26', 'keluhan', 'tindakan', 10000, 'ok', '2020-10-26 01:05:38', '2020-11-12 04:54:18', NULL, NULL, 0, '001/ST/X/2020'),
(3, 9, 'yamaha1', 'rtyy1', '388651', 'rrrr', 4, 0, 0, '2020-09-02', '2020-09-30', 5, '2020-09-29', '1 tahun', 2020, '2020-09-30', 'keluhan', 'tindakan', 1000000, 'keterangan', '2020-09-30 03:20:28', '2020-10-01 02:56:11', 'bengkel', NULL, 0, '0'),
(4, 9, 'yamaha1', 'rtyy1', '388651', 'rrrr', 2, 5, 0, '2020-10-16', '2020-10-14', 5, '2020-10-16', '23232323', 2020, '2020-10-02', 'kel', 'tesss', 300, 'keterangan', '2020-10-02 02:55:38', '2020-10-02 02:55:38', NULL, NULL, 0, '0'),
(5, 15, 'Riester', 'Nova', '040945694', '02.08.02.01.02.1334', 6, 4, 0, '2020-11-03', '2020-11-03', 7, '2020-11-03', '1 tahun', 2020, '2020-11-03', 'tess', 'tindakan', 10000, NULL, '2020-11-03 02:22:38', '2020-11-03 02:23:14', NULL, NULL, 1, '002/ST/XI/2020'),
(6, 14, 'contoh merk', 'rtyy', '2323232', 'tes nomor12', 2, 5, 0, '2020-10-17', '2020-10-14', 6, '2020-10-23', '23232323', 2020, '2020-10-02', 'keluhan', 'dilihat', 3000, 'ket', '2020-10-02 02:58:34', '2020-10-02 02:58:34', NULL, NULL, 0, '0'),
(7, 14, 'contoh merk', 'rtyy', '2323232', 'tes nomor12', 4, 0, 0, '2020-10-10', '2020-10-03', 6, '2020-10-17', 'tes', 2020, '2020-10-02', NULL, NULL, 7126112, NULL, '2020-10-02 03:04:00', '2020-10-02 03:04:00', 'tes', NULL, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pemeliharaan_checklist`
--

CREATE TABLE `catatan_pemeliharaan_checklist` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL DEFAULT '0',
  `checklist` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_pemeliharaan_checklist`
--

INSERT INTO `catatan_pemeliharaan_checklist` (`id`, `id_catatan_pemeliharaan`, `id_kategori`, `checklist`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Cek Kondisi Fisik Alat dari kerusakan', '2020-10-25 18:05:38', '2020-10-25 18:05:38'),
(2, 1, 1, 'Cek Kondisi dan kelengkapan asesoris', '2020-10-25 18:05:39', '2020-10-25 18:05:39'),
(3, 1, 2, 'cek tahanan ground', '2020-10-25 18:05:40', '2020-10-25 18:05:40'),
(4, 1, 2, 'cek kebocoran arus ground pada kondisi normal', '2020-10-25 18:05:41', '2020-10-25 18:05:41'),
(5, 1, 2, 'hero', '2020-10-25 18:05:42', '2020-10-25 18:05:42'),
(6, 1, 3, 'Bersihkan unit dari kotoran', '2020-10-25 18:05:44', '2020-10-25 18:05:44'),
(7, 1, 3, 'cek fungsi saklar ON- OFF', '2020-10-25 18:05:47', '2020-10-25 18:05:47');

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
(1, 1, 1, 1, '2020-10-25 18:05:39', '2020-11-02 19:19:04'),
(2, 1, 2, 0, '2020-10-25 18:05:39', '2020-10-25 18:05:39'),
(3, 1, 3, 0, '2020-10-25 18:05:39', '2020-10-25 18:05:39'),
(4, 2, 1, 2, '2020-10-25 18:05:39', '2020-11-02 19:19:04'),
(5, 2, 2, 0, '2020-10-25 18:05:40', '2020-10-25 18:05:40'),
(6, 2, 3, 0, '2020-10-25 18:05:40', '2020-10-25 18:05:40'),
(7, 3, 1, 0, '2020-10-25 18:05:41', '2020-10-25 18:05:41'),
(8, 3, 2, 1, '2020-10-25 18:05:41', '2020-11-02 19:19:04'),
(9, 3, 3, 0, '2020-10-25 18:05:41', '2020-10-25 18:05:41'),
(10, 4, 1, 0, '2020-10-25 18:05:42', '2020-10-25 18:05:42'),
(11, 4, 2, 2, '2020-10-25 18:05:42', '2020-11-02 19:19:05'),
(12, 4, 3, 0, '2020-10-25 18:05:42', '2020-10-25 18:05:42'),
(13, 5, 1, 0, '2020-10-25 18:05:42', '2020-10-25 18:05:42'),
(14, 5, 2, 0, '2020-10-25 18:05:43', '2020-10-25 18:05:43'),
(15, 5, 3, 0, '2020-10-25 18:05:44', '2020-10-25 18:05:44'),
(16, 6, 1, 0, '2020-10-25 18:05:45', '2020-10-25 18:05:45'),
(17, 6, 2, 0, '2020-10-25 18:05:47', '2020-10-25 18:05:47'),
(18, 6, 3, 0, '2020-10-25 18:05:47', '2020-10-25 18:05:47'),
(19, 7, 1, 0, '2020-10-25 18:05:48', '2020-10-25 18:05:48'),
(20, 7, 2, 0, '2020-10-25 18:05:48', '2020-10-25 18:05:48'),
(21, 7, 3, 0, '2020-10-25 18:05:49', '2020-10-25 18:05:49');

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
(8, 'Cek kondisi fisik alat dari kerusakannya1', 1, '2020-09-17 19:07:17', '2020-10-01 18:34:01', 8),
(10, 'Cek Ketahanan1', 2, '2020-09-17 19:07:17', '2020-10-01 18:34:01', 8),
(12, 'Bersihkan unit1', 3, '2020-09-17 19:07:17', '2020-10-01 18:34:01', 8),
(23, 'cek kebersihan', 1, '2020-09-20 19:58:21', '2020-09-20 20:33:13', 14),
(24, 'safetynya gimana', 2, '2020-09-20 19:58:21', '2020-09-20 20:33:23', 14),
(25, 'maintenancenya gimana', 3, '2020-09-20 19:58:21', '2020-09-20 20:33:32', 14),
(32, 'cek', 1, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(33, 'safety', 2, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(34, 'maintenance', 3, '2020-09-20 21:45:40', '2020-09-20 21:45:40', 7),
(41, 'tes 1', 4, '2020-10-01 18:48:37', '2020-10-01 18:48:37', 8),
(42, 'tes 2', 4, '2020-10-01 18:48:37', '2020-10-01 18:48:37', 8),
(43, 'ini tes ss', 4, '2020-10-01 18:49:30', '2020-10-01 18:49:37', 7),
(44, 'ini tes ssss', 4, '2020-10-01 18:50:19', '2020-10-01 18:50:19', 6);

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_supplier` int(11) DEFAULT '0',
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

INSERT INTO `hasil_tinjauan` (`id`, `oleh_instalasi_alkes`, `oleh_seksi_penunjang_non_medik`, `kesimpulan`, `alasan_kesimpulan`, `alat_diperbaiki_oleh`, `tanggal`, `id_teknisi`, `id_supplier`, `rab`, `proses_perbaikan_tanggal`, `mulai_dikerjakan`, `perkiraan_selesai`, `pelaksanaan_swakelola`, `uji_coba`, `kondisi_akhir`, `waktu_jaminan`, `catatan_tambahan`, `created_at`, `updated_at`, `id_permintaan_pelayanan`) VALUES
(3, 'tes', 'tes 2', 'tidak', 'alsan', '2', NULL, NULL, 4, 'rab coba', '2020-10-01', '2020-10-02', '2020-10-03', NULL, 'uji', 'kondisi coba', 'waktu coba', 'a', '2020-09-29 21:43:42', '2020-09-29 21:44:04', 2);

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
(6, 'Repair (Perbaikan) Alat', '2020-09-13 19:15:22', '2020-10-01 18:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `kalibrasi`
--

CREATE TABLE `kalibrasi` (
  `id` int(11) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kalibrasi`
--

INSERT INTO `kalibrasi` (`id`, `file`, `id_catatan_pemeliharaan`, `created_at`, `updated_at`) VALUES
(1, 'kalibrasi/1601520380 - Screen Shot 2020-09-26 at 21.05.34.png', 1, '2020-09-30 19:46:20', '2020-09-30 19:46:20'),
(2, 'kalibrasi/1601607514 - sample.pdf', 6, '2020-10-01 19:58:34', '2020-10-01 19:58:34');

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
(3, 4, 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-24', 'SUHAIMI', '2020-09-21 21:36:11', '2020-09-21 21:36:11', 1),
(4, 8, 'signs/tanda tangan 1.jpg', NULL, 'tes', '2020-10-01 20:04:00', '2020-10-01 20:04:00', 7),
(5, 5, 'signs/320px-Greg_Koch_(signature).png', NULL, NULL, '2020-10-01 20:04:00', '2020-10-01 20:04:00', 7),
(6, 0, NULL, NULL, '0', '2020-10-01 20:04:00', '2020-10-01 20:04:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_10_041920_create_bouncer_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `perbaikan` varchar(100) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `tanggal`, `perbaikan`, `jam_mulai`, `jam_selesai`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(2, '2023-05-06', 'memperbaiki ac bocor', '10:38:00', '11:39:00', 'nivas', 'selesai', 'gambar_pekerjaan/jadiduit logo.png', '2023-05-05 20:39:15', '2023-05-05 21:00:11'),
(4, '2023-05-09', 'memperbaiki ac bocor', '10:43:00', '11:43:00', 'server basement', 'selesai', 'gambar_pekerjaan/Grey Minimalist Tips Blog Banner.png', '2023-05-05 20:43:35', '2023-05-05 20:59:47');

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
-- Table structure for table `pengaturan_jabatan`
--

CREATE TABLE `pengaturan_jabatan` (
  `id` int(11) NOT NULL,
  `kepala_instalasi_alkes` int(11) DEFAULT '0' COMMENT 'id_teknisi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan_jabatan`
--

INSERT INTO `pengaturan_jabatan` (`id`, `kepala_instalasi_alkes`, `created_at`, `updated_at`) VALUES
(1, 4, '2020-10-01 02:29:05', '2020-10-01 18:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL DEFAULT '0',
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `laporan_kerusakan_awal` text,
  `batas_waktu_perbaikan` date NOT NULL,
  `tindakan_perbaikan` text,
  `suku_cadang` text,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `hasil_perbaikan` text,
  `saran_dari_petugas` text,
  `catatan` text,
  `ka_ruang` varchar(11) DEFAULT NULL,
  `mulai_dikerjakan` date NOT NULL,
  `selesai_dikerjakan` date NOT NULL,
  `pesan_pemberi_tugas` text,
  `nama_petugas_gudang` varchar(100) NOT NULL,
  `id_teknisi_penanggung_jawab` int(11) NOT NULL DEFAULT '0',
  `ttd_teknisi_penanggung_jawab` varchar(100) DEFAULT NULL,
  `nama_smf_bag` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diteruskan_kepada` varchar(100) DEFAULT NULL,
  `pemberi_tugas` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` int(11) DEFAULT '0' COMMENT '1=ditinjau, 0=belum',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_pelayanan`
--

INSERT INTO `permintaan_pelayanan` (`id`, `id_ruang`, `kerusakan_alat`, `id_alkes`, `merk`, `no_seri`, `lain_lain`, `kerusakan_awal`, `tanggal_ajuan`, `batas_waktu_perbaikan`, `data_kerusakan_tanggal`, `opsi_kerusakan`, `catatan_tambahan`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'ini adalah alat', 9, 'yamaha1', '388651', NULL, 'kerusakan awal', '2020-09-29', '2020-09-29', '2020-10-01', 'Perbaikan', 'catatna tambahan', 0, '2020-09-28 21:27:48', '2020-09-30 04:05:11'),
(2, 5, 'tes kerusahan', 16, 'yamaha', '2323232', 'oooo', 'tess', '2020-09-29', '2020-09-30', '2020-09-30', 'Perbaikan', 'tttt', 1, '2020-09-28 22:11:22', '2020-09-29 21:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ability_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forbidden` tinyint(1) NOT NULL DEFAULT '0',
  `scope` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `ability_id`, `entity_id`, `entity_type`, `forbidden`, `scope`) VALUES
(173, 1, 1, 'roles', 0, NULL),
(174, 2, 1, 'roles', 0, NULL),
(175, 3, 1, 'roles', 0, NULL),
(176, 4, 1, 'roles', 0, NULL),
(177, 5, 1, 'roles', 0, NULL),
(178, 6, 1, 'roles', 0, NULL),
(179, 7, 1, 'roles', 0, NULL),
(180, 8, 1, 'roles', 0, NULL),
(181, 9, 1, 'roles', 0, NULL),
(182, 10, 1, 'roles', 0, NULL),
(183, 11, 1, 'roles', 0, NULL),
(184, 12, 1, 'roles', 0, NULL),
(185, 13, 1, 'roles', 0, NULL),
(186, 14, 1, 'roles', 0, NULL),
(187, 15, 1, 'roles', 0, NULL),
(188, 17, 1, 'roles', 0, NULL),
(189, 18, 1, 'roles', 0, NULL),
(190, 19, 1, 'roles', 0, NULL),
(216, 14, 2, 'roles', 0, NULL);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL,
  `scope` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `level`, `scope`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'SuperAdmin', NULL, NULL, '2020-10-09 14:43:19', '2020-10-11 11:49:17'),
(2, 'Ruangan', 'Ruangan', NULL, NULL, '2020-10-09 15:01:43', '2020-10-11 13:20:16');

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
(4, 'PT. Bintang Terang Benderang', 'ngipik', '2020-09-08 19:28:21', '2020-09-15 20:53:01'),
(5, 'PT. Jaya Abadi', 'Trangkil Pati', '2020-10-01 18:31:03', '2020-10-01 18:31:11');

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
(4, 'Neymar Jr', '081567232245', '237238273 34734384 3 344', 'signs/320px-Dave_Bautista_signature.svg.png', 0, '2020-09-17 19:56:11', '2020-10-01 02:37:55'),
(5, 'Luis Suarez', '083569432225', '237238273 34734384 3 355', 'signs/320px-Greg_Koch_(signature).png', 0, '2020-09-17 19:56:55', '2020-09-30 19:06:36'),
(6, 'Leonel Messi', '083967232383', '237238972 39774386 3 300', 'signs/tanda tangan 1.jpg', 0, '2020-09-24 19:02:53', '2020-09-30 19:06:36'),
(7, 'Cristiano Ronaldo', '0894253782197', '237238277 34434384 3 300', 'signs/tanda tangan 2.jpeg', 0, '2020-09-24 19:03:11', '2020-09-30 19:06:36'),
(8, 'David Luiz', '089453782168', '237238273 34734384 3 312', 'signs/tanda tangan 1.jpg', 0, '2020-09-24 19:34:11', '2020-09-30 19:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ruangan` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `id_ruangan`, `updated_at`) VALUES
(1, 'admin', '$2y$10$sD9sKVWkkrcgzUg4CzQQFuT6HI.RanqYHu1PJ.koLsKPgpZTywSJS', '2020-09-06 21:01:34', 0, '2020-09-25 11:40:41'),
(3, 'superadmin', '$2y$10$cCuQwqRoEaKwZLo/t4COnePJoZfAVm6YDfAgqT83xx2ibHR96ucBu', '2020-10-09 14:59:15', 0, '2020-10-09 14:59:15'),
(4, 'ruangan', '$2y$10$M1/tfIncKe/zReZZ7KUIw.XFpII.yeVpFvvDZOCC1FWeg4HmLuGEW', '2020-10-09 15:01:56', 0, '2020-10-09 15:01:56'),
(5, 'IGD', '$2y$10$DYFLXQYhleg/fPRNBhpouOSIaBKnmQLWtwWnpzqu6koQSqgqgBm1.', '2020-10-11 13:17:14', 7, '2020-10-11 13:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abilities_scope_index` (`scope`);

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_roles_entity_index` (`entity_id`,`entity_type`,`scope`),
  ADD KEY `assigned_roles_role_id_index` (`role_id`),
  ADD KEY `assigned_roles_scope_index` (`scope`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `kalibrasi`
--
ALTER TABLE `kalibrasi`
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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan_jabatan`
--
ALTER TABLE `pengaturan_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_entity_index` (`entity_id`,`entity_type`,`scope`),
  ADD KEY `permissions_ability_id_index` (`ability_id`),
  ADD KEY `permissions_scope_index` (`scope`);

--
-- Indexes for table `riwayat_perpindahan`
--
ALTER TABLE `riwayat_perpindahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`,`scope`),
  ADD KEY `roles_scope_index` (`scope`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `data_alkes`
--
ALTER TABLE `data_alkes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hasil_tinjauan`
--
ALTER TABLE `hasil_tinjauan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `jadwal_detail`
--
ALTER TABLE `jadwal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
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
-- AUTO_INCREMENT for table `kalibrasi`
--
ALTER TABLE `kalibrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengaturan_jabatan`
--
ALTER TABLE `pengaturan_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `riwayat_perpindahan`
--
ALTER TABLE `riwayat_perpindahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
