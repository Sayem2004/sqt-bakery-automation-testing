-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 02:45 AM
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
-- Database: `bakarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` enum('pending','confirmed','delivered','cancelled') DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `status`, `total_amount`, `created_at`) VALUES
(1, 3, 'cancelled', 1000.00, '2026-01-17 02:10:00'),
(2, 4, 'delivered', 1000.00, '2026-04-06 08:12:32'),
(3, 4, 'confirmed', 500.00, '2026-04-06 08:16:48'),
(4, 4, 'cancelled', 1500.00, '2026-04-06 08:17:04'),
(5, 4, 'delivered', 700.00, '2026-04-06 08:17:14'),
(6, 10, 'cancelled', 600.00, '2026-04-06 23:15:29'),
(7, 10, 'cancelled', 600.00, '2026-04-06 23:21:42'),
(8, 10, 'cancelled', 600.00, '2026-04-07 09:40:22'),
(9, 10, 'cancelled', 600.00, '2026-04-07 09:41:05'),
(10, 10, 'cancelled', 600.00, '2026-04-07 09:41:24'),
(11, 10, 'pending', 600.00, '2026-04-07 09:51:07'),
(12, 10, 'pending', 600.00, '2026-04-07 09:54:13'),
(13, 10, 'pending', 600.00, '2026-04-07 09:56:22'),
(14, 10, 'pending', 200.00, '2026-04-07 09:57:14'),
(15, 10, 'pending', 200.00, '2026-04-07 10:07:27'),
(16, 17, 'pending', 700.00, '2026-04-08 06:30:26'),
(17, 18, 'pending', 600.00, '2026-04-08 06:38:57'),
(18, 20, 'pending', 600.00, '2026-04-08 06:39:56'),
(19, 21, 'pending', 600.00, '2026-04-08 06:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_status` enum('unpaid','paid') DEFAULT 'unpaid',
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `payment_status`, `paid_at`) VALUES
(1, 1, 1, 10, 100.00, 'paid', '2026-01-17 02:15:29'),
(2, 2, 2, 10, 100.00, 'paid', '2026-04-06 08:12:37'),
(3, 3, 4, 10, 50.00, 'paid', '2026-04-06 08:17:36'),
(4, 4, 3, 5, 300.00, 'paid', '2026-04-06 08:17:34'),
(5, 5, 2, 7, 100.00, 'paid', '2026-04-06 08:17:25'),
(6, 6, 3, 2, 300.00, 'unpaid', NULL),
(7, 7, 3, 2, 300.00, 'unpaid', NULL),
(8, 8, 3, 2, 300.00, 'unpaid', NULL),
(9, 9, 3, 2, 300.00, 'unpaid', NULL),
(10, 10, 3, 2, 300.00, 'unpaid', NULL),
(11, 11, 3, 2, 300.00, 'unpaid', NULL),
(12, 12, 3, 2, 300.00, 'unpaid', NULL),
(13, 13, 3, 2, 300.00, 'unpaid', NULL),
(14, 14, 1, 2, 100.00, 'unpaid', NULL),
(15, 15, 1, 2, 100.00, 'unpaid', NULL),
(16, 16, 2, 7, 100.00, 'unpaid', NULL),
(17, 17, 3, 2, 300.00, 'unpaid', NULL),
(18, 18, 3, 2, 300.00, 'unpaid', NULL),
(19, 19, 3, 2, 300.00, 'paid', '2026-04-08 06:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mfg` date NOT NULL,
  `exp` date NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `quantity`, `mfg`, `exp`, `updated_by`, `updated_at`) VALUES
