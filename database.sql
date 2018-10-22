-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2018 at 02:23 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `dentist`
--

CREATE TABLE `dentist` (
  `idDentist` bigint(20) NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rg` bigint(15) NOT NULL,
  `cpf` bigint(11) NOT NULL,
  `turn` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dentist`
--

INSERT INTO `dentist` (`idDentist`, `fullName`, `birthDate`, `rg`, `cpf`, `turn`, `cro`, `login`, `pass`) VALUES
(21, 'Douglas Souza', '30/9/1998', 123123123, 12312312312, 'Manhã', '123123123', '', ''),
(22, 'Gregory Servindo', '21/10/1895', 123213123, 12312312312, 'Manhã', '123123123', '', ''),
(23, 'Josiscleidson Frederico', '6/6/1966', 666666666, 66666666666, 'Tarde', '666666666', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `idPatient` bigint(20) NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rg` bigint(15) NOT NULL,
  `cpf` bigint(11) NOT NULL,
  `phone` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`idPatient`, `fullName`, `birthDate`, `rg`, `cpf`, `phone`) VALUES
(13, 'Douglas Axel', '30/9/1998', 123123123, 12312312312, 994951111),
(14, 'Ruan Lemos', '28/3/2003', 66666666, 66666666666, 999999999),
(15, 'Rodolfo O Porco', '29/2/2016', 123123123, 12312312312, 696969699);

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `idStuff` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vendor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `qtd` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dueDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`idStuff`, `name`, `vendor`, `qtd`, `type`, `dueDate`) VALUES
(24, 'Bisturi', 'Unimedo', 100, 'Hospitalar', '6/6/2100'),
(25, 'Mesa', 'Cardos Moveis', 30, 'Estrutura', '30/9/2036'),
(26, 'Papel Higienico', 'Mercado', 9999, 'HigiÃªne', '31/12/3000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dentist`
--
ALTER TABLE `dentist`
  ADD PRIMARY KEY (`idDentist`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`idPatient`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`idStuff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dentist`
--
ALTER TABLE `dentist`
  MODIFY `idDentist` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `idPatient` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stuff`
--
ALTER TABLE `stuff`
  MODIFY `idStuff` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
