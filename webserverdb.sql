-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 06:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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
  `quantity` int(11) NOT NULL,
  `size` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`client_id`, `item_id`, `quantity`, `size`) VALUES
(38, 4, 1, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `api_key` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `api_key`) VALUES
(38, 'fashionstore626d890b62fe0'),
(39, 'fashionstore626d8cdb8a75c'),
(40, 'fashionstore626d964c52348'),
(41, 'fashionstore626d966e0e11c'),
(42, 'fashionstore626d96b0a418c'),
(43, 'fashionstore626d96c896d14'),
(44, 'fashionstore626d9c2dc6052'),
(45, 'fashionstore626d9e7563f31'),
(46, 'fashionstore626da16ef3557'),
(47, 'fashionstore626db804bb15f'),
(48, 'fashionstore626db8bd530b0'),
(49, 'fashionstore626db90ee93e9'),
(50, 'fashionstore626db925e155b'),
(51, 'fashionstore626dbeaf1499f'),
(52, 'fashionstore626dbef7eef4d'),
(53, 'fashionstore626dbf3e82034'),
(54, 'fashionstore626dbf86d12cb'),
(55, 'fashionstore626dbff073674'),
(56, 'fashionstore626dc07dad65d'),
(57, 'fashionstore626dc1ae555b0'),
(58, 'fashionstore626ddac5d3266'),
(59, 'fashionstore626ddb6413f2e'),
(60, 'fashionstore626dddcc8f374');

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
(1, 'Calvin Klein CK One lounge sweatshirt in blue', 'Hoodies & Sweatshirts', 'Calvin Klein', 'Navy', 49.5, 'images.asos-media.com/products/calvin-klein-ck-one-lounge-sweatshirt-in-blue/200970328-1-navy'),
(2, 'Abercrombie & Fitch elevated central circle logo hoodie in b', 'Hoodies & Sweatshirts', 'Abercrombie & Fitch', 'black', 69, 'images.asos-media.com/products/abercrombie-fitch-elevated-central-circle-logo-hoodie-in-black/201544751-1-black'),
(3, 'River Island Big & Tall paradise sweatshirt in navy', 'Hoodies & Sweatshirts', 'River Island', 'NAVY', 64, 'images.asos-media.com/products/river-island-big-tall-paradise-sweatshirt-in-navy/201855500-1-navy'),
(4, 'Tommy Hilfiger exclusive to ASOS flag sweatshirt in washed g', 'Hoodies & Sweatshirts', 'Tommy Hilfiger', 'Washed gray', 60.5, 'images.asos-media.com/products/tommy-hilfiger-exclusive-to-asos-flag-sweatshirt-in-washed-gray/202431439-1-washedgrey'),
(5, 'Tommy Jeans chest band color block logo hoodie in black', 'Hoodies & Sweatshirts', 'Tommy Jeans', 'Black / smooth stone', 114.5, 'images.asos-media.com/products/tommy-jeans-chest-band-color-block-logo-hoodie-in-black/23781222-1-blacksmoothstone'),
(6, 'River Island oversized sweatshirt in black', 'Hoodies & Sweatshirts', 'River Island', 'Black', 60, 'images.asos-media.com/products/river-island-oversized-sweatshirt-in-black/24528701-1-black'),
(7, 'Nike Club crew neck sweatshirt in washed teal', 'Hoodies & Sweatshirts', 'Nike', 'Blues', 79, 'images.asos-media.com/products/nike-club-crew-neck-sweatshirt-in-washed-teal/200877358-1-blue'),
(8, 'Nike Move to Zero Revival fleece sweatshirt in mint', 'Hoodies & Sweatshirts', 'Nike', 'Green', 87, 'images.asos-media.com/products/nike-move-to-zero-revival-fleece-sweatshirt-in-mint/200879072-1-green'),
(9, 'Nike Sport Essentials Multi Futura logo fleece hoodie in bla', 'Hoodies & Sweatshirts', 'Nike', 'Black', 95, 'images.asos-media.com/products/nike-sport-essentials-multi-futura-logo-fleece-hoodie-in-black/200882359-1-black');

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
