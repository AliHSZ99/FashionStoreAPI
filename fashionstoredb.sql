-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 10:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionstoredb`
--
CREATE DATABASE IF NOT EXISTS `fashionstoredb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fashionstoredb`;

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

DROP TABLE IF EXISTS `customerorder`;
CREATE TABLE `customerorder` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total` double NOT NULL,
  `status` varchar(15) NOT NULL,
  `guest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password_hash` text NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `api_key` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `email`, `first_name`, `last_name`, `password_hash`, `phone_number`, `api_key`) VALUES
(2, 'f', 'f', 'f', '$2y$10$7RnuM1IyP5Eerhf57w7Z..w35azTBl3NsXrmvc1eEIocvuEsaCh1u', 'f', 'fashionstore626452eebdc0a'),
(9, 'a', 'a', 'a', '$2y$10$7Au3KxfhFJuW9CXFRIcbAuhqIdMpdUy9prfKnxzDAc0tfzT07EGCe', 'a', 'fashionstore62645ddecfb7e'),
(10, 'c', 'c', 'c', '$2y$10$XKG8kzZWATjkptCULMdWmu0OftF42jjwQ/3JtcF8JjHyaYQjpM4pK', 'c', 'fashionstore62645e85e0ec4'),
(11, 'd', 'd', 'd', '$2y$10$xqeR7h4TpYBiLDl2lzh8Ee0DOMMCDEPfpcltguL.Bc/30ZLBT5ieu', 'd', 'fashionstore626461f2dd505');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_size` char(1) NOT NULL,
  `item_type` varchar(30) NOT NULL,
  `item_brand` varchar(30) NOT NULL,
  `item_color` varchar(15) NOT NULL,
  `item_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE `orderitems` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customerorder_to_guest` (`guest_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD KEY `orderitems_to_order` (`order_id`),
  ADD KEY `orderitems_to_item` (`item_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `wishlist_to_item` (`item_id`),
  ADD KEY `wishlist_to_guest` (`guest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `customerorder_to_guest` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_to_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitems_to_order` FOREIGN KEY (`order_id`) REFERENCES `customerorder` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_to_guest` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_to_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
