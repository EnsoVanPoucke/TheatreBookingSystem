-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2025 at 02:06 PM
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
-- Database: `theatrebookingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `screenrooms`
--

CREATE TABLE `screenrooms` (
  `screenroom_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `row_count` int(4) DEFAULT NULL,
  `total_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screenrooms`
--

INSERT INTO `screenrooms` (`screenroom_id`, `name`, `description`, `row_count`, `total_seats`) VALUES
(1, 'Room 1', 'Large theater room.', 16, 372),
(2, 'Room 2', 'Large theatre room.', 16, 316),
(3, 'Room 3', 'Medium theatre room.', 13, 192),
(4, 'Room 4', 'Medium theatre room.', 13, 196),
(5, 'Room 5', 'Small theatre room.', 12, 194);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `screenrooms`
--
ALTER TABLE `screenrooms`
  ADD PRIMARY KEY (`screenroom_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `screenrooms`
--
ALTER TABLE `screenrooms`
  MODIFY `screenroom_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
