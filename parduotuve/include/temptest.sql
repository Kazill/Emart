-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 04:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

DROP TABLE IF EXISTS vertinimai;
DROP TABLE IF EXISTS uzsakymo_prekes;

DROP TABLE IF EXISTS komentarai;
DROP TABLE IF EXISTS prekes;
DROP TABLE IF EXISTS kategorijos;
DROP TABLE IF EXISTS pranesimai;
DROP TABLE IF EXISTS apeliacijos;
DROP TABLE IF EXISTS pardavejai;
DROP TABLE IF EXISTS adresai;
DROP TABLE IF EXISTS uzsakymai;
DROP TABLE IF EXISTS administratoriai;

DROP TABLE IF EXISTS pirkejai;
DROP TABLE IF EXISTS naudotojai;

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
('2023-12-18', '862154637', 0, 5, 16);

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
('Kaunas', 'Lietuva', '5646', 'Lokulu', 5, 8, 15),
('Kaunas', 'Lietuva', '70317', 'Aguonų g.', 6, 9, 16),
('Vilnius', 'Lietuva', '35538', 'Aido g.', 8, 10, 17),
('Marijampolė', 'Lietuva', '53535', 'Akmenės g.', 1, 11, 18),
('Klaipėda', 'Vokietija', '75757', 'Alyvų g.', 15, 12, 19),
('Vilnius', 'Lietuva', '58337', 'Alyvų g.', 20, 13, 20),
('test', 'test', '2422', 'test', 1, 14, 21);

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
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `id` int(11) NOT NULL,
  `kategorijos_pavadinimas` varchar(56) NOT NULL,
  `prekiu_sk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorijos`
--

INSERT INTO `kategorijos` (`id`, `kategorijos_pavadinimas`, `prekiu_sk`) VALUES
(1, 'kita', NULL),
(3, 'kompiuterių priedai', NULL),
(5, 'kompiuteriai', NULL);

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
  `fk_Pirkejasid_Pirkejas` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarai`
--

INSERT INTO `komentarai` (`tekstas`, `data`, `laikas`, `id_Komentaras`, `fk_Prekeid_Preke`, `fk_Pirkejasid_Pirkejas`, `parent_id`) VALUES
('komentaras', '2023-12-14', '16:00', 2, 3, 3, NULL),
('gera preke', '0000-00-00', '15:25', 3, 6, 5, NULL),
('gera preke', '2023-05-12', '15:25', 4, 6, 5, NULL),
('test', '2023-12-18', '19:35:11', 5, 5, 7, NULL),
('Netyčia', '2023-12-18', '19:35:23', 6, 5, 7, 5),
('Gera prekė', '2023-12-18', '19:39:36', 7, 7, 7, NULL);

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
('admin', 'aaaaaaaaa', 'f@gmail.com', '$2y$10$fBpLtSYKuYCFCss1B1kyFeHip4rXzqtnxGlmgsOToz.z8h7.hKwUC', 0, 0, 9),
('naudotojas', 'n', 'naud@gmail.com', '$2y$10$O1RYOmRKzUXZuWwwCJhzwOmfoAj/9lvCBuHP/v.AjmYbxJY2lrh6q', 0, 3, 11),
('administratorius', 'aa', 'rasdsadas@gmail.com', '$2y$10$03DXa4Btk7EeBPSlg99n8eoOYwg12vp/A53XD0Y1DFrDQji.Ytrka', 0, 0, 12),
('pardavejas', 'par', 'pr@gmail.com', '$2y$10$SnQ2qUvI3Rc92IPrEi3jduHx3U3tqodTj67MXuf7lzqSKk8PuJtKO', 0, 2, 13),
('nejus', 'netiejus', 'netej@gmail.com', '$2y$10$reyetV3DBABV5aI66DD5nu6mYodHWzO6fA7o8Cilm1R4lIa2uo1va', 0, 3, 14),
('pranas', 'pedantas', 'pr@gmail.com', '$2y$10$2jWII2qXlx9saHuFduNRJuSQ.5dux.UIAMn02ucF.zOmEtra7Tg6q', 0, 2, 15),
('owner', 'renwo', 'parduotuve.email@gmail.com', '$2y$10$bS7O5FuADJBa5kFPHHY6OuWjOjdx3JRHOaAZLLynajN8dSPkfgpIG', 0, 1, 16),
('matas', 'satam', 'test@gmail.com', '$2y$10$wCIxx.2Vk4kce/P/p/mUoegwbXG/tFYqQnXRfgluiAZf7FiU8jY.m', 0, 2, 17),
('tadas', 'sadat', 'paprastas@gmail.com', '$2y$10$ndGKZXD1.93gICKHnJVJxuUKSiDUwgL2w1El4x2AEIbWpIMnRjoGW', 0, 3, 18),
('ignas', 'sangi', 'Negalima@gmail.com', '$2y$10$rAr0F96OOhZMRVcNATOUr.KKsyRwDJNgnmPJcYdKYE9034uIC/HZG', 0, 2, 19),
('petras', 'sartep', 'Galimas@gmail.com', '$2y$10$a4FogKvZopjR60NuSQWDHOk8kU2sAj5LWLYhv982W7.cO70QrbhhO', 0, 3, 20),
('test', 'test', 'testas@gmail.com', '$2y$10$WShkE8kudjuxOOHnE/jmweHUu5uD7FwKmPQINR6CZatERpCCHY3g.', 0, 0, 21);

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
(1, '2023-12-12', 5, 3, 5, 13),
(0, NULL, 0, NULL, 6, 17),
(1, NULL, 0, NULL, 7, 19);

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
(NULL, 1, 5, 5, 14),
(NULL, 0, 0, 6, 18),
(NULL, 0, 0, 7, 20);

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
('pav', 20.01, 'kat', 'gam', 0, 3, 5),
('Prailginimo laidas', 5.51, 'laidai', 'utex', 1, 4, 5),
('Lygintuvas', 105.51, 'Namu prietasai', 'utex', 0, 5, 5),
('Krovejas', 5.51, 'laidai', 'utex', 0, 6, 5),
('Siurblys', 50.51, 'prietaisai', 'utex', 0, 7, 5),
('testas', 2, '', 'testas', 0, 8, 6),
('testas', 2, 'Kompiuteriai', 'et', 0, 10, 7),
('fsdmfn', 12, 'default', 'fdf', 0, 11, 6),
('fsdmfn', 12, 'default', 'fdf', 0, 12, 6),
('fsdmfn', 12, 'default', 'fdf', 0, 13, 6),
('ksvk', 20, 'default', 'dfnjd', 0, 14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymai`
--

