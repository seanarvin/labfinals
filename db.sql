-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2019 at 10:27 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `date_requested`, `work_id`, `sp_id`, `date`, `from`, `to`, `note`, `client_id`, `specifics_id`, `status`) VALUES
(1, '2019-01-01 18:12:30', 2, 12, '2019-01-02', '01:00:00', '02:10:00', NULL, 9, 1, 'pending');

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

--
-- Dumping data for table `specifics`
--

INSERT INTO `specifics` (`specifics_id`, `specifics`, `service_id`) VALUES
(1, 'Lighting', 1),
(2, 'Fan', 1),
(3, 'Water Heater', 1),
(4, 'Window Type', 4),
(5, 'Tower/ Floor Standing Type', 4),
(6, 'Split Type', 4),
(7, 'Ceiling/ Cassette Type', 4);

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

--
-- Dumping data for table `spservice`
--

INSERT INTO `spservice` (`sp_id`, `service_id`, `uid`) VALUES
(1, 1, 12);

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
  `user_fname` varchar(45) NOT NULL,
  `user_lname` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_name`, `password`, `address`, `contact_no`, `email`, `type`, `status`) VALUES
(12, 'Amanda ', 'Lee', 'sp1', '1234', 'Baguio City', '0989424221', 'sp1@gmail.com', 'sp', 'active'),
(11, 'admin', 'admin', 'admin', 'admin', 'Baguio City', '0987232321', 'admin@gmail.com', 'admin', 'active'),
(13, 'Japper', 'Li', 'japper', '1234', 'Camp 7, Baguio City', '0982727291', 'japper@gmail.com', 'client', 'active');

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
(2, '1', 'Install'),
(3, '1', 'Repair/ Replace'),
(4, '1', 'Relocate/ Move'),
(5, '1', 'Inspection'),
(6, '2', 'Plumbing Repair'),
(7, '2', 'Plumbing Installation'),
(8, '2', 'Declogging'),
(9, '3', 'Repair Furniture'),
(10, '3', 'Door Installation'),
(11, '3', 'Repair Door Hinges'),
(12, '4', 'Not cold/ Not working optimally'),
(13, '4', 'Air not blowing/ Not blowing optimallhy'),
(14, '4', 'Leaking'),
(15, '4', 'Control/ Sensor Problem');

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
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specifics`
--
ALTER TABLE `specifics`
  MODIFY `specifics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spservice`
--
ALTER TABLE `spservice`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
