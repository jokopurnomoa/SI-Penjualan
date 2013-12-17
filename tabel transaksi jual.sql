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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi_jual` */

insert  into `detail_transaksi_jual`(`id`,`no_transaksi`,`kode_barang`,`jumlah_beli`,`harga`) values (1,32,'KP001',8,1000),(2,32,'KP002',3,1000),(4,33,'KP002',3,1000),(5,33,'KP001',4,1000),(7,34,'KP002',3,1000),(10,34,'KP002',4,1000),(11,34,'KP003',4,2500),(13,36,'KP002',3,1000),(17,36,'KP003',5,2500),(18,36,'KP002',7,1000),(20,33,'KP002',6,1000),(21,33,'KP001',4,1000),(23,38,'KP001',3,1000),(24,38,'KP003',2,2500),(26,39,'KP002',4,1000),(27,39,'KP001',1,1000);

/*Table structure for table `temp_transaksi_jual` */

DROP TABLE IF EXISTS `temp_transaksi_jual`;

CREATE TABLE `temp_transaksi_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(8) DEFAULT NULL,
  `jumlah_beli` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `temp_transaksi_jual` */

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_jual` */

insert  into `transaksi_jual`(`no_transaksi`,`tanggal_transaksi`,`total`,`id_user`) values (32,'2013-12-10',11000,'admin'),(33,'2013-12-10',17000,'admin'),(34,'2013-12-11',17000,'admin'),(36,'2013-12-16',22500,'admin'),(38,'2013-12-18',8000,'admin'),(39,'2013-12-18',5000,'admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
