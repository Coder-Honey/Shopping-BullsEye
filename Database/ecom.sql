-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306:3306
-- Generation Time: Mar 10, 2023 at 10:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'inventory', 'inventory');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(2, 'Shoes', 1),
(3, 'Equipments', 1),
(5, 'Clothes', 1),
(7, 'Base Court', 1),
(9, 'Yoga Wears', 1),
(10, 'Caps', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(6, 'Harshada', 'harshada@gmail.com', '7537728273', 'Good Website and products too', '2023-02-04 08:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(3, 'First50', 100, 'Rupee', 500, 1),
(4, 'First60', 10, 'Rupee', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `ccourse_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `instru_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `description` text NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `video_link` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `ccourse_id`, `name`, `instru_id`, `image`, `hours`, `description`, `short_desc`, `video_link`, `status`, `added_on`) VALUES
(1, 2, 'Cricket Basics Course', 4, 'sm-banner1.jpeg', 3, 'This course is designed to teach you everything you need to become an all-around threat on the field - taught by some of the best coaches in Cricket! The team at Cricket Coaching Excellence have years of experience training young players of all levels become skilled athletes. In over an hour of cricket training videos, you will learn essential cricket skills like batting, catching, and fielding. You\'ll also get plenty of training drills to hone in on these skills and enhance your overall fitness level.', 'This instructional cricket course is ideal for any athlete looking to further their ability, or for cricket coaches to develop their team\'s skills and practice routines.', 'https://youtu.be/zA_UXySeGbU', 1, '2023-02-11 07:39:26'),
(2, 5, 'Baseball Basic Course', 5, 'baseball.jpg', 2, 'This course is designed to teach you everything you need to become an all-around threat on the field - taught by some of the best coaches in Baseball! The team at Baseball Coaching Excellence have years of experience training young players of all levels become skilled athletes. In over an hour of Baseball training videos, you will learn essential cricket skills like batting, catching, and fielding. You\'ll also get plenty of training drills to hone in on these skills and enhance your overall fitness level.', 'Baseball is a sport played between two teams usually of nine players each. It is a bat-and-ball game in which a pitcher throws ( pitches) a hard, fist-sized, leather-covered ball toward a batter on the opposing team.', 'https://www.youtube.com/watch?v=dwV04XuiWq4', 1, '2023-02-11 19:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `id` int(11) NOT NULL,
  `course_category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`id`, `course_category`, `status`) VALUES
(2, 'Cricket', 1),
(3, 'Football', 1),
(4, 'Badminton', 1),
(5, 'Baseball', 1),
(6, 'Kabdadi', 1),
(7, 'Hockey', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `iname` varchar(250) NOT NULL,
  `ctype` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `iname`, `ctype`, `status`) VALUES
(4, 'Louis Sullivan', '2', 1),
(5, 'Camden David', '5', 1),
(6, 'Fiona Dean', '6', 1),
(7, 'Cherish Sosa', '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 4, 3, 800),
(2, 1, 8, 2, 50),
(3, 2, 9, 2, 785),
(4, 3, 8, 10, 50),
(5, 4, 4, 1, 800),
(6, 5, 4, 1, 800),
(7, 6, 4, 1, 800),
(8, 7, 7, 1, 5445),
(9, 8, 7, 1, 6000),
(10, 9, 7, 1, 6000),
(11, 10, 12, 1, 449),
(12, 10, 4, 1, 800),
(13, 11, 8, 1, 50),
(14, 11, 7, 1, 6000),
(15, 12, 7, 1, 6000),
(16, 13, 7, 1, 6000),
(17, 14, 7, 1, 6000),
(18, 15, 7, 1, 6000),
(19, 16, 10, 1, 1500),
(20, 17, 9, 1, 785),
(21, 18, 10, 1, 1500),
(22, 19, 10, 1, 1500),
(23, 20, 4, 1, 800),
(24, 21, 9, 3, 785),
(25, 22, 10, 1, 1500),
(26, 23, 12, 5, 449),
(27, 24, 12, 5, 449),
(28, 25, 7, 1, 6000),
(29, 26, 7, 1, 6000),
(30, 27, 7, 1, 6000),
(31, 28, 8, 1, 50),
(32, 29, 9, 1, 785),
(33, 30, 9, 1, 785),
(34, 31, 9, 1, 0),
(35, 32, 9, 1, 785),
(36, 33, 9, 1, 785),
(37, 34, 9, 1, 785),
(38, 35, 9, 1, 785),
(39, 36, 9, 1, 785);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_no` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(250) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_value` varchar(50) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `user_id`, `house_no`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`) VALUES
(1, 13, 'Tilak Nagar', 'Delhi', 'Delhi', 432008, 'COD', 2550, 'pending', 3, '', '', '', 0, '', '', '2023-02-04 03:23:43'),
(2, 13, 'Vadodara', 'Vadodara', 'vadodara', 654756, 'COD', 1620, 'pending', 5, '', '', '', 0, '', '', '2023-02-05 12:58:29'),
(6, 13, 'delhi', 'delhi', 'delhi', 363636, 'COD', 750, 'pending', 1, '', '', '', 3, '100', 'First50', '2023-02-16 07:39:11'),
(9, 13, 'dd', 'sff', 'sf', 22, 'COD', 5950, 'pending', 1, '', '', '', 3, '100', 'First50', '2023-02-16 08:31:49'),
(19, 13, 'x', 'x', 'X', 23, 'instamojo', 1550, 'complete', 3, '31252a7d5392475a8d96cbcd1540fd6c', 'MOJO3221805A56090047', '', 0, '', '', '2023-02-21 07:33:50'),
(20, 13, 'ONGC', 'Vadodara', 'Gujarat', 390009, 'instamojo', 850, 'complete', 1, '62f0837f621c4a138da806a600cf56d8', 'MOJO3223605A39967479', '', 0, '', '', '2023-02-23 05:33:46'),
(21, 13, 'vad', 'vad', 'vad', 122323, 'COD', 2405, 'pending', 1, '', '', '', 0, '', '', '2023-02-23 07:01:31'),
(22, 13, '12 D Tilak nagar', 'wadodiga road', 'vadodara', 392205, 'instamojo', 1450, 'complete', 1, '9a1e4c3342844c05b58ad4a047b1927c', 'MOJO3224605A80424392', '', 3, '100', 'First50', '2023-02-24 07:34:16'),
(36, 14, 'gjj', 'hfh', 'gbkj', 958687, 'instamojo', 835, 'complete', 1, '4e37343190944ad290584e07b5c96d4b', 'MOJO3310O05A51866754', '', 0, '', '', '2023-03-10 10:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `subcategories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `subcategories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(4, 5, 0, 'Men\'s Fleece 500 Blue/Black', 999, 800, 10, '826675904_jacket.png', 'he fleece traps air in the volume created by its texture (known as \"terry cloth\" when it is made up of loops).', 'he fleece traps air in the volume created by its texture (known as \"terry cloth\" when it is made up of loops).', 1, 'Men\'s Fleece 500 Blue/Black', 'Men\'s Fleece 500 Blue/Black', 'wear', 1),
(7, 3, 0, 'Golf Light Stand Bag White', 7400, 6000, 5, '763032862_golf.png', 'Lightweight stand bag offers greater stability once stand legs are extended out Legs are fastened with rip-tab strap.', 'Lightweight stand bag offers greater stability once stand legs are extended out Legs are fastened with rip-tab strap.', 1, 'Lightweight stand bag offers greater stability once stand legs are extended out Legs are fastened with rip-tab strap.', '', 'Golf', 1),
(8, 10, 2, 'Baseball Blue Sports Caps', 100, 50, 10, '535733027_cap.png', 'Cricket, Baseball', 'Cricket, Baseball', 1, 'Cricket, Baseball', '', 'cap', 1),
(9, 2, 0, 'Canvas Casual High Top Sneaker', 1299, 785, 10, '708520824_causal1.jpg', 'Breathable Fabric Canvas upper and lightweight comfortable rubber sole.; Adjustable lace up is more convenience to fit for your feet and easy to wear on and off.', 'Fashion casual canvas sneakers are suitable both for adults and teenagers, they are perfect for back to school gift, Birthday, Valentine’s, Halloween, Thanksgiving, Christmas, New year and so on.', 1, 'Casual High Top Sneaker', 'Canvas Casual High Top Sneaker Shoes', 'causal', 1),
(10, 2, 0, 'Adidas Men\\\'s X Speedportal', 2000, 1500, 10, '431595395_shoes.png', 'Solar Green / Core Black / Solar Yellow', 'Solar Green / Core Black / Solar Yellow', 1, 'Adidas Men\\\'s X Speedportal', 'Adidas Men\\\'s X Speedportal', 'cricket,baseball', 1),
(11, 3, 4, 'Aluminium Badminton Racket with Shuttles', 900, 500, 10, '422011624_71Jq43IodUL._SL1500_.jpg', 'It is for playing level beginner, Intermediate level players\r\nContains: Pack of 2 badminton Rackets, 1 badminton cover + 1 Feather Shuttle box (Pack of 3) Aluminium frame Material Aluminium', 'It is for playing level beginner, Intermediate level players\r\nContains: Pack of 2 badminton Rackets, 1 badminton cover + 1 Feather Shuttle box (Pack of 3) Aluminium frame Material Aluminium\r\nDurable product\r\nAluminum Badminton -Racket Set of -2 with- 3 Pieces Feather shuttles with Full- Cover', 0, 'Aluminium Badminton Racket with Shuttles', 'Aluminium Badminton Racket with Shuttles', 'Badminton', 1),
(12, 3, 2, 'Major Official Baseball', 1199, 449, 5, '848549789_baseball.png', 'Reduced-impact training base balls provide an authentic baseball look with soft, cushioned construction\r\nHelps youth players build confidence by reducing fear about impact', 'Reduced-impact training base balls provide an authentic baseball look with soft, cushioned construction\r\nHelps youth players build confidence by reducing fear about impact\r\nSame size and visual cues as standard baseballs for effective training\r\nComes with 2 Base Balls', 0, 'Major Official Baseball', 'Major Official Baseball', 'Baseball', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(8, 9, 13, 'Very Good', 'Very Good Quality', 1, '2023-02-19 04:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `sub_categories`, `status`) VALUES
(1, 'Cricket', 1),
(2, 'Baseball', 1),
(3, 'Football', 1),
(4, 'Badminton', 1),
(5, 'Kabdadi', 1),
(6, 'Hockey', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(13, 'harshada', 'harshada9999', 'harshada@gmail.com', '7537728273', '2023-01-24 07:39:26'),
(14, 'bullseye_try', 'bullseye99', 'bullseyecom110@gmail.com', '7548653218', '2023-02-04 08:16:06'),
(15, 'payal gandhi', 'payalghandi', 'payalgandhi@gmail.com', '8320262753', '2023-02-25 05:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(12, 13, 12, '2023-02-24 07:29:46'),
(13, 15, 12, '2023-02-25 05:31:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
