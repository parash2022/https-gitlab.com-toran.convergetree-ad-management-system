-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2021 at 09:13 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitb8i_admanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `adtype_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `platform_id`, `client_id`, `adtype_id`, `title`, `url`, `image`, `publish_date`, `expiry`, `created_at`, `updated_at`) VALUES
(7, 2, 3, 16, 'Berger Paint Dashai dhamaka', 'https://www.bergerpaints.com/', 'uploads/2020/10/1602223706-430290.jpeg', '2020-10-06', '2020-10-30', '2020-10-09 06:08:27', '2020-10-09 06:08:27'),
(8, 3, 2, 15, 'Super six Campaign', 'https://www.nicasiabank.com/', 'uploads/2020/10/1602223816-736692.png', '2020-10-09', '2020-11-19', '2020-10-09 06:10:17', '2020-10-12 12:03:16'),
(9, 3, 5, 14, 'Dashain Offer', 'https://esumegh.com/', 'uploads/2020/10/1602245147-424460.png', '2020-10-09', '2021-01-14', '2020-10-09 12:05:21', '2021-01-22 11:39:51'),
(10, 3, 6, 14, 'Toyota Dashain Offer', 'https://bizmandu.com/', 'uploads/2021/04/1617258545-810457.jpeg', '2020-10-15', '2021-05-19', '2020-10-11 04:28:32', '2021-04-01 06:29:05'),
(18, 3, 3, 14, 'Berger Paint Dashai dhamaka -  Copy', 'https://www.bergerpaints.com/', 'uploads/2021/01/1611724145-985009.png', '2021-01-01', '2021-04-30', '2020-10-12 11:56:06', '2021-03-05 05:53:08'),
(19, 3, 7, 14, 'Ruslan', 'https://www.ruslanvodka.com/', 'uploads/2021/01/1611655082-108005.png', '2021-01-20', '2021-04-30', '2020-10-22 05:25:06', '2021-03-05 05:49:56'),
(20, 3, 6, 14, 'Jawa Ad', 'https://convergetree.com/', 'uploads/2021/03/1616740153-421103.jpeg', '2021-03-25', '2021-07-25', '2021-03-25 07:06:48', '2021-03-26 06:29:13'),
(21, 3, 7, 14, 'Nebico Biscuits', 'https://wicketnrun.com', 'uploads/2021/03/1616741525-693256.jpeg', '2021-03-25', '2021-08-17', '2021-03-25 07:07:35', '2021-03-26 06:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `ad_term`
--

CREATE TABLE `ad_term` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_term`
--

