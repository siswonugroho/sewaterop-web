-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 06:22 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewaterop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `accesslevel` enum('admin','owner','pending','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `accesslevel`) VALUES
('sovana', 'c292YW5hMTIz', 'admin'),
('nashir', 'bmFzaGlyMTEx', 'owner'),
('darson', 'ZGFyc29uMTEx', 'admin'),
('dinda', 'ZGluZGExMTE=', 'admin'),
('hendra', 'aGVuZHJhMTEx', 'rejected'),
('dilan', 'ZGlsYW4xMTE=', 'pending'),
('aldo', 'YWxkbzExMQ==', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `status` enum('Tersedia','Habis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`, `status`) VALUES
(1, 'Tenda', 30000, 'Tersedia'),
(2, 'Kursi', 20000, 'Tersedia'),
(3, 'Karangan bunga', 20000, 'Tersedia'),
(4, 'Panggung', 50000, 'Habis'),
(5, 'Sound system', 25000, 'Tersedia'),
(6, 'Alat makan', 24000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tgl_sewa` date NOT NULL DEFAULT '1970-01-01',
  `tgl_kembali` date NOT NULL DEFAULT '1970-01-01',
  `nama_penyewa` varchar(50) NOT NULL,
  `barang_sewaan` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `total_biaya` int(15) NOT NULL,
  `jumlah_bayar` int(15) NOT NULL,
  `sisa` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tgl_sewa`, `tgl_kembali`, `nama_penyewa`, `barang_sewaan`, `jumlah`, `harga_satuan`, `alamat`, `telp`, `total_biaya`, `jumlah_bayar`, `sisa`) VALUES
(1, '2020-05-11', '2020-06-08', 'Joni Iskandar', 'Kursi', 10, 20000, 'Indonesia', '02143532', 200000, 300000, 100000),
(2, '2020-06-18', '2020-06-25', 'Faiz', 'Sound system', 2, 25000, 'Tulungagung', '088798', 50000, 100000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `sewaan`
--

CREATE TABLE `sewaan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '1970-01-01',
  `nama` varchar(50) NOT NULL,
  `barang_sewaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `jumlah` int(4) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewaan`
--

INSERT INTO `sewaan` (`id`, `tanggal`, `nama`, `barang_sewaan`, `jumlah`, `alamat`, `telp`) VALUES
(1, '2020-04-22', 'Surya', 'Karangan bunga', 4, 'Bandung', '0863673'),
(2, '2020-07-08', 'Dinda', 'Tenda', 4, 'Semarang', '095242266');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewaan`
--
ALTER TABLE `sewaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sewaan`
--
ALTER TABLE `sewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
