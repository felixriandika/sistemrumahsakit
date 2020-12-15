-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2016 at 05:16 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalbis_rs`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_dok`
--

CREATE TABLE `biaya_dok` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `biaya_dok` int(11) NOT NULL,
  `status_bayar` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya_dok`
--

INSERT INTO `biaya_dok` (`kd_transaksi`, `kd_pasien`, `biaya_dok`, `status_bayar`) VALUES
(100005, 4, 100000, 'Lunas'),
(100006, 1, 100000, 'Lunas'),
(100007, 1, 100000, 'Lunas'),
(100008, 2, 100000, 'Lunas'),
(100009, 3, 100000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_obat`
--

CREATE TABLE `biaya_obat` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_bayar` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya_obat`
--

INSERT INTO `biaya_obat` (`kd_transaksi`, `kd_pasien`, `kd_obat`, `jumlah`, `status_bayar`) VALUES
(100005, 4, 'SP002', 10, 'Lunas'),
(100006, 1, 'BT003', 1, 'Lunas'),
(100007, 1, 'SP001', 5, 'Lunas'),
(100008, 2, 'BT002', 10, 'Lunas'),
(100009, 3, 'BT003', 1, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `kd_periksa` int(11) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `verifiedBy` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`kd_periksa`, `kd_pasien`, `diagnosa`, `kd_obat`, `jumlah`, `verifiedBy`) VALUES
(100005, 4, 'Pusing nih', 'SP002', 10, 'DOK002'),
(100006, 1, 'Batuk pilek', 'BT003', 1, 'DOK001'),
(100007, 1, 'Pusing', 'SP001', 5, 'DOK001'),
(100008, 2, 'batuk pilek', 'BT002', 10, 'DOK003'),
(100009, 3, 'Batuk berdahak', 'BT003', 1, 'DOK001');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `kd_dok` char(6) NOT NULL,
  `nama_dok` varchar(25) NOT NULL,
  `alamat_dok` varchar(50) NOT NULL,
  `spesialisasi` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`kd_dok`, `nama_dok`, `alamat_dok`, `spesialisasi`) VALUES
('DOK001', 'dr. Astanul Safri', 'Jalan Gunung Sahari Raya', 'Umum'),
('DOK002', 'dr. Dennis Kristianto', 'Jalan Cempaka Baru', 'Umum'),
('DOK003', 'dr. Naomi Lumban Raja', 'Jalan Sumur Batu', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dok`
--

CREATE TABLE `jadwal_dok` (
  `kd_dok` char(6) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `waktu` varchar(15) NOT NULL,
  `ruang` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_dok`
--

INSERT INTO `jadwal_dok` (`kd_dok`, `hari`, `waktu`, `ruang`) VALUES
('DOK001', 'Senin', '16.00 - 19.00', 'KL001'),
('DOK001', 'Rabu', '08.00 - 11.00', 'KL001'),
('DOK002', 'Selasa', '08.00 - 11.00', 'KL002'),
('DOK002', 'Kamis', '16.00 - 19.00', 'KL002'),
('DOK003', 'Jumat', '08.00 - 11.00', 'KL003'),
('DOK003', 'Sabtu', '08.00 - 11.00', 'KL003');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `level`) VALUES
(1, 'dok001', 'dok001', 'DOK001'),
(2, 'farmasi', 'farmasi', 'farmasi'),
(3, 'admin', 'admin', 'admin'),
(4, 'keuangan', 'keuangan', 'keuangan'),
(6, 'pendaftaran', 'pendaftaran', 'pendaftaran'),
(7, 'dok002', 'dok002', 'DOK002'),
(8, 'dok003', 'dok003', 'DOK003');

-- --------------------------------------------------------

--
-- Table structure for table `obat_farmasi`
--

