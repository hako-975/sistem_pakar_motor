-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Apr 2025 pada 11.45
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar_motor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_hasil`
--

CREATE TABLE `analisa_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mekanik` int(11) NOT NULL,
  `kd_kerusakan` char(4) DEFAULT NULL,
  `nilai_akhir` float DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `analisa_hasil`
--

INSERT INTO `analisa_hasil` (`id_hasil`, `id_user`, `id_mekanik`, `kd_kerusakan`, `nilai_akhir`, `tanggal`) VALUES
(1, 3, 3, 'K001', 58.3333, '2025-04-01 16:03:41'),
(2, 1, 3, NULL, NULL, '2025-04-01 16:26:50'),
(4, 1, 3, 'K001', 100, '2025-04-01 16:42:25'),
(5, 1, 2, NULL, NULL, '2025-04-01 16:42:36'),
(6, 3, 3, 'K005', 100, '2025-04-01 16:42:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kd_gejala` char(4) NOT NULL,
  `gejala` varchar(100) NOT NULL,
  `deskripsi_gejala` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kd_gejala`, `gejala`, `deskripsi_gejala`) VALUES
('G001', 'Mesin tidak menyala saat distarter', 'Mesin tidak bereaksi saat distarter, tidak ada tanda-tanda hidup.'),
('G002', 'Suara mesin tidak stabil', 'Mesin mengeluarkan suara yang tidak konsisten, kadang tinggi kadang rendah.'),
('G003', 'Busi tidak menghasilkan percikan api', 'Busi tidak mengeluarkan percikan api saat distarter.'),
('G004', 'Suhu mesin sangat panas', 'Mesin terasa panas berlebihan saat disentuh atau terlihat dari indikator suhu.'),
('G005', 'Mesin mati secara tiba-tiba', 'Mesin tiba-tiba mati saat sedang digunakan.'),
('G006', 'Asap keluar dari mesin', 'Asap putih atau hitam keluar dari bagian mesin atau knalpot.'),
('G007', 'Suara ketukan dari mesin', 'Mesin mengeluarkan suara ketukan yang tidak normal.'),
('G008', 'Getaran yang tidak normal', 'Mesin bergetar secara berlebihan saat dihidupkan atau digunakan.'),
('G009', 'Performa mesin menurun', 'Mesin terasa lemah dan tidak bertenaga saat digunakan.'),
('G010', 'Mesin tersendat-sendat', 'Mesin tidak berakselerasi dengan lancar, tersendat saat gas ditarik.'),
('G011', 'Kecepatan tidak stabil', 'Kecepatan mesin naik turun tanpa diatur.'),
('G012', 'Tenaga mesin berkurang', 'Mesin tidak menghasilkan tenaga maksimal saat digunakan.'),
('G013', 'Konsumsi bahan bakar berlebihan', 'Bahan bakar habis lebih cepat dari biasanya.'),
('G014', 'Bau bahan bakar menyengat', 'Bau bahan bakar terasa sangat kuat di sekitar mesin.'),
('G015', 'Oli mesin cepat habis', 'Oli mesin berkurang secara signifikan dalam waktu singkat.'),
('G016', 'Mesin sulit distarter saat dingin', 'Mesin sulit dihidupkan saat kondisi mesin masih dingin.'),
('G017', 'Mesin sulit distarter saat panas', 'Mesin sulit dihidupkan saat kondisi mesin sudah panas.'),
('G018', 'Suara kasar saat mesin hidup', 'Mesin mengeluarkan suara kasar saat dihidupkan.'),
('G019', 'Indikator oli menyala', 'Lampu indikator oli pada dashboard menyala.'),
('G020', 'Indikator suhu mesin menyala', 'Lampu indikator suhu mesin pada dashboard menyala.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan_solusi`
--

