CREATE DATABASE  IF NOT EXISTS `tech_service` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `tech_service`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: tech_service
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Aguascalientes'),(2,'Baja California'),(3,'Baja California Sur'),(4,'Campeche'),(5,'Coahuila de Zaragoza'),(6,'Colima'),(7,'Chiapas'),(8,'Chihuahua'),(9,'Distrito Federal'),(10,'Durango'),(11,'Guanajuato'),(12,'Guerrero'),(13,'Hidalgo'),(14,'Jalisco'),(15,'México'),(16,'Michoacán de Ocampo'),(17,'Morelos'),(18,'Nayarit'),(19,'Nuevo León'),(20,'Oaxaca de Juárez'),(21,'Puebla'),(22,'Querétaro'),(23,'Quintana Roo'),(24,'San Luis Potosí'),(25,'Sinaloa'),(26,'Sonora'),(27,'Tabasco'),(28,'Tamaulipas'),(29,'Tlaxcala'),(30,'Veracruz de Ignacio de la Llave'),(31,'Yucatán'),(32,'Zacatecas');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('Nuevo','Espera','Diferido','Completado','Sin resolver') COLLATE utf8_unicode_ci NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_estado`),
  KEY `fecha_hora` (`fecha_hora`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'2017-02-19 16:12:05','Completado','afdsfasdf\r\nzxcczxc'),(2,'2017-02-19 16:12:05','Sin resolver',NULL),(4,'2017-02-20 18:34:47','Nuevo','affdsds asdfasf \r\n524242\r\nsadas'),(5,'2017-02-21 18:40:38','Nuevo',NULL),(6,'2017-03-01 21:48:25','Nuevo',NULL),(7,'2017-03-01 21:49:28','Nuevo',NULL),(8,'2017-03-01 21:53:34','Nuevo',NULL),(9,'2017-03-01 21:57:18','Nuevo',NULL),(10,'2017-03-01 21:57:37','Diferido',NULL),(11,'2017-03-01 21:59:40','Nuevo',NULL),(12,'2017-03-01 21:59:59','Nuevo',NULL),(13,'2017-03-01 22:03:37','Nuevo',NULL),(14,'2017-03-01 22:03:55','Nuevo',NULL),(15,'2017-03-01 22:04:27','Nuevo',NULL),(16,'2017-03-01 22:05:06','Nuevo',NULL),(17,'2017-03-01 22:05:37','Nuevo',NULL),(18,'2017-03-01 22:07:59','Nuevo',NULL),(19,'2017-03-01 22:08:20','Nuevo',NULL),(20,'2017-03-01 22:10:09','Nuevo',NULL),(21,'2017-03-01 22:11:26','Nuevo',NULL),(22,'2017-03-01 22:11:49','Nuevo',NULL),(23,'2017-03-01 22:12:36','Nuevo',NULL),(24,'2017-03-01 22:14:49','Nuevo',NULL),(25,'2017-03-01 22:15:06','Nuevo',NULL),(26,'2017-03-01 22:15:40','Nuevo',NULL),(27,'2017-03-01 22:17:36','Nuevo',NULL),(28,'2017-03-01 22:18:56','Nuevo',NULL),(29,'2017-04-17 13:43:44','Diferido','<p>Una descripcion muy descriptiva</p>\n'),(30,'2017-04-17 15:19:37','Diferido',''),(31,'2017-04-17 15:19:59','Sin resolver','<p>Ayuda</p>\n'),(32,'2017-04-17 15:20:15','Completado',''),(33,'2017-04-17 15:28:28','Espera',''),(34,'2017-04-17 15:28:38','Espera',''),(35,'2017-04-17 17:14:49','Espera',''),(36,'2017-04-17 17:15:13','Completado',''),(37,'2017-04-17 17:17:13','Completado','<p>sadfadfasdf<p><span style=\"background-color: rgb(255, 255, 0);\">asdfads</span></p><p><b>asdfsdf</b></p></p>\n'),(38,'2017-04-17 17:18:04','Completado',''),(39,'2017-04-17 17:18:26','Completado',''),(40,'2017-04-17 17:18:51','Completado',''),(41,'2017-04-17 18:05:37','Nuevo',NULL),(42,'2017-04-18 16:45:12','Nuevo',NULL),(43,'2017-04-18 22:02:28','Espera','<p>Pruebas</p>\n'),(44,'2017-04-20 16:40:55','Nuevo',NULL),(45,'2017-04-20 17:02:31','Espera','<p>En sehuhuhfuhfufhufhufhu</p>\n'),(46,'2017-04-28 18:38:30','Espera',''),(47,'2017-04-28 18:39:41','Completado',''),(48,'2017-04-28 18:49:14','Completado',''),(49,'2017-04-28 18:49:41','Espera',''),(50,'2017-04-28 18:51:23','Espera',''),(51,'2017-04-28 18:51:34','Espera',''),(52,'2017-04-28 18:52:08','Espera',''),(53,'2017-04-28 18:53:39','Espera',''),(54,'2017-04-28 18:53:54','Espera',''),(55,'2017-04-28 18:54:52','Espera',''),(56,'2017-04-28 18:55:05','Espera',''),(57,'2017-04-28 18:57:04','Espera',''),(58,'2017-04-28 18:58:13','Espera',''),(59,'2017-04-28 18:59:01','Diferido','<p>asdfasdfadsf</p>\n'),(60,'2017-04-28 19:00:44','Diferido','<p>adasd<p>asdasdsad</p></p>\n'),(61,'2017-04-28 20:55:43','Nuevo',NULL),(62,'2017-04-28 20:56:25','Nuevo','<p>asdasda</p>\n'),(63,'2017-04-28 20:56:54','Nuevo',NULL),(64,'2017-04-28 21:01:20','Nuevo',NULL),(65,'2017-04-28 21:01:59','Nuevo',NULL),(66,'2017-04-28 21:03:33','Nuevo',NULL),(67,'2017-04-28 21:05:31','Nuevo',NULL),(68,'2017-04-28 21:11:38','Nuevo',NULL),(69,'2017-04-28 21:12:24','Nuevo',NULL),(70,'2017-04-28 21:12:32','Nuevo',NULL),(71,'2017-04-28 21:12:38','Nuevo',NULL),(72,'2017-04-28 21:14:25','Nuevo',NULL),(73,'2017-04-28 21:14:37','Nuevo',NULL),(74,'2017-04-28 21:14:51','Nuevo',NULL),(75,'2017-04-28 21:15:11','Nuevo',NULL),(76,'2017-04-28 21:15:36','Nuevo',NULL),(77,'2017-04-28 21:24:05','Nuevo',''),(78,'2017-04-28 21:24:29','Nuevo',''),(79,'2017-04-28 21:25:07','Nuevo',''),(80,'2017-04-28 21:26:06','Nuevo',''),(81,'2017-04-28 21:26:26','Nuevo',''),(82,'2017-04-28 21:26:53','Nuevo',''),(83,'2017-04-28 21:27:14','Nuevo',NULL),(84,'2017-04-28 21:27:36','Nuevo',''),(85,'2017-04-28 21:29:32','Nuevo',''),(86,'2017-04-28 21:31:11','Nuevo',''),(87,'2017-04-28 21:31:45','Nuevo',''),(88,'2017-04-28 21:32:16','Nuevo',''),(89,'2017-04-28 21:32:26','Nuevo',''),(90,'2017-05-03 17:42:06','Nuevo',NULL),(91,'2017-05-03 17:48:36','Nuevo',NULL),(92,'2017-05-31 17:52:33','Nuevo',NULL),(93,'2017-05-31 20:22:26','Nuevo',''),(94,'2017-05-31 20:24:48','Nuevo',''),(95,'2017-05-31 20:34:06','Nuevo',''),(96,'2017-05-31 21:08:08','Sin resolver',''),(97,'2017-06-24 16:40:01','Completado',''),(98,'2017-06-24 16:42:32','Completado',''),(99,'2017-06-24 16:43:37','Completado',''),(100,'2017-06-24 16:43:56','Completado',''),(101,'2017-06-24 16:44:14','Diferido',''),(102,'2017-06-24 16:44:55','Espera',''),(103,'2017-06-24 17:05:42','Nuevo',NULL),(104,'2017-06-24 17:09:49','Nuevo',NULL),(105,'2017-06-24 17:15:56','Nuevo',''),(106,'2017-06-24 17:16:11','Nuevo',''),(107,'2017-06-24 17:36:02','Completado',''),(108,'2017-06-24 17:37:43','Completado','<p>Revisi&oacute;n</p>\n'),(109,'2017-06-24 17:38:18','Completado','<p>asdfdsaf</p>\n'),(110,'2017-06-24 17:42:36','Nuevo',NULL),(111,'2017-06-24 17:43:17','Nuevo',NULL),(112,'2017-06-24 17:43:48','Nuevo',NULL),(113,'2017-06-24 17:45:19','Nuevo',NULL);
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `nombreOriginal` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombreAlmacenado` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (11,'Ley de Dalton.docx','docx','57733fab9daa6de22c95d907c19b375b.docx','2017-04-15 21:53:15'),(10,'13300226-Labview serial.docx','docx','5638f5a92db8d9a50daa2cc442910ca0.docx','2017-04-15 21:38:37'),(9,'13300226 - Ciclos Labview.docx','docx','3a2f5ccef5b762a768b1018b629b4d82.docx','2017-04-15 21:38:37'),(12,'preguntas.docx','docx','7bb7efc85a89082dd148d3b434c8f65f.docx','2017-04-15 21:53:15'),(19,'Ley de Dalton.docx','docx','e1815be869ce499b5cd8c4793ff7861a.docx','2017-04-17 13:43:44'),(20,'Ley de Dalton.docx','docx','07002cf7393c2f77801b3a943b2c535a.docx','2017-04-17 17:14:49'),(21,'preguntas.docx','docx','b8dcd176defaf7ebde325997413063c3.docx','2017-04-17 17:17:13'),(22,'preguntas.docx','docx','584a66611ed5daa315ad0b889da5cfcb.docx','2017-04-17 17:18:04'),(23,'Ley de Dalton.docx','docx','9519b98ef7fcc6763fbab3cdcd9482ed.docx','2017-04-17 17:18:26'),(24,'preguntas.docx','docx','93a02e49785b51c732725abff830ccaa.docx','2017-04-17 17:18:26'),(25,'Ley de Dalton.docx','docx','05d862c4246a61fb61343dcdc9535ea5.docx','2017-04-17 18:05:37'),(26,'Ley de Dalton.docx','docx','ec7cbea5035a2b9d1b68e01f9fac8f18.docx','2017-04-18 16:45:12'),(27,'preguntas.docx','docx','9d77ee9a7651e0c95760d33c7e350a90.docx','2017-04-18 16:45:12'),(31,'canciones.txt','txt','b207e44492c2ac95fa0f8623fe932582.txt','2017-06-24 17:37:44'),(29,'Ley de Dalton.docx','docx','bce014f48257dc5710c87153ff16c645.docx','2017-04-20 16:40:56'),(30,'Ley de Dalton.docx','docx','d8596ceff6901391dfdf7110f36395c4.docx','2017-04-20 16:47:07'),(32,'canciones.txt','txt','44442acc313485c2d59da4f1a943edb3.txt','2017-06-24 17:45:19');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_estados`
--

