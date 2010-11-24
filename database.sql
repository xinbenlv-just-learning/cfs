-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2010 at 05:07 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `chinafundseeker`
--
CREATE DATABASE `chinafundseeker` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `chinafundseeker`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_name` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `person_name`, `address`, `telephone`, `fax`, `email`) VALUES
(7, '5', '6', '7', '8', '9'),
(8, '10', '11', '12', '13', '14'),
(9, '', '', '', '', ''),
(10, '', '', '', '', ''),
(11, 'Jian', 'New York', '917-833-9776', '', 'ma86jian@gmail.com'),
(12, '', '', '', '', ''),
(15, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL),
(17, '', '', '', '', ''),
(18, '', '', '', '', ''),
(19, '', '', '', '', ''),
(20, '', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `datainfo`
--

INSERT INTO `datainfo` (`id`, `language`, `collector`, `reviewer`, `status`, `comments`) VALUES
(4, 'English', 'XU Xiner', NULL, 'Complete', 'TEST'),
(5, 'English', 'CHEN Tracy', NULL, 'Collecting', 'TEST'),
(6, 'English', 'CHEN Tracy', NULL, 'Collecting', 'TEST'),
(7, 'English', 'CHEN Tracy', NULL, 'Collecting', 'TEST'),
(8, 'English', 'CHEN Shangshang', NULL, 'Reviewing', 'TEST'),
(9, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(10, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(11, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(12, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(13, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(14, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(15, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(16, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(17, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(18, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(19, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(20, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(21, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(22, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(23, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(24, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(25, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(26, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(27, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(28, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(29, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(30, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(31, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(32, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(33, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(34, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(35, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(36, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(37, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(38, 'English', 'CHEN Tracy', NULL, 'Collecting', 'test'),
(39, 'English', 'MA Jian', NULL, 'Collecting', 'Test ?ж╠?иибе?'),
(40, 'English', 'MA Jian', NULL, 'Collecting', 'test ?ж╠?иибе????'),
(42, 'English', 'MA Jian', NULL, 'Collecting', 'Test'),
(43, 'English', 'MA Jian', NULL, 'Collecting', 'Test'),
(45, 'Chinese', 'CHEN Tracy', NULL, 'Collecting', ''),
(46, 'English', 'MA Jian', NULL, 'Collecting', ''),
(47, 'English', 'CHEN Tracy', NULL, 'Collecting', 'Test'),
(48, 'English', 'CHEN Tracy', NULL, 'Reviewed', '');

-- --------------------------------------------------------

--
-- Table structure for table `grant`
--

CREATE TABLE IF NOT EXISTS `grant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(10) unsigned NOT NULL,
  `grant_program` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `frequency_offer` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_guide` text COLLATE utf8_unicode_ci,
  `application_deadline` text COLLATE utf8_unicode_ci,
  `grant_recipients_id` int(10) unsigned DEFAULT NULL,
  `sample_proposals` text COLLATE utf8_unicode_ci,
  `datainfo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `grant`
--

INSERT INTO `grant` (`id`, `organization_id`, `grant_program`, `frequency_offer`, `application_guide`, `application_deadline`, `grant_recipients_id`, `sample_proposals`, `datainfo_id`) VALUES
(20, 6, '0', 'Yearly', 'on website', 'no', 35, 'good', 42),
(21, 6, 'Full Time Job', 'Yearly', 'on website', 'no', 36, 'good', 43),
(22, 8, 'test', '[ Select One ]', '', '', 37, '', 46),
(23, 4, '', '[ Select One ]', '', '', 38, '', 0),
(24, 4, '', '[ Select One ]', '', '', 39, '', 0),
(25, 4, '', '[ Select One ]', '', '', 40, '', 0),
(26, 4, '', '[ Select One ]', '', '', 41, '', 0),
(27, 4, 'good', 'Yearly', '100', '11/30', 42, 'www.google.com', 47);

-- --------------------------------------------------------

--
-- Table structure for table `grant_recipients`
--

