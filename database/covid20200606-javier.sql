CREATE DATABASE  IF NOT EXISTS `covidform` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `covidform`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: covidform
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Administrador','admin',2,'javier.mantillap@upb.edu.co','$2y$10$Gbl.O3huMiXQGRWuYuqDqurLKhDpFYguYqJa.Eo6qpS0FzflfwHyO','2020-06-04 00:00:00','2020-06-06 16:20:20',1,1),(2,'Bader apellido','bader.apellido',1,'bader.apellido@upb.edu.co','$2y$10$j7v6t6gCGCUh/5JoAj3mBuI5XCcWPfrfFW4jNPeGtG8SQmTyWZ0V6','2020-06-06 16:26:34','2020-06-06 16:28:12',0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_ingreso`
--

LOCK TABLES `auditoria_ingreso` WRITE;
/*!40000 ALTER TABLE `auditoria_ingreso` DISABLE KEYS */;
INSERT INTO `auditoria_ingreso` VALUES (1,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-04 17:02:40','2020-06-04 17:02:40'),(2,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-04 18:46:53','2020-06-04 18:46:53'),(3,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-04 18:47:49','2020-06-04 18:47:49'),(4,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 07:50:24','2020-06-05 07:50:24'),(5,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 07:51:00','2020-06-05 07:51:00'),(6,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 07:59:07','2020-06-05 07:59:07'),(7,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 08:01:06','2020-06-05 08:01:06'),(8,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 08:10:45','2020-06-05 08:10:45'),(9,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 08:28:31','2020-06-05 08:28:31'),(10,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 08:30:10','2020-06-05 08:30:10'),(11,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 10:03:47','2020-06-05 10:03:47'),(12,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 10:30:44','2020-06-05 10:30:44'),(13,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 10:32:21','2020-06-05 10:32:21'),(14,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 10:32:44','2020-06-05 10:32:44'),(15,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 11:53:53','2020-06-05 11:53:53'),(16,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-05 17:36:04','2020-06-05 17:36:04'),(17,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-06 10:03:12','2020-06-06 10:03:12'),(18,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0','2020-06-06 19:36:01','2020-06-06 19:36:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Medellin','2020-06-05 00:00:00','2020-06-05 00:00:00',1),(2,'Bucaramanga','2020-06-05 00:00:00','2020-06-05 00:00:00',1),(3,'Monteria','2020-06-05 00:00:00','2020-06-05 00:00:00',1),(4,'Palmira','2020-06-05 00:00:00','2020-06-01 00:00:00',1);
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulario` (
  `n_idformulario` bigint(20) NOT NULL,
  `n_idusuario` bigint(20) DEFAULT NULL,
  `n_idsede` varchar(45) DEFAULT NULL,
  `t_consentimiento` char(2) NOT NULL COMMENT 'De manera voluntaria, en pleno conocimiento de que la información que registre será tratada a partir de la ley de protección de datos, consciente de mi compromiso como trabajador para el REPORTE DIARIO de estos datos en cumplimiento de la Resolución 666 de 24 abril de 2020 numeral 4.1  punto 4  y dando fe de que lo contestado corresponden a datos verídicos, autorizo el tratamiento de los mismos incluyendo los de salud que son sensibles, con la finalidad de desarrollar acciones de promoción y prevención, gestión de riesgos en salud y/o frente a la propagación, contagio y control de Covid 19.',
  `t_irahoy` char(2) DEFAULT NULL,
  `t_sitios` varchar(255) DEFAULT NULL,
  `t_actividades` varchar(255) DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idformulario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
INSERT INTO `formulario` VALUES (1,1,NULL,'s',NULL,NULL,NULL,'s',2,'s','s','s','s','s','s','2019-01-01',NULL,'2019-06-03 14:17:52','2020-06-03 14:17:52');
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
  `t_sede` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idsede`),
  UNIQUE KEY `n_idsede_UNIQUE` (`n_idsede`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
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
  `c_codtipo` char(2) DEFAULT NULL,
  `t_documento` varchar(50) NOT NULL,
  `t_idsigaa` varchar(20) DEFAULT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_telefono` varchar(100) DEFAULT NULL,
  `t_jefeinmediatocontacto` varchar(255) DEFAULT NULL,
  `t_facultadareaempresa` varchar(200) DEFAULT NULL,
  `n_idvinculouniversidad` bigint(20) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_activo` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_idtipousuario` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`n_idusuario`),
  UNIQUE KEY `users_t_email_unique` (`t_email`),
  UNIQUE KEY `t_documento_UNIQUE` (`t_documento`),
  UNIQUE KEY `users_t_idsigaa_unique` (`t_idsigaa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'Peña Fuentes','Jairo',NULL,'91268483','69365','jairo.pena@upb.edu.co',NULL,NULL,NULL,NULL,'pelias','S',1,'2020-06-02 05:00:00','2020-06-02 05:00:00');
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
  `t_vinculo` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_idvinculou`),
  UNIQUE KEY `n_idvinculou_UNIQUE` (`n_idvinculou`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinculou`
--

LOCK TABLES `vinculou` WRITE;
/*!40000 ALTER TABLE `vinculou` DISABLE KEYS */;
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

-- Dump completed on 2020-06-06 19:44:14
