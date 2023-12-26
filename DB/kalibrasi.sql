-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Okt 2020 pada 09.54
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
-- Struktur dari tabel `kalibrasi`
--

CREATE TABLE `kalibrasi` (
  `id` int(11) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `id_catatan_pemeliharaan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kalibrasi`
--

INSERT INTO `kalibrasi` (`id`, `file`, `id_catatan_pemeliharaan`, `created_at`, `updated_at`) VALUES
(1, 'kalibrasi/1601520380 - Screen Shot 2020-09-26 at 21.05.34.png', 1, '2020-09-30 19:46:20', '2020-09-30 19:46:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kalibrasi`
--
ALTER TABLE `kalibrasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kalibrasi`
--
ALTER TABLE `kalibrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
