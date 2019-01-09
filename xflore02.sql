-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované:: 01.Dec, 2017 - 21:43
-- Verzia serveru: 5.6.33
-- Verzia PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `xflore02`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cats`
--

CREATE TABLE IF NOT EXISTS `cats` (
  `id_cat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_race` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `pattern` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `id_owner` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cat`),
  KEY `id_owner` (`id_owner`),
  KEY `id_race` (`id_race`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Sťahujem dáta pre tabuľku `cats`
--

INSERT INTO `cats` (`id_cat`, `id_race`, `name`, `pattern`, `color`, `id_owner`, `username`, `password`) VALUES
(18, 11, 'reference', 'Solid', 'Red', 9, 'reference', 'reference');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Sťahujem dáta pre tabuľku `items`
--

INSERT INTO `items` (`id_item`, `name`) VALUES
(8, 'Ball of Wool'),
(9, 'Jumpball'),
(10, 'Little Mouse');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `lives`
--

CREATE TABLE IF NOT EXISTS `lives` (
  `id_life` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_started` date NOT NULL,
  `territory_born` int(10) unsigned NOT NULL,
  `date_end` date DEFAULT NULL,
  `territory_died` int(10) unsigned DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `id_cat` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_life`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Sťahujem dáta pre tabuľku `lives`
--

INSERT INTO `lives` (`id_life`, `date_started`, `territory_born`, `date_end`, `territory_died`, `reason`, `id_cat`) VALUES
(63, '2017-11-01', 24, '2017-12-01', 23, 'Killed by other cat', 18),
(64, '2017-12-01', 23, NULL, NULL, NULL, 18);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`id_news`, `content`, `date_created`) VALUES
(22, 'New territory: Bathroom. Capacity: 20', '2017-12-01'),
(23, 'New territory: Toilet. Capacity: 10', '2017-12-01'),
(24, 'New territory: Livingroom. Capacity: 40', '2017-12-01'),
(25, 'New territory: Garden. Capacity: 100', '2017-12-01'),
(26, 'New territory: Hall. Capacity: 30', '2017-12-01'),
(27, 'New Item: Ball of Wool.', '2017-12-01'),
(28, 'New Item: Jumpball.', '2017-12-01'),
(29, 'New Item: Little Mouse.', '2017-12-01'),
(30, 'New owner: Test Owner1. From: Bratislava', '2017-12-01'),
(31, 'New owner: Test Owner2. From: Královo Pole Brno', '2017-12-01');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cat` int(10) unsigned NOT NULL,
  `id_territory` int(10) unsigned NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_territory` (`id_territory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Sťahujem dáta pre tabuľku `occupation`
--

INSERT INTO `occupation` (`id`, `id_cat`, `id_territory`, `date_started`, `date_ended`) VALUES
(53, 18, 20, '2017-12-01', NULL),
(54, 18, 21, '2017-12-01', NULL),
(55, 18, 23, '2017-12-01', '2017-12-01');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `owners`
--

CREATE TABLE IF NOT EXISTS `owners` (
  `id_owner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `age` int(10) unsigned NOT NULL,
  `gender` char(1) NOT NULL,
  `catnickname` varchar(50) NOT NULL,
  `residence` varchar(50) NOT NULL,
  `id_race` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_owner`),
  KEY `id_race` (`id_race`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Sťahujem dáta pre tabuľku `owners`
--

INSERT INTO `owners` (`id_owner`, `name`, `age`, `gender`, `catnickname`, `residence`, `id_race`) VALUES
(9, 'Test Owner1', 25, 'M', 'Kitty', 'Bratislava', 11),
(10, 'Test Owner2', 40, 'F', 'Apples', 'Královo Pole Brno', 15);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cat` int(10) unsigned NOT NULL,
  `id_item` int(10) unsigned NOT NULL,
  `id_territory` int(10) unsigned NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date DEFAULT NULL,
  `leased` tinyint(1) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_item` (`id_item`),
  KEY `id_territory` (`id_territory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Sťahujem dáta pre tabuľku `properties`
--

INSERT INTO `properties` (`id`, `id_cat`, `id_item`, `id_territory`, `date_started`, `date_ended`, `leased`, `count`) VALUES
(74, 18, 8, 21, '2017-12-01', NULL, 0, 1),
(75, 18, 10, 23, '2017-12-01', NULL, 1, 10);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `races`
--

CREATE TABLE IF NOT EXISTS `races` (
  `id_race` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `eyes` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `fangs` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_race`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Sťahujem dáta pre tabuľku `races`
--

INSERT INTO `races` (`id_race`, `name`, `eyes`, `origin`, `fangs`) VALUES
(11, 'Abyssinian', 'Yellow', 'India', 5),
(12, 'Bengal', 'Yellow', 'Norway', 3),
(13, 'Chartreux', 'Brown', 'France', 5),
(14, 'Devon Rex', 'Green', 'England', 2),
(15, 'Egyptian Mau', 'Green', 'Egypt', 5);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `territories`
--

CREATE TABLE IF NOT EXISTS `territories` (
  `id_territory` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `capacity` int(10) unsigned NOT NULL,
  `current_state` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_territory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Sťahujem dáta pre tabuľku `territories`
--

INSERT INTO `territories` (`id_territory`, `name`, `capacity`, `current_state`) VALUES
(20, 'Bathroom', 20, 1),
(21, 'Toilet', 10, 1),
(22, 'Livingroom', 40, 0),
(23, 'Garden', 100, 1),
(24, 'Hall', 30, 0);

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_ibfk_1` FOREIGN KEY (`id_race`) REFERENCES `races` (`id_race`),
  ADD CONSTRAINT `cats_ibfk_2` FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id_owner`);

--
-- Obmedzenie pre tabuľku `lives`
--
ALTER TABLE `lives`
  ADD CONSTRAINT `lives_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `cats` (`id_cat`);

--
-- Obmedzenie pre tabuľku `occupation`
--
ALTER TABLE `occupation`
  ADD CONSTRAINT `occupation_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `cats` (`id_cat`),
  ADD CONSTRAINT `occupation_ibfk_2` FOREIGN KEY (`id_territory`) REFERENCES `territories` (`id_territory`);

--
-- Obmedzenie pre tabuľku `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_ibfk_1` FOREIGN KEY (`id_race`) REFERENCES `races` (`id_race`);

--
-- Obmedzenie pre tabuľku `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `cats` (`id_cat`),
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`),
  ADD CONSTRAINT `properties_ibfk_3` FOREIGN KEY (`id_territory`) REFERENCES `territories` (`id_territory`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
