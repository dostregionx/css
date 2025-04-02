-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcssv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_03_17_023408_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cxeAnMRfIpp0DcBs5aB5t2Jz7v968hKMv9libRHn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGJUWVdXZzd0WTNOOVFIMDZab243R1hucFpqZHlvQkRsRG42VUpzZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvc2VtZXN0ZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1743144774);

-- --------------------------------------------------------

--
-- Table structure for table `tblagegroup`
--

CREATE TABLE `tblagegroup` (
  `agegroupid` int(11) NOT NULL,
  `agegroup` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblagegroup`
--

INSERT INTO `tblagegroup` (`agegroupid`, `agegroup`) VALUES
(1, '19 or lower	'),
(2, '20-34'),
(3, '35-49'),
(4, '50-64'),
(5, '65 or higher');

-- --------------------------------------------------------

--
-- Table structure for table `tblclienttype`
--

CREATE TABLE `tblclienttype` (
  `clienttypeid` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclienttype`
--

INSERT INTO `tblclienttype` (`clienttypeid`, `name`) VALUES
(1, 'Citizen'),
(2, 'Business'),
(3, 'Government (Employees or another agency)'),
(4, 'Students, Faculty/Researchers');

-- --------------------------------------------------------

--
-- Table structure for table `tblcss_details_cc`
--

CREATE TABLE `tblcss_details_cc` (
  `cssdetailsccid` int(11) NOT NULL,
  `csssummaryid` int(11) DEFAULT NULL,
  `cc1` int(11) DEFAULT NULL,
  `cc2` int(11) DEFAULT NULL,
  `cc3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcss_details_cc`
--

INSERT INTO `tblcss_details_cc` (`cssdetailsccid`, `csssummaryid`, `cc1`, `cc2`, `cc3`) VALUES
(1575, 1587, 4, 4, 3),
(1576, 1588, 4, 4, 3),
(1577, 1589, 4, 4, 3),
(1578, 1590, 4, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblcss_details_sqd`
--

CREATE TABLE `tblcss_details_sqd` (
  `cssdetailssqd` int(11) NOT NULL,
  `csssummaryid` int(11) DEFAULT NULL,
  `sqd0` int(11) DEFAULT NULL,
  `sqd1` int(11) DEFAULT NULL,
  `sqd2` int(11) DEFAULT NULL,
  `sqd3` int(11) DEFAULT NULL,
  `sqd4` int(11) DEFAULT NULL,
  `sqd5` int(11) DEFAULT NULL,
  `sqd6` int(11) DEFAULT NULL,
  `sqd7` int(11) DEFAULT NULL,
  `sqd8` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `suggestions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcss_details_sqd`
--

INSERT INTO `tblcss_details_sqd` (`cssdetailssqd`, `csssummaryid`, `sqd0`, `sqd1`, `sqd2`, `sqd3`, `sqd4`, `sqd5`, `sqd6`, `sqd7`, `sqd8`, `email`, `suggestions`) VALUES
(1570, 1587, 5, 5, 5, 5, 3, 5, 2, 2, 3, 'jordan@email.com', 'Test Suggestions'),
(1571, 1588, 5, 3, 5, 3, 5, 5, 3, 5, 1, 'maxv@f1.com', 'Inchedent'),
(1572, 1589, 5, 5, 5, 5, 5, 5, 5, 5, 5, '', ''),
(1573, 1590, 5, 5, 4, 5, 3, 3, 3, 3, 2, 'viy@payaman.com', 'aircon para cool');

-- --------------------------------------------------------

--
-- Table structure for table `tblcss_summary`
--

CREATE TABLE `tblcss_summary` (
  `csssummaryid` int(11) NOT NULL,
  `officeid` int(11) DEFAULT NULL,
  `quarterid` int(11) DEFAULT NULL,
  `servicesid` int(11) DEFAULT NULL,
  `dost_personnel` varchar(45) DEFAULT NULL,
  `clienttypeid` int(11) DEFAULT NULL,
  `others_remarks` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `age_back` int(11) DEFAULT NULL,
  `vul_sector` varchar(200) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `dost_info` varchar(200) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcss_summary`
--

INSERT INTO `tblcss_summary` (`csssummaryid`, `officeid`, `quarterid`, `servicesid`, `dost_personnel`, `clienttypeid`, `others_remarks`, `name`, `date`, `sex`, `age`, `age_back`, `vul_sector`, `address`, `dost_info`, `year`, `date_created`) VALUES
(1587, 2, 1, 78, 'Vench', 1, NULL, 'Jordan Stew', '2025-03-20', 'Male', 2, NULL, '4P\'s Beneficiary', 'Valencia', 'Radio', '2025', '2025-03-20 14:10:42'),
(1588, 1, 1, 83, 'Ruel Jr', 2, 'Test Others Query', 'Max Verstappen', '2025-03-20', 'Male', 2, NULL, NULL, 'Netherlands', 'TV', '2025', '2025-03-20 14:15:08'),
(1589, 1, 2, 72, 'Rueljr', 2, '', 'Tokyo Athena', '2025-04-02', 'Female', 1, NULL, 'Persons With Disability, 4P\'s Beneficiary', 'Bukidnon', 'Referral', '2025', '2025-04-02 09:09:19'),
(1590, 1, 2, 83, 'Vernabels', 2, 'Secret lang', 'Viy Sakalam', '2025-04-02', 'Female', 2, NULL, '', 'Camaman-an', 'Radio', '2025', '2025-04-02 09:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbloffice`
--

CREATE TABLE `tbloffice` (
  `officeid` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `shorthand` varchar(45) DEFAULT NULL,
  `is_psto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbloffice`
--

INSERT INTO `tbloffice` (`officeid`, `name`, `shorthand`, `is_psto`) VALUES
(1, 'Regional Office', 'RO', 0),
(2, 'DOST - Bukidnon', 'DOST-BUK', 1),
(3, 'DOST - Camiguin', 'DOST-CAM', 1),
(4, 'DOST - Lanao del Norte', 'DOST-LDN', 1),
(5, 'DOST - Misamis Occidental', 'DOST-MOC', 1),
(6, 'DOST -  Misamis Oriental', 'DOST-MOR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblquarters`
--

CREATE TABLE `tblquarters` (
  `quarterid` int(11) NOT NULL,
  `semesterid` int(11) DEFAULT NULL,
  `quarter` varchar(15) DEFAULT NULL,
  `shorthand` char(5) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblquarters`
--

INSERT INTO `tblquarters` (`quarterid`, `semesterid`, `quarter`, `shorthand`, `is_active`) VALUES
(1, 1, '1st Quarter', 'Q1', 1),
(2, 1, '2nd Quarter', 'Q2', 0),
(3, 2, '3rd Quarter', 'Q3', 0),
(4, 2, '4th Quarter', 'Q4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesters`
--

CREATE TABLE `tblsemesters` (
  `semesterid` int(11) NOT NULL,
  `semester` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsemesters`
--

INSERT INTO `tblsemesters` (`semesterid`, `semester`) VALUES
(1, '1st Semester'),
(2, '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `servicesid` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `unit` varchar(150) DEFAULT NULL,
  `is_external` tinyint(4) DEFAULT 0,
  `is_active` tinyint(4) DEFAULT 1,
  `is_cc` tinyint(4) DEFAULT 0,
  `is_psto` tinyint(4) DEFAULT 0,
  `is_psto_only` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`servicesid`, `name`, `unit`, `is_external`, `is_active`, `is_cc`, `is_psto`, `is_psto_only`) VALUES
(21, '', 'Accounting Unit', 0, 1, 0, 0, 0),
(22, 'Recording of Obligation of Payments', 'Budget Unit', 0, 1, 1, 0, 0),
(23, 'Issuance of Checks and LDDAP-ADA', 'Cashiering', 0, 1, 1, 0, 0),
(24, '', 'Consultancy and Training', 0, 1, 0, 0, 0),
(25, '', 'DRRM', 0, 1, 0, 0, 0),
(26, '', 'FOB Secretariat', 0, 1, 0, 0, 0),
(27, 'Employees Request for Certifications and Clearance', 'HR', 0, 1, 1, 0, 0),
(28, 'Payment of Salaries and Other Compensation', 'HR', 0, 1, 1, 0, 0),
(29, 'Processing of Leave Application', 'HR', 0, 1, 1, 0, 0),
(30, 'Janitorial Services', '', 0, 1, 0, 0, 0),
(31, '', 'LGIA-CEST', 0, 1, 0, 0, 0),
(32, 'Request for Maintenance of Buildings, Utilities', 'Maintenance Committee', 0, 1, 1, 0, 0),
(33, 'Request for Maintenance of ICT Equipment', 'Maintenance Committee', 0, 1, 1, 0, 0),
(34, '', 'Management Information Systems (MIS)', 0, 1, 0, 0, 0),
(35, 'Motor Pool Services', '', 0, 1, 0, 0, 0),
(36, '', 'NORMINCOHRD', 0, 1, 0, 0, 0),
(37, '', 'NORMINCIEERD', 0, 1, 0, 0, 0),
(38, '', 'Office of the Regional Director', 0, 1, 0, 0, 0),
(41, '', 'Planning, Monitoring, Evaluation, and QMS', 0, 1, 0, 0, 0),
(42, '', 'PSTO Bukidnon', 0, 1, 0, 0, 0),
(43, '', 'PSTO Camiguin', 0, 1, 0, 0, 0),
(44, '', 'PSTO Lanao del Norte', 0, 1, 0, 0, 0),
(45, '', 'PSTO Misamis Occidental', 0, 1, 0, 0, 0),
(46, '', 'PSTO Misamis Oriental', 0, 1, 0, 0, 0),
(47, '', 'RRDIC', 0, 1, 0, 0, 0),
(48, '', 'RSTL', 0, 1, 0, 0, 0),
(49, '', 'Scholarship', 0, 1, 0, 0, 0),
(50, '', 'SETUP', 0, 1, 0, 0, 0),
(51, '', 'Special Projects', 0, 1, 0, 0, 0),
(52, '', 'Supply Unit', 0, 1, 0, 0, 0),
(54, '', 'Strategic Communication and Creative Unit', 0, 1, 0, 0, 0),
(67, 'Payment', NULL, 1, 1, 0, 0, 0),
(68, 'Training', NULL, 1, 1, 0, 1, 0),
(69, 'Consultancy', NULL, 1, 1, 0, 1, 0),
(70, 'Research', NULL, 1, 1, 0, 0, 0),
(71, 'Data Request', NULL, 1, 1, 0, 1, 0),
(72, 'Information Request', NULL, 1, 1, 0, 1, 0),
(74, 'Scholarship', NULL, 1, 1, 0, 0, 0),
(75, 'Procurement', NULL, 1, 1, 0, 0, 0),
(76, 'Job Application', NULL, 1, 1, 0, 1, 0),
(77, 'Innovation', NULL, 1, 1, 0, 1, 0),
(78, 'Project Proposal', 'SETUP', 1, 1, 0, 1, 1),
(79, 'Project Proposal', 'LGIA-CEST', 1, 1, 0, 1, 1),
(80, 'Project Funds', 'SETUP', 1, 1, 0, 1, 1),
(81, 'Project Funds', 'LGIA-CEST', 1, 1, 0, 1, 1),
(82, 'Technology Needs Assessment', 'SETUP', 1, 1, 0, 1, 1),
(83, 'Others', NULL, 1, 1, 0, 1, 0),
(84, 'Laboratory Services', NULL, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userid` int(11) NOT NULL,
  `officeid` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `usertype` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `officeid`, `username`, `password`, `usertype`) VALUES
(2, 1, 'admin', '$2y$10$l87NPuCWxgFV257NjIZZ3.jRaFDXWhb46Sgjb67021UfQIWD9/dyW', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `_tblagedist`
--

CREATE TABLE `_tblagedist` (
  `agedistid` int(11) NOT NULL,
  `agedist` varchar(45) DEFAULT NULL,
  `low` int(11) DEFAULT NULL,
  `high` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_tblagedist`
--

INSERT INTO `_tblagedist` (`agedistid`, `agedist`, `low`, `high`) VALUES
(1, '19 or lower', NULL, 19),
(2, '20-34', 20, 34),
(3, '35-49', 35, 49),
(4, '50-64', 50, 64),
(5, '65 or higher', 65, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tblagegroup`
--
ALTER TABLE `tblagegroup`
  ADD PRIMARY KEY (`agegroupid`);

--
-- Indexes for table `tblclienttype`
--
ALTER TABLE `tblclienttype`
  ADD PRIMARY KEY (`clienttypeid`);

--
-- Indexes for table `tblcss_details_cc`
--
ALTER TABLE `tblcss_details_cc`
  ADD PRIMARY KEY (`cssdetailsccid`),
  ADD KEY `tblcss_details_cc_sumid_idx` (`csssummaryid`);

--
-- Indexes for table `tblcss_details_sqd`
--
ALTER TABLE `tblcss_details_sqd`
  ADD PRIMARY KEY (`cssdetailssqd`),
  ADD KEY `csssummaryid_sqd_fk_idx` (`csssummaryid`);

--
-- Indexes for table `tblcss_summary`
--
ALTER TABLE `tblcss_summary`
  ADD PRIMARY KEY (`csssummaryid`),
  ADD KEY `tblclienttypeid_fk_idx` (`clienttypeid`),
  ADD KEY `tblquarterid_fk_idx` (`quarterid`),
  ADD KEY `tblservicesid_fk_idx` (`servicesid`),
  ADD KEY `tblagegroup_fk_idx` (`age`);

--
-- Indexes for table `tbloffice`
--
ALTER TABLE `tbloffice`
  ADD PRIMARY KEY (`officeid`);

--
-- Indexes for table `tblquarters`
--
ALTER TABLE `tblquarters`
  ADD PRIMARY KEY (`quarterid`),
  ADD KEY `semesterid_tblsemester_fk_idx` (`semesterid`);

--
-- Indexes for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  ADD PRIMARY KEY (`semesterid`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`servicesid`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `tbluser_officeid_fk_idx` (`officeid`);

--
-- Indexes for table `_tblagedist`
--
ALTER TABLE `_tblagedist`
  ADD PRIMARY KEY (`agedistid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblagegroup`
--
ALTER TABLE `tblagegroup`
  MODIFY `agegroupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblclienttype`
--
ALTER TABLE `tblclienttype`
  MODIFY `clienttypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcss_details_cc`
--
ALTER TABLE `tblcss_details_cc`
  MODIFY `cssdetailsccid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1579;

--
-- AUTO_INCREMENT for table `tblcss_details_sqd`
--
ALTER TABLE `tblcss_details_sqd`
  MODIFY `cssdetailssqd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1574;

--
-- AUTO_INCREMENT for table `tblcss_summary`
--
ALTER TABLE `tblcss_summary`
  MODIFY `csssummaryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1591;

--
-- AUTO_INCREMENT for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `servicesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `_tblagedist`
--
ALTER TABLE `_tblagedist`
  MODIFY `agedistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcss_details_cc`
--
ALTER TABLE `tblcss_details_cc`
  ADD CONSTRAINT `csssummaryid_fk` FOREIGN KEY (`csssummaryid`) REFERENCES `tblcss_summary` (`csssummaryid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcss_details_sqd`
--
ALTER TABLE `tblcss_details_sqd`
  ADD CONSTRAINT `csssummaryid_sqd_fk` FOREIGN KEY (`csssummaryid`) REFERENCES `tblcss_summary` (`csssummaryid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcss_summary`
--
ALTER TABLE `tblcss_summary`
  ADD CONSTRAINT `tblagegroup_fk` FOREIGN KEY (`age`) REFERENCES `tblagegroup` (`agegroupid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblclienttypeid_fk` FOREIGN KEY (`clienttypeid`) REFERENCES `tblclienttype` (`clienttypeid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblquarterid_fk` FOREIGN KEY (`quarterid`) REFERENCES `tblquarters` (`quarterid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblservicesid_fk` FOREIGN KEY (`servicesid`) REFERENCES `tblservices` (`servicesid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tblquarters`
--
ALTER TABLE `tblquarters`
  ADD CONSTRAINT `semesterid_tblsemester_fk` FOREIGN KEY (`semesterid`) REFERENCES `tblsemesters` (`semesterid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `tbluser_officeid_fk` FOREIGN KEY (`officeid`) REFERENCES `tbloffice` (`officeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
