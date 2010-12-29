-- phpMyAdmin SQL Dump
-- version 3.3.7deb2build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2010 at 09:29 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chinafundseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `datainfo`
--

CREATE TABLE IF NOT EXISTS `datainfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collector` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `reviewer` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `datainfo`
--

INSERT INTO `datainfo` (`id`, `language`, `collector`, `reviewer`, `status`, `comments`) VALUES
(1, 'English', 'JIANG Shujie', '', 'To Be Reviewed', 'For the total giving, I use the number " Program and grant management expense for convenience"'),
(2, 'English', 'JIANG Shujie', NULL, 'To Be Reviewed', 'No website available, we should reach out for more information.'),
(3, 'English', 'SONG Ziwei', 'XU Xiner', 'Reviewed', '');
