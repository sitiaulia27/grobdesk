-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 10:16 AM
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
-- Database: `grobdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_category_ticket`
--

CREATE TABLE `m_category_ticket` (
  `category_ticket_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('disabled','enabled') NOT NULL,
  `sort_order` tinyint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_category_ticket`
--

INSERT INTO `m_category_ticket` (`category_ticket_id`, `name`, `status`, `sort_order`) VALUES
(1, 'Akun Grobmart', 'enabled', 1),
(2, 'Konfirmasi Pembayaran', 'enabled', 2),
(3, 'Pemesanan/Order Bermasalah', 'enabled', 3),
(4, 'Pembatalan Pesanan', 'enabled', 4),
(6, 'Refund', 'enabled', 5),
(7, 'RTS/Order Gagal Kirim', 'enabled', 6),
(8, 'Konfirmasi Ganti Cover Buku', 'enabled', 7),
(9, 'Lainnya', 'enabled', 8);

-- --------------------------------------------------------

--
-- Table structure for table `m_macro`
--

CREATE TABLE `m_macro` (
  `macro_id` bigint(20) NOT NULL,
  `macro_name` varchar(160) NOT NULL,
  `macro_text` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` enum('disabled','enabled') NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_macro`
--

INSERT INTO `m_macro` (`macro_id`, `macro_name`, `macro_text`, `user_id`, `status`) VALUES
(1, 'Refund Terlambat', 'Hai Kak, <br /> mohon maaf untuk keterlambatan refundnya, kami akan segera proses ya', 3, 'enabled'),
(3, 'admin', 'terserah', 2, 'enabled'),
(4, 'rijal', 'bebas', 3, 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE `m_menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`id`, `nama`, `url`) VALUES
(1, 'access_menu', ''),
(2, 'ticket', 'http://localhost/grobdesk/data_ticket.php'),
(3, 'tanggapan', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_prm`
--

CREATE TABLE `m_prm` (
  `prm_id` int(11) NOT NULL,
  `prm_name` varchar(255) NOT NULL,
  `prm_file` varchar(255) NOT NULL,
  `prm_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_prm`
--

INSERT INTO `m_prm` (`prm_id`, `prm_name`, `prm_file`, `prm_group`) VALUES
(1, 'ROLE MENU', 'roleMenu.php', 'ROLE'),
(2, 'ADD ROLE', 'roleAdd.php', 'ROLE'),
(3, 'DELETE ROLE', 'roleDelete.php', 'ROLE'),
(4, 'UPDATE ROLE', 'roleEdit.php', 'ROLE'),
(5, 'MENU USER', 'user_menu.php', 'USER'),
(6, 'DELETE USER', 'user_delete.php', 'USER'),
(7, 'ADD USER', 'user_add.php', 'USER'),
(8, 'EDIT USER', 'user_update.php', 'USER'),
(10, 'DETAIL TICKET', 'detail_ticket.php', 'TICKET'),
(11, 'DASHBOARD', 'admin.php', 'ADMIN'),
(12, 'UNASSIGNED TICKET', 'unassigned_tickets.php', 'TICKET'),
(13, 'TICKET', 'data_ticket.php', 'TICKET'),
(14, 'DETAIL DATA TICKET', 'data_detail_ticket.php', 'TICKET'),
(15, 'YOUR UNSOLVED TICKETS', 'your_unsolved_tickets.php', 'TICKET'),
(16, 'CATEGORY TICKET', 'category_index.php', 'TICKET'),
(17, 'ADD TICKET', 'category_add.php', 'TICKET'),
(18, 'CATEGORY DELETE', 'category_delete.php', 'TICKET'),
(19, 'CATEGORY UPDATE', 'category_update.php', 'TICKET'),
(20, 'PENDING TICKET', 'pending_tickets.php', 'TICKET'),
(21, 'RECENTLY SOLVED TICKET', 'recently_solved_tickets.php', 'TICKET'),
(22, 'RECENTLY UPDATE TICKET', 'recently_updated_tickets.php', 'TICKET'),
(23, 'DELETE TICKET', 'delete_tickets.php', 'TICKET'),
(24, 'ALL UNSOLVED TICKET', 'all_unsolved_tickets.php', 'TICKET'),
(25, 'ORDER DETAIL', 'order_detail.php', 'TICKET'),
(26, 'ADMIN PROFIL', 'profil_admin.php', 'ADMIN'),
(27, 'MACRO INDEX', 'macro_index.php', 'ADMIN'),
(28, 'MACRO ADD', 'macro_add.php', 'ADMIN'),
(29, 'MACRO EDIT', 'macro_edit.php', 'ADMIN'),
(30, 'MACRO DELETE', 'macro_delete.php', 'ADMIN'),
(31, 'ASSIGNED TICKETS', 'assigned_tickets.php', 'TICKET');

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

CREATE TABLE `m_role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('disabled','enabled') NOT NULL,
  `role_acces` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`role_id`, `name`, `status`, `role_acces`) VALUES
(1, 'Admin', 'enabled', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]'),
(2, 'Supervisor', 'enabled', '[\"26\",\"11\",\"2\",\"3\",\"1\",\"4\",\"17\",\"24\",\"31\",\"18\",\"16\",\"19\",\"23\",\"14\",\"10\",\"25\",\"20\",\"21\",\"22\",\"13\",\"12\",\"15\",\"7\"]'),
(3, 'Agent', 'enabled', '[\"2\",\"3\",\"1\",\"4\"]');

-- --------------------------------------------------------

--
-- Table structure for table `m_ticket`
--

CREATE TABLE `m_ticket` (
  `ticket_id` bigint(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `email` varchar(160) NOT NULL,
  `category_ticket` int(11) NOT NULL,
  `subject` varchar(160) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('open','solved','unassigned','delete') NOT NULL,
  `id_join` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_ticket_detail`
--

CREATE TABLE `m_ticket_detail` (
  `ticket_detail_id` bigint(20) NOT NULL,
  `ticket_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(20) NOT NULL,
  `status` enum('open','solved','unassigned') NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attachment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(160) NOT NULL,
  `salt` char(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(7) NOT NULL,
  `status` enum('enabled','disabled') NOT NULL,
  `signature` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `name`, `email`, `salt`, `password`, `role_id`, `status`, `signature`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1', '', 1, 'enabled', ''),
(2, 'auliaa', 'aulia12@gmail.com', 'L0q5C', '28df6c71638d6b66ab8c5692d4166cd4', 2, 'disabled', ''),
(3, 'mujahidsujud', 'mujahid12@gmail.com', 'LuHXC', '7a1d4344cb17aaf08ee893c8bd14bcb1', 1, 'enabled', ''),
(5, 'rijal', 'rijal02@gmail.com', 'Fa6du', '1cb9a7b6726eff7f03e9c49a956a8407', 3, 'enabled', ''),
(8, 'Amelia', 'amelianazhaa@gmail.com', 'vd2mx', '1295da480449c3343df7eddb0d726354', 1, 'enabled', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_category_ticket`
--
ALTER TABLE `m_category_ticket`
  ADD PRIMARY KEY (`category_ticket_id`);

--
-- Indexes for table `m_macro`
--
ALTER TABLE `m_macro`
  ADD PRIMARY KEY (`macro_id`);

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_prm`
--
ALTER TABLE `m_prm`
  ADD PRIMARY KEY (`prm_id`);

--
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `m_ticket`
--
ALTER TABLE `m_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `m_ticket_detail`
--
ALTER TABLE `m_ticket_detail`
  ADD PRIMARY KEY (`ticket_detail_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_category_ticket`
--
ALTER TABLE `m_category_ticket`
  MODIFY `category_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `m_macro`
--
ALTER TABLE `m_macro`
  MODIFY `macro_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_prm`
--
ALTER TABLE `m_prm`
  MODIFY `prm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `m_ticket`
--
ALTER TABLE `m_ticket`
  MODIFY `ticket_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_ticket_detail`
--
ALTER TABLE `m_ticket_detail`
  MODIFY `ticket_detail_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
