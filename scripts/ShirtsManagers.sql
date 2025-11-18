--Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
--jxo@njit.edu 
-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net


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
-- Table structure for table `ShirtsManagers`
--

CREATE TABLE IF NOT EXISTS `ShirtsManagers` (
`ShirtsManagerID` int(11) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `pronouns` varchar(60) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `DateTimeCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ShirtsManagers`
--

INSERT INTO `ShirtsManagers` (`ShirtsManagerID`, `emailAddress`, `password`, `pronouns`, `firstName`, `lastName`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(1, 'josue@tshirts.com', 'Josue123', 'He/Him', 'Josue', 'Ortiz', '2025-10-04 00:37:31', '2025-10-04 00:37:31'),
(2, 'josue@graphictees.com', 'Juan123', 'He/Him', 'Juan', 'D Placencio', '2025-10-04 00:37:31', '2025-10-04 00:37:31'),
(3, 'josue@washedtees.com', 'Ceasar123', 'He/Him', 'Ceasar', 'Flores', '2025-10-04 00:37:31', '2025-10-04 00:37:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ShirtsManagers`
--
ALTER TABLE `ShirtsManagers`
 ADD PRIMARY KEY (`ShirtsManagerID`), ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ShirtsManagers`
--
ALTER TABLE `ShirtsManagers`
MODIFY `ShirtsManagerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


