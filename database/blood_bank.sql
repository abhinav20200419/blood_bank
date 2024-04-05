-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 03:16 AM
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
(5, 1, 'B', '+', 11),
(6, 2, 'O', '+', 31),
(7, 2, 'A', '+', 10);

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
(1, 'A hospital', 'Opp. Gorav Khad Bhandar, Near G.T. Road', 'haryana', 'abhiprashar2018@gmail.com', '123456', ''),
(2, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(3, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(4, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(5, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(6, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(7, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(8, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(9, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(10, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(11, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(12, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(13, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', ''),
(14, 'B hospital', 'bharat hospital, sonipat', 'haryana', 'b.hospital@mail.com', '101010', '');

-- --------------------------------------------------------

--
-- Table structure for table `sample_request`
--

CREATE TABLE `sample_request` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `b_group` varchar(10) NOT NULL,
  `b_type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'abhiprashar2018@gmail.com', 'user', 'abcd', 'A', '-');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sample_request`
--
ALTER TABLE `sample_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