CREATE TABLE IF NOT EXISTS `grant_recipients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `total_giving` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `grant_recipients`
--

INSERT INTO `grant_recipients` (`id`, `name`, `year`, `total_giving`) VALUES
(1, '5', 2006, 7),
(2, '5', 2006, 7),
(3, '5', 2006, 7),
(4, '5', 2006, 7),
(5, '5', 2006, 7),
(6, '5', 2006, 7),
(7, '5', 2006, 7),
(8, '5', 2006, 7),
(9, '5', 2006, 7),
(10, '5', 2006, 7),
(11, '5', 2006, 7),
(12, '5', 2006, 7),
(13, '5', 2006, 7),
(14, '5', 2006, 7),
(15, '5', 2006, 7),
(16, '5', 2006, 7),
(17, '5', 2006, 7),
(18, '5', 2006, 7),
(19, '5', 2006, 7),
(20, '5', 2006, 7),
(21, '5', 2006, 7),
(22, '5', 2006, 7),
(23, '5', 2006, 7),
(24, '5', 2006, 7),
(25, '5', 2006, 7),
(26, '5', 2006, 7),
(27, '5', 2006, 7),
(28, '5', 2006, 7),
(29, '5', 2006, 7),
(30, '5', 2006, 7),
(31, '5', 2006, 7),
(32, '5', 2006, 7),
(33, 'Jian', 2006, 7),
(35, 'Jian', 2010, 100000),
(36, 'Jian', 2010, 100000),
(37, '', NULL, NULL),
(38, '', 0000, 0),
(39, '', 0000, 0),
(40, '', 0000, 0),
(41, '', 0000, 0),
(42, 'Name', 2010, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `english_website` text COLLATE utf8_unicode_ci,
  `chinese_website` text COLLATE utf8_unicode_ci,
  `organization_type` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `original_country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grantee_type` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accept_public` tinyint(1) DEFAULT NULL,
  `area_funding` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subarea_funding` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_offices_china` int(11) unsigned DEFAULT NULL,
  `china_contact_id` int(10) unsigned DEFAULT NULL,
  `hq_contact_id` int(10) unsigned DEFAULT NULL,
  `datainfo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `organization_name`, `english_website`, `chinese_website`, `organization_type`, `original_country`, `grantee_type`, `accept_public`, `area_funding`, `subarea_funding`, `num_offices_china`, `china_contact_id`, `hq_contact_id`, `datainfo_id`) VALUES
(4, 'test', '1', '2', 'GONGO', '3', '0', 1, 'Child and Youth', 'Child Protection', 4, 7, 8, 4),
(6, 'Search Engine', 'www.google.com', 'www.baidu.com', 'GONGO', 'America', '0', 1, 'Education', 'All Subareas', 10, 11, 12, 40),
(8, 'good test', '', '', 'Corporate Donor', '', NULL, 1, 'Arts', NULL, 0, 17, 18, 45),
(9, 'test2', '', '', 'Corporate Donor', '', NULL, 1, 'Social Entrepreneurship', NULL, 0, 19, 20, 48);

-- --------------------------------------------------------

--
-- Table structure for table `organization_assets`
--

CREATE TABLE IF NOT EXISTS `organization_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(10) unsigned NOT NULL,
  `year` year(4) DEFAULT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `organization_assets`
--

INSERT INTO `organization_assets` (`id`, `organization_id`, `year`, `amount`) VALUES
(11, 4, 2001, 10000),
(12, 4, 2002, 11000),
(58, 6, 2001, 100000),
(59, 6, 2005, 100000),
(60, 6, 2010, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `organization_geos`
--

CREATE TABLE IF NOT EXISTS `organization_geos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(10) unsigned NOT NULL,
  `geographics_china` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Dumping data for table `organization_geos`
--

INSERT INTO `organization_geos` (`id`, `organization_id`, `geographics_china`) VALUES
(9, 4, 'North China'),
(10, 4, 'Northeastern China'),
(11, 4, 'Northwestern China'),
(12, 4, 'South China'),
(79, 6, 'China in General'),
(80, 6, 'East China'),
(81, 9, 'Northeastern China'),
(82, 9, 'Northwestern China'),
(83, 9, 'South China'),
(84, 9, 'Southeastern China');

-- --------------------------------------------------------

--
-- Table structure for table `organization_giving`
--

CREATE TABLE IF NOT EXISTS `organization_giving` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(10) unsigned NOT NULL,
  `year` year(4) DEFAULT NULL,
  `worldwide` int(10) unsigned DEFAULT NULL,
  `in_china` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organization_giving`
--

INSERT INTO `organization_giving` (`id`, `organization_id`, `year`, `worldwide`, `in_china`) VALUES
(1, 6, 2010, 2000000, 0);
