-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 14 dec 2021 om 08:41
-- Serverversie: 8.0.27-0ubuntu0.20.04.1
-- PHP-versie: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `and_action`
--
CREATE DATABASE IF NOT EXISTS `and_action` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `and_action`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  `kwaliteit` varchar(10) NOT NULL,
  `beschrijving` text NOT NULL,
  `bedrag` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `abonnement`
--

INSERT INTO `abonnement` (`id`, `naam`, `kwaliteit`, `beschrijving`, `bedrag`) VALUES
(1, 'Standard', '720', 'Standard quality, 720P', 20),
(2, 'Premium', '4000', 'Premium quality, 4k', 50),
(3, 'Director', '4000', 'Director subscription', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `commentaar`
--

CREATE TABLE IF NOT EXISTS `commentaar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `film_id` int NOT NULL,
  `gebruiker_id` int NOT NULL,
  `bericht` text NOT NULL,
  `tijdsstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `film_id` (`film_id`),
  KEY `gebruiker_id` (`gebruiker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gebruiker_id` int NOT NULL,
  `titel` varchar(60) NOT NULL,
  `pad` varchar(250) NOT NULL,
  `thumbnail_pad` varchar(250) NOT NULL,
  `geaccepteerd` tinyint(1) NOT NULL,
  `beschrijving` text NOT NULL,
  `kijkwijzer_leeftijd` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gebruiker_id` (`gebruiker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `film_kijkwijzer_geschiktheid`
--

CREATE TABLE IF NOT EXISTS `film_kijkwijzer_geschiktheid` (
  `kijkwijzer_geschiktheid_id` int NOT NULL,
  `film_id` int NOT NULL,
  PRIMARY KEY (`kijkwijzer_geschiktheid_id`,`film_id`),
  KEY `kijkwijzer_geschiktheid_id` (`kijkwijzer_geschiktheid_id`,`film_id`),
  KEY `film_id` (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE IF NOT EXISTS `gebruiker` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `abonnement_id` int NOT NULL,
  `geverifieerd` tinyint(1) NOT NULL,
  `ingelogd` tinyint(1) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `abonnement_eind` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_mail` (`email`),
  KEY `rol_id` (`rol_id`),
  KEY `abonnement_id` (`abonnement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`id`, `rol_id`, `abonnement_id`, `geverifieerd`, `ingelogd`, `gebruikersnaam`, `wachtwoord`, `email`, `abonnement_eind`) VALUES
(1, 1, 1, 1, 0, 'test', '$2y$17$mnbKoUsrQfz7W14CRrnEj.FW1pLWL53wKjuX4jiFKHWVGehUOG7aK', 'test@email.nl', NULL),
(2, 2, 2, 1, 0, 'test2', '$2y$17$nhNIeCrqWk9D3OEj9jqGMOdZjWwGVVIvIggicsN83fzi32Uqrl24i', 'test2@email.nl', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(60) NOT NULL,
  `beschrijving` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `genre`
--

INSERT INTO `genre` (`id`, `naam`, `beschrijving`) VALUES
(1, 'Horror', 'Horror genre'),
(2, 'Comedy', 'Comedy genre'),
(3, 'Fantasy', 'Fantasy Genre'),
(5, 'Western', 'Western genre'),
(6, 'Action', 'Action genre'),
(7, 'Drama', 'Drama genre'),
(8, 'Documentary', 'Documentary genre'),
(9, 'Mystery', 'Mystery genre'),
(10, 'Romance', 'Romance genre'),
(11, 'Thriller', 'Thriller genre'),
(12, 'Other', 'Other genre, this describes a movie that doesnt fit in any other genre'),
(13, 'sci-fi', 'sci-fi genre');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genre_film`
--

CREATE TABLE IF NOT EXISTS `genre_film` (
  `genre_id` int NOT NULL,
  `film_id` int NOT NULL,
  PRIMARY KEY (`genre_id`,`film_id`),
  KEY `genre_id` (`genre_id`,`film_id`),
  KEY `film_id` (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kijkwijzer_geschiktheid`
--

CREATE TABLE IF NOT EXISTS `kijkwijzer_geschiktheid` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(60) NOT NULL,
  `beschrijving` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `kijkwijzer_geschiktheid`
--

INSERT INTO `kijkwijzer_geschiktheid` (`id`, `naam`, `beschrijving`) VALUES
(1, 'Violence', 'There is violence in the movie'),
(2, 'Sex', 'Sexual scenes are shown during the movie'),
(3, 'Discrimination', 'People are discriminated within this movie'),
(4, 'Fear', 'There are some frightening moments in this movie'),
(5, 'Drugs and/ or alcohol', 'Drugs and/or alcohol scenes are shown in this movie'),
(6, 'Foul language', 'There is foul language included within the scenes of this movie');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `laatst_bekeken`
--

CREATE TABLE IF NOT EXISTS `laatst_bekeken` (
  `film_id` int NOT NULL,
  `gebruiker_id` int NOT NULL,
  `tijdsstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`film_id`,`gebruiker_id`),
  KEY `film_id` (`film_id`,`gebruiker_id`),
  KEY `gebruiker_id` (`gebruiker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  `beschrijving` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rol`
--

INSERT INTO `rol` (`id`, `naam`, `beschrijving`) VALUES
(1, 'Director ', 'This role is meant for directors and actors'),
(2, 'Admin', 'This role is meant for admin users'),
(3, 'Watcher', 'This role is meant for every user that is trying to normally watch a movie');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `thumb_up`
--

CREATE TABLE IF NOT EXISTS `thumb_up` (
  `gebruiker_id` int NOT NULL,
  `film_id` int NOT NULL,
  PRIMARY KEY (`gebruiker_id`,`film_id`),
  KEY `gebruiker_id` (`gebruiker_id`,`film_id`),
  KEY `film_id` (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `commentaar`
--
ALTER TABLE `commentaar`
  ADD CONSTRAINT `commentaar_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`),
  ADD CONSTRAINT `commentaar_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`);

--
-- Beperkingen voor tabel `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`);

--
-- Beperkingen voor tabel `film_kijkwijzer_geschiktheid`
--
ALTER TABLE `film_kijkwijzer_geschiktheid`
  ADD CONSTRAINT `film_kijkwijzer_geschiktheid_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `film_kijkwijzer_geschiktheid_ibfk_2` FOREIGN KEY (`kijkwijzer_geschiktheid_id`) REFERENCES `kijkwijzer_geschiktheid` (`id`);

--
-- Beperkingen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD CONSTRAINT `gebruiker_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gebruiker_ibfk_2` FOREIGN KEY (`abonnement_id`) REFERENCES `abonnement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `genre_film`
--
ALTER TABLE `genre_film`
  ADD CONSTRAINT `genre_film_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `genre_film_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Beperkingen voor tabel `laatst_bekeken`
--
ALTER TABLE `laatst_bekeken`
  ADD CONSTRAINT `laatst_bekeken_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `laatst_bekeken_ibfk_2` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`);

--
-- Beperkingen voor tabel `thumb_up`
--
ALTER TABLE `thumb_up`
  ADD CONSTRAINT `thumb_up_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`),
  ADD CONSTRAINT `thumb_up_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
