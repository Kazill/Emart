-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 09:39 AM
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
-- Database: `isp`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratoriai`
--

CREATE TABLE `administratoriai` (
  `idarbinimo_data` date NOT NULL,
  `Tel_nr` varchar(255) NOT NULL,
  `Alga` double NOT NULL,
  `id_Administratorius` int(11) NOT NULL,
  `fk_Naudotojasid_Naudotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administratoriai`
--

INSERT INTO `administratoriai` (`idarbinimo_data`, `Tel_nr`, `Alga`, `id_Administratorius`, `fk_Naudotojasid_Naudotojas`) VALUES
('2023-12-13', '48448464546', 2000, 3, 9),
('2023-12-12', '516515', 2000, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `adresai`
--

CREATE TABLE `adresai` (
  `Miestas` varchar(255) NOT NULL,
  `Salis` varchar(255) NOT NULL,
  `Pasto_kodas` varchar(255) NOT NULL,
  `Gatve` varchar(255) NOT NULL,
  `Namo_nr` int(11) NOT NULL,
  `id_Adresas` int(11) NOT NULL,
  `fk_Naudotojasid_Naudotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresai`
--

INSERT INTO `adresai` (`Miestas`, `Salis`, `Pasto_kodas`, `Gatve`, `Namo_nr`, `id_Adresas`, `fk_Naudotojasid_Naudotojas`) VALUES
('miestas', 'salis', '456456', 'gatve', 3, 1, 8),
('Kaunas', 'Lietuva', '5646', 'Lokulu', 5, 2, 9),
('Vilniu', 'Lietuva', '5646', 'Lokulu', 5, 4, 11),
('Londonas', 'DB', '5646', 'maj', 5, 5, 12),
('Maskva', 'Rusija', '5646', 'Lokulu', 5, 6, 13),
('Vilnius', 'Lietuva', '5646', 'Lokulu', 5, 7, 14),
('Kaunas', 'Lietuva', '5646', 'Lokulu', 5, 8, 15);

-- --------------------------------------------------------

--
-- Table structure for table `apeliacijos`
--

CREATE TABLE `apeliacijos` (
  `tekstas` varchar(255) NOT NULL,
  `priezastis` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `id_Apeliacija` int(11) NOT NULL,
  `fk_Pardavejasid_Pardavejas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apeliacijos`
--

INSERT INTO `apeliacijos` (`tekstas`, `priezastis`, `data`, `id_Apeliacija`, `fk_Pardavejasid_Pardavejas`) VALUES
('ppppp', 'pr', '2023-12-12', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `komentarai`
--

CREATE TABLE `komentarai` (
  `tekstas` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `laikas` varchar(255) NOT NULL,
  `id_Komentaras` int(11) NOT NULL,
  `fk_Prekeid_Preke` int(11) NOT NULL,
  `fk_Pirkejasid_Pirkejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naudotojai`
--

CREATE TABLE `naudotojai` (
  `Vardas` varchar(255) NOT NULL,
  `Pavarde` varchar(255) NOT NULL,
  `El_pastas` varchar(255) NOT NULL,
  `Slaptazodis` varchar(255) NOT NULL,
  `Ar_blokuotas` tinyint(1) NOT NULL,
  `Naudotojo_lygis` int(11) NOT NULL,
  `id_Naudotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `naudotojai`
--

