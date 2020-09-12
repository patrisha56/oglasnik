-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 12:43 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oglasnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `interesi`
--

CREATE TABLE `interesi` (
  `korisnik_id` int(11) NOT NULL,
  `oglas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interesi`
--

INSERT INTO `interesi` (`korisnik_id`, `oglas_id`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(64) NOT NULL,
  `prezime` varchar(64) NOT NULL,
  `oib` varchar(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `kontakt` varchar(16) NOT NULL,
  `korisnicko_ime` varchar(64) NOT NULL,
  `lozinka` varchar(256) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `studij` varchar(128) DEFAULT NULL,
  `godina_studija` int(11) DEFAULT NULL,
  `hobiji` varchar(256) DEFAULT NULL,
  `interesi` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `oib`, `email`, `kontakt`, `korisnicko_ime`, `lozinka`, `datum_rodjenja`, `studij`, `godina_studija`, `hobiji`, `interesi`) VALUES
(1, 'Administrator', 'Account', '11111111111', 'admin@admin.com', '+385991234567', 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', '1980-08-02', NULL, NULL, NULL, NULL),
(2, 'Mliko', 'Ko', '11111111112', 'darko@daric.hm', '0994524314', 'mliko', 'ee11cbb19052e40b07aac0ca060c23ee', '2020-08-05', NULL, NULL, NULL, NULL),
(3, 'Pero', 'Perić', '65525176816', 'pero@peric.com', '0994524314', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '1993-09-08', 'Politehnika', 3, 'Informatika', 'Film');

-- --------------------------------------------------------

--
-- Table structure for table `mjesto`
--

CREATE TABLE `mjesto` (
  `id` int(11) NOT NULL,
  `naziv` varchar(128) NOT NULL,
  `postanski_broj` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mjesto`
--

INSERT INTO `mjesto` (`id`, `naziv`, `postanski_broj`) VALUES
(1, 'Zagreb', '10000'),
(2, 'Rijeka', '51000'),
(3, 'Split', '21000'),
(4, 'Osijek', '31000'),
(5, 'Karlovac', '47000'),
(6, 'Zadar', '23000'),
(7, 'Dubrovnik', '20000'),
(8, 'Šibenik', '22000'),
(9, 'Pula', '52100'),
(10, 'Poreč', '52440');

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

CREATE TABLE `oglas` (
  `id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `mjesto_id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `tip` enum('prodaja','kupovina','najam','cimerstvo') NOT NULL,
  `kvadratura` int(11) NOT NULL,
  `naslov` varchar(128) NOT NULL,
  `detalji` text NOT NULL,
  `cijena` int(11) NOT NULL,
  `slika_url` text NOT NULL,
  `privatni_oglas` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oglas`
--

INSERT INTO `oglas` (`id`, `autor_id`, `mjesto_id`, `datum`, `tip`, `kvadratura`, `naslov`, `detalji`, `cijena`, `slika_url`, `privatni_oglas`) VALUES
(2, 1, 2, '2020-08-24 00:00:00', 'kupovina', 45, 'Stan u Rijeci', 'Tražim stan u Rijeci', 80000, 'uploads/oglas/greece-4405371.jpg', 0),
(3, 1, 9, '2020-08-24 00:00:00', 'najam', 56, 'Stan u Puli', 'Tražim stan za najam u Puli', 200, 'uploads/oglas/iolap.png', 0),
(4, 1, 1, '2020-08-25 00:00:00', 'prodaja', 345, 'Stan u Rijeci', 'Detalji', 23422, 'uploads/oglas/greece-4405371.jpg', 0),
(5, 3, 5, '2020-08-26 00:00:00', 'cimerstvo', 78, 'Stan u Karlovcu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1200, 'uploads/oglas/lisbon-4401269.jpg', 0),
(6, 3, 7, '2020-08-26 21:27:34', 'prodaja', 400, 'Stan u Duborniku', 'Suspendisse mollis mattis mi. Vestibulum ut consectetur ligula, eget volutpat sapien. Etiam dignissim nibh ipsum, a auctor sapien sollicitudin id. Etiam luctus velit id pulvinar ornare. Praesent ornare porttitor justo, quis placerat lacus egestas vitae. Maecenas sollicitudin elementum enim, et vulputate sem rutrum dapibus. Donec efficitur quis magna sed placerat. Donec placerat, sapien eu venenatis placerat, nulla odio lobortis leo, quis commodo nibh magna quis odio. Vivamus sed tortor ipsum. Donec ultricies egestas lobortis. Aliquam erat volutpat. ', 400000, 'uploads/oglas/Why-to-wear-a-tie-on-graduation-day (2).jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recenzije`
--

CREATE TABLE `recenzije` (
  `autor_id` int(11) NOT NULL,
  `subjekt_id` int(11) NOT NULL,
  `ocjena` enum('1','2','3','4','5') NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recenzije`
--

INSERT INTO `recenzije` (`autor_id`, `subjekt_id`, `ocjena`, `komentar`) VALUES
(2, 1, '5', 'Svaka čast'),
(3, 1, '5', 'Dobar'),
(3, 1, '4', 'Da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `interesi`
--
ALTER TABLE `interesi`
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `oglas_id` (`oglas_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mjesto`
--
ALTER TABLE `mjesto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oglas`
--
ALTER TABLE `oglas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `mjesto_id` (`mjesto_id`);

--
-- Indexes for table `recenzije`
--
ALTER TABLE `recenzije`
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `subjekt_id` (`subjekt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mjesto`
--
ALTER TABLE `mjesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oglas`
--
ALTER TABLE `oglas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interesi`
--
ALTER TABLE `interesi`
  ADD CONSTRAINT `interesi_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interesi_ibfk_2` FOREIGN KEY (`oglas_id`) REFERENCES `oglas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oglas`
--
ALTER TABLE `oglas`
  ADD CONSTRAINT `oglas_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oglas_ibfk_2` FOREIGN KEY (`mjesto_id`) REFERENCES `mjesto` (`id`);

--
-- Constraints for table `recenzije`
--
ALTER TABLE `recenzije`
  ADD CONSTRAINT `recenzije_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recenzije_ibfk_2` FOREIGN KEY (`subjekt_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
