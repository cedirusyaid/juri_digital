-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Okt 2025 pada 08.41
-- Versi server: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juri_digital_serbaguna_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_indikator_pengguna`
--

CREATE TABLE `akses_indikator_pengguna` (
  `id_user` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akses_indikator_pengguna`
--

INSERT INTO `akses_indikator_pengguna` (`id_user`, `id_indikator`) VALUES
(7, 8),
(7, 11),
(8, 8),
(8, 11),
(8, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_sub_indikator` int(11) NOT NULL,
  `skor` tinyint(4) NOT NULL,
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id`, `id_penilaian`, `id_sub_indikator`, `skor`, `catatan`, `dibuat_pada`, `diperbarui_pada`) VALUES
(13, 5, 9, 80, '', '2025-10-06 08:35:30', '2025-10-06 08:35:30'),
(14, 5, 10, 50, '', '2025-10-06 08:35:30', '2025-10-06 08:35:30'),
(15, 6, 7, 60, '80', '2025-10-06 09:11:12', '2025-10-06 11:43:11'),
(16, 6, 8, 80, '80', '2025-10-06 09:11:12', '2025-10-06 09:51:10'),
(17, 6, 9, 60, 'ggg', '2025-10-06 09:11:12', '2025-10-06 09:51:10'),
(18, 6, 10, 60, '60', '2025-10-06 09:11:12', '2025-10-06 09:51:10'),
(19, 6, 11, 60, 'kueiygg', '2025-10-06 09:11:12', '2025-10-06 13:27:49'),
(20, 6, 12, 0, '', '2025-10-06 09:11:12', '2025-10-06 09:51:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `entri_lomba`
--

CREATE TABLE `entri_lomba` (
  `id` int(11) NOT NULL,
  `id_kompetisi` int(11) NOT NULL,
  `nama_karya` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `detail_karya` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detail_karya`)),
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `entri_lomba`
--

INSERT INTO `entri_lomba` (`id`, `id_kompetisi`, `nama_karya`, `deskripsi`, `detail_karya`, `dibuat_pada`, `diperbarui_pada`) VALUES
(4, 6, 'Web XXX', 'oqwke', '{\"url\":\"http:\\/\\/coba.tes\",\"admin\":\"qowidh \"}', '2025-10-06 02:29:06', '2025-10-09 07:54:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator_kriteria`
--

CREATE TABLE `indikator_kriteria` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `indikator_kriteria`
--

INSERT INTO `indikator_kriteria` (`id`, `id_kategori`, `nama`, `bobot`) VALUES
(1, 1, 'Orisinalitas Ide', '0.60'),
(2, 1, 'Inovasi Konsep', '0.40'),
(3, 2, 'Kemudahan Penggunaan', '0.70'),
(4, 2, 'Kesesuaian Fitur', '0.30'),
(5, 3, 'Desain Visual', '0.80'),
(6, 3, 'Konsistensi Desain', '0.20'),
(7, 6, 'Responsivitas Desain', '0.50'),
(8, 6, 'Estetika Visual', '0.50'),
(9, 7, 'Navigasi', '0.60'),
(10, 7, 'Fitur Interaktif', '0.40'),
(11, 8, 'Kualitas Konten', '0.70'),
(12, 8, 'Keterbaruan Informasi', '0.30'),
(13, 9, 'Kecepatan Akses', '0.60'),
(14, 9, 'Aspek Keamanan', '0.40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `izin_akses`
--

CREATE TABLE `izin_akses` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `juri_entri_lomba`
--

CREATE TABLE `juri_entri_lomba` (
  `id` int(11) NOT NULL,
  `entri_lomba_id` int(11) NOT NULL,
  `juri_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `juri_entri_lomba`
--

INSERT INTO `juri_entri_lomba` (`id`, `entri_lomba_id`, `juri_id`, `created_at`, `updated_at`) VALUES
(51, 4, 4, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(52, 4, 6, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(53, 4, 7, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(54, 4, 8, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(55, 4, 9, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(56, 4, 10, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(57, 4, 12, '2025-10-06 16:55:01', '2025-10-06 16:55:01'),
(58, 4, 13, '2025-10-06 16:55:01', '2025-10-06 16:55:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_kriteria`
--

CREATE TABLE `kategori_kriteria` (
  `id` int(11) NOT NULL,
  `id_templat_penilaian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_kriteria`
--

INSERT INTO `kategori_kriteria` (`id`, `id_templat_penilaian`, `nama`, `bobot`) VALUES
(1, 1, 'Kreativitas', '0.40'),
(2, 1, 'Fungsionalitas', '0.30'),
(3, 1, 'Estetika', '0.30'),
(4, 2, 'Performa', '0.50'),
(5, 2, 'Keamanan', '0.50'),
(6, 3, 'Desain & Tampilan', '0.30'),
(7, 3, 'Fungsionalitas', '0.30'),
(8, 3, 'Konten & Informasi', '0.25'),
(9, 3, 'Performa & Keamanan', '0.15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kompetisi`
--

CREATE TABLE `kompetisi` (
  `id` int(11) NOT NULL,
  `id_templat_penilaian` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kompetisi`
--

INSERT INTO `kompetisi` (`id`, `id_templat_penilaian`, `nama`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `dibuat_pada`, `diperbarui_pada`) VALUES
(5, 3, 'Lomba Website 2025', '', '2025-10-06', '2025-10-26', '2025-10-06 02:15:00', '2025-10-06 02:15:00'),
(6, 3, 'Lomba Website Desa 2025', '', '2025-10-06', '2025-10-26', '2025-10-06 02:15:56', '2025-10-06 02:16:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20251004100000),
(20251004100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_kompetisi` int(11) NOT NULL,
  `id_entri_lomba` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('draft','terkirim') NOT NULL DEFAULT 'draft',
  `dikirim_pada` timestamp NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_kompetisi`, `id_entri_lomba`, `id_user`, `status`, `dikirim_pada`, `dibuat_pada`, `diperbarui_pada`) VALUES
(5, 6, 4, 7, 'terkirim', '2025-10-06 08:35:30', '2025-10-06 08:35:30', '2025-10-06 08:35:30'),
(6, 6, 4, 4, 'terkirim', '2025-10-09 01:59:09', '2025-10-06 09:11:12', '2025-10-09 01:59:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Admin Super', 'Administrator dengan akses penuh ke sistem dan semua lomba.'),
(2, 'Admin Lomba', 'Administrator yang mengelola lomba-lomba tertentu.'),
(3, 'Juri', 'Penilai yang memberikan skor dan umpan balik pada entri lomba.'),
(5, 'user', 'user biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_izin_akses`
--

CREATE TABLE `role_izin_akses` (
  `id_role` int(11) NOT NULL,
  `id_izin_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `skema_entri_templat`
--

CREATE TABLE `skema_entri_templat` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_templat_penilaian` int(11) NOT NULL,
  `nama_field` varchar(100) NOT NULL COMMENT 'Nama untuk atribut name di input HTML',
  `label_field` varchar(255) NOT NULL COMMENT 'Label yang akan tampil di form',
  `tipe_field` varchar(50) NOT NULL DEFAULT 'text' COMMENT 'Tipe input HTML (cth: text, textarea, url)',
  `urutan` int(11) NOT NULL DEFAULT 0,
  `wajib_diisi` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `skema_entri_templat`
--

INSERT INTO `skema_entri_templat` (`id`, `id_templat_penilaian`, `nama_field`, `label_field`, `tipe_field`, `urutan`, `wajib_diisi`) VALUES
(1, 3, 'url', 'URL Website', 'text', 1, 0),
(3, 3, 'admin', 'Admin Web', 'text', 2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_indikator_kriteria`
--

CREATE TABLE `sub_indikator_kriteria` (
  `id` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `urutan_tampil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_indikator_kriteria`
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
-- Struktur dari tabel `templat_penilaian`
--

CREATE TABLE `templat_penilaian` (
  `id` int(11) NOT NULL,
  `nama_templat` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `templat_penilaian`
--

INSERT INTO `templat_penilaian` (`id`, `nama_templat`, `deskripsi`) VALUES
(1, 'Desain Grafis Dasar', 'Template penilaian untuk lomba desain grafis tingkat dasar.'),
(2, 'Aplikasi Mobile Lanjutan', 'Template penilaian untuk lomba pengembangan aplikasi mobile tingkat lanjutan.'),
(3, 'Penilaian Website Instansi/Desa', 'Template penilaian khusus untuk website instansi pemerintah dan desa.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `kata_sandi`, `dibuat_pada`, `diperbarui_pada`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$dOEi48FYKqODyg2eyUoP5OTlJNULUG/7UJ23eMyahCtrfaO0qoRna', '2025-10-06 00:59:31', '2025-10-06 00:59:31'),
(4, 'Muhammad Rusyaid, S.Kom., M.Si.', 'mrusyaid@sinjaikab.go.id', '$2y$10$klkxsBOZv7fCuKWoJDcfFu4E2oOWVqNcEX0y4H7U59K62oFJbnmnq', '2025-10-03 14:16:56', '2025-10-05 04:57:53'),
(6, 'DR. Mansyur, S.Pd, M.Si', 'mansyur@sinjaikab.go.id', '$2y$10$TQRaFb624YnJ32lmyOYedOyWMw.bqNUx/DOBdjgE5wujfRLP4hQvq', '2025-10-05 03:30:11', '2025-10-05 03:37:19'),
(7, 'Muhammad Takdir, ST, M.I.Kom', 'mtakdir@sinjaikab.go.id', '$2y$10$.A.c2TuTJoe9R.b2/blf6e6SjYC2MPUB6ZdOeuyEmGowpzRP6reLi', '2025-10-05 03:30:11', '2025-10-05 03:41:31'),
(8, 'Ika Mayasari, S.S, M.Si', 'ikamayasari@sinjaikab.go.id', '$2y$10$Em29TedZtMxObmZ4NaulXuKOQKi5jkM.oL0f0tpb9C/OdRVKGAugq', '2025-10-05 03:30:11', '2025-10-05 03:38:41'),
(9, 'Haryanti Arief, S.Si, M.M', 'yantiarief@sinjaikab.go.id', '$2y$10$og65uUTNc5jZRywrn1byHudbfZErEAU1QwGjTJkqho/LD6iuHWH9i', '2025-10-05 03:30:11', '2025-10-05 03:39:20'),
(10, 'Usman, S.H.', 'usman@sinjaikab.go.id', '$2y$10$GBUaiDnk6qpAerbGORn5J.e6RczjHzph8Jxzo1S5gCCR0fTVcizOK', '2025-10-05 03:30:11', '2025-10-05 03:39:56'),
(11, 'Lutfi Hidayat', 'lutfihidayat@sinjaikab.go.id', '$2y$10$0DWiCOWeHtCqST29NCQ2HOXcBN.xar2basGOAbNZ9TygdZprsQF5.', '2025-10-05 03:30:11', '2025-10-05 03:40:21'),
(12, 'Abd. Dzuljalali Wal Ikram, S.T', 'dzul@sinjaikab.go.id', '$2y$10$avu7lNs2SeFhdPxKSUEF5.rDbuttilkPwZZDXmMBIMzdg1NM04XWm', '2025-10-05 03:30:11', '2025-10-05 03:40:56'),
(13, 'Ira Afrawati Nur, S.Kom', 'iraafrawati@sinjaikab.go.id', '$2y$10$7oOe14d/4YStx2FiCzsOseurYRFtx/iOEQKf4i.NCSH0dYgt69RFm', '2025-10-05 03:30:11', '2025-10-05 03:41:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`id_user`, `id_role`) VALUES
(1, 1),
(4, 1),
(4, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses_indikator_pengguna`
--
ALTER TABLE `akses_indikator_pengguna`
  ADD PRIMARY KEY (`id_user`,`id_indikator`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- Indeks untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_sub_indikator` (`id_sub_indikator`);

--
-- Indeks untuk tabel `entri_lomba`
--
ALTER TABLE `entri_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kompetisi` (`id_kompetisi`);

--
-- Indeks untuk tabel `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `izin_akses`
--
ALTER TABLE `izin_akses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_juri_entri_lomba` (`entri_lomba_id`,`juri_id`),
  ADD KEY `juri_id` (`juri_id`);

--
-- Indeks untuk tabel `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indeks untuk tabel `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaian_unik` (`id_kompetisi`,`id_entri_lomba`,`id_user`),
  ADD KEY `id_entri_lomba` (`id_entri_lomba`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `role_izin_akses`
--
ALTER TABLE `role_izin_akses`
  ADD PRIMARY KEY (`id_role`,`id_izin_akses`),
  ADD KEY `id_izin_akses` (`id_izin_akses`);

--
-- Indeks untuk tabel `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_templat_penilaian` (`id_templat_penilaian`);

--
-- Indeks untuk tabel `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- Indeks untuk tabel `templat_penilaian`
--
ALTER TABLE `templat_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id_user`,`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `entri_lomba`
--
ALTER TABLE `entri_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `izin_akses`
--
ALTER TABLE `izin_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kompetisi`
--
ALTER TABLE `kompetisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `templat_penilaian`
--
ALTER TABLE `templat_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akses_indikator_pengguna`
--
ALTER TABLE `akses_indikator_pengguna`
  ADD CONSTRAINT `akses_indikator_pengguna_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `akses_indikator_pengguna_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_sub_indikator`) REFERENCES `sub_indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `entri_lomba`
--
ALTER TABLE `entri_lomba`
  ADD CONSTRAINT `entri_lomba_ibfk_1` FOREIGN KEY (`id_kompetisi`) REFERENCES `kompetisi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `indikator_kriteria`
--
ALTER TABLE `indikator_kriteria`
  ADD CONSTRAINT `indikator_kriteria_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `juri_entri_lomba`
--
ALTER TABLE `juri_entri_lomba`
  ADD CONSTRAINT `juri_entri_lomba_ibfk_1` FOREIGN KEY (`entri_lomba_id`) REFERENCES `entri_lomba` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `juri_entri_lomba_ibfk_2` FOREIGN KEY (`juri_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori_kriteria`
--
ALTER TABLE `kategori_kriteria`
  ADD CONSTRAINT `kategori_kriteria_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD CONSTRAINT `kompetisi_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kompetisi`) REFERENCES `kompetisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_entri_lomba`) REFERENCES `entri_lomba` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_izin_akses`
--
ALTER TABLE `role_izin_akses`
  ADD CONSTRAINT `role_izin_akses_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_izin_akses_ibfk_2` FOREIGN KEY (`id_izin_akses`) REFERENCES `izin_akses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `skema_entri_templat`
--
ALTER TABLE `skema_entri_templat`
  ADD CONSTRAINT `skema_entri_templat_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_indikator_kriteria`
--
ALTER TABLE `sub_indikator_kriteria`
  ADD CONSTRAINT `sub_indikator_kriteria_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
