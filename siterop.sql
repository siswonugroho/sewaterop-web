-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 06:21 PM
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
-- Database: `siterop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `status_user` varchar(10) NOT NULL DEFAULT 'admin',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `status_user`, `username`, `password`) VALUES
(1, 'Sovana Siswonugroho', 'admin', 'sovana898', '$2y$10$FWFIv9Eq9dvjyhn4aJ1WPOpbIKpUFtuTrH0WoMAsmOX3u2v1V0pN2'),
(2, 'Aji Sampurno ', 'pending', 'aji123', '$2y$10$p0kSnetBfYNokIhV0iSlU.zVX9OdTk29u7N9DvLN7jlBd.J8ZO7gm'),
(3, 'Guncoro', 'pending', 'gun95', '$2y$10$Ju6n.oFv2Pp9LUu8DDLZtOMEsN1lbve08i/96AQSRzlRjArWCnmBm'),
(6, 'Hj. Nashir', 'owner', 'nashir212', '$2y$10$4/NCYcnTGQnXCGh1FoEJzuqKS0kKiX3mdA4So/jcXU9wnQToLWSqa'),
(7, 'Hafis', 'admin', 'hafis123', '$2y$10$pQdvzdJ6LAToiXcYiatdC.DCp5HyOogEmbxlZurUW5Id9cDl2tiEe');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `foto_barang` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `foto_barang`, `harga`, `stok`) VALUES
('br01', 'Bunga', '5d5edae819e6769f4ad0d730e086d55e.jpg', 5000, 20),
('br03', 'Meja', '2b7c2678b6b2e236124791688bcd07d3.jpg', 300000, 164),
('br04', 'Panggung', '1e2d643180e9b842cd67e38a1b0d62e2.jpg', 2000000, 10),
('br05', 'Tenda', '5d0110037d0d7931ab4101bf1a839ad3.jpg', 300000, 28),
('br06', 'Barang', '3e52d68cb51091c5aed5ceefeb035791.jpg', 20000, 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_paket`
-- (See below for the actual view)
--
CREATE TABLE `daftar_paket` (
`id_paket` varchar(50)
,`nama_paket` varchar(50)
,`harga` int(11)
,`id_barang` varchar(50)
,`jumlah_barang` int(11)
,`nama_barang` varchar(50)
,`harga_barang` int(11)
,`foto_barang` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_sewaan`
-- (See below for the actual view)
--
CREATE TABLE `daftar_sewaan` (
`id_pesanan` varchar(50)
,`id_pemesan` varchar(50)
,`tgl_mulai` date
,`tgl_selesai` date
,`id_paket` varchar(50)
,`status` enum('berlangsung','selesai')
,`nama_pemesan` varchar(50)
,`nama_paket` varchar(50)
,`harga` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `daftar_transaksi` (
`id_pesanan` varchar(50)
,`total_biaya` int(50)
,`jumlah_bayar` int(50)
,`kembalian` int(50)
,`status_pembayaran` varchar(50)
,`nama_pemesan` varchar(50)
,`id_paket` varchar(50)
,`nama_paket` varchar(50)
,`tgl_mulai` date
,`tgl_selesai` date
);

-- --------------------------------------------------------

--
-- Table structure for table `isi_paket`
--

CREATE TABLE `isi_paket` (
  `id_paket` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `isi_paket`
--

INSERT INTO `isi_paket` (`id_paket`, `id_barang`, `jumlah_barang`) VALUES
('pk01', 'br01', 4),
('pk01', 'br03', 2),
('pk01', 'br05', 1),
('pk06', 'br04', 3),
('pk06', 'br01', 10),
('pk06', 'br03', 200),
('sw12', 'br01', 4),
('sw08', 'br01', 2),
('sw08', 'br03', 4),
('sw13', 'br01', 8),
('pk15', 'br01', 10),
('pk15', 'br03', 50),
('sw10', 'br01', 4),
('sw10', 'br03', 20);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` varchar(50) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga`) VALUES
('pk01', 'Basic', 3000000),
('pk06', 'Premium v2', 50000000),
('pk15', 'Medium', 4000000),
('sw08', 'sw08', 1210000),
('sw10', 'sw10', 6020000),
('sw12', 'sw12', 20000),
('sw13', 'sw13', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` varchar(50) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama_pemesan`, `alamat`, `telepon`) VALUES
('ps02', 'John Doe', 'Location Unknown', '084325257'),
('ps03', 'Parno', 'Yogyakarta', '08666676'),
('ps04', 'bagus', 'jln mana aja', '085730385388'),
('ps05', 'Faiz', 'Ra Tak Dudohi ', '081335088111'),
('ps06', 'Sovana', 'Kuwonharjo Takeran Magetan', '085345634'),
('ps07', 'Putri', 'Magetan', '0866577357');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(50) NOT NULL,
  `id_pemesan` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `id_paket` varchar(50) NOT NULL,
  `status` enum('berlangsung','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pemesan`, `tgl_mulai`, `tgl_selesai`, `id_paket`, `status`) VALUES
