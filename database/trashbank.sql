-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2026 pada 12.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trashbank`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hadiah`
--

CREATE TABLE `hadiah` (
  `id_hadiah` int(11) NOT NULL,
  `nama_hadiah` varchar(50) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hadiah`
--

INSERT INTO `hadiah` (`id_hadiah`, `nama_hadiah`, `poin`) VALUES
(3, 'Paket data 10GB', 1000),
(5, 'Saldo GoPay 200.000', 2000),
(7, 'Pulsa 5000', 50),
(8, 'OVO 20.000', 200),
(9, 'Spotify Premium 3 hari', 400),
(10, 'Pulsa 10.000', 100),
(11, 'Voucher Belanja Shopee 5000', 500),
(12, 'E-Wallet 20.000', 200),
(33, 'Voucher Gojek', 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah`
--

CREATE TABLE `sampah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `berat` float DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `poin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sampah`
--

INSERT INTO `sampah` (`id`, `nama`, `email`, `alamat`, `kategori`, `berat`, `tanggal`, `lokasi`, `poin`) VALUES
(1, 'Keonho', 'titikkoma237@gmail.com', 'Padukuhan Banaran VIII, RT 38 RW 8, Banaran, Playen, Gunungkidul', 'Sampah Logam', 100, '2026-02-12', 'Bank Sampah A', 1000),
(2, 'Keonho', 'titikkoma237@gmail.com', 'Padukuhan Banaran VIII, RT 38 RW 8, Banaran, Playen, Gunungkidul', 'Sampah Kaca', 1000, '2026-02-12', 'Bank Sampah A', 10000),
(3, 'Keonho', 'titikkoma237@gmail.com', 'Padukuhan Banaran VIII, RT 38 RW 8, Banaran, Playen, Gunungkidul', 'Sampah Kaca', 1000, '2026-02-12', 'Bank Sampah A', 10000),
(4, 'Keonho', 'titikkoma237@gmail.com', 'Padukuhan Banaran VIII, RT 38 RW 8, Banaran, Playen, Gunungkidul', 'Sampah Logam', 100, '2026-02-12', 'Bank Sampah A', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukar`
--

CREATE TABLE `tukar` (
  `id_tukar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hadiah` int(11) NOT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tukar`
--

INSERT INTO `tukar` (`id_tukar`, `id_user`, `id_hadiah`, `datetime`) VALUES
(1, 1, 9, '2026-05-15 04:25:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `total`, `remember_token`) VALUES
(1, 'Keonho', 'titikkoma237@gmail.com', '$2y$10$4ReyM7lft84w1E5I/kBQb.J0dDJ12nchsWyePqGgATCqgP/G8eBmm', 20600, '93e748b718e77c163a525790c6914eab588ed7669311cb992cd9b663b5e4f1d6');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id_hadiah`);

--
-- Indeks untuk tabel `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tukar`
--
ALTER TABLE `tukar`
  ADD PRIMARY KEY (`id_tukar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_hadiah` (`id_hadiah`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tukar`
--
ALTER TABLE `tukar`
  MODIFY `id_tukar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tukar`
--
ALTER TABLE `tukar`
  ADD CONSTRAINT `tukar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `tukar_ibfk_2` FOREIGN KEY (`id_hadiah`) REFERENCES `hadiah` (`id_hadiah`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
