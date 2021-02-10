-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2021 pada 14.20
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
-- Database: `sukses-setia-update`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_order_cable_detail`
--

CREATE TABLE `delivery_order_cable_detail` (
  `id_delivery_detail` int(11) NOT NULL,
  `delivery_code_detail` varchar(20) NOT NULL,
  `cable_code` varchar(20) NOT NULL,
  `qty` int(9) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivery_order_cable_detail`
--

INSERT INTO `delivery_order_cable_detail` (`id_delivery_detail`, `delivery_code_detail`, `cable_code`, `qty`, `satuan`, `price`, `sub_total`) VALUES
(1, '1', '1', 1000, '', 10000, 10000000),
(2, '1', '3', 1000, '', 200000, 200000000),
(3, '2', '4', 1000, 'meter', 250000, 250000000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `delivery_order_cable_detail`
--
ALTER TABLE `delivery_order_cable_detail`
  ADD PRIMARY KEY (`id_delivery_detail`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `delivery_order_cable_detail`
--
ALTER TABLE `delivery_order_cable_detail`
  MODIFY `id_delivery_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
