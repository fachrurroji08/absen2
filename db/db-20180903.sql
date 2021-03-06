# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.2.13-MariaDB)
# Database: absen2
# Generation Time: 2018-09-03 15:49:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table absen
# ------------------------------------------------------------

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
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `absen` WRITE;
/*!40000 ALTER TABLE `absen` DISABLE KEYS */;

INSERT INTO `absen` (`id_absen`, `id_pertemuan`, `status`, `waktu_absen`, `tanggal_absen`, `latitude`, `longitude`, `npm`)
VALUES
	(4,5,'hadir','22:48:11','2018-09-03',-7.348371,108.231705,'137006107');

/*!40000 ALTER TABLE `absen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nama_admin` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`)
VALUES
	(3,'admin','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re','Administrator');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dosen
# ------------------------------------------------------------

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

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `nidn`, `gelar_depan`, `gelar_belakang`, `jenis_kelamin`, `password`)
VALUES
	('123456789','kamvret','1233522726','Dr.','S.Pd.','L','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
	('20253035','fachrurroji','1122334455','','','L',NULL),
	('23242526','kasep','1222222222','Dr.','S.T','P',NULL);

/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jadwal
# ------------------------------------------------------------

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
  KEY `id_ruangan` (`id_ruangan`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`),
  CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`),
  CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;

INSERT INTO `jadwal` (`id_jadwal`, `id_dosen`, `id_matakuliah`, `id_ruangan`, `nama_kelas`, `jam_mulai`, `jam_selesai`, `id_hari`)
VALUES
	(1,'123456789',1,885234,'a','22:30:00','23:30:00',1),
	(2,'123456789',1,885234,'b','09:01:00','11:00:00',1),
	(3,'20253035',3,885235,'a','13:00:00','15:00:00',1);

/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table krs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `krs`;

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `npm` varchar(20) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `id_jadwal` (`id_jadwal`),
  CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `krs` WRITE;
/*!40000 ALTER TABLE `krs` DISABLE KEYS */;

INSERT INTO `krs` (`id_krs`, `npm`, `id_jadwal`)
VALUES
	(1,'147006256',1),
	(2,'137006107',1),
	(6,'147006256',3),
	(7,'137006107',3);

/*!40000 ALTER TABLE `krs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mahasiswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `npm` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`npm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;

INSERT INTO `mahasiswa` (`npm`, `nama_mahasiswa`, `password`)
VALUES
	('137006106','Haerani11','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
	('137006107','Dede Gunawan','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re'),
	('147006231','Riki Ahmad Fauzi','$2y$10$WP9P75Vgs411ZFcPWUNOhe6m9q8En/1Lr760roA/AFD3e5XtOY/Re');

/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table matakuliah
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah` (
  `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT,
  `kode_matakuliah` varchar(11) DEFAULT NULL,
  `nama_matakuliah` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_matakuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `matakuliah` WRITE;
/*!40000 ALTER TABLE `matakuliah` DISABLE KEYS */;

INSERT INTO `matakuliah` (`id_matakuliah`, `kode_matakuliah`, `nama_matakuliah`)
VALUES
	(1,'klk','Kalkulus'),
	(2,'mtkd','Matematika Diskrit'),
	(3,'alpro','Algotitma dan Pemrograman');

/*!40000 ALTER TABLE `matakuliah` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pertemuan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pertemuan`;

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) DEFAULT NULL,
  `pertemuan_ke` int(2) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `latitude` float(9,6) DEFAULT NULL,
  `longitude` float(9,6) DEFAULT NULL,
  `id_dosen` varchar(20) DEFAULT NULL,
  `detail_pertemuan` longtext DEFAULT NULL,
  `tanggal_pertemuan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `id_jadwal` (`id_jadwal`),
  KEY `id_ruangan` (`id_ruangan`),
  KEY `id_dosen` (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pertemuan` WRITE;
/*!40000 ALTER TABLE `pertemuan` DISABLE KEYS */;

INSERT INTO `pertemuan` (`id_pertemuan`, `id_jadwal`, `pertemuan_ke`, `id_ruangan`, `latitude`, `longitude`, `id_dosen`, `detail_pertemuan`, `tanggal_pertemuan`, `jam_mulai`, `jam_selesai`)
VALUES
	(5,1,1,885234,-7.348383,108.231697,'123456789','Duka Atuh','2018-09-03','21:00:00',NULL);

/*!40000 ALTER TABLE `pertemuan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ruangan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(32) DEFAULT NULL,
  `kapasitas` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `kapasitas`)
VALUES
	(885234,'c12b',25),
	(885235,'sk03',40);

/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table view_krs
# ------------------------------------------------------------

DROP VIEW IF EXISTS `view_krs`;

CREATE TABLE `view_krs` (
   `id_krs` INT(11) NOT NULL DEFAULT '0',
   `npm` VARCHAR(20) NOT NULL,
   `id_jadwal` INT(11) NOT NULL DEFAULT '0',
   `id_dosen` VARCHAR(20) NULL DEFAULT NULL,
   `id_matakuliah` INT(11) NULL DEFAULT NULL,
   `id_ruangan` INT(11) NULL DEFAULT NULL,
   `nama_kelas` VARCHAR(3) NULL DEFAULT NULL,
   `jam_mulai` TIME NULL DEFAULT NULL,
   `jam_selesai` TIME NULL DEFAULT NULL,
   `id_hari` INT(1) NULL DEFAULT NULL,
   `nama_matakuliah` VARCHAR(200) NULL DEFAULT NULL,
   `nama_ruangan` VARCHAR(32) NULL DEFAULT NULL,
   `nama_dosen` VARCHAR(32) NULL DEFAULT NULL
) ENGINE=MyISAM;





# Replace placeholder table for view_krs with correct view syntax
# ------------------------------------------------------------

DROP TABLE `view_krs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_krs`
AS SELECT
   `k`.`id_krs` AS `id_krs`,
   `k`.`npm` AS `npm`,
   `j`.`id_jadwal` AS `id_jadwal`,
   `j`.`id_dosen` AS `id_dosen`,
   `j`.`id_matakuliah` AS `id_matakuliah`,
   `j`.`id_ruangan` AS `id_ruangan`,
   `j`.`nama_kelas` AS `nama_kelas`,
   `j`.`jam_mulai` AS `jam_mulai`,
   `j`.`jam_selesai` AS `jam_selesai`,
   `j`.`id_hari` AS `id_hari`,
   `mk`.`nama_matakuliah` AS `nama_matakuliah`,
   `r`.`nama_ruangan` AS `nama_ruangan`,
   `d`.`nama_dosen` AS `nama_dosen`
FROM ((((`krs` `k` join `jadwal` `j` on(`j`.`id_jadwal` = `k`.`id_jadwal`)) join `matakuliah` `mk` on(`mk`.`id_matakuliah` = `j`.`id_matakuliah`)) join `ruangan` `r` on(`r`.`id_ruangan` = `j`.`id_ruangan`)) join `dosen` `d` on(`d`.`id_dosen` = `j`.`id_dosen`));

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
