-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2024 at 03:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unity`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('reviewed','verified','rejected') COLLATE utf8mb3_unicode_ci NOT NULL,
  `kategori` enum('pokok','wajib','sukarela') COLLATE utf8mb3_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int UNSIGNED NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `status`, `kategori`, `tanggal`, `jumlah`, `bukti`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'verified', 'pokok', '2024-03-17 10:55:52', 1000000, 'dimasjepang-pokok.png', 3, '2024-03-17 03:55:52', '2024-03-23 09:02:10'),
(2, 'verified', 'wajib', '2024-03-21 00:00:00', 50000, 'wajib_65fc2f53e3323.jpg', 3, '2024-03-21 06:00:03', '2024-03-22 01:25:52'),
(3, 'verified', 'sukarela', '2024-03-21 00:00:00', 50000, 'sukarela_65fc30dbca528.jpg', 3, '2024-03-21 06:06:35', '2024-03-22 01:25:56'),
(4, 'verified', 'wajib', '2024-03-21 00:00:00', 125000, 'wajib_65fc315c50a8a.jpg', 3, '2024-03-21 06:08:44', '2024-03-23 08:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb3_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `role` enum('admin','nasabah') COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `is_active`, `username`, `email`, `password`, `nama`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `profile_picture`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'paduladmin', 'padul.singlet@gmail.com', '$2y$10$cq6xaOtDw2iXR73a4.hV0ujKISBCt1wTA1TlU2/4aFvReV.SzjE1.', 'Pak Dul', 'Tresur, Curug Sangereng, Kelapa Dua, Kabupaten Tangerang', 'L', '1962-12-09', NULL, 'admin', 'c3c539f82494f4ce0aa1bc58f89c7d79cd6c860235e1afac502869f7ff243313', NULL, '2024-03-23 08:55:48'),
(3, 1, 'dimasjepang', 'dimas.jepang@gmail.com', '$2y$10$MuEUUVHcxGPXL.lpQvHBm.ErnYnXpQOiz2UnIWlDw1bYCZF/3K72u', 'Dimas Takeda', 'Treasure Kost Idaman', 'L', '2004-12-04', 'profile_65fc3bd139bb6.png', 'nasabah', 'acad3152e9dcc12401d7d390c81b8c8b88362f50fa97990e5d862a2bcb3a6a30', '2024-03-17 03:55:52', '2024-03-23 09:02:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_foreign` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
