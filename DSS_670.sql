-- DSS_670 example dataset
-- Copyright (c) 2011–2025 Henriette Roued
-- Software environment (DSS prototype) licensed under AGPL-3.0-or-later.
-- Dataset in this SQL file released under CC0 1.0 Universal (public domain dedication).
-- See https://creativecommons.org/publicdomain/zero/1.0/
--
-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2011 at 01:46 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DSS_670`
--

-- --------------------------------------------------------

--
-- Table structure for table `DSS_arguments`
--

CREATE TABLE IF NOT EXISTS `DSS_arguments` (
  `ID` int(5) NOT NULL auto_increment,
  `text` varchar(500) collate utf8_unicode_ci NOT NULL,
  `boolean` tinyint(1) NOT NULL,
  `type` varchar(10) collate utf8_unicode_ci NOT NULL,
  `typeID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `DSS_arguments`
--

INSERT INTO `DSS_arguments` (`ID`, `text`, `boolean`, `type`, `typeID`) VALUES
(24, 'The p of procur[a]torem lacks the loop which is found elsewhere in p in this hand.', 0, 'letter', 150),
(25, 'Most likely reading', 1, 'letter', 224),
(26, 'First stroke of the apparent u is really a decender from a letter in the (lost) line above.', 0, 'letter', 224),
(27, 'A reference to cognati patris would make good sense with procurator in a private legal capacity.', 1, 'letter', 223),
(28, 'We have no suggestions for this.', 0, 'letter', 224),
(29, 'cognit is a likely reading', 1, 'letter', 225),
(30, 'cognat is a likely reading', 1, 'letter', 223),
(31, 'm[ei is a possiblility and would fit in the space.', 1, 'letter', 226),
(32, 'We have considered n[ostri, ut there would not be room to fit it all on this line and the trace before dile=igenter in line 8 does not look like i.', 0, 'letter', 227);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_characters`
--

CREATE TABLE IF NOT EXISTS `DSS_characters` (
  `ID` int(5) NOT NULL auto_increment,
  `wordID` int(5) NOT NULL,
  `afterID` int(5) NOT NULL,
  `beforeID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=182 ;

--
-- Dumping data for table `DSS_characters`
--

