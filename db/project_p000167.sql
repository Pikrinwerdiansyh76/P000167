-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2024 at 12:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_p000167`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(5) NOT NULL,
  `id_semester` int(4) NOT NULL,
  `id_kelas` int(4) NOT NULL,
  `id_jadwal_mengajar` int(4) NOT NULL,
  `id_siswa` int(4) NOT NULL,
  `bulan` char(7) NOT NULL,
  `tanggal` date NOT NULL,
  `kehadiran` enum('Hadir','Sakit','Izin','Alpa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_semester`, `id_kelas`, `id_jadwal_mengajar`, `id_siswa`, `bulan`, `tanggal`, `kehadiran`) VALUES
(1, 3, 6, 76, 13, '2023-11', '2023-11-10', 'Hadir'),
(2, 3, 6, 76, 14, '2023-11', '2023-11-10', 'Hadir'),
(3, 3, 6, 77, 13, '2023-11', '2023-11-10', 'Hadir'),
(4, 3, 6, 77, 14, '2023-11', '2023-11-10', 'Hadir'),
(5, 3, 6, 76, 13, '2023-11', '2023-11-11', 'Hadir'),
(6, 3, 6, 76, 14, '2023-11', '2023-11-11', 'Hadir'),
(7, 3, 6, 77, 13, '2023-11', '2023-11-11', 'Hadir'),
(8, 3, 6, 77, 14, '2023-11', '2023-11-11', 'Hadir'),
(9, 3, 5, 55, 9, '2023-11', '2023-11-13', ''),
(10, 3, 5, 55, 10, '2023-11', '2023-11-13', ''),
(11, 3, 5, 55, 11, '2023-11', '2023-11-13', ''),
(12, 3, 5, 55, 12, '2023-11', '2023-11-13', ''),
(13, 3, 5, 56, 9, '2023-11', '2023-11-13', NULL),
(14, 3, 5, 56, 10, '2023-11', '2023-11-13', NULL),
(15, 3, 5, 56, 11, '2023-11', '2023-11-13', NULL),
(16, 3, 5, 56, 12, '2023-11', '2023-11-13', NULL),
(17, 3, 2, 21, 3, '2023-11', '2023-11-15', NULL),
(18, 3, 2, 21, 4, '2023-11', '2023-11-15', NULL),
(19, 3, 2, 21, 5, '2023-11', '2023-11-15', NULL),
(20, 3, 5, 62, 9, '2023-11', '2023-11-16', 'Hadir'),
(21, 3, 5, 62, 10, '2023-11', '2023-11-16', 'Alpa'),
(22, 3, 5, 62, 11, '2023-11', '2023-11-16', 'Hadir'),
(23, 3, 5, 62, 12, '2023-11', '2023-11-16', 'Izin'),
(24, 3, 5, 57, 9, '2023-11', '2023-11-28', 'Hadir'),
(25, 3, 5, 57, 10, '2023-11', '2023-11-28', 'Hadir'),
(26, 3, 5, 57, 11, '2023-11', '2023-11-28', 'Hadir'),
(27, 3, 5, 57, 12, '2023-11', '2023-11-28', 'Hadir'),
(28, 3, 5, 65, 9, '2023-12', '2023-12-02', ''),
(29, 3, 5, 65, 10, '2023-12', '2023-12-02', ''),
(30, 3, 5, 65, 11, '2023-12', '2023-12-02', ''),
(31, 3, 5, 65, 12, '2023-12', '2023-12-02', ''),
(32, 3, 5, 63, 9, '2023-12', '2023-12-15', 'Izin'),
(33, 3, 5, 63, 10, '2023-12', '2023-12-15', 'Sakit'),
(34, 3, 5, 63, 11, '2023-12', '2023-12-15', 'Sakit'),
(35, 3, 5, 63, 12, '2023-12', '2023-12-15', 'Sakit'),
(36, 3, 1, 3, 1, '2024-01', '2024-01-22', 'Sakit'),
(37, 3, 1, 3, 2, '2024-01', '2024-01-22', 'Hadir'),
(38, 3, 1, 4, 1, '2024-01', '2024-01-22', 'Hadir'),
(39, 3, 1, 4, 2, '2024-01', '2024-01-22', 'Hadir'),
(40, 3, 1, 5, 1, '2024-01', '2024-01-22', 'Hadir'),
(41, 3, 1, 5, 2, '2024-01', '2024-01-22', 'Alpa');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nip_nuptk` varchar(150) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `level` enum('Administrator','Guru') NOT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `slug` varchar(255) NOT NULL,
  `session` text DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `nip_nuptk`, `nama`, `email`, `avatar`, `level`, `status`, `slug`, `session`, `terakhir_login`) VALUES
(1, 'admin', '$2y$10$uWXAZ7W/TxUSDx4H5VphDeZdwQw1VKc843w..M/XuFS6LQZgLYn56', '1900018033', 'Administrator SD', 'administrator@gmail.com', 'administrator-sd-administrator.png', 'Administrator', 'Active', 'administrator-sd-administrator', 'f87f405941cf41f0c2b5b1939e8a1f9edac7e03c7ceb1491ca5ef467f3bdc6db6c277d769ee0ea9854cd66b91feee4dd34456687424306f46c7033aee13a3d9a', '2024-01-20 17:10:43'),
(2, 'sanri', '$2y$10$MYrvC1dTAZTfdixFZXscVeL/VRjt6zzgXYq8M2xDZQoxJj3m59g9C', '196905121', 'Sanri', 'sanri@gmail.com', 'sanri-guru.jpeg', 'Guru', 'Active', 'sanri-guru', NULL, NULL),
(3, 'mustamin', '$2y$10$JGaAbzqpjKNy3cJxrkT2duIzOWjExhz7Wo8Ga5rrG90w5sXHsMuQW', '197308032', 'Mustamin', 'mustamin@gmail.com', 'mustamin-guru.jpeg', 'Guru', 'Active', 'mustamin-guru', 'eafd5eb9c2d686e87306f1d44feef7f1a6b95e66497b0987e2a084d15fa1ceb9c95e64baec6a94bcb17e14f8f1897ca33678199dbc9b0c7bc2b423d89d946338', '2024-01-22 11:28:26'),
(4, 'hamid', '$2y$10$s5aN3vU1Babcp9QeLTgbN.Tq6J1lsod98axdDCJaPZ2M.tvPGFz6a', '156274164', 'A. Hamid', 'hamid@gmail.com', 'a-hamid-guru.jpeg', 'Guru', 'Active', 'a-hamid-guru', '9310b180c7ae34c799e1138c7d40ee9105702ac4f0292449be8ce71cc4a8206bfd2ccc6f19e7e4d65a0132abc8e2633c1c81907065d1d57db1044af6760e6d91', '2024-01-20 17:11:07'),
(5, 'rosmiati', '$2y$10$hf/mrev/fFqo1wF0AF7pqOF6rTfjvitzzD6QGKCQ2FVwm4mCUklkC', '575376366', 'Rosmiati', 'rosmiati@gmail.com', 'rosmiati-guru.jpeg', 'Guru', 'Active', 'rosmiati-guru', 'da3fc928ee77af3e8fdca6d81ffcb8c3764b02425739ad733176458c73757a2ce141d646b76bba26c9d2d933476ab013fb7bf40360917c914c1d2cd987a47b60', '2024-01-14 20:55:11'),
(6, 'srirohayu', '$2y$10$rHenETsrGWEp6WYpEYNl0OoxyZpCQEmpfbB9yHu5Sk73Pjlk5PmsW', '273676266', 'Sri Rohayu', 'srirohayu@gmail.com', 'sri-rohayu-guru.jpeg', 'Guru', 'Active', 'sri-rohayu-guru', 'c821f242fe3597f282a770fdb3f4e0782d0e204e4b9e064e187df05da43011e81a489186d0a9951c8eb843ea54fe0c384ed2fb6c31001e65840e939b79dcd0d7', '2024-01-22 11:28:44'),
(7, 'safaruddin', '$2y$10$ah.NrnSvkOXIbuepd/i9nOB/8Ix8IsfTRi0qAZ04ySRNwdOtnfpTm', '756375966', 'Safaruddin', 'safaruddin@gmail.com', 'safaruddin-guru.jpeg', 'Guru', 'Active', 'safaruddin-guru', '3c2fa4ed002b39fe7c93626169c7e5c24679d27b661b6227042b32f116cedb49d30d23ad391d5c1c0652f8886c52722984d2fa7de49af737de581908c7d0db13', '2023-11-11 10:54:07'),
(8, 'anggun', '$2y$10$Ym85GGS/2Ia8LpgcW2N.Oe6j36JkyaldZYvMW.sthckIXnierSJc6', '1234582727', 'Anggun Lestari', 'anggun@gmail.com', 'anggun-lestari-guru.jpeg', 'Guru', 'Active', 'anggun-lestari-guru', 'b49d636a6bbb1837da4121a66805ef6131c11cd9a23587341dfe2419e88a3670512a16f06097b8570fa06b06f872ccb03f422030a857cdab404d57dab74330b5', '2024-01-14 20:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id_jadwal_mengajar` int(4) NOT NULL,
  `id_semester` int(4) NOT NULL,
  `id_kelas` int(4) NOT NULL,
  `id_akun` int(4) NOT NULL,
  `id_mapel` int(4) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id_jadwal_mengajar`, `id_semester`, `id_kelas`, `id_akun`, `id_mapel`, `hari`, `jam`) VALUES
(3, 3, 1, 6, 4, 'Senin', '07:00 s/d 08:00'),
(4, 3, 1, 6, 5, 'Senin', '08:00 s/d 10:00'),
(5, 3, 1, 6, 6, 'Senin', '10:30 s/d 12:00'),
(6, 3, 1, 6, 9, 'Selasa', '07:00 s/d 09:00'),
(7, 3, 1, 6, 4, 'Selasa', '09:00 s/d 10:00'),
(8, 3, 1, 6, 2, 'Selasa', '10:30 s/d 12:00'),
(9, 3, 1, 6, 7, 'Rabu', '07:00 s/d 12:00'),
(10, 3, 1, 6, 2, 'Kamis', '07:00 s/d 10:00'),
(11, 3, 1, 6, 1, 'Kamis', '10:30 s/d 12:00'),
(12, 3, 1, 6, 8, 'Jumat', '07:00 s/d 08:00'),
(13, 3, 1, 6, 5, 'Jumat', '08:00 s/d 09:00'),
(14, 3, 1, 6, 9, 'Jumat', '09:30 s/d 10:30'),
(15, 3, 1, 6, 10, 'Sabtu', '07:00 s/d 09:00'),
(16, 3, 1, 6, 11, 'Sabtu', '09:30 s/d 11:00'),
(17, 3, 2, 3, 10, 'Senin', '07:00 s/d 10:00'),
(18, 3, 2, 3, 4, 'Senin', '10:30 s/d 12:00'),
(19, 3, 2, 3, 2, 'Selasa', '07:00 s/d 10:00'),
(20, 3, 2, 3, 4, 'Selasa', '10:30 s/d 12:00'),
(21, 3, 2, 3, 2, 'Rabu', '07:00 s/d 10:00'),
(22, 3, 2, 3, 12, 'Rabu', '10:30 s/d 12:00'),
(23, 3, 2, 3, 11, 'Kamis', '07:00 s/d 10:00'),
(24, 3, 2, 3, 13, 'Kamis', '10:30 s/d 12:00'),
(25, 3, 2, 3, 4, 'Jumat', '07:00 s/d 09:00'),
(26, 3, 2, 3, 1, 'Jumat', '09:30 s/d 11:00'),
(27, 3, 2, 3, 12, 'Sabtu', '07:00 s/d 10:00'),
(28, 3, 2, 3, 13, 'Sabtu', '10:30 s/d 12:00'),
(29, 3, 3, 2, 4, 'Senin', '07:00 s/d 10:00'),
(30, 3, 3, 2, 1, 'Senin', '10:30 s/d 12:00'),
(31, 3, 3, 2, 1, 'Selasa', '07:00 s/d 10:00'),
(32, 3, 3, 2, 12, 'Selasa', '10:30 s/d 12:00'),
(33, 3, 3, 2, 10, 'Rabu', '07:00 s/d 10:00'),
(34, 3, 3, 2, 6, 'Rabu', '10:30 s/d 12:00'),
(35, 3, 3, 2, 2, 'Kamis', '07:00 s/d 10:00'),
(36, 3, 3, 2, 3, 'Kamis', '10:30 s/d 12:00'),
(37, 3, 3, 2, 2, 'Jumat', '07:00 s/d 09:30'),
(38, 3, 3, 2, 14, 'Jumat', '10:00 s/d 11:00'),
(39, 3, 3, 2, 3, 'Sabtu', '07:00 s/d 10:00'),
(40, 3, 3, 2, 14, 'Sabtu', '10:30 s/d 12:00'),
(41, 3, 4, 5, 12, 'Senin', '07:00 s/d 10:00'),
(42, 3, 4, 5, 2, 'Senin', '10:30 s/d 12:00'),
(43, 3, 4, 5, 15, 'Selasa', '07:00 s/d 09:00'),
(44, 3, 4, 5, 1, 'Selasa', '09:00 s/d 10:00'),
(45, 3, 4, 5, 2, 'Selasa', '10:30 s/d 12:00'),
(46, 3, 4, 5, 1, 'Rabu', '07:00 s/d 09:00'),
(47, 3, 4, 5, 12, 'Rabu', '09:00 s/d 10:00'),
(48, 3, 4, 5, 14, 'Rabu', '10:30 s/d 12:00'),
(49, 3, 4, 5, 10, 'Kamis', '07:00 s/d 09:00'),
(50, 3, 4, 5, 11, 'Kamis', '09:00 s/d 10:00'),
(51, 3, 4, 5, 15, 'Kamis', '10:30 s/d 12:00'),
(52, 3, 4, 5, 4, 'Jumat', '07:00 s/d 09:30'),
(53, 3, 4, 5, 2, 'Jumat', '10:00 s/d 11:00'),
(54, 3, 4, 5, 7, 'Sabtu', '07:00 s/d 12:00'),
(55, 3, 5, 4, 1, 'Senin', '07:00 s/d 10:00'),
(56, 3, 5, 4, 12, 'Senin', '10:30 s/d 12:00'),
(57, 3, 5, 4, 1, 'Selasa', '07:00 s/d 10:00'),
(58, 3, 5, 4, 2, 'Selasa', '10:30 s/d 12:00'),
(59, 3, 5, 4, 2, 'Rabu', '07:00 s/d 10:00'),
(60, 3, 5, 4, 4, 'Rabu', '10:30 s/d 12:00'),
(61, 3, 5, 4, 3, 'Kamis', '07:00 s/d 10:00'),
(62, 3, 5, 4, 15, 'Kamis', '10:30 s/d 12:00'),
(63, 3, 5, 4, 10, 'Jumat', '07:00 s/d 11:00'),
(64, 3, 5, 4, 11, 'Sabtu', '07:00 s/d 10:00'),
(65, 3, 5, 4, 6, 'Sabtu', '10:30 s/d 12:00'),
(66, 3, 6, 7, 12, 'Senin', '07:00 s/d 10:00'),
(67, 3, 6, 7, 1, 'Senin', '10:30 s/d 12:00'),
(68, 3, 6, 7, 1, 'Selasa', '07:00 s/d 10:00'),
(69, 3, 6, 7, 15, 'Selasa', '10:30 s/d 12:00'),
(70, 3, 6, 7, 15, 'Rabu', '07:00 s/d 10:00'),
(71, 3, 6, 7, 2, 'Rabu', '10:30 s/d 12:00'),
(72, 3, 6, 7, 1, 'Kamis', '07:00 s/d 10:00'),
(73, 3, 6, 7, 12, 'Kamis', '10:30 s/d 12:00'),
(74, 3, 6, 7, 15, 'Jumat', '07:00 s/d 09:00'),
(75, 3, 6, 7, 4, 'Jumat', '09:30 s/d 11:00'),
(76, 3, 6, 7, 10, 'Sabtu', '07:00 s/d 10:00'),
(77, 3, 6, 7, 12, 'Sabtu', '10:30 s/d 12:00');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(4) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas 1'),
(2, 'Kelas 2'),
(3, 'Kelas 3'),
(4, 'Kelas 4'),
(5, 'Kelas 5'),
(6, 'Kelas 6');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(4) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Indonesia'),
(3, 'Ilmu Pengetahuan Alam (IPA)'),
(4, 'Pendidikan Agama Islam'),
(5, 'Pendidikan Pancasila'),
(6, 'Seni Budaya'),
(7, 'Prakarya'),
(8, 'BTA'),
(9, 'Bahasa Daerah'),
(10, 'Penjaskes'),
(11, 'Bahasa Inggris'),
(12, 'PKN'),
(13, 'Seni Rupa'),
(14, 'Mulok'),
(15, 'Ilmu Pengetahuan Sosial (IPS)');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(4) NOT NULL,
  `no_urut` int(4) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis_pengaturan` enum('Gambar','Deskripsi','Teks','Textarea') NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `tgl_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `no_urut`, `judul`, `jenis_pengaturan`, `gambar`, `deskripsi`, `status`, `tgl_update`) VALUES
(1, 1, 'Icon Website 1', 'Gambar', 'icon-website-1.png', NULL, 'Active', '2023-11-27'),
(2, 2, 'Logo Website 1 (Versi Desktop)', 'Gambar', 'logo-website-1-versi-desktop.png', NULL, 'Active', '2023-11-08'),
(3, 3, 'Logo Website 1 (Versi Mobile)', 'Gambar', 'logo-website-1-versi-mobile.png', NULL, 'Active', '2023-11-08'),
(4, 4, 'Nomor WhatsApp', 'Teks', NULL, '082328414265', 'Non-Active', '2023-04-05'),
(5, 5, 'Nomor Telp./SMS', 'Teks', NULL, '082328414265', 'Non-Active', '2023-04-05'),
(6, 6, 'Instagram', 'Teks', NULL, 'https://www.instagram.com/dutaprotraining', 'Non-Active', '2023-04-05'),
(7, 7, 'Facebook', 'Teks', NULL, 'https://www.facebook.com/dutaprotraining', 'Non-Active', '2023-04-05'),
(8, 8, 'TikTok', 'Teks', NULL, 'https://www.tiktok.com/@mandavillacluster', 'Non-Active', '2023-03-31'),
(9, 9, 'YouTube', 'Teks', NULL, 'https://www.youtube.com/channel/UCwqMNbvcRYJx9YcLDTx2qTg', 'Non-Active', '2023-04-05'),
(10, 10, 'LinkedIn', 'Teks', NULL, 'https://www.linkedin.com/in/duta-pro-training-consulting', 'Non-Active', '2023-04-05'),
(11, 11, 'Email', 'Teks', NULL, 'info@dutaprotraining.id', 'Non-Active', '2023-04-05'),
(12, 12, 'Embed Google Maps', 'Textarea', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1976.9372713351606!2d110.44989014999999!3d-7.696610550000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5c132b027c4b%3A0xfdc978072c32e7e6!2sPd.%20II%2C%20Widodomartani%2C%20Kec.%20Ngemplak%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1680637876538!5m2!1sid!2sid\"  width=\"100%\" height=\"225\" class=\"rounded-5 shadow-sm\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Non-Active', '2023-04-05'),
(13, 13, 'Link Google Maps', 'Textarea', NULL, 'https://www.google.com/maps/place/Pd.+II,+Widodomartani,+Kec.+Ngemplak,+Kabupaten+Sleman,+Daerah+Istimewa+Yogyakarta/@-7.6966106,110.4498901,18z/data=!3m1!4b1!4m6!3m5!1s0x2e7a5c132b027c4b:0xfdc978072c32e7e6!8m2!3d-7.6964626!4d110.4496698!16s%2Fg%2F11ghndjp2j', 'Non-Active', '2023-04-05'),
(14, 14, 'Alamat', 'Textarea', NULL, 'Pondok II Widodomartani, Kec.Ngemplak, Sleman, Daerah Istimewa Yogyakarta - 55584', 'Non-Active', '2023-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `rombel`
--

CREATE TABLE `rombel` (
  `id_rombel` int(4) NOT NULL,
  `id_semester` int(4) NOT NULL,
  `id_kelas` int(4) NOT NULL,
  `id_siswa` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rombel`
