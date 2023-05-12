-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2022 at 08:01 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_neuron`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` int(25) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_telp` bigint(13) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jatah_cuti` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pegawai`, `jenis_kelamin`, `jabatan`, `no_telp`, `foto`, `jatah_cuti`, `password`, `id_akses`) VALUES
(19857690, 'Rocky', 'Laki-laki', 'Manager', 81265772144, 'Designer__s_Room_2_0_by_K3nzuS.jpg', 12, 'c93ccd78b2076528346216b3b2f701e6', 1),
(19857691, 'Budi Utomo2', 'Laki-laki', 'Supervisor', 81277897890, 'new_year_nuaHs.jpg', 8, 'bfe84f9b258404dde399993f2933a7d9', 2),
(19857693, 'Rani', 'Perempuan', 'Staff Pegawai', 82290908787, 'rani.jpg', 12, '72eb875289f32115a2f50f6b056f8760', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `jenis_izin` varchar(255) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `tanggalMulai` date NOT NULL,
  `tanggalBerakhir` date NOT NULL,
  `jml_cuti` int(11) NOT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `data_dibuat` datetime NOT NULL,
  `terakhir_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `jenis_izin`, `nip`, `nama_pegawai`, `tanggalMulai`, `tanggalBerakhir`, `jml_cuti`, `berkas`, `keterangan`, `status`, `data_dibuat`, `terakhir_dibuat`) VALUES
(1, 'Cuti', 19857691, 'Budi Utomo2', '2022-12-16', '2022-12-17', 1, '', 'tes', 'Disetujui', '2022-12-15 21:43:16', '2022-12-15 21:43:16'),
(2, 'Cuti', 19857691, 'Budi Utomo2', '2022-12-16', '2022-12-19', 3, '', 'sefew', 'Menunggu Persetujuan', '2022-12-16 01:42:31', '2022-12-16 01:42:31'),
(3, 'Cuti', 19857691, 'Budi Utomo2', '2022-12-16', '2022-12-19', 3, '', 'wqdqw', 'Menunggu Persetujuan', '2022-12-16 01:42:56', '2022-12-16 01:42:56'),
(4, 'Cuti', 19857691, 'Budi Utomo2', '2022-12-20', '2022-12-23', 3, '', 'ff', 'Menunggu Persetujuan', '2022-12-16 01:48:43', '2022-12-16 01:48:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
