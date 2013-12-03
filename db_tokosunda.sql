-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2013 at 07:53 AM
-- Server version: 5.5.16
-- PHP Version: 5.4.0beta2-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tokosunda`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(45) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `jumlah`, `harga_jual`) VALUES
('KP001', 'Kopi ABC', 'PCS', 5, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE IF NOT EXISTS `barang_rusak` (
  `kode_barang` varchar(8) NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_jual`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi_jual` (
  `id` int(11) NOT NULL,
  `no_transaksi` int(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  KEY `no_transaksi` (`no_transaksi`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_suplai`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi_suplai` (
  `no_suplai` int(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `harga_suplai` int(11) NOT NULL,
  `jumlah_suplai` int(11) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  KEY `no_suplai` (`no_suplai`),
  KEY `kode_barang` (`kode_barang`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE IF NOT EXISTS `diskon` (
  `kode_diskon` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(8) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  PRIMARY KEY (`kode_diskon`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(20) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  `publish` varchar(1) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `icon` varchar(30) NOT NULL,
  PRIMARY KEY (`id_modul`),
  UNIQUE KEY `nama_modul` (`nama_modul`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `hak_akses`, `publish`, `id_user`, `icon`) VALUES
(5, 'Pengaturan', 'admin', 'Y', 'admin', 'img/icons/settings.png'),
(48, 'Barang', 'super', 'Y', 'admin', ''),
(50, 'Transaksi Suplai', 'super', 'Y', 'admin', ''),
(51, 'Transaksi Penjualan', 'super', 'Y', 'admin', ''),
(52, 'Distributor', 'super', 'Y', 'admin', ''),
(53, 'Pengguna', 'super', 'Y', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE IF NOT EXISTS `pemasok` (
  `id_pemasok` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pemasok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submodul`
--

CREATE TABLE IF NOT EXISTS `submodul` (
  `id_submodul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_submodul` varchar(20) NOT NULL,
  `link` varchar(50) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  `publish` varchar(1) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  PRIMARY KEY (`id_submodul`),
  KEY `id_modul` (`id_modul`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `submodul`
--

INSERT INTO `submodul` (`id_submodul`, `nama_submodul`, `link`, `hak_akses`, `publish`, `id_modul`, `id_user`) VALUES
(15, 'Tambah Modul', 'submodul=tambah_modul', 'admin', 'Y', 5, 'admin'),
(16, 'Daftar Modul', 'submodul=daftar_modul', 'admin', 'Y', 5, 'admin'),
(17, 'Daftar Submodul', 'submodul=daftar_submodul', 'admin', 'Y', 5, 'admin'),
(18, 'Tambah Submodul', 'submodul=tambah_submodul', 'admin', 'Y', 5, 'admin'),
(45, 'Tambah Barang', 'submodul=tambah_barang', 'super', 'Y', 48, 'admin'),
(48, 'Tampil Barang', 'submodul=tampil_barang', 'super', 'Y', 48, 'admin'),
(49, 'Tambah Transaksi', 'submodul=tambah_transaksi', 'super', 'Y', 50, 'admin'),
(50, 'Tampil Transaksi', 'submodul=tampil_transaksi', 'super', 'Y', 50, 'admin'),
(51, 'Tambah Transaksi', 'submodul=tambah_transaksi', 'super', 'Y', 51, 'admin'),
(53, 'Tampil Transaksi', 'submodul=tampil_transaksi', 'super', 'Y', 51, 'admin'),
(54, 'Tambah Distributor', 'submodul=tambah_distributor', 'super', 'Y', 52, 'admin'),
(56, 'Tampil Distributor', 'submodul=tampil_distributor', 'super', 'Y', 52, 'admin'),
(57, 'Tambah Pengguna', 'submodul=tambah_pengguna', 'super', 'Y', 53, 'admin'),
(58, 'Tampil Pengguna', 'submodul=tampil_pengguna', 'super', 'Y', 53, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_jual`
--

CREATE TABLE IF NOT EXISTS `transaksi_jual` (
  `no_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` date NOT NULL,
  `total_kotor` int(11) NOT NULL,
  `diskon_total` decimal(10,0) NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  PRIMARY KEY (`no_transaksi`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_suplai`
--

CREATE TABLE IF NOT EXISTS `transaksi_suplai` (
  `no_suplai` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_suplai` date NOT NULL,
  `id_pemasok` varchar(8) NOT NULL,
  PRIMARY KEY (`no_suplai`),
  KEY `id_pemasok` (`id_pemasok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hak_akses` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `hak_akses`, `password`) VALUES
('admin', 'Admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD CONSTRAINT `barang_rusak_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_transaksi_jual`
--
ALTER TABLE `detail_transaksi_jual`
  ADD CONSTRAINT `detail_transaksi_jual_ibfk_3` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi_jual` (`no_transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_jual_ibfk_4` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi_suplai`
--
ALTER TABLE `detail_transaksi_suplai`
  ADD CONSTRAINT `detail_transaksi_suplai_ibfk_5` FOREIGN KEY (`no_suplai`) REFERENCES `transaksi_suplai` (`no_suplai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_suplai_ibfk_6` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_suplai_ibfk_7` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `diskon`
--
ALTER TABLE `diskon`
  ADD CONSTRAINT `diskon_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `submodul`
--
ALTER TABLE `submodul`
  ADD CONSTRAINT `submodul_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id_modul`) ON UPDATE CASCADE,
  ADD CONSTRAINT `submodul_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_jual`
--
ALTER TABLE `transaksi_jual`
  ADD CONSTRAINT `transaksi_jual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_suplai`
--
ALTER TABLE `transaksi_suplai`
  ADD CONSTRAINT `transaksi_suplai_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
