CREATE DATABASE  IF NOT EXISTS `covidform` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `covidform`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: covidform
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_nombrecompleto` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_idciudad` bigint(20) DEFAULT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `b_todas` tinyint(1) DEFAULT '0',
  `b_habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`n_id`),
  KEY `fk_administradores_idciudad_ciudad_id_idx` (`n_idciudad`),
  CONSTRAINT `fk_administradores_idciudad_ciudad_id` FOREIGN KEY (`n_idciudad`) REFERENCES `ciudades` (`n_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'admininstrador','admin',NULL,'japefuloni@gmail.com','$2y$10$Afxvg/rNHDycfTIM/UvWneS6QkduQBd.GTObiq5Jb.uohOFgqpbfq',NULL,NULL,0,1);
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditoria_ingreso`
--

DROP TABLE IF EXISTS `auditoria_ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditoria_ingreso` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_idadministrador` bigint(20) NOT NULL,
  `t_ip` varchar(45) NOT NULL,
  `t_navegador` varchar(200) DEFAULT NULL,
  `dt_updated` datetime DEFAULT NULL,
  `dt_created` datetime NOT NULL,
  PRIMARY KEY (`n_id`),
  KEY `fk_auditoria_idadministrador_administrador_id_idx` (`n_idadministrador`),
  CONSTRAINT `fk_auditoria_idadministrador_administrador_id` FOREIGN KEY (`n_idadministrador`) REFERENCES `administradores` (`n_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_ingreso`
--

LOCK TABLES `auditoria_ingreso` WRITE;
/*!40000 ALTER TABLE `auditoria_ingreso` DISABLE KEYS */;
INSERT INTO `auditoria_ingreso` VALUES (1,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','2020-06-05 15:47:00','2020-06-05 15:47:00'),(2,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','2020-06-06 09:30:19','2020-06-06 09:30:19'),(3,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','2020-06-06 10:29:39','2020-06-06 10:29:39'),(4,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','2020-06-06 19:27:02','2020-06-06 19:27:02'),(5,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','2020-06-06 19:38:29','2020-06-06 19:38:29');
/*!40000 ALTER TABLE `auditoria_ingreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_nombre` varchar(45) NOT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_update_at` datetime DEFAULT NULL,
  `b_habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulario` (
  `n_idformulario` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_idusuario` bigint(20) DEFAULT NULL,
  `n_idsede` varchar(45) DEFAULT NULL,
  `t_consentimiento` char(2) NOT NULL COMMENT 'De manera voluntaria, en pleno conocimiento de que la información que registre será tratada a partir de la ley de protección de datos, consciente de mi compromiso como trabajador para el REPORTE DIARIO de estos datos en cumplimiento de la Resolución 666 de 24 abril de 2020 numeral 4.1  punto 4  y dando fe de que lo contestado corresponden a datos verídicos, autorizo el tratamiento de los mismos incluyendo los de salud que son sensibles, con la finalidad de desarrollar acciones de promoción y prevención, gestión de riesgos en salud y/o frente a la propagación, contagio y control de Covid 19.',
  `t_irahoy` char(2) NOT NULL,
  `t_sitios` varchar(255) DEFAULT NULL,
  `t_actividades` varchar(1000) DEFAULT NULL,
  `t_presentadofiebre` char(2) NOT NULL COMMENT '¿Ha presentado fiebre alta superior a 38º C (cuantificada con termómetro)?',
  `t_diasfiebre` int(3) DEFAULT NULL COMMENT 'En caso de haber presentado fiebre mayor a 38°C, ¿por cuántos días la ha presentado?',
  `t_dolorgarganta` char(2) NOT NULL COMMENT '¿Ha tenido dolor de garganta?',
  `t_malestargeneral` char(2) NOT NULL COMMENT '¿Ha tenido malestar general?',
  `t_secresioncongestionnasal` char(2) NOT NULL COMMENT '¿Ha tenido secreción nasal (moco) o congestión nasal?',
  `t_dificultadrespirar` char(2) NOT NULL COMMENT '¿Ha presentado dificultad para respirar?',
  `t_tosseca` char(2) NOT NULL COMMENT '¿Ha tenido tos seca y persistente?',
  `t_contactopersonasinfectadas` char(2) NOT NULL COMMENT '¿Ha estado en contacto con personas que han tenido sintomatología respiratoria o han estado relacionados con casos infectados de Coronavirus?',
  `d_ultimocontacto` date DEFAULT NULL COMMENT 'En caso de que en la anterior pregunta haya marcado "Sí", ¿en qué fecha se presentó el último contacto con la persona infectada?',
  `t_realizoviaje` char(2) DEFAULT NULL,
  `n_semaforo` int(11) DEFAULT NULL,
  `t_activo` char(2) DEFAULT NULL,
  `n_iddesactiva` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idformulario`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
INSERT INTO `formulario` VALUES (1,1,'3','SI','SI','tretret','ertret','SI',2,'SI','SI','SI','SI','SI','SI','2020-06-25','SI',NULL,NULL,NULL,'2020-06-05 03:47:21','2020-06-05 03:47:21'),(2,1,'3','SI','SI','tretret','ertret','SI',2,'SI','SI','SI','SI','SI','SI','2020-06-25','SI',NULL,NULL,NULL,'2020-06-05 03:47:21','2020-06-05 03:47:21'),(3,1,'3','SI','SI','sfsf','sdfsdf','SI',3,'SI','SI','NO','NO','NO','NO','2020-06-27','SI',NULL,NULL,NULL,'2020-06-05 04:51:39','2020-06-05 04:51:39'),(4,1,'2','SI','SI','dsfdsf','sdfdsf','NO',1,'NO','SI','SI','SI','SI','SI','2020-06-25','SI',NULL,NULL,NULL,'2020-06-05 04:55:23','2020-06-05 04:55:23'),(5,1,'2','SI','SI','tretret','ertret','SI',3,'NO','NO','NO','NO','NO','NO','2020-06-25','NO',NULL,NULL,NULL,'2020-06-05 04:56:38','2020-06-05 04:56:38'),(6,1,'2','SI','SI','fgfdg','gfdg','NO',2,'NO','SI','NO','SI','NO','NO','2020-06-25','SI',1,'NO',NULL,'2020-06-05 04:59:11','2020-06-05 04:59:11'),(7,1,'4','SI','SI','fdsff','ertret','SI',1,'SI','SI','SI','SI','SI','SI','2020-06-19','SI',1,'NO',NULL,'2020-06-05 18:17:38','2020-06-05 18:17:38'),(8,1,'2','SI','SI','d','d','SI',1,'SI','SI','SI','SI','SI','SI','2020-06-16','SI',1,'NO',NULL,'2020-06-05 18:25:51','2020-06-05 18:25:51'),(9,1,'2','SI','SI',NULL,NULL,'NO',NULL,'NO','NO','SI','NO','NO','NO','2020-06-19','NO',2,'NO',NULL,'2020-06-05 18:52:32','2020-06-05 18:52:32'),(10,1,'3','SI','NO',NULL,NULL,'SI',NULL,'NO','NO','NO','SI','NO','NO','2020-06-19','NO',3,'NO',NULL,'2020-06-05 18:53:56','2020-06-05 18:53:56'),(11,1,'3','SI','NO',NULL,NULL,'SI',NULL,'NO','NO','NO','SI','NO','NO','2020-06-19','NO',3,'NO',NULL,'2020-06-05 19:06:07','2020-06-05 19:06:07'),(12,1,'3','SI','NO','fdsdf',NULL,'SI',38,'NO','NO','NO','NO','NO','NO','2020-06-18','NO',2,'NO',NULL,'2020-06-05 15:21:18','2020-06-05 15:21:18'),(13,1,'3','SI','SI','dffsdf','sfdds','SI',3,'SI','SI','SI','SI','SI','SI','2020-06-10','SI',3,'NO',NULL,'2020-06-05 15:24:42','2020-06-05 15:24:42'),(14,1,'3','NO','SI',NULL,NULL,'SI',NULL,'SI','SI','SI','SI','SI','SI',NULL,'SI',3,'NO',NULL,'2020-06-05 17:09:48','2020-06-05 17:09:48'),(15,1,'3','SI','SI','dgfdg',NULL,'SI',NULL,'SI','SI','SI','SI','SI','SI','2020-06-18','SI',3,'NO',NULL,'2020-06-05 18:24:42','2020-06-05 18:24:42'),(16,1,'3','SI','SI','dgfd','ertret','SI',1,'NO','NO','NO','NO','NO','NO',NULL,'NO',2,'NO',0,'2020-06-05 18:27:19','2020-06-05 18:27:19'),(17,1,'2','NO','SI','fdsff','sdffsdfsdfsd','SI',3,'NO','NO','NO','NO','SI','NO','2020-06-19','NO',2,'SI',0,'2020-06-05 19:02:19','2020-06-05 19:02:19'),(19,1,'4','SI','NO',NULL,NULL,'NO',NULL,'NO','NO','NO','NO','NO','NO',NULL,'NO',1,'NO',0,'2020-06-06 14:07:45','2020-06-06 14:07:45'),(20,1,'3','SI','NO',NULL,NULL,'NO',NULL,'NO','NO','NO','NO','NO','SI',NULL,'NO',2,'NO',0,'2020-06-06 14:10:50','2020-06-06 14:10:50'),(21,1,'2','SI','NO',NULL,NULL,'NO',NULL,'NO','NO','NO','NO','NO','NO',NULL,'NO',1,'SI',0,'2020-06-06 14:12:54','2020-06-06 14:12:54');
/*!40000 ALTER TABLE `formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `n_idlog` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `n_idusuario` bigint(20) NOT NULL DEFAULT '0',
  `dh_fecha` datetime NOT NULL,
  `t_ipstr` varchar(50) DEFAULT NULL,
  `t_tabla` varchar(50) DEFAULT NULL,
  `n_idingresado` bigint(20) DEFAULT NULL,
  `c_accion` varchar(50) DEFAULT NULL,
  `t_accion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`n_idlog`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sedes` (
  `n_idsede` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_idciudad` bigint(20) DEFAULT NULL,
  `t_sede` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idsede`),
  UNIQUE KEY `n_idsede_UNIQUE` (`n_idsede`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
INSERT INTO `sedes` VALUES (1,NULL,'Medellín Sede Principal','2020-06-04 14:00:23','2020-06-04 14:00:23'),(2,NULL,'Bucaramanga','2020-06-04 14:00:23','2020-06-04 14:00:23'),(3,NULL,'Montería','2020-06-04 14:00:23','2020-06-04 14:00:23'),(4,NULL,'Palmira','2020-06-04 14:00:23','2020-06-04 14:00:23'),(5,NULL,'Bogotá','2020-06-04 14:00:23','2020-06-04 14:00:23'),(6,NULL,'Marinilla','2020-06-04 14:00:23','2020-06-04 14:00:23'),(7,NULL,'Llano Grande','2020-06-04 14:00:23','2020-06-04 14:00:23');
/*!40000 ALTER TABLE `sedes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `n_idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_idsede` bigint(20) DEFAULT NULL,
  `t_apellidos` varchar(50) NOT NULL,
  `t_nombres` varchar(50) NOT NULL,
  `c_codtipo` char(2) NOT NULL,
  `t_documento` varchar(50) NOT NULL,
  `t_idsigaa` varchar(20) DEFAULT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_telefono` varchar(100) NOT NULL,
  `t_jefeinmediatocontacto` varchar(255) NOT NULL,
  `t_facultadareaempresa` varchar(200) NOT NULL,
  `n_idvinculou` bigint(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_activo` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`n_idusuario`),
  UNIQUE KEY `users_t_email_unique` (`t_email`),
  UNIQUE KEY `t_documento_UNIQUE` (`t_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Peña Fuentes','Jairo','CC','91268483','69365','jairo.pena@upb.edu.co','3002079835','Arelis Gómez Nova','CTIC',2,'pelias','SI','2020-06-02 05:00:00','2020-06-06 15:31:03'),(2,4,'dasdas','adsasdsad','TI','91268484','534534535','japefuloni@gmail.com','7862654880','3534543','3453535',4,NULL,'SI','2020-06-05 23:38:44','2020-06-05 23:38:44'),(3,2,'dsfsfsdf','sdfsdfsd','CC','45435','5345345','54345@gmail.com','7862654880','adad','asdad',2,NULL,'SI','2020-06-06 12:43:33','2020-06-06 12:43:33'),(4,2,'33434234','234234234','CC','234324234','2342424','23@gmail.com','213123','21321','21312',5,NULL,'SI','2020-06-06 12:48:24','2020-06-06 12:48:24'),(5,3,'dfsfds','fddsfsf','CC','442','dsfds','sfdsd@gmail.com','sdfsf','sdfsdf','dsfsdf',3,NULL,'SI','2020-06-06 12:55:03','2020-06-06 12:55:03'),(7,2,'dadasd','asdasdasd','TI','2342423','0000435345345','f@gmail.com','dasdasd','adasds','adasd',4,NULL,'SI','2020-06-06 13:00:20','2020-06-06 13:00:20'),(8,3,'4234234','34324234','CE','5545345','345345345','5@hotmail.com','dasdsad','adsasd','adsadsa',2,NULL,'SI','2020-06-06 13:01:28','2020-06-06 13:01:28'),(9,5,'Prueba','Usuario','CC','91268269',NULL,'ga@gmail.com','302009898','Mario Calderón','Ecopetrol',5,NULL,'SI','2020-06-06 15:10:31','2020-06-06 15:18:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vinculou`
--

DROP TABLE IF EXISTS `vinculou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vinculou` (
  `n_idvinculou` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_vinculo` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idvinculou`),
  UNIQUE KEY `n_idvinculou_UNIQUE` (`n_idvinculou`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinculou`
--

LOCK TABLES `vinculou` WRITE;
/*!40000 ALTER TABLE `vinculou` DISABLE KEYS */;
INSERT INTO `vinculou` VALUES (1,'Docente','2020-06-04 13:14:44','2020-06-04 13:14:44'),(2,'Administrativo','2020-06-04 13:15:18','2020-06-04 13:15:18'),(3,'Estudiante','2020-06-04 13:15:18','2020-06-04 13:15:18'),(4,'Proveedor','2020-06-04 13:15:18','2020-06-04 13:15:18'),(5,'Contratista','2020-06-04 13:15:18','2020-06-04 13:15:18'),(6,'Egresado','2020-06-04 13:15:18','2020-06-04 13:15:18'),(7,'Visitante','2020-06-05 15:11:03','2020-06-05 15:11:03');
/*!40000 ALTER TABLE `vinculou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'covidform'
--

--
-- Dumping routines for database 'covidform'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-06 19:47:27
