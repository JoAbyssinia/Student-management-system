-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 10:17 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rvusrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `acadamic-calender`
--

CREATE TABLE `acadamic-calender` (
  `row` int(11) NOT NULL,
  `ocasion` varchar(45) DEFAULT NULL,
  `1st-semister` varchar(100) DEFAULT NULL,
  `2nd-semister` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acadamic-calender`
--

INSERT INTO `acadamic-calender` (`row`, `ocasion`, `1st-semister`, `2nd-semister`) VALUES
(35, 'Class Begin', 'Oct1( Oct, Nov, Dec, Jan )', 'Mar.3 ( March,  April.  May.,Jun. )'),
(36, 'Class End', '30-Jan', '30-Jun'),
(37, 'Exam Period', 'Feb 1-Feb 7', 'Jul 1-Jul 7 '),
(38, 'Break ', 'Feb 10-Feb 25', 'Jul 8-Sep 25'),
(39, 'Make up Exam ', '15-Mar', '15-Oct'),
(40, 'exam date', 'fab 1-fab 7', 'jul 1-Jul 7 '),
(41, 'Grade submission date', 'fab 4-fab 10', 'jul 4-jul 10'),
(42, 'Grade Report Distribution ', '25-Feb', '25-Sep'),
(43, ' Registration period', 'Feb 26 - Feb 28', 'Sep26-Sep 28'),
(44, 'Registration  with Penalty', 'Mar 1-Mar 2', 'Sep 29-Sep-30'),
(45, 'Academic Commission  Meeting(for Graduating s', '25-Mar', '25-Jul'),
(46, 'Senate Meeting(for Graduating students)', '31-Mar', '31-Jul'),
(47, 'Completing Spelling form With two Photographe', NULL, 'Aug 1-Jaug 5'),
(48, 'Clearance ', NULL, 'Aug 1-Jaug 10'),
(49, 'Tentative Graduation Date ', NULL, '22-Aug'),
(50, 'Issuance of Temp,Degree', NULL, 'Aug 25-Sep 30');

-- --------------------------------------------------------

--
-- Table structure for table `acadamic_history`
--

CREATE TABLE `acadamic_history` (
  `st_id` varchar(16) NOT NULL,
  `cors` varchar(15) NOT NULL,
  `dep` varchar(16) NOT NULL,
  `div` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `semister` varchar(45) NOT NULL,
  `lecture` varchar(16) DEFAULT NULL,
  `grade` char(5) DEFAULT NULL,
  `asses1` float DEFAULT NULL,
  `asses2` float DEFAULT NULL,
  `midexam` float DEFAULT NULL,
  `finalexam` float DEFAULT NULL,
  `gradepoint` varchar(4) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acadamic_history`
--

INSERT INTO `acadamic_history` (`st_id`, `cors`, `dep`, `div`, `year`, `semister`, `lecture`, `grade`, `asses1`, `asses2`, `midexam`, `finalexam`, `gradepoint`, `timestamp`) VALUES
('RVUSDR/1417/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 11, 8, 18, 18, '60', '2020-10-30 08:06:29'),
('RVUSDR/1725/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 7, 9, 17, 21, '54', '2020-10-01 08:17:00'),
('RVUSDR/1977/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'A', 14, 14, 28, 33, '89', '2020-10-01 08:17:00'),
('RVUSDR/6964/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 13, 13, 21, 29, '76', '2020-10-01 08:17:00'),
('RVUSDR/9301/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 10, 11, 19, 19, '75', '2020-10-30 08:04:48'),
('RVUSDR/9571/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 12, 9, 19, 29, '69', '2020-10-01 08:16:59'),
('RVUSDR/9573/20', 'COMP241', 'cs', 'R', '1st', '1st', 'RVUIST/6403/20', 'B', 9, 8, 15, 10, '42', '2020-10-01 08:17:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ac_view`
-- (See below for the actual view)
--
CREATE TABLE `ac_view` (
`year` varchar(45)
,`semister` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `addcourse`
--

CREATE TABLE `addcourse` (
  `st_id` varchar(16) NOT NULL,
  `cr_code` varchar(15) NOT NULL,
  `dep` varchar(16) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `div` varchar(4) DEFAULT NULL,
  `section` int(11) DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) DEFAULT '0',
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `adminlogin`
-- (See below for the actual view)
--
CREATE TABLE `adminlogin` (
`id` int(11)
,`username` varchar(45)
,`password` varchar(100)
,`roll` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `admin_staff`
--

CREATE TABLE `admin_staff` (
  `id` int(11) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `roll` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT 'adminstaff'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_staff`
--

INSERT INTO `admin_staff` (`id`, `fullname`, `username`, `phone`, `email`, `roll`, `password`) VALUES
(1, 'Sara Teshomes  ', 'sarat', '096325874              ', 'Sara2012@gmail.com', 'admin', 'Adminstaff              '),
(3, 'natnael yohannes ', 'natjohns ', '0911958893 ', 'jhonstar.kassa@gmail.com ', 'data', 'adminstaff');

-- --------------------------------------------------------

--
-- Table structure for table `app_grade`
--

CREATE TABLE `app_grade` (
  `st_id` varchar(16) NOT NULL,
  `cor_code` varchar(15) NOT NULL,
  `sem` varchar(4) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `grade` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_grade`
--

INSERT INTO `app_grade` (`st_id`, `cor_code`, `sem`, `year`, `grade`) VALUES
('RVUSDR/1417/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/1417/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/1417/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/1417/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/1725/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/1725/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/1725/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/1725/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/1977/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/1977/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/1977/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/1977/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/6964/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/6964/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/6964/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/6964/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/9301/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/9301/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/9301/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/9301/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/9571/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/9571/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/9571/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/9571/20', 'COMP242', '1st', '1st', NULL),
('RVUSDR/9573/20', 'COMP211', '1st', '1st', NULL),
('RVUSDR/9573/20', 'COMP222', '1st', '1st', NULL),
('RVUSDR/9573/20', 'COMP241', '1st', '1st', 'a'),
('RVUSDR/9573/20', 'COMP242', '1st', '1st', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `assigndetail1`
-- (See below for the actual view)
--
CREATE TABLE `assigndetail1` (
`cr_code` varchar(15)
,`year` varchar(6)
,`dep` varchar(16)
,`div` varchar(16)
,`semister` varchar(16)
,`lecture` varchar(16)
,`section` int(3)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `attend`
-- (See below for the actual view)
--
CREATE TABLE `attend` (
`st_id` varchar(16)
,`cr_code` varchar(15)
,`course_tilte` varchar(100)
,`credit_houre` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `classfilter`
-- (See below for the actual view)
--
CREATE TABLE `classfilter` (
`depname` varchar(50)
,`department` varchar(16)
,`acadamic_year` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cr_code` varchar(15) NOT NULL,
  `course_tilte` varchar(100) DEFAULT NULL,
  `catagory` varchar(7) DEFAULT NULL,
  `credit_houre` int(11) DEFAULT NULL,
  `offering_dep` varchar(16) DEFAULT NULL,
  `prerequesit` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cr_code`, `course_tilte`, `catagory`, `credit_houre`, `offering_dep`, `prerequesit`) VALUES
('ACC137', 'introduction to accounting ', 'main', 3, 'acc', ''),
('ACC152', 'cost for accounting ', 'main', 3, 'acc', ''),
('ACC154', 'principle of accounting 1', 'main', 3, 'acc', ''),
('COMP211', 'introduction to computer science ', 'main', 4, 'cs', ''),
('COMP222', 'system analysis and design', 'main', 3, 'cs', 'INSY221,'),
('COMP241', 'Digital logic ', 'main', 3, 'cs', ''),
('COMP242', 'Computer Organization and architecture', 'main', 3, 'cs', 'COMP241,'),
('COMP272', 'Fundamental of programming 1', 'main', 4, 'cs', 'COMP211,'),
('COMP323', 'fundamental of database systems', 'main', 3, 'cs', 'COMP222,'),
('COMP324', 'cloud computing ', 'main', 3, 'cs', ''),
('COMP343', 'microprocessor & assembly programming ', 'main', 3, 'cs', 'COMP242,'),
('COMP353', 'analysis of algorithms', 'main', 3, 'cs', 'COMP272,'),
('COMP354', 'operating systems ', 'main', 3, 'cs', 'COMP242,'),
('COMP373', 'fundamental of programming 2', 'main', 4, 'cs', 'COMP272,'),
('COMP374', 'object oriented programming ', 'main', 4, 'cs', 'COMP373,'),
('COMP384', 'computer networking & data communication ', 'main', 3, 'cs', 'COMP211,'),
('COMP405', 'research methods in computer science', 'main', 3, 'cs', 'COMP211,'),
('COMP406', 'professional ethics and human values ', 'common', 2, 'acc', ''),
('COMP426', 'advanced database systems', 'main', 3, 'cs', 'COMP323,'),
('COMP435', 'internet and website development ', 'main', 3, 'cs', 'COMP373,COMP384,'),
('COMP446', 'computer hardware and maintenance', 'common', 3, 'cs', 'COMP242,COMP343,'),
('COMP455', 'computer security ', 'common', 3, 'cs', 'COMP384,'),
('COMP456', 'complexity theory ', 'common', 3, 'cs', 'MATH311,'),
('COMP465', 'rapid application development ', 'main', 3, 'cs', 'COMP323,COMP373,'),
('COMP466', 'computer graphics ', 'main', 3, 'cs', 'COMP373,'),
('COMP467', 'software engineering ', 'main', 3, 'cs', 'COMP384,'),
('COMP475', 'data structures & algorithms analysis', 'main', 3, 'cs', 'COMP353,COMP374,'),
('COMP476', 'advanced programming with java', 'main', 4, 'cs', 'COMP323,COMP435,'),
('COMP522', 'introduction to information storage and retrieval', 'main', 3, 'cs', ''),
('COMP533', 'e-commerce ', 'main', 3, 'cs', ''),
('COMP537', 'advanced website development ', 'main', 3, 'cs', 'COMP435,'),
('COMP553', 'principle of programming languages', 'main', 3, 'cs', ''),
('COMP557', 'formal languages and automate theory  ', 'common', 3, 'cs', 'COMP343,COMP456,'),
('COMP563', 'computer vision and image processing', 'main', 3, 'cs', ''),
('COMP565', 'information system project management', 'common', 3, 'cs', 'COMP405,'),
('COMP567', 'UNIX system administration and support', 'main', 3, 'cs', 'COMP354,'),
('COMP568', 'artificial intelligence', 'main', 3, 'cs', 'COMP353,'),
('COMP577', 'soft computing techniques', 'main', 3, 'cs', 'COMP467,'),
('COMP578', 'compiler design', 'main', 4, 'cs', 'COMP456,COMP557,'),
('COMP597', 'senior project 1', 'main', 3, 'cs', 'COMP211,'),
('COMP598', 'senior project 2', 'main', 3, 'cs', 'COMP597,'),
('CVET231', 'civics & ethical education ', 'main', 3, 'cs', ''),
('ECON231', 'Micro Economics', 'common', 3, 'acc', ''),
('ENLA231', 'writing skills', 'main', 3, 'cs', ''),
('INSY221', 'Fundamentals of information system ', 'main', 3, 'cs', ''),
('MATH221', 'linear algebra', 'main', 3, 'cs', ''),
('MATH291', 'Calculus', 'common', 3, 'cs', ''),
('MATH292', 'optimization techniques ', 'main', 3, 'cs', 'MATH291,'),
('MATH311', 'numerical analysis', 'main', 3, 'cs', ''),
('MATH391', 'discrete mathematics & combinatorics ', 'main', 3, 'cs', 'MATH291,'),
('MGMT354', 'entrepreneurship & small business management ', 'main', 3, 'buma', ''),
('PHIL344', 'introduction to logic', 'common', 3, 'cs', ''),
('STAT212', 'probability and statistics ', 'main', 3, 'cs', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `course_enroll`
-- (See below for the actual view)
--
CREATE TABLE `course_enroll` (
`st_id` varchar(16)
,`cr_code` varchar(15)
,`course_tilte` varchar(100)
,`credit_houre` int(11)
,`prerequesit` varchar(100)
,`fname` varchar(15)
,`lname` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_code` varchar(16) NOT NULL,
  `depname` varchar(50) DEFAULT NULL,
  `facality` varchar(15) DEFAULT NULL,
  `dephead` varchar(16) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_code`, `depname`, `facality`, `dephead`, `timestamp`) VALUES
('acc', ' Accounting & Finance ', 'fac_bae', 'RVUIST/6706/20', '2020-09-30 17:58:27'),
('buma', 'Business Management', 'fac_bae', '', '2020-09-03 13:10:15'),
('ceng', 'Civil Engineering', 'fac_tech', '', '2020-09-03 13:06:31'),
('cotm', 'Construction Technology Management', 'fac_tech', '', '2020-09-03 13:07:59'),
('cs', 'computer science ', 'fac_tech', 'RVUIST/6403/20', '2020-09-03 13:06:31'),
('ho', 'Health officer', 'fac_health', '', '2020-09-03 13:14:16'),
('md', 'Medical Laboratory', 'fac_health', '', '2020-09-03 13:15:54'),
('med', 'Medicine', 'fac_health', '', '2020-09-03 13:12:37'),
('mid', 'Midwifery', 'fac_health', '', '2020-09-03 13:14:49'),
('nurs', 'Nursing', 'fac_health', '', '2020-09-03 13:13:20'),
('phr', 'Pharmacy', 'fac_health', '', '2020-09-03 13:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `dropcourse`
--

CREATE TABLE `dropcourse` (
  `st_id` varchar(16) NOT NULL,
  `cor_code` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) DEFAULT '0',
  `dip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `st_id` varchar(16) NOT NULL,
  `cr_code` varchar(15) NOT NULL,
  `year` varchar(6) DEFAULT NULL,
  `dep` varchar(16) DEFAULT NULL,
  `div` varchar(16) DEFAULT NULL,
  `semister` varchar(16) DEFAULT NULL,
  `enroll_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lecture` varchar(16) DEFAULT NULL,
  `reg_st` int(11) DEFAULT '0',
  `reg` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`st_id`, `cr_code`, `year`, `dep`, `div`, `semister`, `enroll_date`, `lecture`, `reg_st`, `reg`) VALUES
('RVUSDR/1417/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:50', 'RVUIST/5369/20', 0, 0),
('RVUSDR/1417/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:50', 'RVUIST/3861/20', 0, 0),
('RVUSDR/1417/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:50', 'RVUIST/8405/20', 0, 0),
('RVUSDR/1725/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/5369/20', 0, 0),
('RVUSDR/1725/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/3861/20', 0, 0),
('RVUSDR/1725/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/8405/20', 0, 0),
('RVUSDR/1977/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/5369/20', 0, 0),
('RVUSDR/1977/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/3861/20', 0, 0),
('RVUSDR/1977/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/8405/20', 0, 0),
('RVUSDR/6964/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/5369/20', 0, 0),
('RVUSDR/6964/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/3861/20', 0, 0),
('RVUSDR/6964/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/8405/20', 0, 0),
('RVUSDR/9301/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/5369/20', 0, 0),
('RVUSDR/9301/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/3861/20', 0, 0),
('RVUSDR/9301/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/8405/20', 0, 0),
('RVUSDR/9571/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 08:02:30', 'RVUIST/5369/20', 1, 1),
('RVUSDR/9571/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 08:02:30', 'RVUIST/3861/20', 1, 1),
('RVUSDR/9571/20', 'COMP242', '1st', 'cs', 'R', '1st', '2021-02-10 08:46:24', 'RVUIST/8405/20', 1, 1),
('RVUSDR/9573/20', 'COMP211', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/5369/20', 0, 0),
('RVUSDR/9573/20', 'COMP222', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/3861/20', 0, 0),
('RVUSDR/9573/20', 'COMP242', '1st', 'cs', 'R', '1st', '2020-10-01 07:57:51', 'RVUIST/8405/20', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `code` varchar(15) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`code`, `name`, `timestamp`) VALUES
('fac_bae', 'Business and Social Science', '2020-08-15 11:33:29'),
('fac_health', 'Health Science', '2020-09-03 12:58:01'),
('fac_tech', 'Technology and Engineering', '2020-09-03 12:58:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `grade_app`
-- (See below for the actual view)
--
CREATE TABLE `grade_app` (
`st_id` varchar(16)
,`cor_code` varchar(15)
,`course_tilte` varchar(100)
,`year` varchar(4)
,`credit_houre` int(11)
,`sem` varchar(4)
,`grade` char(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `grade_submit`
--

CREATE TABLE `grade_submit` (
  `id` int(11) NOT NULL,
  `dep` varchar(16) DEFAULT NULL,
  `year` varchar(16) DEFAULT NULL,
  `div` varchar(16) DEFAULT NULL,
  `sem` varchar(16) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `doc_grade` varchar(500) DEFAULT NULL,
  `doc_attendace` varchar(500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cor_id` varchar(15) DEFAULT NULL,
  `lec_id` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_submit`
--

INSERT INTO `grade_submit` (`id`, `dep`, `year`, `div`, `sem`, `section`, `doc_grade`, `doc_attendace`, `date`, `cor_id`, `lec_id`) VALUES
(1, 'cs', '1st', 'R', '1st', 1, 'admin/dist/docs/grade-submited/1ST yr cs grade-grade-COMP241-cs-1st-R-1-2020.xlsx', 'admin/dist/docs/grade-submited/attendace-attendace-COMP241-cs-1st-R-1-2020.xlsx', '2020-10-01 08:11:40', 'COMP241', 'RVUIST/6403/20');

-- --------------------------------------------------------

--
-- Table structure for table `important-docs`
--

CREATE TABLE `important-docs` (
  `id` int(11) NOT NULL,
  `docname` varchar(45) DEFAULT NULL,
  `path` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `important-docs`
--

INSERT INTO `important-docs` (`id`, `docname`, `path`, `timestamp`, `type`) VALUES
(7, 'Rvu acadamic calender2020', '/dist/docs/calender/Rvu acadamic calender2020.pdf', '2020-08-21 09:17:58', 'calender'),
(9, 'graduation-2020', '/dist/docs/imp-documets/graduation-2020.pdf', '2020-09-21 08:58:52', 'important'),
(11, 'compare c and o-2020', '/dist/docs/imp-documets/compare c and o-2020.pdf', '2020-09-21 08:58:37', 'important'),
(12, 'regradeform-2020', '/dist/docs/imp-documets/regradeform-2020.pdf', '2020-09-21 09:10:26', 'important');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `ins_id` varchar(16) NOT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `dep` varchar(15) DEFAULT NULL,
  `entery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(16) DEFAULT 'inst123rvu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`ins_id`, `fname`, `lname`, `type`, `gender`, `dep`, `entery_date`, `phone`, `email`, `password`) VALUES
('RVUIST/3861/20', 'musa', 'adem ', 'full', 'male', 'cs', '2020-09-30 16:05:25', '092-060-1130', 'musa.adem87@gmail.com', 'inst123rvu'),
('RVUIST/4401/20', 'abera', 'desalgn', 'per', 'male', 'cs', '2020-09-30 16:04:15', '092-208-5523', 'abera.desalgn@gmail', 'inst123rvu'),
('RVUIST/4991/20', 'tadel', 'hayilu', 'full', 'male', 'cs', '2020-09-30 16:21:02', '092-058-4569', 'tadel.ayilu@gmail', 'inst123rvu'),
('RVUIST/5369/20', 'abdu', 'mohammed', 'full', 'male', 'cs', '2020-09-01 12:48:38', '092-545-7895', 'abudmohammed@gmail.com', 'inst123rvu'),
('RVUIST/6403/20', 'lekeyelesh', 'tesfeye', 'full', 'female', 'cs', '2020-09-30 16:11:21', '091-198-7456', 'likeleshitesifaye@gmail.com', 'inst123rvu'),
('RVUIST/6706/20', 'kebede', 'chala', 'full', 'male', 'acc', '2020-09-30 16:37:45', '094-587-8956', 'kebed.chala@gmail', 'inst123rvu'),
('RVUIST/7391/20', 'edris', 'kemal', 'per', 'male', 'cs', '2020-09-30 16:16:02', '091-188-3273', 'edriskemal@gmail.com', 'inst123rvu'),
('RVUIST/7976/20', 'meskerm', 'desalgn', 'full', 'female', 'acc', '2020-09-30 16:35:20', '092-689-9045', 'meskerm.desalgn@gmail', 'inst123rvu'),
('RVUIST/7991/20', 'gezahegn ', 'weldu', 'per', 'male', 'acc', '2020-09-30 16:40:42', '092-276-7765', 'gezahegnwolde@gmail.com', 'inst123rvu'),
('RVUIST/8405/20', 'daniel', 'tegegn', 'per', 'male', 'cs', '2020-09-30 16:17:27', '092-312-5478', 'daniel.tegegn@gmail', 'inst123rvu'),
('RVUIST/8599/20', 'bushra', 'ali', 'per', 'male', 'cs', '2020-09-30 16:10:12', '091-287-4525', 'bushra.ali@gmail', 'inst123rvu');

-- --------------------------------------------------------

--
-- Stand-in structure for view `numberofstudent`
-- (See below for the actual view)
--
CREATE TABLE `numberofstudent` (
`department` varchar(16)
,`division` varchar(20)
,`academic_year` varchar(10)
,`total-student` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` varchar(16) NOT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `mname` varchar(15) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `birth_date` varchar(15) DEFAULT NULL,
  `department` varchar(16) DEFAULT NULL,
  `division` varchar(20) DEFAULT NULL,
  `entery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `academic_year` varchar(10) DEFAULT NULL,
  `password` varchar(45) DEFAULT 'stu123rvu',
  `profile` varchar(100) DEFAULT 'assets/img/blank_avatar.png',
  `section` int(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `fname`, `mname`, `lname`, `gender`, `birth_date`, `department`, `division`, `entery_date`, `email`, `phone`, `academic_year`, `password`, `profile`, `section`) VALUES
('RVUSDR/1417/20', 'ABRHAM', 'GEREMEW', 'ALEHEGN', 'male', '1996-12-30', 'cs', 'R', '2020-09-30 17:46:36', 'abrehamgeremew@gmail.com', '0987412563', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/1725/20', 'AYANTU', 'ABDII', 'IBRO', 'femal', '1998-01-16', 'cs', 'R', '2020-09-30 17:46:36', 'ayantu@gmail.com', '0920258974', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/1820/20', 'AMANUEL', ' KASSA', 'YIMAM', 'male', '1996-08-12', 'ACC', 'R', '2020-09-30 21:06:13', 'amanuelkassa.yimam@gmail.com', '0912223434', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/1977/20', 'LIDIYA', 'TESFA', 'KASSIE', 'femal', '1997-12-12', 'cs', 'R', '2020-09-30 17:46:36', 'lidiyatesfa@gmail.com', '0923568974', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/2011/20', 'BILISEE', 'HAILU', 'DINKA', 'male', '1996-11-27', 'ACC', 'R', '2020-10-30 07:33:17', 'biliseehailu.dinka@gmail.com', '0922458200', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 2),
('RVUSDR/2096/20', 'ELLENI ', 'SHIBABAW', 'MOLLA', 'femal', '1996-07-02', 'ACC', 'R', '2020-09-30 21:06:13', 'ellenishibabaw.molla@gmail.com', '0923552020', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/2509/20', 'TSEGAHUN ', 'HIRPESA', 'TADESE', 'male', '1996-06-15', 'ACC', 'R', '2020-10-30 07:33:17', 'tsegahunhirpesa.tadese@gmail.com', '0938055418', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 2),
('RVUSDR/5158/20', 'BETELEHEM', 'ABAYNEH', 'ZERFU', 'femal', '1995-05-18', 'ACC', 'R', '2020-09-30 21:06:51', 'betelehemabayneh.zerfu@gmail.com', '0928099554', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/6964/20', 'FEVEN', 'ALEHGN', 'CHEKLIE', 'femal', '1997-09-26', 'cs', 'R', '2020-09-30 17:46:36', 'faven.alehegn@gmail.com', '0912563214', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/7840/20', 'GELETA', 'BORENA', 'DEBELA', 'male', '1995-05-12', 'ACC', 'R', '2020-10-30 07:33:17', 'geletaborena.debela@gmail.com', '0922106375', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 2),
('RVUSDR/8800/20', 'IBRAHIM ', ' SIRAJ', 'AHMEAD', 'femal', '1996-04-19', 'ACC', 'R', '2020-09-30 21:06:13', 'ibrahimsiraj.ahmead@gmail.com', '0915880112', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/8875/20', 'NURSEFA', 'RESHAD', 'HUSSEN', 'male', '1996-12-22', 'ACC', 'R', '2020-10-30 07:33:17', '', '0924510089', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 2),
('RVUSDR/9301/20', 'ABEBE', 'ALEMU', 'DEBEB', 'male', '1996-06-12', 'cs', 'R', '2020-09-30 17:46:36', 'abelealemu@gmail.com', '0912457896', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/9400/20', 'amanuel', 'kassa', 'yimam', 'male', '1996-06-14', 'ceng', 'R', '2020-09-30 17:39:33', 'nnana@gmail.com', '092-003-3259', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/9571/20', 'YOHANNES', 'KASSA', 'YIMAM', 'male', '1996-10-10', 'cs', 'R', '2020-12-31 09:12:33', 'johnstar@gmail.com', '0932658566', '1st', 'stu123rvu', 'admin/dist/storege/b1-YOHANNESKASSAYIMAM-2020.jpg', 1),
('RVUSDR/9573/20', 'TEWODROS', 'GIRMAY', 'GEBREMEDHIN', 'male', '1996-11-11', 'cs', 'R', '2020-09-30 17:46:36', 'tedros2020@gmail.com', '0921547896', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1),
('RVUSDR/9580/20', 'CHERU', 'WOLDE ', 'HUSEN', 'male', '1995-01-28', 'ACC', 'R', '2020-09-30 21:06:13', 'cheruwolde.husen@gmail.com', '0912673971', '1st', 'stu123rvu', 'assets/img/blank_avatar.png', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `studetchid`
-- (See below for the actual view)
--
CREATE TABLE `studetchid` (
`st_id` varchar(16)
);

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `msg` text,
  `to` varchar(45) DEFAULT NULL,
  `office` varchar(45) DEFAULT NULL,
  `from` varchar(45) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cont_tel` varchar(16) DEFAULT NULL,
  `cont_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `subject`, `msg`, `to`, `office`, `from`, `date`, `cont_tel`, `cont_email`) VALUES
(8, 'notification', '&lt;p&gt;&lt;span style=&quot;font-family: Tahoma, sans-serif, Arial, Helvetica; font-size: 13px; white-space: pre-wrap;&quot;&gt;this notification is to inform you that you are not required to come to the campus in person/physically to make payments or to receive any kind of service. Please make payments at any CBE branch in your local area and send your receipts to your department head via the telegram channel you have been using to obtain course materials. If you must come here in person, please call your department head and notify your intention. Also know that wearing a face mask is mandatory for anyone to be admitted to the campus compound. Stay safe and thank you for taking this advice seriously. Kassa A. (Dean)&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'To all RVU Adama Campus students', 'Dean', '1', '2020-09-30 15:52:26', '0985742136', 'rvuadamaregisrar@gmail.com'),
(9, 'registration ', '&lt;p&gt;&lt;span style=&quot;font-family: Tahoma, sans-serif, Arial, Helvetica; font-size: 13px; white-space: pre-wrap;&quot;&gt;The registrar office of RVU Adama campus has planned to register you in person for 2nd semester in on the date of Wednesday (20/05/2020) therefore you are expected to come to the campus compound on the date mentioned (Wednesday 20/05/2020) to finalize your registration and take registration slip. Those of you who miss this date of registration will not be served by the registrar because other departments will use that time for other departments to minimize crowding and risk of COVID-19 during registration.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'TO ALL 1st YEAR PUBLIC HEALTH STUDENTS ', 'Health Science', '1', '2020-09-30 15:55:05', '0985742136', 'rvuadamaregisrar@gmail.com'),
(10, 'registration ', '&lt;p&gt;&lt;span style=&quot;font-family: Tahoma, sans-serif, Arial, Helvetica; font-size: 13px; white-space: pre-wrap;&quot;&gt;TO regular 4th and 3rd YEAR CIVIL ENGINEERING STUDENTS The registrar office of RVU Adama campus has planned to register you in person for 2nd semester in the on the date of Thursday (21/05/2020) therefor you are expected to come to the campus compound on the date mentioned (Thursday 21/05/2020) to finalize your registration and take registration slip Those of you who miss this date of regitrstion will not be served by the registarar because other departments will use that time for other departments to minimize crowding and risk of COVID-19 during regitsrtion.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'Rift Valley University Adama Campus Civil Eng', 'Civil Engineering department ', '1', '2020-09-30 15:56:52', '0985742136', 'rvuadamaregisrar@gmail.com'),
(11, 'payment fee', '&lt;p&gt;&lt;span style=&quot;font-family: Tahoma, sans-serif, Arial, Helvetica; font-size: 13px; white-space: pre-wrap;&quot;&gt;The Faculty would like to thank all 2nd semester, 2020 A .Y. course instructors for the unreserved contribution and cooperation in supporting, advising and providing teaching materials (course outline, handout/modules, power point summary notes, e - books, assignments, etc) in online service to your students, regardless of the impact and fear caused by the pandemic. In addition, your positive thinking and response on overtime payment decision of the Head Office Management is admirable. The Faculty believes that, the quality of the instructional course materials and the assignment you deliver to the student is of standard. Essay type of question set in the assignment is reliable if it is of structured type, since it reduces biasing when marking. Be respectful to give information to students when needed. Sertse.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'rift valley undergraduate extension students ', 'registrar office and finance office', '1', '2020-09-30 16:04:17', '0985742136', 'rvuadamaregisrar@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `timeline_view`
-- (See below for the actual view)
--
CREATE TABLE `timeline_view` (
`id` int(11)
,`subject` varchar(100)
,`msg` text
,`to` varchar(45)
,`office` varchar(45)
,`fullname` varchar(45)
,`date` timestamp
,`cont_tel` varchar(16)
,`cont_email` varchar(45)
);

-- --------------------------------------------------------

--
-- Structure for view `ac_view`
--
DROP TABLE IF EXISTS `ac_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ac_view`  AS  select `acadamic_history`.`year` AS `year`,`acadamic_history`.`semister` AS `semister` from `acadamic_history` group by `acadamic_history`.`year` desc,`acadamic_history`.`semister` desc ;

-- --------------------------------------------------------

--
-- Structure for view `adminlogin`
--
DROP TABLE IF EXISTS `adminlogin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `adminlogin`  AS  select `admin_staff`.`id` AS `id`,`admin_staff`.`username` AS `username`,`admin_staff`.`password` AS `password`,`admin_staff`.`roll` AS `roll` from `admin_staff` ;

-- --------------------------------------------------------

--
-- Structure for view `assigndetail1`
--
DROP TABLE IF EXISTS `assigndetail1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `assigndetail1`  AS  select `enroll`.`cr_code` AS `cr_code`,`enroll`.`year` AS `year`,`enroll`.`dep` AS `dep`,`enroll`.`div` AS `div`,`enroll`.`semister` AS `semister`,`enroll`.`lecture` AS `lecture`,`student`.`section` AS `section` from (`enroll` join `student` on((`enroll`.`st_id` = `student`.`st_id`))) group by `enroll`.`cr_code`,`enroll`.`dep`,`enroll`.`year`,`enroll`.`semister`,`enroll`.`div`,`enroll`.`lecture`,`student`.`section` ;

-- --------------------------------------------------------

--
-- Structure for view `attend`
--
DROP TABLE IF EXISTS `attend`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attend`  AS  select `acadamic_history`.`st_id` AS `st_id`,`course`.`cr_code` AS `cr_code`,`course`.`course_tilte` AS `course_tilte`,`course`.`credit_houre` AS `credit_houre` from (`acadamic_history` join `course` on((`acadamic_history`.`cors` = `course`.`cr_code`))) ;

-- --------------------------------------------------------

--
-- Structure for view `classfilter`
--
DROP TABLE IF EXISTS `classfilter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classfilter`  AS  select `department`.`depname` AS `depname`,`student`.`department` AS `department`,`student`.`academic_year` AS `acadamic_year` from (`student` join `department` on((`student`.`department` = `department`.`dep_code`))) group by `student`.`department`,`student`.`academic_year`,`student`.`division` ;

-- --------------------------------------------------------

--
-- Structure for view `course_enroll`
--
DROP TABLE IF EXISTS `course_enroll`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `course_enroll`  AS  select `enroll`.`st_id` AS `st_id`,`course`.`cr_code` AS `cr_code`,`course`.`course_tilte` AS `course_tilte`,`course`.`credit_houre` AS `credit_houre`,`course`.`prerequesit` AS `prerequesit`,`instructor`.`fname` AS `fname`,`instructor`.`lname` AS `lname` from ((`enroll` join `course` on((`enroll`.`cr_code` = `course`.`cr_code`))) left join `instructor` on((`enroll`.`lecture` = `instructor`.`ins_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `grade_app`
--
DROP TABLE IF EXISTS `grade_app`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grade_app`  AS  select `app_grade`.`st_id` AS `st_id`,`app_grade`.`cor_code` AS `cor_code`,`course`.`course_tilte` AS `course_tilte`,`app_grade`.`year` AS `year`,`course`.`credit_houre` AS `credit_houre`,`app_grade`.`sem` AS `sem`,`app_grade`.`grade` AS `grade` from (`app_grade` join `course` on((`app_grade`.`cor_code` = `course`.`cr_code`))) ;

-- --------------------------------------------------------

--
-- Structure for view `numberofstudent`
--
DROP TABLE IF EXISTS `numberofstudent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `numberofstudent`  AS  select `student`.`department` AS `department`,`student`.`division` AS `division`,`student`.`academic_year` AS `academic_year`,count(0) AS `total-student` from `student` group by `student`.`department`,`student`.`division`,`student`.`academic_year` ;

-- --------------------------------------------------------

--
-- Structure for view `studetchid`
--
DROP TABLE IF EXISTS `studetchid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studetchid`  AS  select `student`.`st_id` AS `st_id` from `student` ;

-- --------------------------------------------------------

--
-- Structure for view `timeline_view`
--
DROP TABLE IF EXISTS `timeline_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timeline_view`  AS  select `timeline`.`id` AS `id`,`timeline`.`subject` AS `subject`,`timeline`.`msg` AS `msg`,`timeline`.`to` AS `to`,`timeline`.`office` AS `office`,`admin_staff`.`fullname` AS `fullname`,`timeline`.`date` AS `date`,`timeline`.`cont_tel` AS `cont_tel`,`timeline`.`cont_email` AS `cont_email` from (`timeline` join `admin_staff` on((`timeline`.`from` = `admin_staff`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acadamic-calender`
--
ALTER TABLE `acadamic-calender`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `acadamic_history`
--
ALTER TABLE `acadamic_history`
  ADD PRIMARY KEY (`st_id`,`cors`,`dep`,`div`,`year`,`semister`),
  ADD KEY `cors` (`cors`),
  ADD KEY `dep` (`dep`),
  ADD KEY `lecture` (`lecture`);

--
-- Indexes for table `addcourse`
--
ALTER TABLE `addcourse`
  ADD PRIMARY KEY (`row`,`st_id`,`cr_code`),
  ADD KEY `st_id` (`st_id`),
  ADD KEY `cr_code` (`cr_code`),
  ADD KEY `dep` (`dep`);

--
-- Indexes for table `admin_staff`
--
ALTER TABLE `admin_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_grade`
--
ALTER TABLE `app_grade`
  ADD PRIMARY KEY (`st_id`,`cor_code`),
  ADD KEY `course` (`cor_code`) USING BTREE,
  ADD KEY `student` (`st_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cr_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_code`),
  ADD KEY `fac` (`facality`),
  ADD KEY `dephead` (`dephead`) USING BTREE;

--
-- Indexes for table `dropcourse`
--
ALTER TABLE `dropcourse`
  ADD PRIMARY KEY (`st_id`,`cor_code`),
  ADD KEY `dropcourse_ibfk_1` (`cor_code`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`st_id`,`cr_code`),
  ADD KEY `course` (`cr_code`),
  ADD KEY `inst` (`lecture`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `grade_submit`
--
ALTER TABLE `grade_submit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lec_id` (`lec_id`),
  ADD KEY `cor_id` (`cor_id`) USING BTREE;

--
-- Indexes for table `important-docs`
--
ALTER TABLE `important-docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acadamic-calender`
--
ALTER TABLE `acadamic-calender`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `addcourse`
--
ALTER TABLE `addcourse`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_staff`
--
ALTER TABLE `admin_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade_submit`
--
ALTER TABLE `grade_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `important-docs`
--
ALTER TABLE `important-docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acadamic_history`
--
ALTER TABLE `acadamic_history`
  ADD CONSTRAINT `acadamic_history_ibfk_1` FOREIGN KEY (`cors`) REFERENCES `course` (`cr_code`),
  ADD CONSTRAINT `acadamic_history_ibfk_2` FOREIGN KEY (`dep`) REFERENCES `department` (`dep_code`),
  ADD CONSTRAINT `acadamic_history_ibfk_3` FOREIGN KEY (`lecture`) REFERENCES `instructor` (`ins_id`),
  ADD CONSTRAINT `stundet` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `addcourse`
--
ALTER TABLE `addcourse`
  ADD CONSTRAINT `addcourse_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`),
  ADD CONSTRAINT `addcourse_ibfk_2` FOREIGN KEY (`cr_code`) REFERENCES `course` (`cr_code`),
  ADD CONSTRAINT `addcourse_ibfk_3` FOREIGN KEY (`dep`) REFERENCES `department` (`dep_code`);

--
-- Constraints for table `app_grade`
--
ALTER TABLE `app_grade`
  ADD CONSTRAINT `app_grade_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`),
  ADD CONSTRAINT `app_grade_ibfk_2` FOREIGN KEY (`cor_code`) REFERENCES `course` (`cr_code`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fac` FOREIGN KEY (`facality`) REFERENCES `faculty` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dropcourse`
--
ALTER TABLE `dropcourse`
  ADD CONSTRAINT `dropcourse_ibfk_1` FOREIGN KEY (`cor_code`) REFERENCES `course` (`cr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dropcourse_ibfk_2` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `course` FOREIGN KEY (`cr_code`) REFERENCES `course` (`cr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inst` FOREIGN KEY (`lecture`) REFERENCES `instructor` (`ins_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `studnet` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grade_submit`
--
ALTER TABLE `grade_submit`
  ADD CONSTRAINT `c` FOREIGN KEY (`cor_id`) REFERENCES `course` (`cr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grade_submit_ibfk_1` FOREIGN KEY (`lec_id`) REFERENCES `instructor` (`ins_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
