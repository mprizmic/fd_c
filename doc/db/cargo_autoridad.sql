-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-10-2015 a las 17:20:00
-- Versión del servidor: 5.5.44-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `agenda_fd`
--

--
-- Truncar tablas antes de insertar `cargo_autoridad`
--

TRUNCATE TABLE `cargo`;
--
-- Volcado de datos para la tabla `cargo_autoridad`
--

INSERT INTO `cargo` (`id`, `nombre`, `codigo`) VALUES
(7, 'Regente de Primaria', 'RNP'),
(9, 'Regente Terciario', 'RNT'),
(11, 'Rector/a', 'REC'),
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
(29, 'Prosecretario de Media', 'PRONM'),
(30, 'Jubilado/a', 'JUB'),
(31, 'Regente Secretario Académico', 'RSA'),
(32, 'Regente PEI', 'RPEI'),
(33, 'Regente PEP', 'RPEP'),
(34, 'Vicerrector TM', 'VTM'),
(35, 'Vicerrector TT', 'VTT');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
