-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2025 pada 10.45
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
-- Database: `spk_program_kuliah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_topsis`
--

CREATE TABLE `hasil_topsis` (
  `id_hasil` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `preferensi_tertinggi` float DEFAULT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_topsis`
--

INSERT INTO `hasil_topsis` (`id_hasil`, `id_siswa`, `id_jurusan`, `preferensi_tertinggi`, `dibuat_pada`) VALUES
(1, 1, 0, 0.587493, '2025-01-21 14:53:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `dibuat_pada`) VALUES
(1, 'Teknik Informatika', '2025-01-21 13:40:56'),
(2, 'Sistem Informasi', '2025-01-21 13:41:01'),
(3, 'Teknologi Informasi', '2025-01-21 13:41:05'),
(4, 'Teknik Komputer', '2025-01-21 13:41:09'),
(5, 'Manajemen Informatika', '2025-01-21 13:41:23'),
(6, 'Keamanan Jaringan dan Data (Cybersecurity)', '2025-01-21 13:41:29'),
(7, 'Desain Komunikasi Visual (DKV)', '2025-01-21 13:41:32'),
(8, 'Seni Rupa dan Desain', '2025-01-21 13:41:36'),
(9, 'Desain Grafis', '2025-01-21 13:41:39'),
(10, 'Desain Multimedia', '2025-01-21 13:41:43'),
(11, 'Animasi dan Media Digital', '2025-01-21 13:41:46'),
(12, 'Manajemen Perhotelan', '2025-01-21 13:41:50'),
(13, 'Pariwisata', '2025-01-21 13:41:54'),
(14, 'Manajemen Bisnis Pariwisata', '2025-01-21 13:41:57'),
(15, 'Manajemen Event dan Hospitality', '2025-01-21 13:42:01'),
(16, 'Kuliner dan Tata Boga', '2025-01-21 13:42:04'),
(17, 'Teknik Otomotif', '2025-01-21 13:42:07'),
(18, 'Teknik Mesin', '2025-01-21 13:42:11'),
(19, 'Teknologi Rekayasa Otomotif', '2025-01-21 13:42:14'),
(20, 'Teknik Kendaraan Listrik', '2025-01-21 13:42:17'),
(21, 'Manajemen Bisnis Otomotif', '2025-01-21 13:42:20'),
(24, 'Rekayasa Sistem Mekanik', '2025-01-21 13:42:30'),
(25, 'Teknik Transportasi Darat', '2025-01-21 13:42:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `atribut` enum('Benefit','Cost') NOT NULL DEFAULT 'Benefit',
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `atribut`, `dibuat_pada`) VALUES
(1, 'Minat', 0.4, 'Benefit', '2025-01-21 13:18:32'),
(2, 'Hasil Ujian', 0.6, 'Benefit', '2025-01-21 13:22:00');

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
(1, 'Siswa Fiki berhasil ditambahkan!', '2025-01-21 07:52:27', 1),
(2, 'SPK Jurusan Fiki Berhasil ditambahkan!', '2025-01-21 07:53:07', 1),
(3, 'Jurusan Teknologi Rekayasa Otomotif berhasil dihapus!', '2025-01-21 07:54:39', 1),
(4, 'Jurusan Teknik Otomotif berhasil dihapus!', '2025-01-21 07:54:59', 1),
(5, 'Jurusan Teknik Mesin berhasil dihapus!', '2025-01-21 07:55:03', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `id_hasil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_kriteria`, `id_jurusan`, `nilai`, `id_hasil`) VALUES
(1, 2, 11, 5, 1),
(2, 1, 11, 8, 1),
(3, 2, 9, 7.5, 1),
(4, 1, 9, 5, 1),
(5, 2, 7, 5, 1),
(6, 1, 7, 6, 1),
(7, 2, 10, 6, 1),
(8, 1, 10, 6, 1),
(9, 2, 6, 6, 1),
(10, 1, 6, 6, 1),
(11, 2, 16, 6, 1),
(12, 1, 16, 6, 1),
(13, 2, 21, 5, 1),
(14, 1, 21, 5, 1),
(15, 2, 14, 5, 1),
(16, 1, 14, 5, 1),
(17, 2, 15, 5, 1),
(18, 1, 15, 5, 1),
(19, 2, 5, 6, 1),
(20, 1, 5, 6, 1),
(21, 2, 12, 6, 1),
(22, 1, 12, 5, 1),
(23, 2, 13, 5, 1),
(24, 1, 13, 6, 1),
(25, 2, 24, 6, 1),
(26, 1, 24, 4, 1),
(27, 2, 8, 5, 1),
(28, 1, 8, 3, 1),
(29, 2, 2, 4, 1),
(30, 1, 2, 4, 1),
(31, 2, 1, 4, 1),
(32, 1, 1, 5, 1),
(33, 2, 20, 5, 1),
(34, 1, 20, 5, 1),
(35, 2, 4, 5, 1),
(36, 1, 4, 6, 1),
(37, 2, 18, 6, 1),
(38, 1, 18, 4, 1),
(41, 2, 17, 4, 1),
(42, 1, 17, 3, 1),
(45, 2, 25, 7, 1),
(46, 1, 25, 5, 1),
(47, 2, 3, 5, 1),
(48, 1, 3, 7, 1),
(49, 2, 19, 5, 1),
(50, 1, 19, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `alamat`, `foto`, `dibuat_pada`) VALUES
(1, 'Fiki', '2002-01-29', 'laki-laki', '087808675313', 'Pocis', '678f523b4dd7a_1737445947_65483768.jpeg', '2025-01-21 14:52:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('admin','petugas') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `foto`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'Administrator', 'avatar.png', '2025-01-07 09:15:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_ekskul` (`id_jurusan`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_ekskul` (`id_jurusan`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD CONSTRAINT `hasil_topsis_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_4` FOREIGN KEY (`id_hasil`) REFERENCES `hasil_topsis` (`id_hasil`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