--

INSERT INTO `rombel` (`id_rombel`, `id_semester`, `id_kelas`, `id_siswa`) VALUES
(2, 3, 1, 1),
(3, 3, 1, 2),
(4, 3, 2, 3),
(5, 3, 2, 4),
(6, 3, 2, 5),
(7, 3, 3, 6),
(8, 3, 4, 7),
(9, 3, 4, 8),
(10, 3, 5, 9),
(11, 3, 5, 10),
(12, 3, 5, 11),
(13, 3, 5, 12),
(14, 3, 6, 13),
(15, 3, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(4) NOT NULL,
  `nama_semester` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `nama_semester`, `tahun_ajaran`) VALUES
(1, '1 (Ganjil)', '2022/2023'),
(2, '2 (Genap)', '2022/2023'),
(3, '1 (Ganjil)', '2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `id_semester` int(4) NOT NULL,
  `id_kelas` int(4) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `session` text DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `username`, `password`, `nisn`, `nama_siswa`, `nama_ibu`, `jenis_kelamin`, `avatar`, `status`, `id_semester`, `id_kelas`, `slug`, `session`, `terakhir_login`) VALUES
(1, 'siswa', '$2y$10$TKxcfluAMHUgiUaXGqw4AO67ZiGXhoQahkbCEfQy1AtfKpWM1nb66', '1900018011', 'Siswa Kelas 1 v1', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 1, 'siswa-kelas-1-v1-1900018011', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(2, 'siswa', '$2y$10$vjtaenHUyrupveJfKRgFYuBLwPHlQURewHd39.Cf50wvi9BLgEYR2', '1900018012', 'Siswa Kelas 1 v2', 'Dian Untari', 'Perempuan', 'avatar-default.jpeg', 'Active', 3, 1, 'siswa-kelas-1-v2-1900018012', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(3, 'siswa', '$2y$10$ZSoWwmEecG13zmmE9YE0MOU0q6T4zoQeuVlUbO31na588Z7EobQru', '1900018021', 'Siswa Kelas 2 v1', 'Dian Untari', 'Perempuan', 'avatar-default.jpeg', 'Active', 3, 2, 'siswa-kelas-2-v1-1900018021', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(4, 'siswa', '$2y$10$VQanmSTcyrr1gIZFxmDnKe.C6uFLELSoeITVEtu/J1XMZWNf48s6G', '1900018022', 'Siswa Kelas 2 v2', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 2, 'siswa-kelas-2-v2-1900018022', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(5, 'siswa', '$2y$10$6dr.bbMmPRMdOJIeTJgeyezFkllPuvkxpteJJWbTIa99V3rAvYTDO', '1900018023', 'Siswa Kelas 2 v3', 'Dian Untari', 'Perempuan', 'avatar-default.jpeg', 'Active', 3, 2, 'siswa-kelas-2-v3-1900018023', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(6, 'siswa', '$2y$10$rNrUXL1EMItM.Btb9KmRWeapIo7NbVTME27tzolMnE1DBPHEOD/bK', '1900018031', 'Siswa Kelas 3 v1', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 3, 'siswa-kelas-3-v1-1900018031', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(7, 'siswa', '$2y$10$gva4xldTO1xnN62qArIUtex/SapRitipLye7NBqRXSsdIq7EsaSyu', '1900018041', 'Siswa Kelas 4 v1', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 4, 'siswa-kelas-4-v1-1900018041', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(8, 'siswa', '$2y$10$6c9.FsOeMYxd0DFdkcZoJeX.DzGAvsMBTnL5A6tvx.pdDHoerMzja', '1900018042', 'Siswa Kelas 4 v2', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 4, 'siswa-kelas-4-v2-1900018042', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(9, 'siswa', '$2y$10$jKxnSlYTk/rKzIbdW4oKJOeoxCCxzn9b.8s6hu/ahAKgrGtCGyol6', '1900018051', 'Siswa Kelas 5 v1', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 5, 'siswa-kelas-5-v1-1900018051', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(10, 'siswa', '$2y$10$IpJ763GMDOMnwIsJgeoNc.aULIFQPNkOhlK/pVacypsw5EegmYcui', '1900018052', 'Siswa Kelas 5 v2', 'Dian Untari', 'Perempuan', 'avatar-default.jpeg', 'Active', 3, 5, 'siswa-kelas-5-v2-1900018052', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(11, 'siswa', '$2y$10$6Ohh2hkhDF3O846LgpOfoeqRCpfjyVHtSlKv9SgGu1vn9gPaANRFS', '1900018053', 'Siswa Kelas 5 v3', 'Dian Untari', 'Perempuan', 'avatar-default.jpeg', 'Active', 3, 5, 'siswa-kelas-5-v3-1900018053', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(12, 'siswa', '$2y$10$HFFW52NdZbSvCmzOtbFYlu3igCxr8GM/vHYEdf1kYVfbdIO4xm/TW', '1900018054', 'Siswa Kelas 5 v4', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 5, 'siswa-kelas-5-v4-1900018054', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(13, 'siswa', '$2y$10$/sit0igyu/tkx7ba.y8h9epDjw8S05eo3PEndM.RV1DtPO.n..9vy', '1900018061', 'Siswa Kelas 6 v1', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 6, 'siswa-kelas-6-v1-1900018061', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19'),
(14, 'siswa', '$2y$10$21EsSLWX3xvODSZ3Ws2Y6.kU1rxLzxuW4F7EA5N7vw15hCMorCWv6', '1900018062', 'Siswa Kelas 6 v2', 'Dian Untari', 'Laki-Laki', 'avatar-default.jpeg', 'Active', 3, 6, 'siswa-kelas-6-v2-1900018062', '6d22f483430b7a16733a763b3f59583f619ce7d8b74101d58dffa60d08006ab8353a86a7ba0896a2a7d09c63b1c878530e7b0417d71d578255f28320d29688a2', '2024-01-20 17:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wali_kelas` int(4) NOT NULL,
  `id_akun` int(5) NOT NULL,
  `id_kelas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_wali_kelas`, `id_akun`, `id_kelas`) VALUES
(1, 6, 1),
(2, 3, 2),
(3, 2, 3),
(4, 5, 4),
(5, 4, 5),
(6, 7, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_jadwal_mengajar` (`id_jadwal_mengajar`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id_jadwal_mengajar`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id_rombel`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wali_kelas`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id_jadwal_mengajar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id_rombel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wali_kelas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`id_jadwal_mengajar`) REFERENCES `jadwal_mengajar` (`id_jadwal_mengajar`),
  ADD CONSTRAINT `absensi_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD CONSTRAINT `jadwal_mengajar_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`),
  ADD CONSTRAINT `jadwal_mengajar_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `jadwal_mengajar_ibfk_3` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `jadwal_mengajar_ibfk_4` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`);

--
-- Constraints for table `rombel`
--
ALTER TABLE `rombel`
  ADD CONSTRAINT `rombel_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`),
  ADD CONSTRAINT `rombel_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `rombel_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD CONSTRAINT `wali_kelas_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `wali_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
