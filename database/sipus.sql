-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 06.14
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_anggota` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rfid` varchar(100) DEFAULT NULL,
  `no_hp` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jekel` enum('LK','PR') NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `level` enum('Admin','Petugas','NSiswa','Siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_anggota`, `email`, `password`, `rfid`, `no_hp`, `nama`, `jekel`, `kelas`, `level`) VALUES
('A001', 'farhan@admin.com', '$2y$11$dX9w1tZsMGmAK277roMpg.MlMA7dROQnwHbncS7ZpRErbGT1G1bDe', '', '+62(878)2757-592', 'Farhan Naufal', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Admin'),
('A002', 'farhan@nsiswa.com', '$2y$11$4FYnYX38rkrNs3tiRuv2wuUIUIvcGwYt/SSvRQdiMZoTzWtgD7Ssq', NULL, '+62(878)2757-592', 'Farhan Nonsiswa', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'NSiswa'),
('A003', 'farhan@petugas.com', '$2y$11$/AGNRT5vkqBemKS5aVoajutHD9dtGqWLKtNBobCrNvZ/EkIyGUDCm', '', '+62(878)2757-592', 'Farhan Petugas', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Petugas'),
('A004', 'farhan@siswa.com', '$2y$11$/5SrtbPZ3gWjkS.fpTQBHuq.8wQwI1nKi0AkHyMxfBDTT/vy5iKpG', '', '+62(878)2757-592', 'Farhan Siswa', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `th_terbit` year(4) DEFAULT NULL,
  `ISBN` varchar(30) DEFAULT NULL,
  `sinopsis` text DEFAULT 'Sinopsis Belum Tersedia Untuk Buku Ini.',
  `item_image` varchar(5000) DEFAULT 'default.png',
  `item_document` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `th_terbit`, `ISBN`, `sinopsis`, `item_image`, `item_document`) VALUES
('FKS1', 'Mantappu Jiwa', 'Jerome Polin Sijabat', 'Gramedia Pustaka Utama', 2019, '978-602-06-3241-4', '<p>&ldquo;Jadi ini buku soal latihan Matematika ya, Jer?&rdquo;</p>\r\n\r\n<p>Bukan!</p>\r\n\r\n<p>Kata orang, selama masih hidup, manusia akan terus menghadapi masalah demi masalah.&nbsp;&nbsp;Dan itulah yang kuceritakan dalam buku ini, yaitu bagaimana aku menghadapi setiap persoalan&nbsp;&nbsp;di dalam hidupku.&nbsp;&nbsp;Di mulai dari aku yang lahir dekat dengan hari meletusnya kerusuhan di tahun 1998, bagaimana keluargaku berusaha menyekolahkanku dengan kondisi ekonomi yang terbatas, sampai pada akhirnya aku berhasil mendapatkan beasiswa S1 di Jepang.</p>\r\n\r\n<p>Manusia tidak akan pernah lepas dari masalah kehidupan, betul.&nbsp;&nbsp;Tapi buku ini tidak hanya berisi cerita sedih dan keluhan ini-itu.&nbsp;&nbsp;Ini adalah catatan perjuanganku sebagai Jerome Polin Sijabat, sebagai pelajar Indonesia di Jepang yang iseng memulai petualangan di YouTube lewat channel Nihonggo Mantappu.</p>\r\n\r\n<p>Yuk, naik roller coaster di kehidupanku yang penuh dengan kalkukasi matematika.</p>\r\n\r\n<p>It may not gonna be super fun, but I promise it would worth the ride.</p>\r\n\r\n<p>Minasan, let&rsquo;s go, MANTAPPU JIWA!</p>\r\n', '646783.jpg', '618443.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_transaksi`
--

CREATE TABLE `data_transaksi` (
  `id` int(100) NOT NULL,
  `id_sk` varchar(20) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('PIN','KEM','PES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_transaksi`
--

INSERT INTO `data_transaksi` (`id`, `id_sk`, `id_buku`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(162, 'S001', 'FKS1', 'A004', '2021-03-08', '2021-03-15', 'PIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `nama` varchar(50) NOT NULL,
  `nama_pdk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`nama`, `nama_pdk`) VALUES
('Sistem Informatika Jaringan dan Aplikasi', 'SIJA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_akun`
--

CREATE TABLE `log_akun` (
  `id_log` int(11) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `tgl_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_akun`
--

INSERT INTO `log_akun` (`id_log`, `id_anggota`, `tgl_pembuatan`) VALUES
(26, 'A001', '2021-03-08 05:19:06'),
(27, 'A002', '2021-03-08 05:20:33'),
(28, 'A003', '2021-03-08 05:21:36'),
(29, 'A004', '2021-03-08 05:27:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_buku`
--

CREATE TABLE `log_buku` (
  `id_log` int(11) NOT NULL,
  `id_buku` varchar(100) NOT NULL,
  `tgl_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_buku`
--

INSERT INTO `log_buku` (`id_log`, `id_buku`, `tgl_pembuatan`) VALUES
(43, 'FKS1', '2021-03-08 05:24:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_pinjam`
--

CREATE TABLE `log_pinjam` (
  `id_log` int(11) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_pinjam`
--

INSERT INTO `log_pinjam` (`id_log`, `id_buku`, `id_anggota`, `tgl_pinjam`) VALUES
(83, 'FKS1', 'A004', '2021-03-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `keterangan`) VALUES
(87, 'Perpustakaan Kembali Dibuka Pada Bulan Februari 2021'),
(88, 'Peminjaman Buku Hanya Diperkenankan Bagi Seluruh Siswa yang Memiliki Kartu Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(100) NOT NULL,
  `kode_jenis` varchar(3) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `value` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `kode_jenis`, `nama_jenis`, `value`) VALUES
(1, '', '', 1000),
(51, 'FKS', 'Fiksi', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`nama_pdk`);

--
-- Indeks untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `log_buku`
--
ALTER TABLE `log_buku`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `log_pinjam`
--
ALTER TABLE `log_pinjam`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_transaksi`
--
ALTER TABLE `data_transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `log_buku`
--
ALTER TABLE `log_buku`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `log_pinjam`
--
ALTER TABLE `log_pinjam`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD CONSTRAINT `data_transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_transaksi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `akun` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  ADD CONSTRAINT `log_akun_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `akun` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_buku`
--
ALTER TABLE `log_buku`
  ADD CONSTRAINT `log_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_pinjam`
--
ALTER TABLE `log_pinjam`
  ADD CONSTRAINT `log_pinjam_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
