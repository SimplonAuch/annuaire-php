-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2017 at 05:21 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annuairephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartenir`
--

CREATE TABLE `appartenir` (
  `fk_contact` int(11) NOT NULL,
  `fk_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appartenir`
--

INSERT INTO `appartenir` (`fk_contact`, `fk_group`) VALUES
(10, 1),
(10, 3),
(9, 1),
(9, 3),
(9, 2),
(2, 1),
(2, 2),
(1, 1),
(1, 3),
(1, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `entreprise` text NOT NULL,
  `datenaissance` text NOT NULL,
  `rue` text NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` text NOT NULL,
  `telephone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `entreprise`, `datenaissance`, `rue`, `cp`, `ville`, `telephone`) VALUES
(1, 'Chirot', 'Aurélien', 'Simplon', '13/04/1981', '1 rue Darwin', '32000', 'Toulouse', '0677132122'),
(2, 'Chirot', 'Aurélien', 'Simplon', '13/04/1981', '1 rue Darwin', '32000', 'Auch', '0677132122'),
(3, 'Marcel', 'Simon', 'Simplon', '', '1 rue Darwin', '32000', 'Auch', '0677132122'),
(9, 'Marcel', 'Simon', '', '', '1 rue Darwin', '32000', 'Auch', '0677132122'),
(10, 'AAAAAAAAAAA', 'Simon', 'Simplon', '13/04/1981', '1 rue Darwin', '32000', 'Auch', '0677132122');

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`) VALUES
(1, 'aaa'),
(3, 'patate'),
(2, 'simplonAuch1'),
(4, 'tatata');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
