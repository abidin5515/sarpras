-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Sep 2020 pada 10.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alkes_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_pemeliharaan`
--

CREATE TABLE `catatan_pemeliharaan` (
  `id` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `no_seri` varchar(100) NOT NULL,
  `no_invent` varchar(100) NOT NULL,
  `id_jenis_pekerjaan` int(11) NOT NULL,
  `id_teknisi_setempat` int(11) NOT NULL DEFAULT 0,
  `id_vendor` int(11) NOT NULL DEFAULT 0,
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL,
  `id_ruang` int(11) NOT NULL,
  `masa_kalibrasi` varchar(100) NOT NULL,
  `interval_pemeliharaan` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `jumlah_biaya` int(11) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bengkel_rujukan` varchar(100) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan_pemeliharaan`
--

INSERT INTO `catatan_pemeliharaan` (`id`, `id_alkes`, `merek`, `model`, `no_seri`, `no_invent`, `id_jenis_pekerjaan`, `id_teknisi_setempat`, `id_vendor`, `mulai`, `selesai`, `id_ruang`, `masa_kalibrasi`, `interval_pemeliharaan`, `tahun`, `tanggal`, `keluhan`, `tindakan`, `jumlah_biaya`, `keterangan`, `created_at`, `updated_at`, `bengkel_rujukan`, `nama_user`) VALUES
(1, 11, 'Merk', '1A0', '10201o0', '122.213', 3, 4, 0, '2020-09-29', '2020-09-30', 34, '2020-09-29', 'tes', 2020, '2020-09-28', 'keluhan', 'tindakan', 1000000, 'keterangan', '2020-09-29 05:57:06', '2020-09-29 05:57:06', NULL, NULL),
(2, 11, 'Merk', '1A0', '10201o0', '122.213', 6, 4, 0, '2020-09-30', '2020-10-01', 34, '2020-09-29', '1 tahun', 2020, '2020-09-29', 'keluhane', 'memperbaiki', 1000000, 'keterangan', '2020-09-29 06:10:37', '2020-09-29 06:10:37', NULL, NULL),
(3, 9, 'yamaha1', 'rtyy1', '388651', 'rrrr', 4, 8, 0, '2020-09-02', '2020-09-30', 5, '2020-09-29', '1 tahun', 2020, '2020-09-30', 'keluhan', 'tindakan', 1000000, 'keterangan', '2020-09-30 03:20:28', '2020-09-30 03:20:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_pemeliharaan_checklist`
--

CREATE TABLE `catatan_pemeliharaan_checklist` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL DEFAULT 0,
  `checklist` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan_pemeliharaan_checklist`
--

INSERT INTO `catatan_pemeliharaan_checklist` (`id`, `id_catatan_pemeliharaan`, `id_kategori`, `checklist`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Cek Kondisi Fisik Alat dari kerusakan', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(2, 1, 1, 'Cek Kondisi dan kelengkapan asesoris', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(3, 1, 2, 'cek tahanan ground', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(4, 1, 2, 'cek kebocoran arus ground pada kondisi normal', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(5, 1, 3, 'Bersihkan unit dari kotoran', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(6, 1, 3, 'cek fungsi saklar ON- OFF', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(7, 1, 3, 'Cek penunjukan nol pada alat', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(8, 1, 3, 'cek kondisi battere', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(9, 1, 3, 'cek kondisi manset', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(10, 1, 3, 'cek kondisi bulb', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(11, 1, 3, 'cek kondisi selang teknisi', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(12, 1, 3, 'cek kebersihan tubing kaca dan air raksa', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(13, 1, 3, 'cek fungsi dan kinerja alat', '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(14, 3, 1, 'Cek Kondisi Fisik Alat dari kerusakan', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(15, 3, 1, 'Cek Kondisi dan kelengkapan asesoris', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(16, 3, 1, 'Cek kondisi fisik alat dari kerusakannya', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(17, 3, 1, 'Cek kondisi dan kelengkapan asesoris', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(18, 3, 1, 'cek kebersihan', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(19, 3, 1, 'cek', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(20, 3, 1, 'n jn', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(21, 3, 2, 'cek tahanan ground', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(22, 3, 2, 'cek kebocoran arus ground pada kondisi normal', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(23, 3, 2, 'hero', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(24, 3, 2, 'Cek Ketahanan', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(25, 3, 2, 'Cek Kebocoran', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(26, 3, 2, 'safetynya gimana', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(27, 3, 2, 'safety', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(28, 3, 2, 'hjbjhb', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(29, 3, 3, 'Bersihkan unit dari kotoran', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(30, 3, 3, 'cek fungsi saklar ON- OFF', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(31, 3, 3, 'Bersihkan unit', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(32, 3, 3, 'Cek Saklarnya', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(33, 3, 3, 'Cek Penunjukan', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(34, 3, 3, 'maintenancenya gimana', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(35, 3, 3, 'maintenance', '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(36, 3, 3, 'jhbjhb', '2020-09-29 20:20:28', '2020-09-29 20:20:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_pemeliharaan_checklist_value`
--

