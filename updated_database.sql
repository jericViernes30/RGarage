-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buy_n_sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `email`, `password`) VALUES
(1, 'ADMIN_001', 'jericviernes06@gmail.com', '$2y$10$7y6l2oyj2Eih8/yyPV4WOuiBpGvdMPsNnJXCt380F7KT7XGWr6QF6');

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`id`, `name`, `activity`, `created_at`) VALUES
(1, 'Krystle Kaye Curabo', 'Login', '2024-11-14 20:39:24'),
(2, 'Jenmar Gayos', 'Register', '2024-11-14 20:41:12'),
(3, 'Krystle Kaye Curabo', 'Login', '2024-11-16 02:14:05'),
(4, 'Krystle Kaye Curabo', 'Login', '2024-11-17 01:36:49'),
(5, 'Krystle Kaye Curabo', 'Login', '2024-11-17 20:56:21'),
(6, 'Krystle Kaye Curabo', 'Login', '2024-11-17 21:01:56'),
(7, 'Krystle Kaye Curabo', 'Login', '2024-11-23 15:37:17'),
(8, 'Krystle Kaye Curabo', 'Login', '2024-11-24 10:02:01'),
(9, 'Test3 Account', 'Login', '2024-11-26 21:42:17'),
(10, 'Olive Viernes', 'Login', '2024-11-26 21:42:57'),
(11, 'Olive Viernes', 'Login', '2024-11-26 21:45:25'),
(12, 'Olive Viernes', 'Login', '2024-11-26 21:46:39'),
(13, 'Olive Viernes', 'Login', '2024-11-26 21:46:50'),
(14, 'Olive Viernes', 'Login', '2024-11-26 21:48:12'),
(15, 'Olive Viernes', 'Login', '2024-11-26 21:50:05'),
(16, 'Test3 Account', 'Login', '2024-11-26 21:51:30'),
(17, 'account_test3.jpg Account', 'Login', '2024-11-26 21:52:09'),
(18, 'Olive Viernes', 'Login', '2024-11-26 21:53:18'),
(19, 'Olive Viernes', 'Login', '2024-11-26 21:55:15'),
(20, 'Olive Viernes', 'Login', '2024-11-26 21:56:24'),
(21, ' ', 'Login', '2024-11-26 22:01:07'),
(22, ' ', 'Login', '2024-11-26 22:02:01'),
(23, ' ', 'Login', '2024-11-26 22:03:55'),
(24, 'Test3 Account', 'Login', '2024-11-26 22:04:31'),
(25, 'Test3 Account', 'Login', '2024-11-26 22:04:44'),
(26, 'Olive Viernes', 'Login', '2024-11-26 22:05:06'),
(27, 'Krystle Kaye Curabo', 'Login', '2024-11-27 06:40:36'),
(28, 'Krystle Kaye Curabo', 'Login', '2024-11-29 13:41:14'),
(29, 'Krystle Kaye Curabo', 'Login', '2024-11-30 08:12:27'),
(30, 'Jeric James Viernes', 'Login', '2024-12-01 04:35:31'),
(31, 'Jeric James Viernes', 'Login', '2024-12-01 10:30:43'),
(32, 'Juliana Kimberly Viernes', 'Login', '2024-12-04 10:26:31'),
(33, 'Jerald Viernes', 'Login', '2024-12-04 10:29:17'),
(34, 'Krystle Kaye Curabo', 'Login', '2024-12-04 10:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_name`, `receiver_name`, `content`, `created_at`) VALUES
(30, 'Krystle Kaye', 'Admin', 'Hello', '2024-11-11 04:28:18'),
(31, 'Admin', 'Krystle Kaye', 'Hi. How may I help you?', '2024-11-11 05:29:43'),
(32, 'Krystle Kaye', 'Admin', 'Hello Again Admin', '2024-11-11 05:36:06'),
(33, 'Krystle Kaye', 'Admin', 'I just want to inquire about the Honda Beat FI', '2024-11-11 05:36:18'),
(34, 'Barry', 'Admin', 'Hello po', '2024-11-11 05:46:01'),
(35, 'Barry', 'Admin', 'Hm po sa Honda Beat FI?', '2024-11-11 05:49:11'),
(37, 'Admin', 'Barry', '49000', '2024-11-11 06:00:08'),
(38, 'Admin', 'Krystle Kaye', 'What do you want to know po?', '2024-11-11 06:09:58'),
(39, 'Krystle Kaye', 'Admin', 'I just want to ask if it\'s available as installment?', '2024-11-11 06:11:30'),
(40, 'Admin', 'Krystle Kaye', 'As of now hindi po available ang installment namin', '2024-11-11 06:11:42'),
(41, 'Krystle Kaye', 'Admin', 'How about po sa ibang units?', '2024-11-11 06:15:07'),
(42, 'Admin', 'Krystle Kaye', 'Wala pa din po e', '2024-11-11 06:15:28'),
(43, 'Juliana', 'Admin', 'Good afternoon!', '2024-11-11 06:22:20'),
(44, 'Admin', 'Juliana', 'Yes po?', '2024-11-11 06:22:32'),
(45, 'Admin', 'Krystle Kaye', 'Hi', '2024-11-14 04:15:41'),
(46, 'Krystle Kaye', 'Admin', 'I\'m inquiring about Honda Beat FI V2', '2024-11-14 18:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `reserved_date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `user_id`, `unit_id`, `reserved_date`, `time`, `status`, `rating`, `created_at`) VALUES
(3, 6, 7, '2024-11-22', '', 'Completed', 3, '2024-11-30 13:40:20'),
(5, 6, 9, '2024-12-02', '6:30', 'Completed', 3, '2024-11-30 13:35:09'),
(7, 34, 7, '2024-12-10', '8:00', 'Sold', 0, '2024-12-04 11:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `or_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `contact`, `email`, `unit`, `price`, `or_number`, `created_at`) VALUES
(4, 'Krystle Kaye Curabo', '09976589181', 'kkcurabo18@gmail.com', '2021 Honda Beat FI V3', 39000, '1234567', '2024-11-24 18:30:50'),
(10, 'Jeric James Viernes', '09976589181', 'jericviernes06@gmail.com', '2021 Honda CB650R', 100000, '189722', '2024-11-24 19:19:32'),
(33, 'Krystle Kaye Curabo', '09976589181', 'kkcurabo18@gmail.com', '2020 Honda Click 125 V2', 42000, '6846315', '2024-12-04 11:15:43'),
(34, 'Juliana Kimberly Viernes', '09976589181', 'julianakim504@gmail.com', '2020 Honda Click 125 V2', 42000, '6876154', '2024-12-04 11:32:26'),
(36, 'Jerald Viernes', '09976589181', 'viernesjc315@gmail.com', '2020 Honda Click 125 V2', 42000, '87645132', '2024-12-04 11:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `plate_number` varchar(15) NOT NULL,
  `year` varchar(15) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `mileage` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` varchar(255) NOT NULL,
  `shand_price` varchar(255) NOT NULL,
  `modified` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `thread` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `issue` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `plate_number`, `year`, `brand`, `model`, `mileage`, `image`, `price`, `shand_price`, `modified`, `type`, `thread`, `color`, `issue`, `created_at`) VALUES
(7, 'NQU 715', '2020', 'Honda', 'Click 125 V2', 13000, 'click_v2_black.jpg', '48,500', '42000', '', 'scooter', 0, '', '', '2024-11-14 16:10:13'),
(8, 'NQI 812', '2023', 'Yamaha', 'Mio Gear 125', 5000, 'gear_1.jpg', '40,000', '41000', '', 'scooter', 0, '', '', '2024-11-14 16:10:17'),
(9, 'AKJ 785', '2022', 'Honda', 'PCX ', 2000, 'pcx_1.jpg', '53,000', '38000', '', 'scooter', 0, '', '', '2024-11-14 16:10:32'),
(10, 'ASH 715', '2019', 'Suzuki', 'Raider Carb', 46000, 'raider_carb_1.jpg', '30,000', '39500', '', 'underbone', 0, '', '', '2024-11-14 16:10:38'),
(13, 'KAS 812', '2019', 'Kawasaki', 'ZX-10RR', 19000, 'zx10r.jpg', '461,000', '120000', '', 'bigbike', 0, '', '', '2024-11-28 10:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `status`, `verification_code`, `contact_number`, `address`, `profile_picture`, `password`) VALUES
(6, 'Krystle Kaye', 'Curabo', 'krystlekayecurabo81@gmail.com', 'Verified', '123456', '09976589181', 'Phase 1 Executive', '', '$2y$10$DjxPhEk2o8u1L/HiFnNv2eR.PZWKJTRC4mIqhQiz9N5HtV.eQps9u'),
(27, 'Jeric James', 'Viernes', 'jericviernes06@gmail.com', 'Verified', '293428', '09976589181', 'Blk 6 Lot 18 Phase 7 Mamatid', 'viernes_jericjames.png', '$2y$10$y1KGqC13MXLGXaSEa4lTRei8aKIKFyEZFvz.fB73.EScsmsgPEqK2'),
(31, 'Test', 'Account', 'dragonjeric@gmail.com', 'Not Verified', '224343', '09976589181', 'Blk 6 Lot 18 Phase 7 Mamatid', 'account_test.png', '$2y$10$6gA3FIPUX4WKaoTlkZMs1OgmFisX5K1.hbfBfpTX/wa7e9AvSMVvy'),
(35, 'Jerald', 'Viernes', 'viernesjc315@gmail.com', 'Verified', '258331', '09976589181', 'Blk 6 Lot 18 Phase 7 Mamatid', 'viernes_jerald.jpg', '$2y$10$ELqc9ZK.HVTdXXpge0ILwOb0.aymNGlzxGtfXUhKSclHd.cKzENE6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
