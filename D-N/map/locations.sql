-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 08:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discovering-nepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `latitude` float(11,8) NOT NULL,
  `longitude` float(11,8) NOT NULL,
  `place_name` varchar(255) DEFAULT NULL,
  `imgUrl` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `latitude`, `longitude`, `place_name`, `imgUrl`) VALUES
(1, 27.69191933, 85.34775543, 'one', 'https://www.google.com/maps/place/Budhanilkantha+Temple/@27.7778016,85.3620614,3a,75y,90t/data=!3m8!1e2!3m6!1sAF1QipMrjkHPPaKkp7qy94M1Vy07u9vPChXoPy6vq0d6!2e10!3e12!6shttps:%2F%2Flh5.googleusercontent.com%2Fp%2FAF1QipMrjkHPPaKkp7qy94M1Vy07u9vPChXoPy6vq0d6%3Dw114-h86-k-no!7i4032!8i3024!4m7!3m6!1s0x39eb1c226224709b:0x45a65134a18bfef1!8m2!3d27.7778016!4d85.3620614!10e5!16s%2Fg%2F120y85mv?authuser=0&entry=ttu#'),
(2, 27.68513107, 85.34876251, 'two', 'https://lh5.googleusercontent.com/p/AF1QipNSDcBhH0WjKWiZQbETWqchv0BvI497JBSIxys8=w408-h306-k-no'),
(3, 27.69200516, 85.34487915, 'three', 'https://lh5.googleusercontent.com/p/AF1QipO5XH2FjVPD8F7a-nPYFyLNLUw0isxBSstGgLm4=w408-h248-k-no'),
(4, 27.69148827, 85.36182404, 'fourr', 'https://lh5.googleusercontent.com/p/AF1QipNuVAAT3Gg425MetWvP2tdSuZJzFo2HrEutgbtk=w408-h544-k-no'),
(5, 27.69413185, 85.35340118, 'five', 'https://lh5.googleusercontent.com/p/AF1QipOWOx9JMVep3mEfldVNQi45oQF4J4hR7v23NLFD=w408-h313-k-no'),
(6, 27.77086639, 85.42317963, 'six', 'https://lh5.googleusercontent.com/p/AF1QipPKscYPqfGHPf3vHxqQU1ShraRqFjQS4OdpreUg=w408-h306-k-no'),
(7, 27.78347969, 85.38983154, 'seven', 'https://lh5.googleusercontent.com/p/AF1QipM_UM-D8G06V_-WjqjYep5NxVuo8FcGj8AcG5lw=w600-h240-k-no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
