-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: fd
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.13.04.1

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
-- Table structure for table `autoridad`
--

DROP TABLE IF EXISTS `autoridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autoridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_autoridad_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14FFC077418D0677` (`cargo_autoridad_id`),
  KEY `IDX_14FFC07771B61351` (`establecimiento_id`),
  CONSTRAINT `FK_14FFC077418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  CONSTRAINT `FK_14FFC07771B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autoridad`
--

LOCK TABLES `autoridad` WRITE;
/*!40000 ALTER TABLE `autoridad` DISABLE KEYS */;
INSERT INTO `autoridad` VALUES (1,11,13,'Marcela','PELANDA','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,11,23,'Viviana ','KAÑEVSKY','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,11,26,'Horacio A. ','BADARACCO','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,11,31,'Lic. Victor Carlos','BLOISE','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,12,31,'Lic. Virginia Ana','MONASTERIO','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,12,31,'Prof. Andrea López','ALBARELLOS','0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,12,31,'Prof. Francisco Hugo','Guinguis','0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,12,31,'Prof. Gustavo Mario','PRAVETTONI','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `autoridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bachillerato`
--

DROP TABLE IF EXISTS `bachillerato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bachillerato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `ciclo_basico` varchar(255) DEFAULT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_40A642E915CE31DF` (`oferta_educativa_id`),
  CONSTRAINT `FK_40A642E915CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bachillerato`
--

LOCK TABLES `bachillerato` WRITE;
/*!40000 ALTER TABLE `bachillerato` DISABLE KEYS */;
INSERT INTO `bachillerato` VALUES (1,'Bachillerato de prueba','Bachiller','si','5',14),(2,'Bachiller broquen','Bachiller','s','4',15);
/*!40000 ALTER TABLE `bachillerato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barrio`
--

DROP TABLE IF EXISTS `barrio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barrio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrio`
--

LOCK TABLES `barrio` WRITE;
/*!40000 ALTER TABLE `barrio` DISABLE KEYS */;
INSERT INTO `barrio` VALUES (29,'Palermo','PAL',NULL,NULL),(30,'Almagro','ALM',NULL,NULL),(31,'Flores','FLO',NULL,NULL),(32,'Villa Urquiza','URQ',NULL,NULL),(33,'Balvanera','BVN',NULL,NULL),(34,'Villa Lugano','VLG',NULL,NULL),(35,'Belgrano','BGN',NULL,NULL),(38,'Boedo','BOE',NULL,NULL),(39,'Agronomía','AGR',NULL,NULL),(40,'Barracas','BAR',NULL,NULL),(41,'Caballito','CBL',NULL,NULL),(42,'Chacarita','CHA',NULL,NULL),(43,'Coghlan','CHG',NULL,NULL),(44,'Colegiales','COL',NULL,NULL),(45,'Constitución','CTT',NULL,NULL),(46,'Floresta','FRT',NULL,NULL),(47,'La Boca','BOC',NULL,NULL),(48,'La Paternal','PAT',NULL,NULL),(49,'Liniers','LIN',NULL,NULL),(50,'Mataderos','MAT',NULL,NULL),(51,'Monte Castro','MCA',NULL,NULL),(52,'Monserrat','MON',NULL,NULL),(53,'Nueva Pompeya','POM',NULL,NULL),(54,'Núñez','NUÑ',NULL,NULL),(55,'Parque Avellaneda','AVE',NULL,NULL),(56,'Parque Chacabuco','CHA',NULL,NULL),(57,'Parque Chas','CHS',NULL,NULL),(58,'Parque Patricios','PPA',NULL,NULL),(59,'Puerto Madero','PMA',NULL,NULL),(60,'Recoleta','REC',NULL,NULL),(61,'Retiro','RET',NULL,NULL),(62,'Saavedra','SAA',NULL,NULL),(63,'San Cristóbal','SCR',NULL,NULL),(64,'San Nicolás','SIN',NULL,NULL),(65,'San Telmo','STE',NULL,NULL),(66,'Vélez Sársfield','VSA',NULL,NULL),(67,'Versalles','VER',NULL,NULL),(68,'Villa Crespo','VCR',NULL,NULL),(69,'Villa del Parque','VDP',NULL,NULL),(70,'Villa Devoto','VDV',NULL,NULL),(71,'Villa General Mitre','VGM',NULL,NULL);
/*!40000 ALTER TABLE `barrio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo_autoridad`
--

DROP TABLE IF EXISTS `cargo_autoridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo_autoridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_autoridad`
--

LOCK TABLES `cargo_autoridad` WRITE;
/*!40000 ALTER TABLE `cargo_autoridad` DISABLE KEYS */;
INSERT INTO `cargo_autoridad` VALUES (7,'Regente de Primaria','RNP'),(9,'Regente Terciario','RNT'),(11,'Rector/a','Rec'),(12,'Vicerrector/a','Vicer'),(13,'Director/a de Media','DNM'),(14,'Director/a de Inicial','DNI'),(15,'Vicedirector de Inicial','VNI'),(16,'Maestro Secretario de Inicial','MSNI'),(17,'Subregente de Primaria','SRNP'),(18,'Maestro Secretario de Primaria','MSNP'),(19,'Consejero de Terciario','CON'),(20,'Secreatrio de Terciario','SECNT'),(21,'Prosecretario de Terciario','PRONT'),(22,'Tutor de Terciario','TUNT'),(23,'Coordinador de Área','COONT'),(24,'Vicedirector de Media','VDNM'),(25,'Coordinador de Área de Media','COONM'),(26,'Consejero de Media','CONNM'),(27,'tutor de Media','TUNM'),(28,'Coordinador de tutores de Media','COOTM'),(29,'Prosecretario de Media','PRONM');
/*!40000 ALTER TABLE `cargo_autoridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `formacion_id` int(11) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estado_validez_id` int(11) DEFAULT NULL,
  `fecha_estado_validez` date DEFAULT NULL,
  `validez_desde` date DEFAULT NULL,
  `validez_hasta` date DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF1ECD3015CE31DF` (`oferta_educativa_id`),
  KEY `IDX_CF1ECD30F0798A6E` (`formacion_id`),
  KEY `IDX_CF1ECD309F5A440B` (`estado_id`),
  KEY `IDX_CF1ECD302C22C346` (`estado_validez_id`),
  CONSTRAINT `FK_CF1ECD3015CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  CONSTRAINT `FK_CF1ECD302C22C346` FOREIGN KEY (`estado_validez_id`) REFERENCES `estado_validez` (`id`),
  CONSTRAINT `FK_CF1ECD309F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`),
  CONSTRAINT `FK_CF1ECD30F0798A6E` FOREIGN KEY (`formacion_id`) REFERENCES `tipo_formacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'Profesor de Educación Primaria','Profesorado de Educación Primaria','4 años',1,13,1,5,'2008-02-02',NULL,'2014-06-20','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Técnico Superior en Producción de Indumentaria','Tecnicatura Superior en Producción de Indumentaria',NULL,2,4,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'Técnico Superior en Gastronomía','Tecnicatura Superior en Gastronomía',NULL,2,6,1,11,'2010-01-01','2010-01-01','2013-12-31','0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'Profesor de Educación Inicial','Profesorado de Educación Inicial',NULL,1,7,2,3,'2008-01-01','2011-02-02','2014-02-02','0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'Profesor de Inglés para el Nivel Inicial y Nivel Primario','Profesorado de Inglés para el Nivel Inicial y Nivel Primario','sbs',1,8,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'Profesor de Educación Superior en Inglés','Profesorado de Inglés para Nivel Medio y Superior','jrf',1,9,1,11,'2009-02-02','2009-02-02','2014-03-20','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'Profesor de Portugués para el Nivel Inicial y Nivel Primario','Profesorado de Portugués para el Nivel Inicial y Nivel Primario',NULL,1,10,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'Profesor/a de Educación Superior en Portugués','Profesorado de Portugués',NULL,1,11,1,5,'2012-04-03',NULL,'2014-01-01','0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Traductor Técnico-Científico-Literario en idioma Inglés','Traductorado Técnico-Científico-Literario en idioma Inglés',NULL,2,12,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'Traductor de Alemán','Traductorado en Alemán',NULL,2,16,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'Traductor de Inglés','Traductorado en Inglés',NULL,2,17,1,5,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'Profesor/a de Educación Superior en Filosofía','Profesorado de Filosofía','ies1',1,2,1,4,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'Traductor de Francés','Traductorado en Francés',NULL,2,18,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'Traductor de Portugués','Traductorado en Portugués',NULL,2,19,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'Profesor/a de Educación Superior en Inglés','Profesorado en Inglés',NULL,1,20,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'Profesor/a en Inglés para la Educación Inicial y Primaria','Profesorado en Inglés para Nivel Inicial y Primario','jrf',1,21,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'Profesor/a de Educación Superior en Francés','Profesorado en Francés','jrf',1,25,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'Profesor/a en Francés para la Educación Inicial y Primaria','Profesorado en Francés para Nivel Inicial y Primario','jrf',1,23,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'Profesor/a de Educación Lengua y Literatura','Profesorado de Lengua y Literatura','ies1',1,1,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'Profesor/a de Educación Superior en Psicología','Profesorado de Psicología','ies1',1,3,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'Ciclo de Formación Pedagógica para Profesionales y Técnicos Superiores','Ciclo de Formación Pedagógica para Profesionales y Técnicos Superiores','4',1,41,1,4,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'Profesor/a de Educación Superior en Alemán','Profesorado de Alemán',NULL,1,42,1,3,'2008-01-02',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'Profesorado en Portugués para nivel Inicial y Primario EGB 1 y 2','Profesorado en Portugués para nivel Inicial y Primario EGB 1 y 2',NULL,1,43,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'Profesor/a de Educación Superior en Portugués','Profesorado de Portugués',NULL,NULL,44,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'Profesor/a en Alemán para la Educación Inicial y Primaria','Profesorado en Alemán para Nivel Inicial y Primario',NULL,NULL,45,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,'Profesor/a de Educación Superior en Historia','Profesorado de Historia',NULL,NULL,46,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'Profesor/a de Educación Superior en Matemática','Profesorado de Matemática',NULL,NULL,47,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'Profesor/a de Educación Superior en Física','Profesorado de Física',NULL,NULL,48,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'Psicopedagogo','Psicopedagogía',NULL,NULL,49,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'Profesor/a de Educación Superior en Educación Física','Profesorado de Educación Física',NULL,1,50,1,5,'2010-10-06',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,'Profesor/a de Educación Superior en Educación Física','Profesorado de Educación Física',NULL,NULL,51,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'Profesor/a de Educación Superior en Educación Especial','Profesorado de Educación Especial',NULL,NULL,52,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,'Profesor/a de Educación Superior en Matemática','Profesorado de Matemática',NULL,NULL,53,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,'Profesor/a de Educación Superior en Física','Profesorado de Física',NULL,NULL,54,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,'Profesor/a de Educación Superior en Lengua y Literatura','Profesorado de Lengua y Literatura',NULL,NULL,55,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,'Profesor/a de Educación Superior en Educación Tecnológica','Profesorado de Educación Tecnológica',NULL,NULL,56,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,'Profesorado de Educación Secundaria de la modalidad Técnico Profesional en concurrencia con título de base','Profesorado de Educación Secundaria de la modalidad Técnico Profesional en concurrencia con título de base',NULL,NULL,57,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,'Profesor/a de Educación Superior en Ciencias de la Administración','Profesorado en Ciencias de la Administración',NULL,NULL,58,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'Profesor/a de Educación Superior en Ciencias Políticas con Orientación en Ciencias Jurídicas','Profesorado de Ciencias Políticas con Orientación en Ciencias Jurídicas',NULL,NULL,59,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'Profesor/a de Educación Superior en Psicología','Profesorado en Psicología',NULL,NULL,60,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,'Profesor/a de Educación Superior en Lengua y Literatura','Profesorado de Lengua y Literatura',NULL,NULL,61,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,'Profesor/a de Educación Superior en Biología','Profesorado de Biologia','3',1,62,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,'Profesor/a de Educación Superior en Economía','Profesorado en Economía',NULL,NULL,63,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,'Profesor/a de Educación Superior en Filosofía','Profesorado en Filosofìa',NULL,NULL,64,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,'Profesor/a de Educación Superior en Física','Profesorado de Física',NULL,1,65,1,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,'Profesor/a de Educación Superior en Francés','Profesorado en Francés',NULL,NULL,66,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,'Profesor/a de Educación Superior en Geografía','Profesorado de Geografía',NULL,NULL,67,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,'Profesor/a de Educación Superior en Historia','Profesorado de Historia',NULL,NULL,68,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,'Profesor/a en Educación Superior en Inglés','Profesorado en Inglés',NULL,NULL,69,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,'Profesor/a de Educación Superior en Ciencias Jurídicas','Profesorado en Ciencias Jurídicas',NULL,NULL,70,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,'Profesor/a de Educación Superior en Química','Profesorado de Química',NULL,NULL,71,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,'Profesor/a en Educación Superior de Italiano','Profesorado en Italiano',NULL,NULL,72,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'Profesor/a de Educación Superior en Matemática','Profesorado en Matemática',NULL,NULL,73,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,'Profesor/a de Educación Superior en Ciencias de la Educación','Profesorado en Ciencias de la Educación',NULL,NULL,74,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,'Profesor/a de Educación Superior en Ciencias Políticas','Profesorado en Ciencias Políticas',NULL,NULL,75,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,'Profesor/a de Educación Superior en Informática','Profesorado de Informática',NULL,NULL,76,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,'Profesor/a de Inglés para la Enseñanza en el Nivel Inicial y Primario','Profesorado en Inglés para el Nivel Inicial y Primario',NULL,NULL,77,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'Profesor/a en Educación Superior de Italiano para la Enseñanza Primaria','Profesorado en Italiano',NULL,NULL,78,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera_estado_validez`
