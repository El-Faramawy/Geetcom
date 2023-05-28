-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 12:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geetcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `additions`
--

CREATE TABLE `additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addition_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additions`
--

INSERT INTO `additions` (`id`, `addition_category_id`, `name_ar`, `name_en`, `price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'تيست', 'test', 5, NULL, NULL, NULL),
(2, 1, '2تيست', 'test2', 4, NULL, NULL, NULL),
(3, 2, 'تيست3', '3test', 5, NULL, NULL, NULL),
(4, 2, '4تيست', 'test4', 4, NULL, NULL, NULL),
(5, 2, 'a1', 'لا1', 50, NULL, '2023-05-18 14:18:23', '2023-05-18 14:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `addition_categories`
--

CREATE TABLE `addition_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `choise` enum('one','multiple') NOT NULL DEFAULT 'multiple',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addition_categories`
--

INSERT INTO `addition_categories` (`id`, `name_ar`, `name_en`, `choise`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'سلطات', 'salad', 'multiple', NULL, NULL, NULL),
(2, 'فواكه', 'fruit', 'one', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addition_products`
--

CREATE TABLE `addition_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addition_products`
--

INSERT INTO `addition_products` (`id`, `addition_id`, `product_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 3, 1, NULL, NULL, NULL),
(4, 3, 2, NULL, NULL, NULL),
(5, 2, 1, NULL, NULL, NULL),
(6, 2, 3, NULL, NULL, NULL),
(9, 5, 1, NULL, '2023-05-18 14:21:36', '2023-05-18 14:21:36'),
(10, 5, 2, NULL, '2023-05-18 14:21:37', '2023-05-18 14:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `recipient_name` varchar(191) DEFAULT NULL,
  `recipient_number` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT 0,
  `longitude` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `recipient_name`, `recipient_number`, `address`, `latitude`, `longitude`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'home', 'hamada', '01004834728', 'egypt', 123, 456, NULL, '2023-04-26 14:22:16', '2023-04-26 14:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_reset` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `phone`, `email_verified_at`, `password_reset`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Samir', 'admin@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$6x3eDqY3JQZp2fF5JdCgHOg0FBCjoebFoo7xfaKg38QilIUvv.1me', NULL, NULL, '2023-05-19 14:37:26'),
(6, 'admin', 'admin2@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$/W9CrlJEyDd9K.9YBNqFVuWcH/XiKfDNoKq2qvPi6akwNWt4QP38.', NULL, NULL, '2022-10-29 18:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `permission_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL),
(2, 2, 6, NULL, NULL),
(3, 3, 6, NULL, NULL),
(4, 4, 6, NULL, NULL),
(55, 1, 1, '2023-05-19 14:37:26', '2023-05-19 14:37:26'),
(56, 2, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(57, 3, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(58, 4, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(59, 5, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(60, 7, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(61, 9, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(62, 10, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(63, 11, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(64, 13, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(65, 16, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(66, 80, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(67, 81, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(68, 82, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(69, 83, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(70, 84, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(71, 19, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(72, 20, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(73, 21, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(74, 22, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(75, 85, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(76, 86, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(77, 39, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(78, 40, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(79, 41, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(80, 42, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(81, 23, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(82, 24, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(83, 25, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(84, 26, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(85, 51, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(86, 60, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(87, 61, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(88, 62, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(89, 63, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(90, 64, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(91, 65, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(92, 66, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(93, 67, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(94, 68, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(95, 69, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(96, 70, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(97, 71, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(98, 72, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(99, 73, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(100, 74, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(101, 75, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(102, 76, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(103, 77, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(104, 78, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(105, 79, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 5, '2023-04-26 15:55:32', '2023-04-26 15:55:32'),
(3, 6, 2, 5, '2023-04-26 20:20:34', '2023-04-26 20:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `cart_additions`
--

CREATE TABLE `cart_additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_additions`
--

INSERT INTO `cart_additions` (`id`, `cart_id`, `addition_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-04-26 20:21:24', '2023-04-26 20:21:24'),
(2, 3, 2, '2023-04-26 20:21:24', '2023-04-26 20:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name_ar`, `name_en`, `featured`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/user/20541682350021.png', 'وجبات لحوم', 'meat meals', 'yes', NULL, NULL, NULL),
(2, 'uploads/user/20541682350021.png', 'وجبات ساخنة', 'hot meals', 'yes', NULL, NULL, NULL),
(3, 'uploads/Category/14611684441611.jpg', 'test', 'test en', 'no', NULL, '2023-05-18 17:26:02', '2023-05-18 17:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_from` enum('user','admin') NOT NULL DEFAULT 'admin',
  `message` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `message_from`, `message`, `created_at`, `updated_at`) VALUES
(1, 6, 'user', 'test messgae', '2023-04-28 16:21:10', '2023-04-28 16:21:10'),
(2, 6, 'admin', 'test messgae', '2023-04-28 16:21:51', '2023-04-28 16:21:51'),
(3, 6, 'user', 'test messgae', '2023-04-28 16:22:36', '2023-04-28 16:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `mail` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `mail`, `subject`, `message`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 6, 'ahmed', 'a@a.com', 'subject message', 'test message', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `type` enum('value','percentage') NOT NULL DEFAULT 'value',
  `coupon_on` enum('purchases','points') NOT NULL DEFAULT 'purchases',
  `value` double DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `min_price` double DEFAULT NULL,
  `max_price` double DEFAULT NULL,
  `is_available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `coupon_on`, `value`, `percentage`, `min_price`, `max_price`, `is_available`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1234', 'value', 'points', 10, 0, 50, 0, 'yes', NULL, NULL, NULL),
(2, '12345', 'percentage', 'purchases', 0, 10, 0, 100, 'yes', NULL, NULL, NULL),
(3, '123445', 'percentage', 'purchases', NULL, 10, NULL, 100, 'yes', NULL, '2023-05-18 16:54:14', '2023-05-18 17:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_users`
--

CREATE TABLE `coupon_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_paid` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_users`
--

INSERT INTO `coupon_users` (`id`, `user_id`, `coupon_id`, `is_paid`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'yes', NULL, '2023-04-28 18:21:57'),
(2, 6, 2, 'no', NULL, '2023-04-30 12:20:43'),
(5, 6, 3, 'no', '2023-05-18 17:06:15', '2023-05-18 17:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(191) DEFAULT NULL,
  `l_name` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `block` enum('yes','no') NOT NULL DEFAULT 'no',
  `notification` enum('yes','no') NOT NULL DEFAULT 'yes',
  `points` double NOT NULL DEFAULT 0,
  `wallet` double NOT NULL DEFAULT 0,
  `is_available` enum('yes','no') NOT NULL DEFAULT 'no',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `f_name`, `l_name`, `phone`, `image`, `password`, `code`, `block`, `notification`, `points`, `wallet`, `is_available`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', 'delivery', '01004834728', 'uploads/delivery/951682966310.png', '$2y$10$5jKC8UN9Obsqo5aAq0556efuRi10dh00AmyqiTYqe5VayTgwIHCSG', NULL, 'no', 'yes', 400, 200, 'yes', NULL, '2023-05-01 15:33:03', '2023-05-06 13:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `favourates`
--

CREATE TABLE `favourates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourates`
--

INSERT INTO `favourates` (`id`, `user_id`, `product_id`, `market_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 6, NULL, 1, NULL, '2023-04-26 15:19:20', '2023-04-26 15:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `user_name` varchar(191) DEFAULT NULL,
  `location_ar` varchar(191) DEFAULT NULL,
  `location_en` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `panner` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `min_from` varchar(191) DEFAULT NULL,
  `min_to` varchar(191) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `rating` double NOT NULL DEFAULT 0,
  `block` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `name_ar`, `name_en`, `user_name`, `location_ar`, `location_en`, `phone`, `image`, `panner`, `password`, `code`, `min_from`, `min_to`, `price`, `rating`, `block`, `is_available`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'مطعم 1', 'market 1', 'market1', 'المنوفية', 'menofia', '01004834728', 'uploads/user/20541682350021.png', 'uploads/user/20541682350021.png', '$2y$10$/oq66plqf5ou2eU4L6ZdVu7oCcIWq7QEIsOgJsMkTTuOlN/ZKK4EC', NULL, '10', '40', 100, 0, 'no', 'yes', NULL, NULL, '2023-05-15 09:45:42'),
(2, 'مطعم 2', 'market 2', 'market2', 'المنوفية', 'menofia', '01004834728', 'uploads/user/20541682350021.png', 'uploads/user/20541682350021.png', '$2y$10$/oq66plqf5ou2eU4L6ZdVu7oCcIWq7QEIsOgJsMkTTuOlN/ZKK4EC', NULL, '10', '40', 100, 0, 'no', 'yes', NULL, NULL, NULL),
(3, 'مطعم اسماك', 'fish food', 'fish', 'test', 'test', '01004834728', '$2y$10$CFlWKbddsjgCxOuVg2CY4uotcvYx0J.k1e.ST2PgxuD.y/C2nuLLO', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', '2023-05-15 13:44:34', '2023-05-15 11:09:05', '2023-05-15 13:44:34'),
(4, 'مطعم اسماك', 'fish food', 'fishes', 'test', 'test', '01004834728', '$2y$10$x3ze/UhJgGVlNLGXrsAUReFCiJekkGjlEQ2LHOzP.T40Hk43TV2Em', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', '2023-05-15 13:38:04', '2023-05-15 11:09:33', '2023-05-15 13:38:04'),
(5, 'مطعم اسماك', 'fish food', 'fishes2', 'test', 'test', '01004834728', '$2y$10$tDVPUbFUsSKv89EgAU9Br.VYTAdirt56SLDUngFqrxmg9gTg1HJ12', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', '2023-05-15 13:44:34', '2023-05-15 11:10:21', '2023-05-15 13:44:34'),
(7, 'Rooney Clay', 'Adele Oneill', 'sycyga', 'Velit et culpa aliq', 'Est fugit in quia e', '+1 (675) 723-6072', 'uploads/Market/35551684168280.png', 'uploads/Market/93091684168280.jpg', 'Pa$$w0rd!', NULL, '1', '2', 587, 0, 'no', 'yes', NULL, '2023-05-15 13:31:20', '2023-05-15 13:31:20'),
(8, 'Rooney Clay', 'Adele Oneill', 'sycyga2', 'Velit et culpa aliq', 'Est fugit in quia e', '16757236072', 'uploads/Market/50501684170141.jpg', 'uploads/Market/70961684170141.jpg', NULL, NULL, '1', '2', 587, 0, 'no', 'yes', NULL, '2023-05-15 14:00:18', '2023-05-15 14:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `market_categories`
--

CREATE TABLE `market_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_categories`
--

INSERT INTO `market_categories` (`id`, `market_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 2, 1, NULL, NULL, NULL),
(4, 2, 2, NULL, NULL, NULL),
(5, 5, 1, NULL, '2023-05-15 11:10:21', '2023-05-15 11:10:21'),
(6, 5, 2, NULL, '2023-05-15 11:10:22', '2023-05-15 11:10:22'),
(8, 7, 2, NULL, '2023-05-15 13:31:20', '2023-05-15 13:31:20'),
(11, 8, 2, NULL, '2023-05-15 14:02:21', '2023-05-15 14:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2022_08_10_201958_create_users_table', 1),
(25, '2022_08_10_202255_create_settings_table', 1),
(26, '2022_08_10_202310_create_contacts_table', 1),
(27, '2022_08_10_202430_create_categories_table', 1),
(28, '2023_04_20_161117_create_markets_table', 1),
(29, '2023_04_20_161232_create_market_categories_table', 1),
(30, '2023_04_20_161233_create_products_table', 1),
(31, '2023_04_20_161443_create_addition_categories_table', 1),
(32, '2023_04_20_161505_create_additions_table', 1),
(33, '2023_04_20_161514_create_addition_products_table', 1),
(34, '2023_04_20_161631_create_addresses_table', 1),
(35, '2023_04_20_161648_create_favourates_table', 1),
(36, '2023_04_20_161739_create_coupons_table', 1),
(37, '2023_04_20_161818_create_deliveries_table', 1),
(38, '2023_04_20_161819_create_orders_table', 1),
(39, '2023_04_20_161820_create_order_details_table', 1),
(40, '2023_04_20_161835_create_order_details_additions_table', 1),
(41, '2023_04_20_161924_create_supports_table', 1),
(42, '2023_04_20_161933_create_support_products_table', 1),
(43, '2023_04_20_162021_create_rates_table', 1),
(44, '2023_04_20_162022_create_notifications_table', 1),
(45, '2023_04_24_130257_create_coupon_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('notification','offer','reward') NOT NULL DEFAULT 'notification',
  `title` varchar(191) DEFAULT NULL,
  `message` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `delivery_id`, `market_id`, `type`, `title`, `message`, `image`, `is_read`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, NULL, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-04-24 20:04:54'),
(2, 6, NULL, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-04-24 20:04:54'),
(4, NULL, 1, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-05-01 15:46:31'),
(5, NULL, 1, NULL, 'reward', 'test', 'test2', NULL, 1, NULL, '2023-04-27 20:04:54', '2023-04-27 20:04:54'),
(6, 6, NULL, NULL, 'notification', 'تم الرد على رسالتك', 'teeeeeeeeest', NULL, 0, NULL, '2023-05-19 14:59:47', '2023-05-19 14:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('not_paid','new','accepted','in_market_way','wait_order','delivery','ended','canceled_from_market','canceled_from_delivery','canceled_from_admin') NOT NULL DEFAULT 'new',
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `pay_type` enum('wallet','online') NOT NULL DEFAULT 'online',
  `wallet_pay` double NOT NULL DEFAULT 0,
  `online_pay` double NOT NULL DEFAULT 0,
  `notes` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `market_id`, `delivery_id`, `coupon_id`, `status`, `from`, `to`, `total`, `pay_type`, `wallet_pay`, `online_pay`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, NULL, NULL, 'new', '00:00:00', '00:00:00', 100, 'wallet', 0, 0, 'i want fresh meal', NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(2, 6, 1, 1, 1, NULL, 'in_market_way', '00:00:00', '00:00:00', 100, 'wallet', 0, 0, 'i want fresh meal', NULL, '2023-04-27 19:08:17', '2023-04-27 19:08:17'),
(3, 6, 1, 1, 1, NULL, 'ended', '00:00:00', '00:00:00', 100, 'wallet', 50, 50, 'i want fresh meal', NULL, '2023-04-27 19:09:58', '2023-05-01 17:57:33'),
(4, 6, 1, 2, 1, NULL, 'ended', '00:00:00', '00:00:00', 100, 'wallet', 0, 100, 'i want fresh meal', NULL, '2023-04-27 19:34:09', '2023-04-27 19:34:09'),
(5, 7, 1, 1, NULL, NULL, 'canceled_from_admin', '19:40:14', '20:10:14', 100, 'wallet', 0, 100, 'i want fresh meal', NULL, '2023-04-27 19:34:37', '2023-05-17 17:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(2, 1, 1, 2, NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(3, 2, 2, 3, NULL, '2023-04-27 19:08:17', '2023-04-27 19:08:17'),
(4, 2, 1, 2, NULL, '2023-04-27 19:08:17', '2023-04-27 19:08:17'),
(5, 3, 2, 3, NULL, '2023-04-27 19:09:58', '2023-04-27 19:09:58'),
(6, 3, 1, 2, NULL, '2023-04-27 19:09:58', '2023-04-27 19:09:58'),
(7, 4, 2, 3, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(8, 4, 1, 2, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(9, 5, 2, 3, NULL, '2023-04-27 19:34:37', '2023-04-27 19:34:37'),
(10, 5, 1, 2, NULL, '2023-04-27 19:34:38', '2023-04-27 19:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_details_additions`
--

CREATE TABLE `order_details_additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details_additions`
--

INSERT INTO `order_details_additions` (`id`, `details_id`, `addition_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(2, 1, 2, NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(3, 2, 3, NULL, '2023-04-27 19:05:55', '2023-04-27 19:05:55'),
(4, 2, 2, NULL, '2023-04-27 19:05:56', '2023-04-27 19:05:56'),
(5, 3, 1, NULL, '2023-04-27 19:08:17', '2023-04-27 19:08:17'),
(6, 3, 2, NULL, '2023-04-27 19:08:17', '2023-04-27 19:08:17'),
(7, 4, 3, NULL, '2023-04-27 19:08:18', '2023-04-27 19:08:18'),
(8, 4, 2, NULL, '2023-04-27 19:08:18', '2023-04-27 19:08:18'),
(9, 5, 1, NULL, '2023-04-27 19:09:58', '2023-04-27 19:09:58'),
(10, 5, 2, NULL, '2023-04-27 19:09:58', '2023-04-27 19:09:58'),
(11, 6, 3, NULL, '2023-04-27 19:09:59', '2023-04-27 19:09:59'),
(12, 6, 2, NULL, '2023-04-27 19:09:59', '2023-04-27 19:09:59'),
(13, 7, 1, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(14, 7, 2, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(15, 8, 3, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(16, 8, 2, NULL, '2023-04-27 19:34:10', '2023-04-27 19:34:10'),
(17, 9, 1, NULL, '2023-04-27 19:34:37', '2023-04-27 19:34:37'),
(18, 9, 2, NULL, '2023-04-27 19:34:38', '2023-04-27 19:34:38'),
(19, 10, 3, NULL, '2023-04-27 19:34:38', '2023-04-27 19:34:38'),
(20, 10, 2, NULL, '2023-04-27 19:34:38', '2023-04-27 19:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'عرض', NULL, NULL),
(2, 1, 'تعديل', NULL, NULL),
(3, 1, 'حذف', NULL, NULL),
(4, 1, 'اضافة', NULL, NULL),
(5, 2, 'عرض', NULL, NULL),
(7, 2, 'حذف', NULL, NULL),
(9, 2, 'تغيير الحالة', NULL, NULL),
(10, 2, 'حظر', NULL, NULL),
(11, 3, 'عرض', NULL, NULL),
(13, 3, 'حذف', NULL, NULL),
(16, 3, 'حظر', NULL, NULL),
(19, 5, 'عرض', NULL, NULL),
(20, 5, 'حظر', NULL, NULL),
(21, 5, 'حذف', NULL, NULL),
(22, 6, 'تعديل', NULL, NULL),
(23, 14, 'عرض', NULL, NULL),
(24, 14, 'تعديل', NULL, NULL),
(25, 14, 'حذف', NULL, NULL),
(26, 14, 'اضافة', NULL, NULL),
(39, 11, 'عرض', NULL, NULL),
(40, 11, 'حذف', NULL, NULL),
(41, 11, 'تغيير الحالة', NULL, NULL),
(42, 12, 'اضافة', NULL, NULL),
(51, 15, 'عرض', NULL, NULL),
(60, 17, 'عرض', NULL, NULL),
(61, 17, 'تعديل', NULL, NULL),
(62, 17, 'حذف', NULL, NULL),
(63, 17, 'اضافة', NULL, NULL),
(64, 18, 'عرض', NULL, NULL),
(65, 18, 'تعديل', NULL, NULL),
(66, 18, 'حذف', NULL, NULL),
(67, 18, 'اضافة', NULL, NULL),
(68, 19, 'عرض', NULL, NULL),
(69, 19, 'تعديل', NULL, NULL),
(70, 19, 'حذف', NULL, NULL),
(71, 19, 'اضافة', NULL, NULL),
(72, 20, 'عرض', NULL, NULL),
(73, 20, 'تعديل', NULL, NULL),
(74, 20, 'حذف', NULL, NULL),
(75, 20, 'اضافة', NULL, NULL),
(76, 21, 'عرض', NULL, NULL),
(77, 21, 'تعديل', NULL, NULL),
(78, 21, 'حذف', NULL, NULL),
(79, 21, 'اضافة', NULL, NULL),
(80, 4, 'عرض', NULL, NULL),
(81, 4, 'تعديل', NULL, NULL),
(82, 4, 'حذف', NULL, NULL),
(83, 4, 'اضافة', NULL, NULL),
(84, 4, 'حظر', NULL, NULL),
(85, 7, 'عرض', NULL, NULL),
(86, 7, 'حذف', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_sections`
--

CREATE TABLE `permission_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_sections`
--

INSERT INTO `permission_sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'المشرفين', NULL, NULL),
(2, 'المستخدمين', NULL, NULL),
(3, 'المندوبين', NULL, NULL),
(4, 'المطاعم', NULL, NULL),
(5, 'رسائل التواصل', NULL, NULL),
(6, 'الاعدادات', NULL, NULL),
(7, 'المساعدة والدعم', NULL, NULL),
(11, 'الطلبات', NULL, NULL),
(12, 'الاشعارات', NULL, NULL),
(14, 'المنتجات', NULL, NULL),
(15, 'احصائيات الرئيسية', NULL, NULL),
(17, 'الاقسام', NULL, NULL),
(18, 'اقسام الاضافات', NULL, NULL),
(19, 'الاضافات', NULL, NULL),
(20, 'صور العرض', NULL, NULL),
(21, 'الكوبونات', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_token`
--

CREATE TABLE `phone_token` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('ios','android') DEFAULT 'android',
  `phone_token` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_token`
--

INSERT INTO `phone_token` (`id`, `user_id`, `market_id`, `delivery_id`, `type`, `phone_token`, `created_at`, `updated_at`) VALUES
(125, 2, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(126, 3, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(127, 4, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(128, 5, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(129, 6, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(130, 7, NULL, NULL, 'android', '11', '2023-04-24', '2023-04-24'),
(135, NULL, 2, NULL, 'android', '12344444444444444', '2023-04-29', '2023-04-29'),
(136, NULL, 1, NULL, 'android', '12344444444444444', '2023-04-29', '2023-04-29'),
(137, 6, NULL, NULL, 'android', '12344444444444444', '2023-04-30', '2023-04-30'),
(138, NULL, NULL, 1, 'android', '11', '2023-05-01', '2023-05-01'),
(140, NULL, NULL, 1, 'android', '12344444444444444', '2023-05-01', '2023-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `description_ar` varchar(191) DEFAULT NULL,
  `description_en` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `has_offer` enum('yes','no') NOT NULL DEFAULT 'no',
  `offer_type` enum('value','percentage') NOT NULL DEFAULT 'value',
  `value` double NOT NULL DEFAULT 0,
  `percentage` double NOT NULL DEFAULT 0,
  `old_price` double NOT NULL DEFAULT 0,
  `price` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `market_id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `image`, `has_offer`, `offer_type`, `value`, `percentage`, `old_price`, `price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'شاورما', 'shawerma', 'شاورما جيدة', 'shawerma desc', 'uploads/user/20541682350021.png', 'yes', 'value', 10, 0, 100, 90, NULL, NULL, NULL),
(2, 1, 2, 'شاورما2', 'shawerma2', 'شاورما جيدة', 'shawerma desc', 'uploads/user/20541682350021.png', 'yes', 'value', 10, 0, 100, 90, NULL, NULL, NULL),
(3, 2, 1, 'شاورما3', 'shawerma3', 'شاورما جيدة', 'shawerma desc', 'uploads/user/20541682350021.png', 'no', 'value', 10, 0, 100, 90, NULL, NULL, NULL),
(4, 1, 2, 'Ahmed Samir', 'Ahmed Samir en', 'تيست', 'تيستتتتت', 'uploads/product/24481684417818.png', 'no', 'percentage', 15, 10, 150, 135, NULL, '2023-05-18 10:50:18', '2023-05-18 13:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_rate` double NOT NULL DEFAULT 0,
  `delivery_rate` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `order_id`, `market_rate`, `delivery_rate`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 4, NULL, '2023-04-30 14:43:00', '2023-04-30 14:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `fav_icon` varchar(191) DEFAULT NULL,
  `whatsapp` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `privacy` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `points` double DEFAULT 1,
  `wallet_per_points` double DEFAULT 1,
  `delivery_order_points` double NOT NULL DEFAULT 0,
  `delivery_points` double NOT NULL DEFAULT 0,
  `delivery_wallet` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `fav_icon`, `whatsapp`, `phone`, `privacy`, `about`, `terms`, `points`, `wallet_per_points`, `delivery_order_points`, `delivery_points`, `delivery_wallet`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/setting/22091684498800.png', 'uploads/setting/55371684498800.png', 'http://whatsapp.com', '+201004834728', '<pre>\r\nسياسة و خصوصية <span style=\"color:#e74c3c\">جيتكوم\r\n1 .\r\n2.</span>\r\n</pre>\r\n\r\n<p><span style=\"color:#e74c3c\">3.</span></p>\r\n\r\n<div id=\"gtx-trans\" style=\"left:1074px; position:absolute; top:15.0208px\">\r\n<div class=\"gtx-trans-icon\">&nbsp;</div>\r\n</div>', '<pre>\r\nمعلومات عن <span style=\"color:#e74c3c\">جيتكوم</span>\r\n</pre>\r\n\r\n<pre>\r\n<span style=\"color:#e74c3c\">1 .\r\n2.</span>\r\n</pre>\r\n\r\n<p><span style=\"color:#e74c3c\">3.</span></p>', '<pre>\r\nشروط واحكام <span style=\"color:#e74c3c\">جيتكوم</span>\r\n</pre>\r\n\r\n<pre>\r\n<span style=\"color:#e74c3c\">1 .\r\n2.</span>\r\n</pre>\r\n\r\n<p><span style=\"color:#e74c3c\">3.</span></p>', 10, 3, 2, 100, 10, NULL, NULL, '2023-05-19 09:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('product','market') NOT NULL DEFAULT 'product',
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `type`, `market_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'market', 1, NULL, NULL, NULL),
(2, 'product', NULL, 1, NULL, NULL),
(3, 'market', 2, NULL, NULL, NULL),
(4, 'product', NULL, 2, NULL, NULL),
(5, 'product', NULL, 3, NULL, NULL),
(7, 'product', NULL, 1, '2023-05-15 14:46:10', '2023-05-15 14:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `title2` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `title`, `title2`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'uploads/support/19571682891924.jpg', 'test', NULL, '2023-04-30 18:58:44', '2023-04-30 18:58:44'),
(2, 'test', 'test', 'uploads/support/88821682891955.jpg', 'test', NULL, '2023-04-30 18:59:15', '2023-04-30 18:59:15'),
(3, 'test', 'test', 'uploads/support/63371682891973.jpg', 'test', NULL, '2023-04-30 18:59:33', '2023-04-30 18:59:33'),
(4, 'test', 'test', 'uploads/support/15581682891987.jpg', 'test', NULL, '2023-04-30 18:59:47', '2023-04-30 18:59:47'),
(5, 'test', 'test', 'uploads/support/64381682892029.jpg', 'test', NULL, '2023-04-30 19:00:29', '2023-04-30 19:00:29'),
(6, 'test', 'test', 'uploads/support/39671682892063.jpg', 'test', NULL, '2023-04-30 19:01:03', '2023-04-30 19:01:03'),
(7, 'test', 'test', 'uploads/support/38491682892076.jpg', 'test', NULL, '2023-04-30 19:01:16', '2023-04-30 19:01:16'),
(8, 'test', 'test', 'uploads/support/27121682892082.jpg', 'test', NULL, '2023-04-30 19:01:22', '2023-04-30 19:01:22'),
(9, 'test', 'test', 'uploads/support/20631682892113.jpg', 'test', NULL, '2023-04-30 19:01:53', '2023-04-30 19:01:53'),
(10, 'test', 'test', 'uploads/support/7811682892192.jpg', 'test', NULL, '2023-04-30 19:03:12', '2023-04-30 19:03:12'),
(11, 'test', 'test', 'uploads/support/11231682892213.jpg', 'test', NULL, '2023-04-30 19:03:33', '2023-04-30 19:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `support_products`
--

CREATE TABLE `support_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_products`
--

INSERT INTO `support_products` (`id`, `support_id`, `product_id`, `amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 1, NULL, '2023-04-30 19:03:12', '2023-04-30 19:03:12'),
(2, 11, 1, 1, NULL, '2023-04-30 19:03:33', '2023-04-30 19:03:33'),
(3, 11, 2, 2, NULL, '2023-04-30 19:03:33', '2023-04-30 19:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(191) DEFAULT NULL,
  `l_name` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `block` enum('yes','no') NOT NULL DEFAULT 'no',
  `notification` enum('yes','no') NOT NULL DEFAULT 'yes',
  `points` double NOT NULL DEFAULT 0,
  `wallet` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `phone`, `image`, `password`, `code`, `block`, `notification`, `points`, `wallet`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'ahmed', 'samir', '01004834728', 'uploads/user/19141682457678.png', '$2y$10$/oq66plqf5ou2eU4L6ZdVu7oCcIWq7QEIsOgJsMkTTuOlN/ZKK4EC', NULL, 'no', 'yes', 16, 150, NULL, '2023-04-24 12:56:56', '2023-05-01 16:52:10'),
(7, 'ahmed', 'samir', '010048347281', NULL, '$2y$10$fBJxdo.Cyx9xH19kLa2b3O5cJ9q.eXOqUvjl9ILnfRgHaEbhQMxZa', NULL, 'no', 'yes', 0, 0, NULL, '2023-04-24 12:57:19', '2023-04-24 12:57:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additions`
--
ALTER TABLE `additions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additions_addition_category_id_foreign` (`addition_category_id`);

--
-- Indexes for table `addition_categories`
--
ALTER TABLE `addition_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addition_products`
--
ALTER TABLE `addition_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addition_products_addition_id_foreign` (`addition_id`),
  ADD KEY `addition_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_Per_per` (`permission_id`),
  ADD KEY `ad_per_admin_ID16` (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_additions`
--
ALTER TABLE `cart_additions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_cart_id` (`cart_id`),
  ADD KEY `cart_addition_id` (`addition_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_users`
--
ALTER TABLE `coupon_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_users_user_id_foreign` (`user_id`),
  ADD KEY `coupon_users_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourates`
--
ALTER TABLE `favourates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourates_user_id_foreign` (`user_id`),
  ADD KEY `favourates_product_id_foreign` (`product_id`),
  ADD KEY `favourates_market_id_foreign` (`market_id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `market_categories_market_id_foreign` (`market_id`),
  ADD KEY `market_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_delivery_id_foreign` (`delivery_id`),
  ADD KEY `notifications_market_id_foreign` (`market_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`),
  ADD KEY `orders_market_id_foreign` (`market_id`),
  ADD KEY `orders_delivery_id_foreign` (`delivery_id`),
  ADD KEY `orders_copon_id_foreign` (`coupon_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_details_additions`
--
ALTER TABLE `order_details_additions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_additions_details_id_foreign` (`details_id`),
  ADD KEY `order_details_additions_addition_id_foreign` (`addition_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `per_sec_id` (`section_id`);

--
-- Indexes for table `permission_sections`
--
ALTER TABLE `permission_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_token`
--
ALTER TABLE `phone_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client45494_id` (`user_id`),
  ADD KEY `school_id64` (`delivery_id`),
  ADD KEY `token_market_id_fk` (`market_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_market_id_foreign` (`market_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_order_id_foreign` (`order_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slider_market_id_fk` (`market_id`),
  ADD KEY `slider_product_id_fk` (`product_id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_products`
--
ALTER TABLE `support_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_products_support_id_foreign` (`support_id`),
  ADD KEY `support_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additions`
--
ALTER TABLE `additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `addition_categories`
--
ALTER TABLE `addition_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addition_products`
--
ALTER TABLE `addition_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_additions`
--
ALTER TABLE `cart_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupon_users`
--
ALTER TABLE `coupon_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourates`
--
ALTER TABLE `favourates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `market_categories`
--
ALTER TABLE `market_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details_additions`
--
ALTER TABLE `order_details_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `permission_sections`
--
ALTER TABLE `permission_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_token`
--
ALTER TABLE `phone_token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `support_products`
--
ALTER TABLE `support_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additions`
--
ALTER TABLE `additions`
  ADD CONSTRAINT `additions_addition_category_id_foreign` FOREIGN KEY (`addition_category_id`) REFERENCES `addition_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `addition_products`
--
ALTER TABLE `addition_products`
  ADD CONSTRAINT `addition_products_addition_id_foreign` FOREIGN KEY (`addition_id`) REFERENCES `additions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addition_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD CONSTRAINT `ad_Per_per` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ad_per_admin_ID16` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_additions`
--
ALTER TABLE `cart_additions`
  ADD CONSTRAINT `cart_addition_id` FOREIGN KEY (`addition_id`) REFERENCES `additions` (`id`),
  ADD CONSTRAINT `cart_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_users`
--
ALTER TABLE `coupon_users`
  ADD CONSTRAINT `coupon_users_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourates`
--
ALTER TABLE `favourates`
  ADD CONSTRAINT `favourates_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourates_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD CONSTRAINT `market_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `market_categories_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_copon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`),
  ADD CONSTRAINT `orders_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details_additions`
--
ALTER TABLE `order_details_additions`
  ADD CONSTRAINT `order_details_additions_addition_id_foreign` FOREIGN KEY (`addition_id`) REFERENCES `additions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_additions_details_id_foreign` FOREIGN KEY (`details_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `per_sec_id` FOREIGN KEY (`section_id`) REFERENCES `permission_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phone_token`
--
ALTER TABLE `phone_token`
  ADD CONSTRAINT `token_delivery_id_fk` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `token_market_id_fk` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`),
  ADD CONSTRAINT `token_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `slider_market_id_fk` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `slider_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_products`
--
ALTER TABLE `support_products`
  ADD CONSTRAINT `support_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `support_products_support_id_foreign` FOREIGN KEY (`support_id`) REFERENCES `supports` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
