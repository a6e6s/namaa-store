-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2020 at 06:50 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `subject`, `message`, `full_name`, `email`, `phone`, `type`, `status`, `create_date`, `modified_date`) VALUES
(1, 'aaaaaaaaaaa', 'aaaaaaaa', 'aaa', 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaa', 2, 1, 1),
(2, '', '', '', '', '', '', 0, 1578574662, 1578574662),
(3, '', '', '', '', '', '', 1, 1578576619, 1578576619),
(4, 'رسائل التواصل اضافة رسالة جديد', 'رسائل التواصل اضافة رسالة جديد', 'test', 'a6e6s1@gmail.com', '0597767751', 'طلب', 1, 1578577125, 1578577125),
(5, 'رسائل التواصل اضافة رسالة جديد', 'wwww', 'test', 'a6e6s1@gmail.com', '0597767751', 'استفسار', 0, 1578577315, 1578577888);

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
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `amount`, `total`, `quantity`, `donation_type`, `order_id`, `project_id`, `status`, `modified_date`, `create_date`) VALUES
(2, 1, 1, 1, ' ', 2, 4, 3, 1583315262, 1583315247),
(3, 50, 50, 1, ' ', 2, 2, 0, 1583320401, 1583320375),
(4, 50, 50, 1, ' ', 2, 3, 3, 1583399753, 1583399753),
(5, 50, 50, 1, ' ', 2, 3, 1, 1583408352, 1583408352),
(6, 1, 1, 1, ' ', 2, 4, 0, 1583408524, 1583408524),
(7, 1, 1, 1, ' ', 2, 4, 3, 1583408543, 1583408543),
(8, 1, 1, 1, ' ', 2, 4, 1, 1583408581, 1583408581),
(9, 1, 1, 1, ' ', 2, 4, 3, 1583408594, 1583408594),
(10, 1, 1, 1, ' ', 2, 4, 1, 1583408742, 1583408742),
(11, 1, 1, 1, ' ', 2, 4, 0, 1583408795, 1583408795),
(12, 1, 1, 1, ' ', 12, 4, 3, 1583410255, 1583410255),
(13, 1, 1, 1, ' ', 3, 4, 1, 1583413306, 1583413306),
(14, 50, 50, 1, ' ', 3, 3, 2, 1583415740, 1583415420),
(15, 1111, 1111, 1, ' ', 3, 9, 3, 1583733800, 1583733800),
(16, 50, 50, 1, ' ', 3, 3, 3, 1583746341, 1583746334),
(17, 222, 222, 1, ' ', 3, 6, 3, 1583755300, 1583755300),
(18, 222, 222, 1, ' ', 3, 6, 1, 1583765569, 1583755337),
(19, 50, 50, 1, ' ', 3, 3, 1, 1583765198, 1583758994),
(20, 50, 50, 1, ' ', 3, 3, 1, 1583821789, 1583821761),
(21, 50, 50, 1, ' ', 3, 1, 1, 1584440018, 1583821829),
(22, 1, 1, 1, ' ', 11, 10, 3, 1584356204, 1583822177),
(23, 50, 50, 1, ' ', 4, 8, 0, 1584440046, 1583823015),
(24, 11, 33, 3, ' ', 4, 11, 1, 1584972974, 1584535762),
(25, 11, 11, 1, ' ', 4, 11, 0, 1584972955, 1584536881),
(26, 1111, 1111, 1, 'سهم3', 4, 6, 0, 1584971249, 1584971249),
(27, 50, 200, 4, 'قيمة ثابته', 4, 3, 3, 1584971362, 1584971354),
(28, 11, 11, 1, 'فدية', 4, 4, 3, 1585504058, 1585504058),
(29, 11, 11, 1, 'فدية', 4, 4, 4, 1585504149, 1585504142),
(30, 100, 100, 1, 'مفتوح', 4, 10, 1, 1585504149, 1585504142),
(31, 111, 111, 1, 'كسوة فرد', 4, 4, 1, 1585504380, 1585504324),
(32, 50, 50, 1, 'قيمة ثابته', 4, 3, 1, 1586287457, 1585504324),
(33, 100, 100, 1, 'كسوة فردين', 4, 2, 1, 1585504380, 1585504324),
(34, 11, 22, 2, 'فدية', 4, 4, 1, 1585514488, 1585514488),
(35, 199, 199, 1, 'كسوة اسرة', 4, 2, 1, 1585514488, 1585514488),
(36, 50, 50, 1, 'قيمة ثابته', 4, 3, 1, 1585514668, 1585514668),
(37, 50, 50, 1, 'قيمة ثابته', 4, 15, 1, 1585742576, 1585742576),
(38, 10, 10, 1, 'مفتوح', 4, 19, 1, 1585930202, 1585930195),
(39, 50, 100, 2, 'قيمة ثابته', 4, 3, 1, 1586287469, 1585937984),
(40, 111, 111, 1, 'كسوة فرد', 4, 4, 1, 1586353345, 1586353337),
(41, 50, 100, 2, 'قيمة ثابته', 4, 3, 1, 1586353345, 1586353337),
(42, 50, 50, 1, 'قيمة ثابته', 13, 14, 1, 1586353345, 1586353337),
(43, 100, 100, 1, 'كسوة فردين', 5, 2, 1, 1586353345, 1586353337),
(44, 111, 111, 1, 'كسوة فرد', 5, 4, 1, 1586353854, 1586353849),
(45, 111, 111, 1, 'كسوة فرد', 5, 4, 1, 1586354150, 1586354150),
(46, 111, 111, 1, 'كسوة فرد', 5, 4, 1, 1586354932, 1586354446),
(47, 100, 100, 1, 'مفتوح', 5, 10, 1, 1586355102, 1586355095),
(48, 111, 111, 1, 'فدية', 5, 4, 1, 1586355754, 1586355747),
(49, 50, 50, 1, 'قيمة ثابته', 5, 3, 1, 1586355892, 1586355820),
(50, 50, 50, 1, 'قيمة ثابته', 5, 3, 1, 1586392163, 1586392108),
(51, 111, 111, 1, 'فدية', 5, 4, 1, 1586723071, 1586723071),
(52, 111, 111, 1, 'فدية', 5, 4, 1, 1586783302, 1586783302),
(53, 111, 111, 1, 'فدية', 5, 4, 1, 1586783355, 1586783355),
(54, 111, 111, 1, 'فدية', 5, 4, 1, 1586783442, 1586783442),
(55, 111, 111, 1, 'فدية', 5, 4, 1, 1586783468, 1586783468),
(56, 111, 111, 1, 'فدية', 5, 4, 1, 1586783512, 1586783512),
(57, 111, 111, 1, 'فدية', 5, 4, 1, 1586783644, 1586783644),
(58, 111, 111, 1, 'فدية', 5, 4, 1, 1586784078, 1586784078),
(59, 111, 111, 1, 'فدية', 5, 4, 1, 1586784112, 1586784112),
(60, 111, 111, 1, 'فدية', 5, 4, 1, 1586784652, 1586784652),
(61, 111, 111, 1, 'كسوة فرد', 5, 4, 1, 1586787966, 1586787966),
(62, 50, 50, 1, 'قيمة ثابته', 10, 3, 1, 1586788042, 1586788042),
(63, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1586788996, 1586788996),
(64, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1586789281, 1586789281),
(65, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1586789357, 1586789357),
(66, 100, 100, 1, 'كسوة فردين', 13, 2, 1, 1586789572, 1586789572),
(67, 100, 100, 1, 'مفتوح', 13, 10, 1, 1586789890, 1586789890),
(68, 111, 111, 1, 'فدية', 13, 4, 1, 1586789923, 1586789923),
(69, 111, 111, 1, 'فدية', 13, 4, 1, 1586790075, 1586790075),
(70, 111, 111, 1, 'فدية', 13, 4, 1, 1586859538, 1586859538),
(71, 11, 11, 1, 'فدية', 13, 4, 1, 1587071281, 1587071267),
(72, 50, 50, 1, 'قيمة ثابته', 13, 15, 1, 1587071281, 1587071267),
(73, 11, 11, 1, 'سهم3', 13, 11, 1, 1587072382, 1587072375),
(74, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1587077130, 1587077117),
(75, 50, 50, 1, 'قيمة ثابته', 13, 15, 1, 1587077130, 1587077117),
(76, 111, 111, 1, 'كسوة فرد', 13, 4, 1, 1587077130, 1587077117),
(77, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1587077342, 1587077336),
(78, 50, 50, 1, 'كسوة اسرة', 13, 2, 1, 1587077406, 1587077396),
(79, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1587077638, 1587077630),
(80, 11, 11, 1, 'سهم3', 13, 11, 1, 1587077726, 1587077726),
(81, 11, 11, 1, 'سهم3', 13, 11, 1, 1587077768, 1587077749),
(82, 111, 111, 1, 'كسوة فرد', 13, 4, 1, 1587079406, 1587079394),
(83, 50, 50, 1, 'قيمة ثابته', 13, 3, 1, 1587079406, 1587079394),
(84, 50, 50, 1, 'قيمة ثابته', 13, 14, 1, 1587079406, 1587079394),
(85, 111, 111, 1, 'فدية', 13, 4, 0, 1587341268, 1587341209),
(86, 111, 111, 1, 'كسوة فرد', 13, 4, 0, 1587385807, 1587385807),
(87, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1587385807, 1587385807),
(88, 111, 111, 1, 'كسوة فرد', 13, 4, 0, 1587385837, 1587385837),
(89, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1587386222, 1587386222),
(90, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1587386240, 1587386240),
(91, 111, 111, 1, 'كسوة فرد', 13, 4, 0, 1588115914, 1588115914),
(92, 111, 111, 1, 'سهم2', 13, 11, 0, 1588116027, 1588116027),
(93, 1111, 1111, 1, 'سهم3', 13, 11, 0, 1588116314, 1588116314),
(94, 111, 222, 2, 'كسوة فرد', 13, 4, 0, 1588118105, 1588118105),
(95, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1588118165, 1588118165),
(96, 100, 100, 1, 'كسوة فردين', 13, 2, 0, 1588118165, 1588118165),
(97, 50, 200, 4, 'قيمة ثابته', 13, 3, 0, 1588118241, 1588118241),
(98, 50, 100, 2, 'قيمة ثابته', 13, 3, 0, 1588155375, 1588118290),
(99, 100, 100, 1, 'كسوة فردين', 13, 2, 0, 1588245908, 1588245908),
(100, 111, 111, 1, 'كسوة فرد', 13, 4, 0, 1588246062, 1588246062),
(101, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1588246062, 1588246062),
(102, 50, 50, 1, 'قيمة ثابته', 13, 15, 0, 1588246062, 1588246062),
(103, 11, 11, 1, 'فدية', 13, 4, 0, 1588246232, 1588246232),
(104, 50, 50, 1, 'قيمة ثابته', 13, 3, 0, 1588246232, 1588246232),
(105, 50, 100, 2, 'قيمة ثابته', 13, 1, 0, 1588506246, 1588246232);

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
(10, '0597767751', 'Ahmed Elmahdy', NULL, 'yes', 2, 1583675359, 1583673484),
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
(1, 'الإدارة', 'مجموعه تملك كافة الصلاحيات', '{\"admin_login\":{\"view\":\"1\"},\"Contacts\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donations\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donors\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Menus\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Messagings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Orders\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Paymentmethods\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projectcategories\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projects\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projecttags\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Reports\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Slides\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Statuses\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', 1, 1543493061, 1587942660),
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
(1, 'الاقسام', 'الاقسام', '/categories', 'static', 100, NULL, 1, 1583936653, 1583936128);

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
  `hash` varchar(100) DEFAULT NULL,
  `banktransferproof` varchar(255) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT 0,
  `gift_data` mediumtext DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `projects_id` varchar(255) DEFAULT NULL,
  `donor_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `donor_id` (`donor_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_identifier`, `total`, `quantity`, `payment_method_id`, `hash`, `banktransferproof`, `gift`, `gift_data`, `meta`, `projects`, `projects_id`, `donor_id`, `status_id`, `status`, `modified_date`, `create_date`) VALUES
(1, 1007077117, 150, 3, 3, '0', NULL, 0, NULL, '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', NULL, NULL, 12, 4, 1, 1588074971, 1587077117),
(2, 1008115805, 111, 1, 1, 'ad314df3832a435fa30bfea2930fce6e6b9c3e32', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '4-,2-,3', 18, 0, 0, 1588115805, 1588115805),
(3, 1008115843, 111, 1, 1, 'aba628064cebaa1f62eccde66eed83a2a4f84b74', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '4-,3-,9-,6-,1', 18, 4, 0, 1588115843, 1588115843),
(4, 1008115914, 111, 1, 1, '20ad13e6c75f1b2a82255617ab8339f3154c971c', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '', NULL, '8-,11-,6-,3-,4-,10-,2-,15-,19', 18, 0, 0, 1588115914, 1588115914),
(5, 1008116027, 111, 1, 2, '6171a4d4809bc5e63ce8fe9eca5ba2be40e412e0', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, NULL, '2-,4-,10-,3', 18, 0, 0, 1588116027, 1588116027),
(6, 1008116314, 1111, 1, 1, NULL, 'image_a0769.jpg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, NULL, NULL, 18, 4, 0, 1588116324, 1588116314),
(7, 1008118105, 222, 0, 1, NULL, '', 0, '', NULL, NULL, NULL, 18, 0, 0, 1588118116, 1588118105),
(8, 1008118165, 150, 0, 1, NULL, '', 0, '', NULL, NULL, NULL, 18, 0, 0, 1588118174, 1588118165),
(9, 1008118241, 200, 0, 1, NULL, '', 0, '', NULL, NULL, NULL, 18, 4, 0, 1588118253, 1588118241),
(10, 1008118290, 150, 0, 1, NULL, 'image_c4900.jpg', 0, '', NULL, NULL, '3', 18, 3, 0, 1588118302, 1588118290),
(11, 1008245908, 100, 0, 1, 'fa6f3beb6988e60054639dac49344b0dd1f988ae', NULL, 0, '', NULL, NULL, '10', 18, 0, 0, 1588245908, 1588245908),
(12, 1008246062, 211, 0, 1, NULL, 'image_3a335.jpg', 0, '', NULL, NULL, '4', 18, 1, 0, 1588246127, 1588246062),
(13, 1008246232, 111, 0, 1, NULL, '', 0, '', NULL, NULL, '14-,3-,2-,10-,4-,15-,11-,1', 18, 2, 0, 1588246256, 1588246232);

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
  `meta` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_id`, `title`, `content`, `meta`, `image`, `status`, `create_date`, `modified_date`) VALUES
