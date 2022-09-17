-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2022 at 09:28 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greentube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Travel & Events'),
(7, 'Gaming'),
(8, 'People & Blogs'),
(9, 'Comedy'),
(10, 'Entertainment'),
(11, 'News & Politics'),
(12, 'Howto & Style'),
(13, 'Education'),
(14, 'Science & Technology'),
(15, 'Nonprofits & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `postedBy` int(11) NOT NULL,
  `videoId` int(11) NOT NULL DEFAULT '0',
  `responseTo` int(11) NOT NULL DEFAULT '0',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `datePosted` datetime NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 1, 2, 0, 'great', '2022-08-26 11:35:29'),
(2, 2, 2, 0, 'cool', '2022-08-27 09:32:42'),
(3, 1, 2, 1, 'ok', '2022-08-27 12:24:04'),
(4, 2, 4, 0, 'nice', '2022-08-30 11:22:08'),
(5, 2, 4, 0, 'ok', '2022-08-30 11:24:09'),
(6, 1, 3, 0, 'nice', '2022-09-01 07:37:20'),
(7, 1, 4, 4, 'tx', '2022-09-06 07:30:34'),
(8, 1, 4, 5, 'kkf', '2022-09-06 07:46:32'),
(9, 1, 4, 5, 'jkrkf', '2022-09-06 07:47:46'),
(10, 1, 4, 5, 'fff', '2022-09-06 07:48:29'),
(12, 1, 4, 4, 'aaa', '2022-09-06 07:56:15'),
(13, 1, 4, 4, 'ffgg', '2022-09-06 07:56:36'),
(14, 1, 3, 6, 'hh', '2022-09-06 08:31:37'),
(15, 1, 0, 5, 'lld', '2022-09-06 11:07:28'),
(16, 1, 4, 5, 'jdhdaaa', '2022-09-06 11:10:23'),
(17, 1, 4, 5, 'aaaaa', '2022-09-06 11:11:41'),
(18, 1, 4, 5, 'qq', '2022-09-06 11:26:05'),
(19, 1, 4, 4, 'rrr', '2022-09-06 11:26:52'),
(20, 1, 2, 2, 'hh', '2022-09-06 11:35:18'),
(21, 1, 3, 0, 'gg', '2022-09-07 12:36:45'),
(22, 1, 3, 0, 'aa', '2022-09-07 12:37:39'),
(23, 1, 3, 22, 'gg', '2022-09-07 12:37:57'),
(24, 1, 3, 22, 'qq', '2022-09-07 12:39:25'),
(25, 1, 3, 22, 'rr', '2022-09-07 12:40:01'),
(26, 4, 3, 0, 'cool', '2022-09-08 08:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `dislikeId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `commentId` int(11) DEFAULT NULL,
  `videoId` int(11) DEFAULT NULL,
  PRIMARY KEY (`dislikeId`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`dislikeId`, `userId`, `commentId`, `videoId`) VALUES
(14, 2, 1, NULL),
(31, 2, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `likeId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL DEFAULT '0',
  `videoId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`likeId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeId`, `userId`, `commentId`, `videoId`) VALUES
(1, 1, 0, 2),
(2, 1, 2, 0),
(3, 1, 0, 4),
(4, 1, 0, 3),
(5, 2, 0, 4),
(6, 4, 0, 3),
(7, 4, 23, 0),
(8, 1, 0, 5),
(9, 4, 0, 1),
(10, 3, 0, 37);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `subId` int(11) NOT NULL AUTO_INCREMENT,
  `userToId` int(11) NOT NULL,
  `userFromId` int(11) NOT NULL,
  PRIMARY KEY (`subId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`subId`, `userToId`, `userFromId`) VALUES
(10, 2, 1),
(4, 1, 2),
(9, 3, 1),
(12, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tagId` int(11) NOT NULL AUTO_INCREMENT,
  `tagName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `videoId` int(11) NOT NULL,
  PRIMARY KEY (`tagId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `videoId`) VALUES
(17, 'ocean', 1),
(16, 'fish', 1),
(19, 'wood', 2),
(18, 'bear', 2),
(5, 'island', 3),
(6, 'wood', 4),
(7, 'car', 4),
(8, 'ocean', 5),
(9, 'beach', 5),
(20, 'ocean', 8),
(21, 'surfing', 9),
(22, 'ocean', 9);

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

DROP TABLE IF EXISTS `thumbnails`;
CREATE TABLE IF NOT EXISTS `thumbnails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videoId` int(11) NOT NULL,
  `filePath` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `selected` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoId`, `filePath`, `selected`) VALUES
(1, 1, 'uploads/videos/thumbnails/1-62e64d627e7fb.jpg', 0),
(2, 1, 'uploads/videos/thumbnails/1-62e64d62e1394.jpg', 1),
(3, 1, 'uploads/videos/thumbnails/1-62e64d6395b10.jpg', 0),
(4, 2, 'uploads/videos/thumbnails/2-62e663635a82e.jpg', 0),
(5, 2, 'uploads/videos/thumbnails/2-62e663648bea6.jpg', 0),
(6, 2, 'uploads/videos/thumbnails/2-62e663668a3b7.jpg', 1),
(7, 3, 'uploads/videos/thumbnails/3-62e6bc49d8436.jpg', 1),
(8, 3, 'uploads/videos/thumbnails/3-62e6bc4bd7535.jpg', 0),
(9, 3, 'uploads/videos/thumbnails/3-62e6bc4f8fb87.jpg', 0),
(10, 4, 'uploads/videos/thumbnails/4-62e6c2e6f2490.jpg', 1),
(11, 4, 'uploads/videos/thumbnails/4-62e6c2e7da451.jpg', 0),
(12, 4, 'uploads/videos/thumbnails/4-62e6c2e96b5ed.jpg', 0),
(13, 5, 'uploads/videos/thumbnails/5-6319ac398da81.jpg', 1),
(14, 5, 'uploads/videos/thumbnails/5-6319ac39bdc79.jpg', 0),
(15, 5, 'uploads/videos/thumbnails/5-6319ac3a007dd.jpg', 0),
(16, 6, 'uploads/videos/thumbnails/6-6321e18793ae1.jpg', 1),
(17, 6, 'uploads/videos/thumbnails/6-6321e188d38b3.jpg', 0),
(18, 6, 'uploads/videos/thumbnails/6-6321e18ae490e.jpg', 0),
(19, 7, 'uploads/videos/thumbnails/7-6321e20a9e600.jpg', 0),
(20, 7, 'uploads/videos/thumbnails/7-6321e20b43a15.jpg', 0),
(21, 7, 'uploads/videos/thumbnails/7-6321e20c324af.jpg', 1),
(22, 8, 'uploads/videos/thumbnails/8-6321e39f97960.jpg', 1),
(23, 8, 'uploads/videos/thumbnails/8-6321e3a0d02a6.jpg', 0),
(24, 8, 'uploads/videos/thumbnails/8-6321e3a30e6eb.jpg', 0),
(25, 9, 'uploads/videos/thumbnails/9-6321e56667993.jpg', 1),
(26, 9, 'uploads/videos/thumbnails/9-6321e5688f2ad.jpg', 0),
(27, 9, 'uploads/videos/thumbnails/9-6321e56cf1a41.jpg', 0),
(28, 10, 'uploads/videos/thumbnails/10-6322d8352fb2d.jpg', 1),
(29, 10, 'uploads/videos/thumbnails/10-6322d8361b5f8.jpg', 0),
(30, 10, 'uploads/videos/thumbnails/10-6322d837bafb1.jpg', 0),
(31, 11, 'uploads/videos/thumbnails/11-6322d95646df6.jpg', 1),
(32, 11, 'uploads/videos/thumbnails/11-6322d9599b498.jpg', 0),
(33, 11, 'uploads/videos/thumbnails/11-6322d9604603e.jpg', 0),
(34, 12, 'uploads/videos/thumbnails/12-6322d9e6e5ee4.jpg', 1),
(35, 12, 'uploads/videos/thumbnails/12-6322d9e749a84.jpg', 0),
(36, 12, 'uploads/videos/thumbnails/12-6322d9e7ca190.jpg', 0),
(37, 13, 'uploads/videos/thumbnails/13-6322da48c92ec.jpg', 1),
(38, 13, 'uploads/videos/thumbnails/13-6322da496b8f2.jpg', 0),
(39, 13, 'uploads/videos/thumbnails/13-6322da4a8e323.jpg', 0),
(40, 14, 'uploads/videos/thumbnails/14-6322dab7bf475.jpg', 1),
(41, 14, 'uploads/videos/thumbnails/14-6322dab8702e0.jpg', 0),
(42, 14, 'uploads/videos/thumbnails/14-6322dab9968ca.jpg', 0),
(43, 15, 'uploads/videos/thumbnails/15-6322db606d550.jpg', 1),
(44, 15, 'uploads/videos/thumbnails/15-6322db610842d.jpg', 0),
(45, 15, 'uploads/videos/thumbnails/15-6322db61ebc82.jpg', 0),
(46, 16, 'uploads/videos/thumbnails/16-6322dc120abb4.jpg', 1),
(47, 16, 'uploads/videos/thumbnails/16-6322dc1292828.jpg', 0),
(48, 16, 'uploads/videos/thumbnails/16-6322dc135d2a3.jpg', 0),
(49, 17, 'uploads/videos/thumbnails/17-6322dcb0e1bcb.jpg', 1),
(50, 17, 'uploads/videos/thumbnails/17-6322dcb19a58c.jpg', 0),
(51, 17, 'uploads/videos/thumbnails/17-6322dcb2cc137.jpg', 0),
(52, 18, 'uploads/videos/thumbnails/18-6322dd136b034.jpg', 1),
(53, 18, 'uploads/videos/thumbnails/18-6322dd140d340.jpg', 0),
(54, 18, 'uploads/videos/thumbnails/18-6322dd150b075.jpg', 0),
(55, 19, 'uploads/videos/thumbnails/19-6322dda57f4c9.jpg', 1),
(56, 19, 'uploads/videos/thumbnails/19-6322dda76c617.jpg', 0),
(57, 19, 'uploads/videos/thumbnails/19-6322ddaaf0f94.jpg', 0),
(58, 20, 'uploads/videos/thumbnails/20-6322de2ee7532.jpg', 1),
(59, 20, 'uploads/videos/thumbnails/20-6322de2fa531e.jpg', 0),
(60, 20, 'uploads/videos/thumbnails/20-6322de30ebedf.jpg', 0),
(61, 21, 'uploads/videos/thumbnails/21-6322df0f0caf8.jpg', 1),
(62, 21, 'uploads/videos/thumbnails/21-6322df0fa33a2.jpg', 0),
(63, 21, 'uploads/videos/thumbnails/21-6322df10a4cdb.jpg', 0),
(64, 22, 'uploads/videos/thumbnails/22-6322dff70081e.jpg', 1),
(65, 22, 'uploads/videos/thumbnails/22-6322dff864e2f.jpg', 0),
(66, 22, 'uploads/videos/thumbnails/22-6322dffaef1bf.jpg', 0),
(67, 23, 'uploads/videos/thumbnails/23-6322e0aa87960.jpg', 1),
(68, 23, 'uploads/videos/thumbnails/23-6322e0ab34c01.jpg', 0),
(69, 23, 'uploads/videos/thumbnails/23-6322e0ac56e89.jpg', 0),
(70, 24, 'uploads/videos/thumbnails/24-6322e0fcee29b.jpg', 1),
(71, 24, 'uploads/videos/thumbnails/24-6322e0fda2ebf.jpg', 0),
(72, 24, 'uploads/videos/thumbnails/24-6322e0fed056e.jpg', 0),
(73, 25, 'uploads/videos/thumbnails/25-6322e18aac109.jpg', 1),
(74, 25, 'uploads/videos/thumbnails/25-6322e18b38738.jpg', 0),
(75, 25, 'uploads/videos/thumbnails/25-6322e18c156d0.jpg', 0),
(76, 26, 'uploads/videos/thumbnails/26-6322e1ca6c585.jpg', 1),
(77, 26, 'uploads/videos/thumbnails/26-6322e1cac81a7.jpg', 0),
(78, 26, 'uploads/videos/thumbnails/26-6322e1cb5bdb8.jpg', 0),
(79, 27, 'uploads/videos/thumbnails/27-6322e22f40d1b.jpg', 1),
(80, 27, 'uploads/videos/thumbnails/27-6322e22fd3a08.jpg', 0),
(81, 27, 'uploads/videos/thumbnails/27-6322e230dcdd5.jpg', 0),
(82, 28, 'uploads/videos/thumbnails/28-6322e27ee6cd1.jpg', 1),
(83, 28, 'uploads/videos/thumbnails/28-6322e27fb1a09.jpg', 0),
(84, 28, 'uploads/videos/thumbnails/28-6322e28108d1e.jpg', 0),
(85, 29, 'uploads/videos/thumbnails/29-6322e312b682b.jpg', 1),
(86, 29, 'uploads/videos/thumbnails/29-6322e314409af.jpg', 0),
(87, 29, 'uploads/videos/thumbnails/29-6322e316e84ba.jpg', 0),
(88, 30, 'uploads/videos/thumbnails/30-6322e3605596b.jpg', 1),
(89, 30, 'uploads/videos/thumbnails/30-6322e360b8ac2.jpg', 0),
(90, 30, 'uploads/videos/thumbnails/30-6322e3616172c.jpg', 0),
(91, 31, 'uploads/videos/thumbnails/31-6322e42286d1e.jpg', 1),
(92, 31, 'uploads/videos/thumbnails/31-6322e423ad0ca.jpg', 0),
(93, 31, 'uploads/videos/thumbnails/31-6322e425ba9ea.jpg', 0),
(94, 32, 'uploads/videos/thumbnails/32-6322e475ce330.jpg', 0),
(95, 32, 'uploads/videos/thumbnails/32-6322e4769fecc.jpg', 1),
(96, 32, 'uploads/videos/thumbnails/32-6322e477f28db.jpg', 0),
(97, 33, 'uploads/videos/thumbnails/33-6322e5385721e.jpg', 1),
(98, 33, 'uploads/videos/thumbnails/33-6322e539bf0ec.jpg', 0),
(99, 33, 'uploads/videos/thumbnails/33-6322e53c25d24.jpg', 0),
(100, 34, 'uploads/videos/thumbnails/34-6322e59f786ba.jpg', 1),
(101, 34, 'uploads/videos/thumbnails/34-6322e59fe2ad6.jpg', 0),
(102, 34, 'uploads/videos/thumbnails/34-6322e5a0974de.jpg', 0),
(103, 35, 'uploads/videos/thumbnails/35-6322e608c427c.jpg', 1),
(104, 35, 'uploads/videos/thumbnails/35-6322e6092bf67.jpg', 0),
(105, 35, 'uploads/videos/thumbnails/35-6322e609b037e.jpg', 0),
(106, 36, 'uploads/videos/thumbnails/36-6322e6534cd3f.jpg', 1),
(107, 36, 'uploads/videos/thumbnails/36-6322e653bad1d.jpg', 0),
(108, 36, 'uploads/videos/thumbnails/36-6322e6547340f.jpg', 0),
(109, 37, 'uploads/videos/thumbnails/37-6322e9595bcd3.jpg', 1),
(110, 37, 'uploads/videos/thumbnails/37-6322e95a38acc.jpg', 0),
(111, 37, 'uploads/videos/thumbnails/37-6322e95bb32cb.jpg', 0),
(112, 38, 'uploads/videos/thumbnails/38-6322e9ce7c40f.jpg', 1),
(113, 38, 'uploads/videos/thumbnails/38-6322e9cf382be.jpg', 0),
(114, 38, 'uploads/videos/thumbnails/38-6322e9d06595d.jpg', 0),
(115, 39, 'uploads/videos/thumbnails/39-6322ea4f2b629.jpg', 1),
(116, 39, 'uploads/videos/thumbnails/39-6322ea5097051.jpg', 0),
(117, 39, 'uploads/videos/thumbnails/39-6322ea52f17e9.jpg', 0),
(118, 40, 'uploads/videos/thumbnails/40-6322eb413daf3.jpg', 1),
(119, 40, 'uploads/videos/thumbnails/40-6322eb425c17c.jpg', 0),
(120, 40, 'uploads/videos/thumbnails/40-6322eb4466245.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` text COLLATE utf8_unicode_ci NOT NULL,
  `coverPic` text COLLATE utf8_unicode_ci NOT NULL,
  `channelDesc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`, `coverPic`, `channelDesc`) VALUES
