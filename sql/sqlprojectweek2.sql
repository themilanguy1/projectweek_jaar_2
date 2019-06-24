-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 jun 2019 om 12:25
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
  `betaald_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuurregel`
--

CREATE TABLE `factuurregel` (
  `offerte_id` int(11) NOT NULL,
  `factuur_id` int(11) NOT NULL,
  `titel klus` varchar(255) NOT NULL,
  `prijs` double(10,2) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `postcode` varchar(7) NOT NULL,
  `telefoon` varchar(50) NOT NULL,
  `memo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `naam`, `email`, `adres`, `plaats`, `postcode`, `telefoon`, `memo`) VALUES
(1, 'bob boudesteijn', 'bob@hotmail.com', 'veenmos 23', 'rotterdam', '1234 AB', '0627556674', ''),
(2, 'milan gupta', 'milan@gmail.com', 'milanstraat 5', 'schiebroek', '3012 XH', '0612345678', ''),
(3, 'naam', 'email@email.com', 'adres', 'soeinfseoi', '2222XH', '2', '                    '),
(4, 'w', 'themilanguy1@gmail.com', '2', '2', '2222XH', '0612345678', '                    ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `offertes`
--

CREATE TABLE `offertes` (
  `id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `beschrijving klus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `factuurregel`
--
ALTER TABLE `factuurregel`
  ADD PRIMARY KEY (`offerte_id`,`factuur_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `offertes`
--
ALTER TABLE `offertes`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
