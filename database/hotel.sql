-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 10:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `jumlah_penginap` int(11) NOT NULL,
  `rencanacheckin` date NOT NULL,
  `rencanacheckout` date NOT NULL,
  `totalharga` int(11) NOT NULL,
  `lama_menginap` int(11) NOT NULL,
  `dp_dibayar` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_kamar_orders`
--

CREATE TABLE `detail_kamar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kamar_orders_id` int(11) DEFAULT NULL,
  `kamars_id` int(11) NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `jumlah_penginap` int(11) NOT NULL,
  `totalharga` int(11) NOT NULL,
  `lama_menginap` int(11) NOT NULL,
  `dp_dibayar` int(11) DEFAULT NULL,
  `bookings_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_kamar_orders`
--

INSERT INTO `detail_kamar_orders` (`id`, `kamar_orders_id`, `kamars_id`, `tanggal_checkin`, `tanggal_checkout`, `jumlah_penginap`, `totalharga`, `lama_menginap`, `dp_dibayar`, `bookings_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-04-04', '2022-04-07', 1, 300000, 3, 0, 7, 3, '2022-04-04 00:32:44', '2022-04-04 00:32:44'),
(2, 2, 2, '2022-04-04', '2022-04-07', 1, 600000, 3, 0, 8, 4, '2022-04-04 01:16:38', '2022-04-04 01:16:38'),
(3, 2, 4, '2022-04-09', '2022-04-12', 1, 900000, 3, 0, 9, 4, '2022-04-04 01:16:38', '2022-04-04 01:16:38'),
(4, 3, 6, '2022-04-07', '2022-04-11', 1, 2000000, 4, 0, 10, 5, '2022-04-04 01:22:49', '2022-04-04 01:22:49');

--
-- Triggers `detail_kamar_orders`
--
DELIMITER $$
CREATE TRIGGER `hapusbooking` AFTER INSERT ON `detail_kamar_orders` FOR EACH ROW BEGIN 
        UPDATE kamars
        INNER JOIN bookings ON kamars.id = bookings.kamar_id SET kamars.status = "tidak_tersedia"
        WHERE kamars.id = bookings.kamar_id;
        DELETE FROM bookings 
        WHERE bookings.user_id = user_id; 
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namafasilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `namafasilitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 'Air Hangat', 'untuk penyejukan badan', '2022-03-19 23:02:16', '2022-03-19 23:02:16'),
(9, 'TV', 'untuk menonton ramai2', '2022-03-19 23:03:48', '2022-03-19 23:03:48'),
(10, 'Sandal Kamar', 'sendal untuk di kamar', '2022-03-20 00:31:10', '2022-03-20 00:31:10'),
(11, 'Air Dingin', 'air yang digunakan untuk kesejukan', '2022-03-20 01:39:25', '2022-03-20 01:39:25'),
(12, 'Air Conditioner', 'Untuk Mendinginkan ruangan', '2022-03-20 02:12:20', '2022-03-20 02:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `fasilitas_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id`, `kamar_id`, `fasilitas_id`, `created_at`, `updated_at`) VALUES
(3, 6, 9, '2022-03-19 23:03:48', '2022-03-19 23:03:48'),
(5, 12, 10, '2022-03-20 00:31:10', '2022-03-20 00:31:10'),
(6, 13, 8, '2022-03-20 01:14:36', '2022-03-20 01:14:36'),
(7, 13, 9, '2022-03-20 01:14:36', '2022-03-20 01:14:36'),
(8, 12, 8, '2022-03-20 02:00:06', '2022-03-20 02:00:06'),
(9, 12, 9, '2022-03-20 02:00:06', '2022-03-20 02:00:06'),
(10, 6, 8, '2022-03-20 02:00:36', '2022-03-20 02:00:36'),
(16, 13, 11, '2022-03-20 02:12:35', '2022-03-20 02:12:35'),
(17, 13, 12, '2022-03-20 02:12:35', '2022-03-20 02:12:35'),
(19, 14, 8, '2022-03-20 03:25:17', '2022-03-20 03:25:17'),
(20, 14, 9, '2022-03-20 03:25:17', '2022-03-20 03:25:17'),
(21, 14, 11, '2022-03-20 03:25:17', '2022-03-20 03:25:17'),
(22, 14, 12, '2022-03-20 03:25:17', '2022-03-20 03:25:17'),
(23, 1, 9, '2022-03-22 21:23:13', '2022-03-22 21:23:13'),
(24, 1, 12, '2022-03-22 21:23:13', '2022-03-22 21:23:13'),
(25, 2, 9, '2022-03-22 21:24:07', '2022-03-22 21:24:07'),
(26, 2, 11, '2022-03-22 21:24:07', '2022-03-22 21:24:07'),
(27, 2, 12, '2022-03-22 21:24:07', '2022-03-22 21:24:07'),
(32, 4, 9, '2022-03-22 21:34:52', '2022-03-22 21:34:52'),
(33, 4, 11, '2022-03-22 21:34:52', '2022-03-22 21:34:52'),
(34, 4, 12, '2022-03-22 21:34:52', '2022-03-22 21:34:52'),
(38, 6, 8, '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(39, 6, 9, '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(40, 6, 10, '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(41, 6, 11, '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(42, 6, 12, '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(43, 7, 8, '2022-04-04 01:30:25', '2022-04-04 01:30:25'),
(44, 7, 9, '2022-04-04 01:30:25', '2022-04-04 01:30:25'),
(45, 7, 12, '2022-04-04 01:30:25', '2022-04-04 01:30:25'),
(46, 8, 11, '2022-04-04 01:30:56', '2022-04-04 01:30:56'),
(47, 8, 12, '2022-04-04 01:30:56', '2022-04-04 01:30:56'),
(48, 9, 9, '2022-04-04 01:31:35', '2022-04-04 01:31:35'),
(49, 9, 11, '2022-04-04 01:31:35', '2022-04-04 01:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_umums`
--

