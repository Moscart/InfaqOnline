-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 06:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infaqonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `artikel_id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `link` varchar(150) NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `judul` varchar(100) NOT NULL,
  `banner` varchar(500) NOT NULL DEFAULT 'default-banner-infaq-online-4x4.jpg',
  `isi` text NOT NULL,
  `dilihat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`artikel_id`, `user_email`, `link`, `tgl_upload`, `judul`, `banner`, `isi`, `dilihat`) VALUES
(1, 'admin@gmail.com', 'test-posting-dan-edit-artikel', '2022-08-14 20:16:54', 'Test Posting dan Edit Artikel', 'blog-header-design.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi suscipit libero ratione, similique voluptatem vel, pariatur quibusdam, expedita provident perspiciatis repudiandae ipsam aperiam vero praesentium amet facilis autem ullam explicabo.</p>', 9),
(2, 'admin@gmail.com', 'ini-artikel-kedua', '2022-08-18 07:36:51', 'Ini Artikel Kedua', 'mix.jpg', '<p>lorem ipsum sit dolor amet</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_iden` int(2) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL,
  `favicon` varchar(500) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `logo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_iden`, `nama_instansi`, `no_telp`, `alamat`, `nama_pimpinan`, `favicon`, `icon`, `logo`) VALUES
(1, 'Masjid Fikom UDB Surakarta', '(0271) 719552', 'Fakultas Ilmu Komputer Universitas Duta Bangsa, Jl. Bhayangkara No.55, Tipes, Kec. Serengan, Kota Surakarta, Jawa Tengah 57154', 'Takmir Masjid Fikom UDB Surakarta', 'default.ico', 'hand-holding-usd', 'kisspng-sadaqah-islam-android-application-package-baitul-m-5c87ac0e0bd907_1445821615523952780485-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu_front`
--

CREATE TABLE `menu_front` (
  `mf_id` int(11) NOT NULL,
  `title` varchar(15) NOT NULL,
  `url` varchar(150) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_front`
--

INSERT INTO `menu_front` (`mf_id`, `title`, `url`, `is_active`) VALUES
(1, 'Home', 'http://localhost/InfaqOnline/', 1),
(2, 'Artikel', 'http://localhost/InfaqOnline/artikel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_front_detail`
--

CREATE TABLE `menu_front_detail` (
  `mfd_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_front_detail`
--

INSERT INTO `menu_front_detail` (`mfd_id`, `parent_id`, `title`, `url`, `is_active`) VALUES
(1, 2, 'Infak', 'http://localhost/InfaqOnline/donasi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id_program` int(11) NOT NULL,
  `nama_program` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `nama_program`) VALUES
(1, 'Infak');

-- --------------------------------------------------------

--
-- Table structure for table `program_detail`
--

CREATE TABLE `program_detail` (
  `id_programdetail` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `nama_detailprogram` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `banner` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_detail`
--

INSERT INTO `program_detail` (`id_programdetail`, `id_program`, `nama_detailprogram`, `deskripsi`, `banner`) VALUES
(1, 1, 'Infak', '<p>Penggalangan infak akan digunakan untuk menjalankan kegiatan operasional masjid seperti,</p>\r\n\r\n<ol>\r\n	<li>bayar listrik</li>\r\n	<li>bayar pdam</li>\r\n	<li>pembelian alat kebersihan</li>\r\n</ol>', 'infaq.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_keluar`
--

CREATE TABLE `transaksi_keluar` (
  `id` varchar(15) NOT NULL,
  `petugas` varchar(128) NOT NULL,
  `program` varchar(100) DEFAULT NULL,
  `penerima_nama` varchar(60) NOT NULL,
  `penerima_telp` varchar(15) NOT NULL,
  `penerima_alamat_instansi` varchar(250) DEFAULT NULL,
  `tgl` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_keluar`
--

INSERT INTO `transaksi_keluar` (`id`, `petugas`, `program`, `penerima_nama`, `penerima_telp`, `penerima_alamat_instansi`, `tgl`, `nominal`, `keterangan`) VALUES
('TRK220817001', 'Admin', 'Infak', 'Bp. Sanusi', '087234563894', 'Jl. Kapas Madya II No.64', '2022-08-17', 350000, 'Donasi pembangunan masjid tahap I');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `nominal` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `program` varchar(100) DEFAULT NULL,
  `pdf_url` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_masuk`
--

INSERT INTO `transaksi_masuk` (`id`, `payment_type`, `tgl`, `order_id`, `user_nama`, `user_email`, `user_telp`, `nominal`, `status`, `program`, `pdf_url`) VALUES
(4, 'bank_transfer', '2022-09-08 13:10:00', 1139106355, 'Anonymous', '', '', 10000, 'settlement', '', ''),
(5, 'bank_transfer', '2022-08-17 13:11:08', 260026762, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(7, 'bank_transfer', '2022-07-14 13:17:22', 2071073145, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(9, 'bank_transfer', '2022-08-17 13:25:38', 1361395262, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(10, 'bank_transfer', '2022-08-17 13:26:53', 2145263383, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(11, 'bank_transfer', '2022-08-17 13:28:52', 173733355, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(12, 'bank_transfer', '2022-08-17 13:30:04', 323320558, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(13, 'bank_transfer', '2022-08-17 13:30:24', 1040773148, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(14, 'bank_transfer', '2022-08-17 13:37:24', 1826243934, 'User', 'user@gmail.com', '', 10000, 'settlement', 'Infak', ''),
(15, 'bank_transfer', '2022-08-18 12:20:15', 114832540, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(16, 'bank_transfer', '2022-08-18 12:25:46', 499685363, 'User', 'user@gmail.com', '', 10000, 'settlement', 'Infak', ''),
(17, 'bank_transfer', '2022-08-18 16:32:35', 2020653190, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(18, 'bank_transfer', '2022-08-18 16:35:06', 273405613, 'Anonymous', '', '', 10000, 'settlement', 'Infak', ''),
(19, 'bank_transfer', '2022-08-18 16:41:25', 882423789, 'Anonymous', '', '', 10000, 'settlement', 'Infak', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `no_telp`, `alamat`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '', '', 'default.jpg', '$2y$10$XR2C./ESawnYWfsb7y9NQ.CR5iKnvulCAhriXHT0xxfXPrvrEiP1.', 1, 1, 1587030576),
(2, 'User', 'user', 'user@gmail.com', '', '', 'default.jpg', '$2y$10$WiDX9h7lToAVoyk3CqKztuppHGOOqVYYhQvxI4a0Q0Ru2VMeKXBsu', 2, 1, 1602322568);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Donatur');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Donatur');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 3, 'Menu Backend', 'menu', 'fas fa-fw fa-folder', 1),
(3, 3, 'Submenu Backend', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(4, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-shield', 1),
(5, 1, 'Identitas', 'admin/identitas', 'fas fa-fw fa-id-card', 1),
(6, 1, 'Artikel', 'admin/artikel', 'fas fa-fw fa-newspaper', 1),
(7, 1, 'Program', 'admin/program', 'fas fa-fw fa-project-diagram', 1),
(8, 3, 'Frontend Navbar', 'menu/frontendnav', 'fas fa-fw fa-link', 1),
(9, 4, 'Dashboard', 'donatur', 'fas fa-fw fa-tachometer-alt', 1),
(10, 1, 'Transaksi Masuk', 'admin/trsmasuk', 'fas fa-fw fa-hand-holding-usd', 1),
(11, 1, 'Transaksi Keluar', 'admin/trskeluar', 'fas fa-fw fa-shopping-cart', 1),
(12, 1, 'Laporan', 'admin/laporan', 'fas fa-fw fa-book', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `menu_front`
--
ALTER TABLE `menu_front`
  ADD PRIMARY KEY (`mf_id`);

--
-- Indexes for table `menu_front_detail`
--
ALTER TABLE `menu_front_detail`
  ADD PRIMARY KEY (`mfd_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `program_detail`
--
ALTER TABLE `program_detail`
  ADD PRIMARY KEY (`id_programdetail`),
  ADD KEY `id_program` (`id_program`);

--
-- Indexes for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_front`
--
ALTER TABLE `menu_front`
  MODIFY `mf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_front_detail`
--
ALTER TABLE `menu_front_detail`
  MODIFY `mfd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program_detail`
--
ALTER TABLE `program_detail`
  MODIFY `id_programdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_front_detail`
--
ALTER TABLE `menu_front_detail`
  ADD CONSTRAINT `menu_front_detail_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu_front` (`mf_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_detail`
--
ALTER TABLE `program_detail`
  ADD CONSTRAINT `program_detail_ibfk_1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
