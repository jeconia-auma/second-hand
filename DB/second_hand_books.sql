-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2022 at 04:37 PM
-- Server version: 10.5.15-MariaDB-0+deb11u1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `second_hand_books`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`, `total`) VALUES
(10007, '7 HABBITS OF HIGHLY EFFECTIVE PEOPLE', 'Stephen R. Covey', 'The 7 Habits of Highly Effective People, first published in 1989, is a business and self-help book written by Stephen R. Covey.', '800.00', 'Book-7 HABBITS OF HIGHLY EFFECTIVE PEOPLE.png', 9156, 'yes', 'yes', 1000),
(10008, 'THE LEADER IN ME', 'Stephen R. Covey', 'Written by R. Covey to help us activate the leaders in us', '850.00', 'Book-THE LEADER IN ME.png', 9156, 'yes', 'yes', 1000),
(10009, 'RED WHITE & ROYAL BLUE', 'CASEY MCQUISTON', 'A LOVE STORY CASEY MCQUISTON', '1000.00', 'Book-RED WHITE & ROYAL BLUE.png', 9153, 'yes', 'yes', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `id` int(22) NOT NULL,
  `user_id` int(22) DEFAULT NULL,
  `book_id` int(22) DEFAULT NULL,
  `price` decimal(22,2) DEFAULT NULL,
  `qty` int(22) DEFAULT NULL,
  `amount` decimal(22,2) DEFAULT NULL,
  `order_date` varchar(255) DEFAULT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `purchase_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`id`, `user_id`, `book_id`, `price`, `qty`, `amount`, `order_date`, `delivery_date`, `purchase_status`) VALUES
(120032, 1247, 10007, '800.00', 2, '1600.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120033, 1247, 10008, '850.00', 2, '1700.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120034, 1247, 10009, '1000.00', 3, '3000.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120035, 1247, 10007, '800.00', 1, '800.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120036, 1247, 10008, '850.00', 1, '850.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120037, 1247, 10009, '1000.00', 1, '1000.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120038, 1247, 10009, '1000.00', 3, '3000.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120039, 1256, 10009, '1000.00', 2, '2000.00', 'Sun Oct 16 2022', 'Sun 16 Oct 2022', 'delivered'),
(120040, 1257, 10007, '800.00', 1, '800.00', 'Sun Oct 16 2022', '', 'ordered'),
(120041, 1257, 10008, '850.00', 1, '850.00', 'Sun Oct 16 2022', '', 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(22) DEFAULT NULL,
  `book_id` int(22) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(22) DEFAULT NULL,
  `amount` decimal(22,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9150, 'FOOD', 'Book-Category-Food.png', 'yes', 'yes'),
(9151, 'HISTORY', 'Book-Category-History.png', 'yes', 'yes'),
(9152, 'NON FICTION', 'Book-Category-Non Fiction.png', 'yes', 'yes'),
(9153, 'LOVE AND MARRIAGE', 'Book-Category-Love And Marriage.png', 'yes', 'yes'),
(9154, 'HORROR', 'Book-Category-Horror.png', 'yes', 'yes'),
(9155, 'CHRISTIANITY', 'Book-Category-Christianity.png', 'yes', 'yes'),
(9156, 'INSPIRATION', 'Book-Category-Inspiration.png', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `national_id` int(11) NOT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `national_id`, `mobile`, `email`, `password`, `user_type`) VALUES
(1247, 'Okoth Jeconia Auma', 36149028, '708301830', 'jeconiaauma@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'admin'),
(1257, 'Pascal Okoth', 35287469, '0784552363', 'pascal@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users_addresses`
--

CREATE TABLE `users_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `other_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_addresses`
--

INSERT INTO `users_addresses` (`id`, `user_id`, `country`, `town`, `district`, `ward`, `other_details`) VALUES
(1, 1247, 'Kenya', 'Nairobi', 'Kawangware', 'Congo', 'Room 1 First Floor, Donn Plaza Near Stage 2'),
(2, 1256, 'Kenya', 'Kisumu', 'Kondele', 'Kodiaga', 'Kodiaga corner'),
(3, 1257, 'Kenya', 'Nairobi', 'Kawangware', 'Kabiro', 'Johns Plaza');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10010;

--
-- AUTO_INCREMENT for table `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120042;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9158;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1258;

--
-- AUTO_INCREMENT for table `users_addresses`
--
ALTER TABLE `users_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