(1, 'Stefan', 'SimonoviÄ‡', 'sajmon', 'stefan.sajmon@gmail.com', '$2y$10$7kScFI56vh1uXg1DHDZey.ujnPIr9fY78o.BS/lOErya5x9zpZGTS', '2022-07-25 11:51:51', '/assets/images/profilePictures/1-631b396c759d4.jpeg', '/assets/images/coverPhotos/1-631edeb7bcbb9.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pharetra, risus nec maximus semper, tellus leo condimentum orci, sed dignissim ex turpis ut nisi. Fusce sit amet gravida tortor, eget commodo diam. Suspendisse potenti. Quisque efficitur sollicitudin varius. Aenean vel risus vel sem pulvinar auctor id nec leo. Praesent ac mi purus. Proin a lacus eget orci dictum tristique non quis dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam eros purus, gravida sit amet augue nec, tristique feugiat dui. Sed consequat felis sed felis venenatis sagittis. Pellentesque purus orci, maximus sit amet odio sit amet, vestibulum rhoncus magna. Aliquam elit eros, mattis ac mi et, elementum accumsan eros. Vivamus ac fermentum quam.'),
(2, 'Pera', 'Peric', 'perica', 'pera@gmail.com', '$2y$10$WFcxC4HpRdqYo0uueHcRKODJ5eB1zp0.mxO5ux1RbYTN7fFg8Anve', '2022-07-28 06:25:25', '/assets/images/profilePictures/defaults/head_belize_hole.png', '/assets/images/coverPhotos/2-631edf1be6f3a.jpg', NULL),
(3, 'Demo', 'Demo', 'demo1', 'demo@gmail.com', '$2y$10$3PDGC1fRnCSLIXwWC.YM2O4Y47qTybPsX1uYtBAeTVE3I8QdotVGq', '2022-07-31 17:54:57', '/assets/images/profilePictures/3-631ee0264ea57.jpeg', '/assets/images/coverPhotos/3-631edf528fc82.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacinia est in nulla fringilla lobortis. Suspendisse semper, enim nec volutpat imperdiet, nunc velit ornare orci, nec convallis neque libero vitae nibh. In lobortis ipsum eu risus convallis, sit amet dictum augue pretium. Cras volutpat purus non sem tempor iaculis. Etiam malesuada, velit sit amet tempor varius, ante erat pellentesque justo, non hendrerit turpis risus in quam. Aliquam porttitor nisi et dui pretium dignissim. Nam eleifend blandit nibh in viverra. Proin euismod at enim quis pretium. Duis lorem sem, tristique ullamcorper bibendum eget, hendrerit vel dui. Nam sed felis quis mauris tristique fringilla id at felis. Proin sollicitudin libero urna, vel volutpat nibh bibendum eget. Vivamus et nunc eros. '),
(4, 'Jhon', 'Doe', 'Test1', 'test@gmail.com', '$2y$10$T3Q7u4mYxYsHVs5m1SlsseNjk/p6wUO71Q7PF9kSE1wIg0Gqr.wDi', '2022-09-07 12:06:55', '/assets/images/profilePictures/defaults/head_turqoise.png', '/assets/images/coverPhotos/4-631ee14d70f75.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `videoId` int(11) NOT NULL AUTO_INCREMENT,
  `uploadedBy` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `privacy` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `filePath` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `uploadDate` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `duration` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`videoId`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`videoId`, `uploadedBy`, `title`, `description`, `category`, `privacy`, `comments`, `filePath`, `uploadDate`, `views`, `duration`) VALUES
