-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 05:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `psw`) VALUES
('admin', '11');

-- --------------------------------------------------------

--
-- Table structure for table `amnt`
--

CREATE TABLE `amnt` (
  `id` int(11) NOT NULL,
  `reg` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mess_fees` decimal(10,2) NOT NULL,
  `electricity_charges` decimal(10,2) NOT NULL,
  `total_fees` decimal(10,2) NOT NULL,
  `month` varchar(50) NOT NULL,
  `last_date` date NOT NULL,
  `laction` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amnt`
--

INSERT INTO `amnt` (`id`, `reg`, `name`, `mess_fees`, `electricity_charges`, `total_fees`, `month`, `last_date`, `laction`, `year`) VALUES
(1, 'MSUNIV110', 'Yosuva Pravin', '3720.00', '210.00', '3930.00', 'January', '2024-02-10', 'paid', NULL),
(2, 'MSUNIV08', 'Loyola', '3720.00', '210.00', '3930.00', 'January', '2024-02-10', 'paid', NULL),
(3, 'MSUNIV110', 'Yosuva Pravin', '3480.00', '210.00', '3690.00', 'February', '2024-03-05', NULL, NULL),
(4, 'MSUNIV08', 'Loyola', '3480.00', '210.00', '3690.00', 'February', '2024-03-05', 'paid', NULL),
(5, 'MSUNIV234', 'Micheal Xavier A', '3480.00', '210.00', '3690.00', 'February', '2024-03-05', 'paid', NULL),
(6, 'MSUNIV', 'Karthikeyan', '3480.00', '210.00', '3690.00', 'February', '2024-03-05', NULL, NULL),
(75, 'MSUNIV110', 'Yosuva Pravin', '3000.00', '120.00', '3120.00', '2023-12', '2024-01-03', NULL, NULL),
(76, 'MSUNIV08', 'Loyola', '3720.00', '120.00', '3840.00', '2023-12', '2024-01-03', 'paid', NULL),
(77, 'MSUNIV234', 'Micheal Xavier A', '3720.00', '120.00', '3840.00', '2023-12', '2024-01-03', NULL, NULL),
(78, 'MSUNIV', 'Karthikeyan', '3720.00', '120.00', '3840.00', '2023-12', '2024-01-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hcheck`
--

CREATE TABLE `hcheck` (
  `id` varchar(20) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hcheck`
--

INSERT INTO `hcheck` (`id`, `reg`, `name`, `gender`, `dept`, `dist`, `address`, `status`) VALUES
('1', 'UG1902', 'vinoth', 'male', 'cs', 'trichy', 'trichy', '1'),
('2', 'UG1903', 'vinoth', 'male', 'cs', 'trichy', 'trichy', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` varchar(50) NOT NULL,
  `hname` varchar(50) NOT NULL,
  `nor` varchar(50) NOT NULL,
  `rm` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `hfor` varchar(50) NOT NULL,
  `hc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`id`, `hname`, `nor`, `rm`, `phone`, `hfor`, `hc`) VALUES
('1', 'Boys Hostel', '100', '1-100', '9988776611', 'boys', '300'),
('2', 'Rose', '100', '1-100', '9976322005', 'girls', '300'),
('3', 'Umayal', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapp`
--

CREATE TABLE `leaveapp` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course_year` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `leave_id` varchar(20) NOT NULL,
  `reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveapp`
--

INSERT INTO `leaveapp` (`id`, `ap_id`, `name`, `course_year`, `from_date`, `to_date`, `month`, `no_of_days`, `description`, `leave_id`, `reg`) VALUES
(1, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-03-21', '2024-03-23', NULL, 2, 'Going to home', 'LEAVEID001', ''),
(2, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-03-06', '2024-03-12', NULL, 6, 'h', 'LEAVEID012', ''),
(3, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-03-19', '2024-03-28', NULL, 9, 's', 'LEAVEID001', 'MSUNIV110'),
(4, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-02-08', '2024-02-14', NULL, 6, 'Going To Home for Festival.', 'LEAVEID001', 'MSUNIV110'),
(5, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2023-12-08', '2023-12-14', NULL, 6, 'Going To Home for Festival.', 'LEAVEID005', 'MSUNIV110'),
(6, 'STUD01', 'Karthikeyan', 'PhD', '2024-04-03', '2024-04-10', '', 7, 'Going to Home', 'LEAVEID001', 'MSUNIV');

-- --------------------------------------------------------

--
-- Table structure for table `leaverej`
--

CREATE TABLE `leaverej` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course_year` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `leave_id` varchar(20) NOT NULL,
  `reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaverej`
--

INSERT INTO `leaverej` (`id`, `ap_id`, `name`, `course_year`, `from_date`, `to_date`, `month`, `no_of_days`, `description`, `leave_id`, `reg`) VALUES
(1, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-03-29', '2024-03-30', NULL, 1, 'work', 'LEAVEID010', ''),
(2, '', '', '', '0000-00-00', '0000-00-00', NULL, 0, '', '', ''),
(3, 'STUD01', 'Yosuva Pravin', 'MSc-1', '2024-03-26', '2024-03-29', NULL, 3, 'SOME REASONS', 'LEAVEID001', ''),
(4, 'STUD15', 'Loyola', 'BSC-1', '2024-04-03', '2024-04-06', NULL, 3, 'as', 'LEAVEID001', 'MSUNIV08'),
(5, 'STUD15', 'Loyola', 'BSC-1', '2024-04-03', '2024-04-06', NULL, 3, 'as', 'LEAVEID016', 'MSUNIV08'),
(6, 'STUD15', 'Loyola', 'BSC-1', '2024-04-04', '2024-04-05', NULL, 1, 'as', 'LEAVEID017', 'MSUNIV08'),
(7, 'STUD15', 'Loyola', 'BSC-1', '2024-04-04', '2024-04-05', NULL, 1, 'as', 'LEAVEID018', 'MSUNIV08');

-- --------------------------------------------------------

--
-- Table structure for table `leavereq`
--

CREATE TABLE `leavereq` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course_year` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `leave_id` varchar(20) NOT NULL,
  `reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_published` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_id`, `title`, `content`, `date_published`) VALUES
(3, 'NEWSID001', 'Meeting', 'Assemple meeting hall all the students.', '2024-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `paid`
--

CREATE TABLE `paid` (
  `id` varchar(20) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paid`
--

INSERT INTO `paid` (`id`, `reg`, `total`, `date`, `month`) VALUES
('1', 'UG1901', '2500', '19-10-04', 'October'),
('2', 'UG1901', '2500', '19-10-04', 'September'),
('4', 'UG1902', '2700', '19-11-01', 'December'),
('5', 'UG1901', '2500', '19-11-08', 'September'),
('6', 'UG1901', '', '24-02-04', ''),
('7', 'MSUNIV110', '', '24-03-16', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `floor` varchar(10) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `no_of_students` int(11) DEFAULT NULL,
  `staying_students` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `floor`, `room`, `no_of_students`, `staying_students`) VALUES
(1, 'G', 'G-1', 4, 4),
(2, 'F', 'F-1', 4, 4),
(3, 'G', 'G-2', 4, 4),
(4, 'G', 'G-3', 4, 4),
(5, 'G', 'G-4', 4, 4),
(6, 'G', 'G-5', 4, 4),
(7, 'G', 'G-6', 4, 4),
(8, 'F', 'F-3', 4, 0),
(9, 'F', 'F-2', 4, 1),
(10, 'S', 'S-1', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

CREATE TABLE `stud` (
  `id` int(11) NOT NULL,
  `stud_id` varchar(20) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `reg` varchar(20) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `year` varchar(20) NOT NULL,
  `fathname` varchar(50) NOT NULL,
  `fathphone` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `bldgrp` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`id`, `stud_id`, `name`, `reg`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`) VALUES
(1, 'stud001', 'Loyola', 'UG1901', 'Mca', '2nd PG', 'Peeter', '9093229074', 21, '2001-06-05', 'O +ve', 'loyola@gmail.com', '9976322002', '40/4, Rasipuram, Namakkal', ''),
(2, 'stud002', 'john', 'UG1902', 'Mca', '1st PG', 'Josh', '9023234546', 22, '2001-06-19', 'B -ve', 'john@gmail.com', '9976322008', '30/4, Vennandur, Namakkal', ''),
(10, 'stud010', 'Alwin', 'UG1903', 'Mca', '2nd PG', 'Jams', '9023453454', 22, '1999-10-20', 'B -ve', 'alwin@gmail.com', '9092873343', '32/4, Vennandur,Namakkal', ''),
(11, 'stud011', 'kavin', 'UG1904', 'MBA', '2nd PG', 'Ravi', '9372837587', 21, '2001-06-05', 'O -ve', 'kavin@gmail.com', '9092873343', '34/4, Salem', 'face4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `studapp`
--

CREATE TABLE `studapp` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(10) NOT NULL,
  `stud_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `programme` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `fathname` varchar(255) NOT NULL,
  `fathphone` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `bldgrp` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `request_letter` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `physically_challenged` enum('Yes','No') NOT NULL,
  `room_no` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studapp`
--

INSERT INTO `studapp` (`id`, `ap_id`, `stud_id`, `name`, `reg`, `programme`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`, `request_letter`, `reg_date`, `physically_challenged`, `room_no`) VALUES
(11, 'MSUAPP019', 'STUD19', 'Gopi', 'MSUNI342', 'PG', 'Management Studies', 'MBA-1', 'raj', '8765432356', 22, '2002-05-17', 'O+', 'armxavier1@gmail.com', '983436543', 'Chennai', 'admin_dashboard.jpeg', '20224012404125.pdf', '2024-03-17 10:20:32', 'Yes', 'G-6'),
(12, 'MSUAPP020', 'STUD20', 'Kannan', 'MSUNI876', 'Integrate', 'Mathemetics', 'MSc(Maths) -1', 'Ravi', '9765932351', 22, '2004-07-05', 'B+', 'armxavier1@gmail.com', '983436543', 'Salem', 'WhatsApp Image 2024-02-07 at 9.00.24 AM.jpeg', '20224012404125.pdf', '2024-03-17 10:25:35', 'Yes', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `studapp_view`
-- (See below for the actual view)
--
CREATE TABLE `studapp_view` (
`ap_id` varchar(10)
,`stud_id` varchar(10)
,`name` varchar(255)
,`year` varchar(50)
,`physically_challenged` enum('Yes','No')
);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(50) DEFAULT NULL,
  `stud_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `reg` varchar(50) DEFAULT NULL,
  `programme` varchar(100) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `fathname` varchar(100) DEFAULT NULL,
  `fathphone` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bldgrp` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `request_letter` text DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `physically_challenged` varchar(3) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `ap_id`, `stud_id`, `name`, `reg`, `programme`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`, `request_letter`, `reg_date`, `physically_challenged`, `room_no`) VALUES
(3, 'MSUAPP001', 'STUD01', 'Yosuva Pravin', 'MSUNIV110', 'PG', 'COMMERCE', 'MSc-1', 'Peter', '6274563412', 21, '2001-01-11', 'A+', 'armxavier1@gmail.com', '9344627791', 'Rameswaram', 'download.jpg', '20224012404125.pdf', '2024-03-16', 'Yes', 'G-6'),
(4, 'MSUAPP015', 'STUD15', 'Loyola', 'MSUNIV08', 'UG', 'COMMERCE', 'BSC-1', 'Peter', '7639580912', 20, '2004-01-05', 'AB-', 'armxavier1@gmail.com', '9344627781', 'Sankanrankovil', 'download.jpg', '20224012404125.pdf', '2024-03-16', 'No', 'S-1'),
(5, 'MSUAPP001', 'STUD01', 'Micheal Xavier A', 'MSUNIV234', 'PG', 'CSE', 'MCA-1', 'K. Antonysamy', '9788675432', 23, '2001-10-13', 'A+', 'armxavier1@gmail.com', '9867543423', 'Tenkasi', 'download.jpg', '20224012404125.pdf', '2024-03-17', 'No', 'F-2'),
(7, 'MSUAPP001', 'STUD01', 'Karthikeyan', 'MSUNIV', 'Research Scholar', '123', 'PhD', 'Sailappan', '9342567892', 23, '2000-01-17', 'B-', 'francislourdu52@gmail.com', '7667543423', 'Ambur', 'Photograph.jpg', '20224012404125.pdf', '2024-03-17', 'No', 'F-2');

-- --------------------------------------------------------

--
-- Table structure for table `studrej`
--

CREATE TABLE `studrej` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(10) NOT NULL,
  `stud_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `programme` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `fathname` varchar(255) NOT NULL,
  `fathphone` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `bldgrp` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `request_letter` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `physically_challenged` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studrej`
--

INSERT INTO `studrej` (`id`, `ap_id`, `stud_id`, `name`, `reg`, `programme`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`, `request_letter`, `reg_date`, `physically_challenged`) VALUES
(1, 'MSUAPP001', 'MSHostel00', 'S.Karthikeyan', 'PGMCA32', 'PG', 'CSE', 'BCA-1', 'K. Antonysamy', '9344627781', 22, '2001-05-07', 'A-', 'armxavier1@gmail.com', '9344627781', 'Ambur', 'download.jpg', '20224012404125.pdf', '2024-03-14 17:45:22', ''),
(2, '', 'STUD01', 'K. Karuppasamy', 'PGMCA32', 'PG', 'CSE', 'MCA-1', 'K. Antonysamy', '9344627781', 22, '2003-05-05', 'A-', 'armxavier1@gmail.com', '9344627781', 'Vannarpettai, Tirunelveli', 'download.jpg', '20224012404125.pdf', '2024-03-14 18:14:40', 'No'),
(3, 'MSUAPP001', 'STUD01', 'AJAY', 'PGMCA23', 'PG', 'CSE', 'MCA-1', 'raj', '9839580912', 22, '2001-02-05', 'B+', 'armxavier1@gmail.com', '9344627781', 'Vannarpettai, Tirunelveli', 'download.jpg', '20224012404125.pdf', '2024-03-14 18:25:06', 'No'),
(4, 'MSUAPP011', 'STUD11', 'Velu', 'IMCom34', 'Integrate', 'COMMERCE', 'MCom-1', 'raj', '+919344627', 20, '2003-10-14', 'B+', 'armxavier1@gmail.com', '9344627781', 'Vannarpettai, Tirunelveli', 'Photograph.jpg', '20224012404125.pdf', '2024-03-14 18:52:06', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `studreq`
--

CREATE TABLE `studreq` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(10) NOT NULL,
  `stud_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `programme` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `fathname` varchar(255) NOT NULL,
  `fathphone` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `bldgrp` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `request_letter` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `physically_challenged` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studreq`
--

INSERT INTO `studreq` (`id`, `ap_id`, `stud_id`, `name`, `reg`, `programme`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`, `request_letter`, `reg_date`, `physically_challenged`) VALUES
(21, 'MSUAPP001', 'STUD01', 'E. Suba Selvam', 'MSUNIV987', 'PG', 'CSE', 'MCA-II', 'Esakkidurai', '8765453212', 23, '2000-08-29', 'O+', 'armxavier1@gmail.com', '9344627781', 'Vannarpettai, Tirunelveli', 'download.jpg', '20224012404125.pdf', '2024-03-19 09:11:35', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `studs`
--

CREATE TABLE `studs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reg` varchar(10) NOT NULL,
  `dept` varchar(10) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `fathname` varchar(20) DEFAULT NULL,
  `fathphone` varchar(15) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bldgrp` varchar(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studvacated`
--

CREATE TABLE `studvacated` (
  `id` int(11) NOT NULL,
  `ap_id` varchar(50) DEFAULT NULL,
  `stud_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `reg` varchar(50) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `fathname` varchar(100) DEFAULT NULL,
  `fathphone` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bldgrp` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `request_letter` text DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `physically_challenged` varchar(3) DEFAULT NULL,
  `programme` varchar(100) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studvacated`
--

INSERT INTO `studvacated` (`id`, `ap_id`, `stud_id`, `name`, `reg`, `dept`, `year`, `fathname`, `fathphone`, `age`, `dob`, `bldgrp`, `email`, `phone`, `address`, `image`, `request_letter`, `reg_date`, `physically_challenged`, `programme`, `room_no`) VALUES
(1, 'MSUAPP013', 'STUD13', 'Kambar', 'MSUNIV03', 'COMMERCE', 'Mcom-1', 'raj', '7639580912', 20, '2005-05-09', 'B-', 'armxavier1@gmail.com', '9344627781', 'Tenkasi', 'download.jpg', '20224012404125.pdf', '2024-03-15', 'No', 'Integrate', 'S-1'),
(2, 'MSUAPP001', 'STUD01', 'Karthikeyan', 'MSUNIV', '123', 'PhD', 'Sailappan', '9342567892', 23, '2000-01-17', 'B-', 'francislourdu52@gmail.com', '7667543423', 'Ambur', 'Photograph.jpg', '20224012404125.pdf', '2024-03-17', 'No', 'Research Scholar', 'F-2');

-- --------------------------------------------------------

--
-- Table structure for table `suggest`
--

CREATE TABLE `suggest` (
  `id` varchar(20) NOT NULL,
  `reg` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sub` varchar(50) NOT NULL,
  `cmpl` varchar(250) NOT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suggest`
--

INSERT INTO `suggest` (`id`, `reg`, `name`, `sub`, `cmpl`, `status`) VALUES
('', 'MSUNIV', 'Karthikeyan', 'Room Light Maintenance Request', 'I would like to file a complaint regarding the room light, as it needs attention.', 'pending');

-- --------------------------------------------------------

--
-- Structure for view `studapp_view`
--
DROP TABLE IF EXISTS `studapp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studapp_view`  AS SELECT `studapp`.`ap_id` AS `ap_id`, `studapp`.`stud_id` AS `stud_id`, `studapp`.`name` AS `name`, `studapp`.`year` AS `year`, `studapp`.`physically_challenged` AS `physically_challenged` FROM `studapp``studapp`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amnt`
--
ALTER TABLE `amnt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaveapp`
--
ALTER TABLE `leaveapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaverej`
--
ALTER TABLE `leaverej`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavereq`
--
ALTER TABLE `leavereq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room` (`room`);

--
-- Indexes for table `stud`
--
ALTER TABLE `stud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studapp`
--
ALTER TABLE `studapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studrej`
--
ALTER TABLE `studrej`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studreq`
--
ALTER TABLE `studreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studs`
--
ALTER TABLE `studs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studvacated`
--
ALTER TABLE `studvacated`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amnt`
--
ALTER TABLE `amnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `leaveapp`
--
ALTER TABLE `leaveapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leaverej`
--
ALTER TABLE `leaverej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leavereq`
--
ALTER TABLE `leavereq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studapp`
--
ALTER TABLE `studapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `studrej`
--
ALTER TABLE `studrej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studreq`
--
ALTER TABLE `studreq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `studvacated`
--
ALTER TABLE `studvacated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
