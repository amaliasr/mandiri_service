-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 03:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mandiri_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'TOSHIBA'),
(2, 'SHARP');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `id_produk`) VALUES
(16, 2, 1),
(17, 2, 1),
(18, 2, 2),
(19, 2, 2),
(20, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` text NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`id`, `id_user`, `title`, `detail`) VALUES
(1, 2, 'Barang Saya belum selesai?', 'saya telah melakukan service disini tapi masih belum selesai sampai 2 bulan'),
(2, 2, 'Halo', 'halo'),
(3, 3, 'Service nya kok lama', 'service nya baru mulai kemarin');

-- --------------------------------------------------------

--
-- Table structure for table `komplain_reply`
--

CREATE TABLE `komplain_reply` (
  `id` int(11) NOT NULL,
  `id_komplain` int(11) NOT NULL,
  `balasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplain_reply`
--

INSERT INTO `komplain_reply` (`id`, `id_komplain`, `balasan`) VALUES
(1, 1, 'maaf sebelumnya kalau terlalu lama'),
(2, 3, 'sabar ya mba'),
(3, 3, 'iya aku sabar kok'),
(4, 3, 'iya aku sabar kok');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_tipe_pembayaran` varchar(50) NOT NULL,
  `kode_pembelian` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `bukti_pembayaran` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_user`, `tgl_pembelian`, `id_tipe_pembayaran`, `kode_pembelian`, `alamat`, `bukti_pembayaran`, `status`) VALUES
(1, 3, '2023-06-29', 'Transfer', 'PAY20230629180811', 'Malang', '76a405fe7090a69e46c6d2cd98e0dcee.png', 'Process'),
(2, 3, '2023-06-29', 'COD', 'PAY20230629181228', 'Malang', '', 'Process'),
(3, 3, '2023-07-01', 'COD', 'PAY20230701171935', 'Malang', '', 'Process'),
(7, 3, '2023-07-01', 'COD', 'PAY20230701173951', 'Malang', '', 'Sedang Dikemas'),
(8, 4, '2023-07-16', 'COD', 'PAY20230716040024', 'Malang', '', 'Process'),
(9, 4, '2023-07-16', 'Transfer', 'PAY20230716040902', 'Malang', '17d6a2789ae08c9e551876b2880f427d.jpg', 'Process');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id`, `id_pembelian`, `id_produk`, `price`) VALUES
(1, 1, 1, 5000000),
(2, 2, 2, 9000000),
(3, 2, 1, 5000000),
(4, 3, 2, 9000000),
(5, 7, 1, 5000000),
(6, 7, 1, 5000000),
(7, 7, 2, 9000000),
(8, 8, 2, 9000000),
(9, 9, 2, 9000000),
(10, 9, 1, 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `type`, `name`, `id_brand`, `harga`, `stok`, `image`) VALUES
(1, 'TV', '32 Inch AQUOS LED 2T-C32DC1i', 2, 5000000, 11, '196366f2f7aea13d5d3864f819749c7d.jpg'),
(2, 'TV', 'LED TV 2K DIGITAL 2T-C42DD1i', 2, 9000000, 97, 'caad28e6285946ca7dab5e4eb81a0681.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `id_brand`, `type`, `name`, `note`, `status`, `id_user`) VALUES
(1, 1, 'C350L Series', 'Toshiba 75” C350L 4K UHD Smart TV', 'terjadi kerusakan pada layarnya', 'Mulai Pembenahan', 2),
(2, 2, 'TV LED', 'Sharp Aquos Smart Android LED TV 2TC32EG1I 32 Inch.', 'kerusakan pada monitor', 'Mulai Pembenahan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `service_spare_part`
--

CREATE TABLE `service_spare_part` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `spare_part_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `biaya` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_spare_part`
--

INSERT INTO `service_spare_part` (`id`, `service_id`, `spare_part_id`, `qty`, `biaya`) VALUES
(1, 2, 1, 1, 500000),
(4, 1, 1, 2, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `spare_part`
--

CREATE TABLE `spare_part` (
  `id` int(11) NOT NULL,
  `nama_spare_part` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `biaya_beli` bigint(20) NOT NULL,
  `biaya_jual` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_part`
--

INSERT INTO `spare_part` (`id`, `nama_spare_part`, `stok`, `biaya_beli`, `biaya_jual`) VALUES
(1, 'Sparepart & Regulator PSU Mainboard Mesin LED', 195, 500000, 750000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `category` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `category`, `name`, `alamat`, `email`, `password`, `phone`) VALUES
(1, 'admin', 'admin', '', 'admin@user.com', '21232f297a57a5a743894a0e4a801fc3', ''),
(2, 'user', 'Amelia', 'Malang', 'amelia@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(3, 'user', 'Jeng Rara', 'Malang', 'rara@gmail.com', '202cb962ac59075b964b07152d234b70', '0819886768'),
(4, 'user', 'Ulung Probohandoko', 'Malang', 'ulung@gmail.com', '202cb962ac59075b964b07152d234b70', '23123131');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komplain_reply`
--
ALTER TABLE `komplain_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_spare_part`
--
ALTER TABLE `service_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spare_part`
--
ALTER TABLE `spare_part`
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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komplain_reply`
--
ALTER TABLE `komplain_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_spare_part`
--
ALTER TABLE `service_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spare_part`
--
ALTER TABLE `spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
