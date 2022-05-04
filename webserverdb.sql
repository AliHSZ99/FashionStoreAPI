-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 09:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webserverdb`
--
CREATE DATABASE IF NOT EXISTS `webserverdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webserverdb`;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE `checkout` (
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`client_id`, `item_id`, `size`) VALUES
(66, 19, 'S'),
(67, 19, 'S'),
(67, 20, 'S'),
(68, 19, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `api_key` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `api_key`, `email`) VALUES
(64, 'fashionstore6271f8523ea17', ''),
(65, 'fashionstore6271f918b6bf5', ''),
(66, 'fashionstore62720893196d7', ''),
(67, 'fashionstore62720c7bc246e', ''),
(68, 'fashionstore62721075a6aea', '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(60) NOT NULL,
  `item_type` varchar(30) NOT NULL,
  `item_brand` varchar(30) NOT NULL,
  `item_color` varchar(30) NOT NULL,
  `item_price` double NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_type`, `item_brand`, `item_color`, `item_price`, `image_url`) VALUES
(19, 'ASOS DESIGN splice print sweatshirt in brown - part of a set', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'CHOCOLATE BROWN', 45, 'images.asos-media.com/products/asos-design-splice-print-sweatshirt-in-brown-part-of-a-set/201608003-1-chocolatebrown'),
(20, 'ASOS DESIGN oversized sweatshirt in purple & green color blo', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'WHITE', 45, 'images.asos-media.com/products/asos-design-oversized-sweatshirt-in-purple-green-color-block-with-chest-print/201608322-1-white'),
(21, 'ASOS DESIGN oversized hoodie in blue & orange color block wi', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'Azure Blue', 55, 'images.asos-media.com/products/asos-design-oversized-hoodie-in-blue-orange-color-block-with-multiplacement-print/201608896-1-azureblue'),
(22, 'ASOS DESIGN oversized sweatshirt with splice skull print', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'Dark Gull Gray', 45, 'images.asos-media.com/products/asos-design-oversized-sweatshirt-with-splice-skull-print/201613914-1-darkgullgrey'),
(23, 'ASOS DESIGN oversized rugby sweatshirt in color block with c', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'Brittany blue', 45, 'images.asos-media.com/products/asos-design-oversized-rugby-sweatshirt-in-color-block-with-city-print/201614856-1-brittanyblue'),
(24, 'ASOS DESIGN knit hoodie with floral pattern in brown', 'Hoodies & Sweatshirts', 'ASOS DESIGN', 'BROWN', 55, 'images.asos-media.com/products/asos-design-knit-hoodie-with-floral-pattern-in-brown/201728165-1-brown'),
(25, 'The Nortih Face Denali 2 fleece jacket in gray camo', 'Hoodies & Sweatshirts', 'The North Face', 'Gray tie dye', 189, 'images.asos-media.com/products/the-nortih-face-denali-2-fleece-jacket-in-gray-camo/201664764-1-greytiedye'),
(26, 'Nike Tech Fleece full-zip hoodie in black', 'Hoodies & Sweatshirts', 'Nike', 'Black', 130, 'images.asos-media.com/products/nike-tech-fleece-full-zip-hoodie-in-black/201313775-1-black'),
(27, 'Element Crossfield reverse sweatshirt in gray', 'Hoodies & Sweatshirts', 'Element', 'Gray', 95, 'images.asos-media.com/products/element-crossfield-reverse-sweatshirt-in-gray/201673839-1-grey');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE `orderitems` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total` double NOT NULL,
  `status` varchar(30) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD KEY `checkoutToClient` (`client_id`),
  ADD KEY `checkoutToItem` (`item_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orderItems_to_items` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_to_client` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkoutToClient` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkoutToItem` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderItems_to_items` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderItems_to_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_to_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