CREATE TABLE `catatan_pemeliharaan_checklist_value` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan_checklist` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT 'periode/kurun waktu',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1:Baik,2:Tidak Baik',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `catatan_pemeliharaan_checklist_value`
--

INSERT INTO `catatan_pemeliharaan_checklist_value` (`id`, `id_catatan_pemeliharaan_checklist`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(2, 1, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(3, 1, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(4, 2, 1, 2, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(5, 2, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(6, 2, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(7, 3, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(8, 3, 2, 1, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(9, 3, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(10, 4, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(11, 4, 2, 2, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(12, 4, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(13, 5, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(14, 5, 2, 1, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(15, 5, 3, 1, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(16, 6, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(17, 6, 2, 1, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(18, 6, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(19, 7, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(20, 7, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(21, 7, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(22, 8, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(23, 8, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(24, 8, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(25, 9, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(26, 9, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(27, 9, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(28, 10, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(29, 10, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(30, 10, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(31, 11, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(32, 11, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(33, 11, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(34, 12, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(35, 12, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(36, 12, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(37, 13, 1, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(38, 13, 2, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(39, 13, 3, 0, '2020-09-28 22:57:06', '2020-09-28 22:57:06'),
(40, 14, 1, 1, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(41, 14, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(42, 14, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(43, 15, 1, 2, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(44, 15, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(45, 15, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(46, 16, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(47, 16, 2, 1, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(48, 16, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(49, 17, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(50, 17, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(51, 17, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(52, 18, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(53, 18, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(54, 18, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(55, 19, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(56, 19, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(57, 19, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(58, 20, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(59, 20, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(60, 20, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(61, 21, 1, 1, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(62, 21, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(63, 21, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(64, 22, 1, 2, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(65, 22, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(66, 22, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(67, 23, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(68, 23, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(69, 23, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(70, 24, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(71, 24, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(72, 24, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(73, 25, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(74, 25, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(75, 25, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(76, 26, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(77, 26, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(78, 26, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(79, 27, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(80, 27, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(81, 27, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(82, 28, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(83, 28, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(84, 28, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(85, 29, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(86, 29, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(87, 29, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(88, 30, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(89, 30, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(90, 30, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(91, 31, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(92, 31, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(93, 31, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(94, 32, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(95, 32, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(96, 32, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(97, 33, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(98, 33, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(99, 33, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(100, 34, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(101, 34, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(102, 34, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(103, 35, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(104, 35, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(105, 35, 3, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(106, 36, 1, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(107, 36, 2, 0, '2020-09-29 20:20:28', '2020-09-29 20:20:28'),
(108, 36, 3, 2, '2020-09-29 20:20:28', '2020-09-29 20:20:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
