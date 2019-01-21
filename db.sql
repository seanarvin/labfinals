-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 12:40 AM
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
  `specifics` text NOT NULL,
  `status` enum('pending','rejected','ongoing','completed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `street` varchar(50) NOT NULL,
  `barangay` varchar(45) NOT NULL,
  `housenumber` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `city` varchar(60) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_name`, `password`, `street`, `barangay`, `housenumber`, `municipality`, `city`, `contact_no`, `email`, `type`, `status`) VALUES
(42, 'Admin', 'Boss', 'admin', '$2y$10$cfS.CoS9HBeAlqkSTshPie4X39DvnZWpzjfqfKkV7fLfntD/LB6Uy', '13 North Carolina', 'Tanod', '1001', 'La Trinidad', 'Baguio', '0909123456', 'admin@gmail.com', 'admin', 'active'),
(45, 'arvin', 'dagang', 'sean', '$2y$10$36sPsHFbpJ7Gyo.Jh0LRoeRXD1TrCKSgkO9vvH/6x7DTjWQFhJL5O', 'ambiong road', 'ambiong', '15', 'ambiong', 'baguio', '09172666622', 'sean@sean.com', 'client', 'active'),
(46, 'bryn', 'edades', 'bryn', '$2y$10$zaYbheV/DjXNz57eFTGVbOOBQ9LJmypivaIEnFmUt2zi/tey1PDj2', 'evangelista st', 'leonilla hill', '15', 'baguio', 'baguio', '09172228883', 'bryn@bryn.com', 'sp', 'active'),
(47, 'camille', 'poyaoan', 'camille', '$2y$10$XU8.84858./IiPb6MXY4DOAO4e.G0xdr53raBK.Ir/0OiZazSDElS', 'asin road', 'Asin', '25', 'asin', 'baguio city', '09256663371', 'camille@camille.com', 'sp', 'active'),
(48, 'faye', 'lampa', 'faye', '$2y$10$nFEBCe76zLkbBClWkivWIe1G2ddQtcTt2nK00Dfa1uTmtnF8bWp6S', 'Buginvilla', 'pembo', 'Blk 2 Lot 26', 'Baguio', 'Baguio', '09222277172', 'faye@faye.com', 'client', 'active'),
(49, 'bill', 'hilarion', 'bill', '$2y$10$ezBbGeW.cYwawykrfeITn.4rVBGnhDQzPeuaFOCcgxsM6hAUwUQ.i', 'Pogi Street', 'Banga', '127', 'Baguio', 'Baguio', '09562231157', 'bill@bill.com', 'sp', 'active'),
(50, 'kieffer', 'ballesteros', 'kieffer', '$2y$10$nO3DAP5XMje/2bwZ8Y.HTOAabZdmzozNKKbgmh31VnKQz7dx.3pp.', 'laurel st', 'barangbarang', '127', 'baguio', 'baguio', '09567774422', 'kieffer@kieffer.com', 'sp', 'active'),
(51, 'mikka', 'tuguinay', 'mikka', '$2y$10$Y.DelQi.oNlmeWNmUKe7j.jruhotcAekQ8e1yx7/7P8GWO5UtSiD2', 'San Madrid', 'San Carlos', '18-B', 'Baguio', 'City', '09178233462', 'mikka@mikka.com', 'client', 'active'),
(52, 'rico', 'pangan', 'rico', '$2y$10$PiTI9wna0JN4i1a/NG9OHOS9jBz2rMRtDXD6vBd7.Vu/sXvjMnQk.', 'Lourdes', 'Dominican', '17-19L', 'Baguio', 'City', '09567712281', 'rico@rico.com', 'client', 'active'),
(53, 'Raven', 'Gabriz', 'raven', '$2y$10$OHIBS3rV8vlsxPyXshIXS.SSw8leUkZDUk4TBh4m9heo7oXN9A8Ie', 'Circle Road', 'Bayan Park', '22-H', 'Baguio', 'City', '09765524432', 'raven@raven.com', 'sp', 'pending'),
(54, 'ariel', 'bejar', 'ariel', '$2y$10$5AJwWsH3qFlmJKdwG.Hd3./lQV9SWKxT.jw23XzFXqS11LboDW8IW', 'Bautista', 'Lopez Jaena', '72-R', 'Baguio', 'City', '09177765589', 'ariel@ariel.com', 'client', 'pending'),
(55, 'kaye', 'dagang', 'kaye', '$2y$10$gFUT/5hb9eGL90v501k00.6/.O5mY9elUZzwzAeaiNCEtDG0Z9r3C', 'Lupalok St', 'Ambiong', '15-C', 'Baguio', 'City', '09786522432', 'kaye@kaye.com', 'sp', 'active');

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
  `priceTo` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