CREATE TABLE `obat_farmasi` (
  `kd_obat` char(5) NOT NULL,
  `nama_obat` varchar(15) NOT NULL,
  `indikasi` varchar(30) NOT NULL,
  `dosis` varchar(10) NOT NULL,
  `bentuk` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` enum('butir','botol') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat_farmasi`
--

INSERT INTO `obat_farmasi` (`kd_obat`, `nama_obat`, `indikasi`, `dosis`, `bentuk`, `stok`, `satuan`) VALUES
('BT001', 'Konidin', 'Meredakan batuk', '100mg', 'tablet', 100, 'butir'),
('BT002', 'Neozep Forte', 'Meredekan gejala flu', '100mg', 'tablet', 90, 'butir'),
('SP001', 'Panadol', 'Sakit Kepala', '100mg', 'tablet', 95, 'butir'),
('SP002', 'Paramex', 'Sakit Kepala', '125mg', 'tablet', 90, 'butir'),
('BT003', 'Nelco', 'Meringankan gejala flu', '100mg', 'cair', 48, 'botol');

-- --------------------------------------------------------

--
-- Table structure for table `obat_keu`
--

CREATE TABLE `obat_keu` (
  `kd_obat` char(5) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat_keu`
--

INSERT INTO `obat_keu` (`kd_obat`, `harga_satuan`) VALUES
('BT001', 2000),
('BT002', 2500),
('SP001', 2000),
('SP002', 1500),
('BT003', 35000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `kd_pasien` int(11) NOT NULL,
  `no_ktp` char(16) NOT NULL,
  `nama_pasien` varchar(25) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat_p` varchar(50) NOT NULL,
  `riwayat_p` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`kd_pasien`, `no_ktp`, `nama_pasien`, `tgl_lhr`, `alamat_p`, `riwayat_p`, `status`) VALUES
(1, '1029842384957310', 'Glenn', '1990-05-20', 'Jalan Sesama', 'Pusing', 'Lama'),
(2, '1029842384950923', 'Frank', '1990-05-29', 'Jalan Bersama', 'batuk pilek', 'Lama'),
(3, '102984238495736', 'Billy', '1990-05-13', 'Jalan Pramuka', 'Batuk berdahak', 'Lama'),
(4, '1029842384953320', 'John', '1990-02-01', 'Jalan Pemuda', 'Pusing nih', 'Lama');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `kd_periksa` int(11) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `kd_dok` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`kd_periksa`, `kd_pasien`, `kd_dok`) VALUES
(1000005, 4, 'DOK002'),
(1000006, 1, 'DOK001'),
(1000007, 2, 'DOK003'),
(1000008, 3, 'DOK001');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `kd_bag` char(3) NOT NULL,
  `nama_bag` varchar(15) NOT NULL,
  `nama_staf` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`kd_bag`, `nama_bag`, `nama_staf`) VALUES
('DOK', 'Kedokteran', 'Staf Kedokteran'),
('KEU', 'Keuangan', 'Staf Keuangan'),
('DAF', 'Pendaftaran', 'Staf Pendaftaran'),
('FAR', 'Farmasi', 'Staf Farmasi'),
('ADM', 'Administrasi', 'Staf Administrasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_dok`
--
ALTER TABLE `biaya_dok`
  ADD KEY `kd_pasien` (`kd_pasien`),
  ADD KEY `kd_transaksi` (`kd_transaksi`);

--
-- Indexes for table `biaya_obat`
--
ALTER TABLE `biaya_obat`
  ADD KEY `kd_pasien` (`kd_pasien`),
  ADD KEY `kd_obat` (`kd_obat`),
  ADD KEY `kd_transaksi` (`kd_transaksi`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD KEY `kd_pasien` (`kd_pasien`),
  ADD KEY `kd_obat` (`kd_obat`),
  ADD KEY `kd_periksa` (`kd_periksa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kd_dok`);

--
-- Indexes for table `jadwal_dok`
--
ALTER TABLE `jadwal_dok`
  ADD KEY `kd_dok` (`kd_dok`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat_farmasi`
--
ALTER TABLE `obat_farmasi`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `obat_keu`
--
ALTER TABLE `obat_keu`
  ADD KEY `kd_obat` (`kd_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`kd_pasien`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`kd_periksa`),
  ADD KEY `kd_pasien` (`kd_pasien`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`kd_bag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_dok`
--
ALTER TABLE `biaya_dok`
  MODIFY `kd_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;
--
-- AUTO_INCREMENT for table `biaya_obat`
--
ALTER TABLE `biaya_obat`
  MODIFY `kd_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;
--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `kd_periksa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `kd_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `kd_periksa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000009;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
