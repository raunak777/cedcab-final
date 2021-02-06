-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2021 at 05:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `email`, `name`, `date`, `mobile`, `status`, `is_admin`, `password`) VALUES
(1, 'admin@gmail.com', 'Admin', '06-01-2021', '9999999999', 1, 1, '$2y$10$hDe9ArQojEa.fL2JiUshE.fDSDfXDMmc8kQGV5JaqGBWyDsMKKnVS'),
(20, 'raunak@gmail.com', 'Raunak', '06-01-2021', '9999999999', 1, 0, '$2y$10$sY44sbFaOK3fmIfIaX/OheC1vLP3ZNptMYwxS4dPfgaZ7cS.yx6Fi'),
(21, 'puneet@gmail.com', 'Puneet', '06-01-2021', '9999999999', 1, 0, '$2y$10$kXrcqI6.YAnLOK7JXWoTnu1sgPjvWbOiC.kvuO7qRqK28QTBnlrKO'),
(22, 'raunakyadav00@gmail.com', 'Raunak Yadav', '08-01-2021', '9616890120', 1, 0, '$2y$10$mIuqWrmuhB26oNC5cDTcc.ZBWcHqAog0WfL1kgR0a9GgusRj6KEw.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', '0', 1),
(2, 'IndiraNagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki', '60', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` date NOT NULL,
  `pickup` varchar(255) NOT NULL,
  `todrop` varchar(255) NOT NULL,
  `total_distance` varchar(255) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `total_fare` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `cuser_id` int(255) NOT NULL,
  `cab_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup`, `todrop`, `total_distance`, `luggage`, `total_fare`, `status`, `cuser_id`, `cab_type`) VALUES
(33, '2021-01-07', 'Charbagh', 'IndiraNagarion.reload();', '10', '0', '185', 1, 20, 'CedMicro'),
(48, '2021-01-07', 'Charbagh', 'IndiraNagar', '10', '0', '185', 1, 21, 'CedMicro'),
(50, '2021-01-07', 'Charbagh', 'IndiraNagar', '10', '0', '185', 2, 20, 'CedMicro'),
(51, '2021-01-07', 'Charbagh', 'IndiraNagar', '10', '0', '355', 2, 20, 'CedRoyal'),
(52, '2021-01-07', 'Charbagh', 'IndiraNagar', '10', '0', '355', 1, 20, 'CedRoyal'),
(53, '2021-01-07', 'Charbagh', 'Barabanki', '60', '30', '1255', 1, 20, 'CedRoyal'),
(54, '2021-01-07', 'Charbagh', 'IndiraNagar', '10', '0', '185', 2, 20, 'CedMicro'),
(55, '2021-01-07', 'IndiraNagar', 'BBD', '20', '0', '305', 1, 20, 'CedMicro'),
(56, '2021-01-07', 'IndiraNagar', 'Charbagh', '10', '50', '555', 1, 21, 'CedRoyal'),
(57, '2021-01-07', 'IndiraNagar', 'Charbagh', '10', '50', '555', 1, 21, 'CedRoyal'),
(58, '2021-01-07', 'Barabanki', 'Faizabad', '40', '100', '1235', 1, 21, 'CedSUV'),
(59, '2021-01-07', 'Barabanki', 'IndiraNagar', '50', '25', '1015', 1, 21, 'CedMini'),
(60, '2021-01-07', 'Barabanki', 'IndiraNagar', '50', '100', '1015', 2, 20, 'CedMini'),
(61, '2021-01-08', 'Charbagh', 'BBD', '30', '20', '655', 1, 22, 'CedMini'),
(62, '2021-01-08', 'Barabanki', 'BBD', '30', '20', '735', 2, 20, 'CedRoyal'),
(63, '2021-01-08', 'BBD', 'Barabanki', '30', '0', '425', 1, 20, 'CedMicro'),
(64, '2021-01-11', 'Charbagh', 'Gorakhpur', '210', '45', '3000', 1, 20, 'CedRoyal'),
(65, '2021-02-03', 'Charbagh', 'IndiraNagar', '10', '0', '185', 2, 20, 'CedMicro'),
(66, '2021-02-05', 'Charbagh', 'IndiraNagar', '10', '0', '185', 0, 20, 'CedMicro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