(1, 1, 'Blue Ocean', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse placerat urna ac massa commodo, ac euismod magna lacinia. Pellentesque porttitor elementum diam. Nullam in ex sit amet tortor auctor consequat. Vestibulum sed vestibulum sapien, nec commodo massa. Maecenas lacinia suscipit nibh vel dapibus. Sed sodales felis velit, vel condimentum tellus tincidunt vitae. In lacinia enim at neque lacinia cursus. Nam rutrum risus nec arcu imperdiet congue.', 6, 0, 0, 'uploads/videos/62e64d565e34c.mp4', '2022-07-31 09:37:26', 1500, '00:46'),
(6, 1, 'Bridge', 'some bridge', 6, 0, 1, 'uploads/videos/6321e16c3308f.mp4', '2022-09-14 14:13:00', 3, '00:30'),
(7, 1, 'Waterfall', 'Beautiful waterfall', 6, 0, 1, 'uploads/videos/6321e1fdc0103.mp4', '2022-09-14 14:15:25', 21, '00:12'),
(2, 2, 'Bear in the woods', 'find a bear in the woods', 4, 0, 1, 'uploads/videos/62e6633a11ad7.mp4', '2022-07-21 11:10:50', 323, '00:27'),
(3, 2, 'Vacation on the island', 'Far far away, behind the word mountains, far from the countries', 6, 0, 1, 'uploads/videos/62e6bc0759d71.mp4', '2022-07-29 17:29:43', 2230, '00:48'),
(4, 3, 'Car in the wood', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sit amet quam sem. Aliquam condimentum interdum arcu sit amet vehicula. Cras quis iaculis velit, dapibus faucibus massa. In ut feugiat lorem. Nullam pharetra suscipit efficitur. Proin finibus dolor vestibulum sapien mollis maximus. Donec vel nunc sit amet purus suscipit condimentum eu quis velit. Curabitur semper elit eget neque sagittis, et fermentum nibh condimentum.\n\nPellentesque venenatis nisi elit, vel egestas ipsum tempus ac. Mauris efficitur egestas porttitor. Aliquam nisl neque, auctor at egestas ut, ullamcorper vel leo. Proin a lorem et lorem venenatis eleifend et non ex. Integer tristique neque et orci varius, efficitur aliquam neque imperdiet. Maecenas et eleifend diam. Praesent volutpat consequat vestibulum. Integer finibus tellus velit, eget mattis mi ultrices id. Mauris scelerisque eu augue ac volutpat. Suspendisse bibendum a leo ac ultricies. Quisque pellentesque lectus orci, quis maximus neque ultricies quis. Pellentesque ac elit ornare, blandit diam id, sollicitudin diam.', 2, 0, 1, 'uploads/videos/62e6c2c28a557.mp4', '2022-08-31 17:58:26', 1307, '00:21'),
(5, 4, 'Women on the beach', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus odio nulla, aliquet sit amet purus sed, interdum ullamcorper dui. In massa diam, ultricies et est non, posuere congue metus. Nulla hendrerit, diam in tempus consectetur, ipsum nulla eleifend ligula, sit amet molestie metus purus at arcu', 6, 0, 1, 'uploads/videos/6319ac37160e5.mp4', '2022-09-08 08:47:51', 11, '00:13'),
(8, 1, 'Rock in the ocean', 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.\r\n\r\nI am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When, while the lovely valley teems with', 6, 0, 0, 'uploads/videos/6321e37ac6e84.mp4', '2022-09-14 14:21:46', 2, '00:28'),
(9, 1, 'Surfing in ocean', 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.', 5, 0, 1, 'uploads/videos/6321e51997059.mp4', '2022-09-14 14:28:41', 4, '03:03'),
(10, 2, 'Cartoon', 'Rabbit cartoon', 1, 0, 1, 'uploads/videos/6322d82075d93.mp4', '2022-09-15 07:45:36', 4, '00:54'),
(11, 2, 'Cars', 'Cars on street are moving', 2, 0, 1, 'uploads/videos/6322d8d466d49.mp4', '2022-09-15 07:48:36', 1, '01:00'),
(12, 2, 'Animation in water', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 1, 0, 0, 'uploads/videos/6322d9e14b2bf.mp4', '2022-09-15 07:53:05', 3, '00:06'),
(13, 2, 'Lake', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322da3a73757.mp4', '2022-09-15 07:54:34', 4, '00:11'),
(14, 2, 'Dog is playing', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 4, 0, 1, 'uploads/videos/6322daa0c6702.mp4', '2022-09-15 07:56:16', 3, '00:17'),
(15, 2, 'Football game', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 5, 0, 1, 'uploads/videos/6322db5183652.mp4', '2022-09-15 07:59:13', 2, '00:12'),
(16, 2, 'Man running on beach', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 5, 0, 1, 'uploads/videos/6322dc01433ae.mp4', '2022-09-15 08:02:09', 2, '00:12'),
(17, 4, 'Ride a bike', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322dc94a6710.mp4', '2022-09-15 08:04:36', 3, '00:15'),
(18, 4, 'The road to Cappadocia', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322dd03eaba8.mp4', '2022-09-15 08:06:27', 15, '00:19'),
(19, 4, 'Luna Park', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 10, 0, 1, 'uploads/videos/6322dd69abb08.mp4', '2022-09-15 08:08:09', 1, '00:37'),
(20, 4, 'Playing games on mobile', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 7, 0, 1, 'uploads/videos/6322de1713fb1.mp4', '2022-09-15 08:11:03', 0, '00:20'),
(21, 4, 'Classroom', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 13, 0, 0, 'uploads/videos/6322defc07093.mp4', '2022-09-15 08:14:52', 0, '00:12'),
(22, 4, 'Girl wearing a jacket', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 12, 0, 1, 'uploads/videos/6322dfc846ec5.mp4', '2022-09-15 08:18:16', 2, '00:30'),
(23, 4, 'Protest', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 11, 0, 1, 'uploads/videos/6322e0978d97c.mp4', '2022-09-15 08:21:43', 2, '00:18'),
(24, 4, 'DNK', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 14, 0, 1, 'uploads/videos/6322e0eb2e7fd.mp4', '2022-09-15 08:23:07', 3, '00:24'),
(25, 3, 'Party in nightclub', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 0, 'uploads/videos/6322e1739345d.mp4', '2022-09-15 08:25:23', 1, '00:12'),
(26, 3, 'Playing games on the computer', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 7, 0, 1, 'uploads/videos/6322e1c23575d.mp4', '2022-09-15 08:26:42', 0, '00:06'),
(27, 3, 'Reading a book', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 13, 0, 1, 'uploads/videos/6322e2141e8ec.mp4', '2022-09-15 08:28:04', 0, '00:15'),
(28, 3, 'Students in the classroom', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 13, 0, 0, 'uploads/videos/6322e269315fa.mp4', '2022-09-15 08:29:29', 0, '00:25'),
(29, 3, 'Alseace festival', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322e2e14a9df.mp4', '2022-09-15 08:31:29', 5, '00:37'),
(30, 3, 'Vote', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 11, 0, 0, 'uploads/videos/6322e3563e6a4.mp4', '2022-09-15 08:33:26', 1, '00:09'),
(31, 3, 'Activism', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 15, 0, 0, 'uploads/videos/6322e3f7beb98.mp4', '2022-09-15 08:36:07', 0, '00:37'),
(32, 3, 'Reading a newspaper', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 11, 0, 1, 'uploads/videos/6322e46772796.mp4', '2022-09-15 08:37:59', 4, '00:13'),
(33, 1, 'Festival', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322e510dfc96.mp4', '2022-09-15 08:40:48', 1, '00:35'),
(34, 1, 'Scientists', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 14, 0, 1, 'uploads/videos/6322e594549c9.mp4', '2022-09-15 08:43:00', 2, '00:10'),
(35, 1, 'The hand of man and robot', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 14, 0, 1, 'uploads/videos/6322e601d087a.mp4', '2022-09-15 08:44:49', 28, '00:07'),
(36, 1, 'The robot is moving', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 14, 0, 0, 'uploads/videos/6322e649f20d0.mp4', '2022-09-15 08:46:01', 4, '00:12'),
(37, 1, 'Forest', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 1, 'uploads/videos/6322e9417aa9a.mp4', '2022-09-15 08:58:41', 10, '00:40'),
(38, 2, 'Squirrel', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 4, 0, 1, 'uploads/videos/6322e9ba03d9e.mp4', '2022-09-15 09:00:42', 7, '00:19'),
(39, 4, 'Waterfall', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 0, 'uploads/videos/6322ea2106297.mp4', '2022-09-15 09:02:25', 10, '00:20'),
(40, 3, 'Forest', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 6, 0, 0, 'uploads/videos/6322eb1c23485.mp4', '2022-09-15 09:06:36', 3, '00:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
