-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 06:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `tbl_kategori_id` int(11) NOT NULL,
  `kategori_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`tbl_kategori_id`, `kategori_name`) VALUES
(1, 'Consumer Electronics'),
(2, 'Home&Garden'),
(3, 'Pets&Pet Supplies'),
(4, 'Sporting Goods'),
(5, 'Health'),
(6, 'Children'),
(7, 'Fashion'),
(8, 'Beauty'),
(9, 'Video Games&Consoles'),
(10, 'Office Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `tbl_product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `tbl_kategori_id` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `selling` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `productImage` text NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`tbl_product_id`, `product_name`, `tbl_kategori_id`, `purchase`, `selling`, `stock`, `productImage`, `date_updated`) VALUES
(1, 'TV Smart Android TV 32\"', 10, 100, 120, 50, '../uploads/television.png', '2025-01-20 11:01:49'),
(2, 'TV LED 32\'', 1, 150, 180, 60, '../uploads/television.png', '2025-01-20 11:02:06'),
(3, 'Iphone 13 128GB', 1, 80, 100, 30, '../uploads/mobilephone.jpg', '2025-01-20 11:02:29'),
(4, 'Keyboard', 10, 200, 220, 70, '../uploads/keyboard.jpeg', '2025-01-20 11:03:29'),
(5, 'Monitor 18\"', 10, 90, 110, 40, '../uploads/monitor.jpeg', '2025-01-20 11:03:17'),
(6, 'Mouse trackpad', 10, 10, 10, 100, '../uploads/mouse.png', '2025-01-20 11:03:56'),
(7, 'Blander Juicer', 1, 10, 10, 10, '../uploads/Blander.jpg', '2025-01-20 11:07:10'),
(8, 'Monitor', 1, 100, 120, 10, '../uploads/monitor.jpeg', '2025-01-20 11:07:53'),
(9, 'TV Samsung 48\"', 1, 10, 100, 100, '../uploads/television.png', '2025-01-20 11:08:25'),
(10, 'AC Sharp 1/2 PK', 5, 100, 10, 10, '../uploads/airconditioner.jpg', '2025-01-20 11:08:50'),
(11, 'handphone', 5, 100, 100, 100, '../uploads/mobilephone.jpg', '2025-01-20 10:53:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`tbl_kategori_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`tbl_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `tbl_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `tbl_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
