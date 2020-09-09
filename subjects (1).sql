-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 01:21 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(10) NOT NULL,
  `date_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `class`, `date_time`) VALUES
(23, 'English', 10, '2017-03-16T08:00'),
(24, 'Nepali', 10, '2017-03-17T08:00'),
(25, 'Mathematics', 10, '2017-03-19T08:00'),
(27, 'Science', 10, '2017-03-20T08:00'),
(28, 'Social Studies', 10, '2017-03-21T08:00'),
(29, 'Health, Population and Environment ', 10, '2017-03-22T08:00'),
(30, 'Optional Mathematics', 10, '2017-03-23T08:00'),
(31, 'Optional II', 10, '2017-03-24T08:00'),
(32, 'English', 9, '2017-03-16T08:00'),
(33, 'Nepali', 9, '2017-03-17T08:00'),
(34, 'Mathematics', 9, '2017-03-19T08:00'),
(35, 'Science', 9, '2017-03-20T08:00'),
(36, 'Social Studies', 9, '2017-03-21T08:00'),
(37, 'Health, Population and Environment', 9, '2017-03-22T08:00'),
(38, 'Optional Mathematics', 9, '2017-03-23T08:00'),
(39, 'Optional II', 9, '2017-03-24T08:00'),
(40, 'English', 8, '2017-03-16T12:00'),
(41, 'Nepali', 8, '2017-03-17T12:00'),
(43, 'Mathematics', 8, '2017-03-19T12:00'),
(44, 'Science', 8, '2017-03-20T12:00'),
(45, 'Social Studies', 8, '2017-03-21T12:00'),
(46, 'Health, Population and Environment', 8, '2017-03-22T12:00'),
(47, 'Optional Mathematics', 8, '2017-03-23T12:00'),
(48, 'Account', 8, '2017-03-24T12:00'),
(49, 'Computer Science', 8, '2017-03-26T12:00'),
(50, 'English', 7, '2017-03-16T12:00'),
(51, 'Nepali', 7, '2017-03-17T12:00'),
(52, 'Mathematics', 7, '2017-03-19T12:00'),
(53, 'Science', 7, '2017-03-20T12:00'),
(54, 'Social Studies', 7, '2017-03-21T12:00'),
(55, 'Health, Population and Environment', 7, '2017-03-22T12:00'),
(56, 'Optional Mathematics', 7, '2017-03-23T12:00'),
(57, 'Computer Science', 7, '2017-03-24T12:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
