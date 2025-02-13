-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 07:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powerbi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id_dash` int(11) NOT NULL,
  `link` text NOT NULL,
  `dash_name` text DEFAULT NULL,
  `dash_title` text NOT NULL,
  `details` text NOT NULL,
  `fk_depart` varchar(100) NOT NULL,
  `fk_project_cod` varchar(30) NOT NULL,
  `dash_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id_dash`, `link`, `dash_name`, `dash_title`, `details`, `fk_depart`, `fk_project_cod`, `dash_status`) VALUES
(2, 'https://app.powerbi.com/view?r=eyJrIjoiM2VhMGEwZGQtMDMyNi00MjZjLWIxYTAtMmM2M2ZjZGZmMjgzIiwidCI6ImIzYTkwNjYzLWM1MTItNDlmMS04MDgwLTMyNmYwYTRiYTQzMCIsImMiOjl9', '1', 'achifment the project', 'z', '3', '1', 1),
(6, 'https://app.powerbi.com/view?r=eyJrIjoiZGE3MTllMWItZmQ3Ni00MzU5LWE1Y2ItYzYzNTc0YTY2ZTc1IiwidCI6ImIzYTkwNjYzLWM1MTItNDlmMS04MDgwLTMyNmYwYTRiYTQzMCIsImMiOjl9&embedImagePlaceholder=true', 'WASH Dashboard ', 'WASH Activities ', 'WASH Activities ', '4', '1', 1),
(7, 'https://app.powerbi.com/view?r=eyJrIjoiM2VhMGEwZGQtMDMyNi00MjZjLWIxYTAtMmM2M2ZjZGZmMjgzIiwidCI6ImIzYTkwNjYzLWM1MTItNDlmMS04MDgwLTMyNmYwYTRiYTQzMCIsImMiOjl9', 'Health', 'health achievement ', 'ffffff', '3', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dash_permission`
--

