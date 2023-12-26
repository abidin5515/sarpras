-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Sep 2020 pada 12.04
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
-- Struktur dari tabel `hasil_tinjauan`
--

CREATE TABLE `hasil_tinjauan` (
  `id` int(11) NOT NULL,
  `oleh_instalasi_alkes` text DEFAULT NULL,
  `oleh_seksi_penunjang_non_medik` text DEFAULT NULL,
  `kesimpulan` varchar(100) DEFAULT NULL,
  `alasan_kesimpulan` text DEFAULT NULL,
  `alat_diperbaiki_oleh` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_teknisi` int(11) NOT NULL,
  `rab` varchar(100) DEFAULT NULL,
  `proses_perbaikan_tanggal` date DEFAULT NULL,
  `mulai_dikerjakan` date DEFAULT NULL,
  `perkiraan_selesai` date DEFAULT NULL,
  `pelaksanaan_swakelola` varchar(100) DEFAULT NULL,
  `uji_coba` varchar(100) DEFAULT NULL,
  `kondisi_akhir` varchar(100) DEFAULT NULL,
  `waktu_jaminan` varchar(100) DEFAULT NULL,
  `catatan_tambahan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_permintaan_pelayanan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_pelayanan`
--

CREATE TABLE `permintaan_pelayanan` (
  `id` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL DEFAULT 0,
  `kerusakan_alat` text DEFAULT NULL,
  `id_alkes` int(11) NOT NULL DEFAULT 0,
  `merk` varchar(100) DEFAULT NULL,
  `no_seri` varchar(100) DEFAULT NULL,
  `lain_lain` text DEFAULT NULL,
  `kerusakan_awal` text DEFAULT NULL,
  `tanggal_ajuan` date DEFAULT NULL,
  `batas_waktu_perbaikan` date DEFAULT NULL,
  `data_kerusakan_tanggal` date DEFAULT NULL,
  `opsi_kerusakan` enum('Perbaikan','Pergantian') DEFAULT NULL,
  `catatan_tambahan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_pelayanan`
--

INSERT INTO `permintaan_pelayanan` (`id`, `id_ruang`, `kerusakan_alat`, `id_alkes`, `merk`, `no_seri`, `lain_lain`, `kerusakan_awal`, `tanggal_ajuan`, `batas_waktu_perbaikan`, `data_kerusakan_tanggal`, `opsi_kerusakan`, `catatan_tambahan`, `created_at`, `updated_at`) VALUES
(1, 34, 'ini adalah alat', 9, 'yamaha1', '388651', NULL, 'kerusakan awal', '2020-09-29', '2020-09-29', '2020-10-01', 'Perbaikan', 'catatna tambahan', '2020-09-28 21:27:48', '2020-09-28 21:39:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_tinjauan`
--
ALTER TABLE `hasil_tinjauan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_tinjauan`
--
ALTER TABLE `hasil_tinjauan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permintaan_pelayanan`
--
ALTER TABLE `permintaan_pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
