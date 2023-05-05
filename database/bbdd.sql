-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-05-2017 a las 12:57:58
-- Versión del servidor: 5.5.42
-- Versión de PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `Formulari`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inscripcio`
--

DROP TABLE IF EXISTS `Inscripcio`;
CREATE TABLE `Inscripcio` (
  `Nom` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Data_naixement` varchar(155) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Inscripcio`
--

INSERT INTO `Inscripcio` (`Nom`, `Mail`, `Data_naixement`, `Username`, `Password`) VALUES
('Ivan', 'ivan@gmail.com', '1999-02-03', 'JRosS91', 'de');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Inscripcio`
--
ALTER TABLE `Inscripcio`
  ADD PRIMARY KEY (`Username`);
