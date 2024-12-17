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
  `Lähtöaika` TIME NOT NULL,             -- Clock Time of the Flight (e.g., 10:30:00)
  PRIMARY KEY (`LentoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table `lennot` (with added Kellonaika column)

INSERT INTO `lennot` (`LentoID`, `LähtöKaupunki`, `KohdeKaupunki`, `LentoPäivämäärä`, `Aikaväli`, `Kone`, `LipunHinta`, `VapaatPaikat`, `Lähtöaika`) VALUES
(1, 'Oulu', 'Helsinki', '2024-01-10', 'Aamu', 'Q400', '65.50', 6, '08:00:00'),
(2, 'Oulu', 'Helsinki', '2024-01-10', 'Ilta', 'Q400', '65.75', 15, '18:30:00'),
(3, 'Helsinki', 'Rovaniemi', '2024-01-12', 'Päivä', 'A220-300', '74.55', 50, '12:00:00'),
(4, 'Rovaniemi', 'Oulu', '2024-01-15', 'Päivä', 'Q400', '78.94', 3, '14:30:00'),
(5, 'Oslo', 'Bergen', '2024-01-10', 'Aamu', 'Q400', '125.45', 40, '06:45:00'),
(6, 'Oslo', 'Bergen', '2024-01-10', 'Aamu', 'A220-300', '132.53', 14, '07:30:00'),
(7, 'Bergen', 'Oslo', '2024-01-11', 'Päivä', 'Q400', '86.45', 23, '11:00:00'),
(8, 'Bergen', 'Oslo', '2024-01-13', 'Aamu', 'Q400', '75.88', 3, '07:15:00'),
(9, 'Stockholm', 'Arlanda', '2024-01-14', 'Päivä', 'Q400', '98.12', 200, '13:30:00'),
(10, 'Stockholm', 'Arlanda', '2024-01-16', 'Aamu', 'Q400', '99.49', 12, '09:00:00');

-- Indexes for dumped tables

-- Indexes for table `lennot`
ALTER TABLE `lennot`
  ADD PRIMARY KEY (`LentoID`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `lennot`
ALTER TABLE `lennot`
  MODIFY `LentoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
