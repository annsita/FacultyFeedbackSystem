-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2022 at 10:11 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(2, 'Computer science'),
(3, 'Electronics & Communication');

-- --------------------------------------------------------

--
-- Table structure for table `designaton`
--

DROP TABLE IF EXISTS `designaton`;
CREATE TABLE IF NOT EXISTS `designaton` (
  `desig_id` int NOT NULL AUTO_INCREMENT,
  `desig_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`desig_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designaton`
--

INSERT INTO `designaton` (`desig_id`, `desig_name`) VALUES
(2, 'Professor'),
(3, 'Lab Staff');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `f_isactive` int NOT NULL,
  `f_grade` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desig_id` int NOT NULL,
  `dept_id` int NOT NULL,
  PRIMARY KEY (`faculty_id`),
  KEY `faculty_ibfk_1` (`dept_id`),
  KEY `desig_id` (`desig_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `f_name`, `f_email`, `f_gender`, `f_photo`, `f_username`, `f_password`, `f_isactive`, `f_grade`, `desig_id`, `dept_id`) VALUES
(7, 'AiswaryaHOD', 'aisu@gmail.com', 'Female', 'uploads/20220223193153.jfif', 'aisu', 'aisu123', 1, '0', 2, 2),
(8, 'JohnHOD', 'John@gmail.com', 'Male', 'uploads/20220223193031.jpg', 'john', 'john123', 1, '0', 2, 3),
(9, 'George', 'george@gmail.com', 'Male', 'uploads/20220223192828.jpg', 'george', 'george123', 1, '0', 3, 3),
(12, 'Reba John', 'reba@gmail.com', 'Female', 'uploads/20220223192724.jfif', 'reba', 'reba1234', 1, '0', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `Feed_id` int NOT NULL AUTO_INCREMENT,
  `d_id` int NOT NULL,
  `Message` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Reply` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_id` int NOT NULL,
  PRIMARY KEY (`Feed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feed_id`, `d_id`, `Message`, `Reply`, `u_id`) VALUES
(1, 3, 'We need a quick meeting to discuss about exams', 'Ok, we can plan it as soon as possible', 12),
(2, 3, 'Should conduct meetings more often', 'HOD is not replied yet', 9);

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

DROP TABLE IF EXISTS `hod`;
CREATE TABLE IF NOT EXISTS `hod` (
  `hod_id` int NOT NULL AUTO_INCREMENT,
  `f_id` int NOT NULL,
  `dept_id` int NOT NULL,
  PRIMARY KEY (`hod_id`),
  KEY `hod_ibfk_1` (`f_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`hod_id`, `f_id`, `dept_id`) VALUES
(1, 7, 2),
(2, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Uid` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `utype` varchar(10) NOT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Uid`, `uname`, `pwd`, `utype`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int NOT NULL AUTO_INCREMENT,
  `fac_id` int NOT NULL,
  `stud_id` int NOT NULL,
  `mark` int NOT NULL,
  PRIMARY KEY (`mark_id`),
  KEY `mark_ibfk_1` (`fac_id`),
  KEY `stud_id` (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`mark_id`, `fac_id`, `stud_id`, `mark`) VALUES
(42, 12, 6, 87),
(43, 12, 12, 80);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int NOT NULL AUTO_INCREMENT,
  `option_data` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qn_id` int NOT NULL,
  `option_mark` int NOT NULL,
  PRIMARY KEY (`option_id`),
  KEY `options_ibfk_1` (`qn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_data`, `qn_id`, `option_mark`) VALUES
(1, 'Excellent', 2, 8),
(2, 'Fair', 3, 13),
(3, 'Good', 3, 16),
(4, 'Excellent', 3, 18),
(5, 'Poor', 4, 10),
(6, 'Fair', 4, 13),
(7, 'Good', 4, 16),
(8, 'Excellent', 4, 18),
(9, 'Poor', 3, 10),
(10, 'Good', 2, 6),
(11, 'Fair', 2, 3),
(12, 'Poor', 2, 1),
(13, 'Excellent', 5, 8),
(14, 'Good', 5, 6),
(15, 'Fair', 5, 3),
(16, 'Poor', 5, 1),
(17, 'Excellent', 6, 8),
(18, 'Good', 6, 6),
(19, 'Fair', 6, 3),
(20, 'Poor', 6, 1),
(21, 'Excellent', 7, 8),
(22, 'Good', 7, 6),
(23, 'Fair', 7, 3),
(24, 'Poor', 7, 1),
(25, 'Excellent', 8, 8),
(26, 'Good', 8, 6),
(27, 'Fair', 8, 3),
(28, 'Poor', 8, 1),
(29, 'Excellent', 9, 8),
(30, 'Good', 9, 6),
(31, 'Fair', 9, 3),
(32, 'Poor', 9, 1),
(33, 'Excellent', 10, 8),
(34, 'Good', 10, 6),
(35, 'Fair', 10, 3),
(36, 'Poor', 10, 1),
(37, 'Excellent', 11, 8),
(38, 'Good', 11, 6),
(39, 'Fair', 11, 3),
(40, 'Poor', 11, 1),
(41, 'Excellent', 13, 18),
(42, 'Good', 13, 16),
(43, 'Fair', 13, 13),
(44, 'Poor', 13, 10),
(45, 'Excellent', 14, 18),
(46, 'Good', 14, 16),
(47, 'Fair', 14, 13),
(48, 'Poor', 14, 10),
(49, 'Excellent', 12, 8),
(50, 'Good', 12, 6),
(51, 'Fair', 12, 3),
(52, 'Poor', 12, 1),
(53, 'Excellent', 15, 8),
(54, 'Good', 15, 6),
(55, 'Fair', 15, 3),
(56, 'Poor', 15, 1),
(57, 'Excellent', 16, 8),
(58, 'Good', 16, 6),
(59, 'Fair', 16, 3),
(60, 'Poor', 16, 1),
(61, 'Excellent', 17, 8),
(62, 'Good', 17, 6),
(63, 'Fair', 17, 3),
(64, 'Poor', 17, 1),
(65, 'Excellent', 18, 8),
(66, 'Good', 18, 6),
(67, 'Fair', 18, 3),
(68, 'Poor', 18, 1),
(69, 'Excellent', 19, 8),
(70, 'Good', 19, 6),
(71, 'Fair', 19, 3),
(72, 'Poor', 19, 1),
(73, 'Excellent', 20, 8),
(74, 'Good', 20, 6),
(75, 'Fair', 20, 3),
(76, 'Poor', 20, 1),
(77, 'Excellent', 21, 8),
(78, 'Good', 21, 6),
(79, 'Fair', 21, 3),
(80, 'Poor', 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questionaire`
--

DROP TABLE IF EXISTS `questionaire`;
CREATE TABLE IF NOT EXISTS `questionaire` (
  `qnr_id` int NOT NULL AUTO_INCREMENT,
  `qnr_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desig_id` int NOT NULL,
  `qntype_id` int NOT NULL,
  PRIMARY KEY (`qnr_id`),
  KEY `questionaire_ibfk_1` (`qntype_id`),
  KEY `desig_id` (`desig_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questionaire`
--

INSERT INTO `questionaire` (`qnr_id`, `qnr_name`, `desig_id`, `qntype_id`) VALUES
(1, 'Q11', 2, 1),
(2, 'Q22', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questionairetype`
--

DROP TABLE IF EXISTS `questionairetype`;
CREATE TABLE IF NOT EXISTS `questionairetype` (
  `qnrtype_id` int NOT NULL AUTO_INCREMENT,
  `qnrtype_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qnrtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `qn_id` int NOT NULL AUTO_INCREMENT,
  `qnr_id` int NOT NULL,
  `qntype_id` int NOT NULL,
  `qn_data` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qn_id`),
  KEY `questions_ibfk_1` (`qnr_id`),
  KEY `qntype_id` (`qntype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qn_id`, `qnr_id`, `qntype_id`, `qn_data`) VALUES
(2, 1, 1, 'The teacher is willing to help?'),
(3, 1, 1, 'The teacher takes clearly understandable classes?'),
(4, 1, 1, 'The teacher has a good knowledge of the subject?'),
(5, 1, 1, 'The teacher is punctual in class?'),
(6, 1, 1, 'The teacher provides notes and explanations regularly?'),
(7, 1, 1, 'The teacher organizes classes well?'),
(8, 1, 1, 'The teacher has the right speed of presentation?'),
(9, 1, 1, 'The teacher encourages questions?'),
(10, 1, 1, 'The sincerity of the teacher?'),
(11, 1, 1, 'The teacher is kind and courteous?'),
(12, 2, 1, 'The teacher is helpful in lab?'),
(13, 2, 1, 'Maintenance of the lab?'),
(14, 2, 1, 'The teacher has a good technical knowledge?'),
(15, 2, 1, 'The teacher is punctual in lab?'),
(16, 2, 1, 'Regular monitoring of attendance?'),
(17, 2, 1, 'The teacher ensures discipline in lab?'),
(18, 2, 1, 'The teacher ensures that all the safety precautions in the lab are taken?'),
(19, 2, 1, 'The sincerity of the teacher?'),
(20, 2, 1, 'The teacher is kind and courteous?'),
(21, 2, 1, 'The overall effectiveness in lab?');

-- --------------------------------------------------------

--
-- Table structure for table `questiontype`
--

DROP TABLE IF EXISTS `questiontype`;
CREATE TABLE IF NOT EXISTS `questiontype` (
  `qntype_id` int NOT NULL AUTO_INCREMENT,
  `qntype_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qntype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questiontype`
--

INSERT INTO `questiontype` (`qntype_id`, `qntype_name`) VALUES
(1, 'Objective'),
(4, 'Descriptive');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `res_id` int NOT NULL AUTO_INCREMENT,
  `f_id` int NOT NULL,
  `res_grade` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `result_ibfk_1` (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`res_id`, `f_id`, `res_grade`) VALUES
(40, 12, '83.5');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `student_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_contact` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_regno` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_dob` date NOT NULL,
  `student_isactive` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_ibfk_1` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_contact`, `student_email`, `student_gender`, `student_photo`, `student_regno`, `student_dob`, `student_isactive`, `dept_id`, `username`, `password`) VALUES
(6, 'Praveen Thappily', '+917012270499', 'student@gmail.com', 'Male', 'uploads/20220129160804.png', 'P88900', '2022-01-12', 'Yes', 3, 'student', 'student'),
(10, 'Sid Ram', '+917012270499', 'sid.official@gmail.com', 'Male', 'uploads/20220223193412.jfif', 'P88900', '2004-07-23', 'Yes', 2, 'sid', 'sid12345'),
(11, 'Ann John', '9496439725', 'ansitathomas2016@gmail.com', 'Female', 'uploads/20220223193902.jfif', 'M20CA017', '2002-07-20', 'Yes', 3, 'ann', 'ann12345'),
(12, 'Asha Thomas', '8592435745', 'asha123@gmail.com', 'Female', 'uploads/20220224065005.jfif', 'Vnarsmt54', '2002-08-22', 'Yes', 3, 'asha', 'asha1234');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `f_id` int NOT NULL,
  `q_id` int NOT NULL,
  `excellent` int NOT NULL,
  `good` int NOT NULL,
  `fair` int NOT NULL,
  `poor` int NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `f_id`, `q_id`, `excellent`, `good`, `fair`, `poor`) VALUES
(115, 12, 2, 1, 0, 0, 0),
(116, 12, 3, 0, 0, 1, 0),
(117, 12, 4, 0, 0, 0, 1),
(118, 12, 5, 1, 0, 0, 0),
(119, 12, 6, 1, 0, 0, 0),
(120, 12, 7, 1, 0, 0, 0),
(121, 12, 8, 1, 0, 0, 0),
(122, 12, 9, 1, 0, 0, 0),
(123, 12, 10, 1, 0, 0, 0),
(124, 12, 11, 1, 0, 0, 0),
(125, 12, 2, 0, 0, 0, 1),
(126, 12, 3, 0, 0, 1, 0),
(127, 12, 4, 0, 0, 0, 1),
(128, 12, 5, 1, 0, 0, 0),
(129, 12, 6, 1, 0, 0, 0),
(130, 12, 7, 1, 0, 0, 0),
(131, 12, 8, 1, 0, 0, 0),
(132, 12, 9, 1, 0, 0, 0),
(133, 12, 10, 1, 0, 0, 0),
(134, 12, 11, 1, 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `faculty_ibfk_2` FOREIGN KEY (`desig_id`) REFERENCES `designaton` (`desig_id`);

--
-- Constraints for table `hod`
--
ALTER TABLE `hod`
  ADD CONSTRAINT `hod_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `hod_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`qn_id`) REFERENCES `questions` (`qn_id`);

--
-- Constraints for table `questionaire`
--
ALTER TABLE `questionaire`
  ADD CONSTRAINT `questionaire_ibfk_1` FOREIGN KEY (`qntype_id`) REFERENCES `questiontype` (`qntype_id`),
  ADD CONSTRAINT `questionaire_ibfk_2` FOREIGN KEY (`desig_id`) REFERENCES `designaton` (`desig_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`qnr_id`) REFERENCES `questionaire` (`qnr_id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`qntype_id`) REFERENCES `questiontype` (`qntype_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
