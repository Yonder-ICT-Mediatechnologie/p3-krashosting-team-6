-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 27 mrt 2025 om 11:35
-- Serverversie: 5.7.24
-- PHP-versie: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krashosting`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `pakket_id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `besteld_op` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nieuws`
--

CREATE TABLE `nieuws` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `datum` date NOT NULL,
  `status` enum('concept','gepubliceerd') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pakketten`
--

CREATE TABLE `pakketten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `voordelen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pakketten`
--

INSERT INTO `pakketten` (`id`, `naam`, `prijs`, `voordelen`) VALUES
(1, 'Easy', '5.99', 'Snelle hosting, 24/7 support, Gratis SSL, 1GB opslag, 1 MySQL database'),
(2, 'Functionals', '9.99', 'Snelle hosting, 24/7 support, Gratis SSL, 5GB opslag, 5 MySQL databases'),
(3, 'Pro', '14.99', 'Snelle hosting, 24/7 support, Gratis SSL, 10GB opslag, Onbeperkte MySQL databases'),
(4, 'Heavy User', '19.99', 'Snelle hosting, 24/7 support, Gratis SSL, 50GB opslag, Onbeperkte MySQL databases');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pakket_id` (`pakket_id`);

--
-- Indexen voor tabel `nieuws`
--
ALTER TABLE `nieuws`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `pakketten`
--
ALTER TABLE `pakketten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `nieuws`
--
ALTER TABLE `nieuws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `pakketten`
--
ALTER TABLE `pakketten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`pakket_id`) REFERENCES `pakketten` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