CREATE TABLE `kerusakan_solusi` (
  `kd_kerusakan` char(4) NOT NULL,
  `nama_kerusakan` varchar(30) DEFAULT NULL,
  `definisi` text DEFAULT NULL,
  `solusi` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kerusakan_solusi`
--

INSERT INTO `kerusakan_solusi` (`kd_kerusakan`, `nama_kerusakan`, `definisi`, `solusi`) VALUES
('K001', 'Mesin Sulit Hidup', 'Mesin tidak dapat dihidupkan dengan mudah, biasanya disebabkan oleh masalah pada sistem pengapian, bahan bakar, atau kompresi mesin.', '1. Periksa sistem pengapian (busi, koil, kabel busi).\n2. Periksa sistem bahan bakar (pompa bahan bakar, karburator, injektor).\n3. Periksa kompresi mesin.'),
('K002', 'Mesin Overheat', 'Suhu mesin terlalu tinggi dan melebihi batas normal, disebabkan oleh masalah pada sistem pendingin, oli mesin, atau sirkulasi udara.', '1. Periksa sistem pendingin (radiator, selang, cairan pendingin).\r\n2. Ganti oli mesin jika diperlukan.\r\n3. Pastikan sirkulasi udara di sekitar mesin lancar.'),
('K003', 'Mesin Berisik', 'Mesin mengeluarkan suara tidak normal, biasanya disebabkan oleh masalah pada bagian dalam mesin seperti piston, ring piston, atau bearing.', '1. Periksa kondisi piston dan ring piston.\r\n2. Periksa bearing dan komponen internal mesin.\r\n3. Lakukan perbaikan atau penggantian komponen yang rusak.'),
('K004', 'Mesin Tidak Bisa Berakselerasi', 'Mesin tidak dapat meningkatkan kecepatan dengan baik, disebabkan oleh masalah pada karburator, sistem bahan bakar, atau transmisi.', '1. Periksa karburator atau sistem injeksi bahan bakar.\r\n2. Periksa sistem transmisi (rantai, gir, kopling).\r\n3. Bersihkan atau ganti komponen yang bermasalah.'),
('K005', 'Mesin Mogok Saat Digunakan', 'Mesin tiba-tiba mati saat sedang digunakan, biasanya disebabkan oleh masalah pada sistem bahan bakar atau pengapian.', '1. Periksa sistem bahan bakar (pompa bahan bakar, filter bahan bakar).\r\n2. Periksa sistem pengapian (busi, koil, kabel busi).\r\n3. Pastikan tidak ada kebocoran bahan bakar.'),
('K006', 'Mesin Boros Bahan Bakar', 'Konsumsi bahan bakar berlebihan, disebabkan oleh masalah pada karburator, sistem injeksi, atau kebocoran bahan bakar.', '1. Periksa karburator atau sistem injeksi bahan bakar.\r\n2. Periksa kebocoran bahan bakar.\r\n3. Lakukan penyetelan ulang sistem bahan bakar.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tgl_log`, `id_user`) VALUES
(1, 'User admin berhasil logout!', '2025-02-14 14:07:30', 1),
(2, 'User andri123 berhasil login!', '2025-02-14 14:07:44', 2),
(3, 'User andri123 berhasil logout!', '2025-02-14 14:10:40', 2),
(4, 'User admin berhasil login!', '2025-03-14 05:56:06', 1),
(5, 'Mekanik Irgi berhasil ditambahkan!', '2025-03-14 07:20:18', 1),
(6, 'Mekanik andri berhasil ditambahkan!', '2025-03-14 07:21:40', 1),
(7, 'Mekanik Irgi berhasil dihapus!', '2025-03-14 07:23:32', 1),
(8, 'Mekanik Irgi berhasil ditambahkan!', '2025-03-14 07:23:38', 1),
(9, 'Mekanik asd berhasil ditambahkan!', '2025-03-14 07:26:47', 1),
(10, 'Mekanik dsa berhasil diubah!', '2025-03-14 07:26:51', 1),
(11, 'Mekanik dsa berhasil dihapus!', '2025-03-14 07:26:54', 1),
(12, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-03-14 07:29:02', 1),
(13, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-03-14 07:29:03', 1),
(14, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:04', 1),
(15, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:04', 1),
(16, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:05', 1),
(17, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:06', 1),
(18, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:07', 1),
(19, 'Analisa Hasil admin berhasil dihapus!', '2025-03-14 07:29:07', 1),
(20, 'User admin berhasil logout!', '2025-03-14 08:04:34', 1),
(21, 'User admin berhasil login!', '2025-03-16 10:56:13', 1),
(22, 'User admin berhasil login!', '2025-03-17 14:22:47', 1),
(23, 'Gejala G021 berhasil ditambahkan!', '2025-03-17 14:32:13', 1),
(24, 'Gejala G021 berhasil dihapus!', '2025-03-17 14:32:19', 1),
(25, 'Gejala G021 berhasil ditambahkan!', '2025-03-17 14:32:26', 1),
(26, 'Gejala G021 berhasil diubah!', '2025-03-17 14:34:59', 1),
(27, 'Gejala G021 berhasil dihapus!', '2025-03-17 14:35:04', 1),
(28, 'User admin berhasil login!', '2025-03-17 15:59:00', 1),
(29, 'Relasi K001 | G001 berhasil ditambahkan!', '2025-03-17 16:30:27', 1),
(30, 'Relasi K001 | G001 berhasil diubah!', '2025-03-17 16:40:28', 1),
(31, 'Relasi K001 | G001 berhasil diubah!', '2025-03-17 16:42:13', 1),
(32, 'Relasi K001 | G001 berhasil diubah!', '2025-03-17 16:42:28', 1),
(33, 'Relasi K001 | G001 berhasil diubah!', '2025-03-17 16:42:31', 1),
(34, 'Relasi K001 | G001 berhasil diubah!', '2025-03-17 16:42:34', 1),
(35, 'Relasi berhasil dihapus!', '2025-03-17 18:54:56', 1),
(36, 'Relasi K002 | G002 berhasil ditambahkan!', '2025-03-17 18:55:02', 1),
(37, 'Relasi K002 | G002 berhasil diubah!', '2025-03-17 18:55:06', 1),
(38, 'Relasi berhasil dihapus!', '2025-03-17 18:55:08', 1),
(39, 'User admin berhasil logout!', '2025-03-17 19:04:02', 1),
(40, 'User andri berhasil ditambahkan!', '2025-03-17 19:04:21', 3),
(41, 'User andri berhasil login!', '2025-03-17 19:04:25', 3),
(42, 'User admin berhasil login!', '2025-03-17 19:48:40', 1),
(43, 'User admin berhasil login!', '2025-03-23 18:36:51', 1),
(44, 'User admin berhasil login!', '2025-03-30 08:00:29', 1),
(45, 'User admin berhasil login!', '2025-04-01 06:17:33', 1),
(46, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-04-01 07:56:49', 1),
(47, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-04-01 07:56:52', 1),
(48, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-04-01 07:56:59', 1),
(49, 'Analisa Hasil admin berhasil dihapus!', '2025-04-01 08:51:53', 1),
(50, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-04-01 08:51:54', 1),
(51, 'Analisa Hasil Andri Firman Saputra berhasil dihapus!', '2025-04-01 09:02:53', 1),
(52, 'Analisa Hasil admin berhasil dihapus!', '2025-04-01 09:27:14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mekanik`
--

CREATE TABLE `mekanik` (
  `id_mekanik` int(11) NOT NULL,
  `nama_mekanik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mekanik`
--

INSERT INTO `mekanik` (`id_mekanik`, `nama_mekanik`) VALUES
(2, 'andri'),
(3, 'Irgi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id_perhitungan` int(11) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `bobot` float NOT NULL,
  `id_hasil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perhitungan`
--

INSERT INTO `perhitungan` (`id_perhitungan`, `kd_gejala`, `bobot`, `id_hasil`) VALUES
(1, 'G001', 1, 1),
(2, 'G002', 3, 1),
(3, 'G003', 3, 1),
(4, 'G006', 5, 1),
(9, 'G002', 3, 4),
(10, 'G019', 0, 4),
(11, 'G020', 0, 4),
(12, 'G017', 5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` int(4) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `kd_kerusakan` char(4) NOT NULL,
  `jenis_gejala` enum('Ringan','Sedang','Berat') NOT NULL,
  `bobot` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `relasi`
--

INSERT INTO `relasi` (`id_relasi`, `kd_gejala`, `kd_kerusakan`, `jenis_gejala`, `bobot`) VALUES
(1, 'G001', 'K001', 'Ringan', 1),
(2, 'G002', 'K001', 'Sedang', 3),
(3, 'G003', 'K001', 'Sedang', 3),
(4, 'G004', 'K002', 'Sedang', 3),
(5, 'G005', 'K002', 'Sedang', 3),
(6, 'G006', 'K002', 'Berat', 5),
(7, 'G007', 'K003', 'Sedang', 3),
(8, 'G008', 'K003', 'Sedang', 3),
(9, 'G009', 'K003', 'Berat', 5),
(10, 'G010', 'K004', 'Sedang', 3),
(11, 'G011', 'K004', 'Sedang', 3),
(12, 'G012', 'K004', 'Berat', 5),
(13, 'G005', 'K005', 'Sedang', 3),
(14, 'G016', 'K005', 'Sedang', 3),
(15, 'G017', 'K005', 'Berat', 5),
(16, 'G013', 'K006', 'Sedang', 3),
(17, 'G014', 'K006', 'Sedang', 3),
(18, 'G015', 'K006', 'Berat', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('admin','pelanggan') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'admin', 'laki-laki', '2002-01-29', 'admin', 'default.jpg', '2025-02-14 07:43:47'),
(3, 'andri', '$2y$10$.PnL35g9sywNDb33oVzEW.yGcFtSzQ66.sA7QJi2bNVFHBpTcVWya', 'pelanggan', 'Andri Firman Saputra', 'laki-laki', '2002-01-29', 'Jl. AMD Babakan Pocis', 'avatar.png', '2025-03-17 19:04:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_mekanik` (`id_mekanik`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indeks untuk tabel `kerusakan_solusi`
--
ALTER TABLE `kerusakan_solusi`
  ADD PRIMARY KEY (`kd_kerusakan`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  ADD PRIMARY KEY (`id_mekanik`);

--
-- Indeks untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id_perhitungan`),
  ADD KEY `kd_gejala` (`kd_gejala`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indeks untuk tabel `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `kd_gejala` (`kd_gejala`),
  ADD KEY `kd_kerusakan` (`kd_kerusakan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  MODIFY `id_mekanik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
