-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2025 pada 18.31
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
-- Database: `resep_masakan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Ayam'),
(2, 'Sayur'),
(3, 'Seafood'),
(4, 'Kue'),
(5, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `nama_resep` varchar(100) NOT NULL,
  `bahan` text NOT NULL,
  `langkah` text NOT NULL,
  `biaya` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `nama_resep`, `bahan`, `langkah`, `biaya`, `gambar`, `id_kategori`) VALUES
(1140306001, 'Nasi Goreng Ayam', 'Nasi putih, bawang merah, bawang putih, telur, kecap manis, garam, minyak goreng, Ayam Suir', '1. Panaskan minyak. 2. Tumis bawang hingga harum. 3. Masukkan telur dan orak-arik. 4. Masukkan ayam yang telah disuir-suir. 5. Tambahkan nasi, kecap, dan garam. 6. Aduk rata dan masak hingga matang.', 15000, 'nasigoreng_spesial.jpg', 1),
(1140306002, 'Mie Goreng', 'Mie instan, sayuran (kol, wortel), bawang putih, kecap manis, saus tiram, telur', '1. Rebus mie hingga matang, tiriskan. 2. Tumis bawang putih. 3. Masukkan telur, orak-arik. 4. Tambahkan sayuran, lalu mie. 5. Tambahkan kecap dan saus tiram. 6. Aduk hingga rata.', 12000, 'mie-goreng.jpg', 3),
(1140306003, 'Ayam Bakar', 'Ayam, bawang putih, bawang merah, ketumbar, kecap manis, garam, air', '1. Haluskan bumbu, tumis hingga harum. 2. Masukkan ayam dan sedikit air. 3. Masak hingga empuk. 4. Panggang ayam sambil dioles kecap. 5. Bakar hingga kecokelatan.', 30000, 'ayam-bakar.jpg', 1),
(1140306004, 'Sayur Bayam', 'Bayam, jagung manis, bawang merah, temu kunci, garam, air', '1. Didihkan air. 2. Masukkan irisan bawang dan temu kunci. 3. Tambahkan jagung. 4. Setelah empuk, masukkan bayam. 5. Masak sebentar lalu angkat.', 8000, 'sayur-bayam.jpg', 2),
(1140306005, 'Perkedel Kentang', 'Kentang, telur, daun bawang, bawang merah, merica, garam, minyak goreng', '1. Rebus dan haluskan kentang. 2. Tambahkan bumbu dan daun bawang. 3. Bentuk bulat pipih. 4. Celup ke telur kocok. 5. Goreng hingga kuning keemasan.', 10000, 'perkedel-kentang.jpg', NULL),
(1140306006, 'Soto Ayam', 'Ayam, serai, daun jeruk, bawang putih, bawang merah, kunyit, garam, air', '1. Rebus ayam hingga matang. 2. Tumis bumbu halus hingga harum. 3. Masukkan ke rebusan ayam. 4. Tambahkan daun jeruk dan serai. 5. Sajikan dengan nasi dan sambal.', 25000, 'Soto-Ayam.jpg', 1),
(1140306007, 'Capcay Kuah', 'Wortel, kol, sawi, bakso, bawang putih, garam, merica, air', '1. Tumis bawang putih. 2. Masukkan wortel dan air. 3. Tambahkan sayur lainnya dan bakso. 4. Bumbui, masak hingga matang.', 18000, 'capcay-kuah.jpg', 2),
(1140306008, 'Telur Dadar Padang', 'Telur, daun bawang, kelapa parut, cabai, bawang merah, garam', '1. Campur semua bahan. 2. Kocok rata. 3. Goreng dengan minyak panas hingga tebal dan matang merata.', 12000, 'telur-dadar-padang.jpg', 3),
(1140306009, 'Sup Ikan', 'Ikan kakap, tomat, bawang putih, jahe, daun bawang, garam, air', '1. Rebus air dan jahe. 2. Masukkan ikan dan bumbu lainnya. 3. Masak hingga ikan matang. 4. Sajikan hangat.', 28000, 'sup-ikan-sayuran.jpg', 3),
(1140306010, 'Tempe Orek', 'Tempe, kecap manis, bawang putih, cabai, garam, gula merah', '1. Goreng tempe. 2. Tumis bawang dan cabai. 3. Tambahkan kecap, gula, dan garam. 4. Masukkan tempe, aduk rata.', 10000, 'tempemendoan.jpg', NULL),
(1140306011, 'Ayam Teriyaki', '- 200 gr Paha Ayam Tanpa Tulang\r\n- 100 gr Bawang Bombay\r\n- 1 bh Cabai Merah Besar\r\n- 1 bh Cabai Merah Hijau\r\n- 3 sdm Minyak Goreng', '1. Iris serong cabai merah dan cabai hijau, potong bawang bombay, potong ayam bentuk dadu.\r\n2. Siapkan wadah, campurkan ayam dan 1 bks SAORI® Saus Teriyaki, diamkan +/- 15 menit.\r\n3. Panaskan minyak goreng, tumis bawang bombay, cabai merah, dan cabai hijau. Masukkan ayam, aduk rata. Masak hingga matang.', 300000, 'ayam-teriyaki.jpeg', NULL),
(1140306012, 'Udang Asam Manis', '- 250 gr udang\n- Bawang bombay\n- Saus sambal\n- Saus tomat\n- Gula & garam', '1. Bersihkan udang.\n2. Tumis bawang, masukkan saus dan bumbu.\n3. Tambahkan udang dan masak hingga matang.', 350000, NULL, 3),
(1140306013, 'Bolu Kukus Cokelat', '- Tepung terigu\r\n- Gula pasir\r\n- Telur\r\n- Cokelat bubuk\r\n- Baking powder', '1. Campur bahan kering.\r\n2. Tambahkan telur dan aduk rata.\r\n3. Kukus hingga matang.', 150000, 'bolu-kukus.jpg', 4),
(1140306014, 'Es Buah Segar', '- Semangka\n- Melon\n- Nanas\n- Sirup merah\n- Es batu', '1. Potong semua buah kecil-kecil.\n2. Campurkan dengan sirup dan es batu.\n3. Sajikan dingin.', 100000, NULL, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `foto`) VALUES
(1, 'Revaldo', 'revaldo@gmail.com', '$2y$10$3C5PiPhUGlOANxWcaTICGuBJpr3G7hzvBKe3WbOElHVjuQN3qtT6y', 'user_683c4780cbf3b.JPG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `fk_kategori` (`id_kategori`);

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
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1140306015;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
