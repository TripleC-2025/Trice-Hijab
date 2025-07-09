-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2025 at 08:12 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u458337714_localhost`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `nama`, `harga`, `gambar`, `jumlah`) VALUES
(3, 9, 'pashmina kaos pink', 30000, 'uploads/1751887982_671786fd-72bc-41a8-86c8-c23fbcaa7b1d.jpeg', 1),
(4, 7, 'Paris Premium Abu-abu Basah', 20000, 'uploads/1751886508_20ec1adc-7f5b-4bf5-9bf0-88cbfe06ee51.jpeg', 1),
(6, 9, 'Bella square hijau botol', 15, 'uploads/1751887370_f4af3849-00b1-4212-8303-07d0fae11adf.jpeg', 2),
(7, 7, 'pashmina kaos pink', 30000, 'uploads/1751887982_671786fd-72bc-41a8-86c8-c23fbcaa7b1d.jpeg', 1),
(9, 8, 'Paris premium maroon', 15000, 'uploads/1751887745_IMG_8387.jpeg', 4),
(11, 8, 'Paris Premium Abu-abu Basah', 20000, 'uploads/1751886508_20ec1adc-7f5b-4bf5-9bf0-88cbfe06ee51.jpeg', 3),
(12, 9, 'Bella square navy', 15, 'uploads/1751887493_3F739784-6FA5-42FB-8B76-F456979CAABE.jpeg', 1),
(14, 8, 'pashmina voal', 45000, 'uploads/1751888103_629250fa-3b65-46e9-bdf8-66c68dbaacf6.jpeg', 1),
(16, 7, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 2),
(17, 13, 'Bella square coksu', 15000, 'uploads/1751886961_80f59026-752d-446c-a000-513f13ed7732.jpeg', 1),
(18, 10, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 1),
(21, 14, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 1),
(23, 10, 'Bella square biru muda', 15000, 'uploads/1751886909_68467c2d-d29b-4228-a35b-da0904c733ff.jpeg', 1),
(24, 10, 'pashmina kaos abu abu basah', 35000, 'uploads/1751888250_a1c6e027-a230-42b2-8f20-c7303280cb70.jpeg', 1),
(25, 13, 'pashmina voal navy', 45000, 'uploads/1751888103_629250fa-3b65-46e9-bdf8-66c68dbaacf6.jpeg', 1),
(26, 16, 'Paris Premium Abu-abu Basah', 20000, 'uploads/1751886508_20ec1adc-7f5b-4bf5-9bf0-88cbfe06ee51.jpeg', 2),
(27, 8, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 1),
(28, 17, 'Paris premium putih', 15000, 'uploads/1751887550_3d948a32-9374-40c2-a445-02995bdcf3a8.jpeg', 7),
(29, 19, 'Pashmina kaos coffee', 30000, 'uploads/1751887936_d3055bf3-2f7a-479c-a75d-361d512af4ea.jpeg', 1),
(30, 9, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 1),
(31, 13, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 3),
(33, 20, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('normal','sold out','on sale') NOT NULL DEFAULT 'normal',
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `status`, `stok`) VALUES
(83, 'Paris premium cream', 20000, 'uploads/1751886424_44490f92-bb64-4aa6-8b2e-fce9ff6584a3.jpeg', 'normal', 50),
(84, 'Paris Premium Abu-abu Basah', 20000, 'uploads/1751886508_20ec1adc-7f5b-4bf5-9bf0-88cbfe06ee51.jpeg', 'normal', 50),
(85, 'Paris premium cloud', 20000, 'uploads/1751886618_a62cfec7-c593-40e8-8863-ec410eacdd01.jpeg', 'normal', 50),
(86, 'Paris premium Hitam', 20000, 'uploads/1751886649_edf807cd-f5bc-4b8e-9e20-08428d828ec6.jpeg', 'normal', 100),
(87, 'Paris premium hijau army', 20000, 'uploads/1751886688_7b053457-bd91-4389-9b21-1c9d1bc0e550.jpeg', 'normal', 50000),
(88, 'Paris premium sage green', 20000, 'uploads/1751886772_24dcf4f5-4ad1-4537-9c40-fa39793f17e2.jpeg', 'normal', 30),
(90, 'Paris premium putih', 15000, 'uploads/1751887550_3d948a32-9374-40c2-a445-02995bdcf3a8.jpeg', 'normal', 30),
(91, 'Paris premium maroon', 15000, 'uploads/1751887745_IMG_8387.jpeg', 'normal', 30),
(92, 'Paris premium coffe', 15000, 'uploads/1751887778_IMG_8388.jpeg', 'normal', 45),
(93, 'Paris premium broken white', 15000, 'uploads/1751887868_IMG_8389.jpeg', 'normal', 30);

-- --------------------------------------------------------

--
-- Table structure for table `produk2`
--

CREATE TABLE `produk2` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('normal','sold out','on sale') NOT NULL DEFAULT 'normal',
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk2`
--

