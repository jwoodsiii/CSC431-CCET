-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 06:33 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorization`
--

CREATE TABLE `authorization` (
  `auth_id` varchar(9) NOT NULL,
  `auth_level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorization`
--

INSERT INTO `authorization` (`auth_id`, `auth_level`) VALUES
('1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` varchar(9) NOT NULL,
  `dept_name` varchar(45) NOT NULL,
  `document_count` int(11) NOT NULL DEFAULT '0',
  `user_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `document_count`, `user_count`) VALUES
('1', 'dept_nameTest', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` varchar(9) NOT NULL,
  `revision_num` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(9) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `doc_title` varchar(320) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_edit_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category` varchar(45) NOT NULL,
  `content` mediumblob NOT NULL,
  `document_status` varchar(45) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `revision_num`, `user_id`, `status_id`, `doc_title`, `size`, `creation_date`, `last_edit_date`, `category`, `content`, `document_status`) VALUES
('1', 0, '1', 0, 'Test', 0, '2017-05-10 04:56:40', '2017-05-10 04:56:40', 'cdc', 0x3c703e313234333420333420266e6273703b3572343320353433357274203334207433343c2f703e, 'draft'),
('2', 0, '2', 0, 'second', 0, '2017-05-10 05:03:00', '2017-05-10 05:03:00', '1', 0x3c703e456e74657220313231323331323333796f7572207465787420686572653c2f703e, 'draft'),
('3', 0, '2', 0, 'third', 0, '2017-05-10 05:10:43', '2017-05-10 06:33:10', '1', 0x3c703e68656c6c6f20776f726421203477723c2f703e, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `document_id` varchar(9) NOT NULL,
  `user_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` varchar(9) NOT NULL,
  `position_title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shadow`
--

CREATE TABLE `shadow` (
  `login_id` varchar(320) NOT NULL,
  `pass_hash` varchar(320) NOT NULL,
  `user_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shadow`
--

INSERT INTO `shadow` (`login_id`, `pass_hash`, `user_id`) VALUES
('111@163.com', '222', '1'),
('789@163.com', '1234', '2'),
('yxz457@miami.edu', '123456', '3');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `user_id` varchar(9) NOT NULL,
  `dept_id` varchar(9) NOT NULL,
  `position_id` varchar(9) NOT NULL,
  `auth_id` varchar(9) NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `document_count` int(11) NOT NULL DEFAULT '0',
  `email` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`user_id`, `dept_id`, `position_id`, `auth_id`, `fname`, `lname`, `document_count`, `email`) VALUES
('1', '1', '1', '1', 'YIHAO', 'ZHOU', 0, 'yxz457@miami.edu'),
('2', '1', '1', '1', 'Yihao', 'Zhou2', 0, '234@163.com'),
('3', '1', '1', '1', 'lili123444', 'wang555', 0, 'yxz457@123.com');

-- --------------------------------------------------------

--
-- Table structure for table `usertitle`
--

CREATE TABLE `usertitle` (
  `position_id` varchar(9) NOT NULL,
  `position_title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertitle`
--

INSERT INTO `usertitle` (`position_id`, `position_title`) VALUES
('1', 'potison_title_test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorization`
--
ALTER TABLE `authorization`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`,`revision_num`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`document_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `shadow`
--
ALTER TABLE `shadow`
  ADD PRIMARY KEY (`login_id`,`pass_hash`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `auth_id` (`auth_id`);

--
-- Indexes for table `usertitle`
--
ALTER TABLE `usertitle`
  ADD PRIMARY KEY (`position_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userprofile` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userprofile` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `shadow`
--
ALTER TABLE `shadow`
  ADD CONSTRAINT `shadow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userprofile` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userprofile_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `usertitle` (`position_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userprofile_ibfk_3` FOREIGN KEY (`auth_id`) REFERENCES `authorization` (`auth_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
