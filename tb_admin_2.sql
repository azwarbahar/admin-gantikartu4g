-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2022 pada 11.11
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ganti_kartu_tsel_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin_2`
--

CREATE TABLE `tb_admin_2` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `cluster` varchar(255) DEFAULT NULL,
  `tap` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin_2`
--

INSERT INTO `tb_admin_2` (`id`, `username`, `password`, `role`, `cluster`, `tap`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSO_GOWA', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Super', 'GOWA', NULL, 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55'),
(2, 'SBP_GOWA', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Super', 'GOWA', NULL, 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55'),
(3, 'SBP_GOWA_GOWA', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Admin', 'GOWA', 'TAP GOWA', 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55'),
(4, 'SBP_GOWA_MALINO', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Admin', 'GOWA', 'TAP MALINO', 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55'),
(5, 'SBP_GOWA_TAKALAR', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Admin', 'GOWA', 'TAP TAKALAR', 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55'),
(6, 'SBP_GOWA_JENEPONTO', '$2y$10$YU4YKY.UKaNLqPBp409Yk.UfNs6DdgN5CAczKzFNLHH6tRKrxiB0S', 'Admin', 'GOWA', 'TAP JENEPONTO', 'Active', '2022-10-03 08:09:55', '2022-10-03 08:09:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin_2`
--
ALTER TABLE `tb_admin_2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin_2`
--
ALTER TABLE `tb_admin_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
