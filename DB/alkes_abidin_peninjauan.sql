-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2020 at 09:47 AM
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
