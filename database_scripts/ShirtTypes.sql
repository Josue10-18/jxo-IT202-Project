-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql1.njit.edu
-- Generation Time: Nov 22, 2025 at 04:37 AM
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
-- Table structure for table `ShirtTypes`
--

DROP TABLE IF EXISTS `ShirtTypes`;
CREATE TABLE IF NOT EXISTS `ShirtTypes` (
  `ShirtTypeID` int(11) NOT NULL,
  `ShirtTypeCode` varchar(255) NOT NULL,
  `ShirtTypeName` varchar(255) NOT NULL,
  `AisleNumber` int(11) NOT NULL,
  `DateTimeCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `ShirtTypes`
--

TRUNCATE TABLE `ShirtTypes`;
--
-- Dumping data for table `ShirtTypes`
--

INSERT INTO `ShirtTypes` (`ShirtTypeID`, `ShirtTypeCode`, `ShirtTypeName`, `AisleNumber`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(100, 'GRAPHIC', 'Graphic Tees', 1, '2025-10-20 14:40:17', '2025-10-20 14:40:17'),
(200, 'COTTON', 'Cotton Tees', 2, '2025-10-20 14:40:18', '2025-10-20 14:40:18'),
(300, 'LONGSLV', 'Long Sleeve', 3, '2025-10-20 14:40:19', '2025-10-20 14:40:19'),
(500, 'TEST', 'test', 4, '2025-10-24 17:10:17', '2025-10-24 17:10:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ShirtTypes`
--
ALTER TABLE `ShirtTypes`
 ADD PRIMARY KEY (`ShirtTypeID`), ADD UNIQUE KEY `ShirtTypeCode` (`ShirtTypeCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
