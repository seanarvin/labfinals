-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 08:27 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `transaction_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `transaction_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 5),
(4, 2, 1),
(5, 2, 4),
(6, 3, 2),
(7, 3, 3),
(8, 3, 1),
(9, 4, 4),
(10, 4, 5),
(11, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `pay_cat` varchar(40) NOT NULL,
  `pay_type` varchar(40) NOT NULL,
  `pay_name` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_tag` varchar(255) NOT NULL,
  `product_status` varchar(255) NOT NULL,
  `product_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `service_id`, `product_qty`, `product_price`, `product_name`, `product_type`, `product_desc`, `product_category`, `product_tag`, `product_status`, `product_rate`) VALUES
(1, 32, 1, 500.00, 'Grimm Reaper', 'Cloak', 'grimm reaper cloak', 'Halloween', 'reaper', 'available', 150),
(2, 32, 2, 200.00, 'Madoca Magica Bow', 'Toy Weapon', 'Madoca Magica Bow weapons', 'Cosplay', 'magical girl items', 'available', 50),
(3, 32, 1, 300.00, 'Infinity Gauntlet', 'Gloves', 'Thanos Infinity Gauntlet', 'Cospay', 'Metalic Gold Gauntlet ', 'available', 50),
(4, 32, 1, 600.00, 'Buster Sword', 'Cosplay Toy', 'Cloud\'s Buster Sword', 'Cosplay Props', 'Big A$$ sword', 'available', 300),
(5, 32, 1, 1000.00, 'Iron Man Custome', 'Clothes', 'Irom Man Handmade Custome', 'Cosplay', 'iron man', 'available', 500);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `customer` int(10) NOT NULL,
  `retailer` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `orders` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `customer`, `retailer`, `status`, `date_start`, `date_end`, `orders`) VALUES
(1, 33, 32, 'done', '2018-05-01', '2018-05-04', 1),
(2, 33, 32, 'done', '2018-05-06', '2018-05-12', 2),
(3, 33, 32, 'done', '2018-05-09', '2018-05-13', 3),
(4, 34, 35, 'done', '2018-05-12', '2018-05-15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `middle_initial` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `pic` varchar(255) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `firstname`, `lastname`, `gender`, `birthdate`, `middle_initial`, `password`, `email`, `nickname`, `address`, `contact_no`, `status`, `pic`, `usertype`) VALUES
(1, 'admin', 'Leo Evrian', 'Diano', 'Male', '1995-10-03', 'E.', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'leo_evrian@yahoo.com', 'Ian', 'Baguio City', '09394011187', 'active', '169715.jpg', 'Admin'),
(32, 'Hanna', 'Hanna Deza', 'Diano', 'Female', '1998-07-16', 'E.', '0c16f7960340b8bcddb5623adc2132bf6af7cb7b', 'kyutmylove@yahoo.com', 'Zed', 'Leonilla Hill', '09394011187', 'active', '982105.jpg', 'Retailer'),
(33, 'ralph', 'Ralph Gian', 'Diano', 'Male', '2004-05-11', 'E.', '138e0cf9b1fc023db349cd568e9913b2d21560c0', 'giandiano@gmail.com', 'popot', 'Masinloc, Zambales', '09996541234', 'deactivated', '649198.jpg', 'Customer'),
(34, 'lourdes', 'Lourdes', 'Diano', 'Female', '1974-02-18', 'E.', '232d69ef19bc21657517c33a1e9b61902906ace2', 'leodette@gmail.com', 'odette', 'Masinloc, Zambales', '09088731417', 'deactivated', '790367.jpg', 'Customer'),
(35, 'Leo', 'Leo', 'Diano', 'Male', '1973-09-16', 'E.', '838518c6cb2b50d6e720f88cbe4ef4c0ad52a975', 'leo_diano13@yahoo.com', 'kuya', 'Masinloc, Zambales', '09394011187', 'active', '000131.jpg', 'Retailer'),
(36, 'marygrace', 'Mary Grace Joy ', 'Jalipa', 'Female', '1996-07-09', 'V. ', '3eac329c208657f1d240cf5a24f32c084d8c2557', 'gracejalipa@gmail.com', 'joyjoy', 'Project 4, Quezon City', '09425686113', 'active', '797977.jpg', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `retailer` (`retailer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`retailer`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
