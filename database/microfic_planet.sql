-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2026 at 07:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microfic_planet`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `followID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `followerID` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`followID`, `userID`, `followerID`, `created_at`) VALUES
(2, 1, 2, '2026-08-18 17:14:46'),
(3, 5, 2, '2026-08-18 17:15:25'),
(4, 2, 5, '2026-08-18 17:39:32'),
(5, 3, 5, '2026-08-18 17:39:38'),
(6, 5, 7, '2026-08-18 17:42:44'),
(7, 2, 7, '2026-08-18 17:43:01'),
(8, 5, 6, '2026-08-18 17:43:33'),
(9, 2, 6, '2026-08-18 17:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likedID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `storyID` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likedID`, `userID`, `storyID`, `created_at`) VALUES
(15, 2, 3, '2026-08-17 16:52:02'),
(17, 3, 5, '2026-08-18 07:03:28'),
(18, 3, 6, '2026-08-18 07:07:29'),
(20, 3, 4, '2026-08-18 08:20:11'),
(22, 3, 2, '2026-08-18 09:03:50'),
(24, 3, 1, '2026-08-18 09:04:28'),
(25, 2, 1, '2026-08-18 09:04:58'),
(26, 2, 2, '2026-08-18 09:05:00'),
(27, 2, 4, '2026-08-18 09:05:06'),
(28, 2, 5, '2026-08-18 09:05:09'),
(29, 5, 7, '2026-08-18 11:15:14'),
(30, 5, 6, '2026-08-18 11:15:23'),
(31, 5, 1, '2026-08-18 11:15:25'),
(32, 5, 2, '2026-08-18 11:15:27'),
(33, 5, 3, '2026-08-18 11:15:29'),
(34, 5, 4, '2026-08-18 11:15:32'),
(35, 5, 5, '2026-08-18 11:15:35'),
(36, 5, 8, '2026-08-18 11:56:40'),
(37, 6, 1, '2026-08-18 12:16:15'),
(38, 6, 3, '2026-08-18 12:16:17'),
(39, 6, 7, '2026-08-18 12:16:22'),
(40, 1, 1, '2026-08-18 12:40:32'),
(41, 1, 2, '2026-08-18 12:40:34'),
(42, 1, 3, '2026-08-18 12:40:36'),
(43, 2, 6, '2026-08-18 13:14:14'),
(44, 2, 7, '2026-08-18 13:14:18'),
(45, 2, 8, '2026-08-18 13:14:23'),
(46, 2, 9, '2026-08-18 13:14:27'),
(47, 7, 9, '2026-08-18 13:21:14'),
(48, 7, 1, '2026-08-18 13:21:16'),
(49, 7, 2, '2026-08-18 13:21:17'),
(50, 7, 3, '2026-08-18 13:21:20'),
(51, 7, 4, '2026-08-18 13:21:22'),
(52, 7, 5, '2026-08-18 13:21:24'),
(53, 7, 6, '2026-08-18 13:21:27'),
(54, 7, 7, '2026-08-18 13:21:32'),
(55, 7, 8, '2026-08-18 13:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `savedstories`
--

CREATE TABLE `savedstories` (
  `savedID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `storyID` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedstories`
--

INSERT INTO `savedstories` (`savedID`, `userID`, `storyID`, `created_at`) VALUES
(4, 2, 3, '2026-08-17 17:10:43'),
(5, 3, 1, '2026-08-18 08:21:29'),
(6, 3, 3, '2026-08-18 08:23:09'),
(7, 5, 2, '2026-08-18 11:15:40'),
(8, 5, 4, '2026-08-18 11:15:46'),
(9, 5, 3, '2026-08-18 11:41:30'),
(10, 5, 5, '2026-08-18 11:42:54'),
(11, 5, 1, '2026-08-18 11:46:05'),
(12, 5, 6, '2026-08-18 11:47:46'),
(13, 5, 7, '2026-08-18 11:48:42'),
(14, 6, 1, '2026-08-18 12:16:09'),
(15, 6, 3, '2026-08-18 12:16:11'),
(16, 6, 7, '2026-08-18 12:16:34'),
(17, 2, 1, '2026-08-18 13:14:35'),
(18, 7, 7, '2026-08-18 13:24:04'),
(20, 1, 7, '2026-08-18 16:33:12'),
(21, 1, 6, '2026-08-18 16:33:16'),
(22, 1, 4, '2026-08-18 16:33:21'),
(23, 1, 8, '2026-08-18 16:33:26'),
(25, 1, 1, '2026-08-18 16:40:36'),
(26, 2, 8, '2026-08-18 17:15:20'),
(27, 2, 7, '2026-08-18 17:15:45'),
(28, 7, 3, '2026-08-18 17:42:57'),
(29, 2, 9, '2026-08-18 18:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `StoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `state` enum('pending','approved','denied') DEFAULT 'pending',
  `edited` tinyint(1) DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `genre` set('adventure','dystopian','fantasy','history','horror','mystery','poetry','romance','scifi','thriller') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`StoryID`, `userID`, `state`, `edited`, `title`, `content`, `genre`, `created_at`) VALUES
(1, 1, 'approved', 0, 'Mermaids', 'Swimming. Diving. Splashing. Flying through the water, as if it were air. This is living.', 'fantasy,poetry', '2026-08-17 13:05:29'),
(2, 1, 'approved', 0, 'Vacuum', 'Loud. Please stop! Too loud. Please stop! Breaks silence. Please stop! Breaks focus. Please stop! I beg, thank you.', 'poetry', '2026-08-17 13:13:50'),
(3, 2, 'approved', 0, 'Celeste', 'All the lights in the mall went off. It was pitch black. Standing in the middle of a long hallway I couldn’t hear anything or see anyone. I started to reach for my phone when a single light in front of me turned on. In the distance there’s a spotlight. A woman came into the light, she was breathtakingly beautiful, with her neon blue hair and long black dress swaying as she walked. She looked straight at me and whispered, “I see you.”', 'mystery,scifi', '2026-08-17 15:00:56'),
(4, 3, 'approved', 1, 'What\'s that ticking noise', 'I wake up to the deafening sound of a clock chiming. I get up and walk to town. Everyone stands in rows. We\'re all waiting for instructions. I look up. Flyers rain down from a delivery plane. I grab a flyer. It\'s time to fight.', 'dystopian', '2026-08-18 06:55:26'),
(5, 3, 'approved', 0, 'The cabin', 'The cabin was banging wildly as if it were a living organism, breathing in and out. She heard footsteps outside of the cabin on the wooden deck. A banging sound then came from the door, becoming louder by the second. Suddenly the door flung open and light blasted into the room, almost blinding her. There was something about him that made her trust him immediately. The man then walked over to her and reached out his hand. A flash of light, then the whole thing repeats.', 'fantasy,mystery', '2026-08-18 07:03:17'),
(6, 3, 'approved', 0, 'Dear Mary', 'My visit to San Francisco has turned awry. I was able to escape from the city on the ferry, but it was a grueling experience. There was an earthquake in the early morning. The effects were devastating. Buildings old and new were shaking and the bricks were falling from the buildings like rain. And to make matters worse, a fire quickly engulfed the buildings. It was treacherous to run at times as large chasms and hills were made by the cracks in the road. Thank God I got out.', 'history', '2026-08-18 07:07:20'),
(7, 5, 'approved', 0, 'Jazz', '2wedf?\r\nv vcddfgh  /   gh y\r\nb wergb bhgfdc nj\r\n!!!!!!!!!!!', 'poetry', '2026-08-18 11:14:57'),
(8, 5, 'approved', 0, 'Field work', 'Should we talk about the rainy season and storm Desmond? Building on floodplains should not be allowed. Wear insect repellent and never work alone. Ask permission if needed, before you start your systematic sampling.', 'history', '2026-08-18 11:56:34'),
(9, 1, 'approved', 0, 'Countries I want to visit', 'Germany, Poland, France and Canada sound like interesting places to go. But I don\'t like flying and don\'t have any money. So I\'ll stay happily where I am.', 'adventure', '2026-08-18 12:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `tokengifts`
--

CREATE TABLE `tokengifts` (
  `giftID` int(11) NOT NULL,
  `giftedTo` int(11) NOT NULL,
  `giftedFrom` int(11) NOT NULL,
  `amount` enum('5','10','15','20') DEFAULT '5',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokengifts`
--

INSERT INTO `tokengifts` (`giftID`, `giftedTo`, `giftedFrom`, `amount`, `created_at`) VALUES
(9, 1, 5, '5', '2026-08-18 11:56:46'),
(10, 1, 6, '15', '2026-08-18 12:34:58'),
(11, 5, 7, '20', '2026-08-18 13:21:49'),
(12, 1, 7, '20', '2026-08-18 13:21:54'),
(13, 1, 7, '5', '2026-08-18 13:21:59'),
(14, 2, 7, '5', '2026-08-18 17:42:54'),
(15, 2, 6, '10', '2026-08-18 17:44:05'),
(16, 1, 2, '10', '2026-08-18 18:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `role` enum('guest','admin','reader','writer') DEFAULT 'guest',
  `tokens` int(1) DEFAULT NULL,
  `profileImg` varchar(255) DEFAULT 'profile.jpg',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `email`, `passwordHash`, `role`, `tokens`, `profileImg`, `created_at`) VALUES
(1, 'Amy', 'amy@gmail.com', '$2y$10$bN3R2yA1W3ECW06E9f7DMuxPAC/tEha/uSPLYRfLjrLtZLz2bewfS', 'writer', 70, '6a82cea60f98f.jpg', '2026-08-17 11:04:38'),
(2, 'WinterLikesWriting', 'winter@gmail.com', '$2y$10$bH5q3Vdv6o/r0CG20TRaQek5NCHhpyWxEzuExTU4LzK8mUUdG1yuO', 'writer', 20, '6a83058e336e5.png', '2026-08-17 14:58:54'),
(3, 'TheSharpest', 'sharp@gmail.com', '$2y$10$.shkePr4X23iaGB1tpQMrOlt0uUXW5G7PgqKb.dc6YGOByGlne5Yi', 'writer', 5, '6a83e34acfc91.png', '2026-08-18 06:44:59'),
(4, 'Notebook', 'notebook@gmail.con', '$2y$10$XagaC7GhEe9TJrr614hND.AQuGll3XoAzJjSR43hr12uOwxqu.ewe', 'writer', 0, '6a8421e9cb5b5.png', '2026-08-18 11:12:09'),
(5, 'Harry\'s Notebook', 'harry@gmail.com', '$2y$10$ycK7QsxqL2JMfAtW5DKZAerGDEzFRtdIk9DXgXNCuxJWdIiW70FmC', 'writer', 20, '6a842241941e8.png', '2026-08-18 11:13:37'),
(6, 'ElsaLovesReading', 'elsa@gmail.com', '$2y$10$nWrpMOQfGki5seHRTlLcReKUNW6kmnHP9MNcFaRt9tXJwRoZ/4k7e', 'reader', 5, '6a84304ddada1.png', '2026-08-18 12:13:33'),
(7, 'Administrator', 'admin@gmail.com', '$2y$10$Wy4CpnDD6m5Ix8vmNCWDZ.bbKvOoSiOMvU10eq2qyOfOPvkLVebYy', 'admin', 5, '6a843a21261cd.png', '2026-08-18 12:55:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`followID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `followerID` (`followerID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likedID`),
  ADD KEY `storyID` (`storyID`),
  ADD KEY `likes_ibfk_1` (`userID`);

--
-- Indexes for table `savedstories`
--
ALTER TABLE `savedstories`
  ADD PRIMARY KEY (`savedID`),
  ADD KEY `storyID` (`storyID`),
  ADD KEY `savedstories_ibfk_1` (`userID`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`StoryID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tokengifts`
--
ALTER TABLE `tokengifts`
  ADD PRIMARY KEY (`giftID`),
  ADD KEY `tokengifts_ibfk_1` (`giftedTo`),
  ADD KEY `tokengifts_ibfk_2` (`giftedFrom`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `followID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `savedstories`
--
ALTER TABLE `savedstories`
  MODIFY `savedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `StoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tokengifts`
--
ALTER TABLE `tokengifts`
  MODIFY `giftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followerID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`storyID`) REFERENCES `story` (`StoryID`);

--
-- Constraints for table `savedstories`
--
ALTER TABLE `savedstories`
  ADD CONSTRAINT `savedstories_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `savedstories_ibfk_2` FOREIGN KEY (`storyID`) REFERENCES `story` (`StoryID`);

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `story_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `tokengifts`
--
ALTER TABLE `tokengifts`
  ADD CONSTRAINT `tokengifts_ibfk_1` FOREIGN KEY (`giftedTo`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tokengifts_ibfk_2` FOREIGN KEY (`giftedFrom`) REFERENCES `users` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