DROP TABLE IF EXISTS `files_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_estados` (
  `id_estado` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_estados`
--

LOCK TABLES `files_estados` WRITE;
/*!40000 ALTER TABLE `files_estados` DISABLE KEYS */;
INSERT INTO `files_estados` VALUES (29,19),(35,20),(37,21),(38,22),(39,23),(39,24),(108,31);
/*!40000 ALTER TABLE `files_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_foro`
--

DROP TABLE IF EXISTS `files_foro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_foro` (
  `id_foro` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_foro`
--

LOCK TABLES `files_foro` WRITE;
/*!40000 ALTER TABLE `files_foro` DISABLE KEYS */;
INSERT INTO `files_foro` VALUES (12,9),(12,10),(13,11),(13,12),(22,30);
/*!40000 ALTER TABLE `files_foro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_knowledge`
--

DROP TABLE IF EXISTS `files_knowledge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_knowledge` (
  `id_knowledge` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_knowledge`
--

LOCK TABLES `files_knowledge` WRITE;
/*!40000 ALTER TABLE `files_knowledge` DISABLE KEYS */;
/*!40000 ALTER TABLE `files_knowledge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_tickets`
--

DROP TABLE IF EXISTS `files_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_tickets`
--

LOCK TABLES `files_tickets` WRITE;
/*!40000 ALTER TABLE `files_tickets` DISABLE KEYS */;
INSERT INTO `files_tickets` VALUES (53,25),(54,26),(54,27),(55,29),(79,32);
/*!40000 ALTER TABLE `files_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foro`
--

DROP TABLE IF EXISTS `foro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `id_SU` int(11) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensaje` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_nota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ticket_su` (`id_ticket_su`),
  KEY `id_nota` (`id_nota`),
  KEY `id_SU` (`id_SU`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro`
--

LOCK TABLES `foro` WRITE;
/*!40000 ALTER TABLE `foro` DISABLE KEYS */;
INSERT INTO `foro` VALUES (42,'2017-06-24 16:02:32',58,5504,'Problema con la interfaz de usuario','<p>Porfavor ayuda</p>\n',NULL);
/*!40000 ALTER TABLE `foro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informes`
--

DROP TABLE IF EXISTS `informes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `informes` (
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informes`
--

LOCK TABLES `informes` WRITE;
/*!40000 ALTER TABLE `informes` DISABLE KEYS */;
INSERT INTO `informes` VALUES (5506),(5507),(5510),(5511);
/*!40000 ALTER TABLE `informes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Modelo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `noSerie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serviceTag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCompra` date NOT NULL,
  `fechaInicioGarantia` date NOT NULL,
  `fechaFinGarantia` date NOT NULL,
  `categoria` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_inventario`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (7,'HP','asda 1258','3151351','3213151','2017-04-05','2017-04-06','2018-04-05','Algo'),(8,'qwer','zxcv','','','2017-01-01','2017-01-02','2017-01-02','asdf');
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `knowledge`
--

DROP TABLE IF EXISTS `knowledge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `knowledge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_superuser` int(11) NOT NULL,
  `tema` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `visitas` int(11) DEFAULT '0',
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_superuser` (`id_superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `knowledge`
--

LOCK TABLES `knowledge` WRITE;
/*!40000 ALTER TABLE `knowledge` DISABLE KEYS */;
INSERT INTO `knowledge` VALUES (1,'¿Puedo eliminar System32? (act)','<p>No, no lo haga, <span style=\"background-color: rgb(206, 0, 0);\">son </span>archivos <span style=\"background-color: rgb(255, 255, 0);\">escenciales </span>del <span style=\"background-color: rgb(255, 239, 198);\">sistema</span>.<p><br></p><p>Prueba</p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></p>\n',5504,'Sistema',1,'2017-04-16 13:13:54'),(10,'Algo','asdfsdfsdfasdfadsfa',5504,'Prueba',50,'2017-04-18 18:11:47'),(13,'Idea','213123123',5504,'Hardware',120,'2017-04-18 18:12:32'),(21,'Este titulo se refiere a algo con adjuntos','<p>Un contenido con mas de 500 letras:<p style=\"margin-bottom: 15px; padding: 0px; text-align: justify;\"><span style=\'font-family: \"Open Sans\", Arial, sans-serif;\'>Lorem ipsum dolor sit amet, cons<span style=\"background-color: rgb(255, 255, 0);\">ectetur adipiscing elit. Donec at neque eros. Cras congue lorem diam. Nullam ornare turpis a euismod sodales. Donec ornare dignissim ex accumsan accumsan</span>. Suspe</span><font face=\"Comic Sans MS\">ndis<a href=\"http://se%20finibus%20nulla%20massa,%20eu%20scelerisque%20augue%20bibendum%20vel.%20Suspendisse%20in%20quam%20ut%20tortor%20varius%20cursus%20a%20sit%20amet%20ex.%20In%20eget%20odio%20eu\">se finibus nulla massa, eu scelerisque augue bibendum vel. Suspendisse in quam ut tortor varius cursus a sit amet ex. In eget odio eu </a>felis venenatis vehicula. Cras ultricies, eros at cursus facilisis, dolor risus mattis nisi, vitae eleifend purus ipsum in enim. Proin sodales libero e<b>t d</b></font><b><font face=\"Open Sans, Arial, sans-serif\">ui elementum luct</font><u style=\'font-family: \"Open Sans\", Arial, sans-serif;\'>us. Praesent imperdiet augue eu leo venenatis commodo. Praesent sit amet est dolor. Integer ultrices leo sit amet rhoncus consectetur. Aliquam</u><font face=\"Open Sans, Arial, sans-serif\"> efficitur, risus at maximus facilisis, nulla ex tempor purus, at finibus massa nulla a felis.</font></b></p><p style=\"text-align: justify; margin-bottom: 15px; padding: 0px;\"><span style=\'font-family: \"Open Sans\", Arial, sans-serif;\'><b>Maecenas lobortis turpis id leo bibendum, in sodales urna</b> laoreet. Mo</span><font face=\"Courier New\">rbi at euismod ipsum, at auctor nisi. Sed quis commodo purus. Integer malesuada eu sem in bibendum. Proin posuere odio id diam mollis posuere. Quisque tincidunt dictum neque, ut sagittis nisi sollicitudin ut. Vivamus cursus bibendum dui, et tincidunt lacus venenatis ac.</font></p><p style=\'text-align: right; margin-bottom: 15px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif;\'>Nullam vitae mi luctus, finibus ante eu, ullamcorper metus. Fusce bibendum, tortor ut consectetur ornare, nulla arcu fermentum lacus, a imperdiet urna augue eget odio. Donec pretium non elit quis lacinia. Donec sed risus velit. Ut rutrum dignissim egestas. Nulla magna tortor, vehicula et eros eu, viverra porta nisi. Praesent viverra nisl at est fermentum mattis. Quisque eleifend sem libero, id elementum sapien venenatis eget. Pellentesque eu nisi volutpat, semper lorem vel, lacinia dolor. Fusce quis lacus lorem. Pellentesque finibus et massa eget vehicula. In tincidunt gravida diam non convallis. Nunc vehicula pretium nunc at vulputate.</p><p style=\'text-align: right; margin-bottom: 15px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif;\'>Integer ipsum purus, congue eget justo id, vulputate pulvinar ex. Fusce mollis sapien non felis imperdiet posuere. Aenean eleifend id nulla vel vulputate. Mauris iaculis nulla faucibus dolor euismod, eget feugiat mauris efficitur. Suspendisse potenti. Nunc sodales, lorem ut dapibus hendrerit, arcu ex egestas mauris, nec sollicitudin est risus sed ligula. Ut luctus laoreet rhoncus. Sed vitae mi a ex aliquet ornare. Donec vulputate risus purus. Curabitur facilisis tempus nulla, congue eleifend felis convallis ut. Donec efficitur, mauris in ornare rhoncus, dui urna ullamcorper velit, eu dignissim eros quam quis mauris. Nulla venenatis enim ut nulla consectetur dictum.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Phasellus odio turpis, fermentum vulputate ullamcorper in, condimentum eget odio. Donec eget ante ultrices, rhoncus arcu id, ultricies ligula. Pellentesque in purus in elit placerat posuere. Pellentesque vehicula sit amet dolor sit amet pellentesque. Phasellus pharetra hendrerit enim, ac facilisis urna euismod condimentum. Duis quis nulla interdum ante porttitor molestie. Praesent vel felis vel lorem lobortis pretium quis porta urna. Vestibulum commodo nisi vitae ipsum viverra consequat. Etiam mattis lacus ut tellus tempus tempor. Nullam sapien nisi, sollicitudin a ipsum et, malesuada fermentum elit. Fusce faucibus est est, non placerat ante blandit in. Donec purus massa, sollicitudin id velit eu, scelerisque sagittis odio. Etiam eros ipsum, faucibus id quam in, dapibus posuere ex. Praesent nec viverra purus. Vivamus sed nunc metus.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Quisque aliquam in orci nec cursus. Sed quis magna eros. Sed eu arcu nec quam mollis scelerisque vel quis massa. Pellentesque eu leo ante. Duis cursus quam sed orci rhoncus luctus. Integer congue congue urna, quis consectetur orci lacinia et. Sed orci tellus, blandit et velit eget, luctus volutpat felis. Mauris nunc enim, malesuada ut feugiat sit amet, rhoncus id tellus. Phasellus vel sodales velit.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Vestibulum metus velit, viverra non odio sed, efficitur suscipit felis. Cras feugiat urna eget libero aliquet finibus. Nunc vitae ligula varius, rutrum ante blandit, iaculis enim. Donec finibus, justo et dapibus pulvinar, turpis mi finibus neque, a scelerisque eros ipsum ut tellus. Cras dignissim libero non nisl vehicula, ac ultrices orci pellentesque. Nulla ut consequat arcu. Nulla turpis nulla, elementum non ornare sed, bibendum sed ipsum. Vivamus posuere diam leo, sit amet dictum lectus porta eget. Aliquam pulvinar volutpat tempor. Vestibulum non velit pulvinar lacus faucibus tempor.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Nullam a mi nec nisl dictum tristique in ut lectus. Proin elementum scelerisque est in ornare. Cras in porta lorem. Integer ut pharetra turpis. Suspendisse gravida nisl vel metus gravida, gravida vestibulum nunc condimentum. Phasellus lobortis sem sit amet ultrices elementum. Suspendisse potenti. Pellentesque volutpat eget mauris non posuere. Curabitur ornare nisi sapien, convallis faucibus dolor imperdiet in.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Pellentesque varius velit quam, iaculis euismod sem commodo id. Quisque nec metus eros. Morbi dignissim ante in libero mattis pharetra. Nunc sit amet turpis velit. Praesent vel velit pretium, aliquam enim et, tincidunt eros. Suspendisse eu nunc elementum nibh rutrum dictum. Pellentesque vitae odio scelerisque, convallis arcu nec, auctor nunc. Etiam consequat felis vel tortor efficitur, in aliquam ligula tristique. Sed ornare mollis mauris eget blandit. Nam sollicitudin urna vel neque egestas dignissim. Quisque sit amet erat a sapien suscipit pharetra sit amet non nunc. Nullam dui lectus, dictum non condimentum vel, imperdiet vitae lacus. In non arcu enim.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Morbi at venenatis odio. Nam vestibulum porttitor commodo. Ut sit amet purus vel dui tincidunt sagittis sed ut massa. Phasellus scelerisque elementum tempus. Cras in mauris erat. Aenean congue mollis risus, at euismod velit facilisis nec. Donec rhoncus maximus velit. Nullam nec metus mauris. Donec at sem quam. Donec justo sem, bibendum at dignissim nec, hendrerit vitae odio. Nulla varius congue rhoncus. Proin arcu turpis, fermentum non ante vel, varius tincidunt neque. Maecenas sodales erat quis tincidunt rutrum. Donec non condimentum ante, nec lobortis nibh.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Duis vel justo ac mauris luctus cursus. Integer venenatis, enim et mattis ultrices, est turpis elementum nisl, a imperdiet sapien est non urna. Nam sit amet dolor et orci molestie finibus. Maecenas sollicitudin lectus ut neque consequat hendrerit. Pellentesque ornare metus et nulla consectetur, vitae dictum nisl laoreet. Mauris quam ante, placerat ac sapien non, blandit dignissim ante. Integer tristique ante sed nisl tempor, et tincidunt lorem tincidunt. Vestibulum mauris eros, ullamcorper ut dui congue, vulputate dignissim dolor. Vivamus nec elit magna.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Donec dignissim purus a sodales fringilla. Ut pretium, erat sit amet sollicitudin posuere, arcu ex ultrices nisi, eget convallis quam nulla sed nisl. Integer venenatis nisl quis dapibus venenatis. Curabitur pharetra libero sit amet arcu convallis efficitur. Duis accumsan nulla eget sapien iaculis, non consequat neque eleifend. <span style=\"background-color: rgb(255, 255, 0);\">Quisque in ante placerat, lobortis lorem tempor, hendrerit felis. Aenean gravida orci finibus orci tincidunt, non auctor nulla ornare. Sed a tincidunt neque. In hac habitasse platea </span>dictumst.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Quisque vitae erat faucibus, convallis dolor in, egestas nulla. Vivamus vel ex non dui dignissim dignissim at non metus. Sed condimentum accumsan purus. Proin ut lacus vel felis gravida tincidunt ac in turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam faucibus varius purus sed imperdiet. Suspendisse sodales purus eu leo ultrices, sit amet egestas turpis vehicula. Praesent id laoreet nunc, vitae tempor tortor. Pellentesque eleifend magna arcu, eget lacinia risus pulvinar quis. Pellentesque imperdiet, lectus et ultrices porta, elit mauris rutrum lacus, vitae elementum ipsum neque vel mi. Etiam malesuada sollicitudin est, ut condimentum turpis pretium vel.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Mauris tristique dolor et sapien viverra porta. Fusce finibus pretium ipsum. Duis imperdiet vel dui vel gravida. Praesent vulputate lacinia eros vel volutpat. Fusce finibus iaculis lobortis. Aenean ut tortor vel erat pretium consectetur et nec arcu. Phasellus luctus felis iaculis urna ultricies finibus. Aliquam ut lacinia mi. Suspendisse condimentum nisl vel magna pellentesque, in blandit quam rutrum. Proin maximus iaculis tellus vitae facilisis.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Ut lorem orci, auctor sit amet suscipit nec, tincidunt at sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras condimentum dui risus. Cras in fermentum neque, vitae sagittis augue. Mauris a purus sed eros bibendum cursus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec auctor dui purus, sed scelerisque ipsum consequat et. Morbi facilisis lacus tellus, eget congue tortor varius id. Maecenas non ipsum quam. Donec egestas dui in maximus condimentum. Ut scelerisque scelerisque sem, sed lacinia lorem venenatis id. Integer nec feugiat nulla, at fermentum libero.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Nam vestibulum elit nec dui aliquam, in mattis ligula eleifend. Nunc orci tellus, aliquam at dapibus at, fringilla ut tellus. Morbi eu massa vitae ligula ullamcorper iaculis quis ac nibh. Nam sed erat non tortor posuere auctor. Vestibulum odio tortor, tempor a pharetra eu, dapibus id erat. Integer eu nibh justo. Sed vestibulum massa nec accumsan maximus. Aenean iaculis dignissim ex, ut luctus nisi eleifend finibus. Phasellus sit amet semper turpis. Maecenas sapien quam, suscipit nec ornare in, cursus sit amet mi. Morbi vel urna ac sapien consectetur egestas. Proin id sollicitudin mauris, non molestie justo. Donec felis purus, sagittis vitae posuere at, faucibus non orci. Vivamus vitae erat interdum, molestie ligula eget, aliquet purus. Vestibulum placerat, magna non posuere accumsan, ipsum ipsum posuere est, vitae ultricies ex diam quis tellus.</p><p style=\'margin-bottom: 15px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porttitor metus vel sapien dictum semper. Morbi in aliquet arcu, vitae elementum ipsum. Morbi euismod est quis felis cursus, a efficitur quam consectetur. Integer porta lacinia mi, porttitor commodo velit laoreet sed. Mauris mi nisi, efficitur quis venenatis in, auctor a est. Suspendisse aliquam ipsum non risus rutrum consectetur. Quisque ornare</p><p></p><p></p><p></p></p>\n',0,'Prueba2',0,'2017-04-20 16:48:12');
/*!40000 ALTER TABLE `knowledge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `llamadas`
--

DROP TABLE IF EXISTS `llamadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `llamadas` (
  `id_llamada` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_llamada`),
  KEY `id_ticket_su` (`id_ticket_su`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `llamadas`
--

LOCK TABLES `llamadas` WRITE;
/*!40000 ALTER TABLE `llamadas` DISABLE KEYS */;
INSERT INTO `llamadas` VALUES (1,'2017-02-23 18:44:56',9,'hsdgfsdg'),(2,'2017-02-23 18:47:04',9,'hsdgfsdg\n\rsdfsafadfsdf'),(3,'2017-02-23 18:54:53',9,'asdasdas'),(4,'2017-02-23 18:54:55',9,'asdasdasdas'),(5,'2017-02-23 18:54:57',9,'asdasdasd'),(6,'2017-02-23 18:54:59',9,'asdasdasd'),(7,'2017-02-23 18:55:01',9,'asdasdas'),(8,'2017-02-23 18:55:03',9,'asdasdas'),(9,'2017-02-23 18:55:19',9,'asdsdsa'),(10,'2017-02-24 19:34:17',13,'fasdfads'),(11,'2017-02-24 19:34:19',13,'asdfasdf'),(12,'2017-02-24 19:34:20',13,'asdfadsf'),(13,'2017-02-24 19:34:22',13,'sadfasdf'),(14,'2017-04-17 16:15:16',9,'Prueba desde codeigniter'),(15,'2017-04-17 16:15:55',9,'Ya debe de quedar bien esto :)'),(16,'2017-04-17 16:16:16',9,'Ahora si'),(17,'2017-06-24 16:01:09',58,'Una llamada'),(18,'2017-06-24 16:01:13',58,'Prueba\r\n');
/*!40000 ALTER TABLE `llamadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mortals`
--

DROP TABLE IF EXISTS `mortals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mortals` (
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortals`
--

LOCK TABLES `mortals` WRITE;
/*!40000 ALTER TABLE `mortals` DISABLE KEYS */;
INSERT INTO `mortals` VALUES (0),(5200),(5501),(5505),(5508),(5509),(5512),(5513);
/*!40000 ALTER TABLE `mortals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_temas_ticket`
--

DROP TABLE IF EXISTS `sub_temas_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_temas_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tema` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_temas_ticket`
--

LOCK TABLES `sub_temas_ticket` WRITE;
/*!40000 ALTER TABLE `sub_temas_ticket` DISABLE KEYS */;
INSERT INTO `sub_temas_ticket` VALUES (1,'Pantalla',1),(2,'Impresora',1),(3,'Office',2),(4,'Outlook',2),(5,'41',2),(6,'42',1),(7,'1',46),(8,'2',47),(9,'2',48),(10,'2',49),(11,'2',50),(12,'2',2),(13,'2',2),(14,'Algo mas',2),(15,'Algo mas',2),(16,'Focos',1),(17,'Un tema nuevo',2),(18,'Un tema nuevo',2),(19,'tech_service',2),(20,'Relojes',1),(21,'Calculador',1);
/*!40000 ALTER TABLE `sub_temas_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `superusers`
--

DROP TABLE IF EXISTS `superusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `superusers` (
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `superusers`
--

LOCK TABLES `superusers` WRITE;
/*!40000 ALTER TABLE `superusers` DISABLE KEYS */;
INSERT INTO `superusers` VALUES (5500),(5503),(5504),(5514);
/*!40000 ALTER TABLE `superusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temas_tickets`
--

DROP TABLE IF EXISTS `temas_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temas_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas_tickets`
--

LOCK TABLES `temas_tickets` WRITE;
/*!40000 ALTER TABLE `temas_tickets` DISABLE KEYS */;
INSERT INTO `temas_tickets` VALUES (1,'Hardware'),(2,'Software');
/*!40000 ALTER TABLE `temas_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_tiene_tema`
--

DROP TABLE IF EXISTS `ticket_tiene_tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_tiene_tema` (
  `id_ticketSU` int(11) NOT NULL,
  `idTema` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_tiene_tema`
--

LOCK TABLES `ticket_tiene_tema` WRITE;
/*!40000 ALTER TABLE `ticket_tiene_tema` DISABLE KEYS */;
INSERT INTO `ticket_tiene_tema` VALUES (41,5),(42,6),(56,18),(56,18),(56,18),(46,7),(47,8),(48,9),(49,10),(50,11),(51,12),(52,13),(53,14),(54,15),(55,16),(56,18),(57,2),(58,2),(59,19),(59,20),(75,21);
/*!40000 ALTER TABLE `ticket_tiene_tema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_mortal` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pregunta` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_SU` int(11) DEFAULT NULL,
  `porcentaje` int(11) NOT NULL DEFAULT '0',
  `prioridad` enum('alto','medio','bajo') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (53,5200,'2017-03-21 18:05:37','una pregunta mas','<p>COntenido</p>\n',NULL,0,'bajo'),(54,5505,'2017-04-18 16:45:11','Una pregunta nueva','<p>Una descripci&oacute;n muy ilustrativa<p><img style=\"width: 1000px;\" data-filename=\"mundodisco.jpg\" src=\"/img/foro/58f688e7cd99a.jpeg\"><br></p></p>\n',NULL,0,'bajo'),(55,5505,'2017-04-20 16:40:55','Una pregunta','<p><b>Mas,</b><p><b style=\"background-color: rgb(255, 255, 0);\">asdasdas</b></p><p><b style=\"background-color: rgb(255, 255, 0);\"><br></b></p><p><b style=\"background-color: rgb(255, 255, 0);\">asdasdas</b><img style=\"width: 348.787px; height: 348.787px;\" data-filename=\"aRKKW7B_460s_v1.jpg\" src=\"/img/foro/58f92ae7764d8.jpeg\"></p><p>asdsad</p><p>asdasd</p></p>\n',NULL,0,'bajo'),(56,5200,'2017-04-28 20:55:43','Una pregunta','<p>ALasdsadsad</p>\n',NULL,0,'bajo'),(57,5200,'2017-04-28 20:56:54','asdasdasd','<p>asdasdasdasd</p>\n',NULL,0,'bajo'),(58,5200,'2017-04-28 21:01:20','asdfsadfasdf','<p>adafsdf</p>\n',NULL,20,'bajo'),(59,5200,'2017-04-28 21:01:59','asdfsadfasdf','<p>adafsdf</p>\n',NULL,0,'bajo'),(79,5505,'2017-06-24 17:45:19','¿Cómo me llamo?','<p>Ayuda D:</p>\n',NULL,0,NULL);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticketsu_tiene_estado`
--

DROP TABLE IF EXISTS `ticketsu_tiene_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketsu_tiene_estado` (
  `id_ticketSU` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketsu_tiene_estado`
--

LOCK TABLES `ticketsu_tiene_estado` WRITE;
/*!40000 ALTER TABLE `ticketsu_tiene_estado` DISABLE KEYS */;
INSERT INTO `ticketsu_tiene_estado` VALUES (9,4,'2017-04-15 18:19:45'),(9,2,'2017-04-15 18:19:52'),(9,1,'2017-04-15 18:19:58'),(13,11,'2017-04-15 18:22:23'),(13,10,'2017-04-15 18:22:27'),(9,29,'2017-04-17 13:43:44'),(9,30,'2017-04-17 15:19:37'),(9,31,'2017-04-17 15:19:59'),(9,32,'2017-04-17 15:20:15'),(9,33,'2017-04-17 15:28:28'),(13,34,'2017-04-17 15:28:38'),(13,35,'2017-04-17 17:14:49'),(13,36,'2017-04-17 17:15:13'),(9,37,'2017-04-17 17:17:13'),(9,38,'2017-04-17 17:18:04'),(9,39,'2017-04-17 17:18:26'),(9,40,'2017-04-17 17:18:51'),(38,41,'2017-04-17 18:05:37'),(39,42,'2017-04-18 16:45:12'),(39,43,'2017-04-18 22:02:28'),(40,44,'2017-04-20 16:40:55'),(40,45,'2017-04-20 17:02:31'),(39,46,'2017-04-28 18:38:30'),(9,47,'2017-04-28 18:39:42'),(9,48,'2017-04-28 18:49:14'),(40,49,'2017-04-28 18:49:41'),(40,50,'2017-04-28 18:51:23'),(40,51,'2017-04-28 18:51:34'),(40,52,'2017-04-28 18:52:08'),(40,53,'2017-04-28 18:53:39'),(40,54,'2017-04-28 18:53:54'),(40,55,'2017-04-28 18:54:52'),(40,56,'2017-04-28 18:55:05'),(39,57,'2017-04-28 18:57:04'),(39,58,'2017-04-28 18:58:13'),(40,59,'2017-04-28 18:59:02'),(40,60,'2017-04-28 19:00:44'),(41,61,'2017-04-28 20:55:43'),(41,62,'2017-04-28 20:56:25'),(42,63,'2017-04-28 20:56:54'),(43,64,'2017-04-28 21:01:20'),(44,65,'2017-04-28 21:01:59'),(45,66,'2017-04-28 21:03:33'),(46,67,'2017-04-28 21:05:31'),(47,68,'2017-04-28 21:11:38'),(48,69,'2017-04-28 21:12:24'),(49,70,'2017-04-28 21:12:32'),(50,71,'2017-04-28 21:12:38'),(51,72,'2017-04-28 21:14:25'),(52,73,'2017-04-28 21:14:37'),(53,74,'2017-04-28 21:14:51'),(54,75,'2017-04-28 21:15:11'),(55,76,'2017-04-28 21:15:36'),(55,77,'2017-04-28 21:24:05'),(55,78,'2017-04-28 21:24:29'),(55,79,'2017-04-28 21:25:07'),(55,80,'2017-04-28 21:26:06'),(55,81,'2017-04-28 21:26:26'),(55,82,'2017-04-28 21:26:53'),(56,83,'2017-04-28 21:27:14'),(56,84,'2017-04-28 21:27:36'),(56,85,'2017-04-28 21:29:32'),(56,86,'2017-04-28 21:31:11'),(56,87,'2017-04-28 21:31:45'),(56,88,'2017-04-28 21:32:16'),(56,89,'2017-04-28 21:32:27'),(57,90,'2017-05-03 17:42:06'),(58,91,'2017-05-03 17:48:37'),(59,92,'2017-05-31 17:52:33'),(58,93,'2017-05-31 20:22:26'),(55,94,'2017-05-31 20:24:48'),(57,95,'2017-05-31 20:34:06'),(58,96,'2017-05-31 21:08:09'),(0,97,'2017-06-24 16:40:01'),(0,98,'2017-06-24 16:42:32'),(0,99,'2017-06-24 16:43:37'),(58,100,'2017-06-24 16:43:56'),(59,101,'2017-06-24 16:44:14'),(56,102,'2017-06-24 16:44:55'),(59,103,'2017-06-24 17:05:42'),(75,104,'2017-06-24 17:09:49'),(57,105,'2017-06-24 17:15:56'),(57,106,'2017-06-24 17:16:11'),(58,107,'2017-06-24 17:36:02'),(58,108,'2017-06-24 17:37:43'),(58,109,'2017-06-24 17:38:18'),(76,110,'2017-06-24 17:42:36'),(77,111,'2017-06-24 17:43:17'),(78,112,'2017-06-24 17:43:48'),(79,113,'2017-06-24 17:45:19');
/*!40000 ALTER TABLE `ticketsu_tiene_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `areaTrabajo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `trabajo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_region` (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=5516 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5200,'asdasd@asd.com','asdf','Helena','Ruffin','ads','1234','981','asf','asdf',11,NULL),(5500,'1@1.com','123','123','123','123','123','123','123','123',12,NULL),(5501,'a@gmail.com','123456789','Luis Iván','Morett Arévalo','3311516589','38254926','123','una area','la empresa',13,NULL),(5503,'l@l.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','654987','789456','123000','00000','99999','9999','6666',1,''),(5504,'luisivanmorett@hotmail.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123','123','123123','123123','12','123123','123123',17,''),(5505,'luisivanmorett@gmail.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','Scott','Lenard','98515752','58742156','123','123123123','123123123',13,''),(5506,'luisivanmorett@mail.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','dasdasd','adsdasda','7657576567','567575765','677','asdasd','asdasdas',13,NULL),(5507,'luisivanmorett@m.com','$2y$10$VQDZAqT4qVaMmu.oiij5TOa7p1aYqYsLDnvcaxE1lGZTzg01FbMkW','dfsfafd','fsaddfas','6658556','67689','678','adsasd','hjgjh',12,NULL),(5508,'5@5.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','nombre','apellido','354984521','232145689','321','area','trabajo',7,''),(5509,'ll@ll.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','Nombre','Apellido','1569874123','5647891','321','asdfdas','algoooo',3,NULL),(5510,'mm@mm.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123456','654321','12345656','987654','56','23232121','121212',3,NULL),(5511,'aa@aaaa.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123456','654321','12345656','987654','56','23232121','121212',0,NULL),(5512,'aa@aaaaa.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123456','654321','12345656','987654','56','23232121','121212',3,NULL),(5513,'aaa@aaaaa.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123456','654321','12345656','987654','56','23232121','121212',3,NULL),(5514,'123456@lima.com','e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855','Luis Iván','Morett','123123456','12345678','123','23123','123123',14,NULL),(5515,'asdfg@asd.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','123465789','456213','123456','231123','123','123123','123231',3,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tiene_inventario`
--

DROP TABLE IF EXISTS `usuario_tiene_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_tiene_inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tiene_inventario`
--

LOCK TABLES `usuario_tiene_inventario` WRITE;
/*!40000 ALTER TABLE `usuario_tiene_inventario` DISABLE KEYS */;
INSERT INTO `usuario_tiene_inventario` VALUES (7,5200),(7,5501),(7,5505),(8,5508);
/*!40000 ALTER TABLE `usuario_tiene_inventario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-24 19:10:10
