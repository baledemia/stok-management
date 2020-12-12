-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2020 pada 15.46
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

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
-- Struktur dari tabel `cable_category`
--

CREATE TABLE `cable_category` (
  `id_cat` int(11) NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_category`
--

INSERT INTO `cable_category` (`id_cat`, `name_category`, `status`) VALUES
(1, 'single', '1'),
(2, 'jumper', '1'),
(3, 'ftb af', '1'),
(4, 'ftb hy', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_import`
--

CREATE TABLE `cable_import` (
  `id` int(11) NOT NULL,
  `size_id` int(10) NOT NULL,
  `merk_id` int(10) NOT NULL,
  `cable_type_id` int(10) NOT NULL,
  `cable_name` varchar(30) NOT NULL,
  `cable_length` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_import`
--

INSERT INTO `cable_import` (`id`, `size_id`, `merk_id`, `cable_type_id`, `cable_name`, `cable_length`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 'Yuan blabla 2', '50', '2020-11-03 12:44:38', '2020-11-03 13:49:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_order`
--

CREATE TABLE `cable_order` (
  `id` int(10) NOT NULL,
  `no_sj` varchar(20) DEFAULT NULL,
  `cable_type_id` int(10) NOT NULL,
  `length` int(10) NOT NULL,
  `warehouse_id` int(10) NOT NULL,
  `stok_in` varchar(20) NOT NULL,
  `stok_out` varchar(20) NOT NULL,
  `noted` text NOT NULL,
  `haspel` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_order`
--

INSERT INTO `cable_order` (`id`, `no_sj`, `cable_type_id`, `length`, `warehouse_id`, `stok_in`, `stok_out`, `noted`, `haspel`, `tgl_order`, `created_at`, `updated_at`, `operator`) VALUES
(1, NULL, 2, 0, 0, '100', '', 'merah', '100x50', '2020-12-08', '2020-12-08 09:35:27', NULL, ''),
(2, NULL, 3, 50, 0, '50', '', 'hitam', 'hitam', '2020-12-08', '2020-12-08 09:35:27', NULL, ''),
(3, NULL, 4, 100, 0, '100', '', 'futaba', '100x50', '2020-12-08', '2020-12-08 09:35:27', NULL, ''),
(5, NULL, 2, 100, 0, '50', '', 'merah', '100x50', '2020-12-09', '2020-12-08 09:38:19', NULL, ''),
(6, NULL, 2, 30, 0, '100', '', 'tambah lagi', '100x50', '2020-12-11', '2020-12-11 14:02:54', NULL, ''),
(7, NULL, 3, 100, 0, '60', '', 'merah', '100x50', '2020-12-11', '2020-12-11 14:02:54', NULL, ''),
(8, 'SJ001', 4, 100, 0, '50', '', 'tambah lagi', '100x50', '2020-12-11', '2020-12-11 14:30:06', NULL, ''),
(9, 'SJ001', 2, 50, 0, '40', '', 'tambah lagi', '100x50', '2020-12-11', '2020-12-11 14:30:06', NULL, ''),
(10, 'SJ001', 3, 100, 0, '10', '', '100', '100x50', '2020-12-11', '2020-12-11 14:32:37', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_size`
--

CREATE TABLE `cable_size` (
  `id` int(11) NOT NULL,
  `size_name` varchar(10) NOT NULL,
  `result_size` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_size`
--

INSERT INTO `cable_size` (`id`, `size_name`, `result_size`, `created_at`, `updated_at`) VALUES
(2, '1 X 50', '0.50', '2020-11-03 17:28:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_stok`
--

CREATE TABLE `cable_stok` (
  `id` int(10) NOT NULL,
  `cable_id` int(10) NOT NULL,
  `warehouse_kode` varchar(8) NOT NULL,
  `stok` varchar(15) NOT NULL COMMENT 'stok secara keseluruhan - satuan kg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_stok`
--

INSERT INTO `cable_stok` (`id`, `cable_id`, `warehouse_kode`, `stok`, `created_at`, `updated_at`) VALUES
(1, 2, 'PAB', '290', '2020-12-08 09:35:27', '2020-12-11 00:00:00'),
(2, 3, 'PAB', '120', '2020-12-08 09:35:27', '2020-12-11 00:00:00'),
(3, 4, 'PAB', '150', '2020-12-08 09:35:27', '2020-12-11 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_type`
--

CREATE TABLE `cable_type` (
  `id` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_type`
--

INSERT INTO `cable_type` (`id`, `type_name`, `status`, `create_at`, `updated_at`) VALUES
(1, 'coaxial', '1', '2020-11-01 19:54:26', NULL),
(3, 'iphone futaba', '1', '2020-11-01 19:54:26', NULL),
(4, 'nyaf central', '1', '2020-11-28 20:52:56', NULL),
(5, 'nyaf futaba', '1', '2020-11-28 20:52:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cable_type_size`
--

CREATE TABLE `cable_type_size` (
  `id` int(10) NOT NULL,
  `cable_category` int(11) NOT NULL,
  `type_cable_id` int(10) NOT NULL,
  `size_cable_id` int(10) NOT NULL,
  `color_id` int(11) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `cable_length` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cable_type_size`
--

INSERT INTO `cable_type_size` (`id`, `cable_category`, `type_cable_id`, `size_cable_id`, `color_id`, `kode_supplier`, `cable_length`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 2, 1, '2', '50', '2020-11-03 17:49:58', '2020-11-28 11:44:31'),
(3, 3, 1, 2, 2, '2', '50', '2020-11-03 17:49:58', '2020-11-28 11:44:31'),
(4, 1, 3, 2, 1, '2', '100', '2020-11-28 21:11:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `kode_color` varchar(5) NOT NULL,
  `color_name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `color`
--

INSERT INTO `color` (`id`, `kode_color`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'M', 'merah', '2020-11-01 20:14:25', NULL),
(2, 'H', 'Hitam', '2020-11-01 20:14:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `import_order_stok`
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
-- Struktur dari tabel `kawat_type`
--

CREATE TABLE `kawat_type` (
  `id` int(10) NOT NULL,
  `type_kawat` varchar(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `machine`
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
-- Struktur dari tabel `material_kawat`
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
-- Struktur dari tabel `material_kawat_order`
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
-- Struktur dari tabel `material_kawat_stok`
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
-- Struktur dari tabel `material_pvc`
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
-- Struktur dari tabel `material_pvc_order`
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
-- Struktur dari tabel `material_pvc_stok`
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
-- Struktur dari tabel `menu`
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
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id` int(11) NOT NULL,
  `merk_name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id`, `merk_name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'Riweh bae', 'tangerang', '0812808080', '2020-11-03 12:21:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `oven_drum`
--

CREATE TABLE `oven_drum` (
  `id` int(11) NOT NULL,
  `tgl_oven` int(11) NOT NULL,
  `no_bobin` int(11) NOT NULL,
  `no_mesin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(10) NOT NULL,
  `type_material` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_pending`
--

CREATE TABLE `stock_pending` (
  `id` int(10) NOT NULL,
  `no_sj` varchar(20) DEFAULT NULL,
  `cable_type_id` int(10) NOT NULL,
  `warehouse_kode` varchar(8) NOT NULL,
  `length` int(10) NOT NULL,
  `qty` varchar(6) NOT NULL,
  `noted` text NOT NULL,
  `haspel` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock_pending`
--

INSERT INTO `stock_pending` (`id`, `no_sj`, `cable_type_id`, `warehouse_kode`, `length`, `qty`, `noted`, `haspel`, `tgl_order`, `created_at`, `operator`) VALUES
(2, 'SJ001', 4, '91AQ', 100, '10', 'tambah lagi', '100x50', '2020-12-11', '2020-12-11 14:35:02', 'admin-web');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
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
-- Struktur dari tabel `supplier`
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

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `name`, `number_phone`, `avatar`, `address`, `active`, `created_at`, `updated_at`) VALUES
(2, 'A001', 'PT. Wika Karya', '081289898989', 'Capture.PNG', 'Jl. Cengkareng', 1, '2020-11-03 10:34:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `role_id`, `fullname`, `username`, `password`, `active`, `created_at`, `last_login`) VALUES
(1, 1, 'Central Kabel', 'admin-web', '$2y$10$1wYO0SdmO9R9T0q62UCOL.hRF6GmAtAH3DFpxLqoxDmS8JYE/.1nq', 1, '2020-10-29 08:19:48', '2020-12-12 15:22:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_profile`
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
-- Dumping data untuk tabel `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `avatar`, `address`, `number_phone`, `updated_at`) VALUES
(1, 1, 'default.png', 'Jl. Kasir II No.12, RT.003/RW.005, Pasir Jaya, Kec. Jatiuwung, Kota Tangerang, Banten 15135', '5904798', '2020-10-29 15:29:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2020-10-29 08:17:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(10) NOT NULL,
  `kode_warehouse` varchar(5) NOT NULL,
  `noted` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `warehouse`
--

INSERT INTO `warehouse` (`id`, `kode_warehouse`, `noted`, `created_at`, `updated_at`) VALUES
(1, '91AQ', 'kantor no. 91AQ', '2020-11-04 07:49:11', NULL),
(2, 'PAB', 'Pabrik', '2020-11-28 13:15:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cable_category`
--
ALTER TABLE `cable_category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indeks untuk tabel `cable_import`
--
ALTER TABLE `cable_import`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cable_order`
--
ALTER TABLE `cable_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cable_size`
--
ALTER TABLE `cable_size`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cable_stok`
--
ALTER TABLE `cable_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cable_type`
--
ALTER TABLE `cable_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cable_type_size`
--
ALTER TABLE `cable_type_size`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `import_order_stok`
--
ALTER TABLE `import_order_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kawat_type`
--
ALTER TABLE `kawat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_kawat`
--
ALTER TABLE `material_kawat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_kawat_order`
--
ALTER TABLE `material_kawat_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_kawat_stok`
--
ALTER TABLE `material_kawat_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_pvc`
--
ALTER TABLE `material_pvc`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_pvc_order`
--
ALTER TABLE `material_pvc_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_pvc_stok`
--
ALTER TABLE `material_pvc_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_pending`
--
ALTER TABLE `stock_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cable_category`
--
ALTER TABLE `cable_category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `cable_import`
--
ALTER TABLE `cable_import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cable_order`
--
ALTER TABLE `cable_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `cable_size`
--
ALTER TABLE `cable_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cable_stok`
--
ALTER TABLE `cable_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `cable_type`
--
ALTER TABLE `cable_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cable_type_size`
--
ALTER TABLE `cable_type_size`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `import_order_stok`
--
ALTER TABLE `import_order_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kawat_type`
--
ALTER TABLE `kawat_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_kawat`
--
ALTER TABLE `material_kawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_kawat_order`
--
ALTER TABLE `material_kawat_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_kawat_stok`
--
ALTER TABLE `material_kawat_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_pvc`
--
ALTER TABLE `material_pvc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_pvc_order`
--
ALTER TABLE `material_pvc_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `material_pvc_stok`
--
ALTER TABLE `material_pvc_stok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_pending`
--
ALTER TABLE `stock_pending`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
