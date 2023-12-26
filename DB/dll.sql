-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Sep 2020 pada 09.51
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
-- Struktur dari tabel `maintenance_inspection`
--

CREATE TABLE `maintenance_inspection` (
  `id` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL DEFAULT 0,
  `ttd_teknisi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_catatan_pemeliharaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `maintenance_inspection`
--

INSERT INTO `maintenance_inspection` (`id`, `id_teknisi`, `ttd_teknisi`, `tanggal`, `user`, `created_at`, `updated_at`, `id_catatan_pemeliharaan`) VALUES
(1, 4, 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-22', 'AHMAD IMAM', '2020-09-21 21:36:11', '2020-09-21 21:49:46', 1),
(2, 5, 'signs/320px-Greg_Koch_(signature).png', '2020-09-23', 'BADROL', '2020-09-21 21:36:11', '2020-09-21 21:36:11', 1),
(3, 4, 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-24', 'SUHAIMI', '2020-09-21 21:36:11', '2020-09-21 21:36:11', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `checklist_qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `checklist_qty`, `created_at`, `updated_at`) VALUES
(1, 3, '2020-09-19 01:35:43', '2020-09-19 02:22:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `ttd` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`id`, `nama`, `ttd`, `created_at`, `updated_at`) VALUES
(4, 'Budi Sujanarko', 'signs/320px-Dave_Bautista_signature.svg.png', '2020-09-17 19:56:11', '2020-09-17 19:56:11'),
(5, 'Imam Hidayat', 'signs/320px-Greg_Koch_(signature).png', '2020-09-17 19:56:55', '2020-09-17 19:56:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `maintenance_inspection`
--
ALTER TABLE `maintenance_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan_pemeliharaan_checklist_value`
--
ALTER TABLE `catatan_pemeliharaan_checklist_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `maintenance_inspection`
--
ALTER TABLE `maintenance_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
