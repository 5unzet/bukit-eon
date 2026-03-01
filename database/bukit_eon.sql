-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Mar 2026 pada 15.52
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
-- Database: `bukit_eon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_wisata`
--

CREATE TABLE `informasi_wisata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jamBuka` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlahKunjungan` int(11) NOT NULL,
  `jumlahTiket` int(11) NOT NULL,
  `jumlahMakanan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `tanggal`, `jumlahKunjungan`, `jumlahTiket`, `jumlahMakanan`, `created_at`, `updated_at`) VALUES
(1, '1992-08-01', 63, 131, 89, '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(2, '1993-04-04', 133, 133, 37, '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(3, '2019-08-16', 139, 95, 25, '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(4, '2002-08-29', 158, 77, 60, '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(5, '1997-11-19', 126, 35, 54, '2026-03-01 07:42:16', '2026-03-01 07:42:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`id`, `nama`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Mie Rebus', 23282, 14, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(2, 'Nasi Goreng', 20933, 24, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(3, 'Mie Rebus', 27832, 89, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(4, 'Jagung Bakar', 23137, 43, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(5, 'Nasi Goreng', 14219, 25, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(6, 'Nasi Goreng', 18449, 42, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(7, 'Nasi Goreng', 18410, 86, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(8, 'Mie Rebus', 26186, 22, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(9, 'Jagung Bakar', 17280, 64, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(10, 'Nasi Goreng', 19366, 30, '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(11, 'Nasi Goreng', 19651, 49, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(12, 'Nasi Goreng', 25581, 77, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(13, 'Jagung Bakar', 25045, 100, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(14, 'Nasi Goreng', 21406, 73, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(15, 'Mie Rebus', 26079, 26, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(16, 'Mie Rebus', 16557, 21, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(17, 'Jagung Bakar', 14443, 12, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(18, 'Jagung Bakar', 29570, 58, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(19, 'Jagung Bakar', 21657, 93, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(20, 'Mie Rebus', 26580, 71, '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(21, 'Mie Rebus', 18947, 11, '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(22, 'Jagung Bakar', 11179, 16, '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(23, 'Nasi Goreng', 22150, 89, '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(24, 'Jagung Bakar', 29798, 53, '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(25, 'Jagung Bakar', 27451, 80, '2026-03-01 07:42:15', '2026-03-01 07:42:15');

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
(1, '2026_03_01_134744_create_penggunas_table', 1),
(2, '2026_03_01_134806_create_informasi_wisatas_table', 1),
(3, '2026_03_01_134806_create_laporans_table', 1),
(4, '2026_03_01_134828_create_makanans_table', 1),
(5, '2026_03_01_135031_create_tikets_table', 1),
(6, '2026_03_01_135039_create_pesanan_makanans_table', 1),
(7, '2026_03_01_135041_create_pembayarans_table', 1),
(8, '2026_03_01_135042_create_riwayat_pembelians_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tiket_id` bigint(20) UNSIGNED NOT NULL,
  `metode` varchar(255) NOT NULL,
  `status` enum('sukses','gagal') NOT NULL,
  `tanggalBayar` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tiket_id`, `metode`, `status`, `tanggalBayar`, `created_at`, `updated_at`) VALUES
(1, 21, 'Tunai', 'sukses', '2026-03-01 14:42:15', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(2, 22, 'E-Wallet', 'gagal', '2026-03-01 14:42:15', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(3, 23, 'Tunai', 'gagal', '2026-03-01 14:42:15', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(4, 24, 'E-Wallet', 'sukses', '2026-03-01 14:42:15', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(5, 25, 'E-Wallet', 'sukses', '2026-03-01 14:42:16', '2026-03-01 07:42:16', '2026-03-01 07:42:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pengunjung') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Terrance Gusikowski DVM', 'agustina.mueller@example.net', '$2y$12$Me3QoPSArU6WksT7WOBbQev5x46VVl6lCK8wwbqIvGjygVBrzp9ri', 'admin', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(2, 'Kenya Lakin', 'farrell.natasha@example.net', '$2y$12$OQEdoH.MDqOd0ao373jh9.qxZ.vMcdfq6.XAi25qycwn98gdQJFx2', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(3, 'Harold Mayer', 'fjaskolski@example.net', '$2y$12$egdc5B4xdL1f0DkHJd9qTun9GTlIFtWqWZsvpE8W6gg86AYr2D3Ae', 'admin', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(4, 'Miss Vicky Hane', 'chanel.breitenberg@example.org', '$2y$12$dDVOsc4fRajTQ6tVUT0QJenOeDpdjWpnDEvdqheN6PZHYaGUsKRM.', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(5, 'Miss Ursula Gibson Jr.', 'emily.spencer@example.net', '$2y$12$MicK1E23jDnuRisn3SsP2eAgE2er.BVYvATIffpfiqtlTbP2tYNe6', 'admin', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(6, 'Candelario Blick', 'ghansen@example.org', '$2y$12$3iHhb1.Rb2MXdK4jGrQel.QQWr.XfQ9Fk7LFUYloAvH4ODl9Twcgu', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(7, 'Miss Anna Collier', 'qshields@example.com', '$2y$12$BXGtG80i3KXXOObokzlWGOCWjSEhE2JBmGuZDjP1wNCClDjsBeE6.', 'admin', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(8, 'Vivian Morar', 'hillard.keeling@example.com', '$2y$12$L/HtlmFc.Qp5tjFEy1.e2uVXXqeqVH1h2uL5xQUNnqXrjjDpZnjea', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(9, 'Cruz Gerhold V', 'connie31@example.org', '$2y$12$yu6xygZDyFt/LNjEbPFRvuwQeFqj6Ndjpbi.I7g7a/vQ5bZzoBklC', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(10, 'Milan Botsford', 'irempel@example.org', '$2y$12$pkNnRLz755t6TBGBQdJinek8NHtFBy.U5uhRmtOoZlwTbqTIhZQEG', 'pengunjung', '2026-03-01 07:12:26', '2026-03-01 07:12:26'),
(11, 'Herminia Kessler', 'wilber.reynolds@example.org', '$2y$12$WmaNqXvn21c1tbiXzOsf..ImqPylrVNz6DmLJdzqpy3fWruIWixDe', 'pengunjung', '2026-03-01 07:27:09', '2026-03-01 07:27:09'),
(12, 'Mrs. Tina Pagac Sr.', 'lilian09@example.com', '$2y$12$7BOoYZes566MgCQS/IniO.b1Mi2dFuvoFiD5rIZ9CBHFA1tNcfZ.2', 'admin', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(13, 'Antonia Herman IV', 'trenner@example.net', '$2y$12$zsCuhkwSvVqEkGWf71Z3leDqrrAAOfvOQH6tmwk/Mc55/ssZ4T/5m', 'pengunjung', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(14, 'Dean Lubowitz', 'joe.lindgren@example.com', '$2y$12$stHE1XPuOOzFCNWVbS0MbukaWATasnYT2yb4VmVOyjLs09I4miYHq', 'pengunjung', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(15, 'Mckenna Oberbrunner', 'luella83@example.org', '$2y$12$LJsHICS8dXwCcLwhEWsbE.s1sBiKKKO8lJ6senNzQoLO98/j9X39i', 'admin', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(16, 'Mr. Glennie Lemke', 'merritt93@example.net', '$2y$12$/oM.7kODFgYMjfyivw9mnON/5JPi8limd3UUM7XLzB7LewOQZHEJm', 'admin', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(17, 'Taya Bernier', 'hrau@example.net', '$2y$12$USX1eJzSurmZYM0SoPxbMei4eP5c5BwUkpUnKux2TzRPGUBJAeyjy', 'admin', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(18, 'Leonor Zulauf MD', 'block.bryon@example.org', '$2y$12$VS3.zbnxpuIqVQe0DpYqheCPAR2cPSP4pIc2WKtRM67sKK2HtNYiu', 'pengunjung', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(19, 'Kaylah Wyman', 'wyman.chanel@example.com', '$2y$12$R4ryQV5sGcZQLEjk6qPw3uGy1aO8g7DBlYP58tRI06.k3K6anB5Qq', 'admin', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(20, 'Elian Doyle', 'heathcote.pascale@example.com', '$2y$12$Ryl1jxjVHR.4b8DEKwp76.naD3C9V1q2Dfpul8izXOaY9bJIluPUO', 'pengunjung', '2026-03-01 07:27:10', '2026-03-01 07:27:10'),
(21, 'Esmeralda Cole', 'bella62@example.com', '$2y$12$pS8FGqX1igDmDesPVfcbRu4kzp5DdNi2v1upl7uUFmsF9VxYKM3qi', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(22, 'Lauretta Bernier', 'ptrantow@example.net', '$2y$12$htE5dCqyVMhBMLzYOz5pHeb3XFwD5tpfmvzYxNK7vJzFuI.XLd0fi', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(23, 'Daryl Witting', 'cristopher85@example.org', '$2y$12$X5xH2Gyce9eBQdhyMF2II.A2VMAOtcEYLHl9pcXrlySliVYmuBtYS', 'admin', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(24, 'Grace Champlin', 'richmond.harber@example.org', '$2y$12$.enh0nkpfqPDcik6Mcv34esa5D5OyfWC0VhZdwu1ZEhCUsyQ1IhKC', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(25, 'Vito Barrows', 'federico26@example.com', '$2y$12$COU/YeqMbIyduBPTysfBHux7vhI93y/oJqUwk.GVT2lIkXdv4aOKy', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(26, 'Willard Pfeffer', 'juwan.murazik@example.org', '$2y$12$zgZSlRrgFWnWDFICyHT57urTR.ysNdlDZa/5JwWhxxF4wNLyfQgMC', 'admin', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(27, 'Prof. Barrett Murazik', 'ykiehn@example.com', '$2y$12$nY7OtgwkIbwiAVjwhWu61eb9tMr6dQ32EpLbkuGm.6N8PHH17B3CS', 'admin', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(28, 'Krystal Huels', 'marlen.goodwin@example.org', '$2y$12$c0LW/E.VoYY/Lte/t.09wOskFOh89RHclEDklpMvmXgF9DPFaX7se', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(29, 'Breanna Will', 'diana90@example.com', '$2y$12$zpQ1ANWqrcp6mEvNQMeGJuonFL/gq32KSTIL93TdSQ7261HHBFd0y', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(30, 'Prof. Dereck Balistreri Sr.', 'labadie.maegan@example.com', '$2y$12$OoKpPp3oSypssyt0ZgBSxOj21368nrHT32KpC82yjBMN0BZZNbDQu', 'admin', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(31, 'Dr. George Bosco', 'hulda.altenwerth@example.net', '$2y$12$RiIf7B0dByk4/aNy8HtDz.4z1qKf9f44WpQDGgmO4guqyOS6pcVFy', 'pengunjung', '2026-03-01 07:31:48', '2026-03-01 07:31:48'),
(32, 'Trudie Jakubowski', 'macey.shields@example.com', '$2y$12$L4TcDhEsnQhdgwFWkxrdr.b8.KMgrFtTUUmH/6GQrHgcpg3jiUz7e', 'pengunjung', '2026-03-01 07:31:49', '2026-03-01 07:31:49'),
(33, 'Miss Destiny Mayer DDS', 'caroline.bailey@example.net', '$2y$12$NdkkuAZh3o8FTRXmvvaBqO4GKu1Cduh9BvZCBP5HsC2fkWfPO1Dui', 'pengunjung', '2026-03-01 07:31:49', '2026-03-01 07:31:49'),
(34, 'Anibal Bartoletti', 'kris.geoffrey@example.org', '$2y$12$ONC9XN0h2zgjHvcuBJWw1O.EKRkm5TwAls/7HyyqGQ5NOEpKiwRdW', 'admin', '2026-03-01 07:31:49', '2026-03-01 07:31:49'),
(35, 'Rosetta Mayert', 'rhiannon.becker@example.com', '$2y$12$Y0uFv4oCNJkbkOf9Tm8KheeIKtnJIK2i9WbYm8Avx7k2TCcLc4R1m', 'admin', '2026-03-01 07:31:49', '2026-03-01 07:31:49'),
(36, 'Dr. Esta Collier DDS', 'fveum@example.net', '$2y$12$awNWB60H3jSXRDxNEJK2S.nN8AnYZC7gXdlgUUbzosUGgwwyf6S9S', 'admin', '2026-03-01 07:31:49', '2026-03-01 07:31:49'),
(37, 'Josefina Olson', 'schaden.retta@example.com', '$2y$12$/ltE2hv8gl9xc4q1zyjfJ.7gJLcdzrvQ76oSGlbrOccccuHgLtRpe', 'pengunjung', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(38, 'Lou Collins', 'uturner@example.org', '$2y$12$/ol5/kElvEd.4ZLxWZBXpOSiBLBmlHBfRU1AnjBqLzqolmfcySrEa', 'admin', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(39, 'Taryn Stanton', 'ubarrows@example.net', '$2y$12$fbW5fL3MaBMUbUmOHaaAWOKJCOZQFu9dk./h.iIgGu4hk33sWSSOO', 'admin', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(40, 'Cecile Dibbert', 'hbaumbach@example.net', '$2y$12$KcuX7c3KrY7ruEknqz4bM.QoFAl2a/bUPRbajfp29Pf/gbkB9F2HC', 'pengunjung', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(41, 'Antonio Langosh', 'gislason.effie@example.net', '$2y$12$bXHFkiZtVVaPWq4Z/EV9XeV9LYSsLsXqFMpPiPrHQq8sDWJm0F5LK', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(42, 'Emelia Weissnat', 'frederik.quitzon@example.net', '$2y$12$xNLQaJNky1Pi2IQaSKsUduP6h8Fc0L0RBkgh/sPcZYpknBXZgPJJa', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(43, 'Prof. Hilton Senger PhD', 'mckenna.schimmel@example.org', '$2y$12$DJmXR3CfHmVr6lFIsqapeeRuQtP2FB2cM0MvGgEB33om75Z2RG9qm', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(44, 'Prof. Floy Little MD', 'clittle@example.org', '$2y$12$t2n98fAYNyI0EsOmnpwIdODyOzCVgGVCrAcCYLmHnMuBy..gRWaX6', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(45, 'Shanny Bernier DDS', 'raynor.althea@example.net', '$2y$12$5I4g0aOOmOkn0O/upRtZg.r4lklGac/3rZ3dMbD7O/ZWP1pByIhky', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(46, 'Ulises Steuber', 'thill@example.net', '$2y$12$L5qt6ZKR5lF.m56H8/o2x.9tsnotcXgcUT0pe07iI0tQJcJIcvquC', 'admin', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(47, 'Leta Predovic', 'lhomenick@example.net', '$2y$12$O8SQ9D54GKYRFRa37zIw1eF8E6oJxUhJqEPLWnz66kDKQSawogx8C', 'admin', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(48, 'Mr. Hunter Olson', 'joshua82@example.com', '$2y$12$IyBq7M6E6trFXF2HOU.PteiqxgMUaIQxejSZYbAGWBXdPaBhnoa5e', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(49, 'Verona Cremin', 'alfredo.corwin@example.net', '$2y$12$Ffr8m8EBNPqG7Tujs/MaZOQLde2nFavqLXJNhJGUt9AT2kUl2FPem', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(50, 'Jacinthe Quigley', 'aurelio74@example.org', '$2y$12$tdF6/hhWNlmhBx1kZCmy2O0lZ6lkoDZJk3MWs3x4VXl70uo9c2dAi', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(51, 'Mrs. Iva Jenkins II', 'ibrahim.hane@example.com', '$2y$12$95.Hj7r4FSeLjI6wFVYNbekSxT8blvaydhBpFy.ltJjfrb/dGybP2', 'pengunjung', '2026-03-01 07:42:11', '2026-03-01 07:42:11'),
(52, 'Stanley Carter', 'lehner.charles@example.net', '$2y$12$zMApFo8ya3R5n1kkWn29HOaSwEtkTUROMmUjN89hdEc9qWC5e4..C', 'pengunjung', '2026-03-01 07:42:12', '2026-03-01 07:42:12'),
(53, 'Brionna Hettinger', 'okon.wendy@example.com', '$2y$12$.PQohTZkRNQbt8vUfhC1IOcII4zFJSOG5Cu0etkfw6Bu3ZLBqUE2i', 'admin', '2026-03-01 07:42:12', '2026-03-01 07:42:12'),
(54, 'Sibyl Balistreri DDS', 'stark.cali@example.org', '$2y$12$jMvP/11aVMEKswJNiDz/E.x6znNg4eNtRVILupuYamPiOT3S1BdyK', 'pengunjung', '2026-03-01 07:42:12', '2026-03-01 07:42:12'),
(55, 'Ms. Erica Doyle Sr.', 'rwiegand@example.org', '$2y$12$pqLx2LuSDf2OM//8SrCErufR//OG/8lzjajdSNMHQcqoOmg/1XtHK', 'admin', '2026-03-01 07:42:12', '2026-03-01 07:42:12'),
(56, 'Jacinto Kling', 'retta.kunze@example.net', '$2y$12$7rYDZCBSHGAhN/VgJPToWOImzrRXiSkfK5rDWaQW4k/OimKA773Bu', 'admin', '2026-03-01 07:42:13', '2026-03-01 07:42:13'),
(57, 'Mr. Clay Shields DVM', 'cleora08@example.com', '$2y$12$qYYYifWacQyN.ZCLyF8OW.jsMkVutyXU41n7yhVk/04fdE39DrnnC', 'pengunjung', '2026-03-01 07:42:13', '2026-03-01 07:42:13'),
(58, 'Kamron Schmitt', 'jonathan20@example.net', '$2y$12$4t08/U.h14iRC0YBTrrVGefTK.zm/DBcY2mnzfRCJ2JVAVj/4NJwO', 'pengunjung', '2026-03-01 07:42:13', '2026-03-01 07:42:13'),
(59, 'Lempi Nicolas', 'dnicolas@example.net', '$2y$12$nWBMfCKbsuGEyX1G.fLq3.wOjmgOuzaZTDG2cuauRGn.u0JAYpwrq', 'pengunjung', '2026-03-01 07:42:13', '2026-03-01 07:42:13'),
(60, 'Pansy Boehm', 'xpouros@example.com', '$2y$12$vTBTks1xZ00XppEVoAu3lOH9tbgfdccCYSWfaI/NJpLsX1AT0RN8y', 'pengunjung', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(61, 'Armani Waters', 'bell.padberg@example.org', '$2y$12$PNvQFOj1tG7cFIzuuAGsDO/tuQEHqtnIMjFfs.2VvaqnX/3yduomW', 'admin', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(62, 'Mara Schuppe Jr.', 'king.francisco@example.com', '$2y$12$CY950/Cvt6Kv9Z2VaZP5FuGTOXmimvY47mLcUjk3.0LqvPQycjfGC', 'pengunjung', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(63, 'Euna Hane', 'fhand@example.com', '$2y$12$32cgUJe9fvYBFgn4Aqz5i.YWxewa4UlBZ.11pyqykcYISuCJYgCnm', 'admin', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(64, 'Jennie Schmitt DDS', 'hayes.dessie@example.com', '$2y$12$GQuGSc6d5ywChOHby2F9eOSdqgxkjjG4puHQj6RDDSIHg9QvtMMJO', 'pengunjung', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(65, 'Ms. Marisol O\'Hara', 'fklocko@example.net', '$2y$12$hdHECYMYchs0rU5tHUlvdeDkoYwMLlG6adnAx4ldL.kz728bbF8sO', 'admin', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(66, 'Mrs. Jackeline Koss', 'hschmidt@example.com', '$2y$12$RGBGr8W6niKo8Y12bvJPPOOpd0zI.rbLhZTas7BP/ahnk2djTqpIG', 'admin', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(67, 'Filiberto Macejkovic', 'kub.preston@example.org', '$2y$12$xpyUhWRn7MKxRBp3IvNPIOoZPzj0BLz2A.OhNkQoVxVCA4YN33DWG', 'pengunjung', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(68, 'Dr. Joel Conroy PhD', 'balistreri.dillan@example.net', '$2y$12$Ac4fkvyovLfRYIShfCuLyehM7PzYE6JkpKs0UWB1yY0zacTM8sx5K', 'pengunjung', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(69, 'Dr. Maximillian Parisian', 'gpagac@example.net', '$2y$12$LIq20vuK9GWiDbmJX33aEOdRhXydmqK7fYYgvhrsu0ZVNBbKQDDoa', 'admin', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(70, 'Holden Parker', 'irma.stracke@example.net', '$2y$12$DFshfBCx6RK33GlnXwxTiO6LD52VM5pK1CyTNnXQtZ8d32osvEC7.', 'pengunjung', '2026-03-01 07:42:16', '2026-03-01 07:42:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_makanan`
--

CREATE TABLE `pesanan_makanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `makanan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan_makanan`
--

INSERT INTO `pesanan_makanan` (`id`, `pengguna_id`, `makanan_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 61, 21, 4, '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(2, 62, 22, 3, '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(3, 63, 23, 5, '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(4, 64, 24, 3, '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(5, 65, 25, 3, '2026-03-01 07:42:15', '2026-03-01 07:42:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pembelian`
--

CREATE TABLE `riwayat_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `tiket_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `kodeTiket` varchar(255) NOT NULL,
  `tanggalKunjungan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `totalHarga` double NOT NULL,
  `status` enum('pending','dibayar','dikirim') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id`, `pengguna_id`, `kodeTiket`, `tanggalKunjungan`, `jumlah`, `totalHarga`, `status`, `created_at`, `updated_at`) VALUES
(1, 31, 'TKT-uw317', '2026-03-10', 2, 55542, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(2, 32, 'TKT-rg133', '2026-03-05', 4, 35206, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(3, 33, 'TKT-to477', '2026-03-28', 1, 56470, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(4, 34, 'TKT-ex993', '2026-03-12', 1, 95700, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(5, 35, 'TKT-eu395', '2026-03-03', 1, 50719, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(6, 36, 'TKT-gq052', '2026-03-18', 1, 31247, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(7, 37, 'TKT-ms122', '2026-03-29', 2, 25785, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(8, 38, 'TKT-kr262', '2026-03-05', 3, 97675, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(9, 39, 'TKT-ai306', '2026-03-04', 1, 20294, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(10, 40, 'TKT-fq085', '2026-03-18', 5, 70956, 'pending', '2026-03-01 07:31:50', '2026-03-01 07:31:50'),
(11, 51, 'TKT-EZ038', '2026-03-28', 3, 81196, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(12, 52, 'TKT-JS081', '2026-03-08', 2, 75268, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(13, 53, 'TKT-OI700', '2026-03-20', 1, 128156, 'pending', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(14, 54, 'TKT-NQ207', '2026-03-19', 2, 90207, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(15, 55, 'TKT-ZT228', '2026-03-13', 2, 108878, 'dibayar', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(16, 56, 'TKT-GC410', '2026-03-14', 2, 116493, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(17, 57, 'TKT-XH132', '2026-03-15', 5, 113892, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(18, 58, 'TKT-HR729', '2026-03-06', 5, 150372, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(19, 59, 'TKT-XQ742', '2026-03-24', 3, 88634, 'dikirim', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(20, 60, 'TKT-BT857', '2026-03-21', 1, 59555, 'dibayar', '2026-03-01 07:42:14', '2026-03-01 07:42:14'),
(21, 66, 'TKT-UH401', '2026-03-16', 3, 137693, 'dibayar', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(22, 67, 'TKT-UQ776', '2026-03-19', 2, 52395, 'dibayar', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(23, 68, 'TKT-XS833', '2026-03-23', 1, 100204, 'pending', '2026-03-01 07:42:15', '2026-03-01 07:42:15'),
(24, 69, 'TKT-CD752', '2026-03-31', 1, 118184, 'dikirim', '2026-03-01 07:42:16', '2026-03-01 07:42:16'),
(25, 70, 'TKT-XP347', '2026-03-17', 1, 81312, 'dibayar', '2026-03-01 07:42:16', '2026-03-01 07:42:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `informasi_wisata`
--
ALTER TABLE `informasi_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_tiket_id_foreign` (`tiket_id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indeks untuk tabel `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_makanan_pengguna_id_foreign` (`pengguna_id`),
  ADD KEY `pesanan_makanan_makanan_id_foreign` (`makanan_id`);

--
-- Indeks untuk tabel `riwayat_pembelian`
--
ALTER TABLE `riwayat_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_pembelian_pengguna_id_foreign` (`pengguna_id`),
  ADD KEY `riwayat_pembelian_tiket_id_foreign` (`tiket_id`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tiket_pengguna_id_foreign` (`pengguna_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `informasi_wisata`
--
ALTER TABLE `informasi_wisata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pembelian`
--
ALTER TABLE `riwayat_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_tiket_id_foreign` FOREIGN KEY (`tiket_id`) REFERENCES `tiket` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  ADD CONSTRAINT `pesanan_makanan_makanan_id_foreign` FOREIGN KEY (`makanan_id`) REFERENCES `makanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_makanan_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pembelian`
--
ALTER TABLE `riwayat_pembelian`
  ADD CONSTRAINT `riwayat_pembelian_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_pembelian_tiket_id_foreign` FOREIGN KEY (`tiket_id`) REFERENCES `tiket` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
