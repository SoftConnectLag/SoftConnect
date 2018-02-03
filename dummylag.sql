-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2018 at 01:59 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dummylag`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(15) NOT NULL,
  `full_name` text NOT NULL,
  `tel_no` text NOT NULL,
  `department` text NOT NULL,
  `email_address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `matric_no`, `full_name`, `tel_no`, `department`, `email_address`) VALUES
(1, '170805028', 'Rotibi Adedeji Olamide', '07016663388', 'Computer Sciences', 'dayjeerow7@gmail.com'),
(2, '170805037', 'Afolayan John', '07016663388', 'Computer Sciences', 'hughj32001@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(15) NOT NULL,
  `full_name` text NOT NULL,
  `tel_no` text NOT NULL,
  `email_address` text NOT NULL,
  `department` text NOT NULL,
  `level` text NOT NULL,
  `session` text NOT NULL,
  `status` text NOT NULL,
  `date` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `matric_no`, `full_name`, `tel_no`, `email_address`, `department`, `level`, `session`, `status`, `date`) VALUES
(1, '170805037', 'Afolayan John', '+2348167364146', 'hughj32001@gmail.com', 'Computer Sciences', '100', '2018/2019', 'Paid', '01/02/2018'),
(2, '170805028', 'Rotibi Adedeji Olamide', '+2347016663388', 'dayjeerow7@gmail.com', 'Computer Sciences', '100', '2018/2019', 'Paid', '01/02/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