CREATE TABLE `uzsakymai` (
  `data` date NOT NULL,
  `uzsakymo_kaina` double NOT NULL,
  `busena` varchar(255) NOT NULL,
  `pristatymo_budas` varchar(255) NOT NULL,
  `id_Uzsakymas` int(11) NOT NULL,
  `fk_Pirkejasid_Pirkejas` int(11) NOT NULL,
  `fk_Administratoriusid_Administratorius` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzsakymai`
--

INSERT INTO `uzsakymai` (`data`, `uzsakymo_kaina`, `busena`, `pristatymo_budas`, `id_Uzsakymas`, `fk_Pirkejasid_Pirkejas`, `fk_Administratoriusid_Administratorius`) VALUES
('2023-12-04', 203.4, 'Vykdoma', 'Paštomatas', 2, 7, NULL);

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

--
-- Dumping data for table `uzsakymo_prekes`
--

INSERT INTO `uzsakymo_prekes` (`kiekis`, `id_Uzsakymo_prekė`, `fk_Uzsakymasid_Uzsakymas`, `fk_Prekeid_Preke`) VALUES
(2, 3, 2, 8);

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
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_Administratorius` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `adresai`
--
ALTER TABLE `adresai`
  MODIFY `id_Adresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `apeliacijos`
--
ALTER TABLE `apeliacijos`
  MODIFY `id_Apeliacija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentarai`
--
ALTER TABLE `komentarai`
  MODIFY `id_Komentaras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `naudotojai`
--
ALTER TABLE `naudotojai`
  MODIFY `id_Naudotojas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pardavejai`
--
ALTER TABLE `pardavejai`
  MODIFY `id_Pardavejas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pirkejai`
--
ALTER TABLE `pirkejai`
  MODIFY `id_Pirkejas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pranesimai`
--
ALTER TABLE `pranesimai`
  MODIFY `id_Pranesimas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prekes`
--
ALTER TABLE `prekes`
  MODIFY `id_Preke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  MODIFY `id_Uzsakymas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uzsakymo_prekes`
--
ALTER TABLE `uzsakymo_prekes`
  MODIFY `id_Uzsakymo_prekė` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `Paraso` FOREIGN KEY (`fk_Pirkejasid_Pirkejas`) REFERENCES `pirkejai` (`id_Pirkejas`) ON DELETE SET NULL ON UPDATE SET NULL;

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
