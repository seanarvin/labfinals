-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2019 at 06:58 AM
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
  `specifics_id` int(11) NOT NULL,
  `status` enum('pending','rejected','ongoing','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`) VALUES
(1, 'Electrician '),
(2, 'Plumbing'),
(3, 'Carpentry'),
(4, 'AC Repair');

-- --------------------------------------------------------

--
-- Table structure for table `specifics`
--

DROP TABLE IF EXISTS `specifics`;
CREATE TABLE `specifics` (
  `specifics_id` int(11) NOT NULL,
  `specifics` varchar(45) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spservice`
--

DROP TABLE IF EXISTS `spservice`;
CREATE TABLE `spservice` (
  `sp_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spservices`
--

DROP TABLE IF EXISTS `spservices`;
CREATE TABLE `spservices` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `sp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spservices`
--

INSERT INTO `spservices` (`id`, `category`, `sp_id`) VALUES
(1, '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `spwork`
--

DROP TABLE IF EXISTS `spwork`;
CREATE TABLE `spwork` (
  `id` int(11) NOT NULL,
  `work` varchar(20) NOT NULL,
  `spservice_id` int(20) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spwork`
--

INSERT INTO `spwork` (`id`, `work`, `spservice_id`, `price`) VALUES
(1, 'Not Cold/Not working', 1, 10),
(2, 'asdasd', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `user_fname` varchar(45) NOT NULL,
  `user_lname` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `type`, `user_fname`, `user_lname`, `user_name`, `password`, `contact_no`, `address`, `email`, `status`) VALUES
(8, 'sp', 'cam', 'cam', 'cam', '123', '09098080680', 'Dita lang', 'cam@gmail.com', 'disabled'),
(9, 'admin', 'qwe', 'qwe', '123', '123', '12312', 'asda', 'asdasdasd@gmail.com', 'active'),
(10, 'sp', 'a', 'b', 'q', 'q', '123123', 'asd', 'asdasdsfg@gmail.com', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `service_id` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `service_id`, `description`) VALUES
(1, '4', 'Not Cold/Not working optimally');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `specifics`
--
ALTER TABLE `specifics`
  ADD PRIMARY KEY (`specifics_id`,`service_id`);

--
-- Indexes for table `spservice`
--
ALTER TABLE `spservice`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `spservices`
--
ALTER TABLE `spservices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spwork`
--
ALTER TABLE `spwork`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specifics`
--
ALTER TABLE `specifics`
  MODIFY `specifics_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spservice`
--
ALTER TABLE `spservice`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spservices`
--
ALTER TABLE `spservices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spwork`
--
ALTER TABLE `spwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
