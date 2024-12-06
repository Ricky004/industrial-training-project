-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 06:27 AM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`, `phone`) VALUES
(1, 'hello_admin', 'test001@gmail.com', '$2y$10$rrFcef4a49wKPqvvMQw3/uI3i.4Em./PtFPTgpuEc0Z222FSbnKTe', 2344242);

-- --------------------------------------------------------

--
-- Table structure for table `all services`
--

CREATE TABLE `all services` (
  `id` int(10) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `description` text NOT NULL,
  `technacian_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `all services`
--

INSERT INTO `all services` (`id`, `service_name`, `price`, `description`, `technacian_id`) VALUES
(8, 'Home Cleanig', 240, 'cleaning', 17),
(9, 'computer/laptop repairing ', 360, 'Best in the field', 18);

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
(18, 'Home Cleanig', 0, 17, 'pending', '2024-12-05 11:38:36', 8, 14, 2),
(19, 'computer/laptop repairing ', 0, 18, 'pending', '2024-12-05 11:40:24', 9, 14, 7);

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
(17, 'Batman', 'test001@gmail.com', '$2y$10$e3HQIbNeQFRzPRxE7BneNeem20JAR1qDgkUJb4hS/wSNIVOiMgxHm', 'nothing', '6-12', 0, 2344242, 'plumber', 0, 0),
(18, 'Anirban ', 'test002@gmail.com', '$2y$10$C8Mza8s14z4gNxGpv/qlm.hlkj2OCZZ7qddNuvt8LACW5yCMIvEPm', 'nothing here!', '6-12', 0, 2344242, 'electrician', 0, 0);

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
(14, 'user_1', 'user', 'test1@gmail.com', 13314155, '$2y$10$uAkA2O0PtWscME4OVze/jOnsxB2EQ94N.dA1kEDTkunbFuGQZk83K', '2024-12-05 06:00:12');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `tecnacian_fk` (`technacian_id`);

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
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all services`
--
ALTER TABLE `all services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `technacian`
--
ALTER TABLE `technacian`
  MODIFY `technacian_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all services`
--
ALTER TABLE `all services`
  ADD CONSTRAINT `tecnacian_fk` FOREIGN KEY (`technacian_id`) REFERENCES `technacian` (`technacian_id`);

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
