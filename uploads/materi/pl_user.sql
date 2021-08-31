-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2021 at 08:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_poliklinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `pl_user`
--

DROP TABLE IF EXISTS `pl_user`;
CREATE TABLE `pl_user` (
  `id` int(15) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_person` varchar(15) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `category` tinyint(1) NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_exist` tinyint(1) NOT NULL DEFAULT '1',
  `uc_dep` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pl_user`
--

INSERT INTO `pl_user` (`id`, `uc`, `uc_person`, `full_name`, `username`, `password`, `email`, `category`, `photo`, `is_active`, `is_exist`, `uc_dep`) VALUES
(1, '607ca7881b833', '607ca7881b83c', '', 'macderi', '202cb962ac59075b964b07152d234b70', 'dyordhanideri@gmail.com', 2, 'a7d5b12bf2148d479c43183f0f6a0859.jpeg', 0, 1, '607c3d7ca553f'),
(2, '607cf5202ad4c', '607cf5202ad5a', 'Jamilah', 'jamilah', '202cb962ac59075b964b07152d234b70', 'jamilah@gmail.com', 2, '2eba62bfe2b28a7abd8347c49e5ebf51.jpg', 0, 1, '607e4d067ec6b'),
(3, '607cf549d3300', '607cf549d3309', '', 'kurnia', '202cb962ac59075b964b07152d234b70', 'kurnia@gmail.com', 2, 'bb364ef3ddd99c02952b031aafff2465.jpg', 0, 1, '607c3d7ca553f'),
(4, '607cf571723bc', '607cf571723df', '', 'nadya', '202cb962ac59075b964b07152d234b70', 'nad@gmail.com', 2, 'ab9beaba1f6fea8dc9c5272256804120.jpeg', 0, 1, '607c3d7ca553f'),
(5, '607d308389336', '607d308389384', 'Malik Kurnia Asih', 'malik', '202cb962ac59075b964b07152d234b70', 'malik@gmail.com', 3, 'ae794e4140018eb2db8921a9474e1737.jpg', 0, 1, NULL),
(6, '607d3c8898505', '607d3c8898510', 'Guntur', 'guntur', '202cb962ac59075b964b07152d234b70', 'guntur@gmail.com', 3, '325bcc1c115f501cd58132f8a71956b0.jpeg', 1, 1, NULL),
(7, '607f5f262c588', NULL, 'Administrator', 'admin', '202cb962ac59075b964b07152d234b70', 'dyordhanideri@gmail.com', 1, NULL, 1, 1, ''),
(8, '607f5f4d66d1c', NULL, 'Klinik Herbalis', 'klinikherbalis', '202cb962ac59075b964b07152d234b70', 'dyordhanideri@gmail.com', 4, NULL, 1, 1, '607e4d3d69642'),
(9, '607f5f6b6a6f8', NULL, 'Apoteker', 'apoteker', '202cb962ac59075b964b07152d234b70', 'apoteker@gmail.com', 5, NULL, 1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pl_user`
--
ALTER TABLE `pl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pl_user`
--
ALTER TABLE `pl_user`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
