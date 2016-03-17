CREATE DATABASE IF NOT EXISTS pqrs;

USE pqrs;

DROP TABLE IF EXISTS areas;

CREATE TABLE `areas` (
  `idArea` int(11) NOT NULL,
  `NombreArea` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO areas VALUES("1","Gestión Humana","","","","");
INSERT INTO areas VALUES("2","Operaciones","","","","");
INSERT INTO areas VALUES("3","Programación","","","","");
INSERT INTO areas VALUES("4","Seguridad Vial","","","","");



DROP TABLE IF EXISTS mediorecepcion;

CREATE TABLE `mediorecepcion` (
  `idMedio` int(11) NOT NULL,
  `Medio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMedio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO mediorecepcion VALUES("1","Pagina web","","","","");
INSERT INTO mediorecepcion VALUES("2","Telefono","","","","");
INSERT INTO mediorecepcion VALUES("3","Email","","","","");
INSERT INTO mediorecepcion VALUES("4","Redes sociales","","","","");



DROP TABLE IF EXISTS motivospqr;

CREATE TABLE `motivospqr` (
  `idMotivo` int(11) NOT NULL,
  `MotivoPQR` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO motivospqr VALUES("1","Servicio","","","","");
INSERT INTO motivospqr VALUES("2","Aseo","","","","");
INSERT INTO motivospqr VALUES("3","Desconocimiento de ruta","","","","");



DROP TABLE IF EXISTS personas;

CREATE TABLE `personas` (
  `Cedula` int(11) NOT NULL,
  `Nombres` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Telefono` varchar(8) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO personas VALUES("103059","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030442","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("10305906","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("80745406","Jose","Guzman","jii@j.com","9809890","12342344");
INSERT INTO personas VALUES("1030590690","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030590691","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030590692","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030590693","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030590694","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");
INSERT INTO personas VALUES("1030590695","Jorge","Izquierdo","jmin1030@hotmail.com","3106775824","7643462");



DROP TABLE IF EXISTS pqr;

CREATE TABLE `pqr` (
  `idPQR` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Evidencia` varchar(45) DEFAULT NULL,
  `Estado` enum('Radicada','Asignada','Cerrada') DEFAULT NULL,
  `Personas_Cedula` int(11) NOT NULL,
  `Areas_idArea` int(11) NOT NULL,
  `MotivosPQR_idMotivo` int(11) NOT NULL,
  `MedioRecepcion_idMedio` int(11) NOT NULL,
  `TiposPQR_idTipos` int(11) NOT NULL,
  `Solucion` varchar(2000) DEFAULT NULL,
  `FechaSolucion` datetime DEFAULT NULL,
  PRIMARY KEY (`idPQR`),
  KEY `fk_PQR_Personas_idx` (`Personas_Cedula`),
  KEY `fk_PQR_Areas1_idx` (`Areas_idArea`),
  KEY `fk_PQR_MotivosPQR1_idx` (`MotivosPQR_idMotivo`),
  KEY `fk_PQR_MedioRecepcion1_idx` (`MedioRecepcion_idMedio`),
  KEY `fk_PQR_TiposPQR1_idx` (`TiposPQR_idTipos`),
  CONSTRAINT `fk_PQR_Areas1` FOREIGN KEY (`Areas_idArea`) REFERENCES `areas` (`idArea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PQR_MedioRecepcion1` FOREIGN KEY (`MedioRecepcion_idMedio`) REFERENCES `mediorecepcion` (`idMedio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PQR_MotivosPQR1` FOREIGN KEY (`MotivosPQR_idMotivo`) REFERENCES `motivospqr` (`idMotivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PQR_Personas` FOREIGN KEY (`Personas_Cedula`) REFERENCES `personas` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PQR_TiposPQR1` FOREIGN KEY (`TiposPQR_idTipos`) REFERENCES `tipospqr` (`idTipos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO pqr VALUES("7","2016-01-12 00:00:00","test","","Cerrada","1030590693");
INSERT INTO pqr VALUES("8","0000-00-00 00:00:00","test estado","Image.png","Asignada","1030590693");
INSERT INTO pqr VALUES("9","2016-03-14 03:22:30","test fecha","perfil.png","Cerrada","1030590693");
INSERT INTO pqr VALUES("10","2016-03-14 04:50:48","test ","Image.png","Cerrada","1030590693");



DROP TABLE IF EXISTS tipospqr;

CREATE TABLE `tipospqr` (
  `idTipos` int(11) NOT NULL,
  `TiposPQR` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tipospqr VALUES("1","Petición","","","","");
INSERT INTO tipospqr VALUES("2","Queja","","","","");
INSERT INTO tipospqr VALUES("3","Reclamo","","","","");



