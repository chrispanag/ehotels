-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 30, 2018 at 11:29 PM
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
-- Table structure for table `ADDRESSES`
--

CREATE TABLE `ADDRESSES` (
  `address_id` int(11) NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ADDRESSES`
--

INSERT INTO `ADDRESSES` (`address_id`, `street`, `number`, `postal_code`, `city`) VALUES
(1, 'street1', '1', '16777', 'Thessaloniki'),
(2, 'street2', '2', '16779', 'Athens'),
(3, 'street3', '3', '16778', 'Hania'),
(4, 'street4', '4', '16710', 'Giannena');

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE `CUSTOMERS` (
  `irs_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEES`
--

CREATE TABLE `EMPLOYEES` (
  `irs_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HOTELS`
--

CREATE TABLE `HOTELS` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stars` enum('0','1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  `hotel_group_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HOTEL_GROUPS`
--

CREATE TABLE `HOTEL_GROUPS` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `HOTEL_GROUPS`
--

INSERT INTO `HOTEL_GROUPS` (`id`, `email`, `phone`, `address_id`) VALUES
(0, 'hotel_group1@hotel.com', '6981684285', 1),
(1, 'hotel_group2@hotel.com', '6981684286', 2),
(2, 'hotel_group3@hotel.com', '6981684288', 3),
(3, 'hotel_group4@hotel.com', '6981684289', 4);

-- --------------------------------------------------------

--
-- Table structure for table `PAYMENT_TRANSACTIONS`
--

CREATE TABLE `PAYMENT_TRANSACTIONS` (
  `id` int(11) NOT NULL,
  `payment_amount` decimal(10,0) NOT NULL,
  `payment_method` enum('CASH','CREDIT_CARD') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RENTS`
--

CREATE TABLE `RENTS` (
  `employee_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RESERVES`
--

CREATE TABLE `RESERVES` (
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

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

-- --------------------------------------------------------

--
-- Table structure for table `WORKS`
--

CREATE TABLE `WORKS` (
  `employee_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADDRESSES`
--
ALTER TABLE `ADDRESSES`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD PRIMARY KEY (`irs_number`),
  ADD UNIQUE KEY `ssn` (`ssn`),
  ADD KEY `address_customer` (`address_id`);

--
-- Indexes for table `EMPLOYEES`
--
ALTER TABLE `EMPLOYEES`
  ADD PRIMARY KEY (`irs_number`),
  ADD UNIQUE KEY `ssn` (`ssn`),
  ADD KEY `employee_address` (`address_id`);

--
-- Indexes for table `HOTELS`
--
ALTER TABLE `HOTELS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email_address`),
  ADD KEY `hotel_groups_hotel` (`hotel_group_id`),
  ADD KEY `address_hotel` (`address_id`);

--
-- Indexes for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_hotel_group` (`address_id`);

--
-- Indexes for table `PAYMENT_TRANSACTIONS`
--
ALTER TABLE `PAYMENT_TRANSACTIONS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RENTS`
--
ALTER TABLE `RENTS`
  ADD PRIMARY KEY (`room_id`,`start_date`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD KEY `customer_rents` (`customer_id`),
  ADD KEY `employee_rents` (`employee_id`);

--
-- Indexes for table `RESERVES`
--
ALTER TABLE `RESERVES`
  ADD PRIMARY KEY (`room_id`,`start_date`) USING BTREE,
  ADD KEY `customer_reserves` (`customer_id`);

--
-- Indexes for table `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_rooms` (`hotel_id`);

--
-- Indexes for table `WORKS`
--
ALTER TABLE `WORKS`
  ADD PRIMARY KEY (`employee_id`,`hotel_id`) USING BTREE,
  ADD KEY `hotel` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADDRESSES`
--
ALTER TABLE `ADDRESSES`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `HOTELS`
--
ALTER TABLE `HOTELS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `PAYMENT_TRANSACTIONS`
--
ALTER TABLE `PAYMENT_TRANSACTIONS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ROOMS`
--
ALTER TABLE `ROOMS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD CONSTRAINT `address_customer` FOREIGN KEY (`address_id`) REFERENCES `ADDRESSES` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `EMPLOYEES`
--
ALTER TABLE `EMPLOYEES`
  ADD CONSTRAINT `employee_address` FOREIGN KEY (`address_id`) REFERENCES `ADDRESSES` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `HOTELS`
--
ALTER TABLE `HOTELS`
  ADD CONSTRAINT `address_hotel` FOREIGN KEY (`address_id`) REFERENCES `ADDRESSES` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_groups_hotel` FOREIGN KEY (`hotel_group_id`) REFERENCES `HOTEL_GROUPS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  ADD CONSTRAINT `address_hotel_group` FOREIGN KEY (`address_id`) REFERENCES `ADDRESSES` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RENTS`
--
ALTER TABLE `RENTS`
  ADD CONSTRAINT `customer_rents` FOREIGN KEY (`customer_id`) REFERENCES `CUSTOMERS` (`irs_number`),
  ADD CONSTRAINT `employee_rents` FOREIGN KEY (`employee_id`) REFERENCES `EMPLOYEES` (`irs_number`),
  ADD CONSTRAINT `payment_rents` FOREIGN KEY (`payment_id`) REFERENCES `PAYMENT_TRANSACTIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_rents` FOREIGN KEY (`room_id`) REFERENCES `ROOMS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RESERVES`
--
ALTER TABLE `RESERVES`
  ADD CONSTRAINT `customer_reserves` FOREIGN KEY (`customer_id`) REFERENCES `CUSTOMERS` (`irs_number`),
  ADD CONSTRAINT `room_reserves` FOREIGN KEY (`room_id`) REFERENCES `ROOMS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD CONSTRAINT `hotel_rooms` FOREIGN KEY (`hotel_id`) REFERENCES `HOTELS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `WORKS`
--
ALTER TABLE `WORKS`
  ADD CONSTRAINT `employee` FOREIGN KEY (`employee_id`) REFERENCES `EMPLOYEES` (`irs_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel` FOREIGN KEY (`hotel_id`) REFERENCES `HOTELS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
