-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 07:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semijoyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_barang` varchar(15) NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_distributor`, `nama_barang`, `satuan_barang`, `jumlah_barang`, `harga_barang`, `tanggal_beli`) VALUES
(1, 2, 'Pakan Kucing (Excel)', 'Karung', 2, '250000', '2020-11-05'),
(2, 1, 'Anti Saraf', 'Dus', 2, '150000', '2020-11-05'),
(4, 1, 'Suara Emas', 'Dus', 4, '350000', '2021-01-12'),
(5, 1, 'Millet', 'Karung', 5, '1875000', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(200) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `nama_distributor`, `no_telpon`, `alamat`) VALUES
(1, 'Miran', '08124588921', 'Jl. Simpang Lima Tuban'),
(2, 'Bunyong', '08234321245', 'Jl. Veteran 12 Bojonegoro');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int(11) NOT NULL,
  `nama_pengutang` varchar(200) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `jumlah_hutang` varchar(15) NOT NULL,
  `catatan_hutang` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `nama_pengutang`, `no_telpon`, `alamat`, `tanggal_hutang`, `jumlah_hutang`, `catatan_hutang`, `status`) VALUES
(2, 'Kasbi', '08124562837', '-', '2020-11-05', '15000', 'Hutang belum bayar pakan kucing', 'Lunas'),
(3, 'Riza', '0812485938', 'Kalitidu', '2020-11-05', '250000', 'Hutang kurungan', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `stokpenjualan`
--

CREATE TABLE `stokpenjualan` (
  `id_stok` int(11) NOT NULL,
  `nama_stok` varchar(200) NOT NULL,
  `harga_stok` varchar(15) NOT NULL,
  `satuan_stok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stokpenjualan`
--

INSERT INTO `stokpenjualan` (`id_stok`, `nama_stok`, `harga_stok`, `satuan_stok`) VALUES
(1, 'Pakan Kucing (Excel)', '12000', 'pcs'),
(2, 'Anti Saraf', '10000', 'botol'),
(3, 'Suara Emas', '6000', 'pcs'),
(4, 'Millet', '16000', 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(250) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jam_transaksi` varchar(9) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `jam_transaksi`, `total_harga`) VALUES
('INV14012021064651', '2021-01-14', '06:46:51', 18000),
('INV14012021065207', '2021-01-14', '06:52:07', 10000),
('INV14012021065218', '2021-01-14', '06:52:18', 50000),
('INV14012021070036', '2021-01-14', '07:00:36', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksidetail`
--

CREATE TABLE `transaksidetail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_barang` varchar(5) NOT NULL,
  `harga_barang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksidetail`
--

INSERT INTO `transaksidetail` (`id_transaksi_detail`, `id_transaksi`, `nama_barang`, `jumlah_barang`, `harga_barang`) VALUES
(89, 'INV14012021064651', 'Pakan Kucing (Excel)', '1', '12000'),
(90, 'INV14012021064651', 'Suara Emas', '1', '6000'),
(91, 'INV14012021065207', 'Anti Saraf', '1', '10000'),
(92, 'INV14012021065218', 'Suara Emas', '1', '6000'),
(93, 'INV14012021065218', 'Millet', '2', '32000'),
(94, 'INV14012021065218', 'Pakan Kucing (Excel)', '1', '12000'),
(95, 'INV14012021070036', 'Anti Saraf', '3', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email`, `password`, `level`) VALUES
(1, 'Ardan Anjung', 'ardan', 'ardananjungkusuma@gmail.com', 'd2219d75098abd01493908d2f7f4d13d', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `stokpenjualan`
--
ALTER TABLE `stokpenjualan`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stokpenjualan`
--
ALTER TABLE `stokpenjualan`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD CONSTRAINT `transaksidetail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
