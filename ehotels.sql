-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 26, 2018 at 04:24 PM
-- Server version: 8.0.2-dmr
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE `CUSTOMERS` (
  `irs_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEES`
--

CREATE TABLE `EMPLOYEES` (
  `irs_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HOTELS`
--

CREATE TABLE `HOTELS` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stars` float NOT NULL,
  `hotel_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HOTEL_GROUPS`
--

CREATE TABLE `HOTEL_GROUPS` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `HOTEL_GROUPS`
--

INSERT INTO `HOTEL_GROUPS` (`id`, `email`, `phone`) VALUES
(5, 'fghj', 'sdfghj');

-- --------------------------------------------------------

--
-- Table structure for table `ROOMS`
--

CREATE TABLE `ROOMS` (
  `id` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `capacity` int(255) NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amenities` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `repairs_need` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expendable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EMPLOYEES`
--
ALTER TABLE `EMPLOYEES`
  ADD PRIMARY KEY (`irs_number`);

--
-- Indexes for table `HOTELS`
--
ALTER TABLE `HOTELS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email_address`),
  ADD KEY `hotel_groups_hotel` (`hotel_group_id`);

--
-- Indexes for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_rooms` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `HOTELS`
--
ALTER TABLE `HOTELS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ROOMS`
--
ALTER TABLE `ROOMS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `HOTELS`
--
ALTER TABLE `HOTELS`
  ADD CONSTRAINT `hotel_groups_hotel` FOREIGN KEY (`hotel_group_id`) REFERENCES `HOTEL_GROUPS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD CONSTRAINT `hotel_rooms` FOREIGN KEY (`hotel_id`) REFERENCES `HOTELS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
