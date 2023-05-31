-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 10:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ID` int(11) NOT NULL,
  `SSN` varchar(20) NOT NULL,
  `Balance` bigint(20) NOT NULL DEFAULT 0,
  `Type` enum('Saving','Gold','Current') NOT NULL,
  `State` enum('Running','Blocked') NOT NULL DEFAULT 'Running',
  `numberOfWithdraws` int(11) DEFAULT NULL,
  `totalWithdraws` int(11) DEFAULT NULL,
  `numberTransfer` int(11) DEFAULT NULL,
  `totalTransfer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ID`, `SSN`, `Balance`, `Type`, `State`, `numberOfWithdraws`, `totalWithdraws`, `numberTransfer`, `totalTransfer`) VALUES
(1151510556, '30308160105379', 11950, 'Current', 'Running', 4, 3350, 2, 700),
(1151510557, '4555465454', 700, 'Current', 'Running', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `ID` int(11) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Street` varchar(30) DEFAULT NULL,
  `Area` varchar(30) DEFAULT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`ID`, `City`, `Street`, `Area`, `Balance`) VALUES
(1286, 'cairo', '32 salah salem st', 'Maadi', 509800),
(1287, 'Alexandria', 'ba7r', 'agami', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE `creditcard` (
  `ID` bigint(20) NOT NULL,
  `ExpDate` date NOT NULL,
  `CVV` varchar(3) NOT NULL,
  `State` enum('Running','Blocked') NOT NULL DEFAULT 'Running'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creditcard`
--

INSERT INTO `creditcard` (`ID`, `ExpDate`, `CVV`, `State`) VALUES
(6639104799903174, '2026-05-30', '286', 'Running'),
(7340306552896431, '2026-05-30', '213', 'Running'),
(9837144487184185, '2026-05-30', '618', 'Running');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Role` enum('Admin','Technician') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `FirstName`, `LastName`, `UserName`, `Password`, `Role`) VALUES
(2184, 'Omar', 'Younis', 'oyounis', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 'Admin'),
(2196, 'Omar', 'Younis', 'srt', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 'Technician');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `SSN` varchar(50) NOT NULL,
  `AtmID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Date` date NOT NULL,
  `State` enum('Approved','Denied') DEFAULT NULL,
  `Type` enum('Withdraw','Transfer','Deposit') NOT NULL,
  `receiverId` int(11) DEFAULT NULL,
  `transaction_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `AccountID`, `SSN`, `AtmID`, `Amount`, `Date`, `State`, `Type`, `receiverId`, `transaction_time`) VALUES
(10185, 1151510556, '30308160105379', 1286, 50, '2023-05-30', 'Denied', 'Withdraw', NULL, '16:44:50'),
(10186, 1151510556, '30308160105379', 1286, 2000, '2023-05-30', 'Approved', 'Deposit', NULL, '16:46:22'),
(10187, 1151510556, '30308160105379', 1286, 500, '2023-05-30', 'Approved', 'Withdraw', NULL, '16:47:18'),
(10188, 1151510556, '30308160105379', 1286, 800, '2023-05-30', 'Approved', 'Withdraw', NULL, '16:48:35'),
(10189, 1151510556, '30308160105379', 1286, 900, '2023-05-30', 'Denied', 'Withdraw', NULL, '16:48:46'),
(10191, 1151510556, '30308160105379', 1286, 2000, '2023-05-30', 'Approved', 'Deposit', NULL, '17:08:29'),
(10192, 1151510556, '30308160105379', 1286, 2000, '2023-05-30', 'Approved', 'Withdraw', NULL, '17:09:37'),
(10193, 1151510556, '30308160105379', 1286, 200, '2023-05-30', 'Approved', 'Transfer', 1151510557, '17:16:58'),
(10194, 1151510556, '30308160105379', 1286, 500, '2023-05-30', 'Approved', 'Transfer', 1151510557, '17:19:47'),
(10195, 1151510556, '30308160105379', 1286, 10000, '2023-05-30', 'Approved', 'Deposit', NULL, '17:21:31'),
(10196, 1151510556, '30308160105379', 1287, 2000, '2023-05-30', 'Approved', 'Deposit', NULL, '19:43:40'),
(10197, 1151510556, '30308160105379', 1286, 50, '2023-05-30', 'Approved', 'Withdraw', NULL, '19:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `SSN` varchar(20) NOT NULL,
  `CardID` bigint(20) NOT NULL,
  `Fingerprint` varchar(150) NOT NULL,
  `PIN` varchar(150) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Street` varchar(30) DEFAULT NULL,
  `Area` varchar(30) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`SSN`, `CardID`, `Fingerprint`, `PIN`, `FirstName`, `LastName`, `Street`, `Area`, `City`, `Email`, `PhoneNo`) VALUES
('30308160105379', 9837144487184185, 'e99b18c2bb71527309084ce73eec0396', '1070a982af22fe711ec54707c0cd838baec99ff81ec4fd7a00fa4ca0ca48c8c4', 'Omar', 'Younis', '32 salah salem st', 'Maadi', 'cairo', 'oyounis19@gmail.com', '01149911487'),
('4555465454', 7340306552896431, '5de1e45ae57059073acc3dfd2460cd5f', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 'Yousif', 'Helaly', 'edwed', 'qwd`', 'hkh', 'wdw@qdde.ewd', '01101255511');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SSN` (`SSN`);

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AccountID` (`AccountID`),
  ADD KEY `SSN` (`SSN`),
  ADD KEY `AtmID` (`AtmID`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`SSN`),
  ADD UNIQUE KEY `CardID` (`CardID`),
  ADD UNIQUE KEY `Fingerprint` (`Fingerprint`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1151510558;

--
-- AUTO_INCREMENT for table `atm`
--
ALTER TABLE `atm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1288;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2198;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10198;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `Account_ibfk_1` FOREIGN KEY (`SSN`) REFERENCES `user` (`SSN`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `Transaction_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Transaction_ibfk_2` FOREIGN KEY (`SSN`) REFERENCES `user` (`SSN`) ON DELETE CASCADE,
  ADD CONSTRAINT `Transaction_ibfk_3` FOREIGN KEY (`AtmID`) REFERENCES `atm` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Transaction_ibfk_4` FOREIGN KEY (`receiverId`) REFERENCES `account` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`CardID`) REFERENCES `creditcard` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
