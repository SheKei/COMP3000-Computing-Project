-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Nov 19, 2020 at 10:07 PM
-- Server version: 8.0.21
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp3000_stong`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `module_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int NOT NULL,
  `task_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `task_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Ongoing',
  `task_category` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` date DEFAULT NULL,
  `due_time` time DEFAULT NULL,
  `priority_level` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`user_id`, `module_code`, `task_id`, `task_name`, `task_status`, `task_category`, `due_date`, `due_time`, `priority_level`) VALUES
('dummy', 'COMP3000', 2, 'Requirements Gathering', 'Ongoing', 'General', '2020-11-13', '17:30:00', 'High'),
('dummy', 'COMP3000', 3, 'Acceptance Criteria ', 'Ongoing', 'General', '9999-12-30', '00:00:00', 'Medium'),
('dummy', 'COMP3000', 4, 'sad', 'Ongoing', 'Coursework', '2020-11-27', '19:19:00', 'Medium'),
('dummy', 'COMP3000', 5, 'Requirements Gathering Bonus', 'Ongoing', 'General', '9999-12-30', '00:00:00', 'Low'),
('dummy', 'COMP3000', 6, 'Revise Task', 'Ongoing', 'Revision', '9999-12-30', '00:00:00', 'Medium');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `FK_module_user` (`user_id`,`module_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_module_user` FOREIGN KEY (`user_id`,`module_code`) REFERENCES `module` (`user_id`, `module_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
