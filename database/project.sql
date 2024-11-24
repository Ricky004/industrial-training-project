-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 04:39 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all services`
--

CREATE TABLE `all services` (
  `id` int(10) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `all services`
--

INSERT INTO `all services` (`id`, `service_name`, `price`, `description`) VALUES
(1, 'plumber', 430, 'ww3w wwewew4thhjh dfdf'),
(2, 'car mecanic', 357, '1. I have 2+ year experince in car repearing.\r\n2. I have the most lowest price in the market right now. '),
(3, 'fridge repair ', 270, 'fridge repairing from xyz company in 15% low margin'),
(4, 'computer/laptop repairing ', 369, 'I have 2+ experience in repairing any type of personal computer or laptop. ');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(10) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `request_id` int(10) NOT NULL,
  `technacian_id` int(10) NOT NULL,
  `paystatus` varchar(50) NOT NULL,
  `assign_date` datetime NOT NULL DEFAULT current_timestamp(),
  `service_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `service_name`, `request_id`, `technacian_id`, `paystatus`, `assign_date`, `service_id`, `user_id`, `quantity`) VALUES
(4, 'car mecanic', 0, 3, 'cancelled', '2024-11-24 17:11:57', 2, 5, 2),
(7, 'fridge repair ', 0, 3, 'cancelled', '2024-11-24 17:12:23', 3, 5, 1),
(8, 'plumber', 0, 3, 'cancelled', '2024-11-24 17:33:16', 1, 5, 3),
(9, 'plumber', 0, 3, 'pending', '2024-11-24 20:40:55', 1, 5, 2),
(10, 'car mecanic', 0, 3, 'pending', '2024-11-24 20:41:01', 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `technacian`
--

CREATE TABLE `technacian` (
  `technacian_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `experience` enum('0-6','6-12','1-2','2+') NOT NULL,
  `service_id` int(10) NOT NULL,
  `phone` int(12) NOT NULL,
  `type_of_service` text NOT NULL,
  `terms_condition` tinyint(1) NOT NULL,
  `avalability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `technacian`
--

INSERT INTO `technacian` (`technacian_id`, `name`, `email`, `password`, `address`, `experience`, `service_id`, `phone`, `type_of_service`, `terms_condition`, `avalability`) VALUES
(3, 'Batman', 'test001@gmail.com', '$2y$10$lWck94fqjkbXoN6NaH6oMeiMUBSrase1T5zFjVC5KiQf6WV1P4W9m', 'padpp  33d/4 ddd', '', 0, 2344242, 'plumber', 0, 0),
(4, 'Batman', 'test003@gmail.com', '$2y$10$e0d.fvVrd/I3Znc/h7.9X.sPDIlmnPEpFO6uEnHtDYgllX2doVNIq', 'wrrwrw 33r3ds ', '6-12', 0, 2344242, 'plumber', 0, 0),
(6, 'Batman', 'test004@gmail.com', '$2y$10$QDx6azZTe9xnlktntiwB6OlVGgEPBmxXVGUR/qb8VxyqN8yff4at6', 'wrrwrw 33r3ds ', '6-12', 0, 2344242, 'plumber', 0, 0),
(7, 'Batman', 'trstsy@hs.com', '$2y$10$t8duni2ue.T7RPxd9AePZ.gmnuyoP3wl8myVlq1YiqBUFhlQsqDKu', 'wwew wwrw wrw', '0-6', 0, 2344242, 'plumber', 0, 0),
(8, 'Batman', 'lifoj40243@cutefier.com', '$2y$10$314yibjNOcPSckPed77HquEL59Mxu0uyAa3f9WoyWjjM0d7az/Opu', 'retfff 55/3 trr road', '', 0, 2344242, 'plumber', 0, 0),
(9, 'Batman', 'test005@gmail.com', '$2y$10$BlmLLBpf6Cz8Uy4Kt6M3t.aiKTr0IJ8pnNuDoNk.O8CyjtMTWgJLi', 'wdfdfdggh rgrg 33/r rg ', '', 0, 2344242, 'plumber', 0, 0),
(10, 'Anupam ', 'test0011@gmail.com', '$2y$10$CG0D6ByLTtRngsREQhp37e6EepC6R46eUqhxRAStMdbIBQ9tLAhme', 'address is something.', '', 0, 2344242, 'tecnician', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_type` enum('user','admin','technician') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` int(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joining_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_type`, `email`, `phone_no`, `password`, `joining_time`) VALUES
(1, '', 'user', 'test001@gmail.com', 0, '$2y$10$NJJPiqg2rroR.J39.tffdO9Jhbz/DQ2S.BpdE.eGlNHLwdWObgLZ2', '2024-11-23 14:29:49'),
(5, 'tridip_01', 'user', 'test003@gmail.com', 13314155, '$2y$10$SM8ix46mYzDJECA3sPXHOOrup4MQcjzAajbIBAI7Ti.TDOUCG.5yu', '2024-11-23 15:19:26'),
(6, 'tridip_02', 'user', 'test002@gmail.com', 13314155, '$2y$10$dXE8N7N3Mg0ok6oBZx145uhBlib4IQN6dkInztmQL125THhEdsS.u', '2024-11-23 15:32:09'),
(8, 'tridip_02', 'user', 'test004@gmail.com', 13314155, '$2y$10$jRIbV9Pkmg5EqbcrRNKG6OKaq2IZivvU75HVIEsd3nSUmWVWg1kje', '2024-11-23 15:33:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `all services`
--
ALTER TABLE `all services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_fk` (`user_id`),
  ADD KEY `service_fk` (`service_id`),
  ADD KEY `technician_fk` (`technacian_id`);

--
-- Indexes for table `technacian`
--
ALTER TABLE `technacian`
  ADD PRIMARY KEY (`technacian_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `all services`
--
ALTER TABLE `all services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `technacian`
--
ALTER TABLE `technacian`
  MODIFY `technacian_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `service_fk` FOREIGN KEY (`service_id`) REFERENCES `all services` (`id`),
  ADD CONSTRAINT `technician_fk` FOREIGN KEY (`technacian_id`) REFERENCES `technacian` (`technacian_id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
