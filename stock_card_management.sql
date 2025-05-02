-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 04:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_card_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `issuances`
--

CREATE TABLE `issuances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `office` varchar(255) NOT NULL,
  `qty_issued` int(10) UNSIGNED NOT NULL,
  `balance_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issuances`
--

INSERT INTO `issuances` (`id`, `item_id`, `office`, `qty_issued`, `balance_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 'Supply', 1, 0, '2025-04-26 23:25:02', '2025-04-26 23:25:02'),
(2, 1, 'Supply', 2, 0, '2025-04-26 23:25:27', '2025-04-26 23:25:27'),
(3, 1, 'Supply', 1, 0, '2025-04-26 23:25:53', '2025-04-26 23:25:53'),
(4, 1, 'Information Technology', 1, 0, '2025-04-27 03:58:24', '2025-04-27 03:58:24'),
(5, 1, 'EE', 1, 0, '2025-04-27 04:05:22', '2025-04-27 04:05:22'),
(6, 1, 'EE', 1, 16, '2025-04-27 04:17:24', '2025-04-27 04:17:24'),
(7, 1, 'Archi', 1, 15, '2025-04-27 04:21:03', '2025-04-27 04:21:03'),
(8, 4, 'Archi', 12, 88, '2025-05-01 07:44:27', '2025-05-01 07:44:27'),
(9, 4, 'Clinic', 12, 76, '2025-05-01 18:33:50', '2025-05-01 18:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `supply_type` enum('Office Supply','Medical Supply','Janitorial Supply') NOT NULL,
  `unit_of_measure` varchar(50) DEFAULT NULL,
  `stock_number` varchar(50) DEFAULT NULL,
  `unit_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_description`, `supply_type`, `unit_of_measure`, `stock_number`, `unit_cost`, `created_at`, `updated_at`) VALUES
(1, 'Paper clips', 'Jumbo/50mm', 'Office Supply', NULL, NULL, 0.00, '2025-04-26 22:10:24', '2025-04-26 22:10:24'),
(2, 'A4 Coupon', '1 ream', 'Office Supply', NULL, NULL, 0.00, '2025-04-28 04:16:57', '2025-04-28 04:16:57'),
(4, 'Alcohol', '1000ml', 'Medical Supply', NULL, NULL, 0.00, '2025-05-01 07:14:48', '2025-05-01 07:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_27_050935_items', 1),
(2, '2025_04_27_052618_remove_unit_of_measure_and_stock_number_from_items_table', 1),
(3, '2025_04_27_053520_stocks', 1),
(4, '2025_04_27_053657_remove_unit_cost_from_items_table', 1),
(5, '2025_04_27_060814_create_sessions_table', 2),
(6, '2025_04_27_070953_issuances', 3),
(7, '2025_04_27_115724_add_balance_qty_to_issuances_table', 4),
(8, '2025_05_01_134340_add_supply_type_to_items_table', 5),
(9, '2025_05_01_135258_update_supply_type_in_items_table', 6),
(10, '2025_05_01_142215_add_supply_from_to_stocks_table', 7),
(11, '2025_05_02_022442_add_ris_number_to_stocks_table', 8),
(12, '2025_05_02_024232_make_supply_from_nullable_in_stocks_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7SMhNtINGhfOEFUgwrJUIIGN6UAP3rot0FEj0ZiW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlVsT0ZzN3liYWMxSjZEeGZNZkgyNlQ2U044NThpYjJqSm9VYk1GaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9ja3MvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746153848);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `unit_cost`) VIRTUAL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `ris_number` varchar(255) DEFAULT NULL,
  `receipt_qty` int(11) DEFAULT NULL,
  `no_of_days_consume` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `supply_from` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_id`, `quantity`, `unit_cost`, `created_at`, `updated_at`, `reference`, `ris_number`, `receipt_qty`, `no_of_days_consume`, `unit`, `supply_from`) VALUES
(1, 1, 60, 12.00, '2025-04-26 22:24:16', '2025-05-01 06:42:01', NULL, NULL, NULL, NULL, 'box', 'purchased'),
(2, 2, 1920, 231.00, '2025-04-28 04:17:34', '2025-05-01 07:09:10', NULL, NULL, NULL, NULL, 'ream', 'purchased'),
(3, 2, 201, 231.00, '2025-05-01 06:30:04', '2025-05-01 18:15:22', 'PSU Lingayen', NULL, NULL, NULL, 'ream', 'received'),
(4, 4, 152, 122.00, '2025-05-01 07:15:43', '2025-05-01 18:43:32', 'PSU Lingayen', NULL, NULL, NULL, 'bottle', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issuances`
--
ALTER TABLE `issuances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issuances_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_item_id_foreign` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issuances`
--
ALTER TABLE `issuances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuances`
--
ALTER TABLE `issuances`
  ADD CONSTRAINT `issuances_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
