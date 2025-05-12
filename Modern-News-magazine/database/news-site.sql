-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 09, 2025 at 07:24 PM
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
-- Database: `news-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(46, 'Jobs', 1),
(45, 'political ', 1),
(44, 'Sports', 2),
(42, 'Business', 1),
(43, 'Entertainment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(65, 'Jobs Openings', 'Join our growing team and be part of a dynamic, innovative, and supportive work environment. We are currently looking for passionate and dedicated individuals to fill several exciting job openings across various departments. If you\'re ready to take the next step in your career, we’d love to hear from you!', '46', '09 May, 2025', 53, 'img3.jpg'),
(66, 'Mumbai Won by 2 run', 'In a nail-biting finish, Mumbai clinched a dramatic victory by just 2 runs, showcasing nerves of steel in the final overs. With tight bowling and sharp fielding under pressure, the team held their ground against a determined opposition. The match kept fans on the edge of their seats till the very last ball, sealing Mumbai\'s win in spectacular fashion.', '44', '09 May, 2025', 53, '1746803386-mumbai.jpg'),
(67, 'Controversy Over \"Operation Sindoor\" Trademark', 'Mukesh Ambani\'s Reliance Industries faced public backlash after its film studio, Jio Studios, filed a trademark application for \"Operation Sindoor,\" the codename for recent Indian military strikes on Pakistan. The application was withdrawn following criticism that it was insensitive and exploitative. Reliance stated that the filing was made without proper authorization by a junior employee', '42', '09 May, 2025', 52, 'Mukesh_Ambani.jpg'),
(69, 'Lilo & Stitch Live-Action Remake', 'Lilo & Stitch Live-Action Remake: Disney\'s live-action adaptation of Lilo & Stitch, directed by Dean Fleischer Camp, is set for release on May 23, 2025. The film stars Maia Kealoha as Lilo and features original voice actor Chris Sanders as Stitch. The soundtrack includes classic Elvis Presley songs and a new version of \"Hawaiian Roller Coaster Ride\" by Iam Tongi. \r\nWikipedi', '43', '09 May, 2025', 52, '1746803227-e62778a553a468d82b3cba590b4276a4.jpg'),
(70, 'Pakistan’s role in the War on Terror post-9/11?', 'The Pakistan-India War of 1971 was a major military conflict between India and Pakistan that resulted in the creation of the independent nation of Bangladesh. The war stemmed from political and ethnic tensions in East Pakistan (now Bangladesh), where the majority Bengali population sought autonomy and later independence from West Pakistan (present-day Pakistan). Following widespread human rights abuses and a brutal military crackdown by the Pakistani army in East Pakistan, millions of refugees fled to neighboring India, escalating tensions. India intervened militarily in December 1971, leading to a swift and decisive', '45', '09 May, 2025', 52, '1746803333-img.jpg.jpg'),
(71, 'The Indian Premier League (IPL) 2025 has been temporarily suspended', 'The Indian Premier League (IPL) 2025 has been temporarily suspended for one week due to escalating military tensions between India and Pakistan. The Board of Control for Cricket in India (BCCI) announced the suspension on May 9, 2025, with plans to reassess the situation and release a revised schedule in due course', '44', '09 May, 2025', 52, 'mumbai.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(57, 'Ram', 'Patel', 'Ram', '202cb962ac59075b964b07152d234b70', 0),
(58, 'Ajinkya', 'Deshmukh', 'Ajin', '202cb962ac59075b964b07152d234b70', 1),
(59, 'Adarsh', 'Pingale', 'Adi', '202cb962ac59075b964b07152d234b70', 0),
(60, 'Admin', 'Admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(56, 'Sohel', 'Pandey', 'Sohel', '202cb962ac59075b964b07152d234b70', 1),
(52, 'Adarsh', 'Pingale', 'Adarsh', '202cb962ac59075b964b07152d234b70', 1),
(53, 'Parvej', 'Patel', 'Parvej', '202cb962ac59075b964b07152d234b70', 0),
(54, 'Sagar', 'Shukla', 'Sagar', '202cb962ac59075b964b07152d234b70', 0),
(55, 'Jay', 'Toheb', 'Jay', '202cb962ac59075b964b07152d234b70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
