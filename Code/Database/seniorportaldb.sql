-- phpMyAdmin SQL Dump
-- version 4.0.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 11:24 PM
-- Server version: 5.6.19
-- PHP Version: 5.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seniorportaldb`
--
CREATE DATABASE IF NOT EXISTS seniorportaldb;
USE seniorportaldb;
-- --------------------------------------------------------

--
-- Table structure for table `portal_sites`
--

CREATE TABLE IF NOT EXISTS `portal_sites` (
  `name` varchar(50) NOT NULL,
  `url` varchar(500) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `portal_sites`
--

INSERT INTO `portal_sites` (`name`, `url`, `id`) VALUES
('Virtual Job Fair', 'http://vjf-dev.cis.fiu.edu', 1),
('Mobile Judge', 'http://mj.cs.fiu.edu', 2),
('Senior Project Website', 'http://spws.cis.fiu.edu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usertype`, `email`, `password`, `activated`) VALUES
(3, 'admin', 'admin', 'P7owjJUpp1MZAKv6W7sK3rJXpup3uPdiRVcO-PbkCrM', 1),
(4, 'default', 'cjone089@fiu.edu', '4KmgtBkgLrzvoHORoXOycvDzZwjIYBgb1cVcoT452cI', 1),
(5, 'default', 'chris.p.waffles@gmail.com', '4KmgtBkgLrzvoHORoXOycvDzZwjIYBgb1cVcoT452cI', NULL);
--
-- Database: `test`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
