-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 07:06 PM
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
-- Database: `adventure_kingdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'priya', '$2y$10$77wouSxyI1XP0/Q0OREbHO0b4YMCPhFpC55FaJg3X8bBxqatBTm..');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `ride` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tickets` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `ride`, `date`, `time`, `tickets`, `amount`) VALUES
(5, '???? The Sky Fury - ₹500', '2025-04-24', '22:33:00', 2, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'Hariharan', 'hariharanperumal01@gmail.com', '8610154306', '$2y$10$I8dnaiGn9WRN85VjaQzb7uEaZzj7PA2a5pJjDz5z41O8D6lgVXhVW', '2025-03-09 13:42:12'),
(2, 'Hari2', 'hariharanperumal02@gmail.com', '8608280224', '$2y$10$SIRHT7iYP5qqmPk7Xy6AZOkIMtP6nRjCT4AU8DbH0xYF.ojXjrZN.', '2025-03-09 13:44:13'),
(3, 'hari2', 'hariharanperumal03@gmail.com', '8610154306', '$2y$10$C4kIjLN.WzQR7zCcMTlX1.LU8rb/Nt2IDtSBzSHobdhOd8rjwLHIy', '2025-03-09 15:35:39'),
(4, 'Hariharan01', 'hari2@gmail.com', '9876543321', '$2y$10$V9j6vJyoqpJnRSYgsaQ/AeHnjhoyC6Gv.vm/plR81wS.e5roYXKNW', '2025-03-23 04:42:45'),
(5, 'Hariharan2', 'hari00@gmail.com', '8608280224', '$2y$10$vfePaYgU6jyFyr3FgOXeOuAIWtGm9IGvhRhPxVb94fQn5IxMoB3zi', '2025-03-24 14:22:55'),
(6, 'hari3', 'hari3@gmail.com', '9090909090', '$2y$10$uxog2WiZkyju9f3wtqdWceb5Qxzz2J9DdurIvdoVMKtIWgkdrIK8e', '2025-04-06 07:28:05'),
(7, 'priya', 'priya@gmail.com', '8610154306', '$2y$10$64/uv2J1TGNQDVTcTWFACuCWxwNgT0MygmsTazsxrJpqailMgyMPy', '2025-04-23 15:16:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