CREATE TABLE `fasilitas_umums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('tersedia','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas_umums`
--

INSERT INTO `fasilitas_umums` (`id`, `nama_fasilitas`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gym', 'untuk berolahraga agar badan sehat', 'tersedia', '2022-03-16 22:48:51', '2022-03-16 22:48:51'),
(2, 'Kolam Renang', 'kolam renang untuk berenang keluarga', 'tersedia', '2022-03-16 22:49:19', '2022-03-23 06:42:15'),
(3, 'Wifi Gratis', 'untuk membrowsing secara gratis dan bebas', 'tersedia', '2022-03-16 22:49:42', '2022-03-16 22:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nokamar` int(11) NOT NULL,
  `tipe_kamars_id` int(11) NOT NULL,
  `jumlahorangperkamar` int(11) NOT NULL,
  `status` enum('tersedia','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hargakamarpermalam` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `nokamar`, `tipe_kamars_id`, `jumlahorangperkamar`, `status`, `hargakamarpermalam`, `image`, `created_at`, `updated_at`) VALUES
(1, 251, 24, 1, 'tidak_tersedia', 100000, '1648009393.jpg', '2022-03-22 21:23:13', '2022-04-03 20:48:08'),
(2, 12469, 23, 2, 'tidak_tersedia', 200000, '1648009446.jpg', '2022-03-22 21:24:06', '2022-03-23 06:42:55'),
(4, 5591, 21, 3, 'tidak_tersedia', 300000, '1648010092.jpg', '2022-03-22 21:34:52', '2022-04-03 02:57:42'),
(6, 7889, 26, 12, 'tidak_tersedia', 500000, '1648974629.jpg', '2022-04-03 01:30:29', '2022-04-03 01:30:29'),
(7, 13926, 27, 10, 'tersedia', 200000, '1649061025.jpeg', '2022-04-04 01:30:25', '2022-04-04 01:30:25'),
(8, 14517, 29, 1, 'tersedia', 50000, '1649061056.jpg', '2022-04-04 01:30:56', '2022-04-04 01:30:56'),
(9, 13170, 28, 5, 'tersedia', 245000, '1649061095.jpg', '2022-04-04 01:31:35', '2022-04-04 01:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `kamar_orders`
--

CREATE TABLE `kamar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_kode` int(11) NOT NULL,
  `jumlahdibayar` int(11) DEFAULT NULL,
  `totalharga` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `metodepembayaran` enum('cash','transfer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statuspembayaran` enum('lunas','belumlunas') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resepsionis_id` int(11) DEFAULT NULL,
  `status` enum('confirmed','uncorfirmed','done') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar_orders`
--

INSERT INTO `kamar_orders` (`id`, `booking_kode`, `jumlahdibayar`, `totalharga`, `kembalian`, `metodepembayaran`, `statuspembayaran`, `user_id`, `resepsionis_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 19750, 500000, 300000, 200000, 'cash', 'lunas', 3, 2, 'done', '2022-04-04 00:32:44', '2022-04-04 01:13:47'),
(2, 12325, 2000000, 1500000, 500000, 'transfer', 'lunas', 4, 2, 'done', '2022-04-04 01:16:38', '2022-04-04 01:17:43'),
(3, 10220, 2500000, 2000000, 500000, 'cash', 'lunas', 5, 2, 'done', '2022-04-04 01:22:49', '2022-04-04 01:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `msglogs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currurl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `msglogs`, `user_id`, `action`, `status`, `useragent`, `currurl`, `method`, `connection`, `date`, `created_at`, `updated_at`) VALUES
(1, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 05:41:43', '2022-04-03 22:41:43', '2022-04-03 22:41:43'),
(2, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 05:42:04', '2022-04-03 22:42:04', '2022-04-03 22:42:04'),
(3, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 05:42:28', '2022-04-03 22:42:28', '2022-04-03 22:42:28'),
(4, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 05:44:55', '2022-04-03 22:44:55', '2022-04-03 22:44:55'),
(5, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:08:42', '2022-04-04 00:08:43', '2022-04-04 00:08:43'),
(6, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:20:58', '2022-04-04 00:20:58', '2022-04-04 00:20:58'),
(7, 'halaman welcome', 2, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:21:24', '2022-04-04 00:21:24', '2022-04-04 00:21:24'),
(8, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:27:01', '2022-04-04 00:27:01', '2022-04-04 00:27:01'),
(9, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:31:55', '2022-04-04 00:31:55', '2022-04-04 00:31:55'),
(10, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:32:19', '2022-04-04 00:32:19', '2022-04-04 00:32:19'),
(11, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:32:47', '2022-04-04 00:32:47', '2022-04-04 00:32:47'),
(12, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:32:55', '2022-04-04 00:32:55', '2022-04-04 00:32:55'),
(13, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:35:29', '2022-04-04 00:35:29', '2022-04-04 00:35:29'),
(14, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:37:32', '2022-04-04 00:37:32', '2022-04-04 00:37:32'),
(15, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:37:57', '2022-04-04 00:37:57', '2022-04-04 00:37:57'),
(16, 'halaman welcome', 3, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:38:18', '2022-04-04 00:38:18', '2022-04-04 00:38:18'),
(17, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:40:39', '2022-04-04 00:40:39', '2022-04-04 00:40:39'),
(18, 'halaman welcome', 2, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:41:00', '2022-04-04 00:41:00', '2022-04-04 00:41:00'),
(19, 'halaman welcome', 2, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 07:58:27', '2022-04-04 00:58:27', '2022-04-04 00:58:27'),
(20, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:14:20', '2022-04-04 01:14:20', '2022-04-04 01:14:20'),
(21, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:15:31', '2022-04-04 01:15:31', '2022-04-04 01:15:31'),
(22, 'halaman welcome', 4, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:15:43', '2022-04-04 01:15:43', '2022-04-04 01:15:43'),
(23, 'halaman welcome', 4, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:15:51', '2022-04-04 01:15:51', '2022-04-04 01:15:51'),
(24, 'halaman welcome', 4, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:16:14', '2022-04-04 01:16:14', '2022-04-04 01:16:14'),
(25, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:16:54', '2022-04-04 01:16:54', '2022-04-04 01:16:54'),
(26, 'halaman welcome', 2, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:17:19', '2022-04-04 01:17:19', '2022-04-04 01:17:19'),
(27, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:20:41', '2022-04-04 01:20:41', '2022-04-04 01:20:41'),
(28, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:21:12', '2022-04-04 01:21:12', '2022-04-04 01:21:12'),
(29, 'halaman welcome', 5, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:21:48', '2022-04-04 01:21:48', '2022-04-04 01:21:48'),
(30, 'halaman welcome', 5, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:22:25', '2022-04-04 01:22:25', '2022-04-04 01:22:25'),
(31, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:23:02', '2022-04-04 01:23:02', '2022-04-04 01:23:02'),
(32, 'halaman welcome', 2, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:23:23', '2022-04-04 01:23:23', '2022-04-04 01:23:23'),
(33, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:25:52', '2022-04-04 01:25:52', '2022-04-04 01:25:52'),
(34, 'halaman welcome', 1, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:26:35', '2022-04-04 01:26:35', '2022-04-04 01:26:35'),
(35, 'halaman welcome', NULL, '/', 'success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', 'http://127.0.0.1:8000', 'GET', 'keep-alive', '04-April-2022 08:31:42', '2022-04-04 01:31:42', '2022-04-04 01:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_03_09_081524_create_fasilitas_kamars_table', 1),
(7, '2022_03_09_081555_create_fasilitas_umums_table', 1),
(8, '2022_03_09_081631_create_tipe_kamars_table', 1),
(11, '2022_03_09_085039_create_fasilitas_table', 1),
(12, '2022_03_12_041910_create_sarans_table', 1),
(13, '2022_01_01_000000_create_log_activities_table', 2),
(14, '2022_03_09_080804_create_kamars_table', 3),
(30, '2022_03_09_081747_create_kamar_orders_table', 5),
(31, '2022_03_09_081709_create_bookings_table', 6),
(34, '2022_04_01_023238_create_detail_kamar_orders_table', 7),
(37, '2022_04_04_034230_create_trigger_deletebookings', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarans`
--

CREATE TABLE `sarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sarans`
--

INSERT INTO `sarans` (`id`, `name`, `email`, `saran`, `created_at`, `updated_at`) VALUES
(2, 'Uus', 'uus@gmail.com', 'hotelnya bagus', '2022-03-16 23:28:51', '2022-03-16 23:28:51'),
(3, 'Achmad Fadli', 'achmadfadli@gmail.com', 'keren hotelnya', '2022-03-16 23:29:46', '2022-03-16 23:29:46'),
(5, 'Dzaki', 'dzaki@gmail.com', 'testing', '2022-03-23 06:43:30', '2022-03-23 06:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamars`
--

CREATE TABLE `tipe_kamars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe_kamars`
--

INSERT INTO `tipe_kamars` (`id`, `tipe_kamar`, `created_at`, `updated_at`) VALUES
(21, 'triple room', '2022-03-14 13:18:40', '2022-03-14 13:18:45'),
(23, 'Double room', '2022-03-14 06:34:39', '2022-03-14 06:34:39'),
(24, 'Single room', '2022-03-14 06:46:25', '2022-03-14 06:56:35'),
(26, 'Multiple Room', '2022-03-19 21:44:43', '2022-03-19 21:44:43'),
(27, 'Family Room', '2022-03-20 01:13:58', '2022-03-20 01:13:58'),
(28, 'mini room', '2022-04-04 01:26:49', '2022-04-04 01:26:49'),
(29, 'capsule room', '2022-04-04 01:27:05', '2022-04-04 01:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','resepsionis','tamu') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tamu',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin-Indigo', 'adminindigo@gmail.com', NULL, 'admin', '$2y$10$DxlSkSQ4kUXXnTmzMxpVdeqc5CXFDGW4B0rE.f3V2HWkOE2L0hJhq', NULL, NULL, '2022-03-11 23:57:02', '2022-03-11 23:57:02'),
(2, 'Resepsionis-Indigo', 'Resepsionisindigo@gmail.com', NULL, 'resepsionis', '$2y$10$GKYb6t3RVX/Wb5OLtducx.k.uVue1w0s6.fa4CQdkgimiCcDgGt2u', NULL, NULL, '2022-03-12 01:16:12', '2022-03-12 01:16:12'),
(3, 'fadli', 'fadli@gmail.com', NULL, 'tamu', '$2y$10$vhyn3/5pXplzH03/8lBhXOoZI46M8E/JpGgUPTo4NhsBn8QtJ8tba', NULL, NULL, '2022-03-12 01:17:26', '2022-03-12 01:17:26'),
(4, 'Diki Setiawan', 'diki@gmail.com', NULL, 'tamu', '$2y$10$sMUCCp0e7vsN9xnf02/x8ObH8o/zAMcQjDtm9xjNOIYN2esAcWNjC', NULL, NULL, '2022-03-27 01:13:31', '2022-03-27 01:13:31'),
(5, 'Kemal', 'kemalrasyidin@gmail.com', NULL, 'tamu', '$2y$10$wW6MaImcx3C7QI3DvquLguuUd6aab/75t0yR/DueJRI23zmdnZOye', NULL, NULL, '2022-04-01 23:09:03', '2022-04-01 23:09:03'),
(6, 'muhamad arya hidayat', 'arya@arya.com', NULL, 'tamu', '$2y$10$1bwMQ0YFAO3EG.aLvGOUAe2XXabqUaRZY9J8Zq.Tw.63t.iu.Uy7K', NULL, NULL, '2022-04-01 23:58:14', '2022-04-01 23:58:14'),
(7, 'test', 'test@test.com', NULL, 'tamu', '$2y$10$jqxSIzbnlUZMisuP9MRjbOVNEnP3cJ.zeh6J1POa95m7p5YrSJAXm', NULL, NULL, '2022-04-03 02:38:12', '2022-04-03 02:38:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_kamar_orders`
--
ALTER TABLE `detail_kamar_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_umums`
--
ALTER TABLE `fasilitas_umums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kamars_nokamar_unique` (`nokamar`);

--
-- Indexes for table `kamar_orders`
--
ALTER TABLE `kamar_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kamar_orders_booking_kode_unique` (`booking_kode`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sarans`
--
ALTER TABLE `sarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_kamars`
--
ALTER TABLE `tipe_kamars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_kamar_orders`
--
ALTER TABLE `detail_kamar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `fasilitas_umums`
--
ALTER TABLE `fasilitas_umums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kamar_orders`
--
ALTER TABLE `kamar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarans`
--
ALTER TABLE `sarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipe_kamars`
--
ALTER TABLE `tipe_kamars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
