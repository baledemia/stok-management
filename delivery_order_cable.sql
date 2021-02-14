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
-- Struktur dari tabel `delivery_order_cable`
--

CREATE TABLE `delivery_order_cable` (
  `id_delivery_order` int(11) NOT NULL,
  `po_number` varchar(20) NOT NULL,
  `customer` varchar(5) NOT NULL,
  `bill_to` text NOT NULL,
  `ship_to` text NOT NULL,
  `delivery_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivery_order_cable`
--

INSERT INTO `delivery_order_cable` (`id_delivery_order`, `po_number`, `customer`, `bill_to`, `ship_to`, `delivery_date`, `total`, `notes`, `status`) VALUES
(1, '178/R/AMA/SS/II/2021', '2', 'Jl. Kartini Raya, Depok', 'Jl. Kartini Raya, Depok', '2021-02-02', 210000000, '2021-02-02', ''),
(2, '178/R/AMA/SS/II/2021', '3', 'Jl. Kartini Raya, Depok', 'jalan gajah mada no. 19', '2021-02-02', 250000000, '2021-02-02', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `delivery_order_cable`
--
ALTER TABLE `delivery_order_cable`
  ADD PRIMARY KEY (`id_delivery_order`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `delivery_order_cable`
--
ALTER TABLE `delivery_order_cable`
  MODIFY `id_delivery_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
