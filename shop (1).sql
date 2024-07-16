-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2024 at 10:34 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` smallint NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Ordering_View` int NOT NULL,
  `Visibility` tinyint NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering_View`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(1, 'toys', 'this is toys for kids', 1, 0, 0, 0),
(2, 'electronic', '', 2, 0, 1, 0),
(3, 'private', '', 3, 1, 1, 1),
(4, 'Play station', 'play station', 4, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL COMMENT 'To identify user',
  `Username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Username To Login',
  `Password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Password To Login',
  `Email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `FullName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `GroupID` int NOT NULL DEFAULT '0' COMMENT 'identify User Group',
  `TrustStatus` int NOT NULL DEFAULT '0' COMMENT 'Seller Rank',
  `RegStatus` int NOT NULL DEFAULT '0' COMMENT 'User Approval',
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(15, 'amira', '601f1889667efaebb33b8c12572835da3f027f78', 'amira@amira.com', 'amira amira', 1, 0, 1, NULL),
(16, 'Rana', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Rana@gmail.com', 'Rana Muhammed', 0, 0, 1, NULL),
(20, 'sherief', '601f1889667efaebb33b8c12572835da3f027f78', 'sherief@gmail.com', 'sherief ahmed', 0, 0, 1, NULL),
(21, 'majed', '1635135bf5e0c77b55da5cf751a4438fe2a14a78', 'majed@gmail.com', 'majed muhammed', 0, 0, 1, '2024-04-30'),
(24, 'Hashim', 'ce733be1cf0b08775785b796eb59df941896ec44', 'hashim@gmail.com', 'hashim nader', 0, 0, 1, '2024-05-02'),
(25, 'Ayaa', '87ee23cfeb7504b4724e7c0799c01b536db1e935', 'aya@mail.com', 'aya ahmed', 0, 0, 1, '2024-05-07'),
(26, 'samah', '42b962795db504cf9e714b59781cffd9d6563767', 'samah@samah.com', 'samah muhammed', 0, 0, 0, '2024-05-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Username_2` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT COMMENT 'To identify user', AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