('sw02', 'ps03', '2021-01-13', '2021-01-17', 'pk01', 'selesai'),
('sw06', 'ps05', '2021-01-14', '2021-01-19', 'pk01', 'selesai'),
('sw07', 'ps06', '2021-01-19', '2021-01-23', 'pk06', 'berlangsung'),
('sw08', 'ps04', '2021-01-14', '2021-02-10', 'sw08', 'berlangsung'),
('sw09', 'ps03', '2021-01-20', '2021-02-07', 'pk01', 'berlangsung'),
('sw10', 'ps05', '2021-01-20', '2021-01-28', 'sw10', 'berlangsung'),
('sw12', 'ps02', '2021-01-19', '2021-02-05', 'sw12', 'selesai'),
('sw13', 'ps04', '2021-01-27', '2021-02-03', 'sw13', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_pesanan` varchar(50) NOT NULL,
  `total_biaya` int(50) NOT NULL,
  `jumlah_bayar` int(50) NOT NULL,
  `kembalian` int(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_pesanan`, `total_biaya`, `jumlah_bayar`, `kembalian`, `status_pembayaran`) VALUES
('sw02', 3000000, 2000000, -1000000, 'Kurang Rp.1.000.000'),
('sw06', 3000000, 5000000, 2000000, 'Lunas'),
('sw12', 20000, 20000, 0, 'Lunas'),
('sw13', 40000, 50000, 10000, 'Lunas');

-- --------------------------------------------------------

--
-- Structure for view `daftar_paket`
--
DROP TABLE IF EXISTS `daftar_paket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_paket`  AS SELECT `paket`.`id_paket` AS `id_paket`, `paket`.`nama_paket` AS `nama_paket`, `paket`.`harga` AS `harga`, `isi_paket`.`id_barang` AS `id_barang`, `isi_paket`.`jumlah_barang` AS `jumlah_barang`, `barang`.`nama_barang` AS `nama_barang`, `barang`.`harga` AS `harga_barang`, `barang`.`foto_barang` AS `foto_barang` FROM ((`paket` join `isi_paket` on(`isi_paket`.`id_paket` = `paket`.`id_paket`)) join `barang` on(`isi_paket`.`id_barang` = `barang`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `daftar_sewaan`
--
DROP TABLE IF EXISTS `daftar_sewaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_sewaan`  AS SELECT `pesanan`.`id_pesanan` AS `id_pesanan`, `pesanan`.`id_pemesan` AS `id_pemesan`, `pesanan`.`tgl_mulai` AS `tgl_mulai`, `pesanan`.`tgl_selesai` AS `tgl_selesai`, `pesanan`.`id_paket` AS `id_paket`, `pesanan`.`status` AS `status`, `pemesan`.`nama_pemesan` AS `nama_pemesan`, `paket`.`nama_paket` AS `nama_paket`, `paket`.`harga` AS `harga` FROM ((`pesanan` join `pemesan` on(`pesanan`.`id_pemesan` = `pemesan`.`id_pemesan`)) join `paket` on(`pesanan`.`id_paket` = `paket`.`id_paket`)) ;

-- --------------------------------------------------------

--
-- Structure for view `daftar_transaksi`
--
DROP TABLE IF EXISTS `daftar_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_transaksi`  AS SELECT `transaksi`.`id_pesanan` AS `id_pesanan`, `transaksi`.`total_biaya` AS `total_biaya`, `transaksi`.`jumlah_bayar` AS `jumlah_bayar`, `transaksi`.`kembalian` AS `kembalian`, `transaksi`.`status_pembayaran` AS `status_pembayaran`, `pemesan`.`nama_pemesan` AS `nama_pemesan`, `pesanan`.`id_paket` AS `id_paket`, `paket`.`nama_paket` AS `nama_paket`, `pesanan`.`tgl_mulai` AS `tgl_mulai`, `pesanan`.`tgl_selesai` AS `tgl_selesai` FROM (((`transaksi` join `pesanan` on(`pesanan`.`id_pesanan` = `transaksi`.`id_pesanan`)) join `pemesan` on(`pemesan`.`id_pemesan` = `pesanan`.`id_pemesan`)) join `paket` on(`pesanan`.`id_paket` = `paket`.`id_paket`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `isi_paket`
--
ALTER TABLE `isi_paket`
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pemesan` (`id_pemesan`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `isi_paket`
--
ALTER TABLE `isi_paket`
  ADD CONSTRAINT `isi_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isi_paket_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