INSERT INTO `DSS_characters` (`ID`, `wordID`, `afterID`, `beforeID`) VALUES
(1, 1, 0, 2),
(2, 1, 1, 3),
(3, 1, 2, 4),
(4, 1, 3, 5),
(5, 1, 4, 6),
(6, 1, 5, 7),
(7, 1, 6, 0),
(8, 2, 0, 9),
(9, 2, 8, 10),
(10, 2, 9, 11),
(11, 2, 10, 12),
(12, 2, 11, 13),
(13, 2, 12, 14),
(14, 2, 13, 0),
(15, 3, 0, 16),
(16, 3, 15, 17),
(17, 3, 16, 18),
(18, 3, 17, 19),
(19, 3, 18, 20),
(20, 3, 19, 0),
(36, 4, 0, 35),
(35, 4, 36, 34),
(34, 4, 35, 33),
(33, 4, 34, 32),
(32, 4, 33, 31),
(31, 4, 32, 30),
(30, 4, 31, 29),
(29, 4, 30, 28),
(28, 4, 29, 0),
(27, 5, 0, 26),
(26, 5, 27, 25),
(25, 5, 26, 24),
(24, 5, 25, 23),
(23, 5, 24, 22),
(22, 5, 23, 21),
(21, 5, 22, 0),
(37, 6, 0, 38),
(38, 6, 37, 40),
(40, 6, 38, 41),
(41, 6, 40, 42),
(42, 6, 41, 0),
(43, 7, 0, 44),
(44, 7, 43, 0),
(45, 8, 0, 46),
(46, 8, 45, 47),
(47, 8, 46, 48),
(48, 8, 47, 49),
(49, 8, 48, 0),
(50, 9, 0, 51),
(51, 9, 50, 52),
(52, 9, 51, 53),
(53, 9, 52, 0),
(54, 10, 0, 55),
(55, 10, 54, 56),
(56, 10, 55, 57),
(57, 10, 56, 0),
(58, 11, 0, 59),
(59, 11, 58, 0),
(60, 12, 0, 61),
(61, 12, 60, 62),
(62, 12, 61, 63),
(63, 12, 62, 64),
(64, 12, 63, 65),
(65, 12, 64, 66),
(66, 12, 65, 0),
(67, 13, 0, 68),
(68, 13, 67, 69),
(69, 13, 68, 70),
(70, 13, 69, 71),
(71, 13, 70, 72),
(72, 13, 71, 0),
(73, 14, 0, 74),
(74, 14, 73, 75),
(75, 14, 74, 76),
(76, 14, 75, 77),
(77, 14, 76, 0),
(78, 15, 0, 80),
(39, 25, 129, 130),
(80, 15, 78, 81),
(81, 15, 80, 82),
(82, 15, 81, 83),
(83, 15, 82, 84),
(84, 15, 83, 85),
(90, 15, 89, 0),
(89, 15, 88, 90),
(88, 15, 87, 89),
(87, 15, 86, 88),
(86, 15, 85, 87),
(85, 15, 84, 86),
(110, 20, 109, 0),
(109, 20, 108, 110),
(108, 20, 107, 109),
(107, 20, 0, 108),
(106, 19, 105, 0),
(105, 19, 0, 106),
(104, 18, 103, 0),
(103, 18, 102, 104),
(102, 18, 101, 103),
(101, 18, 100, 102),
(100, 18, 99, 101),
(99, 18, 0, 100),
(98, 17, 97, 0),
(97, 17, 96, 98),
(96, 17, 95, 97),
(95, 17, 93, 96),
(93, 17, 0, 95),
(92, 16, 91, 0),
(91, 16, 0, 92),
(111, 21, 0, 112),
(112, 21, 111, 113),
(113, 21, 112, 114),
(114, 21, 113, 115),
(115, 21, 113, 115),
(116, 21, 115, 117),
(117, 21, 116, 118),
(118, 21, 117, 0),
(119, 22, 0, 120),
(120, 22, 119, 121),
(121, 22, 120, 122),
(122, 22, 121, 123),
(123, 22, 122, 124),
(124, 22, 123, 0),
(125, 23, 0, 0),
(126, 24, 0, 0),
(127, 25, 0, 128),
(128, 25, 127, 129),
(129, 25, 128, 39),
(130, 25, 39, 131),
(131, 25, 130, 132),
(132, 25, 131, 133),
(133, 25, 132, 134),
(134, 25, 133, 135),
(135, 25, 134, 0),
(136, 26, 0, 137),
(137, 26, 136, 138),
(138, 26, 137, 139),
(139, 26, 138, 140),
(140, 26, 139, 0),
(141, 27, 0, 142),
(142, 27, 141, 143),
(143, 27, 142, 144),
(144, 27, 143, 0),
(145, 28, 0, 146),
(146, 28, 145, 147),
(147, 28, 146, 148),
(148, 28, 147, 149),
(149, 28, 148, 0),
(150, 29, 0, 151),
(151, 29, 150, 152),
(152, 29, 151, 0),
(153, 30, 0, 154),
(154, 30, 153, 155),
(155, 30, 154, 156),
(156, 30, 155, 157),
(157, 30, 156, 158),
(158, 30, 157, 159),
(159, 30, 158, 160),
(160, 30, 159, 161),
(161, 30, 160, 162),
(162, 30, 161, 0),
(163, 31, 0, 164),
(164, 31, 163, 0),
(165, 32, 0, 166),
(166, 32, 165, 167),
(167, 32, 166, 168),
(168, 32, 167, 169),
(169, 32, 168, 170),
(170, 32, 169, 171),
(171, 32, 170, 172),
(172, 32, 171, 173),
(173, 32, 172, 174),
(174, 32, 173, 175),
(175, 32, 174, 176),
(176, 32, 175, 177),
(177, 32, 176, 178),
(178, 32, 177, 179),
(179, 32, 178, 180),
(180, 32, 179, 181),
(181, 32, 180, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_engines`
--

CREATE TABLE IF NOT EXISTS `DSS_engines` (
  `ID` int(11) NOT NULL auto_increment,
  `webservice` varchar(300) collate utf8_unicode_ci NOT NULL,
  `document` varchar(300) collate utf8_unicode_ci NOT NULL,
  `title` varchar(300) collate utf8_unicode_ci NOT NULL,
  `used` int(11) NOT NULL,
  `suggestionType` set('concordance','lexicon') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `DSS_engines`
--

INSERT INTO `DSS_engines` (`ID`, `webservice`, `document`, `title`, `used`, `suggestionType`) VALUES
(1, 'http://appello-vto2.csad.ox.ac.uk?method=get_word&pattern=', 'http://vto2.classics.ox.ac.uk/index.php/tablets/search-for-tablets?submit=View&tablet=', 'Vindolanda Tablets Online II', 0, 'concordance'),
(2, 'http://localhost/appello_irt/?method=get_word&pattern=', '', 'Inscriptions of Roman Tripolitania', 0, 'concordance'),
(3, 'http://localhost/appello_insaph/?method=get_word&pattern=', '', 'Inscriptions of Aphrodisias', 0, 'concordance'),
(5, 'http://archimedes.mpiwg-berlin.mpg.de/cgi-bin/toc/dict?lang=la;submit=submit%20query;step=table;type=xml;word=', '', 'Perseus Latin Dictionaries', 1, 'lexicon');

-- --------------------------------------------------------

--
-- Table structure for table `DSS_letters`
--

CREATE TABLE IF NOT EXISTS `DSS_letters` (
  `ID` int(5) NOT NULL auto_increment,
  `charID` int(5) NOT NULL,
  `letter` varchar(3) collate utf8_unicode_ci NOT NULL,
  `resolve` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=237 ;

--
-- Dumping data for table `DSS_letters`
--

INSERT INTO `DSS_letters` (`ID`, `charID`, `letter`, `resolve`) VALUES
(74, 1, 'M', 1),
(75, 2, 'a', 1),
(76, 3, 'r', 1),
(77, 4, 't', 1),
(78, 5, 'i', 1),
(79, 6, 'u', 1),
(80, 7, 's', 1),
(81, 8, 'V', 1),
(82, 9, 'i', 1),
(83, 10, 'c', 1),
(84, 11, 't', 1),
(85, 12, 'o', 1),
(86, 13, 'r', 1),
(87, 14, 'i', 1),
(88, 15, 'f', 1),
(89, 16, 'r', 1),
(90, 17, 'a', 1),
(91, 18, 't', 1),
(92, 19, 'r', 1),
(93, 20, 'i', 1),
(94, 21, 'm', 1),
(95, 22, 'e', 0),
(96, 23, 't', 1),
(97, 24, 'u', 1),
(98, 25, 'l', 1),
(99, 26, 'a', 1),
(100, 27, 's', 1),
(101, 28, 'o', 1),
(102, 29, 'm', 1),
(103, 30, 'i', 1),
(104, 31, 's', 1),
(105, 32, 's', 1),
(106, 33, 'i', 1),
(107, 34, 'r', 1),
(108, 35, 'a', 1),
(109, 36, 'k', 1),
(110, 37, 's', 1),
(111, 38, 'c', 0),
(112, 40, 'i', 0),
(113, 41, 'a', 1),
(114, 42, 's', 1),
(115, 43, 'm', 0),
(116, 44, 'e', 1),
(117, 45, 'r', 1),
(118, 46, 'e', 1),
(119, 47, 'c', 1),
(120, 48, 't', 1),
(121, 49, 'e', 1),
(122, 50, 'e', 1),
(123, 51, 's', 0),
(124, 52, 's', 0),
(125, 53, 'e', 0),
(126, 54, 'q', 1),
(127, 55, 'u', 1),
(128, 56, 'o', 1),
(129, 57, 'd', 1),
(130, 58, 't', 0),
(131, 59, 'e', 0),
(132, 60, 'i', 1),
(133, 61, 'n', 1),
(134, 62, 'u', 1),
(135, 63, 'i', 1),
(136, 64, 'c', 1),
(137, 65, 'e', 1),
(138, 66, 'm', 1),
(139, 67, 'f', 1),
(140, 68, 'a', 1),
(141, 69, 'c', 1),
(142, 70, 'e', 0),
(143, 71, 'r', 1),
(144, 72, 'e', 0),
(145, 73, 'c', 1),
(146, 74, 'u', 1),
(147, 75, 'p', 1),
(148, 76, 'i', 1),
(149, 77, 'o', 1),
(150, 78, 'p', 0),
(151, 80, 'r', 1),
(152, 81, 'o', 1),
(153, 82, 'c', 1),
(154, 83, 'u', 1),
(155, 84, 'r', 0),
(156, 85, 'a', 1),
(157, 86, 't', 1),
(158, 87, 'o', 0),
(159, 88, 'r', 1),
(160, 89, 'e', 1),
(161, 90, 'm', 1),
(162, 91, 't', 1),
(163, 92, 'e', 1),
(164, 93, 'f', 0),
(165, 95, 'a', 0),
(166, 96, 'c', 1),
(167, 97, 'i', 1),
(168, 98, 'o', 1),
(169, 99, 'f', 1),
(170, 100, 'r', 1),
(171, 101, 'a', 0),
(172, 102, 't', 1),
(173, 103, 'e', 1),
(174, 104, 'r', 1),
(175, 111, 'c', 0),
(176, 112, 'o', 1),
(177, 113, 'g', 1),
(178, 114, 'n', 1),
(179, 116, 't', 1),
(180, 117, 'i', 0),
(181, 118, 's', 1),
(182, 119, 'p', 1),
(183, 120, 'a', 1),
(184, 121, 't', 1),
(185, 122, 'r', 0),
(186, 123, 'i', 1),
(187, 124, 's', 0),
(188, 127, 'd', 1),
(189, 128, 'i', 0),
(190, 129, 'l', 1),
(191, 130, 'g', 1),
(235, 115, 'u', 0),
(193, 132, 'n', 1),
(194, 133, 't', 1),
(195, 134, 'e', 1),
(196, 135, 'r', 1),
(197, 136, 'n', 1),
(198, 137, 'e', 1),
(199, 138, 'q', 1),
(200, 139, 'u', 0),
(201, 140, 'e', 1),
(202, 131, 'e', 1),
(203, 39, 'i', 1),
(204, 141, 'a', 1),
(205, 143, 'a', 0),
(206, 148, 'i', 0),
(207, 149, 'd', 1),
(208, 150, 'e', 0),
(209, 151, 'i', 1),
(210, 152, 's', 1),
(211, 153, 'd', 1),
(212, 154, 'i', 0),
(213, 155, 's', 0),
(214, 156, 't', 1),
(215, 157, 'r', 1),
(216, 158, 'a', 1),
(217, 159, 'h', 1),
(218, 160, 'a', 1),
(219, 161, 'n', 1),
(220, 162, 't', 1),
(221, 168, 't', 0),
(222, 169, 'e', 1),
(234, 115, 'i', 0),
(233, 115, 'a', 0),
(226, 125, 'm', 0),
(227, 125, 'n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_lines`
--

CREATE TABLE IF NOT EXISTS `DSS_lines` (
  `ID` int(5) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `sectionID` int(5) NOT NULL,
  `afterID` int(5) NOT NULL,
  `beforeID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `DSS_lines`
--

INSERT INTO `DSS_lines` (`ID`, `name`, `sectionID`, `afterID`, `beforeID`) VALUES
(1, '1', 1, 0, 2),
(2, '2', 1, 1, 3),
(3, '4', 1, 2, 4),
(4, '4', 1, 3, 5),
(5, '5', 1, 4, 6),
(6, '6', 1, 5, 7),
(7, '7', 1, 6, 8),
(8, '8', 1, 7, 9),
(9, '9', 1, 8, 10),
(10, '10', 1, 9, 11),
(11, '11', 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_linkToBibl`
--

CREATE TABLE IF NOT EXISTS `DSS_linkToBibl` (
  `ID` int(5) NOT NULL auto_increment,
  `argumentID` int(5) NOT NULL,
  `biblURL` varchar(200) collate utf8_unicode_ci NOT NULL,
  `biblRef` varchar(500) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `DSS_linkToBibl`
--

INSERT INTO `DSS_linkToBibl` (`ID`, `argumentID`, `biblURL`, `biblRef`) VALUES
(1, 27, 'http://www.thesaurus.badw.de/', 'TLL X.2 1573ff'),
(2, 27, '', 'CPL 221 '),
(3, 27, '', 'CPL 225');

-- --------------------------------------------------------

--
-- Table structure for table `DSS_linkToDoc`
--

CREATE TABLE IF NOT EXISTS `DSS_linkToDoc` (
  `ID` int(5) NOT NULL auto_increment,
  `argumentID` int(5) NOT NULL,
  `linkType` varchar(10) collate utf8_unicode_ci NOT NULL,
  `linkID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `DSS_linkToDoc`
--

INSERT INTO `DSS_linkToDoc` (`ID`, `argumentID`, `linkType`, `linkID`) VALUES
(23, 24, 'letter', 119),
(14, 27, 'word', 22),
(15, 27, 'word', 15),
(16, 29, 'word', 21),
(17, 30, 'word', 21),
(18, 31, 'word', 23),
(19, 32, 'letter', 126);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_linkToURL`
--

CREATE TABLE IF NOT EXISTS `DSS_linkToURL` (
  `ID` int(5) NOT NULL auto_increment,
  `argumentID` int(5) NOT NULL,
  `URL` varchar(200) collate utf8_unicode_ci NOT NULL,
  `URLtitle` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `DSS_linkToURL`
--

INSERT INTO `DSS_linkToURL` (`ID`, `argumentID`, `URL`, `URLtitle`) VALUES
(7, 27, 'http://en.wikipedia.org/wiki/Procurator_(Roman)', 'Wiki entry for Procurator (Roman)');

-- --------------------------------------------------------

--
-- Table structure for table `DSS_sections`
--

CREATE TABLE IF NOT EXISTS `DSS_sections` (
  `ID` int(5) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `afterID` int(5) NOT NULL,
  `beforeID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `DSS_sections`
--

INSERT INTO `DSS_sections` (`ID`, `name`, `afterID`, `beforeID`) VALUES
(1, 'A.i', 0, 2),
(2, 'B.ii', 1, 3),
(3, 'A. Address', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DSS_words`
--

CREATE TABLE IF NOT EXISTS `DSS_words` (
  `ID` int(5) NOT NULL auto_increment,
  `lineID` int(5) NOT NULL,
  `afterID` int(5) NOT NULL,
  `beforeID` int(5) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `DSS_words`
--

INSERT INTO `DSS_words` (`ID`, `lineID`, `afterID`, `beforeID`) VALUES
(1, 1, 0, 2),
(2, 1, 1, 3),
(3, 1, 2, 0),
(4, 2, 0, 5),
(5, 2, 4, 0),
(6, 3, 0, 7),
(7, 3, 6, 8),
(8, 3, 7, 9),
(9, 3, 8, 10),
(10, 3, 9, 11),
(11, 3, 10, 0),
(12, 4, 0, 13),
(13, 4, 12, 14),
(14, 4, 13, 15),
(15, 4, 14, 0),
(16, 5, 0, 17),
(17, 5, 16, 18),
(18, 5, 17, 19),
(19, 5, 18, 0),
(20, 6, 0, 0),
(21, 7, 0, 22),
(22, 7, 21, 23),
(23, 7, 22, 0),
(24, 8, 0, 25),
(25, 8, 24, 26),
(26, 8, 25, 27),
(27, 8, 26, 0),
(28, 9, 0, 29),
(29, 9, 28, 30),
(30, 9, 29, 31),
(31, 9, 30, 0),
(32, 10, 0, 0);
