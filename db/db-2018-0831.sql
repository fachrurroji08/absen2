/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 10.1.31-MariaDB : Database - absen2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `absen` */

DROP TABLE IF EXISTS `absen`;

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_pertemuan` int(11) DEFAULT NULL,
  `status` enum('hadir','tidak_hadir') DEFAULT 'tidak_hadir',
  `waktu_absen` time DEFAULT NULL,
  `tanggal_absen` date DEFAULT NULL,
  `latitude` float(9,6) DEFAULT NULL,
  `longitude` float(9,6) DEFAULT NULL,
  `npm` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `npm` (`npm`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `absen` */

insert  into `absen`(`id_absen`,`id_pertemuan`,`status`,`waktu_absen`,`tanggal_absen`,`latitude`,`longitude`,`npm`) values 
(2,3,'hadir','05:27:38','2018-10-02',-7.348367,108.231705,'147006256'),
(3,4,'hadir','11:23:58','2018-10-16',-7.348360,108.231705,'137006107'),
(4,4,'hadir','11:25:40','2018-10-16',-7.348360,108.231705,'147006256');

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nama_admin` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`username`,`password`,`nama_admin`) values 
(3,'admin','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re','Administrator');

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `id_dosen` varchar(20) NOT NULL,
  `nama_dosen` varchar(32) DEFAULT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `gelar_depan` varchar(20) DEFAULT NULL,
  `gelar_belakang` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(`id_dosen`,`nama_dosen`,`nidn`,`gelar_depan`,`gelar_belakang`,`jenis_kelamin`,`password`) values 
