-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2025 at 10:33 AM
-- Server version: 8.0.43
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkipsinjai_juri_sinjai`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_indikator_pengguna`
--

CREATE TABLE `akses_indikator_pengguna` (
  `id_user` int NOT NULL,
  `id_indikator` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akses_indikator_pengguna`
--

INSERT INTO `akses_indikator_pengguna` (`id_user`, `id_indikator`) VALUES
(4, 15),
(7, 15),
(9, 15),
(11, 15),
(12, 15),
(4, 16),
(7, 16),
(9, 16),
(10, 16),
(11, 16),
(12, 16),
(4, 17),
(7, 17),
(9, 17),
(11, 17),
(12, 17),
(4, 30),
(6, 30),
(7, 30),
(9, 30),
(11, 30),
(12, 30),
(4, 31),
(6, 31),
(7, 31),
(9, 31),
(11, 31),
(12, 31),
(4, 32),
(7, 32),
(9, 32),
(11, 32),
(12, 32),
(4, 33),
(7, 33),
(8, 33),
(9, 33),
(10, 33),
(11, 33),
(12, 33),
(4, 34),
(7, 34),
(8, 34),
(9, 34),
(11, 34),
(12, 34),
(4, 35),
(6, 35),
(7, 35),
(9, 35),
(11, 35),
(12, 35),
(4, 36),
(7, 36),
(8, 36),
(9, 36),
(11, 36),
(12, 36),
(4, 37),
(7, 37),
(9, 37),
(11, 37),
(12, 37),
(4, 38),
(7, 38),
(9, 38),
(11, 38),
(12, 38),
(4, 39),
(7, 39),
(9, 39),
(11, 39),
(12, 39),
(4, 40),
(7, 40),
(9, 40),
(11, 40),
(12, 40),
(4, 41),
(7, 41),
(9, 41),
(11, 41),
(12, 41),
(4, 42),
(7, 42),
(9, 42),
(10, 42),
(11, 42),
(12, 42),
(4, 43),
(7, 43),
(9, 43),
(11, 43),
(12, 43),
(4, 44),
(7, 44),
(9, 44),
(11, 44),
(12, 44),
(4, 45),
(7, 45),
(9, 45),
(11, 45),
(12, 45),
(4, 46),
(7, 46),
(9, 46),
(11, 46),
(12, 46);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id` int NOT NULL,
  `id_penilaian` int NOT NULL,
  `id_sub_indikator` int NOT NULL,
  `skor` tinyint NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entri_lomba`
--

CREATE TABLE `entri_lomba` (
  `id` int NOT NULL,
  `id_kompetisi` int NOT NULL,
  `nama_karya` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `detail_karya` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `entri_lomba`
--

INSERT INTO `entri_lomba` (`id`, `id_kompetisi`, `nama_karya`, `deskripsi`, `detail_karya`, `dibuat_pada`, `diperbarui_pada`) VALUES
(3, 4, 'Desa Pasimarannu', '', '{\"url\":\"http://www.desamakmur.or.id\", \"screenshot\":\"http://example.com/desamakmur.jpg\"}', '2025-10-03 17:22:50', '2025-10-08 00:52:37'),
(5, 3, 'Dinas P3AP2KB', '', '{\"url\":\"dp3ap2kb.sinjaikab.go.id\",\"admin\":\"\"}', '2025-10-06 08:14:11', '2025-10-06 08:14:11'),
(6, 3, 'Dinas Perpustakaan dan Kearsipan', '', '{\"url\":\"dispusip.sinjaikab.go.id\",\"admin\":\"\"}', '2025-10-06 08:14:31', '2025-10-06 08:14:31'),
(7, 3, 'Dinas Pariwisata dan Kebudayaan', '', '[]', '2025-10-08 00:37:34', '2025-10-09 01:17:42'),
(8, 3, 'Dinas Perikanan', '', '[]', '2025-10-08 00:38:34', '2025-10-08 00:38:34'),
(9, 3, 'Badan Penanggulangan Bencana Daerah', '', '[]', '2025-10-08 00:39:23', '2025-10-08 00:39:23'),
(10, 3, 'Dinas PM PTSP', '', '[]', '2025-10-08 00:39:40', '2025-10-08 00:39:40'),
(11, 3, 'Dinas Tanaman Pangan dan Holtikultura', '', '[]', '2025-10-08 00:40:18', '2025-10-08 00:40:18'),
(12, 3, 'Badan Pendapatan Daerah', '', '[]', '2025-10-08 00:41:00', '2025-10-08 00:41:00'),
(13, 3, 'Dinas Pemberdayaan Masyarakat dan Desa', '', '[]', '2025-10-08 00:43:27', '2025-10-08 00:44:53'),
(14, 3, 'Bagian Organisasi Setdakab', '', '[]', '2025-10-08 00:46:02', '2025-10-08 00:47:18'),
(15, 3, 'Dinas Kesehatan', '', '[]', '2025-10-08 00:47:38', '2025-10-08 00:47:38'),
(16, 3, 'Badan Perencanaan Daerah', '', '[]', '2025-10-08 00:48:06', '2025-10-08 00:48:06'),
(17, 3, 'Dinas Ketahanan Pangan', '', '[]', '2025-10-08 00:48:54', '2025-10-08 00:48:54'),
(18, 3, 'Dinas Lingkungan Hidup dan Holtikultura', '', '[]', '2025-10-08 00:49:25', '2025-10-08 00:49:25'),
(19, 3, 'Bagian Kesra Setdakab', '', '[]', '2025-10-08 00:49:48', '2025-10-08 00:49:48'),
(20, 3, 'Bagian Protokol dan Komunikasi Pimpinan Setdakab', '', '[]', '2025-10-08 00:50:27', '2025-10-08 00:50:27'),
(21, 3, 'Dinas Perumahan Kawasan Permukiman & Pertanahan', '', '[]', '2025-10-08 00:50:51', '2025-10-08 00:50:51'),
(22, 4, 'Desa Terasa', '', '[]', '2025-10-08 00:52:49', '2025-10-08 00:52:49'),
(23, 4, 'Desa Salohe', '', '[]', '2025-10-08 00:53:03', '2025-10-08 00:53:03'),
(24, 4, 'Desa Biroro', '', '[]', '2025-10-08 00:53:14', '2025-10-08 00:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_kriteria`
--

CREATE TABLE `indikator_kriteria` (
  `id` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indikator_kriteria`
--

INSERT INTO `indikator_kriteria` (`id`, `id_kategori`, `nama`, `bobot`) VALUES
(1, 1, 'Orisinalitas Ide', 0.60),
(2, 1, 'Inovasi Konsep', 0.40),
(3, 2, 'Kemudahan Penggunaan', 0.70),
(4, 2, 'Kesesuaian Fitur', 0.30),
(5, 3, 'Desain Visual', 0.80),
(6, 3, 'Konsistensi Desain', 0.20),
(7, 6, 'Nama Domain Sesuai Aturan (go.id / desa.id) (Wajib: Skor 1 atau 5)', 5.00),
(8, 6, 'Ketersediaan SK Tim Pengelola Website (Update 2024/2025)', 5.00),
(9, 7, 'Profil Lengkap (Sejarah, Visi-Misi, Struktur Organisasi)', 5.00),
(10, 7, 'Profil Pimpinan (Foto Bupati/Wabup, Kepala OPD/Desa)', 5.00),
(11, 8, 'Tampilan Visual Apik & Menarik (Desain profesional, rapi, dan modern)', 5.00),
(12, 8, 'Kemudahan Akses & Navigasi (Menu mudah dipahami, informasi mudah ditemukan)', 5.00),
(13, 9, 'Fitur Pencarian Internal (Berfungsi dengan baik)', 5.00),
(14, 9, 'Integrasi & Embed Media Sosial (Tampilan feed Twitter, IG, Facebook)', 5.00),
(15, 10, 'Nama Domain Sesuai Aturan (go.id / desa.id)', 0.30),
(16, 10, 'Ketersediaan SK Tim Pengelola Website (Update 2024/2025)', 0.40),
(17, 10, 'Informasi Kontak Resmi & Jelas (Alamat, Telp, Email Domain Resmi)', 0.30),
(18, 6, 'Informasi Kontak Resmi & Jelas (Alamat, Telp, Email Domain Resmi)', 5.00),
(19, 7, ' Informasi Layanan Publik (Jenis Layanan, Alur, SOP, Layanan Desa/BUMDes)', 5.00),
(20, 7, ' Berita & Artikel Kegiatan (Diperbarui secara rutin/update)', 5.00),
(21, 7, 'Transparansi Kinerja & Anggaran (Laporan Kinerja, Laporan Keuangan, dll)', 5.00),
(22, 7, ' Regulasi & Produk Hukum (Perda, Perbup, Perdes, Surat Edaran)', 5.00),
(23, 7, 'Dukungan Keterbukaan Informasi Publik (PPID) (Struktur & Daftar Informasi Publik)', 5.00),
(24, 8, 'Desain Responsif (Tampil baik di perangkat mobile/HP)', 5.00),
(25, 9, 'Statistik Pengunjung (Menampilkan data kunjungan website)', 5.00),
(26, 9, 'Kanal Pengaduan/Aspirasi Publik (Formulir online yang fungsional)', 5.00),
(27, 15, 'Kecepatan Muat Halaman (Website tidak lambat saat dibuka)', 5.00),
(28, 15, 'Penggunaan HTTPS (SSL) (Website aman, ditandai ikon gembok) (Wajib: Skor 1 atau 5)', 5.00),
(29, 15, 'Tidak Ada Tautan Rusak (Semua link di website berfungsi)', 5.00),
(30, 11, 'Profil Lengkap (Sejarah, Visi-Misi, Struktur Organisasi)', 5.00),
(31, 11, 'Profil Pimpinan (Foto Bupati/Wabup, Kepala OPD/Desa)', 5.00),
(32, 11, 'Informasi Layanan Publik (Jenis Layanan, Alur, SOP, Layanan Desa/BUMDes)', 5.00),
(33, 11, 'Berita & Artikel Kegiatan (Diperbarui secara rutin/update)', 5.00),
(34, 11, 'Transparansi Kinerja & Anggaran (Laporan Kinerja, Laporan Keuangan, dll)', 5.00),
(35, 11, ' Regulasi & Produk Hukum (Perda, Perbup, Perdes, Surat Edaran)', 5.00),
(36, 11, 'Dukungan Keterbukaan Informasi Publik (PPID) (Struktur & Daftar Informasi Publik)', 5.00),
(37, 12, 'Tampilan Visual Apik & Menarik (Desain profesional, rapi, dan modern)', 5.00),
(38, 12, 'Kemudahan Akses & Navigasi (Menu mudah dipahami, informasi mudah ditemukan)', 5.00),
(39, 12, 'Desain Responsif (Tampil baik di perangkat mobile/HP)', 5.00),
(40, 13, 'Fitur Pencarian Internal (Berfungsi dengan baik)', 5.00),
(41, 13, ' Integrasi & Embed Media Sosial (Tampilan feed Twitter, IG, Facebook)', 5.00),
(42, 13, 'Statistik Pengunjung (Menampilkan data kunjungan website)', 5.00),
(43, 13, 'Kanal Pengaduan/Aspirasi Publik (Formulir online yang fungsional)', 5.00),
(44, 14, 'Kecepatan Muat Halaman (Website tidak lambat saat dibuka)', 5.00),
(45, 14, 'Penggunaan HTTPS (SSL) (Website aman, ditandai ikon gembok) (Wajib: Skor 1 atau 5)', 5.00),
(46, 14, 'Tidak Ada Tautan Rusak (Semua link di website berfungsi)', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `izin_akses`
--

CREATE TABLE `izin_akses` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `juri_entri_lomba`
--

CREATE TABLE `juri_entri_lomba` (
  `id` int NOT NULL,
  `entri_lomba_id` int NOT NULL,
  `juri_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `juri_entri_lomba`
--

INSERT INTO `juri_entri_lomba` (`id`, `entri_lomba_id`, `juri_id`, `created_at`, `updated_at`) VALUES
(615, 3, 4, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(616, 3, 6, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(617, 3, 7, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(618, 3, 8, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(619, 3, 9, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(620, 3, 10, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(621, 3, 12, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(622, 3, 13, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(623, 22, 4, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(624, 22, 6, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(625, 22, 7, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(626, 22, 8, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(627, 22, 9, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(628, 22, 10, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(629, 22, 11, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(630, 22, 12, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(631, 23, 4, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(632, 23, 6, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(633, 23, 7, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(634, 23, 8, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(635, 23, 9, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(636, 23, 10, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(637, 23, 11, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(638, 23, 12, '2025-10-09 09:05:49', '2025-10-09 09:05:49'),
(639, 24, 4, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(640, 24, 6, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(641, 24, 7, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(642, 24, 8, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(643, 24, 9, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(644, 24, 10, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(645, 24, 11, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(646, 24, 12, '2025-10-09 09:05:50', '2025-10-09 09:05:50'),
(656, 5, 4, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(657, 5, 6, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(658, 5, 7, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(659, 5, 8, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(660, 5, 9, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(661, 5, 10, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(662, 5, 11, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(663, 5, 12, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(664, 5, 13, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(665, 6, 4, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(666, 6, 6, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(667, 6, 7, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(668, 6, 8, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(669, 6, 9, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(670, 6, 10, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(671, 6, 11, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(672, 6, 12, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(673, 6, 13, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(674, 7, 4, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(675, 7, 6, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(676, 7, 7, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(677, 7, 8, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(678, 7, 9, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(679, 7, 10, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(680, 7, 11, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(681, 7, 12, '2025-10-09 09:21:12', '2025-10-09 09:21:12'),
(682, 8, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(683, 8, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(684, 8, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(685, 8, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(686, 8, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(687, 8, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(688, 8, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(689, 8, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(690, 9, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(691, 9, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(692, 9, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(693, 9, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(694, 9, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(695, 9, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(696, 9, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(697, 9, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(698, 10, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(699, 10, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(700, 10, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(701, 10, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(702, 10, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(703, 10, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(704, 10, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(705, 10, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(706, 11, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(707, 11, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(708, 11, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(709, 11, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(710, 11, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(711, 11, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(712, 11, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(713, 11, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(714, 12, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(715, 12, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(716, 12, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(717, 12, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(718, 12, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(719, 12, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(720, 12, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(721, 12, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(722, 13, 4, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(723, 13, 6, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(724, 13, 7, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(725, 13, 8, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(726, 13, 9, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(727, 13, 10, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(728, 13, 11, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(729, 13, 12, '2025-10-09 09:21:13', '2025-10-09 09:21:13'),
(730, 14, 4, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(731, 14, 6, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(732, 14, 7, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(733, 14, 8, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(734, 14, 9, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(735, 14, 10, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(736, 14, 11, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(737, 14, 12, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(738, 15, 4, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(739, 15, 6, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(740, 15, 7, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(741, 15, 8, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(742, 15, 9, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(743, 15, 10, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(744, 15, 11, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(745, 15, 12, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(746, 16, 4, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(747, 16, 6, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(748, 16, 7, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(749, 16, 8, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(750, 16, 9, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(751, 16, 10, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(752, 16, 11, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(753, 16, 12, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(754, 17, 4, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(755, 17, 6, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(756, 17, 7, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(757, 17, 8, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(758, 17, 9, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(759, 17, 10, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(760, 17, 11, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(761, 17, 12, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(762, 18, 4, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(763, 18, 6, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(764, 18, 7, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(765, 18, 8, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(766, 18, 9, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(767, 18, 10, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(768, 18, 11, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(769, 18, 12, '2025-10-09 09:21:14', '2025-10-09 09:21:14'),
(770, 19, 4, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(771, 19, 6, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(772, 19, 7, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(773, 19, 8, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(774, 19, 9, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(775, 19, 10, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(776, 19, 11, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(777, 19, 12, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(778, 20, 4, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(779, 20, 6, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(780, 20, 7, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(781, 20, 8, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(782, 20, 9, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(783, 20, 10, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(784, 20, 11, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(785, 20, 12, '2025-10-09 09:21:15', '2025-10-09 09:21:15'),
(794, 21, 4, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(795, 21, 6, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(796, 21, 7, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(797, 21, 8, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(798, 21, 9, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(799, 21, 10, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(800, 21, 11, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(801, 21, 12, '2025-10-09 09:58:19', '2025-10-09 09:58:19'),
(802, 21, 13, '2025-10-09 09:58:19', '2025-10-09 09:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kriteria`
--

CREATE TABLE `kategori_kriteria` (
  `id` int NOT NULL,
  `id_templat_penilaian` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_kriteria`
--

INSERT INTO `kategori_kriteria` (`id`, `id_templat_penilaian`, `nama`, `bobot`) VALUES
(1, 1, 'Kreativitas', 0.40),
(2, 1, 'Fungsionalitas', 0.30),
(3, 1, 'Estetika', 0.30),
(4, 2, 'Performa', 0.50),
(5, 2, 'Keamanan', 0.50),
(6, 3, 'Kepatuhan dan Tata Kelola', 15.00),
(7, 3, 'KONTEN & INFORMASI', 40.00),
(8, 3, 'DESAIN & PENGALAMAN PENGGUNA (UI/UX)', 15.00),
(9, 3, 'FITUR & INTERAKTIVITAS', 15.00),
(10, 4, 'KEPATUHAN & TATA KELOLA', 0.15),
(11, 4, 'KONTEN & INFORMASI', 0.40),
(12, 4, 'DESAIN & PENGALAMAN PENGGUNA (UI/UX)', 0.15),
(13, 4, 'FITUR & INTERAKTIVITAS', 0.15),
(14, 4, 'ASPEK TEKNIS & KEAMANAN', 0.15),
(15, 3, 'ASPEK TEKNIS & KEAMANAN', 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `kompetisi`
--

CREATE TABLE `kompetisi` (
  `id` int NOT NULL,
  `id_templat_penilaian` int DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kompetisi`
--

INSERT INTO `kompetisi` (`id`, `id_templat_penilaian`, `nama`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `dibuat_pada`, `diperbarui_pada`) VALUES
(3, 4, 'Lomba Website Instansi 2025', 'Kompetisi untuk menilai website instansi pemerintah daerah.', '2025-10-06', '2025-10-26', '2025-10-03 17:22:50', '2025-10-06 08:16:58'),
(4, 4, 'Lomba Website Desa 2025', 'Penilaian website desa dengan fokus pada inovasi dan pelayanan publik.', '2025-10-06', '2025-10-26', '2025-10-03 17:22:50', '2025-10-06 08:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20251004100000);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int NOT NULL,
  `id_kompetisi` int NOT NULL,
  `id_entri_lomba` int NOT NULL,
  `id_user` int NOT NULL,
  `status` enum('draft','terkirim') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `dikirim_pada` timestamp NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Admin Super', 'Administrator dengan akses penuh ke sistem dan semua lomba.'),
(3, 'Juri', 'Penilai yang memberikan skor dan umpan balik pada entri lomba.'),
(5, 'user', 'user biasa');

-- --------------------------------------------------------

--
-- Table structure for table `role_izin_akses`
--

CREATE TABLE `role_izin_akses` (
  `id_role` int NOT NULL,
  `id_izin_akses` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skema_entri_templat`
--

CREATE TABLE `skema_entri_templat` (
  `id` int UNSIGNED NOT NULL,
  `id_templat_penilaian` int NOT NULL,
  `nama_field` varchar(100) NOT NULL COMMENT 'Nama untuk atribut name di input HTML',
  `label_field` varchar(255) NOT NULL COMMENT 'Label yang akan tampil di form',
  `tipe_field` varchar(50) NOT NULL DEFAULT 'text' COMMENT 'Tipe input HTML (cth: text, textarea, url)',
  `urutan` int NOT NULL DEFAULT '0',
  `wajib_diisi` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `skema_entri_templat`
--

INSERT INTO `skema_entri_templat` (`id`, `id_templat_penilaian`, `nama_field`, `label_field`, `tipe_field`, `urutan`, `wajib_diisi`) VALUES
(1, 3, 'url', 'URL Website', 'text', 1, 0),
(3, 3, 'admin', 'Admin Web', 'text', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_indikator_kriteria`
--

CREATE TABLE `sub_indikator_kriteria` (
  `id` int NOT NULL,
  `id_indikator` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan_tampil` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_indikator_kriteria`
--

INSERT INTO `sub_indikator_kriteria` (`id`, `id_indikator`, `nama`, `urutan_tampil`) VALUES
(1, 1, 'Keunikan gagasan yang disajikan', 1),
(2, 1, 'Pendekatan baru dalam penyelesaian masalah', 2),
(3, 2, 'Penggunaan teknologi/metode baru', 1),
(4, 2, 'Potensi pengembangan lebih lanjut', 2),
(5, 3, 'Antarmuka intuitif', 1),
(6, 3, 'Navigasi yang jelas', 2),
(7, 7, 'Tampilan adaptif di berbagai perangkat', 1),
(8, 7, 'Tata letak konsisten', 2),
(9, 8, 'Penggunaan warna dan tipografi yang harmonis', 1),
(10, 8, 'Kualitas gambar dan ikon', 2),
(11, 9, 'Kemudahan menemukan informasi', 1),
(12, 9, 'Struktur menu yang jelas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `templat_penilaian`
--

CREATE TABLE `templat_penilaian` (
  `id` int NOT NULL,
  `nama_templat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templat_penilaian`
--

INSERT INTO `templat_penilaian` (`id`, `nama_templat`, `deskripsi`) VALUES
(1, 'Desain Grafis Dasar', 'Template penilaian untuk lomba desain grafis tingkat dasar.'),
(2, 'Aplikasi Mobile Lanjutan', 'Template penilaian untuk lomba pengembangan aplikasi mobile tingkat lanjutan.'),
(3, 'Penilaian Website Instansi/Desa', 'Template penilaian khusus untuk website instansi pemerintah dan desa.'),
(4, 'Penilaian Website OPD dan Desa Kabupaten Sinjai 2025', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kata_sandi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `kata_sandi`, `dibuat_pada`, `diperbarui_pada`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$dOEi48FYKqODyg2eyUoP5OTlJNULUG/7UJ23eMyahCtrfaO0qoRna', '2025-10-06 00:59:31', '2025-10-06 00:59:31'),
(4, 'Muhammad Rusyaid, S.Kom., M.Si.', 'mrusyaid@sinjaikab.go.id', '$2y$10$0ohQ2B2sH63i4HgE2OUOzOxIala/RLNmWQ5WFekM96sqCWbsJgbDu', '2025-10-03 06:16:56', '2025-10-06 08:01:58'),
(6, 'DR. Mansyur, S.Pd, M.Si', 'mansyur@sinjaikab.go.id', '$2y$10$TQRaFb624YnJ32lmyOYedOyWMw.bqNUx/DOBdjgE5wujfRLP4hQvq', '2025-10-04 19:30:11', '2025-10-04 19:37:19'),
(7, 'Muhammad Takdir, ST, M.I.Kom', 'mtakdir@sinjaikab.go.id', '$2y$10$.A.c2TuTJoe9R.b2/blf6e6SjYC2MPUB6ZdOeuyEmGowpzRP6reLi', '2025-10-04 19:30:11', '2025-10-04 19:41:31'),
(8, 'Ika Mayasari, S.S, M.Si', 'ikamayasari@sinjaikab.go.id', '$2y$10$Em29TedZtMxObmZ4NaulXuKOQKi5jkM.oL0f0tpb9C/OdRVKGAugq', '2025-10-04 19:30:11', '2025-10-04 19:38:41'),
(9, 'Haryanti Arief, S.Si, M.M', 'yantiarief@sinjaikab.go.id', '$2y$10$og65uUTNc5jZRywrn1byHudbfZErEAU1QwGjTJkqho/LD6iuHWH9i', '2025-10-04 19:30:11', '2025-10-04 19:39:20'),
(10, 'Usman, S.H.', 'usman@sinjaikab.go.id', '$2y$10$GBUaiDnk6qpAerbGORn5J.e6RczjHzph8Jxzo1S5gCCR0fTVcizOK', '2025-10-04 19:30:11', '2025-10-04 19:39:56'),
(11, 'Lutfi Hidayat', 'lutfihidayat@sinjaikab.go.id', '$2y$10$0DWiCOWeHtCqST29NCQ2HOXcBN.xar2basGOAbNZ9TygdZprsQF5.', '2025-10-04 19:30:11', '2025-10-04 19:40:21'),
(12, 'Abd. Dzuljalali Wal Ikram, S.T', 'dzul@sinjaikab.go.id', '$2y$10$avu7lNs2SeFhdPxKSUEF5.rDbuttilkPwZZDXmMBIMzdg1NM04XWm', '2025-10-04 19:30:11', '2025-10-04 19:40:56'),
(13, 'Ira Afrawati Nur, S.Kom', 'iraafrawati@sinjaikab.go.id', '$2y$10$ak1Xcv7M2sLOn7ttz/tTluCEtZ3ISHFq0vYvwHMJoVVCJNEvkBz4m', '2025-10-04 19:30:11', '2025-10-08 00:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id_user` int NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id_user`, `id_role`) VALUES
(1, 1),
(4, 1),
(12, 1),
(13, 1),
(4, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_indikator_pengguna`
--
ALTER TABLE `akses_indikator_pengguna`
  ADD PRIMARY KEY (`id_user`,`id_indikator`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- Indexes for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_sub_indikator` (`id_sub_indikator`);

--
-- Indexes for table `entri_lomba`
--
ALTER TABLE `entri_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kompetisi` (`id_kompetisi`);

--
-- Indexes for table `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `izin_akses`
--
ALTER TABLE `izin_akses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_juri_entri_lomba` (`entri_lomba_id`,`juri_id`),
  ADD KEY `juri_id` (`juri_id`);

--
-- Indexes for table `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indexes for table `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaian_unik` (`id_kompetisi`,`id_entri_lomba`,`id_user`),
  ADD KEY `id_entri_lomba` (`id_entri_lomba`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `role_izin_akses`
--
ALTER TABLE `role_izin_akses`
  ADD PRIMARY KEY (`id_role`,`id_izin_akses`),
  ADD KEY `id_izin_akses` (`id_izin_akses`);

--
-- Indexes for table `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indexes for table `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- Indexes for table `templat_penilaian`
--
ALTER TABLE `templat_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id_user`,`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entri_lomba`
--
ALTER TABLE `entri_lomba`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `izin_akses`
--
ALTER TABLE `izin_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=803;

--
-- AUTO_INCREMENT for table `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kompetisi`
--
ALTER TABLE `kompetisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `templat_penilaian`
--
ALTER TABLE `templat_penilaian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses_indikator_pengguna`
--
ALTER TABLE `akses_indikator_pengguna`
  ADD CONSTRAINT `akses_indikator_pengguna_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `akses_indikator_pengguna_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_sub_indikator`) REFERENCES `sub_indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `entri_lomba`
--
ALTER TABLE `entri_lomba`
  ADD CONSTRAINT `entri_lomba_ibfk_1` FOREIGN KEY (`id_kompetisi`) REFERENCES `kompetisi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  ADD CONSTRAINT `indikator_kriteria_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  ADD CONSTRAINT `juri_entri_lomba_ibfk_1` FOREIGN KEY (`entri_lomba_id`) REFERENCES `entri_lomba` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `juri_entri_lomba_ibfk_2` FOREIGN KEY (`juri_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  ADD CONSTRAINT `kategori_kriteria_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD CONSTRAINT `kompetisi_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kompetisi`) REFERENCES `kompetisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_entri_lomba`) REFERENCES `entri_lomba` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_izin_akses`
--
ALTER TABLE `role_izin_akses`
  ADD CONSTRAINT `role_izin_akses_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_izin_akses_ibfk_2` FOREIGN KEY (`id_izin_akses`) REFERENCES `izin_akses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  ADD CONSTRAINT `skema_entri_templat_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  ADD CONSTRAINT `sub_indikator_kriteria_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
