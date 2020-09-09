-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2017 at 03:52 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ID` int(11) NOT NULL,
  `TT_ID` int(11) DEFAULT NULL,
  `CLASS_ID` int(11) DEFAULT NULL,
  `PROF_ID` int(11) DEFAULT NULL,
  `TYPE` varchar(10) DEFAULT NULL,
  `LENGTH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ID`, `TT_ID`, `CLASS_ID`, `PROF_ID`, `TYPE`, `LENGTH`) VALUES
(1, 1, 7, 1, 'MANDATORY', 1),
(2, 1, 7, 2, 'MANDATORY', 1),
(3, 1, 7, 3, 'MANDATORY', 1),
(4, 1, 7, 5, 'MANDATORY', 1),
(5, 1, 7, 5, 'MANDATORY', 1),
(6, 1, 7, 6, 'MANDATORY', 1),
(7, 1, 8, 2, 'MANDATORY', 1),
(8, 1, 8, 1, 'MANDATORY', 1),
(9, 1, 8, 3, 'MANDATORY', 1),
(10, 1, 8, 5, 'MANDATORY', 1),
(11, 1, 7, 6, 'MANDATORY', 1),
(12, 1, 7, 1, 'MANDATORY', 1),
(13, 1, 7, 3, 'MANDATORY', 1),
(14, 1, 7, 3, 'MANDATORY', 1),
(15, 1, 7, 6, 'MANDATORY', 1),
(16, 1, 7, 6, 'MANDATORY', 1),
(17, 1, 7, 5, 'MANDATORY', 1),
(18, 1, 7, 5, 'MANDATORY', 1),
(19, 1, 7, 2, 'MANDATORY', 1),
(20, 1, 7, 2, 'MANDATORY', 1),
(21, 1, 8, 5, 'MANDATORY', 1),
(22, 1, 8, 3, 'MANDATORY', 1),
(23, 1, 7, 6, 'MANDATORY', 1),
(24, 1, 8, 6, 'MANDATORY', 1),
(25, 1, 11, 1, 'MANDATORY', 1),
(26, 1, 11, 5, 'MANDATORY', 1),
(27, 1, 11, 3, 'MANDATORY', 1),
(28, 1, 11, 2, 'MANDATORY', 1),
(29, 1, 7, 3, 'MANDATORY', 1),
(30, 1, 11, 5, 'MANDATORY', 1),
(31, 1, 11, 1, 'MANDATORY', 1),
(32, 1, 7, 13, 'MANDATORY', 1),
(33, 1, 7, 13, 'MANDATORY', 1),
(34, 1, 8, 13, 'MANDATORY', 1),
(35, 1, 11, 13, 'MANDATORY', 1),
(36, 1, 15, 1, 'MANDATORY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `year` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `Nepali` int(11) NOT NULL,
  `English` int(11) NOT NULL,
  `Math` int(11) NOT NULL,
  `Social Studies` int(11) NOT NULL,
  `Science` int(11) NOT NULL,
  `Population and Environent` int(11) NOT NULL,
  `Subject 7` int(11) NOT NULL,
  `Subject 8` int(11) NOT NULL,
  `Subject 9` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `ID` int(11) NOT NULL,
  `TT_ID` int(11) DEFAULT NULL,
  `TYPE` varchar(10) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `AVL` text,
  `CONTAINS` varchar(100) DEFAULT NULL,
  `SIZE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`ID`, `TT_ID`, `TYPE`, `NAME`, `AVL`, `CONTAINS`, `SIZE`) VALUES
