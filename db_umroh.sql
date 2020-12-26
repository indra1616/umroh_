-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2019 pada 06.32
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umroh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamaah`
--

CREATE TABLE `jamaah` (
  `jamaah_id` int(11) NOT NULL,
  `jamaah_nik` varchar(50) NOT NULL,
  `jamaah_nama` varchar(50) NOT NULL,
  `jamaah_jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `jamaah_email` varchar(50) NOT NULL,
  `jamaah_password` varchar(100) NOT NULL,
  `jamaah_hp` varchar(15) NOT NULL,
  `jamaah_tempat_lahir` varchar(50) NOT NULL,
  `jamaah_tanggal_lahir` date NOT NULL,
  `jamaah_alamat` text NOT NULL,
  `jamaah_status` enum('baru','aktif','lengkap','hapus') NOT NULL,
  `jamaah_tanggal_tambah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jamaah`
--

INSERT INTO `jamaah` (`jamaah_id`, `jamaah_nik`, `jamaah_nama`, `jamaah_jk`, `jamaah_email`, `jamaah_password`, `jamaah_hp`, `jamaah_tempat_lahir`, `jamaah_tanggal_lahir`, `jamaah_alamat`, `jamaah_status`, `jamaah_tanggal_tambah`) VALUES
(2, '2412414141341431', 'Eko Wahyudi', 'Laki-Laki', 'akun.zudi@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '0858767634765', 'Jombang', '1997-05-21', 'Jombang Kota\r\n\r\n', 'lengkap', '2019-05-13 03:44:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `paket_id` int(11) NOT NULL,
  `paket_no` varchar(50) NOT NULL,
  `paket_nama` varchar(50) NOT NULL,
  `paket_deskripsi` text NOT NULL,
  `paket_kategori` enum('umroh','haji') NOT NULL,
  `paket_status` enum('buka','tutup') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`paket_id`, `paket_no`, `paket_nama`, `paket_deskripsi`, `paket_kategori`, `paket_status`) VALUES
(1, 'UMR-001', 'Umroh Bulan Mei Berkah', '-', 'umroh', 'buka'),
(2, 'HJ-001', 'Haji Paket Hemat Romadhon', '-', 'haji', 'buka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaran_id` int(11) NOT NULL,
  `pendaftaran_no` varchar(50) NOT NULL,
  `pendaftaran_status` enum('menunggu','selesai','batal') NOT NULL,
  `pendaftaran_tanggal_tambah` datetime NOT NULL,
  `pendaftaran_tanggal_kadaluarsa` datetime NOT NULL,
  `periode_id` int(11) NOT NULL,
  `jamaah_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`pendaftaran_id`, `pendaftaran_no`, `pendaftaran_status`, `pendaftaran_tanggal_tambah`, `pendaftaran_tanggal_kadaluarsa`, `periode_id`, `jamaah_id`) VALUES
(2, '140519062934', 'menunggu', '2019-05-14 06:29:34', '2019-05-14 09:29:34', 3, 2),
(3, '140519215344', 'selesai', '2019-05-14 21:53:44', '2019-05-15 00:53:44', 3, 2),
(4, '140519222747', 'selesai', '2019-05-14 22:27:47', '2019-05-15 01:27:47', 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `periode_id` int(11) NOT NULL,
  `periode_bulan` varchar(2) NOT NULL,
  `periode_tahun` varchar(5) NOT NULL,
  `periode_biaya` int(11) NOT NULL,
  `periode_tanggal_berangkat` date NOT NULL,
  `periode_tanggal_tambah` datetime NOT NULL,
  `periode_status` enum('buka','tutup') NOT NULL,
  `paket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`periode_id`, `periode_bulan`, `periode_tahun`, `periode_biaya`, `periode_tanggal_berangkat`, `periode_tanggal_tambah`, `periode_status`, `paket_id`) VALUES
(3, '05', '2019', 5000000, '2019-05-13', '2019-05-13 14:49:24', 'buka', 2),
(4, '05', '2019', 2500000, '2019-05-14', '2019-05-14 07:35:31', 'buka', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `jamaah`
--
ALTER TABLE `jamaah`
  ADD PRIMARY KEY (`jamaah_id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaran_id`),
  ADD KEY `periode_id` (`periode_id`),
  ADD KEY `jamaah_id` (`jamaah_id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`periode_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jamaah`
--
ALTER TABLE `jamaah`
  MODIFY `jamaah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `paket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `pendaftaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `periode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
