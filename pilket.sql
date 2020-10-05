-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2020 pada 06.40
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pilket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `calon_id` int(11) NOT NULL,
  `calon_nama` varchar(50) NOT NULL,
  `calon_foto` varchar(255) NOT NULL,
  `calon_visi` longtext NOT NULL,
  `calon_misi` longtext NOT NULL,
  `calon_kelas` int(5) NOT NULL,
  `total_suara` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `kelas_nama`) VALUES
(1, 'XI IPS 5'),
(2, 'X IPS 5'),
(3, 'X IPS 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_evot`
--

CREATE TABLE `log_evot` (
  `log_id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_user` varchar(50) NOT NULL,
  `log_tipe` int(11) NOT NULL,
  `log_desc` varchar(255) NOT NULL,
  `log_ip` varbinary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_evot`
--

INSERT INTO `log_evot` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`, `log_ip`) VALUES
(1, '2020-07-14 03:55:36', 'Nizar Admin', 3, 'edit data calon dengan logo pendek', 0x00000000000000000000000000000001),
(2, '2020-07-14 03:56:47', 'Nizar Admin', 3, 'edit data calon dengan logo pendek', 0x00000000000000000000000000000001),
(3, '2020-07-14 03:57:08', 'Nizar Admin', 3, 'edit data calon dengan logo pendek', 0x00000000000000000000000000000001),
(4, '2020-07-14 04:33:54', 'Nizar Admin', 3, 'edit dengan logo', 0x00000000000000000000000000000001),
(5, '2020-07-14 04:34:10', 'Nizar Admin', 3, 'edit dengan logo panjang', 0x00000000000000000000000000000001),
(6, '2020-07-14 04:35:56', 'Nizar Admin', 3, 'edit dengan logo panjang', 0x00000000000000000000000000000001),
(7, '2020-07-14 04:39:39', 'Nizar Admin', 3, 'edit logo', 0x00000000000000000000000000000001),
(8, '2020-07-14 04:40:04', 'Nizar Admin', 1, 'Logout', 0x00000000000000000000000000000001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `pemilih_id` int(11) NOT NULL,
  `pemilih_nama` varchar(50) NOT NULL,
  `pemilih_username` varchar(10) NOT NULL,
  `pemilih_kelas` int(5) NOT NULL,
  `sudah_memilih` int(1) NOT NULL,
  `tanggal_memilih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `pengaturan_id` int(11) NOT NULL,
  `pengaturan_nama` varchar(255) NOT NULL,
  `pengaturan_logo` varchar(255) NOT NULL,
  `logo_panjang` varchar(255) NOT NULL,
  `pengaturan_tentang` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`pengaturan_id`, `pengaturan_nama`, `pengaturan_logo`, `logo_panjang`, `pengaturan_tentang`) VALUES
(1, 'E-Vot', 'logo2.png', 'logo1.png', '<p>Pilih yang cocok kalau gak cocok jangan pilih, membuat voting tanpa golput dan transparan.</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `pengguna_id` int(11) NOT NULL,
  `pengguna_nama` varchar(255) NOT NULL,
  `pengguna_username` varchar(50) NOT NULL,
  `pengguna_password` varchar(255) NOT NULL,
  `pengguna_level` enum('admin','guru') NOT NULL,
  `pengguna_status` int(1) NOT NULL DEFAULT 1,
  `pengguna_foto` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`pengguna_id`, `pengguna_nama`, `pengguna_username`, `pengguna_password`, `pengguna_level`, `pengguna_status`, `pengguna_foto`, `created`, `updated`) VALUES
(15, 'Nizar Admin', 'kumengerti', '$2y$10$5HV.LS9MOj6xZkRyDzhvCeXHpjxCvlJhOlItM22TMlU00Nd4oR.Am', 'admin', 1, '', '2020-07-14 09:02:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suara`
--

CREATE TABLE `suara` (
  `suara_id` int(11) NOT NULL,
  `pemilih` int(11) NOT NULL,
  `pilihan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`calon_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indeks untuk tabel `log_evot`
--
ALTER TABLE `log_evot`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`pemilih_id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indeks untuk tabel `suara`
--
ALTER TABLE `suara`
  ADD PRIMARY KEY (`suara_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon`
--
ALTER TABLE `calon`
  MODIFY `calon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_evot`
--
ALTER TABLE `log_evot`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `pemilih_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `suara`
--
ALTER TABLE `suara`
  MODIFY `suara_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
