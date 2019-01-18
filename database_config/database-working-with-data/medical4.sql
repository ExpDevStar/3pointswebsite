-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2018 at 06:35 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical4`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemtype`
--

CREATE TABLE `itemtype` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `defaultSpec` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemtype`
--

INSERT INTO `itemtype` (`item_id`, `name`, `defaultSpec`) VALUES
(1, 'Chainsaw', 'Has Metal Chains');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ID` int(255) NOT NULL,
  `itemTypeID` int(255) DEFAULT NULL,
  `treatmentID` int(255) DEFAULT NULL,
  `spec` varchar(255) DEFAULT NULL,
  `datedone` date DEFAULT NULL,
  `dateout` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID`, `itemTypeID`, `treatmentID`, `spec`, `datedone`, `dateout`, `remarks`, `price`) VALUES
(1, 1, 1, 'Took a lot of work, finished it', '2018-12-04', '2018-12-24', 'Signed Me', '1');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprice`
--

CREATE TABLE `serviceprice` (
  `ID` int(255) NOT NULL,
  `itemTypeID` int(255) DEFAULT NULL,
  `treatmentID` int(255) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprice`
--

INSERT INTO `serviceprice` (`ID`, `itemTypeID`, `treatmentID`, `price`) VALUES
(1, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatment_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `name`) VALUES
(0, 'Name'),
(1, 'Cancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_itemtype` (`itemTypeID`),
  ADD KEY `fk_treatment` (`treatmentID`);

--
-- Indexes for table `serviceprice`
--
ALTER TABLE `serviceprice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_itemtype1` (`itemTypeID`),
  ADD KEY `fk_treatment1` (`treatmentID`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatment_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_itemtype` FOREIGN KEY (`itemTypeID`) REFERENCES `itemtype` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_treatment` FOREIGN KEY (`treatmentID`) REFERENCES `treatment` (`treatment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `serviceprice`
--
ALTER TABLE `serviceprice`
  ADD CONSTRAINT `fk_itemtype1` FOREIGN KEY (`itemTypeID`) REFERENCES `itemtype` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_treatment1` FOREIGN KEY (`treatmentID`) REFERENCES `treatment` (`treatment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
