-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2019 at 05:55 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

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

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `sp_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate`, `comment`, `sp_id`, `client_id`) VALUES
(1, 4, 'ang galing ni bill mag flush ng toilet', 49, 48),
(2, 5, 'Thankyou po sa pag ayos', 49, 48),
(3, 2, 'hnd na po sorry', 46, 48),
(4, 4, 'sa next po ulit :)\r\n', 50, 48),
(5, 2, 'hindi nman po naayos ng mabuti', 47, 52);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `work_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `note` text,
  `client_id` int(11) NOT NULL,
  `specifics` text NOT NULL,
  `status` enum('pending','rejected','ongoing','completed','cancelled') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `date_requested`, `work_id`, `sp_id`, `date`, `from`, `to`, `note`, `client_id`, `specifics`, `status`) VALUES
(3, '2019-01-15 03:22:40', 5, 46, '2019-01-15', '13:22:00', '14:22:00', NULL, 45, '      \n    Paayos po ng door knob', 'ongoing'),
(4, '2019-01-15 04:57:04', 6, 49, '2019-01-15', '15:00:00', '16:00:00', NULL, 48, '      \n    Barado po kasi', 'ongoing'),
(5, '2019-01-15 05:56:28', 5, 46, '2019-01-13', '14:56:00', '15:56:00', NULL, 45, '      \n    ', 'pending'),
(6, '2019-01-16 14:09:13', 5, 46, '2019-01-23', '14:15:00', '17:00:00', NULL, 48, 'ung lock po kasi hnd gumagana', 'cancelled'),
(7, '2019-01-16 14:10:57', 17, 50, '2019-01-16', '08:00:00', '09:00:00', NULL, 48, 'para po sa damit ng baby', 'pending'),
(8, '2019-01-16 14:14:29', 8, 47, '2019-01-19', '08:00:00', '18:00:00', NULL, 51, 'ung wire po sira', 'ongoing'),
(9, '2019-01-16 14:18:19', 8, 47, '2019-01-21', '15:06:00', '17:00:00', NULL, 52, 'paayos po nung sirang wire\n', 'pending'),
(10, '2019-01-17 03:14:52', 5, 46, '2019-01-22', '15:02:00', '17:00:00', NULL, 45, 'paayos po nung lock sa door', 'pending'),
(11, '2019-01-17 04:43:28', 14, 50, '2019-01-21', '15:30:00', '17:00:00', NULL, 45, 'nabasa po ung saksakan', 'completed'),
(12, '2019-01-17 05:16:48', 7, 46, '2019-01-17', '17:00:00', '09:00:00', NULL, 45, 'install bidet', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(45) NOT NULL,
  `sp_id` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `sp_id`, `status`) VALUES
(5, 'Carpentry', 46, 'active'),
(6, 'Plumbing', 49, 'active'),
(7, 'Plumbing', 46, 'active'),
(8, 'electrician', 47, 'active'),
(9, 'electrician', 47, 'active'),
(10, 'plumbing', 47, 'active'),
(11, 'Plumbing', 49, 'active'),
(12, 'Aircon', 49, 'active'),
(13, 'electrician', 50, 'active'),
(14, 'electrician', 50, 'active'),
(15, 'plumbing', 50, 'active'),
(16, 'plumbing', 50, 'active'),
(17, 'carpentry', 50, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

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
(55, 'kaye', 'dagang', 'kaye', '$2y$10$gFUT/5hb9eGL90v501k00.6/.O5mY9elUZzwzAeaiNCEtDG0Z9r3C', 'Lupalok St', 'Ambiong', '15-C', 'Baguio', 'City', '09786522432', 'kaye@kaye.com', 'sp', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE IF NOT EXISTS `work` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `priceFrom` int(50) NOT NULL,
  `priceTo` int(50) NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `service_id`, `description`, `priceFrom`, `priceTo`) VALUES
(5, '5', 'Fix doors', 100, 500),
(6, '6', 'Fix Toilet', 300, 750),
(7, '7', 'Faucet Replacement', 250, 500),
(8, '8', 'able to fix wires', 400, 0),
(9, '9', 'fix lights', 250, 0),
(10, '10', 'fix toilets', 750, 0),
(11, '11', 'clean the comfort room', 500, 0),
(12, '12', 'Fix coolers of aircon', 1200, 0),
(13, '13', 'can fix wires', 150, 0),
(14, '14', 'can fix outlets', 450, 0),
(15, '15', 'can drain clogged sink', 700, 0),
(16, '16', 'can fix clogged toilet', 300, 0),
(17, '17', 'can build cabinet', 1600, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
