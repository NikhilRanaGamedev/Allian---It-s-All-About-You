-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2019 at 12:17 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allian`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `get_user_info`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_info` (IN `id` INT)  SELECT * FROM user_info where user_id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_settings`
--

DROP TABLE IF EXISTS `account_settings`;
CREATE TABLE IF NOT EXISTS `account_settings` (
  `user_id` int(11) NOT NULL,
  `enable_follow_me` tinyint(1) DEFAULT NULL,
  `send_me_notifications` tinyint(1) DEFAULT NULL,
  `text_messages` tinyint(1) DEFAULT NULL,
  `enable_tagging` tinyint(1) DEFAULT NULL,
  `enable_sound` tinyint(1) DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_settings`
--

INSERT INTO `account_settings` (`user_id`, `enable_follow_me`, `send_me_notifications`, `text_messages`, `enable_tagging`, `enable_sound`) VALUES
(1, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `education_info`
--

DROP TABLE IF EXISTS `education_info`;
CREATE TABLE IF NOT EXISTS `education_info` (
  `user_id` int(11) NOT NULL,
  `education_university` varchar(50) DEFAULT NULL,
  `education_from` int(11) DEFAULT NULL,
  `education_to` int(11) DEFAULT NULL,
  `education_description` varchar(100) DEFAULT NULL,
  `graduated` tinyint(1) DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_info`
--

INSERT INTO `education_info` (`user_id`, `education_university`, `education_from`, `education_to`, `education_description`, `graduated`) VALUES
(1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `city` varchar(58) DEFAULT NULL,
  `country` varchar(74) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `profile_cover` varchar(200) DEFAULT NULL,
  `about_me` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `dob`, `gender`, `city`, `country`, `profile_pic`, `profile_cover`, `about_me`) VALUES
(1, 'Nikhil', 'Rana', 'nightpredetor@gmail.com', 'Nikhiliscool123', '1999-03-22', 'male', 'New Delhi', 'India', 'images/profile.png', 'images/cover.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE IF NOT EXISTS `user_interests` (
  `interests_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `interest` varchar(15) NOT NULL,
  PRIMARY KEY (`interests_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`interests_id`, `user_id`, `interest`) VALUES
(1, 1, 'Drinking');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

DROP TABLE IF EXISTS `user_posts`;
CREATE TABLE IF NOT EXISTS `user_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `post_msg` varchar(200) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_info`
--

DROP TABLE IF EXISTS `work_info`;
CREATE TABLE IF NOT EXISTS `work_info` (
  `user_id` int(11) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_designation` varchar(50) DEFAULT NULL,
  `company_from` int(11) DEFAULT NULL,
  `company_to` int(11) DEFAULT NULL,
  `company_place` varchar(50) DEFAULT NULL,
  `company_description` varchar(100) DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_info`
--

INSERT INTO `work_info` (`user_id`, `company_name`, `company_designation`, `company_from`, `company_to`, `company_place`, `company_description`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_settings`
--
ALTER TABLE `account_settings`
  ADD CONSTRAINT `account_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education_info`
--
ALTER TABLE `education_info`
  ADD CONSTRAINT `education_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD CONSTRAINT `user_interests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `user_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_info`
--
ALTER TABLE `work_info`
  ADD CONSTRAINT `work_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
