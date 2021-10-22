-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2017 at 01:51 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `supply_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_item`
--

CREATE TABLE IF NOT EXISTS `added_item` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(30) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `qty_stck` int(20) NOT NULL,
  `qty_added` int(20) NOT NULL,
  `new_qty` int(20) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `added_item`
--

INSERT INTO `added_item` (`id`, `supplier_name`, `item_name`, `qty_stck`, `qty_added`, `new_qty`, `date_added`) VALUES
(1, 'data world', 'monitor', 13, 3, 16, '2017-08-14'),
(2, 'godem comercial', 'fsdfsd', 30, 22, 52, '2017-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE IF NOT EXISTS `availability` (
  `avail_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `rec_quantity` int(255) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` int(255) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `amount` int(255) NOT NULL,
  PRIMARY KEY (`avail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`avail_id`, `item_id`, `item_name`, `brand`, `rec_quantity`, `unit`, `price`, `item_type`, `category`, `amount`) VALUES
(1, '', 'ballpen', 'genius', 8, 'box', 100, 'returnable', 'scientific equipment', 0),
(2, '', 'bondpaper', 'e4tech', 5, 'rem', 150, 'returnable', 'scientific equipment', 0),
(18, '', '', '', 3, '', 0, '', '', 0),
(19, '', '', '', 2, '', 0, '', '', 0),
(20, '', '', '', 5, '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `bar_id` int(11) NOT NULL AUTO_INCREMENT,
  `bar_item` varchar(50) NOT NULL,
  `person_bar` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_bar` date NOT NULL,
  PRIMARY KEY (`bar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`bar_id`, `bar_item`, `person_bar`, `quantity`, `date_bar`) VALUES
(5, 'monitor', '', 1, '2013-03-12'),
(6, 'monitor', '', 1, '2013-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_item`
--

CREATE TABLE IF NOT EXISTS `borrowed_item` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `item_code` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date_borrow` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowed_item`
--

INSERT INTO `borrowed_item` (`id`, `employee_name`, `item_code`, `item_name`, `quantity`, `date_borrow`, `status`) VALUES
(15, 'Rolly B. Abellanosa', 12345, 'monitor', 1, '2013-03-15 00:05:11', ''),
(15, 'Rolly B. Abellanosa', 23456, 'speaker', 1, '2013-03-15 00:05:11', ''),
(16, 'Rolly B. Abellanosa', 12345, 'monitor', 1, '2013-03-15 00:11:03', 'Borrowed'),
(16, 'Rolly B. Abellanosa', 23456, 'speaker', 1, '2013-03-15 00:11:03', 'Borrowed'),
(16, 'Rolly B. Abellanosa', 11111, 'mouse', 1, '2013-03-15 00:11:03', 'Borrowed'),
(16, 'Rolly B. Abellanosa', 22222, 'keyboard', 1, '2013-03-15 00:11:03', 'Borrowed'),
(17, 'admin', 12345, 'monitor', 0, '2017-08-13 23:16:38', 'Borrowed'),
(17, 'admin', 23456, 'keyboard', 0, '2017-08-13 23:16:38', 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `brand`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'office supplies'),
(3, 'construction materials'),
(5, 'sports equipment'),
(6, 'industrial machineries'),
(7, 'technical and scientific  equipment');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `description`) VALUES
(1, 'accounting'),
(2, 'finance'),
(3, 'principal''s office'),
(4, 'registrar');

-- --------------------------------------------------------

--
-- Table structure for table `itemlist`
--

CREATE TABLE IF NOT EXISTS `itemlist` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` int(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `dateadded` varchar(20) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=211 ;

--
-- Dumping data for table `itemlist`
--

INSERT INTO `itemlist` (`item_id`, `item_code`, `item_name`, `brand_name`, `quantity`, `unit_name`, `price`, `type_name`, `cat_name`, `supplier_id`, `supplier_name`, `dateadded`) VALUES
(206, 12345, 'monitor', 'genius', 16, 'pcs', 150, 'returnable', 'office supplies', 0, 'data world', '2017-08-14 '),
(207, 23456, 'speaker', 'genius', 52, 'pcs', 200, 'returnable', 'technical and scientific  equipment', 0, 'data world', '2017-08-14 '),
(209, 22222, 'keyboard', 'genius', 57, 'pcs', 300, 'returnable', 'office supplies', 0, 'data world', '2017-08-11 '),
(210, 24324, 'fsdfsd', 'dfsd', 52, 'pc', 424, 'returnable', 'office supplies', 0, 'godem comercial', '2017-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `itype_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`itype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`itype_id`, `type_name`) VALUES
(1, 'returnable'),
(2, 'consumable'),
(3, 'disposable');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `description`) VALUES
(1, 'principal'),
(2, 'teacher'),
(3, 'librarian'),
(4, 'guard'),
(5, 'accountant');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(255) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `price`
--


-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE IF NOT EXISTS `purchase_item` (
  `po_id` int(11) NOT NULL,
  `item_code` int(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `ord_qty` int(255) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ord_date` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`po_id`, `item_code`, `item_name`, `supplier_name`, `ord_qty`, `unit`, `price`, `total`, `ord_date`, `status`) VALUES
(1, 12345, 'folder', 'godem comercial', 1, 'pcs', 2, 0, '2013-03-12', ''),
(1, 23456, 'envenlop', 'godem comercial', 2, 'pcs', 3, 0, '2013-03-12', ''),
(1, 34567, 'ballpen', 'godem comercial', 3, 'boxes', 150, 0, '2013-03-12', ''),
(2, 12345, 'monitor', 'data world', 2, 'pcs', 150, 0, '2013-03-14', ''),
(2, 23456, 'speaker', 'data world', 3, 'pcs', 200, 0, '2013-03-14', ''),
(3, 24324, 'fsdfsd', 'godem comercial', 2, 'pc', 424, 0, '2017-08-12', ''),
(4, 12345, 'speaker', 'data world', 3, 'pcs', 150, 0, '2017-08-13', ''),
(4, 23456, 'keyboard', 'data world', 3, 'pcs', 200, 0, '2017-08-13', ''),
(5, 24324, 'fsdfsd', 'godem comercial', 0, 'pc', 424, 0, '2017-08-13', ''),
(6, 24324, 'fsdfsd', 'godem comercial', 2, 'pc', 424, 0, '2017-08-13', ''),
(7, 12345, 'monitor', 'data world', 3, 'pcs', 150, 0, '2017-08-13', ''),
(8, 12345, 'speaker', 'data world', 5, 'pcs', 150, 0, '2017-08-13', ''),
(8, 23456, 'keyboard', 'data world', 4, 'pcs', 200, 0, '2017-08-13', ''),
(9, 24324, 'fsdfsd', 'godem comercial', 9, 'pc', 424, 0, '2017-08-13', ''),
(10, 24324, 'fsdfsd', 'godem comercial', 55, 'pc', 424, 0, '2017-08-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `purchase_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `quantity`
--

CREATE TABLE IF NOT EXISTS `quantity` (
  `qnty_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(255) NOT NULL,
  PRIMARY KEY (`qnty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quantity`
--


-- --------------------------------------------------------

--
-- Table structure for table `rec_item`
--

CREATE TABLE IF NOT EXISTS `rec_item` (
  `rec_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `qty_left` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `item_type` varchar(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`rec_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `rec_item`
--

INSERT INTO `rec_item` (`rec_item_id`, `item_name`, `supplier_name`, `brand`, `qty_left`, `unit`, `price`, `item_type`, `category`) VALUES
(16, 'speaker', 'data world', 'genius', 5, 'pcs', 200, 'returnable', 'scientific equipment');

-- --------------------------------------------------------

--
-- Table structure for table `released_item`
--

CREATE TABLE IF NOT EXISTS `released_item` (
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `released_qty` int(11) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date_released` date NOT NULL,
  PRIMARY KEY (`rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `released_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `date_reported` date NOT NULL,
  `time_reported` time NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `report`
--


-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `price` int(255) NOT NULL,
  `totalprice` int(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `req_id`, `name`, `subject`, `item_name`, `quantity`, `unit`, `price`, `totalprice`, `date`, `status`) VALUES
(1, 6, 'ariel', 'maintenance', 'monitor', 3, 'pcs', 150, 450, '2017-08-14', 'Supplied'),
(5, 6, 'ariel', 'buyingggggggggg', 'keyboard', 12, 'pcs', 300, 3600, '2017-08-12', 'Supplied'),
(6, 6, 'ariel', 'retail', 'monitor', 4, 'pcs', 150, 600, '2017-08-14', 'Supplied');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `return`
--


-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Approved'),
(2, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `supplied`
--

CREATE TABLE IF NOT EXISTS `supplied` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `req_id` int(3) NOT NULL,
  `req_name` varchar(100) NOT NULL,
  `req_purpose` varchar(500) NOT NULL,
  `req_item` varchar(100) NOT NULL,
  `req_unit` varchar(20) NOT NULL,
  `req_quantity` int(20) NOT NULL,
  `req_price` int(20) NOT NULL,
  `req_status` varchar(20) NOT NULL,
  `req_date` varchar(30) NOT NULL,
  `supplied_date` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `supplied`
--

INSERT INTO `supplied` (`id`, `req_id`, `req_name`, `req_purpose`, `req_item`, `req_unit`, `req_quantity`, `req_price`, `req_status`, `req_date`, `supplied_date`) VALUES
(1, 6, 'ariel', 'retail', 'monitor', 'pcs', 4, 150, 'Supplied', '2017-08-14 06:07:19', '2017-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateadded` date NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `address`, `contact_person`, `contact`, `email`, `dateadded`) VALUES
(26, 'data world', 'cdo', 'ariel abriol', '0123456789', 'ariel@yahoo.com', '0000-00-00'),
(30, 'godem comercial', 'alubijid, misamis oriental', 'ariel abriol', '09358944967', 'ariel@yahoo.com', '0000-00-00'),
(31, 'ganiu', '23,ahmed street badagry', '09094759458', '09096968686', 'adekunlekunle@yahoo.commmm', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'pc'),
(2, 'pcs'),
(3, 'box'),
(4, 'boxes'),
(5, 'gallon'),
(7, 'meter'),
(9, 'yard'),
(11, 'rem'),
(12, 'bandle');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `utype_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `utype_id`, `name`, `department`, `position`, `username`, `password`, `address`, `contact`, `date`) VALUES
(50, 1, 'Rolly B. Abellanosa', 'Supply', 'OIC', 'admin', 'admin', 'Laguindingan, Misamis Oriental', '09263778273', '2013-03-04'),
(51, 2, 'wilbur ramos', 'accounting', 'book keeper', 'wilbur', 'ramos', 'Laguindingan, Misamis Oriental', '09358944967', '2013-03-04'),
(52, 3, 'ariel abriol', 'finance', 'unkown', 'ariel', 'abriol', 'alubijid, misamis oriental', '09358944967', '2013-03-04'),
(53, 3, 'Folashade Akinwunmi', 'finance', 'clerk', 'fola', 'fola', '23,folashade street', '09023332233', '2017-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `utype_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`utype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`utype_id`, `user_type`) VALUES
(1, 'Administrator'),
(2, 'Authorized'),
(3, 'Common ');
