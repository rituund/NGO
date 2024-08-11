-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 02:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngo3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` varchar(20) NOT NULL,
  `Activity_Name` varchar(35) NOT NULL,
  `ngo_id` varchar(20) DEFAULT NULL,
  `branch_id` varchar(20) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `hrs` int(11) DEFAULT NULL,
  `details` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `Activity_Name`, `ngo_id`, `branch_id`, `credits`, `hrs`, `details`) VALUES
('1', 'Forest Regeneration', '100', '134', 3, 24, 'Forest Regeneration'),
('2', 'Animal Rescue and Rehabilitation', '101', '23', 1, 12, 'Animal Rescue and Re'),
('3', 'Children\'s Education', '102', '345', NULL, 12, ' Children\'s Educatio'),
('4', 'Fundraiser Run', NULL, NULL, NULL, NULL, 'Fundraiser Run'),
('5', 'Elderly Care ', '103', '297', 4, 30, ' Elderly Care ');

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

CREATE TABLE `charity` (
  `charity_id` int(200) NOT NULL,
  `branch_id` int(200) NOT NULL,
  `ngo_id` int(200) NOT NULL,
  `amount` int(10) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charity`
--

INSERT INTO `charity` (`charity_id`, `branch_id`, `ngo_id`, `amount`, `username`) VALUES
(1, 134, 100, 1000, ''),
(2, 134, 100, 1000, 'John M'),
(3, 134, 100, 1000, 'Rajesh MS'),
(5, 134, 100, 1000, 'Rajesh MS'),
(6, 23, 123, 1000, 'Rajesh MS'),
(7, 134, 100, 600, 'Rajesh MS'),
(10, 23, 101, 700, 'Nidhi_MR');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `user_id` int(200) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pwd` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`user_id`, `username`, `pwd`, `email`) VALUES
(1, 'Rajesh MS', '765', 'msr@gmail.com'),
(2, 'Nidhi_MR', '23475', 'nidhimrajesh@gmail.com'),
(3, 'krithi_m_r', 'nk9ub', 'krithi@gmail.com'),
(4, 'John M', '123', 'johhn@gmail.com'),
(7, 'howard', '123', 'howard@gmail.com'),
(9, 'nikhitha', 'nihf', 'nik@gmail.com'),
(10, 'Aakash', 'asks', 'aakash@gmail.com'),
(18, 'Rakshita', '1234', 'rakshitha@gmail.com'),
(19, 'Varun', 'vytfs9', 'vks@gmail.com'),
(20, 'Nishitha', 'nish3334', 'nish@gmail.com'),
(21, 'Arun', 'nura22', 'aruuun@gmail.com'),
(22, 'Meghana', 'megah84', 'megh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `donor_history`
--

CREATE TABLE `donor_history` (
  `user_id` int(10) DEFAULT NULL,
  `activity_id` int(10) NOT NULL,
  `credits` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_history`
--

INSERT INTO `donor_history` (`user_id`, `activity_id`, `credits`) VALUES
(1, 1, 3),
(4, 1, 3),
(4, 2, 1),
(2, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `ngo_id` varchar(20) NOT NULL,
  `ngo_name` varchar(20) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`ngo_id`, `ngo_name`, `phone`) VALUES
('100', 'Save Green', 756379284),
('101', 'Cupa Bangalore', 736352748),
('102', 'NMGCT', 736584644),
('103', 'VTVO', 987654324);

-- --------------------------------------------------------

--
-- Table structure for table `ngo_location`
--

CREATE TABLE `ngo_location` (
  `branch_id` varchar(20) NOT NULL,
  `ngo_id` varchar(20) NOT NULL,
  `city` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ngo_location`
--

INSERT INTO `ngo_location` (`branch_id`, `ngo_id`, `city`) VALUES
('134', '100', 'Bangalore'),
('3099', '100', 'Mumbai'),
('23', '101', 'Bangalore'),
('345', '102', 'Bangalore'),
('297', '103', 'Bangalore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `ngo_id` (`ngo_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `charity`
--
ALTER TABLE `charity`
  ADD PRIMARY KEY (`charity_id`),
  ADD KEY `branch_id` (`branch_id`,`ngo_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`ngo_id`),
  ADD KEY `ngo_id` (`ngo_id`);

--
-- Indexes for table `ngo_location`
--
ALTER TABLE `ngo_location`
  ADD PRIMARY KEY (`ngo_id`,`branch_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charity`
--
ALTER TABLE `charity`
  MODIFY `charity_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`ngo_id`) REFERENCES `ngo` (`ngo_id`),
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `ngo_location` (`branch_id`);

--
-- Constraints for table `ngo_location`
--
ALTER TABLE `ngo_location`
  ADD CONSTRAINT `ngo_location_ibfk_1` FOREIGN KEY (`ngo_id`) REFERENCES `ngo` (`ngo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
