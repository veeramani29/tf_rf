-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2015 at 08:57 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travelapt`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `api_id` int(64) NOT NULL AUTO_INCREMENT,
  `api_name` varchar(32) NOT NULL,
  `api_image` text NOT NULL,
  `username` text NOT NULL,
  `username1` text NOT NULL,
  `username2` text NOT NULL,
  `password` text NOT NULL,
  `url1` text NOT NULL,
  `url2` text NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`api_id`, `api_name`, `api_image`, `username`, `username1`, `username2`, `password`, `url1`, `url2`, `status`) VALUES
(2, 'Travelport-Hotel', '', 'uAPI5529259828', '', '', 'hhFj8GDy2t8dhB8FWagcbPPGS', 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/HotelService', '', 1),
(3, 'Travelport-Flight', '', 'uAPI8187943395-fb19ac3a', '', '', 'm{6NT4e&jX', 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService', '', 1),
(4, 'Travelport-Car', '', 'uAPI5529259828', '', '', 'hhFj8GDy2t8dhB8FWagcbPPGS', 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/VehicleService', '', 1),
(5, 'CRS-Hotel', '', '', '', '', '', '', '', 1),
(6, 'Travelport-PNR', '', 'uAPI5529259828', '', '', 'hhFj8GDy2t8dhB8FWagcbPPGS', 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/UniversalRecordService', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
