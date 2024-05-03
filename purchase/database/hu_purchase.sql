-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2024 at 03:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress_new3`
--

-- --------------------------------------------------------

--
-- Table structure for table `hu_purchase`
--

CREATE TABLE `hu_purchase` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hu_purchase`
--

INSERT INTO `hu_purchase` (`id`, `invoice_id`, `price`, `material_id`, `supplier_id`, `quantity`, `date`) VALUES
(23, 516729777, '400', 1, 1, '2', '2024-01-29 20:10:40'),
(24, 516729777, '6000', 2, 2, '10', '2024-01-29 20:10:40'),
(25, 516729777, '800', 3, 3, '2', '2024-01-29 20:10:40'),
(26, 516729777, '4000', 3, 2, '10', '2024-01-29 20:10:40'),
(27, 516729777, '2000', 4, 3, '10', '2024-01-29 20:10:40'),
(28, 300102568, '6400', 1, 2, '32', '2024-01-29 20:11:33'),
(29, 517503259, '2000', 4, 2, '10', '2024-01-29 20:11:41'),
(30, 517503259, '6400', 1, 3, '32', '2024-01-29 20:11:41'),
(31, 517503259, '100000', 5, 2, '1000', '2024-01-29 20:11:41'),
(32, 496959743, '1000', 1, 1, '5', '2024-01-29 20:12:58'),
(33, 496959743, '19200', 2, 1, '32', '2024-01-29 20:12:58'),
(34, 496959743, '2000', 4, 2, '10', '2024-01-29 20:12:58'),
(35, 496959743, '9200', 3, 3, '23', '2024-01-29 20:12:58'),
(36, 496959743, '1400', 5, 3, '14', '2024-01-29 20:12:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hu_purchase`
--
ALTER TABLE `hu_purchase`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hu_purchase`
--
ALTER TABLE `hu_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
