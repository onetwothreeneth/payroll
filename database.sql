-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 04:16 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `type` varchar(225) DEFAULT NULL,
  `status` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `status`, `created_at`, `updated_at`) VALUES
(NULL, 'admin', 'admin', 'admin', '1', '', ''),
(NULL, 'timekeeper', 'timekeeper', 'timekeeper', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_meta`
--

CREATE TABLE `admin_meta` (
  `id` int(11) NOT NULL,
  `auth_id` int(225) DEFAULT NULL,
  `meta_type` varchar(225) DEFAULT NULL,
  `meta_key` varchar(225) DEFAULT NULL,
  `meta_value` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_meta`
--

INSERT INTO `admin_meta` (`id`, `auth_id`, `meta_type`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'photo', 'default.png', '', ''),
(2, 2, NULL, 'photo', 'default.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `auth_id` int(225) NOT NULL,
  `action` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_meta`
--

CREATE TABLE `company_meta` (
  `id` int(11) NOT NULL,
  `meta_key` varchar(225) NOT NULL,
  `meta_value` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `mname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `birthday` varchar(225) NOT NULL,
  `gender` varchar(225) NOT NULL,
  `contact` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `designation` varchar(225) NOT NULL,
  `basic_rate` varchar(225) NOT NULL,
  `monthly_rate` varchar(225) NOT NULL,
  `hourly_rate` varchar(225) NOT NULL,
  `sss` varchar(225) NOT NULL,
  `philhealth` varchar(225) NOT NULL,
  `pagibig` varchar(225) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(225) NOT NULL,
  `leave_type` varchar(225) NOT NULL,
  `leave_days` varchar(225) NOT NULL,
  `start` varchar(225) NOT NULL,
  `end` varchar(225) NOT NULL,
  `hr_status` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves_meta`
--

CREATE TABLE `leaves_meta` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `days` varchar(225) NOT NULL,
  `pay` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(225) NOT NULL,
  `loan_type` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `months` varchar(225) NOT NULL,
  `interest` varchar(225) NOT NULL,
  `total` varchar(225) NOT NULL,
  `monthly` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_meta`
--

CREATE TABLE `loans_meta` (
  `id` int(11) NOT NULL,
  `loan_type` varchar(225) NOT NULL,
  `payroll_id` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mandatory_meta`
--

CREATE TABLE `mandatory_meta` (
  `id` int(11) NOT NULL,
  `type` varchar(225) NOT NULL,
  `baserange` varchar(225) NOT NULL,
  `monthly` varchar(225) NOT NULL,
  `employee` varchar(225) NOT NULL,
  `employer` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandatory_meta`
--

INSERT INTO `mandatory_meta` (`id`, `type`, `baserange`, `monthly`, `employee`, `employer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pagibig', '8,999.99 - below', '200.00', '100.00', '100.00', '1', '', ''),
(2, 'sss', '8,999.99 - below', '990.00', '663.00', '327.00', '1', '', ''),
(3, 'philhealth', '10,000.00 - below', ' 275.00', '137.50', '137.50', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

CREATE TABLE `payslips` (
  `id` int(11) NOT NULL,
  `cutoff_start` varchar(225) NOT NULL,
  `cutoff_end` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payslips_meta`
--

CREATE TABLE `payslips_meta` (
  `id` int(11) NOT NULL,
  `payslip_id` varchar(225) NOT NULL,
  `emp_id` varchar(225) NOT NULL,
  `total` varchar(225) NOT NULL,
  `data` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timekeeping`
--

CREATE TABLE `timekeeping` (
  `id` int(11) NOT NULL,
  `date` varchar(225) NOT NULL,
  `emp_id` int(225) NOT NULL,
  `attendance` varchar(225) NOT NULL,
  `reg_in` varchar(225) NOT NULL,
  `reg_out` varchar(225) NOT NULL,
  `reg_hours` varchar(225) NOT NULL,
  `ot_start` varchar(225) NOT NULL,
  `ot_end` varchar(225) NOT NULL,
  `ot_hours` varchar(225) NOT NULL,
  `nightdif_in` varchar(225) NOT NULL,
  `nightdif_out` varchar(225) NOT NULL,
  `nightdif_hours` varchar(225) NOT NULL,
  `doublepay` varchar(225) NOT NULL,
  `total_hrs` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL,
  `updated_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_meta`
--
ALTER TABLE `admin_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_meta`
--
ALTER TABLE `company_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves_meta`
--
ALTER TABLE `leaves_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans_meta`
--
ALTER TABLE `loans_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandatory_meta`
--
ALTER TABLE `mandatory_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslips`
--
ALTER TABLE `payslips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslips_meta`
--
ALTER TABLE `payslips_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timekeeping`
--
ALTER TABLE `timekeeping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_meta`
--
ALTER TABLE `admin_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_meta`
--
ALTER TABLE `company_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves_meta`
--
ALTER TABLE `leaves_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans_meta`
--
ALTER TABLE `loans_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandatory_meta`
--
ALTER TABLE `mandatory_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payslips`
--
ALTER TABLE `payslips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslips_meta`
--
ALTER TABLE `payslips_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timekeeping`
--
ALTER TABLE `timekeeping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
