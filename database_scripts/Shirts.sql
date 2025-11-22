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
-- Table structure for table `Shirts`
--

DROP TABLE IF EXISTS `Shirts`;
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
-- Truncate table before insert `Shirts`
--

TRUNCATE TABLE `Shirts`;
--
-- Dumping data for table `Shirts`
--

INSERT INTO `Shirts` (`ShirtID`, `ShirtCode`, `ShirtName`, `ShirtDescription`, `Material`, `Fit`, `ShirtTypeID`, `ShirtWholesalePrice`, `ShirtListPrice`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(1000, 'GOD', 'JESUS IS THE TRUTH', 'A classic black t-shirt a cross design. This shirt is comfortable for all-day wear and highly durable.', 'Cotton Blend', 'L', 100, 12.50, 24.99, '2025-10-24 17:03:04', '2025-10-24 17:03:04'),
(2000, 'CROWN', 'BLUE LONG SLEEVE', 'A heavy-weight, deep navy blue long sleeve shirt. Perfect for layering during cooler months, its reinforced stitching ensures longevity.', 'Heavy Cotton', 'XL', 300, 15.00, 29.99, '2025-10-24 17:03:08', '2025-10-24 17:03:08'),
(3000, 'CAR', 'GRAPHIC LONG SLEVE', 'A graphic design long sleeve. The knit fabric provides style and comfort.', 'Polyester Blend', 'Slim', 300, 12.00, 28.99, '2025-10-24 17:03:09', '2025-10-24 17:03:09');

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
