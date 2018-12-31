-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2018 at 03:31 PM
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
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `service_type` varchar(45) NOT NULL,
  `rate` double DEFAULT NULL,
  PRIMARY KEY (`service_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`service_type`, `rate`) VALUES
('Plumber', 100),
('Carpenter', 500);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `pay_id` int(11) NOT NULL,
  `pay_date` date DEFAULT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `pay_date`) VALUES
(101, '2018-11-26'),
(102, '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

DROP TABLE IF EXISTS `service_provider`;
CREATE TABLE IF NOT EXISTS `service_provider` (
  `sp_id` int(11) NOT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `order_id` varchar(45) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`sp_id`, `user_id`, `order_id`, `phone_no`) VALUES
(11, '01', '1A', 912345698),
(12, '02', '1B', 1234577921);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `reservation_date` datetime NOT NULL,
  `amount` double DEFAULT NULL,
  `pay_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`reservation_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`reservation_date`, `amount`, `pay_id`) VALUES
('2018-11-26 09:17:15', 100, '101'),
('2018-11-28 15:17:12', 500, '102');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_Name` varchar(50) NOT NULL,
  `last_Name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_No` int(50) NOT NULL,
  `acc_Type` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_Id`, `first_Name`, `last_Name`, `address`, `contact_No`, `acc_Type`, `username`, `password`, `status`) VALUES
(14, 'Carl', 'Dumo', 'dumo st.', 2147483647, 'client', 'dumo', 'dumo123', 'approved'),
(15, 'admintest', 'admin', 'admin st.', 912345123, 'admin', 'admin', 'admin', 'pending'),
(16, 'Faye', 'Lampa', 'faye st.', 912387123, 'Client', 'faye', 'faye123', 'deactivated'),
(17, 'Camille', 'Poyaoan', 'poyaoan st.', 2147483647, 'Client', 'camille', 'camille123', 'approved'),
(18, 'Bill', 'Hilarion', 'cacas st.', 2147483647, 'admintest', 'Bill', 'hilarion123', 'pending'),
(19, 'Bryn', 'Edades', 'cerezo st.', 2147483647, 'Client', 'bryn', 'bryn123', 'deactivated'),
(20, 'Mikka', 'Tuguinay', 'laos angeles', 98765627, 'client', 'mikka', 'mikka123', 'declined'),
(21, 'Rico', 'Pangan', 'cleveland', 19238271, 'client', 'rico', 'rico123', 'approved'),
(22, 'Kieffer', 'Ballesteros', 'boston', 192837123, 'client', 'kieffer', 'kieffer123', 'declined');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
