-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2021 at 03:42 PM
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
  `nama_barang` varchar(250) NOT NULL,
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
(5, 1, 'Millet', 'Karung', 5, '1875000', '2021-01-12'),
(6, 1, 'Kurungan Octagon Kotak Standart', 'Dus', 5, '5000000', '2021-01-14'),
(7, 1, 'Kurungan Octagon Bulat Size Standart', 'dus', 2, '1200000', '2021-01-14'),
(8, 2, 'Mbah Joyo', 'Lonjor', 3, '64000', '2021-01-17');

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
(3, 'Riza', '0812485938', 'Kalitidu', '2020-11-05', '250000', 'Hutang kurungan', 'Belum Lunas'),
(4, 'Nur', '08123456789', 'Kapas', '2021-01-14', '120000', 'Hutang Kurungan Kapsul', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `stokpenjualan`
--

CREATE TABLE `stokpenjualan` (
  `id_stok` int(11) NOT NULL,
  `nama_stok` varchar(250) NOT NULL,
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
(4, 'Millet', '16000', 'kg'),
(5, 'Kurungan Octagon Kotak Standart', '150000', 'kurungan'),
(6, 'Kurungan Octagon Bulat Size Standart', '120000', 'kurungan');

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
('INV14012021011955', '2021-01-12', '13:19:55', 12000),
('INV14012021013648', '2021-01-13', '09:36:48', 12000),
('INV14012021013725', '2021-01-14', '13:37:25', 42000),
('INV14012021065352', '2021-01-14', '18:53:52', 150000),
('INV14012021065629', '2021-01-14', '18:56:29', 152000),
('INV14012021082219', '2021-01-14', '20:22:19', 248000),
('INV15012021025415', '2021-02-15', '14:54:15', 38000),
('INV15012021040352', '2021-01-15', '16:03:52', 320000),
('INV15012021040401', '2021-01-15', '16:04:01', 160000),
('INV17012021053053', '2021-01-17', '17:30:53', 156000),
('INV17012021054442', '2021-01-17', '17:44:42', 136000),
('INV17012021054924', '2021-01-17', '17:49:24', 42000),
('INV17012021055103', '2021-01-17', '17:51:03', 42000),
('INV17012021055525', '2021-01-17', '17:55:25', 20000),
('INV17012021055531', '2021-01-17', '17:55:31', 6000),
('INV17012021055732', '2021-01-17', '17:57:32', 10000),
('INV17012021074710', '2021-01-17', '19:47:10', 26000),
('INV17012021075803', '2021-01-17', '19:58:03', 42000),
('INV17012021075837', '2021-01-17', '19:58:37', 24000),
('INV17012021075934', '2021-01-17', '19:59:34', 32000),
('INV17012021080137', '2021-01-17', '20:01:37', 42000),
('INV17012021080214', '2021-01-17', '20:02:14', 12000),
('INV17012021080320', '2021-01-17', '20:03:20', 430000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksidetail`
--

CREATE TABLE `transaksidetail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah_barang` varchar(5) NOT NULL,
  `harga_barang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksidetail`
--

INSERT INTO `transaksidetail` (`id_transaksi_detail`, `id_transaksi`, `nama_barang`, `jumlah_barang`, `harga_barang`) VALUES
(1, 'INV14012021011955', 'Pakan Kucing (Excel)', '1', '12000'),
(3, 'INV14012021013648', 'Pakan Kucing (Excel)', '1', '12000'),
(4, 'INV14012021013725', 'Millet', '2', '32000'),
(5, 'INV14012021013725', 'Anti Saraf', '1', '10000'),
(6, 'INV14012021065352', 'Kurungan Octagon Kotak Standart', '1', '150000'),
(7, 'INV14012021065629', 'Kurungan Octagon Bulat Size Standart', '1', '120000'),
(8, 'INV14012021065629', 'Millet', '2', '32000'),
(9, 'INV14012021082219', 'Pakan Kucing (Excel)', '1', '12000'),
(10, 'INV14012021082219', 'Anti Saraf', '1', '10000'),
(11, 'INV14012021082219', 'Suara Emas', '2', '12000'),
(12, 'INV14012021082219', 'Millet', '4', '64000'),
(13, 'INV14012021082219', 'Kurungan Octagon Kotak Standart', '1', '150000'),
(17, 'INV15012021025415', 'Millet', '2', '32000'),
(18, 'INV15012021025415', 'Suara Emas', '1', '6000'),
(19, 'INV15012021040352', 'Kurungan Octagon Bulat Size Standart', '2', '240000'),
(20, 'INV15012021040352', 'Millet', '5', '80000'),
(21, 'INV15012021040401', 'Anti Saraf', '1', '10000'),
(22, 'INV15012021040401', 'Kurungan Octagon Kotak Standart', '1', '150000'),
(35, 'INV17012021053053', 'Suara Emas', '1', '6000'),
(36, 'INV17012021053053', 'Kurungan Octagon Kotak Standart', '1', '150000'),
(51, 'INV17012021054442', 'Millet', '1', '16000'),
(52, 'INV17012021054442', 'Kurungan Octagon Bulat Size Standart', '1', '120000'),
(53, 'INV17012021054924', 'Anti Saraf', '1', '10000'),
(54, 'INV17012021054924', 'Millet', '2', '32000'),
(55, 'INV17012021055103', 'Pakan Kucing (Excel)', '3', '36000'),
(56, 'INV17012021055103', 'Suara Emas', '1', '6000'),
(57, 'INV17012021055525', 'Anti Saraf', '2', '20000'),
(58, 'INV17012021055531', 'Suara Emas', '1', '6000'),
(59, 'INV17012021055732', 'Anti Saraf', '1', '10000'),
(60, 'INV17012021074710', 'Anti Saraf', '1', '10000'),
(61, 'INV17012021074710', 'Millet', '1', '16000'),
(62, 'INV17012021075803', 'Anti Saraf', '1', '10000'),
(63, 'INV17012021075803', 'Millet', '2', '32000'),
(64, 'INV17012021075837', 'Pakan Kucing (Excel)', '2', '24000'),
(65, 'INV17012021075934', 'Anti Saraf', '2', '20000'),
(66, 'INV17012021075934', 'Pakan Kucing (Excel)', '1', '12000'),
(67, 'INV17012021080137', 'Anti Saraf', '1', '10000'),
(68, 'INV17012021080137', 'Millet', '2', '32000'),
(69, 'INV17012021080214', 'Suara Emas', '2', '12000'),
(70, 'INV17012021080320', 'Anti Saraf', '1', '10000'),
(71, 'INV17012021080320', 'Kurungan Octagon Kotak Standart', '2', '300000'),
(72, 'INV17012021080320', 'Kurungan Octagon Bulat Size Standart', '1', '120000');

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
(1, 'Ardan Anjung', 'ardan', 'ardananjungkusuma@gmail.com', 'd2219d75098abd01493908d2f7f4d13d', 1),
(2, 'Amel', 'amel', 'amel@gmail.com', 'e5796cb0dc9d20918634e9b70b2c0fdd', 2),
(3, 'Efie', 'efie', 'efie@gmail.com', 'c5e3cf3ce1b024a0a47f529a6fbfc84b', 2);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stokpenjualan`
--
ALTER TABLE `stokpenjualan`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
