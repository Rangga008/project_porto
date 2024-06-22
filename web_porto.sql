-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2023 at 05:18 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_porto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`) VALUES
(1, 'SuperAdmin', 'superadmin@admin.com', '$2y$10$sMZYZnqHSvMAD5R8v342c.fmTfReLg0426g57A2eApU2XUg6UCRBC'),
(2, 'Admin', 'admin@admin.com', '$2y$10$97BhfSkremJZvktHaSkNm.WG93LPGyqBin16AaAJpVnEZp14FlYte');

-- --------------------------------------------------------

--
-- Table structure for table `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurnal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnals`
--

INSERT INTO `jurnals` (`id`, `mahasiswa_id`, `judul`, `penulis`, `jurnal`, `file`, `status`, `deleted_at`) VALUES
(1, 4, 'Perancangan Aplikasi Android “Semarang Food Finder”  Menggunakan Bahasa Pemrograman Kotlin dan Clean Architecture', 'Anggara Diebrata;\r\nIke Pertiwi Windasari;\r\nKurniawan Teguh Martono;', 'EMITTER International Journal of Engineering Technology', '1675686911.pdf', 'Menunggu Verifikasi', NULL),
(2, 6, 'Sistem Informasi Geografis Lokasi Kantor Pemerintahan Di Kota Semarang Berbasis Web', 'Yudhi Kasih Pasaribu;\r\nOky Dwi Nurhayati;\r\nIke Pertiwi Windasari', 'Jurnal Ilmu Teknik dan Komputer', '1675741669.pdf', 'Menunggu Verifikasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `mahasiswa_id`, `jabatan`, `kegiatan`, `periode`, `image`, `status`, `deleted_at`) VALUES
(1, 4, 'Sertifikat Kompetensi', 'Memulai Pemrograman dengan Kotlin', '28 Februari 2021', '1675687566.jpg', 'Menunggu Verifikasi', NULL),
(2, 4, 'Certificate of Completion', 'Fundamental SQL Using SELECT Statement', '26 Agustus 2021', '1675687634.jpg', 'Menunggu Verifikasi', NULL),
(3, 10, 'Wakil Ketua', 'Himpunan Mahasiswa Teknik Komputer', '2018-2019', '1675751346.jpeg', 'Telah diverifikasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `email`, `password`, `nim`, `fakultas`, `prodi`, `image`, `deleted_at`) VALUES
(1, 'mahasiswa1', 'mahasiswa1@guest.com', '$2y$10$dkKpy1QAqwfoACRNorZGxOVYv5y.pvndBRvF/hi.lIYhUrDSpGGXa', '11111111111111', 'Fakultas Teknik', 'Teknik Komputer', NULL, NULL),
(2, 'mahasiswa2', 'mahasiswa2@guest.com', '$2y$10$UMMWj4ZxJu0cnMBqcJj/ieFXthe1NHzsBkO0l3HcNPdhEN3lBv/8G', '22222222222222', 'Fakultas Teknik', 'Teknik Komputer', NULL, NULL),
(3, 'Mahasiswa Vokasi', 'mahasiswavokasi@guest.com', '$2y$10$LWX8OQF0cndlwr6sRUXmpOhIDiMmllPLl0ZGO3HCwJXq5N0yFCiqa', '1234567890', 'Sekolah Vokasi', 'D-III-Teknologi Kimia', NULL, '2023-02-06 05:27:48'),
(4, 'Anggara Diebrata', 'anggarad@student.ce.undip.ac.id', '$2y$10$a12ck3aKDmqDso0LQZCnl.w7TPspLmDmHNJPqcEMbXawF97lz5qfK', '21120117140008', 'Fakultas Teknik', 'S1-Teknik Komputer', '1675687644.jpg', NULL),
(5, 'Petrick Jubel Eliezer', 'petrickje@guest.com', '$2y$10$CKKhLBdsIJcqN0Kt.Sjq9uo0lx8.DhOXdYbyi.a1fN9lpyJcns.KG', '21120117120028', 'Fakultas Teknik', 'S1-Teknik Komputer', '1675744819.jpg', NULL),
(6, 'Yudhi Kasih P', 'yudhik@guest.com', '$2y$10$GolAhQsf1UKrDO4oSV3tL.ThsT6l8uxK4PU/wLGGPWGyTJ81WaPFK', '21120117140000', 'Fakultas Teknik', 'S1-Teknik Komputer', '1675744858.jpg', NULL),
(7, 'Obed Jeck Gredo T', 'obedjg@guest.com', '$2y$10$3C5p5BwJwgAy40HBhp2x1.3hIJzizzUk9POZNzktoEDpzV2J4Asv.', '21120117120026', 'Fakultas Teknik', 'S1-Teknik Komputer', NULL, NULL),
(8, 'Erika Clara Simanjuntak', 'erikacs@guest.com', '$2y$10$fjs2J1up/Sv7w7TOaNjkVuGxmn.RkfXAZcv3OXUUV5J..zF1OI572', '21120117130063', 'Fakultas Teknik', 'S1-Teknik Komputer', NULL, NULL),
(9, 'Jeremia Joseph P', 'jeremiajp@guest.com', '$2y$10$kObu1OOyIBYM2Ni9XqDAd.rJ/Iv2KTcE9WQxGCZnZZnWX2QFvoX9a', '21120117140031', 'Fakultas Teknik', 'S1-Teknik Komputer', NULL, '2023-02-07 00:23:34'),
(10, 'Wahyu Aji Sulaiman', 'wahyuaji@guest.com', '$2y$10$85e7q/pjsktjUe3s5cgpPuGBD5bRdH2WnM4ONh.AQCAur2tEt871C', '21120117140015', 'Fakultas Teknik', 'S1-Teknik Komputer', '1675751281.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2022_04_06_055349_create_admin_table', 1),
(3, '2022_04_06_055356_create_mahasiswa_table', 1),
(4, '2022_04_17_102717_create_prestasis_table', 1),
(5, '2022_04_30_143509_create_projects_table', 1),
(6, '2022_09_25_055227_create_jurnals_table', 1),
(7, '2022_09_28_073027_create_kegiatans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prestasis`
--

CREATE TABLE `prestasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prestasis`
--

INSERT INTO `prestasis` (`id`, `mahasiswa_id`, `judul`, `penyelenggara`, `periode`, `image`, `status`, `deleted_at`) VALUES
(1, 4, 'Bronze Medal Award Taiwan Innotech Expo Invention Contest', 'Taiwan Innotech Expo', '2019-09-28', '1675687233.jpg', 'Menunggu Verifikasi', NULL),
(2, 5, 'Bronze Medal Taiwan Innotech Expo', 'Taiwan Innotech Expo', '2019-09-28', '1675741478.jpg', 'Telah diverifikasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `mahasiswa_id`, `judul`, `deskripsi`, `image`, `status`, `deleted_at`) VALUES
(1, 4, 'Bangunanku', 'An app to detect damaged building and road, also sending the report to the server. I was assigned to make the Android Application, which uses location services, session for the user, GET and POST data from/to the server, and camera service.', '1675687280.jpg', 'Menunggu Verifikasi', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_email_unique` (`email`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `prestasis`
--
ALTER TABLE `prestasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prestasis`
--
ALTER TABLE `prestasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