INSERT INTO `produk2` (`id`, `nama`, `harga`, `gambar`, `status`, `stok`) VALUES
(10, 'Bella square biru muda', 15000, 'uploads/1751886909_68467c2d-d29b-4228-a35b-da0904c733ff.jpeg', 'normal', 35),
(11, 'Bella square coksu', 15000, 'uploads/1751886961_80f59026-752d-446c-a000-513f13ed7732.jpeg', 'normal', 35),
(12, 'Bella square ungu muda', 15000, 'uploads/1751887112_5ffc54f9-52a5-4d9e-8141-adad7f8919b0.jpeg', 'normal', 30),
(13, 'Bella square deep white', 15000, 'uploads/1751887152_57290d3d-10be-4fd6-bd9d-bcf583a83572.jpeg', 'normal', 30),
(14, 'Bella square maroon', 15000, 'uploads/1751887275_0aa300f6-1a3f-4948-b1d7-23887c8acfba.jpeg', 'normal', 35),
(15, 'Bella square pink', 15000, 'uploads/1751887334_53a22fcd-e706-46c0-a493-35a67f96e658.jpeg', 'normal', 20),
(16, 'Bella square hijau botol', 15000, 'uploads/1751887370_f4af3849-00b1-4212-8303-07d0fae11adf.jpeg', 'normal', 20),
(17, 'Bella square burgundy', 15000, 'uploads/1751887406_b31e649c-e33e-417c-9692-1a8f0a4727af.jpeg', 'normal', 20),
(18, 'Bella square hitam', 15000, 'uploads/1751887447_5efff71e-a469-46d8-abf9-15b0719e734f.jpeg', 'normal', 100),
(19, 'Bella square navy', 15000, 'uploads/1751887493_3F739784-6FA5-42FB-8B76-F456979CAABE.jpeg', 'normal', 30);

-- --------------------------------------------------------

--
-- Table structure for table `produk3`
--

