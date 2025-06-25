-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2025 pada 08.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopsarmi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `nama_kota` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alamats`
--

INSERT INTO `alamats` (`id`, `id_customer`, `nama`, `alamat`, `kota`, `nama_kota`, `created_at`, `updated_at`) VALUES
(9, 2, 'Kantor', 'JL. Juanda NO.291 Bandung', '23', 'Bandung', '2025-05-12 17:56:44', '2025-05-12 18:12:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_seller@example.com|127.0.0.1', 'i:1;', 1747446496),
('laravel_cache_seller@example.com|127.0.0.1:timer', 'i:1747446496;', 1747446496);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(2, 'Fashion', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(3, 'Makanan', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(4, 'Otomotif', '2025-05-10 12:08:35', '2025-05-10 12:08:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_06_162211_kategori', 1),
(5, '2025_05_06_162117_produk', 1),
(6, '2025_05_06_162148_rating', 1),
(7, '2025_05_06_162153_alamat', 1),
(8, '2025_05_06_162157_pesanan', 1),
(9, '2025_05_06_162206_withdraw', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `id_seller` bigint(20) UNSIGNED NOT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `review` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','proses','dikirim','selesai') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanans`
--

INSERT INTO `pesanans` (`id`, `id_customer`, `id_seller`, `nama_kurir`, `total_harga`, `review`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 'J&T', 20000.00, 1, 'selesai', '2025-05-10 12:08:35', '2025-05-13 12:26:24'),
(5, 2, 6, 'J&T', 102000.00, 1, 'selesai', '2025-05-10 12:08:35', '2025-05-13 12:46:17'),
(7, 2, 6, 'JNE', 220000.00, 1, 'selesai', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(8, 2, 6, 'SiCepat', 400000.00, 1, 'selesai', '2025-05-10 12:08:35', '2025-05-13 12:35:03'),
(21, 2, 5, 'CTC', 208000.00, 1, 'selesai', '2025-05-13 08:30:18', '2025-05-13 09:42:38'),
(22, 2, 5, 'CTCYES', 187000.00, 1, 'selesai', '2025-05-13 11:38:30', '2025-05-13 11:40:53'),
(23, 2, 5, 'CTC', 908000.00, 0, 'proses', '2025-05-13 11:57:21', '2025-05-17 14:06:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_produk`
--

CREATE TABLE `pesanan_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan_produk`
--

INSERT INTO `pesanan_produk` (`id`, `pesanan_id`, `produk_id`, `quantity`, `harga`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 4, 200000.00, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(4, 7, 3, 2, 10000.00, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(10, 5, 6, 3, 100000.00, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(15, 8, 6, 3, 100000.00, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(32, 21, 1, 1, 200000.00, NULL, NULL),
(33, 22, 17, 1, 150000.00, NULL, NULL),
(34, 22, 6, 1, 25000.00, NULL, NULL),
(35, 23, 1, 2, 200000.00, NULL, NULL),
(36, 23, 3, 1, 500000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_seller` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL,
  `imagePath` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `jumlah_customer_rating` int(11) NOT NULL DEFAULT 0,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `id_seller`, `id_kategori`, `nama`, `deskripsi`, `harga`, `imagePath`, `jumlah_customer_rating`, `total_rating`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Baju Wanita', 'Baju Wanita Terbaru', 200000, '[\"products/product_20.jpg\", \"products/product_21.jpeg\"]', 3, 13, '2025-05-10 12:08:35', '2025-05-13 12:26:42'),
(3, 5, 2, 'Baju Casual', 'Id laborum sit quaerat officia maiores.', 500000, '[\"products/product_21.jpeg\"]', 4, 7, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(6, 5, 2, 'Kerajinan Sarmi', 'Kerajinan tangan sarmi papua', 25000, '[\"products/product_22.jpg\"]', 3, 12, '2025-05-10 12:08:35', '2025-05-13 12:46:17'),
(17, 5, 1, 'Tas Kerajinan Sarmi', 'Tas Kerajinan sarmi murah', 150000, '[\"products/product_23.jpg\"]', 1, 5, '2025-05-11 16:02:34', '2025-05-13 11:49:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `id_produk`, `id_customer`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, NULL, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(2, 3, 2, 5, NULL, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(6, 6, 2, 2, 'Id distinctio accusamus aut repellendus quia omnis rerum.', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(7, 3, 4, 5, 'Consequatur modi aut repellat quia doloribus.', '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(13, 3, 2, 1, NULL, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(15, 3, 2, 5, NULL, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(16, 1, 3, 3, 'okeee', '2025-05-13 11:04:36', '2025-05-13 11:04:36'),
(17, 17, 2, 5, 'tes', '2025-05-13 11:49:22', '2025-05-13 11:49:22'),
(18, 6, 2, 5, 'tes', '2025-05-13 11:49:22', '2025-05-13 11:49:22'),
(19, 1, 2, 5, 'dfdf', '2025-05-13 12:26:42', '2025-05-13 12:26:42'),
(20, 6, 2, 5, 'hghgh', '2025-05-13 12:46:17', '2025-05-13 12:46:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1KliudkrLJOR0952iahDnquOnaSMZVqdp7907v8t', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWREaUVsMHpxYUh4NnNuY2lLOGRqRnd1WWttQnhVdmVZM0ZZbkYzZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC93aXRoZHJhdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747541813);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `saldo` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer','seller') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nama`, `no_telp`, `saldo`, `image`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@example.com', '$2y$12$b983pxqtB06md7iPD1DnIusV0ZbURIf3mwtBqYVhC5VSa8J9EC4t2', 'Admin User', '6750198632', 43.435789473684, NULL, 'admin', '2025-05-10 12:08:33', '2025-05-18 03:36:47'),
(2, 'customer1@example.com', '$2y$12$ICKTED22V2lqzfqwanxp8O2Q9aVwXlKorxKpdDJbt31RbXiFNsEce', 'Kristian Hermann', '9986388453', NULL, NULL, 'customer', '2025-05-10 12:08:34', '2025-05-10 12:08:34'),
(3, 'customer2@example.com', '$2y$12$h8KwwzAcVHNnaQtVU311y.3oHa.RawGLq9ztUSkxivrFWKuyAkuy2', 'Kane Schiller', '5541989281', NULL, NULL, 'customer', '2025-05-10 12:08:34', '2025-05-10 12:08:34'),
(4, 'customer3@example.com', '$2y$12$Ear.Rd5cXbYfaRo449LyR.l.5zqT/J4ds0HMJqkLCi0wm.Nykben6', 'Bernhard Nikolaus', '2206790785', NULL, NULL, 'customer', '2025-05-10 12:08:34', '2025-05-10 12:08:34'),
(5, 'seller1@example.com', '$2y$12$j0pRKLXQCxPWDNNicX3UdOtmqrRUPpDWDWIw61rkwuA4Q0wmlFLlm', 'Louisa Windler', '453159556', 825.28, NULL, 'seller', '2025-05-10 12:08:35', '2025-05-18 03:36:47'),
(6, 'seller2@example.com', '$2y$12$gMfqEjAayhwPwgq99tiM/.F.K.StmrbJtE.eGrl2/0dFjFwZG4Quu', 'Shayna Ferry DVM', '7688404281', 662.08, NULL, 'seller', '2025-05-10 12:08:35', '2025-05-10 12:08:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_seller` bigint(20) UNSIGNED NOT NULL,
  `total_saldo` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `withdraws`
--

INSERT INTO `withdraws` (`id`, `id_seller`, `total_saldo`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 381.58, 1, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(2, 6, 491.06, 0, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(3, 5, 64.12, 0, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(4, 6, 354.5, 1, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(5, 6, 163.19, 1, '2025-05-10 12:08:35', '2025-05-10 12:08:35'),
(6, 5, 825.28, 1, '2025-05-17 14:28:56', '2025-05-18 03:36:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_id_customer_foreign` (`id_customer`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanans_id_customer_foreign` (`id_customer`),
  ADD KEY `pesanans_id_seller_foreign` (`id_seller`);

--
-- Indeks untuk tabel `pesanan_produk`
--
ALTER TABLE `pesanan_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_produk_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `pesanan_produk_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_id_seller_foreign` (`id_seller`),
  ADD KEY `produks_id_kategori_foreign` (`id_kategori`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_id_produk_foreign` (`id_produk`),
  ADD KEY `ratings_id_customer_foreign` (`id_customer`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_id_seller_foreign` (`id_seller`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pesanan_produk`
--
ALTER TABLE `pesanan_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanans_id_seller_foreign` FOREIGN KEY (`id_seller`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_produk`
--
ALTER TABLE `pesanan_produk`
  ADD CONSTRAINT `pesanan_produk_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_id_seller_foreign` FOREIGN KEY (`id_seller`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_id_seller_foreign` FOREIGN KEY (`id_seller`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
