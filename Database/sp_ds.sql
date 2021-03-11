/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 5.6.20 : Database - sp_ds
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sp_ds` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sp_ds`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `level` varchar(16) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`user`,`pass`,`level`) values ('admin','admin','admin'),('user','user','user');

/*Table structure for table `tb_diagnosa` */

DROP TABLE IF EXISTS `tb_diagnosa`;

CREATE TABLE `tb_diagnosa` (
  `kode_diagnosa` varchar(16) NOT NULL,
  `nama_diagnosa` varchar(256) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`kode_diagnosa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_diagnosa` */

insert  into `tb_diagnosa`(`kode_diagnosa`,`nama_diagnosa`,`keterangan`) values ('A','Anemia',''),('B','Bronkhitis',''),('D','Demam',''),('F','Flu','');

/*Table structure for table `tb_gejala` */

DROP TABLE IF EXISTS `tb_gejala`;

CREATE TABLE `tb_gejala` (
  `kode_gejala` varchar(16) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL DEFAULT '',
  `bobot` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_gejala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_gejala` */

insert  into `tb_gejala`(`kode_gejala`,`nama_gejala`,`bobot`) values ('1','Badan Panas',0.4),('2','Sakit Kepala',0.5),('3','Bersin ',0.6),('4','Batuk',0.4),('5','Pilek',0.8),('6','Lemas',0.3),('7','Kedinginan',0.3);

/*Table structure for table `tb_relasi` */

DROP TABLE IF EXISTS `tb_relasi`;

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_diagnosa` varchar(16) NOT NULL,
  `kode_gejala` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `tb_relasi` */

insert  into `tb_relasi`(`ID`,`kode_diagnosa`,`kode_gejala`) values (39,'B','1'),(40,'D','1'),(41,'F','1'),(42,'A','2'),(43,'F','2'),(44,'B','3'),(45,'F','3'),(46,'B','4'),(47,'F','5'),(48,'A','6'),(49,'D','6'),(50,'F','6'),(51,'D','7'),(52,'F','7');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
