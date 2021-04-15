-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: juridico_software_2020
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion` (
  `id_accion` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `nombre_accion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `inactivo` enum('1','0') COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `global` tinyint(1) DEFAULT '0' COMMENT 'Indica si es una acción relacionada con cualquier módulo de la aplicación',
  PRIMARY KEY (`id_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,4,'modificar_tipo_proceso',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(2,4,'eliminar_recuperar_tipo_proceso',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(3,7,'asignar_opciones_acciones_perfil',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(4,10,'modificar_usuario',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(5,10,'eliminar_recuperar_usuario',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(6,13,'modificar_etapa_proceso',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(7,13,'eliminar_recuperar_etapa_proceso',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(8,16,'modificar_documento',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(9,16,'eliminar_recuperar_documento',NULL,'0','2019-02-25 14:26:49',1,NULL,NULL,0,0),(10,19,'modificar_plantilla_documento',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(11,19,'eliminar_recuperar_plantilla_documento',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(12,22,'modificar_entidad_pension',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(13,22,'eliminar_recuperar_entidad_pension',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(14,25,'modificar_entidad_justicia',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(15,25,'eliminar_recuperar_entidad_justicia',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(16,28,'modificar_intermediario',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(17,28,'eliminar_recuperar_intermediario',NULL,'0','2019-02-25 14:26:50',1,NULL,NULL,0,0),(18,31,'modificar_actuacion',NULL,'0','2019-02-25 14:28:13',1,NULL,NULL,0,0),(19,31,'eliminar_recuperar_actuacion',NULL,'0','2019-02-25 14:28:13',1,NULL,NULL,0,0),(20,34,'modificar_asociacion_actuacion_etapa_proceso',NULL,'0','2019-03-01 14:01:54',1,NULL,NULL,0,0),(21,37,'modificar_cliente',NULL,'0','2019-04-25 15:44:46',1,NULL,NULL,0,0),(22,37,'eliminar_recuperar_cliente',NULL,'0','2019-04-25 15:44:47',1,NULL,NULL,0,0),(23,41,'modificar_proceso',NULL,'0','2019-04-25 15:44:47',1,NULL,NULL,0,0),(24,41,'eliminar_recuperar_proceso',NULL,'0','2019-04-25 15:44:47',1,NULL,NULL,0,0),(25,42,'seguimiento.php','','','2019-04-25 15:44:47',1,NULL,NULL,0,0),(28,45,'crear_perfil.php',NULL,'0','2020-03-05 00:00:00',1,NULL,NULL,0,0),(29,52,'crear','Permisos para crear un registro en la base de datos','0','2020-05-03 00:25:00',1,'2020-07-30 12:03:28',NULL,0,1),(30,52,'editar','Permisos para editar un registro en la base de datos','0','2020-05-03 00:25:00',1,'2020-07-30 12:03:28',NULL,0,1),(31,52,'consultar','Permisos para consultar un registro en la base de datos','0','2020-05-03 00:25:00',1,'2020-07-30 12:03:28',NULL,0,1),(32,52,'eliminar','Permisos para eliminar un registro en la base de datos','0','2020-05-03 00:25:00',1,'2020-07-30 12:03:28',NULL,0,1),(33,29,'imprimir',NULL,'0','2020-07-30 12:06:01',1,'2020-07-30 12:06:01',1,0,0),(34,29,'descargar PDF',NULL,'0','2020-07-30 12:06:05',1,'2020-07-30 12:06:05',1,0,0),(35,29,'descargar Excel',NULL,'0','2020-07-30 12:06:13',1,'2020-07-30 12:06:13',1,0,0),(36,29,'cambiar dia de vencimiento',NULL,'0','2020-07-30 12:06:21',1,'2020-07-30 12:06:21',1,0,0),(37,29,'cambiar nombre',NULL,'0','2020-07-30 12:06:27',1,'2020-07-30 12:06:27',1,0,0),(38,29,'cambiar valor',NULL,'0','2020-07-30 12:06:35',1,'2020-07-30 12:06:35',1,0,0);
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion_menu_perfil`
--

DROP TABLE IF EXISTS `accion_menu_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion_menu_perfil` (
  `id_accion_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu_perfil` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL,
  PRIMARY KEY (`id_accion_menu`),
  KEY `id_menu_perfil` (`id_menu_perfil`),
  KEY `id_accion` (`id_accion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Relación entre accion y menu_perfil';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion_menu_perfil`
--

LOCK TABLES `accion_menu_perfil` WRITE;
/*!40000 ALTER TABLE `accion_menu_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `accion_menu_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion_perfil`
--

DROP TABLE IF EXISTS `accion_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion_perfil` (
  `id_accion_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_accion` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `inactivo` enum('1','0') COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_accion_perfil`),
  UNIQUE KEY `UQ_accion_perfil` (`id_accion`,`id_perfil`),
  KEY `IX_accion_perfil_inactivo` (`inactivo`),
  KEY `FK_accion_perfil_perfil` (`id_perfil`),
  CONSTRAINT `FK_accion_perfil_accion` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id_accion`),
  CONSTRAINT `FK_accion_perfil_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion_perfil`
--

LOCK TABLES `accion_perfil` WRITE;
/*!40000 ALTER TABLE `accion_perfil` DISABLE KEYS */;
INSERT INTO `accion_perfil` VALUES (1,1,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(2,2,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(3,3,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(4,4,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(5,5,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(6,6,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(7,7,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(8,8,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(9,9,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(10,10,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(11,11,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(12,12,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(13,13,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(14,14,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(15,15,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(16,16,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(17,17,1,'0','2019-02-25 14:26:50',1,NULL,NULL),(18,18,1,'0','2019-02-25 14:28:13',1,NULL,NULL),(19,19,1,'0','2019-02-25 14:28:13',1,NULL,NULL),(20,20,1,'0','2019-03-01 14:01:54',1,NULL,NULL),(21,21,1,'0','2019-04-25 15:44:47',1,NULL,NULL),(22,22,1,'0','2019-04-25 15:44:47',1,NULL,NULL),(23,23,1,'1','2019-04-25 15:44:47',1,NULL,NULL),(24,24,1,'1','2019-04-25 15:44:47',1,NULL,NULL),(25,25,1,'','2019-04-25 15:44:47',1,NULL,NULL),(28,28,1,'0','2020-03-05 00:00:00',1,NULL,NULL);
/*!40000 ALTER TABLE `accion_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion`
--

DROP TABLE IF EXISTS `actuacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion` (
  `id_actuacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_actuacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `genera_alertas` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `aplica_control_vencimiento` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `dias_vencimiento` int(5) DEFAULT NULL,
  `requiere_estudio_favorabilidad` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `actuacion_tiene_cobro` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `valor_actuacion` decimal(12,2) DEFAULT NULL,
  `actuacion_creacion_cliente` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `mostrar_datos_radicado` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `mostrar_datos_juzgado` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `mostrar_datos_respuesta` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `mostrar_datos_apelacion` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `mostrar_datos_cobros` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `programar_audiencia` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `control_entrega_documentos` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `generar_documentos` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `estado_actuacion` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `dias_vencimiento_unidad` int(1) DEFAULT '1' COMMENT '1 = dias 2 = meses',
  `tipo_actuacion` int(1) DEFAULT '2',
  `area_responsable` int(1) DEFAULT '1' COMMENT ' 1 = Recepción 2 = Administración 3= Agotamientos de Via 4 = Sustanciación 5 = Dependencia 6 = Mensajería ',
  `dias_vencimiento_tipo` int(1) DEFAULT '1' COMMENT '1 = calendario 2 = habiles',
  `tipo_resultado` int(1) DEFAULT '2' COMMENT '1 = documento 2 = dato alfanumerico 3 = fecha ',
  PRIMARY KEY (`id_actuacion`),
  UNIQUE KEY `IX_actuacion_nombre_actuacion` (`nombre_actuacion`),
  KEY `IX_actuacion_estado_actuacion` (`estado_actuacion`),
  KEY `IX_actuacion_genera_alertas` (`genera_alertas`),
  KEY `IX_actuacion_aplica_control_vencimiento` (`aplica_control_vencimiento`),
  KEY `IX_actuacion_requiere_estudio_favorabilidad` (`requiere_estudio_favorabilidad`),
  KEY `IX_actuacion_actuacion_tiene_cobro` (`actuacion_tiene_cobro`),
  KEY `IX_actuacion_actuacion_creacion_cliente` (`actuacion_creacion_cliente`),
  KEY `IX_actuacion_mostrar_datos_radicado` (`mostrar_datos_radicado`),
  KEY `IX_actuacion_mostrar_datos_juzgado` (`mostrar_datos_juzgado`),
  KEY `IX_actuacion_mostrar_datos_respuesta` (`mostrar_datos_respuesta`),
  KEY `IX_actuacion_mostrar_datos_apelacion` (`mostrar_datos_apelacion`),
  KEY `IX_actuacion_mostrar_datos_cobros` (`mostrar_datos_cobros`),
  KEY `IX_actuacion_programar_audiencia` (`programar_audiencia`),
  KEY `IX_actuacion_control_entrega_documentos` (`control_entrega_documentos`),
  KEY `IX_actuacion_generar_documentos` (`generar_documentos`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion`
--

LOCK TABLES `actuacion` WRITE;
/*!40000 ALTER TABLE `actuacion` DISABLE KEYS */;
INSERT INTO `actuacion` VALUES (1,'RECEPCIÓN PODERES, CONTRATOS Y OTROS','2','2',15,'1','1',0.00,'1','1','2','1','2','1','2','1','1','1','2019-03-04 19:48:55',1,'2020-09-30 13:26:29',11,0,1,1,4,1,4),(2,'RADICACIÓN RECURSO APELACION RESOLUCION','1','1',10,'2','2',0.00,'2','1','2','1','1','2','2','2','2','1','2019-03-04 19:59:30',1,'2020-10-02 16:01:12',8,0,1,1,3,2,1),(3,'RADICACIÓN DERECHO PETICION CUMPLIMIENTO','2','2',0,'2','2',0.00,'2','1','2','1','2','2','2','2','2','1','2019-03-04 20:00:36',1,'2020-09-14 11:58:39',11,0,1,1,4,1,4),(4,'RADICACION DERECHO PETICION Y ANEXOS','2','2',20,'2','2',0.00,'2','1','2','2','2','2','2','2','2','1','2019-03-04 20:01:21',1,'2020-10-02 15:13:29',8,0,1,1,3,2,1),(5,'RADICACION CONCILIACION PREJUDICIAL','1','1',120,'1','2',0.00,'2','1','2','1','2','2','1','2','2','1','2019-03-04 20:05:35',1,'2020-09-14 11:59:07',11,0,1,2,1,1,1),(6,'RADICACION DEMANDA','1','1',120,'1','2',0.00,'2','1','1','1','1','2','2','1','1','1','2019-03-04 20:06:52',1,'2020-09-30 14:12:22',11,0,1,1,6,1,9),(7,'PROGRAMACION AUDIENCIA CONCILIACION','1','2',0,'2','2',0.00,'2','1','2','1','2','2','1','2','2','1','2019-03-05 13:46:47',1,NULL,NULL,0,1,2,1,1,1),(8,'NOTIFICACION RESOLUCION VIA GUBERNATIVA','1','1',10,'2','2',0.00,'2','1','2','1','1','2','2','2','2','1','2019-03-16 16:58:39',1,'2020-10-02 15:57:49',8,0,1,2,1,1,2),(9,'APROBACION CONCILIACION','2','2',0,'2','2',0.00,'2','1','2','1','2','2','2','2','2','1','2019-03-16 17:18:16',1,NULL,NULL,0,1,2,1,1,1),(10,'PROGRAMACION AUDIENCIA','1','2',0,'2','2',0.00,'2','1','2','2','2','2','1','2','2','2','2019-03-16 17:18:54',1,NULL,NULL,0,1,2,1,1,1),(11,'APROBACION DEMANDA','1','1',3,'2','1',0.00,'2','1','1','1','1','1','2','1','1','1','2019-03-16 17:32:56',1,NULL,NULL,0,1,2,1,1,1),(12,'NOTIFICACION DEMANDADO','2','2',0,'2','2',0.00,'2','1','1','1','2','2','2','2','2','1','2019-03-16 17:33:47',1,NULL,NULL,0,1,2,1,1,1),(13,'APELACION SENTENCIA','1','1',3,'2','2',0.00,'2','1','1','1','1','2','1','2','2','1','2019-03-16 17:34:44',1,NULL,NULL,0,1,2,1,1,1),(14,'APROBACION PAGO','2','2',0,'2','2',0.00,'2','1','1','1','2','2','2','2','2','1','2019-03-16 17:35:49',1,NULL,NULL,0,1,2,1,1,1),(15,'NO APLICA','2','2',0,'2','2',0.00,'2','2','2','2','2','2','2','2','2','1','2019-03-16 17:39:06',1,'2020-09-09 13:42:03',11,1,1,2,1,1,1),(16,'RADICACION RECURSO APELACION CONTRA ACTO ADMINISTRATIVO','1','1',2,'2','2',0.00,'2','1','2','1','1','2','2','2','2','1','2019-03-18 14:27:47',1,'2020-08-31 15:36:57',8,0,1,1,6,2,1),(17,'SOLICITUD COPIAS AUTENTICAS','2','2',0,'2','2',0.00,'2','1','1','1','2','2','2','1','2','1','2019-03-20 14:05:28',1,NULL,NULL,0,1,2,1,1,1),(18,'COMPLETAR DOCUMENTOS','1','1',30,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-08-31 15:54:23',8,'2020-09-01 14:44:39',8,0,1,1,4,1,2),(19,'NOTIFICACIÓN AUTO QUE ADMITE DEMANDA Y FIJA GASTOS','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 10:47:09',11,'2020-09-14 12:34:57',11,0,1,3,5,1,12),(20,'RADICACIÓN GASTOS DE PROCESO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 10:57:44',11,'2020-09-14 12:41:03',11,0,1,1,6,1,4),(21,'NOTIFICACIÓN DE AUTO QUE CORRE TRASLADO CONTESTACIÓN DE DEMANDA','1','1',20,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:00:56',11,'2020-09-14 12:41:55',11,0,1,3,4,2,4),(22,'NOTIFICACIÓN DE AUTO QUE CORRE TRASLADO PARA CONTESTAR EXCEPCIONES (ADMINISTRATIVO)','1','1',3,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:14:50',11,'2020-09-14 11:53:19',11,0,1,3,4,2,4),(23,'RADICACIÓN CONTESTACIÓN DE DEMANDA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:23:53',11,'2020-09-14 11:35:20',11,0,1,1,6,1,3),(24,'RADICACIÓN CONTESTACIÓN DE EXCEPCIONES','1','1',3,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:26:55',11,'2020-09-14 11:40:52',11,0,1,1,6,2,4),(25,'NOTIFICACIÓN AUTO QUE FIJA FECHA AUDIENCIA ART 180','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:28:17',11,'2020-09-14 11:53:01',11,0,1,3,5,1,4),(26,'EJECUCIÓN AUDIENCIA 180 (PENDIENTE PARA ALEGAR Y FALLO)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:30:24',11,'2020-09-14 14:15:44',11,0,1,3,4,1,4),(27,'APORTE DE PRUEBAS DE ENTIDAD DEMANDA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:32:03',11,'2020-09-14 11:44:50',11,0,1,2,5,1,4),(28,'NOTIFICACIÓN AUTO QUE CORRE TRASLADO DE PRUEBAS APORTADAS POR DEMANDADO','1','1',3,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:33:38',11,'2020-09-16 09:13:34',11,0,1,3,4,2,4),(29,'EJECUCIÓN AUDIENCIA 181 (PRUEBAS Y TESTIGOS)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:39:08',11,'2020-09-14 11:44:42',11,0,1,1,4,1,4),(30,'EJECUCIÓN AUDIENCIA 181 (PENDIENTE PRUEBAS)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:42:05',11,'2020-09-14 11:44:32',11,0,1,1,4,1,4),(31,'NOTIFICACIÓN AUTO QUE CORRE TRASLADO PARA ALEGAR DE CONCLUSIÓN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:43:56',11,'2020-09-14 11:52:20',11,0,1,3,5,1,4),(32,'RADICACIÓN ALEGATOS DE CONCLUSIÓN','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:45:41',11,'2020-09-14 11:45:41',11,0,1,1,6,1,4),(33,'AL DESPACHO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:46:29',11,'2020-09-14 11:46:29',11,0,1,3,5,1,4),(34,'NOTIFICACIÓN FALLO DE PRIMERA INSTANCIA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:47:42',11,'2020-09-14 11:48:21',11,0,1,1,5,1,4),(35,'RADICACIÓN RECURSO DE APELACIÓN','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:49:56',11,'2020-09-14 12:03:17',11,0,1,1,5,1,4),(36,'NOTIFICACIÓN AUTO QUE CONCEDE APELACIÓN Y ENVÍA A SUPERIOR','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 11:51:54',11,'2020-09-14 12:00:59',11,0,1,3,5,1,4),(37,'NOTIFICACIÓN AUTO QUE ADMITE APELACIÓN Y FIJA FECHA AUDIENCIA ART 192','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:00:44',11,'2020-09-14 12:00:44',11,0,1,3,5,1,4),(38,'DEMANDADO RADICA APELACIÓN','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:03:51',11,'2020-09-16 09:13:10',11,0,1,2,5,1,4),(39,'NOTIFICACIÓN FALLO DE SEGUNDA INSTANCIA','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:05:08',11,'2020-09-14 12:05:08',11,0,1,3,5,1,4),(40,'NOTIFICACIÓN AUTO INADMITE DEMANDA','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:37:09',11,'2020-09-14 12:37:09',11,0,1,3,5,1,4),(41,'RADICACIÓN SUBSANACIÓN DEMANDA NULIDAD','1','1',10,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:38:25',11,'2020-09-14 12:38:25',11,0,1,1,4,2,4),(42,'NOTIFICACIÓN AUTO RECHAZA DEMANDA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:39:43',11,'2020-09-14 12:40:19',11,0,1,3,5,1,4),(43,'ESTUDIO SENTENCIA PRIMERA INSTANCIA QUE ACCEDE TOTALMENTE(VIABILIDAD APELACIÓN)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:44:00',11,'2020-09-15 18:20:37',11,0,1,1,4,1,4),(44,'ESTUDIO SENTENCIA PRIMERA INSTANCIA QUE ACCEDE PARCIALMENTE(VIABILIDAD APELACIÓN)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:57:12',11,'2020-09-15 18:20:09',11,0,1,1,4,1,4),(45,'ESTUDIO SENTENCIA PRIMERA INSTANCIA QUE NIEGA TOTALMENTE (VIABILIDAD APELACIÓN)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 12:57:46',11,'2020-09-15 18:19:54',11,0,1,1,4,1,4),(46,'ESTUDIO SENTENCIA PRIMERA INSTANCIA QUE NIEGA POR SU230 (VIABILIDAD APELACIÓN Y TVH)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 13:00:43',11,'2020-09-15 18:19:33',11,0,1,1,4,1,4),(47,'EJECUCIÓN AUDIENCIA 180 (SE ALEGÓ DE CONCLUSIÓN- PENDIENTE FALLO)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 13:06:32',11,'2020-09-14 14:15:21',11,0,1,3,4,1,4),(48,'EJECUCIÓN AUDIENCIA 180 (PENDIENTE TESTIGOS)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:16:31',11,'2020-09-14 14:16:31',11,0,1,1,4,1,4),(49,'NOTIFICACIÓN AUTO QUE FIJA FECHA PARA AUDIENCIA DONDE SE DICTA FALLO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:17:35',11,'2020-09-14 14:18:00',11,0,1,1,4,1,4),(50,'EJECUCIÓN AUDIENCIA 192, DECLARA FALLIDA CONCILIACIÓN, Y CONCEDE APELACIÓN EN EFECTO DEVOLUTIVO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:24:43',11,'2020-09-14 14:30:34',11,0,1,1,4,1,4),(51,'EJECUCIÓN AUDIENCIA 192, DECLARA FALLIDA CONCILIACIÓN, Y CONCEDE APELACIÓN EN EFECTO SUSTITIVO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:31:09',11,'2020-09-14 14:31:31',11,0,1,1,4,1,4),(52,'EJECUCIÓN AUDIENCIA 192 Y DECLARA FALLIDA CONCILIACIÓN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:31:55',11,'2020-09-14 14:32:03',11,0,1,1,4,1,4),(53,'AL DESPACHO (SEGUNDA INSTANCIA)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:33:14',11,'2020-09-14 16:30:42',11,0,1,1,4,1,4),(54,'NOTIFICACIÓN AUTO QUE ADMITE APELACIÓN Y CORRE TRASLADO PARA ALEGAR','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:41:16',11,'2020-09-14 14:41:16',11,0,1,1,4,1,4),(55,'EJECUCIÓN AUDIENCIA 180 (NIEGA LLAMAMIENTO EN GARANTÍA Y ENVÍAN EN EFECTO DEVOLUTIVO AL SUPERIOR)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:43:25',11,'2020-09-14 14:43:35',11,0,1,1,4,1,4),(56,'NOTIFICACIÓN AUTO DE SUPERIOR CONFIRMA NEGATIVA DE LLAMAMIENTO EN GARANTÍA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:44:20',11,'2020-09-14 16:25:29',11,0,1,1,5,1,4),(57,'NOTIFICACIÓN AUTO QUE REVOCA NEGATIVA DE LLAMAMIENTO EN GARANTÍA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 14:46:36',11,'2020-09-14 14:46:36',11,0,1,1,3,1,4),(58,'RADICACIÓN SOLICITUD COPIAS AUTÉNTICAS DE SENTENCIA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:24:10',11,'2020-09-14 16:38:25',11,0,1,1,5,1,4),(59,'RECEPCIÓN DE COPIAS AUTÉNTICAS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:25:19',11,'2020-09-14 16:25:43',11,0,1,1,5,1,4),(60,'DEVOLUCIÓN DE EXPEDIENTE DEL SUPERIOR A JUZGADO DE ORIGEN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:28:38',11,'2020-09-14 16:28:38',11,0,1,3,5,1,4),(61,'RECEPCIÓN DE EXPEDIENTE EN JUZGADO DE ORIGEN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:29:08',11,'2020-09-14 16:29:08',11,0,1,1,5,1,4),(62,'NOTIFICACIÓN AUTO DE OBEDEZCA Y CÚMPLASE LO ORDENADO POR SUPERIOR','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:29:45',11,'2020-09-14 16:29:45',11,0,1,1,5,1,4),(63,'NOTIFICACIÓN AUTO QUE ENVÍA A LIQUIDACIÓN DE COSTAS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:31:23',11,'2020-09-14 16:31:54',11,1,1,1,5,1,4),(64,'NOTIFICACIÓN AUTO QUE ENVÍA A LIQUIDACIÓN EN OFICINA DE APOYO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:31:46',11,'2020-09-14 16:31:46',11,0,1,1,5,1,4),(65,'NOTIFICACIÓN AUTO LIQUIDATORIO DE COSTAS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:33:00',11,'2020-09-14 16:35:05',11,0,1,1,5,1,4),(66,'NOTIFICACIÓN AUTO QUE APRUEBA LIQUIDACIÓN DE COSTAS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:34:46',11,'2020-09-14 16:34:57',11,0,1,1,5,1,4),(67,'RADICACIÓN SOLICITUD COPIAS AUTÉNTICAS DE COSTAS','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:39:34',11,'2020-09-14 16:39:34',11,0,1,1,5,1,4),(68,'RECEPCIÓN DE COPIAS AUTÉNTICAS DE LIQUIDACIÓN DE COSTAS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:40:14',11,'2020-09-14 16:40:14',11,0,1,1,5,1,4),(69,'NOTIFICACIÓN AUTO PRE-ADMISIÓN ENVÍA A OFICINA DE APOYO PARA LIQUIDAR','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:47:15',11,'2020-09-14 16:49:09',11,0,1,1,5,1,4),(70,'NOTIFICACIÓN AUTO PRE-ADMISIÓN ORDENA DESARCHIVE PROCESO NULIDAD','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:48:52',11,'2020-09-14 16:48:52',11,0,1,3,5,1,4),(71,'NOTIFICACIÓN AUTO QUE LIBRA MANDAMIENTO Y FIJA GASTOS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 16:56:50',11,'2020-09-14 16:56:50',11,0,1,3,5,1,10),(72,'NOTIFICACIÓN AUTO QUE LIBRA PARCIALMENTE MANDAMIENTO Y FIJA GASTOS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 17:00:49',11,'2020-09-14 17:00:49',11,0,1,3,5,1,3),(73,'RADICACIÓN APELACIÓN AUTO QUE LIBRA PARCIALMENTE MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 17:03:23',11,'2020-09-14 17:03:23',11,0,1,1,4,1,4),(74,'RADICACIÓN APELACIÓN AUTO QUE NIEGA MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 17:04:11',11,'2020-09-14 17:04:11',11,0,1,1,4,1,4),(75,'NOTIFICACIÓN AUTO QUE NIEGA MANDAMIENTO EJECUTIVO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 17:07:47',11,'2020-09-14 17:07:47',11,0,1,1,5,1,4),(76,'NOTIFICACIÓN AUTO QUE CORRE TRASLADO A CONTRAPARTE PARA CONTESTAR DEMANDA (ART 290 CGP)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-14 17:10:03',11,'2020-09-14 17:11:32',11,0,1,3,5,1,4),(77,'NOTIFICACIÓN MANDAMIENTO DE PAGO A DEMANDA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 09:52:14',11,'2020-09-15 09:52:14',11,0,1,3,5,1,4),(78,'RADICACIÓN POR DEMANDA RECURSO DE REPOSICIÓN CONTRA MADAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 09:53:47',11,'2020-09-15 09:53:47',11,0,1,2,5,1,4),(79,'NOTIFICACIÓN AUTO QUE CORRE TRASLADO RECURSO DE REPOSICIÓN DE DEMANDADA CONTRA MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 09:55:42',11,'2020-09-15 11:39:19',11,0,1,1,4,1,4),(80,'RADICACIÓN PRONUNCIAMIENTO RECURSO DE REPOSICIÓN DE DEMANDA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 09:57:29',11,'2020-09-15 09:57:29',11,0,1,1,6,1,4),(81,'NOTIFICACIÓN AUTO QUE RESUELVE REPOSICIÓN Y NO REPONE MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 09:59:02',11,'2020-09-15 09:59:02',11,0,1,3,5,1,4),(82,'NOTIFICACIÓN AUTO QUE RESUELVE REPOSICIÓN Y REPONE MANDAMIENTO DE PAGO (LIBRAMIENTO PARCIAL)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 10:00:39',11,'2020-09-15 10:01:45',11,0,1,3,5,1,4),(83,'NOTIFICACIÓN AUTO QUE RESUELVE REPOSICIÓN Y NIEGA MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 10:01:36',11,'2020-09-15 10:01:36',11,0,1,3,5,1,4),(84,'NOTIFICACIÓN AUTO QUE CORRE TRASLADO PARA PRONUNCIARSE SOBRE EXCEPCIONES','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 10:31:08',11,'2020-09-15 10:31:08',11,0,1,3,5,1,4),(85,'NOTIFICACIÓN AUTO QUE FIJA FECHA AUDIENCIA ART 372 CGP','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 10:34:14',11,'2020-09-15 10:34:14',11,0,1,3,5,1,4),(86,'EJECUCIÓN AUDIENCIA ART 372 CGP (ORDENA SEGUIR ADELANTE EJECUCIÓN, APELARON Y FUE CONCEDIDA)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:17:17',11,'2020-09-15 11:17:58',11,0,1,3,4,1,4),(87,'EJECUCIÓN AUDIENCIA ART 372 CGP (ORDENA SEGUIR ADELANTE EJECUCIÓN, APELARON Y APELAMOS POR INDEXACIÓ','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:18:41',11,'2020-09-15 11:18:41',11,0,1,3,4,1,4),(88,'EJECUCIÓN AUDIENCIA ART 372 CGP (DECLARARON PROBADA EXCEPCIÓN, APELAMOS Y FUE CONCEDIDA)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:19:35',11,'2020-09-15 11:19:35',11,0,1,3,4,1,4),(89,'RADICACIÓN SUSTENTACIÓN APELACIÓN EN AUDIENCIA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:21:27',11,'2020-09-15 11:21:27',11,0,1,1,6,1,4),(90,'NOTIFICACIÓN AUTO QUE ORDENA SEGUIR ADELANTE Y PRESENTAR LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:30:11',11,'2020-09-15 11:30:11',11,0,1,3,5,1,4),(91,'RADICACIÓN LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:30:49',11,'2020-09-15 11:30:49',11,0,1,1,4,1,4),(92,'RADICACIÓN MEMORIAL DE NO ASISTENCIA A AUDIENCIA ART 192 (NO APELAMOS)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:32:47',11,'2020-09-15 11:32:47',11,0,1,1,6,1,4),(93,'NOTIFICACIÓN AUTO CONCEDE APELACIÓN EN EFECTO DEVOLUTIVO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:34:42',11,'2020-09-15 11:34:42',11,0,1,3,5,1,4),(94,'NOTIFICACIÓN AUTO CONCEDE APELACIÓN EN EFECTO SUSPENSIVO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:35:55',11,'2020-09-15 11:35:55',11,0,1,3,5,1,4),(95,'NOTIFICACIÓN AUTO QUE ADMITE APELACIÓN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 11:37:37',11,'2020-09-15 11:37:37',11,0,1,3,5,1,4),(96,'NOTIFICACIÓN AUTO DE SUPERIOR REVOCA AUTO QUE NEGÓ MANDAMIENTO DE PAGO, LO LIBRA Y FIJA GASTOS','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:14:27',11,'2020-09-16 07:43:20',11,0,1,3,5,1,4),(97,'NOTIFICACIÓN AUTO DE SUPERIOR REVOCA AUTO QUE LIBRA PARCIALMENTE MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:15:06',11,'2020-09-15 18:15:06',11,0,1,3,5,1,4),(98,'NOTIFICACIÓN AUTO DE SUPERIOR QUE CONFIRMA AUTO QUE NIEGA MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:15:57',11,'2020-09-15 18:15:57',11,0,1,3,5,1,4),(99,'NOTIFICACIÓN AUTO DE SUPERIOR QUE CONFIRMA AUTO QUE LIBRA PARCIALMENTE MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:16:31',11,'2020-09-15 18:16:31',11,0,1,3,5,1,4),(100,'NOTIFICACIÓN AUTO QUE REVOCA AUTO QUE ORDENA SEGUIR ADELANTE CON EJECUCIÓN Y NIEGA MANDAMIENTO DE PA','1','1',0,'1','1',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:17:42',11,'2020-09-15 18:17:42',11,0,1,3,5,1,4),(101,'ESTUDIO FALLO SEGUNDA INSTANCIA QUE NIEGA DEFINITIVAMENTE MANDAMIENTO DE PAGO (VIABILIDAD TVH)','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:19:12',11,'2020-09-15 18:19:12',11,0,1,1,4,1,4),(102,'ESTUDIO FALLO SEGUNDA INSTANCIA QUE LIBRA DEFINITIVAMENTE PARCIALMENTE MANDAMIENTO DE PAGO (VIABILID','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:24:12',11,'2020-09-15 18:24:12',11,0,1,1,4,1,4),(103,'NOTIFICACIÓN DE SENTENCIA DE SEGUNDA INSTANCIA QUE ORDENA SEGUIR ADELANTE EJECUCIÓN','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:37:40',11,'2020-09-15 18:37:40',11,0,1,3,5,1,4),(104,'NOTIFICACIÓN DE SENTENCIA DE SEGUNDA INSTANCIA QUE CONFIRMA PERO MODIFICA SENTENCIA DE PRIMERA INSTA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:38:56',11,'2020-09-15 18:38:56',11,0,1,3,5,1,4),(105,'NOTIFICACIÓN AUTO QUE FIJA FECHA AUDIENCIA ART 327 CGP','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-15 18:40:56',11,'2020-09-15 18:40:56',11,0,1,3,5,1,4),(106,'NOTIFICACIÓN AUTO OBEDEZCA Y CÚMPLASE LO ORDENADO POR SUPERIOR','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:41:26',11,'2020-09-16 07:41:26',11,0,1,1,5,1,4),(107,'NOTIFICACIÓN AUTO DE SUPERIOR REVOCA AUTO QUE NEGÓ MANDAMIENTO DE PAGO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:44:20',11,'2020-09-16 07:44:20',11,0,1,3,5,1,4),(108,'NOTIFICACIÓN AUTO DE SUPERIOR REVOCA AUTO QUE NEGÓ MANDAMIENTO DE PAGO Y ORDENA DESARCHIVE','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:45:35',11,'2020-09-16 07:45:35',11,0,1,3,5,1,4),(109,'RADICACIÓN ACTUALIZACIÓN DE LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:46:39',11,'2020-09-16 07:46:39',11,0,1,1,4,1,4),(110,'DEMANDADO RADICA LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:47:34',11,'2020-09-16 07:47:34',11,0,1,2,5,1,4),(111,'NOTIFICACIÓN DE AUTO QUE CORRE TRASLADO DE LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:48:44',11,'2020-09-16 07:48:44',11,0,1,3,5,1,4),(112,'RADICACIÓN DE OBJECIÓN A LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:51:17',11,'2020-09-16 07:51:17',11,0,1,1,5,1,4),(113,'NOTIFICACIÓN DE AUTO QUE APRUEBA LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:52:57',11,'2020-09-16 07:52:57',11,0,1,3,5,1,4),(114,'NOTIFICACIÓN DE AUTO QUE MODIFICA LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 07:53:39',11,'2020-09-16 07:53:39',11,0,1,3,5,1,4),(115,'NOTIFICACIÓN AUTO QUE APRUEBA LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:43:45',11,'2020-09-16 08:43:56',11,1,1,3,5,1,4),(116,'RADICACIÓN APELACIÓN AUTO QUE APRUEBA LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:44:33',11,'2020-09-16 08:44:33',11,0,1,1,6,1,4),(117,'RADICACIÓN OFICIO DE SOLICITUD DE DESARCHIVE','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:48:12',11,'2020-09-16 08:48:12',11,0,1,1,6,1,4),(118,'RADICACIÓN DE IMPULSO PROCESAL','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:49:35',11,'2020-09-16 08:49:35',11,0,1,1,6,1,4),(119,'NOTIFICACIÓN AUTO REQUIERE OFICINA DE APOYO PARA DESARCHIVE','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:51:19',11,'2020-09-16 08:51:19',11,0,1,3,5,1,4),(120,'REGISTRA PROYECTO DE FALLO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:51:51',11,'2020-09-30 14:28:49',11,0,1,3,5,1,5),(121,'RADICACIÓN DENUNCIA ANTE FISCALÍA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:58:00',11,'2020-09-16 08:58:00',11,0,1,1,4,1,4),(122,'RADICACIÓN DE IMPULSO DE PAGO DE LIQUIDACIÓN DE CRÉDITO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 08:59:42',11,'2020-09-16 08:59:42',11,0,1,1,4,1,4),(123,'RADICACIÓN DE SOLICITUD DE TERMINACIÓN DE PROCESO POR PAGO TOTAL','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 09:00:57',11,'2020-09-16 09:00:57',11,0,1,1,4,1,4),(124,'NOTIFICACIÓN DE AUTO QUE PONE EN CONOCIMIENTO DENUNCIA AL DEMANDADO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 09:02:11',11,'2020-09-16 09:11:45',11,0,1,3,5,1,4),(125,'DEMANDADO RADICA EXPEDIENTE ADMINISTRATIVO','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 09:14:35',11,'2020-09-16 09:14:35',11,0,1,2,5,1,4),(126,'DEMANDADO RADICA CERTIFICADO DE INEMBARGABILIDAD','1','1',1,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 09:16:17',11,'2020-09-17 08:45:13',8,0,1,2,5,2,4),(127,'DEMANDADO RADICA SOLICITUD DE CONSTANCIA DE EJECUTORIA','1','1',0,'1','2',NULL,'1','1','1','1','1','1','1','1','1','1','2020-09-16 09:17:49',11,'2020-09-16 09:17:49',11,0,1,2,5,1,4);
/*!40000 ALTER TABLE `actuacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_documento`
--

DROP TABLE IF EXISTS `actuacion_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_documento` (
  `id_actuacion_documento` int(11) NOT NULL AUTO_INCREMENT,
  `id_actuacion` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  PRIMARY KEY (`id_actuacion_documento`),
  KEY `FK_actuacion_documento_actuacion` (`id_actuacion`),
  KEY `FK_actuacion_documento_documento` (`id_documento`),
  CONSTRAINT `FK_actuacion_documento_actuacion` FOREIGN KEY (`id_actuacion`) REFERENCES `actuacion` (`id_actuacion`),
  CONSTRAINT `FK_actuacion_documento_documento` FOREIGN KEY (`id_documento`) REFERENCES `documento` (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_documento`
--

LOCK TABLES `actuacion_documento` WRITE;
/*!40000 ALTER TABLE `actuacion_documento` DISABLE KEYS */;
INSERT INTO `actuacion_documento` VALUES (17,9,8),(18,10,8),(19,11,8),(20,12,8),(21,13,8),(22,14,8),(23,15,8),(25,7,8),(30,17,8),(36,16,8),(48,18,1),(49,18,2),(50,18,3),(51,18,16),(73,27,22),(78,31,25),(80,25,20),(85,3,8),(86,5,8),(87,36,28),(88,37,27),(91,39,30),(92,34,29),(93,35,26),(102,19,17),(103,19,33),(104,41,35),(106,42,36),(107,20,5),(108,21,18),(109,22,19),(122,49,37),(124,48,38),(125,47,38),(126,30,38),(127,29,38),(128,26,38),(130,50,38),(132,51,38),(134,52,38),(135,54,39),(137,55,38),(138,57,41),(140,59,43),(141,62,44),(142,64,45),(144,66,47),(145,58,42),(146,67,42),(147,68,43),(149,69,48),(150,70,49),(151,71,50),(152,72,50),(155,74,53),(156,73,52),(157,75,54),(158,76,55),(159,78,56),(161,81,58),(163,83,58),(164,82,58),(165,84,55),(166,24,19),(167,85,20),(168,86,38),(169,87,38),(170,88,38),(171,89,51),(172,90,59),(173,91,60),(174,92,61),(175,93,62),(176,94,63),(177,95,64),(178,79,57),(180,97,65),(181,98,65),(182,99,65),(183,100,65),(184,46,26),(185,45,26),(186,44,26),(187,44,26),(188,43,26),(189,103,30),(190,104,30),(191,105,20),(192,106,44),(193,96,65),(194,107,50),(195,108,50),(196,109,60),(197,110,60),(198,111,55),(199,112,66),(200,114,68),(201,113,67),(202,115,67),(203,116,69),(204,117,70),(205,118,71),(206,119,72),(207,121,73),(208,122,74),(209,123,75),(211,124,76),(212,38,26),(213,28,23),(214,125,77),(217,127,79),(218,127,80),(219,126,78),(225,1,6),(226,1,7),(227,1,2),(228,1,3),(229,1,1),(237,6,31),(238,6,14),(239,6,32),(240,6,31),(241,6,32),(242,4,15),(243,8,3),(244,2,8);
/*!40000 ALTER TABLE `actuacion_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_etapa_proceso`
--

DROP TABLE IF EXISTS `actuacion_etapa_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_etapa_proceso` (
  `id_actuacion_etapa_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `id_etapa_proceso` varchar(45) DEFAULT NULL,
  `id_actuacion` varchar(45) DEFAULT NULL,
  `tiempo_maximo_proxima_actuacion` int(11) DEFAULT NULL,
  `unidad_tiempo_proxima_actuacion` int(1) DEFAULT '1',
  `id_usuario_creacion` int(11) DEFAULT '0',
  `order` int(3) DEFAULT '0',
  PRIMARY KEY (`id_actuacion_etapa_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_etapa_proceso`
--

LOCK TABLES `actuacion_etapa_proceso` WRITE;
/*!40000 ALTER TABLE `actuacion_etapa_proceso` DISABLE KEYS */;
INSERT INTO `actuacion_etapa_proceso` VALUES (1,'2','9',30,1,0,0),(3,'2','5',30,1,0,0),(4,'3','6',2,3,0,0),(6,'3','11',30,1,0,0),(7,'5','11',60,1,0,0),(8,'6','13',20,1,0,0),(9,'1','8',10,1,0,1),(10,'1','16',10,1,0,3),(11,'1','4',30,1,0,2),(12,'2','10',30,1,0,0),(13,'12','1',4,1,11,1);
/*!40000 ALTER TABLE `actuacion_etapa_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_etapa_proceso_detalle`
--

DROP TABLE IF EXISTS `actuacion_etapa_proceso_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_etapa_proceso_detalle` (
  `id_actuacion_etapa_proceso_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_actuacion_etapa_proceso_maestro` int(11) NOT NULL,
  `id_actuacion_proxima` int(11) NOT NULL,
  `tiempo_maximo_proxima_actuacion` smallint(6) NOT NULL,
  `unidad_tiempo_proxima_actuacion` enum('1','2','3','4') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_actuacion_etapa_proceso_detalle`),
  KEY `FK_actuacion_etapa_proceso_detalle_maestro` (`id_actuacion_etapa_proceso_maestro`),
  KEY `FK_actuacion_etapa_proceso_detalle_actuacion` (`id_actuacion_proxima`),
  CONSTRAINT `FK_actuacion_etapa_proceso_detalle_actuacion` FOREIGN KEY (`id_actuacion_proxima`) REFERENCES `actuacion` (`id_actuacion`),
  CONSTRAINT `FK_actuacion_etapa_proceso_detalle_maestro` FOREIGN KEY (`id_actuacion_etapa_proceso_maestro`) REFERENCES `actuacion_etapa_proceso_maestro` (`id_actuacion_etapa_proceso_maestro`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_etapa_proceso_detalle`
--

LOCK TABLES `actuacion_etapa_proceso_detalle` WRITE;
/*!40000 ALTER TABLE `actuacion_etapa_proceso_detalle` DISABLE KEYS */;
INSERT INTO `actuacion_etapa_proceso_detalle` VALUES (1,1,8,3,'3'),(2,2,15,10,'1'),(3,3,9,30,'1'),(6,6,12,30,'1'),(7,7,11,2,'3'),(8,8,15,10,'1'),(9,9,15,30,'1'),(10,10,7,30,'1'),(11,11,15,30,'1'),(13,13,14,20,'1'),(14,14,13,60,'1'),(16,16,11,20,'1');
/*!40000 ALTER TABLE `actuacion_etapa_proceso_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_etapa_proceso_maestro`
--

DROP TABLE IF EXISTS `actuacion_etapa_proceso_maestro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_etapa_proceso_maestro` (
  `id_actuacion_etapa_proceso_maestro` int(11) NOT NULL AUTO_INCREMENT,
  `id_actuacion` int(11) NOT NULL,
  `id_etapa_proceso` int(11) NOT NULL,
  PRIMARY KEY (`id_actuacion_etapa_proceso_maestro`),
  KEY `FK_actuacion_etapa_proceso_maestro_actuacion` (`id_actuacion`),
  KEY `FK_actuacion_etapa_proceso_maestro_etapa_proceso` (`id_etapa_proceso`),
  CONSTRAINT `FK_actuacion_etapa_proceso_maestro_actuacion` FOREIGN KEY (`id_actuacion`) REFERENCES `actuacion` (`id_actuacion`),
  CONSTRAINT `FK_actuacion_etapa_proceso_maestro_etapa_proceso` FOREIGN KEY (`id_etapa_proceso`) REFERENCES `etapa_proceso` (`id_etapa_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_etapa_proceso_maestro`
--

LOCK TABLES `actuacion_etapa_proceso_maestro` WRITE;
/*!40000 ALTER TABLE `actuacion_etapa_proceso_maestro` DISABLE KEYS */;
INSERT INTO `actuacion_etapa_proceso_maestro` VALUES (1,1,1),(2,8,1),(3,5,2),(6,11,3),(7,6,3),(8,16,1),(9,4,1),(10,9,2),(11,10,2),(13,13,6),(14,11,5),(16,13,2);
/*!40000 ALTER TABLE `actuacion_etapa_proceso_maestro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_plantilla_documento`
--

DROP TABLE IF EXISTS `actuacion_plantilla_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_plantilla_documento` (
  `id_actuacion_plantilla_documento` int(11) NOT NULL AUTO_INCREMENT,
  `id_actuacion` int(11) NOT NULL,
  `id_plantilla_documento` int(11) NOT NULL,
  PRIMARY KEY (`id_actuacion_plantilla_documento`),
  KEY `FK_actuacion_plantilla_documento_actuacion` (`id_actuacion`),
  KEY `FK_actuacion_plantilla_documento_plantilla_documento` (`id_plantilla_documento`),
  CONSTRAINT `FK_actuacion_plantilla_documento_actuacion` FOREIGN KEY (`id_actuacion`) REFERENCES `actuacion` (`id_actuacion`),
  CONSTRAINT `FK_actuacion_plantilla_documento_plantilla_documento` FOREIGN KEY (`id_plantilla_documento`) REFERENCES `plantilla_documento` (`id_plantilla_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_plantilla_documento`
--

LOCK TABLES `actuacion_plantilla_documento` WRITE;
/*!40000 ALTER TABLE `actuacion_plantilla_documento` DISABLE KEYS */;
INSERT INTO `actuacion_plantilla_documento` VALUES (5,2,2),(10,6,2),(11,5,2),(14,8,2),(15,9,2),(16,10,2),(17,11,3),(18,12,2),(19,13,2),(20,14,2),(21,15,2),(22,16,2),(23,7,2),(24,1,1),(25,3,2),(26,4,2),(27,17,2);
/*!40000 ALTER TABLE `actuacion_plantilla_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actuacion_proceso`
--

DROP TABLE IF EXISTS `actuacion_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_proceso` (
  `consecutivo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proceso` int(11) NOT NULL,
  `cod_etapa` int(11) NOT NULL,
  `cod_actuacion` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_respuesta` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `usuario_reg` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_radicado` date DEFAULT NULL,
  `entidad_juzgado` varchar(50) DEFAULT NULL,
  `juez_juzgado` varchar(50) DEFAULT NULL,
  `numero_proceso_juzgado` varchar(20) DEFAULT NULL,
  `instancia_proceso_juzgado` varchar(30) DEFAULT NULL,
  `resultado` int(50) DEFAULT NULL,
  `fecha_notifica` date DEFAULT NULL,
  `tipo_resultado` int(10) DEFAULT NULL,
  `numero_resultado` varchar(20) DEFAULT NULL,
  `fecha_audiencia` date DEFAULT NULL,
  `hora_audiencia` varchar(5) DEFAULT NULL,
  `lugar_audiencia` varchar(50) DEFAULT NULL,
  `apela_resultado` int(5) DEFAULT NULL,
  `motivo_apelacion` varchar(50) DEFAULT NULL,
  `numero_radicado` varchar(20) NOT NULL,
  `entidad_respuesta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`consecutivo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacion_proceso`
--

LOCK TABLES `actuacion_proceso` WRITE;
/*!40000 ALTER TABLE `actuacion_proceso` DISABLE KEYS */;
INSERT INTO `actuacion_proceso` VALUES (1,7,1,8,'2020-02-03','2020-02-28','2020-02-12','2020-02-26','',1,'2020-02-03 11:37:55',1,'2020-02-10','','','123456','',0,'2020-02-05',0,'5678','0000-00-00','[obje','',1,'alguna','5678','la misma'),(2,7,1,1,'0000-00-00','0000-00-00','0000-00-00','0000-00-00','',6,'2020-04-03 19:38:54',1,'0000-00-00','','','','',0,'0000-00-00',0,'','0000-00-00','[obje','',0,'','',''),(3,1,1,1,'0000-00-00','0000-00-00','0000-00-00','0000-00-00','',6,'2020-04-04 17:56:09',1,'0000-00-00','','','','',0,'0000-00-00',0,'','0000-00-00','[obje','',0,'','',''),(4,10,1,1,'0000-00-00','0000-00-00','0000-00-00','0000-00-00','',3,'2020-04-22 16:59:03',1,'0000-00-00','','','','',0,'0000-00-00',0,'','0000-00-00','[obje','',0,'','','');
/*!40000 ALTER TABLE `actuacion_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Recepción',0),(2,'Administración',0),(3,'Agotamientos de Via',0),(4,'Sustanciación',0),(5,'Dependencia',0),(6,'Mensajería',0);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase_estado`
--

DROP TABLE IF EXISTS `clase_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase_estado` (
  `id_clase_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_clase_estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_clase_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_estado`
--

LOCK TABLES `clase_estado` WRITE;
/*!40000 ALTER TABLE `clase_estado` DISABLE KEYS */;
INSERT INTO `clase_estado` VALUES (1,'SEDE OPERATIVA'),(2,'TIPO DE DOCUMENTO'),(3,'USUARIO SEDE OPERATIVA'),(4,'USUARIO'),(5,'PERSONA'),(6,'TIPO DE PROCESO'),(7,'ETAPA DE PROCESO'),(8,'DOCUMENTO'),(9,'PLANTILLA DE DOCUMENTO'),(10,'ENTIDAD DE PENSI├ôN'),(11,'ENTIDAD DE JUSTICIA'),(12,'INTERMEDIARIO'),(13,'ACTUACION'),(14,'CLIENTE'),(15,'ESTADO VITAL DEL CLIENTE'),(16,'PROCESO');
/*!40000 ALTER TABLE `clase_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase_parametro`
--

DROP TABLE IF EXISTS `clase_parametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase_parametro` (
  `id_clase_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_clase_parametro` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_clase_parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_parametro`
--

LOCK TABLES `clase_parametro` WRITE;
/*!40000 ALTER TABLE `clase_parametro` DISABLE KEYS */;
INSERT INTO `clase_parametro` VALUES (1,'VALIDACI├ôN DE FORMULARIOS');
/*!40000 ALTER TABLE `clase_parametro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase_tipo`
--

DROP TABLE IF EXISTS `clase_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase_tipo` (
  `id_clase_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_clase_tipo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_clase_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_tipo`
--

LOCK TABLES `clase_tipo` WRITE;
/*!40000 ALTER TABLE `clase_tipo` DISABLE KEYS */;
INSERT INTO `clase_tipo` VALUES (1,'POSICION ETAPA DE PROCESO'),(2,'OBLIGATORIEDAD DOCUMENTO'),(3,'APLICA PRIMERA INSTANCIA - ENTIDAD DE JUSTICIA'),(4,'APLICA SEGUNDA INSTANCIA - ENTIDAD DE JUSTICIA'),(5,'GENERA ALERTAS - ACTUACION'),(6,'APLICA CONTROL DE VENCIMIENTO - ACTUACION'),(7,'REQUIERE ESTUDIO DE FAVORABILIDAD - ACTUACION'),(8,'ACTUACION TIENE COBRO'),(9,'ACTUACION CREACION CLIENTE'),(10,'MOSTRAR DATOS DE RADICADO - ACTUACION'),(11,'MOSTRAR DATOS DE JUZGADO - ACTUACION'),(12,'MOSTRAR DATOS DE RESPUESTA - ACTUACION'),(13,'MOSTRAR DATOS DE APELACION - ACTUACION'),(14,'MOSTRAR DATOS DE COBROS - ACTUACION'),(15,'PROGRAMAR AUDIENCIA - ACTUACION'),(16,'CONTROL DE ENTREGA DE DOCUMENTOS - ACTUACION'),(17,'GENERAR DOCUMENTOS - ACTUACION'),(18,'UNIDAD DE TIEMPO'),(19,'AUTORIZA DAR INFORMACI├ôN DEL ESTADO DE PROCESO');
/*!40000 ALTER TABLE `clase_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `id_intermediario` int(11) DEFAULT NULL,
  `id_contacto` int(11) DEFAULT NULL,
  `estado_vital_cliente` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_fallecimiento` date DEFAULT NULL,
  `nombre_persona_recomienda` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_documento_beneficiario` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_beneficiario` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `parentesco_beneficiario` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_cliente` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `otrodatocontacto` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular2` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipo_documento_beneficiario` int(11) DEFAULT '0',
  `telefono_beneficiario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular_beneficiario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular2_beneficiario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_electronico_beneficiario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `IX_cliente_id_persona` (`id_persona`),
  KEY `FK_cliente_contacto` (`id_contacto`),
  KEY `IX_cliente_estado_vital_cliente` (`estado_vital_cliente`),
  KEY `IX_cliente_estado_cliente` (`estado_cliente`),
  CONSTRAINT `FK_cliente_contacto` FOREIGN KEY (`id_contacto`) REFERENCES `contacto` (`id_contacto`),
  CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,4,NULL,1,'1',NULL,'LUIS FERNANDO CASTILLO','','','','1','2019-05-10 15:00:14',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:25',8,1),(2,5,1,2,'1',NULL,'','','','','1','2019-05-10 15:07:53',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:26:49',8,1),(3,6,NULL,3,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-10 15:28:54',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:27',8,1),(4,7,1,4,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-10 15:37:27',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:26:53',8,1),(5,8,1,5,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-10 15:52:00',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:26:57',8,1),(6,9,1,6,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-10 16:02:45',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:00',8,1),(7,10,1,7,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-10 16:17:47',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:03',8,1),(8,11,1,8,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-13 08:57:56',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:06',8,1),(9,12,1,9,'1',NULL,'','0','NO APLICA','NO APLICA','1','2019-05-13 09:44:47',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:09',8,1),(10,13,1,10,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-13 09:51:10',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:12',8,1),(11,14,1,11,'1',NULL,'NO APLICA','0','NO APLICA','NO APLICA','1','2019-05-13 09:56:28',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:14',8,1),(12,15,1,12,'1',NULL,'','','','','1','2019-08-02 14:01:40',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:17',8,1),(13,16,1,13,'1',NULL,'','','','','1','2019-08-02 14:41:06',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:20',8,1),(14,17,1,14,'1',NULL,'','','','','1','2019-08-06 14:07:03',1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2020-08-14 08:27:23',8,1),(15,32,0,26,'1',NULL,NULL,NULL,NULL,NULL,'1','2020-09-11 10:03:27',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-11 10:07:01',3,1),(16,34,0,30,'1',NULL,'NW',NULL,NULL,NULL,'1','2020-09-30 12:47:40',11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Observaciones del cliente','2020-11-23 09:13:37',1,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente_proceso_com`
--

DROP TABLE IF EXISTS `cliente_proceso_com`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_proceso_com` (
  `id_cliente` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `comentario` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `fecha_proceso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci COMMENT='inf de Comentarios  cliente y proceso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente_proceso_com`
--

LOCK TABLES `cliente_proceso_com` WRITE;
/*!40000 ALTER TABLE `cliente_proceso_com` DISABLE KEYS */;
INSERT INTO `cliente_proceso_com` VALUES (2,12,'algo',1,20200120,'2020-01-20 11:43:46'),(2,12,'algo',1,20200120,'2020-01-20 11:53:40'),(2,7,'pruebas',1,20200120,'2020-01-20 14:38:12'),(14,4,'oleee',1,20200128,'2020-01-28 15:45:52'),(0,0,'',1,20200128,'2020-01-28 16:17:51'),(14,2,'agregar',1,20200129,'2020-01-29 23:14:25'),(14,2,'agregar',1,20200129,'2020-01-29 23:17:33'),(2,7,'primer comentario',1,20200203,'2020-02-03 11:30:09'),(2,7,'segundo comentario',1,20200203,'2020-02-03 11:36:03'),(2,7,'esta cliente es complicado.... ojo!!',3,20200311,'2020-03-11 11:38:15'),(2,7,'este cliente fallecio y los familiares estÃ¡n iniciando proce',3,20200311,'2020-03-11 11:39:29'),(2,7,'este cliente fallecio y los familiares estÃ¡n iniciando proce',3,20200311,'2020-03-11 11:39:39'),(14,3,'prueba con Claudia',3,20200312,'2020-03-12 10:48:34'),(14,3,'la cliente llamo porque esta preocupada por la demora del pr',3,20200312,'2020-03-12 10:49:24'),(2,1,'prueba',6,20200404,'2020-04-04 17:53:40');
/*!40000 ALTER TABLE `cliente_proceso_com` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobro`
--

DROP TABLE IF EXISTS `cobro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobro` (
  `id_cobro` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` int(11) DEFAULT NULL,
  `concepto` varchar(100) DEFAULT '',
  `valor` float(11,2) DEFAULT NULL,
  `fecha_cobro` date DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `cerrado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_cobro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobro`
--

LOCK TABLES `cobro` WRITE;
/*!40000 ALTER TABLE `cobro` DISABLE KEYS */;
/*!40000 ALTER TABLE `cobro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_contacto` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `parentesco` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `barrio` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_municipio` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` bigint(20) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `correo_electronico` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `informacion_adicional` text COLLATE utf8_spanish_ci,
  `id_municipio` int(11) DEFAULT '0',
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (1,'0','','','','','',0,0,'',NULL,0),(2,'0','BALDOINO ASPRILLA RIOS','','','','',3136503337,0,'',NULL,0),(3,'0','EDWAR HERNANDO FAJARDO','HERMANO','CALLE 43 SUR # 13D-29','MARCO FIDEL SUAREZ','BOGOTA',3164159983,3164159983,'luzdaryfajardo76@gmail.com',NULL,0),(4,'0','JULIAN ALBERTO CORREA','HERMANO','CALLE 54 F SUR #94-21','BOSA PORVENIR','BOGOTA',3108833500,3108833500,'butterfly_288@hotmail.com',NULL,0),(5,'0','CLAUDIA ADRIANA ALDANA PERDOMO','HERMANA','CALLE 23 A BIS # 83-75','MODELIA','BOGOTA',3184561043,3184561043,'yasaldana@hotmail.com',NULL,0),(6,'0','LADY CAROLINA SALAMANCA','AMIGA','NO APLICA','NO APLICA','BOGOTA',3156968198,3156968198,'bryanricardo1705@gmail.com',NULL,0),(7,'0','MARIA ANGELICA BAUTISTA RIOS','HERMANA','MANZANA 4 CASA 9','SANTA ISABEL GIRARDOT','GIRARDOT',3213243095,3213243095,'patico1029@yahoo.es',NULL,0),(8,'0','CESAR ANDRES SALAMNCA SANDOVAL','AMIGO','0','NO APLICA','NO APLICA',3167542771,3167542771,'gimilena270@gmail.com',NULL,0),(9,'0','MARIA NIDIA BUILES LONDOÑO','HERMANA','KRA 18A # 5-34 SUR','SAN CARLOS','BOGOTA',3152650025,3152650025,'adreatico1015@yahoo.es',NULL,0),(10,'0','CARLOS ADOLFO BARRIGA BRICEÑO','HERMANO','KRA 24C # 23-38 SUR','CENTENARIO','BOGOTA',3015293966,3015293966,'marthabricenosierra@gmail.com',NULL,0),(11,'0','EMERZON ACEVEDO','AMIGO','CALLE 24 SUR # 12-52','SAN JOSE','BOGOTA',3123125679,3123125679,'bullosa01.17@gmail.com',NULL,0),(12,'','YASMIN ANDREA ALDANA PERDOMO','HERMANA','CALLE 23 A BIS # 83-75 APTO 506','MODELIA','BOGOTA',3188447905,0,'',NULL,0),(13,'','ALEJANDRO FUQUENE','AMIGO','','','BOGOTA',3212553102,0,'',NULL,0),(14,'','','','','','',0,0,'',NULL,0),(15,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'','hia de pepito','hija',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'','hia de pepito','hija',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'',NULL,NULL,NULL,NULL,NULL,1493,1493,'1493',NULL,1493),(27,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'',NULL,NULL,NULL,NULL,NULL,2142,2142,'2142',NULL,2142);
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `nombre_departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_departamento`),
  UNIQUE KEY `IX_departamento_nombre_departamento` (`nombre_departamento`),
  KEY `FK_departamento_pais` (`id_pais`),
  CONSTRAINT `FK_departamento_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,1,'D.C.'),(2,1,'Cundinamarca'),(3,1,'Antioquia'),(4,1,'Valle del Cauca'),(5,1,'Amazonas'),(7,1,'Arauca'),(8,1,'Atlántico'),(9,1,'Bolívar'),(10,1,'Boyacá'),(11,1,'Caldas'),(12,1,'Caquetá'),(13,1,'Casanare'),(14,1,'Cauca'),(15,1,'Cesar'),(16,1,'Chocó'),(18,1,'Córdoba'),(19,1,'Guainía'),(20,1,'Guaviare'),(21,1,'Huila'),(22,1,'La Guajira'),(23,1,'Magdalena'),(24,1,'Meta'),(25,1,'Nariño'),(26,1,'Norte de Santander'),(27,1,'Putumayo'),(28,1,'Quindío'),(29,1,'Risaralda'),(30,1,'San Andrés y Providencia'),(31,1,'Santander'),(32,1,'Sucre'),(33,1,'Tolima'),(35,1,'Vaupés'),(36,1,'Vichada'),(37,2,'Otro');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_documento` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `obligatoriedad_documento` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `estado_documento` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_documento`),
  UNIQUE KEY `IX_documento_nombre_documento` (`nombre_documento`),
  KEY `IX_documento_obligatoriedad_documento` (`obligatoriedad_documento`),
  KEY `IX_documento_estado_documento` (`estado_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,'FOTOCOPIA CEDULA','1','1','2019-03-02 12:14:57',1,NULL,NULL,0),(2,'FACTORES SALARIALES','2','1','2019-03-02 12:15:33',1,NULL,NULL,0),(3,'RESOLUCIÓN','1','1','2019-03-02 12:15:49',1,'2020-10-02 15:58:34',8,0),(4,'COPIA CONTRATOS','2','1','2019-03-02 12:16:13',1,NULL,NULL,0),(5,'OTROS DOCUMENTOS','2','1','2019-03-02 12:16:45',1,NULL,NULL,0),(6,'CONTRATO HONORARIOS','1','1','2019-03-02 12:17:51',1,NULL,NULL,0),(7,'PODERES','1','1','2019-03-02 12:18:03',1,NULL,NULL,0),(8,'APELACIÓN CONTRA ACTO ADMINISTRATIVO','1','1','2019-03-04 19:58:06',1,'2020-09-14 11:56:52',11,0),(9,'DOCU1','1','2','2020-02-26 11:13:15',3,NULL,NULL,0),(10,'PRUEBA','1','2','2020-02-27 11:41:18',3,NULL,NULL,0),(12,'PRUEBA99','1','1','2020-03-25 15:59:48',3,NULL,NULL,0),(13,'CEDULA','1','1','2020-03-25 16:02:17',3,NULL,NULL,0),(14,'HOJA DE REPARTO','1','1','2020-08-28 14:43:12',3,'2020-08-28 14:43:12',3,0),(15,'DERECHO DE PETICIÓN','1','1','2020-08-31 15:43:00',8,'2020-09-14 11:57:22',11,0),(16,'CARTA DE RESULTADO COMPLETAR DOCUMENTOS','1','1','2020-09-01 14:51:37',8,'2020-09-01 14:51:37',8,0),(17,'CONSTANCIA PAGO GASTOS DEL PROCESO','1','1','2020-09-14 10:50:26',11,'2020-09-14 10:51:05',11,0),(18,'CONTESTACIÓN DEMANDA','1','1','2020-09-14 11:03:21',11,'2020-09-14 11:03:21',11,0),(19,'CONTESTACIÓN EXCEPCIONES','1','1','2020-09-14 11:15:23',11,'2020-09-14 11:15:23',11,0),(20,'AUTO QUE FIJA FECHA AUDIENCIA','1','1','2020-09-14 11:28:52',11,'2020-09-14 11:28:52',11,0),(21,'ACTA AUDIENCIA ART 180','1','1','2020-09-14 11:30:41',11,'2020-09-14 14:25:16',11,1),(22,'PRUEBAS APORTADAS POR DEMANDO','1','1','2020-09-14 11:32:20',11,'2020-09-14 11:32:20',11,0),(23,'PRONUNCIAMIENTO PRUEBAS APORTADAS POR DEMANDADO','2','1','2020-09-14 11:34:11',11,'2020-09-14 11:34:11',11,0),(24,'ACTA AUDIENCIA ART 181','1','1','2020-09-14 11:42:33',11,'2020-09-14 14:25:26',11,1),(25,'ALEGATOS DE CONCLUSIÓN','1','1','2020-09-14 11:44:10',11,'2020-09-14 11:44:10',11,0),(26,'APELACIÓN SENTENCIA PRIMERA INSTANCIA','2','1','2020-09-14 11:47:58',11,'2020-09-14 11:57:51',11,0),(27,'AUTO QUE ADMITE APELACIÓN Y FIJA FECHA AUDIENCIA ART 192','1','1','2020-09-14 12:01:30',11,'2020-09-14 12:01:30',11,0),(28,'AUTO QUE CONCEDE APELACIÓN Y ENVÍA AL SUPERIOR','1','1','2020-09-14 12:01:58',11,'2020-09-14 12:01:58',11,0),(29,'SENTENCIA DE PRIMERA INSTANCIA','1','1','2020-09-14 12:05:30',11,'2020-09-14 12:05:30',11,0),(30,'SENTENCIA DE SEGUNDA INSTANCIA','1','1','2020-09-14 12:05:40',11,'2020-09-14 12:05:40',11,0),(31,'CUERPO DE LA DEMANDA','1','1','2020-09-14 12:32:53',11,'2020-09-14 12:32:53',11,0),(32,'ANEXOS DEMANDA','1','1','2020-09-14 12:33:33',11,'2020-09-14 12:33:33',11,0),(33,'AUTO ADMITE DEMANDA Y FIJA GASTOS','1','1','2020-09-14 12:35:19',11,'2020-09-14 12:35:19',11,0),(34,'AUTO INADMITE DEMANDA Y CONCEDE SUBSANACIÓN','1','1','2020-09-14 12:37:25',11,'2020-09-14 12:37:25',11,0),(35,'SUBSANACIÓN DEMANDA','1','1','2020-09-14 12:38:57',11,'2020-09-14 12:38:57',11,0),(36,'AUTO RECHAZA DEMANDA','1','1','2020-09-14 12:39:55',11,'2020-09-14 12:39:55',11,0),(37,'AUTO FIJA FECHA PARA AUDIENCIA DONDE SE DICTA FALLO','2','1','2020-09-14 14:18:19',11,'2020-09-14 14:18:19',11,0),(38,'ACTA AUDIENCIA','1','1','2020-09-14 14:25:01',11,'2020-09-14 14:25:01',11,0),(39,'AUTO ADMITE APELACIÓN Y CORRE TRASLADO PARA ALEGAR','2','1','2020-09-14 14:41:40',11,'2020-09-14 14:41:40',11,0),(40,'AUTO DE SUPERIOR QUE CONFIRMA NEGATIVA DE LLAMAMIENTO EN GARANTÍA','1','1','2020-09-14 14:44:39',11,'2020-09-14 14:44:39',11,0),(41,'AUTO DE SUPERIOR QUE REVOCA NEGATIVA DE LLAMAMIENTO EN GARANTÍA','1','1','2020-09-14 14:46:00',11,'2020-09-14 14:46:00',11,0),(42,'SOLICITUD DE COPIAS AUTÉNTICAS','1','1','2020-09-14 16:24:29',11,'2020-09-14 16:24:29',11,0),(43,'COPIAS AUTÉNTICAS','1','1','2020-09-14 16:24:52',11,'2020-09-14 16:24:52',11,0),(44,'AUTO DE OBEDEZCA Y CÚMPLASE','1','1','2020-09-14 16:30:05',11,'2020-09-16 07:40:42',11,0),(45,'AUTO QUE ENVÍA A OFICINA DE APOYO','2','1','2020-09-14 16:32:13',11,'2020-09-14 16:32:13',11,0),(46,'AUTO LIQUIDATORIO DE COSTAS','2','1','2020-09-14 16:33:11',11,'2020-09-14 16:33:25',11,0),(47,'AUTO QUE APRUEBA LIQUIDACIÓN DE COSTAS','2','1','2020-09-14 16:34:09',11,'2020-09-14 16:34:09',11,0),(48,'AUTO ENVÍA A OFICINA DE APOYO PARA LIQUIDAR','2','1','2020-09-14 16:47:38',11,'2020-09-14 16:47:38',11,0),(49,'AUTO ORDENA DESARCHIVE','2','1','2020-09-14 16:49:26',11,'2020-09-16 08:47:29',11,0),(50,'AUTO LIBRA MANDAMIENTO Y FIJA GASTOS','1','1','2020-09-14 16:57:13',11,'2020-09-14 16:57:13',11,0),(51,'APELACIÓN','1','1','2020-09-14 17:01:30',11,'2020-09-14 17:01:30',11,0),(52,'APELACIÓN POR LIBRAMIENTO PARCIAL DE MANDAMIENTO DE PAGO','1','1','2020-09-14 17:04:52',11,'2020-09-14 17:05:31',11,0),(53,'APELACIÓN POR NEGATIVA DE LIBRAMIENTO MANDAMIENTO DE PAGO','1','1','2020-09-14 17:05:18',11,'2020-09-14 17:05:18',11,0),(54,'AUTO QUE NIEGA MANDAMIENTO EJECUTIVO DE PAGO','1','1','2020-09-14 17:08:07',11,'2020-09-14 17:08:07',11,0),(55,'AUTO CORRE TRASLADO','1','1','2020-09-14 17:10:31',11,'2020-09-15 10:31:32',11,0),(56,'RECURSO DE REPOSICIÓN','1','1','2020-09-15 09:53:58',11,'2020-09-15 09:53:58',11,0),(57,'PRONUNCIAMIENTO SOBRE RECURSO DE REPOSICIÓN DE DEMANDA POR MANDAMIENTO','1','1','2020-09-15 09:56:06',11,'2020-09-15 09:56:06',11,0),(58,'AUTO RESUELVE REPOSICIÓN','1','1','2020-09-15 09:58:22',11,'2020-09-15 09:59:34',11,0),(59,'AUTO ORDENA SEGUIR ADELANTE CON EJECUCIÓN Y PRESENTACIÓN DE LIQUIDACIÓ','1','1','2020-09-15 11:29:40',11,'2020-09-15 11:29:40',11,0),(60,'LIQUIDACIÓN DE CRÉDITO','1','1','2020-09-15 11:30:24',11,'2020-09-15 11:30:24',11,0),(61,'MEMORIAL DE NO ASISTENCIA A AUDIENCIA ART 192','1','1','2020-09-15 11:32:11',11,'2020-09-15 11:32:11',11,0),(62,'AUTO CONCEDE APELACIÓN- EFECTO DEVOLUTIVO','1','1','2020-09-15 11:35:04',11,'2020-09-15 11:35:04',11,0),(63,'AUTO CONCEDE APELACIÓN- EFECTO SUSPENSIVO','1','1','2020-09-15 11:35:17',11,'2020-09-15 11:35:17',11,0),(64,'AUTO ADMITE APELACIÓN','1','1','2020-09-15 11:37:47',11,'2020-09-15 11:37:47',11,0),(65,'AUTO RESUELVE APELACIÓN MANDAMIENTO EJECUTIVO','1','1','2020-09-15 18:13:36',11,'2020-09-15 18:13:36',11,0),(66,'OBJECIÓN A LIQUIDACIÓN DE CRÉDITO','1','1','2020-09-16 07:51:38',11,'2020-09-16 07:51:38',11,0),(67,'AUTO APRUEBA LIQUIDACIÓN','1','1','2020-09-16 07:53:51',11,'2020-09-16 07:53:51',11,0),(68,'AUTO MODIFICA LIQUIDACIÓN','1','1','2020-09-16 07:54:00',11,'2020-09-16 07:54:00',11,0),(69,'APELACIÓN CONTRA AUTO QUE APRUEBA LIQUIDACIÓN DE CRÉDITO','1','1','2020-09-16 08:43:17',11,'2020-09-16 08:43:17',11,0),(70,'OFICIO DE SOLICITUD DE DESARCHIVE','1','1','2020-09-16 08:47:06',11,'2020-09-16 08:47:06',11,0),(71,'IMPULSO PROCESAL','1','1','2020-09-16 08:49:07',11,'2020-09-16 08:49:07',11,0),(72,'AUTO REQUIERE OFICINA DE APOYO','1','1','2020-09-16 08:50:48',11,'2020-09-16 08:50:48',11,0),(73,'DENUNCIA','1','1','2020-09-16 08:57:27',11,'2020-09-16 08:57:27',11,0),(74,'IMPULSO DE PAGO','1','1','2020-09-16 08:58:44',11,'2020-09-16 08:58:44',11,0),(75,'SOLICITUD DE TERMINACIÓN DE PROCESO POR PAGO TOTAL','1','1','2020-09-16 09:00:13',11,'2020-09-16 09:00:13',11,0),(76,'AUTO QUE PONE EN CONOCIMIENTO DENUNCIA AL DEMANDO','1','1','2020-09-16 09:01:38',11,'2020-09-16 09:01:38',11,0),(77,'EXPEDIENTE ADMINISTRATIVO','1','1','2020-09-16 09:14:06',11,'2020-09-16 09:14:06',11,0),(78,'CERTIFICADO DE INEMBARGABILIDAD','1','1','2020-09-16 09:15:49',11,'2020-09-16 09:15:49',11,0),(79,'SOLICITUD DE CONSTANCIA DE EJECUTORIA','1','1','2020-09-16 09:16:37',11,'2020-09-16 09:16:37',11,0),(80,'CONSTANCIA DE EJECUTORIA','1','1','2020-09-16 09:17:08',11,'2020-09-16 09:17:08',11,0);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entidad_demandada`
--

DROP TABLE IF EXISTS `entidad_demandada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidad_demandada` (
  `id_entidad_demandada` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_entidad_demandada` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado_entidad_demandada` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `email_entidad_demandada` varchar(100) COLLATE utf8_spanish_ci DEFAULT '',
  `id_municipio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_entidad_demandada`),
  UNIQUE KEY `IX_entidad_pension_nombre_entidad_pension` (`nombre_entidad_demandada`),
  KEY `IX_entidad_pension_estado_entidad_pension` (`estado_entidad_demandada`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidad_demandada`
--

LOCK TABLES `entidad_demandada` WRITE;
/*!40000 ALTER TABLE `entidad_demandada` DISABLE KEYS */;
INSERT INTO `entidad_demandada` VALUES (1,'UNIDAD DE GESTION PENSIONAL Y PARAFISCALES - UGPP','1','2019-03-02 12:19:51',1,'2020-11-12 11:31:15',1,0,'prueba@gmail.com',NULL),(2,'ADMINISTRADORA COLOMBIANA DE PENSIONES - COLPENSIONES','1','2019-03-02 12:20:11',1,NULL,NULL,0,'',NULL),(3,'SUBRED INTEGRADA DE SERVICIOS DE SALUD SUR E.S.E.','1','2019-03-02 12:21:55',1,NULL,NULL,0,'',NULL),(4,'SUBRED INTEGRADA DE SERVICIOS DE SALUD CENTRO ORIENTE E.S.E.','1','2019-03-02 12:22:35',1,NULL,NULL,0,'',NULL),(5,'SUBRED INTEGRADA DE SERVICIOS DE SALUD SUR OCCIDENTE E.S.E.','1','2019-03-02 12:22:52',1,NULL,NULL,0,'',NULL),(6,'SUBRED INTEGRADA DE SERVICIOS DE SALUD NORTE E.S.E.','1','2019-03-02 12:23:04',1,NULL,NULL,0,'',NULL),(7,'INDUSTRIA MILITAR COLOMBIANA - INDUMIL','1','2019-03-02 12:23:37',1,NULL,NULL,0,'',NULL),(8,'HOSPITAL MILITAR','1','2019-03-02 12:23:56',1,NULL,NULL,0,'',NULL),(9,'INSTITUTO DE DESARROLLO URBANO - IDU','1','2019-03-02 12:24:27',1,NULL,NULL,0,'',NULL),(10,'CAJA DE RETIRO DE LAS FUERZAS MILITARES - CREMIL','1','2019-03-02 12:24:41',1,NULL,NULL,0,'',NULL),(11,'FONDO FINANCIERO DISTRITAL DE SALUD - SECRETARÍA DE SALUD DE BOGOTÁ D.C. - ALCALDÍA MAYOR DE BOGOTÁ','1','2019-03-02 12:24:56',1,NULL,NULL,0,'',NULL),(12,'MÉDICOS ASOCIADOS S.A.','1','2019-03-02 12:25:12',1,NULL,NULL,0,'',NULL),(13,'MINISTERIO DEL INTERIOR - NACIÓN','1','2019-03-02 12:25:26',1,NULL,NULL,0,'',NULL),(14,'BATALLÓN DE SANIDAD - EJÉRCITO - MINISTERIO DE DEFENSA - NACIÓN','1','2019-03-02 12:25:39',1,NULL,NULL,0,'',NULL),(15,'DIRECCIÓN DE SANIDAD - POLICÍA - MINISTERIO DE DEFENSA - NACIÓN','1','2019-03-02 12:25:53',1,NULL,NULL,0,'',NULL),(16,'SERVICIO NACIONAL DE APRENDIZAJE - SENA','1','2019-03-02 12:26:06',1,NULL,NULL,0,'',NULL),(17,'HOSPITAL LA SAMARITANA E.S.E.','1','2019-03-02 12:26:25',1,NULL,NULL,0,'',NULL),(18,'ALCALDÍA MUNICIPAL DE SOACHA','1','2019-03-02 12:26:42',1,NULL,NULL,0,'',NULL),(19,'PORVENIR','1','2019-03-02 12:28:07',1,NULL,NULL,0,'',NULL);
/*!40000 ALTER TABLE `entidad_demandada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entidad_financiera`
--

DROP TABLE IF EXISTS `entidad_financiera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidad_financiera` (
  `id_entidad_financiera` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_entidad_financiera` varchar(100) DEFAULT '',
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_entidad_financiera`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidad_financiera`
--

LOCK TABLES `entidad_financiera` WRITE;
/*!40000 ALTER TABLE `entidad_financiera` DISABLE KEYS */;
INSERT INTO `entidad_financiera` VALUES (1,'Banco Falabella',0),(2,'Banco de Bogotá',0),(3,'Banco Finandina',0),(4,'Banco Popular',0),(5,'Banco Santander de Negocios Colombia S.A.',0),(6,'Banco Itaú Corpbanca Colombia S.A.',0),(7,'Banco Coopcentral',0),(8,'Bancolombia',0),(9,'Banco Citibank',0),(10,'Banco BBVA',0),(11,'Banco AV Villas',0),(12,'Banco de Occidente',0),(13,'Banco Davivienda',0),(14,'Banco Pichincha',0),(15,'Bancoomeva',0),(16,'Banco Mundo Mujer',0);
/*!40000 ALTER TABLE `entidad_financiera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entidad_justicia`
--

DROP TABLE IF EXISTS `entidad_justicia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidad_justicia` (
  `id_entidad_justicia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_entidad_justicia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `aplica_primera_instancia` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `aplica_segunda_instancia` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `estado_entidad_justicia` enum('1','2') COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `email_entidad_justicia` varchar(100) COLLATE utf8_spanish_ci DEFAULT '',
  `id_municipio` int(11) DEFAULT '0',
  PRIMARY KEY (`id_entidad_justicia`),
  UNIQUE KEY `IX_entidad_justicia_nombre_entidad_justicia` (`nombre_entidad_justicia`),
  KEY `IX_entidad_justicia_estado_entidad_justicia` (`estado_entidad_justicia`),
  KEY `IX_entidad_justicia_aplica_primera_instancia` (`aplica_primera_instancia`),
  KEY `IX_entidad_justicia_aplica_segunda_instancia` (`aplica_segunda_instancia`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidad_justicia`
--

LOCK TABLES `entidad_justicia` WRITE;
/*!40000 ALTER TABLE `entidad_justicia` DISABLE KEYS */;
INSERT INTO `entidad_justicia` VALUES (1,'1 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:10:40',1,NULL,NULL,0,'',0),(2,'2 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:11:06',1,NULL,NULL,0,'',0),(3,'3 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:11:17',1,NULL,NULL,0,'',0),(4,'4 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:11:34',1,NULL,NULL,0,'',0),(5,'5 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:11:41',1,NULL,NULL,0,'',0),(6,'7 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:22:52',1,NULL,NULL,0,'',0),(7,'8 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:00',1,NULL,NULL,0,'',0),(8,'9 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:08',1,NULL,NULL,0,'',0),(9,'10 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:16',1,NULL,NULL,0,'',0),(10,'11 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:25',1,NULL,NULL,0,'',0),(11,'12 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:33',1,NULL,NULL,0,'',0),(12,'13 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:40',1,NULL,NULL,0,'',0),(13,'14 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:23:47',1,NULL,NULL,0,'',0),(14,'6 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:24:34',1,NULL,NULL,0,'',0),(15,'15 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:25:20',1,NULL,NULL,0,'',0),(16,'16 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:25:28',1,NULL,NULL,0,'',0),(17,'17 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:25:37',1,NULL,NULL,0,'',0),(18,'18 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:25:45',1,NULL,NULL,0,'',0),(19,'19 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:25:57',1,NULL,NULL,0,'',0),(20,'20 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:16',1,NULL,NULL,0,'',0),(21,'21 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:27',1,NULL,NULL,0,'',0),(22,'22 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:33',1,NULL,NULL,0,'',0),(23,'23 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:41',1,NULL,NULL,0,'',0),(24,'24 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:51',1,NULL,NULL,0,'',0),(25,'25 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:26:57',1,NULL,NULL,0,'',0),(26,'26 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:06',1,NULL,NULL,0,'',0),(27,'27 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:14',1,NULL,NULL,0,'',0),(28,'28 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:29',1,NULL,NULL,0,'',0),(29,'29 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:37',1,NULL,NULL,0,'',0),(30,'30 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:45',1,NULL,NULL,0,'',0),(31,'31 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:27:51',1,NULL,NULL,0,'',0),(32,'33 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:02',1,NULL,NULL,0,'',0),(33,'34 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:10',1,NULL,NULL,0,'',0),(34,'35 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:18',1,NULL,NULL,0,'',0),(35,'36 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:25',1,NULL,NULL,0,'',0),(36,'37 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:32',1,NULL,NULL,0,'',0),(37,'38 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:28:39',1,NULL,NULL,0,'',0),(38,'39 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:32:09',1,NULL,NULL,0,'',0),(39,'40 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:32:16',1,NULL,NULL,0,'',0),(40,'41 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:32:24',1,NULL,NULL,0,'',0),(41,'42 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:06',1,NULL,NULL,0,'',0),(42,'43 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:12',1,NULL,NULL,0,'',0),(43,'44 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:22',1,NULL,NULL,0,'',0),(44,'45 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:31',1,NULL,NULL,0,'',0),(45,'46 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:40',1,NULL,NULL,0,'',0),(46,'47 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:46',1,NULL,NULL,0,'',0),(47,'48 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:52',1,NULL,NULL,0,'',0),(48,'49 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:35:59',1,NULL,NULL,0,'',0),(49,'50 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:05',1,NULL,NULL,0,'',0),(50,'51 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:13',1,NULL,NULL,0,'',0),(51,'52 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:20',1,NULL,NULL,0,'',0),(52,'53 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:26',1,NULL,NULL,0,'',0),(53,'54 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:34',1,NULL,NULL,0,'',0),(54,'55 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:39',1,NULL,NULL,0,'',0),(55,'56 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:46',1,NULL,NULL,0,'',0),(56,'57 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:53',1,NULL,NULL,0,'',0),(57,'58 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:36:59',1,NULL,NULL,0,'',0),(58,'59 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:40:45',1,NULL,NULL,0,'',0),(59,'60 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:40:53',1,NULL,NULL,0,'',0),(60,'61 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:41:01',1,NULL,NULL,0,'',0),(61,'62 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:41:08',1,NULL,NULL,0,'',0),(62,'63 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:42:14',1,NULL,NULL,0,'',0),(63,'64 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:42:21',1,NULL,NULL,0,'',0),(64,'65 ADMINISTRATIVO DE BOGOTA','1','1','1','2019-03-04 19:42:28',1,NULL,NULL,0,'',0),(65,'1 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:16',1,NULL,NULL,0,'',0),(66,'2 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:23',1,NULL,NULL,0,'',0),(67,'3 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:29',1,NULL,NULL,0,'',0),(68,'4 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:38',1,NULL,NULL,0,'',0),(69,'5 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:45',1,NULL,NULL,0,'',0),(70,'6 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:55:56',1,NULL,NULL,0,'',0),(71,'7 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:56:03',1,NULL,NULL,0,'',0),(72,'8 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:56:23',1,NULL,NULL,0,'',0),(73,'9 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:56:35',1,NULL,NULL,0,'',0),(74,'10 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:56:43',1,NULL,NULL,0,'',0),(75,'11 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:56:55',1,NULL,NULL,0,'',0),(76,'12 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:04',1,NULL,NULL,0,'',0),(77,'13 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:13',1,NULL,NULL,0,'',0),(78,'14 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:22',1,NULL,NULL,0,'',0),(79,'15 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:32',1,NULL,NULL,0,'',0),(80,'16 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:40',1,NULL,NULL,0,'',0),(81,'17 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:47',1,NULL,NULL,0,'',0),(82,'18 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:57:54',1,NULL,NULL,0,'',0),(83,'19 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:00',1,NULL,NULL,0,'',0),(84,'20 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:07',1,NULL,NULL,0,'',0),(85,'21 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:14',1,NULL,NULL,0,'',0),(86,'22 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:21',1,NULL,NULL,0,'',0),(87,'23 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:30',1,NULL,NULL,0,'',0),(88,'24 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:36',1,NULL,NULL,0,'',0),(89,'25 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:42',1,NULL,NULL,0,'',0),(90,'26 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:50',1,NULL,NULL,0,'',0),(91,'27 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:58:56',1,NULL,NULL,0,'',0),(92,'28 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:04',1,NULL,NULL,0,'',0),(93,'29 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:11',1,NULL,NULL,0,'',0),(94,'30 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:17',1,NULL,NULL,0,'',0),(95,'31 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:24',1,NULL,NULL,0,'',0),(96,'32 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:40',1,NULL,NULL,0,'',0),(97,'33 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:47',1,NULL,NULL,0,'',0),(98,'34 LABORAL DE BOGOTA','1','1','1','2019-03-07 16:59:54',1,NULL,NULL,0,'',0),(99,'35 LABORAL DE BOGOTA','1','1','1','2019-03-07 17:00:00',1,NULL,NULL,0,'',0),(100,'36 LABORAL DE BOGOTA','1','1','1','2019-03-07 17:00:06',1,NULL,NULL,0,'',0),(101,'37 LABORAL DE BOGOTA','1','1','1','2019-03-07 17:00:15',1,NULL,NULL,0,'',0),(102,'38 LABORAL DE BOGOTA','1','1','1','2019-03-07 17:00:22',1,NULL,NULL,0,'',0),(103,'39 LABORAL DE BOGOTA','1','1','1','2019-03-07 17:00:28',1,NULL,NULL,0,'',0);
/*!40000 ALTER TABLE `entidad_justicia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `xhr` text,
  `status` text,
  `error` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_log`
--

LOCK TABLES `error_log` WRITE;
/*!40000 ALTER TABLE `error_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `error_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `id_clase_estado` int(11) NOT NULL,
  `codigo_estado` int(11) NOT NULL,
  `nombre_estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_estado`),
  KEY `FK_estado_clase_estado` (`id_clase_estado`),
  CONSTRAINT `FK_estado_clase_estado` FOREIGN KEY (`id_clase_estado`) REFERENCES `clase_estado` (`id_clase_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,1,1,'VIGENTE'),(2,1,2,'ELIMINADA'),(3,2,1,'VIGENTE'),(4,2,2,'ELIMINADO'),(5,3,1,'VIGENTE'),(6,3,2,'ELIMINADO'),(7,4,1,'VIGENTE'),(8,4,2,'ELIMINADO'),(9,5,1,'VIGENTE'),(10,5,2,'ELIMINADO'),(11,6,1,'VIGENTE'),(12,6,2,'ELIMINADO'),(13,7,1,'VIGENTE'),(14,7,2,'ELIMINADO'),(15,8,1,'VIGENTE'),(16,8,2,'ELIMINADO'),(17,9,1,'VIGENTE'),(18,9,2,'ELIMINADO'),(19,10,1,'VIGENTE'),(20,10,2,'ELIMINADO'),(21,11,1,'VIGENTE'),(22,11,2,'ELIMINADO'),(23,12,1,'VIGENTE'),(24,12,2,'ELIMINADO'),(25,13,1,'VIGENTE'),(26,13,2,'ELIMINADO'),(27,14,1,'VIGENTE'),(28,14,2,'ELIMINADO'),(29,15,1,'VIVO'),(30,15,2,'FALLECIDO'),(31,16,1,'VIGENTE'),(32,16,2,'ELIMINADO');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapa_actuacion_com`
--

DROP TABLE IF EXISTS `etapa_actuacion_com`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapa_actuacion_com` (
  `id_proceso` int(11) NOT NULL,
  `id_etapa` int(11) NOT NULL,
  `id_actuacion` int(11) NOT NULL,
  `comentario` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_proceso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci COMMENT='inf de Comentarios  cliente y proceso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapa_actuacion_com`
--

LOCK TABLES `etapa_actuacion_com` WRITE;
/*!40000 ALTER TABLE `etapa_actuacion_com` DISABLE KEYS */;
INSERT INTO `etapa_actuacion_com` VALUES (7,1,8,'Primer comentario',1,'2020-02-03','2020-02-03 11:39:13');
/*!40000 ALTER TABLE `etapa_actuacion_com` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapa_proceso`
--

DROP TABLE IF EXISTS `etapa_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapa_proceso` (
  `id_etapa_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_etapa_proceso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `posicion_etapa_proceso` enum('1','2','3') COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_etapa_proceso_anterior` int(11) DEFAULT NULL,
  `id_etapa_proceso_siguiente` int(11) DEFAULT NULL,
  `estado_etapa_proceso` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_etapa_proceso`),
  UNIQUE KEY `IX_etapa_proceso_nombre_etapa_proceso` (`nombre_etapa_proceso`),
  KEY `IX_etapa_proceso_estado_etapa_proceso` (`estado_etapa_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapa_proceso`
--

LOCK TABLES `etapa_proceso` WRITE;
/*!40000 ALTER TABLE `etapa_proceso` DISABLE KEYS */;
INSERT INTO `etapa_proceso` VALUES (1,'VIA GUBERNATIVA','1',NULL,2,'1','2019-03-02 12:08:26',1,'2020-11-12 10:27:26',1,0),(2,'CONCILIACION PREJUDICIAL','2',1,3,'1','2019-03-02 12:09:26',1,'2020-08-27 13:10:07',8,0),(3,'VIA JUDICIAL','2',2,4,'1','2019-03-02 12:09:48',1,NULL,NULL,0),(4,'CUMPLIMIENTO SENTENCIA','2',3,5,'1','2019-03-02 12:10:12',1,NULL,NULL,0),(5,'PROCESO EJECUTIVO','2',4,6,'1','2019-03-02 12:10:37',1,'2020-08-14 10:52:51',8,1),(6,'CUMPLIMIENTO EJECUTIVO','3',5,NULL,'1','2019-03-02 12:12:44',1,NULL,NULL,0),(7,'TUTELA CUMPLIMIENTO SENTENCIA',NULL,NULL,NULL,'1','2020-08-14 10:01:59',8,'2020-08-14 10:01:59',8,0),(8,'CASACION',NULL,NULL,NULL,'1','2020-08-14 10:03:34',8,'2020-09-14 10:11:43',11,1),(9,'COBRO COACTIVO',NULL,NULL,NULL,'1','2020-08-14 10:12:04',8,'2020-08-14 10:12:04',8,0),(10,'TUTELA CUMPLIMIENTO EJECUTIVO',NULL,NULL,NULL,'1','2020-08-14 10:18:27',8,'2020-08-14 10:18:27',8,0),(11,'DENUNCIA',NULL,NULL,NULL,'1','2020-08-14 10:19:37',8,'2020-08-14 10:19:37',8,0),(12,'COMPLETITUD DE DOCUMENTOS',NULL,NULL,NULL,'1','2020-08-14 10:38:38',8,'2020-08-14 10:38:38',8,0);
/*!40000 ALTER TABLE `etapa_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapas_proceso_tipo_proceso`
--

DROP TABLE IF EXISTS `etapas_proceso_tipo_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapas_proceso_tipo_proceso` (
  `id_etapas_proceso_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_etapa_proceso` int(11) NOT NULL,
  `order` int(3) DEFAULT '0',
  `id_usuario_creacion` int(11) DEFAULT '0',
  PRIMARY KEY (`id_etapas_proceso_tipo_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapas_proceso_tipo_proceso`
--

LOCK TABLES `etapas_proceso_tipo_proceso` WRITE;
/*!40000 ALTER TABLE `etapas_proceso_tipo_proceso` DISABLE KEYS */;
INSERT INTO `etapas_proceso_tipo_proceso` VALUES (1,1,1,1,8),(2,1,3,2,8),(3,1,4,4,8),(4,1,7,5,8),(5,1,8,3,8),(6,2,1,2,8),(7,2,3,3,8),(8,2,4,4,8),(9,2,7,5,8),(10,3,1,2,8),(11,3,3,3,8),(12,3,4,4,8),(13,3,7,5,8),(14,4,1,1,8),(15,4,3,3,8),(16,4,2,2,8),(17,4,4,4,8),(18,4,7,5,8),(19,6,1,1,8),(20,6,3,3,8),(22,6,4,4,8),(23,6,7,5,8),(24,6,9,2,8),(25,7,3,2,8),(26,7,6,3,8),(28,7,10,4,8),(29,7,11,5,8),(30,8,3,2,8),(31,8,6,3,8),(32,8,7,4,8),(33,8,11,5,8),(34,9,1,1,8),(35,9,2,2,8),(36,9,3,3,8),(37,9,4,4,8),(38,9,7,5,8),(39,10,12,1,8),(40,10,3,3,8),(41,10,4,4,8),(43,10,7,5,8),(44,2,12,1,8),(45,8,12,1,8),(46,7,12,1,8),(48,3,12,1,8),(49,10,1,2,8);
/*!40000 ALTER TABLE `etapas_proceso_tipo_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos_variables`
--

DROP TABLE IF EXISTS `grupos_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos_variables` (
  `id_grupo_variable` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_grupo_variable` varchar(45) DEFAULT NULL,
  `estado_grupo_variable` tinyint(1) DEFAULT '1',
  `orden` int(2) DEFAULT '0',
  PRIMARY KEY (`id_grupo_variable`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos_variables`
--

LOCK TABLES `grupos_variables` WRITE;
/*!40000 ALTER TABLE `grupos_variables` DISABLE KEYS */;
INSERT INTO `grupos_variables` VALUES (1,'Cliente',1,0),(2,'Proceso',1,0),(3,'Globales',1,0),(4,'Beneficiario',1,0),(5,'Contacto',1,0),(6,'Usuario',1,6);
/*!40000 ALTER TABLE `grupos_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `honorario`
--

DROP TABLE IF EXISTS `honorario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `honorario` (
  `id_honorario` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` int(11) DEFAULT '0',
  `porcentaje_honorarios` int(2) DEFAULT NULL,
  `valor_comision` float(10,2) DEFAULT NULL,
  `retefuente` float(5,2) DEFAULT '0.00',
  `reteica` float(5,2) DEFAULT '0.00',
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `cerrado` tinyint(1) DEFAULT '0',
  `numero_factura` varchar(100) DEFAULT '',
  `valor_factura` float(12,2) DEFAULT '0.00',
  PRIMARY KEY (`id_honorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `honorario`
--

LOCK TABLES `honorario` WRITE;
/*!40000 ALTER TABLE `honorario` DISABLE KEYS */;
/*!40000 ALTER TABLE `honorario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intermediario`
--

DROP TABLE IF EXISTS `intermediario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intermediario` (
  `id_intermediario` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `estado_intermediario` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `retencion` int(3) DEFAULT '0',
  PRIMARY KEY (`id_intermediario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intermediario`
--

LOCK TABLES `intermediario` WRITE;
/*!40000 ALTER TABLE `intermediario` DISABLE KEYS */;
INSERT INTO `intermediario` VALUES (1,3,'1','2019-05-10 14:58:01',1,NULL,NULL,0,0);
/*!40000 ALTER TABLE `intermediario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `ruta_menu` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `tipo_menu` enum('1','2','3') COLLATE utf8_spanish_ci NOT NULL,
  `orden_menu` int(11) NOT NULL,
  `inactivo` enum('1','0') COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `UQ_menu` (`nombre_menu`,`tipo_menu`,`parent_id`),
  KEY `IX_menu_parent_id` (`parent_id`),
  KEY `IX_menu_tipo_menu` (`tipo_menu`),
  KEY `IX_menu_inactivo` (`inactivo`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Administración',NULL,0,'1',2,'0','2019-02-25 14:26:44',1,NULL,NULL,1),(2,'Tipos de proceso','tipos-de-proceso',1,'2',1,'0','2019-02-25 14:26:45',1,NULL,NULL,1),(5,'Seguridad',NULL,0,'1',3,'0','2019-02-25 14:26:45',1,NULL,NULL,1),(6,'Perfiles','perfil',5,'2',1,'0','2019-02-25 14:26:46',1,NULL,NULL,1),(8,'Usuarios','usuario',5,'2',2,'0','2019-02-25 14:26:46',1,NULL,NULL,1),(11,'Etapas de proceso','etapas-de-proceso',1,'2',2,'0','2019-02-25 14:26:46',1,NULL,NULL,1),(14,'Documentos','documento',1,'2',3,'0','2019-02-25 14:26:46',1,NULL,NULL,1),(17,'Plantillas','plantillas',1,'2',4,'0','2019-02-25 14:26:46',1,NULL,NULL,1),(20,'Entidades demandadas','entidades-demandadas',1,'2',5,'0','2019-02-25 14:26:47',1,NULL,NULL,1),(23,'Entidades de justicia','entidades-de-justicia',1,'2',6,'0','2019-02-25 14:26:47',1,NULL,NULL,1),(26,'Intermediarios','intermediario',1,'2',7,'0','2019-02-25 14:26:48',1,NULL,NULL,1),(29,'Actuaciones','actuacion',1,'2',8,'0','2019-02-25 14:28:12',1,NULL,NULL,1),(35,'Clientes','cliente',38,'2',2,'0','2019-04-25 15:44:46',1,NULL,NULL,1),(38,'Operaciones',NULL,0,'1',1,'0','2019-04-25 15:44:46',1,NULL,NULL,1),(39,'Procesos','proceso',38,'2',1,'0','2019-04-25 15:44:46',1,NULL,NULL,1),(42,'Seguimiento','opciones',39,'3',3,'0','2019-09-15 15:44:46',1,NULL,NULL,1),(47,'Gastos de Proceso','cobros-y-pagos',38,'1',5,'0','2020-05-23 20:37:57',1,'2020-07-30 12:04:04',1,1),(48,'Liquidacion de Honorarios y Comisiones','honorarios',38,'1',6,'0','2020-05-23 20:37:57',1,'2020-07-30 12:04:20',1,1),(49,'Cambiar contraseña','cambiar-contrasena',0,'',0,'0','2020-07-30 16:15:26',1,NULL,1,1),(50,'Tipos de resultado','tipos-de-resultado',1,'1',43,'0','2020-07-30 16:16:23',1,NULL,1,1),(51,'Opciones','opciones',1,'1',44,'0','2020-07-30 17:02:26',1,'2020-07-30 17:02:26',1,1),(52,'Seguimiento de procesos','seguimiento-procesos',38,'1',3,'0','2020-07-30 12:03:28',1,'2020-07-30 12:03:28',1,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_perfil`
--

DROP TABLE IF EXISTS `menu_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_perfil` (
  `id_menu_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `inactivo` enum('1','0') COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_perfil`
--

LOCK TABLES `menu_perfil` WRITE;
/*!40000 ALTER TABLE `menu_perfil` DISABLE KEYS */;
INSERT INTO `menu_perfil` VALUES (1,1,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(2,2,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(3,3,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(4,4,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(5,5,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(6,6,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(7,7,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(8,8,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(9,9,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(10,10,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(11,11,1,'0','2019-02-25 14:26:48',1,NULL,NULL),(12,12,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(13,13,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(14,14,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(15,15,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(16,16,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(17,17,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(18,18,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(19,19,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(20,20,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(21,21,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(22,22,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(23,23,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(24,24,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(25,25,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(26,26,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(27,27,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(28,28,1,'0','2019-02-25 14:26:49',1,NULL,NULL),(29,29,1,'0','2019-02-25 14:28:13',1,NULL,NULL),(30,30,1,'0','2019-02-25 14:28:13',1,NULL,NULL),(31,31,1,'0','2019-02-25 14:28:13',1,NULL,NULL),(32,32,1,'0','2019-03-01 14:01:54',1,NULL,NULL),(33,33,1,'0','2019-03-01 14:01:54',1,NULL,NULL),(34,34,1,'0','2019-03-01 14:01:54',1,NULL,NULL),(35,35,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(36,36,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(37,37,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(38,38,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(39,39,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(40,40,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(41,41,1,'0','2019-04-25 15:44:46',1,NULL,NULL),(42,42,1,'0','2019-04-25 15:44:04',1,NULL,NULL),(45,45,1,'0','2020-03-05 00:00:00',1,NULL,NULL),(46,36,3,'0','2020-04-16 17:39:01',3,NULL,NULL),(47,37,3,'0','2020-04-16 17:57:32',3,NULL,NULL);
/*!40000 ALTER TABLE `menu_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int(11) NOT NULL,
  `nombre_municipio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `indicativo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=2218 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,1,'Bogotá D.C',1),(2,2,'La Mesa',1),(3,2,'Sopó',1),(4,3,'La Ceja',4),(5,3,'Marinilla',4),(6,3,'Medellín',4),(7,4,'Bugalagrande',2),(8,4,'Cali',2),(1113,5,'Leticia',8),(1114,5,'Puerto Nariño',7),(1115,3,'Abejorral',4),(1116,3,'Abriaquí',4),(1117,3,'Alejandría',4),(1118,3,'Amagá',4),(1119,3,'Amalfi',4),(1120,3,'Andes',4),(1121,3,'Angelópolis',4),(1122,3,'Angostura',4),(1123,3,'Anorí',4),(1124,3,'Anzá',4),(1125,3,'Apartadó',4),(1126,3,'Arboletes',4),(1127,3,'Argelia',4),(1128,3,'Armenia',4),(1129,3,'Barbosa',4),(1130,3,'Bello',4),(1131,3,'Belmira',4),(1132,3,'Betania',4),(1133,3,'Betulia',4),(1134,3,'Briceño',4),(1135,3,'Buriticá',4),(1136,3,'Cáceres',4),(1137,3,'Caicedo',4),(1138,3,'Caldas',4),(1139,3,'Campamento',4),(1140,3,'Cañasgordas',4),(1141,3,'Caracolí',4),(1142,3,'Caramanta',4),(1143,3,'Carepa',4),(1144,3,'Carolina del Príncipe',4),(1145,3,'Caucasia',4),(1146,3,'Chigorodó',4),(1147,3,'Cisneros',4),(1148,3,'Ciudad Bolívar',4),(1149,3,'Cocorná',4),(1150,3,'Concepción',4),(1151,3,'Concordia',4),(1152,3,'Copacabana',4),(1153,3,'Dabeiba',4),(1154,3,'Donmatías',4),(1155,3,'Ebéjico',4),(1156,3,'El Bagre',4),(1157,3,'El Carmen de Viboral',4),(1158,3,'El Peñol',4),(1159,3,'El Retiro',4),(1160,3,'El Santuario',4),(1161,3,'Entrerríos',4),(1162,3,'Envigado',4),(1163,3,'Fredonia',4),(1164,3,'Frontino',4),(1165,3,'Giraldo',4),(1166,3,'Girardota',4),(1167,3,'Gómez Plata',4),(1168,3,'Granada',4),(1169,3,'Guadalupe',4),(1170,3,'Guarne',4),(1171,3,'Guatapé',4),(1172,3,'Heliconia',4),(1173,3,'Hispania',4),(1174,3,'Itagüí',4),(1175,3,'Ituango',4),(1176,3,'Jardín',4),(1177,3,'Jericó',4),(1179,3,'La Estrella',4),(1180,3,'La Pintada',4),(1181,3,'La Unión',4),(1182,3,'Liborina',4),(1183,3,'Maceo',4),(1186,3,'Montebello',4),(1187,3,'Murindó',4),(1188,3,'Mutatá',4),(1189,3,'Nariño',4),(1190,3,'Nechí',4),(1191,3,'Necoclí',4),(1192,3,'Olaya',4),(1193,3,'Peque',4),(1194,3,'Pueblorrico',4),(1195,3,'Puerto Berrío',4),(1196,3,'Puerto Nare',4),(1197,3,'Puerto Triunfo',4),(1198,3,'Remedios',4),(1199,3,'Rionegro',4),(1200,3,'Sabanalarga',4),(1201,3,'Sabaneta',4),(1202,3,'Salgar',4),(1203,3,'San Andrés de Cuerquia',4),(1204,3,'San Carlos',4),(1205,3,'San Francisco',4),(1206,3,'San Jerónimo',4),(1207,3,'San José de la Montaña',4),(1208,3,'San Juan de Urabá',4),(1209,3,'San Luis',4),(1210,3,'San Pedro de Urabá',4),(1211,3,'San Pedro de los Milagros',4),(1212,3,'San Rafael',4),(1213,3,'San Roque',4),(1214,3,'San Vicente',4),(1215,3,'Santa Bárbara',4),(1216,3,'Santa Fe de Antioquia',4),(1217,3,'Santa Rosa de Osos',4),(1218,3,'Santo Domingo',4),(1219,3,'Segovia',4),(1220,3,'Sonsón',4),(1221,3,'Sopetrán',4),(1222,3,'Támesis',4),(1223,3,'Tarazá',4),(1224,3,'Tarso',4),(1225,3,'Titiribí',4),(1226,3,'Toledo',4),(1227,3,'Turbo',4),(1228,3,'Uramita',4),(1229,3,'Urrao',4),(1230,3,'Valdivia',4),(1231,3,'Valparaíso',4),(1232,3,'Vegachí',4),(1233,3,'Venecia',4),(1234,3,'Vigía del Fuerte',4),(1235,3,'Yalí',4),(1236,3,'Yarumal',4),(1237,3,'Yolombó',4),(1238,3,'Yondó',4),(1239,3,'Zaragoza',4),(1240,7,'Arauca',7),(1241,7,'Arauquita',7),(1242,7,'Cravo Norte',7),(1243,7,'Fortul',7),(1244,7,'Puerto Rondón',7),(1245,7,'Saravena',7),(1246,7,'Tame',7),(1247,8,'Baranoa',5),(1248,8,'Barranquilla',5),(1249,8,'Campo de la Cruz',5),(1250,8,'Candelaria',5),(1251,8,'Galapa',5),(1252,8,'Juan de Acosta',5),(1253,8,'Luruaco',5),(1254,8,'Malambo',5),(1255,8,'Manatí',5),(1256,8,'Palmar de Varela',5),(1257,8,'Piojó',5),(1258,8,'Polonuevo',5),(1259,8,'Ponedera',5),(1260,8,'Puerto Colombia',5),(1261,8,'Repelón',5),(1262,8,'Sabanagrande',5),(1263,8,'Sabanalarga',5),(1264,8,'Santa Lucía',5),(1265,8,'Santo Tomás',5),(1266,8,'Soledad',5),(1267,8,'Suán',5),(1268,8,'Tubará',5),(1269,8,'Usiacurí',5),(1270,9,'Achí',5),(1271,9,'Altos del Rosario',5),(1272,9,'Arenal',5),(1273,9,'Arjona',5),(1274,9,'Arroyohondo',5),(1275,9,'Barranco de Loba',5),(1276,9,'Brazuelo de Papayal',5),(1277,9,'Calamar',5),(1278,9,'Cantagallo',5),(1279,9,'Cartagena de Indias',5),(1280,9,'Cicuco',5),(1281,9,'Clemencia',5),(1282,9,'Córdoba',5),(1283,9,'El Carmen de Bolívar',5),(1284,9,'El Guamo',5),(1285,9,'El Peñón',5),(1286,9,'Hatillo de Loba',5),(1287,9,'Magangué',5),(1288,9,'Mahates',5),(1289,9,'Margarita',5),(1290,9,'María la Baja',5),(1291,9,'Mompós',5),(1292,9,'Montecristo',5),(1293,9,'Morales',5),(1294,9,'Norosí',5),(1295,9,'Pinillos',5),(1296,9,'Regidor',5),(1297,9,'Río Viejo',5),(1298,9,'San Cristóbal',5),(1299,9,'San Estanislao',5),(1300,9,'San Fernando',5),(1301,9,'San Jacinto del Cauca',5),(1302,9,'San Jacinto',5),(1303,9,'San Juan Nepomuceno',5),(1304,9,'San Martín de Loba',5),(1305,9,'San Pablo',5),(1306,9,'Santa Catalina',5),(1307,9,'Santa Rosa',5),(1308,9,'Santa Rosa del Sur',5),(1309,9,'Simití',5),(1310,9,'Soplaviento',5),(1311,9,'Talaigua Nuevo',5),(1312,9,'Tiquisio',5),(1313,9,'Turbaco',5),(1314,9,'Turbaná',5),(1315,9,'Villanueva',5),(1316,9,'Zambrano',5),(1317,10,'Almeida',8),(1318,10,'Aquitania',8),(1319,10,'Arcabuco',8),(1320,10,'Belén',8),(1321,10,'Berbeo',8),(1322,10,'Betéitiva',8),(1323,10,'Boavita',8),(1324,10,'Boyacá',8),(1325,10,'Briceño',8),(1326,10,'Buenavista',8),(1327,10,'Busbanzá',8),(1328,10,'Caldas',8),(1329,10,'Campohermoso',8),(1330,10,'Cerinza',8),(1331,10,'Chinavita',8),(1332,10,'Chiquinquirá',8),(1333,10,'Chíquiza',8),(1334,10,'Chiscas',8),(1335,10,'Chita',8),(1336,10,'Chitaraque',8),(1337,10,'Chivatá',8),(1338,10,'Chivor',8),(1339,10,'Ciénega',8),(1340,10,'Cómbita',8),(1341,10,'Coper',8),(1342,10,'Corrales',8),(1343,10,'Covarachía',8),(1344,10,'Cubará',8),(1345,10,'Cucaita',8),(1346,10,'Cuítiva',8),(1347,10,'Duitama',8),(1348,10,'El Cocuy',8),(1349,10,'El Espino',8),(1350,10,'Firavitoba',8),(1351,10,'Floresta',8),(1352,10,'Gachantivá',8),(1353,10,'Gámeza',8),(1354,10,'Garagoa',8),(1355,10,'Guacamayas',8),(1356,10,'Guateque',8),(1357,10,'Guayatá',8),(1358,10,'Güicán',8),(1359,10,'Iza',8),(1360,10,'Jenesano',8),(1361,10,'Jericó',8),(1362,10,'La Capilla',8),(1363,10,'La Uvita',8),(1364,10,'La Victoria',8),(1365,10,'Labranzagrande',8),(1366,10,'Macanal',8),(1367,10,'Maripí',8),(1368,10,'Miraflores',8),(1369,10,'Mongua',8),(1370,10,'Monguí',8),(1371,10,'Moniquirá',8),(1372,10,'Motavita',8),(1373,10,'Muzo',8),(1374,10,'Nobsa',8),(1375,10,'Nuevo Colón',8),(1376,10,'Oicatá',8),(1377,10,'Otanche',8),(1378,10,'Pachavita',8),(1379,10,'Páez',8),(1380,10,'Paipa',8),(1381,10,'Pajarito',8),(1382,10,'Panqueba',8),(1383,10,'Pauna',8),(1384,10,'Paya',8),(1385,10,'Paz del Río',8),(1386,10,'Pesca',8),(1387,10,'Pisba',8),(1388,10,'Puerto Boyacá',8),(1389,10,'Quípama',8),(1390,10,'Ramiriquí',8),(1391,10,'Ráquira',8),(1392,10,'Rondón',8),(1393,10,'Saboyá',8),(1394,10,'Sáchica',8),(1395,10,'Samacá',8),(1396,10,'San Eduardo',8),(1397,10,'San José de Pare',8),(1398,10,'San Luis de Gaceno',8),(1399,10,'San Mateo',8),(1400,10,'San Miguel de Sema',8),(1401,10,'San Pablo de Borbur',8),(1402,10,'Santa María',8),(1403,10,'Santa Rosa de Viterbo',8),(1404,10,'Santa Sofía',8),(1405,10,'Santana',8),(1406,10,'Sativanorte',8),(1407,10,'Sativasur',8),(1408,10,'Siachoque',8),(1409,10,'Soatá',8),(1410,10,'Socha',8),(1411,10,'Socotá',8),(1412,10,'Sogamoso',8),(1413,10,'Somondoco',8),(1414,10,'Sora',8),(1415,10,'Soracá',8),(1416,10,'Sotaquirá',8),(1417,10,'Susacón',8),(1418,10,'Sutamarchán',8),(1419,10,'Sutatenza',8),(1420,10,'Tasco',8),(1421,10,'Tenza',8),(1422,10,'Tibaná',8),(1423,10,'Tibasosa',8),(1424,10,'Tinjacá',8),(1425,10,'Tipacoque',8),(1426,10,'Toca',8),(1427,10,'Togüí',8),(1428,10,'Tópaga',8),(1429,10,'Tota',8),(1430,10,'Tunja',8),(1431,10,'Tununguá',8),(1432,10,'Turmequé',8),(1433,10,'Tuta',8),(1434,10,'Tutazá',8),(1435,10,'Úmbita',8),(1436,10,'Ventaquemada',8),(1437,10,'Villa de Leyva',8),(1438,10,'Viracachá',8),(1439,10,'Zetaquira',8),(1440,11,'Aguadas',6),(1441,11,'Anserma',6),(1442,11,'Aranzazu',6),(1443,11,'Belalcázar',6),(1444,11,'Chinchiná',6),(1445,11,'Filadelfia',6),(1446,11,'La Dorada',6),(1447,11,'La Merced',6),(1448,11,'Manizales',6),(1449,11,'Manzanares',6),(1450,11,'Marmato',6),(1451,11,'Marquetalia',6),(1452,11,'Marulanda',6),(1453,11,'Neira',6),(1454,11,'Norcasia',6),(1455,11,'Pácora',6),(1456,11,'Palestina',6),(1457,11,'Pensilvania',6),(1458,11,'Riosucio',6),(1459,11,'Risaralda',6),(1460,11,'Salamina',6),(1461,11,'Samaná',6),(1462,11,'San José',6),(1463,11,'Supía',6),(1464,11,'Victoria',6),(1465,11,'Villamaría',6),(1466,11,'Viterbo',6),(1467,12,'Albania',8),(1468,12,'Belén de los Andaquíes',8),(1469,12,'Cartagena del Chairá',8),(1470,12,'Curillo',8),(1471,12,'El Doncello',8),(1472,12,'El Paujil',8),(1473,12,'Florencia',8),(1474,12,'La Montañita',8),(1475,12,'Milán',8),(1476,12,'Morelia',8),(1477,12,'Puerto Rico',8),(1478,12,'San José del Fragua',8),(1479,12,'San Vicente del Caguán',8),(1480,12,'Solano',8),(1481,12,'Solita',8),(1482,12,'Valparaíso',8),(1483,13,'Aguazul',8),(1484,13,'Chámeza',8),(1485,13,'Hato Corozal',8),(1486,13,'La Salina',8),(1487,13,'Maní',8),(1488,13,'Monterrey',8),(1489,13,'Nunchía',8),(1490,13,'Orocué',8),(1491,13,'Paz de Ariporo',8),(1492,13,'Pore',8),(1493,13,'Recetor',8),(1494,13,'Sabanalarga',8),(1495,13,'Sácama',8),(1496,13,'San Luis de Palenque',8),(1497,13,'Támara',8),(1498,13,'Tauramena',8),(1499,13,'Trinidad',8),(1500,13,'Villanueva',8),(1501,13,'Yopal',8),(1502,14,'Almaguer',2),(1503,14,'Argelia',2),(1504,14,'Balboa',2),(1505,14,'Bolívar',2),(1506,14,'Buenos Aires',2),(1507,14,'Cajibío',2),(1508,14,'Caldono',2),(1509,14,'Caloto',2),(1510,14,'Corinto',2),(1511,14,'El Tambo',2),(1512,14,'Florencia',2),(1513,14,'Guachené',2),(1514,14,'Guapí',2),(1515,14,'Inzá',2),(1516,14,'Jambaló',2),(1517,14,'La Sierra',2),(1518,14,'La Vega',2),(1519,14,'López de Micay',2),(1520,14,'Mercaderes',2),(1521,14,'Miranda',2),(1522,14,'Morales',2),(1523,14,'Padilla',2),(1524,14,'Páez',2),(1525,14,'Patía',2),(1526,14,'Piamonte',2),(1527,14,'Piendamó',2),(1528,14,'Popayán',2),(1529,14,'Puerto Tejada',2),(1530,14,'Puracé',2),(1531,14,'Rosas',2),(1532,14,'San Sebastián',2),(1533,14,'Santa Rosa',2),(1534,14,'Santander de Quilichao',2),(1535,14,'Silvia',2),(1536,14,'Sotará',2),(1537,14,'Suárez',2),(1538,14,'Sucre',2),(1539,14,'Timbío',2),(1540,14,'Timbiquí',2),(1541,14,'Toribío',2),(1542,14,'Totoró',2),(1543,14,'Villa Rica',2),(1544,15,'Aguachica',5),(1545,15,'Agustín Codazzi',5),(1546,15,'Astrea',5),(1547,15,'Becerril',5),(1548,15,'Bosconia',5),(1549,15,'Chimichagua',5),(1550,15,'Chiriguaná',5),(1551,15,'Curumaní',5),(1552,15,'El Copey',5),(1553,15,'El Paso',5),(1554,15,'Gamarra',5),(1555,15,'González',5),(1556,15,'La Gloria (Cesar)',5),(1557,15,'La Jagua de Ibirico',5),(1558,15,'La Paz',5),(1559,15,'Manaure Balcón del Cesar',5),(1560,15,'Pailitas',5),(1561,15,'Pelaya',5),(1562,15,'Pueblo Bello',5),(1563,15,'Río de Oro',5),(1564,15,'San Alberto',5),(1565,15,'San Diego',5),(1566,15,'San Martín',5),(1567,15,'Tamalameque',5),(1568,15,'Valledupar',5),(1569,16,'Acandí',4),(1570,16,'Alto Baudó',4),(1571,16,'Bagadó',4),(1572,16,'Bahía Solano',4),(1573,16,'Bajo Baudó',4),(1574,16,'Bojayá',4),(1575,16,'Cantón de San Pablo',4),(1576,16,'Cértegui',4),(1577,16,'Condoto',4),(1578,16,'El Atrato',4),(1579,16,'El Carmen de Atrato',4),(1580,16,'El Carmen del Darién',4),(1581,16,'Istmina',4),(1582,16,'Juradó',4),(1583,16,'Litoral de San Juan',4),(1584,16,'Lloró',4),(1585,16,'Medio Atrato',4),(1586,16,'Medio Baudó',4),(1587,16,'Medio San Juan',4),(1588,16,'Nóvita',4),(1589,16,'Nuquí',4),(1590,16,'Quibdó',4),(1591,16,'Río Iró',4),(1592,16,'Río Quito',4),(1593,16,'Riosucio',4),(1594,16,'San José del Palmar',4),(1595,16,'Sipí',4),(1596,16,'Tadó',4),(1597,16,'Unión Panamericana',4),(1598,16,'Unguía',4),(1599,2,'Agua de Dios',1),(1600,2,'Albán',1),(1601,2,'Anapoima',1),(1602,2,'Anolaima',1),(1603,2,'Apulo',1),(1604,2,'Arbeláez',1),(1605,2,'Beltrán',1),(1606,2,'Bituima',1),(1608,2,'Bojacá',1),(1609,2,'Cabrera',1),(1610,2,'Cachipay',1),(1611,2,'Cajicá',1),(1612,2,'Caparrapí',1),(1613,2,'Cáqueza',1),(1614,2,'Carmen de Carupa',1),(1615,2,'Chaguaní',1),(1616,2,'Chía',1),(1617,2,'Chipaque',1),(1618,2,'Choachí',1),(1619,2,'Chocontá',1),(1620,2,'Cogua',1),(1621,2,'Cota',1),(1622,2,'Cucunubá',1),(1623,2,'El Colegio',1),(1624,2,'El Peñón',1),(1625,2,'El Rosal',1),(1626,2,'Facatativá',1),(1627,2,'Fómeque',1),(1628,2,'Fosca',1),(1629,2,'Funza',1),(1630,2,'Fúquene',1),(1631,2,'Fusagasugá',1),(1632,2,'Gachalá',1),(1633,2,'Gachancipá',1),(1634,2,'Gachetá',1),(1635,2,'Gama',1),(1636,2,'Girardot',1),(1637,2,'Granada',1),(1638,2,'Guachetá',1),(1639,2,'Guaduas',1),(1640,2,'Guasca',1),(1641,2,'Guataquí',1),(1642,2,'Guatavita',1),(1643,2,'Guayabal de Síquima',1),(1644,2,'Guayabetal',1),(1645,2,'Gutiérrez',1),(1646,2,'Jerusalén',1),(1647,2,'Junín',1),(1648,2,'La Calera',1),(1650,2,'La Palma',1),(1651,2,'La Peña',1),(1652,2,'La Vega',1),(1653,2,'Lenguazaque',1),(1654,2,'Machetá',1),(1655,2,'Madrid',1),(1656,2,'Manta',1),(1657,2,'Medina',1),(1658,2,'Mosquera',1),(1659,2,'Nariño',1),(1660,2,'Nemocón',1),(1661,2,'Nilo',1),(1662,2,'Nimaima',1),(1663,2,'Nocaima',1),(1664,2,'Pacho',1),(1665,2,'Paime',1),(1666,2,'Pandi',1),(1667,2,'Paratebueno',1),(1668,2,'Pasca',1),(1669,2,'Puerto Salgar',1),(1670,2,'Pulí',1),(1671,2,'Quebradanegra',1),(1672,2,'Quetame',1),(1673,2,'Quipile',1),(1674,2,'Ricaurte',1),(1675,2,'San Antonio del Tequendama',1),(1676,2,'San Bernardo',1),(1677,2,'San Cayetano',1),(1678,2,'San Francisco',1),(1679,2,'San Juan de Rioseco',1),(1680,2,'Sasaima',1),(1681,2,'Sesquilé',1),(1682,2,'Sibaté',1),(1683,2,'Silvania',1),(1684,2,'Simijaca',1),(1685,2,'Soacha',1),(1687,2,'Subachoque',1),(1688,2,'Suesca',1),(1689,2,'Supatá',1),(1690,2,'Susa',1),(1691,2,'Sutatausa',1),(1692,2,'Tabio',1),(1693,2,'Tausa',1),(1694,2,'Tena',1),(1695,2,'Tenjo',1),(1696,2,'Tibacuy',1),(1697,2,'Tibirita',1),(1698,2,'Tocaima',1),(1699,2,'Tocancipá',1),(1700,2,'Topaipí',1),(1701,2,'Ubalá',1),(1702,2,'Ubaque',1),(1703,2,'Ubaté',1),(1704,2,'Une',1),(1705,2,'Útica',1),(1706,2,'Venecia',1),(1707,2,'Vergara',1),(1708,2,'Vianí',1),(1709,2,'Villagómez',1),(1710,2,'Villapinzón',1),(1711,2,'Villeta',1),(1712,2,'Viotá',1),(1713,2,'Yacopí',1),(1714,2,'Zipacón',1),(1715,2,'Zipaquirá',1),(1716,18,'Ayapel',4),(1717,18,'Buenavista',4),(1718,18,'Canalete',4),(1719,18,'Cereté',4),(1720,18,'Chimá',4),(1721,18,'Chinú',4),(1722,18,'Ciénaga de Oro',4),(1723,18,'Cotorra',4),(1724,18,'La Apartada',4),(1725,18,'Lorica',4),(1726,18,'Los Córdobas',4),(1727,18,'Momil',4),(1728,18,'Montelíbano',4),(1729,18,'Montería',4),(1730,18,'Moñitos',4),(1731,18,'Planeta Rica',4),(1732,18,'Pueblo Nuevo',4),(1733,18,'Puerto Escondido',4),(1734,18,'Puerto Libertador',4),(1735,18,'Purísima',4),(1736,18,'Sahagún',4),(1737,18,'San Andrés de Sotavento',4),(1738,18,'San Antero',4),(1739,18,'San Bernardo del Viento',4),(1740,18,'San Carlos',4),(1741,18,'San José de Uré',4),(1742,18,'San Pelayo',4),(1743,18,'Tierralta',4),(1744,18,'Tuchín',4),(1745,18,'Valencia',4),(1746,19,'Inírida',8),(1747,20,'Calamar',8),(1748,20,'El Retorno',8),(1749,20,'Miraflores',8),(1750,20,'San José del Guaviare',8),(1751,21,'Acevedo',8),(1752,21,'Agrado',8),(1753,21,'Aipe',8),(1754,21,'Algeciras',8),(1755,21,'Altamira',8),(1756,21,'Baraya',8),(1757,21,'Campoalegre',8),(1758,21,'Colombia',8),(1759,21,'El Pital',8),(1760,21,'Elías',8),(1761,21,'Garzón',8),(1762,21,'Gigante',8),(1763,21,'Guadalupe',8),(1764,21,'Hobo',8),(1765,21,'Íquira',8),(1766,21,'Isnos',8),(1767,21,'La Argentina',8),(1768,21,'La Plata',8),(1769,21,'Nátaga',8),(1770,21,'Neiva',8),(1771,21,'Oporapa',8),(1772,21,'Paicol',8),(1773,21,'Palermo',8),(1774,21,'Palestina',8),(1775,21,'Pitalito',8),(1776,21,'Rivera',8),(1777,21,'Saladoblanco',8),(1778,21,'San Agustín',8),(1779,21,'Santa María',8),(1780,21,'Suaza',8),(1781,21,'Tarqui',8),(1782,21,'Tello',8),(1783,21,'Teruel',8),(1784,21,'Tesalia',8),(1785,21,'Timaná',8),(1786,21,'Villavieja',8),(1787,21,'Yaguará',8),(1788,22,'Albania',5),(1789,22,'Barrancas',5),(1790,22,'Dibulla',5),(1791,22,'Distracción',5),(1792,22,'El Molino',5),(1793,22,'Fonseca',5),(1794,22,'Hatonuevo',5),(1795,22,'La Jagua del Pilar',5),(1796,22,'Maicao',5),(1797,22,'Manaure',5),(1798,22,'Riohacha',5),(1799,22,'San Juan del Cesar',5),(1800,22,'Uribia',5),(1801,22,'Urumita',5),(1802,22,'Villanueva',5),(1803,23,'Algarrobo',5),(1804,23,'Aracataca',5),(1805,23,'Ariguaní',5),(1806,23,'Cerro de San Antonio',5),(1807,23,'Chibolo',5),(1808,23,'Chibolo',5),(1809,23,'Ciénaga',5),(1810,23,'Concordia',5),(1811,23,'El Banco',5),(1812,23,'El Piñón',5),(1813,23,'El Retén',5),(1814,23,'Fundación',5),(1815,23,'Guamal',5),(1816,23,'Nueva Granada',5),(1817,23,'Pedraza',5),(1818,23,'Pijiño del Carmen',5),(1819,23,'Pivijay',5),(1820,23,'Plato',5),(1821,23,'Pueblo Viejo',5),(1822,23,'Remolino',5),(1823,23,'Sabanas de San Ángel',5),(1824,23,'Salamina',5),(1825,23,'San Sebastián de Buenavista',5),(1826,23,'San Zenón',5),(1827,23,'Santa Ana',5),(1828,23,'Santa Bárbara de Pinto',5),(1829,23,'Santa Marta',5),(1830,23,'Sitionuevo',5),(1831,23,'Tenerife',5),(1832,23,'Zapayán',5),(1833,23,'Zona Bananera',5),(1834,24,'Acacías',8),(1835,24,'Barranca de Upía',8),(1836,24,'Cabuyaro',8),(1837,24,'Castilla la Nueva',8),(1838,24,'Cubarral',8),(1839,24,'Cumaral',8),(1840,24,'El Calvario',8),(1841,24,'El Castillo',8),(1842,24,'El Dorado',8),(1843,24,'Fuente de Oro',8),(1844,24,'Granada',8),(1845,24,'Guamal',8),(1846,24,'La Macarena',8),(1847,24,'La Uribe',8),(1848,24,'Lejanías',8),(1849,24,'Mapiripán',8),(1850,24,'Mesetas',8),(1851,24,'Puerto Concordia',8),(1852,24,'Puerto Gaitán',8),(1853,24,'Puerto Lleras',8),(1854,24,'Puerto López',8),(1855,24,'Puerto Rico',8),(1856,24,'Restrepo',8),(1857,24,'San Carlos de Guaroa',8),(1858,24,'San Juan de Arama',8),(1859,24,'San Juanito',8),(1860,24,'San Martín',8),(1861,24,'Villavicencio',8),(1862,24,'Vista Hermosa',8),(1863,25,'Aldana',2),(1864,25,'Ancuyá',2),(1865,25,'Arboleda',2),(1866,25,'Barbacoas',2),(1867,25,'Belén',2),(1868,25,'Buesaco',2),(1869,25,'Chachagüí',2),(1870,25,'Colón',2),(1871,25,'Consacá',2),(1872,25,'Contadero',2),(1873,25,'Córdoba',2),(1874,25,'Cuaspud',2),(1875,25,'Cumbal',2),(1876,25,'Cumbitara',2),(1877,25,'El Charco',2),(1878,25,'El Peñol',2),(1879,25,'El Rosario',2),(1880,25,'El Tablón',2),(1881,25,'El Tambo',2),(1882,25,'Francisco Pizarro',2),(1883,25,'Funes',2),(1884,25,'Guachucal',2),(1885,25,'Guaitarilla',2),(1886,25,'Gualmatán',2),(1887,25,'Iles',2),(1888,25,'Imués',2),(1889,25,'Ipiales',2),(1890,25,'La Cruz',2),(1891,25,'La Florida',2),(1892,25,'La Llanada',2),(1893,25,'La Tola',2),(1894,25,'La Unión',2),(1895,25,'Leiva',2),(1896,25,'Linares',2),(1897,25,'Los Andes',2),(1898,25,'Magüí Payán',2),(1899,25,'Mallama',2),(1900,25,'Mosquera',2),(1901,25,'Nariño',2),(1902,25,'Olaya Herrera',2),(1903,25,'Ospina',2),(1904,25,'Pasto',2),(1905,25,'Policarpa',2),(1906,25,'Potosí',2),(1907,25,'Providencia',2),(1908,25,'Puerres',2),(1909,25,'Pupiales',2),(1910,25,'Ricaurte',2),(1911,25,'Roberto Payán',2),(1912,25,'Samaniego',2),(1913,25,'San Bernardo',2),(1914,25,'San José de Albán',2),(1915,25,'San Lorenzo',2),(1916,25,'San Pablo',2),(1917,25,'San Pedro de Cartago',2),(1918,25,'Sandoná',2),(1919,25,'Santa Bárbara',2),(1920,25,'Santacruz',2),(1921,25,'Sapuyes',2),(1922,25,'Taminango',2),(1923,25,'Tangua',2),(1924,25,'Tumaco',2),(1925,25,'Túquerres',2),(1926,25,'Yacuanquer',2),(1927,26,'Ábrego',7),(1928,26,'Arboledas',7),(1929,26,'Bochalema',7),(1930,26,'Bucarasica',7),(1931,26,'Cáchira',7),(1932,26,'Cácota',7),(1933,26,'Chinácota',7),(1934,26,'Chitagá',7),(1935,26,'Convención',7),(1936,26,'Cúcuta',7),(1937,26,'Cucutilla',7),(1938,26,'Duranía',7),(1939,26,'El Carmen',7),(1940,26,'El Tarra',7),(1941,26,'El Zulia',7),(1942,26,'Gramalote',7),(1943,26,'Hacarí',7),(1944,26,'Herrán',7),(1945,26,'La Esperanza',7),(1946,26,'La Playa de Belén',7),(1947,26,'Labateca',7),(1948,26,'Los Patios',7),(1949,26,'Lourdes',7),(1950,26,'Mutiscua',7),(1951,26,'Ocaña',7),(1952,26,'Pamplona',7),(1953,26,'Pamplonita',7),(1954,26,'Puerto Santander',7),(1955,26,'Ragonvalia',7),(1956,26,'Salazar de Las Palmas',7),(1957,26,'San Calixto',7),(1958,26,'San Cayetano',7),(1959,26,'Santiago',7),(1960,26,'Santo Domingo de Silos',7),(1961,26,'Sardinata',7),(1962,26,'Teorama',7),(1963,26,'Tibú',7),(1964,26,'Toledo',7),(1965,26,'Villa Caro',7),(1966,26,'Villa del Rosario',7),(1967,27,'Colón',8),(1968,27,'Mocoa',8),(1969,27,'Orito',8),(1970,27,'Puerto Asís',8),(1971,27,'Puerto Caicedo',8),(1972,27,'Puerto Guzmán',8),(1973,27,'Puerto Leguízamo',8),(1974,27,'San Francisco',8),(1975,27,'San Miguel',8),(1976,27,'Santiago',8),(1977,27,'Sibundoy',8),(1978,27,'Valle del Guamuez',8),(1979,27,'Villagarzón',8),(1980,28,'Armenia',6),(1981,28,'Buenavista',6),(1982,28,'Calarcá',6),(1983,28,'Circasia',6),(1984,28,'Córdoba',6),(1985,28,'Filandia',6),(1986,28,'Génova',6),(1987,28,'La Tebaida',6),(1988,28,'Montenegro',6),(1989,28,'Pijao',6),(1990,28,'Quimbaya',6),(1991,28,'Salento',6),(1992,29,'Apía',6),(1993,29,'Balboa',6),(1994,29,'Belén de Umbría',6),(1995,29,'Dosquebradas',6),(1996,29,'Guática',6),(1997,29,'La Celia',6),(1998,29,'La Virginia',6),(1999,29,'Marsella',6),(2000,29,'Mistrató',6),(2001,29,'Pereira',6),(2002,29,'Pueblo Rico',6),(2003,29,'Quinchía',6),(2004,29,'Santa Rosa de Cabal',6),(2005,29,'Santuario',6),(2006,30,'Providencia y Santa Catalina Islas',8),(2007,30,'San Andrés',8),(2008,31,'Aguada',7),(2009,31,'Albania',7),(2010,31,'Aratoca',7),(2011,31,'Barbosa',7),(2012,31,'Barichara',7),(2013,31,'Barrancabermeja',7),(2014,31,'Betulia',7),(2015,31,'Bolívar',7),(2016,31,'Bucaramanga',7),(2017,31,'Cabrera',7),(2018,31,'California',7),(2019,31,'Capitanejo',7),(2020,31,'Carcasí',7),(2021,31,'Cepitá',7),(2022,31,'Cerrito',7),(2023,31,'Charalá',7),(2024,31,'Charta',7),(2025,31,'Chima',7),(2026,31,'Chipatá',7),(2027,31,'Cimitarra',7),(2028,31,'Concepción',7),(2029,31,'Confines',7),(2030,31,'Contratación',7),(2031,31,'Coromoro',7),(2032,31,'Curití',7),(2033,31,'El Carmen de Chucurí',7),(2034,31,'El Guacamayo',7),(2035,31,'El Peñón',7),(2036,31,'El Playón',7),(2037,31,'El Socorro',7),(2038,31,'Encino',7),(2039,31,'Enciso',7),(2040,31,'Florián',7),(2041,31,'Floridablanca',7),(2042,31,'Galán',7),(2043,31,'Gámbita',7),(2044,31,'Girón',7),(2045,31,'Guaca',7),(2046,31,'Guadalupe',7),(2047,31,'Guapotá',7),(2048,31,'Guavatá',7),(2049,31,'Güepsa',7),(2050,31,'Hato',7),(2051,31,'Jesús María',7),(2052,31,'Jordán',7),(2053,31,'La Belleza',7),(2054,31,'La Paz',7),(2055,31,'Landázuri',7),(2056,31,'Lebrija',7),(2057,31,'Los Santos',7),(2058,31,'Macaravita',7),(2059,31,'Málaga',7),(2060,31,'Matanza',7),(2061,31,'Mogotes',7),(2062,31,'Molagavita',7),(2063,31,'Ocamonte',7),(2064,31,'Oiba',7),(2065,31,'Onzaga',7),(2066,31,'Palmar',7),(2067,31,'Palmas del Socorro',7),(2068,31,'Páramo',7),(2069,31,'Piedecuesta',7),(2070,31,'Pinchote',7),(2071,31,'Puente Nacional',7),(2072,31,'Puerto Parra',7),(2073,31,'Puerto Wilches',7),(2074,31,'Rionegro',7),(2075,31,'Sabana de Torres',7),(2076,31,'San Andrés',7),(2077,31,'San Benito',7),(2078,31,'San Gil',7),(2079,31,'San Joaquín',7),(2080,31,'San José de Miranda',7),(2081,31,'San Miguel',7),(2082,31,'San Vicente de Chucurí',7),(2083,31,'Santa Bárbara',7),(2084,31,'Santa Helena del Opón',7),(2085,31,'Simacota',7),(2086,31,'Suaita',7),(2087,31,'Sucre',7),(2088,31,'Suratá',7),(2089,31,'Tona',7),(2090,31,'Valle de San José',7),(2091,31,'Vélez',7),(2092,31,'Vetas',7),(2093,31,'Villanueva',7),(2094,31,'Zapatoca',7),(2095,32,'Buenavista',5),(2096,32,'Caimito',5),(2097,32,'Chalán',5),(2098,32,'Colosó',5),(2099,32,'Corozal',5),(2100,32,'Coveñas',5),(2101,32,'El Roble',5),(2102,32,'Galeras',5),(2103,32,'Guaranda',5),(2104,32,'La Unión',5),(2105,32,'Los Palmitos',5),(2106,32,'Majagual',5),(2107,32,'Morroa',5),(2108,32,'Ovejas',5),(2109,32,'Sampués',5),(2110,32,'San Antonio de Palmito',5),(2111,32,'San Benito Abad',5),(2112,32,'San Juan de Betulia',5),(2113,32,'San Marcos',5),(2114,32,'San Onofre',5),(2115,32,'San Pedro',5),(2116,32,'Sincé',5),(2117,32,'Sincelejo',5),(2118,32,'Sucre',5),(2119,32,'Tolú',5),(2120,32,'Tolú Viejo',5),(2121,33,'Alpujarra',8),(2122,33,'Alvarado',8),(2123,33,'Ambalema',8),(2124,33,'Anzoátegui',8),(2125,33,'Armero',8),(2126,33,'Ataco',8),(2127,33,'Cajamarca',8),(2128,33,'Carmen de Apicalá',8),(2129,33,'Casabianca',8),(2130,33,'Chaparral',8),(2131,33,'Coello',8),(2132,33,'Coyaima',8),(2133,33,'Cunday',8),(2134,33,'Dolores',8),(2135,33,'El Espinal',8),(2136,33,'Falán',8),(2137,33,'Flandes',8),(2138,33,'Fresno',8),(2139,33,'Guamo',8),(2140,33,'Herveo',8),(2141,33,'Honda',8),(2142,33,'Ibagué',8),(2143,33,'Icononzo',8),(2144,33,'Lérida',8),(2145,33,'Líbano',8),(2146,33,'Mariquita',8),(2147,33,'Melgar',8),(2148,33,'Murillo',8),(2149,33,'Natagaima',8),(2150,33,'Ortega',8),(2151,33,'Palocabildo',8),(2152,33,'Piedras',8),(2153,33,'Planadas',8),(2154,33,'Prado',8),(2155,33,'Purificación',8),(2156,33,'Rioblanco',8),(2157,33,'Roncesvalles',8),(2158,33,'Rovira',8),(2159,33,'Saldaña',8),(2160,33,'San Antonio',8),(2161,33,'San Luis',8),(2162,33,'Santa Isabel',8),(2163,33,'Suárez',8),(2164,33,'Valle de San Juan',8),(2165,33,'Venadillo',8),(2166,33,'Villahermosa',8),(2167,33,'Villarrica',8),(2168,4,'Alcalá',2),(2169,4,'Andalucía',2),(2170,4,'Ansermanuevo',2),(2171,4,'Argelia',2),(2172,4,'Bolívar',2),(2173,4,'Buenaventura',2),(2174,4,'Buga',2),(2176,4,'Caicedonia',2),(2178,4,'Calima',2),(2179,4,'Candelaria',2),(2180,4,'Cartago',2),(2181,4,'Dagua',2),(2182,4,'El Águila',2),(2183,4,'El Cairo',2),(2184,4,'El Cerrito',2),(2185,4,'El Dovio',2),(2186,4,'Florida',2),(2187,4,'Ginebra',2),(2188,4,'Guacarí',2),(2189,4,'Jamundí',2),(2190,4,'La Cumbre',2),(2191,4,'La Unión',2),(2192,4,'La Victoria',2),(2193,4,'Obando',2),(2194,4,'Palmira',2),(2195,4,'Pradera',2),(2196,4,'Restrepo',2),(2197,4,'Riofrío',2),(2198,4,'Roldanillo',2),(2199,4,'San Pedro',2),(2200,4,'Sevilla',2),(2201,4,'Toro',2),(2202,4,'Trujillo',2),(2203,4,'Tuluá',2),(2204,4,'Ulloa',2),(2205,4,'Versalles',2),(2206,4,'Vijes',2),(2207,4,'Yotoco',2),(2208,4,'Yumbo',2),(2209,4,'Zarzal',2),(2210,35,'Carurú',8),(2211,35,'Mitú',8),(2212,35,'Taraira',8),(2213,36,'Cumaribo',8),(2214,36,'La Primavera',8),(2215,36,'Puerto Carreño',8),(2216,36,'Santa Rosalía',8),(2217,37,'Otro',0);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date DEFAULT NULL,
  `forma_pago` int(1) DEFAULT '1' COMMENT '1 => Efectivo\n2 => Consignacion\n3 => Cheque\n4 => Tarjeta de credito\n5 => Tarjeta debito',
  `id_entidad_financiera` int(3) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT '',
  `valor_pago` float(11,2) DEFAULT '0.00',
  `eliminado` tinyint(1) DEFAULT '0',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `id_cobro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago_honorario`
--

DROP TABLE IF EXISTS `pago_honorario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago_honorario` (
  `id_pago_honorario` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_consignacion` date DEFAULT NULL,
  `id_entidad_financiera` int(3) DEFAULT NULL,
  `numero_cuenta` varchar(100) DEFAULT '',
  `valor_pago` float(11,2) DEFAULT '0.00',
  `eliminado` tinyint(1) DEFAULT '0',
  `id_honorario` int(11) DEFAULT NULL,
  `forma_pago` int(1) DEFAULT '1',
  PRIMARY KEY (`id_pago_honorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago_honorario`
--

LOCK TABLES `pago_honorario` WRITE;
/*!40000 ALTER TABLE `pago_honorario` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago_honorario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_pais`),
  UNIQUE KEY `IX_pais_nombre_pais` (`nombre_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'COLOMBIA'),(2,'Otro');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametro`
--

DROP TABLE IF EXISTS `parametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametro` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `id_clase_parametro` int(11) NOT NULL,
  `codigo_parametro` int(11) NOT NULL,
  `nombre_parametro` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor_parametro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_parametro`),
  KEY `IX_parametro_codigo_parametro` (`codigo_parametro`),
  KEY `FK_parametro_clase_parametro` (`id_clase_parametro`),
  CONSTRAINT `FK_parametro_clase_parametro` FOREIGN KEY (`id_clase_parametro`) REFERENCES `clase_parametro` (`id_clase_parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametro`
--

LOCK TABLES `parametro` WRITE;
/*!40000 ALTER TABLE `parametro` DISABLE KEYS */;
INSERT INTO `parametro` VALUES (1,1,1,'CANTIDAD M├üXIMA DE D├ìAS EN UN RANGO DE FECHAS','30');
/*!40000 ALTER TABLE `parametro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `inactivo` enum('1','0') COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `UQ_perfil` (`nombre_perfil`),
  KEY `IX_perfil_inactivo` (`inactivo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'ADMINISTRADOR','0','2019-02-25 14:26:44',1,NULL,NULL,0),(2,'Especialista','0','2020-03-09 09:49:17',1,NULL,NULL,0),(3,'prueba','0','2020-04-16 17:17:02',1,NULL,NULL,0);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `numero_documento` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `segundo_apellido` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_completo` varchar(240) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `barrio` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_municipio` int(11) DEFAULT '1',
  `celular` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `correo_electronico` varchar(60) COLLATE utf8_spanish_ci DEFAULT '',
  `estado_persona` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `id_lugar_expedicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,NULL,NULL,'ADMIN','ADMIN','ADMINISTRADOR','','ADMIN ADMIN ADMINISTRADOR','CALLE 5 # 25 - 18',NULL,1,NULL,'5689422','administrador@juridico.com',1,'2019-02-25 14:26:44',1,NULL,NULL,NULL),(2,NULL,NULL,'FRANCO','','├üNGELA','JOHANA',NULL,'CALLE 5 # 25 - 18',NULL,1,NULL,'5689422','johana.franco@juridico.com',1,'2019-02-25 14:26:44',1,NULL,NULL,NULL),(3,1,'7898465','SANABRIA','CHACON','JUAN','CARLOS','SANABRIA CHACON JUAN CARLOS',NULL,NULL,1,NULL,'0','noaplica@noaplica.com',1,'2019-05-10 14:58:01',1,NULL,NULL,NULL),(4,1,'1032405902','RODRIGUEZ','CONTRERAS','ELIZABETH','NO TIENE','RODRIGUEZ CONTRERAS ELIZABETH NO TIENE','CALLE 58 SUR # 79 - 41','ROMA RUBI - KENNEDY',1,'3214006758','3214006758','elizahe88@hotmail.com',1,'2019-05-10 15:00:13',1,NULL,NULL,NULL),(5,1,'36611481','CARABALI','','ADRIANA','MARIA','CARABALI ADRIANA MARIA','CALLE 19 # 3-10','LAS AGUAS',1,'3212385663','3212385663','adrimaca81@gmail.com',1,'2019-05-10 15:07:53',1,NULL,NULL,NULL),(6,1,'52519767','FAJARDO','VIRVIESCAS','LUZ','DARY','FAJARDO VIRVIESCAS LUZ DARY','CALLE 43 SUR #  13D-29','MARCO FIDEL SUAREZ',1,'3115241623','3115241623','luzdaryfajardo76@gmail.com',1,'2019-05-10 15:28:54',1,NULL,NULL,NULL),(7,1,'52998273','CORREA','RODRIGUEZ','ANGELA','MARCELA','CORREA RODRIGUEZ ANGELA MARCELA','CALLE 54 F SUR # 94-21','BOSA PORVENIR',1,'3185158129','7515265','butterfly_288@hotmail.com',1,'2019-05-10 15:37:27',1,NULL,NULL,NULL),(8,1,'55179905','ALDANA','PERDOMO','YASMIN','ANDREA','ALDANA PERDOMO YASMIN ANDREA','CALLE 23 A BIS # 83-75','MODELIA BALMORAL II',1,'3188447908','4626335','yasaldana@hotmail.com',1,'2019-05-10 15:51:59',1,NULL,NULL,NULL),(9,1,'1033685508','ANGARITA','','BRYAN','RICARDO','ANGARITA BRYAN RICARDO','KRA 5 N #49 A-74 SUR','MARRUECOS',1,'3156973770','3156973770','bryanricardo1705@gmail.com',1,'2019-05-10 16:02:45',1,NULL,NULL,NULL),(10,1,'39584439','BAUTISTA','RIOS','DEICY','ERMINIA','BAUTISTA RIOS DEICY ERMINIA','MANZANA  4 CASA 9','SANTA ISABEL GIRARDOT',1,'3212019920','3212019920','patico1029@yahoo.es',1,'2019-05-10 16:17:47',1,NULL,NULL,NULL),(11,1,'52827294','BERNAL','CAMARGO','GINA','MILENA','BERNAL CAMARGO GINA MILENA','KRA 37A # 53B-21 SUR','FATIMA',1,'3143698085','7494454','gimilena270@gmail.com',1,'2019-05-13 08:57:56',1,NULL,NULL,NULL),(12,1,'98682035','BUILES','LONDOÑO','JOHN','FREDI','BUILES LONDOÑO JOHN FREDI','KRA 18A # 5-34 SUR','SAN CARLOS',1,'3103436424','3103436424','adreatico1015@yahoo.es',1,'2019-05-13 09:44:47',1,NULL,NULL,NULL),(13,1,'39721438','BRIAÑO','SIERRA','MARTHA','PATRICIA','BRIAÑO SIERRA MARTHA PATRICIA','KRA 24C # 23-38 SUR','CENTENARIO',1,'3177798665','3177798665','marthabricenosierra@gmail.com',1,'2019-05-13 09:51:10',1,NULL,NULL,NULL),(14,1,'52099682','BULLA','CANO','ROSA','MARIA','BULLA CANO ROSA MARIA','CALLE 24 SUR # 12-52','SAN JOSE',1,'3208285818','3208285818','bullosa01.17@gmail.com',1,'2019-05-13 09:56:28',1,NULL,NULL,NULL),(15,1,'79958784','ALDANA','PERDOMO','JORGE','LUIS','ALDANA PERDOMO JORGE LUIS','CALLE 23 A BIS # 83-75 APTO 506','MODELIA',3,'3008388953','0','jaldanaperdomo@hotmail.com',1,'2019-08-02 14:01:40',1,NULL,NULL,NULL),(16,1,'52900851','ALFONSO','','YUDY','LEXAIDA','ALFONSO YUDY LEXAIDA','CALLE 36 C SUR #3A-21 ESTE','VILLA DE LOS ALPES',1,'3212588324','0','yudialfonso2011@gmail.com',1,'2019-08-02 14:41:06',1,NULL,NULL,NULL),(17,1,'53011971','Franco','Rodriguez','Angela','Johanna','FRANCO RODRIGUEZ ANGELA JOHANNA','Bogota','RINCON DE LOS ANGELES',1,'3133962084','2172450','angelajfrancor@gmail.com',1,'2019-08-06 14:07:02',1,'2020-08-14 09:45:13',8,NULL),(18,NULL,NULL,'SANABRIA','CHACON','MARIA','','SANABRIA CHACON MARIA','BOGOTA',NULL,1,NULL,'3144702826','maria.sanabria@optimizarti.com',1,'2019-08-06 19:54:53',1,NULL,NULL,NULL),(19,NULL,NULL,'VARGAS','CALERO','FERNANDO','JOSE','VARGAS CALERO FERNANDO JOSE','CALLE 65',NULL,1,NULL,'3125119575','fernandojose.vargas@hotmail.com',1,'2019-08-07 08:40:47',1,NULL,NULL,NULL),(20,NULL,NULL,'SANABRIA','MARTÍNEZ','EDILIA','','SANABRIA MARTÍNEZ EDILIA',NULL,NULL,1,NULL,'2822816','info@organizacionsanabria.com.co',1,'2020-02-25 10:12:23',3,NULL,NULL,NULL),(21,NULL,NULL,'RAMOS','','MARIO','','RAMOS MARIO',NULL,NULL,1,NULL,'3006152802','mramos257@gmail.com',1,'2020-03-21 13:42:23',3,NULL,NULL,NULL),(22,NULL,NULL,'MORENO','MORENO','JOSE','MARIA DE LOS SANTOS','MORENO MORENO JOSE MARIA DE LOS SANTOS','CRA 72A 152B-32 INT A4 APTO 601 SEVILLA',NULL,1,NULL,'3144702826','joblamo@hotmail.com',1,'2020-04-16 17:57:06',3,NULL,NULL,NULL),(23,1,'52105945','Sanabria','Chacon','Maria','de los Santos',NULL,'Bogota',NULL,1,NULL,'3144702826','maria.sanabria@optimizarti.com',0,'2020-07-30 15:43:11',1,'2020-07-30 15:43:11',1,NULL),(24,1,'2222222','Franco',NULL,'Angela','Johana',NULL,'Bogota',NULL,1,NULL,'74464747','johana@pendiente.com',0,'2020-07-30 15:46:22',1,'2020-08-14 09:36:09',8,NULL),(25,1,'777777','Martinez','Sanabria','Edilia',NULL,NULL,'Bogota',NULL,1,NULL,'2822816','mschabogagos@hotmail.com',0,'2020-07-30 15:48:09',1,'2020-11-28 08:22:09',3,NULL),(26,1,'222222','A',NULL,'AA',NULL,NULL,'Bogota',NULL,1,NULL,'5689422','administrador@juridico.com',0,'2020-07-30 15:49:25',1,'2020-07-30 15:49:25',1,NULL),(27,1,'52771323','Cristancho','Manchola','Claudia','Milena',NULL,'Calle 19 3-10 of. 1201',NULL,1,NULL,'5714443100','claudia@juridico.com.co',0,'2020-07-30 15:50:50',1,'2020-08-14 09:40:49',3,NULL),(28,1,'333333','Sanabria',NULL,'Andres','Felipe',NULL,'Bogota',NULL,1,NULL,'2353854','andres.felipe@juridico.com',0,'2020-07-30 15:53:43',3,'2020-11-13 10:41:49',3,NULL),(29,1,'5748578574','Rubio',NULL,'Susana',NULL,NULL,'Calle 19 3-10 of. 1201',NULL,1,NULL,'2822816','susana@juridico.com.co',0,'2020-08-10 14:34:35',3,'2020-08-14 09:36:58',8,NULL),(30,1,'52771325','Sanabria','Uribe','Monica','Liliana',NULL,'Calle 19 3-10 of. 1201',NULL,1,NULL,'5714443100','monica@juridico.com.co',0,'2020-08-14 09:41:58',3,'2020-08-14 09:41:58',3,NULL),(31,1,'1032482911','Sanabria','Uribe','Monica','Liliana',NULL,'Calle 19 3-10 of. 1201',NULL,1,NULL,'3123146057','monica@juridico.com.co',0,'2020-09-09 11:51:11',3,'2020-09-09 11:51:11',3,NULL),(32,1,'83878426563','hrjehr','ejhdjhf','hfjdhfj','fhjdhf',NULL,'hdjhfdjfhj','dhjfhdfjh',1493,'75574857485','83473747','maria.sanabria@optimizarti.com',0,'2020-09-11 10:03:27',3,'2020-09-11 10:03:27',3,3),(33,1,'4376473463','Rodriguez',NULL,'Ricardo',NULL,NULL,'Calle 19 3-10 of. 1201',NULL,1,'','562654634','riro@juridico.coms',0,'2020-09-28 18:39:26',3,'2020-11-12 10:26:17',1,NULL),(34,1,'14208918','ORTIZ','BRIÑEZ','JORGE','ALIRIO',NULL,'CALLE 32 C NO. 4 A - 40','SAN CAYETANO',2142,'3153203376',NULL,'jaortiz@hotmail.com',0,'2020-09-30 12:47:39',11,'2020-11-12 14:45:52',1,2142),(35,1,'253646474','Sanabria','Chacon','Facundo','Jose',NULL,'calle 3 # 24-35',NULL,6,'','3144702825','facundojose@juridico.com.co',0,'2020-11-13 10:44:00',3,'2020-11-13 10:44:42',3,NULL),(36,1,'84574857485','Soriano',NULL,'Jose',NULL,NULL,'hjshffjsfhsjfhs',NULL,1,'','5748754w8','jose@juridico.com',0,'2020-12-09 15:52:49',3,'2020-12-09 15:52:49',3,NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantilla_documento`
--

DROP TABLE IF EXISTS `plantilla_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plantilla_documento` (
  `id_plantilla_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plantilla_documento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `contenido_plantilla_documento` longtext COLLATE utf8_spanish_ci NOT NULL,
  `estado_plantilla_documento` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_plantilla_documento`),
  UNIQUE KEY `IX_plantilla_documento_nombre_plantilla_documento` (`nombre_plantilla_documento`),
  KEY `IX_plantilla_documento_estado_plantilla_documento` (`estado_plantilla_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantilla_documento`
--

LOCK TABLES `plantilla_documento` WRITE;
/*!40000 ALTER TABLE `plantilla_documento` DISABLE KEYS */;
INSERT INTO `plantilla_documento` VALUES (1,'DERECHO PETICION AGOTAMIENTO','<p> {!!NOMBRE_COMPLETO_CLIENTE!!} identificado con&nbsp; {!!TIPO_DOCUMENTO_CLIENTE!!}  No.&nbsp; {!!NUMERO_DOCUMENTO_CLIENTE!!} mediante el siguiente derecho de petición se hacen las siguientes solicitudes:</p><p>p1</p><p>p2</p><p>p3</p><p><br></p><p>Cordialmente</p><p> {!!NOMBRE_COMPLETO_USUARIO!!} </p><p><br></p><p><br></p>','1','2019-03-04 19:46:28',1,'2020-11-28 08:38:40',3,0),(2,'NO APLICA','PHA+PGJyIGRhdGEtY2tlLWZpbGxlcj0idHJ1ZSI+PC9wPg==','1','2019-03-04 19:58:20',1,NULL,NULL,0),(3,'MEMORIAL GASTOS PROCESALES','PHA+PGJyIGRhdGEtY2tlLWZpbGxlcj0idHJ1ZSI+PC9wPg==','1','2019-03-07 18:05:00',1,NULL,NULL,0),(4,'DERECHO DE PETICION CUMPLIMIENTO','PHA+PGJyIGRhdGEtY2tlLWZpbGxlcj0idHJ1ZSI+PC9wPg==','1','2019-03-07 18:05:34',1,NULL,NULL,0),(5,'CONTRATO DE HONORARIOS','PHA+PGJyIGRhdGEtY2tlLWZpbGxlcj0idHJ1ZSI+PC9wPg==','1','2019-09-12 10:12:31',1,NULL,NULL,0),(6,'PRUEBA','PHA+c2RhZGFzZGFzZGFzZGE8L3A+','1','2020-04-05 17:10:25',6,NULL,NULL,0);
/*!40000 ALTER TABLE `plantilla_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_entidad_demandada` int(11) NOT NULL,
  `id_usuario_responsable` int(11) NOT NULL,
  `valor_estudio` decimal(12,2) NOT NULL,
  `fecha_retiro_servicio` date DEFAULT NULL,
  `id_ultima_entidad_servicio` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_acto_administrativo_retiro` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `normatividad_aplicada_caso` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones_caso` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_indice_archivos` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estado_proceso` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `numero_proceso` varchar(23) COLLATE utf8_spanish_ci DEFAULT '',
  `id_carpeta` varchar(45) COLLATE utf8_spanish_ci DEFAULT '',
  `id_entidad_justicia` int(11) DEFAULT NULL,
  `dar_informacion_caso` tinyint(1) DEFAULT '0',
  `id_etapa_proceso` int(11) DEFAULT '0' COMMENT 'Etapa en la que se encuentra el proceso',
  `acto_administrativo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ultima_entidad_retiro` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caducidad` tinyint(1) DEFAULT '0',
  `entidad_justicia_primera_instancia` int(11) DEFAULT '0',
  `entidad_justicia_segunda_instancia` int(11) DEFAULT '0',
  `cuantia_demandada` float(11,2) DEFAULT NULL,
  `estimacion_pretenciones` float(11,2) DEFAULT NULL,
  `valor_final_sentencia` float(11,2) DEFAULT NULL,
  `fecha_radicacion_cumplimineto` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `ubicacion_fisica_archivo_muerto` varchar(50) COLLATE utf8_spanish_ci DEFAULT '',
  `cerrado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_proceso`),
  KEY `IX_proce_docum_codig_indic_arc` (`codigo_indice_archivos`),
  KEY `IX_proceso_estado_proceso` (`estado_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,2,2,2,4,0.00,'1900-01-01','',0,1,'','','5d5578253a539','1','2019-08-15 10:21:50',4,'2020-08-14 08:28:03',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(2,14,4,3,1,0.00,'1900-01-01','',0,1,'','','5d5582032ee53','1','2019-08-15 11:02:36',1,'2020-08-14 08:28:00',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(3,14,4,3,1,0.00,'2019-01-31','SUBRED SUR',0,1,'','ESTA CLIENTE ES MUY CANSONA','5d5ec7da71e79','1','2019-08-22 11:51:32',1,'2020-08-14 08:27:58',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(4,14,4,1,1,0.00,'1900-01-01','',0,1,'','','5d7a5b76306e7','1','2019-09-12 09:52:00',1,'2020-08-14 08:27:56',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(5,3,4,3,1,0.00,'1900-01-01','SUBRED INTEGRADA DE SERVICIOS SUR ESE',0,1,'','','5d7a61d4bbc5e','1','2019-09-12 10:20:00',1,'2020-08-14 08:27:51',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(6,4,4,4,1,0.00,'1900-01-01','SUB RED CENTRO',0,1,'','','5d7a6233160b1','1','2019-09-12 10:22:33',1,'2020-08-14 08:27:53',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(7,2,4,9,1,0.00,'1900-01-01','',0,1,'','','5d7a62dac6552','1','2019-09-12 10:23:43',1,'2020-08-14 08:27:49',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(8,4,2,2,3,300000.00,'2019-12-31','IGAC',0,7,'LEY 797','OBJETIVO EFECTIVIDAD DE LA PENSIÓN','5e6a5e0a6e386','1','2020-03-12 11:09:03',3,'2020-08-14 08:27:43',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(9,13,5,13,6,0.00,'2020-04-04','WEERWERE',0,1,'','','5e890f393b4ed','1','2020-04-04 17:52:11',6,'2020-08-14 08:27:41',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(10,1,1,2,6,0.00,'1900-01-01','',0,1,'','','5e8a4bec51369','1','2020-04-05 16:24:28',6,'2020-08-14 08:27:37',8,1,'','',NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(11,16,2,1,11,0.00,'2019-10-31',NULL,0,0,'LEY 71 DE 1978','Este proceso corresponde a un pensionado por invalidez, que acredita los requisitos de vejez y se solicita convertir la pensión a vejez.\r\nTuvo accidente de tránsito, con lesión columna, con PCL del 96% y después de pensionado por invalidez se afilia a POR','','1','2020-09-30 12:55:05',11,'2020-10-02 15:28:28',8,0,'11001333301234567891234','',NULL,1,1,NULL,'UNIVERSIDAD COOPERATIVA DE COLOMBIA',0,1,0,NULL,NULL,NULL,NULL,NULL,'',0);
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_bitacora`
--

DROP TABLE IF EXISTS `proceso_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_bitacora` (
  `id_proceso_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `comentario` text,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_proceso` int(11) NOT NULL,
  `sesion_id` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_proceso_bitacora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_bitacora`
--

LOCK TABLES `proceso_bitacora` WRITE;
/*!40000 ALTER TABLE `proceso_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_documento`
--

DROP TABLE IF EXISTS `proceso_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_documento` (
  `id_proceso_documento` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `ruta_fisica_archivo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ruta_http_archivo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_archivo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario_creacion` int(11) DEFAULT '0',
  PRIMARY KEY (`id_proceso_documento`),
  KEY `FK_proceso_documento_documento` (`id_documento`),
  CONSTRAINT `FK_proceso_documento_documento` FOREIGN KEY (`id_documento`) REFERENCES `documento` (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_documento`
--

LOCK TABLES `proceso_documento` WRITE;
/*!40000 ALTER TABLE `proceso_documento` DISABLE KEYS */;
INSERT INTO `proceso_documento` VALUES (1,1,4,'D:\\APP\\xampp\\htdocs\\juridico\\doc\\5d5578253a539\\','doc/5d5578253a539/','Boarding Pass - LATAM Airlines.pdf',0),(2,10,7,'D:\\APP\\xampp\\htdocs\\juridico\\doc\\5e8a4bec51369\\','doc/5e8a4bec51369/','200202282037.pdf',0);
/*!40000 ALTER TABLE `proceso_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa`
--

DROP TABLE IF EXISTS `proceso_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa` (
  `id_proceso_etapa` int(11) NOT NULL AUTO_INCREMENT,
  `id_etapa_proceso` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `porcentaje` int(3) DEFAULT '0',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proceso_etapa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa`
--

LOCK TABLES `proceso_etapa` WRITE;
/*!40000 ALTER TABLE `proceso_etapa` DISABLE KEYS */;
INSERT INTO `proceso_etapa` VALUES (1,12,11,0,'2020-09-30 12:55:59','2020-09-30 12:55:59',11,11),(2,1,11,0,'2020-09-30 12:56:01','2020-09-30 12:56:01',11,11),(3,3,11,0,'2020-09-30 12:56:16','2020-09-30 12:56:16',11,11),(4,4,11,0,'2020-09-30 12:56:18','2020-09-30 12:56:18',11,11),(5,7,11,0,'2020-09-30 12:56:20','2020-09-30 12:56:20',11,11);
/*!40000 ALTER TABLE `proceso_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa_actuacion`
--

DROP TABLE IF EXISTS `proceso_etapa_actuacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa_actuacion` (
  `id_proceso_etapa_actuacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa` int(11) NOT NULL,
  `id_actuacion` int(11) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `fecha_radicado` datetime DEFAULT NULL,
  `numero_radicado` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` datetime DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  `id_entidad_justicia` int(11) DEFAULT NULL,
  `nombre_juez` varchar(45) DEFAULT NULL,
  `numero_proceso` varchar(45) DEFAULT NULL,
  `instancia` varchar(45) DEFAULT NULL,
  `resultado` tinyint(1) DEFAULT NULL COMMENT 'Favorable y en contra',
  `fecha_notificacion` datetime DEFAULT NULL,
  `tipo_resultado` int(1) DEFAULT NULL COMMENT 'Resolución y auto',
  `entidad_profirio_respuesta` varchar(45) DEFAULT NULL,
  `fecha_audiencia` datetime DEFAULT NULL,
  `lugar_audiencia` varchar(45) DEFAULT NULL,
  `apela_resultado` tinyint(1) DEFAULT NULL,
  `motivo` text,
  `comentario` text,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `id_usuario_responsable` int(11) NOT NULL,
  `finalizado` tinyint(1) DEFAULT '0',
  `valor_pago` float(11,2) DEFAULT '0.00',
  `id_usuario_asigna` int(11) DEFAULT NULL,
  `resultado_actuacion` varchar(100) DEFAULT '',
  `fecha_actuacion_rama` date DEFAULT NULL,
  `fecha_notificacion_rama` date DEFAULT NULL,
  `fecha_inicio_termino_rama` date DEFAULT NULL,
  `anotacion_rama` varchar(45) DEFAULT '',
  `historico` tinyint(1) DEFAULT '0',
  `fecha_resultado` date DEFAULT NULL,
  PRIMARY KEY (`id_proceso_etapa_actuacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa_actuacion`
--

LOCK TABLES `proceso_etapa_actuacion` WRITE;
/*!40000 ALTER TABLE `proceso_etapa_actuacion` DISABLE KEYS */;
INSERT INTO `proceso_etapa_actuacion` VALUES (1,1,1,'2020-09-30 01:28:36',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-30 13:28:36','2020-09-30 13:55:03',11,11,0,0,0.00,NULL,'2020-09-29',NULL,NULL,NULL,'',0,'2020-09-29'),(2,3,6,'2020-09-30 02:05:16','2020-09-30 02:06:38',NULL,'11001333300020150078900',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-30 14:05:16','2020-09-30 14:12:44',11,11,0,1,0.00,NULL,'15000000',NULL,NULL,NULL,'',0,NULL),(3,3,11,'2020-09-30 02:06:38',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-30 14:06:38','2020-09-30 14:06:38',11,11,5,0,0.00,11,'',NULL,NULL,NULL,'',0,NULL),(4,2,4,'2020-10-02 03:18:21','2020-10-02 03:28:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-02 15:18:21','2020-11-23 09:18:41',8,1,0,1,0.00,NULL,'2020400301624742',NULL,NULL,NULL,'',0,NULL),(5,2,8,'2020-10-02 03:28:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-02 15:28:28','2020-11-28 09:00:53',8,3,8,0,0.00,8,'',NULL,NULL,NULL,'',0,NULL);
/*!40000 ALTER TABLE `proceso_etapa_actuacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa_actuacion_bitacora`
--

DROP TABLE IF EXISTS `proceso_etapa_actuacion_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa_actuacion_bitacora` (
  `id_proceso_etapa_actuacion_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `comentario` text,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_proceso_etapa_actuacion` int(11) NOT NULL,
  `sesion_id` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_proceso_etapa_actuacion_bitacora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa_actuacion_bitacora`
--

LOCK TABLES `proceso_etapa_actuacion_bitacora` WRITE;
/*!40000 ALTER TABLE `proceso_etapa_actuacion_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso_etapa_actuacion_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa_actuacion_documento`
--

DROP TABLE IF EXISTS `proceso_etapa_actuacion_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa_actuacion_documento` (
  `id_proceso_etapa_actuacion_documento` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` int(11) DEFAULT NULL,
  `id_documento` int(11) NOT NULL,
  `ruta_fisica_archivo` varchar(45) DEFAULT NULL,
  `ruta_http_archivo` varchar(45) DEFAULT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_proceso_etapa_actuacion_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa_actuacion_documento`
--

LOCK TABLES `proceso_etapa_actuacion_documento` WRITE;
/*!40000 ALTER TABLE `proceso_etapa_actuacion_documento` DISABLE KEYS */;
INSERT INTO `proceso_etapa_actuacion_documento` VALUES (1,1,6,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(2,1,7,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(4,1,3,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(5,1,1,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(6,1,2,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(7,2,14,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(8,2,31,NULL,NULL,'fALLO PETRO VIDAL.pdf',11),(9,2,32,NULL,NULL,'fALLO PETRO VIDAL.pdf',11);
/*!40000 ALTER TABLE `proceso_etapa_actuacion_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa_actuacion_plantillas`
--

DROP TABLE IF EXISTS `proceso_etapa_actuacion_plantillas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa_actuacion_plantillas` (
  `id_proceso_etapa_actuacion_plantillas` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` int(11) DEFAULT '0',
  `id_proceso_etapa` int(11) DEFAULT '0',
  `id_proceso` int(11) DEFAULT '0',
  `id_plantilla_documento` int(11) NOT NULL,
  PRIMARY KEY (`id_proceso_etapa_actuacion_plantillas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa_actuacion_plantillas`
--

LOCK TABLES `proceso_etapa_actuacion_plantillas` WRITE;
/*!40000 ALTER TABLE `proceso_etapa_actuacion_plantillas` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso_etapa_actuacion_plantillas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_etapa_bitacora`
--

DROP TABLE IF EXISTS `proceso_etapa_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_etapa_bitacora` (
  `id_proceso_etapa_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `comentario` text,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `proceso_etapa` int(11) NOT NULL,
  `sesion_id` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_proceso_etapa_bitacora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_etapa_bitacora`
--

LOCK TABLES `proceso_etapa_bitacora` WRITE;
/*!40000 ALTER TABLE `proceso_etapa_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso_etapa_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_tipo_resultado`
--

DROP TABLE IF EXISTS `proceso_tipo_resultado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_tipo_resultado` (
  `id_proceso_tipo_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_resultado` int(11) NOT NULL,
  `valor_proceso_tipo_resultado` varchar(100) DEFAULT NULL,
  `id_proceso` int(11) NOT NULL,
  PRIMARY KEY (`id_proceso_tipo_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_tipo_resultado`
--

LOCK TABLES `proceso_tipo_resultado` WRITE;
/*!40000 ALTER TABLE `proceso_tipo_resultado` DISABLE KEYS */;
INSERT INTO `proceso_tipo_resultado` VALUES (1,4,'2020-09-29',11),(2,9,'15000000',11),(3,1,'2020400301624742',11);
/*!40000 ALTER TABLE `proceso_tipo_resultado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sede_operativa`
--

DROP TABLE IF EXISTS `sede_operativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sede_operativa` (
  `id_sede_operativa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sede_operativa` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado_sede_operativa` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sede_operativa`),
  UNIQUE KEY `UQ_sede_operativa` (`nombre_sede_operativa`),
  KEY `IX_sede_operativa_estado_sede_operativa` (`estado_sede_operativa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sede_operativa`
--

LOCK TABLES `sede_operativa` WRITE;
/*!40000 ALTER TABLE `sede_operativa` DISABLE KEYS */;
INSERT INTO `sede_operativa` VALUES (1,'BOGOTA',1,'2019-02-25 14:26:44',1,NULL,NULL);
/*!40000 ALTER TABLE `sede_operativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `id_clase_tipo` int(11) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo`),
  KEY `FK_tipo_clase_tipo` (`id_clase_tipo`),
  CONSTRAINT `FK_tipo_clase_tipo` FOREIGN KEY (`id_clase_tipo`) REFERENCES `clase_tipo` (`id_clase_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,1,1,'INICIAL'),(2,1,2,'INTERMEDIA'),(3,1,3,'FINAL'),(4,2,1,'S├ì'),(5,2,2,'NO'),(6,3,1,'S├ì'),(7,3,2,'NO'),(8,4,1,'S├ì'),(9,4,2,'NO'),(10,5,1,'S├ì'),(11,5,2,'NO'),(12,6,1,'S├ì'),(13,6,2,'NO'),(14,7,1,'S├ì'),(15,7,2,'NO'),(16,8,1,'S├ì'),(17,8,2,'NO'),(18,9,1,'S├ì'),(19,9,2,'NO'),(20,10,1,'S├ì'),(21,10,2,'NO'),(22,11,1,'S├ì'),(23,11,2,'NO'),(24,12,1,'S├ì'),(25,12,2,'NO'),(26,13,1,'S├ì'),(27,13,2,'NO'),(28,14,1,'S├ì'),(29,14,2,'NO'),(30,15,1,'S├ì'),(31,15,2,'NO'),(32,16,1,'S├ì'),(33,16,2,'NO'),(34,17,1,'S├ì'),(35,17,2,'NO'),(36,18,1,'D├ìAS'),(37,18,2,'SEMANAS'),(38,18,3,'MESES'),(39,18,4,'A├æOS'),(40,19,1,'S├ì'),(41,19,2,'NO');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `abreviatura_tipo_documento` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_tipo_documento` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado_tipo_documento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_tipo_documento`),
  UNIQUE KEY `UQ_tipo_documento` (`nombre_tipo_documento`),
  KEY `IX_tipo_documento_estado_tipo_documento` (`estado_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'C.C.','Cédula de ciudadanía',1,'2019-02-25 14:26:44',1,0),(2,'C.E.','Cédula de extranjerías',1,'2019-02-25 14:26:44',1,0),(3,'NIT.','Número de identificación tributaria',1,'2019-02-25 14:26:44',1,0),(4,'PAS.','Pasaporte',1,'2019-02-25 14:26:44',1,0);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_proceso`
--

DROP TABLE IF EXISTS `tipo_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_proceso` (
  `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_proceso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado_tipo_proceso` enum('1','2') COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_tipo_proceso`),
  UNIQUE KEY `IX_tipo_proceso_nombre_tipo_proceso` (`nombre_tipo_proceso`),
  KEY `IX_tipo_proceso_estado_tipo_proceso` (`estado_tipo_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_proceso`
--

LOCK TABLES `tipo_proceso` WRITE;
/*!40000 ALTER TABLE `tipo_proceso` DISABLE KEYS */;
INSERT INTO `tipo_proceso` VALUES (1,'NULIDAD AFILIACIÓN RAIS JURISDICCION LABORAL','1','2019-03-01 09:10:13',1,'2020-09-16 10:46:27',1,0),(2,'RECONOCIMIENTO PENSION JURISDICCION ADMINISTRATIVA','1','2019-03-02 12:03:04',1,'2020-08-14 10:25:36',8,0),(3,'REVISION PENSION JURISDICCION ADMINISTRATIVA','1','2019-03-02 12:03:15',1,'2020-08-14 10:25:47',8,0),(4,'CONTRATO REALIDAD JURISDICCION ADMINISTRATIVA','1','2019-03-02 12:03:23',1,'2020-09-09 11:58:46',11,0),(5,'RECLAMACION PRESTACIONES SOCIALES','1','2019-03-02 12:03:46',1,'2020-08-14 10:08:27',8,1),(6,'NULIDAD SANCION PARAFISCALES UGPP','1','2019-03-04 19:07:33',1,'2020-08-14 10:11:37',8,0),(7,'EJECUTIVO JURISDICCION ADMINISTRATIVA (INTERESES)','1','2020-08-14 10:20:14',8,'2020-09-14 16:43:59',11,0),(8,'EJECUTIVO JURISDICCION LABORAL','1','2020-08-14 10:24:40',8,'2020-08-14 10:24:40',8,0),(9,'RECLAMACION CESANTIAS','1','2020-08-14 10:27:53',8,'2020-08-14 10:27:53',8,0),(10,'NULIDAD DESCUENTOS POR APORTES JURISDICCION ADMINISTRATIVA','1','2020-08-14 10:40:12',8,'2020-08-14 10:40:12',8,0),(11,'CONTRATO REALIDAD JURISDICCIÓN LABORAL','1','2020-09-14 10:08:50',11,'2020-09-14 10:08:50',11,0),(12,'DISCIPLINARIO','1','2020-09-14 10:09:23',11,'2020-09-14 10:09:23',11,0),(13,'TUTELA POR VÍA DE HECHO','1','2020-09-14 10:12:00',11,'2020-09-14 10:12:00',11,0),(14,'CASACIÓN','1','2020-09-14 10:12:08',11,'2020-09-14 10:12:08',11,0),(15,'REVISIÓN','1','2020-09-14 10:12:16',11,'2020-09-14 10:12:16',11,0),(16,'EJECUTIVO JURISDICCION ADMINISTRATIVA (APORTES)','1','2020-09-14 16:44:10',11,'2020-09-14 16:44:10',11,0),(17,'EJECUTIVO JURISDICCION ADMINISTRATIVA (INTEGRAL)','1','2020-09-14 16:44:42',11,'2020-09-14 16:44:42',11,0),(18,'EJECUTIVO JURISDICCION ADMINISTRATIVA (HONORARIOS)','1','2020-09-14 16:44:55',11,'2020-09-14 16:44:55',11,0);
/*!40000 ALTER TABLE `tipo_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_resultado`
--

DROP TABLE IF EXISTS `tipo_resultado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_resultado` (
  `id_tipo_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_resultado` varchar(100) NOT NULL,
  `unico_tipo_resultado` tinyint(1) DEFAULT '0',
  `eliminado` tinyint(1) DEFAULT '0',
  `tipo_campo` int(2) DEFAULT NULL COMMENT '1. Alfanumerico\n2. Documento\n3. Fecha\n4. Numero\n5. Moneda\n6. Historico de sentencias',
  PRIMARY KEY (`id_tipo_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_resultado`
--

LOCK TABLES `tipo_resultado` WRITE;
/*!40000 ALTER TABLE `tipo_resultado` DISABLE KEYS */;
INSERT INTO `tipo_resultado` VALUES (1,'Dato alfanumerico',0,0,1),(2,'Documento',0,0,2),(3,'Dato numérico',0,0,4),(4,'Fecha',0,0,3),(5,'Historico de sentencias',1,0,6),(6,'Número del Radicado',1,0,1),(7,'Entidad de Justicia en primera instancia',1,0,1),(8,'Entidad de justicia en segunda instancia',1,0,1),(9,'Cuantía de la demanda',1,0,4),(10,'Estimación de pretensiones',1,0,4),(11,'Fecha de radicación del cumplimiento',1,0,3),(12,'Fecha de pago',1,0,3),(13,'Ubicación física del archivo muerto',1,0,1),(14,'Valor final sentencia',1,0,3),(15,'Magistrado ponente',1,0,1),(16,'Hoja de reparto',1,0,2),(17,'resultado de la vuelta de radicacion',2,1,1),(18,'Gastos del proceso',1,0,5);
/*!40000 ALTER TABLE `tipo_resultado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `estado_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `prefijo_telefono` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `id_area` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `UQ_usuario` (`nombre_usuario`),
  KEY `IX_usuario_estado_usuario` (`estado_usuario`),
  KEY `FK_usuario_perfil` (`id_perfil`),
  KEY `FK_usuario_persona` (`id_persona`),
  CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,26,1,'admin','465c194afb65670f38322df087f0a9bb225cc257e43eb4ac5a0c98ef5b3173ac',1,'2019-02-25 14:26:44',1,NULL,'2020-07-30 15:49:25','$2y$10$mWzftE4zPBxGmfWK8wLMbOQqrPpdKDWMiQEG6brz6eJNqStcEOL06',1,0,NULL),(2,17,1,'jfranco','465c194afb65670f38322df087f0a9bb225cc257e43eb4ac5a0c98ef5b3173ac',1,'2019-02-25 14:26:44',1,NULL,'2020-08-14 09:44:49','$2y$10$5iU/z052fHtMWzq7slmKy.3pTpbJ3FI1blYkRzAL/JeoAIqUpiocK',8,0,NULL),(3,23,1,'msanabria','cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac',1,'2019-08-06 19:54:53',1,NULL,'2020-07-30 15:43:11','$2y$10$ImGsW./kNI6tTba2K4Wu8.7CcC/Dx.rNjBzGp9k/XH3DroNHUSobq',1,0,NULL),(4,19,1,'fernando','57e5423f0529f0adbe06050be66c89a430867727125a643f5357af7efd140470',1,'2019-08-07 08:40:47',1,NULL,'2020-07-30 14:16:05',NULL,1,1,NULL),(5,25,1,'emartinez','cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac',1,'2020-02-25 10:12:23',3,NULL,'2020-11-28 08:22:09','$2y$10$V4AlxBuUVu7TkkHheAeHd.UZAzzcLBxDFTESas.nmV3f1GjeBC9U2',3,0,2),(6,21,1,'mario','cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac',1,'2020-03-21 13:42:25',3,NULL,'2020-07-30 14:15:58',NULL,1,1,NULL),(7,22,3,'josemo','cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac',1,'2020-04-16 17:57:06',3,'+5731','2020-07-30 14:15:46',NULL,1,1,NULL),(8,27,1,'ccristancho','',1,'2020-07-30 15:50:50',1,NULL,'2020-08-14 09:39:55','$2y$10$fU2e3ZVwXuaPICkAF1NLvuLCpoYblLCO.6diSXiMu0NdRsptzIIwK',3,0,NULL),(9,28,1,'asanabria','',1,'2020-07-30 15:53:43',3,NULL,'2020-11-13 10:40:14','$2y$10$ptVv1zAaNvQ6FM722KaME.yDx1rmkjNaa60U.MilZ53SbvjXpT.sO',3,0,NULL),(10,29,1,'srubio','',1,'2020-08-10 14:34:35',3,NULL,'2020-08-14 09:36:58','$2y$10$BT3AUpOAkm40fmYzTSIQouI3T9CB.N2VNmuP2dis/YfFvtL8C.2I2',8,0,NULL),(11,31,1,'mlsanabria','',1,'2020-08-12 15:00:43',3,NULL,'2020-09-09 11:51:11','$2y$10$D2HzQpcM0reBJyDgeZsQ4.DtZkOSJiksMhrMp2n9kAlMjprIkwpfe',3,0,NULL),(12,33,1,'rrodriguez','',1,'2020-09-28 18:39:26',3,NULL,'2020-11-12 10:25:05','$2y$10$pTPOpDHNpB/Kne5BlTp6meG2XSVSttoA0Ci9uf4ibpenKc6r9/pRW',1,0,NULL),(13,35,3,'facundo','',1,'2020-11-13 10:44:00',3,NULL,'2020-11-13 10:44:53','$2y$10$WjYmLoUZRtv2SjnSzIMYdO4rvqfTYdkp/2psuvOyCZ/aTJ2a/hB2S',3,1,NULL),(14,36,1,'jsoriano','',1,'2020-12-09 15:52:49',3,NULL,'2020-12-09 15:52:49','$2y$10$wpRdnq3m/sz8eK6WK7DdFO4PCDPyiFiIV.Q6PNmplfh6fqQaj.mL.',3,0,5);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_sede_operativa`
--

DROP TABLE IF EXISTS `usuario_sede_operativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_sede_operativa` (
  `id_usuario_sede_operativa` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_sede_operativa` int(11) NOT NULL,
  `estado_usuario_sede_operativa` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_sede_operativa`),
  UNIQUE KEY `UQ_usuario_sede_operativa` (`id_usuario`,`id_sede_operativa`),
  KEY `IX_usuario_sede_operativa_estado_usuario_sede_operativa` (`estado_usuario_sede_operativa`),
  KEY `FK_usuario_sede_operativa_sede_operativa` (`id_sede_operativa`),
  CONSTRAINT `FK_usuario_sede_operativa_sede_operativa` FOREIGN KEY (`id_sede_operativa`) REFERENCES `sede_operativa` (`id_sede_operativa`),
  CONSTRAINT `FK_usuario_sede_operativa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_sede_operativa`
--

LOCK TABLES `usuario_sede_operativa` WRITE;
/*!40000 ALTER TABLE `usuario_sede_operativa` DISABLE KEYS */;
INSERT INTO `usuario_sede_operativa` VALUES (1,1,1,1,'2019-02-25 14:26:44',1,NULL,NULL),(2,2,1,1,'2019-02-25 14:26:44',1,NULL,NULL),(3,3,1,1,'2019-08-06 19:54:54',1,NULL,NULL),(4,4,1,1,'2019-08-07 08:40:47',1,NULL,NULL),(5,5,1,1,'2020-02-25 10:12:23',3,NULL,NULL),(6,6,1,1,'2020-03-21 13:42:25',3,NULL,NULL),(7,7,1,1,'2020-04-16 17:57:06',3,NULL,NULL);
/*!40000 ALTER TABLE `usuario_sede_operativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `id_variable` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_variable` varchar(45) DEFAULT NULL,
  `valor_variable` varchar(45) NOT NULL,
  `estado_variable` tinyint(1) DEFAULT '1',
  `id_grupo_variable` int(11) NOT NULL,
  `orden` int(3) DEFAULT '0',
  `function_variable` varchar(100) NOT NULL,
  PRIMARY KEY (`id_variable`),
  UNIQUE KEY `valor_variable_UNIQUE` (`valor_variable`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
INSERT INTO `variables` VALUES (1,'Teléfono','TELEFONO_CLIENTE',1,1,0,'getTelefono'),(2,'Celular 1','CELULAR_PRINCIPAL_CLIENTE',1,1,0,'getCelular'),(3,'Celular 2','CELULAR_SECUNDARIO_CLIENTE',1,1,0,'celular2'),(4,'Correo electrónico','CORREO_ELECTRONICO_CLIENTE',1,1,0,'getEmail'),(5,'Nombre completo','NOMBRE_COMPLETO_CLIENTE',1,1,0,'getNombreCompleto'),(6,'Primer nombre','PRIMER_NOMBRE_CLIENTE',1,1,0,'getPrimerNombre'),(7,'Primer apellido','PRIMER_APELLIDO_CLIENTE',1,1,0,'getPrimerApellido'),(8,'Segundo nombre','SEGUNDO_NOMBRE_CLIENTE',1,1,0,'getSegundoNombre'),(9,'Segundo apellido','SEGUNDO_APELLIDO_CLIENTE',1,1,0,'getSegundoApellido'),(10,'Número de documento','NUMERO_DOCUMENTO_CLIENTE',1,1,0,'getNumeroDocumento'),(11,'Tipo de documento','TIPO_DOCUMENTO_CLIENTE',1,1,0,'getTipoDocumento'),(12,'Tipo de documento abreviado','TIPO_DOCUMENTO_ABREVIADO_CLIENTE',1,1,0,'getSiglasTipoDocumento'),(13,'Lugar de expedicion del documento','LUGAR_EXPEDICION_DOCUMENTO_CLIENTE',1,1,0,'getLugarExpedicionDocumento'),(14,'Estado vital','ESTADO_VITAL_CLIENTE',1,1,0,'getEstadoVital'),(15,'Direccion de residencia','DIRECCION_RESIDENCIA_CLIENTE',1,1,0,'getDireccion'),(16,'Barrio de residencia','BARRIO_RESIDENCIA_CLIENTE',1,1,0,'getBarrio'),(17,'Número del proceso','NUMERO_PROCESO',1,2,0,'id_proceso'),(18,'Fecha de creación','FECHA_CREACION_PROCESO',1,2,0,'getFechaCreacion'),(19,'Hora de creación','HORA_CREACION_PROCESO',1,2,0,'getHoraCreacion'),(20,'Pais','PAIS_PROCESO',1,2,0,'getPais'),(21,'Departamento','DEPARTAMENTO_PROCESO',1,2,0,'getDepartamento'),(22,'Municipio','MUNICIPIO_PROCESO',1,2,0,'getMunicipio'),(23,'Entidad demandada','ENTIDAD_DEMANDADA',1,2,0,'getEntidadDemandada'),(24,'Fecha de retiro del servicio','FECHA_RETIRO_SERVICIO_PROCESO',1,2,0,'getFechaRetiroServicioString'),(25,'Entidad de justicia','ENTIDAD_JUSTICIA',1,2,0,'getEntidadJusticia'),(26,'Acto administrativo del retiro','ACTO_ADMINISTRATIVO_RETIRO',1,2,0,'acto_administrativo'),(27,'Fecha actual','FECHA_ACTUAL',1,3,0,'date(\"d/m/Y\")'),(28,'Hora actual','HORA_ACTUAL',1,3,0,'date(\"h:i A\")'),(29,'Tipo de documento','TIPO_DOCUMENTO_BENEFICIARIO',1,4,0,'getTipoDocumentoBeneficiario'),(30,'Número de documento','DOCUMENTO_BENEFICIARIO',1,4,0,'getDocumentoBeneficiario'),(31,'Nombre completo','NOMBRE_COMPLETO_BENEFICIARIO',1,4,0,'getNombreBeneficiario'),(32,'Parentesco con el cliente','PARENTESCO_CLIENTE_BENEFICIARIO',1,4,0,'getParentescoBeneficiario'),(33,'Nombre completo','NOMBRE_COMPLETO_CONTACTO',1,5,0,'nombre_contacto'),(34,'Parentesco con el cliente','PARENTESCO_CONTACTO',1,5,0,'parentesco'),(35,'Municipio','MUNICIPIO_CONTACTO',1,5,0,'getMunicipio'),(36,'Departamento','DEPARTAMENTO_CONTACTO',1,5,0,'getDepartamento'),(37,'Pais','PAIS_CONTACTO',1,5,0,'getPais'),(38,'Barrio','BARRIO_CONTACTO',1,5,0,'barrio'),(39,'Dirección','DIRECCION_CONTACTO',1,5,0,'direccion'),(40,'Celular','CELULAR_CONTACTO',1,5,0,'celular'),(41,'Teléfono','TELEFONO_CONTACTO',1,5,0,'telefono'),(42,'Correo electrónico','CORREO_ELECTRONICO_CONTACTO',1,5,0,'correo_electronico'),(43,'Area','AREA_USUARIO',1,6,0,'getArea'),(44,'Nombre de usuario','NOMBRE_DE_USUARIO',1,6,0,'nombre_usuario'),(45,'Tipo de documento','TIPO_DOCUMENTO_USUARIO',1,6,0,'getTipoDocumento'),(46,'Nombre completo','NOMBRE_COMPLETO_USUARIO',1,6,0,'getNombreCompleto'),(47,'Sede operativa','SEDE_OPERATIVA_USUARIO',1,6,0,'getSedeOperativa'),(48,'Dirección','DIRECCION_USUARIO',1,6,0,'getDireccion'),(49,'Teléfono','TELEFONO_USUARIO',1,6,0,'getTelefono'),(50,'Correo electrónico','CORREO_ELECTRONICO_USUARIO',1,6,0,'getCorreoElectronico');
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-15 22:12:48
