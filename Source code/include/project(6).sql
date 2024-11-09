-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 06:55 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL,
  `ID User` int(11) NOT NULL,
  `product_id` int(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(50) NOT NULL,
  `total_price` int(50) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `number` int(50) NOT NULL,
  `method` varchar(255) NOT NULL,
  `flat` int(50) NOT NULL,
  `street` int(50) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pin_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `ID User`, `product_id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`, `number`, `method`, `flat`, `street`, `city`, `country`, `pin_code`) VALUES
(63, 1, 0, 'orange', 6, 'image/orange_1834038b.webp', 1, 6, '', 0, '', 0, 0, '', '', ''),
(64, 1, 0, 'apple', 5, 'image/apple.jpg', 1, 5, '', 0, '', 0, 0, '', '', ''),
(65, 1, 0, 'orange', 6, 'image/orange_1834038b.webp', 2, 12, '', 0, '', 0, 0, '', '', ''),
(66, 1, 0, '7up', 9, 'image/7up.webp', 1, 9, '01', 0, '', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `ID User` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `product_id` int(50) NOT NULL,
  `product_price` int(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `Qunty` int(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `pin_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `ID User`, `user_name`, `Email`, `user_address`, `product_id`, `product_price`, `qty`, `Qunty`, `total_price`, `status`, `created_at`, `updated_at`, `phone`, `method`, `pin_code`) VALUES
(1, 1, 'aysha', '', '', 8, 0, 0, 4, 14.00, 'acknowledged', '2024-05-20 18:29:46', '2024-05-20 18:29:46', '', '', ''),
(2, 1, 'aysha', '', '', 7, 0, 0, 12, 90.00, '', '2024-05-21 11:13:47', '2024-05-21 11:13:47', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(50) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_qty` int(50) NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `short_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `categories`, `product_name`, `product_qty`, `product_price`, `product_image`, `product_code`, `short_desc`) VALUES
(4, 'drinks', '7up', 6, 9, 'image/7up.webp', '01', ''),
(6, 'drinks', 'vemto', 3, 6, 'image/71K60qXroPL.jpg', '', ''),
(7, 'drinks', 'orange juice', 9, 5, 'image/mcdonalds-Tropicana-Orange-Juice-2_1-3-product-tile-desktop.jpg', '', ''),
(8, 'drinks', 'water', 7, 8, 'image/640x640.jpg', '', ''),
(9, 'sweet', 'chips lays', 6, 9, 'image/Lay-s-Potato-Chips-Limon-Flavor-7-75-oz-Bag_5f090e6d-fd82-4f8a-99a3-dc41d556211e.6dcea6a65421632ac8b8.webp', '', ''),
(10, 'sweet', 'm&m', 8, 6, 'image/images.jpg', '', ''),
(11, 'sweet', 'kinder', 9, 5, 'image/Kinder-Chocolate-100g_0123e290-ada7-46ee-9f5f-1cae8accf741.8f5a40dcf384b083808099a8e096e9d3.webp', '', ''),
(12, 'sweet', 'galaxy', 6, 9, 'image/06294001830054.webp', '', ''),
(13, 'sweet', 'ice cream', 7, 5, 'image/images (1).jpg', '', ''),
(14, ' vegetable', 'carrot', 8, 5, 'image/images (2).jpg', '', ''),
(15, 'vegetable', 'tomato', 6, 5, 'image/images (3).jpg', '', ''),
(16, 'fruit', 'orange', 8, 6, 'image/orange_1834038b.webp', '', ''),
(17, 'fruit', 'apple', 9, 5, 'image/apple.jpg', '', ''),
(18, 'fruit ', 'banana', 7, 6, 'image/banana.jpg', '', ''),
(20, 'egg and dairy', 'awal yoghurt', 8, 4, 'image/images (4).jpg', '', ''),
(21, 'egg and dairy', 'awal cheese', 7, 9, 'image/images (5).jpg', '', ''),
(22, 'egg and dairy', 'egg', 6, 9, 'image/images (6).jpg', '', ''),
(23, 'egg', 'laban awal', 8, 4, 'image/images (7).jpg', '', ''),
(25, 'pet', 'wet food', 7, 3, 'image/images (8).jpg', '', ''),
(26, 'pet', 'litter scoop', 7, 9, 'image/images.png', '', ''),
(27, 'pet', 'apple cat litter', 6, 8, 'image/images (9).jpg', '', ''),
(28, 'pet', 'cat shampoo', 7, 6, 'image/images (10).jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipt`
--

CREATE TABLE `recipt` (
  `ID` int(50) NOT NULL,
  `Progress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID User` int(11) NOT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `password2` varchar(200) NOT NULL,
  `user_type` text NOT NULL DEFAULT 'user',
  `user_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID User`, `user_name`, `Email`, `password`, `password2`, `user_type`, `user_address`) VALUES
(1, 'aysha', 'aysha123@gmail.com', 'Aysha123**', 'Aysha123**', 'user', ''),
(2, 'admin', 'admin@gmail.com', 'abc123', 'abc123', 'admin', ''),
(9, 'alhanoof', 'al@gmail.com', '$2y$10$4qmDCdNImxH5YoiqxN61Y.Q4lG02x1l178En8BG2XNaC92L8WVfvC', '', 'user', ''),
(10, 'mahra ', 'mahra@gmail.com', '$2y$10$8kS.jOuIBqTYjUQAHqqRL.t3FLLhZ64VHa11XSoxryIVflmcoAijW', '', 'user', ''),
(11, 'Muneera', 'm123@gmail.com', '$2y$10$KjDf5dgIL5Ld5U7vRvuw0.rfeTadH/vQgSa9RVC.LtAuQzUGHAPqm', '', 'user', ''),
(12, 'John Doe', 'JohnDoe@gmail.com', 'John1234**', 'John1234**', 'user', ''),
(13, 'mahra', 'mahra12@gmail.com', 'mahra123##', 'mahra123##', 'staff', ''),
(14, 'noof', 'noof@gmail.com', '$2y$10$meEb5wrnSlQrrBQzvNfGH.u4PevU37NDr8hAfFG.jdpqduSM8f3oK', '', 'staff', ''),
(16, 'Nada', 'Nada@gmail.com', '$2y$10$61YXqapz70t/3lzozr/YSOuml2YvGsvAR8ggJtgJr1Ycn2gidGp3.', '$2y$10$61YXqapz70t/3lzozr/YSOuml2YvGsvAR8ggJtgJr1Ycn2gidGp3.', 'staff', ''),
(17, 'fatima', 'fatima@gmail.com', '$2y$10$51wR/gL6H6HaUAg5SJ8OU./lxMziZXFVrVqtRsm6CZFT3wEc4JSnK', '$2y$10$51wR/gL6H6HaUAg5SJ8OU./lxMziZXFVrVqtRsm6CZFT3wEc4JSnK', 'staff', ''),
(18, 'Muneer', 'Muneer@gmail.com', '$2y$10$VFoqHqZHjjYXCD0KmIv4VOqhZujbCsZ.GhgvJ7w02zn2ObX/dbBZG', '$2y$10$VFoqHqZHjjYXCD0KmIv4VOqhZujbCsZ.GhgvJ7w02zn2ObX/dbBZG', 'staff', ''),
(19, '', '', '', '', '', ''),
(23, '', 'dfghjk@dfgh.com', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID User` (`ID User`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID User` (`ID User`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID User`),
  ADD UNIQUE KEY `Email_2` (`Email`),
  ADD KEY `username` (`user_name`),
  ADD KEY `Email` (`Email`),
  ADD KEY `password` (`password`),
  ADD KEY `password2` (`password2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ID User`) REFERENCES `users` (`ID User`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
