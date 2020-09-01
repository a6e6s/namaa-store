-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2020 at 12:30 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blank-mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `total` bigint(20) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `donation_type` varchar(200) DEFAULT '" "',
  `order_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `API_status` enum('read','unread','updated') NOT NULL DEFAULT 'unread',
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `amount`, `total`, `quantity`, `donation_type`, `order_id`, `project_id`, `API_status`, `status`, `modified_date`, `create_date`) VALUES
(2, 1, 1, 1, ' ', 2, 4, 'unread', 3, 1583315262, 1583315247),
(3, 50, 50, 1, ' ', 2, 2, 'unread', 1, 1583320401, 1583320375),
(4, 50, 50, 1, ' ', 2, 3, 'unread', 3, 1583399753, 1583399753),
(5, 50, 50, 1, ' ', 2, 3, 'unread', 1, 1583408352, 1583408352),
(6, 1, 1, 1, ' ', 2, 4, 'unread', 0, 1583408524, 1583408524),
(7, 1, 1, 1, ' ', 2, 4, 'unread', 3, 1583408543, 1583408543),
(8, 1, 1, 1, ' ', 2, 4, 'unread', 1, 1583408581, 1583408581),
(9, 1, 1, 1, ' ', 2, 4, 'unread', 3, 1583408594, 1583408594),
(10, 1, 1, 1, ' ', 2, 4, 'unread', 1, 1583408742, 1583408742),
(11, 1, 1, 1, ' ', 2, 4, 'unread', 0, 1583408795, 1583408795),
(12, 1, 1, 1, ' ', 12, 4, 'unread', 3, 1583410255, 1583410255),
(13, 1, 1, 1, ' ', 3, 4, 'unread', 1, 1583413306, 1583413306),
(14, 50, 50, 1, ' ', 3, 3, 'unread', 2, 1583415740, 1583415420),
(15, 1111, 1111, 1, ' ', 3, 9, 'unread', 3, 1583733800, 1583733800),
(16, 50, 50, 1, ' ', 3, 3, 'unread', 3, 1583746341, 1583746334),
(17, 222, 222, 1, ' ', 3, 6, 'unread', 3, 1583755300, 1583755300),
(18, 222, 222, 1, ' ', 3, 6, 'unread', 1, 1583765569, 1583755337),
(19, 50, 50, 1, ' ', 3, 3, 'unread', 1, 1583765198, 1583758994),
(20, 50, 50, 1, ' ', 3, 3, 'unread', 1, 1583821789, 1583821761),
(21, 50, 50, 1, ' ', 3, 1, 'unread', 1, 1584440018, 1583821829),
(22, 1, 1, 1, ' ', 11, 10, 'unread', 3, 1584356204, 1583822177),
(23, 50, 50, 1, ' ', 4, 8, 'unread', 0, 1584440046, 1583823015),
(24, 11, 33, 3, ' ', 4, 11, 'unread', 1, 1584972974, 1584535762),
(25, 11, 11, 1, ' ', 4, 11, 'unread', 0, 1584972955, 1584536881),
(26, 1111, 1111, 1, 'سهم3', 4, 6, 'unread', 0, 1584971249, 1584971249),
(27, 50, 200, 4, 'قيمة ثابته', 4, 3, 'unread', 3, 1584971362, 1584971354),
(28, 11, 11, 1, 'فدية', 4, 4, 'unread', 3, 1585504058, 1585504058),
(29, 11, 11, 1, 'فدية', 4, 4, 'unread', 4, 1585504149, 1585504142),
(30, 100, 100, 1, 'مفتوح', 4, 10, 'unread', 1, 1585504149, 1585504142),
(31, 111, 111, 1, 'كسوة فرد', 4, 4, 'unread', 1, 1585504380, 1585504324),
(32, 50, 50, 1, 'قيمة ثابته', 4, 3, 'unread', 1, 1586287457, 1585504324),
(33, 100, 100, 1, 'كسوة فردين', 4, 2, 'unread', 1, 1585504380, 1585504324),
(34, 11, 22, 2, 'فدية', 4, 4, 'unread', 1, 1585514488, 1585514488),
(35, 199, 199, 1, 'كسوة اسرة', 4, 2, 'unread', 1, 1585514488, 1585514488),
(36, 50, 50, 1, 'قيمة ثابته', 4, 3, 'unread', 1, 1585514668, 1585514668),
(37, 50, 50, 1, 'قيمة ثابته', 4, 15, 'unread', 1, 1585742576, 1585742576),
(38, 10, 10, 1, 'مفتوح', 4, 19, 'unread', 1, 1585930202, 1585930195),
(39, 50, 100, 2, 'قيمة ثابته', 4, 3, 'unread', 1, 1586287469, 1585937984),
(40, 111, 111, 1, 'كسوة فرد', 4, 4, 'unread', 1, 1586353345, 1586353337),
(41, 50, 100, 2, 'قيمة ثابته', 4, 3, 'unread', 1, 1586353345, 1586353337),
(42, 50, 50, 1, 'قيمة ثابته', 13, 14, 'unread', 1, 1586353345, 1586353337),
(43, 100, 100, 1, 'كسوة فردين', 5, 2, 'unread', 1, 1586353345, 1586353337),
(44, 111, 111, 1, 'كسوة فرد', 5, 4, 'unread', 1, 1586353854, 1586353849),
(45, 111, 111, 1, 'كسوة فرد', 5, 4, 'unread', 1, 1586354150, 1586354150),
(46, 111, 111, 1, 'كسوة فرد', 5, 4, 'unread', 1, 1586354932, 1586354446),
(47, 100, 100, 1, 'مفتوح', 5, 10, 'unread', 1, 1586355102, 1586355095),
(48, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586355754, 1586355747),
(49, 50, 50, 1, 'قيمة ثابته', 5, 3, 'unread', 1, 1586355892, 1586355820),
(50, 50, 50, 1, 'قيمة ثابته', 5, 3, 'unread', 1, 1586392163, 1586392108),
(51, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586723071, 1586723071),
(52, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783302, 1586783302),
(53, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783355, 1586783355),
(54, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783442, 1586783442),
(55, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783468, 1586783468),
(56, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783512, 1586783512),
(57, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586783644, 1586783644),
(58, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586784078, 1586784078),
(59, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586784112, 1586784112),
(60, 111, 111, 1, 'فدية', 5, 4, 'unread', 1, 1586784652, 1586784652),
(61, 111, 111, 1, 'كسوة فرد', 5, 4, 'unread', 1, 1586787966, 1586787966),
(62, 50, 50, 1, 'قيمة ثابته', 10, 3, 'unread', 1, 1586788042, 1586788042),
(63, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1586788996, 1586788996),
(64, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1586789281, 1586789281),
(65, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1586789357, 1586789357),
(66, 100, 100, 1, 'كسوة فردين', 13, 2, 'unread', 1, 1586789572, 1586789572),
(67, 100, 100, 1, 'مفتوح', 13, 10, 'unread', 1, 1586789890, 1586789890),
(68, 111, 111, 1, 'فدية', 13, 4, 'unread', 1, 1586789923, 1586789923),
(69, 111, 111, 1, 'فدية', 13, 4, 'unread', 1, 1586790075, 1586790075),
(70, 111, 111, 1, 'فدية', 13, 4, 'unread', 1, 1586859538, 1586859538),
(71, 11, 11, 1, 'فدية', 13, 4, 'unread', 1, 1587071281, 1587071267),
(72, 50, 50, 1, 'قيمة ثابته', 13, 15, 'unread', 1, 1587071281, 1587071267),
(73, 11, 11, 1, 'سهم3', 13, 11, 'unread', 1, 1587072382, 1587072375),
(74, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1587077130, 1587077117),
(75, 50, 50, 1, 'قيمة ثابته', 13, 15, 'unread', 1, 1587077130, 1587077117),
(76, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 1, 1587077130, 1587077117),
(77, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1587077342, 1587077336),
(78, 50, 50, 1, 'كسوة اسرة', 13, 2, 'unread', 1, 1587077406, 1587077396),
(79, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1587077638, 1587077630),
(80, 11, 11, 1, 'سهم3', 13, 11, 'unread', 1, 1587077726, 1587077726),
(81, 11, 11, 1, 'سهم3', 13, 11, 'unread', 1, 1587077768, 1587077749),
(82, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 1, 1587079406, 1587079394),
(83, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 1, 1587079406, 1587079394),
(84, 50, 50, 1, 'قيمة ثابته', 13, 14, 'unread', 1, 1587079406, 1587079394),
(85, 111, 111, 1, 'فدية', 13, 4, 'unread', 0, 1587341268, 1587341209),
(86, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 0, 1587385807, 1587385807),
(87, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1587385807, 1587385807),
(88, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 0, 1587385837, 1587385837),
(89, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1587386222, 1587386222),
(90, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1587386240, 1587386240),
(91, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 0, 1588115914, 1588115914),
(92, 111, 111, 1, 'سهم2', 13, 11, 'unread', 0, 1588116027, 1588116027),
(93, 1111, 1111, 1, 'سهم3', 13, 11, 'unread', 0, 1588116314, 1588116314),
(94, 111, 222, 2, 'كسوة فرد', 13, 4, 'unread', 0, 1588118105, 1588118105),
(95, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1588118165, 1588118165),
(96, 100, 100, 1, 'كسوة فردين', 13, 2, 'unread', 1, 1588118165, 1588118165),
(97, 50, 200, 4, 'قيمة ثابته', 13, 3, 'unread', 0, 1588118241, 1588118241),
(98, 50, 100, 2, 'قيمة ثابته', 13, 3, 'unread', 0, 1588155375, 1588118290),
(99, 100, 100, 1, 'كسوة فردين', 13, 2, 'unread', 1, 1588245908, 1588245908),
(100, 111, 111, 1, 'كسوة فرد', 13, 4, 'unread', 0, 1588246062, 1588246062),
(101, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1588246062, 1588246062),
(102, 50, 50, 1, 'قيمة ثابته', 13, 15, 'unread', 0, 1588246062, 1588246062),
(103, 11, 11, 1, 'فدية', 13, 4, 'unread', 0, 1588246232, 1588246232),
(104, 50, 50, 1, 'قيمة ثابته', 13, 3, 'unread', 0, 1588246232, 1588246232),
(105, 50, 100, 2, 'قيمة ثابته', 13, 1, 'unread', 0, 1588506246, 1588246232),
(106, 111, 111, 1, 'كسوة فرد', 17, 4, 'unread', 0, 1588984504, 1588984504),
(107, 111, 111, 1, 'كسوة فرد', 18, 4, 'unread', 0, 1588985165, 1588985165),
(108, 111, 111, 1, 'كسوة فرد', 19, 4, 'unread', 0, 1588985280, 1588985280),
(109, 111, 111, 1, 'كسوة فرد', 20, 4, 'unread', 0, 1588985293, 1588985293),
(110, 111, 111, 1, 'كسوة فرد', 21, 4, 'unread', 0, 1588985353, 1588985353),
(111, 111, 111, 1, 'كسوة فرد', 22, 4, 'unread', 0, 1588985372, 1588985372),
(112, 111, 111, 1, 'كسوة فرد', 23, 4, 'unread', 0, 1588985385, 1588985385),
(113, 111, 111, 1, 'كسوة فرد', 24, 4, 'unread', 0, 1588985704, 1588985704),
(114, 111, 111, 1, 'كسوة فرد', 25, 4, 'unread', 0, 1588986093, 1588986093),
(115, 111, 111, 1, 'كسوة فرد', 26, 4, 'unread', 0, 1588986251, 1588986251),
(116, 111, 111, 1, 'كسوة فرد', 27, 4, 'unread', 0, 1588986703, 1588986703),
(117, 111, 111, 1, 'كسوة فرد', 28, 4, 'unread', 0, 1588986724, 1588986724),
(118, 111, 111, 1, 'كسوة فرد', 29, 4, 'unread', 0, 1588988779, 1588988779),
(119, 111, 111, 1, 'كسوة فرد', 30, 4, 'unread', 0, 1588988810, 1588988810),
(120, 111, 333, 3, 'كسوة فرد', 32, 4, 'unread', 0, 1589044640, 1589044640),
(121, 50, 50, 1, 'قيمة ثابته', 32, 3, 'unread', 0, 1589044640, 1589044640),
(122, 100, 200, 2, 'كسوة فردين', 32, 2, 'unread', 0, 1589044640, 1589044640),
(123, 50, 50, 1, 'قيمة ثابته', 32, 14, 'unread', 0, 1589044640, 1589044640),
(124, 111, 333, 3, 'كسوة فرد', 33, 4, 'unread', 0, 1589045295, 1589045295),
(125, 50, 50, 1, 'قيمة ثابته', 33, 3, 'unread', 0, 1589045295, 1589045295),
(126, 100, 200, 2, 'كسوة فردين', 33, 2, 'unread', 3, 1589045295, 1589045295),
(127, 50, 50, 1, 'قيمة ثابته', 33, 14, 'unread', 0, 1589045295, 1589045295),
(128, 50, 50, 1, 'قيمة ثابته', 34, 2, 'unread', 0, 1589057919, 1589049845),
(129, 222, 222, 1, 'مفتوح', 34, 10, 'unread', 0, 1589049845, 1589049845),
(130, 50, 50, 1, 'قيمة ثابته', 35, 15, 'unread', 0, 1589229462, 1589229462),
(131, 200, 200, 1, 'كسوة اسرة', 35, 2, 'unread', 0, 1589229462, 1589229462),
(132, 50, 150, 3, '50 ريال', 35, 15, 'unread', 0, 1589229462, 1589229462),
(133, 11, 22, 2, 'فدية', 35, 4, 'unread', 0, 1589229462, 1589229462),
(134, 50, 50, 1, 'قيمة ثابته', 35, 3, 'unread', 0, 1589229462, 1589229462),
(135, 11, 33, 3, 'فدية', 36, 4, 'unread', 0, 1589235647, 1589235647),
(136, 111, 111, 1, 'كسوة فرد', 36, 4, 'unread', 0, 1589235647, 1589235647),
(137, 50, 100, 2, 'قيمة ثابته', 36, 14, 'unread', 0, 1589235647, 1589235647),
(138, 100, 400, 4, 'كسوة فردين', 36, 2, 'unread', 0, 1589235647, 1589235647),
(139, 60, 180, 3, 'مفتوح', 36, 10, 'unread', 0, 1589235647, 1589235647),
(140, 111, 111, 1, 'كسوة فرد', 37, 4, 'unread', 0, 1589321635, 1589321635),
(141, 50, 50, 1, '50 ريال', 38, 15, 'unread', 1, 1595336108, 1595336108),
(142, 50, 100, 2, '50 ريال', 39, 15, 'unread', 0, 1595336546, 1595336546),
(143, 50, 50, 1, '50 ريال', 40, 15, 'unread', 1, 1595336814, 1595336814),
(144, 50, 300, 6, 'قيمة ثابته', 41, 15, 'unread', 0, 1595338863, 1595338863),
(145, 111, 111, 1, 'كسوة فرد', 42, 4, 'unread', 0, 1595946958, 1595946958),
(146, 111, 111, 1, 'كسوة فرد', 43, 4, 'unread', 1, 1595947086, 1595947086),
(147, 2, 2, 1, 'مفتوح', 44, 12, 'unread', 0, 1595947131, 1595947131),
(148, 450, 450, 1, 'اضحية', 45, 1, 'unread', 1, 1596031343, 1596031343),
(149, 111, 111, 1, 'كسوة فرد', 46, 4, 'unread', 1, 1596625952, 1596625952),
(150, 111, 111, 1, 'كسوة فرد', 47, 4, 'unread', 0, 1598876677, 1598876677);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(15) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_confirmed` enum('yes','no') DEFAULT 'no',
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `mobile`, `full_name`, `email`, `mobile_confirmed`, `status`, `modified_date`, `create_date`) VALUES
(1, '+966 5 97767751', 'Ahmed Elmahdy', '', 'yes', 1, 1585822230, 1583237268),
(2, '+966 53 9776775', 'Ahmed Elmahdy', NULL, 'no', 0, 1583237404, 1583237404),
(3, '+966 54 9776775', 'Ahmed Elmahdy', NULL, 'no', 1, 1583237678, 1583237678),
(4, '+966 05 9776776', 'Ahmed Elmahdy', NULL, 'yes', 0, 1583237822, 1583237822),
(5, '+966 55 5555555', 'Ahmed Elmahdy', NULL, 'no', 0, 1583237995, 1583237995),
(6, '+966 05 9776771', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238085, 1583238085),
(7, '+966 05 9776772', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238276, 1583238276),
(8, '+966 05 9776755', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238315, 1583238315),
(9, '+966 05 9776779', 'Ahmed Elmahdy', NULL, 'yes', 1, 1583415420, 1583415420),
(10, '0597767751', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 2, 1583675359, 1583673484),
(11, '0597767751', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'no', 2, 1583677328, 1583677328),
(12, '+966597767751', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1586507399, 1585503924),
(13, '+966 05 1111111', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1585514668, 1585514668),
(14, '+966 05 9771111', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1585742576, 1585742576),
(15, '+966 05 9776775', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 0, 1585930195, 1585930195),
(16, '+966 50 5977677', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1586353337, 1586353337),
(17, '+966597767751', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1586807632, 1586723071),
(18, '+966505977677', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'yes', 1, 1586859538, 1586859538);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `permissions` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `permissions`, `status`, `create_date`, `modified_date`) VALUES
(1, 'الإدارة', 'مجموعه تملك كافة الصلاحيات', '{\"admin_login\":{\"view\":\"1\"},\"Contacts\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donations\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donors\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Menus\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Messagings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Orders\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Paymentmethods\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projectcategories\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projects\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projecttags\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Reports\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Slides\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Statuses\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Stores\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', 1, 1543493061, 1597672872),
(2, 'الاشراف', 'مجموعة تملك صلاحيات التعديل والاضافة والعرض', '{\"admin_login\":{\"view\":\"1\"},\"Groups\":{\"index\":\"1\",\"add\":\"1\"},\"Users\":{\"index\":\"1\",\"add\":\"1\"}}', 1, 1543746264, 1544079169),
(3, 'المراقبين', '', '{\"admin_login\":{\"view\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"}}', 1, 1549259804, 1572870120);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` enum('static','dynamic') DEFAULT 'static',
  `arrangement` int(11) DEFAULT NULL,
  `position` enum('main','footer') DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `name`, `alias`, `url`, `type`, `arrangement`, `position`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الاقسام', 'الاقسام', '/projectCategories', 'dynamic', 100, NULL, 1, 1583936653, 1583936128);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_identifier` bigint(15) NOT NULL,
  `total` bigint(20) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `payment_method_id` int(11) NOT NULL,
  `payment_method_key` varchar(50) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `banktransferproof` varchar(255) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT 0,
  `gift_data` mediumtext DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `projects_id` varchar(255) DEFAULT NULL,
  `donor_id` int(11) NOT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `API_status` enum('read','unread','updated') NOT NULL DEFAULT 'unread',
  `status_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `donor_id` (`donor_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `store_id` (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_identifier`, `total`, `quantity`, `payment_method_id`, `payment_method_key`, `hash`, `banktransferproof`, `gift`, `gift_data`, `meta`, `projects`, `projects_id`, `donor_id`, `store_id`, `API_status`, `status_id`, `status`, `modified_date`, `create_date`) VALUES
(1, 1007077117, 150, 3, 3, 'ahly', NULL, 'image_b8e27.jpeg', 0, NULL, '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', NULL, NULL, 12, NULL, 'read', 4, 1, 1595945867, 1587077117),
(2, 1008115805, 111, 1, 1, NULL, NULL, '', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '(4),(2),(3)', 18, NULL, 'read', 0, 1, 1595931729, 1588115805),
(3, 1008115843, 111, 1, 1, NULL, NULL, '', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '(4),(3),(9),(6),(1)', 18, NULL, 'read', 4, 1, 1595944632, 1588115843),
(4, 1008115914, 111, 1, 1, NULL, NULL, '', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '(8),(11),(6),(3),(4),(10),(2),(15),(19)', 18, NULL, 'read', 0, 1, 1595944669, 1588115914),
(5, 1008116027, 111, 1, 2, NULL, NULL, 'image_aa344.jpeg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, NULL, '(2),(4),(10),(3)', 18, NULL, 'read', 3, 1, 1595945803, 1588116027),
(6, 1008116314, 1111, 1, 1, NULL, NULL, 'image_a0769.jpg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, NULL, NULL, 18, NULL, 'read', 4, 1, 1588116324, 1588116314),
(7, 1008118105, 222, 0, 1, NULL, NULL, '', 0, '', NULL, NULL, NULL, 18, NULL, 'read', 0, 1, 1588118116, 1588118105),
(8, 1008118165, 150, 0, 1, NULL, NULL, '', 0, '', NULL, NULL, NULL, 18, NULL, 'read', 0, 1, 1588118174, 1588118165),
(9, 1008118241, 200, 0, 1, NULL, NULL, '', 0, '', NULL, NULL, NULL, 18, NULL, 'read', 4, 1, 1588118253, 1588118241),
(10, 1008118290, 150, 0, 1, NULL, NULL, 'image_c4900.jpg', 0, '', NULL, NULL, '(3)', 18, NULL, 'read', 3, 1, 1588118302, 1588118290),
(11, 1008245908, 100, 0, 1, NULL, NULL, 'image_0f004.jpg', 0, '', NULL, NULL, '(10)', 18, NULL, 'read', 4, 1, 1595945716, 1588245908),
(12, 1008246062, 211, 0, 1, NULL, NULL, 'image_3a335.jpg', 0, '', NULL, NULL, '(4)', 18, NULL, 'read', 1, 1, 1588246127, 1588246062),
(13, 1008246232, 111, 0, 1, NULL, NULL, '', 0, '', NULL, NULL, '(14),(3),(2),(10),(4),(15),(11),(1)', 18, NULL, 'read', 2, 1, 1588246256, 1588246232),
(14, 1008983540, 111, 1, 1, NULL, '9747e2ba4295498fee6cc2ac83a1ad0ad3923535', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'unread', 0, 2, 1588983540, 1588983540),
(15, 1008984352, 111, 1, 1, NULL, 'd74010972b3674a5b43f72d1df4a212e58edf878', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'unread', 0, 2, 1588984352, 1588984352),
(16, 1008984420, 111, 1, 1, NULL, 'ab8db8a9212a46f1f564d1050743584bdd2e59c6', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'unread', 0, 2, 1588984420, 1588984420),
(17, 1008984504, 111, 1, 1, NULL, '5fbd58c3206033f7b63c55d720331c4e467cfb0d', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588984504, 1588984504),
(18, 1008985165, 111, 1, 1, NULL, '0b141b9a81b938d4b11848a784242b1f0f93a8f5', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 3, 1588985165, 1588985165),
(19, 1008985280, 111, 1, 1, NULL, '886626d424a78ec816036e3f285ad25674aedd3a', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 3, 1588985280, 1588985280),
(20, 1008985293, 111, 1, 1, NULL, '8506db2a0562049acf18d67e828001c7444fb1fa', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588985293, 1588985293),
(21, 1008985353, 111, 1, 1, NULL, '7aad471917ff4eaf38ad92abab6f6a8087672864', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 4, 1588985353, 1588985353),
(22, 1008985372, 111, 1, 1, NULL, 'e19f812c4271feb28f34326d6150b8a98176ff22', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588985372, 1588985372),
(23, 1008985385, 111, 1, 1, NULL, '498bfd984d7d443552d118021d135ce2dc7bc7b0', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 3, 1588985385, 1588985385),
(24, 1008985704, 111, 1, 1, NULL, '8f1df198b4acca15edf1e3cbfb6337b8a9430a56', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 4, 1588985704, 1588985704),
(25, 1008986093, 111, 1, 1, NULL, 'd6c439b44b3bdd08b90b61f3687a535526794510', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588986093, 1588986093),
(26, 1008986251, 111, 1, 1, NULL, '4ff82d31a7dfad4843d364b50d8a167e7ca4d310', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588986251, 1588986251),
(27, 1008986703, 111, 1, 1, NULL, '1b26f99d4312e0e2413c4df1f570fe300d771757', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 3, 1588986703, 1588986703),
(28, 1008986724, 111, 1, 1, NULL, '5bb659d212ebe09960640e89b30a540f684df85b', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588986724, 1588986724),
(29, 1008988779, 111, 1, 1, NULL, 'ada4adfd766bf1e9a0dde47e5b6d55303905a18a', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 0, 0, 1588988779, 1588988779),
(30, 1008988810, 111, 1, 3, NULL, NULL, NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"3248ce140a07f293980641ada9742c389944998bbe5b549bd65bfd751f3ca5db\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"2098352507\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 'الحالات الطارئة4', '(4)', 12, NULL, 'read', 4, 1, 1589059308, 1588988810),
(31, 1009044497, 633, 7, 3, NULL, '8938b62cea26343f0d6adb2d7c64d3967e972a6a', NULL, 0, '', NULL, 'الحالات الطارئة4,كفارة اليمين..,كسوة الشتاء,كفارة اليمين..', '(4),(3),(2),(14)', 12, NULL, 'read', 0, 4, 1589044497, 1589044497),
(32, 1009044640, 633, 7, 3, NULL, '507abdc16cb219aa9a34250d0309109edba75ddc', NULL, 0, '', NULL, 'الحالات الطارئة4,كفارة اليمين..,كسوة الشتاء,كفارة اليمين..', '(4),(3),(2),(14)', 12, NULL, 'read', 0, 0, 1589044640, 1589044640),
(33, 1009045295, 633, 7, 3, NULL, NULL, NULL, 0, '', '{\"amount\":\"63300\",\"response_code\":\"00072\",\"signature\":\"8958e9d201f67359b54357d45a975b85140944d77a10b2d19f5bf22d957a7506\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1345624056\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 'الحالات الطارئة4,كفارة اليمين..,كسوة الشتاء,كفارة اليمين..', '(4),(3),(2),(14)', 12, NULL, 'read', 0, 3, 1589046020, 1589045295),
(34, 1009049845, 272, 2, 1, NULL, NULL, 'image_76301.jpg', 0, '', NULL, 'كفارة اليمين..,ضضضضضضضضضضضض', '(3),(10)', 12, NULL, 'read', 4, 0, 1589059226, 1589049845),
(35, 1009229462, 472, 8, 3, NULL, NULL, NULL, 0, '', '{\"amount\":\"47200\",\"response_code\":\"00072\",\"signature\":\"666f2aeb17a13456dfa90a4cf356acce282b616e33001c9e9eb70ca8de210328\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1863532910\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 'كفارة اليمين..,كسوة الشتاء,كفارة اليمين..,الحالات الطارئة4,كفارة اليمين..', '(15),(2),(15),(4),(3)', 12, NULL, 'read', 0, 0, 1589229474, 1589229462),
(36, 1009235647, 824, 13, 1, NULL, NULL, 'image_77339.jpg', 0, '', NULL, 'الحالات الطارئة4,الحالات الطارئة4,كفارة اليمين..,كسوة الشتاء,ضضضضضضضضضضضض', '(4),(4),(14),(2),(10)', 18, NULL, 'read', 0, 0, 1589235655, 1589235647),
(37, 1009321635, 111, 1, 3, NULL, NULL, NULL, 0, '', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"355a61b18d36cda634bce7f2886312a54532df7d10d7358fb27496c1fbc3bcd8\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1203257855\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 'الحالات الطارئة4', '(4)', 18, NULL, 'read', 0, 0, 1589321644, 1589321635),
(38, 1015336108, 50, 1, 1, NULL, 'e2a7cf84ff928f52091bd37988217fc98fa16592', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'كفارة اليمين..', '(15)', 10, NULL, 'unread', 4, 1, 1595336194, 1595336108),
(39, 1015336546, 100, 2, 1, NULL, 'e1a1048d3b686d36c60c36102b5d4c8679db3134', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'كفارة اليمين..', '(15)', 10, NULL, 'unread', 4, 0, 1595336560, 1595336546),
(40, 1015336814, 50, 1, 1, NULL, '2906fd1cbfd366102017c983fec2bddccc570c68', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'كفارة اليمين..', '(15)', 10, NULL, 'unread', 4, 1, 1595336823, 1595336814),
(41, 1015338863, 300, 6, 1, NULL, 'aa74b905c130b54769413e29357cb6f5bd72b753', NULL, 0, '', NULL, 'كفارة اليمين..', '(15)', 10, NULL, 'unread', 4, 0, 1595339883, 1595338863),
(42, 1015946958, 111, 1, 2, NULL, '36f279f4c70c281eee482c58921b0b457341d3b4', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 10, NULL, 'unread', 0, 0, 1595946958, 1595946958),
(43, 1015947086, 111, 1, 2, 'branch', '338697f1064e1c35c45186f874d4a2b7d7a2a8f4', NULL, 0, '', NULL, 'الحالات الطارئة4', '(4)', 10, 4, 'unread', 0, 1, 1595947086, 1595947086),
(44, 1015947131, 2, 1, 4, 'payOnRecive', '21e398c08416a49883dcfa6e021cfe78cbcfaa20', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'اقسام المشروعات اضافة قسم جديد', '(12)', 10, NULL, 'unread', 0, 0, 1595947131, 1595947131),
(45, 1016031343, 450, 1, 1, 'rajhi', NULL, NULL, 0, '', NULL, 'حالة طارئة    17', '(1)', 10, 4, 'unread', 0, 1, 1596031354, 1596031343),
(46, 1016625952, 111, 1, 1, 'rajhi', NULL, 'image_d1a8b.jpg', 0, '', NULL, 'الحالات الطارئة4', '(4)', 10, 4, 'unread', 0, 1, 1596625990, 1596625952),
(47, 1018876677, 111, 1, 1, 'rajhi', NULL, 'image_6f84b.jpg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 'الحالات الطارئة4', '(4)', 10, NULL, 'unread', 0, 0, 1598876688, 1598876677);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `alias`, `content`, `image`, `meta_keywords`, `meta_description`, `hits`, `status`, `create_date`, `modified_date`) VALUES
(1, 'عنا', 'عنا', '<p>Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n\r\n<p style=\"text-align:justify;\">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read MoreFilm festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p style=\"text-align:justify;\"><span style=\"color:#3498db;\">Film festivals used to be do-or-die moments for movie makers</span></p>\r\n	</li>\r\n	<li>\r\n	<p>. They were where you met the producers that could fund your project,</p>\r\n	</li>\r\n	<li>\r\n	<p>and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>123,456,789,</p>\r\n', 'unnamed2.gif', 'Film festivals,to be do-or-die,movie makers', 'Film festivals used to be do-or-die moments for movie makers', NULL, 1, 1543733978, 1585512822),
(2, 'سياسة الاستخدام', NULL, '<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p> </p>\r\n', '', 'سياسة الاستخدام,سياسة الاستخدام,سياسة الاستخدام,سياسة الاستخدام', 'سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام', NULL, 1, 1548935358, 1583933060),
(3, 'قرطاسية', NULL, '<p><img alt=\"\" src=\"http://localhost/BerTraif/media/images/4853.jpg\" style=\"height:520px;width:449px;\" /></p>\r\n', 'thuma6e_13.png', '', '', NULL, 2, 1572266239, 1572266239),
(4, '', NULL, NULL, '', '', '', NULL, 2, 1572266245, 1572266245),
(5, 'rrtrt', NULL, NULL, '0025.jpg', '', '', NULL, 2, 1572351131, 1572356316),
(6, 'سياسة الخصوصية', NULL, '<p style=\"text-align:center;\">سياسة الخصوصية</p>\r\n', '', '', '', NULL, 1, 1573390923, 1574337169),
(7, 'فريق العمل', 'فريق-العمل', '<div class=\"youtube-embed-wrapper\" style=\"height:0;padding-bottom:56.25%;padding-top:30px;\"><iframe frameborder=\"0\" height=\"360\" src=\"https://www.youtube.com/embed/ipUznKIhHrg?rel=0&amp;controls=0\" width=\"640\"></iframe>\r\n<div class=\"youtube-embed-wrapper\" style=\"height:0;padding-bottom:56.25%;padding-top:30px;\"><iframe frameborder=\"0\" height=\"360\" src=\"https://www.youtube.com/embed/F4KD5u-xkik?rel=0\" style=\"width:100%;height:100%;\" width=\"640\"></iframe></div>\r\n<iframe frameborder=\"0\" height=\"360\" src=\"https://www.youtube.com/embed/ipUznKIhHrg?rel=0\" width=\"640\"></iframe></div>\r\n\r\n<p> </p>\r\n', 'thuma6e_5.png', '', '', NULL, 1, 1578984687, 1585572558);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `payment_key` varchar(50) DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cart_show` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_id`, `title`, `content`, `payment_key`, `meta`, `image`, `cart_show`, `status`, `create_date`, `modified_date`) VALUES
(1, 'التحويل البنكي', NULL, '', '{\"bank1\":{\"bankname\":\"\\u0627\\u0644\\u0631\\u0627\\u062c\\u062d\\u064a\",\"account_type\":\"\\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u0632\\u0643\\u0627\\u0629\",\"iban\":\"46549784348676465789\",\"payment_key\":\"rajhi\",\"url\":\"https:\\/\\/namaa.sa\\/product\"},\"bank2\":{\"bankname\":\"\\u0627\\u0644\\u0627\\u0647\\u0644\\u064a\",\"account_type\":\"\\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u0635\\u062f\\u0642\\u0629\",\"iban\":\"223333332222222222222\",\"payment_key\":\"ahly\",\"url\":\"https:\\/\\/namaa.sa\\/product\"}}', 'thuma6e_6.png', 1, 1, 0, 1595771705),
(2, 'الدفع من خلال فروعنا', '<p>سوف يتم التواصل من خلال مندوبنا خلال 24 ساعه لتحديد الوقت المناسب لاستلام المبلغ</p>\r\n', 'branch', '{\"branch1\":{\"branchname\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0631\\u0639\\t\",\"address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"url\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0639\\u0644\\u064a \\u062e\\u0631\\u0627\\u0626\\u0637 \\u062c\\u0648\\u062c\\u0644\\t\"},\"branch2\":{\"branchname\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0631\\u0639\\t2\",\"address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u06462\",\"url\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0639\\u0644\\u064a \\u062e\\u0631\\u0627\\u0626\\u0637 \\u062c\\u0648\\u062c\\u0644\\t2\"},\"branch3\":{\"branchname\":\"\",\"address\":\"\",\"url\":\"\"},\"branch4\":{\"branchname\":\"\",\"address\":\"\",\"url\":\"\"}}', 'thuma6e_13.png', 1, 1, 1573652572, 1595946916),
(3, 'بطاقة الأئتمان', NULL, 'visa', 'null', 'v-24-512.png', 1, 1, 1573739801, 1595946898),
(4, 'الدفع عند الاستلام', '<p style=\"text-align:center;\">سيتم تحصيل الرسوم عندس تسليم الهدية</p>\r\n', 'payOnRecive', 'null', '345.png', 1, 0, 1574663247, 1595769856);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `project_number` varchar(255) DEFAULT '" "',
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `arrangement` int(11) DEFAULT NULL,
  `back_home` tinyint(1) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `secondary_image` varchar(255) DEFAULT NULL,
  `enable_cart` tinyint(1) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT 0,
  `mobile_confirmation` tinyint(1) DEFAULT NULL,
  `donation_type` text DEFAULT NULL,
  `payment_methods` varchar(255) DEFAULT NULL,
  `target_price` int(11) DEFAULT NULL,
  `target_unit` varchar(100) DEFAULT NULL,
  `unit_price` bigint(20) DEFAULT NULL,
  `fake_target` int(11) DEFAULT NULL,
  `collected_traget` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `thanks_message` text DEFAULT NULL,
  `sms_msg` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `advertising_code` text DEFAULT NULL,
  `header_code` text DEFAULT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `finished` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `name`, `alias`, `project_number`, `description`, `category_id`, `arrangement`, `back_home`, `image`, `secondary_image`, `enable_cart`, `gift`, `mobile_confirmation`, `donation_type`, `payment_methods`, `target_price`, `target_unit`, `unit_price`, `fake_target`, `collected_traget`, `start_date`, `end_date`, `hidden`, `hits`, `thanks_message`, `sms_msg`, `mobile`, `whatsapp`, `advertising_code`, `header_code`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `finished`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'حالة طارئة    17', 'حالة-طارئة----17', 'SOS-00307', '<p>أرملة  ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال  بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n', 1, 1, 0, '345_2.png', 'image_07bdc.jpg', 1, 0, 0, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0627\\u0636\\u062d\\u064a\\u0629\",\"value\":\"450\"},\"item2\":{\"name\":\"\\u0641\\u062f\\u064a\\u0629\",\"value\":\"400\"}}}', '[\"2\",\"1\"]', 1000000, '', 0, 0, NULL, 0, 2145906000, 0, NULL, 'تم الارسال .. وطلبكم الآن قيد المراجعة .. وسوف يتم ارسال رسالة نصية فور تأكيد الطلب .. \r\nشكرا جزيلاً لكم ..  بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nجمعية نماء بمنطقة مكة المكرمة ..', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '1111111111', '1111111111', '', '', '', NULL, '', '', 0, 1, 1, 1591622744, NULL),
(2, 'كسوة الشتاء', 'كسوة-الشتاء', '', '<p><strong>فكرة المشروع :</strong></p>\r\n\r\n<p>تأمين مستلزمات الشتاء الأساسية من بطانيات ودفايات التي لا يستغنى عنـها في أي منزل نتيجة لبرودة الجو .</p>\r\n\r\n<p><strong>أهمية المشروع :</strong></p>\r\n\r\n<p>تكمن أهمية المشروع في :</p>\r\n\r\n<ul>\r\n	<li>- عدم استطاعة الفقراء دفع تكاليف مستلزمات الشتاء .</li>\r\n	<li>- تخفيف معاناة برودة الجو القارس على الفقراء .</li>\r\n</ul>\r\n\r\n<p><strong>أهداف المشروع :</strong></p>\r\n\r\n<ul>\r\n	<li>- رفع معاناة الأسر الفقيرة المسجلة لدى الفرع وسد احتياجاتها .</li>\r\n	<li>- إيجاد طرق سهلة للمحسن للتبرع الدائم .</li>\r\n	<li>- إيجاد حلول عملية واقعية لرفع معاناة الفقير والمحتاج والعاطل .</li>\r\n	<li>- تحقيق التكافل الاجتماعي بين أفراد المجتمع .</li>\r\n	<li>- فتح باب المشاركة للمؤسسات التجارية المتخصصة وفاعلي الخير .</li>\r\n</ul>\r\n', 1, 100, 1, '345_18.png', '91ddb8751920595dfde2515820730482.gif', 1, 0, 1, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\",\"value\":\"50\"},\"item2\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0646\",\"value\":\"100\"},\"item3\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0627\\u0633\\u0631\\u0629\",\"value\":\"200\"}}}', '[\"3\",\"2\",\"1\"]', 150000, 'ذبيحة', 100, 0, NULL, 0, 2145906000, 0, NULL, 'شكرا لدعمكم', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '597767751', '597767751', 'كود التتبع الاعلاني :', 'كود الهيدر :', 'rgba(255,33,17,1)', 'pic1521704669_11.png', 'مستلزمات الشتاء الأساسية,كسوة الشتاء', 'وصف مختصر لمحرك البحث', NULL, 1, 1, 1585927917, 1574238278),
(3, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 3, 1, '[&#34;skyscraper-scaled.jpg&#34;,&#34;345.png&#34;]', 'image_37ae5.jpg', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 1000, 'ذبيحة', 50, 0, 2000, 0, 2145906000, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', NULL, 1, 1, 1585927999, 1574249492),
(4, 'الحالات الطارئة4', 'الحالات-الطارئة4', 'SOS-00307', '<p style=\"text-align:center;\">الحالات الطارئة4</p>\r\n\r\n<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 1, 0, 0, '[&#34;pic1521704669.png&#34;,&#34;default.jpg&#34;,&#34;345.png&#34;]', '', 1, 1, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\",\"value\":\"111\"},\"item2\":{\"name\":\"\\u0641\\u062f\\u064a\\u0629\",\"value\":\"11\"}}}', '[\"4\",\"3\",\"2\",\"1\"]', 10000, 'ذبيحة', 100, 20, NULL, 0, 2145906000, 0, NULL, 'شكرا لتبرعك للحاللت الطارئة شكرا لتبرعك للحاللت الطارئة شكرا لتبرعك للحاللت الطارئة', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 0, 1, 1, 1591577054, 1574249556),
(5, 'qqqqqq', 'qqqqqq', ' ', '<p>أرملة  ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال  بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n', 2, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 0, 1576492983, 1576492983),
(6, 'qqqqqq', 'qqqqqq', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 11, 0, '', '', 0, 0, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0633\\u0647\\u0645\",\"value\":\"11\"},\"item2\":{\"name\":\"\\u0633\\u0647\\u06452\",\"value\":\"111\"},\"item3\":{\"name\":\"\\u0633\\u0647\\u06453\",\"value\":\"1111\"}}}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 0, 1584968728, 1576493017),
(7, 'qqqqqq', 'qqqqqq', ' ', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 0, 1576493226, 1576493226),
(8, 'المشروع', '-المشروع', ' ', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 10, 0, '', 'inside- 3_4.jpg', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 0, 1579689776, 1576493238),
(9, 'qqqqqq', 'qqqqqq', '', '<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق. لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n', 2, 111, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585505116, 1576496602),
(10, 'ضضضضضضضضضضضض', 'ضضضضضضضضضضضض', '', '<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n\r\n<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n', 1, 34, 0, '', '', 1, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585505107, 1576496713),
(11, 'كفارة اليمين..1212', 'كفارة-اليمين--1212', '23123123', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 23, 0, '', '', 0, 1, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0633\\u0647\\u0645\",\"value\":\"11\"},\"item2\":{\"name\":\"\\u0633\\u0647\\u06452\",\"value\":\"111\"},\"item3\":{\"name\":\"\\u0633\\u0647\\u06453\",\"value\":\"1111\"}}}', '[\"4\",\"3\",\"2\",\"1\"]', 0, '', 0, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585694517, 1584359855),
(12, 'اقسام المشروعات اضافة قسم جديد', 'اقسام-المشروعات-اضافة-قسم-جديد', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 3, 0, 0, '', '', 0, 1, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1584951378, 1584448618),
(13, 'اقسام المشروعات اضافة قسم جديد', 'اقسام-المشروعات-اضافة-قسم-جديد', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 222, 0, '', '', 0, 1, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, '', 0, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585694505, 1584951577),
(14, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 333, 1, '[skyscraper-scaled.jpg,345.png]', '', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', NULL, 1, 1, 1584951604, 1584951604),
(15, 'كفارة اليمين..', 'كفارة-اليمين--', 'SOS-00307', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 11, 1, '', 'inside- 3_14.jpg', 1, 1, 0, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 10000, 'ذبيحة', 50, 0, NULL, 0, 2145906000, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 0, 1, 1, 1595338835, 1584952182),
(16, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 145, 1, '', 'inside- 3_14.jpg', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, NULL, NULL, 0, NULL, 0, 2145906000, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', NULL, 1, 1, 1585228556, 1585228556),
(17, 'كفارة اليمين1', 'كفارة-اليمين1', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\",\"3\"]', 1400000, 'ذبيحة1', 100, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585694213, 1585665401),
(18, 'كفارة اليمين', 'كفارة-اليمين', '23123123', NULL, 4, 111, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"3\"]', 0, '', 0, 0, NULL, 0, 2145906000, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', NULL, 1, 1, 1585694575, 1585694551),
(19, 'صدقه', 'صدقه', 'SOS-00307', '<p>ششش</p>\r\n', 4, 111, 0, 'inside- 3.jpg', 'No file was uploaded', 0, 1, 0, '{\"type\":\"open\"}', '[\"3\"]', 0, '', 0, 0, NULL, 0, 2145906000, 1, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', 'No file was uploaded', '', '', 1, 1, 1, 1591224831, 1585915073),
(20, 'فطرتي لمن يستحقها222sss', 'فطرتي-لمن-يستحقها222sss', 'SOS-00307', NULL, 7, 0, 0, '', 'No file was uploaded', 0, 0, 0, '{\"type\":\"fixed\",\"value\":\"100\"}', '[\"4\"]', 0, '', 0, 0, NULL, 0, 2145906000, 0, NULL, '', '', '', '', '', '', '', 'No file was uploaded', '', '', 1, 0, 1, 1591576345, 1591576345),
(21, 'فطرتي لمن يستحقها222sss', 'فطرتي-لمن-يستحقها222sss', 'SOS-00307', NULL, 2, 0, 1, 'inside- 3_4.jpg', 'image_dac7c.jpg', 0, 0, 0, '{\"type\":\"fixed\",\"value\":\"100\"}', '[\"4\"]', 0, '', 0, 0, NULL, 0, 2145906000, 0, NULL, '', '', '', '', '', '', '', 'No file was uploaded', '', '', 0, 1, 1, 1591583864, 1591576411);

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
CREATE TABLE IF NOT EXISTS `project_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `level` int(11) DEFAULT NULL,
  `arrangement` int(11) DEFAULT NULL,
  `back_home` tinyint(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`category_id`, `name`, `alias`, `description`, `parent_id`, `level`, `arrangement`, `back_home`, `image`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الحالات الطارئة', 'Unayzah', 'عطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 4, 4, 100, 1, 'section.png', '', '', '', '', 1, 1, 1579521941, 1573998457),
(2, 'الكفارات', 'الحالات-الطارئة', 'فكرة المشروع : تأمين مستلزمات الشتاء الأساسية من بطانيات ودفايات التي لا يستغنى عنـها في أي منزل .\r\n\r\nعطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 0, 1, 100, 1, 'section-1.png', '', '', 'الحالات الطارئة,تبرع,كفالة', 'عطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 1, 1, 1579524690, 1573998549),
(3, 'إبدأها بصدقة', 'إبدأها-بصدقة', 'اشتريت سيارة جديدة؟ رزقت بمولود؟ بدأت مشروع جديد؟ بدأت عملك الجديد ؟ ما رأيك أن تبدأ كل جديد ، بصدقة ستسعدك أكيد', 2, 2, 0, 1, 'inside- 3.jpg', '', '', '', '', 1, 1, 1579522051, 1579522051),
(4, 'كفارة', 'كفارة-', '', 3, 3, 0, 0, '', '', '', '', '', 0, 1, 1585678298, 1585678298),
(5, 'الحالات الطارئة6', 'الحالات-الطارئة6', '', 0, 1, 0, 0, '', '', '', '', '', 0, 1, 1585684659, 1585684558),
(6, 'كفارة اليمين3', 'كفارة-اليمين3', '', 2, 2, 0, 0, '', '', '', '', '', 0, 1, 1585684760, 1585684746),
(7, 'كفارة اليمين8', 'كفارة-اليمين8', '', 0, 1, 0, 0, '', '', '', '', '', 0, 1, 1585684838, 1585684815);

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

DROP TABLE IF EXISTS `project_tags`;
CREATE TABLE IF NOT EXISTS `project_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `arrangement` int(11) DEFAULT NULL,
  `back_home` tinyint(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`tag_id`, `name`, `alias`, `description`, `arrangement`, `back_home`, `image`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الأكثر طلباً', 'الأكثر-طلبا', 'تجد هنا المشروعات الاكثر طلبا', 100, 1, 'thuma6e_9.png', '', '', '', '', 1, 1, 1575450678, 1575381344),
(2, 'جديد', 'جديد', '', 0, 0, '', '', '', '', '', 0, 1, 1575457921, 1575457921),
(3, 'كفارة اليمين', 'كفارة-اليمين', '', 0, 0, '', '', '', '', '', 0, 1, 1587317180, 1587317180),
(4, 'كسوة الشتاء', 'كسوة-الشتاء', '', 0, 0, '', '', '', '', '', 0, 1, 1587317185, 1587317185),
(5, 'Ahmed', 'Ahmed', '', 0, 0, '', '', '', '', '', 0, 1, 1587317194, 1587317194);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `value` mediumtext DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `title`, `alias`, `value`, `create_date`, `modified_date`) VALUES
(1, 'الاعدادات العامة', 'site', '{\"title\":\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0646\\u0645\\u0627\\u0621 \\u0627\\u0644\\u0623\\u0647\\u0644\\u064a\\u0629 \\u0628\\u0645\\u0646\\u0637\\u0642\\u0629 \\u0645\\u0643\\u0629 \\u0627\\u0644\\u0645\\u0643\\u0631\\u0645\\u0629\",\"logo\":\"namaa-logo.png\",\"header_code\":\"\",\"footer_code\":\"\",\"show_banner\":\"1\",\"mobile_validation\":\"0\",\"show_projects\":\"1\",\"project_text\":\"\\u0645\\u0634\\u0631\\u0648\\u0639\\u0627\\u062a \\u0648\\u0628\\u0631\\u0627\\u0645\\u062c \\u062e\\u064a\\u0631\\u064a\\u0629 \",\"enableTages\":\"1\",\"show_categories\":\"1\",\"category_text\":\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645 \",\"show_bottom\":\"1\",\"show_footer\":\"1\",\"bootom\":\"<p style=\\\"text-align:center;\\\"><img alt=\\\"\\\" class=\\\"img-fluid\\\" src=\\\"https:\\/\\/7ololnet.com\\/namaa\\/media\\/images\\/1111111111.png\\\" \\/><\\/p>\\r\\n\"}', 1583845973, 1589234381),
(2, 'اعدادات بيانات التواصل', 'contact', '{\"phone\":\"0597767751\",\"phone2\":\"0597767751\",\"mobile\":\"0597767751\",\"mobile2\":\"0597767751\",\"fax\":\"0597767751\",\"address\":\"\\u062c\\u062f\\u0629 \\u062d\\u064a \\u0627\\u0644\\u0646\\u0639\\u064a\\u0645\",\"email\":\"namaa@namaa.sa\",\"map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m13!1m8!1m3!1d3710.8054150744156!2d39.1637415!3d21.5544626!3m2!1i1024!2i768!4f13.1!3m2!1m1!2sNamaa!5e0!3m2!1sar!2ssa!4v1583928833064!5m2!1sar!2ssa\"}', 1583845973, 1586350008),
(3, 'اعدادات الارشفة', 'seo', '{\"meta_keywords\":\"\",\"meta_description\":\"\"}', 1583845973, 1583916715),
(4, 'اعدادات مواقع التواصل الاجتماعي', 'social', '{\"facebook\":\"\",\"twitter\":\"\",\"instagram\":\"\",\"linkedin\":\"\",\"youtube\":\"\"}', 1583845973, 1584360023),
(5, 'اعدادات البريد الالكتروني', 'email', '{\"contacts_email\":\"\",\"donation_email\":\"donation@namaa.com\",\"sending_email\":\"donation@namaa.com\",\"sending_name\":\"\\u0645\\u062a\\u062c\\u0631 \\u0646\\u0645\\u0627\\u0621 \\u0627\\u0644\\u062e\\u064a\\u0631\\u064a\"}', 1583845973, 1588985382),
(6, 'اعدادات رسائل SMS', 'sms', '{\"gateurl\":\"http:\\/\\/www.oursms.net\\/api\\/sendsms.php\",\"sms_username\":\"namaa\",\"sender_name\":\"Namaa.sa\",\"sms_password\":\"147147\",\"smsenabled\":\"0\"}', 1583845973, 1595338690),
(7, 'اعدادات التصميم', 'theme', '{\"background_color\":\"\",\"background_image\":\"\",\"banner_image\":\"BB01.jpg\",\"banner_image_url\":\"#1\",\"projects_image\":\"BB02.jpg\",\"projects_image_url\":\"#2\",\"categories_image\":\"BB03.jpg\",\"categories_image_url\":\"#3\",\"categories_image2\":\"BB01.jpg\",\"categories_image2_url\":\"#4\",\"categories_image3\":\"BB02.jpg\",\"categories_image3_url\":\"#5\",\"bootom\":null}', 1583845975, 1585570246),
(8, 'الاهداء الخيري', 'gift', '{\"rowrowrowrowrowrowrowrow2\":{\"name\":\"qweqweqw\",\"image\":\"section.png\"},\"rowrowrowrowrowrowrowrow3\":{\"name\":\"2342\",\"image\":\"image_05acc.png\"},\"rowrow3\":{\"name\":\"\\u0627\\u0644\\u064a \\u0635\\u062f\\u0633\\u0642\\u0633\",\"image\":\"[&#34;thuma6e_2.png&#34;,&#34;thuma6e.png&#34;,&#34;skyscraper-scaled.jpg&#34;,&#34;section.png&#34;,&#34;image_37ae5.jpg&#34;,&#34;image_07bdc.jpg&#34;,&#34;91ddb8751920595dfde2515820730482.gif&#34;,&#34;345.png&#34;]\"},\"row4\":{\"name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0629 :\",\"image\":\"[&#34;345.png&#34;,&#34;111.png&#34;]\"}}', 1583845971, 1585938109),
(9, 'اعدادات الواجهة البرمجية API', 'api', '{\"api_user\":\"tarek\",\"api_key\":\"T@r3k2020\",\"api_enable\":\"1\"}', 1582972955, 1586997149),
(10, 'اعدادات التنبيهات', 'notifications', '{\"confirm_enabled\":\"0\",\"confirm_subject\":\"\\u0645\\u062a\\u062c\\u0631 \\u0646\\u0645\\u0627\\u0621 \\u0627\\u0644\\u062e\\u064a\\u0631\\u064a : \\u062a\\u0623\\u0643\\u064a\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628\",\"confirm_msg\":\"[[name]]\\r\\n \\u062a\\u0645 \\u062a\\u0623\\u0643\\u064a\\u062f \\u0637\\u0644\\u0628\\u0643\\u0645 \\u0631\\u0642\\u0645 [[identifier]] \\r\\n\\u0628\\u0645\\u0628\\u0644\\u063a [[total]] \\u0631\\u064a\\u0627\\u0644 \\r\\n\\u0641\\u064a \\u0645\\u0634\\u0631\\u0648\\u0639 [[project]] \\r\\n\\u0628\\u0627\\u0631\\u0643 \\u0627\\u0644\\u0644\\u0647 \\u0641\\u064a\\u0643\\u0645 \\u0648\\u0646\\u0641\\u0639\\u0646\\u0627 \\u0648\\u0623\\u064a\\u0627\\u0643\\u0645 \\u0648\\u062c\\u0639\\u0644\\u0647 \\u0641\\u064a \\u0645\\u064a\\u0632\\u0627\\u0646 \\u062d\\u0633\\u0646\\u0627\\u062a\\u0643\\u0645 \\r\\n\\u0643\\u0644 \\u0639\\u0627\\u0645 \\u0648\\u0627\\u0646\\u062a\\u0645 \\u0628\\u062e\\u064a\\u0631 \\u060c\\u060c\",\"inform_enabled\":\"0\",\"inform_subject\":\"\\u062a\\u0645 \\u0627\\u0633\\u062a\\u0644\\u0627\\u0645 \\u0637\\u0644\\u0628 \\u062a\\u0628\\u0631\\u0639\\u0643\\u0645\",\"inform_msg\":\"[[name]]\\r\\n  \\u062a\\u0645 \\u0627\\u0633\\u062a\\u0644\\u0627\\u0645 \\u0637\\u0644\\u0628\\u0643\\u0645 \\u0631\\u0642\\u0645 : [[identifier]]\\r\\n\\u0628\\u0645\\u0634\\u0631\\u0648\\u0639 : [[project]]\\r\\n\\u0628\\u0642\\u064a\\u0645\\u0629 : [[total]]  \\u0648\\u062c\\u0627\\u0631\\u064a \\u0645\\u0631\\u0627\\u062c\\u0639\\u0629 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0644\\u062a\\u0623\\u0643\\u064a\\u062f \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\r\\n\\u0634\\u0643\\u0631\\u0627 \\u062c\\u0632\\u064a\\u0644\\u0627\\u064b \\u0644\\u0643\\u0645 ..\\r\\n\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0646\\u0645\\u0627\\u0621 \\u0627\\u0644\\u0623\\u0647\\u0644\\u064a\\u0629 \\u0628\\u0645\\u0646\\u0637\\u0642\\u0629 \\u0645\\u0643\\u0629 \\u0627\\u0644\\u0645\\u0643\\u0631\\u0645\\u0629 ..\\r\\n\",\"confirm_sms\":\"0\",\"confirm_sms_msg\":\"[[name]]\\r\\n \\u062a\\u0645 \\u062a\\u0623\\u0643\\u064a\\u062f \\u0637\\u0644\\u0628\\u0643\\u0645 \\u0631\\u0642\\u0645 [[identifier]] \\r\\n\\u0628\\u0645\\u0628\\u0644\\u063a [[total]] \\u0631\\u064a\\u0627\\u0644 \\r\\n\\u0641\\u064a \\u0645\\u0634\\u0631\\u0648\\u0639 [[project]] \\r\\n\\u0628\\u0627\\u0631\\u0643 \\u0627\\u0644\\u0644\\u0647 \\u0641\\u064a\\u0643\\u0645 \\u0648\\u0646\\u0641\\u0639\\u0646\\u0627 \\u0648\\u0623\\u064a\\u0627\\u0643\\u0645 \\u0648\\u062c\\u0639\\u0644\\u0647 \\u0641\\u064a \\u0645\\u064a\\u0632\\u0627\\u0646 \\u062d\\u0633\\u0646\\u0627\\u062a\\u0643\\u0645 \\r\\n\\u0643\\u0644 \\u0639\\u0627\\u0645 \\u0648\\u0627\\u0646\\u062a\\u0645 \\u0628\\u062e\\u064a\\u0631 \\u060c\\u060c\"}', 1583845973, 1598179148);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `arrangement` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `name`, `alias`, `url`, `description`, `arrangement`, `image`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الحقيبة المدرسية', 'الحقيبة-المدرسية', '#', 'الحقيبة المدرسية', 111, 'skyscraper-scaled_11.jpg', 0, 1578552208, 1578492246),
(2, 'Unayzah', 'Unayzah', '/category/1', 'وصف الشريحة :', 29, '1920129_682699965177415_6946150248044097862_n_3.jpg', 0, 1578551278, 1578551278),
(3, 'لست بحاجة إلى الاستعراض بالسيارات والمنازل الفاخرة والرحلات وحتى الطائرات', '', '', 'لست بحاجة إلى الاستعراض بالسيارات والمنازل الفاخرة والرحلات وحتى الطائرات. أفضل أن يحصل قومي على بعض مما رزقته في هذه الحياة &#34;', 24, 'unnamed1.gif', 1, 1579174509, 1578551572),
(4, 'اقسام المشروعات اضافة قسم جديد', '', '', '', 0, 'skyscraper-scaled.jpg', 1, 1579174808, 1578572776);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `name`, `alias`, `description`, `status`, `modified_date`, `create_date`) VALUES
(1, 'تحت المراجعة', 'تحت-المراجعة', 'عرض التبرعات التي مازالت تحت المراجعة', 1, 1586273587, 1583404335),
(2, 'تم مراجعته', 'تم-مراجعته', '', 1, 1584273031, 1584273031),
(3, 'تم تأكيد التحويل', 'تم-تأكيد-التحويل', '', 1, 1584273045, 1584273045),
(4, 'في الانتظار', 'في-الانتظار', '', 1, 1584273058, 1584273058);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_image` varchar(255) NOT NULL,
  `employee_number` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `background_color` varchar(30) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`store_id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `alias`, `name`, `user`, `password`, `employee_name`, `employee_image`, `employee_number`, `details`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `status`, `modified_date`, `create_date`) VALUES
(1, 'elsharafya', 'الشرفية', 'ahmed', '$2y$10$VOtbbUO.tWi7BxNMuRmNhOXrobJGfocceS.G.vfInKQXTXp7x2eaO', 'Ahmed', 'default.jpg', '111', 'المملكة العربية السعودية\r\nجدة\r\nشارع الأمير محمد بن عبد العزيز ( التحلية )\r\nالهاتف:0552360000\r\nساعات العمل: من 8 - 4 من الأحد الي الخميس', '', NULL, '', '', 1, 1598444724, NULL),
(2, 'متجر_نماء_فرع_المحمدية', 'متجر نماء فرع المحمدية', 'a6e6s', '$2y$10$i/vrWLmAIvzQQVqiWtEOfumxF4syiJEAytXSF4Z0w0hbrLTLHDbLm', 'احمد المهدي', 'default.jpg', '1264885', '', '', 'No file was uploaded', '', '', 1, 1598264639, 1597843302),
(3, 'متجر_نماء_فرع_حائل', 'متجر نماء فرع حائل', 'a6e6s1-gmail-com', '$2y$10$Ol3KjJcz6guoNit4G3XlYOSQ7VWViDYrYDzOuK7JA0nr8GZoTALfe', 'احمد المهدي', 'default.jpg', '111', 'https://www.youtube.com/watch?v=P1HhTi4JYQ4https://www.youtube.com/watch?v=P1HhTi4JYQ4https://www.youtube.com/watch?v=P1HhTi4JYQ4https://www.youtube.com/watch?v=P1HhTi4JYQ4https://www.youtube.com/watch?v=P1HhTi4JYQ4', 'rgba(83,70,255,1)', 'image_45eb9.jpg', '', '', 1, 1598264622, 1597914532),
(4, 'شرفية', 'متجر نماء فرع الشرفية', 'a6e6s1-gmail-com', '$2y$10$/317fuBnDiHZiTkxZ4/BjuhdV8XkAKVW4b9MAiywcEofTplJC6Mwm', 'احمد المهدي', 'default.jpg', '1264885', '', '', 'No file was uploaded', '', '', 1, 1598448129, 1597931258);

-- --------------------------------------------------------

--
-- Table structure for table `stores_projects`
--

DROP TABLE IF EXISTS `stores_projects`;
CREATE TABLE IF NOT EXISTS `stores_projects` (
  `stores_projects_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`stores_projects_id`),
  KEY `tag_id` (`store_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores_projects`
--

INSERT INTO `stores_projects` (`stores_projects_id`, `store_id`, `project_id`, `status`, `create_date`, `modified_date`) VALUES
(7, 3, 18, 1, 1598267001, 1598267001),
(8, 3, 17, 0, 1598267001, 1598267001),
(9, 3, 16, 1, 1598267001, 1598267001),
(10, 3, 15, 0, 1598267001, 1598267001),
(11, 3, 14, 0, 1598267001, 1598267001),
(12, 3, 5, 0, 1598268506, 1598268506),
(13, 3, 4, 0, 1598268506, 1598268506),
(14, 3, 3, 1, 1598268506, 1598268506),
(15, 3, 2, 0, 1598268506, 1598268506),
(16, 3, 1, 0, 1598268506, 1598268506),
(17, 2, 1, 1, 1598356069, 1598356069),
(39, 4, 20, 1, 1598357020, 1598357020),
(40, 4, 16, 0, 1598357020, 1598357020),
(41, 4, 9, 1, 1598357020, 1598357020),
(42, 1, 19, 0, 1598443262, 1598443262),
(43, 1, 18, 0, 1598443262, 1598443262),
(44, 1, 17, 0, 1598443262, 1598443262),
(45, 1, 21, 0, 1598444053, 1598444053),
(46, 1, 20, 0, 1598444053, 1598444053),
(47, 1, 16, 0, 1598444053, 1598444053),
(48, 1, 15, 0, 1598444053, 1598444053),
(49, 1, 14, 0, 1598444053, 1598444053),
(50, 1, 13, 0, 1598444053, 1598444053),
(51, 1, 12, 0, 1598444053, 1598444053),
(52, 1, 11, 0, 1598444053, 1598444053),
(53, 1, 10, 0, 1598444053, 1598444053),
(54, 1, 9, 0, 1598444053, 1598444053),
(55, 1, 8, 0, 1598444053, 1598444053),
(56, 1, 7, 0, 1598444053, 1598444053),
(57, 1, 6, 0, 1598444053, 1598444053),
(58, 1, 5, 0, 1598444053, 1598444053),
(59, 1, 4, 0, 1598444053, 1598444053),
(60, 1, 3, 0, 1598444053, 1598444053),
(61, 1, 2, 0, 1598444054, 1598444054),
(62, 1, 1, 0, 1598444054, 1598444054);

-- --------------------------------------------------------

--
-- Table structure for table `tags_donations`
--

DROP TABLE IF EXISTS `tags_donations`;
CREATE TABLE IF NOT EXISTS `tags_donations` (
  `tags_donations_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`tags_donations_id`),
  KEY `tag_id` (`tag_id`),
  KEY `project_id` (`donation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_donations`
--

INSERT INTO `tags_donations` (`tags_donations_id`, `tag_id`, `donation_id`, `create_date`, `modified_date`) VALUES
(154, 3, 36, 1585767665, 1585767665),
(155, 3, 32, 1585767665, 1585767665),
(156, 3, 27, 1585767665, 1585767665),
(157, 3, 23, 1585767665, 1585767665),
(158, 3, 21, 1585767665, 1585767665),
(159, 3, 20, 1585767665, 1585767665),
(160, 3, 3, 1585767665, 1585767665),
(161, 1, 34, 1585767675, 1585767675),
(162, 1, 31, 1585767675, 1585767675),
(163, 1, 29, 1585767675, 1585767675),
(164, 1, 28, 1585767675, 1585767675),
(165, 1, 26, 1585767675, 1585767675),
(166, 1, 25, 1585767675, 1585767675),
(167, 1, 24, 1585767675, 1585767675),
(168, 1, 15, 1585767675, 1585767675),
(169, 4, 37, 1585768567, 1585768567),
(170, 4, 19, 1585768575, 1585768575),
(171, 4, 18, 1585768575, 1585768575),
(172, 4, 17, 1585768575, 1585768575);

-- --------------------------------------------------------

--
-- Table structure for table `tags_projects`
--

DROP TABLE IF EXISTS `tags_projects`;
CREATE TABLE IF NOT EXISTS `tags_projects` (
  `tags_projects_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`tags_projects_id`),
  KEY `tag_id` (`tag_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_projects`
--

INSERT INTO `tags_projects` (`tags_projects_id`, `tag_id`, `project_id`, `create_date`, `modified_date`) VALUES
(94, 2, 14, 1584951604, 1584951604),
(95, 1, 14, 1584951604, 1584951604),
(106, 2, 16, 1585228557, 1585228557),
(107, 1, 16, 1585228557, 1585228557),
(108, 2, 9, 1585505116, 1585505116),
(109, 1, 9, 1585505116, 1585505116),
(114, 1, 17, 1585694213, 1585694213),
(116, 1, 13, 1585694505, 1585694505),
(117, 2, 11, 1585694517, 1585694517),
(118, 2, 18, 1585694575, 1585694575),
(124, 1, 2, 1585927917, 1585927917),
(133, 2, 3, 1585928000, 1585928000),
(134, 1, 3, 1585928000, 1585928000),
(143, 2, 19, 1591224831, 1591224831),
(193, 5, 21, 1591583864, 1591583864),
(194, 4, 21, 1591583864, 1591583864),
(195, 3, 21, 1591583864, 1591583864),
(196, 2, 21, 1591583864, 1591583864),
(197, 1, 21, 1591583864, 1591583864),
(198, 2, 1, 1591622744, 1591622744),
(199, 1, 1, 1591622744, 1591622744),
(206, 2, 15, 1595338835, 1595338835),
(207, 1, 15, 1595338835, 1595338835);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `image` tinytext DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `activation_code` varchar(100) DEFAULT NULL,
  `request_password_time` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `login_date` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `groups` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `mobile`, `image`, `bio`, `activation_code`, `request_password_time`, `group_id`, `login_date`, `status`, `modified_date`, `create_date`) VALUES
(22, 'احمد المهدي', 'a6e6s1@gmail.com', '$2y$10$veHBsCh4q39J.k0MPGKfDuHhraBWnyQmnhoBVRIA1rZyL.eLAp61a', '597767751', 'thuma6e.png', '', '98783', 0, 1, 1597672893, 1, 1574344167, 1543831099),
(23, 'Monyb Younos', 'munybe@gmail.com', '$2y$10$Raf3iUVZJPQr4//YEBuypO.fWDuSWTRZPDmCa7.Ta84v21ZFWl056', '0597767751', 'سيسش شسيشسي سيسش ضصث  غعغف عفغ.png', '', NULL, NULL, 3, NULL, 1, 1584428774, 1572786123);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
