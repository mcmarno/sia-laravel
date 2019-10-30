/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.21 : Database - larasiadb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`larasiadb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `larasiadb`;

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `dsnNidn` int(11) NOT NULL,
  `dsnNip` int(11) DEFAULT NULL,
  `dsnNama` varchar(60) DEFAULT NULL,
  `dsnJenisKelamin` varchar(12) DEFAULT NULL,
  `dsnNoTelp` int(12) DEFAULT NULL,
  `dsnAlamat` varchar(100) DEFAULT NULL,
  `dsnProdiKode` int(11) DEFAULT NULL,
  `photo` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`dsnNidn`),
  UNIQUE KEY `dsnNip_UNIQUE` (`dsnNip`),
  KEY `fk_dosen_1_idx` (`dsnProdiKode`),
  CONSTRAINT `fk_dosen_1` FOREIGN KEY (`dsnProdiKode`) REFERENCES `program_studi` (`prodiKode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(dsnNidn,dsnNip,dsnNama,dsnJenisKelamin,dsnNoTelp,dsnAlamat,dsnProdiKode,photo) values (1111111111,2147483647,'aaaaaaaaa','Laki - Laki',11111111,'aaaaaaaa',1,'2019-06-19.a.png');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `klsId` int(11) NOT NULL AUTO_INCREMENT,
  `klsMkKurId` int(11) DEFAULT NULL,
  `klsDsnNidn` int(11) DEFAULT NULL,
  `klsSempId` int(11) DEFAULT NULL,
  `klsNama` varchar(20) DEFAULT NULL,
  `klsGolongan` varchar(10) DEFAULT NULL,
  `perSatu` date DEFAULT NULL,
  `perDua` date DEFAULT NULL,
  `perTiga` date DEFAULT NULL,
  `perEmpat` date DEFAULT NULL,
  `perLima` date DEFAULT NULL,
  `perEnam` date DEFAULT NULL,
  `perTujuh` date DEFAULT NULL,
  `perDelapan` date DEFAULT NULL,
  `perSembilan` date DEFAULT NULL,
  `perSepuluh` date DEFAULT NULL,
  `perSebelas` date DEFAULT NULL,
  `perDuabelas` date DEFAULT NULL,
  `uts` date DEFAULT NULL,
  `uas` date DEFAULT NULL,
  PRIMARY KEY (`klsId`),
  KEY `fk_kelas_1_idx` (`klsMkKurId`),
  KEY `fk_kelas_2_idx` (`klsDsnNidn`),
  KEY `fk_kelas_3_idx` (`klsSempId`),
  CONSTRAINT `fk_kelas_1` FOREIGN KEY (`klsMkKurId`) REFERENCES `matakuliah_kurikulum` (`mkkurId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kelas_2` FOREIGN KEY (`klsDsnNidn`) REFERENCES `dosen` (`dsnNidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kelas_3` FOREIGN KEY (`klsSempId`) REFERENCES `semester_prodi` (`sempId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(klsId,klsMkKurId,klsDsnNidn,klsSempId,klsNama,klsGolongan,perSatu,perDua,perTiga,perEmpat,perLima,perEnam,perTujuh,perDelapan,perSembilan,perSepuluh,perSebelas,perDuabelas,uts,uas) values (4,1,1111111111,38,'MI4','KPT','2000-12-21','2019-10-01','2019-10-01','2019-10-03','2019-10-04','2019-10-11','2019-10-03','2019-10-10','2019-10-04','2019-10-05','2019-10-05','2019-10-15','2019-10-18','2019-10-26'),(5,2,1111111111,38,'MI4','KPT','2000-12-21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,3,1111111111,40,'MI4','KPT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `kode_nilai` */

DROP TABLE IF EXISTS `kode_nilai`;

CREATE TABLE `kode_nilai` (
  `kdnlId` varchar(1) NOT NULL,
  `kdnlBobot` int(11) DEFAULT NULL,
  `kdnlRangeBawah` int(11) DEFAULT NULL,
  `kdnlRangeAtas` int(11) DEFAULT NULL,
  PRIMARY KEY (`kdnlId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kode_nilai` */

insert  into `kode_nilai`(kdnlId,kdnlBobot,kdnlRangeBawah,kdnlRangeAtas) values ('A',4,80,100),('B',3,70,79),('C',2,60,69),('D',1,40,59),('E',0,0,39);

/*Table structure for table `krs` */

DROP TABLE IF EXISTS `krs`;

CREATE TABLE `krs` (
  `krsId` int(11) NOT NULL AUTO_INCREMENT,
  `krsSempId` int(11) DEFAULT NULL,
  `krsNim` varchar(45) DEFAULT NULL,
  `krsPaketSem` tinyint(4) DEFAULT NULL,
  `krsTglTransaksi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`krsId`),
  KEY `fk_krs_1_idx` (`krsNim`),
  KEY `fk_krs_2_idx` (`krsSempId`),
  CONSTRAINT `fk_krs_1` FOREIGN KEY (`krsNim`) REFERENCES `mahasiswa` (`mhsNim`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_krs_2` FOREIGN KEY (`krsSempId`) REFERENCES `semester_prodi` (`sempId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `krs` */

insert  into `krs`(krsId,krsSempId,krsNim,krsPaketSem,krsTglTransaksi) values (4,38,'111111111',1,'2019-07-06'),(5,40,'111111111',2,'2019-07-17'),(6,38,'111111111',3,'2019-10-28');

/*Table structure for table `krs_detail` */

DROP TABLE IF EXISTS `krs_detail`;

CREATE TABLE `krs_detail` (
  `krsdtId` int(11) NOT NULL AUTO_INCREMENT,
  `krsdtKrsId` int(11) DEFAULT NULL,
  `krsdtBobotNilai` int(3) DEFAULT NULL,
  `krsdtKodeNilai` varchar(1) DEFAULT NULL,
  `krsKlsId` int(11) DEFAULT NULL,
  PRIMARY KEY (`krsdtId`),
  KEY `fk_krs_detail_1_idx` (`krsdtKrsId`),
  KEY `fk_krs_detail_2_idx` (`krsKlsId`),
  CONSTRAINT `fk_krs_detail_1` FOREIGN KEY (`krsdtKrsId`) REFERENCES `krs` (`krsId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_krs_detail_2` FOREIGN KEY (`krsKlsId`) REFERENCES `kelas` (`klsId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `krs_detail` */

insert  into `krs_detail`(krsdtId,krsdtKrsId,krsdtBobotNilai,krsdtKodeNilai,krsKlsId) values (4,4,NULL,NULL,4),(5,5,NULL,NULL,6),(6,4,NULL,NULL,5);

/*Table structure for table `krs_nilai` */

DROP TABLE IF EXISTS `krs_nilai`;

CREATE TABLE `krs_nilai` (
  `krsnaId` int(11) NOT NULL AUTO_INCREMENT,
  `krsnaKrsDtId` int(11) DEFAULT NULL,
  `krsnaNilaiTugas` int(11) DEFAULT NULL,
  `krsnaNilaiUTS` int(11) DEFAULT NULL,
  `krsnaNilaiUAS` int(11) DEFAULT NULL,
  PRIMARY KEY (`krsnaId`),
  KEY `fk_krs_nilai_1_idx` (`krsnaKrsDtId`),
  CONSTRAINT `fk_krs_nilai_1` FOREIGN KEY (`krsnaKrsDtId`) REFERENCES `krs_detail` (`krsdtId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `krs_nilai` */

/*Table structure for table `kurikulum` */

DROP TABLE IF EXISTS `kurikulum`;

CREATE TABLE `kurikulum` (
  `kurId` int(11) NOT NULL,
  `kurProdiKode` int(11) DEFAULT NULL,
  `kurTahun` int(11) DEFAULT NULL,
  `kurNama` varchar(45) DEFAULT NULL,
  `kurNoSkRektor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`kurId`),
  KEY `fk_kurikulum_1_idx` (`kurProdiKode`),
  CONSTRAINT `fk_kurikulum_1` FOREIGN KEY (`kurProdiKode`) REFERENCES `program_studi` (`prodiKode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kurikulum` */

insert  into `kurikulum`(kurId,kurProdiKode,kurTahun,kurNama,kurNoSkRektor) values (1,1,2010,'kk2010','kk/2010');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `mhsNomerPendaftaran` varchar(15) DEFAULT NULL,
  `mhsNik` varchar(16) DEFAULT NULL,
  `mhsNim` varchar(15) NOT NULL,
  `mhsNama` varchar(60) DEFAULT NULL,
  `mhsJenisKelamin` varchar(12) DEFAULT NULL,
  `mhsAgama` varchar(10) DEFAULT NULL,
  `mhsTempatLahir` varchar(30) DEFAULT NULL,
  `mhsTanggalLahir` date DEFAULT NULL,
  `mhsAlamat` varchar(60) DEFAULT NULL,
  `mhsNoTelp` int(13) DEFAULT NULL,
  `mhsStatusNikah` varchar(20) DEFAULT NULL,
  `mhsProdiKode` int(11) DEFAULT NULL,
  `mhsAngkatan` int(11) DEFAULT NULL,
  `mhsKurId` varchar(45) DEFAULT NULL,
  `mhsGolongan` varchar(10) DEFAULT NULL,
  `mhsKelompok` varchar(10) DEFAULT NULL COMMENT 'Kelompok ini mirip ID kelas',
  `mhsAsalSekolah` varchar(30) DEFAULT NULL,
  `mhsNamaOrtu` varchar(60) DEFAULT NULL,
  `mhsAlamatOrtu` varchar(60) DEFAULT NULL,
  `mhsPekerjaanOrtu` varchar(30) DEFAULT NULL,
  `mhsStatusAktif` tinyint(1) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`mhsNim`),
  KEY `fk_mahasiswa_1_idx` (`mhsProdiKode`),
  CONSTRAINT `fk_mahasiswa_1` FOREIGN KEY (`mhsProdiKode`) REFERENCES `program_studi` (`prodiKode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(mhsNomerPendaftaran,mhsNik,mhsNim,mhsNama,mhsJenisKelamin,mhsAgama,mhsTempatLahir,mhsTanggalLahir,mhsAlamat,mhsNoTelp,mhsStatusNikah,mhsProdiKode,mhsAngkatan,mhsKurId,mhsGolongan,mhsKelompok,mhsAsalSekolah,mhsNamaOrtu,mhsAlamatOrtu,mhsPekerjaanOrtu,mhsStatusAktif,photo) values ('1111111111','1111111','111111111','aaaaaaa','Laki - Laki','Islam','aaaa','2019-06-13','aaaaaaaaaaa',2147483647,'Nikah',1,1221,'1','KPT','MI4','aaaaaaaaa','aaaaaaaaa','aaaaaaa','aaaaaaa',1,'2019-06-19.IMG_8088.JPG');

/*Table structure for table `matakuliah_kurikulum` */

DROP TABLE IF EXISTS `matakuliah_kurikulum`;

CREATE TABLE `matakuliah_kurikulum` (
  `mkkurId` int(11) NOT NULL AUTO_INCREMENT,
  `mkkurKode` varchar(45) DEFAULT NULL,
  `mkkurNama` varchar(45) DEFAULT NULL,
  `mkkurKurId` int(11) DEFAULT NULL,
  `mkkurSemester` int(2) DEFAULT NULL,
  `mkkurJumlahSks` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`mkkurId`),
  KEY `fk_matakuliah_kurikulum_1_idx` (`mkkurKurId`),
  CONSTRAINT `fk_matakuliah_kurikulum_1` FOREIGN KEY (`mkkurKurId`) REFERENCES `kurikulum` (`kurId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `matakuliah_kurikulum` */

insert  into `matakuliah_kurikulum`(mkkurId,mkkurKode,mkkurNama,mkkurKurId,mkkurSemester,mkkurJumlahSks) values (1,'mI1','s',1,1,3),(2,'MI5','mkff',1,1,3),(3,'MI6','aaaa',1,2,2);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `program_studi` */

DROP TABLE IF EXISTS `program_studi`;

CREATE TABLE `program_studi` (
  `prodiKode` int(11) NOT NULL,
  `prodiNama` varchar(45) DEFAULT NULL,
  `prodiJjarKode` varchar(10) DEFAULT NULL,
  `prodiKodeLabel` varchar(4) NOT NULL,
  PRIMARY KEY (`prodiKode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `program_studi` */

insert  into `program_studi`(prodiKode,prodiNama,prodiJjarKode,prodiKodeLabel) values (1,'MANAJEMEN INFORMATIKA','DIPLOMA 3','MI'),(2,'TEKNIK MESIN','SARJANA','TM');

/*Table structure for table `semester` */

DROP TABLE IF EXISTS `semester`;

CREATE TABLE `semester` (
  `semId` int(11) NOT NULL,
  `semTglMulai` date DEFAULT NULL,
  `semTglSelesai` date DEFAULT NULL,
  `semTahun` varchar(11) DEFAULT NULL,
  `semNmSmtId` tinyint(4) DEFAULT NULL,
  `semStatus` int(1) DEFAULT NULL,
  `semKeterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`semId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `semester` */

insert  into `semester`(semId,semTglMulai,semTglSelesai,semTahun,semNmSmtId,semStatus,semKeterangan) values (1,'2019-07-06','2019-10-05','2019',2,1,'a'),(12,'2019-07-18','2019-07-27','2019',2,0,'aa');

/*Table structure for table `semester_prodi` */

DROP TABLE IF EXISTS `semester_prodi`;

CREATE TABLE `semester_prodi` (
  `sempId` int(11) NOT NULL AUTO_INCREMENT,
  `sempSemId` int(11) DEFAULT NULL,
  `sempTglMulaiKrs` date DEFAULT NULL,
  `sempTglSelesaiKrs` date DEFAULT NULL,
  `sempTglMulaiInputNilai` date DEFAULT NULL,
  `sempTglSelesaiInputNilai` date DEFAULT NULL,
  `sempIsAktif` tinyint(4) DEFAULT '0',
  `semProdiKode` int(11) DEFAULT NULL,
  PRIMARY KEY (`sempId`),
  KEY `fk_semester_prodi_1_idx` (`sempSemId`),
  KEY `fk_semester_prodi_2_idx` (`semProdiKode`),
  CONSTRAINT `fk_semester_prodi_1` FOREIGN KEY (`sempSemId`) REFERENCES `semester` (`semId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_semester_prodi_2` FOREIGN KEY (`semProdiKode`) REFERENCES `program_studi` (`prodiKode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `semester_prodi` */

insert  into `semester_prodi`(sempId,sempSemId,sempTglMulaiKrs,sempTglSelesaiKrs,sempTglMulaiInputNilai,sempTglSelesaiInputNilai,sempIsAktif,semProdiKode) values (36,NULL,'2019-07-06','2019-07-20','2019-10-26','2019-11-23',0,1),(37,NULL,'2019-07-06','2019-07-20','2019-10-26','2019-11-23',0,2),(38,1,'2019-07-06','2019-07-20','2019-10-26','2019-11-23',1,1),(39,1,'2019-07-06','2019-07-20','2019-10-26','2019-11-23',1,2),(40,12,'2019-07-17','2019-07-31','2019-11-06','2019-12-04',0,1),(41,12,'2019-07-17','2019-07-31','2019-11-06','2019-12-04',0,2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(id,name,username,email,password,remember_token,created_at,updated_at,level) values (4,'admin','admin','admin@gmail.com','$2y$10$/ksTXyJ2EAyzjliAkonhnewNjNj3BX8e3gnJgmVIso2Up8ydeA/cy','lkTigMInE0Km5OVPWd8cV9LGHksIktzLRa8H4YrXqyY4LdvkSUMy7bvWnc81','2016-03-03 10:35:28','2019-10-30 16:07:22',1),(74,'','11220109','','$2y$10$1DiYeDf4DEvBWpj3Qh2zheBcwA7P/NyrygnmhvOYMcZ3gPOD4aZS.','WjmahFfF4ESA93m96BlkqBRs0FHagQ8RH13Z9yODwwfPpmGdn3Cuu11oTAX4','2016-08-21 10:21:21','2016-08-27 17:14:04',2),(78,'','M.09.15.01','','$2y$10$YRXWOgIcudTAn0lwhDN7eupqrV0Jp1DLnEujC9CPP5GeWFl/EXlzO','GAmLerVoOYwCTE0T4vYdwTLH1NRUEkIkEZhMeam8Tp4iJ4nJ8pxDdoCBW58b','2016-08-27 17:15:36','2018-11-27 03:47:01',3),(79,'','M.09.15.05','','$2y$10$2hUsHLdNQ7n9ZAmeRHnoreCRbAJf8LTERztCSVngmDXTCzlgKd8WG',NULL,'2018-11-27 04:11:29','2018-11-27 04:11:29',3),(80,'','17','','$2y$10$bPBCfaRwhw4G93tQyahNlOVM7leXDNTVfnnfbmlGK7o/xp0QVZmwe','odsJ8xVQJ3zoEGmzJN5jKk3j6OvMEq1X3dlB6ezBHclL4B6BzABRbnBosZdt','2018-12-15 11:55:01','2018-12-15 11:56:07',2),(81,'','987654321','','$2y$10$rEAmtL728KDPoywD.i4i8u3D9i9HZg8achPfna45I3u2ijjmB0GGO','InJRadjdVXLvorYh8SdfTiQR16KxhxYosxHeCfPbx5HYYjrjsH7ue0IDGC8K','2019-01-02 12:40:35','2019-02-08 16:14:27',2),(82,'','1540033023','','$2y$10$9TYdMooFvDHqxNe9h52nU./oLvOyqOGSoriX3uZiu54LZjh6cpYBC','12uFJeBH5RYzQWL6bB25KZuJCKjZ23EHmGJxvpCyXp5DROD7oOIkdsY4b2TR','2019-01-25 06:48:59','2019-02-24 12:09:30',3),(86,'','123','','$2y$10$xbJcDAfs3H5GFQca.YXpZ.aGL7RYBjhx2z/NmMh.RewBjnVSfcP7e','C7FzwK95m5EwLvdbGesUu8UfS5P5cYc2wObzBmnFgaLrY0K8Z7mxsJUYTUg4','2019-02-08 15:55:52','2019-02-24 12:12:10',2),(87,'','1','','$2y$10$bAG1XmKGTuIBSu.XdDZneeab0WglOm7bjbCIRxgOmscduMJvdUgie','Koy1wer5gxI51A5qCmIAP0m6D7PV2iCBWugEHiKOqWmDCmI8UdoNejUEWqRX','2019-02-08 17:24:40','2019-04-04 14:19:10',2),(95,'','111111111','','$2y$10$IQf10TPUMcK/j.1zSl0mEOgmgN487rE033d7lfX6IMKItvCD5R0Ha','nzXGlHQg8JqRmEJn3dmWGKy9kpIguErIBmOZCu9arAkbM70AFKXU7QON6brT','2019-10-29 14:50:22','2019-10-30 16:06:42',3),(97,'','2147483647','','$2y$10$KWxgNqqGZptbKw29KuM60.D1T/jb6waLtMiwqtmmVgrlP5Minzwpe','QamsBlUWTECJHZOQpBTZ0SS0IQUYA7rzcpBfWdzQPxeRbD4mIvmOwatUoPId','2019-10-29 14:55:09','2019-10-30 16:22:28',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
