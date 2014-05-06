-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2014 a las 15:43:35
-- Versión del servidor: 5.5.35
-- Versión de PHP: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Fd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoridad`
--

CREATE TABLE IF NOT EXISTS `autoridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_autoridad_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) NOT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `te_particular` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14FFC077418D0677` (`cargo_autoridad_id`),
  KEY `IDX_14FFC07771B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `autoridad`
--

INSERT INTO `autoridad` (`id`, `cargo_autoridad_id`, `establecimiento_id`, `nombre`, `apellido`, `actualizado`, `creado`, `celular`, `email`, `te_particular`) VALUES
(1, 11, 13, 'Marcela', 'PELANDA', '2014-02-20 13:46:48', '0000-00-00 00:00:00', '15-6666-5555', NULL, NULL),
(2, 11, 23, 'Viviana ', 'KAÑEVSKY', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(3, 11, 26, 'Horacio A. ', 'BADARACCO', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(4, 11, 31, 'Lic. Victor Carlos', 'BLOISE', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(5, 12, 31, 'Lic. Virginia Ana', 'MONASTERIO', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(6, 12, 31, 'Prof. Andrea López', 'ALBARELLOS', '2014-02-24 15:04:31', '0000-00-00 00:00:00', NULL, 'a@a.com', NULL),
(7, 12, 31, 'Prof. Francisco Hugo', 'Guinguis', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(8, 12, 31, 'Prof. Gustavo Mario', 'PRAVETTONI', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(9, 9, 13, 'María Graciela', 'CHEMELLO', '2014-02-20 13:15:22', '2014-02-20 13:14:53', NULL, NULL, NULL),
(10, 11, 17, 'Gustavo', 'OTERO', '2014-03-07 10:51:51', '2014-03-07 10:51:51', NULL, NULL, NULL),
(11, 11, 30, 'Maritza', 'SAGO', '2014-03-07 10:53:26', '2014-03-07 10:53:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bachillerato`
--

CREATE TABLE IF NOT EXISTS `bachillerato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `ciclo_basico` varchar(255) DEFAULT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_40A642E915CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `bachillerato`
--

INSERT INTO `bachillerato` (`id`, `nombre`, `titulo`, `ciclo_basico`, `duracion`, `oferta_educativa_id`) VALUES
(1, 'Bachillerato de prueba', 'Bachiller', 'si', '5', 14),
(2, 'Bachiller broquen', 'Bachiller', 's', '4', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE IF NOT EXISTS `barrio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`id`, `nombre`, `abreviatura`, `created`, `updated`) VALUES
(29, 'Palermo', 'PAL', NULL, NULL),
(30, 'Almagro', 'ALM', NULL, NULL),
(31, 'Flores', 'FLO', NULL, NULL),
(32, 'Villa Urquiza', 'URQ', NULL, NULL),
(33, 'Balvanera', 'BVN', NULL, NULL),
(34, 'Villa Lugano', 'VLG', NULL, NULL),
(35, 'Belgrano', 'BGN', NULL, NULL),
(38, 'Boedo', 'BOE', NULL, NULL),
(39, 'Agronomía', 'AGR', NULL, NULL),
(40, 'Barracas', 'BAR', NULL, NULL),
(41, 'Caballito', 'CBL', NULL, NULL),
(42, 'Chacarita', 'CHA', NULL, NULL),
(43, 'Coghlan', 'CHG', NULL, NULL),
(44, 'Colegiales', 'COL', NULL, NULL),
(45, 'Constitución', 'CTT', NULL, NULL),
(46, 'Floresta', 'FRT', NULL, NULL),
(47, 'La Boca', 'BOC', NULL, NULL),
(48, 'La Paternal', 'PAT', NULL, NULL),
(49, 'Liniers', 'LIN', NULL, NULL),
(50, 'Mataderos', 'MAT', NULL, NULL),
(51, 'Monte Castro', 'MCA', NULL, NULL),
(52, 'Monserrat', 'MON', NULL, NULL),
(53, 'Nueva Pompeya', 'POM', NULL, NULL),
(54, 'Núñez', 'NUÑ', NULL, NULL),
(55, 'Parque Avellaneda', 'AVE', NULL, NULL),
(56, 'Parque Chacabuco', 'CHA', NULL, NULL),
(57, 'Parque Chas', 'CHS', NULL, NULL),
(58, 'Parque Patricios', 'PPA', NULL, NULL),
(59, 'Puerto Madero', 'PMA', NULL, NULL),
(60, 'Recoleta', 'REC', NULL, NULL),
(61, 'Retiro', 'RET', NULL, NULL),
(62, 'Saavedra', 'SAA', NULL, NULL),
(63, 'San Cristóbal', 'SCR', NULL, NULL),
(64, 'San Nicolás', 'SIN', NULL, NULL),
(65, 'San Telmo', 'STE', NULL, NULL),
(66, 'Vélez Sársfield', 'VSA', NULL, NULL),
(67, 'Versalles', 'VER', NULL, NULL),
(68, 'Villa Crespo', 'VCR', NULL, NULL),
(69, 'Villa del Parque', 'VDP', NULL, NULL),
(70, 'Villa Devoto', 'VDV', NULL, NULL),
(71, 'Villa General Mitre', 'VGM', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_autoridad`
--

CREATE TABLE IF NOT EXISTS `cargo_autoridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `cargo_autoridad`
--

INSERT INTO `cargo_autoridad` (`id`, `nombre`, `abreviatura`) VALUES
(7, 'Regente de Primaria', 'RNP'),
(9, 'Regente Terciario', 'RNT'),
(11, 'Rector/a', 'Rec'),
(12, 'Vicerrector/a', 'Vicer'),
(13, 'Director/a de Media', 'DNM'),
(14, 'Director/a de Inicial', 'DNI'),
(15, 'Vicedirector de Inicial', 'VNI'),
(16, 'Maestro Secretario de Inicial', 'MSNI'),
(17, 'Subregente de Primaria', 'SRNP'),
(18, 'Maestro Secretario de Primaria', 'MSNP'),
(19, 'Consejero de Terciario', 'CON'),
(20, 'Secreatrio de Terciario', 'SECNT'),
(21, 'Prosecretario de Terciario', 'PRONT'),
(22, 'Tutor de Terciario', 'TUNT'),
(23, 'Coordinador de Área', 'COONT'),
(24, 'Vicedirector de Media', 'VDNM'),
(25, 'Coordinador de Área de Media', 'COONM'),
(26, 'Consejero de Media', 'CONNM'),
(27, 'tutor de Media', 'TUNM'),
(28, 'Coordinador de tutores de Media', 'COOTM'),
(29, 'Prosecretario de Media', 'PRONM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `formacion_id` int(11) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF1ECD3015CE31DF` (`oferta_educativa_id`),
  KEY `IDX_CF1ECD30F0798A6E` (`formacion_id`),
  KEY `IDX_CF1ECD309F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `duracion`, `formacion_id`, `oferta_educativa_id`, `estado_id`, `actualizado`, `creado`) VALUES
(1, 'Profesorado de Educación Primaria', '4 años', 1, 13, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Tecnicatura Superior en Producción de Indumentaria', NULL, 2, 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Tecnicatura Superior en Gastronomía', NULL, 2, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Profesorado de Educación Inicial', NULL, 1, 7, 1, '2014-02-18 15:07:32', '0000-00-00 00:00:00'),
(9, 'Profesorado de Inglés para el Nivel Inicial y Nivel Primario', 'sbs', 1, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Profesorado de Inglés para Nivel Medio y Superior', 'jrf', 1, 9, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Profesorado de Portugués para el Nivel Inicial y Nivel Primario', NULL, 1, 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Profesorado de Portugués', NULL, 1, 11, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Traductorado Técnico-Científico-Literario en idioma Inglés', NULL, 2, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Traductorado en Alemán', NULL, 2, 16, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Traductorado en Inglés', NULL, 2, 17, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Profesorado de Filosofía', 'ies1', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Traductorado en Francés', NULL, 2, 18, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Traductorado en Portugués', NULL, 2, 19, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Profesorado en Inglés', NULL, 1, 20, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Profesorado en Inglés para Nivel Inicial y Primario', 'jrf', 1, 21, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Profesorado en Francés', 'jrf', 1, 25, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Profesorado en Francés para Nivel Inicial y Primario', 'jrf', 1, 23, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Profesorado de Lengua y Literatura', 'ies1', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Profesorado de Psicología', 'ies1', 1, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Ciclo de Formación Pedagógica para Profesionales y Técnicos Superiores', '4', 1, 41, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Profesorado de Alemán', NULL, 1, 42, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Profesorado en Portugués para nivel Inicial y Primario EGB 1 y 2', NULL, 1, 43, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Profesorado de Portugués', NULL, 1, 44, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Profesorado en Alemán para Nivel Inicial y Primario', NULL, 1, 45, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Profesorado de Historia', NULL, 1, 46, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Profesorado de Matemática', NULL, 1, 47, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Profesorado de Física', NULL, 1, 48, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Psicopedagogía', NULL, 1, 49, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Profesorado de Educación Física', NULL, 1, 50, 1, '2014-02-18 17:01:50', '0000-00-00 00:00:00'),
(43, 'Profesorado de Educación Física', NULL, 1, 51, 1, '2014-02-18 17:02:05', '0000-00-00 00:00:00'),
(44, 'Profesorado de Educación Especial', NULL, 1, 52, 1, '2014-02-18 17:00:55', '0000-00-00 00:00:00'),
(45, 'Profesorado de Matemática', NULL, 1, 53, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Profesorado de Física', NULL, 1, 54, 1, '2014-02-18 17:03:01', '0000-00-00 00:00:00'),
(47, 'Profesorado de Lengua y Literatura', NULL, 1, 55, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Profesorado de Educación Tecnológica', NULL, 1, 56, 1, '2014-02-18 17:02:46', '0000-00-00 00:00:00'),
(49, 'Profesorado de Educación Secundaria de la modalidad Técnico Profesional en concurrencia con título de base', NULL, 1, 57, 1, '2014-02-18 17:02:31', '0000-00-00 00:00:00'),
(50, 'Profesorado en Ciencias de la Administración', NULL, 1, 58, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Profesorado de Ciencias Políticas con Orientación en Ciencias Jurídicas', NULL, 1, 59, 1, '2014-02-18 17:00:18', '0000-00-00 00:00:00'),
(52, 'Profesorado en Psicología', NULL, 1, 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Profesorado de Lengua y Literatura', NULL, 1, 61, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Profesorado de Biologia', '3', 1, 62, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Profesorado en Economía', NULL, 1, 63, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Profesorado en Filosofìa', NULL, 1, 64, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Profesorado de Física', NULL, 1, 65, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Profesorado en Francés', NULL, 1, 66, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Profesorado de Geografía', NULL, 1, 67, 1, '2014-02-18 17:03:35', '0000-00-00 00:00:00'),
(60, 'Profesorado de Historia', NULL, 1, 68, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Profesorado en Inglés', NULL, 1, 69, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Profesorado en Ciencias Jurídicas', NULL, 1, 70, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Profesorado de Química', NULL, 1, 71, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Profesorado en Italiano', NULL, 1, 72, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Profesorado en Matemática', NULL, 1, 73, 2, '2014-02-06 12:52:48', '0000-00-00 00:00:00'),
(66, 'Profesorado en Ciencias de la Educación', NULL, 1, 74, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Profesorado en Ciencias Políticas', NULL, 1, 75, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Profesorado de Informática', NULL, 1, 76, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Profesorado en Inglés para el Nivel Inicial y Primario', NULL, 1, 77, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Profesorado en Italiano', NULL, 1, 78, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera_estado_validez`
--

CREATE TABLE IF NOT EXISTS `carrera_estado_validez` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `estado_validez_id` int(11) DEFAULT NULL,
  `fecha_estado_validez` date DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77A76A52C22C346` (`estado_validez_id`),
  KEY `IDX_77A76A5C671B40F` (`carrera_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `carrera_estado_validez`
--

INSERT INTO `carrera_estado_validez` (`id`, `carrera_id`, `estado_validez_id`, `fecha_estado_validez`, `createdAt`) VALUES
(13, 42, 6, '2010-10-11', '2013-06-17 16:13:02'),
(14, 42, 10, '2010-10-12', '2013-06-17 16:13:22'),
(15, 42, 11, '2010-10-14', '2013-06-17 16:13:39'),
(16, 42, 3, '2010-10-15', '2013-06-17 16:14:47'),
(17, 42, 4, '2010-10-15', '2013-06-17 16:16:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cgp`
--

CREATE TABLE IF NOT EXISTS `cgp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF692037F55AE19E` (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Volcado de datos para la tabla `cgp`
--

INSERT INTO `cgp` (`id`, `numero`) VALUES
(113, '1'),
(122, '10'),
(123, '11'),
(124, '12'),
(125, '13'),
(126, '14'),
(127, '15'),
(128, '16'),
(114, '2'),
(115, '3'),
(116, '4'),
(117, '5'),
(118, '6'),
(119, '7'),
(120, '8'),
(121, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cohorte`
--

CREATE TABLE IF NOT EXISTS `cohorte` (
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
  `matricula` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35697A4BD1F42FF` (`unidad_oferta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `cohorte`
--

INSERT INTO `cohorte` (`id`, `unidad_oferta_id`, `anio`, `matricula_ingresantes`, `matricula_inicial`, `matricula_final`, `egreso`, `createdAt`, `actualizado`, `creado`, `matricula`) VALUES
(20, 9, 2013, 76, NULL, NULL, 10, '2014-02-28 16:30:33', '2014-02-28 16:30:33', '2014-02-28 16:30:33', 224),
(21, 10, 2013, 66, NULL, NULL, 7, '2014-02-28 16:31:25', '2014-02-28 16:31:32', '2014-02-28 16:31:25', 151),
(22, 2, 2014, 1, NULL, NULL, 2, '2014-03-05 14:21:53', '2014-03-05 14:21:53', '2014-03-05 14:21:53', 151),
(23, 2, 2009, 2, NULL, NULL, 4, '2014-03-05 14:22:15', '2014-03-05 14:22:15', '2014-03-05 14:22:15', 23),
(24, 2, 2012, 22, NULL, NULL, 11, '2014-03-05 14:22:30', '2014-03-05 14:22:30', '2014-03-05 14:22:30', 55),
(25, 9, 2014, 10, NULL, NULL, 10, '2014-03-05 15:38:58', '2014-03-05 15:38:58', '2014-03-05 15:38:58', 10),
(26, 2, 2013, 20, NULL, NULL, 20, '2014-03-05 15:40:20', '2014-03-05 15:40:20', '2014-03-05 15:40:20', 20),
(27, 10, 2014, 80, NULL, NULL, 80, '2014-03-05 15:41:53', '2014-03-05 15:41:53', '2014-03-05 15:41:53', 80),
(28, 3, 2014, 15, NULL, NULL, 15, '2014-03-05 15:42:22', '2014-03-05 15:42:23', '2014-03-05 15:42:22', 15),
(29, 3, 2013, 20, NULL, NULL, 20, '2014-03-05 15:43:04', '2014-03-05 15:43:04', '2014-03-05 15:43:04', 20),
(30, 3, 2012, 72, NULL, NULL, 72, '2014-03-05 17:18:31', '2014-03-05 17:18:31', '2014-03-05 17:18:31', 72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE IF NOT EXISTS `comuna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id`, `numero`) VALUES
(113, 1),
(114, 2),
(115, 3),
(116, 4),
(117, 5),
(118, 6),
(119, 7),
(120, 8),
(121, 9),
(122, 10),
(123, 11),
(124, 12),
(125, 13),
(126, 14),
(127, 15),
(128, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE IF NOT EXISTS `dia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(15) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(36, 'DOM', 'Domingo', 1),
(37, 'LUN', 'Lunes', 2),
(38, 'MAR', 'Martes', 3),
(39, 'MIE', 'Miércoles', 4),
(40, 'JUE', 'Jueves', 5),
(41, 'VIE', 'Viernes', 6),
(42, 'SAB', 'Sábado', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito_escolar`
--

CREATE TABLE IF NOT EXISTS `distrito_escolar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- Volcado de datos para la tabla `distrito_escolar`
--

INSERT INTO `distrito_escolar` (`id`, `numero`, `nombre`) VALUES
(148, 1, '1'),
(149, 2, '2'),
(150, 3, '3'),
(151, 4, '4'),
(152, 5, '5'),
(153, 6, '6'),
(154, 7, '7'),
(155, 8, '8'),
(156, 9, '9'),
(157, 10, '10'),
(158, 11, '11'),
(159, 12, '12'),
(160, 13, '13'),
(161, 14, '14'),
(162, 15, '15'),
(163, 16, '16'),
(164, 17, '17'),
(165, 18, '18'),
(166, 19, '19'),
(167, 20, '20'),
(168, 21, '21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE IF NOT EXISTS `domicilio` (
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
  KEY `IDX_9B942ED18A652BD6` (`edificio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id`, `edificio_id`, `calle`, `altura`, `piso`, `departamento`, `referencia`, `principal`, `c_postal`, `actualizado`, `creado`) VALUES
(19, 19, 'Córdoba, Av.', '1950', NULL, NULL, NULL, 1, 'C1120AA', '2014-02-25 14:10:11', '0000-00-00 00:00:00'),
(20, 20, 'La Rioja', '1042', NULL, NULL, NULL, 1, '1181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 21, 'Carlos Calvo', '3150', NULL, NULL, NULL, 1, '1181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 22, 'Gral Urquiza', '277', NULL, NULL, NULL, 1, 'C1215AD', '2014-02-21 10:29:31', '0000-00-00 00:00:00'),
(23, 22, 'Moreno', '3111', NULL, NULL, NULL, 0, 'C1215AD', '2014-02-21 10:29:31', '0000-00-00 00:00:00'),
(24, 23, 'Bolívar', '1235', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 24, 'Saraza', '4241', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 25, 'Rivadavia, Av.', '4950', NULL, NULL, NULL, 1, 'C1424CE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 26, 'Arcamendia', '743', NULL, NULL, NULL, 1, 'C1274AA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 27, 'Suárez', '2103', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 40, 'Ayacucho', '632', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 41, 'Curapaligüe', '1150', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 42, 'Guemes', '3859', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 43, 'Corrientes, Av.', '4261', NULL, NULL, NULL, 1, 'C1195AA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 44, 'Callao, Av.', '450', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 45, 'Humahuaca', '4260', NULL, NULL, NULL, 1, 'C1195AA', '2014-02-27 19:07:16', '0000-00-00 00:00:00'),
(36, 46, 'O Higgins', '2441', NULL, NULL, NULL, 1, 'C1428AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 47, '3 de Febrero', '2300', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 48, 'Dean Funes', '1821', NULL, NULL, NULL, 1, 'C1244AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 51, 'Juncal', '3251', NULL, NULL, NULL, 1, 'C1425AYQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 53, 'Lascano', '3840 ', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 54, 'C. Pellegrini', '1515', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 55, 'Dorrego', '3781 ', NULL, NULL, NULL, 1, 'C1425GBB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 52, 'Córdoba, Av.', '2016', NULL, NULL, NULL, 1, 'C1120AAP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 57, 'Miguel Sanchéz', '1339', NULL, NULL, NULL, 1, 'C1429BSN', '2014-02-27 19:25:50', '0000-00-00 00:00:00'),
(49, 56, 'Paraguay', '3925', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 19, 'Ayacucho', '875', NULL, NULL, NULL, 0, '1425', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 58, 'AAA no la sabemos', '99', NULL, NULL, NULL, 1, '1181', '2014-02-28 17:00:52', '2014-02-28 17:00:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio_localizacion`
--

CREATE TABLE IF NOT EXISTS `domicilio_localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domicilio_id` int(11) DEFAULT NULL,
  `localizacion_id` int(11) DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DABAA005166FC4DD` (`domicilio_id`),
  KEY `IDX_DABAA005C851F487` (`localizacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Volcado de datos para la tabla `domicilio_localizacion`
--

INSERT INTO `domicilio_localizacion` (`id`, `domicilio_id`, `localizacion_id`, `principal`, `actualizado`, `creado`) VALUES
(36, 19, 36, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 19, 38, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 19, 37, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 19, 39, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 20, 41, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 20, 42, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 21, 40, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 23, 43, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 23, 44, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 23, 45, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 26, 46, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 26, 47, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 26, 48, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 26, 49, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 27, 50, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 27, 51, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 27, 52, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 28, 53, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 33, 54, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 33, 55, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 35, 56, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 33, 57, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 36, 58, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 36, 59, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 36, 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 36, 61, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 40, 62, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 40, 64, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 40, 65, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 40, 66, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 41, 67, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 41, 68, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 41, 69, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 41, 70, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 45, 71, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 42, 72, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 42, 73, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 42, 74, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 42, 75, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 43, 76, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 43, 77, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 43, 78, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 44, 79, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 44, 80, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 32, 82, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 49, 81, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 46, 83, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 30, 84, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 24, 85, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 25, 88, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 50, 37, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 51, 95, 1, '2014-02-28 17:04:57', '2014-02-28 17:04:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duracion`
--

CREATE TABLE IF NOT EXISTS `duracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(1) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `duracion`
--

INSERT INTO `duracion` (`id`, `codigo`, `descripcion`) VALUES
(15, 'C', 'Cuatrimestral'),
(16, 'A', 'Anual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE IF NOT EXISTS `edificio` (
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
  KEY `IDX_DED4A4E862E97D21` (`distrito_escolar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id`, `comuna_id`, `cgp_id`, `barrio_id`, `distrito_escolar_id`, `cui`, `superficie`, `updatedAt`, `createdAt`) VALUES
(19, 113, 113, 29, 148, 12, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 115, 116, 30, 153, 12344, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 115, 116, 30, 153, 123666, 255, '2012-11-05 15:45:16', '0000-00-00 00:00:00'),
(22, 115, 113, 33, 153, 555555, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 113, 113, 33, 151, 333333, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 120, 113, 34, 168, 333301, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 118, 113, 41, 155, 4444, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 116, 113, 40, 152, 5555, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 116, 113, 40, 152, 5552, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 115, 113, 33, 149, 3, 3, NULL, '2012-11-09 16:25:54'),
(41, 119, 113, 56, 166, 4333, 4333, NULL, '2012-11-09 17:03:33'),
(42, 126, 113, 29, 149, 6666666, 66666, NULL, '2012-11-09 17:09:11'),
(43, 117, 113, 29, 149, 777777, 777777, NULL, '2012-11-09 17:11:33'),
(44, 115, 113, 29, 148, 9999999, 99999, NULL, '2012-11-09 17:13:30'),
(45, 113, 113, 29, 149, 757575, 757575, NULL, '2012-11-09 17:15:17'),
(46, 125, 113, 35, 157, 1010, 1010, NULL, '2012-11-12 13:28:24'),
(47, 113, 113, 35, 149, 1003, 5000, NULL, '2012-11-12 14:37:10'),
(48, 116, 113, 55, 153, 11, 11, NULL, '2012-11-12 15:11:51'),
(51, 126, 113, 55, 148, 44, 44, '2012-11-12 15:29:39', '2012-11-12 15:29:39'),
(52, 115, 113, 52, 148, 111111, 111111, NULL, '2012-11-12 15:44:23'),
(53, 123, 114, 29, 164, 222, 222, '2012-11-12 15:51:40', '2012-11-12 15:51:40'),
(54, 113, 113, 29, 148, 55, 55, '2012-11-12 16:02:19', '2012-11-12 16:02:19'),
(55, 126, 113, 35, 156, 8888, 8888, '2012-11-12 16:27:54', '2012-11-12 16:27:54'),
(56, 113, 113, 29, 149, 6565, NULL, NULL, '2012-11-12 16:33:34'),
(57, 125, 113, 54, 157, 9911, 9911, '2012-11-12 16:46:58', '2012-11-12 16:46:58'),
(58, 113, 113, 34, 166, 963, NULL, NULL, '2014-02-28 17:00:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializacion`
--

CREATE TABLE IF NOT EXISTS `especializacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera` varchar(255) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_especializacion_id` int(11) DEFAULT NULL,
  `ultima_cohorte_valida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_24C61C0415CE31DF` (`oferta_educativa_id`),
  KEY `IDX_24C61C049F5A440B` (`estado_id`),
  KEY `IDX_24C61C046CBBC6BF` (`tipo_especializacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `especializacion`
--

INSERT INTO `especializacion` (`id`, `carrera`, `oferta_educativa_id`, `titulo`, `nombre`, `duracion`, `estado_id`, `tipo_especializacion_id`, `ultima_cohorte_valida`) VALUES
(1, NULL, 27, NULL, 'Especialización Superior en Políticas de Infancia', NULL, 2, 5, NULL),
(2, NULL, 28, NULL, 'Especialización Superior en Jardín Maternal', NULL, 1, 5, 2018),
(3, NULL, 29, NULL, 'Especialización Superior en Estimulación Temprana', NULL, 1, NULL, NULL),
(4, NULL, 30, NULL, 'Especialización Superior en Informática Educativa', NULL, 1, NULL, NULL),
(5, NULL, 31, NULL, 'Especialización Superior en Profesor Tutor', NULL, 1, NULL, NULL),
(6, NULL, 32, NULL, 'Especialización Superior en Conducción de Instituciones de Nivel Medio y Equivalente', NULL, 1, NULL, NULL),
(7, NULL, 33, NULL, 'Especialización Superior en Investigación Educativa', NULL, 1, NULL, NULL),
(8, NULL, 34, NULL, 'Diplomatura Superior en Ciencias del Lenguaje', NULL, 1, 3, 2009),
(10, NULL, 35, NULL, 'Especialización Superior en Educación Sexual', NULL, 1, NULL, NULL),
(11, NULL, 36, NULL, 'Diplomatura Superior en Matemática Educativa', NULL, 1, NULL, NULL),
(12, NULL, 37, NULL, 'Interculturalidad y Enseñanza del Español como Lengua Segunda\r y Extranjera', NULL, 1, NULL, NULL),
(13, NULL, 38, NULL, 'Actualización Académica en Educación Ambiental', NULL, 2, NULL, 2008),
(14, NULL, 39, NULL, 'Especialización Docente de Nivel Superior en Educación en Contextos de Encierro', NULL, 1, NULL, NULL),
(15, NULL, 40, NULL, 'Especialización en Enseñanza de la Astronomía para la Educación Primaria', NULL, 1, NULL, NULL),
(16, NULL, 82, 'Prácticas corporales y motrices conscientes desde un enfoque interdisciplinario', 'Diplomatura Superior en Prácticas corporales y motrices conscientes desde un enfoque interdisciplinario', '2 años', 1, NULL, NULL),
(17, NULL, 83, 'La narrativa en la obra escrita a través de los canales expresivos audiovisuales', 'La narrativa en la obra escrita a través de los canales expresivos audiovisuales', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE IF NOT EXISTS `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito_escolar_id` int(11) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `cue` varchar(7) DEFAULT NULL,
  `codigo_previo_transferencia` varchar(7) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `descripcion` varchar(15) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `tiene_cooperadora` varchar(2) DEFAULT NULL,
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
  `fecha_presentacion_roi` date DEFAULT NULL,
  `fecha_aprobacion_roi` date DEFAULT NULL,
  `fecha_elecciones` date DEFAULT NULL,
  `fin_mandato` date DEFAULT NULL,
  `fecha_presentacion_ram` date DEFAULT NULL,
  `fecha_aprobacion_ram` date DEFAULT NULL,
  `fecha_presentacion_rp` date DEFAULT NULL,
  `fecha_aprobacion_rp` date DEFAULT NULL,
  `anio_inicio_nes` int(11) DEFAULT NULL,
  `te` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94A4D17E62E97D21` (`distrito_escolar_id`),
  KEY `IDX_94A4D17EDE95C867` (`sector_id`),
  KEY `IDX_94A4D17EE83582FE` (`tipo_establecimiento_id`),
  KEY `IDX_94A4D17E418D0677` (`cargo_autoridad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `establecimiento`
--

INSERT INTO `establecimiento` (`id`, `distrito_escolar_id`, `sector_id`, `cue`, `codigo_previo_transferencia`, `nombre`, `numero`, `descripcion`, `fecha_creacion`, `tiene_cooperadora`, `url`, `apodo`, `email`, `orden`, `tipo_establecimiento_id`, `nombre_autoridad`, `cargo_autoridad_id`, `campo_deportes`, `actualizado`, `creado`, `fecha_presentacion_roi`, `fecha_aprobacion_roi`, `fecha_elecciones`, `fin_mandato`, `fecha_presentacion_ram`, `fecha_aprobacion_ram`, `fecha_presentacion_rp`, `fecha_aprobacion_rp`, `anio_inicio_nes`, `te`) VALUES
(13, 148, 22, '200696', NULL, 'Escuela Normal Superior Nro 1 Roque Saenz Peña', 1, NULL, '2012-10-29', 'no', 'http://ens1de1.buenosaires.edu.ar', 'ENS 1', 'ens1@bue.edu.ar', 1, 1, 'Marcela Pelanda', 11, NULL, '2014-03-10 16:29:55', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, 2015, NULL),
(14, 153, 22, '201778', '', 'Escuela Normal Superior Nro 8 Julio Argentino Roca', 8, '', '2012-10-29', '0', 'http://ens8de6.buenosaires.edu.ar/ens8.htm', 'ENS 8', 'ens8@bue.edu.ar', 8, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 153, 22, '200866', NULL, 'Escuela Normal Superior Nro 2 Mariano Acosta', 2, NULL, '2009-01-01', '0', NULL, 'ENS 2', 'ens2acosta@bue.edu.ar', 2, 1, NULL, 7, NULL, '2014-02-27 19:46:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 148, 22, '200720', NULL, 'Instituto de Enseñanza Superior Nro 1 Alicia Moreau', 13, NULL, '2009-01-01', '0', NULL, 'Alicia', 'iesamjusto@bue.edu.ar', 13, 3, NULL, NULL, NULL, '2014-02-27 19:11:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 153, 22, '201411', NULL, 'Instituto de Enseñanza Superior Nro 2 Mariano Acosta', 2, NULL, '2009-01-01', '0', NULL, 'IES 2', 'iesacos@yahoo.com.ar', 14, 3, NULL, NULL, NULL, '2014-02-27 20:02:10', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 151, 22, '200536', NULL, 'Escuela Normal Superior Nro 3 Bernardino Rivadavia', 3, NULL, '2009-01-01', '0', NULL, 'ENS 3', 'ens3@bue.edu.ar', 3, 1, NULL, NULL, NULL, '2014-02-27 19:47:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 155, 22, '201297', NULL, 'Escuela Normal Superior Nro 4 Estanislao Severo Zeballos', 4, NULL, NULL, '0', NULL, 'ENS 4', 'ens4@bue.edu.ar', 4, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 152, 22, '201328', NULL, 'Escuela Normal Superior Nro 5 General Don Martín Miguel de Güemes', 5, NULL, '2009-01-01', '0', NULL, 'ENS 5', 'ens5@bue.edu.ar', 5, 1, NULL, 7, NULL, '2014-03-07 15:20:23', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, '4301-9690'),
(21, 149, 22, '200717', NULL, 'Escuela Normal Superior Nro 6 Vicente López y Planes', 6, NULL, NULL, '0', NULL, 'ENS 6', 'ens6@bue.edu.ar', 6, 1, NULL, 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 149, 22, '200997', NULL, 'Escuela Normal Superior Nro 7 José María Torres', 7, NULL, NULL, '0', NULL, 'ENS 7', 'ens7@bue.edu.ar', 7, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 148, 22, '201177', NULL, 'Escuela Normal Superior Nro 9 Domingo Faustino Sarmiento', 9, NULL, NULL, '0', NULL, 'ENS 9', 'ens9secre@yahoo.com.ar', 9, 1, 'Viviana KAÑEVSKY', 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 157, 22, '201214', NULL, 'Escuela Normal Superior Nro 10 Juan Bautista Alberdi', 10, NULL, '2009-01-01', '0', NULL, 'ENS 10', 'ens10@bue.edu.ar', 10, 1, NULL, 11, NULL, '2014-02-14 17:03:41', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 158, 22, '201693', NULL, 'Escuela Normal Superior Nro 11 Ricardo Levene', 11, NULL, NULL, '0', NULL, 'ENS 11', 'ens11@bue.edu.ar', 11, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 148, 22, '200708', NULL, 'Escuela Normal Superior en Lenguas Vivas Sofía E. Broquen de Spangenberg', 12, NULL, NULL, '0', NULL, 'Spangenberg', 'enslvsebs@bue.edu.ar', 12, 1, 'Horacio A. BADARACCO', 11, 'propio en la escuela', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 164, 22, '200895', NULL, 'Instituto de Educación Superior Juan B. Justo', NULL, NULL, NULL, '0', NULL, 'JBJusto', 'jbjusto@bue.edu.ar', 15, 2, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 148, 22, '200584', NULL, 'Instituto de Enseñanza Superior en Lenguas Vivas Juan Ramón Fernández', NULL, NULL, NULL, '0', NULL, 'JRF', 'ieslvjrf@bue.edu.ar', 16, 3, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 148, 22, '201329', NULL, 'Instituto Superior del Profesorado de Educación Inicial Sara C. Eccleston', NULL, NULL, NULL, '0', NULL, 'Eccleston', 'ispei@bue.edu.ar', 17, 4, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 149, 22, '201414', NULL, 'Instituto Superior del Profesorado de Educación Especial', NULL, NULL, NULL, '0', NULL, 'ISPEE', 'ispee@bue.edu.ar', 18, 4, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 157, 22, '201019', NULL, 'Instituto Superior de Educación Física Nro 1 Dr. Enrique Romero Brest', NULL, NULL, NULL, '0', 'http://www.romerobrest.edu.ar/', 'Romero', 'isef1@romerobrest.edu.ar', 19, 5, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 155, 22, '201393', NULL, 'Instituto Superior de Educación Física Federico Williams Dickens', NULL, NULL, NULL, '0', 'http://www.institutodickens.edu.ar/', 'Dickens', 'secretaria@institutodickens.edu.ar', 20, 5, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 148, 22, '201104', NULL, 'Instituto Superior del Profesorado Dr. Joaquín V. González', NULL, NULL, NULL, '0', NULL, 'Joaquín', 'rectoradojvgonzalez@gmail.com', 21, 4, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento_edificio`
--

CREATE TABLE IF NOT EXISTS `establecimiento_edificio` (
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
  KEY `IDX_37D12C65884BAFEF` (`edificios_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `establecimiento_edificio`
--

INSERT INTO `establecimiento_edificio` (`id`, `cue_anexo`, `nombre`, `fecha_creacion`, `fecha_baja`, `te1`, `te2`, `te3`, `email1`, `email2`, `establecimientos_id`, `edificios_id`) VALUES
(16, '00', 'Sede ENS 1', '2012-10-29', NULL, '4444444', '5555', NULL, NULL, NULL, 13, 19),
(17, '00', 'Sede ENS 8', '2012-10-29', NULL, NULL, NULL, NULL, NULL, NULL, 14, 20),
(18, '01', 'Anexo Carlos Calvo', '2012-10-29', NULL, NULL, NULL, NULL, NULL, NULL, 14, 21),
(19, '00', 'Sede ENS 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 22),
(20, '00', 'Sede IES 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 22),
(21, '00', 'sede ENS 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 23),
(22, '01', 'anexo Lugano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 24),
(23, '00', 'sede ens 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, 25),
(24, '00', 'sede ENS 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, 26),
(25, '01', 'anexo ENS 5', '2008-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 20, 27),
(27, '00', 'sede joaquin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, 40),
(28, '00', 'sede ens 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 42),
(29, '00', 'sede ens 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, 43),
(30, '00', 'sede ENS 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, 44),
(31, '01', 'anexo ens 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, 45),
(32, '00', 'sede ens 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 46),
(33, '01', 'anexo ens 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 47),
(34, '00', 'sede ens 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 48),
(35, '00', 'sede spangenberg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 51),
(36, '00', 'sele IES 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 52),
(37, '00', 'sele jbj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, 53),
(38, '00', 'sede Recoleta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, 54),
(39, '00', 'sede Eccleston', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, 55),
(40, '00', 'sede ISPEE', '2008-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 30, 42),
(41, '01', 'anexo ISPEE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, 56),
(42, '00', 'sede Brest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, 57),
(43, '00', 'sede Dickens', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, 41),
(44, '01', 'anexo Lugano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_carrera`
--

CREATE TABLE IF NOT EXISTS `estado_carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estado_carrera`
--

INSERT INTO `estado_carrera` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(1, 'ACT', 'Activa', 1),
(2, 'INAC', 'Inactiva', 2),
(3, 'VIG', 'Vigente', 3),
(4, 'RES', 'Residual', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_validez`
--

CREATE TABLE IF NOT EXISTS `estado_validez` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `estado_validez`
--

INSERT INTO `estado_validez` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(3, 'FT', 'Falta presentar', 1),
(4, 'ET', 'En trámite', 2),
(5, 'AP', 'Aprobado', 3),
(6, 'AC', 'Acordado', 4),
(10, 'RE', 'Rechazado', 5),
(11, 'APN', 'Aprobado nominal', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glosario`
--

CREATE TABLE IF NOT EXISTS `glosario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `termino` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `glosario`
--

INSERT INTO `glosario` (`id`, `termino`, `descripcion`) VALUES
(1, 'Matrícula inicial', 'Se toma aproximandamente a los 30 días de iniciadas las clases. Incluye a la matrícula de ingresantes'),
(2, 'Matrícula ingresantes', 'Cantidad de alumnos que ingresan a carrera'),
(3, 'Desgranamiento', 'Matícula inicial - matrícula final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_etario`
--

CREATE TABLE IF NOT EXISTS `grupo_etario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `grupo_etario`
--

INSERT INTO `grupo_etario` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(3, '5', '5 años', 6),
(4, '4', '4 años', 5),
(5, '3', '3 años', 4),
(6, '2', '2 años', 3),
(7, 'D', 'Deambulador (de 1 a 2 años)', 2),
(8, 'L', 'Lactario (45 días a 1 año)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicial`
--

CREATE TABLE IF NOT EXISTS `inicial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `duracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_73E9728915CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `inicial`
--

INSERT INTO `inicial` (`id`, `oferta_educativa_id`, `duracion`) VALUES
(1, 84, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicial_x`
--

CREATE TABLE IF NOT EXISTS `inicial_x` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_oferta_id` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_766EEA91D1F42FF` (`unidad_oferta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `inicial_x`
--

INSERT INTO `inicial_x` (`id`, `unidad_oferta_id`, `matricula`, `actualizado`, `creado`) VALUES
(1, 122, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 134, NULL, '2014-03-07 12:32:38', '2014-03-07 12:32:38'),
(3, 135, NULL, '2014-03-07 12:32:38', '2014-03-07 12:32:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lexik_maintenance`
--

CREATE TABLE IF NOT EXISTS `lexik_maintenance` (
  `ttl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizacion`
--

CREATE TABLE IF NOT EXISTS `localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `establecimiento_edificio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5512F061BF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_5512F061E0B84520` (`establecimiento_edificio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Volcado de datos para la tabla `localizacion`
--

INSERT INTO `localizacion` (`id`, `unidad_educativa_id`, `establecimiento_edificio_id`) VALUES
(36, 43, 16),
(37, 44, 16),
(38, 45, 16),
(39, 46, 16),
(40, 47, 18),
(41, 48, 17),
(42, 49, 17),
(43, 51, 19),
(44, 52, 19),
(45, 53, 20),
(46, 54, 23),
(47, 55, 23),
(48, 56, 23),
(49, 57, 23),
(50, 58, 24),
(51, 59, 24),
(52, 60, 24),
(53, 61, 25),
(54, 62, 29),
(55, 63, 29),
(56, 64, 31),
(57, 65, 29),
(58, 66, 32),
(59, 67, 32),
(60, 68, 32),
(61, 69, 32),
(62, 75, 34),
(64, 76, 34),
(65, 77, 34),
(66, 78, 34),
(67, 79, 35),
(68, 80, 35),
(69, 81, 35),
(70, 82, 35),
(71, 83, 36),
(72, 84, 37),
(73, 85, 37),
(74, 86, 37),
(75, 87, 37),
(76, 88, 38),
(77, 89, 38),
(78, 90, 38),
(79, 91, 39),
(80, 92, 39),
(81, 93, 40),
(82, 93, 41),
(83, 94, 42),
(84, 95, 43),
(85, 100, 21),
(86, 101, 21),
(87, 102, 21),
(88, 103, 22),
(89, 96, 28),
(92, 97, 28),
(93, 98, 28),
(94, 99, 28),
(95, 90, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20130903145540'),
('20130920172325'),
('20130920174433'),
('20130924152107'),
('20130924153308'),
('20131018112552'),
('20131028123752'),
('20131028124714'),
('20131031142039'),
('20131205150218'),
('20131220141843'),
('20131220152642'),
('20131220153154'),
('20131226123317'),
('20140212145327'),
('20140214161739'),
('20140214163105'),
('20140217161945'),
('20140217162613'),
('20140217165654'),
('20140220133827'),
('20140224150029'),
('20140225120107'),
('20140225142515'),
('20140225145727'),
('20140227150313'),
('20140227170008'),
('20140228141623'),
('20140228161955'),
('20140307151849'),
('20140307152059'),
('20140310162408'),
('20140311143020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE IF NOT EXISTS `modalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id`, `nombre`, `abreviatura`) VALUES
(29, 'Común', 'Cmn'),
(30, 'Artística', 'Art'),
(31, 'Especial', 'Esp'),
(32, 'Jóvenes y adultos', 'JyA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `crearUOClass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id`, `nombre`, `abreviatura`, `orden`, `crearUOClass`) VALUES
(29, 'Inicial', 'Ini', 1, 'Fd\\EstablecimientoBundle\\Model\\UnidadOfertaInicialHandler'),
(30, 'Primario', 'Pri', 2, ''),
(31, 'Medio', 'Med', 3, ''),
(32, 'Terciario', 'Ter', 4, 'Fd\\EstablecimientoBundle\\Model\\UnidadOfertaTerciarioHandler');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `norma`
--

CREATE TABLE IF NOT EXISTS `norma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_norma_id` int(11) DEFAULT NULL,
  `descripcion` longtext,
  `numero` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EF6217E36AA9857` (`tipo_norma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=154 ;

--
-- Volcado de datos para la tabla `norma`
--

INSERT INTO `norma` (`id`, `tipo_norma_id`, `descripcion`, `numero`, `anio`, `actualizado`, `creado`) VALUES
(1, 1, NULL, 6635, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, NULL, 6626, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Validez nacional', 140, 2011, '2013-11-27 16:03:18', '0000-00-00 00:00:00'),
(4, 2, 'MEN', 2029, 2011, '2014-02-11 14:32:09', '0000-00-00 00:00:00'),
(5, 1, NULL, 6862, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, NULL, 941, 2006, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, NULL, 63, 2003, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, NULL, 6861, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, NULL, 149, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 5, NULL, 609, 2000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 5, NULL, 608, 2000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 3, 'Validez nacional', 130, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, NULL, 2116, 2011, '2014-02-11 14:34:06', '0000-00-00 00:00:00'),
(14, 3, 'Validez nacional', 812, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 4, '(rectificatoria)', 2936, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, NULL, 1908, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, '(rectificatoria)', 2141, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 3, NULL, 1921, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 5, NULL, 88, 1998, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, NULL, 6989, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, NULL, 4079, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 3, 'Validez Nacional', 1543, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 3, 'Validez Nacional', 1538, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 3, 'Validez Nacional', 1539, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 3, NULL, 763, 1994, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 3, NULL, 98, 1991, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, NULL, 2163, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, NULL, 3284, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 3, NULL, 1938, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 3, NULL, 1603, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, NULL, 597, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 3, NULL, 1905, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'esta es una descripcion somera', 4186, 2009, '2013-11-27 13:10:33', '0000-00-00 00:00:00'),
(34, 1, NULL, 4281, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, NULL, 1103, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 3, NULL, 1919, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 3, 'cohorte 2012', 907, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 6, NULL, 5569, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 6, NULL, 501, 2005, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 6, NULL, 1710, 2006, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, NULL, 2361, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 5, NULL, 95, 2006, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 5, NULL, 1694, 2006, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, NULL, 3279, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 3, NULL, 431, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 4, NULL, 410, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, NULL, 5475, 2008, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, NULL, 4747, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 4, NULL, 623, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, NULL, 1307, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, NULL, 5815, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, NULL, 310, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 5, NULL, 941, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, NULL, 150, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 3, NULL, 1413, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, NULL, 3304, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, NULL, 7668, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 3, NULL, 805, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, NULL, 3870, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 3, 'Validez Nacional', 1540, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 3, 'Validez Nacional', 1542, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 3, NULL, 2891, 1986, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, NULL, 219, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 3, NULL, 808, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 3, NULL, 1899, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, NULL, 6116, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 3, NULL, 2133, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 3, NULL, 2134, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 3, NULL, 2135, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 5, NULL, 1085, 2004, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 3, NULL, 984, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 3, NULL, 1467, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 1, NULL, 5789, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, NULL, 1890, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, NULL, 6988, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 1, NULL, 5830, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 3, NULL, 1131, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 1, NULL, 6623, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 1, NULL, 5818, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 3, NULL, 182, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 1, NULL, 10893, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 1, NULL, 6624, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 3, NULL, 931, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 3, NULL, 2008, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 1, NULL, 6634, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 1, NULL, 255, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 1, NULL, 4329, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 3, 'cohortes 2009/10/11', 2085, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 1, NULL, 8497, 2008, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 1, NULL, 56, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 1, NULL, 983, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 3, NULL, 2178, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 1, NULL, 966, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 1, NULL, 649, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 3, 'esta es una descripción somera', 180, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 1, NULL, 56, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 1, NULL, 2168, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 1, NULL, 896, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 1, NULL, 6627, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 3, NULL, 1937, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 3, NULL, 589, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 1, NULL, 529, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 3, NULL, 1397, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 5, NULL, 2168, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 5, NULL, 56, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 3, NULL, 1398, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 3, NULL, 809, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 3, NULL, 1065, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 1, NULL, 4565, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 3, NULL, 1561, 2010, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 3, 'cohorte 2009', 1403, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 1, NULL, 886, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 3, NULL, 1847, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 4, 'Solo validez juridiscional', 133, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 3, NULL, 899, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 3, NULL, 832, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 3, NULL, 830, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 3, NULL, 1600, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 3, NULL, 817, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 4, NULL, 1135, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 4, NULL, 1230, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 1, NULL, 6630, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 3, NULL, 1935, 2011, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 3, NULL, 1858, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 1, NULL, 6632, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 3, NULL, 1123, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 1, NULL, 6628, 2009, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 3, NULL, 1039, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 3, NULL, 586, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 1, 'prueba', 99999, 2013, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 4, 'postítulo del IES 2', 424, 2013, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 6, NULL, 781, 2006, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 7, 'Aprueba el Plan Nacional de Educación Obligatoria y Formación Docente 2012 - 2016', 188, 2012, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 7, 'Aprueba el Plan Nacional de Formación Docente', 23, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 7, 'anexo I: documento diagnóstico y descriptivo del sistema formador "Hacia una Institucionalidad del Sistema de Formación Docente en Argentina"\r\nanexo II: "Lineamientos Nacionales para la Formación Docente Continua y el Desarrolo Profesional"', 30, 2007, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 7, 'fija la responsabilidad jurisdiccional en la Dirección de Formación Docente', 72, 2008, '2013-11-27 16:12:04', '0000-00-00 00:00:00'),
(145, 7, 'Aprueba el documento Lineamientos Federales para el planeamiento y organización institucional del sistema formador.\r\nEl documento trata de:\r\na) Planeamiento\r\nb) Condiciones institucionales del sistema formador\r\nc) Organizacion interna de los IFD', 140, 2011, '2014-02-17 16:14:36', '0000-00-00 00:00:00'),
(151, 1, 'x', 1002, 2013, '2013-11-27 16:15:21', '2013-11-27 16:15:21'),
(152, 1, 'x', 1003, 2013, '2014-02-17 16:14:41', '2013-11-27 16:16:26'),
(153, 1, 'xx', 1004, 2013, '2013-11-27 16:18:50', '2013-11-27 16:18:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `norma_referencias`
--

CREATE TABLE IF NOT EXISTS `norma_referencias` (
  `norma_id` int(11) NOT NULL,
  `referencia_id` int(11) NOT NULL,
  PRIMARY KEY (`norma_id`,`referencia_id`),
  KEY `IDX_BCB3D063E06FC29E` (`norma_id`),
  KEY `IDX_BCB3D063778D91A2` (`referencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `norma_referencias`
--

INSERT INTO `norma_referencias` (`norma_id`, `referencia_id`) VALUES
(3, 98),
(33, 114),
(98, 33),
(98, 140),
(140, 33),
(145, 152);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_educativa`
--

CREATE TABLE IF NOT EXISTS `oferta_educativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel_id` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21B7C831DA3426AE` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Volcado de datos para la tabla `oferta_educativa`
--

INSERT INTO `oferta_educativa` (`id`, `nivel_id`, `creado`, `actualizado`) VALUES
(1, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 32, '0000-00-00 00:00:00', '2013-11-28 13:30:57'),
(8, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 32, '0000-00-00 00:00:00', '2014-02-24 16:07:21'),
(13, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_norma`
--

CREATE TABLE IF NOT EXISTS `oferta_norma` (
  `oferta_id` int(11) NOT NULL,
  `norma_id` int(11) NOT NULL,
  PRIMARY KEY (`oferta_id`,`norma_id`),
  KEY `IDX_703EF970FAFBF624` (`oferta_id`),
  KEY `IDX_703EF970E06FC29E` (`norma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `oferta_norma`
--

INSERT INTO `oferta_norma` (`oferta_id`, `norma_id`) VALUES
(1, 20),
(1, 21),
(1, 22),
(2, 20),
(2, 23),
(3, 20),
(3, 24),
(4, 10),
(6, 11),
(7, 2),
(7, 3),
(7, 4),
(8, 7),
(8, 8),
(9, 9),
(9, 14),
(9, 15),
(10, 7),
(11, 16),
(11, 17),
(11, 18),
(12, 19),
(13, 1),
(13, 12),
(13, 13),
(14, 53),
(15, 54),
(15, 55),
(16, 25),
(17, 26),
(18, 26),
(19, 27),
(20, 28),
(20, 29),
(20, 30),
(21, 33),
(23, 34),
(24, 31),
(24, 32),
(25, 35),
(25, 36),
(25, 37),
(27, 38),
(28, 39),
(29, 40),
(30, 41),
(31, 42),
(32, 43),
(33, 44),
(33, 45),
(34, 46),
(35, 47),
(36, 48),
(37, 49),
(38, 50),
(39, 51),
(40, 52),
(41, 53),
(42, 54),
(42, 55),
(43, 56),
(44, 57),
(44, 58),
(45, 59),
(46, 20),
(46, 63),
(47, 20),
(47, 23),
(48, 20),
(48, 64),
(49, 65),
(50, 31),
(50, 32),
(51, 66),
(51, 67),
(51, 68),
(52, 69),
(52, 70),
(52, 71),
(52, 72),
(53, 73),
(53, 74),
(53, 75),
(54, 76),
(54, 77),
(55, 78),
(55, 79),
(55, 80),
(56, 81),
(56, 82),
(56, 83),
(57, 84),
(58, 85),
(58, 86),
(58, 87),
(59, 88),
(59, 89),
(59, 90),
(59, 91),
(60, 92),
(60, 93),
(60, 94),
(60, 95),
(61, 96),
(61, 97),
(61, 98),
(62, 99),
(62, 100),
(62, 101),
(63, 102),
(63, 103),
(63, 104),
(64, 105),
(64, 106),
(65, 107),
(65, 108),
(65, 109),
(66, 100),
(66, 108),
(66, 110),
(67, 100),
(67, 108),
(67, 111),
(68, 112),
(68, 113),
(68, 114),
(69, 93),
(69, 100),
(69, 115),
(69, 116),
(70, 117),
(71, 93),
(71, 100),
(71, 118),
(72, 93),
(72, 100),
(72, 119),
(73, 93),
(73, 100),
(73, 120),
(73, 121),
(74, 122),
(75, 123),
(75, 124),
(76, 125),
(76, 126),
(76, 127),
(77, 128),
(77, 129),
(78, 130),
(78, 131),
(78, 132),
(82, 133),
(83, 134);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orientacion`
--

CREATE TABLE IF NOT EXISTS `orientacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FB4EAA70C671B40F` (`carrera_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `orientacion`
--

INSERT INTO `orientacion` (`id`, `carrera_id`, `nombre`, `titulo`, `duracion`) VALUES
(1, 44, 'Orientación en Discapacidad Intelectual', 'Orientación en Discapacidad Intelectual', NULL),
(2, 44, 'Orientación en Sordos e Hipoacúsicos', 'Orientación en Sordos e Hipoacúsicos', NULL),
(3, 44, 'Orientación en Ciegos y Disminuidos Visuales', 'Orientación en Ciegos y Disminuidos Visuales', NULL),
(4, 8, 'Educación Inicial en Contexto de Vulnerabilidad Social: Educación y Pobreza nombre', NULL, NULL),
(5, 8, 'Educación Inicial y Lenguaje Artístico - Expresivo', NULL, NULL),
(6, 8, 'Educación Inicial y TICs', NULL, NULL),
(7, 8, 'Educación Inicial y Lenguas Originarias', NULL, NULL),
(18, 8, 'Educación Inicial y Lenguas Extranjeras (Inglés)', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(22, 'AR', 'Argentinax', 1),
(23, 'UR', 'Uruguay', 2),
(24, 'AS', 'Asia', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portada`
--

CREATE TABLE IF NOT EXISTS `portada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `portada`
--

INSERT INTO `portada` (`id`, `tabla`, `descripcion`, `actualizado`, `creado`, `url`) VALUES
(1, 'Autoridad', 'Son los datos de las personas que son las autoridades de los establecimientos.', '2013-12-20 14:53:13', '2013-12-20 14:53:13', 'backend_autoridad_buscar'),
(2, 'Barrio', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_barrio'),
(3, 'Cargo Autoridad', 'Son los cargos de las autoridades según el estatuto', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_cargo_autoridad'),
(4, 'CGP', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_cgp'),
(5, 'Distrito Escolar', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_distrito_escolar'),
(6, 'Domicilio', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_domicilio'),
(7, 'Domicilio Localización ', 'Que domicilio de que edificio se asocia a cada sede/anexo. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_domicilio_localizacion'),
(8, 'Especializaciones', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_especializacion'),
(9, 'Establecimientos', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_establecimiento'),
(10, ' EstablecimientoEdificio', 'Con esta página se establece que establecimientos funcionan en cuales edificios, tanto sedes como anexos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_establecimiento_edificio'),
(11, 'Estado de una carrera', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_estadocarrera'),
(12, 'Estado histórico del avance de la validez de un título', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_tituloestadovalidez'),
(13, 'Estado del trámite de la validez nacional de una carrera', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_estadovalidez'),
(14, ' Edificio', 'En un edificio pueden funcionar más de un establecimiento. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_edificio'),
(15, 'Glosario', 'Lista de términos utilizados en el sistema. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_glosario'),
(16, 'Grupo Etario', 'Lista de años de las salas de Inicial.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_grupo_etario'),
(17, 'Localización', 'LOCALIZACION determina en que edificio (sede o anexo) del establecimiento funciona cada uno de sus niveles (o unidades educativas).', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_localizacion'),
(18, 'Matrícula', 'Se cargan los datos de matrícula de cada carrera de cada establecimiento.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_cohorte'),
(19, 'Modalidad', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_modalidad'),
(20, 'Nivel', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_nivel'),
(21, 'Norma', 'Son las normas referentes a las carreras y las especializaciones.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_norma_buscar'),
(22, 'Oferta educativa', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_ofertaeducativa'),
(23, 'Orientaciones de carreras', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_orientacion'),
(24, 'País', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_pais'),
(25, 'Sector', 'Sector estatal o privado.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_sector'),
(28, 'Tipo norma', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_tiponorma'),
(29, 'Tipo establecimiento', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_tipo_establecimiento'),
(30, 'Turno', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_turno'),
(31, 'Unidad Educativa', 'Queda determinada por el nivel y la modalidad de enseñanza (en nuestros casos siempre modalidad común. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_unidad_educativa'),
(32, 'Unidad Oferta', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'backend_unidadoferta'),
(33, 'Vecino', 'Con quien se comparte edificio', '2014-02-27 17:03:24', '2014-02-27 17:03:24', 'vecino'),
(34, 'Titulo', 'Tìtulos de una carrera', '2014-03-11 15:10:31', '2014-03-11 15:10:31', 'backend_titulo_buscar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `primario`
--

CREATE TABLE IF NOT EXISTS `primario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` varchar(255) NOT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4101E2EA15CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `primario`
--

INSERT INTO `primario` (`id`, `duracion`, `oferta_educativa_id`) VALUES
(2, '5 años', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(19, 'CABA', 'CABA', 1),
(20, 'CBA', 'Córdoba', 2),
(21, 'MSN', 'Misiones', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inicial_x_id` int(11) DEFAULT NULL,
  `grupo_etario_id` int(11) DEFAULT NULL,
  `q_secciones` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E226041C36ED91FF` (`grupo_etario_id`),
  KEY `IDX_E226041C940B40B8` (`inicial_x_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id`, `descripcion`, `abreviatura`) VALUES
(22, 'Estatal', 'E'),
(23, 'Público', 'P'),
(24, 'Mixto', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_especializacion`
--

CREATE TABLE IF NOT EXISTS `tipo_especializacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo_especializacion`
--

INSERT INTO `tipo_especializacion` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(2, 'DIP', 'Diplomatura', 1),
(3, 'DIPSP', 'Diplomatura Superior', 2),
(4, 'ESP', 'Especialización', 3),
(5, 'ESPSP', 'Especialización Superior', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_establecimiento`
--

CREATE TABLE IF NOT EXISTS `tipo_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo_establecimiento`
--

INSERT INTO `tipo_establecimiento` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(1, 'ENS', 'Escuela Normal Superior', 1),
(2, 'IEdS', 'Instituto de Educación Superior', 2),
(3, 'IEnS', 'Instituto de Enseñanza Superior', 3),
(4, 'ISP', 'Instituto Superior del Profesorado', 4),
(5, 'ISEF', 'Instituto Superior de Educación Física', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_formacion`
--

CREATE TABLE IF NOT EXISTS `tipo_formacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(2) DEFAULT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_formacion`
--

INSERT INTO `tipo_formacion` (`id`, `codigo`, `descripcion`) VALUES
(1, 'FD', 'Formación Docente'),
(2, 'FT', 'Formación Técnica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_instancia`
--

CREATE TABLE IF NOT EXISTS `tipo_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `tipo_instancia`
--

INSERT INTO `tipo_instancia` (`id`, `codigo`, `descripcion`) VALUES
(25, 'Tal', 'Taller'),
(26, 'Mat', 'Materia'),
(27, 'Sem', 'Seminario'),
(28, 'Tcp', 'Trabajo de campo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_norma`
--

CREATE TABLE IF NOT EXISTS `tipo_norma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tipo_norma`
--

INSERT INTO `tipo_norma` (`id`, `codigo`, `descripcion`) VALUES
(1, 'RES/MEGC', 'Resolución Ministerial GCBA'),
(2, 'RECT', 'Rectificatoria'),
(3, 'RES/ME', 'Resolución Ministerio Nacional'),
(4, 'RES/SSGEYCP', 'Resolución SSGEYCP'),
(5, 'RES/SED', 'Resolución SED'),
(6, 'SEG', '?????'),
(7, 'RES/CF', 'Resolución del Consejo Federal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_trayecto`
--

CREATE TABLE IF NOT EXISTS `tipo_trayecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `tipo_trayecto`
--

INSERT INTO `tipo_trayecto` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(37, 'TFG', 'Trayecto de formación general', 1),
(38, 'TFE', 'Trayecto de formación específica', 2),
(39, 'TCPD', 'Trayecto de construcción de la práctica docente', 3),
(40, 'CFG', 'Campo de formación general', 4),
(41, 'CFE', 'Campo de formación específica', 5),
(42, 'CFPD', 'Campo de formación de la práctica docente', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo`
--

CREATE TABLE IF NOT EXISTS `titulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estado_validez_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_estado_validez` date DEFAULT NULL,
  `validez_desde` date DEFAULT NULL,
  `validez_hasta` date DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_17713E5AC671B40F` (`carrera_id`),
  KEY `IDX_17713E5A9F5A440B` (`estado_id`),
  KEY `IDX_17713E5A2C22C346` (`estado_validez_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `titulo`
--

INSERT INTO `titulo` (`id`, `carrera_id`, `estado_id`, `estado_validez_id`, `nombre`, `fecha_estado_validez`, `validez_desde`, `validez_hasta`, `actualizado`, `creado`) VALUES
(1, 1, 2, 3, 'Profesor de Educación Primaria', NULL, NULL, NULL, '2014-03-11 15:52:32', '2014-03-11 15:49:30'),
(2, 6, 1, 3, 'Técnico Superior en Producción de Indumentaria', NULL, NULL, NULL, '2014-03-11 15:50:21', '2014-03-11 15:50:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo_estado_validez`
--

CREATE TABLE IF NOT EXISTS `titulo_estado_validez` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_id` int(11) DEFAULT NULL,
  `estado_validez_id` int(11) DEFAULT NULL,
  `fecha_estado_validez` date DEFAULT NULL,
  `validez_desde` date DEFAULT NULL,
  `validez_hasta` date DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_44057B5561AD3496` (`titulo_id`),
  KEY `IDX_44057B552C22C346` (`estado_validez_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE IF NOT EXISTS `turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(29, 'TM', 'Mañana', 1),
(30, 'TT', 'Tarde', 2),
(31, 'TV', 'Vespertino', 3),
(32, 'NA', 'No aplica', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_unidad_educativa`
--

CREATE TABLE IF NOT EXISTS `turno_unidad_educativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `turno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_167633EABF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_167633EA69C5211E` (`turno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `turno_unidad_educativa`
--

INSERT INTO `turno_unidad_educativa` (`id`, `unidad_educativa_id`, `turno_id`) VALUES
(3, 43, 29),
(6, 45, 30),
(7, 46, 29),
(8, 46, 31),
(10, 44, 29),
(11, 44, 30),
(12, 45, 29),
(13, 94, 29),
(14, 94, 31),
(20, 43, 31),
(24, 58, 29),
(25, 61, 29),
(26, 61, 30),
(27, 90, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_educativa`
--

CREATE TABLE IF NOT EXISTS `unidad_educativa` (
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
  KEY `IDX_27515E80418D0677` (`cargo_autoridad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Volcado de datos para la tabla `unidad_educativa`
--

INSERT INTO `unidad_educativa` (`id`, `establecimiento_id`, `nivel_id`, `descripcion`, `cargo_autoridad_id`, `nombre_autoridad`, `actualizado`, `creado`) VALUES
(43, 13, 29, 'inicial', 14, 'La señorita Cunegunda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 13, 30, 'primaria', 7, 'La señorita Cunegunda directora de primaria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 13, 31, 'media', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 13, 32, 'terciario', 9, 'La señorita cunegunda 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 14, 30, 'primaria', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 14, 31, 'media', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 14, 32, 'terciario', NULL, 'La señorita cunegunda 8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 15, 31, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 15, 30, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 17, 32, NULL, 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 19, 29, NULL, 14, 'Lafuente Josefina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 19, 30, NULL, 7, 'Ursi, Ana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 19, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 19, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 20, 29, NULL, 14, 'López Patricia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 20, 30, NULL, 7, 'Franciosi, Andrea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 20, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 20, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 22, 29, 'yyyyyyyyyyy', 14, 'Sesé Marcela', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 22, 30, NULL, 7, 'Bonelli, Isabel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 22, 31, NULL, 13, 'XX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 22, 32, NULL, 9, 'Claudia SAMOILOVICH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 24, 29, NULL, 14, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 24, 30, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 24, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 24, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 25, 29, NULL, 14, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 25, 30, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 25, 31, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 25, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 26, 29, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 26, 30, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 26, 31, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 26, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 16, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 27, 29, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 27, 30, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 27, 31, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 27, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 28, 30, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 28, 31, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 28, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 29, 29, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 29, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 30, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 31, 32, 'terciario romera', 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 32, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 21, 29, NULL, 14, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 21, 30, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 21, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 21, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 18, 29, NULL, 14, 'Marina Rizzo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 18, 30, NULL, 7, 'Gomez, Miriam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 18, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 18, 32, NULL, 9, 'Silvia LEDO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 23, 29, NULL, 14, 'Kempner Dina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 23, 30, NULL, 7, 'Garcia, Maria Celia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 23, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 23, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 14, 29, NULL, 14, 'Fornek, Marcela', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 33, 32, NULL, 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 15, 32, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_oferta`
--

CREATE TABLE IF NOT EXISTS `unidad_oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_95C6F11DBF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_95C6F11D15CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Volcado de datos para la tabla `unidad_oferta`
--

INSERT INTO `unidad_oferta` (`id`, `unidad_educativa_id`, `oferta_educativa_id`, `creado`, `actualizado`) VALUES
(1, 109, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 46, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 46, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 49, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 49, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 56, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 57, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 57, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 61, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 61, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 65, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 65, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 69, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 69, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 78, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 78, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 78, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 82, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 82, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 82, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 82, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 82, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 82, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 83, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 83, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 83, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 83, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 83, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 87, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 87, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 90, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 90, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 90, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 90, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 90, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 90, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 90, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 90, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 92, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 92, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 93, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 94, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 99, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 99, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 103, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 103, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 107, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 107, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 109, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 109, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 109, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 109, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 109, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 109, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 90, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 90, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 90, 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 87, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 90, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 90, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 90, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 83, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 83, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 83, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 83, 49, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 94, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 95, 51, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 93, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 53, 53, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 53, 54, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 53, 55, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 53, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 53, 57, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 109, 58, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 109, 59, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 109, 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 109, 61, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 109, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 109, 63, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 109, 64, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 109, 65, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 109, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 109, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 109, 68, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 109, 69, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 109, 70, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 109, 71, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 109, 72, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 109, 73, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 109, 74, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 109, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 109, 77, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 109, 78, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 109, 75, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 94, 82, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 110, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 99, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 43, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 79, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 54, 84, '2014-03-07 12:30:16', '2014-03-07 12:30:16'),
(135, 58, 84, '2014-03-07 12:30:16', '2014-03-07 12:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
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
  `nombre_usuario` varchar(100) NOT NULL,
  `conexion_anterior` datetime DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  `conexion_actual` datetime DEFAULT NULL,
  `rol` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `password`, `salt`, `direccion`, `permite_mail`, `fecha_alta`, `fecha_nacimiento`, `dni`, `nombre_usuario`, `conexion_anterior`, `actualizado`, `creado`, `conexion_actual`, `rol`) VALUES
(11, 'Juan', 'Perez', 'jp@jp.com.ar', 'WT90gX202Rk+0AvMnIIrAKBNOwmIoR5CMLlrTItDvErt/dsuTC+epUd/mPbDnJ1cTj8ofGhx3g/8KhLdaTCXqw==', '381f8d09cf88fa09de94353856e9ddb8', NULL, 0, '2012-10-29 14:55:14', NULL, NULL, 'juan', '2014-02-20 19:07:51', '2014-02-21 17:16:16', '0000-00-00 00:00:00', '2014-02-21 17:16:16', 'ROLE_USUARIO'),
(12, 'Marcelo', 'Prizmic', 'mp@mp.com.ar', 'ZVTKviBdWSHUMvNTpoEbtyc4Nzx0bHdP9PmfkXsNSIi0q4B0NqWuGtAjAGxPigbGYDNOsb5qaOYz22Ah5prnhA==', '8852d8ef2244522831a5c604ca03b0a8', NULL, 0, '2012-10-29 14:55:14', '1963-02-23 00:00:00', NULL, 'marcelo', '2014-03-11 11:14:11', '2014-03-11 14:21:45', '0000-00-00 00:00:00', '2014-03-11 14:21:45', 'ROLE_SUPER_ADMIN'),
(13, 'secreataria', 'dfd', 'xx@cc.com', 'jQeTUCfcPF6ImJbvDMGanVxl5+pTrFdST8OGLWvNVJGv6FuibhAH+QhwFQE38mNWR9EYT6Qncjvfd+fsg8/Cug==', '4830eb439a06ab08becd8f05280991a9', NULL, 0, '2014-02-20 18:30:16', '1903-04-03 00:00:00', NULL, 'secretaria', '2014-02-21 10:27:12', '2014-02-27 14:24:16', '2014-02-20 18:30:16', '2014-02-21 17:18:17', 'ROLE_ADMIN'),
(14, 'lili', 'garcia dominguez', 'g@g.com', 'UrWiJLj9/JQ0QPNXNFeJm8hinbmareVTx4xO3LFDRG4fSZfA6pmuyHMbguo8lHqV0gQiWcI7J4rGMDBmAsjapg==', '58cf46f69f877eba5cb041937c1cd330', NULL, 0, '2014-02-20 18:46:03', NULL, NULL, 'lili', NULL, '2014-02-24 15:57:39', '2014-02-20 18:46:03', '2014-02-24 15:57:39', 'ROLE_USUARIO'),
(15, 'andres', 'zetko', 'a@a.com', 'r2WgWt0Nz2rHPtKqKqL2VfeNs+druny/ArSPGjnJRMJxuUA1zM8OFFyYU/FzP0l9jWQ7lERgZTx+2wCepD7ogQ==', '8ea926e65aed369280847efa02d2c5fc', NULL, 0, '2014-02-20 19:12:58', NULL, NULL, 'andres', NULL, '2014-02-20 19:15:34', '2014-02-20 19:12:58', '2014-02-20 19:15:34', 'ROLE_USUARIO'),
(16, 'x', 'x', 'x@x.com', 'wVoGqhV/qdCi+QhHc3quNL0KnAsUCw/ZIXd1qfG7KiAJvtRX4ijk31t/4DPI0YbM3Wbr9vbLbaFyhkJ5mleY8g==', '620645d8bd6a339efaa0a53c94b8a9f3', NULL, 0, '2014-03-11 11:42:49', NULL, NULL, 'x', NULL, '2014-03-11 11:42:50', '2014-03-11 11:42:49', NULL, 'ROLE_USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vecino`
--

CREATE TABLE IF NOT EXISTS `vecino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edificio_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_758D25E08A652BD6` (`edificio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `vecino`
--

INSERT INTO `vecino` (`id`, `edificio_id`, `nombre`, `actualizado`, `creado`) VALUES
(1, 19, 'Escuela de Comercio Nº 10 “Islas Malvinas”', '2014-02-27 15:45:02', '2014-02-27 15:45:02'),
(2, 19, 'Liceo 4 “R. de E. de San Martín”', '2014-02-27 15:45:23', '2014-02-27 15:45:23'),
(3, 22, 'IES 2 - ENS 2', '2014-02-27 15:46:37', '2014-02-27 15:46:37'),
(4, 23, 'Escuela de Comercio Nº 27 “Antártica Argentina”', '2014-02-27 15:46:53', '2014-02-27 15:46:53'),
(5, 23, 'Escuela de Comercio Nº 4 “Baldomero F. Moreno” + Club de Jóvenes', '2014-02-27 16:00:02', '2014-02-27 16:00:02'),
(6, 24, 'Escuela Nº 14 “Dr. Ricardo Levene” + Jardín', '2014-02-27 16:02:31', '2014-02-27 16:01:35'),
(7, 25, 'Liceo Nº 2 “Amancio Alcorta”', '2014-02-27 16:03:44', '2014-02-27 16:03:44'),
(9, 26, 'Liceo 3 “José Manuel Estrada', '2014-02-27 16:08:48', '2014-02-27 16:08:48'),
(10, 42, 'ISPEE - ENS 6', '2014-02-27 17:04:08', '2014-02-27 17:03:57'),
(11, 43, 'Escuela de Comercio Nº 8 “Patricias Argentinas”', '2014-02-27 17:11:57', '2014-02-27 17:04:35'),
(12, 43, 'Escuela de Comercio Nº 25 “Santiago de Liniers”', '2014-02-27 17:12:13', '2014-02-27 17:04:58'),
(13, 44, 'Liceo Nº 7 “Domingo F. Sarmiento” + Club de Jóvenes', '2014-02-27 17:05:47', '2014-02-27 17:05:47'),
(14, 46, 'Escuela de Danza Nº 10 “Curso Nº 21”', '2014-02-27 17:06:04', '2014-02-27 17:06:04'),
(15, 51, 'Escuela de Comercio Nº 26 “Enrique de Vedia”', '2014-02-27 17:06:26', '2014-02-27 17:06:26'),
(16, 57, 'Escuela de Educación Media Nº 3', '2014-02-27 17:07:08', '2014-02-27 17:07:08'),
(17, 57, 'Instituto de Deportes', '2014-02-27 17:07:22', '2014-02-27 17:07:22'),
(18, 40, 'Colegio Nº 3 “Mariano Moreno”', '2014-02-27 17:07:44', '2014-02-27 17:07:44');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autoridad`
--
ALTER TABLE `autoridad`
  ADD CONSTRAINT `FK_14FFC077418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  ADD CONSTRAINT `FK_14FFC07771B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`);

--
-- Filtros para la tabla `bachillerato`
--
ALTER TABLE `bachillerato`
  ADD CONSTRAINT `FK_40A642E915CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`);

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `FK_CF1ECD3015CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  ADD CONSTRAINT `FK_CF1ECD309F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`),
  ADD CONSTRAINT `FK_CF1ECD30F0798A6E` FOREIGN KEY (`formacion_id`) REFERENCES `tipo_formacion` (`id`);

--
-- Filtros para la tabla `carrera_estado_validez`
--
ALTER TABLE `carrera_estado_validez`
  ADD CONSTRAINT `FK_77A76A52C22C346` FOREIGN KEY (`estado_validez_id`) REFERENCES `estado_validez` (`id`),
  ADD CONSTRAINT `FK_77A76A5C671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `cohorte`
--
ALTER TABLE `cohorte`
  ADD CONSTRAINT `FK_35697A4BD1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`);

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `FK_9B942ED18A652BD6` FOREIGN KEY (`edificio_id`) REFERENCES `edificio` (`id`);

--
-- Filtros para la tabla `domicilio_localizacion`
--
ALTER TABLE `domicilio_localizacion`
  ADD CONSTRAINT `FK_DABAA005166FC4DD` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`id`),
  ADD CONSTRAINT `FK_DABAA005C851F487` FOREIGN KEY (`localizacion_id`) REFERENCES `localizacion` (`id`);

--
-- Filtros para la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD CONSTRAINT `FK_DED4A4E862E97D21` FOREIGN KEY (`distrito_escolar_id`) REFERENCES `distrito_escolar` (`id`),
  ADD CONSTRAINT `FK_DED4A4E873AEFE7` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`),
  ADD CONSTRAINT `FK_DED4A4E8DBA79E2A` FOREIGN KEY (`barrio_id`) REFERENCES `barrio` (`id`),
  ADD CONSTRAINT `FK_DED4A4E8E68FCBB4` FOREIGN KEY (`cgp_id`) REFERENCES `cgp` (`id`);

--
-- Filtros para la tabla `especializacion`
--
ALTER TABLE `especializacion`
  ADD CONSTRAINT `FK_24C61C0415CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  ADD CONSTRAINT `FK_24C61C046CBBC6BF` FOREIGN KEY (`tipo_especializacion_id`) REFERENCES `tipo_especializacion` (`id`),
  ADD CONSTRAINT `FK_24C61C049F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`);

--
-- Filtros para la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD CONSTRAINT `FK_94A4D17E418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  ADD CONSTRAINT `FK_94A4D17E62E97D21` FOREIGN KEY (`distrito_escolar_id`) REFERENCES `distrito_escolar` (`id`),
  ADD CONSTRAINT `FK_94A4D17EDE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`),
  ADD CONSTRAINT `FK_94A4D17EE83582FE` FOREIGN KEY (`tipo_establecimiento_id`) REFERENCES `tipo_establecimiento` (`id`);

--
-- Filtros para la tabla `establecimiento_edificio`
--
ALTER TABLE `establecimiento_edificio`
  ADD CONSTRAINT `FK_37D12C65884BAFEF` FOREIGN KEY (`edificios_id`) REFERENCES `edificio` (`id`),
  ADD CONSTRAINT `FK_37D12C65FB6C6A54` FOREIGN KEY (`establecimientos_id`) REFERENCES `establecimiento` (`id`);

--
-- Filtros para la tabla `inicial`
--
ALTER TABLE `inicial`
  ADD CONSTRAINT `FK_73E9728915CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`);

--
-- Filtros para la tabla `inicial_x`
--
ALTER TABLE `inicial_x`
  ADD CONSTRAINT `FK_766EEA91D1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`);

--
-- Filtros para la tabla `localizacion`
--
ALTER TABLE `localizacion`
  ADD CONSTRAINT `FK_5512F061BF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`),
  ADD CONSTRAINT `FK_5512F061E0B84520` FOREIGN KEY (`establecimiento_edificio_id`) REFERENCES `establecimiento_edificio` (`id`);

--
-- Filtros para la tabla `norma`
--
ALTER TABLE `norma`
  ADD CONSTRAINT `FK_3EF6217E36AA9857` FOREIGN KEY (`tipo_norma_id`) REFERENCES `tipo_norma` (`id`);

--
-- Filtros para la tabla `norma_referencias`
--
ALTER TABLE `norma_referencias`
  ADD CONSTRAINT `FK_BCB3D063778D91A2` FOREIGN KEY (`referencia_id`) REFERENCES `norma` (`id`),
  ADD CONSTRAINT `FK_BCB3D063E06FC29E` FOREIGN KEY (`norma_id`) REFERENCES `norma` (`id`);

--
-- Filtros para la tabla `oferta_educativa`
--
ALTER TABLE `oferta_educativa`
  ADD CONSTRAINT `FK_21B7C831DA3426AE` FOREIGN KEY (`nivel_id`) REFERENCES `nivel` (`id`);

--
-- Filtros para la tabla `oferta_norma`
--
ALTER TABLE `oferta_norma`
  ADD CONSTRAINT `FK_703EF970E06FC29E` FOREIGN KEY (`norma_id`) REFERENCES `norma` (`id`),
  ADD CONSTRAINT `FK_703EF970FAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `oferta_educativa` (`id`);

--
-- Filtros para la tabla `orientacion`
--
ALTER TABLE `orientacion`
  ADD CONSTRAINT `FK_FB4EAA70C671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `primario`
--
ALTER TABLE `primario`
  ADD CONSTRAINT `FK_4101E2EA15CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`);

--
-- Filtros para la tabla `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `FK_E226041C36ED91FF` FOREIGN KEY (`grupo_etario_id`) REFERENCES `grupo_etario` (`id`),
  ADD CONSTRAINT `FK_E226041C940B40B8` FOREIGN KEY (`inicial_x_id`) REFERENCES `inicial_x` (`id`);

--
-- Filtros para la tabla `titulo`
--
ALTER TABLE `titulo`
  ADD CONSTRAINT `FK_17713E5A2C22C346` FOREIGN KEY (`estado_validez_id`) REFERENCES `estado_validez` (`id`),
  ADD CONSTRAINT `FK_17713E5A9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`),
  ADD CONSTRAINT `FK_17713E5AC671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `titulo_estado_validez`
--
ALTER TABLE `titulo_estado_validez`
  ADD CONSTRAINT `FK_44057B552C22C346` FOREIGN KEY (`estado_validez_id`) REFERENCES `estado_validez` (`id`),
  ADD CONSTRAINT `FK_44057B5561AD3496` FOREIGN KEY (`titulo_id`) REFERENCES `titulo` (`id`);

--
-- Filtros para la tabla `turno_unidad_educativa`
--
ALTER TABLE `turno_unidad_educativa`
  ADD CONSTRAINT `FK_167633EA69C5211E` FOREIGN KEY (`turno_id`) REFERENCES `turno` (`id`),
  ADD CONSTRAINT `FK_167633EABF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`);

--
-- Filtros para la tabla `unidad_educativa`
--
ALTER TABLE `unidad_educativa`
  ADD CONSTRAINT `FK_27515E80418D0677` FOREIGN KEY (`cargo_autoridad_id`) REFERENCES `cargo_autoridad` (`id`),
  ADD CONSTRAINT `FK_27515E8071B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_27515E80DA3426AE` FOREIGN KEY (`nivel_id`) REFERENCES `nivel` (`id`);

--
-- Filtros para la tabla `unidad_oferta`
--
ALTER TABLE `unidad_oferta`
  ADD CONSTRAINT `FK_95C6F11D15CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`),
  ADD CONSTRAINT `FK_95C6F11DBF20CF2F` FOREIGN KEY (`unidad_educativa_id`) REFERENCES `unidad_educativa` (`id`);

--
-- Filtros para la tabla `vecino`
--
ALTER TABLE `vecino`
  ADD CONSTRAINT `FK_758D25E08A652BD6` FOREIGN KEY (`edificio_id`) REFERENCES `edificio` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
