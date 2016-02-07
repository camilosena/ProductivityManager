CREATE DATABASE  IF NOT EXISTS `productivitymanager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `productivitymanager`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: productivitymanager
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB

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
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `idAreas` int(11) NOT NULL DEFAULT '0',
  `nombreArea` varchar(45) DEFAULT NULL,
  `roles_idRoles` int(11) NOT NULL,
  PRIMARY KEY (`idAreas`,`roles_idRoles`),
  KEY `fk_areas_roles1_idx` (`roles_idRoles`),
  CONSTRAINT `fk_areas_roles1` FOREIGN KEY (`roles_idRoles`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (0,'default',0),(1,'Administracion',1),(2,'Privado',2),(3,'Corte',3),(4,'Ensamble',3),(5,'Publico',2),(6,'Cliente',4);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombreCompania` varchar(45) DEFAULT NULL,
  `nit` bigint(15) NOT NULL,
  `sectorEmpresarial` varchar(45) DEFAULT NULL,
  `sectorEconomico` varchar(45) DEFAULT NULL,
  `telefonoFijo` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`idCliente`,`nit`),
  UNIQUE KEY `nit_UNIQUE` (`nit`),
  CONSTRAINT `fk_Clientes_Usuarios1` FOREIGN KEY (`idCliente`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'Muebles La Oficina',99473843,'Publico','Industrial',7758734);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactenos`
--

DROP TABLE IF EXISTS `contactenos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactenos` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `modo` varchar(45) DEFAULT NULL,
  `razon` varchar(45) DEFAULT NULL,
  `indicativos_idPais` int(11) NOT NULL,
  PRIMARY KEY (`idContacto`,`idPersona`,`indicativos_idPais`),
  KEY `fk_contactenos_indicativos1_idx` (`indicativos_idPais`),
  KEY `fk_contactenos_personas1_idx` (`idPersona`),
  CONSTRAINT `fk_contactenos_indicativos1` FOREIGN KEY (`indicativos_idPais`) REFERENCES `indicativos` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contactenos_personas1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactenos`
--

