-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 02:07 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egy_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Hu Shaffer', 'zehukyxyci@mailinator.com', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 1),
(2, 'Edan Murray', 'nacica@mailinator.com', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 1),
(3, 'asdasd', 'ali@gmail.com', 'd5644e8105ad77c3c3324ba693e83d8fffd54950', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `nation_id` bigint(20) NOT NULL,
  `passport_num` varchar(255) NOT NULL,
  `mrn` varchar(255) NOT NULL,
  `visit_code` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL,
  `repo_date` varchar(2000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `birthday`, `result`, `nationality`, `nation_id`, `passport_num`, `mrn`, `visit_code`, `gender`, `reg_date`, `repo_date`, `img`, `time`, `admin_id`) VALUES
(16, 'Burton Kane', '1980-06-04', 'Positive', 'Omnis commodi nobis ', 45, '60', '18', '82', 'Male', '2001-02-16', '1970-05-10', '2788_WhatsApp Image 2021-11-02 at 10.44.51 PM.jpeg', '', 1),
(17, 'Zachery Vaughn', '1975-08-09', 'Negative', 'Sit quia doloremque', 91, '62', '12', '96', 'Male', '1999-08-02', '2018-07-15', '546869_WhatsApp Image 2021-11-02 at 10.43.20 PM.jpeg', '', 1),
(18, 'Amelia Cortez', '2017-01-23', 'Positive', 'Ullamco ut incidunt', 77, '19', '46', '75', 'Female', '2002-02-18', '2004-12-11', '675301_WhatsApp Image 2021-10-30 at 5.22.03 PM.jpeg', '2021/11/08 . 12:11:29', 1),
(19, 'Ashely Blanchard', '1980-05-22', 'Positive', 'Minima rerum aliquid', 55, '2', '94', '47', 'Female', '2006-07-21', '1976-03-26', '681_Ashely Blanchard', '2021/11/08 . 12:12:32', 1),
(20, 'Jelani Fernandez', '2001-04-14', 'Positive', 'Tempora voluptatem c', 20, '19', '69', '52', 'Female', '2000-06-18', '1995-08-09', '123_Jelani Fernandez', '2021/11/08 . 12:13:09', 1),
(21, 'Gregory Walton', '1990-06-21', 'Positive', 'Et nostrum tempor qu', 37, '92', '52', '36', 'Female', '1999-07-21', '1987-09-27', '122_Gregory Walton', '2021/11/08 . 12:13:32', 1),
(22, 'Bethany Simmons', '1976-04-22', 'Negative', 'Quos et esse in sed ', 35, '37', '62', '49', 'Male', '2010-09-09T22:37', '1970-12-28T02:20', '449_Bethany Simmons', '2021/11/08 . 05:46:55', 1),
(23, 'Heidi Snyder', '2006-09-12', 'Negative', 'Minus neque est ea f', 28506091601661, '29068057', '2486', '11024050010', 'Female', '2013-02-27T11:55', '1991-04-13T21:16', '386_Heidi Snyder', '2021/11/08 . 06:26:04', 1),
(24, 'Sybil Aguirre', '1988-12-03', 'Positive', 'Veniam velit dolori', 35, '55', '53', '10', 'Male', '1984-03-03T10:07', '2008-01-08T15:07', '815_Sybil Aguirre', '2021/11/08 . 06:42:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
