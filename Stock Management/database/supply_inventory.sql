-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 01:06 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supply_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_item`
--

CREATE TABLE `added_item` (
  `Id` int(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `qty_stck` int(10) NOT NULL,
  `qty_added` int(10) NOT NULL,
  `new_qty` int(10) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `added_item`
--

INSERT INTO `added_item` (`Id`, `supplier_name`, `item_name`, `qty_stck`, `qty_added`, `new_qty`, `date_added`) VALUES
(1, 'data world', 'keyboard', 3, 2, 5, '2021-08-24'),
(2, 'data world', 'keyboard', 5, 6, 11, '2021-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `avail_id` int(11) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `rec_quantity` int(255) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` int(255) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `borrow` (
  `bar_id` int(11) NOT NULL,
  `bar_item` varchar(50) NOT NULL,
  `person_bar` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_bar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `borrowed_item` (
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
(16, 'Rolly B. Abellanosa', 22222, 'keyboard', 1, '2013-03-15 00:11:03', 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'office supplies'),
(3, 'construction materials'),
(4, 'technical and scientific  equipment'),
(5, 'sports equipment'),
(6, 'industrial machineries');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `description`) VALUES
(1, 'accounting'),
(2, 'finance'),
(3, 'principal\'s office'),
(4, 'registrar');

-- --------------------------------------------------------

--
-- Table structure for table `itemlist`
--

CREATE TABLE `itemlist` (
  `item_id` int(11) NOT NULL,
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
  `dateadded` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemlist`
--

INSERT INTO `itemlist` (`item_id`, `item_code`, `item_name`, `brand_name`, `quantity`, `unit_name`, `price`, `type_name`, `cat_name`, `supplier_id`, `supplier_name`, `dateadded`) VALUES
(206, 12345, 'monitor', 'genius', 0, 'pcs', 150, 'returnable', 'office supplies', 0, 'data world', ''),
(207, 23456, 'speaker', 'genius', 3, 'pcs', 200, 'returnable', 'technical and scientific  equipment', 0, 'data world', ''),
(208, 11111, 'mouse', 'genius', 2, 'pcs', 200, 'returnable', 'office supplies', 0, 'data world', ''),
(209, 22222, 'keyboard', 'genius', 7, 'pcs', 300, 'returnable', 'office supplies', 0, 'data world', ''),
(216, 212201, 'Hp Probook laptop', 'Hewelett Packard', 4, 'pc', 250000, 'consumable', 'office supplies', 0, 'data world', '2021-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `itype_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `position` (
  `pos_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
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
(2, 23456, 'speaker', 'data world', 3, 'pcs', 200, 0, '2013-03-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quantity`
--

CREATE TABLE `quantity` (
  `qnty_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_item`
--

CREATE TABLE `rec_item` (
  `rec_item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `qty_left` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `item_type` varchar(10) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_item`
--

INSERT INTO `rec_item` (`rec_item_id`, `item_name`, `supplier_name`, `brand`, `qty_left`, `unit`, `price`, `item_type`, `category`) VALUES
(16, 'speaker', 'data world', 'genius', 5, 'pcs', 200, 'returnable', 'scientific equipment');

-- --------------------------------------------------------

--
-- Table structure for table `released_item`
--

CREATE TABLE `released_item` (
  `rel_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `released_qty` int(11) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date_released` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `date_reported` date NOT NULL,
  `time_reported` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `price` int(255) NOT NULL,
  `totalprice` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `req_id`, `name`, `subject`, `item_name`, `quantity`, `unit`, `price`, `totalprice`, `status`, `date`) VALUES
(22, 1, 'ariel abriol', 'for laboratory 1', 'monitor', 2, 'pcs', 0, 0, 'Supplied', '2013-03-15 00:57:31'),
(37, 2, 'ariel', 'testing', 'speaker', 2, 'pcs', 200, 400, 'Supplied', '2021-08-24 00:00:00'),
(38, 3, 'ariel', 'Testing', 'keyboard', 4, 'pcs', 300, 1200, 'Supplied', '2021-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `return_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `supplied` (
  `Id` int(10) NOT NULL,
  `req_id` int(10) NOT NULL,
  `req_name` varchar(255) NOT NULL,
  `req_purpose` varchar(255) NOT NULL,
  `req_item` varchar(255) NOT NULL,
  `req_unit` int(10) NOT NULL,
  `req_quantity` int(10) NOT NULL,
  `req_price` varchar(255) NOT NULL,
  `req_status` varchar(255) NOT NULL,
  `req_date` varchar(255) NOT NULL,
  `supplied_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplied`
--

INSERT INTO `supplied` (`Id`, `req_id`, `req_name`, `req_purpose`, `req_item`, `req_unit`, `req_quantity`, `req_price`, `req_status`, `req_date`, `supplied_date`) VALUES
(1, 22, 'ariel abriol', 'for laboratory 1', 'monitor', 0, 2, '0', 'Supplied', '2013-03-15 00:57:31', '2021-08-24'),
(2, 37, 'ariel', 'testing', 'speaker', 0, 2, '200', 'Supplied', '2021-08-24 00:00:00', '2021-08-24'),
(3, 38, 'ariel', 'Testing', 'keyboard', 0, 4, '300', 'Supplied', '2021-08-24 00:00:00', '2021-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateadded` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `address`, `contact_person`, `contact`, `email`, `dateadded`) VALUES
(26, 'data world', 'cdo', 'ariel abriol', '0123456789', 'ariel@yahoo.com', '0000-00-00 00:00:00'),
(30, 'godem comercial', 'alubijid, misamis oriental', 'ariel abriol', '09358944967', 'ariel@yahoo.com', '0000-00-00 00:00:00'),
(32, 'Adewale', 'Omolow', 'Olowo', '09990099', 'olowoade@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `user` (
  `id` int(9) NOT NULL,
  `utype_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `utype_id`, `name`, `department`, `position`, `username`, `password`, `address`, `contact`, `date`) VALUES
(50, 1, 'Rolly B. Abellanosa', 'Supply', 'OIC', 'admin', 'admin', 'Laguindingan, Misamis Oriental', '09263778273', '2013-03-04'),
(51, 2, 'wilbur ramos', 'accounting', 'book keeper', 'wilbur', 'ramos', 'Laguindingan, Misamis Oriental', '09358944967', '2013-03-04'),
(52, 3, 'ariel abriolaaa', 'finance', 'unkown', 'ariel', 'abriol', 'alubijid, misamis oriental', '09358944967', '2013-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `utype_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`utype_id`, `user_type`) VALUES
(1, 'Administrator'),
(2, 'Authorized'),
(3, 'Common ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added_item`
--
ALTER TABLE `added_item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`avail_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`bar_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `itemlist`
--
ALTER TABLE `itemlist`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`itype_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `quantity`
--
ALTER TABLE `quantity`
  ADD PRIMARY KEY (`qnty_id`);

--
-- Indexes for table `rec_item`
--
ALTER TABLE `rec_item`
  ADD PRIMARY KEY (`rec_item_id`);

--
-- Indexes for table `released_item`
--
ALTER TABLE `released_item`
  ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `supplied`
--
ALTER TABLE `supplied`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`utype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `added_item`
--
ALTER TABLE `added_item`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `avail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `bar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itemlist`
--
ALTER TABLE `itemlist`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `itype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quantity`
--
ALTER TABLE `quantity`
  MODIFY `qnty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rec_item`
--
ALTER TABLE `rec_item`
  MODIFY `rec_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `released_item`
--
ALTER TABLE `released_item`
  MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplied`
--
ALTER TABLE `supplied`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `utype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
