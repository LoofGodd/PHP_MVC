-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2024 at 01:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MVC`
--

-- --------------------------------------------------------

--
-- Table structure for table `mvc`
--

CREATE TABLE `mvc` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mvc`
--

INSERT INTO `mvc` (`id`, `heading`, `description`, `image`) VALUES
(44, 'Cat', 'Cat is good', '35f2798a-e59b-4dc4-af7f-9996c100ead2_cat.jpeg'),
(45, 'dog', 'dog love eating', '82a3f17e-e723-45ca-a14c-bc2265d1909c_dog.jpeg'),
(46, 'Car', 'I\'ll buy a car', '3cd68024-2498-4cdd-bd1b-ad0e84209e27_car.jpeg'),
(47, 'Black', 'Black animal', '18f270d7-84f2-4a4c-bf35-660ce47232c6_gorila.jpeg'),
(48, 'Who is your favorite boxer?', 'Mike Tyson', '3607a949-2f22-47e3-a71c-6df5d4e6601b_mike tyson.jpeg'),
(49, 'Cambodia Kingdom of Wonder', 'Yes It is.', '2d5ac605-306e-4750-89b3-300febc6237d_siemreab.jpeg'),
(50, 'Wired', 'Is that a snakrat?', '5dbe4525-6533-4b27-9ab8-09314f8f7860_snake.jpeg'),
(51, 'King of Animal', 'Tiger', '8979c7f1-a3cc-42cc-b458-3df99bd67796_tiger.jpeg'),
(52, 'Ben 10', 'Wait, am I downloading the wrong ben image?', 'ed650e83-9254-4683-947e-11b2a2189835_steav.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mvc`
--
ALTER TABLE `mvc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mvc`
--
ALTER TABLE `mvc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
