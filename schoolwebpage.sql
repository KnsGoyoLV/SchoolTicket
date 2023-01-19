-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 01:00 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `apstiprinajums`
--

CREATE TABLE `apstiprinajums` (
  `apstiprinajums_id` int(11) NOT NULL,
  `apstiprinajums` enum('Apstiprināts','Noliegts') NOT NULL DEFAULT 'Noliegts'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsultacijas`
--

CREATE TABLE `konsultacijas` (
  `konsultacijas_id` int(11) NOT NULL,
  `sakums` date NOT NULL,
  `beigas` date NOT NULL,
  `id_skolotaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pieteikties`
--

CREATE TABLE `pieteikties` (
  `pieteikties_id` int(11) NOT NULL,
  `tema` enum('') NOT NULL,
  `izvele` enum('Mācīties','Labot') NOT NULL,
  `konsultacijas_konsultacijas_id` int(11) NOT NULL,
  `konsultacijas_id_skolotaji` int(11) NOT NULL,
  `apstiprinajums_apstiprinajums_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pieteikums`
--

CREATE TABLE `pieteikums` (
  `ticket_id` int(11) NOT NULL,
  `laiks` date NOT NULL,
  `iela` enum('Vānes iela','Ventspils iela') NOT NULL DEFAULT 'Ventspils iela',
  `telpa` varchar(20) NOT NULL,
  `status` enum('Neatrisināts','Procesā','Atrisināts','Atrisināts(Parbaudīts)') NOT NULL DEFAULT 'Neatrisināts',
  `problema` text NOT NULL,
  `piezimes` text DEFAULT NULL,
  `risinajums_risinajums_id` int(11) NOT NULL,
  `epasts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pieteikums`
--

INSERT INTO `pieteikums` (`ticket_id`, `laiks`, `iela`, `telpa`, `status`, `problema`, `piezimes`, `risinajums_risinajums_id`, `epasts`) VALUES
(0, '2023-01-18', 'Ventspils iela', 'test', 'Neatrisināts', 'test2', 'test3', 1, 'testemail'),
(1, '2023-01-18', 'Vānes iela', 'A-203', 'Atrisināts(Parbaudīts)', 'Aizkeros aiz bezvada interneta', NULL, 1, 'daniels.vidopskis@sk.lvt.lv'),
(2, '2023-01-12', 'Ventspils iela', 'test', 'Neatrisināts', 'test2', 'test3', 1, 'testemail');

-- --------------------------------------------------------

--
-- Table structure for table `problema`
--

CREATE TABLE `problema` (
  `problema_id` int(11) NOT NULL,
  `it_nodala` varchar(45) DEFAULT NULL,
  `saimniecibas_nodala` varchar(45) DEFAULT NULL,
  `pieteikums_ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risinajums`
--

CREATE TABLE `risinajums` (
  `risinajums_id` int(11) NOT NULL,
  `daritajs` varchar(45) NOT NULL,
  `apstiprinats` tinyint(4) DEFAULT 0,
  `piezime` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `risinajums`
--

INSERT INTO `risinajums` (`risinajums_id`, `daritajs`, `apstiprinats`, `piezime`) VALUES
(1, 'Neviens', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skolnieki`
--

CREATE TABLE `skolnieki` (
  `skolnieki_id` int(11) NOT NULL,
  `audzeknis` varchar(45) DEFAULT NULL,
  `vards` varchar(45) DEFAULT NULL,
  `uzvards` varchar(45) DEFAULT NULL,
  `epasts` varchar(45) DEFAULT NULL,
  `kurss` varchar(45) DEFAULT NULL,
  `pieteikties_pieteikties_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skolotaji`
--

CREATE TABLE `skolotaji` (
  `lomas_id` int(11) NOT NULL,
  `loma` enum('IT Admins','Saimniecības Nod. Admins','Skolotājs','Kons. Sar. Admins') NOT NULL DEFAULT 'Skolotājs',
  `vards` varchar(45) DEFAULT NULL,
  `uzvards` varchar(45) DEFAULT NULL,
  `epasts` varchar(45) DEFAULT NULL,
  `problema_problema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apstiprinajums`
--
ALTER TABLE `apstiprinajums`
  ADD PRIMARY KEY (`apstiprinajums_id`);

--
-- Indexes for table `konsultacijas`
--
ALTER TABLE `konsultacijas`
  ADD PRIMARY KEY (`konsultacijas_id`,`id_skolotaji`),
  ADD KEY `fk_konsultacijas_skolotaji_idx` (`id_skolotaji`);

--
-- Indexes for table `pieteikties`
--
ALTER TABLE `pieteikties`
  ADD PRIMARY KEY (`pieteikties_id`,`konsultacijas_konsultacijas_id`,`konsultacijas_id_skolotaji`,`apstiprinajums_apstiprinajums_id`),
  ADD KEY `fk_pieteikties_konsultacijas1_idx` (`konsultacijas_konsultacijas_id`,`konsultacijas_id_skolotaji`),
  ADD KEY `fk_pieteikties_apstiprinajums1_idx` (`apstiprinajums_apstiprinajums_id`);

--
-- Indexes for table `pieteikums`
--
ALTER TABLE `pieteikums`
  ADD PRIMARY KEY (`ticket_id`,`risinajums_risinajums_id`),
  ADD KEY `fk_pieteikums_risinajums1_idx` (`risinajums_risinajums_id`);

--
-- Indexes for table `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`problema_id`,`pieteikums_ticket_id`),
  ADD KEY `fk_problema_pieteikums1_idx` (`pieteikums_ticket_id`);

--
-- Indexes for table `risinajums`
--
ALTER TABLE `risinajums`
  ADD PRIMARY KEY (`risinajums_id`);

--
-- Indexes for table `skolnieki`
--
ALTER TABLE `skolnieki`
  ADD PRIMARY KEY (`skolnieki_id`,`pieteikties_pieteikties_id`),
  ADD KEY `fk_skolnieki_pieteikties1_idx` (`pieteikties_pieteikties_id`);

--
-- Indexes for table `skolotaji`
--
ALTER TABLE `skolotaji`
  ADD PRIMARY KEY (`lomas_id`,`problema_problema_id`),
  ADD KEY `fk_skolotaji_problema1_idx` (`problema_problema_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apstiprinajums`
--
ALTER TABLE `apstiprinajums`
  MODIFY `apstiprinajums_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultacijas`
--
ALTER TABLE `konsultacijas`
  MODIFY `konsultacijas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pieteikties`
--
ALTER TABLE `pieteikties`
  MODIFY `pieteikties_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problema`
--
ALTER TABLE `problema`
  MODIFY `problema_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risinajums`
--
ALTER TABLE `risinajums`
  MODIFY `risinajums_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skolnieki`
--
ALTER TABLE `skolnieki`
  MODIFY `skolnieki_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skolotaji`
--
ALTER TABLE `skolotaji`
  MODIFY `lomas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsultacijas`
--
ALTER TABLE `konsultacijas`
  ADD CONSTRAINT `fk_konsultacijas_skolotaji` FOREIGN KEY (`id_skolotaji`) REFERENCES `skolotaji` (`lomas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pieteikties`
--
ALTER TABLE `pieteikties`
  ADD CONSTRAINT `fk_pieteikties_apstiprinajums1` FOREIGN KEY (`apstiprinajums_apstiprinajums_id`) REFERENCES `apstiprinajums` (`apstiprinajums_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pieteikties_konsultacijas1` FOREIGN KEY (`konsultacijas_konsultacijas_id`,`konsultacijas_id_skolotaji`) REFERENCES `konsultacijas` (`konsultacijas_id`, `id_skolotaji`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pieteikums`
--
ALTER TABLE `pieteikums`
  ADD CONSTRAINT `fk_pieteikums_risinajums1` FOREIGN KEY (`risinajums_risinajums_id`) REFERENCES `risinajums` (`risinajums_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `problema`
--
ALTER TABLE `problema`
  ADD CONSTRAINT `fk_problema_pieteikums1` FOREIGN KEY (`pieteikums_ticket_id`) REFERENCES `pieteikums` (`ticket_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skolnieki`
--
ALTER TABLE `skolnieki`
  ADD CONSTRAINT `fk_skolnieki_pieteikties1` FOREIGN KEY (`pieteikties_pieteikties_id`) REFERENCES `pieteikties` (`pieteikties_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skolotaji`
--
ALTER TABLE `skolotaji`
  ADD CONSTRAINT `fk_skolotaji_problema1` FOREIGN KEY (`problema_problema_id`) REFERENCES `problema` (`problema_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
