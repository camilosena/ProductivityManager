DROP TABLE IF EXISTS areas;
CREATE TABLE `areas` (
  `idAreas` int(11) NOT NULL DEFAULT '0',
  `nombreArea` varchar(45) DEFAULT NULL,
  `roles_idRoles` int(11) NOT NULL,
  PRIMARY KEY (`idAreas`,`roles_idRoles`),
  KEY `fk_areas_roles1_idx` (`roles_idRoles`),
  CONSTRAINT `fk_areas_roles1` FOREIGN KEY (`roles_idRoles`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO areas VALUES ("0","default","0");
INSERT INTO areas VALUES ("1","Administracion","1");
INSERT INTO areas VALUES ("2","Privado","1");
INSERT INTO areas VALUES ("3","Corte","3");
INSERT INTO areas VALUES ("4","Ensamble","3");
INSERT INTO areas VALUES ("6","Cliente","4");
