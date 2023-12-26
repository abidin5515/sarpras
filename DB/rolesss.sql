-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Okt 2020 pada 09.54
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

--
-- Dumping data untuk tabel `abilities`
--

INSERT INTO `abilities` (`id`, `name`, `title`, `entity_id`, `entity_type`, `only_owned`, `options`, `scope`, `created_at`, `updated_at`) VALUES
(1, 'teknisi', 'teknisi', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(2, 'ruangan', 'ruangan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(3, 'supplier', 'supplier', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(4, 'sumber-dana', 'sumber-dana', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(5, 'kepemilikan', 'kepemilikan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(6, 'alat', 'alat', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(7, 'kategori-checklist', 'kategori-checklist', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(8, 'jenis-pekerjaan', 'jenis-pekerjaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(9, 'data-alkes', 'data-alkes', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(10, 'jadwal-pemeliharaan', 'jadwal-pemeliharaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(11, 'catatan-pemeliharaan', 'catatan-pemeliharaan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(12, 'jadwal', 'jadwal', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(13, 'cetak-label', 'cetak-label', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(14, 'permintaan-pelayanan', 'permintaan-pelayanan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(15, 'pengaturan_jabatan', 'pengaturan_jabatan', NULL, NULL, 0, NULL, NULL, '2020-10-09 21:23:04', '2020-10-09 21:23:04'),
(17, 'roles', 'roles', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(18, 'user', 'user', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(19, 'on', 'On', NULL, NULL, 0, NULL, NULL, '2020-10-11 20:13:31', '2020-10-11 20:13:31');

--
-- Dumping data untuk tabel `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `role_id`, `entity_id`, `entity_type`, `restricted_to_id`, `restricted_to_type`, `scope`) VALUES
(2, 1, 3, 'App\\User', NULL, NULL, NULL),
(3, 2, 4, 'App\\User', NULL, NULL, NULL),
(4, 1, 1, 'App\\User', NULL, NULL, NULL),
(5, 2, 5, 'App\\User', NULL, NULL, NULL);

--
-- Dumping data untuk tabel `permissions`
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
(215, 14, 2, 'roles', 0, NULL);

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `level`, `scope`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'SuperAdmin', NULL, NULL, '2020-10-09 21:43:19', '2020-10-11 18:49:17'),
(2, 'Ruangan', 'Ruangan', NULL, NULL, '2020-10-09 22:01:43', '2020-10-11 20:20:16');

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`, `id_ruangan`) VALUES
(1, 'admin', '$2y$10$sD9sKVWkkrcgzUg4CzQQFuT6HI.RanqYHu1PJ.koLsKPgpZTywSJS', '2020-09-07 04:01:34', '2020-09-25 18:40:41', 0),
(3, 'superadmin', '$2y$10$cCuQwqRoEaKwZLo/t4COnePJoZfAVm6YDfAgqT83xx2ibHR96ucBu', '2020-10-09 21:59:15', '2020-10-09 21:59:15', 0),
(4, 'ruangan', '$2y$10$M1/tfIncKe/zReZZ7KUIw.XFpII.yeVpFvvDZOCC1FWeg4HmLuGEW', '2020-10-09 22:01:56', '2020-10-09 22:01:56', 0),
(5, 'IGD', '$2y$10$DYFLXQYhleg/fPRNBhpouOSIaBKnmQLWtwWnpzqu6koQSqgqgBm1.', '2020-10-11 20:17:14', '2020-10-11 20:19:41', 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
