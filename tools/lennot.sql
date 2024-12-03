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
(67, 'Helsinki', 'Rovaniemi', '2024-05-31', 'Aamu', 'A220-300', '230.00', 20),
(68, 'Rovaniemi', 'Helsinki', '2024-06-01', 'Ilta', 'Q400', '235.00', 15),
(69, 'Oslo', 'Bergen', '2024-06-02', 'Päivä', 'A220-300', '240.00', 10),
(70, 'Bergen', 'Oslo', '2024-06-03', 'Aamu', 'Q400', '245.00', 5),
(71, 'Stockholm', 'Göteborg', '2024-06-04', 'Ilta', 'A220-300', '250.00', 40),
(72, 'Göteborg', 'Stockholm', '2024-06-05', 'Päivä', 'Q400', '255.00', 35),
(73, 'Reykjavik', 'Keflavik', '2024-06-06', 'Aamu', 'A220-300', '260.00', 30),
(74, 'Keflavik', 'Reykjavik', '2024-06-07', 'Ilta', 'Q400', '265.00', 25),
(75, 'Kööpenhamina', 'Billund', '2024-06-08', 'Päivä', 'A220-300', '270.00', 20),
(76, 'Billund', 'Kööpenhamina', '2024-06-09', 'Aamu', 'Q400', '275.00', 15),
(77, 'Oslo', 'Trondheim', '2024-06-10', 'Ilta', 'A220-300', '280.00', 10),
(78, 'Trondheim', 'Oslo', '2024-06-11', 'Päivä', 'Q400', '285.00', 5),
(79, 'Helsinki', 'Oulu', '2024-06-12', 'Aamu', 'A220-300', '290.00', 30),
(80, 'Oulu', 'Helsinki', '2024-06-13', 'Ilta', 'Q400', '295.00', 25),
(81, 'Helsinki', 'Rovaniemi', '2024-06-14', 'Päivä', 'A220-300', '300.00', 20),
(82, 'Rovaniemi', 'Helsinki', '2024-06-15', 'Aamu', 'Q400', '305.00', 15),
(83, 'Oslo', 'Bergen', '2024-06-16', 'Ilta', 'A220-300', '310.00', 10),
(84, 'Bergen', 'Oslo', '2024-06-17', 'Päivä', 'Q400', '315.00', 5),
(85, 'Stockholm', 'Göteborg', '2024-06-18', 'Aamu', 'A220-300', '320.00', 40),
(86, 'Göteborg', 'Stockholm', '2024-06-19', 'Ilta', 'Q400', '325.00', 35),
(87, 'Reykjavik', 'Keflavik', '2024-06-20', 'Päivä', 'A220-300', '330.00', 30),
(88, 'Keflavik', 'Reykjavik', '2024-06-21', 'Aamu', 'Q400', '335.00', 25),
(89, 'Kööpenhamina', 'Billund', '2024-06-22', 'Ilta', 'A220-300', '340.00', 20),
(90, 'Billund', 'Kööpenhamina', '2024-06-23', 'Päivä', 'Q400', '345.00', 15),
(91, 'Oslo', 'Trondheim', '2024-06-24', 'Aamu', 'A220-300', '350.00'),
(92, 'Trondheim', 'Oslo', '2024-06-25', 'Ilta', 'Q400', '355.00', 5),
(93, 'Helsinki', 'Oulu', '2024-06-26', 'Päivä', 'A220-300', '360.00', 30),
(94, 'Oulu', 'Helsinki', '2024-06-27', 'Aamu', 'Q400', '365.00', 25),
(95, 'Helsinki', 'Rovaniemi', '2024-06-28', 'Ilta', 'A220-300', '370.00', 20),
(96, 'Rovaniemi', 'Helsinki', '2024-06-29', 'Päivä', 'Q400', '375.00', 15),
(97, 'Oslo', 'Bergen', '2024-06-30', 'Aamu', 'A220-300', '380.00', 10),
(98, 'Bergen', 'Oslo', '2024-07-01', 'Ilta', 'Q400', '385.00', 5),
(99, 'Stockholm', 'Göteborg', '2024-07-02', 'Päivä', 'A220-300', '390.00', 40),
(100, 'Göteborg', 'Stockholm', '2024-07-03', 'Aamu', 'Q400', '395.00', 35),
(101, 'Reykjavik', 'Keflavik', '2024-07-04', 'Ilta', 'A220-300', '400.00', 30),
(102, 'Keflavik', 'Reykjavik', '2024-07-05', 'Päivä', 'Q400', '405.00', 25),
(103, 'Kööpenhamina', 'Billund', '2024-07-06', 'Aamu', 'A220-300', '410.00', 20),
(104, 'Billund', 'Kööpenhamina', '2024-07-07', 'Ilta', 'Q400', '415.00', 15),
(105, 'Oslo', 'Trondheim', '2024-07-08', 'Päivä', 'A220-300', '420.00', 10),
(106, 'Trondheim', 'Oslo', '2024-07-09', 'Aamu', 'Q400', '425.00', 5),
(107, 'Helsinki', 'Oulu', '2024-07-10', 'Ilta', 'A220-300', '430.00', 30),
(108, 'Oulu', 'Helsinki', '2024-07-11', 'Päivä', 'Q400', '435.00', 25),
(109, 'Helsinki', 'Rovaniemi', '2024-07-12', 'Aamu', 'A220-300', '440.00', 20),
(110, 'Rovaniemi', 'Helsinki', '2024-07-13', 'Ilta', 'Q400', '445.00', 15),
(111, 'Oslo', 'Bergen', '2024-07-14', 'Päivä', 'A220-300', '450.00', 10),
(112, 'Bergen', 'Oslo', '2024-07-15', 'Aamu', 'Q400', '455.00', 5),
(113, 'Stockholm', 'Göteborg', '2024-07-16', 'Ilta', 'A220-300', '460.00', 40),
(114, 'Göteborg', 'Stockholm', '2024-07-17', 'Päivä', 'Q400', '465.00', 35),
(115, 'Reykjavik', 'Keflavik', '2024-07-18', 'Aamu', 'A220-300', '470.00', 30),
(116, 'Keflavik', 'Reykjavik', '2024-07-19', 'Ilta', 'Q400', '475.00', 25),
(117, 'Kööpenhamina', 'Billund', '2024-07-20', 'Päivä', 'A220-300', '480.00', 20),
(118, 'Billund', 'Kööpenhamina', '2024-07-21', 'Aamu', 'Q400', '485.00', 15),
(119, 'Oslo', 'Trondheim', '2024-07-22', 'Ilta', 'A220-300', '490.00', 10),
(120, 'Trondheim', 'Oslo', '2024-07-23', 'Päivä', 'Q400', '495.00', 5),
(121, 'Helsinki', 'Oulu', '2024-07-24', 'Aamu', 'A220-300', '500.00', 30),
(122, 'Oulu', 'Helsinki', '2024-07-25', 'Ilta', 'Q400', '505.00', 25),
(123, 'Helsinki', 'Rovaniemi', '2024-07-26', 'Päivä', 'A220-300', '510.00', 20),
(124, 'Rovaniemi', 'Helsinki', '2024-07-27', 'Aamu', 'Q400', '515.00', 15),
(125, 'Oslo', 'Bergen', '2024-07-28', 'Ilta', 'A220-300', '520.00', 10),
(126, 'Bergen', 'Oslo', '2024-07-29', 'Päivä', 'Q400', '525.00', 5),
(127, 'Stockholm', 'Göteborg', '2024-07-30', 'Aamu', 'A220-300', '530.00', 40),
(128, 'Göteborg', 'Stockholm', '2024-07-31', 'Ilta', 'Q400', '535.00', 35),
(129, 'Reykjavik', 'Keflavik', '2024-08-01', 'Päivä', 'A220-300', '540.00', 30),
(130, 'Keflavik', 'Reykjavik', '2024-08-02', 'Aamu', 'Q400', '545.00', 25),
(131, 'Kööpenhamina', 'Billund', '2024-08-03', 'Ilta', 'A220-300', '550.00', 20),
(132, 'Billund', 'Kööpenhamina', '2024-08-04', 'Päivä', 'Q400', '555.00', 15),
(133, 'Oslo', 'Trondheim', '2024-08-05', 'Aamu', 'A220-300', '560.00', 10),
(134, 'Trondheim', 'Oslo', '2024-08-06', 'Ilta', 'Q400', '565.00', 5),
(135, 'Helsinki', 'Oulu', '2024-08-07', 'Päivä', 'A220-300', '570.00', 30),
(136, 'Oulu', 'Helsinki', '2024-08-08', 'Aamu', 'Q400', '575.00', 25),
(137, 'Helsinki', 'Rovaniemi', '2024-08-09', 'Ilta', 'A220-300', '580.00', 20),
(138, 'Rovaniemi', 'Helsinki', '2024-08-10', 'Päivä', 'Q400', '585.00', 15),
(139, 'Oslo', 'Bergen', '2024-08-11', 'Aamu', 'A220-300', '590.00', 10),
(140, 'Bergen', 'Oslo', '2024-08-12', 'Ilta', 'Q400', '595.00', 5),
(141, 'Stockholm', 'Göteborg', '2024-08-13', 'Päivä', 'A220-300', '600.00', 40),
(142, 'Göteborg', 'Stockholm', '2024-08-14', 'Aamu', 'Q400', '605.00', 35),
(143, 'Reykjavik', 'Keflavik', '2024-08-15', 'Ilta', 'A220-300', '610.00', 30),
(144, 'Keflavik', 'Reykjavik', '2024-08-16', 'Päivä', 'Q400', '615.00', 25),
(145, 'Kööpenhamina', 'Billund', '2024-08-17', 'Aamu', 'A220-300', '620.00', 20),
(146, 'Billund', 'Kööpenhamina', '2024-08-18', 'Ilta', 'Q400', '625.00', 15),
(147, 'Oslo', 'Trondheim', '2024-08-19', 'Päivä', 'A220-300', '630.00', 10),
(148, 'Trondheim', 'Oslo', '2024-08-20', 'Aamu', 'Q400', '635.00', 5),
(149, 'Helsinki', 'Oulu', '2024-08-21', 'Ilta', 'A220-300', '640.00', 30),
(150, 'Oulu', 'Helsinki', '2024-08-22', 'Päivä', 'Q400', '645.00', 25),
(151, 'Helsinki', 'Rovaniemi', '2024-08-23', 'Aamu', 'A220-300', '650.00', 20),
(152, 'Rovaniemi', 'Helsinki', '2024-08-24', 'Ilta', 'Q400', '655.00', 15),
(153, 'Oslo', 'Bergen', '2024-08-25', 'Päivä', 'A220-300', '660.00', 10),
(154, 'Bergen', 'Oslo', '2024-08-26', 'Aamu', 'Q400', '665.00', 5),
(155, 'Stockholm', 'Göteborg', '2024-08-27', 'Ilta', 'A220-300', '670.00', 40),
(156, 'Göteborg', 'Stockholm', '2024-08-28', 'Päivä', 'Q400', '675.00', 35),
(157, 'Reykjavik', 'Keflavik', '2024-08-29', 'Aamu', 'A220-300', '680.00', 30),
(158, 'Keflavik', 'Reykjavik', '2024-08-30', 'Ilta', 'Q400', '685.00', 25),
(159, 'Kööpenhamina', 'Billund', '2024-08-31', 'Päivä', 'A220-300', '690.00', 20),
(160, 'Billund', 'Kööpenhamina', '2024-09-01', 'Aamu', 'Q400', '695.00', 15),
(161, 'Oslo', 'Trondheim', '2024-09-02', 'Ilta', 'A220-300', '700.00', 10),
(162, 'Trondheim', 'Oslo', '2024-09-03', 'Päivä', 'Q400', '705.00', 5),
(163, 'Helsinki', 'Oulu', '2024-09-04', 'Aamu', 'A220-300', '710.00', 30),
(164, 'Oulu', 'Helsinki', '2024-09-05', 'Ilta', 'Q400', '715.00', 25),
(165, 'Helsinki', 'Rovaniemi', '2024-09-06', 'Päivä', 'A220-300', '720.00', 50),
(166, 'Rovaniemi', 'Helsinki', '2024-09-07', 'Aamu', 'Q400', '725.00', 15),
(167, 'Oslo', 'Bergen', '2024-09-08', 'Ilta', 'A220-300', '730.00', 10),
(168, 'Bergen', 'Oslo', '2024-09-09', 'Päivä', 'Q400', '735.00', 5),
(169, 'Stockholm', 'Göteborg', '2024-09-10', 'Aamu', 'A220-300', '740.00', 40),
(170, 'Göteborg', 'Stockholm', '2024-09-11', 'Ilta', 'Q400', '745.00', 35),
(171, 'Reykjavik', 'Keflavik', '2024-09-12', 'Päivä', 'A220-300', '750.00', 30),
(172, 'Keflavik', 'Reykjavik', '2024-09-13', 'Aamu', 'Q400', '755.00', 25),
(173, 'Kööpenhamina', 'Billund', '2024-09-14', 'Ilta', 'A220-300', '760.00', 20),
(174, 'Billund', 'Kööpenhamina', '2024-09-15', 'Päivä', 'Q400', '765.00', 5),
(175, 'Oslo', 'Trondheim', '2024-09-16', 'Aamu', 'A220-300', '770.00', 10),
(176, 'Trondheim', 'Oslo', '2024-09-17', 'Ilta', 'Q400', '775.00', 5),
(177, 'Helsinki', 'Oulu', '2024-09-18', 'Päivä', 'A220-300', '780.00', 30),
(178, 'Oulu', 'Helsinki', '2024-09-19', 'Aamu', 'Q400', '785.00', 25),
(179, 'Helsinki', 'Rovaniemi', '2024-09-20', 'Ilta', 'A220-300', '790.00', 20),
(180, 'Rovaniemi', 'Helsinki', '2024-09-21', 'Päivä', 'Q400', '795.00', 15),
(181, 'Oslo', 'Bergen', '2024-09-22', 'Aamu', 'A220-300', '800.00', 10),
(182, 'Bergen', 'Oslo', '2024-09-23', 'Ilta', 'Q400', '805.00', 5),
(183, 'Stockholm', 'Göteborg', '2024-09-24', 'Päivä', 'A220-300', '810.00', 40),
(184, 'Göteborg', 'Stockholm', '2024-09-25', 'Aamu', 'Q400', '815.00', 35),
(185, 'Reykjavik', 'Keflavik', '2024-09-26', 'Ilta', 'A220-300', '820.00', 30),
(186, 'Keflavik', 'Reykjavik', '2024-09-27', 'Päivä', 'Q400', '825.00', 25),
(187, 'Kööpenhamina', 'Billund', '2024-09-28', 'Aamu', 'A220-300', '830.00', 20),
(188, 'Billund', 'Kööpenhamina', '2024-09-29', 'Ilta', 'Q400', '835.00', 15),
(189, 'Oslo', 'Trondheim', '2024-09-30', 'Päivä', 'A220-300', '840.00', 10),
(190, 'Trondheim', 'Oslo', '2024-10-01', 'Aamu', 'Q400', '845.00', 5),
(191, 'Helsinki', 'Oulu', '2024-10-02', 'Ilta', 'A220-300', '850.00', 30),
(192, 'Oulu', 'Helsinki', '2024-10-03', 'Päivä', 'Q400', '855.00', 25);


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
