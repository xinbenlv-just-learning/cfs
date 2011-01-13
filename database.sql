-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2011 at 04:40 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `chinafundseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_subareas`
--

CREATE TABLE IF NOT EXISTS `area_subareas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  `subarea` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `area_subareas`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contact`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `datainfo`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grant`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grant_recipients`
--


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
  `num_offices_china` int(11) unsigned DEFAULT NULL,
  `china_contact_id` int(10) unsigned DEFAULT NULL,
  `hq_contact_id` int(10) unsigned DEFAULT NULL,
  `datainfo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `organization`
--


-- --------------------------------------------------------

--
-- Table structure for table `organization_areas`
--

CREATE TABLE IF NOT EXISTS `organization_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `org_id` int(11) unsigned NOT NULL,
  `area` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `organization_areas`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `organization_assets`
--


-- --------------------------------------------------------

--
-- Table structure for table `organization_geos`
--

CREATE TABLE IF NOT EXISTS `organization_geos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(10) unsigned NOT NULL,
  `geographics_china` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `organization_geos`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `organization_giving`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`) VALUES
('admin', 'c58326bef6a67cc55591588c787f7d3f6e3b3e8e', 'admin'),
