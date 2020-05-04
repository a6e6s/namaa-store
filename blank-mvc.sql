-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2020 at 11:56 AM
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
  `donation_identifier` bigint(15) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` bigint(20) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `donation_type` varchar(200) DEFAULT '" "',
  `payment_method_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `banktransferproof` varchar(255) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT 0,
  `gift_data` mediumtext DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `donor_id` (`donor_id`),
  KEY `project_id` (`project_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donation_identifier`, `amount`, `total`, `quantity`, `donation_type`, `payment_method_id`, `order_id`, `hash`, `banktransferproof`, `gift`, `gift_data`, `meta`, `project_id`, `donor_id`, `status_id`, `status`, `modified_date`, `create_date`) VALUES
(2, 1, 1, 1, 1, ' ', 1, 0, NULL, 'خطاب إلغاء_18.pdf', 0, NULL, NULL, 4, 1, 3, 3, 1583315262, 1583315247),
(3, 3, 50, 50, 1, ' ', 1, 0, NULL, '1413b43d-6c7d-4d71-aac5-b03783646302.jpg', 0, NULL, NULL, 2, 1, 0, 0, 1583320401, 1583320375),
(4, 4, 50, 50, 1, ' ', 4, 0, '748a51d1b312aa689bd1dbf239d73c6879d67cef', NULL, 0, NULL, NULL, 3, 1, 0, 3, 1583399753, 1583399753),
(5, 6, 50, 50, 1, ' ', 4, 0, '696204a4ab1e58b428aa58c7252f3be5c756baf0', NULL, 0, NULL, NULL, 3, 1, 0, 1, 1583408352, 1583408352),
(6, 5465, 1, 1, 1, ' ', 2, 0, 'f53e892aafe039fccb5e2b72a21aa83a13d320fb', NULL, 0, NULL, NULL, 4, 1, 0, 0, 1583408524, 1583408524),
(7, 54654, 1, 1, 1, ' ', 4, 0, 'ecdb6e8ba92601d8991fa761886288181db86e2a', NULL, 0, NULL, NULL, 4, 1, 4, 3, 1583408543, 1583408543),
(8, 23423, 1, 1, 1, ' ', 4, 0, 'c5ecb3ff60425067363f9c46b9a8d4fa7f3dc85b', NULL, 0, NULL, NULL, 4, 1, 0, 1, 1583408581, 1583408581),
(9, 1123, 1, 1, 1, ' ', 2, 0, 'ace9b96a312aad136c7ed20f34a183283ef3837c', NULL, 0, NULL, NULL, 4, 1, 1, 3, 1583408594, 1583408594),
(10, 1785, 1, 1, 1, ' ', 2, 0, '672fb9f4c096b80666a23bdca33be125256cd16b', NULL, 0, NULL, NULL, 4, 1, 0, 1, 1583408742, 1583408742),
(11, 274, 1, 1, 1, ' ', 2, 0, '2ed541f561271db360f2d663a2359124566f6cc5', NULL, 0, NULL, NULL, 4, 1, 1, 0, 1583408795, 1583408795),
(12, 1234, 1, 1, 1, ' ', 3, 0, '222816124837c1831900bf9d937d2dad66022ec4', NULL, 0, NULL, NULL, 4, 1, 3, 3, 1583410255, 1583410255),
(13, 1111, 1, 1, 1, ' ', 3, 0, '097d88ae201049ce10a1b644bf13b1c02409644e', NULL, 0, NULL, NULL, 4, 1, 0, 1, 1583413306, 1583413306),
(14, 1222, 50, 50, 1, ' ', 3, 0, NULL, NULL, 0, NULL, '', 3, 9, 1, 2, 1583415740, 1583415420),
(15, 158373380099928, 1111, 1111, 1, ' ', 4, 0, '3945061b8ac0dbbf61a9ea98271b19e696546c20', NULL, 0, NULL, NULL, 9, 1, 3, 3, 1583733800, 1583733800),
(16, 158374633499983, 50, 50, 1, ' ', 3, 0, NULL, NULL, 0, NULL, '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"c479ba970bc15530ed772ebee934af0068e7ccb401f6817958ff3cb5cc608c6e\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"535854337\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 1, 1, 3, 1583746341, 1583746334),
(17, 158375530099131, 222, 222, 1, ' ', 3, 0, 'add7c0431c2ce7414dbaa98f7143c9791fa82dd1', NULL, 0, NULL, NULL, 6, 1, 1, 3, 1583755300, 1583755300),
(18, 158375533799877, 222, 222, 1, ' ', 3, 0, NULL, NULL, 0, NULL, '{\"amount\":\"22200\",\"response_code\":\"13666\",\"card_number\":\"405433******5085\",\"card_holder_name\":\"Ahmed Elmahdy\",\"signature\":\"f44da9ee92bdc9a621bdbe188dde20e8b155b418aa219ee6761160275558ba15\",\"payment_option\":\"VISA\",\"expiry_date\":\"2501\",\"customer_ip\":\"188.55.208.27\",\"eci\":\"ECOMMERCE\",\"fort_id\":\"158375535200074771\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062d\\u0631\\u0643\\u0629 \\u0645\\u0631\\u0641\\u0648\\u0636\\u0629\",\"merchant_reference\":\"1672706624\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"13\"}', 6, 1, 1, 1, 1583765569, 1583755337),
(19, 158375899499187, 50, 50, 1, ' ', 1, 0, NULL, 'منصة خدمات التأشيرات.pdf', 0, NULL, NULL, 3, 1, 3, 1, 1583765198, 1583758994),
(20, 158382176199277, 50, 50, 1, ' ', 1, 0, NULL, 'receipt (8).pdf', 0, NULL, NULL, 3, 1, 3, 1, 1583821789, 1583821761),
(21, 158382182999195, 50, 50, 1, ' ', 3, 0, NULL, NULL, 0, NULL, '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"95cefdcff045ac4e01b80cae9ce742b846d3ab03086373498e593d59ec1b1d47\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1546377473\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 1, 1, 3, 1, 1584440018, 1583821829),
(22, 158382217799913, 1, 1, 1, ' ', 4, 0, NULL, NULL, 0, NULL, '{\"amount\":\"100\",\"response_code\":\"00072\",\"signature\":\"49769b4ee0bac3273d160305f5f93a51db3b673e0c71705b8d22164a5aad83f8\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1988473144\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 10, 1, 1, 3, 1584356204, 1583822177),
(23, 158382301599111, 50, 50, 1, ' ', 1, 0, '1266541a5da27cec7a362043cce8255256ad0c28', NULL, 0, NULL, NULL, 8, 1, 1, 0, 1584440046, 1583823015),
(24, 158453576299274, 11, 33, 3, ' ', 1, 0, NULL, 'image_1807c.png', 0, NULL, NULL, 11, 1, 0, 1, 1584972974, 1584535762),
(25, 158453688199589, 11, 11, 1, ' ', 1, 0, NULL, 'image_6ae51.jpg', 1, '{\"enable\":\"1\",\"giver_name\":\"\\u0627\\u062d\\u0645\\u062f \\u0627\\u0644\\u0645\\u0647\\u062f\\u064a\",\"giver_number\":\"+966 55 5555555\",\"giver_group\":\"\\u0627\\u0644\\u064a \\u0632\\u0648\\u062c\\u062a\\u064a\",\"card\":\"inside- 3_10.jpg\"}', NULL, 11, 1, 0, 0, 1584972955, 1584536881),
(26, 158497124999143, 1111, 1111, 1, 'سهم3', 4, 0, 'd40819677a35ec0a311ab065ed5c78dde677ff49', NULL, 0, '{\"enable\":0}', NULL, 6, 1, 2, 0, 1584971249, 1584971249),
(27, 158497135499294, 50, 200, 4, 'قيمة ثابته', 3, 0, NULL, NULL, 1, '{\"enable\":\"1\",\"giver_name\":\"\\u0627\\u062d\\u0645\\u062f \\u0627\\u0644\\u0645\\u0647\\u062f\\u064a\",\"giver_number\":\"+966 22 2222222\",\"giver_group\":\"\\u0627\\u0644\\u064a \\u0627\\u0645\\u064a\",\"card\":\"thuma6e_9.png\"}', '{\"amount\":\"20000\",\"response_code\":\"00072\",\"signature\":\"4c572c241b9965ad4e2c33bc9f3bdd14939129fdec2790ffeff2ab8f9e517c2a\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1448377787\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 1, 1, 3, 1584971362, 1584971354),
(28, 158550405899954, 11, 11, 1, 'فدية', 3, 0, '5aea373c68ba15026dc39317fa19218556e93ac9', NULL, 0, '', NULL, 4, 12, 1, 3, 1585504058, 1585504058),
(29, 158550414299585, 11, 11, 1, 'فدية', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"7ae1432d898973a4231b92b194634d1620102936daee377a6c722d868ed47310\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1246620584\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 12, 2, 4, 1585504149, 1585504142),
(30, 158550414299585, 100, 100, 1, 'مفتوح', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"7ae1432d898973a4231b92b194634d1620102936daee377a6c722d868ed47310\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1246620584\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 10, 12, 0, 1, 1585504149, 1585504142),
(31, 158550432499793, 111, 111, 1, 'كسوة فرد', 1, 0, NULL, 'image_bb5d7.jpg', 0, '', NULL, 4, 4, 2, 1, 1585504380, 1585504324),
(32, 158550432499793, 50, 50, 1, 'قيمة ثابته', 1, 0, NULL, 'image_bb5d7.jpg', 0, '', NULL, 3, 4, 2, 1, 1586287457, 1585504324),
(33, 158550432499793, 100, 100, 1, 'كسوة فردين', 1, 0, NULL, 'image_bb5d7.jpg', 0, '', NULL, 2, 4, 2, 1, 1585504380, 1585504324),
(34, 158551448899288, 11, 22, 2, 'فدية', 2, 0, '62b68ec36b9ea7c4588c9ce387a59e206d97dd6c', NULL, 0, '', NULL, 4, 1, 2, 1, 1585514488, 1585514488),
(35, 158551448899288, 199, 199, 1, 'كسوة اسرة', 2, 0, '62b68ec36b9ea7c4588c9ce387a59e206d97dd6c', NULL, 0, '', NULL, 2, 1, 2, 1, 1585514488, 1585514488),
(36, 158551466899940, 50, 50, 1, 'قيمة ثابته', 2, 0, '2c1b3feffac4588ccd01b6477efcc2f392fb9c1e', NULL, 0, '', NULL, 3, 13, 2, 1, 1585514668, 1585514668),
(37, 158574257699110, 50, 50, 1, 'قيمة ثابته', 2, 0, 'af4befc237493f38f76e20d3e0471e1bc288bcf9', NULL, 0, '', NULL, 15, 14, 2, 1, 1585742576, 1585742576),
(38, 158593019599310, 10, 10, 1, 'مفتوح', 3, 0, NULL, NULL, 1, '{\"enable\":\"1\",\"giver_name\":\"\\u0627\\u062d\\u0645\\u062f \\u0627\\u0644\\u0645\\u0647\\u062f\\u064a\",\"giver_number\":\"+966 22 2222222\",\"giver_group\":\"\\u0627\\u0644\\u064a \\u0632\\u0648\\u062c\\u062a\\u064a\",\"card\":\"inside- 3.jpg\"}', '{\"amount\":\"1000\",\"response_code\":\"00072\",\"signature\":\"f46618d9447a4f52028c26d37993d44ed59cb1a0a8f1fbc98a54fb1210e2a3e7\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1797414442\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 19, 15, 2, 1, 1585930202, 1585930195),
(39, 158593798499293, 50, 100, 2, 'قيمة ثابته', 4, 0, 'c6e8b9ec76df60ed985b23257cf07039b4f66c3c', NULL, 1, '{\"enable\":\"1\",\"giver_name\":\"\\u0627\\u062d\\u0645\\u062f \\u0627\\u0644\\u0645\\u0647\\u062f\\u064a\",\"giver_number\":\"+966 22 2222222\",\"giver_group\":\"\\u0627\\u0644\\u064a \\u0635\\u062f\\u0633\\u0642\\u0633\",\"card\":\"thuma6e.png\"}', NULL, 3, 15, 2, 1, 1586287469, 1585937984),
(40, 158635333799818, 111, 111, 1, 'كسوة فرد', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"36100\",\"response_code\":\"00072\",\"signature\":\"bd4b52d9b990921a80f97f315c1d69af1b542584f4dc873b4925f04e44832213\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1260732887\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 16, 0, 1, 1586353345, 1586353337),
(41, 158635333799818, 50, 100, 2, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"36100\",\"response_code\":\"00072\",\"signature\":\"bd4b52d9b990921a80f97f315c1d69af1b542584f4dc873b4925f04e44832213\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1260732887\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 16, 0, 1, 1586353345, 1586353337),
(42, 158635333799818, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"36100\",\"response_code\":\"00072\",\"signature\":\"bd4b52d9b990921a80f97f315c1d69af1b542584f4dc873b4925f04e44832213\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1260732887\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 14, 16, 0, 1, 1586353345, 1586353337),
(43, 158635333799818, 100, 100, 1, 'كسوة فردين', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"36100\",\"response_code\":\"00072\",\"signature\":\"bd4b52d9b990921a80f97f315c1d69af1b542584f4dc873b4925f04e44832213\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1260732887\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 2, 16, 0, 1, 1586353345, 1586353337),
(44, 158635384999450, 111, 111, 1, 'كسوة فرد', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"bfd3d6944a33648ef40baf539b016c55a1c180d12aa1bccb4391ac1bf11f91dd\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"971129346\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 16, 0, 1, 1586353854, 1586353849),
(45, 158635415099475, 111, 111, 1, 'كسوة فرد', 3, 0, 'a921c993795fd7c7e22cc8ca41c0259b3391dbb0', NULL, 0, '', NULL, 4, 16, 0, 1, 1586354150, 1586354150),
(46, 158635444699932, 111, 111, 1, 'كسوة فرد', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"e382a5adc32313bbf328fe5f900303fc5ef504c8c52cc070cd8360210396bbc9\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"976501687\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 16, 0, 1, 1586354932, 1586354446),
(47, 158635509599173, 100, 100, 1, 'مفتوح', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"10000\",\"response_code\":\"00072\",\"signature\":\"ecd3050d00ac2b695a4975806549b346e7a03da4ca7b1cf2a34ca2e3ddb55f01\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"49298362\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 10, 16, 0, 1, 1586355102, 1586355095),
(48, 158635574799018, 111, 111, 1, 'فدية', 3, 0, NULL, NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '{\"amount\":\"11100\",\"response_code\":\"00072\",\"signature\":\"774c58b1f7d4133c9575ad53e342a74eca7679a74d09a33ed8f1c1d5fd5e58eb\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1564323784\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 15, 0, 1, 1586355754, 1586355747),
(49, 158635582099128, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"44bf7e3f93f52a0786450a54404bfe8f7354cc68f996c06649ba11a0a40c79b9\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"195703989\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 16, 0, 1, 1586355892, 1586355820),
(50, 158639210899257, 50, 50, 1, 'قيمة ثابته', 1, 0, NULL, 'image_508ff.jpg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 3, 12, 0, 1, 1586392163, 1586392108),
(51, 158672307199784, 111, 111, 1, 'فدية', 1, 0, '576d6bfe849e5b09653c6ffc459f39ec6a434328', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586723071, 1586723071),
(52, 158678330299875, 111, 111, 1, 'فدية', 2, 0, '5669919943db4e550dd8078f353d9b312df8b714', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783302, 1586783302),
(53, 158678335599557, 111, 111, 1, 'فدية', 2, 0, 'f1e6279cd819408801e69431f46308b272f94446', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783355, 1586783355),
(54, 158678344299217, 111, 111, 1, 'فدية', 2, 0, 'f853d15acea495fecca0c0178b23feb188137820', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783442, 1586783442),
(55, 158678346899863, 111, 111, 1, 'فدية', 2, 0, 'b16b634ebe65d50df46329c318ea7b6a9f9dd8a9', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783468, 1586783468),
(56, 158678351299249, 111, 111, 1, 'فدية', 2, 0, '564109e6d021683a7e2f05be73d5cab00423a68d', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783512, 1586783512),
(57, 158678364499817, 111, 111, 1, 'فدية', 4, 0, '9fb51b95e93de515067e2383fbba405188f38533', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586783644, 1586783644),
(58, 158678407899054, 111, 111, 1, 'فدية', 4, 0, '4d6e902d03799c2c6dd60c1f9f75c9def180944d', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586784078, 1586784078),
(59, 158678411299596, 111, 111, 1, 'فدية', 4, 0, 'db08274c4a32d05d3ec7bed836084718a2eff70e', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586784112, 1586784112),
(60, 158678465299128, 111, 111, 1, 'فدية', 4, 0, '5ff82c32bf4980509836a294820d440c4258827e', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586784652, 1586784652),
(61, 158678796699815, 111, 111, 1, 'كسوة فرد', 3, 0, '0a37c8c82386db4fd100f6eff72af563b907daa2', NULL, 0, '', NULL, 4, 12, 0, 1, 1586787966, 1586787966),
(62, 158678804299871, 50, 50, 1, 'قيمة ثابته', 3, 0, '92b8999f00b806127c0d3f6bad99c0604bb85bae', NULL, 0, '', NULL, 3, 17, 0, 1, 1586788042, 1586788042),
(63, 158678899699516, 50, 50, 1, 'قيمة ثابته', 3, 0, '324cec75630464d678ac6ac069ddbcb1d9941540', NULL, 0, '', NULL, 3, 12, 0, 1, 1586788996, 1586788996),
(64, 158678928199394, 50, 50, 1, 'قيمة ثابته', 3, 0, 'cda2f12fd5866dce600d6cc27e01f99766239308', NULL, 0, '', NULL, 3, 12, 0, 1, 1586789281, 1586789281),
(65, 158678935799377, 50, 50, 1, 'قيمة ثابته', 3, 0, 'c6c03ac934f3565e65f8576596d5428deca4eb3e', NULL, 0, '', NULL, 3, 12, 0, 1, 1586789357, 1586789357),
(66, 158678957299701, 100, 100, 1, 'كسوة فردين', 3, 0, '07638216236280e7e06a91f6f66c2c1dd1e4f99b', NULL, 0, '', NULL, 2, 12, 0, 1, 1586789572, 1586789572),
(67, 158678989099634, 100, 100, 1, 'مفتوح', 3, 0, '4c35657c4aaf558bba9fe2c4b8a0471dc0357cce', NULL, 0, '', NULL, 10, 12, 0, 1, 1586789890, 1586789890),
(68, 158678992399736, 111, 111, 1, 'فدية', 3, 0, 'e8d693c482044a038ea5066c58f0e126dcf57abd', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586789923, 1586789923),
(69, 158679007599236, 111, 111, 1, 'فدية', 3, 0, '1b87253c1a51b6b582c21759ffb4bcb11fcbd4bb', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 17, 0, 1, 1586790075, 1586790075),
(70, 158685953899224, 111, 111, 1, 'فدية', 1, 0, '211cea9f45f8bde086c21430725b382fef990d48', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 18, 0, 1, 1586859538, 1586859538),
(71, 1007071267, 11, 11, 1, 'فدية', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"6100\",\"response_code\":\"00072\",\"signature\":\"62fca132d0d163db128adc9e2dc2e75d746403f0ce9af8861f71e0ba7b33fc8d\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1750785866\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 12, 0, 1, 1587071281, 1587071267),
(72, 1007071267, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"6100\",\"response_code\":\"00072\",\"signature\":\"62fca132d0d163db128adc9e2dc2e75d746403f0ce9af8861f71e0ba7b33fc8d\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1750785866\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 15, 12, 0, 1, 1587071281, 1587071267),
(73, 1007072375, 11, 11, 1, 'سهم3', 3, 0, NULL, NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '{\"amount\":\"1100\",\"response_code\":\"00072\",\"signature\":\"2d8dd956343a97634fa2812238f1b62d630c532eec5151d706c6748e8e5c4748\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1296807254\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 11, 12, 0, 1, 1587072382, 1587072375),
(74, 1007077117, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 12, 0, 1, 1587077130, 1587077117),
(75, 1007077117, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 15, 12, 0, 1, 1587077130, 1587077117),
(76, 1007077117, 111, 111, 1, 'كسوة فرد', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 12, 0, 1, 1587077130, 1587077117),
(77, 1007077336, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"952ca345c7daef9903e25132b98d806fe6891fd082d3b3ef1bf425beb308b124\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1807096545\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 18, 0, 1, 1587077342, 1587077336),
(78, 1007077396, 50, 50, 1, 'كسوة اسرة', 3, 0, NULL, NULL, 0, '{\"enable\":0}', '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"5f45959db833839304143daa98ca2217e98211ec121d417ba79acf6f583c5940\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"2070804670\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 2, 18, 0, 1, 1587077406, 1587077396),
(79, 1007077630, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"5000\",\"response_code\":\"00072\",\"signature\":\"be48f033001f0a3424bad0c32c7d8943e5f5978660a949eb52503fb788a4d135\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"720760860\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 18, 0, 1, 1587077638, 1587077630),
(80, 1007077726, 11, 11, 1, 'سهم3', 1, 0, 'b5953750507d8916570ee1f35686ccd1d2e07c49', NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 11, 18, 0, 1, 1587077726, 1587077726),
(81, 1007077749, 11, 11, 1, 'سهم3', 3, 0, NULL, NULL, 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', '{\"amount\":\"1100\",\"response_code\":\"00072\",\"signature\":\"fccf28361c63732836ac2e6a555ac0926221f85d25d92eec0a6e8fb0c2e1a72e\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1432675692\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 11, 18, 0, 1, 1587077768, 1587077749),
(82, 1007079394, 111, 111, 1, 'كسوة فرد', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"5825e1aa83b1ea92a0b32577888c70a98078b53cae9003b5e005b2d176787b20\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1548211642\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 4, 18, 0, 1, 1587079406, 1587079394),
(83, 1007079394, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"5825e1aa83b1ea92a0b32577888c70a98078b53cae9003b5e005b2d176787b20\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1548211642\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 18, 0, 1, 1587079406, 1587079394),
(84, 1007079394, 50, 50, 1, 'قيمة ثابته', 3, 0, NULL, NULL, 0, '', '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"5825e1aa83b1ea92a0b32577888c70a98078b53cae9003b5e005b2d176787b20\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"1548211642\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 14, 18, 0, 1, 1587079406, 1587079394),
(85, 1007341209, 111, 111, 1, 'فدية', 1, 0, NULL, 'image_b4a09.jpg', 0, '{\"enable\":\"0\",\"giver_name\":\"\",\"giver_number\":\"\",\"giver_group\":\"\"}', NULL, 4, 18, 0, 0, 1587341268, 1587341209),
(86, 1007385807, 111, 111, 1, 'كسوة فرد', 3, 0, '2e2ac5469eb627c07731774fc73d6cc871e9c166', NULL, 0, '', NULL, 4, 18, 0, 0, 1587385807, 1587385807),
(87, 1007385807, 50, 50, 1, 'قيمة ثابته', 3, 0, '2e2ac5469eb627c07731774fc73d6cc871e9c166', NULL, 0, '', NULL, 3, 18, 0, 0, 1587385807, 1587385807),
(88, 1007385837, 111, 111, 1, 'كسوة فرد', 3, 0, '6b2c55302d9de5e9149f7adcbaca093fd60d0056', NULL, 0, '', NULL, 4, 18, 0, 0, 1587385837, 1587385837),
(89, 1007386222, 50, 50, 1, 'قيمة ثابته', 3, 0, '5457317eb0afa4d8a4373d92da9bfe8d0b5f0144', NULL, 0, '', NULL, 3, 18, 0, 0, 1587386222, 1587386222),
(90, 1007386240, 50, 50, 1, 'قيمة ثابته', 2, 0, '76dd97c7ffc2649f3b21282827c28c3e8e283482', NULL, 0, '', NULL, 3, 18, 0, 0, 1587386240, 1587386240);

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
  `amount` int(11) NOT NULL,
  `total` bigint(20) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `donation_type` varchar(200) DEFAULT '" "',
  `payment_method_id` int(11) NOT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `banktransferproof` varchar(255) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT 0,
  `gift_data` mediumtext DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL,
  `modified_date` int(10) DEFAULT NULL,
  `create_date` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `donor_id` (`donor_id`),
  KEY `project_id` (`project_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_identifier`, `amount`, `total`, `quantity`, `donation_type`, `payment_method_id`, `hash`, `banktransferproof`, `gift`, `gift_data`, `meta`, `project_id`, `donor_id`, `status_id`, `status`, `modified_date`, `create_date`) VALUES
(1, 1007077117, 50, 150, 3, 'قيمة ثابته', 3, '0', NULL, 0, NULL, '{\"amount\":\"21100\",\"response_code\":\"00072\",\"signature\":\"b4e49fabe5496ccc47cf6058d6bc5169bc6b13650f13ad80f2aa9e80361cfb18\",\"command\":\"PURCHASE\",\"response_message\":\"\\u062a\\u0645 \\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"merchant_reference\":\"68908197\",\"customer_email\":\"test@payfort.com\",\"currency\":\"SAR\",\"status\":\"00\"}', 3, 12, 4, 1, 1588074971, 1587077117);

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
(22, 'احمد المهدي', 'a6e6s1@gmail.com', '$2y$10$veHBsCh4q39J.k0MPGKfDuHhraBWnyQmnhoBVRIA1rZyL.eLAp61a', '597767751', 'thuma6e.png', '', '98783', 0, 1, 1587942664, 1, 1574344167, 1543831099),
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
