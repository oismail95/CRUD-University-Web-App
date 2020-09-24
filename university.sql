-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2020 at 03:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_number` varchar(10) NOT NULL,
  `course_name` varchar(50) DEFAULT '',
  `credit_hours` int(1) unsigned DEFAULT '0',
  `department` varchar(10) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_number`, `course_name`, `credit_hours`, `department`) VALUES
('CS1250', 'Intro to Computing', 3, 'CS'),
('CS2250', 'Program and Data', 5, 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `grade_report`
--

CREATE TABLE IF NOT EXISTS `grade_report` (
  `student_number` int(10) unsigned NOT NULL,
  `section_identifier` int(10) NOT NULL,
  `grade` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_report`
--

INSERT INTO `grade_report` (`student_number`, `section_identifier`, `grade`) VALUES
(21, 132, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE IF NOT EXISTS `prerequisite` (
  `course_number` varchar(10) NOT NULL,
  `prerequisite_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prerequisite`
--

INSERT INTO `prerequisite` (`course_number`, `prerequisite_number`) VALUES
('MATH2000', 'MATH1900');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_identifier` int(10) unsigned NOT NULL,
  `course_number` varchar(10) NOT NULL,
  `semester` varchar(10) DEFAULT '',
  `year` varchar(10) DEFAULT '',
  `instructor` varchar(10) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_identifier`, `course_number`, `semester`, `year`, `instructor`) VALUES
(22, 'CS4280', 'Spring', '19', 'Climer'),
(32, 'CS4760', 'Fall', '16', 'James');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_number` int(10) unsigned NOT NULL,
  `name` varchar(30) DEFAULT '',
  `class` int(1) unsigned DEFAULT '0',
  `major` varchar(10) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_number`, `name`, `class`, `major`) VALUES
(4, 'Adam', 3, 'CS'),
(24, 'Sam', 2, 'CS'),
(29, 'Carlos', 1, 'MATH'),
(39, 'John', 3, 'CS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`course_number`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`section_identifier`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
