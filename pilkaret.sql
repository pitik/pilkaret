-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2017 at 04:21 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pilkaret`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_rt`
--

CREATE TABLE IF NOT EXISTS `calon_rt` (
  `no_urut` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jumlah_suara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `sebagai` enum('admin','bilik') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `sebagai`) VALUES
(1, 'Admin', '1f3c1aecf5f417fcfba7b346303485fb', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE IF NOT EXISTS `pemilih` (
  `id_pemilih` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `antrian` int(11) DEFAULT NULL,
  `status_memilih` enum('Sudah','Belum','Antri') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_bilik`
--

CREATE TABLE IF NOT EXISTS `status_bilik` (
  `nama` varchar(7) NOT NULL,
  `status` int(11) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `total_antri`
--

CREATE TABLE IF NOT EXISTS `total_antri` (
  `id_an` int(11) NOT NULL,
  `jum_antri` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_antri`
--

INSERT INTO `total_antri` (`id_an`, `jum_antri`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `total_suara`
--

CREATE TABLE IF NOT EXISTS `total_suara` (
  `id_tot` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_suara`
--

INSERT INTO `total_suara` (`id_tot`, `jumlah`) VALUES
(1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_rt`
--
ALTER TABLE `calon_rt`
  ADD PRIMARY KEY (`no_urut`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`),
  ADD UNIQUE KEY `u_antrian` (`antrian`);

--
-- Indexes for table `status_bilik`
--
ALTER TABLE `status_bilik`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `total_antri`
--
ALTER TABLE `total_antri`
  ADD PRIMARY KEY (`id_an`);

--
-- Indexes for table `total_suara`
--
ALTER TABLE `total_suara`
  ADD PRIMARY KEY (`id_tot`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
