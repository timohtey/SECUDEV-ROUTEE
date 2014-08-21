-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2014 at 07:45 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `403208`
--

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(50) NOT NULL,
  `Address` varchar(90) NOT NULL,
  `date` datetime NOT NULL,
  `deleted` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `description`, `lat`, `lng`, `type`, `Address`, `date`, `deleted`) VALUES
(8, 'person jumped all stopped', 14.538184, 121.008278, 'Accident', 'Epifanio de los Santos Avenue, Pasay, Philippines', '2014-04-06 21:10:40', 'yes'),
(7, 'car crash', 14.544789, 121.022911, 'Accident', 'Epifanio de los Santos Avenue, Makati, Philippines', '2014-04-06 21:10:20', 'yes'),
(9, 'Destoyed road', 14.564921, 120.993950, 'Construction', 'De La Salle University, Taft Avenue, Manila, Metro Manila', '2014-04-07 08:11:06', 'yes'),
(10, 'accident!', 14.436610, 121.045563, 'Accident', 'Multisystem Bldg., Km. 22 SLEX East Service Road, Muntinlupa 1771, Philippines', '2014-04-07 10:07:06', 'no'),
(11, 'Stuck in traffic', 14.619797, 121.050797, 'Heavy Traffic', 'Epifanio de los Santos Avenue, Quezon City, Philippines', '2014-04-07 10:10:35', 'no'),
(12, 'road fix', 14.438254, 121.050735, 'Construction', 'Manuel L. Quezon, Muntinlupa, Philippines', '2014-04-07 10:09:56', 'no'),
(13, 'traffic northbound', 14.431189, 121.050133, 'Heavy Traffic', 'Manuel L. Quezon, Muntinlupa, Philippines', '2014-04-07 10:10:19', 'no'),
(14, 'car crash caused traffic', 14.444488, 121.045151, 'Heavy Traffic', 'West Service Road, Muntinlupa, Philippines', '2014-04-07 10:10:51', 'yes'),
(15, 'So traffic! bumper to bumper!', 14.444478, 121.045258, 'Heavy Traffic', 'Radial Road 3, Muntinlupa, Philippines', '2014-04-07 10:14:17', 'yes'),
(16, 'nagmimina', 14.436376, 121.045471, 'Construction', 'Radial Road 3, Muntinlupa, Philippines', '2014-04-07 10:20:42', 'no'),
(17, 'Nagmimina', 14.620461, 121.008911, 'Construction', 'Kabignayan, Quezon City, Philippines', '2014-04-07 14:14:55', 'no'),
(18, 'soehing', 14.452614, 121.049011, 'Construction', 'Sucat, Meralco Road, Muntinlupa, Metro Manila', '2014-04-07 14:27:58', 'no'),
(19, '2 Jeepneys Collision', 14.575360, 120.996040, 'Accident', '1345 Quirino Avenue, Manila, Philippines', '2014-04-07 14:32:32', 'no'),
(20, 'a guy git shit', 14.442244, 121.038261, 'Accident', 'Santan, ParaÃ±aque, Philippines', '2014-04-07 14:34:57', 'no'),
(21, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:27', 'no'),
(22, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:28', 'no'),
(23, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:30', 'no'),
(24, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(25, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(26, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(27, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(28, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(29, 'Nalunod ako', 14.599698, 121.027748, 'Flood', 'San Mauriclo, San Juan, Philippines', '2014-04-07 19:55:32', 'no'),
(30, '5 days', 14.568548, 120.986565, 'Construction', 'San Andres Street, Manila, Philippines', '2014-04-08 07:23:46', 'no'),
(31, 'Yo mama', 14.567593, 120.993042, 'Accident', 'Taft Avenue, Maynila, Pilipinas', '2014-05-29 15:05:56', 'no'),
(32, 'ihugy', 14.558434, 121.020981, 'Accident', 'Valero, Makati, Pilipinas', '2014-07-10 15:19:59', 'no'),
(33, 'ihugy', 14.558434, 121.020981, 'Accident', 'Valero, Makati, Pilipinas', '2014-07-10 15:20:00', 'no'),
(34, 'SO MENI CR+ARz', 14.128611, 120.905830, 'Heavy Traffic', 'Mendez, Calabarzon', '2014-07-10 15:18:52', 'no'),
(35, 'MENI CARSZ', 14.128752, 120.905571, 'Heavy Traffic', 'Alegre, Mendez, Philippines', '2014-07-10 15:20:10', 'no'),
(36, 'whooo hohohoho\n', 14.298860, 120.949646, 'Construction', 'Governor&#39;s Drive, DasmariÃ±as City, Philippines', '2014-07-10 15:23:10', 'no'),
(37, 'adsjj;das\n\n', 14.294036, 120.940849, 'Heavy Traffic', 'Governor&#39;s Drive, DasmariÃ±as City, Philippines', '2014-07-10 15:23:17', 'no'),
(38, 'aw', 14.447106, 121.043167, 'Accident', 'Villsam, Muntinlupa, Philippines', '2014-08-15 21:39:49', 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
