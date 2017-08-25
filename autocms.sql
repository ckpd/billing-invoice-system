-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2017 at 12:33 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autocms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `customeremail` varchar(255) NOT NULL,
  `customerphone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `parish` varchar(255) NOT NULL,
  `vehiclereg` varchar(255) NOT NULL,
  `lastVisited` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `firstname`, `lastname`, `customeremail`, `customerphone`, `city`, `parish`, `vehiclereg`, `lastVisited`) VALUES
(172, '', '', '', '', '', '', '', '2017-08-26-37');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoiceid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoiceid`, `customerid`, `invoice_date`, `total`, `status`, `file`) VALUES
(240, 172, '', '0', 'open', '--2017-08-26-37'),
(241, 172, '', '0', 'open', '--2017-08-26-56'),
(242, 172, '', '0', 'open', '--2017-08-26-26');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `product` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `subtotal` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `product`, `qty`, `price`, `subtotal`) VALUES
(292, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(291, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(290, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(288, '', 1, '', '0.00'),
(289, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(286, '', 1, '', '0.00'),
(287, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(285, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(284, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(283, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(282, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(281, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(280, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(278, '', 1, '', '0.00'),
(279, '', 1, '', '0.00'),
(277, '', 1, '', '0.00'),
(276, '', 1, '', '0.00'),
(275, '', 1, '', '0.00'),
(273, '', 1, '', '0.00'),
(274, '', 1, '', '0.00'),
(271, '', 1, '', '0.00'),
(272, '', 1, '', '0.00'),
(270, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(269, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(268, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(267, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(266, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(265, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(264, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(263, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(262, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(259, '', 1, '', '0.00'),
(260, '', 1, '', '0.00'),
(261, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(258, '', 1, '', '0.00'),
(257, '', 1, '', '0.00'),
(256, '', 1, '', '0.00'),
(255, '', 1, '', '0.00'),
(254, '', 1, '', '0.00'),
(253, '', 1, '', '0.00'),
(252, '', 1, '', '0.00'),
(251, '', 1, '', '0.00'),
(250, '', 1, '', '0.00'),
(249, '', 1, '', '0.00'),
(248, '', 1, '', '0.00'),
(247, '', 1, '', '0.00'),
(246, '', 1, '', '0.00'),
(245, '', 1, '', '0.00'),
(244, '', 1, '', '0.00'),
(243, '', 1, '', '0.00'),
(242, '', 1, '', '0.00'),
(241, '', 1, '', '0.00'),
(240, '', 1, '', '0.00'),
(239, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(238, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(237, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(236, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(235, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(293, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(294, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(295, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(296, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99'),
(297, '', 1, '', '0.00'),
(298, '', 1, '', '0.00'),
(299, '', 1, '', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productcode` int(10) NOT NULL,
  `productname` varchar(250) NOT NULL,
  `productdesc` varchar(255) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productcode`, `productname`, `productdesc`, `unitprice`) VALUES
(0, 'Brake Fluid', 'Castrol GTX', '95.99');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(10) NOT NULL,
  `vehicle_reg_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoiceid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoiceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
