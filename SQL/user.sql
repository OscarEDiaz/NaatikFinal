-- Creación de la base de datos
CREATE Database Naatik;

-- Creación de la tabla Usuario
CREATE TABLE IF NOT EXISTS `Naatik_User` (
  `idUser` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `adminprivs` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `Naatik_User` VALUES
(1, 'test@gmail.com', 'test123', 1);
