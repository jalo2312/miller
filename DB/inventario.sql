-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2024 a las 14:36:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliares`
--

CREATE TABLE `auxiliares` (
  `aux_cedula` int(11) NOT NULL,
  `aux_nombre` varchar(100) NOT NULL,
  `aux_primer_apellido` varchar(50) NOT NULL,
  `aux_segundo_apellido` varchar(50) NOT NULL,
  `aux_estado` varchar(30) NOT NULL,
  `aux_cargo` varchar(30) NOT NULL,
  `aux_telefono` int(10) NOT NULL,
  `dot_cod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliar_herramientas`
--

CREATE TABLE `auxiliar_herramientas` (
  `auxher_id` int(11) NOT NULL,
  `aux_cedula` int(11) NOT NULL,
  `her_cod` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dotaciones`
--

CREATE TABLE `dotaciones` (
  `dot_cod` varchar(50) NOT NULL,
  `dot_descripcion` varchar(100) NOT NULL,
  `dot_fecha_llegada` date NOT NULL,
  `dot_estado` varchar(50) NOT NULL,
  `dot_observacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `equi_serial` varchar(50) NOT NULL,
  `equi_numero_salida` varchar(30) NOT NULL,
  `equi_fecha_entrega` date NOT NULL,
  `equi_descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `her_cod` varchar(15) NOT NULL,
  `her_tipo` varchar(20) NOT NULL,
  `her_descripcion` varchar(100) NOT NULL,
  `her_estado` varchar(30) NOT NULL,
  `her_fecha_entrada` date NOT NULL,
  `her_fecha_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `tec_cedula` int(11) NOT NULL,
  `tec_nombre` varchar(100) NOT NULL,
  `tec_primer_apellido` varchar(50) NOT NULL,
  `tec_segundo_apellido` varchar(50) NOT NULL,
  `tec_estado` varchar(30) NOT NULL,
  `tec_cargo` varchar(30) NOT NULL,
  `tec_telefono` int(11) NOT NULL,
  `dot_cod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico_equipos`
--

CREATE TABLE `tecnico_equipos` (
  `tecequi_id` int(11) NOT NULL,
  `tec_cedula` int(11) NOT NULL,
  `equi_serial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico_herramientas`
--

CREATE TABLE `tecnico_herramientas` (
  `techer_id` int(11) NOT NULL,
  `tec_cedula` int(11) NOT NULL,
  `her_cod` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auxiliares`
--
ALTER TABLE `auxiliares`
  ADD PRIMARY KEY (`aux_cedula`),
  ADD KEY `dot_cod` (`dot_cod`);

--
-- Indices de la tabla `auxiliar_herramientas`
--
ALTER TABLE `auxiliar_herramientas`
  ADD PRIMARY KEY (`auxher_id`),
  ADD KEY `aux_cedula` (`aux_cedula`),
  ADD KEY `her_cod` (`her_cod`);

--
-- Indices de la tabla `dotaciones`
--
ALTER TABLE `dotaciones`
  ADD PRIMARY KEY (`dot_cod`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`equi_serial`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`her_cod`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`tec_cedula`),
  ADD KEY `dot_cod` (`dot_cod`);

--
-- Indices de la tabla `tecnico_equipos`
--
ALTER TABLE `tecnico_equipos`
  ADD PRIMARY KEY (`tecequi_id`),
  ADD KEY `tec_cedula` (`tec_cedula`),
  ADD KEY `equi_serial` (`equi_serial`);

--
-- Indices de la tabla `tecnico_herramientas`
--
ALTER TABLE `tecnico_herramientas`
  ADD PRIMARY KEY (`techer_id`),
  ADD KEY `tec_cedula` (`tec_cedula`),
  ADD KEY `her_cod` (`her_cod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auxiliar_herramientas`
--
ALTER TABLE `auxiliar_herramientas`
  MODIFY `auxher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnico_equipos`
--
ALTER TABLE `tecnico_equipos`
  MODIFY `tecequi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnico_herramientas`
--
ALTER TABLE `tecnico_herramientas`
  MODIFY `techer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auxiliares`
--
ALTER TABLE `auxiliares`
  ADD CONSTRAINT `auxiliares_ibfk_2` FOREIGN KEY (`dot_cod`) REFERENCES `dotaciones` (`dot_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auxiliar_herramientas`
--
ALTER TABLE `auxiliar_herramientas`
  ADD CONSTRAINT `auxiliar_herramientas_ibfk_1` FOREIGN KEY (`aux_cedula`) REFERENCES `auxiliares` (`aux_cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auxiliar_herramientas_ibfk_2` FOREIGN KEY (`her_cod`) REFERENCES `herramientas` (`her_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD CONSTRAINT `tecnicos_ibfk_1` FOREIGN KEY (`dot_cod`) REFERENCES `dotaciones` (`dot_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnico_equipos`
--
ALTER TABLE `tecnico_equipos`
  ADD CONSTRAINT `tecnico_equipos_ibfk_1` FOREIGN KEY (`tec_cedula`) REFERENCES `tecnicos` (`tec_cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tecnico_equipos_ibfk_2` FOREIGN KEY (`equi_serial`) REFERENCES `equipos` (`equi_serial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnico_herramientas`
--
ALTER TABLE `tecnico_herramientas`
  ADD CONSTRAINT `tecnico_herramientas_ibfk_1` FOREIGN KEY (`tec_cedula`) REFERENCES `tecnicos` (`tec_cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tecnico_herramientas_ibfk_2` FOREIGN KEY (`her_cod`) REFERENCES `herramientas` (`her_cod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