INSERT INTO `ad_term` (`id`, `ad_id`, `term_id`, `created_at`, `updated_at`) VALUES
(18, 7, 2, NULL, NULL),
(19, 7, 10, NULL, NULL),
(20, 8, 3, NULL, NULL),
(21, 8, 13, NULL, NULL),
(22, 9, 2, NULL, NULL),
(23, 9, 6, NULL, NULL),
(24, 10, 2, NULL, NULL),
(40, 18, 2, NULL, NULL),
(42, 19, 2, NULL, NULL),
(43, 19, 6, NULL, NULL),
(46, 10, 17, NULL, NULL),
(47, 18, 18, NULL, NULL),
(48, 20, 2, NULL, NULL),
(49, 20, 28, NULL, NULL),
(50, 21, 2, NULL, NULL),
(51, 21, 28, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'NIC Asia', '2020-10-06 06:03:44', '2020-10-06 15:12:48'),
(3, 'Berger Paints', '2020-10-06 14:56:45', '2020-10-06 15:13:03'),
(4, 'Mahindra Motors', '2020-10-06 15:08:35', '2020-10-06 15:13:47'),
(5, 'ChoiceGoody', '2020-10-09 12:05:21', '2020-10-10 13:11:09'),
(6, 'Toyota', '2020-10-11 04:28:32', '2020-10-11 04:28:32'),
(7, 'Rushlan', '2020-10-22 05:25:06', '2020-10-22 05:25:06'),
(8, 'NCell', '2021-04-01 06:12:59', '2021-04-01 06:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(70, '2014_10_12_000000_create_users_table', 1),
(71, '2014_10_12_100000_create_password_resets_table', 1),
(72, '2020_05_28_072753_create_roles_table', 1),
(73, '2020_05_28_083358_create_role_user_table', 1),
(74, '2020_08_02_052207_create_settings_table', 1),
(75, '2020_08_04_045349_create_pages_table', 1),
(76, '2020_08_04_093706_create_posts_table', 1),
(77, '2020_08_06_055240_create_taxonomies_table', 1),
(78, '2020_08_06_062001_create_terms_table', 1),
(79, '2020_08_06_111224_create_post_term_table', 1),
(80, '2020_08_16_083945_create_vendor_profiles_table', 1),
(81, '2020_08_16_084007_create_vendor_contacts_table', 1),
(82, '2020_08_16_084030_create_vendor_documents_table', 1),
(83, '2020_08_27_061907_create_vendor_term_table', 2),
(84, '2020_08_27_062842_create_term_user_table', 3),
(85, '2020_08_30_065630_create_jobs_table', 4),
(86, '2020_10_03_164625_create_ads_table', 5),
(87, '2020_10_04_100957_create_ad_term_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Desktop', NULL, NULL),
(2, 'Mobile', NULL, NULL),
(3, 'App', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_term`
--

CREATE TABLE `post_term` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `term_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(2, 'Moderator', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(3, 'Author', '2020-08-18 00:18:00', '2020-08-18 00:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 2, 5, NULL, NULL),
(5, 2, 6, NULL, NULL),
(6, 2, 7, NULL, NULL),
(7, 2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `svalue` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `skey`, `svalue`, `created_at`, `updated_at`) VALUES
(1, 'site__url', 'http://localhost/vr', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(2, 'site__path', 'D:\\xampp\\htdocs\\vr', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(3, 'site__title', 'Laraverge', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(4, 'site__tagline', 'Do something better', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(5, 'site__admin_email', 'admin@laraverge.com', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(6, 'site__language', 'en', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(7, 'site__timezone', 'America/New_York', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(8, 'site__date_format', 'd M, Y', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(9, 'site__time_format', 'g:i A', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(10, 'site__mail_from', 'donotreply@laraverge.com', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(11, 'site__mail_from_name', 'Laraverge', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(12, 'site__mail_driver', 'smtp', '2020-08-18 00:18:00', '2020-09-07 00:29:10'),
(13, 'site__mail_port', '2525', '2020-08-18 00:18:00', '2020-08-30 23:49:17'),
(14, 'site__mail_host', 'smtp.mailtrap.io', '2020-08-18 00:18:00', '2020-08-30 23:49:17'),
(15, 'site__mail_username', '74298db830a823', '2020-08-18 00:18:00', '2020-08-30 23:49:17'),
(16, 'site__mail_password', '388ba6d02d5706', '2020-08-18 00:18:00', '2020-08-30 23:49:17'),
(17, 'site__mail_ecryption', '0', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(18, 'site__social_media_links', '[\"https:\\/\\/www.facebook.com\\/\",\"https:\\/\\/twitter.com\\/\"]', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(19, 'site__page_taxonomies', '[]', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(20, 'site__post_taxonomies', '[\"1\"]', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(21, 'site__active_theme', 'default', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(22, 'site__vendor_taxonomies', '[\"2\"]', '2020-08-18 00:18:00', '2020-08-18 00:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'category', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(2, 'Ad Category', 'ad-category', '2020-08-20 01:06:53', '2020-08-20 01:06:53'),
(3, 'Ad Type', 'ad-type', '2020-08-20 01:06:53', '2020-08-20 01:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_id` bigint(20) NOT NULL,
  `term_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `queryKey` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `taxonomy_id`, `term_id`, `queryKey`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Uncategorized', 'uncategorized', '2020-08-18 00:18:00', '2020-08-18 00:18:00'),
(2, 2, NULL, 'HP', 'Home Page', 'home-page', '2020-08-20 01:07:11', '2021-01-29 11:04:56'),
(3, 2, NULL, 'IP', 'Inner Page', 'inner-page', '2020-08-20 01:07:26', '2021-01-29 11:05:20'),
(6, 2, '2', 'HPTB', 'Top Banner', 'top-banner', '2020-08-27 00:20:19', '2021-01-29 11:05:03'),
(10, 2, '2', 'HPSB', 'Side Banner', 'side-banner', '2020-10-05 03:03:50', '2021-01-29 11:05:13'),
(12, 2, '3', 'IPTABN', 'Title Ad - Below News title', 'title-ad-below-news-title', '2020-10-05 05:00:55', '2021-01-29 11:05:26'),
(13, 2, '3', 'IPCA', 'Content Ads', 'content-ads', '2020-10-05 05:01:13', '2021-01-29 11:05:31'),
(14, 3, NULL, NULL, 'Generic', 'generic', '2020-10-06 15:00:01', '2020-10-06 15:00:01'),
(15, 3, NULL, NULL, 'Splash', 'splash', '2020-10-06 15:00:14', '2020-10-06 15:00:14'),
(16, 3, NULL, NULL, 'Popup', 'popup', '2020-10-06 15:00:38', '2020-10-06 15:00:38'),
(17, 2, '2', 'HPCBTB', 'Category Bishesh Top Banner', 'category-bishesh-top-banner', '2021-01-29 11:28:38', '2021-01-29 11:28:38'),
(18, 2, '2', 'HPMSB', 'MukhyaSamachar Banner', 'mukhyasamachar-banner', '2021-02-25 10:40:31', '2021-02-25 10:41:47'),
(19, 2, '2', 'HPSB', 'Samachar Banner', 'samachar-banner', '2021-02-25 10:40:55', '2021-02-25 10:41:56'),
(20, 2, '2', 'HPDB', 'Desh Banner', 'desh-banner', '2021-02-25 10:41:07', '2021-02-25 10:42:04'),
(21, 2, '2', 'HPCB', 'Coporate Banner', 'coporate-banner', '2021-02-25 10:41:28', '2021-02-25 10:42:13'),
(22, 2, '2', 'HPSMB', 'Stock Market Banner', 'stock-market-banner', '2021-02-25 10:42:36', '2021-02-25 10:42:36'),
(23, 2, '2', 'HPAB', 'Auto Banner', 'auto-banner', '2021-02-25 10:42:58', '2021-02-25 10:42:58'),
(24, 2, '2', 'HPRB', 'Retail Banner', 'retail-banner', '2021-02-25 10:43:09', '2021-02-25 10:43:09'),
(25, 2, '2', 'HPICTB', 'ICT Banner', 'ict-banner', '2021-02-25 10:43:22', '2021-02-25 10:43:22'),
(26, 2, '2', 'HPRB', 'Rajgaar Banner', 'rajgaar-banner', '2021-02-25 10:43:38', '2021-02-25 10:43:38'),
(27, 2, '2', 'HPLSB', 'LifeStyle Banner', 'lifestyle-banner', '2021-02-25 10:44:08', '2021-02-25 10:44:08'),
(28, 2, '2', 'HPBCA', 'Bishesh Content Ad', 'bishesh-content-ad', '2021-02-25 10:44:46', '2021-02-25 10:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `term_user`
--

CREATE TABLE `term_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `term_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_user`
--

INSERT INTO `term_user` (`id`, `user_id`, `term_id`, `created_at`, `updated_at`) VALUES
(1, 25, 2, NULL, NULL),
(2, 25, 6, NULL, NULL),
(3, 25, 7, NULL, NULL),
(4, 26, 2, NULL, NULL),
(5, 26, 6, NULL, NULL),
(6, 26, 7, NULL, NULL),
(7, 27, 2, NULL, NULL),
(8, 27, 6, NULL, NULL),
(9, 27, 7, NULL, NULL),
(10, 29, 2, NULL, NULL),
(11, 29, 6, NULL, NULL),
(12, 29, 7, NULL, NULL),
(14, 31, 2, NULL, NULL),
(15, 31, 6, NULL, NULL),
(16, 31, 7, NULL, NULL),
(17, 32, 2, NULL, NULL),
(18, 32, 6, NULL, NULL),
(19, 32, 7, NULL, NULL),
(20, 33, 2, NULL, NULL),
(21, 33, 6, NULL, NULL),
(22, 34, 2, NULL, NULL),
(23, 34, 6, NULL, NULL),
(24, 34, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lara', 'admin@ams.com', '2020-08-18 00:18:00', '$2y$10$ueSJnnYzT.9CPje6PjcI1eRlzSnqsLGB8VLeXV2nsnD7bYleggYtu', 'EL2qGiibdXO3OqjZfAVJuWT0RdGptyDJHL33qwYWaQd2teQHQzwzP4NJFzpX', '2020-08-18 00:18:00', '2020-08-18 00:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_term`
--
ALTER TABLE `ad_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`(191));

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_term`
--
ALTER TABLE `post_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomies`
--
ALTER TABLE `taxonomies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_user`
--
ALTER TABLE `term_user`
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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ad_term`
--
ALTER TABLE `ad_term`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_term`
--
ALTER TABLE `post_term`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `term_user`
--
ALTER TABLE `term_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
