-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 05:32 PM
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
-- Database: `loans_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@123.com', '123'),
(2, 'admin2', 'admin2@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `loan_amount` int(255) NOT NULL DEFAULT 0,
  `pay_duration` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `interest` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `repaid` int(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan_amount`, `pay_duration`, `created_at`, `interest`, `userid`, `repaid`) VALUES
(1, 50000, 5, '2024-09-03', 13, 1, 5000),
(2, 200000, 12, '2024-09-03', 13, 2, 10000),
(3, 250000, 15, '2024-09-03', 13, 12, 100000),
(4, 1000000, 36, '2024-09-04', 13, 6, 125000),
(9, 70000, 7, '2024-09-16', 13, 14, 0),
(12, 50000, 5, '2024-09-16', 13, 13, 0),
(13, 98775, 9, '2024-09-16', 13, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `idcard` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `dob`, `gender`, `idcard`, `created_at`) VALUES
(1, 'ndungu', 'joe', 'murimi', 'joemurimi@gmail.com', 711288317, '0000-00-00', 'Male', 32200000, '2024-09-01 00:43:10'),
(2, 'Kim', 'kamau', 'kimani', 'kim@123', 711223344, '1998-07-20', 'Male', 3450000, '2024-09-09 00:22:48'),
(4, 'jane', 'mwende', 'musyoka', 'jane@123.com', 742158158, '0000-00-00', 'Female', 33100111, '2024-08-30 22:48:33'),
(5, 'Mary', 'Kerubo', 'Nyangau', 'mary@abc.com', 724112244, '2002-07-24', 'Female', 33300100, '2024-09-09 00:21:35'),
(6, 'Mike', 'Kamau', 'Njuguna', 'mike@123.com', 724252525, '2001-02-06', 'Male', 33411111, '2024-09-09 00:09:36'),
(7, 'Jane', 'Omondi', 'Atieno', 'jane@abc.com', 711222333, '2000-10-18', 'female', 33333333, '2024-09-02 16:35:06'),
(8, 'Ann', 'Njeri', 'Kamau', 'annnje@123.com', 712455788, '2003-06-10', 'Female', 33812493, '2024-09-09 00:11:10'),
(9, 'Ndungu', 'Joe', 'Murimi', 'joemurimi.jm@gmail.com', 711288317, '2002-04-04', 'Male', 21121232, '2024-09-03 00:36:06'),
(10, 'Sarah', 'Muthoni', 'Kamau', 'sarahmu@abc.com', 7524521, '2000-04-06', 'Feale', 3323232, '2024-09-03 00:54:52'),
(11, 'Stella', 'Mwaura', 'Muthoni', 'stellamwas@123.com', 725351468, '2001-11-11', 'Female', 3333328, '2024-09-09 00:12:54'),
(12, 'Michael', 'Mwaura', 'Gitau', 'mikemwaura@12.com', 758458857, '2007-10-16', 'Male', 3535353, '2024-09-03 02:14:51'),
(13, 'Simon', 'Ndungu', 'Njunge', 'simonmwau@abc.com', 724255255, '2000-05-08', 'Male', 332222211, '2024-09-12 11:57:37'),
(14, 'Joyline', 'Njagi', 'Katerina', 'jkarina@abc.com', 722555999, '1997-11-04', 'Female', 3311111, '2024-09-08 23:55:50'),
(15, 'Mary', 'kimani', 'Wambui', 'marykim01@gmail.com', 711888999, '2002-06-21', 'Female', 3386664, '2024-09-12 11:59:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