--

DROP TABLE IF EXISTS `carrera_estado_validez`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera_estado_validez` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `estado_validez_id` int(11) DEFAULT NULL,
  `fecha_estado_validez` date DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77A76A52C22C346` (`estado_validez_id`),
  KEY `IDX_77A76A5C671B40F` (`carrera_id`),
  CONSTRAINT `FK_77A76A52C22C346` FOREIGN KEY (`estado_validez_id`) REFERENCES `estado_validez` (`id`),
  CONSTRAINT `FK_77A76A5C671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera_estado_validez`
--

LOCK TABLES `carrera_estado_validez` WRITE;
/*!40000 ALTER TABLE `carrera_estado_validez` DISABLE KEYS */;
INSERT INTO `carrera_estado_validez` VALUES (13,42,6,'2010-10-11','2013-06-17 16:13:02'),(14,42,10,'2010-10-12','2013-06-17 16:13:22'),(15,42,11,'2010-10-14','2013-06-17 16:13:39'),(16,42,3,'2010-10-15','2013-06-17 16:14:47'),(17,42,4,'2010-10-15','2013-06-17 16:16:23'),(18,8,5,'2013-05-13','2013-06-17 16:57:41'),(19,8,NULL,'2013-05-13','2013-06-17 16:58:12');
/*!40000 ALTER TABLE `carrera_estado_validez` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cgp`
--

DROP TABLE IF EXISTS `cgp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cgp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF692037F55AE19E` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cgp`
--

LOCK TABLES `cgp` WRITE;
/*!40000 ALTER TABLE `cgp` DISABLE KEYS */;
INSERT INTO `cgp` VALUES (113,'1'),(122,'10'),(123,'11'),(124,'12'),(125,'13'),(126,'14'),(127,'15'),(128,'16'),(114,'2'),(115,'3'),(116,'4'),(117,'5'),(118,'6'),(119,'7'),(120,'8'),(121,'9');
/*!40000 ALTER TABLE `cgp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cohorte`
--

DROP TABLE IF EXISTS `cohorte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cohorte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_oferta_id` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `matricula_ingresantes` int(11) DEFAULT NULL,
  `matricula_inicial` int(11) DEFAULT NULL,
  `matricula_final` int(11) DEFAULT NULL,
  `egreso` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35697A4BD1F42FF` (`unidad_oferta_id`),
  CONSTRAINT `FK_35697A4BD1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cohorte`
--

LOCK TABLES `cohorte` WRITE;
/*!40000 ALTER TABLE `cohorte` DISABLE KEYS */;
INSERT INTO `cohorte` VALUES (1,36,2012,100,1000,500,200,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,36,2011,50,800,200,50,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,22,2011,50,100,80,15,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,22,2012,45,50,45,15,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,21,2011,30,40,32,31,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,21,2012,55,65,15,4,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,21,2009,50,500000,45,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,21,2010,50,60,40,20,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,19,2009,123,123,123,123,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,19,2010,1,2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,19,2013,22,22,22,22,'2013-04-25 17:15:13','0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,2,2009,123,1231,1231,6,'2013-04-25 18:22:09','0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,2,2012,1231,123,123,1,'2013-04-25 18:31:04','0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,21,2000,665,666,666,666,'2013-05-07 15:09:35','0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,45,2013,1,1,1,1,'2013-05-09 17:01:57','0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,2,2008,1,1,1,1,'2013-05-09 17:07:15','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cohorte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comuna`
--

DROP TABLE IF EXISTS `comuna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comuna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comuna`
--

LOCK TABLES `comuna` WRITE;
/*!40000 ALTER TABLE `comuna` DISABLE KEYS */;
INSERT INTO `comuna` VALUES (113,1),(114,2),(115,3),(116,4),(117,5),(118,6),(119,7),(120,8),(121,9),(122,10),(123,11),(124,12),(125,13),(126,14),(127,15),(128,16);
/*!40000 ALTER TABLE `comuna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dia`
--

DROP TABLE IF EXISTS `dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(15) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia`
--

LOCK TABLES `dia` WRITE;
/*!40000 ALTER TABLE `dia` DISABLE KEYS */;
INSERT INTO `dia` VALUES (36,'DOM','Domingo',1),(37,'LUN','Lunes',2),(38,'MAR','Martes',3),(39,'MIE','Miércoles',4),(40,'JUE','Jueves',5),(41,'VIE','Viernes',6),(42,'SAB','Sábado',7);
/*!40000 ALTER TABLE `dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distrito_escolar`
--

DROP TABLE IF EXISTS `distrito_escolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distrito_escolar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distrito_escolar`
--

LOCK TABLES `distrito_escolar` WRITE;
/*!40000 ALTER TABLE `distrito_escolar` DISABLE KEYS */;
INSERT INTO `distrito_escolar` VALUES (148,1,'1'),(149,2,'2'),(150,3,'3'),(151,4,'4'),(152,5,'5'),(153,6,'6'),(154,7,'7'),(155,8,'8'),(156,9,'9'),(157,10,'10'),(158,11,'11'),(159,12,'12'),(160,13,'13'),(161,14,'14'),(162,15,'15'),(163,16,'16'),(164,17,'17'),(165,18,'18'),(166,19,'19'),(167,20,'20'),(168,21,'21');
/*!40000 ALTER TABLE `distrito_escolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domicilio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edificio_id` int(11) DEFAULT NULL,
  `calle` varchar(50) NOT NULL,
  `altura` varchar(5) NOT NULL,
  `piso` varchar(3) DEFAULT NULL,
  `departamento` varchar(2) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `c_postal` varchar(8) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B942ED18A652BD6` (`edificio_id`),
  CONSTRAINT `FK_9B942ED18A652BD6` FOREIGN KEY (`edificio_id`) REFERENCES `edificio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domicilio`
--

LOCK TABLES `domicilio` WRITE;
/*!40000 ALTER TABLE `domicilio` DISABLE KEYS */;
INSERT INTO `domicilio` VALUES (19,19,'Córdoba, Av.','1950',NULL,NULL,NULL,1,'C1120AA','0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,20,'La Rioja','1042',NULL,NULL,NULL,1,'1181','0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,21,'Carlos Calvo','3150',NULL,NULL,NULL,1,'1181','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,22,'Gral Urquiza','277',NULL,NULL,NULL,0,'C1215AD','0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,22,'Moreno','3111',NULL,NULL,NULL,1,'C1215AD','0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,23,'Bolívar','1235',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,24,'Saraza','4241',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,25,'Rivadavia, Av.','4950',NULL,NULL,NULL,1,'C1424CE','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,26,'Arcamendia','743',NULL,NULL,NULL,1,'C1274AA','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,27,'Suárez','2103',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,40,'Ayacucho','632',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,41,'Curapaligüe','1150',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,42,'Guemes','3859',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,43,'Corrientes, Av.','4261',NULL,NULL,NULL,1,'C1195AA','0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,44,'Callao, Av.','450',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,45,'Guardia Vieja','4266',NULL,NULL,NULL,1,'C1195AA','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,46,'O Higgins','2441',NULL,NULL,NULL,1,'C1428AG','0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,47,'3 de Febrero','2300',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,48,'Dean Funes','1821',NULL,NULL,NULL,1,'C1244AM','0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,51,'Juncal','3251',NULL,NULL,NULL,1,'C1425AYQ','0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,53,'Lascano','3840 ',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,54,'C. Pellegrini','1515',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,55,'Dorrego','3781 ',NULL,NULL,NULL,1,'C1425GBB','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,52,'Córdoba, Av.','2016',NULL,NULL,NULL,1,'C1120AAP','0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,57,'Miguel Sanchéz','1050',NULL,NULL,NULL,1,'C1429BSN','0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,56,'Paraguay','3925',NULL,NULL,NULL,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,19,'Ayacucho','875',NULL,NULL,NULL,0,'1425','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `domicilio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domicilio_localizacion`
--

DROP TABLE IF EXISTS `domicilio_localizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domicilio_localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domicilio_id` int(11) DEFAULT NULL,
  `localizacion_id` int(11) DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DABAA005166FC4DD` (`domicilio_id`),
  KEY `IDX_DABAA005C851F487` (`localizacion_id`),
  CONSTRAINT `FK_DABAA005166FC4DD` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`id`),
  CONSTRAINT `FK_DABAA005C851F487` FOREIGN KEY (`localizacion_id`) REFERENCES `localizacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domicilio_localizacion`
--

LOCK TABLES `domicilio_localizacion` WRITE;
/*!40000 ALTER TABLE `domicilio_localizacion` DISABLE KEYS */;
INSERT INTO `domicilio_localizacion` VALUES (36,19,36,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,19,38,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,19,37,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,19,39,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,20,41,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,20,42,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,21,40,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,23,43,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,23,44,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,23,45,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,26,46,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,26,47,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,26,48,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,26,49,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,27,50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,27,51,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,27,52,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,28,53,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,33,54,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,33,55,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,35,56,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,33,57,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,36,58,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,36,59,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,36,60,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,36,61,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,40,62,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,40,64,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,40,65,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,40,66,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,41,67,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,41,68,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,41,69,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,41,70,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,45,71,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,42,72,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,42,73,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,42,74,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,42,75,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,43,76,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,43,77,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,43,78,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,44,79,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,44,80,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,32,82,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,49,81,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,46,83,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,30,84,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,24,85,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,25,88,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,50,37,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `domicilio_localizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `duracion`
--

DROP TABLE IF EXISTS `duracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `duracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(1) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `duracion`
--

LOCK TABLES `duracion` WRITE;
/*!40000 ALTER TABLE `duracion` DISABLE KEYS */;
INSERT INTO `duracion` VALUES (15,'C','Cuatrimestral'),(16,'A','Anual');
/*!40000 ALTER TABLE `duracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edificio`
--

DROP TABLE IF EXISTS `edificio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edificio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna_id` int(11) DEFAULT NULL,
  `cgp_id` int(11) DEFAULT NULL,
  `barrio_id` int(11) DEFAULT NULL,
  `distrito_escolar_id` int(11) DEFAULT NULL,
  `cui` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DED4A4E8D3F6F824` (`cui`),
  KEY `IDX_DED4A4E873AEFE7` (`comuna_id`),
  KEY `IDX_DED4A4E8E68FCBB4` (`cgp_id`),
  KEY `IDX_DED4A4E8DBA79E2A` (`barrio_id`),
  KEY `IDX_DED4A4E862E97D21` (`distrito_escolar_id`),
  CONSTRAINT `FK_DED4A4E862E97D21` FOREIGN KEY (`distrito_escolar_id`) REFERENCES `distrito_escolar` (`id`),
  CONSTRAINT `FK_DED4A4E873AEFE7` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`),
  CONSTRAINT `FK_DED4A4E8DBA79E2A` FOREIGN KEY (`barrio_id`) REFERENCES `barrio` (`id`),
  CONSTRAINT `FK_DED4A4E8E68FCBB4` FOREIGN KEY (`cgp_id`) REFERENCES `cgp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edificio`
--

LOCK TABLES `edificio` WRITE;
/*!40000 ALTER TABLE `edificio` DISABLE KEYS */;
INSERT INTO `edificio` VALUES (19,114,114,29,148,12,12,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,115,116,30,153,123456790,1500,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,124,116,30,154,1233211,255,'2012-11-05 15:45:16','0000-00-00 00:00:00'),(22,115,113,33,153,555555,1000,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,113,113,33,151,333333,50,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,120,113,34,168,333301,10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,118,113,41,155,4444,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,116,113,40,152,5555,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,113,113,40,152,5552,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,115,113,33,148,3,3,NULL,'2012-11-09 16:25:54'),(41,119,113,56,155,4333,4333,NULL,'2012-11-09 17:03:33'),(42,126,113,29,149,6666666,66666,NULL,'2012-11-09 17:09:11'),(43,117,113,29,149,777777,777777,NULL,'2012-11-09 17:11:33'),(44,115,113,29,148,9999999,99999,NULL,'2012-11-09 17:13:30'),(45,113,113,29,149,757575,757575,NULL,'2012-11-09 17:15:17'),(46,125,113,35,157,1010,1010,NULL,'2012-11-12 13:28:24'),(47,113,113,35,149,1003,5000,NULL,'2012-11-12 14:37:10'),(48,116,113,55,158,11,11,NULL,'2012-11-12 15:11:51'),(51,126,113,55,148,44,44,'2012-11-12 15:29:39','2012-11-12 15:29:39'),(52,115,113,52,148,111111,111111,NULL,'2012-11-12 15:44:23'),(53,123,114,29,164,222,222,'2012-11-12 15:51:40','2012-11-12 15:51:40'),(54,113,113,29,148,55,55,'2012-11-12 16:02:19','2012-11-12 16:02:19'),(55,126,113,35,148,8888,8888,'2012-11-12 16:27:54','2012-11-12 16:27:54'),(56,113,113,29,149,6565,6565,NULL,'2012-11-12 16:33:34'),(57,125,113,54,157,9911,9911,'2012-11-12 16:46:58','2012-11-12 16:46:58');
/*!40000 ALTER TABLE `edificio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especializacion`
--

DROP TABLE IF EXISTS `especializacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especializacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera` varchar(255) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_especializacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_24C61C0415CE31DF` (`oferta_educativa_id`),
  KEY `IDX_24C61C049F5A440B` (`estado_id`),
  KEY `IDX_24C61C046CBBC6BF` (`tipo_especializacion_id`),
  CONSTRAINT `FK_24C61C0415CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  CONSTRAINT `FK_24C61C046CBBC6BF` FOREIGN KEY (`tipo_especializacion_id`) REFERENCES `tipo_especializacion` (`id`),
  CONSTRAINT `FK_24C61C049F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especializacion`
--

LOCK TABLES `especializacion` WRITE;
/*!40000 ALTER TABLE `especializacion` DISABLE KEYS */;
INSERT INTO `especializacion` VALUES (1,NULL,27,NULL,'Especialización Superior en Políticas de Infancia',NULL,1,5),(2,NULL,28,NULL,'Especialización Superior en Jardín Maternal',NULL,1,5),(3,NULL,29,NULL,'Especialización Superior en Estimulación Temprana',NULL,1,NULL),(4,NULL,30,NULL,'Especialización Superior en Informática Educativa',NULL,1,NULL),(5,NULL,31,NULL,'Especialización Superior en Profesor Tutor',NULL,1,NULL),(6,NULL,32,NULL,'Especialización Superior en Conducción de Instituciones de Nivel Medio y Equivalente',NULL,1,NULL),(7,NULL,33,NULL,'Especialización Superior en Investigación Educativa',NULL,1,NULL),(8,NULL,34,NULL,'Diplomatura Superior en Ciencias del Lenguaje',NULL,1,3),(10,NULL,35,NULL,'Especialización Superior en Educación Sexual',NULL,1,NULL),(11,NULL,36,NULL,'Diplomatura Superior en Matemática Educativa',NULL,1,NULL),(12,NULL,37,NULL,'Interculturalidad y Enseñanza del Español como Lengua Segunda\r y Extranjera',NULL,1,NULL),(13,NULL,38,NULL,'Actualización Académica en Educación Ambiental',NULL,2,NULL),(14,NULL,39,NULL,'Especialización Docente de Nivel Superior en Educación en Contextos de Encierro',NULL,1,NULL),(15,NULL,40,NULL,'Especialización en Enseñanza de la Astronomía para la Educación Primaria',NULL,1,NULL),(16,NULL,82,'Prácticas corporales y motrices conscientes desde un enfoque interdisciplinario','Diplomatura Superior en Prácticas corporales y motrices conscientes desde un enfoque interdisciplinario','2 años',1,NULL),(17,NULL,83,'La narrativa en la obra escrita a través de los canales expresivos audiovisuales','La narrativa en la obra escrita a través de los canales expresivos audiovisuales',NULL,1,NULL);
/*!40000 ALTER TABLE `especializacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito_escolar_id` int(11) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `cue` varchar(7) DEFAULT NULL,
  `codigo_previo_transferencia` varchar(7) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `descripcion` varchar(15) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `tiene_cooperadora` tinyint(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `apodo` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `tipo_establecimiento_id` int(11) DEFAULT NULL,
  `nombre_autoridad` varchar(255) DEFAULT NULL,
  `cargo_autoridad_id` int(11) DEFAULT NULL,
  `campo_deportes` varchar(25) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94A4D17E62E97D21` (`distrito_escolar_id`),
  KEY `IDX_94A4D17EDE95C867` (`sector_id`),
  KEY `IDX_94A4D17EE83582FE` (`tipo_establecimiento_id`),
  KEY `IDX_94A4D17E418D0677` (`cargo_autoridad_id`),
  CONSTRAINT `FK_94A4D17E418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  CONSTRAINT `FK_94A4D17E62E97D21` FOREIGN KEY (`distrito_escolar_id`) REFERENCES `distrito_escolar` (`id`),
  CONSTRAINT `FK_94A4D17EDE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`),
  CONSTRAINT `FK_94A4D17EE83582FE` FOREIGN KEY (`tipo_establecimiento_id`) REFERENCES `tipo_establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (13,148,22,'200696','zzz','Escuela Normal Superior Nro 1 Roque Saenz Peña',1,NULL,'2012-10-29',1,'http://ens1de1.buenosaires.edu.ar','ENS 1','ens1@bue.edu.ar',1,1,'Marcela Pelanda',11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,153,22,'201778','aaa2','Escuela Normal Superior Nro 8 Julio Argentino Roca',8,'ENS 8','2012-10-29',1,'http://ens8de6.buenosaires.edu.ar/ens8.htm','ENS 8','ens8@bue.edu.ar',8,1,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,153,22,'200866',NULL,'Escuela Normal Superior Nro 2 Mariano Acosta',2,NULL,NULL,0,NULL,'ENS 2',NULL,2,1,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,148,22,'200720',NULL,'Instituto de Enseñanza Superior Nro 1 Alicia Moreau',13,NULL,NULL,0,NULL,'IES 1',NULL,13,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,153,22,'021354',NULL,'Instituto de Enseñanza Superior Nro 2 Mariano Acosta',2,NULL,NULL,0,NULL,'IES 2',NULL,14,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,151,22,'200536',NULL,'Escuela Normal Superior Nro 3 Bernardino Rivadavia',3,NULL,NULL,0,NULL,'ENS 3',NULL,3,1,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,155,22,'201297',NULL,'Escuela Normal Superior Nro 4 Estanislao Severo Zeballos',4,NULL,NULL,0,NULL,'ENS 4',NULL,4,1,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,152,22,'201328',NULL,'Escuela Normal Superior Nro 5 General Don Martín Miguel de Güemes',5,NULL,NULL,0,NULL,'ENS 5',NULL,5,1,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,149,22,'200717',NULL,'Escuela Normal Superior Nro 6 Vicente López y Planes',6,NULL,NULL,0,NULL,'ENS 6',NULL,6,1,NULL,11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,149,22,'200997',NULL,'Escuela Normal Superior Nro 7 José María Torres',7,NULL,NULL,0,NULL,'ENS 7',NULL,7,1,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,148,22,'201177',NULL,'Escuela Normal Superior Nro 9 Domingo Faustino Sarmiento',9,NULL,NULL,0,NULL,'ENS 9',NULL,9,1,'Viviana KAÑEVSKY',11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,157,22,'201214',NULL,'Escuela Normal Superior Nro 10 Juan Bautista Alberdi',10,NULL,NULL,0,NULL,'ENS 10',NULL,10,1,NULL,11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,158,22,'201693',NULL,'Escuela Normal Superior Nro 11 Ricardo Levene',11,NULL,NULL,0,NULL,'ENS 11',NULL,11,1,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,148,22,'200708',NULL,'Escuela Normal Superior en Lenguas Vivas Sofía E. Broquen de Spangenberg',12,NULL,NULL,0,NULL,'Spangenberg',NULL,12,1,'Horacio A. BADARACCO',11,'propio en la escuela','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,164,22,'200895',NULL,'Instituto de Educación Superior Juan B. Justo',NULL,NULL,NULL,0,NULL,'JBJusto',NULL,15,2,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,148,22,'200584',NULL,'Instituto de Enseñanza Superior en Lenguas Vivas Juan Ramón Fernández',NULL,NULL,NULL,0,NULL,'JRF',NULL,16,3,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,148,22,'201329',NULL,'Instituto Superior del Profesorado de Educación Inicial Sara C. Eccleston',NULL,NULL,NULL,0,NULL,'Eccleston',NULL,17,4,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,149,22,'201414',NULL,'Instituto Superior del Profesorado de Educación Especial',NULL,NULL,NULL,0,NULL,'ISPEE',NULL,18,4,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,157,22,'201019',NULL,'Instituto Superior de Educación Física Nro 1 Dr. Enrique Romero Brest',NULL,NULL,NULL,0,'http://www.romerobrest.edu.ar/','Romero',NULL,19,5,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,155,22,'201393',NULL,'Instituto Superior de Educación Física Federico Williams Dickens',NULL,NULL,NULL,0,'http://www.institutodickens.edu.ar/','Dickens','iefdickens@yahoo.com.ar',20,5,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,148,22,'201104',NULL,'Instituto Superior del Profesorado Dr. Joaquín V. González',NULL,NULL,NULL,0,NULL,'Joaquín',NULL,21,4,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento_edificio`
--

DROP TABLE IF EXISTS `establecimiento_edificio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_edificio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cue_anexo` varchar(2) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `te1` varchar(255) DEFAULT NULL,
  `te2` varchar(255) DEFAULT NULL,
  `te3` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `establecimientos_id` int(11) DEFAULT NULL,
  `edificios_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_37D12C65FB6C6A54` (`establecimientos_id`),
  KEY `IDX_37D12C65884BAFEF` (`edificios_id`),
  CONSTRAINT `FK_37D12C65884BAFEF` FOREIGN KEY (`edificios_id`) REFERENCES `edificio` (`id`),
  CONSTRAINT `FK_37D12C65FB6C6A54` FOREIGN KEY (`establecimientos_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_edificio`
--

LOCK TABLES `establecimiento_edificio` WRITE;
/*!40000 ALTER TABLE `establecimiento_edificio` DISABLE KEYS */;
INSERT INTO `establecimiento_edificio` VALUES (16,'00','Sede ENS 1','2012-10-29',NULL,'4444444','5555',NULL,NULL,NULL,13,19),(17,'00','Sede ENS 8','2012-10-29',NULL,NULL,NULL,NULL,NULL,NULL,14,20),(18,'01','Anexo Carlos Calvo','2012-10-29',NULL,NULL,NULL,NULL,NULL,NULL,14,21),(19,'00','Sede ENS 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,22),(20,'00','Sede IES 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,22),(21,'00','sede ENS 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,23),(22,'01','anexo Lugano',NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,24),(23,'00','sede ens 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,25),(24,'00','sede ENS 5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,26),(25,'01','anexo ENS 5','2008-01-01',NULL,NULL,NULL,NULL,NULL,NULL,20,27),(27,'00','sede joaquin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,33,40),(28,'00','sede ens 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,42),(29,'00','sede ens 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,43),(30,'00','sede ENS 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,23,44),(31,'01','anexo ens 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,45),(32,'00','sede ens 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,24,46),(33,'01','anexo ens 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,24,47),(34,'00','sede ens 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,25,48),(35,'00','sede spangenberg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,26,51),(36,'00','sele IES 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,16,52),(37,'00','sele jbj',NULL,NULL,NULL,NULL,NULL,NULL,NULL,27,53),(38,'00','sede Lengusa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,28,54),(39,'00','sede Eccleston',NULL,NULL,NULL,NULL,NULL,NULL,NULL,29,55),(40,'00','sede ISPEE','2008-01-01',NULL,NULL,NULL,NULL,NULL,NULL,30,42),(41,'01','anexo ISPEE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,56),(42,'00','sede Brest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,31,57),(43,'00','sede Dickens',NULL,NULL,NULL,NULL,NULL,NULL,NULL,32,41),(51,'00','asdfasdf',NULL,NULL,'33333333333333',NULL,NULL,NULL,NULL,13,19);
/*!40000 ALTER TABLE `establecimiento_edificio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_carrera`
--

DROP TABLE IF EXISTS `estado_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_carrera`
--

LOCK TABLES `estado_carrera` WRITE;
/*!40000 ALTER TABLE `estado_carrera` DISABLE KEYS */;
INSERT INTO `estado_carrera` VALUES (1,'ACT','Activa',1),(2,'INAC','Inactiva',2),(3,'VIG','Vigente',3),(4,'RES','Residual',4);
/*!40000 ALTER TABLE `estado_carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_validez`
--

DROP TABLE IF EXISTS `estado_validez`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_validez` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_validez`
--

LOCK TABLES `estado_validez` WRITE;
/*!40000 ALTER TABLE `estado_validez` DISABLE KEYS */;
INSERT INTO `estado_validez` VALUES (3,'FT','Falta presentar',1),(4,'ET','En trámite',2),(5,'AP','Aprobado',3),(6,'AC','Acordado',4),(10,'RE','Rechazado',5),(11,'APN','Aprobado nominal',6);
/*!40000 ALTER TABLE `estado_validez` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glosario`
--

DROP TABLE IF EXISTS `glosario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glosario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `termino` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glosario`
--

LOCK TABLES `glosario` WRITE;
/*!40000 ALTER TABLE `glosario` DISABLE KEYS */;
INSERT INTO `glosario` VALUES (1,'Matrícula inicial','Se toma aproximandamente a los 30 días de iniciadas las clases. Incluye a la matrícula de ingresantes'),(2,'Matrícula ingresantes','Cantidad de alumnos que ingresan a carrera'),(3,'Desgranamiento','Matícula inicial - matrícula final');
/*!40000 ALTER TABLE `glosario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_etario`
--

DROP TABLE IF EXISTS `grupo_etario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_etario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_etario`
--

LOCK TABLES `grupo_etario` WRITE;
/*!40000 ALTER TABLE `grupo_etario` DISABLE KEYS */;
INSERT INTO `grupo_etario` VALUES (3,'5','5 años',6),(4,'4','4 años',5),(5,'3','3 años',4),(6,'2','2 años',3),(7,'D','Deambulador (de 1 a 2 años)',2),(8,'L','Lactario (45 días a 1 año)',1);
/*!40000 ALTER TABLE `grupo_etario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inicial`
--

DROP TABLE IF EXISTS `inicial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inicial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `duracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_73E9728915CE31DF` (`oferta_educativa_id`),
  CONSTRAINT `FK_73E9728915CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inicial`
--

LOCK TABLES `inicial` WRITE;
/*!40000 ALTER TABLE `inicial` DISABLE KEYS */;
INSERT INTO `inicial` VALUES (1,84,'5');
/*!40000 ALTER TABLE `inicial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inicial_x`
--

DROP TABLE IF EXISTS `inicial_x`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inicial_x` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_oferta_id` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_766EEA91D1F42FF` (`unidad_oferta_id`),
  CONSTRAINT `FK_766EEA91D1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inicial_x`
--

LOCK TABLES `inicial_x` WRITE;
/*!40000 ALTER TABLE `inicial_x` DISABLE KEYS */;
INSERT INTO `inicial_x` VALUES (1,122,50,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,127,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,128,30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,129,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,130,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,131,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,132,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,133,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,134,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,135,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,124,5,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,136,5,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,137,5,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `inicial_x` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_maintenance`
--

DROP TABLE IF EXISTS `lexik_maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_maintenance` (
  `ttl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_maintenance`
--

LOCK TABLES `lexik_maintenance` WRITE;
/*!40000 ALTER TABLE `lexik_maintenance` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localizacion`
--

DROP TABLE IF EXISTS `localizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `establecimiento_edificio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5512F061BF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_5512F061E0B84520` (`establecimiento_edificio_id`),
  CONSTRAINT `FK_5512F061BF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`),
  CONSTRAINT `FK_5512F061E0B84520` FOREIGN KEY (`establecimiento_edificio_id`) REFERENCES `establecimiento_edificio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localizacion`
--

LOCK TABLES `localizacion` WRITE;
/*!40000 ALTER TABLE `localizacion` DISABLE KEYS */;
INSERT INTO `localizacion` VALUES (36,43,16),(37,44,16),(38,45,16),(39,46,16),(40,47,18),(41,48,17),(42,49,17),(43,51,19),(44,52,19),(45,53,20),(46,54,23),(47,55,23),(48,56,23),(49,57,23),(50,58,24),(51,59,24),(52,60,24),(53,61,25),(54,62,29),(55,63,29),(56,64,31),(57,65,29),(58,66,32),(59,67,32),(60,68,32),(61,69,32),(62,75,34),(64,76,34),(65,77,34),(66,78,34),(67,79,35),(68,80,35),(69,81,35),(70,82,35),(71,83,36),(72,84,37),(73,85,37),(74,86,37),(75,87,37),(76,88,38),(77,89,38),(78,90,38),(79,91,39),(80,92,39),(81,93,40),(82,93,41),(83,94,42),(84,95,43),(85,100,21),(86,101,21),(87,102,21),(88,103,22),(89,96,28),(92,97,28),(93,98,28),(94,99,28);
/*!40000 ALTER TABLE `localizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20130903145540'),('20130920172325'),('20130920174433'),('20130924152107'),('20130924153308'),('20131018112552');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidad`
--

DROP TABLE IF EXISTS `modalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidad`
--

LOCK TABLES `modalidad` WRITE;
/*!40000 ALTER TABLE `modalidad` DISABLE KEYS */;
INSERT INTO `modalidad` VALUES (29,'Común','Cmn'),(30,'Artística','Art'),(31,'Especial','Esp'),(32,'Jóvenes y adultos','JyA');
/*!40000 ALTER TABLE `modalidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `crearUOClass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (29,'Inicial','Ini',1,'Fd\\EstablecimientoBundle\\Model\\UnidadOfertaInicialHandler'),(30,'Primario','Pri',2,''),(31,'Medio','Med',3,''),(32,'Terciario','Ter',4,'');
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `norma`
--

DROP TABLE IF EXISTS `norma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `norma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_norma_id` int(11) DEFAULT NULL,
  `descripcion` longtext,
  `numero` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EF6217E36AA9857` (`tipo_norma_id`),
  CONSTRAINT `FK_3EF6217E36AA9857` FOREIGN KEY (`tipo_norma_id`) REFERENCES `tipo_norma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `norma`
--

LOCK TABLES `norma` WRITE;
/*!40000 ALTER TABLE `norma` DISABLE KEYS */;
INSERT INTO `norma` VALUES (1,1,NULL,6635,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,NULL,6626,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,3,'Validez nacional',140,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,2,'MEN',2029,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,NULL,6862,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,5,NULL,941,2006,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,5,NULL,63,2003,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,NULL,6861,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,1,NULL,149,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,5,NULL,609,2000,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,5,NULL,608,2000,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,3,'Validez nacional',130,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,2,NULL,2116,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,3,'Validez nacional',812,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,4,'(rectificatoria)',2936,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,1,NULL,1908,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,4,'(rectificatoria)',2141,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,3,NULL,1921,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,5,NULL,88,1998,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,1,NULL,6989,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,1,NULL,4079,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,3,'Validez Nacional',1543,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,3,'Validez Nacional',1538,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,3,'Validez Nacional',1539,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,3,NULL,763,1994,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,3,NULL,98,1991,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,1,NULL,2163,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,1,NULL,3284,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,3,NULL,1938,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,3,NULL,1603,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,1,NULL,597,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,3,NULL,1905,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,1,'esta es una descripcion somera',4186,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,1,NULL,4281,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,1,NULL,1103,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,3,NULL,1919,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,3,'cohorte 2012',907,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,6,NULL,5569,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,6,NULL,501,2005,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,6,NULL,1710,2006,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,1,NULL,2361,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,5,NULL,95,2006,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,5,NULL,1694,2006,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,1,NULL,3279,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,3,NULL,431,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,4,NULL,410,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,1,NULL,5475,2008,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,1,NULL,4747,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,4,NULL,623,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,1,NULL,1307,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,1,NULL,5815,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,1,NULL,310,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,5,NULL,941,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,1,NULL,150,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,3,NULL,1413,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,1,NULL,3304,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,1,NULL,7668,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,3,NULL,805,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,1,NULL,3870,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,3,'Validez Nacional',1540,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,3,'Validez Nacional',1542,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,3,NULL,2891,1986,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,1,NULL,219,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,3,NULL,808,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,3,NULL,1899,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,1,NULL,6116,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,3,NULL,2133,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,3,NULL,2134,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,3,NULL,2135,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,5,NULL,1085,2004,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,3,NULL,984,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,3,NULL,1467,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,1,NULL,5789,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,1,NULL,1890,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,1,NULL,6988,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,1,NULL,5830,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,3,NULL,1131,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,1,NULL,6623,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,1,NULL,5818,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,3,NULL,182,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,1,NULL,10893,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,1,NULL,6624,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,3,NULL,931,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,3,NULL,2008,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,1,NULL,6634,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,1,NULL,255,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,1,NULL,4329,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,3,'cohortes 2009/10/11',2085,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,1,NULL,8497,2008,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,1,NULL,56,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,1,NULL,983,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,3,NULL,2178,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,1,NULL,966,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,1,NULL,649,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,3,'esta es una descripción somera',180,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,1,NULL,56,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,1,NULL,2168,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,1,NULL,896,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,1,NULL,6627,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,3,NULL,1937,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,3,NULL,589,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(105,1,NULL,529,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(106,3,NULL,1397,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(107,5,NULL,2168,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(108,5,NULL,56,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(109,3,NULL,1398,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(110,3,NULL,809,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(111,3,NULL,1065,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(112,1,NULL,4565,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(113,3,NULL,1561,2010,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(114,3,'cohorte 2009',1403,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(115,1,NULL,886,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(116,3,NULL,1847,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(117,4,'Solo validez juridiscional',133,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(118,3,NULL,899,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(119,3,NULL,832,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(120,3,NULL,830,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(121,3,NULL,1600,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(122,3,NULL,817,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(123,4,NULL,1135,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(124,4,NULL,1230,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(125,1,NULL,6630,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(126,3,NULL,1935,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(127,3,NULL,1858,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(128,1,NULL,6632,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(129,3,NULL,1123,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(130,1,NULL,6628,2009,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(131,3,NULL,1039,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(132,3,NULL,586,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(133,1,'prueba',99999,2013,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(134,4,'postítulo del IES 2',424,2013,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(135,6,NULL,781,2006,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(136,7,'Aprueba el Plan Nacional de Educación Obligatoria y Formación Docente 2012 - 2016',188,2012,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(138,7,'Aprueba el Plan Nacional de Formación Docente',23,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(139,7,'anexo I: documento diagnóstico y descriptivo del sistema formador \"Hacia una Institucionalidad del Sistema de Formación Docente en Argentina\"\r\nanexo II: \"Lineamientos Nacionales para la Formación Docente Continua y el Desarrolo Profesional\"',30,2007,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(140,7,'fija la responsabilidad jurisdiccional en la Dirección de Formación Docente',72,2008,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(145,7,'Aprueba el documento Lineamientos Federales para el planeamiento y organización institucional del sistema formador.\r\nEl documento trata de:\r\na) Planeamiento\r\nb) Condiciones institucionales del sistema formador\r\nc) Organizacion interna de los IFD',140,2011,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `norma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `norma_referencias`
--

DROP TABLE IF EXISTS `norma_referencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `norma_referencias` (
  `norma_id` int(11) NOT NULL,
  `referencia_id` int(11) NOT NULL,
  PRIMARY KEY (`norma_id`,`referencia_id`),
  KEY `IDX_BCB3D063E06FC29E` (`norma_id`),
  KEY `IDX_BCB3D063778D91A2` (`referencia_id`),
  CONSTRAINT `FK_BCB3D063778D91A2` FOREIGN KEY (`referencia_id`) REFERENCES `norma` (`id`),
  CONSTRAINT `FK_BCB3D063E06FC29E` FOREIGN KEY (`norma_id`) REFERENCES `norma` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `norma_referencias`
--

LOCK TABLES `norma_referencias` WRITE;
/*!40000 ALTER TABLE `norma_referencias` DISABLE KEYS */;
INSERT INTO `norma_referencias` VALUES (3,98),(33,114),(98,33),(98,140),(140,33);
/*!40000 ALTER TABLE `norma_referencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oferta_educativa`
--

DROP TABLE IF EXISTS `oferta_educativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oferta_educativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel_id` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21B7C831DA3426AE` (`nivel_id`),
  CONSTRAINT `FK_21B7C831DA3426AE` FOREIGN KEY (`nivel_id`) REFERENCES `nivel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oferta_educativa`
--

LOCK TABLES `oferta_educativa` WRITE;
/*!40000 ALTER TABLE `oferta_educativa` DISABLE KEYS */;
INSERT INTO `oferta_educativa` VALUES (1,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,31,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,31,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,29,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `oferta_educativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oferta_norma`
--

DROP TABLE IF EXISTS `oferta_norma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oferta_norma` (
  `oferta_id` int(11) NOT NULL,
  `norma_id` int(11) NOT NULL,
  PRIMARY KEY (`oferta_id`,`norma_id`),
  KEY `IDX_703EF970FAFBF624` (`oferta_id`),
  KEY `IDX_703EF970E06FC29E` (`norma_id`),
  CONSTRAINT `FK_703EF970E06FC29E` FOREIGN KEY (`norma_id`) REFERENCES `norma` (`id`),
  CONSTRAINT `FK_703EF970FAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `oferta_educativa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oferta_norma`
--

LOCK TABLES `oferta_norma` WRITE;
/*!40000 ALTER TABLE `oferta_norma` DISABLE KEYS */;
INSERT INTO `oferta_norma` VALUES (1,20),(1,21),(1,22),(2,20),(2,23),(3,20),(3,24),(4,10),(6,11),(7,2),(7,3),(7,4),(8,7),(8,8),(9,9),(9,14),(9,15),(10,7),(11,16),(11,17),(11,18),(12,19),(13,1),(13,12),(13,13),(14,53),(15,54),(15,55),(16,25),(17,26),(18,26),(19,27),(20,28),(20,29),(20,30),(21,33),(23,34),(24,31),(24,32),(25,35),(25,36),(25,37),(27,38),(28,39),(29,40),(30,41),(31,42),(32,43),(33,44),(33,45),(34,46),(35,47),(36,48),(37,49),(38,50),(39,51),(40,52),(41,53),(42,54),(42,55),(43,56),(44,57),(44,58),(45,59),(46,20),(46,63),(47,20),(47,23),(48,20),(48,64),(49,65),(50,31),(50,32),(51,66),(51,67),(51,68),(52,69),(52,70),(52,71),(52,72),(53,73),(53,74),(53,75),(54,76),(54,77),(55,78),(55,79),(55,80),(56,81),(56,82),(56,83),(57,84),(58,85),(58,86),(58,87),(59,88),(59,89),(59,90),(59,91),(60,92),(60,93),(60,94),(60,95),(61,96),(61,97),(61,98),(62,99),(62,100),(62,101),(63,102),(63,103),(63,104),(64,105),(64,106),(65,107),(65,108),(65,109),(66,100),(66,108),(66,110),(67,100),(67,108),(67,111),(68,112),(68,113),(68,114),(69,93),(69,100),(69,115),(69,116),(70,117),(71,93),(71,100),(71,118),(72,93),(72,100),(72,119),(73,93),(73,100),(73,120),(73,121),(74,122),(75,123),(75,124),(76,125),(76,126),(76,127),(77,128),(77,129),(78,130),(78,131),(78,132),(82,133),(83,134);
/*!40000 ALTER TABLE `oferta_norma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientacion`
--

DROP TABLE IF EXISTS `orientacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FB4EAA70C671B40F` (`carrera_id`),
  CONSTRAINT `FK_FB4EAA70C671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientacion`
--

LOCK TABLES `orientacion` WRITE;
/*!40000 ALTER TABLE `orientacion` DISABLE KEYS */;
INSERT INTO `orientacion` VALUES (1,44,'Orientación en Discapacidad Intelectual','Orientación en Discapacidad Intelectual',NULL),(2,44,'Orientación en Sordos e Hipoacúsicos','Orientación en Sordos e Hipoacúsicos',NULL),(3,44,'Orientación en Ciegos y Disminuidos Visuales','Orientación en Ciegos y Disminuidos Visuales',NULL),(4,8,'Educación Inicial en Contexto de Vulnerabilidad Social: Educación y Pobreza nombre',NULL,NULL),(5,8,'Educación Inicial y Lenguaje Artístico - Expresivo',NULL,NULL),(6,8,'Educación Inicial y TICs',NULL,NULL),(7,8,'Educación Inicial y Lenguas Originarias',NULL,NULL),(18,8,'Educación Inicial y Lenguas Extranjeras (Inglés)',NULL,NULL);
/*!40000 ALTER TABLE `orientacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (22,'AR','Argentinax',1),(23,'UR','Uruguay',2),(24,'AS','Asia',3);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `primario`
--

DROP TABLE IF EXISTS `primario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` varchar(255) NOT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4101E2EA15CE31DF` (`oferta_educativa_id`),
  CONSTRAINT `FK_4101E2EA15CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `primario`
--

LOCK TABLES `primario` WRITE;
/*!40000 ALTER TABLE `primario` DISABLE KEYS */;
INSERT INTO `primario` VALUES (2,'5 años',2);
/*!40000 ALTER TABLE `primario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (19,'CABA','CABA',1),(20,'CBA','Córdoba',2),(21,'MSN','Misiones',3);
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (16,'ROLE_USUARIO'),(17,'ROLE_ADMIN'),(18,'ROLE_SUPERADMIN');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inicial_x_id` int(11) DEFAULT NULL,
  `grupo_etario_id` int(11) DEFAULT NULL,
  `q_secciones` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E226041C36ED91FF` (`grupo_etario_id`),
  KEY `IDX_E226041C940B40B8` (`inicial_x_id`),
  CONSTRAINT `FK_E226041C36ED91FF` FOREIGN KEY (`grupo_etario_id`) REFERENCES `grupo_etario` (`id`),
  CONSTRAINT `FK_E226041C940B40B8` FOREIGN KEY (`inicial_x_id`) REFERENCES `inicial_x` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (6,1,8,1),(7,1,7,2),(8,1,3,3),(24,7,4,22),(25,7,5,33);
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sector`
--

LOCK TABLES `sector` WRITE;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
INSERT INTO `sector` VALUES (22,'Estatal','E'),(23,'Público','P'),(24,'Mixto','M');
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_especializacion`
--

DROP TABLE IF EXISTS `tipo_especializacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_especializacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_especializacion`
--

LOCK TABLES `tipo_especializacion` WRITE;
/*!40000 ALTER TABLE `tipo_especializacion` DISABLE KEYS */;
INSERT INTO `tipo_especializacion` VALUES (2,'DIP','Diplomatura',1),(3,'DIPSP','Diplomatura Superior',2),(4,'ESP','Especialización',3),(5,'ESPSP','Especialización Superior',4);
/*!40000 ALTER TABLE `tipo_especializacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_establecimiento`
--

DROP TABLE IF EXISTS `tipo_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_establecimiento`
--

LOCK TABLES `tipo_establecimiento` WRITE;
/*!40000 ALTER TABLE `tipo_establecimiento` DISABLE KEYS */;
INSERT INTO `tipo_establecimiento` VALUES (1,'ENS','Escuela Normal Superior',1),(2,'IEdS','Instituto de Educación Superior',2),(3,'IEnS','Instituto de Enseñanza Superior',3),(4,'ISP','Instituto Superior del Profesorado',4),(5,'ISEF','Instituto Superior de Educación Física',5);
/*!40000 ALTER TABLE `tipo_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_formacion`
--

DROP TABLE IF EXISTS `tipo_formacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_formacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(2) DEFAULT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_formacion`
--

LOCK TABLES `tipo_formacion` WRITE;
/*!40000 ALTER TABLE `tipo_formacion` DISABLE KEYS */;
INSERT INTO `tipo_formacion` VALUES (1,'FD','Formación Docente'),(2,'FT','Formación Técnica');
/*!40000 ALTER TABLE `tipo_formacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_instancia`
--

DROP TABLE IF EXISTS `tipo_instancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_instancia`
--

LOCK TABLES `tipo_instancia` WRITE;
/*!40000 ALTER TABLE `tipo_instancia` DISABLE KEYS */;
INSERT INTO `tipo_instancia` VALUES (25,'Tal','Taller'),(26,'Mat','Materia'),(27,'Sem','Seminario'),(28,'Tcp','Trabajo de campo');
/*!40000 ALTER TABLE `tipo_instancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_norma`
--

DROP TABLE IF EXISTS `tipo_norma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_norma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_norma`
--

LOCK TABLES `tipo_norma` WRITE;
/*!40000 ALTER TABLE `tipo_norma` DISABLE KEYS */;
INSERT INTO `tipo_norma` VALUES (1,'RES/MEGC','Resolución Ministerial GCBA'),(2,'RECT','Rectificatoria'),(3,'RES/ME','Resolución Ministerio Nacional'),(4,'RES/SSGEYCP','Resolución SSGEYCP'),(5,'RES/SED','Resolución SED'),(6,'SEG','?????'),(7,'RES/CF','Resolución del Consejo Federal');
/*!40000 ALTER TABLE `tipo_norma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_trayecto`
--

DROP TABLE IF EXISTS `tipo_trayecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_trayecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_trayecto`
--

LOCK TABLES `tipo_trayecto` WRITE;
/*!40000 ALTER TABLE `tipo_trayecto` DISABLE KEYS */;
INSERT INTO `tipo_trayecto` VALUES (37,'TFG','Trayecto de formación general',1),(38,'TFE','Trayecto de formación específica',2),(39,'TCPD','Trayecto de construcción de la práctica docente',3),(40,'CFG','Campo de formación general',4),(41,'CFE','Campo de formación específica',5),(42,'CFPD','Campo de formación de la práctica docente',6);
/*!40000 ALTER TABLE `tipo_trayecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (29,'TM','Mañana',1),(30,'TT','Tarde',2),(31,'TV','Vespertino',3),(32,'NA','No aplica',4);
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno_unidad_educativa`
--

DROP TABLE IF EXISTS `turno_unidad_educativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno_unidad_educativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `turno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_167633EABF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_167633EA69C5211E` (`turno_id`),
  CONSTRAINT `FK_167633EA69C5211E` FOREIGN KEY (`turno_id`) REFERENCES `turno` (`id`),
  CONSTRAINT `FK_167633EABF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno_unidad_educativa`
--

LOCK TABLES `turno_unidad_educativa` WRITE;
/*!40000 ALTER TABLE `turno_unidad_educativa` DISABLE KEYS */;
INSERT INTO `turno_unidad_educativa` VALUES (3,43,29),(6,45,30),(7,46,29),(8,46,31),(10,44,29),(11,44,30),(12,45,29),(13,94,29),(14,94,31),(20,43,31),(24,58,29);
/*!40000 ALTER TABLE `turno_unidad_educativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad_educativa`
--

DROP TABLE IF EXISTS `unidad_educativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_educativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `cargo_autoridad_id` int(11) DEFAULT NULL,
  `nombre_autoridad` varchar(50) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_27515E8071B61351` (`establecimiento_id`),
  KEY `IDX_27515E80DA3426AE` (`nivel_id`),
  KEY `IDX_27515E80418D0677` (`cargo_autoridad_id`),
  CONSTRAINT `FK_27515E80418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  CONSTRAINT `FK_27515E8071B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_27515E80DA3426AE` FOREIGN KEY (`nivel_id`) REFERENCES `nivel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad_educativa`
--

LOCK TABLES `unidad_educativa` WRITE;
/*!40000 ALTER TABLE `unidad_educativa` DISABLE KEYS */;
INSERT INTO `unidad_educativa` VALUES (43,13,29,'inicial',14,'La señorita Cunegunda','0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,13,30,'primaria',7,'La señorita Cunegunda directora de primaria','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,13,31,'media',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,13,32,'terciario',9,'La señorita cunegunda 1','0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,14,30,'primaria',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,14,31,'media',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,14,32,'terciario',NULL,'La señorita cunegunda 8','0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,15,31,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,15,30,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,17,32,NULL,11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,19,29,NULL,14,'Lafuente Josefina','0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,19,30,NULL,7,'Ursi, Ana','0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,19,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,19,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,20,29,NULL,14,'López Patricia','0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,20,30,NULL,7,'Franciosi, Andrea','0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,20,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,20,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,22,29,'yyyyyyyyyyy',14,'Sesé Marcela','0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,22,30,NULL,7,'Bonelli, Isabel','0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,22,31,NULL,13,'XX','0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,22,32,NULL,9,'Claudia SAMOILOVICH','0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,24,29,NULL,14,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,24,30,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,24,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,24,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,25,29,NULL,14,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,25,30,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,25,31,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,25,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,26,29,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,26,30,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,26,31,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,26,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,16,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,27,29,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,27,30,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,27,31,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,27,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,28,30,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,28,31,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,28,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,29,29,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,29,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,30,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,31,32,'terciario romera',9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,32,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,21,29,NULL,14,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,21,30,NULL,7,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,21,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,21,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,18,29,NULL,14,'Marina Rizzo','0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,18,30,NULL,7,'Gomez, Miriam','0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,18,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,18,32,NULL,9,'Silvia LEDO','0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,23,29,NULL,14,'Kempner Dina','0000-00-00 00:00:00','0000-00-00 00:00:00'),(105,23,30,NULL,7,'Garcia, Maria Celia','0000-00-00 00:00:00','0000-00-00 00:00:00'),(106,23,31,NULL,13,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(107,23,32,NULL,9,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(108,14,29,NULL,14,'Fornek, Marcela','0000-00-00 00:00:00','0000-00-00 00:00:00'),(109,33,32,NULL,11,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(110,15,32,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `unidad_educativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad_oferta`
--

DROP TABLE IF EXISTS `unidad_oferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_95C6F11DBF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_95C6F11D15CE31DF` (`oferta_educativa_id`),
  CONSTRAINT `FK_95C6F11D15CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  CONSTRAINT `FK_95C6F11DBF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad_oferta`
--

LOCK TABLES `unidad_oferta` WRITE;
/*!40000 ALTER TABLE `unidad_oferta` DISABLE KEYS */;
INSERT INTO `unidad_oferta` VALUES (1,109,36,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,46,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,46,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,49,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,49,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,56,14,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,57,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,57,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,61,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,61,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,65,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,65,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,69,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,69,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,78,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,78,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,78,38,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,82,8,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,82,9,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,82,10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,82,11,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,82,12,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,82,15,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,83,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,83,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,83,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,83,39,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,83,40,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,87,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,87,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,90,16,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,90,17,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,90,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,90,19,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,90,20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,90,21,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,90,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,90,25,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,92,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,92,28,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,93,29,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,94,24,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,99,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,99,6,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,103,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,103,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,107,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,107,13,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,109,30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,109,31,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,109,32,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,109,33,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,109,34,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,109,35,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,90,11,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,90,15,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,90,42,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,87,41,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,90,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,90,44,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,90,45,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,83,46,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,83,47,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,83,48,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,83,49,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,94,50,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,95,51,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,93,52,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,53,53,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,53,54,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,53,55,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,53,56,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,53,57,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,109,58,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,109,59,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,109,60,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,109,61,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,109,62,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,109,63,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,109,64,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,109,65,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,109,66,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,109,67,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,109,68,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,109,69,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,109,70,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,109,71,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,109,72,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,109,73,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,109,74,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,109,76,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,109,77,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,109,78,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,109,75,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(119,94,82,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(120,110,27,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(121,99,7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(122,43,84,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(124,100,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(127,96,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(128,62,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(129,108,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(130,104,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(131,66,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(132,75,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(133,79,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(134,84,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(135,91,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(136,54,43,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(137,58,43,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `unidad_oferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `permite_mail` tinyint(1) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `rol` varchar(255) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `ultima_conexion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (11,'Juan','Perez','jp@jp.com.ar','L+mfcBZTl12h6RtzzeUXsyHa//iTOYrrmIKN+5f/0PWzDKSUNm+3bqHfq61VQ/+O+k19eqOdDbmqj5xOxNrrOQ==','a75be2455e5c411b0b2fbad49c1bfe66',NULL,0,'2012-10-29 14:55:14',NULL,NULL,'ROLE_USUARIO','juan',NULL),(12,'Marcelo','Prizmic','mp@mp.com.ar','Xd5DiyQ4mTWY9eXq9z+Zs/YuPcLWo/RoWkV6+5zk+E0VD+vfJJ9ipcflxnCAIQ42wBWUYwhCZca9fu0q4NqNJw==','a75be2455e5c411b0b2fbad49c1bfe66',NULL,0,'2012-10-29 14:55:14','1963-02-23 00:00:00',NULL,'ROLE_ADMIN','marcelo','2013-08-08 17:00:20');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-18 11:27:49
