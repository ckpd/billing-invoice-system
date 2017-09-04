-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2017 at 07:59 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoiceid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `mileage` varchar(255) NOT NULL,
  `note` varchar(800) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(361, '', 1, '', '0.00'),
(360, '', 1, '', '0.00'),
(359, '', 1, '', '0.00'),
(358, '', 1, '', '0.00'),
(357, '', 1, '', '0.00'),
(356, '', 1, '', '0.00'),
(355, '', 1, '', '0.00'),
(354, '', 1, '', '0.00'),
(353, '', 1, '', '0.00'),
(352, '', 1, '', '0.00'),
(351, '', 1, '', '0.00'),
(350, '', 1, '', '0.00'),
(349, '', 1, '', '0.00'),
(348, '', 1, '', '0.00'),
(347, '', 1, '', '0.00'),
(346, '', 1, '', '0.00'),
(345, '', 1, '', '0.00'),
(344, '', 1, '', '0.00'),
(343, '', 1, '', '0.00'),
(342, '', 1, '', '0.00'),
(341, '', 1, '', '0.00'),
(340, '', 1, '', '0.00'),
(339, '', 1, '', '0.00'),
(338, '', 1, '', '0.00'),
(337, '', 1, '', '0.00'),
(336, '', 1, '', '0.00'),
(335, '', 1, '', '0.00'),
(334, '', 1, '', '0.00'),
(333, '', 1, '', '0.00'),
(332, '', 1, '', '0.00'),
(330, '', 1, '', '0.00'),
(331, '', 1, '', '0.00'),
(328, '', 1, '', '0.00'),
(329, '', 1, '', '0.00'),
(327, 'Brake Fluid - Castrol GTX - 95.99', 1, '95.99', '95.99');

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
(0, 'Brake Fluid', 'Castrol GTX', 95.99);

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
  MODIFY `customerid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoiceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(10) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
