-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 04:20 AM
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
(8, 4, 'Archi', 12, 88, '2025-05-01 07:44:27', '2025-05-01 07:44:27');

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
(10, '2025_05_01_142215_add_supply_from_to_stocks_table', 7);

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
('2IZq5khQ8kA7dot8rH3AbV9IGRTMmRD9tnjDKKFB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2NTNUtCb3hiM3Jtdkk2ODA5dXdPSW40UlF2bzNyNWM4WnFiTER4MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9ja3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1745843984),
('7SMhNtINGhfOEFUgwrJUIIGN6UAP3rot0FEj0ZiW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlVsT0ZzN3liYWMxSjZEeGZNZkgyNlQ2U044NThpYjJqSm9VYk1GaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9ja3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746152122),
('k2D1PHx95aH40JWmK0XSYLSTjlAFCd3tkHP24QEC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWxFcXFuR1RBcFRKMDZQanlQQ3dRUm40Y1dOMDMzZnlQRUpweFBmZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pdGVtcy8xL3N0b2NrY2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745756501),
('UHpTmqDMd2aMm4PzqKO2FrypsRNdThTC7lyAlhYb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDhFZmNDYkFDbHRtYUpsSXR6RGQwQ1VmN0tLbVROVkFQRGp1ZDJuUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pdGVtcy80L3N0b2NrY2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746114303);

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
  `receipt_qty` int(11) DEFAULT NULL,
  `no_of_days_consume` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `supply_from` enum('purchased','received') NOT NULL DEFAULT 'purchased'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_id`, `quantity`, `unit_cost`, `created_at`, `updated_at`, `reference`, `receipt_qty`, `no_of_days_consume`, `unit`, `supply_from`) VALUES
(1, 1, 60, 12.00, '2025-04-26 22:24:16', '2025-05-01 06:42:01', NULL, NULL, NULL, 'box', 'purchased'),
(2, 2, 1920, 231.00, '2025-04-28 04:17:34', '2025-05-01 07:09:10', NULL, NULL, NULL, 'ream', 'purchased'),
(3, 2, 201, 231.00, '2025-05-01 06:30:04', '2025-05-01 18:15:22', 'PSU Lingayen', NULL, NULL, 'ream', 'received'),
(4, 4, 88, 122.00, '2025-05-01 07:15:43', '2025-05-01 07:44:27', 'PSU Lingayen', NULL, NULL, 'bottle', 'received');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
