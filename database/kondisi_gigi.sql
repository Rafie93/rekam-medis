-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 07.25
-- Versi server: 5.7.34
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik_medishina`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_gigi`
--

CREATE TABLE `kondisi_gigi` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kondisi_gigi`
--

INSERT INTO `kondisi_gigi` (`id`, `kode`, `nama`) VALUES
(1, 'sou', 'sound'),
(2, 'non', 'no information'),
(3, 'une', 'unerupted'),
(4, 'pre', 'present'),
(5, 'imx', 'impacted non-visible'),
(6, 'ano', 'anomali'),
(7, 'dia', 'diastema'),
(8, 'abr', NULL),
(9, 'car', 'caries'),
(10, 'cfr', 'crown fractured'),
(11, 'nvt', 'non-vital tooth'),
(12, 'rrx', 'retained root'),
(13, 'mis', 'missing'),
(14, 'att', 'attrition'),
(15, 'amf', 'amalgam filling'),
(16, 'gif', 'glass ionomer filling'),
(17, 'cof', NULL),
(18, 'fis', 'fissure sealant'),
(19, 'inl', 'inlay'),
(20, 'onl', 'onlay'),
(21, 'fmc', 'full metal crown'),
(22, 'poc', 'porcelain crown'),
(23, 'mpc', 'metal porcelain crown'),
(24, 'gmc', 'gold metal crown'),
(25, 'rct', 'root canal treatment'),
(26, 'ipx', 'implant'),
(27, 'meb', 'metal bridge'),
(28, 'pob', 'porcelain bridge'),
(29, 'pon', 'pontic'),
(30, 'abu', 'abutment');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
