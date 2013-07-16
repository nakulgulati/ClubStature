-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 02:07 PM
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
  `rating` decimal(2,0) NOT NULL DEFAULT '0',
  `url` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `clubName`, `description`, `category`, `college`, `rating`, `url`, `image`) VALUES
(1, 'Arts', 'We dont like art', 'arts', 'XYZ', 0, 'google.com', 'amit'),
(2, 'Music', 'We like music', '', 'IIT', 0, 'iit.com', 'iit'),
(3, 'Dance', 'Dance boy', '', 'MIT', 0, 'MIT', 'MIT');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `timeStamp`, `clubID`, `username`, `comment`) VALUES
(1, '2:27 13/7/2013', 0, '', 'I hope this works.'),
(2, '2:31 13/7/2013', 1, '', 'Hope this works'),
(3, '2:33 13/7/2013', 2, '', 'This better work properly'),
(4, '2:37 13/7/2013', 3, 'nidhi', 'This is nidhi..'),
(5, '3:13 13/7/2013', 3, 'nakul', 'This is nidhi..'),
(6, '17:33 16/7/2013', 3, 'amit', 'kdsnflkdsnfkldsn');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(30) CHARACTER SET utf8 NOT NULL,
  `position` int(3) NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `slug`, `position`, `visibility`) VALUES
(1, 'About', 'about.php', 1, 1),
(2, 'Browse Clubs', 'browse.php', 2, 1),
(3, 'Top Lists', 'lists.php', 3, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `hashedPass`) VALUES
(6, 'nakul', 'nakgulati@gmail.com', 'd54b76b2bad9d9946011ebc62a1d272f4122c7b5'),
(7, 'nidhi', 'nidhi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(8, 'veni', 'veni@gmail.com', '268898dece5052735352eb754d75d2e45eb73c57'),
(9, 'amit', 'amitkal@umich.edu', '40c5169448af7279279c2b4041455ee4b0ab5cd1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
