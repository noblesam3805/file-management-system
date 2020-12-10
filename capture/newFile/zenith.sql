-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2018 at 12:48 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 7.0.23-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zenith`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_type` varchar(50) NOT NULL,
  `account_balance` double(20,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_number`, `account_type`, `account_balance`) VALUES
(46, '000', 'savings', 0.00),
(47, '0046', 'savings', 1380.00),
(48, '00472', 'savings', 0.00),
(49, '0048312465', 'savings', 0.00),
(50, '0049412465', 'savings', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `gender`, `password`) VALUES
(1, 'israel', 'male', 'mr cheat');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(50) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `middle_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `dob` date NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `bio_data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `address`, `email`, `phone`, `dob`, `account_number`, `passport`, `bio_data`) VALUES
(2, 'Sunny', 'fafafa', 'Emmanuel', 'male', '1209,v dmdls', 'duff_israel@yahoo.com', '08032433543', '0000-00-00', '0046', '../upload/profile/0046.png', 'eastern region'),
(4, 'Eneji', 'Bernard', 'John', 'male', '123, street Calabar.', 'eneji@gmail.com', '08032433543', '0000-00-00', '0048312465', '../upload/profile/0048312465.png', 'mr energy'),
(5, 'Chaly', 'Ugo', 'Chacha', 'male', '133, street Calabar.', 'chaly@gmail.com', '0803243332', '0000-00-00', '0049412465', '../upload/profile/0049412465.png', 'my password');

-- --------------------------------------------------------

--
-- Table structure for table `fraud`
--

CREATE TABLE `fraud` (
  `id` int(10) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `frauder_img` varchar(200) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `checked` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fraud`
--

INSERT INTO `fraud` (`id`, `account_number`, `description`, `frauder_img`, `unit_name`, `checked`) VALUES
(1, '0014', 'test fraud', '', 'unit 1', 0),
(2, '0014', 'test fraud', '', 'unit 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fraud_analysis`
--

CREATE TABLE `fraud_analysis` (
  `id` int(10) NOT NULL,
  `fraud_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bio_data` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gps` varchar(200) NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `account_number`, `bio_data`, `login_time`, `gps`, `ip_address`, `status`) VALUES
(1, '0046', '00462018-01-30T10:49:45+01:00', '2018-01-30 09:49:46', '{\"lng\":\"0\",\"lat\":\"0\"}', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_team`
--

CREATE TABLE `monitoring_team` (
  `id` int(10) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitoring_team`
--

INSERT INTO `monitoring_team` (`id`, `unit_name`, `email`, `phone`, `password`) VALUES
(1, 'Unit 1', 'unit1@yahoo.com', '09012345678', 'unit1');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_type`, `account_number`, `transaction_date`, `admin_id`) VALUES
(1, 'deposit', '0046', '2017-12-23 15:24:51', -1),
(2, 'widthraw', '0046', '2017-12-23 15:25:08', -1),
(3, 'widthraw', '0046', '2018-01-29 08:06:54', -1),
(4, 'widthraw', '0046', '2018-01-29 08:41:08', -1),
(5, 'widthraw', '0046', '2018-01-29 08:42:55', -1),
(6, 'widthraw', '0046', '2018-01-29 09:13:39', -1),
(7, 'widthraw', '0046', '2018-01-29 09:18:11', -1),
(8, 'widthraw', '0046', '2018-01-29 10:10:46', -1),
(9, 'widthraw', '0046', '2018-01-30 09:53:37', -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fraud`
--
ALTER TABLE `fraud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fraud_analysis`
--
ALTER TABLE `fraud_analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring_team`
--
ALTER TABLE `monitoring_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fraud`
--
ALTER TABLE `fraud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fraud_analysis`
--
ALTER TABLE `fraud_analysis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `monitoring_team`
--
ALTER TABLE `monitoring_team`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