INSERT INTO `naudotojai` (`Vardas`, `Pavarde`, `El_pastas`, `Slaptazodis`, `Ar_blokuotas`, `Naudotojo_lygis`, `id_Naudotojas`) VALUES
('aaaaaaaaaa', 'aaaaaaaaa', 'nrr@gmail.com', '$2y$10$ndwijoHfAr1smsjaPakrned8yan2nhWpL9A4uYbpwc8y2Dj7AwM.a', 1, 3, 8),
('admin', 'aaaaaaaaa', 'f@gmail.com', '$2y$10$fBpLtSYKuYCFCss1B1kyFeHip4rXzqtnxGlmgsOToz.z8h7.hKwUC', 0, 1, 9),
('naudotojas', 'n', 'naud@gmail.com', '$2y$10$O1RYOmRKzUXZuWwwCJhzwOmfoAj/9lvCBuHP/v.AjmYbxJY2lrh6q', 0, 3, 11),
('administratorius', 'aa', 'ad@gmail.com', '$2y$10$03DXa4Btk7EeBPSlg99n8eoOYwg12vp/A53XD0Y1DFrDQji.Ytrka', 0, 1, 12),
('pardavejas', 'par', 'pr@gmail.com', '$2y$10$SnQ2qUvI3Rc92IPrEi3jduHx3U3tqodTj67MXuf7lzqSKk8PuJtKO', 0, 2, 13),
('nejus', 'netiejus', 'netej@gmail.com', '$2y$10$reyetV3DBABV5aI66DD5nu6mYodHWzO6fA7o8Cilm1R4lIa2uo1va', 0, 3, 14),
('pranas', 'pedantas', 'pr@gmail.com', '$2y$10$2jWII2qXlx9saHuFduNRJuSQ.5dux.UIAMn02ucF.zOmEtra7Tg6q', 0, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `pardavejai`
--

CREATE TABLE `pardavejai` (
  `Ar_patvirtintas` tinyint(1) NOT NULL,
  `patvirtinimo_data` date DEFAULT NULL,
  `Ikeltu_prekiu_skaicius` int(11) NOT NULL,
  `vertinimu_vidurkis` double DEFAULT NULL,
  `id_Pardavejas` int(11) NOT NULL,
  `fk_Naudotojasid_Naudotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pardavejai`
--

INSERT INTO `pardavejai` (`Ar_patvirtintas`, `patvirtinimo_data`, `Ikeltu_prekiu_skaicius`, `vertinimu_vidurkis`, `id_Pardavejas`, `fk_Naudotojasid_Naudotojas`) VALUES
(0, NULL, 0, NULL, 4, 15),
(1, '2023-12-12', 5, 3, 5, 13);

-- --------------------------------------------------------

--
-- Table structure for table `pirkejai`
--

CREATE TABLE `pirkejai` (
  `vertinimu_vidurkis` double DEFAULT NULL,
  `uzsakymu_skaicius` int(11) NOT NULL,
  `komentaru_skaicius` int(11) NOT NULL,
  `id_Pirkejas` int(11) NOT NULL,
  `fk_Naudotojasid_Naudotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pirkejai`
--

INSERT INTO `pirkejai` (`vertinimu_vidurkis`, `uzsakymu_skaicius`, `komentaru_skaicius`, `id_Pirkejas`, `fk_Naudotojasid_Naudotojas`) VALUES
(NULL, 2, 2, 3, 8),
(NULL, 0, 0, 4, 11),
(NULL, 1, 5, 5, 14);

-- --------------------------------------------------------

--
-- Table structure for table `pranesimai`
--

CREATE TABLE `pranesimai` (
  `data` date NOT NULL,
  `gavejas` varchar(255) NOT NULL,
  `priezastis` varchar(255) NOT NULL,
  `tekstas` varchar(255) NOT NULL,
  `id_Pranesimas` int(11) NOT NULL,
  `fk_Administratoriusid_Administratorius` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pranesimai`
--

INSERT INTO `pranesimai` (`data`, `gavejas`, `priezastis`, `tekstas`, `id_Pranesimas`, `fk_Administratoriusid_Administratorius`) VALUES
('2023-12-10', 'cx', 'ssssssss', '', 1, NULL),
('2023-12-10', 'cx', 'ssssssss', 'dddddddddddddd', 2, NULL),
('2023-12-10', 'cx', 'ssssssss', 'sssssssssssssssssssssssssss', 9, NULL),
('2023-12-11', 'cx', 'ssssssss', 'aaaaaaaaaaaaaaaaa', 16, NULL),
('2023-12-11', 'cx', 'ssssssss', 'bhb', 26, NULL),
('2023-12-11', 'cx', 'ssssssss', 'bhb', 27, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prekes`
--

CREATE TABLE `prekes` (
  `pavadinimas` varchar(255) NOT NULL,
  `kaina` double NOT NULL,
  `kategorija` varchar(255) NOT NULL,
  `gamintojas` varchar(255) DEFAULT NULL,
  `ar_paslepta` tinyint(1) NOT NULL,
  `id_Preke` int(11) NOT NULL,
  `fk_Pardavėjasid_Pardavėjas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prekes`
--

INSERT INTO `prekes` (`pavadinimas`, `kaina`, `kategorija`, `gamintojas`, `ar_paslepta`, `id_Preke`, `fk_Pardavėjasid_Pardavėjas`) VALUES
('pav', 20.01, 'kat', 'gam', 1, 3, 5),
('Prailginimo laidas', 5.51, 'laidai', 'utex', 0, 4, 5),
('Lygintuvas', 105.51, 'Namu prietasai', 'utex', 0, 5, 5),
('Krovejas', 5.51, 'laidai', 'utex', 0, 6, 5),
('Siurblys', 50.51, 'prietaisai', 'utex', 0, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymai`
--

CREATE TABLE `uzsakymai` (
  `data` date NOT NULL,
  `uzsakymo_kaina` double NOT NULL,
  `būsena` varchar(255) NOT NULL,
  `pristatymo_budas` varchar(255) NOT NULL,
  `id_Uzsakymas` int(11) NOT NULL,
  `fk_Pirkejasid_Pirkejas` int(11) NOT NULL,
  `fk_Administratoriusid_Administratorius` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymo_prekes`
--

CREATE TABLE `uzsakymo_prekes` (
  `kiekis` int(11) NOT NULL,
  `id_Uzsakymo_prekė` int(11) NOT NULL,
  `fk_Uzsakymasid_Uzsakymas` int(11) NOT NULL,
  `fk_Prekeid_Preke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vertinimai`
--

CREATE TABLE `vertinimai` (
  `Ivertis` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_Vertinimas` int(11) NOT NULL,
  `fk_Pirkejasid_Pirkejas` int(11) DEFAULT NULL,
  `fk_Prekeid_Preke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratoriai`
--
ALTER TABLE `administratoriai`
  ADD PRIMARY KEY (`id_Administratorius`),
  ADD UNIQUE KEY `fk_Naudotojasid_Naudotojas` (`fk_Naudotojasid_Naudotojas`);

--
-- Indexes for table `adresai`
--
ALTER TABLE `adresai`
  ADD PRIMARY KEY (`id_Adresas`),
  ADD KEY `Priklauso` (`fk_Naudotojasid_Naudotojas`);

--
-- Indexes for table `apeliacijos`
--
ALTER TABLE `apeliacijos`
  ADD PRIMARY KEY (`id_Apeliacija`),
  ADD KEY `Daro` (`fk_Pardavejasid_Pardavejas`);

--
-- Indexes for table `komentarai`
--
ALTER TABLE `komentarai`
  ADD PRIMARY KEY (`id_Komentaras`),
  ADD KEY `Gavo` (`fk_Prekeid_Preke`),
  ADD KEY `Paraso` (`fk_Pirkejasid_Pirkejas`);

--
-- Indexes for table `naudotojai`
--
ALTER TABLE `naudotojai`
  ADD PRIMARY KEY (`id_Naudotojas`);

--
-- Indexes for table `pardavejai`
--
ALTER TABLE `pardavejai`
  ADD PRIMARY KEY (`id_Pardavejas`),
  ADD UNIQUE KEY `fk_Naudotojasid_Naudotojas` (`fk_Naudotojasid_Naudotojas`);

--
-- Indexes for table `pirkejai`
--
ALTER TABLE `pirkejai`
  ADD PRIMARY KEY (`id_Pirkejas`),
  ADD UNIQUE KEY `fk_Naudotojasid_Naudotojas` (`fk_Naudotojasid_Naudotojas`);

--
-- Indexes for table `pranesimai`
--
ALTER TABLE `pranesimai`
  ADD PRIMARY KEY (`id_Pranesimas`),
  ADD KEY `Raso` (`fk_Administratoriusid_Administratorius`);

--
-- Indexes for table `prekes`
--
ALTER TABLE `prekes`
  ADD PRIMARY KEY (`id_Preke`),
  ADD KEY `Parduoda` (`fk_Pardavėjasid_Pardavėjas`);

--
-- Indexes for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD PRIMARY KEY (`id_Uzsakymas`),
  ADD KEY `Gauna` (`fk_Pirkejasid_Pirkejas`),
  ADD KEY `Tvarko` (`fk_Administratoriusid_Administratorius`);

--
-- Indexes for table `uzsakymo_prekes`
--
ALTER TABLE `uzsakymo_prekes`
  ADD PRIMARY KEY (`id_Uzsakymo_prekė`),
  ADD KEY `Yra2` (`fk_Uzsakymasid_Uzsakymas`),
  ADD KEY `Yra` (`fk_Prekeid_Preke`);

--
-- Indexes for table `vertinimai`
--
ALTER TABLE `vertinimai`
  ADD PRIMARY KEY (`id_Vertinimas`),
  ADD KEY `Turi` (`fk_Prekeid_Preke`),
  ADD KEY `Duoda` (`fk_Pirkejasid_Pirkejas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratoriai`
--
ALTER TABLE `administratoriai`
  MODIFY `id_Administratorius` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adresai`
--
ALTER TABLE `adresai`
  MODIFY `id_Adresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apeliacijos`
--
ALTER TABLE `apeliacijos`
  MODIFY `id_Apeliacija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentarai`
--
ALTER TABLE `komentarai`
  MODIFY `id_Komentaras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `naudotojai`
--
ALTER TABLE `naudotojai`
  MODIFY `id_Naudotojas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pardavejai`
--
ALTER TABLE `pardavejai`
  MODIFY `id_Pardavejas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pirkejai`
--
ALTER TABLE `pirkejai`
  MODIFY `id_Pirkejas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pranesimai`
--
ALTER TABLE `pranesimai`
  MODIFY `id_Pranesimas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prekes`
--
ALTER TABLE `prekes`
  MODIFY `id_Preke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  MODIFY `id_Uzsakymas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uzsakymo_prekes`
--
ALTER TABLE `uzsakymo_prekes`
  MODIFY `id_Uzsakymo_prekė` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vertinimai`
--
ALTER TABLE `vertinimai`
  MODIFY `id_Vertinimas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administratoriai`
--
ALTER TABLE `administratoriai`
  ADD CONSTRAINT `Gali_buti` FOREIGN KEY (`fk_Naudotojasid_Naudotojas`) REFERENCES `naudotojai` (`id_Naudotojas`);

--
-- Constraints for table `adresai`
--
ALTER TABLE `adresai`
  ADD CONSTRAINT `Priklauso` FOREIGN KEY (`fk_Naudotojasid_Naudotojas`) REFERENCES `naudotojai` (`id_Naudotojas`);

--
-- Constraints for table `apeliacijos`
--
ALTER TABLE `apeliacijos`
  ADD CONSTRAINT `Daro` FOREIGN KEY (`fk_Pardavejasid_Pardavejas`) REFERENCES `pardavejai` (`id_Pardavejas`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `komentarai`
--
ALTER TABLE `komentarai`
  ADD CONSTRAINT `Gavo` FOREIGN KEY (`fk_Prekeid_Preke`) REFERENCES `prekes` (`id_Preke`),
  ADD CONSTRAINT `Paraso` FOREIGN KEY (`fk_Pirkejasid_Pirkejas`) REFERENCES `pirkejai` (`id_Pirkejas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pardavejai`
--
ALTER TABLE `pardavejai`
  ADD CONSTRAINT `Gali_buti2` FOREIGN KEY (`fk_Naudotojasid_Naudotojas`) REFERENCES `naudotojai` (`id_Naudotojas`);

--
-- Constraints for table `pirkejai`
--
ALTER TABLE `pirkejai`
  ADD CONSTRAINT `Gali_buti3` FOREIGN KEY (`fk_Naudotojasid_Naudotojas`) REFERENCES `naudotojai` (`id_Naudotojas`);

--
-- Constraints for table `pranesimai`
--
ALTER TABLE `pranesimai`
  ADD CONSTRAINT `Raso` FOREIGN KEY (`fk_Administratoriusid_Administratorius`) REFERENCES `administratoriai` (`id_Administratorius`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `prekes`
--
ALTER TABLE `prekes`
  ADD CONSTRAINT `Parduoda` FOREIGN KEY (`fk_Pardavėjasid_Pardavėjas`) REFERENCES `pardavejai` (`id_Pardavejas`);

--
-- Constraints for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD CONSTRAINT `Gauna` FOREIGN KEY (`fk_Pirkejasid_Pirkejas`) REFERENCES `pirkejai` (`id_Pirkejas`),
  ADD CONSTRAINT `Tvarko` FOREIGN KEY (`fk_Administratoriusid_Administratorius`) REFERENCES `administratoriai` (`id_Administratorius`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `uzsakymo_prekes`
--
ALTER TABLE `uzsakymo_prekes`
  ADD CONSTRAINT `Yra` FOREIGN KEY (`fk_Prekeid_Preke`) REFERENCES `prekes` (`id_Preke`),
  ADD CONSTRAINT `Yra2` FOREIGN KEY (`fk_Uzsakymasid_Uzsakymas`) REFERENCES `uzsakymai` (`id_Uzsakymas`);

--
-- Constraints for table `vertinimai`
--
ALTER TABLE `vertinimai`
  ADD CONSTRAINT `Duoda` FOREIGN KEY (`fk_Pirkejasid_Pirkejas`) REFERENCES `pirkejai` (`id_Pirkejas`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Turi` FOREIGN KEY (`fk_Prekeid_Preke`) REFERENCES `prekes` (`id_Preke`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
