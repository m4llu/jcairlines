-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: 07.04.2021 klo 10:07
-- Server Version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `lennot`
-- --------------------------------------------------------

-- Table structure for table `lennot`

CREATE TABLE `lennot` (
  `LentoID` int(11) NOT NULL AUTO_INCREMENT,
  `LähtöKaupunki` varchar(255) NOT NULL,  -- From city
  `KohdeKaupunki` varchar(255) NOT NULL,  -- To city
  `LentoPäivämäärä` date NOT NULL,        -- Flight Date
  `Aikaväli` varchar(255) NOT NULL,       -- Time of Day
  `Kone` varchar(20) NOT NULL,            -- Aircraft
  `LipunHinta` decimal(10,2) NOT NULL,    -- Ticket Price
  `VapaatPaikat` int(11) NOT NULL,        -- Available Seats
  PRIMARY KEY (`LentoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table `lennot`

INSERT INTO `lennot` (`LentoID`, `LähtöKaupunki`, `KohdeKaupunki`, `LentoPäivämäärä`, `Aikaväli`, `Kone`, `LipunHinta`, `VapaatPaikat`) VALUES
(1, 'Oulu', 'Helsinki', '2024-01-10', 'Aamu', 'Q400', '65.50', 6),
(2, 'Oulu', 'Helsinki', '2024-01-10', 'Ilta', 'Q400', '65.75', 15),
(3, 'Helsinki', 'Rovaniemi', '2024-01-12', 'Päivä', 'A220-300', '74.55', 50),
(4, 'Rovaniemi', 'Oulu', '2024-01-15', 'Päivä', 'Q400', '78.94', 3),
(5, 'Oslo', 'Bergen', '2024-01-10', 'Aamu', 'Q400', '125.45', 40),
(6, 'Oslo', 'Bergen', '2024-01-10', 'Aamu', 'A220-300', '132.53', 14),
(7, 'Bergen', 'Oslo', '2024-01-11', 'Päivä', 'Q400', '86.45', 23),
(8, 'Bergen', 'Oslo', '2024-01-13', 'Aamu', 'Q400', '75.88', 3),
(9, 'Stockholm', 'Arlanda', '2024-01-14', 'Päivä', 'Q400', '98.12', 200),
(10, 'Stockholm', 'Arlanda', '2024-01-16', 'Aamu', 'Q400', '99.49', 12),
(11, 'Stockholm', 'Arlanda', '2024-01-18', 'Päivä', 'A220-300', '102.24', 50),
(12, 'Helsinki', 'Rovaniemi', '2024-01-20', 'Päivä', 'Q400', '78.50', 60),
(13, 'Helsinki', 'Rovaniemi', '2024-01-25', 'Päivä', 'Q400', '88.34', 16),
(14, 'Helsinki', 'Rovaniemi', '2024-02-01', 'Päivä', 'A220-300', '87.32', 5),
(15, 'Oslo', 'Bergen', '2024-02-10', 'Päivä', 'A220-100', '199.93', 7),
(16, 'Oslo', 'Bergen', '2024-02-12', 'Ilta', 'A220-300', '213.05', 8),
(17, 'Helsinki', 'Oulu', '2024-02-14', 'Aamu', 'Q400', '81.20', 16),
(18, 'Helsinki', 'Oulu', '2024-02-16', 'Aamu', 'A220-100', '99.00', 20),
(19, 'Oulu', 'Helsinki', '2024-02-20', 'Päivä', 'A220-100', '234.40', 7),
(20, 'Bergen', 'Oslo', '2024-02-25', 'Ilta', 'A220-100', '134.90', 30),
(21, 'Bergen', 'Oslo', '2024-03-01', 'Päivä', 'A220-300', '144.10', 8),
(22, 'Stockholm', 'Göteborg', '2024-03-05', 'Ilta', 'A220-300', '55.00', 34),
(23, 'Stockholm', 'Göteborg', '2024-03-10', 'Aamu', 'A220-300', '61.00', 12),
(24, 'Reykjavik', 'Keflavik', '2024-03-15', 'Ilta', 'A220-300', '63.00', 15),
(25, 'Stockholm', 'Malmö', '2024-03-20', 'Ilta', 'Q400', '75.00', 32),
(26, 'Stockholm', 'Malmö', '2024-03-25', 'Aamu', 'A220-300', '82.00', 12),
(27, 'Oslo', 'Trondheim', '2024-04-01', 'Ilta', 'A220-300', '81.00', 16),
(28, 'Kööpenhamina', 'Kööpenhamina', '2024-04-03', 'Ilta', 'A220-300', '91.00', 3),
(29, 'Stockholm', 'Göteborg', '2024-04-07', 'Ilta', 'A220-300', '55.00', 34),
(30, 'Kööpenhamina', 'Billund', '2024-04-10', 'Ilta', 'A220-300', '61.00', 12),
(31, 'Reykjavik', 'Keflavik', '2024-04-12', 'Ilta', 'A220-300', '63.00', 11),
(32, 'Kööpenhamina', 'Billund', '2024-04-15', 'Aamu', 'Q400', '75.00', 32),
(33, 'Kööpenhamina', 'Kööpenhamina', '2024-04-18', 'Ilta', 'A220-300', '82.00', 12),
(34, 'Oslo', 'Trondheim', '2024-04-20', 'Ilta', 'A220-300', '81.00', 16),
(35, 'Kööpenhamina', 'Kööpenhamina', '2024-04-25', 'Ilta', 'A220-300', '91.00', 33),
(36, 'Helsinki', 'Rovaniemi', '2024-04-30', 'Päivä', 'Q400', '78.50', 60),
(37, 'Helsinki', 'Oulu', '2024-05-01', 'Aamu', 'Q400', '80.00', 20),
(38, 'Oulu', 'Helsinki', '2024-05-02', 'Ilta', 'Q400', '85.00', 15),
(39, 'Helsinki', 'Rovaniemi', '2024-05-03', 'Päivä', 'A220-300', '90.00', 50),
(40, 'Rovaniemi', 'Helsinki', '2024-05-04', 'Aamu', 'Q400', '95.00', 10),
(41, 'Oslo', 'Bergen', '2024-05-05', 'Ilta', 'A220-300', '100.00', 30),
(42, 'Bergen', 'Oslo', '2024-05-06', 'Päivä', 'Q400', '105.00', 25),
(43, 'Stockholm', 'Göteborg', '2024-05-07', 'Aamu', 'A220-300', '110.00', 40),
(44, 'Göteborg', 'Stockholm', '2024-05-08', 'Ilta', 'Q400', '115.00', 35),
(45, 'Reykjavik', 'Keflavik', '2024-05-09', 'Päivä', 'A220-300', '120.00', 20),
(46, 'Keflavik', 'Reykjavik', '2024-05-10', 'Aamu', 'Q400', '125.00', 15),
(47, 'Kööpenhamina', 'Billund', '2024-05-11', 'Ilta', 'A220-300', '130.00', 10),
(48, 'Billund', 'Kööpenhamina', '2024-05-12', 'Päivä', 'Q400', '135.00', 5),
(49, 'Oslo', 'Trondheim', '2024-05-13', 'Aamu', 'A220-300', '140.00', 25),
(50, 'Trondheim', 'Oslo', '2024-05-14', 'Ilta', 'Q400', '145.00', 20),
(51, 'Helsinki', 'Oulu', '2024-05-15', 'Päivä', 'A220-300', '150.00', 30),
(52, 'Oulu', 'Helsinki', '2024-05-16', 'Aamu', 'Q400', '155.00', 25),
(53, 'Helsinki', 'Rovaniemi', '2024-05-17', 'Ilta', 'A220-300', '160.00', 20),
(54, 'Rovaniemi', 'Helsinki', '2024-05-18', 'Päivä', 'Q400', '165.00', 15),
(55, 'Oslo', 'Bergen', '2024-05-19', 'Aamu', 'A220-300', '170.00', 10),
(56, 'Bergen', 'Oslo', '2024-05-20', 'Ilta', 'Q400', '175.00', 5),
(57, 'Stockholm', 'Göteborg', '2024-05-21', 'Päivä', 'A220-300', '180.00', 40),
(58, 'Göteborg', 'Stockholm', '2024-05-22', 'Aamu', 'Q400', '185.00', 35),
(59, 'Reykjavik', 'Keflavik', '2024-05-23', 'Ilta', 'A220-300', '190.00', 30),
(60, 'Keflavik', 'Reykjavik', '2024-05-24', 'Päivä', 'Q400', '195.00', 25),
(61, 'Kööpenhamina', 'Billund', '2024-05-25', 'Aamu', 'A220-300', '200.00', 20),
(62, 'Billund', 'Kööpenhamina', '2024-05-26', 'Ilta', 'Q400', '205.00', 15),
(63, 'Oslo', 'Trondheim', '2024-05-27', 'Päivä', 'A220-300', '210.00', 10),
(64, 'Trondheim', 'Oslo', '2024-05-28', 'Aamu', 'Q400', '215.00', 5),
(65, 'Helsinki', 'Oulu', '2024-05-29', 'Ilta', 'A220-300', '220.00', 30),
(66, 'Oulu', 'Helsinki', '2024-05-30', 'Päivä', 'Q400', '225.00', 25),
(67, 'Helsinki', 'Rovaniemi', '2024-05-31', 'Aamu', 'A220-300', '230.00', 20);


-- Indexes for dumped tables

-- Indexes for table `lennot`
ALTER TABLE `lennot`
  ADD PRIMARY KEY (`LentoID`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `lennot`
ALTER TABLE `lennot`
  MODIFY `LentoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
