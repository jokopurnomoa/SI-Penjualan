/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.72-community : Database - db_tokosunda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tokosunda` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_tokosunda`;

/*Table structure for table `detail_transaksi_jual` */

DROP TABLE IF EXISTS `detail_transaksi_jual`;

CREATE TABLE `detail_transaksi_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` int(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_transaksi` (`no_transaksi`),
  KEY `kode_barang` (`kode_barang`),
  KEY `id` (`id`),
  CONSTRAINT `detail_transaksi_jual_ibfk_3` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi_jual` (`no_transaksi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `detail_transaksi_jual_ibfk_4` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Table structure for table `transaksi_jual` */

DROP TABLE IF EXISTS `transaksi_jual`;

CREATE TABLE `transaksi_jual` (
  `no_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` date NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  PRIMARY KEY (`no_transaksi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `transaksi_jual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
