CREATE DATABASE  IF NOT EXISTS `WebDiP2020x057` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `WebDiP2020x057`;
-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: WebDiP2020x057
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dnevnik`
--

LOCK TABLES `dnevnik` WRITE;
/*!40000 ALTER TABLE `dnevnik` DISABLE KEYS */;
INSERT INTO `dnevnik` VALUES (1,'/index.php','2021-06-08 22:53:08','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(2,'/donate.php','2021-06-08 22:57:52','UPDATE javni_poziv SET skupljeno_sredstava = 100 WHERE id_javni_poziv = 1','Neregistrirani korisnik s IP adresom 127.0.0.1 donirao je 100 HRK za javni poziv s oznakon 1.',7,1),(3,'/index.php','2021-06-08 22:57:58','UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = 1','Prijavio se korisnik mmatijevi.',1,1),(4,'/donate.php','2021-06-08 23:45:32','UPDATE javni_poziv SET skupljeno_sredstava = 1500.5 WHERE id_javni_poziv = 1; INSERT INTO `WebDiP2020x057`.`donacije` (`iznos`, `id_javni_poziv`, `id_donator`) VALUES (1500.5, 1, 1)','Korisnik Mislav donirao je 1500.5 HRK za javni poziv s oznakom 1.',7,1),(5,'/logout.php','2021-06-08 23:46:50',NULL,'Korisnik mmatijevi se odjavio.',2,1);
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
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `donacije_AFTER_INSERT` AFTER INSERT ON `donacije` FOR EACH ROW BEGIN
UPDATE javni_poziv SET skupljeno_sredstava = skupljeno_sredstava + new.iznos WHERE id_javni_poziv = new.id_javni_poziv;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
INSERT INTO `korisnik` VALUES (0,'Sustav','Sustav','sustav','sustav','test1','0a7fc5cc78223487d69cfb9cfbd051eb50a9692ed634c58cc9','58ece1d09bef3384a8e4c77b2e190c4c5a52d5c9b6e995a60c60d68ae1ba53d2','2000-01-01 00:00:00','2000-01-01 00:00:00',0,NULL,1),(1,'Mislav','Matijević','mmatijevi','mmatijevi@foi.hr','test1','0a7fc5cc78223487d69cfb9cfbd051eb50a9692ed634c58cc9','58ece1d09bef3384a8e4c77b2e190c4c5a52d5c9b6e995a60c60d68ae1ba53d2','2021-04-04 19:56:43','2021-04-13 10:33:51',NULL,NULL,1),(2,'Ana','Anić','aanic2','aanic@foi.hr','anica2','c1eb290d086b6fea2d69e9bb1a0c4aadc2c02eeba79b90ff03','68585e18b46f08b7a2e6ba9ad5c28fa835ded7980a239b51f8e265899dbb6a8b','2021-04-03 19:32:42','2021-04-03 19:29:42',NULL,NULL,2),(3,'Goran','Gorić','ggoric','ggoric@foi.hr','goran2','9dcb20da04ab56976207e21257d6876414a6f9d51e0ca6593c','24480947f6480e6b41984fe0d82f2e5ed6e89a318f7e23be4713e7f472b738fd','2021-04-12 00:19:30','2021-04-11 23:19:30',NULL,NULL,2),(4,'Mirko','Mirkić','mmirkic','mmirkic@foi.hr','dinamo2','4ab3831d2e13f3e1b6a100df3b69b7aed150aab1b4fee19a37','23e21c8c348b7c956b01cfc5c0b812d297f052108e4c57379affd6a83b8f4833','2021-04-08 12:43:17','2021-04-08 11:33:17',NULL,NULL,2),(5,'Matej','Matijač','mmatijac3','mmatijac@foi.hr','matejftw3','a6131062aa6cf86b7f532df6fb8c2275b0e312d91d98277976','23e21c8c348b7c956b01cfc5c0b812d297f052108e4c57379affd6a83b8f4833','2021-04-09 23:11:07','2021-04-09 02:11:07',NULL,NULL,3),(6,'Željko','Željkić','zzeljkic','zzeljkic@foi.hr','kamion3','13e52e602c68ea6b98f600b280106fffd8ad2316fff26087ef','82cd10cc71ddc59fe61940df0f799a03793059ac26be6a18eb4935e458c85d18','2021-04-10 10:10:12','2021-04-09 23:10:06',NULL,NULL,3),(7,'Maja','Majajić','mmajajic','mmajajic@foi.hr','barbie3','4e252eb36bf22e7df2e7a1bedc7f7537323b88419b457d6c1d','f97f5adf67b2336386bee53a9adff9d5dbe0dc415b6cc1a4b96af7d8af81721e','2021-04-11 14:12:16','2021-04-11 05:12:44',NULL,NULL,3),(8,'Zera','Hudžibufić','zhudzibufic','zhudzibufic@foi.hr','zera3','67e7d1943d77547cc73de22ef1a092c2bb4ca9d3872eb82406','357d1d299d75aa0a6f2c09ff1c01aaebfd010fccbf8f508e31950b10a2bf0fc9','2021-04-12 12:29:31','2021-04-12 06:29:31',NULL,NULL,3),(9,'Garo','Garavi','ggaravi','ggaravi@foi.hr','crnac3','1759f170cda454382affdde219a0f21ee4fdc1f5ec36b6476a','60eb5729f752bf5ca4087b43a45bf0eb8150f0356ea4ee4cc9a578c68a112a05','2021-04-13 07:12:18','2021-04-12 22:11:08',NULL,NULL,3),(10,'Ana','Prekrasna','aprekrasna4','aprekrasna@foi.hr','beuty4','ef1610327931e998af41220471c4da8299ab1a6441a04a9036','d16bc3a2cf373b869faa84d29473db6d367e86e69a3d65c860869a84903121c3','2021-04-14 08:31:00','2021-04-13 10:39:30',NULL,NULL,4),(12,'Mario','Nižić','mnizic','mnizic@email.co','test1','3e0b3410fa6fc4c7c58650fe80acaf76f9ba473501182a9240','b75206edb899393578ab3043cae4fd32a50394addd07e0f333dcb162c3eb1515','2021-05-24 20:54:51','2021-05-23 20:54:51',NULL,NULL,3),(13,'Anton','Lovrić','alovric','alovric@mail','test3','77290002ce57efb8af2d920e3fe44fc5547e4e16d4f50140fb','35ad342b20971c43ae6afef7bcb42e5948d71b7af3f95ed22be7fe491103d60c','2021-06-07 18:46:50','2021-06-06 17:18:00',NULL,NULL,3),(14,'Mateo','Mustać','mmustac','mmustac@web.com','test3','5b9a686654757f16579fff5aee90aaab6199050771b63f54b4','aeac8215fe6c43bf903abe1edddd26e069f6a58400aa351726aa6e06751d91a7','2021-06-07 19:00:15','2021-06-07 18:59:39',NULL,NULL,3),(61,'<script>alert()</script>','<script>alert(\"XSS FTW\")</script>','<br>','Lith1955@dayrep.com','hakerčina1','0e1b28de3df75f8e1f132201285c2436a75d5ab0051b469dbe','fbb86d4730d934af9c69c9476d34ea1eed9fe882394e78d66645d002e8ce6680',NULL,'2021-06-07 18:46:50',NULL,NULL,3),(62,'&lt;script&gt;alert()&lt;','&lt;script&gt;alert(','&lt;br&gt;','Lith1955@dayrep.com','hakerčina1','9397b4bcb1ea549caee5a9d58ddbfae996169a75ce3972c31c','04a7e12e5fc95c593bc79a6777eed0fe7a1595dee8deddde814d44331ba22a53',NULL,'2021-06-07 18:59:39',NULL,NULL,3);
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
INSERT INTO `moderator_kategorije` VALUES (1,1),(1,6),(2,4),(3,2),(3,4),(3,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_radnje`
--

LOCK TABLES `tip_radnje` WRITE;
/*!40000 ALTER TABLE `tip_radnje` DISABLE KEYS */;
INSERT INTO `tip_radnje` VALUES (1,'prijava'),(2,'odjava'),(3,'registracija'),(4,'aktivacija'),(5,'promjena lozinke'),(6,'prihvaćanje uvjeta'),(7,'donacija'),(8,'otvaranje javnog poziva'),(9,'zatvaranje javnog poziva'),(10,'prijava na javni poziv'),(11,'novi status javnog poziva'),(12,'prijava štete'),(13,'neuspješna prijava'),(14,'blokiranje'),(15,'zahtjev nove lozinke'),(16,'promjena lozinke'),(17,'promjena podataka'),(18,'mail za registraciju'),(19,'mail za lozinku'),(20,'mail za blokiranje'),(21,'općenit upit');
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

--
-- Dumping events for database 'WebDiP2020x057'
--

--
-- Dumping routines for database 'WebDiP2020x057'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-09  1:53:59
