-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 06:23 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db`;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `sp_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate`, `comment`, `sp_id`, `client_id`) VALUES
(4, 5, 'bad', 36, 37),
(5, 5, 'test', 36, 37),
(6, 5, 'Weak', 36, 38);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `work_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `note` text,
  `client_id` int(11) NOT NULL,
  `specifics` varchar(11) NOT NULL,
  `status` enum('pending','rejected','ongoing','completed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `date_requested`, `work_id`, `sp_id`, `date`, `from`, `to`, `note`, `client_id`, `specifics`, `status`) VALUES
(5, '2019-01-14 04:19:56', 32, 36, '2019-01-14', '13:19:00', '14:19:00', NULL, 38, '      akjwh', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(45) NOT NULL,
  `sp_id` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `sp_id`, `status`) VALUES
(7, 'Test', 36, 'disabled'),
(8, 'Test', 36, 'disabled'),
(9, 'Plumbing', 36, 'disabled'),
(10, 'Carpentry', 36, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transactions_id` int(100) NOT NULL,
  `sp_id` int(100) NOT NULL,
  `client_id` int(100) NOT NULL,
  `history` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(45) NOT NULL,
  `user_lname` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `barangay` varchar(45) NOT NULL,
  `housenumber` varchar(50) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_name`, `password`, `barangay`, `housenumber`, `contact_no`, `email`, `type`, `status`) VALUES
(30, 'Admin', 'Admin', 'admin', '$2y$10$jZdBqAsT2659OOyl5ZTTxu7IShNLWqXCieXIp3jLpzagj/ruUudha', 'Admin Boss, Admin', '', '09123456789', 'admin@gmail.com', 'admin', 'active'),
(35, 'roger', 'roger', 'roger', '$2y$10$pDjoERMDePf0gFEtCnqQTeJuGgHiJOzBYBypnSNawxWGoGrEms3i6', 'asdasd', '', '123123', 'asdas@gmail.com', 'sp', 'active'),
(34, 'Japper', 'Li', 'japper', '$2y$10$0e.tISPGnHrxI88xUZhj/.FtUkD16gujlZ8HspPLVR02JKhRWc.XS', 'pqoweoqwieq', '', '0912318491', 'yanalinso@gmail.com', 'sp', 'active'),
(36, 'Ted', 'Zhang', 'ted', '$2y$10$wWhfe0/iWTtUo65alxt3TOspEIGYS27K239IlLzOZ.3ncF3g55uKS', 'Tanod', '123', '123123', 'asdasdf@mgail.com', 'sp', 'active'),
(37, 'Roger', 'Li', 'rog', '$2y$10$9352Nm0eYnT.Za58MeaeIu1Lmn/xXtz/z5.sCEKgIvM.YASY.DRiK', 'asdas', '123', '123123', 'asdasd@gmail.com', 'client', 'active'),
(38, 'Lambert ', 'Sun', 'lambert', '$2y$10$NVscRQ4Y9r2nLXrhjHqjVOVHMXDICgrWDrII12dc52C4dRMcFWmZ6', '1231', '19208301', '123123', 'lambert@gmail.com', 'client', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `service_id` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `priceFrom` int(50) NOT NULL,
  `priceTo` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `service_id`, `description`, `priceFrom`, `priceTo`) VALUES
(31, '9', 'Install', 1000, 2000),
(32, '10', 'Install yeah', 100, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactions_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactions_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
