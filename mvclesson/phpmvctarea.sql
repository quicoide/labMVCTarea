-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2021 at 05:17 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

/*
Alumno: Enrique Manuel Gorian Lemus
Profesor: Octavio Aguirre Lozano
Materia: Computacion en el servidor Web
Trabajo: Manejo de datos en el servidor e interacción con cliente mediante una aplicación web.
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmvctarea`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `type`, `year`, `manufacturer_id`) VALUES
(1, 'NSX', 'Coupe', 2019, 1),
(2, 'A8', 'Sedan', 2020, 2),
(3, 'M-Series', 'Coupe', 2020, 3),
(4, 'Lucerne', 'Sedan', 2021, 4),
(5, 'XLR', 'Convertible', 2020, 5),
(6, 'Corvette', 'Coupe', 2021, 6),
(7, 'Sebring', 'Convertible', 2020, 7),
(8, 'Leganza', 'Sedan', 2020, 8),
(9, 'Ram 2500', 'Pickup', 2007, 9),
(10, 'Talon', 'Hatchback', 2005, 10),
(11, 'F250', 'Pickup', 1995, 12),
(12, 'Metro LSI', 'Convertible', 2002, 13),
(13, 'Yukon XL Denali', 'Camioneta', 2020, 14),
(14, 'Odyssey', 'Coupe', 2019, 15),
(15, 'H1', 'Sedan', 2013, 16),
(16, 'Azera', 'Sedan', 2007, 17),
(17, 'QX56', 'Camioneta', 2010, 18),
(18, 'Hombre', 'Camioneta', 2010, 19),
(19, 'XK', 'Convertible', 2017, 20),
(20, 'Commander', 'Camioneta', 2018, 21),
(21, 'Amanti', 'Sedan', 2015, 22),
(22, 'Range Rover', 'Camioneta', 2011, 23),
(23, 'SC 430', 'Convertible', 2011, 24),
(24, 'Navigator', 'Camioneta', 2012, 25),
(25, 'CX-7', 'Camioneta', 2013, 26),
(26, 'CLS Class', 'Sedan', 2005, 27),
(27, 'Mariner', 'Camioneta', 2015, 28),
(28, 'Cooper', 'Convertible', 2016, 29),
(29, 'Eclipse', 'Convertible', 2017, 30),
(30, 'Armada', 'Camioneta', 2018, 31),
(31, 'Silhouette', 'Camioneta', 2019, 32),
(32, 'Voyager', 'Camioneta', 2000, 34),
(33, 'Firebird', 'Hatchback', 2001, 35),
(34, '911 Carrera', 'Coupe', 2005, 36),
(35, '9-3', 'Convertible', 2008, 38),
(36, 'Sky', 'Convertible', 2009, 39),
(37, 'tC', 'Sedan', 2010, 40),
(38, 'B9 Tribeca', 'Camioneta', 2011, 42),
(39, 'XL-7', 'Camioneta', 2012, 43),
(40, 'MR2 Spyder', 'Convertible', 2013, 45),
(41, 'Touareg', 'Camioneta', 2015, 46),
(42, 'XC90', 'Camioneta', 2017, 47),
(43, 'CX-5', 'Camioneta', 2019, 26),
(44, 'CX-5', 'Camioneta', 2021, 26),
(45, 'Mazda2', 'Sedan', 2020, 26),
(46, 'Mazda2', 'Hatchback', 2019, 26),
(47, 'Mazda2', 'Sedan', 2018, 26),
(48, 'Mazda3', 'Sedan', 2017, 26),
(49, 'Camry', 'Sedan', 2005, 45),
(50, 'Camry', 'Sedan', 2007, 45),
(51, 'Rav4', 'Camioneta', 2008, 45),
(52, 'Prius', 'Sedan', 2009, 45),
(53, 'Versa', 'Sedan', 2015, 31),
(54, 'Tsuru', 'Sedan', 1990, 31);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL,
  `code` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `code`, `name`) VALUES
(1, 'ACURA', 'Acura'),
(2, 'AUDI', 'Audi'),
(3, 'BMW', 'BMW'),
(4, 'BUICK', 'Buick'),
(5, 'CAD', 'Cadillac'),
(6, 'CHEV', 'Chevrolet'),
(7, 'CHRY', 'Chrysler'),
(8, 'DAEW', 'Daewoo'),
(9, 'DODGE', 'Dodge'),
(10, 'EAGLE', 'Eagle'),
(11, 'FER', 'Ferrari'),
(12, 'FORD', 'Ford'),
(13, 'GEO', 'Geo'),
(14, 'GMC', 'GMC'),
(15, 'HONDA', 'Honda'),
(16, 'AMGEN', 'HUMMER'),
(17, 'HYUND', 'Hyundai'),
(18, 'INFIN', 'Infiniti'),
(19, 'ISU', 'Isuzu'),
(20, 'JAG', 'Jaguar'),
(21, 'JEEP', 'Jeep'),
(22, 'KIA', 'Kia'),
(23, 'ROV', 'Land Rover'),
(24, 'LEXUS', 'Lexus'),
(25, 'LINC', 'Lincoln'),
(26, 'MAZDA', 'Mazda'),
(27, 'MB', 'Mercedes-Benz'),
(28, 'MERC', 'Mercury'),
(29, 'MINI', 'MINI'),
(30, 'MIT', 'Mitsubishi'),
(31, 'NISSAN', 'Nissan'),
(32, 'OLDS', 'Oldsmobile'),
(33, 'PEUG', 'Peugeot'),
(34, 'PLYM', 'Plymouth'),
(35, 'PONT', 'Pontiac'),
(36, 'POR', 'Porsche'),
(37, 'REN', 'Renault'),
(38, 'SAAB', 'Saab'),
(39, 'SATURN', 'Saturn'),
(40, 'SCION', 'Scion'),
(41, 'SMART', 'smart'),
(42, 'SUB', 'Subaru'),
(43, 'SUZUKI', 'Suzuki'),
(44, 'TESLA', 'Tesla'),
(45, 'TOYOTA', 'Toyota'),
(46, 'VOLKS', 'Volkswagen'),
(47, 'VOLVO', 'Volvo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
