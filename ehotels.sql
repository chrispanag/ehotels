-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 21, 2018 at 09:39 PM
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
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CUSTOMERS`
--

INSERT INTO `CUSTOMERS` (`irs_number`, `ssn`, `first_name`, `last_name`, `first_registration`) VALUES
('093809900', '3247673246', 'Grigorios', 'Thanasoulas', '2018-05-21 18:21:21'),
('885784850', '1908309219', 'Sissy', 'Kosma', '2018-04-30 21:14:00');

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

--
-- Dumping data for table `EMPLOYEES`
--

INSERT INTO `EMPLOYEES` (`irs_number`, `ssn`, `first_name`, `last_name`) VALUES
('498239873', '8473878190', 'Nikoletta', 'Katsouli'),
('904257238', '8401374930', 'Christos', 'Panagiotakopoulos');

-- --------------------------------------------------------

--
-- Table structure for table `HOTELS`
--

CREATE TABLE `HOTELS` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_rooms` int(11) NOT NULL,
  `stars` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `HOTELS`
--

INSERT INTO `HOTELS` (`id`, `email_address`, `phone_number`, `number_of_rooms`, `stars`) VALUES
(5555, 'cityofstars@gmail.com', '2109927187', 20, 3),
(7890, 'happyholidays@gmail.com', '2105540395', 40, 5);

-- --------------------------------------------------------

--
-- Table structure for table `HOTEL_GROUPS`
--

CREATE TABLE `HOTEL_GROUPS` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hotels` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `HOTEL_GROUPS`
--

INSERT INTO `HOTEL_GROUPS` (`id`, `hotels`, `email`, `phone`) VALUES
('763', '3', 'happy@gmail.com', '2104789909');

-- --------------------------------------------------------

--
-- Table structure for table `ROOMS`
--

CREATE TABLE `ROOMS` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `capacity` int(255) NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amenities` longtext COLLATE utf8_unicode_ci NOT NULL,
  `repairs_need` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expendable` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ROOMS`
--

INSERT INTO `ROOMS` (`id`, `price`, `capacity`, `view`, `amenities`, `repairs_need`, `expendable`) VALUES
('33439', 40, 2, 'garden ', 'wifi, parking, toiletry, private bathroom, TV', 'no', 'yes'),
('94809', 90, 3, 'sea', 'wifi, parking, toiletry, private bathroom, TV', 'no', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD PRIMARY KEY (`irs_number`),
  ADD UNIQUE KEY `ssn` (`ssn`);

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
  ADD UNIQUE KEY `email` (`email_address`);

--
-- Indexes for table `HOTEL_GROUPS`
--
ALTER TABLE `HOTEL_GROUPS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ROOMS`
--
ALTER TABLE `ROOMS`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `HOTELS`
--
ALTER TABLE `HOTELS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7891;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