('123456789','Asep','1233522726','Dr.','S.Pd.','L','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('20253035','fachrurroji','1122334455','','','L','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('23242526','kasep','1222222222','Dr.','S.T','P','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re');

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_dosen` varchar(20) DEFAULT NULL,
  `id_matakuliah` int(11) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `nama_kelas` varchar(3) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `id_hari` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_dosen` (`id_dosen`),
  KEY `id_matakuliah` (`id_matakuliah`),
  KEY `id_ruangan` (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id_jadwal`,`id_dosen`,`id_matakuliah`,`id_ruangan`,`nama_kelas`,`jam_mulai`,`jam_selesai`,`id_hari`) values 
(1,'123456789',1,885234,'a','05:00:00','15:00:00',2),
(2,'123456789',1,885234,'b','15:00:00','16:30:00',1),
(3,'20253035',3,885235,'a','13:00:00','15:00:00',1);

/*Table structure for table `krs` */

DROP TABLE IF EXISTS `krs`;

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `npm` varchar(20) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `id_jadwal` (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `krs` */

insert  into `krs`(`id_krs`,`npm`,`id_jadwal`) values 
(1,'147006256',1),
(2,'137006107',1),
(6,'147006256',3),
(7,'137006107',3),
(8,'147006256',2),
(9,'147006001',1),
(10,'147006002',1),
(11,'147006003',1),
(12,'147006004`',1),
(13,'147006005',1);

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `npm` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`npm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`npm`,`nama_mahasiswa`,`password`) values 
('137006106','Haerani11','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('137006107','Dede Gunawan','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006001','Ahmad hudori','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006002','Chikara','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006003','Ahmad Zaki','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006004','Kiara Aminah','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006005','Asmi Zakaria','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006231','Riki Ahmad Fauzi','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
('147006256','Muhammad Fachrurroji','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re');

/*Table structure for table `matakuliah` */

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah` (
  `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT,
  `kode_matakuliah` varchar(11) DEFAULT NULL,
  `nama_matakuliah` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_matakuliah`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `matakuliah` */

insert  into `matakuliah`(`id_matakuliah`,`kode_matakuliah`,`nama_matakuliah`) values 
(1,'klk','Kalkulus'),
(2,'mtkd','Matematika Diskrit'),
(3,'alpro','Algotitma dan Pemrog');

/*Table structure for table `pertemuan` */

DROP TABLE IF EXISTS `pertemuan`;

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) DEFAULT NULL,
  `pertemuan_ke` int(2) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `latitude` float(9,6) DEFAULT NULL,
  `longitude` float(9,6) DEFAULT NULL,
  `id_dosen` varchar(20) DEFAULT NULL,
  `detail_pertemuan` longtext,
  `tanggal_pertemuan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `id_jadwal` (`id_jadwal`),
  KEY `id_dosen` (`id_dosen`),
  KEY `pertemuan_ibfk_2` (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pertemuan` */

insert  into `pertemuan`(`id_pertemuan`,`id_jadwal`,`pertemuan_ke`,`id_ruangan`,`latitude`,`longitude`,`id_dosen`,`detail_pertemuan`,`tanggal_pertemuan`,`jam_mulai`,`jam_selesai`) values 
(3,1,1,885234,-7.348367,108.231705,'123456789','pertemuan ini untuk pengujian aplikasi','2018-10-02','05:15:30',NULL),
(4,1,2,885234,-7.348353,108.231697,'123456789','','2018-10-16','11:15:45',NULL);

/*Table structure for table `ruangan` */

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(32) DEFAULT NULL,
  `kapasitas` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=885236 DEFAULT CHARSET=latin1;

/*Data for the table `ruangan` */

insert  into `ruangan`(`id_ruangan`,`nama_ruangan`,`kapasitas`) values 
(885234,'c12b',25),
(885235,'sk03',40);

/*Table structure for table `pertemuan_minggu_ini` */

DROP TABLE IF EXISTS `pertemuan_minggu_ini`;

/*!50001 DROP VIEW IF EXISTS `pertemuan_minggu_ini` */;
/*!50001 DROP TABLE IF EXISTS `pertemuan_minggu_ini` */;

/*!50001 CREATE TABLE  `pertemuan_minggu_ini`(
 `id_pertemuan` int(11) ,
 `id_jadwal` int(11) ,
 `pertemuan_ke` int(2) ,
 `id_ruangan` int(11) ,
 `latitude` float(9,6) ,
 `longitude` float(9,6) ,
 `id_dosen` varchar(20) ,
 `detail_pertemuan` longtext ,
 `tanggal_pertemuan` date ,
 `jam_mulai` time ,
 `jam_selesai` time ,
 `jumlah_hadir` decimal(23,0) ,
 `jumlah_tidak_hadir` decimal(23,0) ,
 `total_mahasiswa` bigint(21) 
)*/;

/*Table structure for table `view_jadwal` */

DROP TABLE IF EXISTS `view_jadwal`;

/*!50001 DROP VIEW IF EXISTS `view_jadwal` */;
/*!50001 DROP TABLE IF EXISTS `view_jadwal` */;

/*!50001 CREATE TABLE  `view_jadwal`(
 `id_jadwal` int(11) ,
 `id_dosen` varchar(20) ,
 `id_matakuliah` int(11) ,
 `id_ruangan` int(11) ,
 `nama_kelas` varchar(3) ,
 `jam_mulai` time ,
 `jam_selesai` time ,
 `id_hari` int(1) ,
 `kode_matakuliah` varchar(11) ,
 `nama_matakuliah` varchar(20) ,
 `nama_ruangan` varchar(32) ,
 `id_pertemuan` int(11) ,
 `pertemuan_ke` int(2) ,
 `latitude` float(9,6) ,
 `longitude` float(9,6) ,
 `detail_pertemuan` longtext ,
 `tanggal_pertemuan` date ,
 `pertemuan_jam_mulai` time ,
 `pertemuan_jam_selesai` time ,
 `jumlah_hadir` decimal(23,0) ,
 `jumlah_tidak_hadir` decimal(23,0) ,
 `total_mahasiswa` bigint(21) 
)*/;

/*Table structure for table `view_krs` */

DROP TABLE IF EXISTS `view_krs`;

/*!50001 DROP VIEW IF EXISTS `view_krs` */;
/*!50001 DROP TABLE IF EXISTS `view_krs` */;

/*!50001 CREATE TABLE  `view_krs`(
 `id_krs` int(11) ,
 `npm` varchar(20) ,
 `id_jadwal` int(11) ,
 `id_dosen` varchar(20) ,
 `id_matakuliah` int(11) ,
 `id_ruangan` int(11) ,
 `nama_kelas` varchar(3) ,
 `jam_mulai` time ,
 `jam_selesai` time ,
 `id_hari` int(1) ,
 `nama_matakuliah` varchar(20) ,
 `nama_ruangan` varchar(32) ,
 `nama_dosen` varchar(32) 
)*/;

/*View structure for view pertemuan_minggu_ini */

/*!50001 DROP TABLE IF EXISTS `pertemuan_minggu_ini` */;
/*!50001 DROP VIEW IF EXISTS `pertemuan_minggu_ini` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pertemuan_minggu_ini` AS select `p`.`id_pertemuan` AS `id_pertemuan`,`p`.`id_jadwal` AS `id_jadwal`,`p`.`pertemuan_ke` AS `pertemuan_ke`,`p`.`id_ruangan` AS `id_ruangan`,`p`.`latitude` AS `latitude`,`p`.`longitude` AS `longitude`,`p`.`id_dosen` AS `id_dosen`,`p`.`detail_pertemuan` AS `detail_pertemuan`,`p`.`tanggal_pertemuan` AS `tanggal_pertemuan`,`p`.`jam_mulai` AS `jam_mulai`,`p`.`jam_selesai` AS `jam_selesai`,sum(if((`a`.`status` = 'hadir'),1,0)) AS `jumlah_hadir`,sum(if((`a`.`status` = 'tidak_hadir'),1,0)) AS `jumlah_tidak_hadir`,count(`a`.`status`) AS `total_mahasiswa` from (`pertemuan` `p` left join `absen` `a` on((`a`.`id_pertemuan` = `p`.`id_pertemuan`))) where (curdate() between (`p`.`tanggal_pertemuan` - interval (dayofweek(`p`.`tanggal_pertemuan`) - 1) day) and (`p`.`tanggal_pertemuan` + interval (7 - dayofweek(`p`.`tanggal_pertemuan`)) day)) group by `p`.`id_pertemuan` */;

/*View structure for view view_jadwal */

/*!50001 DROP TABLE IF EXISTS `view_jadwal` */;
/*!50001 DROP VIEW IF EXISTS `view_jadwal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jadwal` AS select `j`.`id_jadwal` AS `id_jadwal`,`j`.`id_dosen` AS `id_dosen`,`j`.`id_matakuliah` AS `id_matakuliah`,`j`.`id_ruangan` AS `id_ruangan`,`j`.`nama_kelas` AS `nama_kelas`,`j`.`jam_mulai` AS `jam_mulai`,`j`.`jam_selesai` AS `jam_selesai`,`j`.`id_hari` AS `id_hari`,`mk`.`kode_matakuliah` AS `kode_matakuliah`,`mk`.`nama_matakuliah` AS `nama_matakuliah`,`r`.`nama_ruangan` AS `nama_ruangan`,`pi`.`id_pertemuan` AS `id_pertemuan`,`pi`.`pertemuan_ke` AS `pertemuan_ke`,`pi`.`latitude` AS `latitude`,`pi`.`longitude` AS `longitude`,`pi`.`detail_pertemuan` AS `detail_pertemuan`,`pi`.`tanggal_pertemuan` AS `tanggal_pertemuan`,`pi`.`jam_mulai` AS `pertemuan_jam_mulai`,`pi`.`jam_selesai` AS `pertemuan_jam_selesai`,`pi`.`jumlah_hadir` AS `jumlah_hadir`,`pi`.`jumlah_tidak_hadir` AS `jumlah_tidak_hadir`,`pi`.`total_mahasiswa` AS `total_mahasiswa` from (((`jadwal` `j` join `matakuliah` `mk` on((`mk`.`id_matakuliah` = `j`.`id_matakuliah`))) join `ruangan` `r` on((`r`.`id_ruangan` = `j`.`id_ruangan`))) left join `pertemuan_minggu_ini` `pi` on((`pi`.`id_jadwal` = `j`.`id_jadwal`))) */;

/*View structure for view view_krs */

/*!50001 DROP TABLE IF EXISTS `view_krs` */;
/*!50001 DROP VIEW IF EXISTS `view_krs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_krs` AS select `k`.`id_krs` AS `id_krs`,`k`.`npm` AS `npm`,`j`.`id_jadwal` AS `id_jadwal`,`j`.`id_dosen` AS `id_dosen`,`j`.`id_matakuliah` AS `id_matakuliah`,`j`.`id_ruangan` AS `id_ruangan`,`j`.`nama_kelas` AS `nama_kelas`,`j`.`jam_mulai` AS `jam_mulai`,`j`.`jam_selesai` AS `jam_selesai`,`j`.`id_hari` AS `id_hari`,`mk`.`nama_matakuliah` AS `nama_matakuliah`,`r`.`nama_ruangan` AS `nama_ruangan`,`d`.`nama_dosen` AS `nama_dosen` from ((((`krs` `k` join `jadwal` `j` on((`j`.`id_jadwal` = `k`.`id_jadwal`))) join `matakuliah` `mk` on((`mk`.`id_matakuliah` = `j`.`id_matakuliah`))) join `ruangan` `r` on((`r`.`id_ruangan` = `j`.`id_ruangan`))) join `dosen` `d` on((`d`.`id_dosen` = `j`.`id_dosen`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
