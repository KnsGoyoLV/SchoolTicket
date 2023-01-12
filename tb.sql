-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 12:14 PM
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
-- Database: `problema`
--
CREATE DATABASE IF NOT EXISTS `problema` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `problema`;

-- --------------------------------------------------------

--
-- Table structure for table `lietotajs`
--

CREATE TABLE `lietotajs` (
  `lietotajs_id` int(11) NOT NULL,
  `vards` varchar(45) NOT NULL,
  `uzvards` varchar(55) NOT NULL,
  `epasts` varchar(255) NOT NULL,
  `loma` enum('Skolotājs','Admin','SU','Strādnieki') NOT NULL DEFAULT 'Skolotājs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `laiks` date NOT NULL,
  `iela` enum('Vānes iela','Ventspils iela') NOT NULL DEFAULT 'Vānes iela',
  `klase` varchar(255) NOT NULL,
  `problema` text NOT NULL,
  `piezime` text DEFAULT NULL,
  `apstiprinats` tinyint(1) NOT NULL,
  `status` enum('Nav iesākts','Iesākts','Pabeigts','Pabeigts(pārbaudīts)') DEFAULT 'Nav iesākts'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `laiks`, `iela`, `klase`, `problema`, `piezime`, `apstiprinats`, `status`) VALUES
(1, '2023-01-11', 'Ventspils iela', 'A-216', 'Pazuda internets', NULL, 0, 'Nav iesākts'),
(2, '2023-01-11', 'Vānes iela', 'C-205', 'Griesti iejuka', 'Laukā bija vētra un lietus līdz ar to iebruka griesti', 0, 'Nav iesākts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lietotajs`
--
ALTER TABLE `lietotajs`
  ADD PRIMARY KEY (`lietotajs_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lietotajs`
--
ALTER TABLE `lietotajs`
  MODIFY `lietotajs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
