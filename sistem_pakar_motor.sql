-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2025 pada 09.23
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
  `id` int(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kd_kerusakan` char(4) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kd_gejala` char(4) NOT NULL,
  `gejala` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kd_gejala`, `gejala`) VALUES
('G15', 'Suara mesin kasar saat dinyalakan'),
('G14', 'Oli berkurang tanpa sebab jelas'),
('G13', 'Mesin sering overheat'),
('G12', 'Knalpot mengeluarkan asap hitam'),
('G11', 'Knalpot mengeluarkan asap putih'),
('G10', 'Aki cepat habis'),
('G09', 'Konsumsi bahan bakar tinggi'),
('G08', 'Mesin bergetar hebat'),
('G07', 'Terdengar bunyi aneh pada mesin'),
('G06', 'Mesin tidak bertenaga'),
('G05', 'Mesin mati mendadak'),
('G01', 'Mesin tidak mau menyala'),
('G02', 'Mesin cepat panas'),
('G03', 'Mesin tersendat saat digas'),
('G04', 'Knalpot mengeluarkan asap tebal'),
('G16', 'Tarikan gas berat'),
('G17', 'Lampu indikator panas menyala'),
('G18', 'Mesin sulit dihidupkan di pagi hari'),
('G19', 'Kelistrikan mati sebagian'),
('G20', 'Mesin sering mati saat idle');

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
('KR01', 'Mesin Tidak Mau Menyala', 'Mesin tidak dapat dinyalakan meskipun starter telah digunakan.', 'Periksa aki, kabel starter, dan sistem pengapian. Ganti komponen yang rusak.'),
('KR02', 'Mesin Cepat Panas', 'Mesin mengalami overheat dalam waktu singkat setelah dihidupkan.', 'Periksa radiator, sistem pendingin, dan oli mesin. Tambah atau ganti oli jika perlu.'),
('KR03', 'Mesin Brebet Saat Gas', 'Mesin tersendat-sendat saat gas ditarik.', 'Periksa sistem bahan bakar, karburator, dan filter udara. Bersihkan atau ganti komponen yang kotor.'),
('KR04', 'Knalpot Berasap Tebal', 'Asap putih atau hitam pekat keluar dari knalpot.', 'Periksa ring piston, seal klep, dan kualitas bahan bakar. Ganti komponen yang rusak.'),
('KR05', 'Mesin Mati Mendadak', 'Mesin mati tiba-tiba saat kendaraan sedang berjalan.', 'Periksa sistem kelistrikan, CDI, dan kabel busi. Pastikan tidak ada komponen yang longgar.'),
('KR06', 'Tenaga Mesin Lemah', 'Mesin tidak bertenaga saat melaju di jalan menanjak atau berbeban.', 'Periksa kompresi mesin, filter udara, dan bahan bakar. Lakukan servis rutin.'),
('KR07', 'Bunyi Tidak Normal', 'Terdengar suara aneh seperti ketukan atau gesekan dari mesin.', 'Periksa rantai kamprat, bearing, dan piston. Lakukan penggantian bila ada kerusakan.'),
('KR08', 'Mesin Bergetar Kuat', 'Mesin bergetar berlebihan saat kendaraan diam atau melaju.', 'Periksa mounting mesin dan keseimbangan roda. Perbaiki bagian yang longgar atau tidak seimbang.'),
('KR09', 'Bensin Boros', 'Konsumsi bahan bakar melebihi batas normal.', 'Periksa karburator, injektor, dan tekanan ban. Lakukan penyetelan karburator jika diperlukan.'),
('KR10', 'Aki Cepat Habis', 'Aki kendaraan cepat habis meski baru diisi ulang.', 'Periksa alternator, regulator, dan kabel kelistrikan. Pastikan tidak ada arus bocor.');

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
(1, 'User andri123 berhasil ditambahkan!', '2025-02-09 07:37:32', 2),
(2, 'User andri123 berhasil login!', '2025-02-09 07:37:40', 2),
(3, 'User admin berhasil login!', '2025-02-09 07:43:44', 1),
(4, 'User admin berhasil login!', '2025-02-09 13:24:22', 1),
(5, 'User admin berhasil logout!', '2025-02-09 13:37:35', 1),
(6, 'User andri123 gagal ditambahkan!', '2025-02-09 13:43:17', 1),
(7, 'User andri123 gagal ditambahkan!', '2025-02-09 13:43:59', 1),
(8, 'User andri123 gagal ditambahkan!', '2025-02-09 13:44:13', 1),
(9, 'User andri123 berhasil ditambahkan!', '2025-02-09 13:45:04', 3),
(10, 'User andri123 berhasil login!', '2025-02-09 13:45:13', 3),
(11, 'Profile berhasil diperbaharui!', '2025-02-09 13:50:31', 3),
(12, 'Profile berhasil diperbaharui!', '2025-02-09 13:51:24', 3),
(13, 'Profile berhasil diperbaharui!', '2025-02-09 13:51:39', 3),
(14, 'Password berhasil diperbaharui!', '2025-02-09 13:51:55', 3),
(15, 'User andri123 berhasil logout!', '2025-02-09 13:51:59', 3),
(16, 'User andri123 berhasil login!', '2025-02-09 13:52:14', 3),
(17, 'Password berhasil diperbaharui!', '2025-02-09 13:52:21', 3),
(18, 'User andri123 berhasil logout!', '2025-02-09 15:03:06', 3),
(19, 'User admin berhasil login!', '2025-02-09 15:03:19', 1),
(20, 'User andri123 berhasil login!', '2025-02-09 15:04:08', 3),
(21, 'User admin berhasil login!', '2025-02-10 07:51:51', 1),
(22, 'Kerusakan Solusi KD69 berhasil ditambahkan!', '2025-02-10 08:08:33', 1),
(23, 'Kerusakan & Solusi KD69 berhasil dihapus!', '2025-02-10 08:13:19', 1),
(24, 'User admin berhasil logout!', '2025-02-10 08:16:10', 1),
(25, 'Kerusakan Solusi asd berhasil ditambahkan!', '2025-02-10 08:22:39', 1),
(26, 'Kerusakan & Solusi asd berhasil diubah!', '2025-02-10 08:22:46', 1),
(27, 'Kerusakan & Solusi asd berhasil dihapus!', '2025-02-10 08:22:49', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` int(4) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `kd_kerusakan` char(4) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `relasi`
--

INSERT INTO `relasi` (`id_relasi`, `kd_gejala`, `kd_kerusakan`, `bobot`) VALUES
(1, 'G03', 'P01', 0.85),
(2, 'G20', 'P01', 0.4),
(3, 'G16', 'P01', 0.4),
(4, 'G15', 'P01', 0.4),
(5, 'G21', 'P01', 0.25),
(6, 'G19', 'P01', 0.35),
(7, 'G22', 'P01', 0.25),
(8, 'G02', 'P02', 0.9),
(9, 'G04', 'P02', 0.5),
(10, 'G20', 'P02', 0.45),
(11, 'G17', 'P02', 0.4),
(12, 'G21', 'P02', 0.35),
(14, 'G22', 'P02', 0.35),
(15, 'G06', 'P03', 0.8),
(16, 'G10', 'P03', 0.7),
(17, 'G11', 'P03', 0.6),
(18, 'G14', 'P03', 0.5),
(19, 'G04', 'P03', 0.4),
(20, 'G16', 'P03', 0.35),
(21, 'G22', 'P03', 0.3),
(28, 'G07', 'P05', 0.8),
(27, 'G22', 'P04', 0.2),
(26, 'G20', 'P04', 0.35),
(25, 'G19', 'P04', 0.4),
(24, 'G12', 'P04', 0.6),
(22, 'G05', 'P04', 0.85),
(23, 'G08', 'P04', 0.7),
(29, 'G09', 'P05', 0.7),
(30, 'G13', 'P05', 0.6),
(31, 'G17', 'P05', 0.4),
(32, 'G18', 'P05', 0.35),
(33, 'G21', 'P05', 0.3),
(34, 'G22', 'P05', 0.3),
(35, 'G01', 'P06', 0.9),
(36, 'G04', 'P06', 0.85),
(37, 'G15', 'P06', 0.5),
(38, 'G18', 'P06', 0.4),
(43, 'G16', 'P07', 0.2),
(45, 'G24', 'P07', 0.7),
(46, 'G25', 'P07', 0.7),
(44, 'NULL', 'P07', 0.6),
(48, 'G23', 'P07', 0.6),
(49, 'G01', 'KR01', 0.9),
(50, 'G18', 'KR01', 0.8),
(51, 'G02', 'KR02', 0.85),
(52, 'G13', 'KR02', 0.8),
(53, 'G17', 'KR02', 0.75),
(54, 'G03', 'KR03', 0.7),
(55, 'G16', 'KR03', 0.6),
(56, 'G04', 'KR04', 0.9),
(57, 'G11', 'KR04', 0.8),
(58, 'G12', 'KR04', 0.85),
(59, 'G05', 'KR05', 0.85),
(60, 'G20', 'KR05', 0.8),
(61, 'G06', 'KR06', 0.8),
(62, 'G14', 'KR06', 0.7),
(63, 'G07', 'KR07', 0.7),
(64, 'G15', 'KR07', 0.75),
(65, 'G08', 'KR08', 0.75),
(66, 'G09', 'KR09', 0.65),
(67, 'G10', 'KR10', 0.8),
(68, 'G19', 'KR10', 0.75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_analisa`
--

CREATE TABLE `tmp_analisa` (
  `noip` varchar(30) NOT NULL,
  `kd_kerusakan` char(4) NOT NULL,
  `kd_gejala` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_gejala`
--

CREATE TABLE `tmp_gejala` (
  `noip` int(3) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_kerusakan`
--

CREATE TABLE `tmp_kerusakan` (
  `noip` varchar(30) NOT NULL,
  `kd_kerusakan` char(4) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `jenis_kelamin`, `alamat`, `foto`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'Administrator', 'laki-laki', 'pocis', 'avatar.png', '2025-01-07 09:15:31'),
(3, 'andri123', '$2y$10$yxpRwXgVhCn4glx/2axC0O0zLuOvaCNs9bEu7onnbU88LsSI7HLeG', 'pelanggan', 'Andri Firman Saputra', 'laki-laki', 'pocis', 'avatar.png', '2025-02-09 13:45:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

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
-- Indeks untuk tabel `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `kd_gejala` (`kd_gejala`),
  ADD KEY `kd_kerusakan` (`kd_kerusakan`);

--
-- Indeks untuk tabel `tmp_analisa`
--
ALTER TABLE `tmp_analisa`
  ADD PRIMARY KEY (`noip`),
  ADD KEY `kd_kerusakan` (`kd_kerusakan`),
  ADD KEY `kd_gejala` (`kd_gejala`);

--
-- Indeks untuk tabel `tmp_gejala`
--
ALTER TABLE `tmp_gejala`
  ADD PRIMARY KEY (`noip`),
  ADD KEY `kd_gejala` (`kd_gejala`);

--
-- Indeks untuk tabel `tmp_kerusakan`
--
ALTER TABLE `tmp_kerusakan`
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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tmp_gejala`
--
ALTER TABLE `tmp_gejala`
  MODIFY `noip` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
