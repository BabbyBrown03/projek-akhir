-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2025 pada 08.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resepmasakan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_resep` varchar(100) NOT NULL,
  `bahan` text NOT NULL,
  `langkah` text NOT NULL,
  `biaya` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `id_user`, `id_kategori`, `nama_resep`, `bahan`, `langkah`, `biaya`, `gambar`, `created_at`) VALUES
(1140306004, 0, 0, 'Ayam Goreng Krispi', 'Ayam, Tepung, Minyak', '1. Lumuri ayam dengan tepung\r\n2. Goreng hingga keemasan', 25000, 'ayamgoreng_krispi.jpg', '2025-05-24 12:48:39'),
(1140306005, 0, 0, 'Sambal Terasi', 'Cabe, Terasi, Garam', '1. Ulek semua bahan\r\n2. Tumis sebentar', 5000, 'sambalterasi.jpg', '2025-05-24 12:48:39'),
(1140306006, 0, 0, 'Sayur Asem', 'Kacang panjang, Melinjo, Asam', '1. Rebus semua bahan\r\n2. Tambahkan asam', 15000, 'sayurasem.jpg', '2025-05-24 12:48:39'),
(1140306007, 0, 0, 'Nasi Goreng Spesial', 'Nasi, Telur, Kecap', '1. Tumis bahan\r\n2. Tambahkan nasi dan kecap', 18000, 'nasigoreng_spesial.jpg', '2025-05-24 12:48:39'),
(1140306008, 0, 0, 'Tempe Mendoan', 'Tempe, Tepung, Daun bawang', '1. Celupkan tempe ke adonan\r\n2. Goreng sebentar', 8000, 'tempemendoan.jpg', '2025-05-24 12:48:39'),
(1140306009, 0, 0, 'Soto Ayam', 'Ayam, Serai, Daun jeruk, Bawang goreng', '1. Rebus ayam dengan bumbu\r\n2. Sajikan dengan kuah dan pelengkap', 22000, 'Soto-Ayam.jpg', '2025-05-25 02:22:34'),
(1140306010, 0, 0, 'Perkedel Kentang', 'Kentang, Telur, Daging cincang', '1. Haluskan kentang dan campur bahan\r\n2. Goreng hingga matang', 12000, 'perkedel-kentang.jpg', '2025-05-25 02:22:34'),
(1140306011, 0, 0, 'Bakwan Jagung', 'Jagung, Tepung, Seledri', '1. Campur semua bahan\r\n2. Goreng hingga kuning keemasan', 7000, 'bakwan-jagung.jpg', '2025-05-25 02:22:34'),
(1140306012, 0, 0, 'Capcay Kuah', 'Wortel, Sawi, Kembang kol, Bawang putih', '1. Tumis bawang\r\n2. Tambahkan sayuran dan air, masak hingga matang', 15000, 'capcay-kuah.jpg', '2025-05-25 02:22:34'),
(1140306013, 0, 0, 'Ikan Bakar Kecap', 'Ikan, Kecap, Bawang putih, Jeruk nipis', '1. Lumuri ikan dengan bumbu\r\n2. Bakar hingga matang sambil oles bumbu', 30000, 'ikan-bakar-kecap-pedas.jpg', '2025-05-25 02:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1140306014;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
