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
-- Table structure for table `Shirts`
--

CREATE TABLE IF NOT EXISTS `Shirts` (
  `ShirtID` int(11) NOT NULL,
  `ShirtCode` varchar(10) NOT NULL,
  `ShirtName` varchar(255) NOT NULL,
  `ShirtDescription` text NOT NULL,
  `Material` varchar(255) NOT NULL,
  `Fit` varchar(10) NOT NULL,
  `ShirtTypeID` int(11) NOT NULL,
  `ShirtWholesalePrice` decimal(10,2) NOT NULL,
  `ShirtListPrice` decimal(10,2) NOT NULL,
  `DateTimeCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Shirts`
--

INSERT INTO `Shirts` (`ShirtID`, `ShirtCode`, `ShirtName`, `ShirtDescription`, `Material`, `Fit`, `ShirtTypeID`, `ShirtWholesalePrice`, `ShirtListPrice`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(200, '250', 'Soccer Tshirt', 'Soccer Shirt for kids.', 'cotton', 'small', 600, 20.99, 25.99, '2025-12-06 05:54:36', '2025-12-06 05:54:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Shirts`
--
ALTER TABLE `Shirts`
 ADD PRIMARY KEY (`ShirtID`), ADD UNIQUE KEY `ShirtCode` (`ShirtCode`), ADD KEY `ShirtTypeID` (`ShirtTypeID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Shirts`
--
ALTER TABLE `Shirts`
ADD CONSTRAINT `Shirts_ibfk_1` FOREIGN KEY (`ShirtTypeID`) REFERENCES `ShirtTypes` (`ShirtTypeID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
