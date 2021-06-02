-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sistemabecas
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades` (
  `idActividad` int NOT NULL AUTO_INCREMENT,
  `nombreActividad` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idActividad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (1,'actividadUno'),(2,'actividadUDos'),(3,'actividadTres'),(4,'actividadCuatro'),(5,'actividadCinco');
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnoactividades`
--

DROP TABLE IF EXISTS `alumnoactividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnoactividades` (
  `idAlumnoActividades` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `trimestreRealizacion` varchar(6) DEFAULT NULL,
  `comprobante` varchar(200) DEFAULT NULL,
  `actividades_idActividad` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  PRIMARY KEY (`idAlumnoActividades`),
  KEY `actividades_idActividad` (`actividades_idActividad`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  CONSTRAINT `alumnoactividades_ibfk_1` FOREIGN KEY (`actividades_idActividad`) REFERENCES `actividades` (`idActividad`),
  CONSTRAINT `alumnoactividades_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnoactividades`
--

LOCK TABLES `alumnoactividades` WRITE;
/*!40000 ALTER TABLE `alumnoactividades` DISABLE KEYS */;
INSERT INTO `alumnoactividades` VALUES (1,'2173000641','Actividad realizada','2017-O','comprobantesActividades/Fores.jpg',3,3),(2,'2172000094','realizo una actividad ','2017-O','comprobantesActividades/imagen.jpg',3,1),(3,'2173000641','Se realizo la actividad 4','2020-I','comprobantesActividades/imagen.jpg',4,3),(4,'2172000094','Realizo la actividad prueba','2017-I','comprobantesActividades/imagen.jpg',1,1),(5,'2172000094','realizo la actividad dos','2017-O','comprobantesActividades/imagen.jpg',2,1);
/*!40000 ALTER TABLE `alumnoactividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnotutor`
--

DROP TABLE IF EXISTS `alumnotutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnotutor` (
  `idAlumnoTutor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `primerApellido` varchar(50) DEFAULT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `matricula` varchar(11) DEFAULT NULL,
  `anioIngreso` int DEFAULT NULL,
  `trimestreingreso` varchar(5) DEFAULT NULL,
  `licenciatura` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `becaActiva` varchar(2) DEFAULT NULL,
  `tutor_idTutor` int NOT NULL,
  PRIMARY KEY (`idAlumnoTutor`),
  KEY `alumnoTutor_tutor` (`tutor_idTutor`),
  CONSTRAINT `alumnoTutor_tutor` FOREIGN KEY (`tutor_idTutor`) REFERENCES `tutor` (`idTutor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnotutor`
--

LOCK TABLES `alumnotutor` WRITE;
/*!40000 ALTER TABLE `alumnotutor` DISABLE KEYS */;
INSERT INTO `alumnotutor` VALUES (1,'NOM_001','PAT_001','MAT_001','2172000094',2017,'17P','122','CORREO_001','TEL_001','si',1),(2,'NOM_002','PAT_002','MAT_002','2172000165',2017,'17P','122','CORREO_002','TEL_002','no',2),(3,'NOM_003','PAT_003','MAT_003','2173000641',2017,'17O','122','CORREO_003','TEL_003','no',1),(4,'NOM_132','PAT_132','MAT_132','2182000097',2018,'18P','122','CORREO_132','TEL_132','si',1),(5,'NOM_139','PAT_139','MAT_139','2182000766',2018,'18P','122','CORREO_139','TEL_139','si',1),(6,'NOM_140','PAT_140','MAT_140','2182000828',2018,'18P','122','CORREO_140','TEL_140','no',1),(7,'NOM_130','PAT_130','MAT_130','2173799189',2017,'17O','122','CORREO_130','TEL_130','si',2),(8,'NOM_131','PAT_131','MAT_131','2182000079',2018,'18P','122','CORREO_131','TEL_131','no',3),(9,'NOM_199','PAT_199','MAT_199','2182006008',2018,'18P','122','CORREO_199','TEL_199','si',3),(10,'NOM_200','PAT_200','MAT_200','2182006106',2018,'18P','122','CORREO_200','TEL_200','no',1),(11,'NOM_201','PAT_201','MAT_201','2183000055',2018,'18O','122','CORREO_201','TEL_201','si',2);
/*!40000 ALTER TABLE `alumnotutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoalumno`
--

DROP TABLE IF EXISTS `estadoalumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estadoalumno` (
  `idestadoAlumno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idestadoAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoalumno`
--

LOCK TABLES `estadoalumno` WRITE;
/*!40000 ALTER TABLE `estadoalumno` DISABLE KEYS */;
INSERT INTO `estadoalumno` VALUES (1,'inscrito con carga academica'),(2,'inscrito sin carga academica'),(10,'no inscrito');
/*!40000 ALTER TABLE `estadoalumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pruebaarchivo`
--

DROP TABLE IF EXISTS `pruebaarchivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pruebaarchivo` (
  `idPruArch` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idPruArch`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `pruebaarchivo_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `pruebaarchivo_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `pruebaarchivo_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pruebaarchivo`
--

LOCK TABLES `pruebaarchivo` WRITE;
/*!40000 ALTER TABLE `pruebaarchivo` DISABLE KEYS */;
INSERT INTO `pruebaarchivo` VALUES (1,'2172000094',200,'19I',1,1,6),(2,'2173000641',106,'19I',1,3,6),(3,'2182000097',60,'19I',1,4,6),(4,'2182000766',52,'19I',1,5,6),(5,'2182000828',40,'19I',1,6,6),(6,'2182006106',52,'19I',1,10,6),(7,'2172000094',200,'19I',1,1,6),(8,'2172000094',200,'19I',1,1,6),(9,'2173000641',106,'19I',1,3,6),(10,'2173000641',106,'19I',1,3,6),(11,'2182000097',60,'19I',1,4,6),(12,'2182000097',60,'19I',1,4,6),(13,'2182000766',52,'19I',1,5,6),(14,'2182000766',52,'19I',1,5,6),(15,'2182000828',40,'19I',1,6,6),(16,'2182000828',40,'19I',1,6,6),(17,'2182006106',52,'19I',1,10,6),(18,'2182006106',52,'19I',1,10,6),(19,'2172000094',200,'19I',1,1,6),(20,'2173000641',106,'19I',1,3,6),(21,'2182000097',60,'19I',1,4,6),(22,'2182000766',52,'19I',1,5,6),(23,'2182000828',40,'19I',1,6,6),(24,'2182006106',52,'19I',1,10,6),(25,'2182006106',52,'19I',1,10,6),(26,'2172000094',200,'19I',1,1,6),(27,'2173000641',106,'19I',1,3,6),(28,'2182000097',60,'19I',1,4,6),(29,'2182000766',52,'19I',1,5,6),(30,'2182000828',40,'19I',1,6,6),(31,'2182006106',52,'19I',1,10,6),(32,'2182006106',52,'19I',1,10,6);
/*!40000 ALTER TABLE `pruebaarchivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2017o`
--

DROP TABLE IF EXISTS `trim2017o`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2017o` (
  `idTrim2018O` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2018O`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2017o_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2017o_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2017o_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2017o`
--

LOCK TABLES `trim2017o` WRITE;
/*!40000 ALTER TABLE `trim2017o` DISABLE KEYS */;
INSERT INTO `trim2017o` VALUES (1,'2172000094',50,'17O',1,1,2),(2,'2173000641',20,'17O',1,3,2);
/*!40000 ALTER TABLE `trim2017o` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2017p`
--

DROP TABLE IF EXISTS `trim2017p`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2017p` (
  `idTrim2017P` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2017P`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2017p_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2017p_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2017p_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2017p`
--

LOCK TABLES `trim2017p` WRITE;
/*!40000 ALTER TABLE `trim2017p` DISABLE KEYS */;
INSERT INTO `trim2017p` VALUES (1,'2172000094',26,'17P',1,1,1);
/*!40000 ALTER TABLE `trim2017p` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2018i`
--

DROP TABLE IF EXISTS `trim2018i`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2018i` (
  `idTrim2018I` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2018I`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2018i_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2018i_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2018i_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2018i`
--

LOCK TABLES `trim2018i` WRITE;
/*!40000 ALTER TABLE `trim2018i` DISABLE KEYS */;
INSERT INTO `trim2018i` VALUES (1,'2172000094',80,'18I',1,1,3),(2,'2173000641',56,'18I',1,3,3);
/*!40000 ALTER TABLE `trim2018i` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2018o`
--

DROP TABLE IF EXISTS `trim2018o`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2018o` (
  `idTrim2018O` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2018O`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2018o_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2018o_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2018o_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2018o`
--

LOCK TABLES `trim2018o` WRITE;
/*!40000 ALTER TABLE `trim2018o` DISABLE KEYS */;
INSERT INTO `trim2018o` VALUES (1,'2172000094',100,'18O',1,1,5),(2,'2173000641',99,'18O',1,3,5),(3,'2182000097',36,'18O',1,4,5),(4,'2182000766',26,'18O',1,5,5),(5,'2182000828',40,'18O',1,6,5),(6,'2182006106',12,'18O',1,10,5);
/*!40000 ALTER TABLE `trim2018o` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2018p`
--

DROP TABLE IF EXISTS `trim2018p`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2018p` (
  `idTrim2018P` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2018P`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2018p_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2018p_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2018p_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2018p`
--

LOCK TABLES `trim2018p` WRITE;
/*!40000 ALTER TABLE `trim2018p` DISABLE KEYS */;
INSERT INTO `trim2018p` VALUES (1,'2172000094',95,'18P',1,1,4),(2,'2173000641',80,'18P',1,3,4),(3,'2182000097',12,'18P',1,4,4),(4,'2182000766',26,'18P',1,5,4),(5,'2182000828',20,'18P',1,6,4),(6,'2182006106',6,'18P',1,10,4);
/*!40000 ALTER TABLE `trim2018p` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trim2019i`
--

DROP TABLE IF EXISTS `trim2019i`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trim2019i` (
  `idTrim2019I` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) DEFAULT NULL,
  `creditosAcum` int DEFAULT NULL,
  `ultimoTrimAct` varchar(7) DEFAULT NULL,
  `estadoAlumno_idestadoAlumno` int NOT NULL,
  `alumnoTutor_idAlumnoTutor` int NOT NULL,
  `trimestres_idTrimestre` int NOT NULL,
  PRIMARY KEY (`idTrim2019I`),
  KEY `estadoAlumno_idestadoAlumno` (`estadoAlumno_idestadoAlumno`),
  KEY `alumnoTutor_idAlumnoTutor` (`alumnoTutor_idAlumnoTutor`),
  KEY `trimestres_idTrimestre` (`trimestres_idTrimestre`),
  CONSTRAINT `trim2019i_ibfk_1` FOREIGN KEY (`estadoAlumno_idestadoAlumno`) REFERENCES `estadoalumno` (`idestadoAlumno`),
  CONSTRAINT `trim2019i_ibfk_2` FOREIGN KEY (`alumnoTutor_idAlumnoTutor`) REFERENCES `alumnotutor` (`idAlumnoTutor`),
  CONSTRAINT `trim2019i_ibfk_3` FOREIGN KEY (`trimestres_idTrimestre`) REFERENCES `trimestres` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trim2019i`
--

LOCK TABLES `trim2019i` WRITE;
/*!40000 ALTER TABLE `trim2019i` DISABLE KEYS */;
INSERT INTO `trim2019i` VALUES (1,'2172000094',200,'19I',1,1,6),(2,'2173000641',106,'19I',2,3,6),(3,'2182000097',60,'19I',1,4,6),(4,'2182000766',52,'19I',2,5,6),(5,'2182000828',40,'19I',1,6,6),(6,'2182006106',52,'19I',1,10,6);
/*!40000 ALTER TABLE `trim2019i` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trimestres`
--

DROP TABLE IF EXISTS `trimestres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trimestres` (
  `idTrimestre` int NOT NULL AUTO_INCREMENT,
  `trim` varchar(5) DEFAULT NULL,
  `estadoTrim` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trimestres`
--

LOCK TABLES `trimestres` WRITE;
/*!40000 ALTER TABLE `trimestres` DISABLE KEYS */;
INSERT INTO `trimestres` VALUES (1,'17P','ANTERIOR'),(2,'17O','ANTERIOR'),(3,'18I','ANTERIOR'),(4,'18P','ANTERIOR'),(5,'18O','ANTERIOR'),(6,'19I','ACTUAL');
/*!40000 ALTER TABLE `trimestres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutor` (
  `idTutor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) DEFAULT NULL,
  `primerApellido` varchar(15) DEFAULT NULL,
  `segundoApellido` varchar(15) DEFAULT NULL,
  `numeroEco` int DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `passw` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTutor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,'Roberto','Hernandez','Gonzalez',20576,'usuario1@correo.com','robertohernandez'),(2,'Andrea','Estrada','Padro',25963,'usuario2@correo.com','andreaestrada'),(3,'Katherin','Mendoza','Nuñes',56589,'usuario3@correo.com','katherinmendoza'),(4,'Roberto','Hernandez','Gonzalez',20576,'usuario1@correo.com','robertohernandez'),(5,'Andrea','Estrada','Padro',25963,'usuario2@correo.com','andreaestrada'),(6,'Katherin','Mendoza','Nuñes',56589,'usuario3@correo.com','katherinmendoza');
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-02 16:41:34
