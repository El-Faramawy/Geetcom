-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2023 at 11:37 PM
-- Server version: 5.7.34
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geetcom3_geetcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `additions`
--

CREATE TABLE `additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addition_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
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
(6, 3, 'قطعة لحم', 'قطعة لحم', 10, NULL, '2023-05-27 21:03:46', '2023-05-27 21:03:46'),
(7, 3, '200 جم لحم', '200 جم لحم', 19, NULL, '2023-05-28 11:39:29', '2023-05-28 11:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `addition_categories`
--

CREATE TABLE `addition_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choise` enum('one','multiple') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'multiple',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addition_categories`
--

INSERT INTO `addition_categories` (`id`, `name_ar`, `name_en`, `choise`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'سلطات', 'salad', 'multiple', NULL, NULL, NULL),
(2, 'فواكه', 'fruit', 'one', NULL, NULL, NULL),
(3, 'لحم اضافي', 'لحم اضافي', 'one', NULL, '2023-05-27 21:02:38', '2023-05-28 11:39:02');

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
(3, 3, 1, NULL, NULL, NULL),
(4, 3, 2, NULL, NULL, NULL),
(5, 2, 1, NULL, NULL, NULL),
(6, 2, 3, NULL, NULL, NULL),
(12, 1, 1, NULL, '2023-05-20 11:42:35', '2023-05-20 11:42:35'),
(13, 1, 2, NULL, '2023-05-20 11:42:35', '2023-05-20 11:42:35'),
(14, 1, 4, NULL, '2023-05-20 11:42:35', '2023-05-20 11:42:35'),
(15, 1, 3, NULL, '2023-05-20 11:42:35', '2023-05-20 11:42:35'),
(37, 6, 10, NULL, '2023-05-28 11:06:21', '2023-05-28 11:06:21'),
(38, 7, 10, NULL, '2023-05-28 11:39:29', '2023-05-28 11:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `recipient_name`, `recipient_number`, `address`, `latitude`, `longitude`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'home', 'hamada', '01004834728', 'egypt', 123, 456, NULL, '2023-04-26 14:22:16', '2023-04-26 14:22:16'),
(4, 6, 'home 2', 'hamada', '01004834728', 'egypt', 123, 456, NULL, '2023-05-20 17:05:35', '2023-05-20 17:05:35'),
(6, 6, 'home 3', 'hamada', '01004834728', 'egypt', 123, 456, NULL, '2023-05-20 17:16:14', '2023-05-20 17:16:14'),
(7, 6, 'home 3', 'hamada', '01004834728', 'egypt', 123, 456, NULL, '2023-05-20 17:17:27', '2023-05-20 17:17:27'),
(8, 8, 'المنزل', 'te', 'te', 'te', 37.4217777, -122.0838229, NULL, '2023-05-20 17:18:42', '2023-05-20 17:18:42'),
(9, 12, 'المنزل', 'Ahmed', '966546349264', 'البيت', 24.7231772, 46.828765, NULL, '2023-05-23 10:37:20', '2023-05-23 10:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_reset` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `phone`, `email_verified_at`, `password_reset`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed', 'admin@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$i0huNlCfHPAIMnNfFpjvJeoMxBS2jclqfV/vcUJBzsSbenqPcQgGy', NULL, NULL, '2023-05-22 06:31:21'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `amount`, `created_at`, `updated_at`) VALUES
(7, 10, 1, 1, '2023-05-22 05:05:37', '2023-05-22 07:21:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_additions`
--

INSERT INTO `cart_additions` (`id`, `cart_id`, `addition_id`, `created_at`, `updated_at`) VALUES
(53, 7, 1, '2023-05-22 07:21:28', '2023-05-22 07:21:28'),
(54, 7, 3, '2023-05-22 07:21:28', '2023-05-22 07:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name_ar`, `name_en`, `featured`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/Category/6221684744664.png', 'برجر', 'برجر', 'yes', NULL, NULL, '2023-05-22 06:09:42'),
(2, 'uploads/Category/16161684744685.png', 'حلويات', 'حلويات', 'yes', NULL, NULL, '2023-05-22 05:38:05'),
(3, 'uploads/Category/64141684744641.png', 'فطائر', 'فطائر', 'yes', NULL, '2023-05-18 17:26:02', '2023-05-22 06:09:27'),
(4, 'uploads/Category/52531684744620.png', 'البيتزا', 'البيتزا', 'yes', NULL, '2023-05-21 07:08:27', '2023-05-22 06:09:15'),
(5, 'uploads/Category/75061684746612.png', 'مكرونات', 'مكرونات', 'yes', NULL, '2023-05-22 06:10:12', '2023-05-22 06:10:12'),
(6, 'uploads/Category/37881684746641.png', 'جاهزة', 'جاهزة', 'yes', NULL, '2023-05-22 06:10:41', '2023-05-22 06:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_from` enum('user','admin') NOT NULL DEFAULT 'admin',
  `message` varchar(500) DEFAULT NULL,
  `is_read` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `message_from`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 6, 'user', 'test messgae', 1, '2023-04-28 16:21:10', '2023-05-28 17:34:19'),
(2, 6, 'admin', 'test messgae', 1, '2023-04-28 16:21:51', '2023-05-28 17:34:19'),
(3, 6, 'user', 'test messgae', 1, '2023-04-28 16:22:36', '2023-05-28 17:34:19'),
(4, 6, 'admin', 'ahmed samir', 1, '2023-05-28 17:33:10', '2023-05-28 17:34:19'),
(5, 6, 'admin', 'test', 0, '2023-05-28 17:34:27', '2023-05-28 17:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
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
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('value','percentage') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'value',
  `coupon_on` enum('purchases','points') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'purchases',
  `value` double DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `min_price` double DEFAULT NULL,
  `max_price` double DEFAULT NULL,
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
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
(3, '123445', 'percentage', 'purchases', NULL, 10, NULL, 100, 'yes', NULL, '2023-05-18 16:54:14', '2023-05-18 17:04:20'),
(5, 'Hamza', 'percentage', 'purchases', NULL, 20, NULL, 100, 'yes', NULL, '2023-05-20 17:29:04', '2023-05-20 17:29:04'),
(6, '123456', 'value', 'purchases', 10, NULL, 100, NULL, 'yes', NULL, '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(7, '123456', 'value', 'purchases', 10, NULL, 100, NULL, 'yes', NULL, '2023-05-20 17:33:58', '2023-05-20 17:33:58'),
(8, '123456', 'value', 'purchases', 10, NULL, 100, NULL, 'yes', NULL, '2023-05-20 17:37:39', '2023-05-20 17:37:39'),
(9, '12344', 'value', 'purchases', 10, NULL, 100, NULL, 'yes', NULL, '2023-05-21 07:10:00', '2023-05-21 07:10:00'),
(10, 'GEETCOM', 'percentage', 'purchases', NULL, 20, NULL, 100, 'yes', NULL, '2023-05-22 05:47:32', '2023-05-22 05:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_users`
--

CREATE TABLE `coupon_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_paid` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_users`
--

INSERT INTO `coupon_users` (`id`, `user_id`, `coupon_id`, `is_paid`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'yes', NULL, '2023-04-28 18:21:57'),
(2, 6, 2, 'no', NULL, '2023-04-30 12:20:43'),
(5, 6, 3, 'no', '2023-05-18 17:06:15', '2023-05-18 17:06:15'),
(7, 8, 5, 'yes', '2023-05-20 17:29:04', '2023-05-20 19:40:42'),
(8, 6, 6, 'no', '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(9, 7, 6, 'no', '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(10, 8, 6, 'no', '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(11, 6, 7, 'no', '2023-05-20 17:33:58', '2023-05-20 17:33:58'),
(12, 7, 7, 'no', '2023-05-20 17:33:58', '2023-05-20 17:33:58'),
(13, 8, 5, 'yes', '2023-05-20 17:33:58', '2023-05-20 19:40:42'),
(14, 6, 8, 'no', '2023-05-20 17:37:39', '2023-05-20 17:37:39'),
(15, 7, 8, 'no', '2023-05-20 17:37:39', '2023-05-20 17:37:39'),
(16, 8, 1, 'yes', '2023-05-20 17:37:40', '2023-05-20 18:06:43'),
(17, 6, 9, 'no', '2023-05-21 07:10:00', '2023-05-21 07:10:00'),
(18, 7, 9, 'no', '2023-05-21 07:10:00', '2023-05-21 07:10:00'),
(19, 8, 9, 'no', '2023-05-21 07:10:00', '2023-05-21 07:10:00'),
(20, 6, 10, 'no', '2023-05-22 05:47:32', '2023-05-22 05:47:32'),
(21, 7, 10, 'no', '2023-05-22 05:47:32', '2023-05-22 05:47:32'),
(22, 8, 10, 'no', '2023-05-22 05:47:32', '2023-05-22 05:47:32'),
(23, 9, 10, 'no', '2023-05-22 05:47:32', '2023-05-22 05:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `notification` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `points` double NOT NULL DEFAULT '0',
  `wallet` double NOT NULL DEFAULT '0',
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `latitude` double DEFAULT '0',
  `longitude` double DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `f_name`, `l_name`, `phone`, `image`, `password`, `code`, `block`, `notification`, `points`, `wallet`, `is_available`, `latitude`, `longitude`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', 'delivery', '01004834728', 'uploads/delivery/951682966310.png', '$2y$10$gd93wwf.dcYstkifAsT9Ju6zWQnzBA7MQ5XRW5RfEmyqh7zBgoqAG', NULL, 'no', 'yes', 400, 200, 'yes', 37.4217777, -122.0838229, NULL, '2023-05-01 15:33:03', '2023-05-21 18:02:56'),
(2, 'Hamza', 'Mahmoud', '01551330024', 'uploads/delivery/79151684678299.png', '$2y$10$.oMxs4MOgr0RqasFUDzBZ.wBUGEx6ltJAOtyCKMOzORMiGcV9JZdi', NULL, 'no', 'yes', 99799, 20, 'no', 24.7231772, 46.828765, NULL, '2023-05-21 10:15:38', '2023-05-27 09:06:02'),
(3, 'ahmed', 'Ahmed', '966546349264', NULL, '$2y$10$gRINrna1xetycMIUrJnitujq7E8pmvUGAYUDLP85.mQ6pwAAu7Vzu', NULL, 'no', 'yes', 4, 0, 'no', 0, 0, NULL, '2023-05-23 13:23:30', '2023-05-28 00:12:34');

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
(6, 6, NULL, 1, NULL, '2023-05-20 10:46:44', '2023-05-20 10:46:44'),
(8, 6, 1, NULL, NULL, '2023-05-20 10:47:11', '2023-05-20 10:47:11'),
(24, 8, NULL, 7, NULL, '2023-05-20 13:26:45', '2023-05-20 13:26:45'),
(36, 8, 2, NULL, NULL, '2023-05-21 03:05:45', '2023-05-21 03:05:45'),
(37, 12, NULL, 1, NULL, '2023-05-24 13:37:08', '2023-05-24 13:37:08'),
(38, 12, NULL, 2, NULL, '2023-05-24 13:37:30', '2023-05-24 13:37:30'),
(39, 12, 4, NULL, NULL, '2023-05-24 13:37:56', '2023-05-24 13:37:56'),
(40, 12, 5, NULL, NULL, '2023-05-25 13:16:43', '2023-05-25 13:16:43'),
(41, 12, 7, NULL, NULL, '2023-05-25 13:16:59', '2023-05-25 13:16:59'),
(42, 12, 8, NULL, NULL, '2023-05-25 13:17:09', '2023-05-25 13:17:09'),
(44, 12, 3, NULL, NULL, '2023-05-25 13:17:29', '2023-05-25 13:17:29'),
(45, 12, 6, NULL, NULL, '2023-05-25 13:17:35', '2023-05-25 13:17:35'),
(47, 12, NULL, 12, NULL, '2023-05-25 13:17:52', '2023-05-25 13:17:52'),
(48, 8, NULL, 2, NULL, '2023-05-28 12:34:25', '2023-05-28 12:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `rating` double NOT NULL DEFAULT '0',
  `block` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `latitude` double DEFAULT '0',
  `longitude` double DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `name_ar`, `name_en`, `user_name`, `location_ar`, `location_en`, `phone`, `image`, `panner`, `password`, `code`, `min_from`, `min_to`, `price`, `rating`, `block`, `is_available`, `latitude`, `longitude`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'كنتاكي', 'كنتاكي', 'market1', 'قرطبة', 'قرطبة', '0546349264', 'uploads/Market/35311684744866.png', 'uploads/Market/8611684744224.png', NULL, NULL, '10', '40', 100, 0, 'no', 'yes', 24.67866608584229, 46.688346250215204, NULL, '2023-05-01 13:06:35', '2023-05-22 07:52:15'),
(2, 'ماكدونالدز', 'ماكدونالدز', 'market2', 'السعودية المربع', 'السعودية المربع', '0546349264', 'uploads/Market/10291684744414.png', 'uploads/Market/13431684744414.png', '$2y$10$ZzxO2BI7LnoE7qERSflTseUIFOA4kXl4z9uMvYU9Ld0gSVmR4BpCu', NULL, '10', '40', 100, 0, 'no', 'yes', 0, 0, NULL, '2023-05-01 13:06:41', '2023-05-23 10:53:13'),
(3, 'مطعم اسماك', 'fish food', 'fish', 'test', 'test', '01004834728', '$2y$10$CFlWKbddsjgCxOuVg2CY4uotcvYx0J.k1e.ST2PgxuD.y/C2nuLLO', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', 0, 0, '2023-05-15 13:44:34', '2023-05-15 11:09:05', '2023-05-15 13:44:34'),
(4, 'مطعم اسماك', 'fish food', 'fishes', 'test', 'test', '01004834728', '$2y$10$x3ze/UhJgGVlNLGXrsAUReFCiJekkGjlEQ2LHOzP.T40Hk43TV2Em', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', 0, 0, '2023-05-15 13:38:04', '2023-05-15 11:09:33', '2023-05-15 13:38:04'),
(5, 'مطعم اسماك', 'fish food', 'fishes2', 'test', 'test', '01004834728', '$2y$10$tDVPUbFUsSKv89EgAU9Br.VYTAdirt56SLDUngFqrxmg9gTg1HJ12', NULL, '123456', NULL, '20', '45', 100, 0, 'no', 'no', 0, 0, '2023-05-15 13:44:34', '2023-05-15 11:10:21', '2023-05-15 13:44:34'),
(7, 'مطعم البيك', 'مطعم البيك', 'red6', 'الياسمين', 'الملز', '0546349264', 'uploads/Market/4161684744089.png', 'uploads/Market/77041684744089.png', NULL, NULL, '15', '20', 20, 0, 'no', 'yes', 24.678660624396507, 46.68879593710745, NULL, '2023-05-15 13:31:20', '2023-05-22 06:39:01'),
(8, 'Rooney Clay', 'Adele Oneill', 'res4', 'السعودية الرياض', 'السعودية الرياض', '16757236072', 'uploads/Market/25341684753767.png', 'uploads/Market/88381684753660.png', NULL, NULL, '1', '2', 587, 0, 'no', 'yes', 0, 0, NULL, '2023-05-15 14:00:18', '2023-05-22 08:09:27'),
(9, 'السعودي', 'السعودي', 'hamza', 'ا', 'المدينة 1', '0546349264', 'uploads/Market/82281684743841.png', 'uploads/Market/85631684743841.png', NULL, NULL, '15', '30', 50, 0, 'no', 'yes', 0, 0, NULL, '2023-05-21 04:50:48', '2023-05-22 06:36:57'),
(10, 'August Morales', 'Jade Hayden', 'mudakun', 'Veritatis rem verita', 'Dolore eligendi sint', '+1 (133) 574-8052', NULL, NULL, '$2y$10$Szjwh8UlKIQrKtozad3nY.JoaA20rt6DyaD73hyaj2QAlx2IjIKoW', NULL, 'Ut optio officia od', 'Tempor itaque laboru', 871, 0, 'no', 'yes', 0, 0, '2023-05-21 17:40:57', '2023-05-21 17:40:46', '2023-05-21 17:40:57'),
(11, 'السعودي', 'السعودي', 'res2', 'السعودية الرياض', 'السعودية الرياض', '201551330024', 'uploads/Market/69551684743801.png', 'uploads/Market/47851684743801.png', NULL, NULL, '15', '30', 10, 0, 'no', 'yes', 24.69430871119157, 46.718670470114034, '2023-05-22 06:20:34', '2023-05-22 03:11:24', '2023-05-22 06:20:34'),
(12, 'هاف مليون', 'هاف مليون', 'res1', 'السعودية الرياض 1', 'السعودية الرياض 1', '0546349264', 'uploads/Market/40501684743767.png', 'uploads/Market/19031684743767.png', NULL, NULL, '15', '30', 22, 0, 'no', 'yes', 24.678737284643955, 46.68875925558055, NULL, '2023-05-22 03:19:45', '2023-05-22 06:38:04'),
(13, 'بيت الشاورما', 'بيت الشاورما', 'shaorma', 'السعودية', 'السعودية', '0568267433', '$2y$10$3.0ZKcbQhI5tXtpSv0z/EuCQKHhm5aop3GvI8MsCkaEJ.fXmR7f/i', 'uploads/Market/53381684744519.png', NULL, NULL, '15', '30', 10, 0, 'no', 'yes', NULL, NULL, NULL, '2023-05-22 05:35:20', '2023-05-22 07:50:56'),
(14, 'كيان', 'cian', 'admin', 'الرياض', 'Ryhid', '0546349264', '$2y$10$UVXDMgDPVB9bNvCtCqZ7yeVbJ95yhN8w5H4EDIUh0ehLgM23qxorq', NULL, '123456', NULL, '15', '30', 100, 0, 'no', 'yes', NULL, NULL, NULL, '2023-05-22 06:35:24', '2023-05-22 06:54:37');

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
(5, 5, 1, NULL, '2023-05-15 11:10:21', '2023-05-15 11:10:21'),
(6, 5, 2, NULL, '2023-05-15 11:10:22', '2023-05-15 11:10:22'),
(21, 10, 2, NULL, '2023-05-21 17:40:46', '2023-05-21 17:40:46'),
(22, 10, 3, NULL, '2023-05-21 17:40:46', '2023-05-21 17:40:46'),
(50, 11, 3, NULL, '2023-05-22 06:14:09', '2023-05-22 06:14:09'),
(74, 1, 1, NULL, '2023-05-22 07:52:15', '2023-05-22 07:52:15'),
(76, 12, 4, NULL, '2023-05-22 08:05:16', '2023-05-22 08:05:16'),
(78, 8, 2, NULL, '2023-05-22 08:09:28', '2023-05-22 08:09:28'),
(79, 2, 1, NULL, '2023-05-23 10:45:32', '2023-05-23 10:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `market_sub_category`
--

CREATE TABLE `market_sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `type` enum('notification','offer','reward') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'notification',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `delivery_id`, `market_id`, `type`, `title`, `message`, `image`, `is_read`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, NULL, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-05-20 10:06:14'),
(2, 6, NULL, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-05-20 10:06:14'),
(4, NULL, 1, NULL, 'notification', 'test', 'test2', NULL, 1, NULL, NULL, '2023-05-21 09:14:16'),
(5, NULL, 1, NULL, 'reward', 'test', 'test2', NULL, 1, NULL, '2023-04-27 20:04:54', '2023-04-27 20:04:54'),
(6, 6, NULL, NULL, 'notification', 'تم الرد على رسالتك', 'teeeeeeeeest', NULL, 1, NULL, '2023-05-19 14:59:47', '2023-05-20 10:06:14'),
(7, 8, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 1, NULL, '2023-05-20 17:28:28', '2023-05-23 19:43:43'),
(8, 8, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 1, NULL, '2023-05-20 17:29:04', '2023-05-23 19:43:43'),
(9, 6, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 0, NULL, '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(10, 7, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 0, NULL, '2023-05-20 17:33:47', '2023-05-20 17:33:47'),
(11, 8, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 1, NULL, '2023-05-20 17:33:47', '2023-05-23 19:43:43'),
(12, 6, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 0, NULL, '2023-05-20 17:33:58', '2023-05-20 17:33:58'),
(13, 7, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 0, NULL, '2023-05-20 17:33:58', '2023-05-20 17:33:58'),
(14, 8, NULL, NULL, 'notification', 'كوبون جديد', ' مشتريات تم اضافة كوبون ', NULL, 1, NULL, '2023-05-20 17:33:58', '2023-05-23 19:43:43'),
(15, NULL, NULL, 1, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-20 19:27:18', '2023-05-20 19:27:18'),
(16, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 10:39:27', '2023-05-28 00:11:13'),
(17, 12, NULL, NULL, 'notification', 'تم تغيير حالة الطلب', 'جديدالى  1تم تغيير حالة الطلب رقم ', NULL, 1, NULL, '2023-05-23 10:49:00', '2023-05-24 13:36:47'),
(18, NULL, NULL, 2, 'notification', 'تم تغيير حالة الطلب', 'جديدالى  1تم تغيير حالة الطلب رقم ', NULL, 1, NULL, '2023-05-23 10:49:02', '2023-05-28 00:11:13'),
(19, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 13:18:33', '2023-05-28 00:11:13'),
(20, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 13:53:53', '2023-05-28 00:11:13'),
(21, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 15:45:21', '2023-05-28 00:11:13'),
(22, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 16:06:22', '2023-05-28 00:11:13'),
(23, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-23 19:46:24', '2023-05-28 00:11:13'),
(24, NULL, NULL, 1, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-25 13:23:33', '2023-05-25 13:23:33'),
(25, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-26 12:30:41', '2023-05-28 00:11:13'),
(26, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 1, NULL, '2023-05-26 12:50:38', '2023-05-28 00:11:13'),
(27, 12, NULL, NULL, 'notification', 'تم قبول الطلب من المتجر', 'تم قبول الطلب من المتجر', NULL, 0, NULL, '2023-05-27 11:48:37', '2023-05-27 11:48:37'),
(28, NULL, 2, NULL, 'notification', 'تم قبول الطلب من المتجر', 'تم قبول الطلب من المتجر', NULL, 0, NULL, '2023-05-27 13:18:16', '2023-05-27 13:18:16'),
(29, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 11:54:08', '2023-05-28 11:54:08'),
(30, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 11:57:40', '2023-05-28 11:57:40'),
(31, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 12:18:07', '2023-05-28 12:18:07'),
(32, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 13:36:05', '2023-05-28 13:36:05'),
(33, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 13:36:31', '2023-05-28 13:36:31'),
(34, NULL, NULL, 1, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(35, NULL, NULL, 1, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(36, NULL, NULL, 1, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(37, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 14:49:46', '2023-05-28 14:49:46'),
(38, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 15:02:06', '2023-05-28 15:02:06'),
(39, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 15:04:08', '2023-05-28 15:04:08'),
(40, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 15:05:07', '2023-05-28 15:05:07'),
(41, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 15:38:17', '2023-05-28 15:38:17'),
(42, 8, NULL, NULL, 'notification', 'تم الغاء الطلب ', 'تم الغاء الطلب من المتجر', NULL, 0, NULL, '2023-05-28 16:23:17', '2023-05-28 16:23:17'),
(43, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 16:24:08', '2023-05-28 16:24:08'),
(44, NULL, NULL, 2, 'notification', 'لديك طلب جديد', 'لديك طلب جديد', NULL, 0, NULL, '2023-05-28 16:28:39', '2023-05-28 16:28:39'),
(45, 8, NULL, NULL, 'notification', 'تم قبول طلبك', 'تم قبول طلبك من المطعم', NULL, 0, NULL, '2023-05-28 16:30:01', '2023-05-28 16:30:01');

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
  `status` enum('not_paid','new','accepted','in_market_way','wait_order','delivery','ended','canceled_from_market','canceled_from_delivery','canceled_from_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `pay_type` enum('wallet','online') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'online',
  `wallet_pay` double NOT NULL DEFAULT '0',
  `online_pay` double NOT NULL DEFAULT '0',
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted_time` time DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `delivery_price` double DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `market_id`, `delivery_id`, `coupon_id`, `status`, `from`, `to`, `total`, `pay_type`, `wallet_pay`, `online_pay`, `notes`, `accepted_time`, `delivery_time`, `delivery_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 12, 9, 2, 3, NULL, 'ended', '16:31:35', '17:01:35', 113.5, 'wallet', 0, 113.5, NULL, '16:21:35', NULL, NULL, NULL, '2023-05-23 10:39:27', '2023-05-23 13:28:18'),
(2, 12, 9, 2, 3, NULL, 'canceled_from_market', NULL, NULL, 217, 'wallet', 0, 217, NULL, NULL, NULL, NULL, NULL, '2023-05-23 13:18:33', '2023-05-23 16:02:37'),
(3, 12, 9, 2, NULL, NULL, 'canceled_from_market', '19:11:28', '19:41:28', 113.5, 'wallet', 0, 113.5, NULL, '19:01:28', NULL, NULL, NULL, '2023-05-23 13:53:53', '2023-05-23 16:02:45'),
(4, 12, 9, 2, NULL, NULL, 'canceled_from_market', '19:09:56', '19:39:56', 217, 'wallet', 0, 217, NULL, '18:59:56', NULL, NULL, NULL, '2023-05-23 15:45:21', '2023-05-23 16:02:49'),
(5, 12, 9, 2, NULL, NULL, 'accepted', '18:30:57', '19:00:57', 237.7, 'wallet', 0, 237.7, NULL, '18:20:57', NULL, NULL, NULL, '2023-05-23 16:06:22', '2023-05-28 15:20:57'),
(6, 8, 8, 2, NULL, NULL, 'not_paid', NULL, NULL, 493, 'wallet', 20, 473, NULL, NULL, NULL, NULL, NULL, '2023-05-23 19:46:24', '2023-05-23 19:46:24'),
(7, 12, 9, 1, NULL, NULL, 'not_paid', NULL, NULL, 21.5, 'wallet', 0, 21.5, NULL, NULL, NULL, NULL, NULL, '2023-05-25 13:23:32', '2023-05-25 13:23:32'),
(8, 8, 8, 2, NULL, NULL, 'not_paid', NULL, NULL, 38449.3, 'wallet', 20, 38429.3, NULL, NULL, NULL, NULL, NULL, '2023-05-26 12:30:41', '2023-05-26 12:30:41'),
(9, 8, 8, 2, 1, 3, 'accepted', NULL, NULL, 38449.3, 'online', 0, 38449.3, NULL, NULL, NULL, 5, NULL, '2023-05-26 12:50:38', '2023-05-26 12:53:29'),
(10, 8, 8, 2, NULL, NULL, 'not_paid', NULL, NULL, 38425.15, 'online', 0, 38425.15, NULL, NULL, NULL, NULL, NULL, '2023-05-28 11:54:08', '2023-05-28 11:54:08'),
(11, 8, 8, 2, NULL, NULL, 'not_paid', NULL, NULL, 38425.15, 'online', 0, 38425.15, NULL, NULL, NULL, NULL, NULL, '2023-05-28 11:57:39', '2023-05-28 11:57:39'),
(12, 8, 8, 2, NULL, NULL, 'accepted', '16:32:55', '17:02:55', 38414.8, 'wallet', 38414.8, 0, NULL, '16:22:55', NULL, 0, NULL, '2023-05-28 12:18:07', '2023-05-28 13:22:55'),
(13, 8, 8, 2, NULL, NULL, 'new', NULL, NULL, 38403.3, 'wallet', 38403.3, 0, NULL, NULL, NULL, 0, NULL, '2023-05-28 13:36:05', '2023-05-28 13:36:05'),
(14, 8, 8, 2, NULL, NULL, 'new', NULL, NULL, 38403.3, 'wallet', 38403.3, 0, NULL, NULL, NULL, 0, NULL, '2023-05-28 13:36:31', '2023-05-28 13:36:31'),
(15, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(16, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(17, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:38:42', '2023-05-28 13:38:42'),
(18, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:40:01', '2023-05-28 13:40:01'),
(19, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:42:00', '2023-05-28 13:42:00'),
(20, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(21, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:43:35', '2023-05-28 13:43:35'),
(22, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(23, 6, 1, 1, NULL, NULL, 'new', NULL, NULL, 100, 'online', 0, 100, 'i want fresh meal', NULL, NULL, 0, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(24, 8, 8, 2, NULL, NULL, 'accepted', '18:11:07', '18:41:07', 38403.3, 'wallet', 38403.3, 0, NULL, '18:01:07', NULL, 0, NULL, '2023-05-28 14:49:45', '2023-05-28 15:01:07'),
(25, 8, 8, 2, NULL, NULL, 'canceled_from_market', '19:00:30', '19:30:30', 38403.3, 'wallet', 38403.3, 0, NULL, '18:50:30', NULL, 0, NULL, '2023-05-28 15:02:04', '2023-05-28 16:23:17'),
(26, 8, 8, 2, NULL, NULL, 'accepted', '18:47:43', '19:17:43', 38403.3, 'wallet', 38403.3, 0, NULL, '18:37:43', NULL, 0, NULL, '2023-05-28 15:04:08', '2023-05-28 15:37:43'),
(27, 8, 8, 2, NULL, NULL, 'accepted', '18:15:25', '18:45:25', 38403.3, 'wallet', 38403.3, 0, NULL, '18:05:25', NULL, 0, NULL, '2023-05-28 15:05:07', '2023-05-28 15:05:25'),
(28, 8, 8, 2, NULL, NULL, 'accepted', '18:48:39', '19:18:39', 38403.3, 'wallet', 38403.3, 0, NULL, '18:38:39', NULL, 0, NULL, '2023-05-28 15:38:17', '2023-05-28 15:38:39'),
(29, 8, 8, 2, NULL, NULL, 'accepted', '19:34:20', '20:04:20', 38403.3, 'wallet', 38403.3, 0, NULL, '19:24:20', NULL, 0, NULL, '2023-05-28 16:24:07', '2023-05-28 16:24:20'),
(30, 8, 8, 2, NULL, NULL, 'accepted', '19:40:01', '20:10:01', 38403.3, 'wallet', 38403.3, 0, NULL, '19:30:01', NULL, 0, NULL, '2023-05-28 16:28:39', '2023-05-28 16:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, NULL, '2023-05-23 10:39:27', '2023-05-23 10:39:27'),
(2, 2, 5, 2, NULL, '2023-05-23 13:18:33', '2023-05-23 13:18:33'),
(3, 3, 5, 1, NULL, '2023-05-23 13:53:53', '2023-05-23 13:53:53'),
(4, 4, 5, 2, NULL, '2023-05-23 15:45:21', '2023-05-23 15:45:21'),
(5, 5, 3, 2, NULL, '2023-05-23 16:06:22', '2023-05-23 16:06:22'),
(6, 6, 4, 3, NULL, '2023-05-23 19:46:24', '2023-05-23 19:46:24'),
(7, 7, 6, 1, NULL, '2023-05-25 13:23:33', '2023-05-25 13:23:33'),
(8, 8, 3, 1, NULL, '2023-05-26 12:30:41', '2023-05-26 12:30:41'),
(9, 9, 5, 1, NULL, '2023-05-26 12:50:38', '2023-05-26 12:50:38'),
(10, 10, 10, 1, NULL, '2023-05-28 11:54:08', '2023-05-28 11:54:08'),
(11, 11, 10, 1, NULL, '2023-05-28 11:57:40', '2023-05-28 11:57:40'),
(12, 12, 10, 1, NULL, '2023-05-28 12:18:07', '2023-05-28 12:18:07'),
(13, 13, 10, 1, NULL, '2023-05-28 13:36:05', '2023-05-28 13:36:05'),
(14, 14, 10, 1, NULL, '2023-05-28 13:36:31', '2023-05-28 13:36:31'),
(15, 15, 2, 3, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(16, 15, 1, 2, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(17, 16, 2, 3, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(18, 16, 1, 2, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(19, 17, 2, 3, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(20, 17, 1, 2, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(21, 18, 2, 3, NULL, '2023-05-28 13:40:01', '2023-05-28 13:40:01'),
(22, 18, 1, 2, NULL, '2023-05-28 13:40:06', '2023-05-28 13:40:06'),
(23, 19, 2, 3, NULL, '2023-05-28 13:42:03', '2023-05-28 13:42:03'),
(24, 19, 1, 2, NULL, '2023-05-28 13:42:05', '2023-05-28 13:42:05'),
(25, 20, 2, 3, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(26, 20, 1, 2, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(27, 21, 2, 3, NULL, '2023-05-28 13:43:35', '2023-05-28 13:43:35'),
(28, 21, 1, 2, NULL, '2023-05-28 13:43:36', '2023-05-28 13:43:36'),
(29, 22, 2, 3, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(30, 22, 1, 2, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(31, 23, 2, 3, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(32, 23, 1, 2, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(33, 24, 10, 1, NULL, '2023-05-28 14:49:46', '2023-05-28 14:49:46'),
(34, 25, 10, 1, NULL, '2023-05-28 15:02:05', '2023-05-28 15:02:05'),
(35, 26, 10, 1, NULL, '2023-05-28 15:04:08', '2023-05-28 15:04:08'),
(36, 27, 10, 1, NULL, '2023-05-28 15:05:07', '2023-05-28 15:05:07'),
(37, 28, 10, 1, NULL, '2023-05-28 15:38:17', '2023-05-28 15:38:17'),
(38, 29, 10, 1, NULL, '2023-05-28 16:24:07', '2023-05-28 16:24:07'),
(39, 30, 10, 1, NULL, '2023-05-28 16:28:39', '2023-05-28 16:28:39');

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
(1, 5, 1, NULL, '2023-05-23 16:06:22', '2023-05-23 16:06:22'),
(2, 5, 2, NULL, '2023-05-23 16:06:22', '2023-05-23 16:06:22'),
(3, 6, 1, NULL, '2023-05-23 19:46:24', '2023-05-23 19:46:24'),
(4, 10, 7, NULL, '2023-05-28 11:54:08', '2023-05-28 11:54:08'),
(5, 11, 7, NULL, '2023-05-28 11:57:40', '2023-05-28 11:57:40'),
(6, 12, 6, NULL, '2023-05-28 12:18:07', '2023-05-28 12:18:07'),
(7, 15, 1, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(8, 15, 2, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(9, 16, 3, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(10, 16, 2, NULL, '2023-05-28 13:37:06', '2023-05-28 13:37:06'),
(11, 17, 1, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(12, 17, 2, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(13, 18, 3, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(14, 18, 2, NULL, '2023-05-28 13:37:53', '2023-05-28 13:37:53'),
(15, 19, 1, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(16, 19, 2, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(17, 20, 3, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(18, 20, 2, NULL, '2023-05-28 13:38:43', '2023-05-28 13:38:43'),
(19, 21, 1, NULL, '2023-05-28 13:40:01', '2023-05-28 13:40:01'),
(20, 21, 2, NULL, '2023-05-28 13:40:03', '2023-05-28 13:40:03'),
(21, 22, 3, NULL, '2023-05-28 13:40:06', '2023-05-28 13:40:06'),
(22, 22, 2, NULL, '2023-05-28 13:40:06', '2023-05-28 13:40:06'),
(23, 23, 1, NULL, '2023-05-28 13:42:05', '2023-05-28 13:42:05'),
(24, 23, 2, NULL, '2023-05-28 13:42:05', '2023-05-28 13:42:05'),
(25, 24, 3, NULL, '2023-05-28 13:42:05', '2023-05-28 13:42:05'),
(26, 24, 2, NULL, '2023-05-28 13:42:05', '2023-05-28 13:42:05'),
(27, 25, 1, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(28, 25, 2, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(29, 26, 3, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(30, 26, 2, NULL, '2023-05-28 13:42:56', '2023-05-28 13:42:56'),
(31, 27, 1, NULL, '2023-05-28 13:43:35', '2023-05-28 13:43:35'),
(32, 27, 2, NULL, '2023-05-28 13:43:36', '2023-05-28 13:43:36'),
(33, 28, 3, NULL, '2023-05-28 13:43:36', '2023-05-28 13:43:36'),
(34, 28, 2, NULL, '2023-05-28 13:43:36', '2023-05-28 13:43:36'),
(35, 29, 1, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(36, 29, 2, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(37, 30, 3, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(38, 30, 2, NULL, '2023-05-28 13:45:57', '2023-05-28 13:45:57'),
(39, 31, 1, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(40, 31, 2, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(41, 32, 3, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59'),
(42, 32, 2, NULL, '2023-05-28 13:47:59', '2023-05-28 13:47:59');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `type` enum('ios','android') COLLATE utf8mb4_unicode_ci DEFAULT 'android',
  `phone_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_token`
--

INSERT INTO `phone_token` (`id`, `user_id`, `market_id`, `delivery_id`, `type`, `phone_token`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, NULL, 'android', 'dRKKv5nTRBi-xr2M7eeWiS:APA91bFrn65t_8xWA-ZTRgZEaZpiq47ZPLmw9IjTCBIj01aG4QhsBZ9lNkj7EqSNDBv01Z89vFH4mzivqTs6ZTujatwUseg36XdI6jBmdgQzNLz8wid5bgP5AKSg26kTn0ynFP_DwZzp', '2023-05-28', '2023-05-28'),
(2, NULL, 2, NULL, 'android', 'c_X12THqT3yifj2cKcoWr8:APA91bFWuAokzUKhXpAnzBNYR-Ywfd9uY_1IsWQwzDkpIrpJBTiwHklM1J-Tu6mZchSxM9VFS3rlVrzIv9Q5uL3f_7Pbq_80dbapv_IQeENJuH7QGYugj26Ybp68DQA1jUZvKx3WyIaH', '2023-05-28', '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_offer` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `offer_type` enum('value','percentage') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'value',
  `value` double DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `old_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `market_id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `image`, `has_offer`, `offer_type`, `value`, `percentage`, `old_price`, `price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 7, 'نصف فرخة', 'نصف فرخة', 'نصف فرخة مع ارز و ثومية', 'نصف فرخة مع ارز و ثومية', 'uploads/product/32161684746270.png', 'no', 'value', 10, 0, 100, 50, NULL, NULL, '2023-05-22 06:04:30'),
(2, 2, NULL, 7, 'بن كيك', 'بن كيك', 'بن كيك بالشكولاته', 'بن كيك بالشكولاته', 'uploads/product/61311684746346.png', 'no', 'value', 10, 0, 100, 90, NULL, NULL, '2023-05-22 06:05:46'),
(3, 1, NULL, 2, 'دجاج لحم', 'دجاج لحم', 'دجاج لحم قطعتين', 'دجاج لحم قطعتين', 'uploads/product/47581684746462.png', 'no', 'value', 10, 0, 100, 90, NULL, NULL, '2023-05-22 06:07:42'),
(4, 1, NULL, 2, 'بيج تيستي', 'بيج تيستي', 'برجر من طبقتين', 'برجر من طبقتين', 'uploads/product/49841684746135.png', 'no', 'percentage', 15, 10, 150, 135, NULL, '2023-05-18 10:50:18', '2023-05-22 06:02:15'),
(5, 1, NULL, 2, 'بيج ماك', 'بيج ماك', 'بيج ماك', 'بيج ماك', 'uploads/product/65921684746038.png', 'yes', 'percentage', NULL, 10, 100, 90, NULL, '2023-05-21 07:03:26', '2023-05-22 08:12:13'),
(6, 1, NULL, 1, 'برجر', 'برجر', 'برجر مكون من طبقتين خبز وبعض شرائح الطماطم والخس وقطعم اللحم 200 جم', 'برجر مكون من طبقتين خبز وبعض شرائح الطماطم والخس وقطعم اللحم 200 جم', 'uploads/product/51561684745092.png', 'no', 'percentage', NULL, NULL, NULL, 10, NULL, '2023-05-22 05:44:52', '2023-05-22 05:44:52'),
(7, 4, NULL, 12, 'بيتزا', 'بيتزا', 'بيتزا بالفراخ', 'بيتزا بالفراخ', 'uploads/product/77461684747768.png', 'no', 'value', NULL, NULL, NULL, 50, NULL, '2023-05-22 06:29:28', '2023-05-22 06:29:28'),
(8, 2, NULL, 8, 'دستة حلويات', 'دستة حلويات', 'دستة حلويات من كافة الانواع', 'دستة حلويات من كافة الانواع', 'uploads/product/4001684754069.jpg', 'no', 'value', NULL, NULL, NULL, 50, NULL, '2023-05-22 08:14:29', '2023-05-22 08:14:29'),
(9, NULL, 1, 1, 'Ahmed Samir', 'b', 'a', 'a', 'uploads/product/20001685226970.PNG', 'no', 'value', NULL, NULL, NULL, 90, NULL, '2023-05-27 19:36:10', '2023-05-27 19:36:10'),
(10, NULL, 3, 2, 'شير بوكس سبايسي', 'شير بوكس سبايسي', 'شير بوكس سبايسي', 'شير بوكس سبايسي', 'uploads/product/29361685232030.png', 'no', 'value', NULL, NULL, NULL, 50, NULL, '2023-05-27 21:00:30', '2023-05-27 21:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_rate` double NOT NULL DEFAULT '0',
  `delivery_rate` double NOT NULL DEFAULT '0',
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
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` text COLLATE utf8mb4_unicode_ci,
  `about` text COLLATE utf8mb4_unicode_ci,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `training` text COLLATE utf8mb4_unicode_ci,
  `points` double DEFAULT '1',
  `wallet_per_points` double DEFAULT '1',
  `delivery_order_points` double NOT NULL DEFAULT '0',
  `delivery_points` double NOT NULL DEFAULT '0',
  `delivery_wallet` double NOT NULL DEFAULT '0',
  `delivery_price_for_kilometer` double NOT NULL DEFAULT '0',
  `num_of_kilos` double NOT NULL DEFAULT '0',
  `num_of_kilos_for_delivery` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `fav_icon`, `whatsapp`, `phone`, `privacy`, `about`, `terms`, `training`, `points`, `wallet_per_points`, `delivery_order_points`, `delivery_points`, `delivery_wallet`, `delivery_price_for_kilometer`, `num_of_kilos`, `num_of_kilos_for_delivery`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/setting/15421684580774.png', 'uploads/setting/92511684580774.png', 'http://whatsapp.com', '+201004834728', '<ul>\r\n	<li>يسمح الموقع لأعضائه الذين يوافقون على الاتفاقية بالطلب من فروع مطاعم سماالديرة على الانترنت.</li>\r\n	<li>&nbsp;نقدم لك طريقة سهلة لإيصال طلباتك حيثما كنت في مملكة البحرين ولكن برسوم توصيل تختلف على حسب إجمالي سعر الطلب وكذلك المسافة.</li>\r\n	<li>&nbsp;غرض الموقع هو تقديم خدمة بسيطة ومريحة إلى العملاء &nbsp;في منطقتهم التي يمكنها تقديم وجبات خارجية، وتسمح قوائم الطعام التفاعلية للعملاء بإختيار الطلبات والأطباق المفضلة بطريقة سهلة وسريعة.</li>\r\n	<li>&nbsp;في حالة اشتراك في خدمة البريد الإلكتروني سوف تصلك رسائل إخبارية بكل جديد في الموقع من حيث العروض والتخفيضات وكذلك الرسائل الترويجية.</li>\r\n	<li>&nbsp;لا نتحمل مسئولية تأخر الطلب للأسباب التالية: الإزدحام المروري، خطأ في العنوان، تاخر الرد من قبل العميل، ولأسباب أخرى تتعلق بالشؤون الداخلية لدينا.</li>\r\n	<li>&nbsp;في حالة استلام الطلب ووجود أصناف مختلفة غير المطلوبة يحق لك التواصل معنا وسنقوم بإستبدال الطلب الخاطئ بالصحيح في أسرع وقت بشرط الحفاظ على حالة الطعام المراد استبداله جيداً دون المساس والعبث فيه.</li>\r\n	<li>&nbsp;يمكننا إلغاء الطلب في حالة عدم توفرة في أي وقت مع الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا تغيير الأسعار وحذف الصنف في أي وقت دون الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا التوقف عن البيع من خلال الموقع الإلكتروني في أي وقت وحسب ما نراه صالح لنا دون الرجوع للعميل.</li>\r\n	<li>- يستطيع العميل الاختيار بين طرق الدفع المختلفة، وهي في الوقت الحالي: نقداً عند الاستلام، بطاقات الائتمان &ndash; بطاقات السحب الآلي &ndash; بنفت بي.</li>\r\n	<li>يحق لنا توفير أي طرق دفع اخرى غير متاحة حالياً، أو حجب أي طرق دفع متوفرة حاليا.</li>\r\n	<li>&nbsp;يلتزم العميل دوماً بضمان أن رصيد البطاقة كافٍ لدفع قيمة الطلب وذلك قبل القيام بالطلب، كما يلتزم العميل باستخدام البطاقة ضمن الحد الائتماني المسموح للبطاقة. كما يلتزم العميل بعدم التورط بعمليات رد المبالغ المدفوعة الغير مصرح بها.</li>\r\n	<li>نتعامل مع رضا العملاء بمنتهى الجدية. وفي حالة وجود مشاكل مع طلب أي وجبة، يرجى الاتصال بـ الدعم الفني وخدمة العملاء بالاتصال بنا عبر الهاتف وسوف نقوم بمساعدتك ونحاول حل المشكلة، وفي الحالات التي تم فيها إصدار فاتورة لك ع، سوف نقوم برد كامل أو جزء من المبلغ طبقا للحالات التالية:<br />\r\n	في حالة عدم حصولك على الطلب أو استلام طلب غير صحيح، يجوز إصدار رد المبلغ كاملا لك، وفي حالة نقص جزء من طلبك، سوف نقوم باصدار رد جزء من المبلغ، وفي جميع الحالات، سوف نبذل قصارى جهدنا لضمان رضاك عن خدمتنا.</li>\r\n</ul>', '<ul>\r\n	<li>يسمح الموقع لأعضائه الذين يوافقون على الاتفاقية بالطلب من فروع مطاعم سماالديرة على الانترنت.</li>\r\n	<li>&nbsp;نقدم لك طريقة سهلة لإيصال طلباتك حيثما كنت في مملكة البحرين ولكن برسوم توصيل تختلف على حسب إجمالي سعر الطلب وكذلك المسافة.</li>\r\n	<li>&nbsp;غرض الموقع هو تقديم خدمة بسيطة ومريحة إلى العملاء &nbsp;في منطقتهم التي يمكنها تقديم وجبات خارجية، وتسمح قوائم الطعام التفاعلية للعملاء بإختيار الطلبات والأطباق المفضلة بطريقة سهلة وسريعة.</li>\r\n	<li>&nbsp;في حالة اشتراك في خدمة البريد الإلكتروني سوف تصلك رسائل إخبارية بكل جديد في الموقع من حيث العروض والتخفيضات وكذلك الرسائل الترويجية.</li>\r\n	<li>&nbsp;لا نتحمل مسئولية تأخر الطلب للأسباب التالية: الإزدحام المروري، خطأ في العنوان، تاخر الرد من قبل العميل، ولأسباب أخرى تتعلق بالشؤون الداخلية لدينا.</li>\r\n	<li>&nbsp;في حالة استلام الطلب ووجود أصناف مختلفة غير المطلوبة يحق لك التواصل معنا وسنقوم بإستبدال الطلب الخاطئ بالصحيح في أسرع وقت بشرط الحفاظ على حالة الطعام المراد استبداله جيداً دون المساس والعبث فيه.</li>\r\n	<li>&nbsp;يمكننا إلغاء الطلب في حالة عدم توفرة في أي وقت مع الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا تغيير الأسعار وحذف الصنف في أي وقت دون الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا التوقف عن البيع من خلال الموقع الإلكتروني في أي وقت وحسب ما نراه صالح لنا دون الرجوع للعميل.</li>\r\n	<li>- يستطيع العميل الاختيار بين طرق الدفع المختلفة، وهي في الوقت الحالي: نقداً عند الاستلام، بطاقات الائتمان &ndash; بطاقات السحب الآلي &ndash; بنفت بي.</li>\r\n	<li>يحق لنا توفير أي طرق دفع اخرى غير متاحة حالياً، أو حجب أي طرق دفع متوفرة حاليا.</li>\r\n	<li>&nbsp;يلتزم العميل دوماً بضمان أن رصيد البطاقة كافٍ لدفع قيمة الطلب وذلك قبل القيام بالطلب، كما يلتزم العميل باستخدام البطاقة ضمن الحد الائتماني المسموح للبطاقة. كما يلتزم العميل بعدم التورط بعمليات رد المبالغ المدفوعة الغير مصرح بها.</li>\r\n	<li>نتعامل مع رضا العملاء بمنتهى الجدية. وفي حالة وجود مشاكل مع طلب أي وجبة، يرجى الاتصال بـ الدعم الفني وخدمة العملاء بالاتصال بنا عبر الهاتف وسوف نقوم بمساعدتك ونحاول حل المشكلة، وفي الحالات التي تم فيها إصدار فاتورة لك ع، سوف نقوم برد كامل أو جزء من المبلغ طبقا للحالات التالية:<br />\r\n	في حالة عدم حصولك على الطلب أو استلام طلب غير صحيح، يجوز إصدار رد المبلغ كاملا لك، وفي حالة نقص جزء من طلبك، سوف نقوم باصدار رد جزء من المبلغ، وفي جميع الحالات، سوف نبذل قصارى جهدنا لضمان رضاك عن خدمتنا.</li>\r\n</ul>', '<ul>\r\n	<li>يسمح الموقع لأعضائه الذين يوافقون على الاتفاقية بالطلب من فروع مطاعم سماالديرة على الانترنت.</li>\r\n	<li>&nbsp;نقدم لك طريقة سهلة لإيصال طلباتك حيثما كنت في مملكة البحرين ولكن برسوم توصيل تختلف على حسب إجمالي سعر الطلب وكذلك المسافة.</li>\r\n	<li>&nbsp;غرض الموقع هو تقديم خدمة بسيطة ومريحة إلى العملاء &nbsp;في منطقتهم التي يمكنها تقديم وجبات خارجية، وتسمح قوائم الطعام التفاعلية للعملاء بإختيار الطلبات والأطباق المفضلة بطريقة سهلة وسريعة.</li>\r\n	<li>&nbsp;في حالة اشتراك في خدمة البريد الإلكتروني سوف تصلك رسائل إخبارية بكل جديد في الموقع من حيث العروض والتخفيضات وكذلك الرسائل الترويجية.</li>\r\n	<li>&nbsp;لا نتحمل مسئولية تأخر الطلب للأسباب التالية: الإزدحام المروري، خطأ في العنوان، تاخر الرد من قبل العميل، ولأسباب أخرى تتعلق بالشؤون الداخلية لدينا.</li>\r\n	<li>&nbsp;في حالة استلام الطلب ووجود أصناف مختلفة غير المطلوبة يحق لك التواصل معنا وسنقوم بإستبدال الطلب الخاطئ بالصحيح في أسرع وقت بشرط الحفاظ على حالة الطعام المراد استبداله جيداً دون المساس والعبث فيه.</li>\r\n	<li>&nbsp;يمكننا إلغاء الطلب في حالة عدم توفرة في أي وقت مع الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا تغيير الأسعار وحذف الصنف في أي وقت دون الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا التوقف عن البيع من خلال الموقع الإلكتروني في أي وقت وحسب ما نراه صالح لنا دون الرجوع للعميل.</li>\r\n	<li>- يستطيع العميل الاختيار بين طرق الدفع المختلفة، وهي في الوقت الحالي: نقداً عند الاستلام، بطاقات الائتمان &ndash; بطاقات السحب الآلي &ndash; بنفت بي.</li>\r\n	<li>يحق لنا توفير أي طرق دفع اخرى غير متاحة حالياً، أو حجب أي طرق دفع متوفرة حاليا.</li>\r\n	<li>&nbsp;يلتزم العميل دوماً بضمان أن رصيد البطاقة كافٍ لدفع قيمة الطلب وذلك قبل القيام بالطلب، كما يلتزم العميل باستخدام البطاقة ضمن الحد الائتماني المسموح للبطاقة. كما يلتزم العميل بعدم التورط بعمليات رد المبالغ المدفوعة الغير مصرح بها.</li>\r\n	<li>نتعامل مع رضا العملاء بمنتهى الجدية. وفي حالة وجود مشاكل مع طلب أي وجبة، يرجى الاتصال بـ الدعم الفني وخدمة العملاء بالاتصال بنا عبر الهاتف وسوف نقوم بمساعدتك ونحاول حل المشكلة، وفي الحالات التي تم فيها إصدار فاتورة لك ع، سوف نقوم برد كامل أو جزء من المبلغ طبقا للحالات التالية:<br />\r\n	في حالة عدم حصولك على الطلب أو استلام طلب غير صحيح، يجوز إصدار رد المبلغ كاملا لك، وفي حالة نقص جزء من طلبك، سوف نقوم باصدار رد جزء من المبلغ، وفي جميع الحالات، سوف نبذل قصارى جهدنا لضمان رضاك عن خدمتنا.</li>\r\n</ul>', '<ul>\r\n	<li>يسمح الموقع لأعضائه الذين يوافقون على الاتفاقية بالطلب من فروع مطاعم سماالديرة على الانترنت.</li>\r\n	<li>&nbsp;نقدم لك طريقة سهلة لإيصال طلباتك حيثما كنت في مملكة البحرين ولكن برسوم توصيل تختلف على حسب إجمالي سعر الطلب وكذلك المسافة.</li>\r\n	<li>&nbsp;غرض الموقع هو تقديم خدمة بسيطة ومريحة إلى العملاء &nbsp;في منطقتهم التي يمكنها تقديم وجبات خارجية، وتسمح قوائم الطعام التفاعلية للعملاء بإختيار الطلبات والأطباق المفضلة بطريقة سهلة وسريعة.</li>\r\n	<li>&nbsp;في حالة اشتراك في خدمة البريد الإلكتروني سوف تصلك رسائل إخبارية بكل جديد في الموقع من حيث العروض والتخفيضات وكذلك الرسائل الترويجية.</li>\r\n	<li>&nbsp;لا نتحمل مسئولية تأخر الطلب للأسباب التالية: الإزدحام المروري، خطأ في العنوان، تاخر الرد من قبل العميل، ولأسباب أخرى تتعلق بالشؤون الداخلية لدينا.</li>\r\n	<li>&nbsp;في حالة استلام الطلب ووجود أصناف مختلفة غير المطلوبة يحق لك التواصل معنا وسنقوم بإستبدال الطلب الخاطئ بالصحيح في أسرع وقت بشرط الحفاظ على حالة الطعام المراد استبداله جيداً دون المساس والعبث فيه.</li>\r\n	<li>&nbsp;يمكننا إلغاء الطلب في حالة عدم توفرة في أي وقت مع الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا تغيير الأسعار وحذف الصنف في أي وقت دون الرجوع للعميل.</li>\r\n	<li>&nbsp;يمكننا التوقف عن البيع من خلال الموقع الإلكتروني في أي وقت وحسب ما نراه صالح لنا دون الرجوع للعميل.</li>\r\n	<li>- يستطيع العميل الاختيار بين طرق الدفع المختلفة، وهي في الوقت الحالي: نقداً عند الاستلام، بطاقات الائتمان &ndash; بطاقات السحب الآلي &ndash; بنفت بي.</li>\r\n	<li>يحق لنا توفير أي طرق دفع اخرى غير متاحة حالياً، أو حجب أي طرق دفع متوفرة حاليا.</li>\r\n	<li>&nbsp;يلتزم العميل دوماً بضمان أن رصيد البطاقة كافٍ لدفع قيمة الطلب وذلك قبل القيام بالطلب، كما يلتزم العميل باستخدام البطاقة ضمن الحد الائتماني المسموح للبطاقة. كما يلتزم العميل بعدم التورط بعمليات رد المبالغ المدفوعة الغير مصرح بها.</li>\r\n	<li>نتعامل مع رضا العملاء بمنتهى الجدية. وفي حالة وجود مشاكل مع طلب أي وجبة، يرجى الاتصال بـ الدعم الفني وخدمة العملاء بالاتصال بنا عبر الهاتف وسوف نقوم بمساعدتك ونحاول حل المشكلة، وفي الحالات التي تم فيها إصدار فاتورة لك ع، سوف نقوم برد كامل أو جزء من المبلغ طبقا للحالات التالية:<br />\r\n	في حالة عدم حصولك على الطلب أو استلام طلب غير صحيح، يجوز إصدار رد المبلغ كاملا لك، وفي حالة نقص جزء من طلبك، سوف نقوم باصدار رد جزء من المبلغ، وفي جميع الحالات، سوف نبذل قصارى جهدنا لضمان رضاك عن خدمتنا.</li>\r\n</ul>', 5, 1, 2, 100, 10, 3, 0, '7', NULL, NULL, '2023-05-21 18:22:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `type`, `market_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'market', 1, NULL, NULL, NULL),
(3, 'market', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name_ar`, `name_en`, `category_id`, `market_id`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Samir', 'Ahmed Samir', NULL, 1, '2023-05-27 18:34:34', '2023-05-27 18:34:34'),
(2, 'a', 'b', NULL, 7, '2023-05-27 18:34:49', '2023-05-27 18:34:49'),
(3, 'شير بوكس', 'شير بوكس', NULL, 2, '2023-05-27 20:59:29', '2023-05-27 20:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `title`, `title2`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12, 'test', 'test', NULL, 'test', NULL, '2023-05-21 04:20:17', '2023-05-21 04:20:17'),
(13, 'طلب غير مكتمل', NULL, NULL, 'teeee', NULL, '2023-05-21 04:21:28', '2023-05-21 04:21:28'),
(14, 'مشكلة في الطلب', NULL, 'uploads/support/95701684653999.png', 'qweqwe', NULL, '2023-05-21 04:26:39', '2023-05-21 04:26:39'),
(15, 'ملاحظات على المندوب', 'النظافة', NULL, 'wer', NULL, '2023-05-21 04:42:43', '2023-05-21 04:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `support_products`
--

CREATE TABLE `support_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
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
(3, 11, 2, 2, NULL, '2023-04-30 19:03:33', '2023-04-30 19:03:33'),
(4, 12, 1, 1, NULL, '2023-05-21 04:20:17', '2023-05-21 04:20:17'),
(5, 12, 2, 2, NULL, '2023-05-21 04:20:17', '2023-05-21 04:20:17'),
(6, 13, 4, 1, NULL, '2023-05-21 04:21:28', '2023-05-21 04:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `notification` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `points` double NOT NULL DEFAULT '0',
  `wallet` double NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `phone`, `image`, `password`, `code`, `block`, `notification`, `points`, `wallet`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'ahmed', 'samir', '01004834728', 'uploads/user/19141682457678.png', '$2y$10$/oq66plqf5ou2eU4L6ZdVu7oCcIWq7QEIsOgJsMkTTuOlN/ZKK4EC', NULL, 'no', 'yes', 106, 70, NULL, '2023-04-24 12:56:56', '2023-05-28 12:11:21'),
(7, 'ahmed', 'samir', '010048347281', NULL, '$2y$10$fBJxdo.Cyx9xH19kLa2b3O5cJ9q.eXOqUvjl9ILnfRgHaEbhQMxZa', NULL, 'no', 'yes', 0, 0, NULL, '2023-04-24 12:57:19', '2023-04-24 12:57:19'),
(8, 'Hamza', 'Mahmoud', '01551330024', 'uploads/user/41761684606544.png', '$2y$10$cu77onGXe2f8Z11HryzzR.LgYxdRyJ86G7.z6Sci6XKG/KLTtNMdq', NULL, 'no', 'yes', 789762, 654527.8, NULL, '2023-05-20 07:40:24', '2023-05-28 16:28:39'),
(9, 'Hamza', 'Mahmoud', '01127910028', NULL, '$2y$10$PJxiTNyXeqEDJMS16zZb1uq6uTR8CuAx.Il7xEZVD6h8StCCQc8Tu', NULL, 'no', 'yes', 0, 0, NULL, '2023-05-21 10:11:57', '2023-05-21 10:11:57'),
(11, 'ahmed', 'Ahmed', '546349264', NULL, '$2y$10$QPJQSUX90aFQ01/PHTVGJuh.XVYken9pC3SFrKt5C.D0hmeHOFAti', NULL, 'no', 'yes', 0, 0, NULL, '2023-05-22 10:36:11', '2023-05-22 10:36:11'),
(12, 'Ahmed', 'Ahmed', '966546349264', NULL, '$2y$10$BrXGIz5KNpwGlB/HedqSBuEz3Is79FsqSwoZPbNgYdYqfVpQXByKC', '429142', 'no', 'yes', 10000, 0, NULL, '2023-05-23 10:35:27', '2023-05-28 00:10:16');

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
-- Indexes for table `market_sub_category`
--
ALTER TABLE `market_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mar_sub_cat_cat_id` (`sub_category_id`),
  ADD KEY `mar_sub_cat_mar_id` (`market_id`);

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
  ADD KEY `products_market_id_foreign` (`market_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

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
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_cat_cat_id` (`category_id`),
  ADD KEY `sub_cat_mar_id` (`market_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `addition_categories`
--
ALTER TABLE `addition_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addition_products`
--
ALTER TABLE `addition_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart_additions`
--
ALTER TABLE `cart_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupon_users`
--
ALTER TABLE `coupon_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favourates`
--
ALTER TABLE `favourates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `market_categories`
--
ALTER TABLE `market_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `market_sub_category`
--
ALTER TABLE `market_sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_details_additions`
--
ALTER TABLE `order_details_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `support_products`
--
ALTER TABLE `support_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `market_sub_category`
--
ALTER TABLE `market_sub_category`
  ADD CONSTRAINT `mar_sub_cat_mar_id` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mar_sub_cat_sub_cat_id` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`),
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_cat_cat_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cat_mar_id` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
