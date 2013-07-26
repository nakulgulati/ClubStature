-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2013 at 06:40 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ratemyclub`
--
CREATE DATABASE IF NOT EXISTS `ratemyclub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ratemyclub`;

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
  `overallRating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `rigor` decimal(2,1) NOT NULL DEFAULT '0.0',
  `cohesiveness` decimal(2,1) NOT NULL DEFAULT '0.0',
  `timeCommitment` decimal(2,1) NOT NULL DEFAULT '0.0',
  `url` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `clubName`, `description`, `category`, `college`, `overallRating`, `rigor`, `cohesiveness`, `timeCommitment`, `url`, `image`) VALUES
(1, 'Michigan Hackers', 'We hack and not yack.', 'Sci Tech', 'Michigan', '0.0', '0.0', '0.0', '0.0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE IF NOT EXISTS `colleges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`) VALUES
(1, 'NIIT University, Neemrana'),
(2, 'UC-Berkeley'),
(3, 'Barefoot College'),
(4, 'University of Michigan'),
(5, 'University of California at Los Angeles (UCLA)'),
(6, 'Massachusetts Institute of Technology (MIT)'),
(7, 'Harvard University'),
(8, 'Shri Ram School - Aravali'),
(9, 'California Institute of Technology (CalTech)'),
(10, 'Princeton University'),
(11, 'Yale University'),
(12, 'Cornell University'),
(13, 'Brown University'),
(14, 'University of Pennsylvania'),
(15, 'Columbia University'),
(16, 'Stanford University'),
(17, 'Georgia Tech'),
(18, 'Williams College'),
(19, 'Swarthmore College'),
(20, 'University of Chicago'),
(21, 'Duke University'),
(22, 'Dartmouth College'),
(23, 'Northwestern University'),
(24, 'John Hopkins University'),
(25, 'WUSTL'),
(26, 'Rice University'),
(27, 'University of Notre Dame'),
(28, 'Vanderbilt University'),
(29, 'Emory University'),
(30, 'Georgetown University'),
(31, 'Carnegie Mellon University'),
(32, 'University of South California'),
(33, 'University of Virgina'),
(34, 'Wake Forest University'),
(35, 'Tufts University'),
(36, 'IIT-Delhi'),
(37, 'IIT-Kanpur'),
(38, 'BITS-Pilani'),
(39, 'IIT-Bombay'),
(44, 'St. Stephen''s College');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` varchar(30) NOT NULL,
  `clubID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(30) CHARACTER SET utf8 NOT NULL,
  `position` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `slug`, `position`) VALUES
(1, 'About', 'about.php', 1),
(3, 'Top Lists', 'lists.php', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clubId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `rigor` int(2) NOT NULL,
  `cohesiveness` int(2) NOT NULL,
  `timeCommitment` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `hashedPass` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `hashedPass` (`hashedPass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
