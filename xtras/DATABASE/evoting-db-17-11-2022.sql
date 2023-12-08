-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2022 at 03:26 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'candidate', 'updated', 1, 'App\\Models\\Candidate', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masudul Kabir 3\"},\"old\":{\"name\":\"Md. Masudul Kabir\"}}', '2022-11-17 15:00:59', '2022-11-17 15:00:59'),
(2, 'candidate', 'updated', 1, 'App\\Models\\Candidate', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Md. Masudul Kabir\"},\"old\":{\"name\":\"Md. Masudul Kabir 3\"}}', '2022-11-17 15:06:37', '2022-11-17 15:06:37'),
(3, 'permission', 'created', 5, 'App\\Models\\Permission', 1, 'App\\Models\\User', '[]', '2022-11-17 15:09:34', '2022-11-17 15:09:34'),
(4, 'user', 'created', 4, 'App\\Models\\User', 1, 'App\\Models\\User', '{\"attributes\":{\"username\":\"1@f.com\",\"name\":\"ddd\",\"email\":\"1@f.com\",\"password\":\"$2y$10$HHJVQWCRI\\/HW63kslL3YS.VljLx5rSS6\\/wBP9O1OwAfqiS\\/0EPxEa\",\"image\":null,\"counter_officer_id\":null,\"permissions\":null,\"status\":null}}', '2022-11-17 15:10:14', '2022-11-17 15:10:14'),
(5, 'permission', 'created', 6, 'App\\Models\\Permission', 1, 'App\\Models\\User', '[]', '2022-11-17 15:10:14', '2022-11-17 15:10:14'),
(6, 'permission', 'created', 7, 'App\\Models\\Permission', 1, 'App\\Models\\User', '[]', '2022-11-17 15:10:14', '2022-11-17 15:10:14'),
(7, 'permission', 'created', 8, 'App\\Models\\Permission', 1, 'App\\Models\\User', '[]', '2022-11-17 15:10:30', '2022-11-17 15:10:30'),
(8, 'permission', 'created', 9, 'App\\Models\\Permission', 1, 'App\\Models\\User', '[]', '2022-11-17 15:10:30', '2022-11-17 15:10:30'),
(9, 'permission', 'created', 10, 'App\\Models\\Permission', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"voting_schedule\",\"guard_name\":\"web\"}}', '2022-11-17 15:11:34', '2022-11-17 15:11:34'),
(10, 'setting', 'updated', 1, 'App\\Models\\Setting', 1, 'App\\Models\\User', '{\"attributes\":{\"enable_sms_gateway_service\":1},\"old\":{\"enable_sms_gateway_service\":0}}', '2022-11-17 15:15:00', '2022-11-17 15:15:00'),
(11, 'voter', 'created', 3, 'App\\Models\\Voter', 1, 'App\\Models\\User', '{\"attributes\":{\"name\":\"xusi@mailinator.com\",\"member_id\":\"Ipsum quod cupidata\",\"category\":\"Beatae ex adipisicin\",\"email_address\":\"xezaqefe@mailinator.com\",\"contact_number\":\"213\",\"image\":\"uploads\\/2022\\/11\\/qBrQ1akmVX0L.jpg\",\"token\":null,\"is_online_voter\":null,\"is_checked_in\":null}}', '2022-11-17 15:16:59', '2022-11-17 15:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `form_data` json DEFAULT NULL,
  `is_approved` tinyint(4) DEFAULT NULL,
  `is_declined` tinyint(4) DEFAULT NULL,
  `declined_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `applications_voter_id_unique` (`voter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `voter_id`, `form_data`, `is_approved`, `is_declined`, `declined_reason`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"name\": \"Md. Rubel Hossain\", \"email\": \"rubel@gmail.com\", \"phone\": \"01676717945\", \"member_id\": \"123456\"}', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

DROP TABLE IF EXISTS `archives`;
CREATE TABLE IF NOT EXISTS `archives` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_voters` bigint(20) DEFAULT NULL,
  `online_voters` bigint(20) DEFAULT NULL,
  `offline_voters` bigint(20) DEFAULT NULL,
  `vote_cast_online` bigint(20) DEFAULT NULL,
  `vote_cast_offline` bigint(20) DEFAULT NULL,
  `total_vote_cast` bigint(20) DEFAULT NULL,
  `total_candidate` int(11) DEFAULT NULL,
  `total_position` int(11) DEFAULT NULL,
  `vote_by_candidate` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ballots`
--

DROP TABLE IF EXISTS `ballots`;
CREATE TABLE IF NOT EXISTS `ballots` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vote_limit` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ballots_position_id_unique` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `ballot_items`;
CREATE TABLE IF NOT EXISTS `ballot_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ballot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `candidate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ballot_items_ballot_id_foreign` (`ballot_id`),
  KEY `ballot_items_candidate_id_foreign` (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `offline_vote_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidates_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `icon`, `counter`, `offline_vote_count`, `created_at`, `updated_at`) VALUES
(1, 'Md. Masudul Kabir', NULL, NULL, NULL, NULL, '2022-11-17 15:06:37'),
(2, 'Abdul Kayum', NULL, NULL, NULL, NULL, NULL),
(3, 'Kawsar Ibn Siraj', NULL, NULL, NULL, NULL, NULL),
(4, 'Jiaur Rahman', NULL, NULL, NULL, NULL, NULL),
(5, 'Sadek Hossain', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `counter_number` int(11) DEFAULT NULL,
  `counter_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter_officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `counters_counter_number_unique` (`counter_number`),
  UNIQUE KEY `counters_counter_officer_id_unique` (`counter_officer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `counter_number`, `counter_name`, `counter_officer_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'East', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counter_officers`
--

DROP TABLE IF EXISTS `counter_officers`;
CREATE TABLE IF NOT EXISTS `counter_officers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `counter_officers_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_officers`
--

INSERT INTO `counter_officers` (`id`, `name`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Md. Sadek', 'He is honest.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) DEFAULT NULL,
  `receiver_type_id` tinyint(4) DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `sms` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `category_id`, `receiver_type_id`, `subject`, `body`, `sms`, `schedule_date`, `schedule_time`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Online Application Form', 'Please Visit the url for online vote approval', 'Please Visit the url for online vote approval', NULL, NULL, NULL, NULL),
(2, 2, NULL, 'Online Vote Casting Invitation', 'Please Visit the url for online vote Cast', 'Please Visit the url for online vote Cast', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"afd0f410-0cc5-461a-97c9-271c09a71721\",\"displayName\":\"App\\\\Jobs\\\\SmsSendingJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SmsSendingJob\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\SmsSendingJob\\\":12:{s:32:\\\"\\u0000App\\\\Jobs\\\\SmsSendingJob\\u0000receiver\\\";s:17:\\\"+1 (919) 377-7696\\\";s:31:\\\"\\u0000App\\\\Jobs\\\\SmsSendingJob\\u0000message\\\";s:109:\\\"Dolore quibusdam consectetur doloribus magna consequatur Deleniti perspiciatis sed nulla incidunt non commodo\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1668698104, 1668698104);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_01_151049_create_activity_log_table', 1),
(2, '2014_10_12_000000_create_counter_officers_table', 1),
(3, '2014_10_12_000001_create_counters_table', 1),
(4, '2014_10_12_000002_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2021_11_15_055301_create_voters_table', 1),
(9, '2021_11_15_055638_create_applications_table', 1),
(10, '2021_11_15_055711_create_tokens_table', 1),
(11, '2021_11_15_055742_create_qr_codes_table', 1),
(12, '2021_11_15_055804_create_positions_table', 1),
(13, '2021_11_15_055825_create_candidates_table', 1),
(14, '2021_11_15_055842_create_ballots_table', 1),
(15, '2021_11_15_055843_create_ballot_items_table', 1),
(16, '2021_11_15_055902_create_votes_table', 1),
(17, '2021_11_15_055954_create_settings_table', 1),
(18, '2021_11_29_083434_create_email_templates_table', 1),
(19, '2021_12_05_115900_create_jobs_table', 1),
(20, '2021_12_08_074127_create_offline_tokens_table', 1),
(21, '2022_01_25_113633_create_archives_table', 1),
(22, '2022_02_28_201713_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(5, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 4),
(8, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 4),
(10, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offline_tokens`
--

DROP TABLE IF EXISTS `offline_tokens`;
CREATE TABLE IF NOT EXISTS `offline_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `counter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` int(11) DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offline_tokens_token_unique` (`token`),
  KEY `offline_tokens_voter_id_foreign` (`voter_id`),
  KEY `offline_tokens_counter_id_foreign` (`counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create articles', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(2, 'read articles', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(3, 'update articles', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(4, 'delete articles', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(5, 'import_voter_data', 'web', '2022-11-17 15:09:34', '2022-11-17 15:09:34'),
(6, 'application_form', 'web', '2022-11-17 15:10:14', '2022-11-17 15:10:14'),
(7, 'online_voter_list', 'web', '2022-11-17 15:10:14', '2022-11-17 15:10:14'),
(8, 'voter_list', 'web', '2022-11-17 15:10:30', '2022-11-17 15:10:30'),
(9, 'submission', 'web', '2022-11-17 15:10:30', '2022-11-17 15:10:30'),
(10, 'voting_schedule', 'web', '2022-11-17 15:11:34', '2022-11-17 15:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `positions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `qr_codes`;
CREATE TABLE IF NOT EXISTS `qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_used` tinyint(4) DEFAULT NULL,
  `scan_blank_ballot` timestamp NULL DEFAULT NULL,
  `scan_voted_ballot` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qr_codes_code_unique` (`code`),
  KEY `qr_codes_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `code`, `is_used`, `scan_blank_ballot`, `scan_voted_ballot`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '951623', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(2, 'Admin', 'web', '2022-11-17 15:00:08', '2022-11-17 15:00:08'),
(3, 'Officer', 'web', '2022-11-17 15:00:09', '2022-11-17 15:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `logo_type` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `election_schedule_date` date DEFAULT NULL,
  `election_interval` tinyint(4) DEFAULT NULL,
  `application_submission_form` json DEFAULT NULL,
  `online_application_form_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online_voting_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `election_year` year(4) DEFAULT NULL,
  `voting_schedule_start_date` date DEFAULT NULL,
  `voting_schedule_start_time` time DEFAULT NULL,
  `voting_schedule_end_time` time DEFAULT NULL,
  `application_subscription_start_date` date DEFAULT NULL,
  `application_subscription_end_date` date DEFAULT NULL,
  `ballot_merge_all` tinyint(1) DEFAULT NULL,
  `officer_secret_code` int(11) NOT NULL DEFAULT '2554',
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
  `mail_port` int(11) DEFAULT NULL,
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
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `max_limit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `organization_name`, `address`, `logo_type`, `icon`, `election_schedule_date`, `election_interval`, `application_submission_form`, `online_application_form_url`, `online_voting_url`, `election_year`, `voting_schedule_start_date`, `voting_schedule_start_time`, `voting_schedule_end_time`, `application_subscription_start_date`, `application_subscription_end_date`, `ballot_merge_all`, `officer_secret_code`, `lock_qr_code`, `lock_online_token`, `disable_common_users_login`, `disable_voters_import`, `disable_voters_deletion`, `disable_permanently_voters_deletion`, `offline_checked_in_status`, `display_voting_result`, `disable_offline_voting_result_upload`, `enable_sms_gateway_service`, `enable_voting_functions`, `archive`, `mail_mailer`, `mail_host`, `mail_port`, `mail_encryption`, `mail_username`, `mail_password`, `mail_from_name`, `mail_from_address`, `aws_access_key`, `aws_secret_key`, `aws_region`, `api_token_sslwireless`, `domain_sslwireless`, `sid_sslwireless`, `ballot_print`, `print_code`, `position`, `orientation`, `paper_size`, `width`, `height`, `max_limit`, `created_at`, `updated_at`) VALUES
(1, 'Advanced Project Integration Ltd.', 'House 04, Flat, 7A Rd #23/a, Dhaka 1213', 'text-logo', NULL, '2022-11-27', 2, '[{\"name\": \"name\", \"type\": \"text\", \"label\": \"Full Name\", \"required\": \"true\", \"placeholder\": \"Enter your full name.\"}, {\"name\": \"email\", \"type\": \"email\", \"label\": \"Email Address\", \"required\": \"true\", \"placeholder\": \"Enter a valid email address.\"}, {\"name\": \"member_id\", \"type\": \"text\", \"label\": \"Member ID\", \"required\": \"true\", \"placeholder\": \"Enter a valid member id.\"}, {\"name\": \"phone\", \"type\": \"number\", \"label\": \"Phone Number\", \"required\": \"true\", \"placeholder\": \"Enter your phone number.\"}]', NULL, NULL, 2022, '2022-11-27', '10:00:00', '22:00:00', '2022-11-16', '2022-11-23', 1, 123456, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'barcode', 'top-left', 'portrait', 'a4', NULL, NULL, 100, NULL, '2022-11-17 15:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` bigint(20) DEFAULT NULL,
  `is_used` tinyint(4) DEFAULT NULL,
  `is_sent_email` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tokens_voter_id_unique` (`voter_id`),
  UNIQUE KEY `tokens_token_unique` (`token`),
  UNIQUE KEY `tokens_otp_unique` (`otp`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `voter_id`, `token`, `otp`, `is_used`, `is_sent_email`, `created_at`, `updated_at`) VALUES
(1, 1, '852147', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` json DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_counter_officer_id_unique` (`counter_officer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `image`, `password`, `counter_officer_id`, `email_verified_at`, `remember_token`, `permissions`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', 'superadmin@demo.com', NULL, '$2y$10$3bF1qnE31nviPxAC2VdYZ..Wvhs.YuxPT3S72xiYs78W3P15EGJw.', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 'admin', 'Admin', 'admin@demo.com', NULL, '$2y$10$ncjUzSuA1iCTYfsAKqBanO4jNLNOVs4WxDCUfmSApHqoWPcq/0SoK', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 'officer', 'Officer', 'officer@demo.com', NULL, '$2y$10$funjz4v/L5s/UlJWGT4w9uvWGD6HyJsSzdhE8tCzUyUk3qnpjua3u', 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, '1@f.com', 'ddd', '1@f.com', NULL, '$2y$10$HHJVQWCRI/HW63kslL3YS.VljLx5rSS6/wBP9O1OwAfqiS/0EPxEa', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 15:10:14', '2022-11-17 15:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

DROP TABLE IF EXISTS `voters`;
CREATE TABLE IF NOT EXISTS `voters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_online_voter` tinyint(4) DEFAULT NULL,
  `is_checked_in` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voters_member_id_unique` (`member_id`),
  UNIQUE KEY `voters_email_address_unique` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `name`, `member_id`, `category`, `email_address`, `contact_number`, `image`, `token`, `is_online_voter`, `is_checked_in`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Md. Rubel Hossain', '123456', 'member', 'emailtorubel@gmail.com', '01676717945', NULL, '575058', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Md. Masud ', '654321', 'member', 'masud.ncse@gmail.com', '01770520203', NULL, '962923', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'xusi@mailinator.com', 'Ipsum quod cupidata', 'Beatae ex adipisicin', 'xezaqefe@mailinator.com', '213', 'uploads/2022/11/qBrQ1akmVX0L.jpg', NULL, NULL, NULL, NULL, NULL, '2022-11-17 15:16:59', '2022-11-17 15:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `candidate_ids` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `candidate_ids`, `created_at`, `updated_at`) VALUES
(1, '[1, 3, 4]', NULL, NULL),
(2, '[2, 4, 5]', NULL, NULL),
(3, '[1, 3, 5]', NULL, NULL),
(4, '[2, 4, 5]', NULL, NULL),
(5, '[2, 3, 5]', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ballots`
--
ALTER TABLE `ballots`
  ADD CONSTRAINT `ballots_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ballot_items`
--
ALTER TABLE `ballot_items`
  ADD CONSTRAINT `ballot_items_ballot_id_foreign` FOREIGN KEY (`ballot_id`) REFERENCES `ballots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ballot_items_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_counter_officer_id_foreign` FOREIGN KEY (`counter_officer_id`) REFERENCES `counter_officers` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `offline_tokens_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offline_tokens_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD CONSTRAINT `qr_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `tokens_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_counter_officer_id_foreign` FOREIGN KEY (`counter_officer_id`) REFERENCES `counter_officers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
