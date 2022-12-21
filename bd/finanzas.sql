-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2021 a las 20:11:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finanzas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_gasto`
--

CREATE TABLE `detalles_gasto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gasto` int(11) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `tipo_gasto` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ingreso`
--

CREATE TABLE `detalles_ingreso` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ingreso` int(11) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `tipo_ingreso` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id_mb` int(10) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED NOT NULL,
  `nombres_mb` varchar(50) NOT NULL,
  `apellidos_mb` varchar(50) NOT NULL,
  `telefono_mb` bigint(11) NOT NULL,
  `correo_mb` varchar(70) NOT NULL,
  `usuario_mb` varchar(50) NOT NULL,
  `clave_mb` varchar(50) NOT NULL,
  `rol_familiar_mb` varchar(50) NOT NULL,
  `archivado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_mb`, `id_admin`, `nombres_mb`, `apellidos_mb`, `telefono_mb`, `correo_mb`, `usuario_mb`, `clave_mb`, `rol_familiar_mb`, `archivado`) VALUES
(1, 1, 'Juan Solano', 'Vastidas', 786322, 'solano@hgmail.com', 'solano', '1234', 'Editor', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos`
--

CREATE TABLE `objetivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_principales`
--

CREATE TABLE `usuarios_principales` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `nombres_admin` varchar(50) NOT NULL,
  `apellidos_admin` varchar(50) NOT NULL,
  `telefono_admin` bigint(11) NOT NULL,
  `correo_admin` varchar(70) NOT NULL,
  `usuario_admin` varchar(50) NOT NULL,
  `clave_admin` varchar(50) NOT NULL,
  `rol_familiar_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_principales`
--

INSERT INTO `usuarios_principales` (`id_admin`, `nombres_admin`, `apellidos_admin`, `telefono_admin`, `correo_admin`, `usuario_admin`, `clave_admin`, `rol_familiar_admin`) VALUES
(1, 'Andres Felipe', 'Obando', 722324, 'andres@gmail.com', 'andres', '123', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_gasto`
--
ALTER TABLE `detalles_gasto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gasto` (`id_gasto`);

--
-- Indices de la tabla `detalles_ingreso`
--
ALTER TABLE `detalles_ingreso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ingreso` (`id_ingreso`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id_mb`),
  ADD UNIQUE KEY `correo_mb` (`correo_mb`) USING BTREE,
  ADD UNIQUE KEY `usuario_mb` (`usuario_mb`),
  ADD KEY `id_admin` (`id_admin`);
ALTER TABLE `miembros` ADD FULLTEXT KEY `nombres_mb` (`nombres_mb`,`apellidos_mb`);

--
-- Indices de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `usuarios_principales`
--
ALTER TABLE `usuarios_principales`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `correo_admin` (`correo_admin`),
  ADD UNIQUE KEY `usuario_admin` (`usuario_admin`);
ALTER TABLE `usuarios_principales` ADD FULLTEXT KEY `nombres_admin` (`nombres_admin`,`apellidos_admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_gasto`
--
ALTER TABLE `detalles_gasto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_ingreso`
--
ALTER TABLE `detalles_ingreso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_mb` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_principales`
--
ALTER TABLE `usuarios_principales`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_gasto`
--
ALTER TABLE `detalles_gasto`
  ADD CONSTRAINT `detalles_gasto_ibfk_1` FOREIGN KEY (`id_gasto`) REFERENCES `gastos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_ingreso`
--
ALTER TABLE `detalles_ingreso`
  ADD CONSTRAINT `detalles_ingreso_ibfk_1` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuarios_principales` (`id_admin`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuarios_principales` (`id_admin`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `miembros_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuarios_principales` (`id_admin`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `objetivos`
--
ALTER TABLE `objetivos`
  ADD CONSTRAINT `objetivos_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuarios_principales` (`id_admin`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
