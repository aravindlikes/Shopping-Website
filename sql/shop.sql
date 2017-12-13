-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2017 at 11:52 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminType` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `adminType`, `creationDate`, `updationDate`) VALUES
(1, 'admin@cousinslab.com', 'admin', 0, '2017-01-24 16:21:18', '25-01-2017 12:05:43 AM');

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

DROP TABLE IF EXISTS `blogpost`;
CREATE TABLE IF NOT EXISTS `blogpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posttitle` varchar(40) NOT NULL,
  `postcontent` varchar(65000) NOT NULL,
  `postby` varchar(100) NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postimage` varchar(50) NOT NULL,
  `poststatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryDescription` longtext NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT '1',
  `categoryImage` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`, `isAvailable`, `categoryImage`) VALUES
(1, 'Rock Bee Honey (Malai Thaen)', 'This honey is extracted from the hives of Apis dorsata, the largest of the honey bees, and arguably the most vicious. They build their hives far away from human habitats on rock cliffs or branches of giant trees. They defend their colonies with aggression and collecting honey from them is a dangerous task, and not for the unskilled or faint at heart.', '2017-01-24 13:47:37', '06-12-2017 10:42:18 PM', 1, 'Rock Bee Honey (Malai Thaen).jpg'),
(2, 'Dammer Bee Honey (Siru Thaen)', 'Dammer bee or Stingless bee belong to the family Meliponini, their honey has passed down in tribal lore as the ultimate medicinal wonder. Dammer bee honey is rare, can be found in limited quantity of few hundred grams per hive, and has long been prized by forest dwelling tribes as an elixir. It is even given by tribal people to their  infants and kids.', '2017-01-24 13:49:32', '', 1, '400x400.png'),
(3, 'Indian Bee Honey (Pondhu Thaen)', 'Apis cerana indica bees are furtive creatures that build their hives in inaccessible, dark cavities in the earth, or in hollows trunks of large trees. Being the least aggressive and tractable of their species, they are favorites of beekeepers around the world.', '2017-01-24 19:19:54', '', 1, '400x400.png'),
(4, 'asd', 'asdasd', '2017-12-04 11:35:23', '08-12-2017 10:43:57 PM', 1, 'asd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `size`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(21, 1, '2', 'small', 1, '2017-11-27 12:23:15', NULL, 'delivered'),
(22, 1, '2', 'medium', 1, '2017-11-27 12:32:04', NULL, 'delivered'),
(23, 1, '2', 'small', 1, '2017-11-27 13:30:11', NULL, NULL),
(24, 2, '2', 'small', 3, '2017-11-28 05:43:06', NULL, NULL),
(25, 2, '2', 'medium', 1, '2017-11-28 06:33:06', NULL, NULL),
(26, 3, '2', 'medium', 3, '2017-11-28 07:03:30', NULL, NULL),
(27, 1, '2', 'large', 5, '2017-11-29 09:25:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

DROP TABLE IF EXISTS `ordertrackhistory`;
CREATE TABLE IF NOT EXISTS `ordertrackhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

