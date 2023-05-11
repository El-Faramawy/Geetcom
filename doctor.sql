-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 01:05 AM
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
-- Database: `doctor`
--

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
(1, 'Ahmed Samir', 'admin@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$jQwijE6U4aYXGgIk21ORzOIAAFhoCGOFcgkGn39o.hM3LDiHqn7ha', NULL, NULL, '2023-01-30 02:49:26'),
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
(5, 1, 1, '2023-01-20 13:18:34', '2023-01-20 13:18:34'),
(6, 2, 1, '2023-01-20 13:18:34', '2023-01-20 13:18:34'),
(7, 3, 1, '2023-01-20 13:18:34', '2023-01-20 13:18:34'),
(8, 4, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(9, 5, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(10, 7, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(12, 10, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(18, 19, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(19, 20, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(20, 21, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(21, 22, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(22, 39, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(23, 40, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(24, 41, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(25, 42, 1, '2023-01-20 13:18:35', '2023-01-20 13:18:35'),
(34, 51, 1, '2023-01-20 13:18:36', '2023-01-20 13:18:36'),
(35, 60, 1, '2023-01-20 13:18:36', '2023-01-20 13:18:36'),
(36, 61, 1, '2023-01-20 13:18:36', '2023-01-20 13:18:36'),
(37, 62, 1, '2023-01-20 13:18:36', '2023-01-20 13:18:36'),
(38, 63, 1, '2023-01-20 13:18:36', '2023-01-20 13:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'باطنة', 'stomac', '2023-03-29 10:06:43', '2023-03-29 10:06:43'),
(2, 'مخ و اعصاب', 'brain', '2023-03-29 10:07:11', '2023-03-29 10:07:11'),
(3, 'انف و اذن', 'ear and nose', '2023-03-29 10:08:22', '2023-03-29 10:08:30'),
(6, 'امراض القلب', 'Heart disease', '2023-03-29 10:20:35', '2023-03-29 10:20:35'),
(7, 'امراض مناعة', 'immune diseases', '2023-03-29 10:21:18', '2023-03-29 10:21:18'),
(8, 'امراض عظام', 'bone diseases', '2023-03-29 10:21:48', '2023-03-29 10:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `message` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Samir', 'ahmedelfaramawy84@gmail.com', '01004834728', 'test', NULL, '2023-03-29 12:36:26', '2023-03-29 12:36:26'),
(5, 'Ahmed Samir', 'ahmedelfaramawy84@gmail.com', '+201004834728', 'test4', NULL, '2023-03-29 13:01:59', '2023-03-29 13:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'دكتوراه', 'doctor', '2023-03-29 11:31:19', '2023-03-29 11:31:19'),
(2, 'استشاري أول', 'doctor', '2023-03-29 11:31:37', '2023-03-29 11:31:37'),
(3, 'طبيب إستشاري', 'doctor', '2023-03-29 11:32:01', '2023-03-29 11:32:01'),
(4, 'أخصائي أول', 'doctor', '2023-03-29 11:32:30', '2023-03-29 11:32:36'),
(5, 'طبيب أخصائي', 'doctor', '2023-03-29 11:32:58', '2023-03-29 11:32:58'),
(6, 'طبيب مقيم', 'doctor', '2023-03-29 11:33:12', '2023-03-29 11:33:12'),
(7, 'طبيب الامتياز', 'doctor', '2023-03-29 11:33:35', '2023-03-29 11:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `deseases`
--

CREATE TABLE `deseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deseases`
--

INSERT INTO `deseases` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'سكر', 'suger', NULL, NULL),
(2, 'ضغط', 'pressure', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `degree_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('clinic','hospital','both') NOT NULL DEFAULT 'hospital',
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `location_ar` varchar(191) DEFAULT NULL,
  `location_en` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT 0,
  `longitude` double NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `day_limit` int(11) NOT NULL DEFAULT 1,
  `age_from` int(11) NOT NULL DEFAULT 1,
  `age_to` int(11) NOT NULL DEFAULT 100,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `hospital_id`, `category_id`, `degree_id`, `type`, `gender`, `name_ar`, `name_en`, `email`, `phone`, `password`, `image`, `location_ar`, `location_en`, `description`, `latitude`, `longitude`, `rating`, `day_limit`, `age_from`, `age_to`, `price`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 2, 'both', 'male', 'Ahmed Samir', NULL, '1admin@admin.com', '1201004834728', '$2y$10$TY0zz6/T/iMDk/Hy9/DuiObdrCAA3bPS64LVk22.LmYW5b3KgIW/G', 'uploads/doctor/21261680196207.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 0, '2023-03-30 15:10:07', '2023-03-30 15:10:07'),
(2, NULL, 2, 2, 'both', 'male', 'Ahmed Samir 1', NULL, '2admin@admin.com', '120100434728', '$2y$10$KWchFSX27bCs7eCCXtROl.gLUAyR4ChEgZ.uI5JKdEb4bz95s6q5W', 'uploads/doctor/87951680196284.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 50, '2023-03-30 15:11:24', '2023-03-30 15:11:24'),
(3, NULL, 2, 2, 'both', 'male', 'Ahmed Samir 2', NULL, '2admin@ad1min.com', '1201100434728', '$2y$10$urqpzeslcPCRHbRW6Qnbr.agqsWfD1U0uSk7SnUjoMq2NQDCDmpmC', 'uploads/doctor/28541680196765.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 0, '2023-03-30 15:19:25', '2023-03-30 15:19:25'),
(4, NULL, 2, 2, 'both', 'male', 'Ahmed Samir 3', NULL, '2admin@adin.com', '120110434728', '$2y$10$bN26SLP2wPRXBwxtcIzIxOKQ5Qgv8s0a/E7EJB.5WOlAgH7hJ9312', 'uploads/doctor/98601680197058.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 10, '2023-03-30 15:24:18', '2023-03-30 15:24:18'),
(5, NULL, 2, 2, 'both', 'male', 'Ahmed Samir 4', NULL, '2admin@adn.com', '12010434728', '$2y$10$0E/7VcpvukZpALSbxYDIzu0jTNkfTMC6qYSjpMWKC0j6ppSGBvuAO', 'uploads/doctor/44031680197102.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 0, '2023-03-30 15:25:02', '2023-03-30 15:25:02'),
(6, NULL, 2, 2, 'both', 'male', 'Ahmed Samir 5', NULL, '2admn@adn.com', '1201043478', '$2y$10$RZLDw.8oj08F7/lG.QpguOO4xF/9867H22VfRuCcR2Qbl5DNDJxi.', 'uploads/doctor/28851680197262.png', 'test', NULL, 'test', 30.54981791007435, 30.951076205992802, 0, 5, 1, 30, 0, '2023-03-30 15:27:42', '2023-03-30 15:27:42'),
(7, NULL, 1, 2, 'both', 'male', 'Ahmed Samir 6', NULL, 'admin@adm1in.com', '2010048347218', '$2y$10$bVrL2ZDFCurJ1MjVya.DmOjwTRbLaO37QsxLcQQUxOk86eQxgySJy', 'uploads/doctor/36001681066635.png', 'test', NULL, 'test', 30.70772223657828, 30.876918491149052, 0, 5, 1, 30, 0, '2023-04-09 16:57:15', '2023-04-09 16:57:15'),
(8, 1, 1, 2, 'both', 'male', 'Ahmed Samir 7', NULL, 'adm1in@admin.com', '20100483411728', '$2y$10$hdD7m.ZkaMbeFbYrp1xXa.EPyMLTUlfJ/PSjNFG.UJwx6RROSsKQG', 'uploads/doctor/51351681072924.jpg', 'test', NULL, 'test desc', 30.450460573380578, 30.919490512633427, 0, 5, 1, 30, 0, '2023-04-09 18:42:04', '2023-04-09 18:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_ar` varchar(191) DEFAULT NULL,
  `location_en` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT 0,
  `longitude` double NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `day_limit` int(11) NOT NULL DEFAULT 1,
  `age_from` int(11) NOT NULL DEFAULT 1,
  `age_to` int(11) NOT NULL DEFAULT 100,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name_ar`, `name_en`, `email`, `password`, `category_id`, `location_ar`, `location_en`, `description`, `latitude`, `longitude`, `rating`, `day_limit`, `age_from`, `age_to`, `price`, `created_at`, `updated_at`) VALUES
(1, 'مستشفى منوف', 'menouf hospital', 'a@a.com', '123456', 1, 'منوف', 'menouf', 'مستشفى منوف لجميع التخصصات', 0, 0, 0, 1, 1, 100, 100, NULL, NULL);

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
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2023_03_26_123035_create_contacts_table', 1),
(19, '2023_03_26_123047_create_categories_table', 1),
(20, '2023_03_26_124635_create_degrees_table', 1),
(21, '2023_03_26_124654_create_deseases_table', 1),
(22, '2023_03_26_124710_create_hospitals_table', 1),
(23, '2023_03_26_124720_create_doctors_table', 1),
(24, '2023_03_26_124837_create_reservations_table', 1),
(25, '2023_03_26_124848_create_reservation_deseases_table', 1),
(26, '2023_03_26_124858_create_rates_table', 1),
(27, '2023_03_26_142514_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `message` varchar(191) DEFAULT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(10, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:42:23', '2023-01-30 16:42:23'),
(14, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:42:31', '2023-01-30 16:42:31'),
(18, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:45:00', '2023-01-30 16:45:00'),
(22, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:46:31', '2023-01-30 16:46:31'),
(26, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:47:04', '2023-01-30 16:47:04'),
(30, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:47:35', '2023-01-30 16:47:35'),
(34, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:47:59', '2023-01-30 16:47:59'),
(38, 8, 'تجربة', 'رسالة تجربة', 0, '2023-01-30 16:48:31', '2023-01-30 16:48:31'),
(42, 8, 'a', 'b', 0, '2023-01-30 16:49:20', '2023-01-30 16:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, 2, 'حظر', NULL, NULL),
(19, 5, 'عرض', NULL, NULL),
(20, 5, 'رد', NULL, NULL),
(21, 5, 'حذف', NULL, NULL),
(22, 6, 'تعديل', NULL, NULL),
(39, 11, 'عرض', NULL, NULL),
(40, 11, 'حذف', NULL, NULL),
(41, 11, 'تغيير الحالة', NULL, NULL),
(42, 12, 'اضافة', NULL, NULL),
(51, 15, 'عرض', NULL, NULL),
(60, 17, 'عرض', NULL, NULL),
(61, 17, 'تعديل', NULL, NULL),
(62, 17, 'حذف', NULL, NULL),
(63, 17, 'اضافة', NULL, NULL),
(80, 22, 'عرض', NULL, NULL),
(81, 22, 'تعديل', NULL, NULL),
(82, 22, 'حذف', NULL, NULL),
(83, 22, 'اضافة', NULL, NULL),
(84, 23, 'عرض', NULL, NULL),
(85, 23, 'تعديل', NULL, NULL),
(86, 23, 'حذف', NULL, NULL),
(87, 23, 'اضافة', NULL, NULL),
(88, 24, 'عرض', NULL, NULL),
(89, 24, 'تعديل', NULL, NULL),
(90, 24, 'حذف', NULL, NULL),
(91, 24, 'اضافة', NULL, NULL);

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
(5, 'تواصل معنا', NULL, NULL),
(6, 'الاعدادات', NULL, NULL),
(11, 'الطلبات', NULL, NULL),
(12, 'الاشعارات', NULL, NULL),
(15, 'احصائيات الرئيسية', NULL, NULL),
(17, 'الماركات', NULL, NULL),
(22, 'الاصدارات', NULL, NULL),
(23, 'الموديلات', NULL, NULL),
(24, 'قطع الغيار', NULL, NULL);

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
  `type` enum('ios','android') DEFAULT 'android',
  `phone_token` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_token`
--

INSERT INTO `phone_token` (`id`, `user_id`, `type`, `phone_token`, `created_at`, `updated_at`) VALUES
(13, 8, 'android', 'erEYGQZcTVOUivm4HElLfc:APA91bGBHC7LsLyirAxk8ueImgA3NKJ22Zduo6vCpaQZbdfV3jtUa0KNe0-HiiQPz3yeLf1jZ0HGK1zPrlCGyZoyI2NFd6EkHLZvNERV_aaL_INvdnSw0ukKgnxHeuD2FTWoK831jRro', '2023-01-29', '2023-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('new','accepted','refused','ended') NOT NULL DEFAULT 'new',
  `hospital_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `date`, `name`, `gender`, `age`, `phone`, `image`, `notes`, `status`, `hospital_id`, `doctor_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2023-04-15', 'Ahmed Samir', 'male', 23, '01004834728', 'D:\\xampp\\tmp\\php5521.tmp', 'test', 'new', NULL, 2, NULL, '2023-04-12 20:57:54', '2023-04-12 20:57:54'),
(2, '2023-04-15', 'Ahmed Samir', 'male', 23, '01004834728', 'D:\\xampp\\tmp\\php75.tmp', 'test', 'new', NULL, 2, NULL, '2023-04-12 20:58:41', '2023-04-12 20:58:41'),
(3, '2023-04-15', 'Ahmed Samir', 'female', 4, '01004834728', 'D:\\xampp\\tmp\\phpD1C0.tmp', 'teeeeeeeeest', 'new', NULL, 2, NULL, '2023-04-12 20:59:32', '2023-04-12 20:59:32'),
(4, '2023-04-15', 'Ahmed Samir', 'male', 1, '201004834728', NULL, NULL, 'new', NULL, 2, NULL, '2023-04-12 21:00:02', '2023-04-12 21:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_deseases`
--

CREATE TABLE `reservation_deseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desease_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms` text DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `fav_icon` varchar(191) DEFAULT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `linked_in` varchar(191) DEFAULT NULL,
  `insta` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `terms`, `logo`, `fav_icon`, `facebook`, `twitter`, `linked_in`, `insta`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, '<p style=\"text-align:right\"><strong>&nbsp;: <span style=\"color:#e74c3c\">عربة </span>لقطع الغيار السيارات يوضح لك عزيزي العميل الشروط والأحكام&nbsp;</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>الإلغاء:</strong></p>\r\n\r\n<p style=\"text-align:right\"><strong>-إلغاء الطلبات الغير مدفوعة تلقائي كل اربعة وعشرين ساعة.</strong></p>\r\n\r\n<p style=\"text-align:right\"><strong>-في حال الدفع والعميل يرغب بإلغاء الطلب لا مانع بشرط عدم شحن الطلب.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>الإرجاع</strong></p>\r\n\r\n<p style=\"text-align:right\"><strong>1 -</strong>&nbsp;<strong>في حالة القطع صحيحة من طرفنا وتم الشحن إلى العميل ويرغب في إعادة الطلب لا مانع في ذلك في ذلك شرط أن يكون الإرجاع خلال ثمانية واربعون ساعة كحد اقصى من تاريخ استلام العميل للشحنة. وان يكون الطلب غير مفتوح نهائياً او مستخدم ويتحمل العميل قيمة الشحن الينا. القطع الغير مضمونة لا يشملها الاسترجاع الا في حال وجود خلل مصنعي خلال اربعة وعشرين ساعة من استلام الشحنة وتكون بكامل ملحقاتها الأصليه، القطع الكهربائية غير مشموله في هذا البند قيمة الشحن غير مستردة نهائيا في اي حال من الأحوال . سوف يتم خصم أي رسوم مصرفية إضافية يتحملها المتجر بسبب عملية الإرجاع او الألغاء .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>2- القطع الكهربائية غير مضمونة ولاترد نهائياً.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>3 - لا يمكن تبديل المنتج إذا ظهرت علية علامات الاستخدام .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>4 - يجب احضار السند الأصلي ( الفاتورة ).</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>5 - الضمان للسلع المضمونة من قبل المؤسسة يشمل صيانة المنتج من المشاكل الفنية فقط وليس ضمان استبدال واي عبث بالمنتج كالفك وقطع الاسلاك ونحوه يخرجه من الضمان.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>6 - في حال عدم ذكر مدة الضمان في الفاتورة فالسلعة غير مشمولة بالضمان.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>7 - مدة الضمان: حسب ماهو مذكور في الفاتورة الأصلية المختومة بالختم المعتمد للمؤسسة من تاريخ الشراء.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>8 - السلع المضمونة من الوكيل يكون المسؤل عن ضمانها هو وكيلها المعتمد وتطبق شروط و أحكام الوكيل في الضمان .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>9 - في حال رغب العميل إرجاع المنتج وفق الشروط السابقة فسيقوم المتجر بتزويد العميل ببوليصة استرجاع يتم استخدامها خلال ثمانية واربعون ساعة من استلامها وفي حال عدم استخدامها خلال هذه الفترة فيعتبر المنتج غير خاضع لسياسة الإسترجاع.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>10 - القطع التي يتم طلبها من مستودعات دولية لا يقبل إرجاعها نهائياً.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>11 - في حالة القطع غير صحيحة و الخطأ من طرفنا كون القطعة غير مطابقة لما هو مذكور في الموقع</strong></p>\r\n\r\n<p style=\"text-align:right\"><strong>يتحمل المتجر بشكل كامل إرجاع القطعة .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>12 - الاستثناءات من الضمان الكسور ,الأضرار الناتجة عن الحوادث أو سوء الاستخدام ,الأضرار الناتجة عن طريق الصيانة خارج مراكزنا.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>13 - للمتجر الحق في التعديل على سياسة الإسترجاع والاستبدال متى ما اقتضت الحاجة .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>14 - الاسترجاع أو الاستبدال الجزئي: في حال أن التوصيل كان مجاني بسبب تجاوز طلب العميل حد التوصيل المجاني ، ثم قام العميل باسترجاع/استبدال ( جزء من طلبه / كل طلبه ) و أصبح مجموع طلبه بعد التعديل تحت حد التوصيل المجاني ، فإنه يقوم بدفع مبلغ التوصيل .</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>15 - عدم استلام الطلب: في حالة رغب العميل من نفسه عدم استلام الطلب أو لم يقم بالرد على مناديب شركات التوصيل أو ظهر منه قصور في استلام الطلب بأي وجه كان ، فإنه يتحمل قيمة ارجاع الطلب.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>16 -</strong>&nbsp;<strong>في حال عدم توفر المنتج بعد الطلب في مستودعاتنا او نفاذه او تم وضعه سعره بشكل غير صحيح في الموقع يحتفظ شركة <span style=\"color:#e74c3c\">عربة&nbsp; </span>لنفسه بالحق في رفض أو إلغاء الطلب ولا يلزم توفيره في اي حال من الاحوال.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>17- المبالغ المستردة سوف تظهر في حساب العميل البنكي خلال 7-14 يوم عمل حسب البنك العميل.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>18 - تعد الموافقة على الطلب بمثابة موافقة على جميع الشروط والأحكام ولا يتحمل شركة <span style=\"color:#e74c3c\">عربة&nbsp; </span>عبء عدم أطلاع العميل عليها.</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>*للإلغاء او الاسترجاع يمكنك التواصل عبر القنوات الرسمية التالية فقط :</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>واتس اب : 920006356</strong></p>\r\n\r\n<p style=\"text-align:right\"><strong>بريد الالكتروني : Info@alkhidhrautoparts.com</strong></p>\r\n\r\n<p style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><strong>لا يعتبر الاتصال هاتفياً عذراً بحال من الأحوال.</strong></p>', 'uploads/setting/74521681165222.png', 'uploads/setting/59371681165222.ico', 'https://www.facebook.com/profile.php?id=100008665549360', 'https://instagram.com', 'https://www.linkedin.com/in/ahmed-samir-el-faramawy-399507232/', 'https://instagram.com', '+201004834728', 'ahmedelfaramawy84@gmail.com', NULL, '2023-04-10 20:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/Slider/90291680094217.jpg', '2023-03-29 10:46:20', '2023-03-29 10:50:17'),
(2, 'uploads/Slider/26901680094238.jpg', '2023-03-29 10:50:38', '2023-03-29 10:50:38'),
(3, 'uploads/Slider/95481680094256.jpg', '2023-03-29 10:50:56', '2023-03-29 10:50:56'),
(4, 'uploads/Slider/15331680094266.jpg', '2023-03-29 10:51:06', '2023-03-29 10:51:06'),
(5, 'uploads/Slider/31051680094280.jpg', '2023-03-29 10:51:20', '2023-03-29 10:51:20'),
(6, 'uploads/Slider/55271680094288.jpg', '2023-03-29 10:51:28', '2023-03-29 10:51:28'),
(7, 'uploads/Slider/19081680094297.jpg', '2023-03-29 10:51:37', '2023-03-29 10:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `block` enum('yes','no') NOT NULL DEFAULT 'no',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `block`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user1', 'a@a.com', '01004834728', NULL, '123456', 'no', NULL, NULL, '2023-03-29 11:12:53'),
(2, 'user2', 'a@a.com2', '010048347282', NULL, '123456', 'yes', NULL, NULL, '2023-03-29 11:12:56'),
(7, 'Ahmed Samir', 'admin@admin.com', NULL, NULL, '$2y$10$Qq6KhcX9QqPNMckBrgSts.8a3FBQLCHoPqn46sJBqOvlh8W5w/LLy', 'no', NULL, '2023-03-30 13:43:55', '2023-03-30 13:43:55'),
(8, 'Ahmed Samir', 'admn@admin.com', '201004834728', NULL, '$2y$10$NLgaspyyEymbl6xhA584Oeh9bB6z/avXjM4ApHKEyLbfmwUhHKzZu', 'no', NULL, '2023-03-30 13:46:47', '2023-03-30 13:46:47');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deseases`
--
ALTER TABLE `deseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_hospital_id_foreign` (`hospital_id`),
  ADD KEY `doctors_category_id_foreign` (`category_id`),
  ADD KEY `doctors_degree_id_foreign` (`degree_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_cat_id12` (`category_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD KEY `client45494_id` (`user_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_reservation_id_foreign` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_hospital_id_foreign` (`hospital_id`),
  ADD KEY `reservations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `reservation_deseases`
--
ALTER TABLE `reservation_deseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_deseases_desease_id_foreign` (`desease_id`),
  ADD KEY `reservation_deseases_reservation_id_foreign` (`reservation_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deseases`
--
ALTER TABLE `deseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `permission_sections`
--
ALTER TABLE `permission_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_token`
--
ALTER TABLE `phone_token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation_deseases`
--
ALTER TABLE `reservation_deseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD CONSTRAINT `ad_Per_per` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ad_per_admin_ID16` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_degree_id_foreign` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospital_cat_id12` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `per_sec_id` FOREIGN KEY (`section_id`) REFERENCES `permission_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phone_token`
--
ALTER TABLE `phone_token`
  ADD CONSTRAINT `phone_token_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_deseases`
--
ALTER TABLE `reservation_deseases`
  ADD CONSTRAINT `reservation_deseases_desease_id_foreign` FOREIGN KEY (`desease_id`) REFERENCES `deseases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_deseases_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
