-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 06:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_units`
--

CREATE TABLE `blood_units` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `b_group` varchar(10) NOT NULL,
  `b_type` varchar(5) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_units`
--

INSERT INTO `blood_units` (`id`, `hospital_id`, `b_group`, `b_type`, `units`) VALUES
(1, 1, 'B', '+', 2),
(2, 1, 'O', '-', 3),
(3, 1, 'A', '+', 4),
(4, 1, 'AB', '+', 4),
(6, 2, 'O', '+', 45),
(7, 2, 'A', '+', 26),
(8, 2, 'O', '-', 45),
(9, 2, 'AB', '-', 3),
(10, 2, 'A', '-', 24),
(11, 17, 'B', '-', 22),
(12, 17, 'O', '+', 11),
(13, 17, 'A', '-', 100),
(14, 17, 'B', '+', 31),
(15, 18, 'A', '+', 10),
(16, 18, 'A', '-', 1020),
(17, 18, 'B', '+', 55),
(18, 18, 'B', '-', 23),
(19, 18, 'O', '+', 24),
(20, 18, 'O', '-', 90),
(21, 18, 'AB', '-', 100);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `state`, `email`, `password`, `image`) VALUES
(1, 'A hospital', 'Opp. Gorav Khad Bhandar, Near G.T. Road', 'haryana', 'abhiprashar2018@gmail.com', '123456', 'download (2).jpeg'),
(2, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', 'download (3).jpeg'),
(16, 'C hospital', 'address c, city c', 'rajasthan', 'hospital@c.com', 'c.1234', 'download (4).jpeg'),
(17, 'd hospital', 'd address', 'delhi', 'hospital@d.com', '123456', 'download (5).jpeg'),
(18, 'gangaram hospital', 'address new delhi ', 'delhi', 'gangaram@gmail.com', '123456', 'download (4).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sample_request`
--

CREATE TABLE `sample_request` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_group` varchar(10) NOT NULL,
  `b_type` varchar(5) NOT NULL,
  `is_confirmed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sample_request`
--

INSERT INTO `sample_request` (`id`, `hospital_id`, `user_id`, `b_group`, `b_type`, `is_confirmed`) VALUES
(10, 1, 2, 'A', '+', 1),
(12, 1, 5, 'A', '+', 0),
(13, 2, 5, 'A', '+', 0),
(14, 2, 2, 'A', '+', 0),
(15, 18, 2, 'A', '+', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `b_group` varchar(10) NOT NULL,
  `b_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `b_group`, `b_type`) VALUES
(1, 'abhiprashar2018@gmail.com', 'user', 'abcd', 'O', '-'),
(2, 'user1@gmail.com', 'user1', '123456', 'A', '+'),
(3, 'user2@gmail.com', 'user2', '123456', 'B', '+'),
(4, 'user3@gmail.com', 'user3', '123456', 'B', '+'),
(5, 'dilip@gmail.com', 'dilip', '123456', 'A', '+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_units`
--
ALTER TABLE `blood_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_request`
--
ALTER TABLE `sample_request`
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
-- AUTO_INCREMENT for table `blood_units`
--
ALTER TABLE `blood_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sample_request`
--
ALTER TABLE `sample_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
