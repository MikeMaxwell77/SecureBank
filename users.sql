-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 08:23 PM
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
-- Database: `secure_bank_website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `balance` decimal(10,2) DEFAULT 0.00,
  `account_number` varchar(255) DEFAULT 'demo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `registration_date`, `balance`, `account_number`) VALUES
(1, 'Username', '$flag$0$qR6dAXhCyzHBf/KLkJnhOue7U/SotDY.ZtYbIHABd/xgI[flag]', '2025-03-26 19:36:28', 0.00, 'demo'),
(3, 'memer11', '$2y$10$25FMFHwwTL8Q/DLsWy869uNL00hV1B9kYncspswC.lVp.Kb7N3u8e', '2025-04-01 11:15:57', 0.00, 'demo'),
(4, 'mikey', '$2y$10$e9Hm.iRCAgLNBpemJXZUb.JbjwOQItyBmtXSjCjm3q/PrEibwJSSm', '2025-04-02 18:55:41', 0.00, 'demo'),
(5, 'gamer', '$2y$10$cQs1YBhfXMdPjYSNrqv0tubjUa6YGXx2Le3Em7P5bhS8n5FwrrL/.', '2025-04-05 14:08:12', 0.00, 'demo'),
(6, 'testing', '$2y$10$GHKhQY3raYzLgfepVUzd1eRsiBHyVO./mwiC7OmxIZPzv55A79ga6', '2025-04-05 14:11:56', 0.00, 'demo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
