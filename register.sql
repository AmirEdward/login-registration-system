-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 01:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(6) UNSIGNED NOT NULL,
  `sender_name` varchar(30) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender_name`, `sender_email`, `message`, `send_date`) VALUES
(1, 'AmirEd', 'amir@amir.com', 'asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd', '2017-05-20 16:32:34'),
(2, 'Amir Edward', 'amir@example.com', 'lkjsdfsdliwer,mncvicxvkjlskd.a?Sl;ksffsdf', '2017-05-20 18:36:03'),
(3, 'Amir Edward', 'amiredward55@gmail.com', 'Ø§Ø¨ØªØ«Ø¬Ø­Ø®Ø¯Ø°Ø±Ø²Ø³Ø´ØµØ¶Ø·Ø¸Ø¹ØºÙÙ‚ÙƒÙ„Ù…Ù†Ù‡ÙˆÙŠ', '2017-05-24 14:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `join_date`) VALUES
(1, 'AmirEd', '$2y$10$mnJ0CcKGuulG9AoFqsrl5.5yrlH3jByV3OtlLlfqIkQjQlEdB/ga6', 'AmirEd@example.com', '2017-05-27 14:41:21'),
(2, 'AmirEdward', '$2y$10$Iw7SeHPju4hxVo19NDxVo.KreoAUJyAtntT0dXserAyhi5bxuT2ya', 'amir.edward@rocketmail.com', '2017-05-24 13:25:53'),
(3, 'Bisho', '$2y$10$U/yv8phQ9LJoQol8qtCqx.R4fuGhl4vIJCrzExlpfC1E1h5wTEr6W', 'ab@cd.ef', '2017-05-26 17:55:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
