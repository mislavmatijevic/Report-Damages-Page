-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: WebDiP2020x057
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dnevnik`
--

DROP TABLE IF EXISTS `dnevnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dnevnik` (
  `id_dnevnik` int NOT NULL AUTO_INCREMENT,
  `url` varchar(45) NOT NULL,
  `datum_vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upit` text,
  `opis_radnje` text,
  `id_radnja` int NOT NULL,
  `id_izvrsitelj` int NOT NULL,
  PRIMARY KEY (`id_dnevnik`),
  KEY `fk_dnevnik_tip_radnje1_idx` (`id_radnja`),
  KEY `fk_dnevnik_korisnik1_idx` (`id_izvrsitelj`),
  CONSTRAINT `fk_dnevnik_korisnik` FOREIGN KEY (`id_izvrsitelj`) REFERENCES `korisnik` (`id_korisnik`),
  CONSTRAINT `fk_dnevnik_tip_radnje` FOREIGN KEY (`id_radnja`) REFERENCES `tip_radnje` (`id_tip`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dnevnik`
--

LOCK TABLES `dnevnik` WRITE;
/*!40000 ALTER TABLE `dnevnik` DISABLE KEYS */;
INSERT INTO `dnevnik` VALUES (1,'/index.php','2021-06-08 22:53:08','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(4,'/donate.php','2021-06-08 23:45:32','UPDATE javni_poziv SET skupljeno_sredstava = 1500.5 WHERE id_javni_poziv = 1; INSERT INTO `WebDiP2020x057`.`donacije` (`iznos`, `id_javni_poziv`, `id_donator`) VALUES (1500.5, 1, 1)','Korisnik Mislav donirao je 1500.5 HRK za javni poziv s oznakom 1.',7,1),(5,'/logout.php','2021-06-08 23:46:50',NULL,'Korisnik mmatijevi se odjavio.',2,1),(6,'/index.php','2021-06-09 09:51:39','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(7,'/logout.php','2021-06-09 09:51:41',NULL,'Korisnik mmatijevi se odjavio.',2,1),(8,'/index.php','2021-06-09 11:39:55','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(9,'/logout.php','2021-06-09 11:40:24',NULL,'Korisnik mmatijevi se odjavio.',2,1),(10,'/index.php','2021-06-09 11:40:36','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(11,'/logout.php','2021-06-09 11:43:49',NULL,'Korisnik mmatijevi se odjavio.',2,1),(12,'/index.php','2021-06-09 11:46:37','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(13,'/logout.php','2021-06-09 11:57:39',NULL,'Korisnik mmatijevi se odjavio.',2,1),(14,'/index.php','2021-06-09 11:57:46','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(15,'/index.php','2021-06-09 11:59:21','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(16,'/logout.php','2021-06-09 11:59:32',NULL,'Korisnik mmatijevi se odjavio.',2,1),(17,'/index.php','2021-06-09 11:59:34','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(18,'/logout.php','2021-06-09 11:59:38',NULL,'Korisnik mmatijevi se odjavio.',2,1),(19,'/index.php','2021-06-09 11:59:39','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(20,'/logout.php','2021-06-09 11:59:43',NULL,'Korisnik mmatijevi se odjavio.',2,1),(21,'/index.php','2021-06-09 12:22:08','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(22,'/logout.php','2021-06-09 12:42:02',NULL,'Korisnik mmatijevi se odjavio.',2,1),(23,'/index.php','2021-06-09 12:44:13','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(24,'/logout.php','2021-06-09 12:44:15',NULL,'Korisnik mmatijevi se odjavio.',2,1),(25,'/index.php','2021-06-09 12:44:23','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(26,'/logout.php','2021-06-09 13:15:33',NULL,'Korisnik mmatijevi se odjavio.',2,1),(27,'/index.php','2021-06-09 13:15:41','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(28,'/index.php','2021-06-09 15:10:01','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 2','Prijavio se korisnik aanic2.',1,2),(29,'/logout.php','2021-06-09 15:10:04',NULL,'Korisnik aanic2 se odjavio.',2,2),(30,'/index.php','2021-06-09 15:10:05','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(31,'/login-page.php','2021-06-09 16:38:27','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(32,'/block-user.php','2021-06-09 17:09:57','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(33,'/block-user.php','2021-06-09 17:10:02','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(34,'/block-user.php','2021-06-09 17:10:03','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(35,'/block-user.php','2021-06-09 17:11:09','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = gga','Blokiran je korisnik gga.',14,1),(36,'/block-user.php','2021-06-09 17:11:09','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = gga','Blokiran je korisnik gga.',14,1),(37,'/block-user.php','2021-06-09 17:11:23','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = gga','Blokiran je korisnik gga.',14,1),(38,'/block-user.php','2021-06-09 17:11:29','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = gga','Blokiran je korisnik gga.',14,1),(39,'/block-user.php','2021-06-09 17:25:24','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(40,'/block-user.php','2021-06-09 17:26:00','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(41,'/block-user.php','2021-06-09 17:26:04','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(42,'/block-user.php','2021-06-09 17:26:27','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(43,'/block-user.php','2021-06-09 17:26:55','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(44,'/block-user.php','2021-06-09 17:27:01','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(45,'/block-user.php','2021-06-09 17:27:19','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(46,'/block-user.php','2021-06-09 17:27:30','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(47,'/block-user.php','2021-06-09 17:27:34','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(48,'/block-user.php','2021-06-09 17:27:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(49,'/block-user.php','2021-06-09 17:27:42','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(50,'/block-user.php','2021-06-09 17:27:49','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(51,'/block-user.php','2021-06-09 17:27:57','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(52,'/block-user.php','2021-06-09 17:28:03','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(53,'/block-user.php','2021-06-09 17:28:03','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(54,'/block-user.php','2021-06-09 17:28:04','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(55,'/block-user.php','2021-06-09 17:28:04','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(56,'/block-user.php','2021-06-09 17:28:04','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = &lt;br&gt;','Blokiran je korisnik &lt;br&gt;.',14,1),(57,'/block-user.php','2021-06-09 17:28:49','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(58,'/block-user.php','2021-06-09 17:28:51','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(59,'/block-user.php','2021-06-09 17:28:55','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(60,'/block-user.php','2021-06-09 17:28:56','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(61,'/block-user.php','2021-06-09 17:29:05','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(62,'/block-user.php','2021-06-09 17:29:08','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(63,'/block-user.php','2021-06-09 17:30:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(64,'/block-user.php','2021-06-09 17:30:36','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(65,'/block-user.php','2021-06-09 17:30:38','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(66,'/block-user.php','2021-06-09 17:30:39','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(67,'/block-user.php','2021-06-09 17:30:39','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mnizic','Blokiran je korisnik mnizic.',14,1),(68,'/logout.php','2021-06-09 17:30:43',NULL,'Korisnik mmatijevi se odjavio.',2,1),(69,'/index.php','2021-06-09 17:32:07','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(70,'/block-user.php','2021-06-09 17:34:30','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = alovric','Blokiran je korisnik alovric.',14,1),(71,'/block-user.php','2021-06-09 17:34:33','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(72,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(73,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(74,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(75,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(76,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(77,'/block-user.php','2021-06-09 17:34:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = mmustac','Blokiran je korisnik mmustac.',14,1),(78,'/block-user.php','2021-06-09 17:34:49','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggaravi','Blokiran je korisnik ggaravi.',14,1),(79,'/block-user.php','2021-06-09 17:34:54','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = goran2','Blokiran je korisnik goran2.',14,1),(80,'/block-user.php','2021-06-09 17:34:55','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = goran2','Blokiran je korisnik goran2.',14,1),(81,'/block-user.php','2021-06-09 17:34:58','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = goran2','Blokiran je korisnik goran2.',14,1),(82,'/block-user.php','2021-06-09 17:35:04','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ggoric','Blokiran je korisnik ggoric.',14,1),(83,'/block-user.php','2021-06-09 17:35:13','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = anica2','Blokiran je korisnik anica2.',14,1),(84,'/block-user.php','2021-06-09 17:35:17','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic','Blokiran je korisnik aanic.',14,1),(85,'/block-user.php','2021-06-09 17:35:18','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic','Blokiran je korisnik aanic.',14,1),(86,'/block-user.php','2021-06-09 17:35:19','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(87,'/logout.php','2021-06-09 17:35:22',NULL,'Korisnik mmatijevi se odjavio.',2,1),(88,'/index.php','2021-06-09 17:35:26','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(89,'/block-user.php','2021-06-09 17:35:29','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(90,'/logout.php','2021-06-09 17:35:32',NULL,'Korisnik mmatijevi se odjavio.',2,1),(91,'/index.php','2021-06-09 17:35:33','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 2','Prijavio se korisnik aanic2.',1,2),(92,'/logout.php','2021-06-09 17:35:34',NULL,'Korisnik aanic2 se odjavio.',2,2),(93,'/index.php','2021-06-09 17:35:36','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(94,'/config.php','2021-06-09 19:57:50','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(virtualTimeOffsetSeconds) 0 -> 0',22,1),(95,'/config.php','2021-06-09 19:57:54','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(virtualTimeOffsetSeconds) 0 -> 0',22,1),(96,'/config.php','2021-06-09 19:57:56','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(virtualTimeOffsetSeconds) 0 -> 0',22,1),(97,'/block-user.php','2021-06-09 20:03:50','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(98,'/block-user.php','2021-06-09 20:03:52','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(99,'/block-user.php','2021-06-09 20:03:56','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(100,'/block-user.php','2021-06-09 20:04:18','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(101,'/block-user.php','2021-06-09 20:04:33','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(102,'/block-user.php','2021-06-09 20:04:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(103,'/block-user.php','2021-06-09 20:04:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(104,'/block-user.php','2021-06-09 20:04:35','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(105,'/block-user.php','2021-06-09 20:05:16','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(106,'/block-user.php','2021-06-09 20:05:19','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(107,'/block-user.php','2021-06-09 20:05:21','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(108,'/block-user.php','2021-06-09 20:05:23','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(109,'/block-user.php','2021-06-09 20:05:25','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(110,'/block-user.php','2021-06-09 20:06:34','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(111,'/block-user.php','2021-06-09 20:07:52','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(112,'/block-user.php','2021-06-09 20:07:58','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(113,'/block-user.php','2021-06-09 20:08:10','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanica2','Blokiran je korisnik aanica2.',14,1),(114,'/block-user.php','2021-06-09 20:10:47','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(115,'/block-user.php','2021-06-09 20:10:55','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(116,'/block-user.php','2021-06-09 20:10:58','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(117,'/block-user.php','2021-06-09 20:10:59','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(118,'/block-user.php','2021-06-09 20:10:59','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(119,'/block-user.php','2021-06-09 20:11:02','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(120,'/block-user.php','2021-06-09 20:11:07','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(121,'/block-user.php','2021-06-09 20:14:17','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(122,'/block-user.php','2021-06-09 20:14:19','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(123,'/block-user.php','2021-06-09 20:14:42','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(124,'/block-user.php','2021-06-09 20:14:48','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = 1, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(125,'/block-user.php','2021-06-09 20:14:50','UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = , `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = aanic2','Blokiran je korisnik aanic2.',14,1),(126,'/config.php','2021-06-09 20:22:18','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxSessionLengthMinutes) 1200 -> 1210',22,1),(127,'/config.php','2021-06-09 20:25:44','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxFailedLogins) 3 -> 5\n(maxHoursToAccept) 14 -> 15\n(maxItemsPerPage) 10 -> 15\n(cookieDurationDays) 7 -> 5',22,1),(128,'/config.php','2021-06-09 20:26:22','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxFailedLogins) 5 -> 3\n(maxHoursToAccept) 15 -> 14\n(maxItemsPerPage) 15 -> 10\n(cookieDurationDays) 5 -> 7\n(maxSessionLengthMinutes) 1210 -> 1200',22,1),(129,'/config.php','2021-06-09 22:00:36','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:',22,1),(130,'/logout.php','2021-06-09 23:51:49',NULL,'Korisnik mmatijevi se odjavio.',2,1),(131,'/retrieve-logs.php','2021-06-10 14:49:55','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(132,'/retrieve-logs.php','2021-06-10 14:50:09','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(133,'/retrieve-logs.php','2021-06-10 14:50:21','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(134,'/retrieve-logs.php','2021-06-10 14:50:31','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(135,'/retrieve-logs.php','2021-06-10 14:50:42','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(136,'/retrieve-logs.php','2021-06-10 14:50:53','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(137,'/retrieve-logs.php','2021-06-10 14:51:07','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(138,'/retrieve-logs.php','2021-06-10 14:51:07','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(139,'/retrieve-logs.php','2021-06-10 14:51:16','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(140,'/retrieve-logs.php','2021-06-10 14:51:17','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(141,'/retrieve-logs.php','2021-06-10 14:51:20','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(142,'/retrieve-logs.php','2021-06-10 14:51:21','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(143,'/retrieve-logs.php','2021-06-10 14:51:23','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(144,'/retrieve-logs.php','2021-06-10 14:51:37','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(145,'/retrieve-logs.php','2021-06-10 14:52:23','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(146,'/retrieve-logs.php','2021-06-10 14:52:33','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(147,'/retrieve-logs.php','2021-06-10 14:52:38','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(148,'/retrieve-logs.php','2021-06-10 14:52:44','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(149,'/retrieve-logs.php','2021-06-10 14:52:51','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(150,'/retrieve-logs.php','2021-06-10 14:52:58','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(151,'/retrieve-logs.php','2021-06-10 14:53:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(152,'/retrieve-logs.php','2021-06-10 14:53:08','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(153,'/retrieve-logs.php','2021-06-10 14:58:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(154,'/retrieve-logs.php','2021-06-10 14:58:54','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(155,'/retrieve-logs.php','2021-06-10 14:58:56','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(156,'/retrieve-logs.php','2021-06-10 14:58:57','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(157,'/retrieve-logs.php','2021-06-10 14:59:00','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(158,'/retrieve-logs.php','2021-06-10 14:59:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(159,'/retrieve-logs.php','2021-06-10 14:59:10','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(160,'/retrieve-logs.php','2021-06-10 14:59:27','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(161,'/retrieve-logs.php','2021-06-10 14:59:30','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(162,'/retrieve-logs.php','2021-06-10 14:59:32','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(163,'/retrieve-logs.php','2021-06-10 14:59:34','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(164,'/retrieve-logs.php','2021-06-10 14:59:36','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(165,'/retrieve-logs.php','2021-06-10 14:59:37','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(166,'/retrieve-logs.php','2021-06-10 14:59:40','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(167,'/retrieve-logs.php','2021-06-10 15:03:00','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(168,'/retrieve-logs.php','2021-06-10 15:03:14','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(169,'/retrieve-logs.php','2021-06-10 15:03:35','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(170,'/retrieve-logs.php','2021-06-10 15:05:07','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(171,'/retrieve-logs.php','2021-06-10 15:05:14','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(172,'/index.php','2021-06-10 15:05:17','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(173,'/config.php','2021-06-10 15:52:03','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 15',22,1),(174,'/config.php','2021-06-10 15:56:43','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 15 -> 10',22,1),(175,'/config.php','2021-06-10 15:56:53','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 15',22,1),(176,'/config.php','2021-06-10 15:57:00','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 15 -> -9',22,1),(177,'/config.php','2021-06-10 15:57:04','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) -9 -> 1',22,1),(178,'/config.php','2021-06-10 15:57:07','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 1 -> 38',22,1),(179,'/config.php','2021-06-10 15:57:13','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 38 -> 10',22,1),(180,'/config.php','2021-06-10 15:57:30','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 8',22,1),(181,'/config.php','2021-06-10 15:57:39','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 8 -> 16',22,1),(182,'/config.php','2021-06-10 15:58:22','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 16 -> 4',22,1),(183,'/config.php','2021-06-10 15:58:28','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 4 -> 32',22,1),(184,'/config.php','2021-06-10 15:58:35','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 32 -> 10',22,1),(185,'/config.php','2021-06-10 15:58:40','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 12',22,1),(186,'/config.php','2021-06-10 15:58:58','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 12 -> 15',22,1),(187,'/config.php','2021-06-10 15:59:07','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 15 -> 20',22,1),(188,'/config.php','2021-06-10 15:59:16','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 20 -> 10',22,1),(189,'/config.php','2021-06-10 15:59:52','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 8',22,1),(190,'/config.php','2021-06-10 16:00:00','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 8 -> 10',22,1),(191,'/config.php','2021-06-10 16:00:50','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 10 -> 15',22,1),(192,'/config.php','2021-06-10 16:01:46','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 15 -> 19',22,1),(193,'/config.php','2021-06-10 16:01:59','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 19 -> 15',22,1),(194,'/config.php','2021-06-10 16:02:03','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 15 -> 25',22,1),(195,'/config.php','2021-06-10 16:02:11','','Promijenjene su konfiguracijske postavke sljedećim vrijednostima:\n(maxItemsPerPage) 25 -> 10',22,1),(196,'/index.php','2021-06-10 16:42:29','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(197,'/retrieve-logs.php','2021-06-10 16:46:58','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(198,'/retrieve-logs.php','2021-06-10 16:46:58','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(199,'/retrieve-logs.php','2021-06-10 17:07:09','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(200,'/retrieve-logs.php','2021-06-10 17:07:09','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(201,'/retrieve-logs.php','2021-06-10 17:07:13','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(202,'/retrieve-logs.php','2021-06-10 17:07:13','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(203,'/retrieve-logs.php','2021-06-10 17:07:17','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(204,'/retrieve-logs.php','2021-06-10 17:07:17','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(205,'/retrieve-logs.php','2021-06-10 17:14:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(206,'/retrieve-logs.php','2021-06-10 17:14:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(207,'/retrieve-logs.php','2021-06-10 17:14:55','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(208,'/retrieve-logs.php','2021-06-10 17:14:56','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(209,'/retrieve-logs.php','2021-06-10 17:16:45','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(210,'/retrieve-logs.php','2021-06-10 17:16:45','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(211,'/retrieve-logs.php','2021-06-10 17:16:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(212,'/retrieve-logs.php','2021-06-10 17:16:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(213,'/retrieve-logs.php','2021-06-10 17:17:22','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(214,'/retrieve-logs.php','2021-06-10 17:17:22','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(215,'/retrieve-logs.php','2021-06-10 17:17:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(216,'/retrieve-logs.php','2021-06-10 17:17:50','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(217,'/retrieve-logs.php','2021-06-10 17:19:11','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(218,'/retrieve-logs.php','2021-06-10 17:19:15','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(219,'/retrieve-logs.php','2021-06-10 17:20:08','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(220,'/retrieve-logs.php','2021-06-10 17:20:36','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(221,'/retrieve-logs.php','2021-06-10 17:20:36','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(222,'/retrieve-logs.php','2021-06-10 17:21:58','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(223,'/retrieve-logs.php','2021-06-10 17:23:49','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(224,'/retrieve-logs.php','2021-06-10 17:23:49','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(225,'/retrieve-logs.php','2021-06-10 17:25:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(226,'/retrieve-logs.php','2021-06-10 17:25:47','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(227,'/retrieve-logs.php','2021-06-10 17:27:56','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(228,'/retrieve-logs.php','2021-06-10 17:27:56','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(229,'/retrieve-logs.php','2021-06-10 17:28:01','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(230,'/retrieve-logs.php','2021-06-10 17:28:01','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(231,'/retrieve-logs.php','2021-06-10 17:28:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(232,'/retrieve-logs.php','2021-06-10 17:28:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(233,'/retrieve-logs.php','2021-06-10 17:28:15','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(234,'/retrieve-logs.php','2021-06-10 17:28:15','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(235,'/retrieve-logs.php','2021-06-10 17:28:29','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(236,'/retrieve-logs.php','2021-06-10 17:28:29','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(237,'/retrieve-logs.php','2021-06-10 17:28:34','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(238,'/retrieve-logs.php','2021-06-10 17:28:34','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(239,'/retrieve-logs.php','2021-06-10 17:28:39','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(240,'/retrieve-logs.php','2021-06-10 17:28:40','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(241,'/retrieve-logs.php','2021-06-10 17:28:41','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(242,'/retrieve-logs.php','2021-06-10 17:28:41','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(243,'/retrieve-logs.php','2021-06-10 17:28:52','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(244,'/retrieve-logs.php','2021-06-10 17:28:52','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(245,'/retrieve-logs.php','2021-06-10 17:31:31','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(246,'/retrieve-logs.php','2021-06-10 17:31:31','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(247,'/retrieve-logs.php','2021-06-10 17:31:34','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(248,'/retrieve-logs.php','2021-06-10 17:31:34','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(249,'/retrieve-logs.php','2021-06-10 17:37:39','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(250,'/retrieve-logs.php','2021-06-10 17:37:40','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(251,'/logout.php','2021-06-10 17:50:54',NULL,'Korisnik mmatijevi se odjavio.',2,1),(252,'/login-page.php','2021-06-10 18:04:46','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(253,'/retrieve-logs.php','2021-06-10 18:05:30','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(254,'/retrieve-logs.php','2021-06-10 18:05:30','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(255,'/retrieve-logs.php','2021-06-10 18:07:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(256,'/retrieve-logs.php','2021-06-10 18:07:02','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(257,'/retrieve-logs.php','2021-06-10 18:07:03','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(258,'/retrieve-logs.php','2021-06-10 18:07:06','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(259,'/retrieve-logs.php','2021-06-10 18:07:07','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(260,'/retrieve-logs.php','2021-06-10 18:07:12','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(261,'/retrieve-logs.php','2021-06-10 18:07:15','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(262,'/retrieve-logs.php','2021-06-10 18:07:15','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(263,'/retrieve-logs.php','2021-06-10 18:07:20','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(264,'/retrieve-logs.php','2021-06-10 18:07:20','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = sustav','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom sustav.',21,1),(265,'/retrieve-logs.php','2021-06-10 18:08:17','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(266,'/retrieve-logs.php','2021-06-10 18:08:17','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(267,'/retrieve-logs.php','2021-06-10 18:08:19','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(268,'/retrieve-logs.php','2021-06-10 18:08:20','SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = mmatijevi','Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom mmatijevi.',21,1),(269,'/logout.php','2021-06-10 19:30:08',NULL,'Korisnik mmatijevi se odjavio.',2,1),(270,'/index.php','2021-06-10 19:30:09','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1);
/*!40000 ALTER TABLE `dnevnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokazni_materijali`
--

DROP TABLE IF EXISTS `dokazni_materijali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokazni_materijali` (
  `id_materijala` int NOT NULL AUTO_INCREMENT,
  `putanja_disk` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `naziv` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datum_postavljanja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opaska` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_vrsta_materijala` int NOT NULL,
  PRIMARY KEY (`id_materijala`),
  KEY `fk_dokazni_materijali_vrsta_materijala1_idx` (`id_vrsta_materijala`),
  CONSTRAINT `fk_dokazni_materijali_vrsta_materijala` FOREIGN KEY (`id_vrsta_materijala`) REFERENCES `vrsta_materijala` (`id_vrsta_materijala`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokazni_materijali`
--

LOCK TABLES `dokazni_materijali` WRITE;
/*!40000 ALTER TABLE `dokazni_materijali` DISABLE KEYS */;
INSERT INTO `dokazni_materijali` VALUES (1,'wall.jpg','Primjer dokaza 1','2021-04-13 12:57:10','Pogledati gornji desni kut.',1),(2,'požar.jpg','požar.jpg','2021-05-23 17:36:08',NULL,1),(27,'oluja.jpg','oluja.jpg','2021-05-23 17:40:35',NULL,1),(28,'potres.jpg','potres.jpg','2021-05-23 17:41:37',NULL,1),(29,'krađa.jpg','krađa.jpg','2021-05-23 17:43:09',NULL,1),(30,'potres.jpg','potres.jpg','2021-05-23 18:28:19',NULL,1),(31,'poplava_kuca.jpg','oluja.jpg','2021-05-23 18:37:16',NULL,1),(32,'poplava_kuca.jpg','poplava_kuca.jpg','2021-05-24 14:50:14',NULL,1),(33,'poplava_kuca.jpg','poplava_kuca.jpg','2021-05-24 14:50:45',NULL,1),(34,'kuća_gori.jpg','kuća_gori.jpg','2021-05-24 17:22:08',NULL,1),(35,'wall.jpg','krađa.jpg','2021-05-24 18:34:27',NULL,1);
/*!40000 ALTER TABLE `dokazni_materijali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donacije`
--

DROP TABLE IF EXISTS `donacije`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `donacije` (
  `id_donacije` int NOT NULL AUTO_INCREMENT,
  `iznos` float NOT NULL,
  `id_javni_poziv` int NOT NULL,
  `id_donator` int NOT NULL,
  PRIMARY KEY (`id_donacije`),
  KEY `fk_donacije_steta1_idx` (`id_javni_poziv`),
  KEY `fk_donacije_korisnik1_idx` (`id_donator`),
  CONSTRAINT `fk_donacije_korisnik` FOREIGN KEY (`id_donator`) REFERENCES `korisnik` (`id_korisnik`),
  CONSTRAINT `fk_donacije_steta` FOREIGN KEY (`id_javni_poziv`) REFERENCES `steta` (`id_steta`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donacije`
--

LOCK TABLES `donacije` WRITE;
/*!40000 ALTER TABLE `donacije` DISABLE KEYS */;
INSERT INTO `donacije` VALUES (1,125,2,1),(2,1500.5,1,1),(3,1500.5,1,1);
/*!40000 ALTER TABLE `donacije` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `javni_poziv`
--

DROP TABLE IF EXISTS `javni_poziv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `javni_poziv` (
  `id_javni_poziv` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datum_otvaranja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_zatvaranja` timestamp NULL DEFAULT NULL,
  `skupljeno_sredstava` float NOT NULL DEFAULT '0',
  `zatvoren` tinyint NOT NULL DEFAULT '0',
  `id_odgovorna_osoba` int NOT NULL,
  `id_kategorija_stete` int NOT NULL,
  PRIMARY KEY (`id_javni_poziv`),
  KEY `fk_javni_poziv_korisnik1_idx` (`id_odgovorna_osoba`),
  KEY `fk_javni_poziv_kategorija_stete1_idx` (`id_kategorija_stete`),
  CONSTRAINT `fk_javni_poziv_kategorija_stete` FOREIGN KEY (`id_kategorija_stete`) REFERENCES `kategorija_stete` (`id_kategorija_stete`),
  CONSTRAINT `fk_javni_poziv_korisnik` FOREIGN KEY (`id_odgovorna_osoba`) REFERENCES `korisnik` (`id_korisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `javni_poziv`
--

LOCK TABLES `javni_poziv` WRITE;
/*!40000 ALTER TABLE `javni_poziv` DISABLE KEYS */;
INSERT INTO `javni_poziv` VALUES (1,'Subvencija za nedavnu oluju','Nedavna oluja nanijela je mnogim našim građanima velike štete. Vjetar, gromovi, sve to nanosi materijalne štete.\r\n\r\nPomozite sugrađanima popraviti te štete!','2021-04-10 01:15:18','2021-04-13 15:50:50',3001,0,1,1),(2,'Pomoć žrtvama poplave','Nedavna poplava nanijela je velike materijalne štete našim sugrađanima. Pomozite im!','2021-03-31 18:00:00','2021-09-30 18:00:00',125,0,3,2),(3,'Potres, prvi javni natječaj','Ovo je prvi javni natječaj za žrtve potresa!','2021-04-01 18:00:00','2021-04-08 18:00:00',0,0,3,4),(4,'Potres, drugi javni natječaj','Ovo je drugi javni natječaj za žrtve potresa! Pomozite im jer im je potrebno!','2021-04-11 18:00:00','2021-12-31 19:00:00',0,0,2,4),(5,'Krađe','Nedavno su naši sugrađani bili izloženi stravičnim pljačkama. Pomozite im nadomjesititi ukradenu imovinu dok policija ne odradi svoj posao.','2021-04-09 18:00:00','2022-01-15 19:00:00',0,0,3,5),(6,'Pomoć za ratna stradanja','Neki naši sugrađani još izlaze na kraj s ratnim razaranjima. Ovo je prilika da im pomognete do 13. travnja 2021.','2021-04-10 06:00:00','2021-08-12 18:00:00',0,0,1,6);
/*!40000 ALTER TABLE `javni_poziv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorija_stete`
--

DROP TABLE IF EXISTS `kategorija_stete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorija_stete` (
  `id_kategorija_stete` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kolicina_prijava` int NOT NULL DEFAULT '0',
  `kolicina_javnih_poziva` int NOT NULL DEFAULT '0',
  `ilustracija` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_kategorija_stete`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorija_stete`
--

LOCK TABLES `kategorija_stete` WRITE;
/*!40000 ALTER TABLE `kategorija_stete` DISABLE KEYS */;
INSERT INTO `kategorija_stete` VALUES (1,'Oluja','Gromovi mogu spaliti osigurače, električne uređaje itd. Šteta je još gora kada se posjed zapali uslijed udara groma.',1,1,'storm.jpg'),(2,'Poplava','Nema načina zaštite spremišta ispod prizemne razine od poplava. PVC stolarija, metalna vrata, ništa ne zaustavlja prodor vode pred ogromnim pritiskom. Voda uništi sav namještaj od ivice, električne uređaje. U dodiru s otvorenim instalacijama može doći i do požara.',3,1,'flood.jpg'),(3,'Požar','Sama pomisao na požare utiskuju strah u kosti. Eksplozija cijevi od plina uslijed malene pukotine može se dogoditi bilo kome. Vatra najčešće uništi susjedne posjede, stanove itd.',0,0,'arson.jpg'),(4,'Potres','Instiktivan strah koje potresi uzrokuju rijetki mogu izdržati, a strah se duboko urezuje u kosti. Kao da to nije dovoljno, na starijim građevinama potresi uzrokuju katastrofalnu infrastrukturnu štetu koju je teško i skupo sanirati.',2,1,'earthquake.jpg'),(5,'Krađa','Nekada se čovjek trudi, radi svoj posao pošteno, samo da bi uočio obijenu bravu na kućnim vratima. Ponekad štete nastale krađom budu kobne i ljudi izgube svo bogatstvo što su imali.',2,1,'theft.jpg'),(6,'Posljedice rata','Već je 30 godina od rata, no štete nastale razaranjima i pljačkom i dan danas nisu kompenzirane.',1,1,'war.jpg');
/*!40000 ALTER TABLE `kategorija_stete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisnik` (
  `id_korisnik` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prezime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `korisnicko_ime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lozinka_citljiva` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sol` varchar(50) DEFAULT NULL,
  `lozinka_sha256` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datum_aktivacije` timestamp NULL DEFAULT NULL,
  `datum_registracije` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_blokade` tinyint DEFAULT NULL,
  `broj_neuspjesnih_prijava` int DEFAULT NULL,
  `id_uloga` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`id_korisnik`),
  KEY `fk_korisnik_uloga_idx` (`id_uloga`),
  CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (0,'Sustav','Sustav','sustav','sustav','test1','0a7fc5cc78223487d69cfb9cfbd051eb50a9692ed634c58cc9','58ece1d09bef3384a8e4c77b2e190c4c5a52d5c9b6e995a60c60d68ae1ba53d2','2000-01-01 00:00:00','2000-01-01 00:00:00',NULL,NULL,1),(1,'Mislav','Matijević','mmatijevi','mmatijevi@foi.hr','test1','0a7fc5cc78223487d69cfb9cfbd051eb50a9692ed634c58cc9','58ece1d09bef3384a8e4c77b2e190c4c5a52d5c9b6e995a60c60d68ae1ba53d2','2021-04-04 19:56:43','2021-04-13 10:33:51',NULL,NULL,1),(2,'Ana','Anić','aanic2','aanic@foi.hr','anica2','c1eb290d086b6fea2d69e9bb1a0c4aadc2c02eeba79b90ff03','68585e18b46f08b7a2e6ba9ad5c28fa835ded7980a239b51f8e265899dbb6a8b','2021-04-03 19:32:42','2021-04-03 19:29:42',NULL,NULL,2),(3,'Goran','Gorić','ggoric','ggoric@foi.hr','goran2','9dcb20da04ab56976207e21257d6876414a6f9d51e0ca6593c','24480947f6480e6b41984fe0d82f2e5ed6e89a318f7e23be4713e7f472b738fd','2021-04-12 00:19:30','2021-04-11 23:19:30',1,NULL,2),(4,'Mirko','Mirkić','mmirkic','mmirkic@foi.hr','dinamo2','4ab3831d2e13f3e1b6a100df3b69b7aed150aab1b4fee19a37','23e21c8c348b7c956b01cfc5c0b812d297f052108e4c57379affd6a83b8f4833','2021-04-08 12:43:17','2021-04-08 11:33:17',NULL,NULL,2),(5,'Matej','Matijač','mmatijac3','mmatijac@foi.hr','matejftw3','a6131062aa6cf86b7f532df6fb8c2275b0e312d91d98277976','23e21c8c348b7c956b01cfc5c0b812d297f052108e4c57379affd6a83b8f4833','2021-04-09 23:11:07','2021-04-09 02:11:07',NULL,NULL,3),(6,'Željko','Željkić','zzeljkic','zzeljkic@foi.hr','kamion3','13e52e602c68ea6b98f600b280106fffd8ad2316fff26087ef','82cd10cc71ddc59fe61940df0f799a03793059ac26be6a18eb4935e458c85d18','2021-04-10 10:10:12','2021-04-09 23:10:06',NULL,NULL,3),(7,'Maja','Majajić','mmajajic','mmajajic@foi.hr','barbie3','4e252eb36bf22e7df2e7a1bedc7f7537323b88419b457d6c1d','f97f5adf67b2336386bee53a9adff9d5dbe0dc415b6cc1a4b96af7d8af81721e','2021-04-11 14:12:16','2021-04-11 05:12:44',NULL,NULL,3),(8,'Zera','Hudžibufić','zhudzibufic','zhudzibufic@foi.hr','zera3','67e7d1943d77547cc73de22ef1a092c2bb4ca9d3872eb82406','357d1d299d75aa0a6f2c09ff1c01aaebfd010fccbf8f508e31950b10a2bf0fc9','2021-04-12 12:29:31','2021-04-12 06:29:31',NULL,NULL,3),(9,'Garo','Garavi','ggaravi','ggaravi@foi.hr','crnac3','1759f170cda454382affdde219a0f21ee4fdc1f5ec36b6476a','60eb5729f752bf5ca4087b43a45bf0eb8150f0356ea4ee4cc9a578c68a112a05','2021-04-13 07:12:18','2021-04-12 22:11:08',1,NULL,3),(10,'Ana','Prekrasna','aprekrasna4','aprekrasna@foi.hr','beuty4','ef1610327931e998af41220471c4da8299ab1a6441a04a9036','d16bc3a2cf373b869faa84d29473db6d367e86e69a3d65c860869a84903121c3','2021-04-14 08:31:00','2021-04-13 10:39:30',NULL,NULL,4),(12,'Mario','Nižić','mnizic','mnizic@email.co','test1','3e0b3410fa6fc4c7c58650fe80acaf76f9ba473501182a9240','b75206edb899393578ab3043cae4fd32a50394addd07e0f333dcb162c3eb1515','2021-05-24 20:54:51','2021-05-23 20:54:51',1,NULL,3),(13,'Anton','Lovrić','alovric','alovric@mail','test3','77290002ce57efb8af2d920e3fe44fc5547e4e16d4f50140fb','35ad342b20971c43ae6afef7bcb42e5948d71b7af3f95ed22be7fe491103d60c','2021-06-07 18:46:50','2021-06-06 17:18:00',1,NULL,3),(14,'Mateo','Mustać','mmustac','mmustac@web.com','test3','5b9a686654757f16579fff5aee90aaab6199050771b63f54b4','aeac8215fe6c43bf903abe1edddd26e069f6a58400aa351726aa6e06751d91a7','2021-06-07 19:00:15','2021-06-07 18:59:39',1,NULL,3),(61,'<script>alert()</script>','<script>alert(\"XSS FTW\")</script>','<br>','Lith1955@dayrep.com','hakerčina1','0e1b28de3df75f8e1f132201285c2436a75d5ab0051b469dbe','fbb86d4730d934af9c69c9476d34ea1eed9fe882394e78d66645d002e8ce6680',NULL,'2021-06-07 18:46:50',0,NULL,3),(62,'&lt;script&gt;alert()&lt;','&lt;script&gt;alert(','&lt;br&gt;','Lith1955@dayrep.com','hakerčina1','9397b4bcb1ea549caee5a9d58ddbfae996169a75ce3972c31c','04a7e12e5fc95c593bc79a6777eed0fe7a1595dee8deddde814d44331ba22a53',NULL,'2021-06-07 18:59:39',NULL,NULL,3);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderator_kategorije`
--

DROP TABLE IF EXISTS `moderator_kategorije`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moderator_kategorije` (
  `id_moderator` int NOT NULL,
  `id_kategorija_stete` int NOT NULL,
  PRIMARY KEY (`id_moderator`,`id_kategorija_stete`),
  KEY `fk_kategorija_stete_has_korisnik_korisnik1_idx` (`id_moderator`),
  KEY `fk_kategorija_stete_has_korisnik_kategorija_stete1_idx` (`id_kategorija_stete`),
  CONSTRAINT `fk_kategorija_stete_has_korisnik_kategorija_stete` FOREIGN KEY (`id_kategorija_stete`) REFERENCES `kategorija_stete` (`id_kategorija_stete`),
  CONSTRAINT `fk_kategorija_stete_has_korisnik_korisnik` FOREIGN KEY (`id_moderator`) REFERENCES `korisnik` (`id_korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator_kategorije`
--

LOCK TABLES `moderator_kategorije` WRITE;
/*!40000 ALTER TABLE `moderator_kategorije` DISABLE KEYS */;
INSERT INTO `moderator_kategorije` VALUES (1,1),(1,6),(2,4),(3,2),(3,4),(3,5),(4,2);
/*!40000 ALTER TABLE `moderator_kategorije` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_stete`
--

DROP TABLE IF EXISTS `status_stete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_stete` (
  `id_status_stete` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_status_stete`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_stete`
--

LOCK TABLES `status_stete` WRITE;
/*!40000 ALTER TABLE `status_stete` DISABLE KEYS */;
INSERT INTO `status_stete` VALUES (1,'obrada'),(2,'prihvaćeno'),(3,'odbijeno');
/*!40000 ALTER TABLE `status_stete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `steta`
--

DROP TABLE IF EXISTS `steta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `steta` (
  `id_steta` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `oznake` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datum_prijave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_potvrde` timestamp NULL DEFAULT NULL,
  `subvencija_hrk` float DEFAULT NULL,
  `id_status_stete` int NOT NULL,
  `id_kategorija_stete` int NOT NULL,
  `id_prijavitelj` int NOT NULL,
  `id_javni_poziv` int NOT NULL,
  PRIMARY KEY (`id_steta`),
  KEY `fk_steta_javni_poziv1_idx` (`id_javni_poziv`),
  KEY `fk_steta_korisnik1_idx` (`id_prijavitelj`),
  KEY `fk_steta_kategorija_stete1_idx` (`id_kategorija_stete`),
  KEY `fk_steta_status_stete1_idx` (`id_status_stete`),
  CONSTRAINT `fk_steta_javni_poziv` FOREIGN KEY (`id_javni_poziv`) REFERENCES `javni_poziv` (`id_javni_poziv`),
  CONSTRAINT `fk_steta_kategorija_stete` FOREIGN KEY (`id_kategorija_stete`) REFERENCES `kategorija_stete` (`id_kategorija_stete`),
  CONSTRAINT `fk_steta_korisnik` FOREIGN KEY (`id_prijavitelj`) REFERENCES `korisnik` (`id_korisnik`),
  CONSTRAINT `fk_steta_status_stete` FOREIGN KEY (`id_status_stete`) REFERENCES `status_stete` (`id_status_stete`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steta`
--

LOCK TABLES `steta` WRITE;
/*!40000 ALTER TABLE `steta` DISABLE KEYS */;
INSERT INTO `steta` VALUES (1,'Poplava','Poplava uništila kuću, molim pomoć.','poplava pomoć','2021-05-23 13:41:05','2021-12-12 21:12:12',NULL,2,2,1,1),(2,'Požar','Vatra uništila kuću, hitno trebamo krov nad glavom! Ovo je postalo nesnošljivo. Trebamo hitno pomoć!','vatra vruće','2021-05-23 17:38:41','2021-12-12 12:14:14',NULL,2,3,1,3),(23,'Oluja','Grom udario u stog sijena, izgorijela štala. Hitno trebam financijsku pomoć!','grom sijeno','2021-05-23 17:40:35',NULL,NULL,1,1,1,1),(24,'Potres','Potres uništio staru kuću iz 70-ih. Sve je nestalo!','hitno trese pomozite','2021-05-23 17:41:37',NULL,NULL,1,4,1,4),(25,'Krađa','Lopovi ukrali preko noći novi Samsung TV. Ne znam što mi je činiti...','lopovi majkuim','2021-05-23 17:43:09',NULL,NULL,1,5,1,5),(26,'Požar jaoo','Vatra uništila kuću, hitno trebamo krov nad glavom!!!','vatra','2021-05-23 18:28:19',NULL,NULL,1,2,1,2),(27,'Poplava','Lopovi ukrali preko noći novi Samsung TV.','voda poplava','2021-05-23 18:37:16','2021-05-13 13:30:00',NULL,2,2,1,2),(28,'Poplava 2','Ovo je druga poplava za redom, prilažem sliku! Molim pomoć. Utopit ćemo se. aaaaaaa','poplava','2021-05-24 14:50:14','2021-12-31 09:15:15',NULL,2,2,1,2),(29,'Poplava 3','Jao voda nas pobi. Jao pomoć. Topim se. jaoo *gulp*  *gulp*','poplava','2021-05-24 14:50:45','2021-05-24 05:15:15',NULL,3,2,1,2),(30,'Požar 2','Izgorjela kuća. Molim pomoć...','gori vatra jao meni','2021-05-24 17:22:08','2021-01-01 21:01:01',NULL,2,3,2,3),(31,'Stravična krađa','Teške lopuže! Ukrali mi TV...','lopuže','2021-05-24 18:34:27','2021-12-31 21:23:23',NULL,2,1,1,1);
/*!40000 ALTER TABLE `steta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `steta_dokazi`
--

DROP TABLE IF EXISTS `steta_dokazi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `steta_dokazi` (
  `id_steta` int NOT NULL,
  `id_materijala` int NOT NULL,
  PRIMARY KEY (`id_steta`,`id_materijala`),
  KEY `fk_steta_has_dokazni_materijali_dokazni_materijali1_idx` (`id_materijala`),
  KEY `fk_steta_has_dokazni_materijali_steta1_idx` (`id_steta`),
  CONSTRAINT `fk_steta_has_dokazni_materijali_dokazni_materijali` FOREIGN KEY (`id_materijala`) REFERENCES `dokazni_materijali` (`id_materijala`),
  CONSTRAINT `fk_steta_has_dokazni_materijali_steta` FOREIGN KEY (`id_steta`) REFERENCES `steta` (`id_steta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steta_dokazi`
--

LOCK TABLES `steta_dokazi` WRITE;
/*!40000 ALTER TABLE `steta_dokazi` DISABLE KEYS */;
INSERT INTO `steta_dokazi` VALUES (1,1),(2,2),(23,27),(24,28),(25,29),(26,30),(27,31),(28,32),(29,33),(30,34),(31,35);
/*!40000 ALTER TABLE `steta_dokazi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip_radnje`
--

DROP TABLE IF EXISTS `tip_radnje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tip_radnje` (
  `id_tip` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_tip`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_radnje`
--

LOCK TABLES `tip_radnje` WRITE;
/*!40000 ALTER TABLE `tip_radnje` DISABLE KEYS */;
INSERT INTO `tip_radnje` VALUES (1,'prijava'),(2,'odjava'),(3,'registracija'),(4,'aktivacija'),(5,'promjena lozinke'),(6,'prihvaćanje uvjeta'),(7,'donacija'),(8,'otvaranje javnog poziva'),(9,'zatvaranje javnog poziva'),(10,'prijava na javni poziv'),(11,'novi status javnog poziva'),(12,'prijava štete'),(13,'neuspješna prijava'),(14,'blokiranje'),(15,'zahtjev nove lozinke'),(16,'promjena lozinke'),(17,'promjena podataka'),(18,'mail za registraciju'),(19,'mail za lozinku'),(20,'mail za blokiranje'),(21,'općenit upit'),(22,'promjena konfiguracije');
/*!40000 ALTER TABLE `tip_radnje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uloga`
--

DROP TABLE IF EXISTS `uloga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uloga` (
  `id_uloga` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_uloga`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uloga`
--

LOCK TABLES `uloga` WRITE;
/*!40000 ALTER TABLE `uloga` DISABLE KEYS */;
INSERT INTO `uloga` VALUES (1,'Administrator'),(2,'Moderator'),(3,'Registrirani korisnik'),(4,'Neregistrirani korisnik');
/*!40000 ALTER TABLE `uloga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vrsta_materijala`
--

DROP TABLE IF EXISTS `vrsta_materijala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vrsta_materijala` (
  `id_vrsta_materijala` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `upute_za_upload` text NOT NULL,
  `ekstenzija` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `najveca_velicina_mb` int NOT NULL,
  PRIMARY KEY (`id_vrsta_materijala`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vrsta_materijala`
--

LOCK TABLES `vrsta_materijala` WRITE;
/*!40000 ALTER TABLE `vrsta_materijala` DISABLE KEYS */;
INSERT INTO `vrsta_materijala` VALUES (1,'Fotografija','Fotografija materijal.','Uploadati.','.jpg, .jpeg',4),(2,'Video','Video materijal.','Uploadati.','.mp4',64),(3,'Audio','Audio materijal.','Uploadati.','.mp3',1);
/*!40000 ALTER TABLE `vrsta_materijala` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-10 23:52:50
