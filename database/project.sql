-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 06:49 PM
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
  `technacian_id` int(10) NOT NULL,
  `type_of_service` enum('technician','electrician','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `all services`
--

INSERT INTO `all services` (`id`, `service_name`, `price`, `description`, `technacian_id`, `type_of_service`) VALUES
(14, 'electrician work 1', 259, 'edefef ', 22, 'electrician'),
(15, 'electrician work 2', 120, 'wdwdw', 22, 'electrician'),
(16, 'technician work 1', 200, 'sdsdsd', 24, 'technician');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(10) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `request_id` int(10) NOT NULL,
  `technacian_id` int(10) NOT NULL,
  `paystatus` enum('confirmed','cancelled','pending','') NOT NULL,
  `technician_status` enum('cancelled','confirmed','pending','') NOT NULL,
  `assign_date` datetime NOT NULL DEFAULT current_timestamp(),
  `service_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `service_name`, `request_id`, `technacian_id`, `paystatus`, `technician_status`, `assign_date`, `service_id`, `user_id`, `quantity`) VALUES
(28, 'electrician work 1', 0, 22, 'confirmed', 'pending', '2024-12-06 23:17:03', 14, 14, 1);

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
  `type_of_service` enum('technician','electrician','','') NOT NULL,
  `terms_condition` tinyint(1) NOT NULL,
  `avalability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `technacian`
--

INSERT INTO `technacian` (`technacian_id`, `name`, `email`, `password`, `address`, `experience`, `service_id`, `phone`, `type_of_service`, `terms_condition`, `avalability`) VALUES
(22, 'test-1', 'test001@gmail.com', '$2y$10$AcJ0Y5kDH9htDXXWfr5rZuLZnTUo4FwL.4Q/vmZt8rAdL3X9grD0.', 'dwdwdwd', '', 0, 2344242, 'electrician', 0, 0),
(24, 'test-2', 'test002@gmail.com', '$2y$10$7roHzkrajtoQKkYDlKfx1OY4EMJYNUbkkfpPxsNCJP3txkoK0Qmt2', 'wdwd wdwdwd', '', 0, 2344242, 'technician', 0, 0);

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
(14, 'user_1', 'user', 'test1@gmail.com', 13314155, '$2y$10$uAkA2O0PtWscME4OVze/jOnsxB2EQ94N.dA1kEDTkunbFuGQZk83K', '2024-12-05 06:00:12'),
(15, 'tridip_user_1', 'user', 'test2@gmail.com', 13314155, '$2y$10$e5TnQHdobuPZFzmVVGT00.Kk2uBE1VpxOY6DMIDxifhkZu472wXIm', '2024-12-06 06:03:50');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `technacian`
--
ALTER TABLE `technacian`
  MODIFY `technacian_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