LOCK TABLES `contactenos` WRITE;
/*!40000 ALTER TABLE `contactenos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactenos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiodecostos`
--

DROP TABLE IF EXISTS `estudiodecostos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiodecostos` (
  `idestudioDeCostos` int(11) NOT NULL AUTO_INCREMENT,
  `idProyectoSolicitado` int(11) NOT NULL,
  `idGerenteACargo` int(11) NOT NULL,
  `costoManoDeObra` int(11) DEFAULT NULL,
  `costoProduccion` int(11) DEFAULT NULL,
  `costoProyecto` bigint(20) DEFAULT NULL,
  `utilidad` int(11) DEFAULT NULL,
  `tiempoEstimado` int(11) DEFAULT NULL,
  `totalTrabajadores` int(11) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idestudioDeCostos`,`idProyectoSolicitado`,`idGerenteACargo`),
  KEY `fk_estudioDeCostos_Proyectos1_idx` (`idProyectoSolicitado`),
  KEY `fk_estudiodecostos_usuarios1_idx` (`idGerenteACargo`),
  CONSTRAINT `fk_estudioDeCostos_Proyectos1` FOREIGN KEY (`idProyectoSolicitado`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_estudiodecostos_usuarios1` FOREIGN KEY (`idGerenteACargo`) REFERENCES `personas` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiodecostos`
--

LOCK TABLES `estudiodecostos` WRITE;
/*!40000 ALTER TABLE `estudiodecostos` DISABLE KEYS */;
/*!40000 ALTER TABLE `estudiodecostos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicativos`
--

DROP TABLE IF EXISTS `indicativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicativos` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(45) DEFAULT NULL,
  `indicativo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicativos`
--

LOCK TABLES `indicativos` WRITE;
/*!40000 ALTER TABLE `indicativos` DISABLE KEYS */;
/*!40000 ALTER TABLE `indicativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiaprima`
--

DROP TABLE IF EXISTS `materiaprima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiaprima` (
  `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionMateria` varchar(80) NOT NULL,
  `unidadDeMedida` varchar(45) NOT NULL,
  `precioBase` int(11) NOT NULL,
  PRIMARY KEY (`idMateriaPrima`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiaprima`
--

LOCK TABLES `materiaprima` WRITE;
/*!40000 ALTER TABLE `materiaprima` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiaprima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiaprimaporproducto`
--

DROP TABLE IF EXISTS `materiaprimaporproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiaprimaporproducto` (
  `ProductosIdProductos` int(11) NOT NULL,
  `idMateriaPrima_materiaPrima` int(11) NOT NULL,
  `cantidadMateriaPorProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProductosIdProductos`,`idMateriaPrima_materiaPrima`),
  KEY `fk_Productos_has_materiaPrima_materiaPrima1_idx` (`idMateriaPrima_materiaPrima`),
  KEY `fk_Productos_has_materiaPrima_Productos1_idx` (`ProductosIdProductos`),
  CONSTRAINT `fk_Productos_has_materiaPrima_Productos1` FOREIGN KEY (`ProductosIdProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_materiaPrima_materiaPrima1` FOREIGN KEY (`idMateriaPrima_materiaPrima`) REFERENCES `materiaprima` (`idMateriaPrima`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiaprimaporproducto`
--

LOCK TABLES `materiaprimaporproducto` WRITE;
/*!40000 ALTER TABLE `materiaprimaporproducto` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiaprimaporproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiaprimaporproyecto`
--

DROP TABLE IF EXISTS `materiaprimaporproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiaprimaporproyecto` (
  `materiaPrima_idMateriaPrima` int(11) NOT NULL,
  `proyectos_idProyecto` int(11) NOT NULL,
  `valorTotal` int(11) DEFAULT NULL,
  `porcentajeProvisional` int(11) DEFAULT NULL,
  PRIMARY KEY (`materiaPrima_idMateriaPrima`,`proyectos_idProyecto`),
  KEY `fk_materiaPrima_has_proyectos_proyectos1_idx` (`proyectos_idProyecto`),
  CONSTRAINT `fk_materiaPrima_has_proyectos_materiaPrima1` FOREIGN KEY (`materiaPrima_idMateriaPrima`) REFERENCES `materiaprima` (`idMateriaPrima`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_materiaPrima_has_proyectos_proyectos1` FOREIGN KEY (`proyectos_idProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiaprimaporproyecto`
--

LOCK TABLES `materiaprimaporproyecto` WRITE;
/*!40000 ALTER TABLE `materiaprimaporproyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiaprimaporproyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novedades` (
  `idNovedad` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_idUsuario` int(11) NOT NULL,
  `proyectos_idProyecto` int(11) NOT NULL,
  `categoria` enum('Retraso','Actividad','Solicitud') NOT NULL,
  `descripcionNovedad` varchar(200) DEFAULT NULL,
  `fechaNovedad` datetime NOT NULL,
  `archivoNovedad` varchar(45) DEFAULT NULL,
  `solucionNovedad` varchar(45) DEFAULT NULL,
  `fechaSolucionNovedad` date DEFAULT NULL,
  `estadoSolucion` enum('Pendiente','Solucionado') DEFAULT NULL,
  PRIMARY KEY (`idNovedad`,`usuarios_idUsuario`,`proyectos_idProyecto`),
  KEY `fk_Usuarios_has_Proyectos_Proyectos1_idx` (`proyectos_idProyecto`),
  KEY `fk_Usuarios_has_Proyectos_Usuarios1_idx` (`usuarios_idUsuario`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `fk_Usuarios_has_Proyectos_Proyectos1` FOREIGN KEY (`proyectos_idProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Usuarios_has_Proyectos_Usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedades`
--

LOCK TABLES `novedades` WRITE;
/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `URL` varchar(120) DEFAULT NULL,
  `nombreRuta` varchar(45) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPermisos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'','Proyectos',1),(2,'crearProyecto.php','Crear Nuevo',2),(3,'listarProyectos.php','Listar Proyectos',2),(4,'','Novedades',1),(5,'agregarNovedad.php','Agregar Nueva',3),(6,'listarNovedades.php','Listar Informes de Novedad',3),(7,'','Personal',1),(8,'registrarUsuario.php','Registrar',4),(9,'listarUsuarios.php','Ver Todos',4),(10,'listarUsuariosInactivos.php','Inactivos',4),(11,'','Auditorias',1),(12,'generarAuditoria.php','Generar Nueva',5),(13,'listarAuditorias.php','Listar Auditorias',5),(14,'','Clientes',1),(15,'agregarCliente.php','Agregar',6),(16,'clientesActivos.php','Activos',6),(17,'clientesInactivos.php','Inactivos',6),(18,NULL,'Roles',1),(19,'crearRol.php','Crear Nuevo',7),(20,'agregarAreas.php','Agregar Área',7),(21,'modificarRol.php','Modificar Rol',0),(22,'asignarPermisos.php','Asignar Permisos',0),(23,'modificarUsuario.php','Modificar Usuario',0),(24,'modificarCliente.php','Modificar Cliente',0),(25,'modificarContrasena.php','Modificar Contraseña',0),(26,'estudioDeCostos.php','Estudio De Costos',0),(27,'modificarProyecto.php','Modificar Proyecto',0),(28,NULL,'Materia Prima',1),(29,'agregarInsumos.php','Agregar Materia Prima',8),(30,'actualizarRolArea.php','Actualizar Rol Area',0),(31,'agregarProcesos.php','Agregar Proceso',9),(32,NULL,'Procesos',1),(33,'asignarAreas.php','Asignar Area',0),(34,NULL,'Productos',1),(35,'agregarProductos.php','Agregar Producto',10),(36,'produccionProyecto.php','Producción Proyecto',0),(37,'crearRol.php?#ModalRoles','Ver Roles',7),(38,'informacionProyecto.php','Información Proyecto',0),(39,'insumosPorProducto.php','Insumos Por Producto',0);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisosporrol`
--

DROP TABLE IF EXISTS `permisosporrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisosporrol` (
  `permisos_idPermisos` int(11) NOT NULL,
  `idRoles_Roles` int(11) NOT NULL,
  PRIMARY KEY (`permisos_idPermisos`,`idRoles_Roles`),
  KEY `fk_permisos_has_Roles_Roles1_idx` (`idRoles_Roles`),
  KEY `fk_permisos_has_Roles_permisos1_idx` (`permisos_idPermisos`),
  CONSTRAINT `fk_permisos_has_Roles_Roles1` FOREIGN KEY (`idRoles_Roles`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_has_Roles_permisos1` FOREIGN KEY (`permisos_idPermisos`) REFERENCES `permisos` (`idPermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisosporrol`
--

LOCK TABLES `permisosporrol` WRITE;
/*!40000 ALTER TABLE `permisosporrol` DISABLE KEYS */;
INSERT INTO `permisosporrol` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(12,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1);
/*!40000 ALTER TABLE `permisosporrol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(10) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` bigint(12) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Bloqueado') NOT NULL,
  `foto` varchar(95) DEFAULT NULL,
  `areas_idAreas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`,`identificacion`,`areas_idAreas`),
  UNIQUE KEY `identificacion_UNIQUE` (`identificacion`),
  KEY `apellidos` (`apellidos`),
  KEY `identificacion` (`identificacion`),
  KEY `fk_personas_areas1_idx1` (`areas_idAreas`),
  CONSTRAINT `fk_personas_areas1` FOREIGN KEY (`areas_idAreas`) REFERENCES `areas` (`idAreas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,1012377025,'Camilo','Arias González','Cll 93 No 11-08',3015782659,'1991-05-20','carias520@misena.edu.co','Inactivo','camilo.jpg',1),(2,378327683,'Pedro','Gonzalez','Calle 98a 12-87',77863448,NULL,'carias520@misena.edu.co','Activo','perfil.png',6);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesoporproducto`
--

DROP TABLE IF EXISTS `procesoporproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesoporproducto` (
  `idProductos_Productos` int(11) NOT NULL,
  `procesos_idProceso` int(11) NOT NULL,
  `cantidadDeEmpleados` int(11) DEFAULT NULL,
  `tiempoPorProceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductos_Productos`,`procesos_idProceso`),
  KEY `fk_Productos_has_procesos_procesos1_idx` (`procesos_idProceso`),
  KEY `fk_Productos_has_procesos_Productos1_idx` (`idProductos_Productos`),
  CONSTRAINT `fk_Productos_has_procesos_Productos1` FOREIGN KEY (`idProductos_Productos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_procesos_procesos1` FOREIGN KEY (`procesos_idProceso`) REFERENCES `procesos` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesoporproducto`
--

LOCK TABLES `procesoporproducto` WRITE;
/*!40000 ALTER TABLE `procesoporproducto` DISABLE KEYS */;
/*!40000 ALTER TABLE `procesoporproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesos`
--

DROP TABLE IF EXISTS `procesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesos` (
  `idProceso` int(11) NOT NULL AUTO_INCREMENT,
  `tipoProceso` varchar(45) NOT NULL,
  `precioProceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesos`
--

LOCK TABLES `procesos` WRITE;
/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesosporproyecto`
--

DROP TABLE IF EXISTS `procesosporproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesosporproyecto` (
  `idProyecto_proyectos` int(11) NOT NULL,
  `procesos_idProceso` int(11) NOT NULL,
  `totalTiempoProceso` int(11) DEFAULT NULL,
  `totalPrecioProceso` int(11) DEFAULT NULL,
  `totalEmpleadosProceso` varchar(45) DEFAULT NULL,
  `porcentajeProvision` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProyecto_proyectos`,`procesos_idProceso`),
  KEY `fk_proyectos_has_procesos_procesos1_idx` (`procesos_idProceso`),
  KEY `fk_proyectos_has_procesos_proyectos1_idx` (`idProyecto_proyectos`),
  CONSTRAINT `fk_proyectos_has_procesos_procesos1` FOREIGN KEY (`procesos_idProceso`) REFERENCES `procesos` (`idProceso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_proyectos_has_procesos_proyectos1` FOREIGN KEY (`idProyecto_proyectos`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesosporproyecto`
--

LOCK TABLES `procesosporproyecto` WRITE;
/*!40000 ALTER TABLE `procesosporproyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `procesosporproyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productoporproyecto`
--

DROP TABLE IF EXISTS `productoporproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productoporproyecto` (
  `Productos_idProductos` int(11) NOT NULL,
  `proyectosIdProyecto` int(11) NOT NULL,
  `cantidadProductos` int(11) DEFAULT NULL,
  PRIMARY KEY (`Productos_idProductos`,`proyectosIdProyecto`),
  KEY `fk_Productos_has_proyectos_proyectos1_idx` (`proyectosIdProyecto`),
  KEY `fk_Productos_has_proyectos_Productos1_idx` (`Productos_idProductos`),
  CONSTRAINT `fk_Productos_has_proyectos_Productos1` FOREIGN KEY (`Productos_idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_proyectos_proyectos1` FOREIGN KEY (`proyectosIdProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productoporproyecto`
--

LOCK TABLES `productoporproyecto` WRITE;
/*!40000 ALTER TABLE `productoporproyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `productoporproyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nombreProducto` varchar(45) DEFAULT NULL,
  `fotoProducto` varchar(45) DEFAULT NULL,
  `descripcionProducto` varchar(200) DEFAULT NULL,
  `estadoProducto` enum('Activo','Inactivo','Sin Procesos') DEFAULT NULL,
  `ganancia` double DEFAULT NULL,
  PRIMARY KEY (`idProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (10,'Prueba1','','Carga1','Inactivo',5),(11,'Prueba2','','Carga2','Inactivo',6),(12,'Prueba3','','Carga3','Inactivo',7),(13,'Prueba4','','Carga4','Inactivo',8),(14,'Prueba5','','Carga5','Inactivo',9);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProyecto` varchar(45) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `estadoProyecto` enum('Ejecución','Cancelado','Finalizado','Aplazado','Sin Estudio Costos','Sin Producción') NOT NULL,
  `ejecutado` int(11) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idProyecto`),
  KEY `estado` (`estadoProyecto`),
  KEY `nombreProyecto` (`nombreProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` VALUES (1,'dsadassad','2016-11-12','0000-00-00','Sin Producción',0,'FDSFS');
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (0,'default'),(1,'Administrador'),(2,'Gerente'),(3,'Empleado'),(4,'Clientes');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarioporproyecto`
--

DROP TABLE IF EXISTS `usuarioporproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarioporproyecto` (
  `usuarioAsignado` int(11) NOT NULL,
  `proyectoAsignado` int(11) NOT NULL,
  PRIMARY KEY (`usuarioAsignado`,`proyectoAsignado`),
  KEY `fk_usuarioPorProyecto_Proyectos1_idx` (`proyectoAsignado`),
  CONSTRAINT `fk_usuarioPorProyecto_Proyectos1` FOREIGN KEY (`proyectoAsignado`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarioPorProyecto_usuarios1` FOREIGN KEY (`usuarioAsignado`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarioporproyecto`
--

LOCK TABLES `usuarioporproyecto` WRITE;
/*!40000 ALTER TABLE `usuarioporproyecto` DISABLE KEYS */;
INSERT INTO `usuarioporproyecto` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `usuarioporproyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idLogin` bigint(20) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  `rolesId` int(11) NOT NULL,
  PRIMARY KEY (`idLogin`,`rolesId`,`contrasena`),
  KEY `fk_roles_idx` (`rolesId`),
  CONSTRAINT `fk_roles` FOREIGN KEY (`rolesId`) REFERENCES `roles` (`idRoles`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_usuarios1` FOREIGN KEY (`idLogin`) REFERENCES `personas` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1012377025,'c893bad68927b457dbed39460e6afd62',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'productivitymanager'
--

--
-- Dumping routines for database 'productivitymanager'
--
/*!50003 DROP PROCEDURE IF EXISTS `asignarUsuarioProyecto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `asignarUsuarioProyecto`(usuario int, proyecto int)
BEGIN
INSERT INTO `productivitymanager`.`usuarioporproyecto` (`usuarioAsignado`, `proyectoAsignado`) VALUES (usuario, proyecto);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ClienteProyecto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ClienteProyecto`(idProject int)
BEGIN
Select idCliente,nit, nombreCompania,sectorEmpresarial, sectorEconomico, telefonoFijo,
idUsuario,identificacion, concat(nombres,' ',apellidos) nombre,direccion,telefono,email,foto
from clientes, usuarios, usuarioporproyecto
where idUsuario=idCliente and idUsuario=usuarioAsignado and proyectoAsignado=idProject;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consecutivoAreas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `consecutivoAreas`()
BEGIN
select max(idAreas) from areas;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consecutivoRoles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `consecutivoRoles`()
BEGIN
SELECT max(idroles) FROM productivitymanager.roles;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `eliminarRol`(IdRol int)
BEGIN
DELETE FROM roles WHERE idRoles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GerenteEncargado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `GerenteEncargado`(idProject int)
BEGIN
Select idUsuario,identificacion, concat(nombres,' ',apellidos) nombre,direccion,telefono,fechaNacimiento,email,rol,perfil              
from usuarios, users, roles, usuarioporproyecto, gerentesdeproyecto
 where estado='Activo' and idUsuario=usuarioAsignado and proyectoAsignado=idProject and identificacion=idLogin and rolesId=idRoles and idGerente=idUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ListarIdRoles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ListarIdRoles`()
BEGIN
SELECT idRoles FROM productivitymanager.roles;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ListarPermisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ListarPermisos`()
BEGIN
SELECT idpermisos, nombreRuta FROM productivitymanager.permisos ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ListarRoles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ListarRoles`()
BEGIN
SELECT * FROM roles where idRoles!=4 and idRoles!=0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ModificarRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ModificarRol`(IdRol int)
BEGIN
delete  FROM productivitymanager.permisosporrol where idRoles_Roles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `obtenerId`(IdRol int)
BEGIN
SELECT idRoles FROM roles where idRoles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerNombreRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `obtenerNombreRol`(IdRol int)
BEGIN
select rol from roles where idRoles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerPermisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `obtenerPermisos`(IdRol int)
BEGIN
select * from permisosporrol where Roles_idRoles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerPermisosPorRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `obtenerPermisosPorRol`(IdRol int)
BEGIN
SELECT permisos_idpermisos permisos FROM productivitymanager.permisosporrol where idRoles_Roles=(IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ProgresoProyectos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `ProgresoProyectos`()
BEGIN
select nombreProyecto, ejecutado, fechaFin from proyectos order by fechaFin asc limit 6;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RegistrarPermisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `RegistrarPermisos`(Permiso int, IdRol int)
BEGIN
insert into permisosporrol values (Permiso,IdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RegistrarRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `RegistrarRol`( idRol int, nombreRol varchar (45) )
BEGIN

INSERT INTO roles VALUES(idRol,nombreRol );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `registrarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `registrarUsuario`(doc bigint(10), nombre varchar(45),apellido varchar(45),direccion varchar(45),telefono bigint(12),fecha date,email varchar(45),estado varchar(45),foto varchar(95),area int)
BEGIN 
 DECLARE EXIT HANDLER FOR 1062 SELECT 'Este Usuario Ya Esta Registrado';
 DECLARE EXIT HANDLER FOR SQLEXCEPTION SELECT 'Error';
 DECLARE EXIT HANDLER FOR SQLSTATE '23000' SELECT 'Error';

INSERT INTO `productivitymanager`.`personas` (`idUsuario`, `identificacion`, `nombres`, `apellidos`, `direccion`, `telefono`, `fechaNacimiento`, `email`, `estado`, `foto`, `areas_idAreas`)
 VALUES (default, doc, nombre, apellido, direccion, telefono, fecha, email, estado, foto, area);

select('true');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `seguridadPaginas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `seguridadPaginas`(nameRol varchar(25))
BEGIN
select url from permisos, permisosporrol, roles where idpermisos= permisos_idPermisos
 and idRoles_Roles = idRoles and rol=nameRol and URL<>'';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UsuarioEnSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `UsuarioEnSesion`(Logueo int)
BEGIN
select idUsuario from personas, usuarios
where identificacion = idLogin and idLogin=Logueo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `verFoto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`Gerente`@`localhost` PROCEDURE `verFoto`(idLogueo int)
BEGIN
select foto from personas, usuarios where identificacion = idLogin and idLogin = idLogueo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-06 21:30:29
