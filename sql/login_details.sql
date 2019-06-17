-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 04:58 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `deviceId` varchar(50) NOT NULL,
  `randum` text NOT NULL,
  `email` text NOT NULL,
  `pass` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `bloodgroup` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `prents` varchar(100) NOT NULL,
  `kidsDetails` varchar(100) NOT NULL,
  `longt` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `deviceId`, `randum`, `email`, `pass`, `name`, `last_name`, `age`, `gender`, `mobile`, `address`, `bloodgroup`, `height`, `weight`, `prents`, `kidsDetails`, `longt`, `lat`) VALUES
(2, '', 'bf01051c88d76a6f3f282fed3a1', '324364', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '', 'bf01051c88d76a6f3f282fed3a104', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '', 'bf01051c88d76a6f3f282fed3a104200', 'rehanansari8521@gmail.com', '12345678', 'Saddam', 'Ansari', '21', 'Male', '7091959527', 'Kendua', 'A+', '5.4', '74', 'Mafizuddin', 'Nawed', '12.34535.34', '34.2334.33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