(1, 'Cake', 100.00, 51, '2026-01-17', '2026-01-31', 1, '2026-04-07 10:07:27'),
(2, 'Mango', 100.00, 476, '2026-04-03', '2026-04-29', 6, '2026-04-08 06:30:26'),
(3, 'Apple Juice', 300.00, 483, '2026-04-02', '2026-05-20', 6, '2026-04-08 06:40:24'),
(4, 'watermelon juice', 50.00, 590, '2026-03-30', '2026-11-11', 6, '2026-04-06 08:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`) VALUES
(1, 'rahi', '01902190562', 'a@gmail.com', '12345', 'staff'),
(2, 'delivery', '01902190562', 'd@gmail.com', '12345', 'delivery'),
(3, 'babu', '01902190562', 'c@g.c', '12345', 'customer'),
(4, 'qwww', '01701234567', 'qwww@gmaili.com', '$2y$10$SrGb94rmqH4OPFFApgZWguKRgrrRmpf58FvbTFh7YoFfFK0mEpQ3a', 'customer'),
(5, 'qwww', '1326205776', 'www@gmaili.com', '$2y$10$POqlJEAcGkjEp5ToUuSnVuY3lSSvJLv5b9ty9BLYBgpd84HstAw1W', 'staff'),
(6, 'qwww', '1326205776', 'ww@gmail.com', '$2y$10$ufKqTJNgDjvxJ9Q0PIGOR.cQC/Lp1.YvfcXB2DiMve55ui8RiRmi2', 'staff'),
(7, 'qwww', '1326205776', 'w@gmail.com', '$2y$10$8wRKE8S5I46sDoiCjMtsDe.PeEkQ73d8WhEk22O5eZ82iFYXn3xz.', 'delivery'),
(8, 'sss', '017014977865', 'sss@gmail.com', '$2y$10$mLa2VHJ.HzGrLlvVtPN8VO4d0zsZWdSeBqVhnTcUs06R/yyoOuF7C', 'customer'),
(9, 'sss', '017014977865', 'ss@gmail.com', '$2y$10$wVq0iqcBQOACbV/M6LMvbOxxVoD1T0LshNR5NKfIlXMZm9X.SZRZS', 'staff'),
(10, 'Zim Sayem', '01700000000', 'test@gmail.com', '$2y$10$ti9Qmoc/5UOrYOF5ZUUBBO2WbCmEFwdYg6x7zU2mzFuItWLyAwWW2', 'customer'),
(11, 'Selenium Automator', '01700000000', 'testuser_3051@test.com', '$2y$10$DZsSgW3fG.PtoWr6HjvxLuZIoO9bcZBs2j4Ix.Wz1qBltzIUqX02m', 'customer'),
(12, 'Selenium Automator', '01700000000', 'testuser_1747@test.com', '$2y$10$HnswufPs503rQCKZHJrnO.EFRjTROnD7gBjdqRkHt5.iebwTI.0mS', 'customer'),
(13, 'Selenium Automator', '01700000000', 'testuser_1827@test.com', '$2y$10$5BG6/zCD1QbFS0r7i2JcDupYzve/jMXiLb90m0NUD8EePBKzuATSG', 'customer'),
(14, 'Selenium Automator', '01700000000', 'testuser_5643@test.com', '$2y$10$8Fzb53meesz1EsQaWuFm5.Y92AVb6oyw8OLWPdI65JbEPPQjGOg8O', 'customer'),
(15, 'Zim Sayem', '01700000000', 'testuser_9463@test.com', '$2y$10$wPbUIOhEJBMPo3nfgeKgSOpbUIwJgeK5yhWUOP229t.bodj9P6KaG', 'customer'),
(16, 'Zim Sayem', '01700000000', 'testuser_6036@test.com', '$2y$10$PqD842RXtin0B04qQwC3JerJDU3TW/ugaqzTlwJdCgdw0f/hPK7sK', 'customer'),
(17, 'ab', '1326205776', 'ab@gmail.com', '$2y$10$SVfuCfZuK6u/S2UrgqKLJ.oawndFEqTAQZm5muvHC6G.LQITfRIUe', 'customer'),
(18, 'Test User', '01711111111', 'user3622@test.com', '$2y$10$6YaoxHSbkq9X6I82mOsfvuRjg12uqhVfpVJdGooF0E9eHTicm.7Bu', 'customer'),
(19, 'Test User', '01711111111', 'user2434@test.com', '$2y$10$0Ri6G3RHLq84Xku1iAXye.x8PaJtZ8T0cO8unGpu50oete0dwMIbu', 'customer'),
(20, 'Test User', '01711111111', 'user8204@test.com', '$2y$10$ll7wsNieS4lNj2PJsELJmeiAZCTlGmn.zvUhEu4MEz7b3qW81qw7m', 'customer'),
(21, 'Test User', '01711111111', 'user1414@test.com', '$2y$10$cwJPuiW6CoNfp.zE1WjINuHJ5DVhtJzAThQarS74POyzVjnp9e5yS', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
