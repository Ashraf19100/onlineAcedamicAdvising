-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2024 at 01:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advising`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_courses`
--

CREATE TABLE `add_courses` (
  `id` int NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `sunday` varchar(50) DEFAULT NULL,
  `monday` varchar(50) DEFAULT NULL,
  `tuesday` varchar(50) DEFAULT NULL,
  `wednesday` varchar(50) DEFAULT NULL,
  `thursday` varchar(50) DEFAULT NULL,
  `section` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_courses`
--

INSERT INTO `add_courses` (`id`, `course_code`, `course_title`, `student_id`, `semester`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `section`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSE111', 'fundamental programming', '191001412', 'sprin19', '18:30', '04:08', '', '', '', 1, 0, '2024-10-27 19:08:41', '2024-11-05 13:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'if 1 then active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2024-10-27 14:24:30', '2024-10-27 14:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `completed_courses`
--

CREATE TABLE `completed_courses` (
  `id` int NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `result` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `status` enum('passed','fail') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `prerequest_course_cousre_code` varchar(100) DEFAULT NULL,
  `credit` int NOT NULL,
  `type` enum('non-programed','programed') NOT NULL,
  `department` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_title`, `prerequest_course_cousre_code`, `credit`, `type`, `department`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CSE111', 'fundamental programming', '', 3, '', 'CSE', 1, '2024-10-27 18:50:58', '2024-10-27 18:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `course_offered_bysemester`
--

CREATE TABLE `course_offered_bysemester` (
  `id` int NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `prerequest_course_cousre_code` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `admissioned_semester` varchar(100) NOT NULL,
  `present_semester` varchar(100) NOT NULL,
  `section` int NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `credit` int NOT NULL,
  `type` enum('non-programed','programed') NOT NULL,
  `limited_seat` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_offered_bysemester`
--

INSERT INTO `course_offered_bysemester` (`id`, `course_code`, `course_title`, `prerequest_course_cousre_code`, `department`, `admissioned_semester`, `present_semester`, `section`, `instructor_name`, `credit`, `type`, `limited_seat`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CSE111', 'fundamental programming', '', 'CSE', 'spring19', 'sprin19', 2, 'Ashraf', 3, '', 20, 1, '2024-10-27 18:52:01', '2024-10-27 18:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `id` int NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `section` tinyint NOT NULL,
  `present_semester` varchar(50) DEFAULT NULL,
  `sunday` varchar(50) DEFAULT NULL,
  `monday` varchar(50) DEFAULT NULL,
  `tuesday` varchar(50) DEFAULT NULL,
  `wednesday` varchar(50) DEFAULT NULL,
  `thursday` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`id`, `course_code`, `section`, `present_semester`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `created_at`, `updated_at`) VALUES
(1, 'CSE111', 1, 'sprin19', '18:30', '04:08', '', '', '', '2024-10-27 19:07:27', '2024-10-27 19:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int NOT NULL,
  `semester_name` varchar(250) NOT NULL,
  `year` varchar(250) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `year`, `created_time`) VALUES
(1, 'sprin19', '2019', '2024-10-27 14:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admissioned_semester` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `student_email`, `department`, `student_name`, `phone_number`, `password`, `admissioned_semester`, `active`, `created_at`, `updated_at`) VALUES
(1, '191001412', '191001412@eastdelta.edu.bd', 'CSE', 'Md Ashraful islam chowdhury ', '01834815169', '827ccb0eea8a706c4c34a16891f84e7b', 'sprin19', 1, '2024-10-27 17:46:13', '2024-10-27 17:46:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_courses`
--
ALTER TABLE `add_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_title` (`course_title`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `completed_courses`
--
ALTER TABLE `completed_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_title` (`course_title`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_title` (`course_title`);

--
-- Indexes for table `course_offered_bysemester`
--
ALTER TABLE `course_offered_bysemester`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_title` (`course_title`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_courses`
--
ALTER TABLE `add_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `completed_courses`
--
ALTER TABLE `completed_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_offered_bysemester`
--
ALTER TABLE `course_offered_bysemester`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
