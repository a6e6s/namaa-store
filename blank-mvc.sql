-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2020 at 02:27 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

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
(1, 'aaaaaaaaaaa', 'aaaaaaaa', 'aaa', 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaa', 0, 1, 1),
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
  `donation_identifier` bigint(15) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `banktransferproof` varchar(255) DEFAULT NULL,
  `meta` text,
  `project_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  UNIQUE KEY `donation_identifier` (`donation_identifier`),
  KEY `donor_id` (`donor_id`),
  KEY `project_id` (`project_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donation_identifier`, `amount`, `payment_method_id`, `hash`, `banktransferproof`, `meta`, `project_id`, `donor_id`, `status`, `modified_date`, `create_date`) VALUES
(2, 1, 1, 1, NULL, 'خطاب إلغاء_18.pdf', NULL, 4, 1, 0, 1583315262, 1583315247),
(3, 3, 50, 1, NULL, '1413b43d-6c7d-4d71-aac5-b03783646302.jpg', NULL, 2, 1, 0, 1583320401, 1583320375),
(4, 4, 50, 4, '748a51d1b312aa689bd1dbf239d73c6879d67cef', NULL, NULL, 3, 1, 0, 1583399753, 1583399753),
(5, 6, 50, 4, '696204a4ab1e58b428aa58c7252f3be5c756baf0', NULL, NULL, 3, 1, 0, 1583408352, 1583408352),
(6, 5465, 1, 2, 'f53e892aafe039fccb5e2b72a21aa83a13d320fb', NULL, NULL, 4, 1, 0, 1583408524, 1583408524),
(7, 54654, 1, 4, 'ecdb6e8ba92601d8991fa761886288181db86e2a', NULL, NULL, 4, 1, 0, 1583408543, 1583408543),
(8, 23423, 1, 4, 'c5ecb3ff60425067363f9c46b9a8d4fa7f3dc85b', NULL, NULL, 4, 1, 0, 1583408581, 1583408581),
(9, 1123, 1, 2, 'ace9b96a312aad136c7ed20f34a183283ef3837c', NULL, NULL, 4, 1, 0, 1583408594, 1583408594),
(10, 1785, 1, 2, '672fb9f4c096b80666a23bdca33be125256cd16b', NULL, NULL, 4, 1, 0, 1583408742, 1583408742),
(11, 274, 1, 2, '2ed541f561271db360f2d663a2359124566f6cc5', NULL, NULL, 4, 1, 0, 1583408795, 1583408795),
(12, 1234, 1, 3, '222816124837c1831900bf9d937d2dad66022ec4', NULL, NULL, 4, 1, 0, 1583410255, 1583410255),
(13, 1111, 1, 3, '097d88ae201049ce10a1b644bf13b1c02409644e', NULL, NULL, 4, 1, 0, 1583413306, 1583413306),
(14, 1222, 50, 3, NULL, NULL, '', 3, 9, 0, 1583415740, 1583415420),
(15, 158373380099928, 1111, 4, '3945061b8ac0dbbf61a9ea98271b19e696546c20', NULL, NULL, 9, 1, 0, 1583733800, 1583733800),
(16, 158374633499983, 50, 3, NULL, NULL, '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"c479ba970bc15530ed772ebee934af0068e7ccb401f6817958ff3cb5cc608c6e\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"535854337\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 1, 1, 1583746341, 1583746334),
(17, 158375530099131, 222, 3, 'add7c0431c2ce7414dbaa98f7143c9791fa82dd1', NULL, NULL, 6, 1, 0, 1583755300, 1583755300),
(18, 158375533799877, 222, 3, NULL, NULL, '{\"amount\":\"22200\",\"response_code\":\"13666\",\"card_number\":\"405433******5085\",\"card_holder_name\":\"Ahmed Elmahdy\",\"signature\":\"f44da9ee92bdc9a621bdbe188dde20e8b155b418aa219ee6761160275558ba15\",\"payment_option\":\"VISA\",\"expiry_date\":\"2501\",\"customer_ip\":\"188.55.208.27\",\"eci\":\"ECOMMERCE\",\"fort_id\":\"158375535200074771\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062d\\u0631\\u0643\\u0629 \\u0645\\u0631\\u0641\\u0648\\u0636\\u0629\",\"merchant_reference\":\"1672706624\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"13\"}', 6, 1, 0, 1583765569, 1583755337),
(19, 158375899499187, 50, 1, NULL, 'منصة خدمات التأشيرات.pdf', NULL, 3, 1, 0, 1583765198, 1583758994),
(20, 158382176199277, 50, 1, NULL, 'receipt (8).pdf', NULL, 3, 1, 0, 1583821789, 1583821761),
(21, 158382182999195, 50, 3, NULL, NULL, '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"95cefdcff045ac4e01b80cae9ce742b846d3ab03086373498e593d59ec1b1d47\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1546377473\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 1, 0, 1583821851, 1583821829),
(22, 158382217799913, 1, 3, NULL, NULL, '{\"amount\":\"100\",\"response_code\":\"00072\",\"signature\":\"49769b4ee0bac3273d160305f5f93a51db3b673e0c71705b8d22164a5aad83f8\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1988473144\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 1, 0, 1583822186, 1583822177),
(23, 158382301599111, 50, 1, '1266541a5da27cec7a362043cce8255256ad0c28', NULL, NULL, 3, 1, 0, 1583823015, 1583823015);

-- --------------------------------------------------------

--
-- Table structure for table `donation_tags`
--

DROP TABLE IF EXISTS `donation_tags`;
CREATE TABLE IF NOT EXISTS `donation_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donation_tags`
--

INSERT INTO `donation_tags` (`tag_id`, `name`, `alias`, `description`, `arrangement`, `back_home`, `image`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'تحت المراجعة', 'تحت-المراجعة', 'عرض التبرعات التي مازالت تحت المراجعة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1583407883, 1583404335);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `mobile`, `full_name`, `email`, `mobile_confirmed`, `status`, `modified_date`, `create_date`) VALUES
(1, '+966 05 9776775', 'Ahmed Elmahdy', '', 'yes', 1, 1583676783, 1583237268),
(2, '+966 53 9776775', 'Ahmed Elmahdy', NULL, 'no', 0, 1583237404, 1583237404),
(3, '+966 54 9776775', 'Ahmed Elmahdy', NULL, 'no', 1, 1583237678, 1583237678),
(4, '+966 05 9776776', 'Ahmed Elmahdy', NULL, 'no', 0, 1583237822, 1583237822),
(5, '+966 55 5555555', 'Ahmed Elmahdy', NULL, 'no', 0, 1583237995, 1583237995),
(6, '+966 05 9776771', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238085, 1583238085),
(7, '+966 05 9776772', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238276, 1583238276),
(8, '+966 05 9776755', 'Ahmed Elmahdy', NULL, 'no', 0, 1583238315, 1583238315),
(9, '+966 05 9776779', 'Ahmed Elmahdy', NULL, 'yes', 1, 1583415420, 1583415420),
(10, '0597767751', 'Ahmed Elmahdy', NULL, 'yes', 2, 1583675359, 1583673484),
(11, '0597767751', 'Ahmed Elmahdy', 'a6e6s1@gmail.com', 'no', 2, 1583677328, 1583677328);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
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
(1, 'الإدارة', 'مجموعه تملك كافة الصلاحيات', '{\"admin_login\":{\"view\":\"1\"},\"Contacts\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donations\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donationtags\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donors\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Menus\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Paymentmethods\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projectcategories\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projects\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Projecttags\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Slides\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', 1, 1543493061, 1583934772),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `name`, `alias`, `url`, `type`, `arrangement`, `position`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الاقسام', 'الاقسام', '/categories', 'static', 100, NULL, 1, 1583936653, 1583936128);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
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
(1, 'عنا', 'عنا', '<p>Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n\r\n<p>Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read MoreFilm festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n\r\n<ul><li>\r\n	<p>Film festivals used to be do-or-die moments for movie makers</p>\r\n	</li>\r\n	<li>\r\n	<p>. They were where you met the producers that could fund your project,</p>\r\n	</li>\r\n	<li>\r\n	<p>and if the buyers liked your flick, they’d pay to Fast-forward and… Read More</p>\r\n	</li>\r\n</ul><p>123,456,789,</p>\r\n', 'unnamed2.gif', 'Film festivals,to be do-or-die,movie makers', 'Film festivals used to be do-or-die moments for movie makers', NULL, 1, 1543733978, 1548933384),
(2, 'سياسة الاستخدام', NULL, '<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p>سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام </p>\r\n\r\n<p> </p>\r\n', '', 'سياسة الاستخدام,سياسة الاستخدام,سياسة الاستخدام,سياسة الاستخدام', 'سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام سياسة الاستخدام', NULL, 1, 1548935358, 1583933060),
(3, 'قرطاسية', NULL, '<p><img alt=\"\" src=\"http://localhost/BerTraif/media/images/4853.jpg\" style=\"height:520px;width:449px;\" /></p>\r\n', 'thuma6e_13.png', '', '', NULL, 2, 1572266239, 1572266239),
(4, '', NULL, NULL, '', '', '', NULL, 2, 1572266245, 1572266245),
(5, 'rrtrt', NULL, NULL, '0025.jpg', '', '', NULL, 2, 1572351131, 1572356316),
(6, 'سياسة الخصوصية', NULL, '<p style=\"text-align:center;\">سياسة الخصوصية</p>\r\n', '', '', '', NULL, 1, 1573390923, 1574337169),
(7, 'فريق العمل', 'فريق-العمل', NULL, 'thuma6e_5.png', '', '', NULL, 1, 1578984687, 1578984687);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `meta` text,
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
  `description` text,
  `category_id` int(11) NOT NULL,
  `arrangement` int(11) DEFAULT NULL,
  `back_home` tinyint(1) DEFAULT NULL,
  `image` text,
  `secondary_image` varchar(255) DEFAULT NULL,
  `enable_cart` tinyint(1) DEFAULT NULL,
  `mobile_confirmation` tinyint(1) DEFAULT NULL,
  `donation_type` text,
  `payment_methods` varchar(255) DEFAULT NULL,
  `target_price` int(11) DEFAULT NULL,
  `fake_target` int(11) DEFAULT NULL,
  `collected_traget` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `thanks_message` text,
  `sms_msg` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `advertising_code` text,
  `header_code` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `name`, `alias`, `description`, `category_id`, `arrangement`, `back_home`, `image`, `secondary_image`, `enable_cart`, `mobile_confirmation`, `donation_type`, `payment_methods`, `target_price`, `fake_target`, `collected_traget`, `start_date`, `end_date`, `hidden`, `hits`, `thanks_message`, `sms_msg`, `mobile`, `whatsapp`, `advertising_code`, `header_code`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'حالة طارئة SOS   13644', 'حالة-طارئة-SOS---13644', 'أرملة  ومصدر دخلها من الضمان الاجتماعي وخدماتها موقوفة بسبب دين ومهددة بالسجن وبحاجة للمساعدة لسداد دينها المبلغ الإجمالي المطلوب 37,500 ريال  بحمد الله تعالى تم تقفيل الحالة .. جزاكم الله خيراً وجعله الله في ميزان حسناتكم\r\n', 1, 1, 0, '345_2.png', NULL, 1, 0, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0627\\u0636\\u062d\\u064a\\u0629\",\"value\":\"450\"},\"item2\":{\"name\":\"\\u0641\\u062f\\u064a\\u0629\",\"value\":\"400\"}}}', '[\"2\",\"1\"]', 1000000, 0, NULL, 1574812800, 1587686400, 1, NULL, 'تم الارسال .. وطلبكم الآن قيد المراجعة .. وسوف يتم ارسال رسالة نصية فور تأكيد الطلب .. \r\nشكرا جزيلاً لكم ..  بارك الله فيكم ونفعنا وأياكم وجعله في ميزان حسناتكم \r\nجمعية نماء بمنطقة مكة المكرمة ..', NULL, '1111111111', '1111111111', '', '', '', NULL, '', '', 1, 1, 1574256143, NULL),
(2, 'كسوة الشتاء', 'كسوة-الشتاء', '<p><strong>فكرة المشروع :</strong></p>\r\n\r\n<p>تأمين مستلزمات الشتاء الأساسية من بطانيات ودفايات التي لا يستغنى عنـها في أي منزل نتيجة لبرودة الجو .</p>\r\n\r\n<p><strong>أهمية المشروع :</strong></p>\r\n\r\n<p>تكمن أهمية المشروع في :</p>\r\n\r\n<ul>\r\n	<li>- عدم استطاعة الفقراء دفع تكاليف مستلزمات الشتاء .</li>\r\n	<li>- تخفيف معاناة برودة الجو القارس على الفقراء .</li>\r\n</ul>\r\n\r\n<p><strong>أهداف المشروع :</strong></p>\r\n\r\n<ul>\r\n	<li>- رفع معاناة الأسر الفقيرة المسجلة لدى الفرع وسد احتياجاتها .</li>\r\n	<li>- إيجاد طرق سهلة للمحسن للتبرع الدائم .</li>\r\n	<li>- إيجاد حلول عملية واقعية لرفع معاناة الفقير والمحتاج والعاطل .</li>\r\n	<li>- تحقيق التكافل الاجتماعي بين أفراد المجتمع .</li>\r\n	<li>- فتح باب المشاركة للمؤسسات التجارية المتخصصة وفاعلي الخير .</li>\r\n</ul>\r\n', 1, 100, 1, '345_18.png', '91ddb8751920595dfde2515820730482.gif', 1, 1, '{\"type\":\"unit\",\"value\":{\"item1\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\",\"value\":\"50\"},\"item2\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0646\",\"value\":\"100\"},\"item3\":{\"name\":\"\\u0643\\u0633\\u0648\\u0629 \\u0627\\u0633\\u0631\\u0629\",\"value\":\"200\"}}}', '[\"3\",\"2\",\"1\"]', 150000, 0, NULL, 1574208000, 1580428800, 0, NULL, 'شكرا لدعمكم', '', '597767751', '597767751', 'كود التتبع الاعلاني :', 'كود الهيدر :', 'rgba(255,33,17,1)', 'pic1521704669_11.png', 'مستلزمات الشتاء الأساسية,كسوة الشتاء', 'وصف مختصر لمحرك البحث', 1, 1, 1579693842, 1574238278),
(3, 'كفارة اليمين..', 'كفارة-اليمين--', '<p>( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )<br />\r\nزكـاتـك ... عطاء ونماء<br />\r\nالزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد<br />\r\nوهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم<br />\r\nيستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم<br />\r\nفضلا ادخل مبلغ الزكاة في خانة الكمية.<br />\r\nبارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم..</p>\r\n\r\n<p> </p>\r\n', 2, 0, 1, '[&#34;skyscraper-scaled.jpg&#34;,&#34;345.png&#34;]', 'inside- 3_14.jpg', 1, 1, '{\"type\":\"fixed\",\"value\":\"50\"}', '[\"4\",\"3\",\"2\",\"1\"]', 100, 0, 2000, 0, 0, 0, NULL, 'رسالة الشكر التلقائية :', 'الرسالة النصية القصيرة :', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1583334094, 1574249492),
(4, 'الحالات الطارئة4', 'الحالات-الطارئة4', '<p style=\"text-align:center;\">الحالات الطارئة4</p>\r\n', 1, 0, 0, '[&#34;pic1521704669.png&#34;,&#34;default.jpg&#34;,&#34;345.png&#34;]', '', 0, 0, '{\"type\":\"fixed\",\"value\":\"1\"}', '[\"4\",\"3\",\"2\",\"1\"]', 10, 0, NULL, 0, 0, 0, NULL, 'شكرا لتبرعك للحاللت الطارئة', '', '0597767751', '0597767751', '', '', '', '', '', '', 1, 1, 1583410241, 1574249556),
(5, 'qqqqqq', 'qqqqqq', NULL, 2, 0, 0, '', '', 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1576492983, 1576492983),
(6, 'qqqqqq', 'qqqqqq', NULL, 2, 0, 0, '', '', 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1576493017, 1576493017),
(7, 'qqqqqq', 'qqqqqq', NULL, 2, 0, 0, '', '', 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1576493226, 1576493226),
(8, 'المشروع', '-المشروع', NULL, 2, 0, 0, '', 'inside- 3_4.jpg', 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1579689776, 1576493238),
(9, 'qqqqqq', 'qqqqqq', NULL, 2, 0, 0, '', '', 0, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1576496602, 1576496602),
(10, 'ضضضضضضضضضضضض', 'ضضضضضضضضضضضض', NULL, 1, 0, 0, '', '', 1, 0, '{\"type\":\"open\"}', '[\"4\"]', 0, 0, NULL, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', 1, 1, 1580133409, 1576496713);

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
CREATE TABLE IF NOT EXISTS `project_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`category_id`, `name`, `alias`, `description`, `arrangement`, `back_home`, `image`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الحالات الطارئة', 'Unayzah', 'عطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 100, 1, 'section.png', '', '', '', '', 1, 1, 1579521941, 1573998457),
(2, 'الكفارات', 'الحالات-الطارئة', 'فكرة المشروع : تأمين مستلزمات الشتاء الأساسية من بطانيات ودفايات التي لا يستغنى عنـها في أي منزل .\r\n\r\nعطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 100, 1, 'section-1.png', '', '', 'الحالات الطارئة,تبرع,كفالة', 'عطاؤك يساعد أمّاً لاجئة على إعالة وحماية أطفالها ويعيد لهم الأمل بعد أن خسروا الوطن والسند.', 1, 1, 1579524690, 1573998549),
(3, 'إبدأها بصدقة', 'إبدأها-بصدقة', 'اشتريت سيارة جديدة؟ رزقت بمولود؟ بدأت مشروع جديد؟ بدأت عملك الجديد ؟ ما رأيك أن تبدأ كل جديد ، بصدقة ستسعدك أكيد', 0, 1, 'inside- 3.jpg', '', '', '', '', 1, 1, 1579522051, 1579522051);

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

DROP TABLE IF EXISTS `project_tags`;
CREATE TABLE IF NOT EXISTS `project_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`tag_id`, `name`, `alias`, `description`, `arrangement`, `back_home`, `image`, `background_color`, `background_image`, `meta_keywords`, `meta_description`, `featured`, `status`, `modified_date`, `create_date`) VALUES
(1, 'الأكثر طلباً', 'الأكثر-طلبا', 'تجد هنا المشروعات الاكثر طلبا', 100, 1, 'thuma6e_9.png', '', '', '', '', 1, 0, 1575450678, 1575381344),
(2, 'جديد', 'جديد', '', 0, 0, '', '', '', '', '', 0, 0, 1575457921, 1575457921);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `value` mediumtext,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `title`, `alias`, `value`, `create_date`, `modified_date`) VALUES
(1, 'الاعدادات العامة', 'site', '{\"title\":\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0646\\u0645\\u0627\\u0621 \",\"logo\":\"pic1521704669.png\",\"header_code\":\"\",\"footer_code\":\"\",\"show_banner\":\"0\",\"show_projects\":\"0\",\"show_categories\":\"0\",\"show_bottom\":\"0\",\"show_footer\":\"0\"}', 1583845973, 1583850876),
(2, 'اعدادات بيانات التواصل', 'contact', '{\"phone\":\"0597767751\",\"phone2\":\"0597767751\",\"mobile\":\"0597767751\",\"mobile2\":\"0597767751\",\"fax\":\"0597767751\",\"address\":\"\\u062c\\u062f\\u0629 \\u062d\\u064a \\u0627\\u0644\\u0646\\u0639\\u064a\\u0645\",\"map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m13!1m8!1m3!1d3710.8054150744156!2d39.1637415!3d21.5544626!3m2!1i1024!2i768!4f13.1!3m2!1m1!2sNamaa!5e0!3m2!1sar!2ssa!4v1583928833064!5m2!1sar!2ssa\"}', 1583845973, 1583928866),
(3, 'اعدادات الارشفة', 'seo', '{\"meta_keywords\":\"\",\"meta_description\":\"\"}', 1583845973, 1583916715),
(4, 'اعدادات بيانات التواصل', 'social', '{\"facebook\":\"\",\"twitter\":\"\",\"instagram\":\"\",\"linkedin\":\"\",\"youtube\":\"\"}', 1583845973, 1583916702),
(5, 'اعدادات البريد الالكتروني', 'email', '{\"contacts_email\":\"\",\"donation_email\":\"\"}', 1583845973, 1583916692),
(6, 'اعدادات رسائل SMS', 'sms', '{\"gateurl\":\"\",\"sms_username\":\"\",\"sms_password\":\"\",\"smsenabled\":\"0\"}', 1583845973, 1583916683),
(7, 'اعدادات التصميم', 'theme', '{\"background_color\":\"\",\"background_image\":\"\",\"banner_image\":\"\",\"projects_image\":\"\",\"categories_image\":\"\"}', 1583845973, 1583932736);

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
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_donations`
--

INSERT INTO `tags_donations` (`tags_donations_id`, `tag_id`, `donation_id`, `create_date`, `modified_date`) VALUES
(3, 1, 19, 1583765198, 1583765198),
(5, 1, 18, 1583765569, 1583765569);

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_projects`
--

INSERT INTO `tags_projects` (`tags_projects_id`, `tag_id`, `project_id`, `create_date`, `modified_date`) VALUES
(1, 1, 1, 212222, NULL),
(3, 2, 1, 2133123, NULL),
(4, 2, 9, 1576496602, 1576496602),
(5, 1, 9, 1576496602, 1576496602),
(15, 1, 2, 1579693842, 1579693842),
(82, 2, 3, 1583334094, 1583334094),
(83, 1, 3, 1583334094, 1583334094);

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
  `image` tinytext,
  `bio` text,
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
(22, 'احمد المهدي', 'a6e6s1@gmail.com', '$2y$10$veHBsCh4q39J.k0MPGKfDuHhraBWnyQmnhoBVRIA1rZyL.eLAp61a', '597767751', 'thuma6e.png', '', '98783', 0, 1, 1583934776, 1, 1574344167, 1543831099),
(23, 'Monyb Younos', 'munybe@gmail.com', '$2y$10$Raf3iUVZJPQr4//YEBuypO.fWDuSWTRZPDmCa7.Ta84v21ZFWl056', '0597767751', 'logo-xl.png', '', NULL, NULL, 3, NULL, 1, 1572786141, 1572786123);

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
