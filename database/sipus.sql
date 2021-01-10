-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 02:38 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

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
-- Table structure for table `akun`
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
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_anggota`, `email`, `password`, `rfid`, `no_hp`, `nama`, `jekel`, `kelas`, `level`) VALUES
('A005', 'alif@gmail.com', '$2y$11$7CS0I0Xhyxp8hFKOeLFxxeG5pyzo1u92oEM4h1OpuxopG1Bo2BT8O', 'B969A4A3', '+62(888)4443-333', 'Mohamad Alif Dzikry', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Siswa'),
('A004', 'farhan@gmail.com', '$2y$11$WtKIA.YuT4LwPZTKGT1TIec92JU6IClGv9mJZNlQm47ecwcaOG0oO', '999498D5', '+62(878)2759-207', 'Farhan Naufal', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Siswa'),
('A003', 'mirna@gmail.com', '$2y$11$ThZoUMwUZHtigHP3qdVhg.531gB0FSMGzRP67SlmWtF2pAI1zZ1nO', '', '+62(88)833-3444', 'Mirna Rahayu Daivani', 'PR', '13 Sistem Informatika Jaringan dan Aplikasi A', 'Siswa'),
('A006', 'rafi@gmail.com', '$2y$11$/VjC2lm7stk4oz.sBYyjVeVUzXnHbtzvc7e5qZB.hfXguduWozBdC', '873D174E', '+62(888)8777-777', 'Muhamad Rafi Raditya Dzakwan', 'LK', '13 Sistem Informatika Jaringan dan Aplikasi B', 'Petugas'),
('A001', 'vnalvaro24@gmail.com', '$2y$11$nfi/o.CajSYPfrWr1SewUec8K6dbfR2pOfD9yqoVZhiMg9O9gYwV.', '03A4EF02', '+62(878)2757-592', 'Farhan Naufal', 'LK', '', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `th_terbit` year(4) NOT NULL,
  `ISBN` varchar(30) DEFAULT NULL,
  `sinopsis` text DEFAULT 'Sinopsis Belum Tersedia Untuk Buku Ini.',
  `item_image` varchar(5000) DEFAULT 'default.png',
  `item_document` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `th_terbit`, `ISBN`, `sinopsis`, `item_image`, `item_document`) VALUES
('SOL1', 'HANTU DIGOEL', 'Takashi Shiraishi', 'LKiS', 2016, '979-8966-78-3', '<p>Buku ini berusaha mengungkapkan keberadaan Pulau Digoel sebagai kamp tahanan. Keadaan Digoel yang 100% terisolasi, belantara rawa penuh nyamuk malaria, dan berada sekitar 450 km ke hulu sungai yang penuh buaya adalah siksaan tersendiri. Dengan daerah hunian yang tak layak huni ini, rasa sepi yang mencekam dan rindu kampung halaman yang kuat, maka ada di antara para tahanan ini yang kemudian menjadi gila, mati, mencoba melarikan diri namun kemudian lenyap tak tahu rimbanya, atau tunduk dengan apa yang diinginkan oleh pemerintah.</p>\r\n', '692826.jpg', '372444.pdf'),
('SOL2', 'Makna Budaya dalam Komunikasi Antar Budaya', 'Dr. Alo Liliweri, MS', 'LKiS', 2007, '978-979-9492-88-0', '<p>Manusia, baik sebagai makhluk individu maupun sosial selalu melakukan aktifitas komunikasi. Komunikasi antarsesama, dengan Tuhan, bahkan dengan makhluk-makluk lainnya. Komunikasi antarbudaya pada dasarnya mengacu pada realitas keragaman budaya dalam masyarakat yang masing-masing memiliki etika, tata cara, unggah-ungguh berkomunikasi yang beragam pula.</p>\r\n', '972093.jpg', '591500.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
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
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`id`, `id_sk`, `id_buku`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(85, 'S002', 'SOL1', 'A005', '2021-01-09', '2021-01-16', 'PIN'),
(108, 'S003', 'SOL1', 'A004', '2021-01-09', '2021-01-16', 'PIN');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `nama` varchar(50) NOT NULL,
  `nama_pdk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`nama`, `nama_pdk`) VALUES
('Instrumentasi dan Otomatisasi Proses', 'IOP'),
('Produksi Film dan Produk Televisi', 'PFPT'),
('Rekayasa Perangkat Lunak', 'RPL'),
('Sistem Informatika Jaringan dan Aplikasi', 'SIJA'),
('Teknik Elektronika Daya dan Komunikasi', 'TEDK'),
('Teknik Elektronika Industri', 'TEI'),
('Teknik Mekatronika', 'MEKA'),
('Teknik Otomasi Industri', 'TOI'),
('Teknik Pendingin dan Tata Udara', 'TPTU');

-- --------------------------------------------------------

--
-- Table structure for table `log_akun`
--

CREATE TABLE `log_akun` (
  `id_log` int(11) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_akun`
--

INSERT INTO `log_akun` (`id_log`, `id_anggota`, `tanggal_pembuatan`) VALUES
(2, 'A001', '2021-01-08 12:54:47'),
(4, 'A003', '2021-01-08 12:56:27'),
(5, 'A004', '2021-01-08 12:57:00'),
(6, 'A005', '2021-01-08 12:57:30'),
(9, 'A006', '2021-01-10 07:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `log_buku`
--

CREATE TABLE `log_buku` (
  `id_log` int(11) NOT NULL,
  `id_buku` varchar(100) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_buku`
--

INSERT INTO `log_buku` (`id_log`, `id_buku`, `tanggal_pembuatan`) VALUES
(20, 'SOL1', '2021-01-07 05:02:09'),
(21, 'SOL2', '2021-01-10 15:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `log_pinjam`
--

CREATE TABLE `log_pinjam` (
  `id_log` int(11) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_pinjam`
--

INSERT INTO `log_pinjam` (`id_log`, `id_buku`, `id_anggota`, `tgl_pinjam`) VALUES
(33, 'SOL1', 'A005', '2021-01-09'),
(38, 'SOL1', 'A004', '2021-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `keterangan`) VALUES
(87, 'Perpustakaan Kembali Dibuka Pada Bulan Februari 2021'),
(88, 'Peminjaman Buku Hanya Diperkenankan Bagi Seluruh Siswa yang Memiliki Kartu Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(100) NOT NULL,
  `kode_jenis` varchar(3) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `value` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `kode_jenis`, `nama_jenis`, `value`) VALUES
(1, '', '', 3000),
(2, 'ILH', 'Ilmiah', 0),
(3, 'NFS', 'Non-Fiksi', 0),
(4, 'SJH', 'Sejarah', 0),
(5, 'FKS', 'Fiksi', 0),
(15, 'SOL', 'Sosial', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `log_buku`
--
ALTER TABLE `log_buku`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `id_buku` (`id_buku`);

--
-- Indexes for table `log_pinjam`
--
ALTER TABLE `log_pinjam`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `log_buku`
--
ALTER TABLE `log_buku`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `log_pinjam`
--
ALTER TABLE `log_pinjam`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD CONSTRAINT `data_transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_transaksi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `akun` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD CONSTRAINT `log_akun_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `akun` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_buku`
--
ALTER TABLE `log_buku`
  ADD CONSTRAINT `log_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_pinjam`
--
ALTER TABLE `log_pinjam`
  ADD CONSTRAINT `log_pinjam_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
