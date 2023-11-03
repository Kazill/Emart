-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 02:00 AM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vartvald`
--

-- --------------------------------------------------------

--
-- Table structure for table `Naudotojas`
--

CREATE TABLE `Naudotojas` (
  `id` int(11) NOT NULL,
  `el_pastas` varchar(255) NOT NULL,
  `vardas` varchar(255) NOT NULL,
  `pavarde` varchar(255) NOT NULL,
  `gimimo_data` date NOT NULL,
  `slaptazodis` varchar(255) NOT NULL,
  `tel_nr` varchar(255) NOT NULL,
  `tipas` int(11) NOT NULL,
  `fk_Adresasid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Naudotojas`
--

INSERT INTO `Naudotojas` (`id`, `el_pastas`, `vardas`, `pavarde`, `gimimo_data`, `slaptazodis`, `tel_nr`, `tipas`, `fk_Adresasid`) VALUES
(1, 'darbas@email.com', 'Juras', 'Jurauskas', '1997-03-11', 'c2acd92812ef99acd3dcdbb746b9a434', '864736164', 2, 9),
(2, 'admin@email.com', 'Antanas', 'Antanaitis', '1993-10-04', 'c2acd92812ef99acd3dcdbb746b9a434', '864936123', 1, 7),
(3, 'vaidas@email.com', 'Vaidas', 'Vaidauskas', '1990-01-16', 'c2acd92812ef99acd3dcdbb746b9a434', '863491643', 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Naudotojas`
--
ALTER TABLE `Naudotojas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Naudotojas`
--
ALTER TABLE `Naudotojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
