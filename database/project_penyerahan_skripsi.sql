-- Database: `project_penyerahan_skripsi`
-- Compatible with MySQL-Front, phpMyAdmin, and XAMPP MySQL

CREATE DATABASE IF NOT EXISTS `project_penyerahan_skripsi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `project_penyerahan_skripsi`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `submissions`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Petugas Admin', 'admin@admin.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NOW(), NOW()),
(2, 'Administrator System', 'admin@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `students`
-- --------------------------------------------------------

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status_lulus` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_nim_unique` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `students`
INSERT INTO `students` (`id`, `nim`, `nama`, `angkatan`, `no_tlp`, `email`, `status_lulus`, `created_at`, `updated_at`) VALUES
(1, '202001001', 'Ahmad Rizky Pratama', '2020', '081234567890', 'ahmad.rizky@student.ac.id', 'Lulus', NOW(), NOW()),
(2, '202001002', 'Siti Nurhaliza', '2020', '081298765432', 'siti.nurhaliza@student.ac.id', 'Lulus', NOW(), NOW()),
(3, '202101003', 'Budi Santoso', '2021', '085612345678', 'budi.santoso@student.ac.id', 'Belum Lulus', NOW(), NOW()),
(4, '202101004', 'Dewi Anita Lestari', '2021', '087711223344', 'dewi.lestari@student.ac.id', 'Belum Lulus', NOW(), NOW()),
(5, '202001005', 'Doni Prasetyo', '2020', '081355667788', 'doni.prasetyo@student.ac.id', 'Lulus', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `submissions`
-- --------------------------------------------------------

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `tanggal_penyerahan` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `petugas_penerima` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submissions_student_id_foreign` (`student_id`),
  CONSTRAINT `submissions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `submissions`
INSERT INTO `submissions` (`id`, `student_id`, `judul`, `tipe`, `tanggal_penyerahan`, `status`, `petugas_penerima`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sistem Informasi Geografis Pemetaan Fasilitas Umum', 'skripsi', '2026-07-15', 'Sudah Menyerahkan', 'Drs. Hendra M.T.', NOW(), NOW()),
(2, 2, 'Analisis Sentimen Media Sosial Menggunakan Machine Learning', 'ta', '2026-07-20', 'Sudah Menyerahkan', 'Siti Rahma S.Kom', NOW(), NOW()),
(3, 3, 'Aplikasi Manajemen Inventaris Berbasis Web pada PT Maju Jaya', 'kkp', '2026-08-01', 'Sudah Menyerahkan', 'Rian Hidayat S.T.', NOW(), NOW()),
(4, 4, 'Pengembangan API E-Commerce Menggunakan Framework Laravel', 'skripsi', NULL, 'Belum Menyerahkan', NULL, NOW(), NOW()),
(5, 5, 'Rancang Bangun Network Security Operations Center', 'ta', '2026-07-28', 'Sudah Menyerahkan', 'Drs. Hendra M.T.', NOW(), NOW());
