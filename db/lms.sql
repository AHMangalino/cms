-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 01:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `slots` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `image_path` blob NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `image_path`, `title`, `caption`) VALUES
(14, 0x2e2e2f6173736574732f63617264732f57494e5f32303233313032325f31375f34325f35345f50726f2e6a7067, 'Russel Guisihan', 'Considering that 98% of mobile phone owners read every single text they receive, it’s not surprising that text messaging is the most effective way to engage alumni of all ages and demographics. This is even true for younger alums who tend to ignore phone calls and emails, but respond to their texts within minutes. Yet many colleges and universities are still using less effective channels to interact with them.   Having direct conversations with former students through texting enables you to keep them up-to-date about events, alumni benefits, mentorship opportunities, important news, and more. When you engage your alumni on their terms, it becomes much easier to learn about their interests — so you can provide them with the relevant, timely information they actually want. This automated feedback loop builds affinity, deepens your connection with former students over time, and increases alumni engagement and giving. This approach is especially important for community colleges looking to strengthen ties with transfer students who have moved on to a four-year university.   At Mainstay, we specialize in helping colleges have meaningful conversations that improve student and alumni engagement. That’s why we created an actionable guide that highlights some of the best text messages you can send former students right now. Use these conversation starters today to spark meaningful interactions, increase engagement, and grow alumni advocacy at scale.');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(100) NOT NULL,
  `course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `picture_path` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `picture_path`) VALUES
(12, 0x2e2e2f6173736574732f636f766572732f74682e6a706567),
(15, 0x2e2e2f6173736574732f636f766572732f57494e5f32303233313032325f31375f34325f35345f50726f2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `grid_content`
--

CREATE TABLE `grid_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grid_content`
--

INSERT INTO `grid_content` (`id`, `title`, `caption`, `size`) VALUES
(1, 'ewew', 'erer', 12),
(2, 'ewew', 'erer', 12),
(3, 'waw', 'ewe', 12);

-- --------------------------------------------------------

--
-- Table structure for table `grid_data`
--

CREATE TABLE `grid_data` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `size` int(11) NOT NULL,
  `background_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grid_data`
--

INSERT INTO `grid_data` (`id`, `title`, `caption`, `size`, `background_color`) VALUES
(7, 'REMINDER!', 'CLASS, DO NOT UPLOAD UNNECESSARY FILES, OR ELSE I WILL CLOSE THE WEBSITE. THANK YOU', 5, '#ff0000'),
(8, 'CMS Activity', 'Deadline po will be on Feb 9 love you', 5, '#c84646'),
(11, 'Preliminary Examination', 'During prelim examination po presentation ng system which includes; cms, messaging and, enrollment system with appointment scheduling', 5, '#e23636');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(169) NOT NULL,
  `pic` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `pic`) VALUES
(15, 0x363435376437303034356562362e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `school_profile`
--

CREATE TABLE `school_profile` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_profile`
--

INSERT INTO `school_profile` (`id`, `school_name`, `address`, `contact_number`) VALUES
(1, 'Eidrei University', 'Inter Galactic ', '21345465657');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(100) NOT NULL,
  `section` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(169) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid_content`
--
ALTER TABLE `grid_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid_data`
--
ALTER TABLE `grid_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_profile`
--
ALTER TABLE `school_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `grid_content`
--
ALTER TABLE `grid_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grid_data`
--
ALTER TABLE `grid_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(169) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `school_profile`
--
ALTER TABLE `school_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(169) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
