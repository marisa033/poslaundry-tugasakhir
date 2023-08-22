-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 03:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poslaundri`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `gambar` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'icaaa', 'admin@gmail.com', '$2y$10$7byo3ZMBqpA3YoxxADjSoO3bjM6sk2vio2F7luzPdotckOXjztEZC', 'app/laundri/1-1689262495-1Bc4f.png', NULL, '2023-07-17 16:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `laundri`
--

CREATE TABLE `laundri` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `alamat` longtext NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundri`
--

INSERT INTO `laundri` (`id`, `nama`, `tlp`, `alamat`, `lat`, `lng`, `deskripsi`, `gambar`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Al-Fazza laundry', '089878778664', '4XQF+R79, Kantor, Delta Pawan, Ketapang Regency, West Kalimantan 78821, Indonesia', '-1.8600812', '-1.8600812', 'Solusi nya cuci cepat', 'app/laundri/1-1690703323-AR9Vf.jpg', 'Alfazza@gmail.com', '$2y$10$OcYmUcFyjJg./gxaQenRgeo7KBMueq.W2n.wAfKAd5L4A5kUOIS1W', '2023-07-22 10:54:32', '2023-08-01 21:12:59'),
(2, 'Setia Laundry', '0897978676533', '5XVG+7W9, Sukaharja, Delta Pawan, Ketapang Regency, West Kalimantan 78813, Indonesia', '-1.8067115823377047', '109.97734457293008', '<p>ingin cuci cepat, bersih dan wangi? setia laundry solusinya</p>', 'app/laundri/-1690299423-I8kTn.png', 'setialaundry@gmail.com', '$2y$10$EJNN5hpjqE1V7y8n2ahGMuOvFgKdytHAKuf2HD30s3qNVRT32yI9C', '2023-07-26 05:37:04', '2023-07-26 05:40:17'),
(4, 'Mitra laundry', '089508080808', '5XJH+3Q9, Jl. Brigjend. Katamso, Sukaharja, Kec. Delta Pawan, Kabupaten Ketapang, Kalimantan Barat 78112, Indonesia', '-1.8196463', '-1.8196463', 'Bersih wangi dan cepat', 'app/laundri/-1690565356-4hEBl.jpg', 'mitra@gmail.com', '$2y$10$OcYmUcFyjJg./gxaQenRgeo7KBMueq.W2n.wAfKAd5L4A5kUOIS1W', '2023-07-29 07:29:17', '2023-07-29 07:54:04'),
(5, 'laundry ketapang', '089708080900', '5XPH+9MM, Sukaharja, Delta Pawan, Ketapang Regency, West Kalimantan 78112, Indonesia', '-1.8142732817553038', '109.9794942324639', '<p>Bersih, wangi, dan cepat</p>', 'app/laundri/-1690663887-VEUo8.jpg', 'laundry@gmail.com', '$2y$10$cAu3KVMUHH4Caued2f9ZqeWkd4qBRBuQK1XqHX/4Fri0Prf/1Tzdi', '2023-07-30 10:51:28', '2023-07-30 11:07:45'),
(6, 'dika', '089797976767', 'Indonesia', '0.000883654822793814', '109.16440019086014', '<p>cuci cepat</p>', 'app/laundri/-1690852049-xT4B9.jpg', 'dika@gmail.com', '$2y$10$HCvCK.JbGoIzpN20TyhM2uhw6VwLqOSquStvE6Pb42TOwHua6WQ32', '2023-08-01 15:07:32', '2023-08-01 15:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `id_laundri` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `gambar_layanan` varchar(100) NOT NULL,
  `satuan_harga` varchar(50) NOT NULL,
  `harga_layanan` double NOT NULL,
  `deskripsi_layanan` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `id_laundri`, `nama_kategori`, `nama_layanan`, `gambar_layanan`, `satuan_harga`, `harga_layanan`, `deskripsi_layanan`, `created_at`, `updated_at`) VALUES
(2, 1, 'Gaun pesta, jas,  dan lain-lain', 'Cuci baju khusus', 'app/layanan/2-1689974603-dI8Il.jpg', 'Pcs', 7000, 'solusinya cuci cepat bersih dan wangi', '2023-07-22 10:59:22', '2023-07-30 18:01:17'),
(3, 1, 'Layanan cuci dan perawatan selimut, bedcover, dan sprei', 'Cuci selimut dan bedcover', 'app/layanan/3-1689974618-F0ZNH.jpg', 'Pcs', 15000, 'Solusinya cuci cepat', '2023-07-22 11:01:13', '2023-07-22 11:23:38'),
(4, 1, 'Menyetrika pakaian', 'Setrika', 'app/layanan/4-1689974634-sqGiR.jpg', 'Kg', 5000, 'Solusinya cuci cepat', '2023-07-22 11:02:49', '2023-07-22 11:23:54'),
(5, 2, 'Pakaian Biasa', 'Cuci Kilat', 'app/layanan/-1690300363-pY8mZ.jpg', 'kg', 12000, '<font face=\"Times New Roman, serif\"><span style=\"font-size: 16px;\">wangi bersih dan cepat jadinya</span></font>', '2023-07-26 05:52:43', '2023-07-26 05:55:01'),
(6, 2, 'Pakaian Biasa', 'Cuci Reguler', 'app/layanan/-1690300465-z1EOe.jpg', 'kg', 9000, '<p><span style=\"font-size: 12pt; line-height: 107%; font-family: &quot;Times New Roman&quot;, serif; color: black; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">wangi bersih dan\r\ncepat jadinya</span><br></p>', '2023-07-26 05:54:25', '2023-07-26 05:55:17'),
(8, 2, 'setrika', 'Pakaian Biasa', 'app/layanan/-1690300617-Wczmw.jpg', 'kg', 5000, '<p class=\"MsoNormal\" style=\"text-align:justify\"><span style=\"font-size: 12pt; line-height: 107%; font-family: &quot;Times New Roman&quot;, serif; color: black; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">wangi bersih dan cepat jadinya</span><span style=\"font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif\"><o:p></o:p></span></p>', '2023-07-26 05:56:58', '2023-07-26 05:56:58'),
(17, 1, 'Baju harian', 'Cuci biasa', 'app/layanan/-1690425408-QeQ2j.jpg', 'Kg', 7000, 'Solusi cuci cepat', '2023-07-27 16:36:49', '2023-07-27 16:36:49'),
(19, 4, 'Cuci pakaian sehari - hari', 'Laundry Reguler', 'app/layanan/-1690565857-zJVoH.jpg', 'Kg', 7000, 'Titik', '2023-07-29 07:37:37', '2023-07-29 07:37:37'),
(20, 4, 'Pakaian', 'Laundry Kilat', 'app/layanan/-1690566394-B8iV3.jpg', 'Kg', 13000, 'Deskripsi', '2023-07-29 07:46:34', '2023-07-29 07:46:34'),
(21, 4, 'Jas, gaun malam, jas hujan', 'Laundry dry cleaning', 'app/layanan/-1690566480-SABgJ.jpg', 'Pcs', 7000, 'Deskripsi', '2023-07-29 07:48:00', '2023-07-29 07:48:00'),
(23, 1, 'extra', 'pakaian sehari hari', 'app/layanan/-1690667444-3iqGc.jpg', 'kg', 10000, '<p>cuci extra</p>', '2023-07-30 11:50:44', '2023-07-30 11:50:44'),
(26, 6, 'cuci biasa', 'pakaian sehari hari', 'app/layanan/-1690852962-W8BYg.jpg', 'kg', 7000, '<p>cuci bersih</p>', '2023-08-01 15:22:42', '2023-08-01 15:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_laundri` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `gambar_order` varchar(100) NOT NULL,
  `berat` double NOT NULL,
  `total` double NOT NULL,
  `status_order` enum('Baru','Proses','Selesai','Batal','Diterima') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_layanan`, `id_laundri`, `id_pelanggan`, `gambar_order`, `berat`, `total`, `status_order`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'app/orderan/1-1690692107-bPlh1.jpg', 12, 84000, 'Proses', '2023-07-29 04:51:04', '2023-07-30 18:41:47'),
(2, 19, 4, 1, 'app/orderan/-1690566668-gbcjX.jpg', 7, 49000, 'Selesai', '2023-07-29 07:51:08', '2023-07-29 07:52:39'),
(3, 2, 1, 2, 'app/orderan/3-1690692237-9OZeH.jpg', 9, 63000, 'Selesai', '2023-07-29 09:06:25', '2023-07-30 19:01:14'),
(4, 3, 1, 1, 'app/orderan/-1690661899-jUEjb.jpg', 2, 30000, 'Selesai', '2023-07-30 10:18:20', '2023-07-30 10:23:22'),
(5, 4, 1, 1, 'app/orderan/5-1690692209-9YUve.jpg', 3, 15000, 'Proses', '2023-07-30 10:27:39', '2023-07-30 18:43:29'),
(6, 17, 1, 5, 'app/orderan/-1690669162-WbaYM.jpg', 10, 70000, 'Proses', '2023-07-30 12:19:22', '2023-07-30 12:19:22'),
(7, 2, 1, 2, 'app/orderan/-1690692035-I9viZ.jpg', 2, 14000, 'Proses', '2023-07-30 18:40:35', '2023-08-01 04:44:33'),
(10, 8, 2, 1, 'app/orderan/-1690858213-ip5eA.jpg', 5, 25000, 'Baru', '2023-08-01 16:50:13', '2023-08-01 16:50:13'),
(14, 2, 1, 6, 'app/orderan/14-1690859518-Z0sxc.jpg', 5, 35000, 'Selesai', '2023-08-01 17:09:49', '2023-08-01 17:19:24'),
(15, 4, 1, 6, 'app/orderan/-1690860003-60nMn.jpg', 10, 50000, 'Selesai', '2023-08-01 17:20:03', '2023-08-01 17:20:58'),
(16, 3, 1, 6, 'app/orderan/-1690860334-4ogdF.jpg', 8, 120000, 'Proses', '2023-08-01 17:25:34', '2023-08-01 21:10:35'),
(17, 2, 1, 1, 'app/orderan/-1690867095-jlQrv.jpg', 3, 21000, 'Selesai', '2023-08-01 19:18:15', '2023-08-01 19:19:12'),
(19, 2, 1, 1, 'app/orderan/-1690873893-1v1S9.jpg', 2, 14000, 'Selesai', '2023-08-01 21:11:33', '2023-08-01 21:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `alamat` longtext NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `gambar_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `tlp`, `alamat`, `lat`, `lng`, `gambar_pelanggan`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'marisa', '089765654334', 'Gg. Selat Sunda No.22, Siantan Hulu, Kec. Siantan, Kota Pontianak, Kalimantan Barat 78243, Indonesia', '-0.01948558144202104', '109.35593627674419', 'app/pelanggan/-1689973866-9JGjb.marisalaundry.jpg', 'marisa@gmail.com', '$2y$10$BuHnYYRLZfhlUzrbBWfgV.iOk3RyTw9CfGLCcuUXbS1n8Gnop57Pq', '2023-07-22 11:11:07', '2023-07-22 11:11:07'),
(2, 'izaa', '08976565432', '5XFH+29J, Sukaharja, Delta Pawan, Ketapang Regency, West Kalimantan 78811, Indonesia', '-1.8273492815880696', '109.97857361100228', 'app/pelanggan/-1690300980-Xj0cB.marisalaundry.jpg', 'iza@gmail.com', '$2y$10$uZJCmh8kGxaN4L0r1Z532OoSqUO7npT.8Zn/yq9gbctaMyi1HtYZ.', '2023-07-26 06:03:00', '2023-07-26 06:03:21'),
(4, 'atnita', '089500987675', 'Jalan Tanpa Nama, Sungai Kakap, Kec. Sungai Kakap, Kabupaten Kubu Raya, Kalimantan Barat 78381, Indonesia', '-0.042422731602466714', '109.1756111900175', 'app/pelanggan/-1690570946-YpR6x.setialaundry profil.png', 'atnita@gmail.com', '$2y$10$9SoSD.OsQ/ZA6dxNLv0MW.qS4KTFfVzHH8d..iemq44P7/StF/RFe', '2023-07-29 09:02:26', '2023-07-29 09:02:26'),
(5, 'mia', '0897989876765', '5XJH+VM7, Sukaharja, Delta Pawan, Ketapang Regency, West Kalimantan 78112, Indonesia', '-1.818055915170102', '109.97860558542882', 'app/pelanggan/-1690668372-f8Eqt.marisalaundry.jpg', 'mia@gmail.com', '$2y$10$tWg9MHV9um0nWSp5O7FcbuWO7hL5ZFwQy/mUDiVN3bqBdziDKFQIS', '2023-07-30 12:06:12', '2023-07-30 12:06:12'),
(6, 'Maiza', '089797987678', 'Jalan Tanpa Nama, Kabupaten Ketapang, Kalimantan Barat 78873, Indonesia', '-1.6457652383218593', '110.35829897272166', 'app/pelanggan/-1690858722-KMCI8.image-333020325398973371.jpg', 'maiza@gmail.com', '$2y$10$TmMMljAqUA6zR665jwB46OH4/Ig7PXy7Yyw4S2MDsjp.Nz6p/mJn.', '2023-08-01 16:58:42', '2023-08-01 16:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `bukti` varchar(225) DEFAULT NULL,
  `tipe` enum('Bayar ditempat','Transfer') NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_order`, `bukti`, `tipe`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'app/bukti/-1690566736-bmLMW.codlaundry.jpg', 'Bayar ditempat', 'Lunas', '2023-07-29 07:52:16', '2023-07-29 07:52:16'),
(2, 4, 'app/bukti/-1690662101-JM9WF.codlaundry.jpg', 'Bayar ditempat', 'Lunas', '2023-07-30 10:21:41', '2023-07-30 10:21:41'),
(3, 3, 'app/bukti/-1690693200-xTgEo.codlaundry.jpg', 'Bayar ditempat', 'Lunas', '2023-07-30 19:00:00', '2023-07-30 19:00:00'),
(6, 2, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 16:39:21', '2023-08-01 16:39:21'),
(7, 5, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 16:39:38', '2023-08-01 16:39:38'),
(8, 2, 'app/bukti/-1690857597-Ah65E.cucian baju biasa.jpg', 'Transfer', 'Lunas', '2023-08-01 16:39:57', '2023-08-01 16:39:57'),
(9, 9, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 16:42:39', '2023-08-01 16:42:39'),
(10, 14, 'app/bukti/-1690859949-1J4Og.fotolakilaki.png', 'Transfer', 'Lunas', '2023-08-01 17:19:10', '2023-08-01 17:19:10'),
(11, 15, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 17:20:35', '2023-08-01 17:20:35'),
(12, 17, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 19:18:54', '2023-08-01 19:18:54'),
(13, 19, NULL, 'Bayar ditempat', 'Lunas', '2023-08-01 21:12:09', '2023-08-01 21:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `id_laundri` int(11) NOT NULL,
  `nama_stok` varchar(50) NOT NULL,
  `jumlah` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `id_laundri`, `nama_stok`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'Deterjen cair', 10, '2023-07-22 11:06:51', '2023-07-22 11:07:07'),
(2, 1, 'Pewangi pakaian', 10, '2023-07-22 11:08:20', '2023-07-22 11:08:20'),
(3, 1, 'Kantong plastik laundry', 10, '2023-07-22 11:08:58', '2023-07-22 11:08:58'),
(4, 2, 'Deterjen', 12, '2023-07-26 05:57:42', '2023-07-26 05:57:42'),
(5, 2, 'molto', 13, '2023-07-26 05:57:58', '2023-07-26 05:58:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundri`
--
ALTER TABLE `laundri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laundri`
--
ALTER TABLE `laundri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
