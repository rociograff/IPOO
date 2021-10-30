--
-- Estructura de tabla para la tabla `teatro`
--
create table if not exists `teatro`(
  `idTeatro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL, 
  `direccion` varchar(100) NOT NULL,
  PRIMARY KEY(idTeatro)
);

--
-- Estructura de tabla para la tabla `funcion`
--
CREATE TABLE IF NOT EXISTS `funcion` (
  `idFuncion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `horarioInicio` int(10) NOT NULL,
  `duracion` int(10) NOT NULL,
  `precio` double(12,2) NOT NULL,
  `costoSala` double(12,2) NOT NULL,
  `fecha` date NOT NULL,
  `idTeatro` int(11) NOT NULL,
  PRIMARY KEY(`idFuncion`),
  FOREIGN KEY(`idTeatro`) REFERENCES `teatro`(`idTeatro`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `obra_teatral`
--
CREATE TABLE IF NOT EXISTS `obra` (
  `idFuncion` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idFuncion`),
  FOREIGN KEY (`idFuncion`) REFERENCES `funcion` (`idFuncion`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `musical`
--
CREATE TABLE IF NOT EXISTS `musical` (
  `idFuncion` int(11) NOT NULL AUTO_INCREMENT,
  `director` varchar(150) NOT NULL,
  `personasEnEscena` int(10) NOT NULL,
  PRIMARY KEY (`idFuncion`),
  FOREIGN KEY (`idFuncion`) REFERENCES `funcion` (`idFuncion`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `cine`
--
CREATE TABLE IF NOT EXISTS `cine` (
  `idFuncion` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(150) NOT NULL,
  `paisOrigen` varchar(150) NOT NULL,
  PRIMARY KEY (`idFuncion`),
  FOREIGN KEY (`idFuncion`) REFERENCES `funcion` (`idFuncion`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;