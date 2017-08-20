-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2017 at 11:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecdocument`
--

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_categories`
--

CREATE TABLE `ecdoc_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ecdoc_categories`
--

INSERT INTO `ecdoc_categories` (`id`, `name`, `description`) VALUES
(1, 'งานวิจัย', 'งานวิจัยถูกเก็บไว้ที่แห่งนี้...'),
(2, 'คุณภาพ ISO', 'เอกสารรับประกันคุณภาพตามหลัก ISO ของบริษัท\r\nเพื่อใช้อ้างอิงกับลูกค้า'),
(3, 'หลักการบริหาร', 'เอกสารสำหรับพนักบริหาร...'),
(4, 'เอกสารการทำงาน', 'ข้อกำหนดการทำงานของแต่ละแผนกในองค์กร'),
(5, 'โครงสร้างองค์กร', 'เอกสารการจัดทำคู่มือคุณภาพ '),
(6, 'เอกสารสนับสนุน', 'เอกสารที่สนับสนุนการทำงาน');

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_documents`
--

CREATE TABLE `ecdoc_documents` (
  `id` int(11) NOT NULL,
  `document_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเอกสาร',
  `register_date` datetime NOT NULL COMMENT 'วันที่ลงทะเบียนเอกสาร',
  `reference` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'อ้างอิงเอกสาร',
  `topic` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเอกสาร',
  `store` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานที่จัดเก็บเอกสาร',
  `filename` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์อัพโหลด',
  `description` text COLLATE utf8_unicode_ci,
  `created_date` datetime NOT NULL COMMENT 'วันที่บันทึก',
  `modified_date` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `created_by` int(11) NOT NULL COMMENT 'ผู้สร้าง',
  `modified_by` int(11) NOT NULL COMMENT 'ผู้แก้ไข',
  `categorie_id` int(11) NOT NULL COMMENT 'หมวดหมู่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ecdoc_documents`
--

INSERT INTO `ecdoc_documents` (`id`, `document_code`, `register_date`, `reference`, `topic`, `store`, `filename`, `description`, `created_date`, `modified_date`, `created_by`, `modified_by`, `categorie_id`) VALUES
(2, 'DC1235466', '2015-09-10 00:00:00', 'ไม่มีเอกสารอ้างอิง', 'ISO9000', 'ตู้ชั้นที่ 1', '560969afd7f66.pdf', 'AAAAAAAAAAAAAAAAAAAAAAAAAA\r\nBBBBBBBBBBBBBBBBBBBBBBBB', '2015-09-28 18:24:15', '2017-05-02 03:50:31', 1, 1, 5),
(3, 'DC3425622', '2015-10-01 00:00:00', 'HDDGG-011', 'OTH00111', '', '5609735ea26d3.pdf', '', '2015-09-28 19:05:34', '2015-09-28 19:05:34', 1, 1, 6),
(4, 'DDDDDD', '2017-06-23 00:00:00', 'PM-932221', 'เอกสารสอบจบ', '', '594e8137e5e88.pdf', 'เอกสารสำคัญ', '2017-06-24 17:11:52', '2017-06-24 17:11:52', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_users`
--

CREATE TABLE `ecdoc_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permission` enum('USER','ADMIN') COLLATE utf8_unicode_ci NOT NULL,
  `permission_read` bigint(20) NOT NULL DEFAULT '0',
  `permission_write` bigint(20) NOT NULL DEFAULT '0',
  `permission_edit` bigint(20) NOT NULL DEFAULT '0',
  `permission_delete` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ecdoc_users`
--

INSERT INTO `ecdoc_users` (`id`, `username`, `password`, `imagename`, `display_name`, `permission`, `permission_read`, `permission_write`, `permission_edit`, `permission_delete`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Administrator', 'ADMIN', 0, 0, 0, 0),
(2, 'tawatsak', '860074d2d36ec43e78e83c7663155336', '', 'นายบอล ดอทคอม', 'ADMIN', 0, 0, 0, 0),
(3, 'test1', '5a105e8b9d40e1329780d62ea2265d8a', '', 'TEST2', 'USER', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ecdoc_categories`
--
ALTER TABLE `ecdoc_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecdoc_documents`
--
ALTER TABLE `ecdoc_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecdoc_users`
--
ALTER TABLE `ecdoc_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ecdoc_categories`
--
ALTER TABLE `ecdoc_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ecdoc_documents`
--
ALTER TABLE `ecdoc_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ecdoc_users`
--
ALTER TABLE `ecdoc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
