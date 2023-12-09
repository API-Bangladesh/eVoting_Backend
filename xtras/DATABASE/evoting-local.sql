-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2023 at 06:31 AM
-- Server version: 8.0.30
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'voter', 'deleted', 2, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masud \",\"member_id\":\"654321\",\"category\":\"member\",\"email_address\":\"masud.ncse@gmail.com\",\"contact_number\":\"01770520203\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:37:42', '2023-12-08 16:37:42'),
(2, 'setting', 'updated', 1, 'App\\Models\\Setting', 1, 'App\\Models\\User', '{\"attributes\":{\"lock_qr_code\":null,\"lock_online_token\":null},\"old\":{\"lock_qr_code\":0,\"lock_online_token\":0}}', '2023-12-08 16:37:42', '2023-12-08 16:37:42'),
(8, 'voter', 'created', 6, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Rubel\",\"member_id\":\"455661\",\"category\":\"CTO\",\"email_address\":\"emailtorubel@gmail.com\",\"contact_number\":\"01832196673\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:42:53', '2023-12-08 16:42:53'),
(9, 'voter', 'created', 7, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Sadek\",\"member_id\":\"455662\",\"category\":\"SE\",\"email_address\":\"sadeksltn@gmail.com\",\"contact_number\":\"01521484839\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:42:53', '2023-12-08 16:42:53'),
(10, 'voter', 'created', 8, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"kawsar\",\"member_id\":\"455663\",\"category\":\"FD\",\"email_address\":\"kawsar.csestd@gmail.com\",\"contact_number\":\"01775686936\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:42:53', '2023-12-08 16:42:53'),
(11, 'voter', 'created', 9, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Miraz Ahmed\",\"member_id\":\"455664\",\"category\":\"MD\",\"email_address\":\"muahmed2@gmail.com \",\"contact_number\":\"01913275557\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:42:53', '2023-12-08 16:42:53'),
(12, 'voter', 'created', 10, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masudul Kabir\",\"member_id\":\"455665\",\"category\":\"DEV\",\"email_address\":\"masud.ncse@gmail.com\",\"contact_number\":\"01676717945\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:42:53', '2023-12-08 16:42:53'),
(13, 'voter', 'updated', 6, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455661.PNG\"},\"old\":{\"image\":null}}', '2023-12-08 16:43:42', '2023-12-08 16:43:42'),
(14, 'voter', 'updated', 7, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455662.JPG\"},\"old\":{\"image\":null}}', '2023-12-08 16:43:42', '2023-12-08 16:43:42'),
(15, 'voter', 'updated', 8, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455663.JPEG\"},\"old\":{\"image\":null}}', '2023-12-08 16:43:42', '2023-12-08 16:43:42'),
(16, 'voter', 'updated', 9, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455664.png\"},\"old\":{\"image\":null}}', '2023-12-08 16:43:42', '2023-12-08 16:43:42'),
(17, 'voter', 'updated', 10, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455665.jpg\"},\"old\":{\"image\":null}}', '2023-12-08 16:43:42', '2023-12-08 16:43:42'),
(18, 'voter', 'deleted', 6, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Rubel\",\"member_id\":\"455661\",\"category\":\"CTO\",\"email_address\":\"emailtorubel@gmail.com\",\"contact_number\":\"01832196673\",\"image\":\"uploads\\/2023\\/12\\/455661.PNG\",\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:44:32', '2023-12-08 16:44:32'),
(19, 'voter', 'deleted', 7, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Sadek\",\"member_id\":\"455662\",\"category\":\"SE\",\"email_address\":\"sadeksltn@gmail.com\",\"contact_number\":\"01521484839\",\"image\":\"uploads\\/2023\\/12\\/455662.JPG\",\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:44:32', '2023-12-08 16:44:32'),
(20, 'voter', 'deleted', 8, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"kawsar\",\"member_id\":\"455663\",\"category\":\"FD\",\"email_address\":\"kawsar.csestd@gmail.com\",\"contact_number\":\"01775686936\",\"image\":\"uploads\\/2023\\/12\\/455663.JPEG\",\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:44:32', '2023-12-08 16:44:32'),
(21, 'voter', 'deleted', 9, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Miraz Ahmed\",\"member_id\":\"455664\",\"category\":\"MD\",\"email_address\":\"muahmed2@gmail.com \",\"contact_number\":\"01913275557\",\"image\":\"uploads\\/2023\\/12\\/455664.png\",\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:44:32', '2023-12-08 16:44:32'),
(22, 'voter', 'deleted', 10, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masudul Kabir\",\"member_id\":\"455665\",\"category\":\"DEV\",\"email_address\":\"masud.ncse@gmail.com\",\"contact_number\":\"01676717945\",\"image\":\"uploads\\/2023\\/12\\/455665.jpg\",\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:44:32', '2023-12-08 16:44:32'),
(23, 'voter', 'created', 1, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Rubel\",\"member_id\":\"455661\",\"category\":\"CTO\",\"email_address\":\"emailtorubel@gmail.com\",\"contact_number\":\"01832196673\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(24, 'voter', 'created', 2, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Sadek\",\"member_id\":\"455662\",\"category\":\"SE\",\"email_address\":\"sadeksltn@gmail.com\",\"contact_number\":\"01521484839\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(25, 'voter', 'created', 3, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"kawsar\",\"member_id\":\"455663\",\"category\":\"FD\",\"email_address\":\"kawsar.csestd@gmail.com\",\"contact_number\":\"01775686936\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(26, 'voter', 'created', 4, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Miraz Ahmed\",\"member_id\":\"455664\",\"category\":\"MD\",\"email_address\":\"muahmed2@gmail.com \",\"contact_number\":\"01913275557\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(27, 'voter', 'created', 5, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masudul Kabir\",\"member_id\":\"455665\",\"category\":\"DEV\",\"email_address\":\"masud.ncse@gmail.com\",\"contact_number\":\"01676717945\",\"image\":null,\"is_online_voter\":null,\"is_checked_in\":null,\"status\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(28, 'voter', 'updated', 1, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455661.PNG\"},\"old\":{\"image\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(29, 'voter', 'updated', 2, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455662.JPG\"},\"old\":{\"image\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(30, 'voter', 'updated', 3, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455663.JPEG\"},\"old\":{\"image\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(31, 'voter', 'updated', 4, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455664.png\"},\"old\":{\"image\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(32, 'voter', 'updated', 5, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"image\":\"uploads\\/2023\\/12\\/455665.jpg\"},\"old\":{\"image\":null}}', '2023-12-08 16:49:30', '2023-12-08 16:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `voter_id` bigint UNSIGNED DEFAULT NULL,
  `form_data` json DEFAULT NULL,
  `is_approved` tinyint DEFAULT NULL,
  `is_declined` tinyint DEFAULT NULL,
  `declined_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint UNSIGNED NOT NULL,
  `total_voters` bigint DEFAULT NULL,
  `online_voters` bigint DEFAULT NULL,
  `offline_voters` bigint DEFAULT NULL,
  `vote_cast_online` bigint DEFAULT NULL,
  `vote_cast_offline` bigint DEFAULT NULL,
  `total_vote_cast` bigint DEFAULT NULL,
  `total_candidate` int DEFAULT NULL,
  `total_position` int DEFAULT NULL,
  `vote_by_candidate` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ballots`
--

CREATE TABLE `ballots` (
  `id` bigint UNSIGNED NOT NULL,
  `position_id` bigint UNSIGNED DEFAULT NULL,
  `vote_limit` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ballots`
--

INSERT INTO `ballots` (`id`, `position_id`, `vote_limit`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ballot_items`
--

CREATE TABLE `ballot_items` (
  `id` bigint UNSIGNED NOT NULL,
  `ballot_id` bigint UNSIGNED DEFAULT NULL,
  `candidate_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ballot_items`
--

INSERT INTO `ballot_items` (`id`, `ballot_id`, `candidate_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int DEFAULT NULL,
  `offline_vote_count` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `icon`, `counter`, `offline_vote_count`, `created_at`, `updated_at`) VALUES
(1, 'Md. Masudul Kabir', NULL, NULL, NULL, NULL, NULL),
(2, 'Abdul Kayum', NULL, NULL, NULL, NULL, NULL),
(3, 'Kawsar Ibn Siraj', NULL, NULL, NULL, NULL, NULL),
(4, 'Jiaur Rahman', NULL, NULL, NULL, NULL, NULL),
(5, 'Sadek Hossain', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint UNSIGNED NOT NULL,
  `counter_number` int DEFAULT NULL,
  `counter_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter_officer_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `counter_number`, `counter_name`, `counter_officer_id`, `created_at`, `updated_at`) VALUES
(1, 301, 'East Corner', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counter_officers`
--

CREATE TABLE `counter_officers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_officers`
--

INSERT INTO `counter_officers` (`id`, `name`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Md. Sadek', 'He is honest.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` int UNSIGNED NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` text COLLATE utf8mb4_unicode_ci,
  `attachments` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` tinyint DEFAULT NULL,
  `receiver_type_id` tinyint DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `sms` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int DEFAULT NULL,
  `sent_logs` json DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `category_id`, `receiver_type_id`, `subject`, `body`, `sms`, `counter`, `sent_logs`, `schedule_date`, `schedule_time`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Online Application Form', 'Please Visit the url for online vote approval', 'Please Visit the url for online vote approval', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, 'Online Vote Casting Invitation', 'Please Visit the url for online vote Cast', 'Please Visit the url for online vote Cast', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_01_151049_create_activity_log_table', 1),
(2, '2014_10_12_000000_create_counter_officers_table', 1),
(3, '2014_10_12_000001_create_counters_table', 1),
(4, '2014_10_12_000002_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2015_07_31_100000_create_email_logs_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_11_15_055301_create_voters_table', 1),
(10, '2021_11_15_055638_create_applications_table', 1),
(11, '2021_11_15_055711_create_tokens_table', 1),
(12, '2021_11_15_055742_create_qr_codes_table', 1),
(13, '2021_11_15_055804_create_positions_table', 1),
(14, '2021_11_15_055825_create_candidates_table', 1),
(15, '2021_11_15_055842_create_ballots_table', 1),
(16, '2021_11_15_055843_create_ballot_items_table', 1),
(17, '2021_11_15_055902_create_votes_table', 1),
(18, '2021_11_15_055954_create_settings_table', 1),
(19, '2021_11_29_083434_create_email_templates_table', 1),
(20, '2021_12_05_115900_create_jobs_table', 1),
(21, '2021_12_08_074127_create_offline_tokens_table', 1),
(22, '2022_01_25_113633_create_archives_table', 1),
(23, '2022_02_28_201713_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `offline_tokens`
--

CREATE TABLE `offline_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `voter_id` bigint UNSIGNED DEFAULT NULL,
  `counter_id` bigint UNSIGNED DEFAULT NULL,
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(2, 'read voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(3, 'update voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(4, 'delete voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(5, 'delete-permanently voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(6, 'search voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(7, 'trash voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(8, 'restore voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(9, 'import voters', 'web', '2023-12-08 16:30:50', '2023-12-08 16:30:50'),
(10, 'export voters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(11, 'read-online-voters voters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(12, 'read-offline-voters voters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(13, 'create positions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(14, 'read positions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(15, 'update positions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(16, 'delete positions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(17, 'create candidates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(18, 'read candidates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(19, 'update candidates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(20, 'delete candidates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(21, 'export candidates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(22, 'create counters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(23, 'read counters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(24, 'update counters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(25, 'delete counters', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(26, 'create counter-officers', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(27, 'read counter-officers', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(28, 'update counter-officers', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(29, 'delete counter-officers', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(30, 'create ballots', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(31, 'read ballots', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(32, 'update ballots', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(33, 'delete ballots', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(34, 'read activity-logs', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(35, 'search activity-logs', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(36, 'read email-logs', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(37, 'search email-logs', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(38, 'create email-templates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(39, 'read email-templates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(40, 'update email-templates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(41, 'delete email-templates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(42, 'send email-templates', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(43, 'create roles', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(44, 'read roles', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(45, 'update roles', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(46, 'delete roles', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(47, 'assign-permissions roles', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(48, 'create permissions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(49, 'read permissions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(50, 'update permissions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(51, 'delete permissions', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(52, 'read tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(53, 'generate tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(54, 'lock tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(55, 'create users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(56, 'read users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(57, 'update users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(58, 'trash users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(59, 'restore users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(60, 'delete users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(61, 'update-profile users', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(62, 'read qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(63, 'generate qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(64, 'export qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(65, 'lock qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(66, 'validate-ballots qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(67, 'verify-ballots qr-codes', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(68, 'create offline-tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(69, 'read offline-tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(70, 'search offline-tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(71, 're-print offline-tokens', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(72, 'read settings', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(73, 'update settings', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(74, 'update-actions settings', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(75, 'update-print-config settings', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(76, 'update-voting-schedule settings', 'web', '2023-12-08 16:30:51', '2023-12-08 16:30:51'),
(77, 'update-email-config settings', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(78, 'update-sms-config settings', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(79, 'test-devices-services settings', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(80, 'db-clean settings', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(81, 'create-form applications', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(82, 'read-submissions applications', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(83, 'export-submissions applications', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(84, 'approve-submissions applications', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(85, 'decline-submissions applications', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(86, 'read voting-results', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(87, 'upload-voting-results voting-results', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(88, 'create articles', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(89, 'read articles', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(90, 'update articles', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(91, 'delete articles', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'President', NULL, NULL),
(2, 'Director', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_used` tinyint DEFAULT NULL,
  `scan_blank_ballot` timestamp NULL DEFAULT NULL,
  `scan_voted_ballot` timestamp NULL DEFAULT NULL,
  `validated_by` bigint UNSIGNED DEFAULT NULL,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(2, 'Admin', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52'),
(3, 'Officer', 'web', '2023-12-08 16:30:52', '2023-12-08 16:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(88, 3),
(89, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `organization_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `logo_type` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `election_schedule_date` date DEFAULT NULL,
  `election_interval` tinyint DEFAULT NULL,
  `application_submission_form` json DEFAULT NULL,
  `online_application_form_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online_voting_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `election_year` year DEFAULT NULL,
  `voting_schedule_start_date` date DEFAULT NULL,
  `voting_schedule_start_time` time DEFAULT NULL,
  `voting_schedule_end_time` time DEFAULT NULL,
  `application_subscription_start_date` date DEFAULT NULL,
  `application_subscription_end_date` date DEFAULT NULL,
  `ballot_merge_all` tinyint(1) DEFAULT NULL,
  `officer_secret_code` int DEFAULT NULL,
  `lock_qr_code` tinyint(1) DEFAULT NULL,
  `lock_online_token` tinyint(1) DEFAULT NULL,
  `disable_common_users_login` tinyint(1) DEFAULT NULL,
  `disable_voters_import` tinyint(1) DEFAULT NULL,
  `disable_voters_deletion` tinyint(1) DEFAULT NULL,
  `disable_permanently_voters_deletion` tinyint(1) DEFAULT NULL,
  `offline_checked_in_status` tinyint(1) DEFAULT NULL,
  `display_voting_result` tinyint(1) DEFAULT NULL,
  `disable_offline_voting_result_upload` tinyint(1) DEFAULT NULL,
  `enable_sms_gateway_service` tinyint(1) DEFAULT NULL,
  `enable_voting_functions` tinyint(1) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  `mail_mailer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` int DEFAULT NULL,
  `mail_encryption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aws_access_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aws_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aws_region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token_sslwireless` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain_sslwireless` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sid_sslwireless` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ballot_print` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orientation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `max_limit` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `organization_name`, `address`, `logo_type`, `icon`, `election_schedule_date`, `election_interval`, `application_submission_form`, `online_application_form_url`, `online_voting_url`, `election_year`, `voting_schedule_start_date`, `voting_schedule_start_time`, `voting_schedule_end_time`, `application_subscription_start_date`, `application_subscription_end_date`, `ballot_merge_all`, `officer_secret_code`, `lock_qr_code`, `lock_online_token`, `disable_common_users_login`, `disable_voters_import`, `disable_voters_deletion`, `disable_permanently_voters_deletion`, `offline_checked_in_status`, `display_voting_result`, `disable_offline_voting_result_upload`, `enable_sms_gateway_service`, `enable_voting_functions`, `archive`, `mail_mailer`, `mail_host`, `mail_port`, `mail_encryption`, `mail_username`, `mail_password`, `mail_from_name`, `mail_from_address`, `aws_access_key`, `aws_secret_key`, `aws_region`, `api_token_sslwireless`, `domain_sslwireless`, `sid_sslwireless`, `ballot_print`, `print_code`, `position`, `orientation`, `paper_size`, `width`, `height`, `max_limit`, `created_at`, `updated_at`) VALUES
(1, 'Advanced Project Integration Ltd.', 'House 04, Flat, 7A Rd #23/a, Dhaka 1213', 'text-logo', NULL, '2023-12-18', 2, '[{\"name\": \"name\", \"type\": \"text\", \"label\": \"Full Name\", \"required\": \"true\", \"placeholder\": \"Enter your full name.\"}, {\"name\": \"email\", \"type\": \"email\", \"label\": \"Email Address\", \"required\": \"true\", \"placeholder\": \"Enter a valid email address.\"}, {\"name\": \"member_id\", \"type\": \"text\", \"label\": \"Member ID\", \"required\": \"true\", \"placeholder\": \"Enter a valid member id.\"}, {\"name\": \"phone\", \"type\": \"number\", \"label\": \"Phone Number\", \"required\": \"true\", \"placeholder\": \"Enter your phone number.\"}]', NULL, NULL, 2022, '2023-12-18', '10:00:00', '22:00:00', '2023-12-07', '2023-12-14', 1, 123456, NULL, NULL, 0, 0, 0, 0, 1, 1, 0, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'barcode', 'top-left', 'portrait', 'a4', NULL, NULL, 100, NULL, '2023-12-08 16:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `voter_id` bigint UNSIGNED DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` bigint DEFAULT NULL,
  `is_used` tinyint DEFAULT NULL,
  `is_sent_email` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_officer_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `image`, `password`, `counter_officer_id`, `email_verified_at`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', 'superadmin@demo.com', NULL, '$2y$10$JHPcOOYIwT5ia7ug8nG9WOOzlEAN1UYJf8bhwhIFMQ7fsw7ICmtHO', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'admin', 'Admin', 'admin@demo.com', NULL, '$2y$10$8cWieGtk7MKAsrQtmHKnHuOGu3X9zpSbgRyte0LX8GNjehqmbfb06', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'officer', 'Officer', 'officer@demo.com', NULL, '$2y$10$JthqihHdu4ZECfwnmKMqReTWRpaOBKC3H4k8DHR4ci8/n0WVOX.iS', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_online_voter` tinyint DEFAULT NULL,
  `is_checked_in` tinyint DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `name`, `member_id`, `category`, `email_address`, `contact_number`, `image`, `is_online_voter`, `is_checked_in`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Rubel', '455661', 'CTO', 'emailtorubel@gmail.com', '01832196673', 'uploads/2023/12/455661.PNG', NULL, NULL, NULL, '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(2, 'Sadek', '455662', 'SE', 'sadeksltn@gmail.com', '01521484839', 'uploads/2023/12/455662.JPG', NULL, NULL, NULL, '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(3, 'kawsar', '455663', 'FD', 'kawsar.csestd@gmail.com', '01775686936', 'uploads/2023/12/455663.JPEG', NULL, NULL, NULL, '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(4, 'Miraz Ahmed', '455664', 'MD', 'muahmed2@gmail.com ', '01913275557', 'uploads/2023/12/455664.png', NULL, NULL, NULL, '2023-12-08 16:49:30', '2023-12-08 16:49:30'),
(5, 'Md. Masudul Kabir', '455665', 'DEV', 'masud.ncse@gmail.com', '01676717945', 'uploads/2023/12/455665.jpg', NULL, NULL, NULL, '2023-12-08 16:49:30', '2023-12-08 16:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint UNSIGNED NOT NULL,
  `candidate_ids` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applications_voter_id_unique` (`voter_id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ballots`
--
ALTER TABLE `ballots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ballots_position_id_unique` (`position_id`);

--
-- Indexes for table `ballot_items`
--
ALTER TABLE `ballot_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ballot_items_ballot_id_foreign` (`ballot_id`),
  ADD KEY `ballot_items_candidate_id_foreign` (`candidate_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidates_name_unique` (`name`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `counters_counter_number_unique` (`counter_number`),
  ADD UNIQUE KEY `counters_counter_name_unique` (`counter_name`),
  ADD UNIQUE KEY `counters_counter_officer_id_unique` (`counter_officer_id`);

--
-- Indexes for table `counter_officers`
--
ALTER TABLE `counter_officers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `counter_officers_name_unique` (`name`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `offline_tokens`
--
ALTER TABLE `offline_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offline_tokens_voter_id_unique` (`voter_id`),
  ADD UNIQUE KEY `offline_tokens_token_unique` (`token`),
  ADD UNIQUE KEY `offline_tokens_phone_unique` (`phone`),
  ADD KEY `offline_tokens_counter_id_foreign` (`counter_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_name_unique` (`name`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qr_codes_code_unique` (`code`),
  ADD KEY `qr_codes_validated_by_foreign` (`validated_by`),
  ADD KEY `qr_codes_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tokens_voter_id_unique` (`voter_id`),
  ADD UNIQUE KEY `tokens_token_unique` (`token`),
  ADD UNIQUE KEY `tokens_otp_unique` (`otp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_counter_officer_id_unique` (`counter_officer_id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voters_member_id_unique` (`member_id`),
  ADD UNIQUE KEY `voters_email_address_unique` (`email_address`),
  ADD UNIQUE KEY `voters_contact_number_unique` (`contact_number`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ballots`
--
ALTER TABLE `ballots`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ballot_items`
--
ALTER TABLE `ballot_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counter_officers`
--
ALTER TABLE `counter_officers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `offline_tokens`
--
ALTER TABLE `offline_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`);

--
-- Constraints for table `ballots`
--
ALTER TABLE `ballots`
  ADD CONSTRAINT `ballots_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Constraints for table `ballot_items`
--
ALTER TABLE `ballot_items`
  ADD CONSTRAINT `ballot_items_ballot_id_foreign` FOREIGN KEY (`ballot_id`) REFERENCES `ballots` (`id`),
  ADD CONSTRAINT `ballot_items_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`);

--
-- Constraints for table `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_counter_officer_id_foreign` FOREIGN KEY (`counter_officer_id`) REFERENCES `counter_officers` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offline_tokens`
--
ALTER TABLE `offline_tokens`
  ADD CONSTRAINT `offline_tokens_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`),
  ADD CONSTRAINT `offline_tokens_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`);

--
-- Constraints for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD CONSTRAINT `qr_codes_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `qr_codes_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_counter_officer_id_foreign` FOREIGN KEY (`counter_officer_id`) REFERENCES `counter_officers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
