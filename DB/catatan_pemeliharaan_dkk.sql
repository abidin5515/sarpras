-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Sep 2020 pada 10.07
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
-- Database: `alkes`
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bengkel_rujukan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan_pemeliharaan`
--

INSERT INTO `catatan_pemeliharaan` (`id`, `id_alkes`, `merek`, `model`, `no_seri`, `no_invent`, `id_jenis_pekerjaan`, `teknisi_setempat`, `id_vendor`, `mulai`, `selesai`, `id_ruang`, `masa_kalibrasi`, `interval_pemeliharaan`, `tahun`, `tanggal`, `keluhan`, `tindakan`, `jumlah_biaya`, `keterangan`, `created_at`, `updated_at`, `bengkel_rujukan`) VALUES
(1, 10, 'Merk', '1A0', '10201o0', 'no invent', 3, 'abdul', 4, '2020-09-14', '2020-09-14', 9, 'masa kalibrasi', '2 bulan', 2020, '2020-09-14', 'keluhan', 'tindakan', 10000, 'keterangan', '2020-09-14 02:44:26', '2020-09-14 02:44:26', NULL),
(2, 10, 'Merk', '1A0', '10201o0', 'no invent', 3, 'abdul', 4, '2020-09-14', '2020-09-14', 9, 'masa kalibrasi', '2 bulan', 2020, '2020-09-14', 'keluhan', 'tindakan', 10000, 'keterangan', '2020-09-14 02:45:26', '2020-09-14 02:45:26', NULL),
(5, 10, 'Merk', '1A0', '10201o0', '912812u182u81u', 3, 'teknisi', 5, '2020-09-14', '2020-09-14', 9, '12912912', 'ok', 2020, '2020-09-15', 'okok', 'oko', 10, 'ok', '2020-09-14 06:02:55', '2020-09-14 06:02:55', NULL),
(6, 10, 'Merk', '1A0', '10201o0', '02.00.21', 2, 'Abdul', 5, '2020-09-15', '2020-09-23', 9, 'MASA KALIBRAIS', '1x setahun', 2020, '2020-09-15', 'Keluhan', 'ok', 10000, 'ok', '2020-09-15 01:42:02', '2020-09-15 01:42:02', 'Bengkel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_pemeliharaan_checklist`
--

CREATE TABLE `catatan_pemeliharaan_checklist` (
  `id` int(11) NOT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0: Default; 1: Baik; 2 Tidak Baik',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan_pemeliharaan_checklist`
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
(31, 6, 7, 2, '2020-09-14 18:42:02', '2020-09-14 18:42:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_kategori_checklist` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_alat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `checklist`
--

INSERT INTO `checklist` (`id`, `nama`, `id_kategori_checklist`, `created_at`, `updated_at`, `id_alat`) VALUES
(1, 'Cek Kondisi Fisik Alat dari kerusakan', 1, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(2, 'Cek Kondisi dan kelengkapan asesoris', 1, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(3, 'cek tahanan ground', 2, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(4, 'cek kebocoran arus ground pada kondisi normal', 2, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(5, 'Bersihkan unit dari kotoran', 3, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(6, 'cek fungsi saklar ON- OFF', 3, '2020-09-09 22:37:58', '2020-09-09 22:44:06', 6),
(7, 'hero', 2, '2020-09-09 22:42:11', '2020-09-09 22:42:11', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pekerjaan`
--

CREATE TABLE `jenis_pekerjaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_pekerjaan`
--

INSERT INTO `jenis_pekerjaan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Kalibrasi Alat', '2020-09-13 19:14:31', '2020-09-13 19:14:31'),
(3, 'Inspection Alat', '2020-09-13 19:14:40', '2020-09-13 19:14:40'),
(4, 'Maintenance Alat', '2020-09-13 19:14:57', '2020-09-13 19:14:57'),
(5, 'Complain Alat', '2020-09-13 19:15:07', '2020-09-13 19:15:11'),
(6, 'Repair (Perbaikan) Alat', '2020-09-13 19:15:22', '2020-09-13 19:15:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_checklist`
--

CREATE TABLE `kategori_checklist` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_checklist`
--

INSERT INTO `kategori_checklist` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Visual Check', '2020-09-09 19:17:12', '2020-09-09 19:17:12'),
(2, 'Safety Check', '2020-09-09 19:17:37', '2020-09-09 19:17:37'),
(3, 'Maintenance', '2020-09-09 19:17:42', '2020-09-09 19:17:42');

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
-- Indeks untuk tabel `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_checklist`
--
ALTER TABLE `kategori_checklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan`
--
ALTER TABLE `catatan_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan_checklist`
--
ALTER TABLE `catatan_pemeliharaan_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_checklist`
--
ALTER TABLE `kategori_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
