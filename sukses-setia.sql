-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 30, 2020 at 01:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sukses-setia`
--

-- --------------------------------------------------------

--
-- Table structure for table `cable_import`
--

CREATE TABLE `cable_import` (
  `id` int(11) NOT NULL,
  `size_id` int(10) NOT NULL,
  `merk_id` int(10) NOT NULL,
  `cable_type_id` int(10) NOT NULL,
  `cable_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cable_order_stok`
--

CREATE TABLE `cable_order_stok` (
  `id` int(10) NOT NULL,
  `cable_type_id` int(10) NOT NULL,
  `length` int(10) NOT NULL,
  `warehouse_id` int(10) NOT NULL,
  `stok_in` varchar(20) NOT NULL,
  `stok_out` varchar(20) NOT NULL,
  `result_stok` varchar(20) NOT NULL,
  `noted` text NOT NULL,
  `haspel` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cable_size`
--

CREATE TABLE `cable_size` (
  `id` int(11) NOT NULL,
  `size_name` varchar(10) NOT NULL,
  `result_size` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cable_type`
--

CREATE TABLE `cable_type` (
  `id` int(10) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  `status` varchar(5) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cable_type_size`
--

CREATE TABLE `cable_type_size` (
  `id` int(10) NOT NULL,
  `type_cable_id` int(10) NOT NULL,
  `size_cable_id` int(10) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `cable_length` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `kode_color` varchar(5) NOT NULL,
  `color_name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `import_order_stok`
--

CREATE TABLE `import_order_stok` (
  `id` int(10) NOT NULL,
  `cable_import_id` int(10) NOT NULL,
  `length` int(10) NOT NULL,
  `stok_in` varchar(20) NOT NULL,
  `stok_out` varchar(20) NOT NULL,
  `result_stok` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `noted` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kawat_type`
--

CREATE TABLE `kawat_type` (
  `id` int(10) NOT NULL,
  `type_kawat` varchar(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(10) NOT NULL,
  `no_machine` varchar(6) NOT NULL,
  `type_machine` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material_kawat`
--

CREATE TABLE `material_kawat` (
  `id` int(11) NOT NULL,
  `material_id` int(10) NOT NULL,
  `material_type` varchar(10) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `no_bobin` varchar(5) NOT NULL,
  `material_name` varchar(20) NOT NULL COMMENT 'Contoh: AF 0.50 LMK	',
  `berat_bobin` varchar(10) NOT NULL,
  `bruto` varchar(10) NOT NULL,
  `netto` varchar(10) NOT NULL,
  `meteran` varchar(20) NOT NULL,
  `size` varchar(10) NOT NULL,
  `result_size` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_kawat_order`
--

CREATE TABLE `material_kawat_order` (
  `id` int(10) NOT NULL,
  `material_kawat_id` int(10) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `incoming_stok` varchar(20) NOT NULL,
  `stok_out` varchar(20) NOT NULL,
  `result_stok` varchar(20) NOT NULL,
  `information` text NOT NULL,
  `tgl_order` date NOT NULL,
  `tgl_finish_production` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `operator` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_kawat_stok`
--

CREATE TABLE `material_kawat_stok` (
  `id` int(10) NOT NULL,
  `material_kawat_id` int(10) NOT NULL,
  `stok` varchar(15) NOT NULL COMMENT 'stok secara keseluruhan - satuan kg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_pvc`
--

CREATE TABLE `material_pvc` (
  `id` int(10) NOT NULL,
  `material_id` int(10) NOT NULL,
  `kode_pvc` varchar(5) NOT NULL,
  `color_id` int(10) NOT NULL,
  `pvc_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_pvc_order`
--

CREATE TABLE `material_pvc_order` (
  `id` int(10) NOT NULL,
  `material_pvc_id` int(10) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `tgl_order` date NOT NULL,
  `incoming_stok` varchar(20) NOT NULL,
  `stok_out` varchar(20) NOT NULL,
  `result_stok` varchar(20) NOT NULL,
  `information` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `operator` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_pvc_stok`
--

CREATE TABLE `material_pvc_stok` (
  `id` int(10) NOT NULL,
  `material_pvc_id` int(10) NOT NULL,
  `stok` varchar(15) NOT NULL COMMENT 'stok secara keseluruhan - satuan kg	',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `numrow` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` int(11) NOT NULL,
  `merk_name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oven_drum`
--

CREATE TABLE `oven_drum` (
  `id` int(11) NOT NULL,
  `tgl_oven` int(11) NOT NULL,
  `no_bobin` int(11) NOT NULL,
  `no_mesin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(10) NOT NULL,
  `type_material` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number_phone` varchar(15) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `fullname` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `fullname`, `username`, `password`, `active`, `created_at`, `last_login`) VALUES
(1, 1, 'Central Kabel', 'admin-web', '$2y$10$1wYO0SdmO9R9T0q62UCOL.hRF6GmAtAH3DFpxLqoxDmS8JYE/.1nq', 1, '2020-10-29 08:19:48', '2020-10-29 09:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `number_phone` varchar(15) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `avatar`, `address`, `number_phone`, `updated_at`) VALUES
(1, 1, 'default.png', 'Jl. Kasir II No.12, RT.003/RW.005, Pasir Jaya, Kec. Jatiuwung, Kota Tangerang, Banten 15135', '5904798', '2020-10-29 15:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2020-10-29 08:17:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(10) NOT NULL,
  `kode_warehouse` varchar(5) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cable_import`
--
ALTER TABLE `cable_import`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cable_order_stok`
--
ALTER TABLE `cable_order_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cable_size`
--
ALTER TABLE `cable_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cable_type`
--
ALTER TABLE `cable_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cable_type_size`
--
ALTER TABLE `cable_type_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_order_stok`
--
ALTER TABLE `import_order_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kawat_type`
--
ALTER TABLE `kawat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_kawat`
--
ALTER TABLE `material_kawat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_kawat_order`
--
ALTER TABLE `material_kawat_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_kawat_stok`
--
ALTER TABLE `material_kawat_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_pvc`
--
ALTER TABLE `material_pvc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_pvc_order`
--
ALTER TABLE `material_pvc_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_pvc_stok`
--
ALTER TABLE `material_pvc_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cable_import`
--
ALTER TABLE `cable_import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cable_order_stok`
--
ALTER TABLE `cable_order_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cable_size`
--
ALTER TABLE `cable_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cable_type`
--
ALTER TABLE `cable_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cable_type_size`
--
ALTER TABLE `cable_type_size`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_order_stok`
--
ALTER TABLE `import_order_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kawat_type`
--
ALTER TABLE `kawat_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_kawat`
--
ALTER TABLE `material_kawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_kawat_order`
--
ALTER TABLE `material_kawat_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_kawat_stok`
--
ALTER TABLE `material_kawat_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_pvc`
--
ALTER TABLE `material_pvc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_pvc_order`
--
ALTER TABLE `material_pvc_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_pvc_stok`
--
ALTER TABLE `material_pvc_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
