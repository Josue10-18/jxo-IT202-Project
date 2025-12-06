-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql1.njit.edu
-- Generation Time: Dec 06, 2025 at 08:07 AM
-- Server version: 8.0.17
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jxo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ShirtsTypes`
--

CREATE TABLE IF NOT EXISTS `ShirtsTypes` (
  `ShirtTypeID` int(11) NOT NULL,
  `ShirtTypeCode` varchar(255) NOT NULL,
  `ShirtTypeName` varchar(255) NOT NULL,
  `AisleNumber` int(11) NOT NULL,
  `DateTimeCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ShirtsTypes`
--

INSERT INTO `ShirtsTypes` (`ShirtTypeID`, `ShirtTypeCode`, `ShirtTypeName`, `AisleNumber`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(100, 'GRAPHIC', 'Graphic Tees', 1, '2025-10-20 13:56:07', '2025-10-20 13:56:07'),
(200, 'COTTON', 'Cotton Tees', 2, '2025-10-20 13:56:11', '2025-10-20 13:56:11'),
(300, 'LONGSLV', 'Long Sleeve', 3, '2025-10-20 13:56:13', '2025-10-20 13:56:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ShirtsTypes`
--
ALTER TABLE `ShirtsTypes`
 ADD PRIMARY KEY (`ShirtTypeID`), ADD UNIQUE KEY `ShirtTypeCode` (`ShirtTypeCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
