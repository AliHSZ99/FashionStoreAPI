-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 02:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
  `api_key` varchar(60) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `email`, `first_name`, `last_name`, `password_hash`, `phone_number`, `api_key`, `token`) VALUES
(81, 'f', 'f', 'f', '$2y$10$aC6xsucHvmtxR2WQBeoR6ukJgoMTdlIG2EyDpVPWtgBUpFQXAbebu', 'f', 'fashionstore626d890b62fe0', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDU2NzgsImV4cCI6MTY1Mzk3MzY3OH0.Td59dncB9aGPBjK5eZCbIqEWZS2mBZFZUtzjto_8RHM'),
(82, 'b', 'b', 'b', '$2y$10$MWJg/nqLcsO5lQpxhnvy8e8lWRoRba8K7uF5WLBhWflB9FcwnDUDS', 'b', 'fashionstore626d8cdb8a75c', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDY2NTMsImV4cCI6MTY1Mzk3NDY1M30.vjhyy2YP3b-0SnUdZ0xwVmQIZUGm-g3-r-8FeDe-xY0'),
(83, 'gg', 'gg', 'gg', '$2y$10$GWg2QXPt1Ip1zTZqf0T2Vul8W9w5VbWjk6Y3s3ZIFftD4PVtt/X5K', 'gg', 'fashionstore626d964c52348', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDkwNzAsImV4cCI6MTY1Mzk3NzA3MH0.0tCO4iyNCqtWpGhcnTWOTGFSpf-n_MgSC5O9naDAp7s'),
(84, 'hh', 'hhh', 'hh', '$2y$10$/W7eN9ogSPQUvE1/kO9HN.eRJ0luZMsStuW2XU1pJCUo2QxsT51Si', 'hh', 'fashionstore626d966e0e11c', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDkxMDQsImV4cCI6MTY1Mzk3NzEwNH0.C3riyPvvO67b3aEXKxjNuP6IgR6WYBNIQPYqOczGE6s'),
(85, 't', 't', 't', '$2y$10$uBIpmbBuf.04P6o41wW0wevfD1Rx57ZVujQyJL/jlrCHAnSMk0rWa', 't', 'fashionstore626d96b0a418c', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDkxNzAsImV4cCI6MTY1Mzk3NzE3MH0.A5ETHtYEg9VW7n05hlLgcPuXl-pHGQPQdxZNKAen5x0'),
(86, 'y', 'y', 'y', '$2y$10$fogPpsfJZ.GyfUTCRPeDZ.dzCVVl/mIPCsO57qtxJm49i/t18/eru', 'y', 'fashionstore626d96c896d14', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNDkxOTQsImV4cCI6MTY1Mzk3NzE5NH0.dR-dID6ZeN3mkZcREOdRJVRhQz0469Ukd2KNWmb4TEU'),
(87, 'hhh', 'hhh', 'hhh', '$2y$10$FcBHWy9HGy4bmvs0dUpMjuGRlDEBfpA.5bhuhxDnV7lyn/Nii2r52', 'hhh', 'fashionstore626d9c2dc6052', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTA1NzgsImV4cCI6MTY1Mzk3ODU3OH0.edA0PunrqjRD7YhcY3U5JjOdcwWiNypPQKlF0pbu05w'),
(88, 'jj', 'jj', 'jj', '$2y$10$QLNbgtfj1Ag6ZhESMDMou.NXf88VABhPi/sonGUyJmzBmDE.T6oeO', 'jj', 'fashionstore626d9e7563f31', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTExNTksImV4cCI6MTY1Mzk3OTE1OX0.s35EGbdcYBEB2lsWRFdZKaxQyGWjtu710aqBssL0avc'),
(89, 'p', 'p', 'p', '$2y$10$QnvU1B/73S3U7ohmOcasDuRXpIrd5CnvUKFW5X0YwzRXMvDvwarFq', 'p', 'fashionstore626da16ef3557', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTE5NjIsImV4cCI6MTY1Mzk3OTk2Mn0.GNUm9NtW7fO9dVYV9VIYJAbK4-_SDOJJpxC-10qqAzw'),
(90, 'as', 'as', 'as', '$2y$10$bPeSFesocZVIDRezTUoa7O2l0BA1Jkc/W9iPioYTd/AOidV.HlK9O', 'as', 'fashionstore626db804bb15f', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTc3MDMsImV4cCI6MTY1Mzk4NTcwM30.nl5B8a2m-RxayJA-jMezq8ERUuL6ifCshO7TARkEcYQ'),
(91, 'k', 'k', 'k', '$2y$10$1RFjf3ko091QAlrNxIlhtusV0za.VK2qFl6nhIPTgB/E4YiWH3hkG', 'k', 'fashionstore626db8bd530b0', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTc4ODcsImV4cCI6MTY1Mzk4NTg4N30.eOyBiieM0jjX-1jISiMPl9rQqNspML6Y-OxxXIGGH0U'),
(92, 'kk', 'kk', 'kk', '$2y$10$E8hFEIqLpkzX76dxj4TUdeF0KBknQB8pe2qqyglpk0Ilti84yJKfe', 'kk', 'fashionstore626db90ee93e9', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTc5NjksImV4cCI6MTY1Mzk4NTk2OX0.7tf0vZRGA17pesscYirc2q8PKWkVkaR8PyzyXVoP1ec'),
(93, 'dd', 'dd', 'dd', '$2y$10$Vu9PAqNcnvB836scQiGgVOgSdDwwr9vF8NOVWfZnaM1h3eM03jOFi', 'dd', 'fashionstore626db925e155b', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTc5OTIsImV4cCI6MTY1Mzk4NTk5Mn0.kidU3QIaoJhaNFGaEKuJbOATTdyPK81n62Yp5dpxRZw'),
(94, 'cc', 'cc', 'cc', '$2y$10$aTCR67NUYnlrHu3FvAx67O/7OLfckZejBh1zaH7Xn5iVyl.NxTzOa', 'cc', 'fashionstore626dbeaf1499f', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk0MDksImV4cCI6MTY1Mzk4NzQwOX0.IGUFk7_kSar7hlwGnx-e34GR9UBRkxP0OCcFYgjfCYE'),
(95, '2', '2', '2', '$2y$10$ooSePOQYAgA7Gik5Jkwv/ezU2D/olvLDKzKSPrZt.lIf1tbVU4n3K', '2', 'fashionstore626dbef7eef4d', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk0ODMsImV4cCI6MTY1Mzk4NzQ4M30.Regml_u-K2WdH2PVxQNrR0ebWDcJxM_1womWDD19uVQ'),
(96, 'ass', 'ass', 'ass', '$2y$10$ddRH4X/kjCQsMpx3kzpRz.xc8UiC.CrZNJ/Slev3jyui6WkDldG4W', 'ass', 'fashionstore626dbf3e82034', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk1NTMsImV4cCI6MTY1Mzk4NzU1M30.QkfHiofsxuTaR2nZSH5mK8BkAzMTPuuPS3TRsVwOo4E'),
(97, 'jjj', 'jjj', 'jjj', '$2y$10$NG0N1.I4FKKDz.hAQdhJAepkUfbhtxohMixqVHx0DBiBimGp8gwJ2', 'jjj', 'fashionstore626dbf86d12cb', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk2MjUsImV4cCI6MTY1Mzk4NzYyNX0.lPt0JErldZSWapzV_5pf5aYcwWtaRomH38Pn9EHEpjI'),
(98, 'ww', 'ww', 'ww', '$2y$10$qLSVBCEHdijZLFNTgSjqLe3S9kOMbL9TVBET17TSTIfBO/09zC8s2', 'ww', 'fashionstore626dbff073674', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk3MzAsImV4cCI6MTY1Mzk4NzczMH0.5rRUp11bwlrcQZeVnsouYvFv5DSCMZK1BU9B2biWx5A'),
(99, 'w', 'w', 'w', '$2y$10$GUf3bxeEd7I86H2HL/Jdv.6qjtgPIWq0om0VPLmdll5mUk8Yr4MQu', 'w', 'fashionstore626dc07dad65d', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNTk4NzIsImV4cCI6MTY1Mzk4Nzg3Mn0.-42KzM5wNbNAjGzdxmZF57ju6CPU50zXb7gLhln_Pgw'),
(100, 'www', 'www', 'www', '$2y$10$Bd/oclRFhd49i88xPKGOlOEeCuMECxrRJ89t6aanJHpSnNdyefbAm', 'www', 'fashionstore626dc1ae555b0', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0F1dGgvaW5kZXgiLCJpYXQiOjE2NTEzNjAxNzYsImV4cCI6MTY1Mzk4ODE3Nn0.OafG84K3asTEDAoGKRRgHluv_JqN1SbxqnCrO1lmPJU'),
(101, 'tr', 'tr', 'tr', '$2y$10$YE9rfhZyWXDh5TWRSOR5Lunsc5.iPD6E/xQMprPLqeIoA7WYBqFlu', 'tr', 'fashionstore6271c8242854c', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_price` int(11) NOT NULL,
  `image_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `guest_id`, `item_id`, `item_name`, `item_price`, `image_url`) VALUES
(2, 81, 3, 'River Island Big & Tall paradise sweatshirt in navy', 64, 'images.asos-media.com/products/river-island-big-tall-paradise-sweatshirt-in-navy/201855500-1-navy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `wishlist_to_guest` (`guest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_to_guest` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