(1, 1, 'PROF', 'Amit Kumar Patel', '', NULL, 0),
(2, 1, 'PROF', 'Aditya Patel', '', NULL, 0),
(3, 1, 'PROF', 'Arun Patel', '', NULL, 0),
(4, 1, 'PROF', '', '', NULL, 0),
(5, 1, 'PROF', 'Anu', ':1,1;1,2;1,3;1,4;1,6;1,7;1,8;2,1;2,2;2,3;2,4;2,6;2,7;2,8;3,1;3,2;3,3;3,4;3,6;3,7;3,8;4,1;4,2;4,3;4,4;4,6;4,7;4,8;5,1;5,2;5,3;5,4;5,6;5,7;5,8;6,1;6,2;6,3;6,4;6,6;6,7;6,8;', NULL, 0),
(6, 1, 'PROF', 'Archana', '', NULL, 0),
(7, 1, 'CLASS', 'class1', ':1,1;1,2;1,3;1,4;1,6;1,7;1,8;2,1;2,2;2,3;2,4;2,6;2,7;2,8;3,1;3,2;3,3;3,4;3,6;3,7;3,8;4,1;4,2;4,3;4,4;4,6;4,7;4,8;5,1;5,2;5,3;5,4;5,6;5,7;5,8;6,1;6,2;6,3;6,4;6,6;6,7;6,8;', NULL, 48),
(8, 1, 'CLASS', 'class2', ':1,1;1,2;1,3;1,4;1,6;1,7;1,8;2,1;2,2;2,3;2,4;2,6;2,7;2,8;3,1;3,2;3,3;3,4;3,6;3,7;3,8;4,1;4,2;4,3;4,4;4,6;4,7;4,8;5,1;5,2;5,3;5,4;5,6;5,7;5,8;6,1;6,2;6,3;6,4;6,6;6,7;6,8;', NULL, 48),
(9, 1, 'ROOM', 'R2', '', NULL, 50),
(10, 1, 'ROOM', 'R1', '', NULL, 50),
(11, 1, 'CLASS', 'class3', ':1,1;1,2;1,3;1,4;1,6;1,7;1,8;2,1;2,2;2,3;2,4;2,6;2,7;2,8;3,1;3,2;3,3;3,4;3,6;3,7;3,8;4,1;4,2;4,3;4,4;4,6;4,7;4,8;5,1;5,2;5,3;5,4;5,6;5,7;5,8;6,1;6,2;6,3;6,4;6,6;6,7;6,8;', NULL, 48),
(12, 1, 'ROOM', 'R3', '', NULL, 50),
(13, 1, 'PROF', 'BREAK', '', NULL, 0),
(14, 1, 'PROF', 'Aaaa', '', NULL, 0),
(15, 1, 'CLASS', 'class5', '', NULL, 0),
(16, 1, 'CLASS', 'class10', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sched_activities`
--

CREATE TABLE `sched_activities` (
  `ID` int(11) NOT NULL,
  `TT_ID` int(11) DEFAULT NULL,
  `CLASS_ID` int(11) DEFAULT NULL,
  `PROF_ID` int(11) DEFAULT NULL,
  `ROOM_ID` int(11) DEFAULT NULL,
  `DAY` int(11) DEFAULT NULL,
  `INT_NO` int(11) DEFAULT NULL,
  `TWEAK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sched_activities`
--

INSERT INTO `sched_activities` (`ID`, `TT_ID`, `CLASS_ID`, `PROF_ID`, `ROOM_ID`, `DAY`, `INT_NO`, `TWEAK`) VALUES
(413, 1, 8, 6, 9, 5, 4, 0),
(414, 1, 11, 1, 9, 5, 8, 0),
(415, 1, 11, 5, 9, 4, 8, 0),
(416, 1, 7, 6, 9, 3, 3, 0),
(417, 1, 8, 3, 9, 3, 8, 0),
(418, 1, 7, 2, 9, 6, 2, 0),
(419, 1, 8, 5, 9, 2, 4, 0),
(420, 1, 11, 3, 9, 1, 3, 0),
(421, 1, 11, 2, 9, 6, 1, 0),
(422, 1, 7, 13, 10, 5, 4, 0),
(423, 1, 8, 13, 9, 6, 4, 0),
(424, 1, 11, 13, 9, 2, 6, 0),
(425, 1, 7, 13, 9, 4, 2, 0),
(426, 1, 11, 1, 9, 1, 4, 0),
(427, 1, 7, 3, 9, 4, 1, 0),
(428, 1, 11, 5, 9, 1, 2, 0),
(429, 1, 7, 2, 10, 1, 3, 0),
(430, 1, 7, 5, 9, 2, 3, 0),
(431, 1, 7, 6, 10, 6, 1, 0),
(432, 1, 8, 2, 9, 6, 3, 0),
(433, 1, 8, 1, 10, 2, 3, 0),
(434, 1, 7, 5, 9, 3, 4, 0),
(435, 1, 7, 5, 9, 5, 3, 0),
(436, 1, 7, 2, 9, 4, 3, 0),
(437, 1, 7, 3, 10, 2, 4, 0),
(438, 1, 8, 3, 10, 5, 3, 0),
(439, 1, 8, 5, 9, 1, 1, 0),
(440, 1, 7, 6, 10, 1, 2, 0),
(441, 1, 7, 6, 9, 4, 4, 0),
(442, 1, 7, 5, 9, 5, 2, 0),
(443, 1, 7, 1, 10, 6, 3, 0),
(444, 1, 7, 3, 10, 6, 4, 0),
(445, 1, 7, 6, 10, 1, 1, 0),
(446, 1, 7, 1, 9, 3, 2, 0),
(447, 1, 7, 3, 10, 1, 4, 0),
(448, 1, 15, 1, 12, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `strecord`
--

CREATE TABLE `strecord` (
  `s_id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `grade` int(11) NOT NULL,
  `address` varchar(60) NOT NULL,
  `father` varchar(50) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` int(11) NOT NULL,
  `dobbs` date NOT NULL,
  `dobad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strecord`
--

INSERT INTO `strecord` (`s_id`, `username`, `grade`, `address`, `father`, `mother`, `first_name`, `last_name`, `gender`, `dobbs`, `dobad`) VALUES
(-817477723, 'aditya', 10, 'Madhopur', 'JayNarayan Raut', 'Anita Devi Raut', 'Aditya', 'Patel', 1, '2042-01-10', '1986-04-14'),
(-417303949, 'ann', 3, 'njkbdgn', 'nbjkjnb ', 'nbdfjn', 'bgknj', 'nbdf', 2, '2055-10-12', '1986-04-14'),
(25588418, 'amit', 7, 'Madhopur', 'JayNarayan Raut', 'Anita Devi Raut', 'Amit Kumar', 'Patel', 1, '2052-12-28', '1996-04-10'),
(233386664, 'arun', 3, 'Madhopur', 'JayNarayan Raut', 'Anita Devi Raut', 'Arun Kumar', 'Patel', 1, '2044-02-15', '1988-02-04'),
(1361703869, 'asdf', 2, 'aaaa', 'aaaa', 'aaaaa', 'aaaaa', 'aaa', 2, '2055-10-12', '1988-02-04'),
(1587105892, 'archana', 4, 'Madhopur', 'JayNarayan Raut', 'Anita Devi Raut', 'Archana', 'Patel', 2, '2046-01-01', '1990-02-05'),
(1833286559, 'anu', 2, 'Madhopur', 'JayNarayan Raut', 'Anita Devi Raut', 'Anu', 'Patel', 2, '2050-01-09', '1994-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `std_roll_no` int(11) NOT NULL,
  `student_name` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `Session` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Program` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Semester` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`std_roll_no`, `student_name`, `dob`, `gender`, `email`, `phone`, `address`, `Session`, `Program`, `Semester`) VALUES
(2, 'Arun Patel', '1988-01-30', 'male', 'patelarun@outlook.com', '9841334455', 'Delhi', '3', '5th', 'BCS'),
(3, 'Arun Patel', '1988-02-07', 'male', 'patelamyt@gmail.com', '', '', '', '2017', 'Class 6'),
(4, 'Patel patel', '2010-09-08', '1', 'patelamyt@outlook.com', '9843567856', 'rrrrrrrrrrrrrrr', '4', '2017', 'Class 6');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `subject_no` int(11) NOT NULL,
  `subject_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `teacher_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `field` varchar(8) CHARACTER SET utf8 NOT NULL,
  `semester` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_table`
--

INSERT INTO `subject_table` (`subject_no`, `subject_name`, `teacher_name`, `field`, `semester`) VALUES
(1, 'C++', 'Sir javed', 'BSCS', '5th'),
(2, 'Java', 'Others', 'BSCS', '5th');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendence`
--

CREATE TABLE `tbl_attendence` (
  `attID` int(11) NOT NULL,
  `StudentRollNumber` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `Attendence` varchar(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendence`
--

INSERT INTO `tbl_attendence` (`attID`, `StudentRollNumber`, `SubjectId`, `Attendence`, `Date`) VALUES
(6, 1, 1, 'P', '2017-01-19 00:00:00'),
(14, 1, 2, 'P', '2017-01-19 00:00:00'),
(15, 2, 1, 'P', '2017-01-19 00:00:00'),
(16, 1, 1, 'A', '2017-01-20 00:00:00'),
(18, 1, 2, 'P', '2017-01-20 00:00:00'),
(19, 0, 0, '', '2017-01-20 00:00:00'),
(20, 4, 1, 'P', '2017-02-11 00:00:00'),
(21, 3, 1, 'P', '2017-02-11 00:00:00'),
(24, 4, 2, 'P', '2017-02-11 00:00:00'),
(25, 3, 1, 'P', '2017-02-12 00:00:00'),
(27, 4, 1, 'P', '2017-02-12 00:00:00'),
(29, 4, 2, 'A', '2017-02-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `phone` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `degree` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `salary` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `address` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_table`
--

INSERT INTO `teacher_table` (`teacher_id`, `first_name`, `last_name`, `dob`, `gender`, `email`, `phone`, `degree`, `salary`, `address`) VALUES
(1, 'Aditya', 'Patel', '1986-01-19', 'male', 'patelarun@outlook.com', '9841575754', 'Master', '40000', 'Kalaiya,Bara');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DAYS` int(11) DEFAULT NULL,
  `INTERVALS` int(11) DEFAULT NULL,
  `INTERVAL_START` int(11) DEFAULT NULL,
  `INTERVAL_LENGTH` int(11) DEFAULT NULL,
  `INTERVAL_GAP` int(11) DEFAULT NULL,
  `DAY_NAMES` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`ID`, `USER_ID`, `NAME`, `DAYS`, `INTERVALS`, `INTERVAL_START`, `INTERVAL_LENGTH`, `INTERVAL_GAP`, `DAY_NAMES`) VALUES
(1, 2, 'class', 6, 8, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `trrecord`
--

CREATE TABLE `trrecord` (
  `t_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `sex` int(11) NOT NULL,
  `nationality` int(11) NOT NULL,
  `citizenship_no` varchar(20) NOT NULL,
  `issue_district` varchar(20) NOT NULL,
  `father's_name` varchar(100) NOT NULL,
  `mother's_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `license_no` int(11) NOT NULL,
  `bank_acc_no` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `time` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `user_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `ip_address`, `time`, `date`, `user_status`) VALUES
(22, 'aditya', 'patel', '::1', '10:55:32pm', '2017:01:20', 'student'),
(20, 'amit', 'patel', '::1', '10:30:18pm', '2017:01:20', 'student'),
(25, 'ann', 'patel', '::1', '11:16:48pm', '2017:01:20', 'student'),
(24, 'anu', 'patel', '::1', '11:02:23pm', '2017:01:20', 'student'),
(23, 'archana', 'patel', '::1', '10:58:36pm', '2017:01:20', 'student'),
(21, 'arun', 'patel', '::1', '10:50:21pm', '2017:01:20', 'student'),
(26, 'asdf', 'asdf', '::1', '11:18:12pm', '2017:01:20', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sched_activities`
--
ALTER TABLE `sched_activities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `strecord`
--
ALTER TABLE `strecord`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`std_roll_no`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_no`);

--
-- Indexes for table `tbl_attendence`
--
ALTER TABLE `tbl_attendence`
  ADD PRIMARY KEY (`attID`),
  ADD UNIQUE KEY `attend` (`StudentRollNumber`,`SubjectId`,`Date`),
  ADD KEY `StudentRollNumber_2` (`StudentRollNumber`,`SubjectId`,`Date`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trrecord`
--
ALTER TABLE `trrecord`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sched_activities`
--
ALTER TABLE `sched_activities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;
--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `std_roll_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subject_table`
--
ALTER TABLE `subject_table`
  MODIFY `subject_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_attendence`
--
ALTER TABLE `tbl_attendence`
  MODIFY `attID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `strecord`
--
ALTER TABLE `strecord`
  ADD CONSTRAINT `strecord_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
