-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 11:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolwebpage`
--
CREATE DATABASE IF NOT EXISTS `schoolwebpage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `schoolwebpage`;

-- --------------------------------------------------------

--
-- Table structure for table `admin login`
--

CREATE TABLE `admin login` (
  `AdminLogin_ID` int(11) NOT NULL,
  `epasts` varchar(30) NOT NULL,
  `parole` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin login`
--

INSERT INTO `admin login` (`AdminLogin_ID`, `epasts`, `parole`) VALUES
(4, 'admin@admin.com', '$2y$10$h3BEKd698WLQJBxVA2d7buyDixF0QaK6euT9yYIaTujb3LhxaRLeO');

-- --------------------------------------------------------

--
-- Table structure for table `microsoft api`
--

CREATE TABLE `microsoft api` (
  `MicrosoftAPI_KEY` int(11) NOT NULL,
  `Vards` varchar(50) NOT NULL,
  `Uzvards` varchar(50) NOT NULL,
  `epasts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Microsoft Azure API ';

-- --------------------------------------------------------

--
-- Table structure for table `pieteikums`
--

CREATE TABLE `pieteikums` (
  `ticket_id` int(11) NOT NULL,
  `laiks` date NOT NULL DEFAULT current_timestamp(),
  `iela` enum('Vānes iela','Ventspils iela') NOT NULL DEFAULT 'Ventspils iela',
  `telpa` varchar(20) NOT NULL,
  `status` enum('Neatrisināts','Procesā','Atrisināts','Atrisināts(Parbaudīts)') NOT NULL DEFAULT 'Neatrisināts',
  `problema` text NOT NULL,
  `piezimes` text DEFAULT NULL,
  `nodala` enum('IT','Saimniecības') NOT NULL DEFAULT 'IT',
  `epasts` varchar(50) NOT NULL,
  `vards` varchar(25) NOT NULL,
  `uzvards` varchar(25) NOT NULL,
  `MicrosoftAPI_KEY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pieteikums`
--

INSERT INTO `pieteikums` (`ticket_id`, `laiks`, `iela`, `telpa`, `status`, `problema`, `piezimes`, `nodala`, `epasts`, `vards`, `uzvards`, `MicrosoftAPI_KEY`) VALUES
(90, '2023-06-20', 'Ventspils iela', 'A203', 'Neatrisināts', 'Kvalifikācijas eksamenis', 'Ceru ka nolikšu', 'IT', 'admin@admin.com', 'Daniels', 'Vidopskis', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin login`
--
ALTER TABLE `admin login`
  ADD PRIMARY KEY (`AdminLogin_ID`);

--
-- Indexes for table `microsoft api`
--
ALTER TABLE `microsoft api`
  ADD PRIMARY KEY (`MicrosoftAPI_KEY`);

--
-- Indexes for table `pieteikums`
--
ALTER TABLE `pieteikums`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `MicrosoftAPI_KEY` (`MicrosoftAPI_KEY`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin login`
--
ALTER TABLE `admin login`
  MODIFY `AdminLogin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `microsoft api`
--
ALTER TABLE `microsoft api`
  MODIFY `MicrosoftAPI_KEY` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pieteikums`
--
ALTER TABLE `pieteikums`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pieteikums`
--
ALTER TABLE `pieteikums`
  ADD CONSTRAINT `MicrosoftAPI_FK` FOREIGN KEY (`MicrosoftAPI_KEY`) REFERENCES `microsoft api` (`MicrosoftAPI_KEY`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
