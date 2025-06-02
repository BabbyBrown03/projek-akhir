-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2025 pada 15.14
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
(1140306001, 'Nasi Goreng Ayam', '- Nasi putih\r\n- bawang merah \r\n- bawang putih \r\n- telur\r\n- kecap manis\r\n- garam\r\n- minyak goreng\r\n- Ayam Suir', '1. Panaskan minyak. \r\n2. Tumis bawang hingga harum. \r\n3. Masukkan telur dan orak-arik. \r\n4. Masukkan ayam yang telah disuir-suir. \r\n5. Tambahkan nasi, kecap, dan garam. \r\n6. Aduk rata dan masak hingga matang.', 15000, 'nasigoreng_spesial.jpg', 1),
(1140306002, 'Mie Goreng', '- Mie instan\r\n- sayuran (kol, wortel)\r\n- bawang putih \r\n- kecap manis \r\n- saus tiram \r\n- telur', '1. Rebus mie hingga matang, tiriskan. \r\n2. Tumis bawang putih. \r\n3. Masukkan telur, orak-arik. \r\n4. Tambahkan sayuran, lalu mie. \r\n5. Tambahkan kecap dan saus tiram. \r\n6. Aduk hingga rata.', 12000, 'mie-goreng.jpg', 3),
(1140306003, 'Ayam Bakar', '- Ayam\r\n- Bawang putih \r\n- bawang merah\r\n- ketumbar\r\n- kecap manis \r\n- garam \r\n- air', '1. Haluskan bumbu, tumis hingga harum. \r\n2. Masukkan ayam dan sedikit air. \r\n3. Masak hingga empuk. \r\n4. Panggang ayam sambil dioles kecap. \r\n5. Bakar hingga kecokelatan.', 30000, 'ayam-bakar.jpg', 1),
(1140306004, 'Sayur Bayam', '- Bayam\r\n- jagung manis \r\n- bawang merah\r\n- temu kunci \r\n- garam\r\n- air', '1. Didihkan air. \r\n2. Masukkan irisan bawang dan temu kunci. \r\n3. Tambahkan jagung. \r\n4. Setelah empuk, masukkan bayam. \r\n5. Masak sebentar lalu angkat.', 8000, 'sayur-bayam.jpg', 2),
(1140306005, 'Perkedel Kentang', '- Kentang\r\n- telur\r\n- daun bawang \r\n- bawang merah\r\n- merica \r\n- garam\r\n- minyak goreng', '1. Rebus dan haluskan kentang. \r\n2. Tambahkan bumbu dan daun bawang. \r\n3. Bentuk bulat pipih. \r\n4. Celup ke telur kocok. \r\n5. Goreng hingga kuning keemasan.', 10000, 'perkedel-kentang.jpg', NULL),
(1140306006, 'Soto Ayam', '- Ayam\r\n- serai\r\n- daun jeruk\r\n- bawang putih \r\n- bawang merah \r\n- kunyit \r\n- garam\r\n- air', '1. Rebus ayam hingga matang. \r\n2. Tumis bumbu halus hingga harum. \r\n3. Masukkan ke rebusan ayam. \r\n4. Tambahkan daun jeruk dan serai. \r\n5. Sajikan dengan nasi dan sambal.', 25000, 'Soto-Ayam.jpg', 1),
(1140306007, 'Capcay Kuah', '- Wortel\r\n- kol\r\n- sawi\r\n- bakso\r\n- bawang putih\r\n- garam \r\n- merica \r\n- air', '1. Tumis bawang putih. \r\n2. Masukkan wortel dan air. \r\n3. Tambahkan sayur lainnya dan bakso. \r\n4. Bumbui, masak hingga matang.', 18000, 'capcay-kuah.jpg', 2),
(1140306008, 'Telur Dadar Padang', '- Telur\r\n- daun bawang \r\n- kelapa parut\r\n- cabai\r\n- bawang merah\r\n- garam', '1. Campur semua bahan. \r\n2. Kocok rata. \r\n3. Goreng dengan minyak panas hingga tebal dan matang merata.', 12000, 'telur-dadar-padang.jpg', 3),
(1140306009, 'Sup Ikan', '- Ikan kakap \r\n- tomat\r\n- bawang putih \r\n- jahe\r\n- daun bawang \r\n- garam\r\n- air', '1. Rebus air dan jahe. \r\n2. Masukkan ikan dan bumbu lainnya. \r\n3. Masak hingga ikan matang. \r\n4. Sajikan hangat.', 28000, 'sup-ikan-sayuran.jpg', 3),
(1140306010, 'Tempe Orek', '- Tempe\r\n- kecap manis \r\n- bawang putih\r\n- cabai \r\n- garam\r\n- gula merah', '1. Goreng tempe. \r\n2. Tumis bawang dan cabai. \r\n3. Tambahkan kecap, gula, dan garam. \r\n4. Masukkan tempe, aduk rata.', 10000, 'tempemendoan.jpg', NULL),
(1140306011, 'Ayam Teriyaki', '- 200 gr Paha Ayam Tanpa Tulang\r\n- 100 gr Bawang Bombay\r\n- 1 bh Cabai Merah Besar\r\n- 1 bh Cabai Merah Hijau\r\n- 3 sdm Minyak Goreng', '1. Iris serong cabai merah dan cabai hijau, potong bawang bombay, potong ayam bentuk dadu.\r\n2. Siapkan wadah, campurkan ayam dan 1 bks SAORI® Saus Teriyaki, diamkan +/- 15 menit.\r\n3. Panaskan minyak goreng, tumis bawang bombay, cabai merah, dan cabai hijau. Masukkan ayam, aduk rata. Masak hingga matang.', 300000, 'ayam-teriyaki.jpeg', NULL),
(1140306012, 'Udang Asam Manis', '- 250 gr udang\r\n- Bawang bombay\r\n- Saus sambal\r\n- Saus tomat\r\n- Gula & garam', '1. Bersihkan udang.\r\n2. Tumis bawang, masukkan saus dan bumbu.\r\n3. Tambahkan udang dan masak hingga matang.', 350000, 'Udang-Asam-Manis.jpg', 3),
(1140306013, 'Bolu Kukus Cokelat', '- Tepung terigu\r\n- Gula pasir\r\n- Telur\r\n- Cokelat bubuk\r\n- Baking powder', '1. Campur bahan kering.\r\n2. Tambahkan telur dan aduk rata.\r\n3. Kukus hingga matang.', 150000, 'bolu-kukus.jpg', 4),
(1140306014, 'Es Buah Segar', '- Semangka\r\n- Melon\r\n- Nanas\r\n- Sirup merah\r\n- Es batu', '1. Potong semua buah kecil-kecil.\r\n2. Campurkan dengan sirup dan es batu.\r\n3. Sajikan dingin.', 100000, 'Es-Buah.jpg', 5);

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
(1, 'Revaldo', 'revaldo@gmail.com', '$2y$10$3C5PiPhUGlOANxWcaTICGuBJpr3G7hzvBKe3WbOElHVjuQN3qtT6y', 'user_683c4780cbf3b.JPG'),
(2, 'admin', 'admin@localhost.com', '$2y$10$nIgeI2ySgp/RhQbJGiRczO0g00rXqsonNr07gAagzkUBhfsCrzO8K', NULL);

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