CREATE TABLE `produk3` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('normal','sold out','on sale') NOT NULL DEFAULT 'normal',
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk3`
--

INSERT INTO `produk3` (`id`, `nama`, `harga`, `gambar`, `status`, `stok`) VALUES
(10, 'Pashmina kaos coffee', 30000, 'uploads/1751887936_d3055bf3-2f7a-479c-a75d-361d512af4ea.jpeg', 'normal', 20),
(11, 'pashmina kaos pink', 30000, 'uploads/1751887982_671786fd-72bc-41a8-86c8-c23fbcaa7b1d.jpeg', 'normal', 40),
(12, 'pashmina voal hitam ', 45000, 'uploads/1751888024_7d90cd3e-721a-4248-a27d-34c7fadeeb34.jpeg', 'normal', 20),
(13, 'pashmina kaos cream ', 30000, 'uploads/1751888067_49bd274d-8659-474c-8845-b9ede8443285.jpeg', 'normal', 20),
(14, 'pashmina voal navy', 45000, 'uploads/1751888103_629250fa-3b65-46e9-bdf8-66c68dbaacf6.jpeg', 'normal', 25),
(15, 'pashmina crickle deep purple', 25000, 'uploads/1751888161_7396f419-d8ea-4544-8caf-d188ef027b3a.jpeg', 'normal', 20),
(16, 'pashmina ceruty hijau ', 20000, 'uploads/1751888205_8c4a7dc4-d691-42d0-8b8c-fb615ed7ebbc.jpeg', 'normal', 30),
(17, 'pashmina kaos abu abu basah', 35000, 'uploads/1751888250_a1c6e027-a230-42b2-8f20-c7303280cb70.jpeg', 'normal', 20),
(18, 'pashmina ceruty hitam ', 20000, 'uploads/1751888378_8cb39761-72ee-469c-98a2-d6cfe6793dbf.jpeg', 'normal', 30),
(19, 'pashmina ceruty coksu', 20000, 'uploads/1751888438_IMG_8218.jpeg', 'normal', 20);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'rajakoin96@gmail.com', '2025-07-08 06:28:15'),
(2, 'nurulfitra414@gmail.com', '2025-07-08 09:10:02'),
(3, 'indranurman396@gmail.com', '2025-07-08 09:19:50'),
(4, 'amnhamanah03@gmail.com', '2025-07-08 15:49:40'),
(5, 'nurulhikma8260@gmail.com', '2025-07-08 16:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `no_hp`, `foto`) VALUES
(6, 'admin', 'admin@gmail.com', '$2y$10$s4w3b6nGPgE0aOZz/Hks2.ZMFnuf/pz1eIrGEDAhnICsIScW3RqxK', 'admin', '2025-07-07 10:58:14', 'admin@gmail.com', NULL),
(7, 'amanah', 'amnhamanah03@gmail.com', '$2y$10$sNYOp20/OwBz9ZszhEIKReHPszhJGcFxdmqSQVHxGc876Vq4ZpreS', 'user', '2025-07-07 10:59:29', '085672341945', 'user_7.jpeg'),
(8, 'Indra Nurman ', 'indranurman396@gmail.com', '$2y$10$Bi/Kq05wjIhJmsrKiKMv1OBlR8.3sIzxNOnpHdADy7OJ8RkbY7iUi', 'user', '2025-07-07 11:11:36', '081242120121', 'user_8.jpg'),
(9, 'user', 'user@gmail.com', '$2y$10$fVP1jvzULNsU2fm4ARO6luYna.WnDJCh8PD3c32XawBU4/jQFVcvO', 'user', '2025-07-07 11:21:09', '8282882', NULL),
(10, 'enal', 'aldyraenaldy39@gmail.com', '$2y$10$vkRUz30U.q0YeX.Yj.W.1uAZ4ksMSNbKpJ5OJBf5iUOLG1jP.8QuK', 'user', '2025-07-07 11:49:24', '082346992260', 'user_10.png'),
(11, 'tripleC', 'tricehijab@gmail.com', '$2y$10$As4DiZkcOx/vofP19sM6rOn39tr8Q1w6jJ0n5Lhv6/7RDwxqea8yi', 'user', '2025-07-07 11:51:15', '085624784335', NULL),
(12, 'Arsy', 'arsy@gmail.com', '$2y$10$dt.cKPvqD/H.Ka69wAry7uAfvoltRuRimLBUpRA1US0R930vD.nbS', 'user', '2025-07-07 15:16:13', '082192665449', NULL),
(13, 'Nurul Fitra', 'nurulfitra414@gmail.com', '$2y$10$f2tFU9vgdv0u5wBKI3EHK.bqOf66hvm9yPndcjfZGlUXSX9ISfe5e', 'user', '2025-07-08 02:02:16', '082217250021', NULL),
(14, 'helmy', 'helmyahmed011080@gmail.com', '$2y$10$fQs/u4NAknCS/KhiLyjQf.YefKMvnctVDlsPtgECOyjqQgxEjAfEK', 'user', '2025-07-08 08:55:48', '089630315624', NULL),
(15, 'karina amelia', 'songkolobgdng623@gmail.com', '$2y$10$YbpHKJTe31e3peFaSuEyFOWzVCbJehsUUAfySr1GlNpmiPjTHOGli', 'user', '2025-07-08 09:14:13', '085394261805', NULL),
(16, 'Fadhill', 'fadhil@gmail.com', '$2y$10$2jpfVZJM81cu3DumPcARlu4Vvhlq3bTN57xFxlb77EEjpXNbeyzf6', 'user', '2025-07-08 11:38:30', '088', NULL),
(17, 'afdalganteng', 'muhafdalnas6704@gmail.com', '$2y$10$n2oKbZRQAWgXR7pgYrC6pOHUBRz8vDo8GQ7P3TjqkdKNOnM8pAFyq', 'user', '2025-07-08 13:12:37', '088242136325', NULL),
(18, 'Afif Aufar', 'jxoxk@gmail.com', '$2y$10$UrJpfg77TYUkLJnhMC3Z7e7aFCrSf8TQsRXurIoOLFFUV0qwqe8fK', 'user', '2025-07-08 13:18:23', '081234567890', NULL),
(19, 'Afif Aufar', 'afifaufar@gmail.com', '$2y$10$xWDuEBClOg1mUQO42Vcdoe86k79S2JhH9q9cR/w4t/qepWKD9w1mW', 'user', '2025-07-08 13:19:01', '081234567890', NULL),
(20, 'rapel', 'rapel123@gmail.com', '$2y$10$ehFRBwdY4JlZFR3RqY79S.PyllCBHRu/C4WRKpMvRyXiXViNuaigK', 'user', '2025-07-08 15:49:28', '08234567182', NULL),
(21, 'Aldy Januari', 'aldij1604@gmail.com', '$2y$10$KEkwUd/s2xAq2PFfE7.V2uTJmzMakD7RhHX4CLotxkD0hyWEbyOX.', 'user', '2025-07-09 06:45:01', '087765415307', 'user_21.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk2`
--
ALTER TABLE `produk2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk3`
--
ALTER TABLE `produk3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `produk2`
--
ALTER TABLE `produk2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `produk3`
--
ALTER TABLE `produk3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
