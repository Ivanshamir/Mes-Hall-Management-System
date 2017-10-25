-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2017 at 06:37 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mesmng`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_member`
--

CREATE TABLE `db_member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `memid` int(11) NOT NULL,
  `mng_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_member`
--

INSERT INTO `db_member` (`id`, `name`, `memid`, `mng_id`) VALUES
(60, 'Omar Sakib', 3, '01'),
(58, 'Rajib Riki Rathor', 1, '01'),
(59, 'Ayan Magi', 2, '01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `id` int(11) NOT NULL,
  `expense` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `mng_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`id`, `expense`, `date`, `mng_id`) VALUES
(16, '600', '2017-07-20', '01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_givcash`
--

CREATE TABLE `tbl_givcash` (
  `id` int(11) NOT NULL,
  `memid` int(11) NOT NULL,
  `givencash` varchar(50) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `mng_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_givcash`
--

INSERT INTO `tbl_givcash` (`id`, `memid`, `givencash`, `date`, `mng_id`) VALUES
(46, 3, '600', '2017-07-20', '01'),
(45, 2, '200', '2017-07-20', '01'),
(44, 1, '100', '2017-07-20', '01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manager`
--

CREATE TABLE `tbl_manager` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mng_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manager`
--

INSERT INTO `tbl_manager` (`id`, `name`, `username`, `mng_id`, `password`) VALUES
(1, 'Shamir Imtiaz', 'shamir', '01', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Shamun Ishmam', 'Shamun', '02', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Maruf Hassan', 'Maruf', '03', '202cb962ac59075b964b07152d234b70'),
(4, 'Rajib Riki Rathor', 'Rajib', '05', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meal`
--

CREATE TABLE `tbl_meal` (
  `id` int(11) NOT NULL,
  `memid` int(11) NOT NULL,
  `meal` varchar(255) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `mng_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_meal`
--

INSERT INTO `tbl_meal` (`id`, `memid`, `meal`, `date`, `mng_id`) VALUES
(65, 3, '1', '2017-07-20', '01'),
(64, 2, '2', '2017-07-20', '01'),
(63, 1, '2', '2017-07-20', '01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_member`
--
ALTER TABLE `db_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_givcash`
--
ALTER TABLE `tbl_givcash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meal`
--
ALTER TABLE `tbl_meal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_member`
--
ALTER TABLE `db_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_givcash`
--
ALTER TABLE `tbl_givcash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_meal`
--
ALTER TABLE `tbl_meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
