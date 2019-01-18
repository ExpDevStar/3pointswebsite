-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2019 at 03:08 PM
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
(0, 'Hordeolum and chalazion', ' H00.011 …… right upper eyelid\r\n H00.012 …… right lower eyelid\r\n H00.013 …… right eye, unspecified eyelid\r\n H00.014 …… left upper eyelid\r\n H00.015 …… left lower eyelid\r\n H00.016 …… left eye, unspecified eyelid\r\n'),
(1, '02A3 Cancer', 'Has Metal Chains'),
(2, 'A00 - Cholera', 'A00.0 Cholera due to Vibrio cholerae 01, biovar cholerae\r\nA00.1 Cholera due to Vibrio cholerae 01, biovar eltor\r\nA00.9 Cholera, unspecified');

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
(0, 1, 1, 'Bandaids was more expensive from insurance', '2018-12-04', '2018-12-24', 'Adrian Chrysanthu', '3'),
(1, 0, 3, 'Took a lot of work, finished it. Medical Diagnosis Good. ', '2018-12-04', '2018-12-24', 'Signed Me', '120');

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
(0, 1, 1, '0'),
(1, 1, 0, '30'),
(3, 2, 1, '2'),
(4, 2, 4, '100');

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
(0, 'Pain Meds'),
(1, 'Bandaids'),
(3, 'Brace'),
(4, 'MRI Scan'),
(5, 'Pap Smear'),
(6, 'Thyroid Blood Tests'),
(7, 'Ultrasound'),
(8, 'Cortisone Injection');

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
