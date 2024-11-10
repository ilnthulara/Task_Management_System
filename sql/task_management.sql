-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 05:55 AM
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
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `category` varchar(50) DEFAULT 'General',
  `due_date` date DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `priority`, `category`, `due_date`, `status`, `created_at`) VALUES
(2, 1, 'Prepare Presentation for Client Meeting', 'Create a PowerPoint presentation outlining the project\'s progress for an upcoming client meeting.', 'high', 'Work', '2024-11-15', 'pending', '2024-11-10 00:38:37'),
(3, 1, 'Submit Weekly Report', 'Compile and submit the weekly progress report to the team lead.', 'medium', 'Work', '2024-11-12', 'pending', '2024-11-10 00:39:11'),
(4, 1, 'Buy Groceries for the Week', 'Purchase groceries to last through the week, including fruits, vegetables, and essentials.', 'medium', 'Personal', '2024-11-11', 'completed', '2024-11-10 00:39:34'),
(5, 1, 'Complete Online Course Module', 'Finish watching the video lectures and complete the quiz for this week’s module.', 'medium', 'Personal', '2024-11-12', 'pending', '2024-11-10 00:39:59'),
(6, 1, 'Complete Coding Challenge for Job Application', 'Complete a coding challenge for a job application, involving solving algorithmic problems.', 'high', 'Other', '2024-11-12', 'pending', '2024-11-10 00:40:30'),
(7, 1, 'Attend Charity Event', 'Attend a local charity event and support the cause.', 'medium', 'Other', '2024-11-25', 'pending', '2024-11-10 00:42:17'),
(8, 4, 'Call Family Member', 'Call your grandmother to check on her and chat.', 'low', 'Personal', '2024-11-22', 'completed', '2024-11-10 01:01:50'),
(9, 4, 'Plan a Family Reunion', 'Begin planning a family reunion for the holidays, including location, guests, and activities.', 'medium', 'Personal', '2024-11-20', 'pending', '2024-11-10 01:02:15'),
(10, 2, 'Set Up Smart Home Devices', 'Install and configure smart home devices like thermostats and lights.', 'medium', 'Personal', '2024-12-12', 'pending', '2024-11-10 01:03:16'),
(11, 2, 'Write a Blog Post on JavaScript Best Practices', 'Write and publish a blog post outlining best practices in JavaScript coding.', 'low', 'Other', '2024-11-30', 'pending', '2024-11-10 01:03:44'),
(12, 2, 'Update Website Content', 'Review and update the content on the company website to reflect recent changes.', 'low', 'Work', '2024-11-17', 'pending', '2024-11-10 01:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'nethmiti', '$2y$10$YEicEagvjip7BfTR9/4Mz.lCYokN8VGkZjpoLfLFW7Ho1og435i8W', '2024-11-10 00:21:20'),
(2, 'Dula', '$2y$10$tUDRX08W6HHv5XFfOxo8reZ8lgmG3GV6yjuplMY5VAwqQw1bukNxK', '2024-11-10 00:22:30'),
(3, 'daisy', '$2y$10$d.aLhSc6Dk2X79TNEFdCX.Opcs.GIiL4eBm6qb.Xa4iwUUViWxbS2', '2024-11-10 00:22:51'),
(4, 'peter5', '$2y$10$gRiwKFGA0S4UvXuUA01kQ.ZxBKrO1bwqXgvx5BwsfzJ15aO3D/JA.', '2024-11-10 00:23:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
