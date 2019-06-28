-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jun 2019 om 11:27
-- Serverversie: 10.1.29-MariaDB
-- PHP-versie: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sqlprojectweek2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

CREATE TABLE `factuur` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `prijs` decimal(19,2) NOT NULL,
  `status_betaald` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (factuur_id, `datum`, `prijs`, `status_betaald`) VALUES
(1, '2019-06-18', '2001.12', 0),
(2, '2019-06-28', '192.98', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur_regel`
--

CREATE TABLE `factuur_regel` (
  `offerte_id` int(11) NOT NULL,
  `factuur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `factuur_regel`
--

INSERT INTO `factuur_regel` (`offerte_id`, `factuur_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `telefoon` varchar(50) NOT NULL,
  `memo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (klant_id, `naam`, `email`, `adres`, `plaats`, `postcode`, `telefoon`, `memo`) VALUES
(1, 'bob boudesteijn', 'bob@hotmail.com', 'veenmos 23', 'rotterdam', '1234AB', '0627556674', '                    '),
(2, 'milan gupta', 'milan@gmail.com', 'milanstraat 5', 'schiebroek', '3012 X', '0612345678', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `offertes`
--

CREATE TABLE `offertes` (
  `id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `klus_beschrijving` varchar(255) NOT NULL,
  `prijs` decimal(19,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `offertes`
--

INSERT INTO `offertes` (offerte_id, offerte_klant_id, `datum`, `klus_beschrijving`, `prijs`, `status`) VALUES
(1, 1, '2019-06-19', 'aioenfoienf', '1.11', 1),
(2, 1, '2019-06-17', '                    ', '1.00', 0),
(4, 1, '2019-06-03', '12qwqwdawd', '1.00', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (factuur_id);

--
-- Indexen voor tabel `factuur_regel`
--
ALTER TABLE `factuur_regel`
  ADD PRIMARY KEY (`offerte_id`,`factuur_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (klant_id);

--
-- Indexen voor tabel `offertes`
--
ALTER TABLE `offertes`
  ADD PRIMARY KEY (offerte_id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