DROP TABLE IF EXISTS `productreviews`;
CREATE TABLE IF NOT EXISTS `productreviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `review` longtext NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subCategory` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productCompany` varchar(255) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productPriceBeforeDiscount` int(11) NOT NULL,
  `productDescription` longtext NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `shippingCharge` int(11) NOT NULL,
  `productAvailability` int(11) NOT NULL DEFAULT '1',
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(2, 2, 'Rock Bee', 'thean', 500, 0, 'sadasdads\r\nasdasdasd\r\nasdasd', 'Rock Bee.jpg', 45, 1, '2017-11-25 00:39:38', '08-12-2017 10:04:13 PM'),
(3, 3, 'Some', '', 550, 4500, 'Some', 'Some.jpg', 50, 1, '2017-12-06 12:12:18', '08-12-2017 10:03:43 PM'),
(4, 1, 'Some', 'self', 100, 0, 'Some thing health full', 'Some.gif', 50, 1, '2017-12-10 07:22:13', '10-12-2017 12:51:50 PM'),
(5, 1, 'Some', 'self', 100, 0, 'Some thing health full', 'Some.gif', 50, 0, '2017-12-10 07:22:45', '10-12-2017 12:52:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT '1',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `isAvailable`, `creationDate`, `updationDate`) VALUES
(1, 1, 'Rock Bee Honey', 1, '2017-11-24 15:00:00', '06-12-2017 06:14:30 PM'),
(2, 2, 'Thaen Some', 1, '2017-12-04 12:52:08', '06-12-2017 06:17:54 PM'),
(3, 4, 'Thean Some', 1, '2017-12-04 16:02:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 06:33:59', '27-11-2017 12:51:29 PM', 1),
(2, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 07:23:16', '27-11-2017 02:30:36 PM', 1),
(3, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 09:02:43', '27-11-2017 02:33:56 PM', 1),
(4, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 09:57:15', '27-11-2017 03:27:27 PM', 1),
(5, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 09:59:13', '27-11-2017 05:02:06 PM', 1),
(6, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 11:32:14', '27-11-2017 05:18:31 PM', 1),
(7, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 12:19:06', '27-11-2017 05:50:45 PM', 1),
(8, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 12:21:02', '27-11-2017 05:54:25 PM', 1),
(9, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 12:30:56', '', 1),
(10, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-27 13:29:42', '', 1),
(11, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-28 05:16:09', '', 1),
(12, '', 0x3a3a3100000000000000000000000000, '2017-11-28 05:17:04', '', 0),
(13, '', 0x3a3a3100000000000000000000000000, '2017-11-28 05:20:08', '', 0),
(14, '', 0x3a3a3100000000000000000000000000, '2017-11-28 05:22:03', '', 0),
(15, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-28 05:25:58', '28-11-2017 10:56:02 AM', 1),
(16, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 05:40:35', '28-11-2017 11:12:21 AM', 1),
(17, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 05:43:00', '28-11-2017 11:25:07 AM', 1),
(18, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 05:55:21', '28-11-2017 11:57:46 AM', 1),
(19, '', 0x3a3a3100000000000000000000000000, '2017-11-28 06:04:43', '', 0),
(20, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-28 06:27:53', '28-11-2017 12:01:20 PM', 1),
(21, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-28 06:31:36', '28-11-2017 12:02:40 PM', 1),
(22, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 06:32:48', '28-11-2017 12:09:49 PM', 1),
(23, 'yashanandan@gmail.com', 0x3139322e3136382e302e313000000000, '2017-11-28 06:47:13', '28-11-2017 02:24:30 PM', 1),
(24, '', 0x3139322e3136382e302e313000000000, '2017-11-28 07:09:07', '', 0),
(25, '', 0x3a3a3100000000000000000000000000, '2017-11-28 07:30:16', '', 0),
(26, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 07:35:36', '28-11-2017 01:05:39 PM', 1),
(27, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 07:36:08', '28-11-2017 01:21:11 PM', 1),
(28, '', 0x3a3a3100000000000000000000000000, '2017-11-28 07:51:24', '', 0),
(29, '', 0x3a3a3100000000000000000000000000, '2017-11-28 07:51:52', '28-11-2017 03:15:16 PM', 0),
(30, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 07:54:00', '', 0),
(31, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:42:28', '', 0),
(32, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:43:26', '', 0),
(33, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:43:46', '', 0),
(34, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:44:26', '', 0),
(35, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 08:45:45', '28-11-2017 02:15:49 PM', 1),
(36, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:47:53', '', 0),
(37, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:49:27', '', 0),
(38, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 08:49:31', '28-11-2017 02:19:43 PM', 1),
(39, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:50:36', '', 0),
(40, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 08:50:42', '', 0),
(41, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 08:51:32', '28-11-2017 02:32:01 PM', 1),
(42, 'yashanandan@gmail.com', 0x3139322e3136382e302e313000000000, '2017-11-28 08:55:28', '', 0),
(43, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:02:51', '', 0),
(44, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:04:45', '', 0),
(45, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:07:07', '', 0),
(46, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:07:10', '', 0),
(47, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:11:10', '', 0),
(48, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:11:12', '28-11-2017 02:42:06 PM', 1),
(49, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:13:15', '28-11-2017 02:43:19 PM', 1),
(50, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:25:36', '', 0),
(51, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:25:53', '28-11-2017 02:55:57 PM', 1),
(52, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:26:04', '', 0),
(53, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:26:09', '', 0),
(54, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:27:46', '', 0),
(55, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:27:51', '', 0),
(56, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:27:54', '', 0),
(57, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:27:58', '', 0),
(58, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:28:11', '', 0),
(59, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:28:15', '', 0),
(60, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:28:21', '', 0),
(61, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:33:20', '', 0),
(62, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:33:21', '', 0),
(63, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:33:25', '28-11-2017 03:03:42 PM', 1),
(64, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:33:47', '', 0),
(65, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:34:10', '', 0),
(66, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:34:58', '', 0),
(67, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:35:06', '', 0),
(68, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:35:09', '', 0),
(69, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:35:35', '', 0),
(70, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:35:40', '', 0),
(71, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:35:44', '', 0),
(72, 'asdasd@g.ccc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:36:49', '', 0),
(73, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:36:53', '', 0),
(74, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:36:57', '28-11-2017 03:07:01 PM', 1),
(75, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:37:12', '', 0),
(76, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:40:33', '', 0),
(77, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:40:37', '', 0),
(78, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:40:43', '', 0),
(79, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:41:13', '', 0),
(80, 'asdasd@g.cc', 0x3a3a3100000000000000000000000000, '2017-11-28 09:41:19', '', 0),
(81, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:41:24', '28-11-2017 03:13:02 PM', 1),
(82, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 09:45:36', '', 1),
(83, 'asdasd@g.c', 0x3a3a3100000000000000000000000000, '2017-11-28 10:59:58', '28-11-2017 04:30:33 PM', 1),
(84, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 08:58:49', '29-11-2017 02:37:31 PM', 1),
(85, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 09:07:59', '29-11-2017 02:38:02 PM', 1),
(86, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 09:08:10', '29-11-2017 02:38:23 PM', 1),
(87, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 09:08:50', '29-11-2017 02:38:53 PM', 1),
(88, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 09:17:08', '29-11-2017 02:54:24 PM', 1),
(89, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-11-29 09:24:59', '29-11-2017 02:57:49 PM', 1),
(90, 'arvi@gmail.com', 0x3132372e302e302e3100000000000000, '2017-11-30 09:40:39', '', 1),
(91, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-12-01 06:52:00', '01-12-2017 12:22:46 PM', 1),
(92, 'arvi@gmail.com', 0x3a3a3100000000000000000000000000, '2017-12-04 11:56:16', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shippingAddress` longtext NOT NULL,
  `shippingState` varchar(255) NOT NULL,
  `shippingCity` varchar(255) NOT NULL,
  `shippingPincode` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `regDate`, `updationDate`) VALUES
(1, 'aravind', 'arvi@gmail.com', 8056556733, 'aravind', '98, aps street', 'Tamilnadu', 'Virudhunagar', 626001, '2017-11-25 13:42:50', '2017-11-30 15:20:08'),
(3, 'Yash', 'yashanandan@gmail.com', 9876543210, 'password', '34, abc, def', 'TN', 'CHN', 600008, '2017-11-28 06:46:40', '2017-11-28 12:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
