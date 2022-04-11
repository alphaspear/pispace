-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2021 at 05:02 PM
-- Server version: 8.0.26-0ubuntu0.21.04.3
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ongc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(30, 'Admin2', 'admin2@gmail.com', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`) VALUES
('iabhilashjoshi@gmail.com', '610a5876e01ea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `sn` int NOT NULL,
  `qns` text NOT NULL,
  `optiona` text NOT NULL,
  `optionb` text NOT NULL,
  `optionc` text NOT NULL,
  `optiond` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`eid`, `qid`, `sn`, `qns`, `optiona`, `optionb`, `optionc`, `optiond`, `ansid`) VALUES
('610a5876e01ea', '610a59ba5a1f6', 1, 'value of g on Earth ', '7 m/sec²', '72 m/sec²', '17 m/sec²', '9.8 m/sec²', 'd'),
('610a5876e01ea', '610a59ba5a9ef', 2, 'Escape velocity for earth', '1212', '121', '11.6', '2112', 'c'),
('610a5876e01ea', '610a59ba5ad14', 3, 'Archimedes was from', 'Greek', 'Rome', 'Italy', 'India', 'b'),
('610a5876e01ea', '610a59ba5b044', 4, 'Formula for work', 'w=sd', 'w=mg', 'w=oy', 'w=jh', 'b'),
('610a5876e01ea', '610a59ba5b92c', 5, 'Speed of light', '12', '123', '34', '3*10⁸', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `total` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `timelimit` int NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `total`, `timelimit`, `status`) VALUES
('610a5876e01ea', 'Physics', 5, 14, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `department` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `department`, `email`, `password`) VALUES
('Abhilash Joshi', 'Computer Science', 'iabhilashjoshi@gmail.com', 'Zero0One0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
