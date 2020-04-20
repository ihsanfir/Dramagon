-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2020 pada 17.15
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dramagon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telpon` varchar(13) NOT NULL,
  `jenkel` varchar(20) NOT NULL,
  `tanggalLahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `email`, `telpon`, `jenkel`, `tanggalLahir`) VALUES
(1, 'IhsanX2', '$2y$10$En2xBfwqmxwUzJ1L3A18guNv6preWKFuaTGPMJbMrrSq5dtvp0Y1.', 'Ihsan Firdaus', 'ihsanfirdaus16@gmail.com', '085216761894', 'laki', '1999-08-16'),
(2, 'ihsanfir', '$2y$10$ijXd/H4ysk30kDtd5.0npedth6pNnUQNVHo7qDdWNk8cWKBkzvz/q', '', 'ihsanfirdaus16@gmail.com', '', '', '0000-00-00'),
(3, 'kuyhaaa', '$2y$10$JPVUFDQmq1MIRQzN5NIIJORcvKRKvEVtPPE7Y2UZk70BgZowdDbAW', '', 'ihsanfirdaus10@gmail.com', '', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
