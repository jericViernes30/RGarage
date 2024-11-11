-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 07:07 AM
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
(37, 'Admin', 'Barry', '49000', '2024-11-11 06:00:08');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `plate_number`, `year`, `brand`, `model`, `mileage`, `image`, `price`, `created_at`) VALUES
(2, 'DEF 456', '2019', 'Honda', 'Beat FI', 4000, 'beat_1.jpg, beat_2.jpg, beat_3.jpg', '49,000', '2024-11-04 18:35:25'),
(6, 'ABC 123', '2021', 'Honda', 'Beat FI V2', 13000, 'beat_black_v2.jpg', '49,000', '2024-11-04 16:09:19'),
(7, 'NQU 715', '2020', 'Honda', 'Click 125 V2', 13000, 'click_v2_black.jpg', '48,500', '2024-11-04 16:12:31'),
(8, 'NQI 812', '2023', 'Yamaha', 'Mio Gear 125', 5000, 'gear_1.jpg', '40,000', '2024-11-04 16:15:02'),
(9, 'AKJ 785', '2022', 'Honda', 'PCX ', 2000, 'pcx_1.jpg', '53,000', '2024-11-04 16:15:02'),
(10, 'ASH 715', '2019', 'Suzuki', 'Raider Carb', 46000, 'raider_carb_1.jpg', '30,000', '2024-11-04 16:32:49'),
(12, 'GJS 821', '2021', 'Honda', 'CB650R', 8000, 'cbr_2.jpg,cbr_3.jpg,cbr_1.jpg', '460,000', '2024-11-04 19:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `contact_number`, `address`, `password`) VALUES
(1, 'Jeric James', 'Viernes', 'jericviernes06@gmail.com', '09976589181', 'Blk 6 Lot 18 Phase 7 Mamatid', 'jjviernes1'),
(5, 'Allan Paul', 'Labigan', 'allanlabigan@gmail.com', '09123124121', 'Brgy. San Juan Manila', '$2y$10$2FMIwAbzdw4XdiW92kZK4.oVTMzYzauCDW4fxqygxzvVw3i3yZmRm'),
(6, 'Krystle Kaye', 'Curabo', 'kkcurabo18@gmail.com', '09976589181', 'Phase 1 Executive', '$2y$10$DjxPhEk2o8u1L/HiFnNv2eR.PZWKJTRC4mIqhQiz9N5HtV.eQps9u'),
(7, 'John Laurence', 'Azana', 'laurance@gmail.com', '09461846484', 'Mamatid', '$2y$10$p6I3Ph0ptmakXjm4DYau1u5eemmfCQnv7WZAnGvqZ887ERBtBoTjq'),
(8, 'Test', 'Account', 'testaccount1@gmail.com', '09123165121', 'Manila', '$2y$10$zTT4mPx8LbZOp5ARVfjNTOcx50s9YFwKjtRHZaXMA1QjflZ0CszBq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
