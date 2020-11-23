-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: pendaftaran
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anak`
--

DROP TABLE IF EXISTS `anak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anak` (
  `id_anak` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `umur` int(2) DEFAULT NULL,
  `asal_tk` varchar(20) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `lengkap` int(1) DEFAULT NULL,
  `id_ortu` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_anak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anak`
--

LOCK TABLES `anak` WRITE;
/*!40000 ALTER TABLE `anak` DISABLE KEYS */;
/*!40000 ALTER TABLE `anak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ortu`
--

DROP TABLE IF EXISTS `ortu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ortu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama_ortu` varchar(50) DEFAULT NULL,
  `alamat_ortu` varchar(255) DEFAULT NULL,
  `no_hp` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ortu`
--

LOCK TABLES `ortu` WRITE;
/*!40000 ALTER TABLE `ortu` DISABLE KEYS */;
/*!40000 ALTER TABLE `ortu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-23 21:33:34
