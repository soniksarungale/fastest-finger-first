-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2018 at 06:45 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourdatabasename`
--

-- --------------------------------------------------------

--
-- Table structure for table `fffans`
--

CREATE TABLE `fffans` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `correct` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fffplayers`
--

CREATE TABLE `fffplayers` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `done` varchar(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fffplayers`
--

INSERT INTO `fffplayers` (`id`, `name`, `code`, `done`) VALUES
(1, 'sonik sarungale', 'FH7S', '0'),
(2, 'ram sham', '6HR3', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fffans`
--
ALTER TABLE `fffans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fffplayers`
--
ALTER TABLE `fffplayers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fffplayers`
--
ALTER TABLE `fffplayers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
