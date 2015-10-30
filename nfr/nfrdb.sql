-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 01, 2015 at 01:05 PM
-- Server version: 5.5.42
-- PHP Version: 5.5.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `nfr`
--

-- --------------------------------------------------------

--
-- Table structure for table `nfr_district_master`
--

CREATE TABLE `nfr_district_master` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dist_hq` varchar(80) DEFAULT NULL,
  `zone` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_district_master`
--

INSERT INTO `nfr_district_master` (`id`, `name`, `dist_hq`, `zone`) VALUES
(1, 'Bagsa', 'Mushalpur', ''),
(2, 'Barpeta', 'Barpeta', ''),
(3, 'Bongaigaon', 'Bongaigaon', ''),
(4, 'Cachar', 'Silchar', ''),
(5, 'Chirang', 'Kajalgaon', ''),
(6, 'Darrang', 'Mangaldai', ''),
(7, 'Dhemaji', 'Dhemaji', ''),
(8, 'Dhubri', 'Dhubri', ''),
(9, 'Dibrugarh', 'Dibrugarh', ''),
(10, 'Goalpara', 'Goalpara', ''),
(11, 'Golaghat', 'Golaghat', ''),
(12, 'Hailakandi', 'Hailakandi', ''),
(13, 'Jorhat', 'Jorhat', ''),
(14, 'Kamrup', 'Dispur', ''),
(15, 'Kamrup (M)', 'Dispur', ''),
(16, 'Karbi Anglong', 'Diphu', ''),
(17, 'Karimganj', 'Karimganj', ''),
(18, 'Kokrajhar', 'Kokrajhar', ''),
(19, 'Lakhimpur', 'Lakhimpur', ''),
(20, 'Marigaon', 'Marigaon', ''),
(21, 'Nagaon', 'Nagaon', ''),
(22, 'Nalbari', 'Nalbari', ''),
(23, 'Dima Hasao', 'Haflong', ''),
(24, 'Sivasagar', 'Sivasagar', ''),
(25, 'Sonitpur', 'Tezpur', ''),
(26, 'Tinsukia', 'Tinsukia', ''),
(27, 'Udalguri', 'Udalguri', '');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_gear_master`
--

CREATE TABLE `nfr_gear_master` (
  `id` int(11) NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `periodicity_level_1` int(11) NOT NULL,
  `periodicity_level_2` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `remarks` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nfr_gear_type_master`
--

CREATE TABLE `nfr_gear_type_master` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nfr_gear_type_master`
--

INSERT INTO `nfr_gear_type_master` (`id`, `name`, `code`) VALUES
(1, 'test', 'TES1234'),
(2, 'Electrical Operated Point', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_maintenance_schedule_ledger`
--

CREATE TABLE `nfr_maintenance_schedule_ledger` (
  `id` int(11) NOT NULL,
  `station_gear_id` int(11) NOT NULL,
  `maintenance_date` date NOT NULL,
  `role_id` int(11) NOT NULL,
  `maintenance_by` int(11) NOT NULL DEFAULT '0',
  `remarks` varchar(40) NOT NULL,
  `status` enum('done','pending') NOT NULL,
  `progress` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nfr_role_master`
--

CREATE TABLE `nfr_role_master` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_role_master`
--

INSERT INTO `nfr_role_master` (`id`, `name`) VALUES
(1, 'SECTIONAL DSMG'),
(2, 'INCHARGE SSE/SE'),
(3, 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_schedule_code_master`
--

CREATE TABLE `nfr_schedule_code_master` (
  `id` int(11) NOT NULL,
  `code` varchar(40) NOT NULL,
  `gear_type_id` int(11) NOT NULL,
  `periodicity_level_1` int(11) NOT NULL,
  `periodicity_level_2` int(11) NOT NULL,
  `remarks` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nfr_schedule_code_master`
--

INSERT INTO `nfr_schedule_code_master` (`id`, `code`, `gear_type_id`, `periodicity_level_1`, `periodicity_level_2`, `remarks`) VALUES
(1, 'TEST12344', 1, 14, 90, 'test'),
(2, 'P1', 2, 14, 90, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_station_gear_master`
--

CREATE TABLE `nfr_station_gear_master` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `gear_id` int(11) NOT NULL,
  `date_of_replacement` date NOT NULL,
  `remarks` varchar(80) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nfr_station_master`
--

CREATE TABLE `nfr_station_master` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `code` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_station_master`
--

INSERT INTO `nfr_station_master` (`id`, `district_id`, `name`, `code`) VALUES
(1, 26, 'Tinsukia Junction', 'TSK'),
(2, 9, 'Dibrugarh', 'DBRG');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_user_master`
--

CREATE TABLE `nfr_user_master` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `designation` varchar(80) NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_user_master`
--

INSERT INTO `nfr_user_master` (`id`, `name`, `email`, `mobile`, `password`, `designation`, `user_type`, `role_id`, `status`, `created`, `last_update`) VALUES
(1, 'Glomindz', 'support@glomindz.com', '9854087006', '88f2dccb02b2a20615211e5492f85204', 'Developer', 'admin', 3, 1, '2014-06-19', '2014-06-19 11:24:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nfr_district_master`
--
ALTER TABLE `nfr_district_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_gear_master`
--
ALTER TABLE `nfr_gear_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_gear_type_master`
--
ALTER TABLE `nfr_gear_type_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_maintenance_schedule_ledger`
--
ALTER TABLE `nfr_maintenance_schedule_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_role_master`
--
ALTER TABLE `nfr_role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_schedule_code_master`
--
ALTER TABLE `nfr_schedule_code_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_station_gear_master`
--
ALTER TABLE `nfr_station_gear_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_station_master`
--
ALTER TABLE `nfr_station_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_user_master`
--
ALTER TABLE `nfr_user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nfr_gear_master`
--
ALTER TABLE `nfr_gear_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nfr_gear_type_master`
--
ALTER TABLE `nfr_gear_type_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nfr_maintenance_schedule_ledger`
--
ALTER TABLE `nfr_maintenance_schedule_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nfr_role_master`
--
ALTER TABLE `nfr_role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nfr_schedule_code_master`
--
ALTER TABLE `nfr_schedule_code_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nfr_station_gear_master`
--
ALTER TABLE `nfr_station_gear_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nfr_station_master`
--
ALTER TABLE `nfr_station_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nfr_user_master`
--
ALTER TABLE `nfr_user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;