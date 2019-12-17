-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 10:24 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gemscap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `admin_id` varchar(45) NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_id`, `password`) VALUES
('test@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `daily_import`
--

CREATE TABLE `daily_import` (
  `id` int(11) NOT NULL,
  `takion_id` bigint(20) NOT NULL,
  `deposite` float NOT NULL,
  `bought_forword` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payout`
--

CREATE TABLE `payout` (
  `takion_id` bigint(11) NOT NULL,
  `month` varchar(3) NOT NULL,
  `amount` float NOT NULL,
  `other_deductions` float NOT NULL,
  `currency_rate` float NOT NULL,
  `tds_deductions` float NOT NULL,
  `payment_date` datetime NOT NULL,
  `low_deposite_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trader_master`
--

CREATE TABLE `trader_master` (
  `takion_id` bigint(20) NOT NULL,
  `trader_type` varchar(35) NOT NULL,
  `company_id` int(11) NOT NULL,
  `time_duration` int(11) NOT NULL,
  `designation` varchar(35) NOT NULL,
  `fix_salary` int(11) NOT NULL,
  `is_agent_based` tinyint(1) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `adhar_no` bigint(20) NOT NULL,
  `adhar_path` varchar(150) NOT NULL,
  `pan_no` varchar(11) NOT NULL,
  `pan_path` varchar(150) NOT NULL,
  `ifsc` varchar(35) NOT NULL,
  `bank_name` varchar(150) NOT NULL,
  `acc_no` bigint(20) NOT NULL,
  `deposite` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_import`
--
ALTER TABLE `daily_import`
  ADD PRIMARY KEY (`id`),
  ADD KEY `takion_id` (`takion_id`);

--
-- Indexes for table `payout`
--
ALTER TABLE `payout`
  ADD KEY `takion_id` (`takion_id`);

--
-- Indexes for table `trader_master`
--
ALTER TABLE `trader_master`
  ADD PRIMARY KEY (`takion_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_import`
--
ALTER TABLE `daily_import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_import`
--
ALTER TABLE `daily_import`
  ADD CONSTRAINT `takion_id` FOREIGN KEY (`takion_id`) REFERENCES `trader_master` (`takion_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payout`
--
ALTER TABLE `payout`
  ADD CONSTRAINT `takion_id_payout` FOREIGN KEY (`takion_id`) REFERENCES `trader_master` (`takion_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