CREATE TABLE `dash_permission` (
  `id_u_d` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `fk_id_dash` int(11) NOT NULL,
  `user_dash_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dash_permission`
--

INSERT INTO `dash_permission` (`id_u_d`, `fk_id_user`, `fk_id_dash`, `user_dash_status`) VALUES
(1, 1, 2, 1),
(4, 10, 6, 1),
(5, 10, 2, 1),
(6, 1, 6, 0),
(7, 10, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `link` text NOT NULL,
  `file_name` text DEFAULT NULL,
  `file_title` text NOT NULL,
  `file_details` text DEFAULT NULL,
  `fk_depart` varchar(40) DEFAULT NULL,
  `fk_project_cod` varchar(40) DEFAULT NULL,
  `file_status` int(11) NOT NULL,
  `document_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `link`, `file_name`, `file_title`, `file_details`, `fk_depart`, `fk_project_cod`, `file_status`, `document_type`) VALUES
(1, 'CUsersOsamahPicturesScreenshots\\1.png', 'database', 'Form database', '.', '1', '1', 1, 'word'),
(3, 'e', 'we', '33', 'w', '1', '3', 1, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `files_type`
--

CREATE TABLE `files_type` (
  `id_file_type` int(11) NOT NULL,
  `name_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files_type`
--

INSERT INTO `files_type` (`id_file_type`, `name_type`) VALUES
(1, 'folder'),
(2, 'word'),
(3, 'pdf'),
(4, 'excel'),
(5, 'other'),
(7, 'image'),
(8, 'envelope');

-- --------------------------------------------------------

--
-- Table structure for table `file_permission`
--

CREATE TABLE `file_permission` (
  `id_u_f` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `fk_id_file` int(11) NOT NULL,
  `user_file_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_permission`
--

INSERT INTO `file_permission` (`id_u_f`, `fk_id_user`, `fk_id_file`, `user_file_status`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 1),
(3, 8, 1, 1),
(4, 8, 3, 1),
(5, 10, 3, 1),
(6, 10, 1, 1),
(7, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_table`
--

CREATE TABLE `jobs_table` (
  `job_id` int(11) NOT NULL,
  `type_job` varchar(100) NOT NULL,
  `job_name` varchar(100) NOT NULL,
  `job_details` text DEFAULT NULL,
  `job_note` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs_table`
--

INSERT INTO `jobs_table` (`job_id`, `type_job`, `job_name`, `job_details`, `job_note`, `status`) VALUES
(1, 'organization', 'Program Manager', NULL, '', 1),
(2, 'organization', 'Project Manager-H&N', NULL, '', 1),
(3, 'organization', 'Project Manager-wash ', NULL, '', 1),
(4, 'organization', 'Project Manager-protection ', NULL, '', 1),
(5, 'organization', 'Health Supervisor', NULL, '', 1),
(6, 'organization', 'Nutrition Supervisor', NULL, '', 1),
(7, 'organization', 'wash supervisor ', NULL, '', 1),
(8, 'organization', 'protection Supervisor', NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id_page` int(11) NOT NULL,
  `link` text NOT NULL,
  `name_page` varchar(100) NOT NULL,
  `icon_page` varchar(50) NOT NULL,
  `page_details` text DEFAULT NULL,
  `page_status` int(50) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id_page`, `link`, `name_page`, `icon_page`, `page_details`, `page_status`) VALUES
(1, 'mange_user.php', 'Mange User', 'user-plus', 'mang user ', 1),
(2, 'projects.php', 'Mange project', 'plus-square', 'c', 1),
(3, 'Dachboard_with_projects.php', 'Mange Dashboard', 'chart-pie', 'Mange Dashboard', 1),
(4, 'files.php', 'Mange Documents', 'folder', 'Mange Documents', 1),
(5, 'mange_permission.php', 'Mange Permission', 'lock', 'Mange Permission', 1),
(7, 'suggest_user.php', 'Suggest User', 'inbox', 'Suggest User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages_permission`
--

CREATE TABLE `pages_permission` (
  `id_u_p` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_page_id` int(11) NOT NULL,
  `user_pages_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages_permission`
--

INSERT INTO `pages_permission` (`id_u_p`, `fk_user_id`, `fk_page_id`, `user_pages_status`) VALUES
(1, 10, 1, 1),
(2, 1, 1, 1),
(3, 1, 5, 1),
(4, 1, 0, 1),
(5, 1, 2, 1),
(6, 1, 3, 1),
(7, 1, 4, 1),
(8, 1, 6, 1),
(9, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id_perm` int(11) NOT NULL,
  `name_permiss` varchar(200) NOT NULL,
  `perm_details` text DEFAULT NULL,
  `status_permi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id_perm`, `name_permiss`, `perm_details`, `status_permi`) VALUES
(1, 'Programmer', NULL, 1),
(2, 'Multi Sector', NULL, 1),
(3, 'Layer1', NULL, 1),
(4, 'Layer2', NULL, 1),
(10, 'No thing', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_cod` varchar(100) NOT NULL,
  `project_note` text DEFAULT NULL,
  `project_details` text DEFAULT NULL,
  `project_status` int(2) NOT NULL,
  `project_period` int(3) NOT NULL,
  `project_date_start` varchar(100) NOT NULL,
  `project_date_end` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_cod`, `project_note`, `project_details`, `project_status`, `project_period`, `project_date_start`, `project_date_end`) VALUES
(1, '35148', '', '.', 2, 11, '', ''),
(3, 'Public ', '', '.', 1, 0, '', ''),
(4, '35165', '', 'Multi sectore(health, nutraton, WASH, Protection)', 1, 10, '2024-01-01', '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `email_user` varchar(200) NOT NULL,
  `password_user` varchar(200) NOT NULL,
  `permissions_fk` int(11) NOT NULL DEFAULT 10,
  `img_user` text NOT NULL DEFAULT '1.png',
  `user_job` int(2) NOT NULL,
  `details_job` text DEFAULT NULL,
  `fk_id_user` int(11) NOT NULL DEFAULT 0,
  `user_note` text DEFAULT NULL,
  `department` int(2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `user_phone`, `email_user`, `password_user`, `permissions_fk`, `img_user`, `user_job`, `details_job`, `fk_id_user`, `user_note`, `department`, `status`) VALUES
(1, 'Osamah Abdul-Qader', '11212', 'data.health.ibb.yemen@intersos.org', '202cb962ac59075b964b07152d234b70', 1, '_1720426641.jpg', 1, '34', 0, 'qwq', 1, 1),
(8, 'Mohammed Shahrah', '773877918', 'ro.multi-sector.ibb.yemen@intersos.org', '9eb31610f5ddb63e5ee852569c1eff8b', 1, '1.png', 1, NULL, 0, '', 1, 1),
(9, 'Akram Alwajih', '774614152', 'data.wash.ibb.yemen@intersos.org', '202cb962ac59075b964b07152d234b70', 4, '1.png', 7, NULL, 0, '', 2, 1),
(10, 'Anas', '773877918', 'ibb.me.intersos@gmail.com', '202cb962ac59075b964b07152d234b70', 4, '1.png', 5, NULL, 0, '', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_department`
--

CREATE TABLE `user_department` (
  `depart_id` int(11) NOT NULL,
  `depart_name` varchar(100) NOT NULL,
  `depart_details` text NOT NULL,
  `depart_status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_department`
--

INSERT INTO `user_department` (`depart_id`, `depart_name`, `depart_details`, `depart_status`) VALUES
(1, 'Programmer', '', 1),
(2, 'Multi Sector', '', 1),
(3, 'Health & Nutrition ', '', 1),
(4, 'wash ', '', 1),
(5, 'protection ', 'protection ', 1),
(6, 'Health', '', 1),
(7, 'Nutrition', '', 1),
(8, 'Public', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id_dash`);

--
-- Indexes for table `dash_permission`
--
ALTER TABLE `dash_permission`
  ADD PRIMARY KEY (`id_u_d`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `files_type`
--
ALTER TABLE `files_type`
  ADD PRIMARY KEY (`id_file_type`);

--
-- Indexes for table `file_permission`
--
ALTER TABLE `file_permission`
  ADD PRIMARY KEY (`id_u_f`);

--
-- Indexes for table `jobs_table`
--
ALTER TABLE `jobs_table`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `pages_permission`
--
ALTER TABLE `pages_permission`
  ADD PRIMARY KEY (`id_u_p`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_perm`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_department`
--
ALTER TABLE `user_department`
  ADD PRIMARY KEY (`depart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id_dash` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dash_permission`
--
ALTER TABLE `dash_permission`
  MODIFY `id_u_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files_type`
--
ALTER TABLE `files_type`
  MODIFY `id_file_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `file_permission`
--
ALTER TABLE `file_permission`
  MODIFY `id_u_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs_table`
--
ALTER TABLE `jobs_table`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages_permission`
--
ALTER TABLE `pages_permission`
  MODIFY `id_u_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id_perm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_department`
--
ALTER TABLE `user_department`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
