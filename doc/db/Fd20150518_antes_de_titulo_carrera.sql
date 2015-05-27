-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-05-2015 a las 14:36:56
-- Versión del servidor: 5.1.66
-- Versión de PHP: 5.3.3-7+squeeze16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Fd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acto_publico`
--

CREATE TABLE IF NOT EXISTS `acto_publico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `acto_publico`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcar la base de datos para la tabla `autoridad`
--

INSERT INTO `autoridad` (`id`, `cargo_autoridad_id`, `establecimiento_id`, `nombre`, `apellido`, `actualizado`, `creado`, `celular`, `email`, `te_particular`) VALUES
(1, 11, 13, 'Marcela', 'PELANDA', '2014-02-28 11:18:19', '0000-00-00 00:00:00', '1550637833', 'marcelapelanda@gmail.com', NULL),
(2, 11, 23, 'Viviana ', 'KAÑEVSKY', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(3, 11, 26, 'Horacio A. ', 'BADARACCO', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(4, 11, 31, 'Lic. Victor Carlos', 'BLOISE', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(5, 12, 31, 'Lic. Virginia Ana', 'MONASTERIO', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(6, 12, 31, 'Prof. Andrea López', 'ALBARELLOS', '2014-02-24 15:04:31', '0000-00-00 00:00:00', NULL, 'a@a.com', NULL),
(7, 12, 31, 'Prof. Francisco Hugo', 'GUINGUIS', '2014-03-07 11:44:32', '0000-00-00 00:00:00', NULL, NULL, NULL),
(8, 12, 31, 'Prof. Gustavo Mario', 'PRAVETTONI', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL),
(10, 20, 13, 'Claudia', 'RIZZO', '2014-02-28 11:11:45', '2014-02-28 11:11:44', '15-50206628', NULL, NULL),
(11, 12, 13, 'Crisitina', 'TACCHI', '2014-02-28 11:17:28', '2014-02-28 11:14:18', '1544060664', 'cristacchi@yahoo.es', NULL),
(12, 12, 13, 'Mirta', 'AQUINO', '2014-02-28 11:16:55', '2014-02-28 11:15:27', '15 3 592 0832', 'miraquino@fibertel.com.ar', NULL),
(14, 11, 17, 'Gustavo', 'OTERO', '2014-03-07 08:08:04', '2014-03-07 08:08:04', NULL, NULL, NULL),
(15, 11, 30, 'Maritza', 'SAGO', '2014-03-07 08:24:23', '2014-03-07 08:24:23', NULL, NULL, NULL),
(18, 11, 33, 'patricia', 'SIMEONE', '2014-03-07 08:36:33', '2014-03-07 08:36:33', NULL, NULL, NULL),
(19, 11, 15, 'Raquel', 'PAPALARDO', '2014-03-07 09:21:24', '2014-03-07 09:21:24', NULL, NULL, NULL),
(20, 11, 18, 'Silvia', 'LEDO', '2014-03-07 09:23:16', '2014-03-07 09:23:16', NULL, NULL, NULL),
(21, 11, 20, 'Laura', 'RUSSIAN', '2014-03-07 11:28:11', '2014-03-07 11:28:05', NULL, NULL, NULL),
(22, 11, 21, 'María Cristina', 'NASIF DE CZAJA', '2014-03-07 11:33:16', '2014-03-07 11:33:15', NULL, NULL, NULL),
(23, 11, 22, 'Claudia', 'SAMOILOVICH', '2014-03-07 11:35:08', '2014-03-07 11:35:08', NULL, NULL, NULL),
(24, 11, 14, 'Gustavo', 'ALCARAZ', '2014-03-07 11:38:25', '2014-03-07 11:38:25', NULL, NULL, NULL),
(26, 11, 24, 'Graciela', 'CASSARINO', '2014-03-07 11:44:57', '2014-03-07 11:44:57', NULL, NULL, NULL),
(27, 11, 25, 'Graciela', 'GUISASOLA', '2014-03-07 11:55:13', '2014-03-07 11:55:13', NULL, NULL, NULL),
(28, 11, 26, 'Horacio', 'BADARRACCO', '2014-03-07 11:56:56', '2014-03-07 11:56:56', NULL, NULL, NULL),
(29, 11, 27, 'Laura', 'PITLUK', '2014-03-07 12:04:01', '2014-03-07 12:04:01', NULL, NULL, NULL),
(30, 11, 29, 'Laura', 'PIRES', '2014-03-07 12:05:30', '2014-03-07 12:05:30', NULL, NULL, NULL),
(31, 11, 28, 'Isabel', 'BOMPET', '2014-03-07 12:07:38', '2014-03-07 12:07:38', NULL, NULL, NULL),
(32, 11, 16, 'Cristina', 'BEURNEL', '2014-03-07 12:08:36', '2014-03-07 12:08:36', NULL, NULL, NULL),
(33, 12, 14, 'Alberto', 'MAC NAMARA', '2014-04-16 09:22:46', '2014-04-16 09:22:46', NULL, NULL, NULL),
(34, 12, 25, 'Adriana', 'VALERO', '2014-04-16 09:25:38', '2014-04-16 09:25:38', NULL, NULL, NULL),
(35, 9, 25, 'Mónica', 'COHEN', '2014-04-16 09:26:10', '2014-04-16 09:26:10', NULL, NULL, NULL),
(37, 9, 21, 'Virginia Aurora', 'LOUSSINIAN', '2014-04-16 09:30:26', '2014-04-16 09:30:26', NULL, NULL, NULL),
(38, 9, 13, 'Hugo', 'DEL BARRIO', '2014-05-23 10:48:11', '2014-05-23 10:48:11', NULL, NULL, NULL),
(39, 20, 18, 'Alicia', 'RACTORET', '2014-05-23 11:23:31', '2014-05-23 11:23:31', NULL, NULL, NULL),
(40, 11, 32, 'Fernando', 'CURSI', '2014-08-27 12:38:18', '2014-08-27 12:38:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

CREATE TABLE IF NOT EXISTS `aviso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `aviso`
--

INSERT INTO `aviso` (`id`, `descripcion`, `fecha`, `activo`) VALUES
(1, 'Yo terminé de cargar los CUI que le faltaban a Ludmila. Quedaron todos cargados', '2014-09-26', 1),
(2, 'Estoy empezando a cargar las carreras de la oferta 2015. Las del 2009 van a quedar con estado RESIDUAL y las 2015 con estado ACTIVA.', '2015-05-08', 1),
(4, 'Los nombres de las carreras de la oferta 2015 tienen que ser revisados a partir de las nuevas resoluciones jurisdiccionales', '2015-05-08', 1),
(5, 'Cargué la oferta del IES 1', '2015-05-13', 1),
(6, 'Terminé de cargar la oferta de las carreras nuevas (oferta 2015). Son las activas. Sobre las residuales habría que hacer un estudio.', '2015-05-14', 1),
(7, 'Se le agrega el campo "comentarios" a las carreras para poner información como por ejemplo la incumbencia (o lo que sea).', '2015-05-18', 1),
(8, 'Ya se pueden cargar los títulos de las carreras y asignárselos a las carreras.', '2015-05-22', 1);

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
-- Volcar la base de datos para la tabla `bachillerato`
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
-- Volcar la base de datos para la tabla `barrio`
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
-- Estructura de tabla para la tabla `caracter`
--

CREATE TABLE IF NOT EXISTS `caracter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `caracter`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_horas` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `descripcion`, `cantidad_horas`) VALUES
(1, 'AY DE INFORMÁTICA', '00:00:00'),
(2, 'DIRECTOR', '00:00:00'),
(3, 'BIBLIOTECARIO', '00:00:00'),
(4, 'AYUDANTE  DE BIOLOGÍA', '00:00:00'),
(5, 'PRECEPTOR', '00:00:00');

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
-- Volcar la base de datos para la tabla `cargo_autoridad`
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
(20, 'Secretario/a de Terciario', 'SECNT'),
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
  `anio_inicio` int(11) DEFAULT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF1ECD3015CE31DF` (`oferta_educativa_id`),
  KEY `IDX_CF1ECD30F0798A6E` (`formacion_id`),
  KEY `IDX_CF1ECD309F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Volcar la base de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `duracion`, `formacion_id`, `oferta_educativa_id`, `estado_id`, `actualizado`, `creado`, `anio_inicio`, `comentario`) VALUES
(1, 'Profesorado de Educación Primaria', '4 años', 1, 13, 4, '2014-09-24 12:33:56', '0000-00-00 00:00:00', 2009, NULL),
(6, 'Tecnicatura Superior en Producción de Indumentaria', NULL, 2, 4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(7, 'Tecnicatura Superior en Gastronomía', NULL, 2, 6, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(8, 'Profesorado de Educación Inicial', NULL, 1, 7, 4, '2014-09-24 08:16:17', '0000-00-00 00:00:00', 2009, NULL),
(9, 'Profesorado de Inglés para el Nivel Inicial y Nivel Primario', 'sbs', 1, 8, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(10, 'Profesorado de Inglés para Nivel Medio y Superior', 'jrf', 1, 9, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(11, 'Profesorado de Portugués para el Nivel Inicial y Nivel Primario', NULL, 1, 10, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(12, 'Profesorado de Portugués', NULL, 1, 11, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(13, 'Traductorado Técnico-Científico-Literario en idioma Inglés', NULL, 2, 12, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(14, 'Traductorado en Alemán', NULL, 2, 16, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(15, 'Traductorado en Inglés', NULL, 2, 17, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(16, 'Profesorado de Filosofía', 'ies1', 1, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(17, 'Traductorado en Francés', NULL, 2, 18, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(20, 'Traductorado en Portugués', NULL, 2, 19, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(22, 'Profesorado en Inglés', NULL, 1, 20, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(23, 'Profesorado en Inglés para Nivel Inicial y Primario', 'jrf', 1, 21, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(24, 'Profesorado en Francés', 'jrf', 1, 25, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(26, 'Profesorado en Francés para Nivel Inicial y Primario', 'jrf', 1, 23, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(28, 'Profesorado de Lengua y Literatura', 'ies1', 1, 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(29, 'Profesorado de Psicología', 'ies1', 1, 3, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(31, 'Ciclo de Formación Pedagógica para Profesionales y Técnicos Superiores (m y s)', '4', 1, 41, 4, '2015-05-13 14:52:28', '0000-00-00 00:00:00', NULL, NULL),
(33, 'Profesorado de Alemán', NULL, 1, 42, 4, '2014-10-02 11:53:52', '0000-00-00 00:00:00', NULL, NULL),
(34, 'Profesorado en Portugués para nivel Inicial y Primario EGB 1 y 2', NULL, 1, 43, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(35, 'Profesorado de Portugués', NULL, 1, 44, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(36, 'Profesorado en Alemán para Nivel Inicial y Primario', NULL, 1, 45, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(38, 'Profesorado de Historia', NULL, 1, 46, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(39, 'Profesorado de Matemática', NULL, 1, 47, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(40, 'Profesorado de Física', NULL, 1, 48, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(41, 'Psicopedagogía', NULL, 1, 49, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(42, 'Profesorado de Educación Física', NULL, 1, 50, 4, '2014-02-18 17:01:50', '0000-00-00 00:00:00', NULL, NULL),
(43, 'Profesorado de Educación Física', NULL, 1, 51, 4, '2014-02-18 17:02:05', '0000-00-00 00:00:00', NULL, NULL),
(44, 'Profesorado de Educación Especial', NULL, 1, 52, 4, '2014-02-18 17:00:55', '0000-00-00 00:00:00', NULL, NULL),
(45, 'Profesorado de Matemática', NULL, 1, 53, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(46, 'Profesorado de Física', NULL, 1, 54, 4, '2014-02-18 17:03:01', '0000-00-00 00:00:00', NULL, NULL),
(47, 'Profesorado de Lengua y Literatura', NULL, 1, 55, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(48, 'Profesorado de Educación Tecnológica', NULL, 1, 56, 4, '2014-02-18 17:02:46', '0000-00-00 00:00:00', NULL, NULL),
(49, 'Profesorado de Educación Secundaria de la modalidad Técnico Profesional en concurrencia con título de base', NULL, 1, 57, 4, '2014-02-18 17:02:31', '0000-00-00 00:00:00', NULL, NULL),
(50, 'Profesorado en Ciencias de la Administración', NULL, 1, 58, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(51, 'Profesorado de Ciencia Política', NULL, 1, 59, 4, '2014-10-02 11:55:37', '0000-00-00 00:00:00', NULL, NULL),
(52, 'Profesorado en Psicología', NULL, 1, 60, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(53, 'Profesorado de Lengua y Literatura', NULL, 1, 61, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(54, 'Profesorado de Biologia', '3', 1, 62, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(55, 'Profesorado en Economía', NULL, 1, 63, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(56, 'Profesorado en Filosofìa', NULL, 1, 64, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(57, 'Profesorado de Física', NULL, 1, 65, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(58, 'Profesorado en Francés', NULL, 1, 66, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(59, 'Profesorado de Geografía', NULL, 1, 67, 4, '2014-02-18 17:03:35', '0000-00-00 00:00:00', NULL, NULL),
(60, 'Profesorado de Historia', NULL, 1, 68, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(61, 'Profesorado en Inglés', NULL, 1, 69, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(62, 'Profesorado en Ciencias Jurídicas', NULL, 1, 70, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(63, 'Profesorado de Química', NULL, 1, 71, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(64, 'Profesorado en Italiano', NULL, 1, 72, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(65, 'Profesorado en Matemática', NULL, 1, 73, 2, '2014-02-06 12:52:48', '0000-00-00 00:00:00', NULL, NULL),
(66, 'Profesorado en Ciencias de la Educación', NULL, 1, 74, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(67, 'Profesorado en Ciencias Políticas', NULL, 1, 75, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(68, 'Profesorado de Informática', NULL, 1, 76, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(69, 'Profesorado en Inglés para el Nivel Inicial y Primario', NULL, 1, 77, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(70, 'Profesorado en Italiano', NULL, 1, 78, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(71, 'Profesorado de Educación Inicial', '5 años', 1, 86, 1, '2014-09-24 12:07:49', '2014-09-24 08:12:47', 2015, NULL),
(72, 'Profesorado de Educación Primaria', '5 años', 1, 87, 1, '2014-09-29 13:12:47', '2014-09-24 12:19:30', 2015, NULL),
(73, 'Profesorado de Alemán', '4 años', 1, 88, 4, '2014-09-26 14:39:11', '2014-09-26 14:39:11', 2015, NULL),
(74, 'Profesorado de Alemán', '4', 1, 89, 1, '2015-05-07 14:55:54', '2014-10-07 14:17:33', 2015, NULL),
(75, 'Profesorado de Biología', '5', 1, 90, 1, '2015-05-07 14:57:39', '2014-10-07 14:17:34', 2015, NULL),
(76, 'Profesorado de Ciencias de la Administración', '5', 1, 91, 1, '2015-05-14 14:07:56', '2014-10-07 14:17:34', 2015, NULL),
(77, 'Profesorado de Ciencias de la Educación', '5', 1, 92, 1, '2015-05-14 14:09:01', '2014-10-07 14:17:34', 2015, NULL),
(78, 'Profesorado de Ciencias Jurídicas (con validez jurisdiccional)', '5', 1, 93, 1, '2015-05-14 14:10:06', '2014-10-07 14:17:34', 2015, NULL),
(79, 'Profesorado de Economía', '5', 1, 94, 1, '2015-05-14 14:10:54', '2014-10-07 14:17:34', 2015, NULL),
(80, 'Profesorado de Educación Especial con orientación en Discapacidad Intelectual', '5', 1, 95, 1, '2015-05-14 14:26:57', '2014-10-07 14:17:34', 2015, NULL),
(81, 'Profesorado de Educación Especial con orientación en Sordos e Hipoacúsicos', '5', 1, 96, 1, '2015-05-14 14:11:55', '2014-10-07 14:17:34', 2015, NULL),
(82, 'Profesorado de Educación Física', '4', 1, 97, 1, '2015-05-07 15:06:58', '2014-10-07 14:17:34', 2015, NULL),
(84, 'Profesorado de Educación Media y Superior en/de Ciencia Política', '5', 1, 99, 1, '2015-05-14 14:14:46', '2014-10-07 14:17:34', 2015, NULL),
(85, 'Profesorado de Educación Superior en Alemán', '5', 1, 100, 1, '2015-05-14 14:17:17', '2014-10-07 14:17:34', 2015, NULL),
(86, 'Profesorado de Educación Superior en Educación Física', '5', 1, 101, 1, '2015-05-07 15:06:06', '2014-10-07 14:17:35', 2015, NULL),
(87, 'Profesorado de Educación Superior en Filosofía', '5', 1, 102, 1, '2015-05-07 14:51:22', '2014-10-07 14:17:35', 2015, NULL),
(88, 'Profesorado de Educación Superior en Física', '5', 1, 103, 1, '2014-10-07 14:17:35', '2014-10-07 14:17:35', 1020142, NULL),
(89, 'Profesorado de Educación Superior en Francés', '5', 1, 104, 1, '2015-05-14 14:20:04', '2014-10-07 14:17:35', 2015, NULL),
(90, 'Profesorado de Educación Superior en Historia', '5', 1, 105, 1, '2015-05-13 09:19:20', '2014-10-07 14:17:35', 2015, NULL),
(91, 'Profesorado de Educación Superior en Inglés', '5', 1, 106, 1, '2015-05-07 14:41:33', '2014-10-07 14:17:35', 2015, NULL),
(92, 'Profesorado de Educación Superior en Italiano', '5', 1, 107, 1, '2015-05-14 14:21:38', '2014-10-07 14:17:35', 2015, NULL),
(93, 'Profesorado de Educación Superior en Lengua y Literatura', '5', 1, 108, 1, '2015-05-07 15:18:17', '2014-10-07 14:17:35', 2015, NULL),
(94, 'Profesorado de Educación Superior en Matemática', '5', 1, 109, 1, '2015-05-13 09:20:26', '2014-10-07 14:17:35', 2015, NULL),
(95, 'Profesorado de Educación Superior en Portugués', '5', 1, 110, 1, '2015-05-07 14:40:10', '2014-10-07 14:17:35', 2015, NULL),
(96, 'Profesorado de Educación Superior en Psicología', '5', 1, 111, 1, '2015-05-13 09:21:17', '2014-10-07 14:17:35', 2015, NULL),
(97, 'Profesorado de Educación Superior en Química', '5', 1, 112, 1, '2015-05-07 15:16:59', '2014-10-07 14:17:35', 2015, NULL),
(98, 'Profesorado de Educación Tecnológica', '4', 1, 113, 1, '2015-05-07 15:16:04', '2014-10-07 14:17:36', 2015, NULL),
(99, 'Profesorado de Educcación Especial con  orientación en Ciegos y Disminuidos Visuales', '5', 1, 114, 1, '2015-05-14 14:26:07', '2014-10-07 14:17:36', 2015, NULL),
(100, 'Profesorado de Filosofía', '5', 1, 115, 1, '2015-05-14 14:27:58', '2014-10-07 14:17:36', 2015, NULL),
(101, 'Profesorado de Física', '4', 1, 116, 1, '2015-05-07 15:01:12', '2014-10-07 14:17:36', 2015, NULL),
(102, 'Profesorado de Francés', '4', 1, 117, 1, '2015-05-14 14:28:56', '2014-10-07 14:17:36', 2015, NULL),
(103, 'Profesorado de Geografía', '5', 1, 118, 1, '2015-05-14 14:30:13', '2014-10-07 14:17:36', 2015, NULL),
(104, 'Profesorado de Historia', '5', 1, 119, 1, '2015-05-14 14:31:06', '2014-10-07 14:17:36', 2015, NULL),
(105, 'Profesorado de Informática', '5', 1, 120, 1, '2015-05-14 14:31:49', '2014-10-07 14:17:36', 2015, NULL),
(106, 'Profesorado de Inglés', '4', 1, 121, 1, '2015-05-07 14:41:53', '2014-10-07 14:17:36', 2015, NULL),
(107, 'Profesorado de Italiano', '4', 1, 122, 1, '2015-05-07 15:12:16', '2014-10-07 14:17:36', 2015, NULL),
(108, 'Profesorado de Lengua y Literatura', '4', 1, 123, 1, '2015-05-14 14:32:45', '2014-10-07 14:17:37', 2015, NULL),
(109, 'Profesorado de Matemática', '4', 1, 124, 1, '2015-05-07 15:10:49', '2014-10-07 14:17:37', 2015, NULL),
(110, 'Profesorado de Portugués', '4', 1, 125, 1, '2015-05-07 14:43:51', '2014-10-07 14:17:37', 2015, NULL),
(111, 'Profesorado de Psicología', '5', 1, 126, 1, '2015-05-07 15:13:43', '2014-10-07 14:17:37', 2015, NULL),
(112, 'Profesorado de Química', '4', 1, 127, 1, '2015-05-07 15:09:33', '2014-10-07 14:17:37', 2015, NULL),
(113, 'Tecnicatura Superior en Producción de Indumentaria', '4', 2, 128, 1, '2015-05-07 15:36:47', '2015-05-07 15:36:47', 2014, NULL),
(114, 'Ciclo de Formación Pedagógica para Profesionales y Técnicos Superiores (p y m)', NULL, 1, 129, 1, '2015-05-13 14:54:36', '2015-05-13 14:53:37', 2015, NULL);

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
-- Volcar la base de datos para la tabla `cgp`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Volcar la base de datos para la tabla `cohorte`
--

INSERT INTO `cohorte` (`id`, `unidad_oferta_id`, `anio`, `matricula_ingresantes`, `matricula_inicial`, `matricula_final`, `egreso`, `createdAt`, `actualizado`, `creado`, `matricula`) VALUES
(21, 13, 2013, 199, NULL, NULL, 54, '2014-03-06 14:03:10', '2014-03-06 14:03:10', '2014-03-06 14:03:10', 414),
(22, 14, 2013, 88, NULL, NULL, 34, '2014-03-06 14:03:33', '2014-03-06 14:03:33', '2014-03-06 14:03:33', 267),
(23, 45, 2013, 60, NULL, NULL, 15, '2014-03-06 14:05:35', '2014-03-06 14:05:35', '2014-03-06 14:05:35', 195),
(24, 44, 2013, 65, NULL, NULL, 23, '2014-03-06 14:06:04', '2014-03-06 14:06:04', '2014-03-06 14:06:04', 157),
(25, 121, 2013, 63, NULL, NULL, 13, '2014-03-06 14:06:27', '2014-03-06 14:06:27', '2014-03-06 14:06:27', 194),
(26, 29, 2013, 40, NULL, NULL, 1, '2014-03-06 14:09:43', '2014-03-06 14:09:43', '2014-03-06 14:09:43', 225),
(27, 30, 2013, 35, NULL, NULL, 10, '2014-03-06 14:11:03', '2014-03-06 14:11:03', '2014-03-06 14:11:03', 220),
(28, 40, 2013, 203, NULL, NULL, 115, '2014-03-06 14:18:58', '2014-03-06 14:18:58', '2014-03-06 14:18:58', 1543),
(29, 5, 2013, 57, NULL, NULL, 12, '2014-03-06 14:20:12', '2014-03-06 14:24:08', '2014-03-06 14:20:12', 199),
(30, 4, 2013, 59, NULL, NULL, 11, '2014-03-06 14:20:33', '2014-03-06 14:20:33', '2014-03-06 14:20:33', 232),
(31, 12, 2013, 118, NULL, NULL, 11, '2014-03-06 14:22:21', '2014-03-06 14:22:21', '2014-03-06 14:22:21', 427),
(32, 11, 2013, 113, NULL, NULL, 16, '2014-03-06 14:22:43', '2014-03-06 14:22:43', '2014-03-06 14:22:43', 419),
(33, 47, 2013, 88, NULL, NULL, 2, '2014-03-06 14:27:44', '2014-03-06 14:36:55', '2014-03-06 14:27:44', 325),
(34, 46, 2013, 123, NULL, NULL, 23, '2014-03-06 14:28:11', '2014-03-06 14:38:42', '2014-03-06 14:28:11', 344),
(35, 31, 2013, 0, NULL, NULL, 4, '2014-03-06 14:34:24', '2014-03-06 14:34:24', '2014-03-06 14:34:24', 45),
(36, 49, 2013, 25, NULL, NULL, 12, '2014-03-06 14:35:16', '2014-03-06 14:35:17', '2014-03-06 14:35:16', 81),
(37, 48, 2013, 37, NULL, NULL, 6, '2014-03-06 14:35:37', '2014-03-06 14:35:37', '2014-03-06 14:35:37', 137),
(38, 24, 2013, 87, NULL, NULL, 14, '2014-03-06 14:40:37', '2014-03-11 13:43:40', '2014-03-06 14:40:37', 138),
(39, 134, 2013, 133, NULL, NULL, 19, '2014-03-06 14:44:18', '2014-03-06 14:44:19', '2014-03-06 14:44:18', 467),
(40, 15, 2013, 78, NULL, NULL, 15, '2014-03-06 14:45:04', '2014-03-06 14:45:04', '2014-03-06 14:45:04', 242),
(41, 16, 2013, 75, NULL, NULL, 12, '2014-03-06 14:45:48', '2014-03-06 14:45:48', '2014-03-06 14:45:48', 213),
(42, 70, 2013, 395, NULL, NULL, 165, '2014-03-06 14:46:47', '2014-03-06 14:46:47', '2014-03-06 14:46:47', 1876),
(43, 72, 2013, 267, NULL, NULL, 52, '2014-03-06 14:54:55', '2014-03-06 14:54:55', '2014-03-06 14:54:55', 536),
(44, 71, 2013, 287, NULL, NULL, 48, '2014-03-06 15:01:14', '2014-03-06 15:01:14', '2014-03-06 15:01:14', 885),
(45, 2, 2013, 190, NULL, NULL, 36, '2014-03-11 13:30:08', '2014-03-11 13:30:08', '2014-03-11 13:30:08', 911),
(46, 3, 2013, 200, NULL, NULL, 44, '2014-03-11 13:36:30', '2014-03-11 13:36:30', '2014-03-11 13:36:30', 995),
(47, 9, 2013, 74, NULL, NULL, 10, '2014-03-11 13:37:42', '2014-03-11 13:37:42', '2014-03-11 13:37:42', 224),
(48, 10, 2013, 66, NULL, NULL, 7, '2014-03-11 13:38:05', '2014-03-11 13:38:05', '2014-03-11 13:38:05', 151),
(49, 7, 2013, 260, NULL, NULL, 26, '2014-03-11 13:39:13', '2014-03-11 13:39:13', '2014-03-11 13:39:13', 744),
(50, 8, 2013, 270, NULL, NULL, 41, '2014-03-11 13:39:49', '2014-03-11 13:39:49', '2014-03-11 13:39:49', 843),
(51, 25, 2013, 83, NULL, NULL, 1, '2014-03-11 13:44:28', '2014-03-11 13:44:29', '2014-03-11 13:44:28', 314),
(52, 26, 2013, 265, NULL, NULL, 6, '2014-03-11 13:45:51', '2014-03-11 13:45:51', '2014-03-11 13:45:51', 852),
(53, 66, 2013, 6, NULL, NULL, 4, '2014-03-11 13:46:28', '2014-03-11 13:46:28', '2014-03-11 13:46:28', 20),
(54, 67, 2013, 31, NULL, NULL, 5, '2014-03-11 13:47:09', '2014-03-11 13:47:09', '2014-03-11 13:47:09', 92),
(55, 68, 2013, 23, NULL, NULL, 1, '2014-03-11 13:47:45', '2014-03-11 13:47:45', '2014-03-11 13:47:45', 82),
(56, 69, 2013, 83, NULL, NULL, 87, '2014-03-11 13:48:21', '2014-03-11 13:48:21', '2014-03-11 13:48:21', 328);

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
-- Volcar la base de datos para la tabla `comuna`
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
-- Volcar la base de datos para la tabla `dia`
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
-- Volcar la base de datos para la tabla `distrito_escolar`
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
-- Volcar la base de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id`, `edificio_id`, `calle`, `altura`, `piso`, `departamento`, `referencia`, `principal`, `c_postal`, `actualizado`, `creado`) VALUES
(19, 19, 'Córdoba, Av.', '1950', NULL, NULL, NULL, 1, 'C1120AA', '2014-02-25 14:10:11', '0000-00-00 00:00:00'),
(20, 20, 'La Rioja', '1042', NULL, NULL, NULL, 1, '1181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 21, 'Carlos Calvo', '3150', NULL, NULL, NULL, 1, '1181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 22, 'Gral Urquiza', '277', NULL, NULL, NULL, 1, 'C1215AD', '2014-02-21 10:29:31', '0000-00-00 00:00:00'),
(23, 22, 'Moreno', '3111', NULL, NULL, NULL, 0, 'C1215AD', '2014-02-21 10:29:31', '0000-00-00 00:00:00'),
(24, 23, 'Bolívar', '1235', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 24, 'Saraza', '4204', NULL, NULL, NULL, 1, 'C1407AAF', '2014-03-06 14:26:30', '0000-00-00 00:00:00'),
(26, 25, 'Rivadavia, Av.', '4950', NULL, NULL, NULL, 1, 'C1424CE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 26, 'Arcamendia', '743', NULL, NULL, NULL, 1, 'C1274AA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 27, 'Coronel Rico', '751/3', NULL, NULL, NULL, 1, NULL, '2014-08-29 07:48:03', '0000-00-00 00:00:00'),
(29, 40, 'Ayacucho', '632', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 41, 'Curapaligüe', '1150', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 42, 'Güemes', '3859', NULL, NULL, NULL, 1, '1', '2014-03-07 11:31:34', '0000-00-00 00:00:00'),
(33, 43, 'Corrientes, Av.', '4261', NULL, NULL, NULL, 1, 'C1195AA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 44, 'Callao, Av.', '450', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 46, 'O Higgins', '2441', NULL, NULL, NULL, 1, 'C1428AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 47, '3 de Febrero', '2300', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 48, 'Dean Funes', '1821', NULL, NULL, NULL, 1, 'C1244AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 51, 'Juncal', '3251', NULL, NULL, NULL, 1, 'C1425AYQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 53, 'Lascano', '3840 ', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 54, 'Carlos Pellegrini, Av.', '1515', NULL, NULL, NULL, 1, '1425', '2014-03-07 09:16:01', '0000-00-00 00:00:00'),
(44, 55, 'Dorrego', '3751', NULL, NULL, NULL, 1, 'C1425GBB', '2014-03-07 12:06:13', '0000-00-00 00:00:00'),
(45, 52, 'Córdoba, Av.', '2016', NULL, NULL, NULL, 1, 'C1120AAP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 57, 'Miguel Sánchez', '1338', NULL, NULL, NULL, 1, 'C1429BSN', '2014-03-10 12:35:31', '0000-00-00 00:00:00'),
(49, 56, 'Paraguay', '3925', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 19, 'Ayacucho', '875', NULL, NULL, NULL, 0, '1425', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 58, 'Aníbal Pedro Arbeletche', '1052', NULL, NULL, NULL, 1, '1111', '2014-05-13 06:50:59', '2014-02-28 15:35:35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Volcar la base de datos para la tabla `domicilio_localizacion`
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
(45, 23, 45, 0, '2015-05-07 14:18:03', '0000-00-00 00:00:00'),
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
(92, 51, 95, 1, '2014-05-13 06:51:55', '2014-02-28 15:38:36'),
(93, 29, 96, 0, '2014-03-05 11:27:16', '2014-03-05 11:27:16'),
(94, 33, 56, 1, '2014-09-26 14:58:53', '2014-09-26 14:58:45'),
(95, 24, 97, 1, '2015-02-25 09:56:00', '2015-02-25 09:55:14'),
(96, 49, 82, 0, '2015-05-05 09:03:48', '2015-05-05 09:03:48'),
(97, 22, 45, 1, '2015-05-07 14:18:03', '2015-05-07 14:17:50');

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
-- Volcar la base de datos para la tabla `duracion`
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
-- Volcar la base de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id`, `comuna_id`, `cgp_id`, `barrio_id`, `distrito_escolar_id`, `cui`, `superficie`, `updatedAt`, `createdAt`) VALUES
(19, 114, 114, 29, 148, 29, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 115, 115, 30, 153, 325, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 115, 116, 30, 153, 323, 255, '2012-11-05 15:45:16', '0000-00-00 00:00:00'),
(22, 115, 115, 33, 153, 324, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 113, 113, 33, 151, 199, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 120, 113, 34, 168, 2309, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 120, 120, 41, 155, 427, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 116, 116, 40, 152, 259, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 116, 113, 40, 152, 293, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 115, 115, 33, 149, 1863, 3, NULL, '2012-11-09 16:25:54'),
(41, 119, 119, 56, 166, 428, 4333, NULL, '2012-11-09 17:03:33'),
(42, 126, 126, 29, 156, 101, 66666, NULL, '2012-11-09 17:09:11'),
(43, 117, 117, 29, 149, 102, 0, NULL, '2012-11-09 17:11:33'),
(44, 115, 115, 29, 148, 30, 99999, NULL, '2012-11-09 17:13:30'),
(46, 125, 125, 35, 157, 532, 1010, NULL, '2012-11-12 13:28:24'),
(47, 113, 113, 35, 149, 1003, 5000, NULL, '2012-11-12 14:37:10'),
(48, 116, 116, 55, 153, 327, 11, NULL, '2012-11-12 15:11:51'),
(51, 126, 126, 29, 148, 28, 44, '2012-11-12 15:29:39', '2012-11-12 15:29:39'),
(52, 115, 115, 52, 148, 31, 111111, NULL, '2012-11-12 15:44:23'),
(53, 123, 123, 69, 164, 796, 222, '2012-11-12 15:51:40', '2012-11-12 15:51:40'),
(54, 113, 113, 29, 148, 32, 55, '2012-11-12 16:02:19', '2012-11-12 16:02:19'),
(55, 126, 126, 35, 156, 472, 8888, '2012-11-12 16:27:54', '2012-11-12 16:27:54'),
(56, 113, 113, 29, 149, 6565, NULL, NULL, '2012-11-12 16:33:34'),
(57, 125, 125, 54, 157, 522, 9911, '2012-11-12 16:46:58', '2012-11-12 16:46:58'),
(58, 116, 116, 53, 166, 963, NULL, NULL, '2014-02-28 15:35:35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `especializacion`
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
(17, NULL, 83, 'La narrativa en la obra escrita a través de los canales expresivos audiovisuales', 'La narrativa en la obra escrita a través de los canales expresivos audiovisuales', NULL, 1, NULL, NULL),
(18, NULL, NULL, 'Especialización Superior en Inclusión Educativa', 'Especialización Superior en Inclusión Educativa', '3 cuatrimestres', 1, 5, NULL),
(19, NULL, NULL, 'Especialización Superior en Atención Temprana', 'Especialización Superior en Atención Temprana', NULL, 1, 5, NULL);

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
  `fecha_presentacion_rp` date DEFAULT NULL,
  `fecha_aprobacion_rp` date DEFAULT NULL,
  `anio_inicio_nes` int(11) DEFAULT NULL,
  `te` varchar(25) DEFAULT NULL,
  `fecha_presentacion_rai` date DEFAULT NULL,
  `fecha_aprobacion_rai` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94A4D17E62E97D21` (`distrito_escolar_id`),
  KEY `IDX_94A4D17EDE95C867` (`sector_id`),
  KEY `IDX_94A4D17EE83582FE` (`tipo_establecimiento_id`),
  KEY `IDX_94A4D17E418D0677` (`cargo_autoridad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `establecimiento`
--

INSERT INTO `establecimiento` (`id`, `distrito_escolar_id`, `sector_id`, `cue`, `codigo_previo_transferencia`, `nombre`, `numero`, `descripcion`, `fecha_creacion`, `tiene_cooperadora`, `url`, `apodo`, `email`, `orden`, `tipo_establecimiento_id`, `nombre_autoridad`, `cargo_autoridad_id`, `campo_deportes`, `actualizado`, `creado`, `fecha_presentacion_roi`, `fecha_aprobacion_roi`, `fecha_elecciones`, `fin_mandato`, `fecha_presentacion_rp`, `fecha_aprobacion_rp`, `anio_inicio_nes`, `te`, `fecha_presentacion_rai`, `fecha_aprobacion_rai`) VALUES
(13, 148, 22, '200696', NULL, 'Escuela Normal Superior Nro 1 Roque Saenz Peña', 1, NULL, '2012-10-29', '0', 'http://ens1de1.buenosaires.edu.ar', 'ENS 1', 'ens1@bue.edu.ar', 1, 1, 'Marcela Pelanda', 11, NULL, '2014-02-20 14:35:20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2015, NULL, NULL, NULL),
(14, 153, 22, '201778', '', 'Escuela Normal Superior Nro 8 Julio Argentino Roca', 8, '', '2012-10-29', '0', 'http://ens8de6.buenosaires.edu.ar/ens8.htm', 'ENS 8', 'ens8@bue.edu.ar', 8, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 153, 22, '200866', NULL, 'Escuela Normal Superior Nro 2 Mariano Acosta', 2, NULL, '2010-01-01', 'sd', 'http://ens2.caba.infd.edu.ar/sitio/', 'ENS 2', 'ens2acosta@bue.edu.ar', 2, 1, NULL, 7, NULL, '2015-05-14 16:13:49', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 148, 22, '200720', NULL, 'Instituto de Enseñanza Superior Nro 1 Alicia Moreau', 13, NULL, '2009-01-01', '0', 'ies1.caba.infd.edu.ar', 'Alicia', 'iesamjusto@bue.edu.ar', 13, 3, NULL, NULL, NULL, '2014-03-10 12:22:08', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 153, 22, '201411', NULL, 'Instituto de Enseñanza Superior Nro 2 Mariano Acosta', 2, NULL, '2009-01-01', '0', 'http://www.ies2.comar', 'IES 2', 'ies85de6@buenosaires.edu.ar', 14, 3, NULL, NULL, NULL, '2014-03-07 07:08:09', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 151, 22, '200536', NULL, 'Escuela Normal Superior Nro 3 Bernardino Rivadavia', 3, NULL, '2010-01-01', 'sd', 'http://ens3.caba.infd.edu.ar/sitio/', 'ENS 3', 'ens3@bue.edu.ar', 3, 1, NULL, NULL, NULL, '2015-05-14 16:15:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 155, 22, '201297', NULL, 'Escuela Normal Superior Nro 4 Estanislao Severo Zeballos', 4, NULL, NULL, 'sd', 'http://ens4.caba.infd.edu.ar/sitio/', 'ENS 4', 'ens4@bue.edu.ar', 4, 1, NULL, NULL, NULL, '2015-05-14 16:15:47', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 152, 22, '201328', NULL, 'Escuela Normal Superior Nro 5 General Don Martín Miguel de Güemes', 5, NULL, NULL, 'sd', 'http://ens5.caba.infd.edu.ar/sitio/', 'ENS 5', 'ens5@bue.edu.ar', 5, 1, NULL, 7, NULL, '2015-05-14 16:17:38', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2014, '4302-7727 (terciario)', NULL, NULL),
(21, 149, 22, '200717', NULL, 'Escuela Normal Superior Nro 6 Vicente López y Planes', 6, NULL, NULL, 'sd', 'http://ens6de2.buenosaires.edu.ar/nivel_terciario.htm', 'ENS 6', 'ens6@bue.edu.ar', 6, 1, NULL, 11, NULL, '2015-05-14 16:18:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 149, 22, '200997', NULL, 'Escuela Normal Superior Nro 7 José María Torres', 7, NULL, NULL, 'si', 'http://ens7.caba.infd.edu.ar/sitio/', 'ENS 7', 'ens7@bue.edu.ar', 7, 1, NULL, NULL, NULL, '2015-05-14 16:19:34', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 148, 22, '201177', NULL, 'Escuela Normal Superior Nro 9 Domingo Faustino Sarmiento', 9, NULL, NULL, 'sd', 'http://ens9.caba.infd.edu.ar/sitio/', 'ENS 9', 'ens9secre@yahoo.com.ar', 9, 1, 'Viviana KAÑEVSKY', 11, NULL, '2015-05-14 16:27:17', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 157, 22, '201214', NULL, 'Escuela Normal Superior Nro 10 Juan Bautista Alberdi', 10, NULL, NULL, 'sd', 'http://ens10.caba.infd.edu.ar', 'ENS 10', 'ens10@bue.edu.ar', 10, 1, NULL, 11, NULL, '2015-05-14 16:29:42', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 158, 22, '201693', NULL, 'Escuela Normal Superior Nro 11 Ricardo Levene', 11, NULL, NULL, '0', NULL, 'ENS 11', 'ens11@bue.edu.ar', 11, 1, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 148, 22, '200708', NULL, 'Escuela Normal Superior en Lenguas Vivas Sofía E. Broquen de Spangenberg', 12, NULL, NULL, '0', NULL, 'Spangenberg', 'enslvsebs@bue.edu.ar', 12, 1, 'Horacio A. BADARACCO', 11, 'propio en la escuela', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 164, 22, '200895', NULL, 'Instituto de Educación Superior Juan B. Justo', NULL, NULL, '2009-01-01', '0', 'http://www.buenosaires.edu.ar/areas/educacion/escuelas/escuelas/superior/jbjusto/default.htm', 'JBJusto', 'jbjusto@bue.edu.ar', 15, 2, NULL, 7, NULL, '2014-03-10 12:21:16', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 148, 22, '200584', NULL, 'Instituto de Enseñanza Superior en Lenguas Vivas Juan Ramón Fernández', NULL, NULL, NULL, '0', NULL, 'JRF', 'ieslvjrf@bue.edu.ar', 16, 3, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 148, 22, '201329', NULL, 'Instituto Superior del Profesorado de Educación Inicial Sara C. Eccleston', NULL, NULL, NULL, '0', NULL, 'Eccleston', 'ispei@bue.edu.ar', 17, 4, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 149, 22, '201414', NULL, 'Instituto Superior del Profesorado de Educación Especial', NULL, NULL, '2009-01-01', '0', 'http://ispee.buenosaires.edu.ar', 'ISPEE', 'ispee@bue.edu.ar', 18, 4, NULL, NULL, NULL, '2014-03-07 08:22:39', '0000-00-00 00:00:00', NULL, NULL, '2009-01-01', '2009-01-01', NULL, NULL, NULL, NULL, NULL, NULL),
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
-- Volcar la base de datos para la tabla `establecimiento_edificio`
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
(25, '01', 'anexo Cnel. Rico', '2010-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 20, 27),
(27, '00', 'sede joaquin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, 40),
(28, '00', 'sede ens 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 42),
(29, '00', 'sede ens 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, 43),
(30, '00', 'sede ENS 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, 44),
(32, '00', 'sede ens 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 46),
(33, '01', 'anexo ens 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 47),
(34, '00', 'sede ens 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 48),
(35, '00', 'sede spangenberg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 51),
(36, '00', 'sede IES 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 52),
(37, '00', 'sede jbj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, 53),
(38, '00', 'sede Recoleta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, 54),
(39, '00', 'sede Eccleston', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, 55),
(40, '00', 'sede ISPEE', '2008-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 30, 42),
(41, '01', 'anexo ISPEE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, 56),
(42, '00', 'sede Brest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, 57),
(43, '00', 'sede Dickens', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, 41),
(44, '01', 'anexo Lugano', '2014-02-28', NULL, NULL, NULL, NULL, NULL, NULL, 28, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento_recurso`
--

CREATE TABLE IF NOT EXISTS `establecimiento_recurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `recurso_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `origen_hora_id` int(11) DEFAULT NULL,
  `comentario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4968F6271B61351` (`establecimiento_id`),
  KEY `IDX_D4968F62E52B6C4E` (`recurso_id`),
  KEY `IDX_D4968F62EA54AA7B` (`origen_hora_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `establecimiento_recurso`
--

INSERT INTO `establecimiento_recurso` (`id`, `establecimiento_id`, `recurso_id`, `cantidad`, `origen_hora_id`, `comentario`) VALUES
(1, 19, 3, 1, NULL, NULL),
(2, 19, 1, 1, NULL, NULL),
(3, 19, 4, 1, NULL, NULL),
(4, 19, 5, 1, NULL, NULL),
(5, 19, 6, 1, 2, NULL),
(6, 23, 3, 1, NULL, NULL),
(7, 23, 10, 1, NULL, NULL),
(8, 23, 1, 1, NULL, NULL),
(9, 24, 1, 1, NULL, NULL),
(10, 24, 3, 1, NULL, NULL),
(11, 24, 10, 1, NULL, NULL),
(12, 24, 4, 1, NULL, NULL),
(13, 29, 3, 1, NULL, NULL),
(14, 29, 1, 1, NULL, NULL),
(15, 29, 6, 1, 1, NULL),
(16, 17, 11, 1, 1, NULL),
(17, 17, 12, 1, 1, NULL),
(18, 17, 1, 1, NULL, NULL),
(19, 17, 3, 1, NULL, NULL),
(20, 13, 1, 1, NULL, NULL),
(21, 13, 3, 2, NULL, NULL),
(22, 13, 7, 1, 1, 'Tienen 2 personas con tareas pasivas pero una se está jubilando'),
(23, 13, 6, 1, 2, NULL),
(24, 27, 1, 1, 1, 'Compartido todos los niveles'),
(25, 27, 3, 1, NULL, 'Sin personal específico'),
(26, 27, 4, 1, NULL, 'Compartido. Sin personal específico'),
(27, 31, 3, 1, NULL, NULL),
(28, 31, 13, 1, NULL, NULL),
(29, 31, 15, 1, NULL, NULL);

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
-- Volcar la base de datos para la tabla `estado_carrera`
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
-- Volcar la base de datos para la tabla `estado_validez`
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
-- Volcar la base de datos para la tabla `glosario`
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
-- Volcar la base de datos para la tabla `grupo_etario`
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
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_73E9728915CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `inicial`
--

INSERT INTO `inicial` (`id`, `oferta_educativa_id`, `duracion`, `descripcion`) VALUES
(1, 84, '5', 'Inicial común');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicial_x`
--

CREATE TABLE IF NOT EXISTS `inicial_x` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inicial_x`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE IF NOT EXISTS `licencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `licencia`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamado`
--

CREATE TABLE IF NOT EXISTS `llamado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `caracter_id` int(11) DEFAULT NULL,
  `motivo_id` int(11) DEFAULT NULL,
  `cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `horario` time NOT NULL,
  `anio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iniciacion` date NOT NULL,
  `terminacion` date DEFAULT NULL,
  `continuidad_pedagogica` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_56DB349071B61351` (`establecimiento_id`),
  KEY `IDX_56DB34907D89F04A` (`caracter_id`),
  KEY `IDX_56DB3490F9E584F8` (`motivo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `llamado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizacion`
--

CREATE TABLE IF NOT EXISTS `localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_educativa_id` int(11) DEFAULT NULL,
  `establecimiento_edificio_id` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  `cantidad_docentes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5512F061BF20CF2F` (`unidad_educativa_id`),
  KEY `IDX_5512F061E0B84520` (`establecimiento_edificio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Volcar la base de datos para la tabla `localizacion`
--

INSERT INTO `localizacion` (`id`, `unidad_educativa_id`, `establecimiento_edificio_id`, `actualizado`, `creado`, `cantidad_docentes`) VALUES
(36, 43, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(37, 44, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(38, 45, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(39, 46, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(40, 47, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(41, 48, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(42, 49, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(43, 51, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(44, 52, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(45, 53, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(46, 54, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(47, 55, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(48, 56, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(49, 57, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(50, 58, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(51, 59, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(52, 60, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(53, 61, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(54, 62, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(55, 63, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(56, 64, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(57, 65, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(58, 66, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(59, 67, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(60, 68, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(61, 69, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(62, 75, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(64, 76, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(65, 77, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(66, 78, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(67, 79, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(68, 80, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(69, 81, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(70, 82, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(71, 83, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(72, 84, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(73, 85, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(74, 86, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(75, 87, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(76, 88, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(77, 89, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(78, 90, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(79, 91, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(80, 92, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(81, 93, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(82, 93, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(83, 94, 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(84, 95, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(85, 100, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(86, 101, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(87, 102, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(88, 103, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(89, 96, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(92, 97, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(93, 98, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(94, 99, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(95, 90, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(96, 109, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(97, 103, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(98, 110, 19, '2015-05-07 14:19:48', '2015-05-07 14:19:48', NULL),
(99, 104, 30, '2015-05-07 14:33:27', '2015-05-07 14:33:27', NULL),
(100, 105, 30, '2015-05-07 14:33:39', '2015-05-07 14:33:39', NULL),
(101, 106, 30, '2015-05-07 14:33:57', '2015-05-07 14:33:57', NULL),
(102, 107, 30, '2015-05-07 14:34:09', '2015-05-07 14:34:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_acto_publico`
--

CREATE TABLE IF NOT EXISTS `log_acto_publico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `log_acto_publico`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `migration_versions`
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
('20140311143020'),
('20140321153011'),
('20140327165621'),
('20140327174328'),
('20140327194533'),
('20140328140058'),
('20140401163255'),
('20140401164648'),
('20140403170000'),
('20140403190204'),
('20140403192255'),
('20140403192621'),
('20140411122004'),
('20140411123658'),
('20140411125708'),
('20140522163100'),
('20140522164856'),
('20140523125355'),
('20140915094829'),
('20140918143337'),
('20140923140204'),
('20140923142942'),
('20140929161541'),
('20140930131041'),
('20141001144750'),
('20141110171500'),
('20150224162547'),
('20150225124041'),
('20150304170502'),
('20150319164949'),
('20150422184427'),
('20150517214010'),
('20150518133800'),
('20150519150003'),
('20150519170929');

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
-- Volcar la base de datos para la tabla `modalidad`
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
-- Volcar la base de datos para la tabla `nivel`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=160 ;

--
-- Volcar la base de datos para la tabla `norma`
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
(153, 1, 'xx', 1004, 2013, '2013-11-27 16:18:50', '2013-11-27 16:18:50'),
(154, 1, 'tamado del cuadernillo  del RA2013', 2629, 2007, '2014-03-06 14:32:59', '2014-03-06 14:32:59'),
(155, 4, 'Sobre la Especialización en Superior en Inclusión Educativa', 1054, 2014, '2014-03-27 09:43:51', '2014-03-27 09:43:51'),
(156, 1, 'Falta la validez nacional', 2438, 2014, '2014-09-24 08:13:39', '2014-09-24 08:13:25'),
(157, 1, 'falta la validez nacional', 2514, 2014, '2014-09-24 12:31:59', '2014-09-24 12:31:50'),
(158, 5, 'se pone esto para los que no la se', 9999, 2015, '2015-05-07 14:38:33', '2015-05-07 14:38:33'),
(159, 8, 'plan nuevo', 24, 2015, '2015-05-07 15:38:57', '2015-05-07 15:37:47');

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
-- Volcar la base de datos para la tabla `norma_referencias`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Volcar la base de datos para la tabla `oferta_educativa`
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
(16, 32, '0000-00-00 00:00:00', '2014-03-06 14:33:19'),
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
(84, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 30, '2014-09-18 16:02:40', '2014-09-18 16:02:44'),
(86, 32, '2014-09-24 08:12:47', '2014-09-24 08:15:27'),
(87, 32, '2014-09-24 12:19:30', '2014-09-24 12:32:54'),
(88, 32, '2014-09-26 14:39:11', '2014-09-26 14:39:11'),
(89, 32, '2014-10-07 14:17:33', '2015-05-07 14:56:00'),
(90, 32, '2014-10-07 14:17:34', '2015-05-07 14:58:04'),
(91, 32, '2014-10-07 14:17:34', '2015-05-14 14:08:04'),
(92, 32, '2014-10-07 14:17:34', '2015-05-14 14:09:09'),
(93, 32, '2014-10-07 14:17:34', '2015-05-14 14:10:12'),
(94, 32, '2014-10-07 14:17:34', '2015-05-14 14:10:59'),
(95, 32, '2014-10-07 14:17:34', '2015-05-14 14:27:02'),
(96, 32, '2014-10-07 14:17:34', '2015-05-14 14:12:00'),
(97, 32, '2014-10-07 14:17:34', '2015-05-07 15:07:06'),
(99, 32, '2014-10-07 14:17:34', '2015-05-14 14:14:51'),
(100, 32, '2014-10-07 14:17:34', '2015-05-14 14:17:22'),
(101, 32, '2014-10-07 14:17:35', '2015-05-07 15:06:15'),
(102, 32, '2014-10-07 14:17:35', '2015-05-07 14:51:28'),
(103, 32, '2014-10-07 14:17:35', '2015-05-13 09:18:42'),
(104, 32, '2014-10-07 14:17:35', '2015-05-14 14:20:12'),
(105, 32, '2014-10-07 14:17:35', '2015-05-13 09:19:26'),
(106, 32, '2014-10-07 14:17:35', '2015-05-07 14:39:03'),
(107, 32, '2014-10-07 14:17:35', '2015-05-14 14:21:44'),
(108, 32, '2014-10-07 14:17:35', '2015-05-07 15:18:24'),
(109, 32, '2014-10-07 14:17:35', '2015-05-13 09:20:33'),
(110, 32, '2014-10-07 14:17:35', '2015-05-07 14:40:17'),
(111, 32, '2014-10-07 14:17:35', '2015-05-13 09:21:22'),
(112, 32, '2014-10-07 14:17:35', '2015-05-07 15:17:06'),
(113, 32, '2014-10-07 14:17:36', '2015-05-07 15:16:10'),
(114, 32, '2014-10-07 14:17:36', '2015-05-14 14:26:12'),
(115, 32, '2014-10-07 14:17:36', '2015-05-14 14:28:03'),
(116, 32, '2014-10-07 14:17:36', '2015-05-07 15:01:21'),
(117, 32, '2014-10-07 14:17:36', '2015-05-14 14:29:00'),
(118, 32, '2014-10-07 14:17:36', '2015-05-14 14:30:20'),
(119, 32, '2014-10-07 14:17:36', '2015-05-14 14:31:11'),
(120, 32, '2014-10-07 14:17:36', '2015-05-14 14:31:54'),
(121, 32, '2014-10-07 14:17:36', '2015-05-07 14:42:46'),
(122, 32, '2014-10-07 14:17:36', '2015-05-07 15:12:24'),
(123, 32, '2014-10-07 14:17:37', '2015-05-14 14:32:50'),
(124, 32, '2014-10-07 14:17:37', '2015-05-07 15:10:57'),
(125, 32, '2014-10-07 14:17:37', '2015-05-07 14:43:58'),
(126, 32, '2014-10-07 14:17:37', '2015-05-07 15:13:51'),
(127, 32, '2014-10-07 14:17:37', '2015-05-07 15:09:41'),
(128, 32, '2015-05-07 15:36:47', '2015-05-07 15:40:00'),
(129, 32, '2015-05-13 14:53:37', '2015-05-13 14:53:46');

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
-- Volcar la base de datos para la tabla `oferta_norma`
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
(16, 154),
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
(83, 134),
(86, 156),
(87, 157),
(89, 158),
(90, 158),
(91, 158),
(92, 158),
(93, 158),
(94, 158),
(95, 158),
(96, 158),
(97, 158),
(99, 158),
(100, 158),
(101, 158),
(102, 158),
(103, 158),
(104, 158),
(105, 158),
(106, 158),
(107, 158),
(108, 158),
(109, 158),
(110, 158),
(111, 158),
(112, 158),
(113, 158),
(114, 158),
(115, 158),
(116, 158),
(117, 158),
(118, 158),
(119, 158),
(120, 158),
(121, 158),
(122, 158),
(123, 158),
(124, 158),
(125, 158),
(126, 158),
(127, 158),
(128, 159),
(129, 158);

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
-- Volcar la base de datos para la tabla `orientacion`
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
-- Estructura de tabla para la tabla `origen_hora`
--

CREATE TABLE IF NOT EXISTS `origen_hora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `origen_hora`
--

INSERT INTO `origen_hora` (`id`, `codigo`, `descripcion`, `actualizado`, `creado`) VALUES
(1, 1, 'Cargo de la POF', '2014-05-22 16:39:50', '2014-05-22 16:39:50'),
(2, 2, 'Hs institucionales', '2014-05-22 16:39:50', '2014-05-22 16:39:50');

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
-- Volcar la base de datos para la tabla `pais`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Volcar la base de datos para la tabla `portada`
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
(35, 'Título de una Carrera', 'Título asociado a una carrera', '2015-05-21 00:00:00', '2015-05-21 00:00:00', 'backend_titulocarrera_buscar'),
(36, 'Recursos', 'Laboratorios, bibiotecas, etc', '2014-04-22 00:00:00', '2014-04-22 00:00:00', 'recurso'),
(37, 'EstablecimientoRecurso', 'Relación entre establecimiento y los recursos que tiene', '2014-04-22 00:00:00', '2014-04-22 00:00:00', 'establecimiento_recurso'),
(39, 'OrigenHora', 'Si un lab/centro se financia por POF u horas cátedra', '2014-05-23 10:10:10', '2014-05-23 10:10:10', 'en_desarrollo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `primario`
--

CREATE TABLE IF NOT EXISTS `primario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` varchar(255) NOT NULL,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4101E2EA15CE31DF` (`oferta_educativa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `primario`
--

INSERT INTO `primario` (`id`, `duracion`, `oferta_educativa_id`, `descripcion`) VALUES
(3, '7 años', 85, 'Primaria común');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `primario_x`
--

CREATE TABLE IF NOT EXISTS `primario_x` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_oferta_id` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C8B17359D1F42FF` (`unidad_oferta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `primario_x`
--


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
-- Volcar la base de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(19, 'CABA', 'CABA', 1),
(20, 'CBA', 'Córdoba', 2),
(21, 'MSN', 'Misiones', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE IF NOT EXISTS `recurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(1, 'BIB', 'Biblioteca', 0),
(2, 'CDC', 'Centro de documentación', 0),
(3, 'LIF', 'Laboratorio de Informática', 0),
(4, 'LCN', 'Laboratorio de Ciencia Naturales', 0),
(5, 'LIF', 'Laboratorio de Humanidades', 0),
(6, 'JUE', 'Juegoteca/Ludoteca', 0),
(7, 'CRD', 'Centro de recursos didácticos', 0),
(8, 'LID', 'Laboratorio de idiomas', 0),
(9, 'LBI', 'Laboratorio de biología', 0),
(10, 'LFQ', 'Lab físico-química', 1),
(11, 'LFI', 'Laboratorio de física', 1),
(12, 'LQU', 'Laboratorio de química', 1),
(13, 'LFI', 'Laboratorio de fisiología', 10),
(14, 'DIN', 'Departamento de investigación', 11),
(15, 'LPE', 'Laboratorio de Pedagogía', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE IF NOT EXISTS `resultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `resultado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_media`
--

CREATE TABLE IF NOT EXISTS `resumen_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `establecimiento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_vacante` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_iniciacion` date DEFAULT NULL,
  `fecha_terminacion` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_horas` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug_cargo` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_horas_string` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_lunes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_martes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_miercoles` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_jueves` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_viernes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fila` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1056 ;

--
-- Volcar la base de datos para la tabla `resumen_media`
--

INSERT INTO `resumen_media` (`id`, `numero`, `fecha`, `cargo`, `establecimiento`, `cargo_vacante`, `fecha_iniciacion`, `fecha_terminacion`, `cantidad_horas`, `slug_cargo`, `cantidad_horas_string`, `horario_lunes`, `horario_martes`, `horario_miercoles`, `horario_jueves`, `horario_viernes`, `fila`) VALUES
(1045, 'ACTO PÚBLICO Nº 18', '11/07/14', 'JEFE DE PRECEPTORES', 'ENS Nº 01 "Pte. R. Sáenz Peña"', 'Jefa de Preceptores', '2014-07-03', NULL, '24', 'jefe-de-preceptores', '24', '7.30hs a 12.20hs', '7.30hs a 12.15hs', '7.30hs a 12.20hs', '', '7.30hs a 12.15hs', 14),
(1046, 'ACTO PÚBLICO Nº 18', '11/07/14', 'JEFE DE PRECEPTORES', 'ENS Nº 09 "D. Faustino Sarmiento"', 'jefe de preceptores', '2014-06-17', NULL, '', 'jefe-de-preceptores', '', '13,15/18,05', '13,15/18,05', '13,15/18,05', '', '13,15/18,05', 26),
(1047, 'ACTO PÚBLICO Nº 18', '11/07/14', 'JEFE DE PRECEPTORES', 'B.O.A. Nº 4 "XUL SOLAR"', 'jefe de Preceptores', '2013-10-15', NULL, '', 'jefe-de-preceptores', '', '18:27 a 23:15', '18:27 a 23:15', '18:27 a 23:15', '', '18:27 a 23:15', 38),
(1048, 'ACTO PÚBLICO Nº 18', '11/07/14', 'JEFE DE PRECEPTORES', 'B.O.A.   Nº 1 "ANTONIO BERNI"', 'Jefe de Preceptores', '2014-04-08', NULL, '', 'jefe-de-preceptores', '', '18:27 a 23:15', '18:27 a 23:15', '18:27 a 23:15', '', '18:27 a 23:15', 63),
(1049, 'ACTO PÚBLICO Nº 18', '11/07/14', 'SUB-JEFE DE PRECEPTORES', 'ESCUELA E.B.A "LOLA MORA"', 'Subjefa de Preceptores', '2014-03-17', NULL, '', 'sub-jefe-de-preceptores', '', '18:00 a 22:48', '18:00 a 22:48', '18:00 a 22:48', '', '18:00 a 22:48', 79),
(1050, 'ACTO PÚBLICO Nº 18', '11/07/14', 'SUB-JEFE DE PRECEPTORES', 'ENS LV "S. B. Spangenberg"', 'Sub Jefe de Preceptores', '2014-07-14', NULL, '', 'sub-jefe-de-preceptores', '', '12:10 a 17:00 hs.', '12:10 a 17:00 hs.', '12:10 a 17:00 hs.', '', '12:10 a 17:00 hs.', 92),
(1051, 'ACTO PÚBLICO Nº 18', '11/07/14', 'INGLES', 'ENS Nº08 "Julio Argentino Roca"', 'Inglés', '2014-06-24', NULL, '18', 'ingles', 'TP 03', '7,45 a 8,25       8,25 a 9,05       12,10 a 12,50     13,15 a 13,55     13,55 a 14,35     14,45 a 15', '7,45 a 8,25           8,25 a 9,05          9,15 a 9,55          9,55 a 10,35             11,25 a 12,', '', '', '7,45 a 8,25                 8,25 a 9,05                    9,15 a 9,55                9,55 a 10,35  ', 123),
(1052, 'ACTO PÚBLICO Nº 18', '11/07/14', 'INGLES', 'ENS Nº08 "Julio Argentino Roca"', 'Inglés', '2014-06-24', NULL, '12', 'ingles', 'TP 04', '9,15 a 9,55             9,55 a 10,35      10,45 a 11,25     11,25 a 12,05', '10,45 a 11,25       12,10 a 12,50      13,15 a 13,55      13,55 a 14,35      14,45 a 15,25', '', '', '13,15 a 13,55          13,55 a 14,35               14,45 a 15,25', 136),
(1053, 'ACTO PÚBLICO Nº 18', '11/07/14', 'MATEMÁTICA', 'ENS Nº 09 "D. Faustino Sarmiento"', 'MATEMATICA', '2014-06-17', NULL, '5', 'matemtica', '5', '', '', '16,20/17               17/17,40', '', '15,30/16,10          16,20/17', 177),
(1054, 'ACTO PÚBLICO Nº 18', '11/07/14', 'GEOGRAFÍA', 'ENS Nº 05 "Gral. Martín Miguel de Güemes"', 'Geografía', '2014-06-24', NULL, '24', 'geografa', 'TP 02 (19 hs. de clase) 05 extraclase)', '07.45 a 09.05 09.20 a 10.40 10.50 a 13.30', '07.45 a 09.05 y de.10.50 a 13.30', '07.45 a 09.05- de 10.50 a 12.10', '', '10.00 a 10.40 y de 13.00 a 13.40', 361),
(1055, 'ACTO PÚBLICO Nº 18', '11/07/14', 'GEOGRAFÍA', 'ENS Nº 05 "Gral. Martín Miguel de Güemes"', 'Geografía', '2014-06-24', NULL, '3', 'geografa', '3', '', '09.20 a 10.00', '', '', '10.50 a 12.10', 374);

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

--
-- Volcar la base de datos para la tabla `sala`
--


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
-- Volcar la base de datos para la tabla `sector`
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
-- Volcar la base de datos para la tabla `tipo_especializacion`
--

INSERT INTO `tipo_especializacion` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(2, 'DIP', 'Diplomatura', 1),
(3, 'DIPSP', 'Diplomatura Superior', 2),
(4, 'ESP', 'Especialización Académica', 3),
(5, 'ESPSP', 'Especialización Docente de Nivel Superior', 4);

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
-- Volcar la base de datos para la tabla `tipo_establecimiento`
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
-- Volcar la base de datos para la tabla `tipo_formacion`
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
-- Volcar la base de datos para la tabla `tipo_instancia`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `tipo_norma`
--

INSERT INTO `tipo_norma` (`id`, `codigo`, `descripcion`) VALUES
(1, 'RES/MEGC', 'Resolución Ministerial GCBA'),
(2, 'RECT', 'Rectificatoria'),
(3, 'RES/ME', 'Resolución Ministerio Nacional'),
(4, 'RES/SSGEYCP', 'Resolución SSGEYCP'),
(5, 'RES/SED', 'Resolución SED'),
(6, 'SEG', '?????'),
(7, 'RES/CF', 'Resolución del Consejo Federal'),
(8, 'RES/SSGECP', 'Resol. de ??');

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
-- Volcar la base de datos para la tabla `tipo_trayecto`
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
-- Estructura de tabla para la tabla `titulo_carrera`
--

CREATE TABLE IF NOT EXISTS `titulo_carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `actualizado` datetime NOT NULL,
  `creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_955288BA3A909126` (`nombre`),
  KEY `IDX_955288BAC671B40F` (`carrera_id`),
  KEY `IDX_955288BA9F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `titulo_carrera`
--

INSERT INTO `titulo_carrera` (`id`, `carrera_id`, `estado_id`, `nombre`, `actualizado`, `creado`) VALUES
(1, 71, 1, 'Profesor/a de Educación Inicial', '2015-05-21 15:26:03', '2015-05-21 15:24:57'),
(2, 86, 1, 'Profesor/a de Educación Superior en Educación Física', '2015-05-21 15:26:36', '2015-05-21 15:25:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Volcar la base de datos para la tabla `turno`
--

INSERT INTO `turno` (`id`, `codigo`, `descripcion`, `orden`) VALUES
(29, 'TM', 'Mañana', 1),
(30, 'TT', 'Tarde', 2),
(31, 'TV', 'Vespertino', 3),
(32, 'NA', 'No aplica', 6),
(33, 'JC', 'Jornada completa', 4),
(34, 'VS', 'Viernes noche y sábado', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadoferta_turno`
--

CREATE TABLE IF NOT EXISTS `unidadoferta_turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_oferta_id` int(11) DEFAULT NULL,
  `turno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59229137D1F42FF` (`unidad_oferta_id`),
  KEY `IDX_5922913769C5211E` (`turno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=473 ;

--
-- Volcar la base de datos para la tabla `unidadoferta_turno`
--

INSERT INTO `unidadoferta_turno` (`id`, `unidad_oferta_id`, `turno_id`) VALUES
(1, 2, 29),
(2, 2, 30),
(3, 2, 31),
(4, 3, 29),
(5, 3, 30),
(6, 3, 31),
(7, 134, 29),
(8, 134, 30),
(9, 134, 31),
(10, 46, 31),
(11, 47, 31),
(12, 7, 29),
(13, 7, 30),
(14, 8, 29),
(15, 8, 30),
(16, 9, 29),
(17, 9, 31),
(18, 10, 29),
(19, 10, 31),
(20, 121, 30),
(21, 121, 31),
(22, 44, 29),
(23, 44, 31),
(24, 45, 30),
(25, 45, 31),
(26, 11, 29),
(27, 11, 31),
(28, 12, 29),
(29, 12, 31),
(30, 4, 31),
(31, 5, 31),
(32, 5, 30),
(33, 48, 30),
(34, 49, 30),
(35, 13, 30),
(36, 13, 31),
(37, 14, 30),
(38, 14, 31),
(39, 15, 31),
(40, 16, 31),
(41, 34, 30),
(42, 34, 31),
(43, 32, 29),
(44, 32, 30),
(45, 32, 31),
(46, 63, 30),
(47, 63, 31),
(48, 56, 30),
(49, 56, 31),
(50, 35, 29),
(51, 35, 30),
(52, 35, 31),
(53, 36, 29),
(54, 36, 30),
(55, 36, 31),
(56, 62, 30),
(57, 62, 31),
(58, 33, 29),
(59, 33, 31),
(60, 37, 29),
(61, 37, 31),
(62, 38, 29),
(63, 38, 31),
(64, 31, 29),
(65, 31, 31),
(66, 59, 29),
(67, 59, 31),
(68, 64, 29),
(69, 64, 31),
(70, 18, 29),
(71, 18, 31),
(72, 19, 29),
(73, 19, 31),
(74, 20, 31),
(75, 21, 31),
(76, 22, 31),
(77, 29, 31),
(78, 30, 31),
(79, 60, 31),
(80, 40, 29),
(81, 40, 30),
(82, 66, 29),
(83, 66, 31),
(84, 24, 29),
(85, 24, 31),
(86, 68, 29),
(87, 67, 29),
(88, 25, 31),
(89, 26, 31),
(90, 69, 29),
(91, 69, 31),
(92, 73, 31),
(93, 74, 31),
(94, 75, 31),
(95, 76, 31),
(96, 72, 31),
(97, 71, 29),
(98, 71, 30),
(99, 71, 31),
(100, 70, 29),
(101, 70, 30),
(102, 70, 31),
(103, 81, 30),
(104, 81, 31),
(105, 88, 29),
(106, 88, 30),
(107, 88, 31),
(108, 84, 29),
(109, 80, 29),
(110, 82, 30),
(111, 82, 31),
(112, 91, 30),
(113, 93, 29),
(114, 93, 31),
(115, 85, 29),
(116, 87, 30),
(117, 87, 31),
(118, 83, 30),
(119, 94, 29),
(121, 78, 31),
(122, 96, 29),
(123, 96, 30),
(124, 86, 31),
(125, 92, 30),
(126, 103, 30),
(127, 90, 29),
(128, 97, 29),
(129, 97, 30),
(130, 97, 31),
(131, 89, 29),
(132, 89, 30),
(133, 89, 31),
(134, 98, 30),
(135, 122, 29),
(136, 122, 30),
(137, 6, 29),
(138, 135, 29),
(139, 135, 30),
(140, 136, 29),
(141, 136, 30),
(142, 137, 29),
(143, 137, 30),
(144, 138, 29),
(145, 138, 30),
(146, 139, 29),
(147, 139, 30),
(148, 140, 29),
(149, 140, 30),
(150, 141, 29),
(151, 141, 30),
(152, 142, 29),
(153, 142, 30),
(154, 144, 29),
(155, 144, 30),
(156, 144, 33),
(157, 143, 29),
(158, 143, 30),
(159, 146, 29),
(161, 145, 33),
(162, 147, 29),
(165, 149, 29),
(166, 149, 30),
(167, 150, 30),
(168, 151, 29),
(169, 152, 30),
(170, 153, 29),
(171, 154, 29),
(172, 155, 30),
(173, 156, 29),
(174, 156, 30),
(175, 157, 30),
(176, 158, 29),
(177, 158, 30),
(178, 159, 29),
(179, 159, 30),
(180, 160, 29),
(181, 161, 29),
(182, 161, 30),
(183, 162, 29),
(184, 163, 29),
(185, 163, 30),
(186, 164, 29),
(187, 164, 30),
(188, 165, 33),
(189, 166, 29),
(190, 167, 29),
(191, 167, 30),
(192, 168, 29),
(193, 168, 30),
(194, 169, 29),
(195, 169, 30),
(196, 170, 29),
(197, 171, 29),
(198, 171, 30),
(199, 172, 29),
(200, 173, 29),
(201, 173, 30),
(202, 174, 29),
(203, 174, 30),
(204, 175, 29),
(205, 175, 30),
(206, 176, 29),
(207, 176, 30),
(208, 176, 31),
(209, 179, 29),
(210, 179, 30),
(211, 179, 31),
(212, 187, 29),
(213, 187, 31),
(214, 180, 29),
(215, 180, 30),
(216, 180, 31),
(217, 178, 29),
(218, 178, 30),
(221, 181, 29),
(223, 181, 30),
(224, 178, 31),
(225, 181, 31),
(226, 182, 29),
(227, 182, 30),
(228, 193, 29),
(229, 193, 30),
(230, 183, 29),
(231, 183, 31),
(232, 194, 29),
(233, 194, 31),
(234, 195, 29),
(235, 195, 31),
(236, 196, 29),
(237, 196, 31),
(238, 197, 31),
(239, 185, 30),
(240, 185, 31),
(241, 186, 30),
(242, 198, 30),
(243, 188, 30),
(244, 188, 31),
(245, 199, 30),
(246, 199, 31),
(247, 189, 31),
(248, 200, 31),
(249, 204, 29),
(250, 205, 30),
(251, 205, 31),
(252, 206, 31),
(253, 207, 29),
(254, 208, 29),
(255, 209, 30),
(256, 210, 31),
(257, 211, 31),
(258, 212, 29),
(259, 212, 30),
(260, 212, 31),
(264, 214, 30),
(265, 215, 29),
(266, 216, 29),
(267, 216, 30),
(268, 216, 31),
(269, 217, 29),
(270, 217, 30),
(271, 217, 31),
(272, 218, 31),
(273, 219, 29),
(274, 220, 31),
(275, 221, 29),
(276, 222, 29),
(277, 223, 29),
(278, 223, 31),
(279, 224, 29),
(280, 224, 31),
(281, 225, 29),
(282, 225, 31),
(283, 226, 29),
(284, 226, 30),
(285, 226, 31),
(286, 227, 30),
(287, 228, 29),
(288, 228, 31),
(289, 229, 31),
(290, 230, 29),
(291, 231, 31),
(292, 232, 29),
(293, 232, 31),
(294, 233, 31),
(295, 234, 30),
(296, 234, 31),
(297, 235, 31),
(298, 236, 30),
(299, 237, 31),
(300, 238, 31),
(301, 239, 29),
(302, 240, 31),
(303, 241, 29),
(304, 242, 29),
(305, 243, 31),
(306, 244, 30),
(307, 244, 31),
(308, 245, 29),
(309, 245, 30),
(310, 245, 31),
(311, 246, 29),
(312, 246, 30),
(313, 247, 29),
(314, 247, 31),
(315, 248, 29),
(316, 248, 31),
(317, 249, 29),
(318, 249, 30),
(319, 249, 31),
(320, 250, 30),
(321, 251, 31),
(322, 252, 30),
(323, 252, 31),
(324, 253, 31),
(325, 254, 29),
(326, 254, 31),
(327, 255, 31),
(328, 256, 30),
(329, 256, 31),
(330, 257, 29),
(331, 258, 30),
(332, 191, 31),
(333, 202, 31),
(334, 261, 29),
(335, 261, 30),
(336, 261, 31),
(337, 272, 29),
(338, 272, 30),
(339, 272, 31),
(340, 278, 29),
(341, 278, 30),
(342, 278, 31),
(343, 262, 31),
(344, 279, 31),
(345, 263, 29),
(346, 263, 30),
(347, 263, 31),
(348, 280, 29),
(349, 280, 30),
(350, 280, 31),
(351, 281, 29),
(352, 281, 30),
(353, 282, 29),
(354, 282, 30),
(355, 283, 29),
(356, 283, 31),
(357, 284, 29),
(358, 284, 31),
(359, 285, 30),
(360, 285, 31),
(361, 286, 30),
(362, 286, 31),
(365, 288, 29),
(366, 288, 31),
(367, 289, 29),
(368, 289, 31),
(369, 290, 31),
(370, 291, 30),
(371, 291, 31),
(372, 292, 30),
(373, 292, 31),
(374, 293, 30),
(375, 293, 31),
(376, 296, 31),
(377, 297, 31),
(378, 298, 29),
(379, 298, 31),
(380, 299, 31),
(381, 300, 29),
(382, 300, 31),
(383, 301, 31),
(384, 302, 31),
(386, 305, 29),
(387, 306, 30),
(388, 306, 31),
(389, 307, 29),
(390, 307, 30),
(391, 307, 31),
(392, 308, 29),
(393, 308, 31),
(394, 309, 29),
(395, 310, 31),
(396, 311, 29),
(397, 311, 30),
(398, 311, 31),
(399, 312, 29),
(400, 312, 31),
(401, 314, 29),
(402, 314, 30),
(403, 314, 31),
(404, 315, 29),
(405, 315, 30),
(406, 315, 31),
(407, 313, 29),
(408, 313, 30),
(409, 313, 31),
(410, 317, 30),
(411, 319, 29),
(412, 319, 31),
(413, 318, 31),
(414, 320, 30),
(415, 321, 29),
(416, 322, 30),
(417, 322, 31),
(418, 323, 31),
(419, 324, 30),
(420, 326, 29),
(421, 326, 31),
(422, 325, 31),
(423, 327, 29),
(424, 327, 31),
(425, 328, 29),
(426, 329, 29),
(427, 329, 31),
(428, 330, 29),
(429, 331, 31),
(430, 332, 29),
(431, 332, 31),
(432, 304, 34),
(433, 333, 31),
(434, 334, 31),
(435, 335, 29),
(436, 336, 29),
(437, 337, 30),
(438, 338, 31),
(439, 339, 31),
(440, 340, 31),
(441, 341, 30),
(442, 271, 29),
(443, 271, 30),
(444, 342, 31),
(445, 343, 29),
(446, 344, 31),
(447, 345, 29),
(448, 346, 29),
(449, 347, 30),
(450, 348, 31),
(451, 349, 29),
(452, 349, 31),
(453, 351, 30),
(454, 351, 31),
(455, 352, 31),
(456, 353, 31),
(457, 354, 31),
(458, 355, 31),
(459, 356, 29),
(460, 357, 29),
(461, 358, 31),
(462, 359, 30),
(463, 359, 31),
(464, 360, 29),
(465, 360, 30),
(466, 360, 31),
(467, 361, 29),
(468, 361, 30),
(469, 362, 31),
(470, 363, 30),
(471, 363, 31),
(472, 364, 32);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Volcar la base de datos para la tabla `unidad_educativa`
--

INSERT INTO `unidad_educativa` (`id`, `establecimiento_id`, `nivel_id`, `descripcion`, `cargo_autoridad_id`, `nombre_autoridad`, `actualizado`, `creado`) VALUES
(43, 13, 29, 'inicial', 14, 'La señorita Cunegunda', '2014-04-07 14:24:55', '0000-00-00 00:00:00'),
(44, 13, 30, 'primaria', 7, 'La señorita Cunegunda directora de primaria', '2014-04-07 14:24:55', '0000-00-00 00:00:00'),
(45, 13, 31, 'media', NULL, NULL, '2014-04-07 14:24:55', '0000-00-00 00:00:00'),
(46, 13, 32, 'terciario', NULL, NULL, '2014-04-07 14:24:55', '0000-00-00 00:00:00'),
(47, 14, 30, NULL, NULL, NULL, '2014-09-22 13:52:22', '0000-00-00 00:00:00'),
(48, 14, 31, NULL, NULL, NULL, '2014-09-22 13:52:22', '0000-00-00 00:00:00'),
(49, 14, 32, NULL, NULL, NULL, '2014-09-22 13:52:22', '0000-00-00 00:00:00'),
(51, 15, 31, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 15, 30, NULL, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 17, 32, NULL, 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 19, 29, NULL, NULL, NULL, '2014-03-07 10:04:02', '0000-00-00 00:00:00'),
(55, 19, 30, NULL, NULL, NULL, '2014-03-07 10:06:14', '0000-00-00 00:00:00'),
(56, 19, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 19, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 20, 29, NULL, 14, 'López Patricia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 20, 30, NULL, 7, 'Franciosi, Andrea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 20, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 20, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 22, 29, NULL, 14, 'Sesé Marcela', '2014-03-07 11:36:07', '0000-00-00 00:00:00'),
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
(83, 16, 32, NULL, 9, NULL, '2014-09-22 13:52:38', '0000-00-00 00:00:00'),
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
(101, 18, 30, NULL, NULL, NULL, '2014-03-07 09:25:58', '0000-00-00 00:00:00'),
(102, 18, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 18, 32, NULL, 9, NULL, '2014-03-07 09:24:28', '0000-00-00 00:00:00'),
(104, 23, 29, NULL, 14, 'Kempner Dina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 23, 30, NULL, 7, 'Garcia, Maria Celia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 23, 31, NULL, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 23, 32, NULL, 9, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 14, 29, NULL, 14, 'Fornek, Marcela', '2014-09-22 13:52:22', '0000-00-00 00:00:00'),
(109, 33, 32, NULL, 11, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 15, 32, 'turnos chequeados', NULL, NULL, '2014-03-05 11:37:35', '0000-00-00 00:00:00'),
(111, 15, 29, 'recientemente creado', NULL, NULL, '2015-05-07 14:19:00', '2015-05-07 14:19:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_oferta`
--

CREATE TABLE IF NOT EXISTS `unidad_oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oferta_educativa_id` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  `localizacion_id` int(11) DEFAULT NULL,
  `salas_inicial_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_95C6F11D83FF791E` (`salas_inicial_id`),
  KEY `IDX_95C6F11D15CE31DF` (`oferta_educativa_id`),
  KEY `IDX_95C6F11DC851F487` (`localizacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=365 ;

--
-- Volcar la base de datos para la tabla `unidad_oferta`
--

INSERT INTO `unidad_oferta` (`id`, `oferta_educativa_id`, `creado`, `actualizado`, `localizacion_id`, `salas_inicial_id`) VALUES
(1, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(2, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(3, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(4, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(5, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(6, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(7, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(8, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(9, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(11, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(12, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(13, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(14, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(15, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(16, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(17, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(18, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(19, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(20, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(21, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(22, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(23, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(24, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(25, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(26, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(27, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(28, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(29, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(30, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(31, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(32, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(33, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(34, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(35, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(36, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(37, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(38, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(40, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(41, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(42, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(43, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(44, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(45, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(46, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(47, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(48, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(49, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(50, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(51, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(52, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(53, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(54, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(55, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(56, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(57, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(59, 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(60, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(62, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(63, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(64, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(66, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(67, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(68, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(69, 49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(70, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(71, 51, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(72, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(73, 53, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(74, 54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(75, 55, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(76, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(77, 57, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(78, 58, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(79, 59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(80, 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(81, 61, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(82, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(83, 63, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(84, 64, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(85, 65, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(86, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(87, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(88, 68, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(89, 69, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(90, 70, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(91, 71, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(92, 72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(93, 73, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(94, 74, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(96, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(97, 77, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(98, 78, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(103, 75, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(119, 82, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(120, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(121, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(122, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(134, 13, '2014-03-06 14:43:39', '2014-03-06 14:43:39', NULL, NULL),
(135, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(136, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(137, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(138, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(139, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(140, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(141, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(142, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(143, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(144, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(145, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(146, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(147, 15, '2014-09-18 13:05:27', '2014-09-18 13:05:27', NULL, NULL),
(149, 85, '2014-09-22 15:25:21', '2014-09-22 15:25:24', NULL, NULL),
(150, 85, '2014-09-22 13:27:41', '2014-09-22 13:27:42', NULL, NULL),
(151, 15, '2014-09-22 13:31:07', '2014-09-22 13:31:08', NULL, NULL),
(152, 85, '2014-09-22 13:31:53', '2014-09-22 13:31:54', NULL, NULL),
(153, 15, '2014-09-22 13:32:37', '2014-09-22 13:32:37', NULL, NULL),
(154, 15, '2014-09-22 13:34:39', '2014-09-22 13:34:39', NULL, NULL),
(155, 85, '2014-09-22 13:35:06', '2014-09-22 13:35:06', NULL, NULL),
(156, 15, '2014-09-22 13:35:51', '2014-09-22 13:35:51', NULL, NULL),
(157, 85, '2014-09-22 13:36:34', '2014-09-22 13:36:34', NULL, NULL),
(158, 85, '2014-09-22 13:37:15', '2014-09-22 13:37:15', NULL, NULL),
(159, 15, '2014-09-22 13:37:35', '2014-09-22 13:37:35', NULL, NULL),
(160, 15, '2014-09-22 13:38:28', '2014-09-22 13:38:29', NULL, NULL),
(161, 85, '2014-09-22 13:39:07', '2014-09-22 13:39:07', NULL, NULL),
(162, 15, '2014-09-22 13:39:51', '2014-09-22 13:39:52', NULL, NULL),
(163, 85, '2014-09-22 13:40:22', '2014-09-22 13:40:22', NULL, NULL),
(164, 15, '2014-09-22 13:40:57', '2014-09-22 13:40:57', NULL, NULL),
(165, 85, '2014-09-22 13:42:31', '2014-09-22 13:42:31', NULL, NULL),
(166, 15, '2014-09-22 13:43:32', '2014-09-22 13:43:32', NULL, NULL),
(167, 85, '2014-09-22 13:44:06', '2014-09-22 13:44:06', NULL, NULL),
(168, 85, '2014-09-22 13:45:00', '2014-09-22 13:45:01', NULL, NULL),
(169, 15, '2014-09-22 13:45:17', '2014-09-22 13:45:17', NULL, NULL),
(170, 15, '2014-09-22 13:46:05', '2014-09-22 13:46:06', NULL, NULL),
(171, 85, '2014-09-22 13:46:38', '2014-09-22 13:46:38', NULL, NULL),
(172, 15, '2014-09-22 13:47:28', '2014-09-22 13:47:28', NULL, NULL),
(173, 85, '2014-09-22 13:47:54', '2014-09-22 13:47:54', NULL, NULL),
(174, 85, '2014-09-22 13:48:41', '2014-09-22 13:48:42', NULL, NULL),
(175, 15, '2014-09-22 13:49:16', '2014-09-22 13:49:16', NULL, NULL),
(176, 86, '2014-09-26 14:15:17', '2014-09-26 14:15:17', NULL, NULL),
(178, 86, '2014-09-26 14:15:34', '2014-09-26 14:15:34', NULL, NULL),
(179, 87, '2014-09-26 14:22:50', '2014-09-26 14:22:50', NULL, NULL),
(180, 87, '2014-09-26 14:22:52', '2014-09-26 14:22:52', NULL, NULL),
(181, 87, '2014-09-26 14:22:53', '2014-09-26 14:22:53', NULL, NULL),
(182, 87, '2014-09-26 14:22:54', '2014-09-26 14:22:54', NULL, NULL),
(183, 87, '2014-09-26 14:22:55', '2014-09-26 14:22:55', NULL, NULL),
(185, 87, '2014-09-26 14:22:58', '2014-09-26 14:22:58', NULL, NULL),
(186, 87, '2014-09-26 14:22:59', '2014-09-26 14:22:59', NULL, NULL),
(187, 87, '2014-09-26 14:23:06', '2014-09-26 14:23:06', NULL, NULL),
(188, 87, '2014-09-26 14:23:08', '2014-09-26 14:23:08', NULL, NULL),
(189, 87, '2014-09-26 14:23:09', '2014-09-26 14:23:09', NULL, NULL),
(191, 87, '2014-09-26 14:23:23', '2014-09-26 14:23:23', NULL, NULL),
(193, 86, '2014-09-29 13:13:41', '2014-09-29 13:13:41', NULL, NULL),
(194, 86, '2014-09-29 13:13:43', '2014-09-29 13:13:43', NULL, NULL),
(195, 86, '2014-09-29 13:13:45', '2014-09-29 13:13:45', NULL, NULL),
(196, 86, '2014-09-29 13:13:46', '2014-09-29 13:13:46', NULL, NULL),
(197, 86, '2014-09-29 13:13:47', '2014-09-29 13:13:47', NULL, NULL),
(198, 86, '2014-09-29 13:13:48', '2014-09-29 13:13:48', NULL, NULL),
(199, 86, '2014-09-29 13:13:50', '2014-09-29 13:13:50', NULL, NULL),
(200, 86, '2014-09-29 13:13:51', '2014-09-29 13:13:51', NULL, NULL),
(202, 86, '2014-09-29 13:14:10', '2014-09-29 13:14:10', NULL, NULL),
(203, 86, '2014-09-29 13:14:14', '2014-09-29 13:14:14', NULL, NULL),
(204, 89, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(205, 90, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(206, 91, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(207, 92, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(208, 93, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(209, 94, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(210, 95, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(211, 96, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(212, 97, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(214, 99, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(215, 100, '2014-10-07 14:17:34', '2014-10-07 14:17:34', NULL, NULL),
(216, 101, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(217, 101, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(218, 102, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(219, 103, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(220, 103, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(221, 103, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(222, 104, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(223, 105, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(224, 106, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(225, 106, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(226, 106, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(227, 107, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(228, 108, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(229, 108, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(230, 109, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(231, 109, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(232, 109, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(233, 110, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(234, 110, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(235, 111, '2014-10-07 14:17:35', '2014-10-07 14:17:35', NULL, NULL),
(236, 112, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(237, 113, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(238, 114, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(239, 115, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(240, 116, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(241, 116, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(242, 117, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(243, 117, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(244, 118, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(245, 119, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(246, 120, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(247, 121, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(248, 121, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(249, 121, '2014-10-07 14:17:36', '2014-10-07 14:17:36', NULL, NULL),
(250, 122, '2014-10-07 14:17:36', '2014-10-07 14:17:37', NULL, NULL),
(251, 123, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(252, 123, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(253, 124, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(254, 124, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(255, 125, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(256, 125, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(257, 126, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(258, 127, '2014-10-07 14:17:37', '2014-10-07 14:17:37', NULL, NULL),
(261, 86, '2015-05-07 14:08:49', '2015-05-07 14:08:49', 39, NULL),
(262, 86, '2015-05-07 14:08:51', '2015-05-07 14:08:51', 97, NULL),
(263, 86, '2015-05-07 14:08:53', '2015-05-07 14:08:53', 88, NULL),
(271, 86, '2015-05-07 14:09:25', '2015-05-07 14:09:25', 80, NULL),
(272, 87, '2015-05-07 14:12:40', '2015-05-07 14:12:40', 39, NULL),
(278, 87, '2015-05-07 14:20:15', '2015-05-07 14:20:15', 98, NULL),
(279, 87, '2015-05-07 14:21:35', '2015-05-07 14:21:35', 97, NULL),
(280, 87, '2015-05-07 14:21:37', '2015-05-07 14:21:37', 88, NULL),
(281, 86, '2015-05-07 14:23:25', '2015-05-07 14:23:25', 49, NULL),
(282, 87, '2015-05-07 14:23:28', '2015-05-07 14:23:28', 49, NULL),
(283, 86, '2015-05-07 14:25:28', '2015-05-07 14:25:28', 53, NULL),
(284, 87, '2015-05-07 14:25:32', '2015-05-07 14:25:32', 53, NULL),
(285, 86, '2015-05-07 14:26:35', '2015-05-07 14:26:35', 94, NULL),
(286, 6, '2015-05-07 14:27:56', '2015-05-07 14:27:56', 94, NULL),
(288, 87, '2015-05-07 14:30:11', '2015-05-07 14:30:11', 57, NULL),
(289, 86, '2015-05-07 14:30:14', '2015-05-07 14:30:14', 57, NULL),
(290, 86, '2015-05-07 14:30:57', '2015-05-07 14:30:57', 42, NULL),
(291, 87, '2015-05-07 14:31:34', '2015-05-07 14:31:34', 42, NULL),
(292, 86, '2015-05-07 14:32:26', '2015-05-07 14:32:26', 61, NULL),
(293, 87, '2015-05-07 14:32:29', '2015-05-07 14:32:29', 61, NULL),
(294, 87, '2015-05-07 14:35:28', '2015-05-07 14:35:28', 102, NULL),
(295, 86, '2015-05-07 14:35:30', '2015-05-07 14:35:30', 102, NULL),
(296, 86, '2015-05-07 14:35:57', '2015-05-07 14:35:57', 66, NULL),
(297, 87, '2015-05-07 14:36:00', '2015-05-07 14:36:00', 66, NULL),
(298, 106, '2015-05-07 14:37:13', '2015-05-07 14:37:13', 70, NULL),
(299, 110, '2015-05-07 14:40:40', '2015-05-07 14:40:40', 70, NULL),
(300, 121, '2015-05-07 14:42:04', '2015-05-07 14:42:04', 70, NULL),
(301, 125, '2015-05-07 14:44:15', '2015-05-07 14:44:15', 70, NULL),
(302, 102, '2015-05-07 14:51:47', '2015-05-07 14:51:47', 71, NULL),
(304, 41, '2015-05-07 14:54:08', '2015-05-07 14:54:08', 94, NULL),
(305, 89, '2015-05-07 14:56:19', '2015-05-07 14:56:19', 78, NULL),
(306, 90, '2015-05-07 14:58:13', '2015-05-07 14:58:13', 96, NULL),
(307, 121, '2015-05-07 14:59:22', '2015-05-07 14:59:22', 96, NULL),
(308, 121, '2015-05-07 14:59:28', '2015-05-07 14:59:28', 78, NULL),
(309, 116, '2015-05-07 15:01:41', '2015-05-07 15:01:41', 96, NULL),
(310, 116, '2015-05-07 15:01:46', '2015-05-07 15:01:46', 45, NULL),
(311, 106, '2015-05-07 15:04:27', '2015-05-07 15:04:27', 96, NULL),
(312, 106, '2015-05-07 15:04:33', '2015-05-07 15:04:33', 78, NULL),
(313, 101, '2015-05-07 15:06:22', '2015-05-07 15:06:22', 83, NULL),
(314, 101, '2015-05-07 15:06:27', '2015-05-07 15:06:27', 84, NULL),
(315, 97, '2015-05-07 15:07:14', '2015-05-07 15:07:14', 84, NULL),
(317, 127, '2015-05-07 15:10:05', '2015-05-07 15:10:05', 96, NULL),
(318, 124, '2015-05-07 15:11:14', '2015-05-07 15:11:14', 45, NULL),
(319, 124, '2015-05-07 15:11:20', '2015-05-07 15:11:20', 96, NULL),
(320, 122, '2015-05-07 15:12:38', '2015-05-07 15:12:38', 96, NULL),
(321, 126, '2015-05-07 15:13:59', '2015-05-07 15:13:59', 96, NULL),
(322, 125, '2015-05-07 15:14:55', '2015-05-07 15:14:55', 78, NULL),
(323, 113, '2015-05-07 15:16:18', '2015-05-07 15:16:18', 45, NULL),
(324, 112, '2015-05-07 15:17:13', '2015-05-07 15:17:13', 96, NULL),
(325, 108, '2015-05-07 15:18:40', '2015-05-07 15:18:40', 45, NULL),
(326, 108, '2015-05-07 15:18:45', '2015-05-07 15:18:45', 71, NULL),
(327, 128, '2015-05-07 15:39:34', '2015-05-07 15:39:34', 94, NULL),
(328, 103, '2015-05-13 09:17:41', '2015-05-13 09:17:41', 71, NULL),
(329, 105, '2015-05-13 09:19:37', '2015-05-13 09:19:37', 71, NULL),
(330, 109, '2015-05-13 09:20:41', '2015-05-13 09:20:41', 71, NULL),
(331, 111, '2015-05-13 09:21:27', '2015-05-13 09:21:27', 71, NULL),
(332, 49, '2015-05-13 09:22:03', '2015-05-13 09:22:03', 71, NULL),
(333, 129, '2015-05-13 14:53:54', '2015-05-13 14:53:54', 75, NULL),
(334, 91, '2015-05-14 14:08:11', '2015-05-14 14:08:11', 96, NULL),
(335, 92, '2015-05-14 14:09:16', '2015-05-14 14:09:16', 96, NULL),
(336, 93, '2015-05-14 14:10:18', '2015-05-14 14:10:18', 96, NULL),
(337, 94, '2015-05-14 14:11:08', '2015-05-14 14:11:08', 96, NULL),
(338, 96, '2015-05-14 14:12:09', '2015-05-14 14:12:09', 81, NULL),
(339, 96, '2015-05-14 14:12:11', '2015-05-14 14:12:11', 82, NULL),
(340, 86, '2015-05-14 14:13:43', '2015-05-14 14:13:43', 75, NULL),
(341, 99, '2015-05-14 14:14:58', '2015-05-14 14:14:58', 96, NULL),
(342, 87, '2015-05-14 14:16:25', '2015-05-14 14:16:25', 75, NULL),
(343, 100, '2015-05-14 14:17:30', '2015-05-14 14:17:30', 78, NULL),
(344, 103, '2015-05-14 14:19:09', '2015-05-14 14:19:09', 45, NULL),
(345, 103, '2015-05-14 14:19:30', '2015-05-14 14:19:30', 96, NULL),
(346, 104, '2015-05-14 14:20:23', '2015-05-14 14:20:23', 78, NULL),
(347, 107, '2015-05-14 14:22:02', '2015-05-14 14:22:02', 96, NULL),
(348, 109, '2015-05-14 14:23:15', '2015-05-14 14:23:15', 45, NULL),
(349, 109, '2015-05-14 14:23:42', '2015-05-14 14:23:42', 96, NULL),
(351, 110, '2015-05-14 14:24:42', '2015-05-14 14:24:42', 78, NULL),
(352, 114, '2015-05-14 14:26:19', '2015-05-14 14:26:19', 81, NULL),
(353, 114, '2015-05-14 14:26:22', '2015-05-14 14:26:22', 82, NULL),
(354, 95, '2015-05-14 14:27:07', '2015-05-14 14:27:07', 81, NULL),
(355, 95, '2015-05-14 14:27:09', '2015-05-14 14:27:09', 82, NULL),
(356, 115, '2015-05-14 14:28:09', '2015-05-14 14:28:09', 96, NULL),
(357, 117, '2015-05-14 14:29:10', '2015-05-14 14:29:10', 78, NULL),
(358, 117, '2015-05-14 14:29:40', '2015-05-14 14:29:40', 96, NULL),
(359, 118, '2015-05-14 14:30:25', '2015-05-14 14:30:25', 96, NULL),
(360, 119, '2015-05-14 14:31:17', '2015-05-14 14:31:17', 96, NULL),
(361, 120, '2015-05-14 14:32:02', '2015-05-14 14:32:02', 96, NULL),
(362, 123, '2015-05-14 14:33:01', '2015-05-14 14:33:01', 45, NULL),
(363, 123, '2015-05-14 14:33:03', '2015-05-14 14:33:03', 96, NULL),
(364, 57, '2015-05-14 14:35:01', '2015-05-14 14:35:01', 45, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `password`, `salt`, `direccion`, `permite_mail`, `fecha_alta`, `fecha_nacimiento`, `dni`, `nombre_usuario`, `conexion_anterior`, `actualizado`, `creado`, `conexion_actual`, `rol`) VALUES
(11, 'Juan', 'Perez', 'jp@jp.com.ar', 'H3eY4UnHdXuNfkHdqX5B0Chm7WIRMNGxevv3Ojgu8IVaLFNEDHxlJ4HEhUU3Zg1w+mtLoVjY/xf6EWG/0M4jnw==', 'cca869da65d0697abf2b9c683ab020ab', NULL, 0, '2012-10-29 14:55:14', NULL, NULL, 'juan', '2014-02-21 17:16:16', '2014-09-25 10:00:49', '0000-00-00 00:00:00', '2014-09-25 10:00:49', 'ROLE_USER'),
(12, 'Marcelo', 'Prizmic', 'mp@mp.com.ar', 'H2M3+bRrxaeJRi6w06qugs5H1e08SxW+G1IcXBh5rVDMM3BygrwKrntJ+H9kc19DLcUASYmZ/gUzubWnWeNa+A==', '85d9a3e715c90058f0cd91d51b62de9a', NULL, 0, '2012-10-29 14:55:14', '1963-02-23 00:00:00', NULL, 'marcelo', '2015-05-22 09:35:08', '2015-05-22 09:38:09', '0000-00-00 00:00:00', '2015-05-22 09:38:09', 'ROLE_SUPER_ADMIN'),
(13, 'secreataria', 'dfd', 'xx@cc.com', 'zSUjLyUFmW2HYrAROe4sNnX6QCj+wLvUIlOce54aRlCTqY7pC/OKhWh0Ma6uEEdFyUZZ/uiXpiPXmkJruCxW5A==', '2404f39d0f051dab2c13ac5700ce2b32', NULL, 0, '2014-02-20 18:30:16', '1903-04-03 00:00:00', NULL, 'secretaria', '2014-09-25 10:37:08', '2014-10-27 12:30:42', '2014-02-20 18:30:16', '2014-10-27 12:30:41', 'ROLE_ADMIN'),
(14, 'lili', 'garcia dominguez', 'g@g.com', 'zSUjLyUFmW2HYrAROe4sNnX6QCj+wLvUIlOce54aRlCTqY7pC/OKhWh0Ma6uEEdFyUZZ/uiXpiPXmkJruCxW5A==', '2404f39d0f051dab2c13ac5700ce2b32', NULL, 0, '2014-02-20 18:46:03', NULL, NULL, 'lili', '2014-09-25 10:06:13', '2014-09-26 14:19:15', '2014-02-20 18:46:03', '2014-09-26 14:19:15', 'ROLE_ADMIN'),
(15, 'andres', 'zetko', 'a@a.com', 'zSUjLyUFmW2HYrAROe4sNnX6QCj+wLvUIlOce54aRlCTqY7pC/OKhWh0Ma6uEEdFyUZZ/uiXpiPXmkJruCxW5A==', '2404f39d0f051dab2c13ac5700ce2b32', NULL, 0, '2014-02-20 19:12:58', NULL, NULL, 'andres', '2015-05-12 14:48:36', '2015-05-14 10:32:08', '2014-02-20 19:12:58', '2015-05-14 10:32:08', 'ROLE_USUARIO'),
(20, 'Graciela', 'Leclerq', 'gqq@gqqq.com', '/5EeOFpKHXaQqOcDYqkOtQxbbETV4AHgLC9I/ubthg8AIGepC4cndTnmqx9Lt6GHx7LxtrR6WxGoiQlzenou4w==', '4682f71e288122c980a907a44ed353cc', NULL, 0, '2014-03-11 09:12:11', '2000-01-01 00:00:00', NULL, 'graciela', NULL, '2014-03-11 09:12:54', '2014-03-11 09:12:11', NULL, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacancia`
--

CREATE TABLE IF NOT EXISTS `vacancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `vacancia`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `vecino`
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
(18, 40, 'Colegio Nº 3 “Mariano Moreno”', '2014-02-27 17:07:44', '2014-02-27 17:07:44'),
(19, 58, 'Escuela 10 D.E. 19', '2014-05-13 06:53:30', '2014-03-10 11:58:25');

--
-- Filtros para las tablas descargadas (dump)
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
-- Filtros para la tabla `establecimiento_recurso`
--
ALTER TABLE `establecimiento_recurso`
  ADD CONSTRAINT `FK_D4968F6271B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_D4968F62E52B6C4E` FOREIGN KEY (`recurso_id`) REFERENCES `recurso` (`id`),
  ADD CONSTRAINT `FK_D4968F62EA54AA7B` FOREIGN KEY (`origen_hora_id`) REFERENCES `origen_hora` (`id`);

--
-- Filtros para la tabla `inicial`
--
ALTER TABLE `inicial`
  ADD CONSTRAINT `FK_73E9728915CE31DF` FOREIGN KEY (`oferta_educativa_id`) REFERENCES `oferta_educativa` (`id`);

--
-- Filtros para la tabla `llamado`
--
ALTER TABLE `llamado`
  ADD CONSTRAINT `FK_56DB349071B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_56DB34907D89F04A` FOREIGN KEY (`caracter_id`) REFERENCES `caracter` (`id`),
  ADD CONSTRAINT `FK_56DB3490F9E584F8` FOREIGN KEY (`motivo_id`) REFERENCES `licencia` (`id`);

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
-- Filtros para la tabla `primario_x`
--
ALTER TABLE `primario_x`
  ADD CONSTRAINT `FK_C8B17359D1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`);

--
-- Filtros para la tabla `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `FK_E226041C36ED91FF` FOREIGN KEY (`grupo_etario_id`) REFERENCES `grupo_etario` (`id`),
  ADD CONSTRAINT `FK_E226041C940B40B8` FOREIGN KEY (`inicial_x_id`) REFERENCES `inicial_x` (`id`);

--
-- Filtros para la tabla `titulo_carrera`
--
ALTER TABLE `titulo_carrera`
  ADD CONSTRAINT `FK_955288BA9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_carrera` (`id`),
  ADD CONSTRAINT `FK_955288BAC671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `unidadoferta_turno`
--
ALTER TABLE `unidadoferta_turno`
  ADD CONSTRAINT `FK_5922913769C5211E` FOREIGN KEY (`turno_id`) REFERENCES `turno` (`id`),
  ADD CONSTRAINT `FK_59229137D1F42FF` FOREIGN KEY (`unidad_oferta_id`) REFERENCES `unidad_oferta` (`id`);

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
  ADD CONSTRAINT `FK_95C6F11D83FF791E` FOREIGN KEY (`salas_inicial_id`) REFERENCES `inicial_x` (`id`),
  ADD CONSTRAINT `FK_95C6F11DC851F487` FOREIGN KEY (`localizacion_id`) REFERENCES `localizacion` (`id`);

--
-- Filtros para la tabla `vecino`
--
ALTER TABLE `vecino`
  ADD CONSTRAINT `FK_758D25E08A652BD6` FOREIGN KEY (`edificio_id`) REFERENCES `edificio` (`id`);
