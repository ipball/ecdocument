-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2018 at 05:46 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_categories`
--

INSERT INTO `ecdoc_categories` (`id`, `name`, `description`) VALUES
(1, 'Purchase', ''),
(2, 'Sales', ''),
(3, 'General', ''),
(4, 'Planning', ''),
(5, 'Store', ''),
(6, 'Accounting', '');

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_documents`
--

CREATE TABLE `ecdoc_documents` (
  `id` int(11) NOT NULL,
  `document_code` varchar(30) NOT NULL COMMENT 'รหัสเอกสาร',
  `register_date` datetime NOT NULL COMMENT 'วันที่ลงทะเบียนเอกสาร',
  `reference` varchar(100) DEFAULT NULL COMMENT 'อ้างอิงเอกสาร',
  `doc_remark` enum('Normal','ISO') DEFAULT NULL COMMENT 'เอกสารบ่งชี',
  `topic` varchar(100) NOT NULL COMMENT 'ชื่อเอกสาร',
  `store` varchar(100) DEFAULT NULL COMMENT 'สถานที่จัดเก็บเอกสาร',
  `filename` varchar(100) DEFAULT NULL COMMENT 'ชื่อไฟล์อัพโหลด',
  `description` text,
  `created_date` datetime NOT NULL COMMENT 'วันที่บันทึก',
  `modified_date` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `created_by` int(11) NOT NULL COMMENT 'ผู้สร้าง',
  `modified_by` int(11) NOT NULL COMMENT 'ผู้แก้ไข',
  `categorie_id` int(11) NOT NULL COMMENT 'หมวดหมู่',
  `document_folder_id` int(11) DEFAULT NULL COMMENT 'แฟ้มเอกสาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_documents`
--

INSERT INTO `ecdoc_documents` (`id`, `document_code`, `register_date`, `reference`, `doc_remark`, `topic`, `store`, `filename`, `description`, `created_date`, `modified_date`, `created_by`, `modified_by`, `categorie_id`, `document_folder_id`) VALUES
(1, 'PU0001', '2018-01-19 00:00:00', 'TO-A01', 'ISO', 'จัดซื้อ 1', 'ตู้ B123', '5a56475ad7d5f.pdf', 'รายละเอียดจัดซื้อจัดจ้าง', '2018-01-10 18:03:23', '2018-01-25 23:00:13', 1, 1, 6, 5),
(2, 'SO0001', '2018-02-01 00:00:00', 'AO003k8', NULL, 'ยอดขายประจำไตรมาส 1', 'ตู้ A111', '5a5647c766111.pdf', 'งานขายประจำไตรมาส (ลับ)', '2018-01-10 18:05:11', '2018-01-10 18:05:11', 1, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_document_folder`
--

CREATE TABLE `ecdoc_document_folder` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_document_folder`
--

INSERT INTO `ecdoc_document_folder` (`id`, `name`, `description`, `categorie_id`) VALUES
(1, 'ขาย 1', '													', 2),
(2, 'ขาย 2', '													', 2),
(3, 'ขาย 3', '													', 2),
(4, 'บัญชี 1', '													', 6),
(5, 'บัญชี 2', '													', 6),
(6, 'บัญชี 3', '													', 6),
(7, 'test01', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_permission`
--

CREATE TABLE `ecdoc_permission` (
  `categorie_id` int(11) NOT NULL,
  `usergroup_id` int(11) NOT NULL,
  `read` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_permission`
--

INSERT INTO `ecdoc_permission` (`categorie_id`, `usergroup_id`, `read`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 0),
(1, 4, 0),
(1, 5, 1),
(2, 1, 0),
(2, 2, 0),
(2, 3, 1),
(2, 4, 0),
(2, 5, 1),
(3, 1, 1),
(3, 2, 0),
(3, 3, 0),
(3, 4, 1),
(3, 5, 1),
(4, 1, 1),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 5, 1),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 1),
(5, 5, 1),
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 1),
(6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_usergroup`
--

CREATE TABLE `ecdoc_usergroup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_usergroup`
--

INSERT INTO `ecdoc_usergroup` (`id`, `name`) VALUES
(1, 'ผู้จัดการฝ่ายจัดซื้อ'),
(2, 'ฝ่ายจัดซื้อ'),
(3, 'ฝ่ายขาย'),
(4, 'ฝ่ายบัญชี'),
(5, 'เจ้าของบริษัท');

-- --------------------------------------------------------

--
-- Table structure for table `ecdoc_users`
--

CREATE TABLE `ecdoc_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `imagename` varchar(100) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `permission` enum('USER','ADMIN') NOT NULL,
  `permission_read` bigint(20) NOT NULL DEFAULT '0',
  `permission_write` bigint(20) NOT NULL DEFAULT '0',
  `permission_edit` bigint(20) NOT NULL DEFAULT '0',
  `permission_delete` bigint(20) NOT NULL DEFAULT '0',
  `usergroup_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecdoc_users`
--

INSERT INTO `ecdoc_users` (`id`, `username`, `password`, `imagename`, `display_name`, `permission`, `permission_read`, `permission_write`, `permission_edit`, `permission_delete`, `usergroup_id`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Administrator', 'ADMIN', 0, 0, 0, 0, 5),
(2, 'tawatsak', '96e79218965eb72c92a549dd5a330112', '', 'นายบอล ดอทคอม', 'USER', 0, 0, 0, 0, 3),
(3, 'test1', '96e79218965eb72c92a549dd5a330112', '', 'TEST2', 'USER', 0, 0, 0, 0, 1),
(4, 'testuser', '96e79218965eb72c92a549dd5a330112', '', 'จริงใจ ไม่ลวงหลอก', 'USER', 0, 0, 0, 0, 2);

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
-- Indexes for table `ecdoc_document_folder`
--
ALTER TABLE `ecdoc_document_folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecdoc_permission`
--
ALTER TABLE `ecdoc_permission`
  ADD PRIMARY KEY (`categorie_id`,`usergroup_id`) USING BTREE;

--
-- Indexes for table `ecdoc_usergroup`
--
ALTER TABLE `ecdoc_usergroup`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ecdoc_document_folder`
--
ALTER TABLE `ecdoc_document_folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ecdoc_usergroup`
--
ALTER TABLE `ecdoc_usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ecdoc_users`
--
ALTER TABLE `ecdoc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
