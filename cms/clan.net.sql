-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2009 at 12:31 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ksi-clan-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevels`
--

CREATE TABLE IF NOT EXISTS `accesslevels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `s1id` int(11) NOT NULL DEFAULT '0',
  `s2id` int(11) NOT NULL DEFAULT '0',
  `s3id` int(11) NOT NULL DEFAULT '0',
  `clid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accesslevels`
--


-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE IF NOT EXISTS `alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00-00-00',
  `textalert` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alert`
--


-- --------------------------------------------------------

--
-- Table structure for table `bgpending`
--

CREATE TABLE IF NOT EXISTS `bgpending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bgpending`
--


-- --------------------------------------------------------

--
-- Table structure for table `blkclans`
--

CREATE TABLE IF NOT EXISTS `blkclans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cblktag` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cblkclan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cblkreason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cblklv` int(1) DEFAULT NULL,
  `cblkauthid` int(11) DEFAULT NULL,
  `cblkdate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blkclans`
--


-- --------------------------------------------------------

--
-- Table structure for table `blklist`
--

CREATE TABLE IF NOT EXISTS `blklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blkname` varchar(17) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blkreason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blklv` int(1) DEFAULT NULL,
  `blkproof` text COLLATE utf8_unicode_ci,
  `blkauthid` int(11) NOT NULL DEFAULT '1',
  `blkdate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blklist`
--


-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE IF NOT EXISTS `chatbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datesent` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `chatbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `checklogs`
--

CREATE TABLE IF NOT EXISTS `checklogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `gameid` int(20) DEFAULT NULL,
  `gamertag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numclans` int(11) NOT NULL DEFAULT '0',
  `numtags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `checklogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `squadid` int(11) DEFAULT NULL,
  `codechars` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `codes`
--


-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diviname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diviabbr` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `divipass` int(8) NOT NULL DEFAULT '30000192',
  `visable` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `diviname`, `diviabbr`, `divipass`, `visable`) VALUES
(37, 'Leaders', 'LDR', 30000192, 0);

-- --------------------------------------------------------

--
-- Table structure for table `frontpage_stats_gb`
--

CREATE TABLE IF NOT EXISTS `frontpage_stats_gb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `division` text COLLATE utf8_unicode_ci,
  `totalnum` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `frontpage_stats_gb`
--


-- --------------------------------------------------------

--
-- Table structure for table `gametypes`
--

CREATE TABLE IF NOT EXISTS `gametypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gamename` varchar(250) DEFAULT NULL,
  `abbr` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gametypes`
--


-- --------------------------------------------------------

--
-- Table structure for table `ipban`
--

CREATE TABLE IF NOT EXISTS `ipban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ipban`
--


-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `time` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `mbrlist`
--

CREATE TABLE IF NOT EXISTS `mbrlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(17) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `addid` int(11) DEFAULT NULL,
  `bgcheck` int(1) NOT NULL DEFAULT '0',
  `rank` int(2) DEFAULT NULL,
  `date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gametype` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `visable` int(1) NOT NULL DEFAULT '0',
  `des` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n/a',
  `cl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mbrlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `removed_names`
--

CREATE TABLE IF NOT EXISTS `removed_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(17) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `removed_names`
--


-- --------------------------------------------------------

--
-- Table structure for table `requestlist`
--

CREATE TABLE IF NOT EXISTS `requestlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) DEFAULT NULL,
  `squadid` int(11) DEFAULT NULL,
  `multi` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `requestlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `squadlogs`
--

CREATE TABLE IF NOT EXISTS `squadlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci,
  `ip` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `squadlogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `squads`
--

CREATE TABLE IF NOT EXISTS `squads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `squadname` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `squadpass` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visable` int(1) NOT NULL DEFAULT '0',
  `divisionid` int(11) DEFAULT NULL,
  `date` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '06/10/07',
  `max` int(11) NOT NULL DEFAULT '100',
  `secure` int(1) NOT NULL DEFAULT '1',
  `defaultgame` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=346 ;

--
-- Dumping data for table `squads`
--

INSERT INTO `squads` (`id`, `squadname`, `squadpass`, `visable`, `divisionid`, `date`, `max`, `secure`, `defaultgame`) VALUES
(345, 'Leaders', '1234567897', 0, 37, '06/10/07', 400, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `useraccess`
--

CREATE TABLE IF NOT EXISTS `useraccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(17) DEFAULT NULL,
  `password` varchar(62) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `accesslevel` int(1) DEFAULT NULL,
  `clanleaderid` int(11) NOT NULL DEFAULT '0',
  `ipaddress` varchar(25) DEFAULT NULL,
  `lastactive` varchar(9) NOT NULL DEFAULT '-',
  `firststarted` varchar(9) DEFAULT NULL,
  `letinby` int(10) NOT NULL DEFAULT '0',
  `colorcode` varchar(21) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `useraccess`
--

INSERT INTO `useraccess` (`id`, `username`, `password`, `email`, `accesslevel`, `clanleaderid`, `ipaddress`, `lastactive`, `firststarted`, `letinby`, `colorcode`) VALUES
(1, 'admin', '098f6bcd4621d373cade4e832627b4f6', '1@1.com', 5, 0, NULL, '-', '2007', 0, '0');
