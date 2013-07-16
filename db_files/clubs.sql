-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 03:25 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ratemyclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clubName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(30) NOT NULL,
  `college` varchar(50) NOT NULL,
  `overallRating` decimal(2,0) NOT NULL DEFAULT '0',
  `rigor` decimal(2,0) NOT NULL DEFAULT '0',
  `cohesiveness` decimal(2,0) NOT NULL DEFAULT '0',
  `timeCommitment` decimal(2,0) NOT NULL DEFAULT '0',
  `url` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `nRigor` int(11) NOT NULL,
  `nCohesiveness` int(11) NOT NULL,
  `nTimeCommitment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `clubName`, `description`, `category`, `college`, `overallRating`, `rigor`, `cohesiveness`, `timeCommitment`, `url`, `image`, `nRigor`, `nCohesiveness`, `nTimeCommitment`) VALUES
(1, 'Arts', 'We dont like art', 'arts', 'XYZ', 0, 0, 0, 0, 'google.com', 'amit', 0, 0, 0),
(2, 'Music', 'We like music', '', 'IIT', 0, 0, 0, 0, 'iit.com', 'iit', 0, 0, 0),
(3, 'Dance', 'Dance boy', '', 'MIT', 0, 0, 0, 0, 'MIT', 'MIT', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
