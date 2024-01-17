-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2023 at 01:40 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_suzuya`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_jenis` int NOT NULL,
  `id_satuan` int NOT NULL,
  `uom_order` int NOT NULL,
  `jumlah_satuan` int NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `id_jenis`, `id_satuan`, `uom_order`, `jumlah_satuan`, `harga_beli`, `harga_jual`, `stok_barang`) VALUES
(1, 'Susu Bendera', 1, 1, 12, 0, 40000, 60000, 100),
(2, 'Nutrisari', 1, 1, 36, 0, 10000, 12000, 156),
(3, 'Nutela', 1, 1, 1, 0, 40000, 45000, 70),
(4, 'Lampu Pijar', 2, 1, 50, 0, 10000, 15000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int NOT NULL,
  `jenis_barang` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis_barang`) VALUES
(1, 'Makanan'),
(2, 'Elektronik'),
(3, 'Alat Rumah Tangga'),
(4, 'Pakaian Wanita'),
(5, 'Pakaian Pria');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int NOT NULL,
  `id_type` int NOT NULL,
  `no_po` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_suplier` int NOT NULL,
  `date_po` int NOT NULL,
  `date_expired` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `id_type`, `no_po`, `id_suplier`, `date_po`, `date_expired`) VALUES
(1, 1, 'po-1', 1, 1691112896, 1691168400);

-- --------------------------------------------------------

--
-- Table structure for table `po_barang`
--

CREATE TABLE `po_barang` (
  `id` int NOT NULL,
  `no_po` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` int NOT NULL,
  `stok_pesanan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_barang`
--

INSERT INTO `po_barang` (`id`, `no_po`, `id_barang`, `stok_pesanan`) VALUES
(2, 'po-1', 2, 400),
(3, 'po-1', 3, 300);

-- --------------------------------------------------------

--
-- Table structure for table `po_harga`
--

CREATE TABLE `po_harga` (
  `no_po` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_normal` int NOT NULL,
  `diskon` int NOT NULL,
  `harga_diskon` int NOT NULL,
  `ppn` int NOT NULL,
  `ppn_bm` int NOT NULL,
  `jumlah_pembelian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_harga`
--

INSERT INTO `po_harga` (`no_po`, `harga_normal`, `diskon`, `harga_diskon`, `ppn`, `ppn_bm`, `jumlah_pembelian`) VALUES
('po-1', 16000000, 4, 15360000, 11, 0, 17049600);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_suplier`
--

CREATE TABLE `receiving_suplier` (
  `id` int NOT NULL,
  `no_receiving` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_suplier` int NOT NULL,
  `no_po` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `date_receiving` int NOT NULL,
  `status_laporan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `date_checker` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiving_suplier`
--

INSERT INTO `receiving_suplier` (`id`, `no_receiving`, `id_suplier`, `no_po`, `date_receiving`, `status_laporan`, `date_checker`) VALUES
(1, 'rs-1', 1, 'po-1', 1691112989, 'Di Tolak', 1691113145);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_sup_barang`
--

CREATE TABLE `receiving_sup_barang` (
  `id` int NOT NULL,
  `no_po` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` int NOT NULL,
  `stok_pesanan` int NOT NULL,
  `keterangan_barang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiving_sup_barang`
--

INSERT INTO `receiving_sup_barang` (`id`, `no_po`, `id_barang`, `stok_pesanan`, `keterangan_barang`) VALUES
(2, 'po-1', 2, 300, 'Tersedia'),
(3, 'po-1', 3, 300, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` int NOT NULL,
  `satuan_barang` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id`, `satuan_barang`) VALUES
(1, 'Pack (PCS)'),
(2, 'Kilo Gram (KG)'),
(3, 'Kotak');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int NOT NULL,
  `nama_suplier` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telpon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `date_login` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `nama_suplier`, `alamat`, `no_telpon`, `username`, `password`, `date_login`) VALUES
(1, 'Azrim', 'Ulee Kareng', '0983623', 'azrim', '$2y$10$hKwMHXLT8mnbfrrjTVJDNeozLop73gjVc0spucVSAGwUBbhNuNUqG', 1691113168),
(2, 'Azmi', 'Baet', '0983623', 'za31', '$2y$10$jLQu9XvkjZloiRkS6x3/geSQttTDXDKh0MqXV7tlkREH9DJnYxwWC', 1691021480);

-- --------------------------------------------------------

--
-- Table structure for table `typepo`
--

CREATE TABLE `typepo` (
  `id` int NOT NULL,
  `type_po` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typepo`
--

INSERT INTO `typepo` (`id`, `type_po`) VALUES
(1, 'Kontan'),
(2, 'Kredit');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telpon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL,
  `date_login` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `no_telpon`, `level`, `date_login`) VALUES
(1, 'admin', '$2y$10$wZGgbpXVgmRYkOc/AEWtyekGwqmPYvFmkWqcnVpsAf7OJJsxS2Fqy', '082215514446', 1, 1691113184),
(2, 'checker', '$2y$10$3CpR63BMRS40A1PLUtPxS.iZz3EmIj40wp2V17bP7Czw74odw7DAS', '132542121', 2, 1691113015);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_barang`
--
ALTER TABLE `po_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_suplier`
--
ALTER TABLE `receiving_suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_sup_barang`
--
ALTER TABLE `receiving_sup_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typepo`
--
ALTER TABLE `typepo`
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `po_barang`
--
ALTER TABLE `po_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receiving_suplier`
--
ALTER TABLE `receiving_suplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receiving_sup_barang`
--
ALTER TABLE `receiving_sup_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `typepo`
--
ALTER TABLE `typepo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