(1, 'التحويل البنكي', NULL, '{\"bank1\":{\"bankname\":\"\\u0627\\u0644\\u0631\\u0627\\u062c\\u062d\\u064a\",\"account_type\":\"\\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u0632\\u0643\\u0627\\u0629\",\"iban\":\"46549784348676465789\",\"url\":\"https:\\/\\/namaa.sa\\/product\"},\"bank2\":{\"bankname\":\"\\u0627\\u0644\\u0627\\u0647\\u0644\\u064a\",\"account_type\":\"\\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u0635\\u062f\\u0642\\u0629\",\"iban\":\"223333332222222222222\",\"url\":\"https:\\/\\/namaa.sa\\/product\"}}', 'thuma6e_6.png', 1, 0, 1583244728),
(2, 'الدفع من خلال فروعنا', '<p>سوف يتم التواصل من خلال مندوبنا خلال 24 ساعه لتحديد الوقت المناسب لاستلام المبلغ</p>\r\n', '{\"branch1\":{\"branchname\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0631\\u0639\\t\",\"address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"url\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0639\\u0644\\u064a \\u062e\\u0631\\u0627\\u0626\\u0637 \\u062c\\u0648\\u062c\\u0644\\t\"},\"branch2\":{\"branchname\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0631\\u0639\\t2\",\"address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u06462\",\"url\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0639\\u0644\\u064a \\u062e\\u0631\\u0627\\u0626\\u0637 \\u062c\\u0648\\u062c\\u0644\\t2\"},\"branch3\":{\"branchname\":\"\",\"address\":\"\",\"url\":\"\"},\"branch4\":{\"branchname\":\"\",\"address\":\"\",\"url\":\"\"}}', 'thuma6e_13.png', 1, 1573652572, 1579525446),
(3, 'بطاقة الأئتمان', NULL, 'null', 'v-24-512.png', 1, 1573739801, 1583241647),
(4, 'الدفع عند الاستلام', '<p style=\"text-align:center;\">سيتم تحصيل الرسوم عندس تسليم الهدية</p>\r\n', NULL, '345.png', 0, 1574663247, 1574663247);

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
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `name`, `alias`, `project_number`, `description`, `category_id`, `arrangement`, `back_home`, `image`, `secondary_image`, `enable_cart`, `gift`, `mobile_confirmation`, `donation_type`, `payment_methods`, `target_price`, `target_unit`, `unit_price`, `fake_target`, `collected_traget`, `start_date`, `end_date`, `hidden`, `hits`, `thanks_message`, `sms_msg`, `mobile`, `whatsapp`, `advertising_code`, `header_code`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'حالة طارئة    17', 'حالة-طارئة----17', '', '<p>أرملة  ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال  بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n', 1, 1, 0, '345_2.png', 'image_07bdc.jpg', 1, 0, 0, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0627\\u0636\\u062d\\u064a\\u0629\",\"value\":\"450\"},\"item2\":{\"name\":\"\\u0641\\u062f\\u064a\\u0629\",\"value\":\"400\"}}}', '[\"2\",\"1\"]', 1000000, '', 0, 0, NULL, 1574812800, 1587686400, 1, NULL, 'تم الارسال .. وطلبكم الآن قيد المراجعة .. وسوف يتم ارسال رسالة نصية فور تأكيد الطلب .. \r\nشكرا جزيلاً لكم ..  بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nجمعية نماء بمنطقة مكة المكرمة ..', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '1111111111', '1111111111', '', '', '', NULL, '', '', 1, 1, 1585828397, NULL),
(2, 'كسوة الشتاء', 'كسوة-الشتاء', '', '<p><strong>فكرة المشروع :</strong></p>\r\n\r\n<p>تأمين مستلزمات الشتاء الأساسية من بطانيات ودفايات التي لا يستغنى عنـها في أي منزل نتيجة لبرودة الجو .</p>\r\n\r\n<p><strong>أهمية المشروع :</strong></p>\r\n\r\n<p>تكمن أهمية المشروع في :</p>\r\n\r\n<ul>\r\n	<li>- عدم استطاعة الفقراء دفع تكاليف مستلزمات الشتاء .</li>\r\n	<li>- تخفيف معاناة برودة الجو القارس على الفقراء .</li>\r\n</ul>\r\n\r\n<p><strong>أهداف المشروع :</strong></p>\r\n\r\n<ul>\r\n	<li>- رفع معاناة الأسر الفقيرة المسجلة لدى الفرع وسد احتياجاتها .</li>\r\n	<li>- إيجاد طرق سهلة للمحسن للتبرع الدائم .</li>\r\n	<li>- إيجاد حلول عملية واقعية لرفع معاناة الفقير والمحتاج والعاطل .</li>\r\n	<li>- تحقيق التكافل الاجتماعي بين أفراد المجتمع .</li>\r\n	<li>- فتح باب المشاركة للمؤسسات التجارية المتخصصة وفاعلي الخير .</li>\r\n</ul>\r\n', 1, 100, 1, '345_18.png', '91ddb8751920595dfde2515820730482.gif', 1, 0, 1, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\",\"value\":\"50\"},\"item2\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0646\",\"value\":\"100\"},\"item3\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0627\\u0633\\u0631\\u0629\",\"value\":\"200\"}}}', '[\"3\",\"2\",\"1\"]', 150000, 'ذبيحة', 100, 0, NULL, 1574208000, 1580428800, 0, NULL, 'شكرا لدعمكم', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '597767751', '597767751', 'كود التتبع الاعلاني :', 'كود الهيدر :', 'rgba(255,33,17,1)', 'pic1521704669_11.png', 'مستلزمات الشتاء الأساسية,كسوة الشتاء', 'وصف مختصر لمحرك البحث', 1, 1, 1585927917, 1574238278),
(3, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 3, 1, '[&#34;skyscraper-scaled.jpg&#34;,&#34;345.png&#34;]', 'image_37ae5.jpg', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 1000, 'ذبيحة', 50, 0, 2000, 0, 0, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1585927999, 1574249492),
(4, 'الحالات الطارئة4', 'الحالات-الطارئة4', 'SOS-00307', '<p style=\"text-align:center;\">الحالات الطارئة4</p>\r\n\r\n<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 1, 0, 0, '[&#34;pic1521704669.png&#34;,&#34;default.jpg&#34;,&#34;345.png&#34;]', '', 1, 1, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\",\"value\":\"111\"},\"item2\":{\"name\":\"\\u0641\\u062f\\u064a\\u0629\",\"value\":\"11\"}}}', '[\"4\",\"3\",\"2\",\"1\"]', 10000, 'ذبيحة', 100, 20, NULL, 0, 0, 0, NULL, 'شكرا لتبرعك للحاللت الطارئة شكرا لتبرعك للحاللت الطارئة شكرا لتبرعك للحاللت الطارئة', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1587341189, 1574249556),
(5, 'qqqqqq', 'qqqqqq', ' ', '<p>أرملة  ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال  بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n', 2, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 0, 1576492983, 1576492983),
(6, 'qqqqqq', 'qqqqqq', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 11, 0, '', '', 0, 0, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0633\\u0647\\u0645\",\"value\":\"11\"},\"item2\":{\"name\":\"\\u0633\\u0647\\u06452\",\"value\":\"111\"},\"item3\":{\"name\":\"\\u0633\\u0647\\u06453\",\"value\":\"1111\"}}}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 0, 1584968728, 1576493017),
(7, 'qqqqqq', 'qqqqqq', ' ', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 0, 1576493226, 1576493226),
(8, 'المشروع', '-المشروع', ' ', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 2, 10, 0, '', 'inside- 3_4.jpg', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 0, 1579689776, 1576493238),
(9, 'qqqqqq', 'qqqqqq', '', '<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق. لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n', 2, 111, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1585505116, 1576496602),
(10, 'ضضضضضضضضضضضض', 'ضضضضضضضضضضضض', '', '<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n\r\n<p>لأجلك يا أمي  هي هدية يقدمها الأبناء لأمهاتهم  تتشكل في  علبة بسيطة مكونة من ظرف فاخر يحوي كارت أنيق.</p>\r\n', 1, 34, 0, '', '', 1, 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1585505107, 1576496713),
(11, 'كفارة اليمين..1212', 'كفارة-اليمين--1212', '23123123', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 23, 0, '', '', 0, 1, 0, '{\"type\":\"share\",\"value\":{\"item1\":{\"name\":\"\\u0633\\u0647\\u0645\",\"value\":\"11\"},\"item2\":{\"name\":\"\\u0633\\u0647\\u06452\",\"value\":\"111\"},\"item3\":{\"name\":\"\\u0633\\u0647\\u06453\",\"value\":\"1111\"}}}', '[\"4\",\"3\",\"2\",\"1\"]', 0, '', 0, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1585694517, 1584359855),
(12, 'اقسام المشروعات اضافة قسم جديد', 'اقسام-المشروعات-اضافة-قسم-جديد', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\\\\r\\\\n\\', 3, 0, 0, '', '', 0, 1, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, NULL, NULL, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 0, 1, 1584951378, 1584448618),
(13, 'اقسام المشروعات اضافة قسم جديد', 'اقسام-المشروعات-اضافة-قسم-جديد', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 222, 0, '', '', 0, 1, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, '', 0, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1585694505, 1584951577),
(14, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 333, 1, '[skyscraper-scaled.jpg,345.png]', '', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, NULL, NULL, 0, NULL, 0, 0, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1584951604, 1584951604),
(15, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 11, 1, '', 'inside- 3_14.jpg', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, NULL, NULL, 0, NULL, 0, 0, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1584953008, 1584952182),
(16, 'كفارة اليمين..', 'كفارة-اليمين--', '', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 145, 1, '', 'inside- 3_14.jpg', 1, 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, NULL, NULL, 0, NULL, 0, 0, 0, NULL, 'رسالة الشكر التلقائية :', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '0597767751', '0597767751', '', '', '', '', '', '', 0, 1, 1585228556, 1585228556),
(17, 'كفارة اليمين1', 'كفارة-اليمين1', '', '<p>أرملة ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم</p>\r\n\r\n<p>\\\\r\\\\n\\</p>\r\n', 3, 0, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"4\",\"3\"]', 1400000, 'ذبيحة1', 100, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 0, 1, 1585694213, 1585665401),
(18, 'كفارة اليمين', 'كفارة-اليمين', '23123123', NULL, 4, 111, 0, '', '', 0, 0, 0, '{\"type\":\"open\"}', '[\"3\"]', 0, '', 0, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1585694575, 1585694551),
(19, 'كفارة اليمين', 'كفارة-اليمين', 'SOS-00307', NULL, 4, 111, 0, '', '', 0, 1, 0, '{\"type\":\"open\"}', '[\"3\"]', 0, '', 0, 0, NULL, 0, 0, 0, NULL, '', '[[name]] تم تأكيد طلبكم رقم [[identifier]] بمبلغ [[total]] ريال في مشروع [[project]] \r\nبارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nكل عام وانتم بخير ،،', '', '', '', '', '', '', '', '', 1, 1, 1586874176, 1585915073);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `title`, `alias`, `value`, `create_date`, `modified_date`) VALUES
(1, 'الاعدادات العامة', 'site', '{\"title\":\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0646\\u0645\\u0627\\u0621 \",\"logo\":\"namaa-logo.png\",\"header_code\":\"<!-- Google Tag Manager -->\\r\\n<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':\\r\\nnew Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],\\r\\nj=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\\r\\n\'https:\\/\\/www.googletagmanager.com\\/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);\\r\\n})(window,document,\'script\',\'dataLayer\',\'GTM-KKQQ54J\');<\\/script>\\r\\n<!-- End Google Tag Manager -->\\r\\n\\r\\n\\r\\n\",\"footer_code\":\"<!-- Google Tag Manager -->\\r\\n<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':\\r\\nnew Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],\\r\\nj=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\\r\\n\'https:\\/\\/www.googletagmanager.com\\/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);\\r\\n})(window,document,\'script\',\'dataLayer\',\'GTM-KKQQ54J\');<\\/script>\\r\\n<!-- End Google Tag Manager -->\\r\\n\\r\\n\\r\\n\",\"show_banner\":\"1\",\"mobile_validation\":\"0\",\"show_projects\":\"1\",\"project_text\":\"\\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639\\u0627\\u062a \",\"enableTages\":\"1\",\"show_categories\":\"1\",\"category_text\":\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645 \",\"show_bottom\":\"1\",\"show_footer\":\"1\",\"bootom\":null}', 1583845973, 1587385784),
(2, 'اعدادات بيانات التواصل', 'contact', '{\"phone\":\"0597767751\",\"phone2\":\"0597767751\",\"mobile\":\"0597767751\",\"mobile2\":\"0597767751\",\"fax\":\"0597767751\",\"address\":\"\\u062c\\u062f\\u0629 \\u062d\\u064a \\u0627\\u0644\\u0646\\u0639\\u064a\\u0645\",\"email\":\"namaa@namaa.sa\",\"map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m13!1m8!1m3!1d3710.8054150744156!2d39.1637415!3d21.5544626!3m2!1i1024!2i768!4f13.1!3m2!1m1!2sNamaa!5e0!3m2!1sar!2ssa!4v1583928833064!5m2!1sar!2ssa\"}', 1583845973, 1586350008),
(3, 'اعدادات الارشفة', 'seo', '{\"meta_keywords\":\"\",\"meta_description\":\"\"}', 1583845973, 1583916715),
(4, 'اعدادات مواقع التواصل الاجتماعي', 'social', '{\"facebook\":\"\",\"twitter\":\"\",\"instagram\":\"\",\"linkedin\":\"\",\"youtube\":\"\"}', 1583845973, 1584360023),
(5, 'اعدادات البريد الالكتروني', 'email', '{\"contacts_email\":\"\",\"donation_email\":\"\",\"sending_email\":\"donation@namaa.com\",\"sending_name\":\"\\u0645\\u062a\\u062c\\u0631 \\u0646\\u0645\\u0627\\u0621 \\u0627\\u0644\\u062e\\u064a\\u0631\\u064a\",\"bootom\":null}', 1583845973, 1585744565),
(6, 'اعدادات رسائل SMS', 'sms', '{\"gateurl\":\"http:\\/\\/www.oursms.net\\/api\\/sendsms.php\",\"sms_username\":\"namaa\",\"sender_name\":\"Namaa.sa\",\"sms_password\":\"147147\",\"smsenabled\":\"1\",\"bootom\":null}', 1583845973, 1585824733),
(7, 'اعدادات التصميم', 'theme', '{\"background_color\":\"\",\"background_image\":\"\",\"banner_image\":\"BB01.jpg\",\"banner_image_url\":\"#1\",\"projects_image\":\"BB02.jpg\",\"projects_image_url\":\"#2\",\"categories_image\":\"BB03.jpg\",\"categories_image_url\":\"#3\",\"categories_image2\":\"BB01.jpg\",\"categories_image2_url\":\"#4\",\"categories_image3\":\"BB02.jpg\",\"categories_image3_url\":\"#5\",\"bootom\":null}', 1583845973, 1585570246),
(8, 'الاهداء الخيري', 'gift', '{\"rowrowrowrowrowrowrowrow2\":{\"name\":\"qweqweqw\",\"image\":\"section.png\"},\"rowrowrowrowrowrowrowrow3\":{\"name\":\"2342\",\"image\":\"image_05acc.png\"},\"rowrow3\":{\"name\":\"\\u0627\\u0644\\u064a \\u0635\\u062f\\u0633\\u0642\\u0633\",\"image\":\"[&#34;thuma6e_2.png&#34;,&#34;thuma6e.png&#34;,&#34;skyscraper-scaled.jpg&#34;,&#34;section.png&#34;,&#34;image_37ae5.jpg&#34;,&#34;image_07bdc.jpg&#34;,&#34;91ddb8751920595dfde2515820730482.gif&#34;,&#34;345.png&#34;]\"},\"row4\":{\"name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0629 :\",\"image\":\"[&#34;345.png&#34;,&#34;111.png&#34;]\"}}', 1583845971, 1585938109),
(9, 'اعدادات الواجهة البرمجية API', 'api', '{\"api_user\":\"tarek\",\"api_key\":\"T@r3k2020\",\"api_enable\":\"1\"}', 1582972955, 1586997149);

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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_projects`
--

INSERT INTO `tags_projects` (`tags_projects_id`, `tag_id`, `project_id`, `create_date`, `modified_date`) VALUES
(94, 2, 14, 1584951604, 1584951604),
(95, 1, 14, 1584951604, 1584951604),
(104, 2, 15, 1584953008, 1584953008),
(105, 1, 15, 1584953008, 1584953008),
(106, 2, 16, 1585228557, 1585228557),
(107, 1, 16, 1585228557, 1585228557),
(108, 2, 9, 1585505116, 1585505116),
(109, 1, 9, 1585505116, 1585505116),
(114, 1, 17, 1585694213, 1585694213),
(116, 1, 13, 1585694505, 1585694505),
(117, 2, 11, 1585694517, 1585694517),
(118, 2, 18, 1585694575, 1585694575),
(119, 2, 1, 1585828397, 1585828397),
(120, 1, 1, 1585828397, 1585828397),
(124, 1, 2, 1585927917, 1585927917),
(133, 2, 3, 1585928000, 1585928000),
(134, 1, 3, 1585928000, 1585928000),
(136, 2, 19, 1586874176, 1586874176);

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
(22, 'احمد المهدي', 'a6e6s1@gmail.com', '$2y$10$veHBsCh4q39J.k0MPGKfDuHhraBWnyQmnhoBVRIA1rZyL.eLAp61a', '597767751', 'thuma6e.png', '', '98783', 0, 1, 1588704046, 1, 1574344167, 1543831099),
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
