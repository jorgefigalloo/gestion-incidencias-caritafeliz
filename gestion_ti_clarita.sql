-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2025 a las 16:56:43
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
-- Base de datos: `gestion_ti_clarita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(100) NOT NULL,
  `id_sede` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`, `id_sede`) VALUES
(1, 'Gerencias', 2),
(2, 'Facturación', 2),
(3, 'Tesoreria', 2),
(4, 'Contabilidad', 2),
(5, 'Financiera', 2),
(6, 'Piso 1', 1),
(7, 'Piso 2', 1),
(8, 'Piso 3', 1),
(9, 'Piso 4', 1),
(10, 'Piso 5', 1),
(11, 'Piso 6', 1),
(12, 'Sistemas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `respuesta_solucion` text DEFAULT NULL,
  `id_tipo_incidencia` int(11) DEFAULT NULL,
  `id_subtipo_incidencia` int(11) DEFAULT NULL,
  `id_usuario_reporta` int(11) DEFAULT NULL,
  `nombre_reporta` varchar(100) DEFAULT NULL,
  `email_reporta` varchar(100) DEFAULT NULL,
  `estado` enum('abierta','en_proceso','cerrada','cancelada') DEFAULT 'abierta',
  `prioridad` enum('baja','media','alta','critica') DEFAULT 'media',
  `fecha_reporte` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_cierre` timestamp NULL DEFAULT NULL,
  `id_usuario_tecnico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id_incidencia`, `titulo`, `descripcion`, `respuesta_solucion`, `id_tipo_incidencia`, `id_subtipo_incidencia`, `id_usuario_reporta`, `nombre_reporta`, `email_reporta`, `estado`, `prioridad`, `fecha_reporte`, `fecha_cierre`, `id_usuario_tecnico`) VALUES
(1, 'error de red', 'problemas con el cable', 'se cambio el cable', 3, NULL, NULL, '', '', 'cerrada', 'media', '2025-09-15 19:23:22', '2025-09-21 22:42:12', 2),
(2, 'averia', 'averia de telefono ip', '', 4, NULL, NULL, 'Usuario Final', 'sistemas@clinicacaritafeliz.com', 'abierta', 'baja', '2025-09-21 23:08:00', NULL, NULL),
(3, 'averia', 'averias prueba', NULL, 3, NULL, NULL, 'Usuario Final', 'sistemas@clinicacaritafeliz.com', 'abierta', 'alta', '2025-10-06 13:56:31', NULL, NULL),
(4, '', '', 'se soluciono', NULL, NULL, NULL, '', '', 'en_proceso', 'critica', '2025-10-06 14:16:41', NULL, 2),
(5, '', '', 'solucionado, el caso era el software', NULL, NULL, NULL, '', '', 'abierta', 'alta', '2025-10-30 22:53:28', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'tecnico'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `nombre_sede`, `descripcion`) VALUES
(1, 'Sede 1039', 'Edificio de 6 pisos'),
(2, 'Sede 925', 'Sede de 3 pisos, gerencia, facturación, tesorería, contabilidad, etc.'),
(3, 'secundaria', 'grndes'),
(5, 'primero', 'buenas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtipos_incidencias`
--

CREATE TABLE `subtipos_incidencias` (
  `id_subtipo_incidencia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_tipo_incidencia` int(11) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subtipos_incidencias`
--

INSERT INTO `subtipos_incidencias` (`id_subtipo_incidencia`, `nombre`, `descripcion`, `id_tipo_incidencia`, `estado`, `fecha_creacion`) VALUES
(1, 'Computadora no enciende', 'Problemas de energía o fallo de componentes', 1, 'activo', '2025-10-31 15:28:16'),
(2, 'Pantalla dañada', 'Problemas con el monitor o display', 1, 'activo', '2025-10-31 15:28:16'),
(3, 'Teclado o mouse defectuoso', 'Periféricos que no funcionan correctamente', 1, 'activo', '2025-10-31 15:28:16'),
(4, 'Impresora no funciona', 'Problemas con impresoras o escáneres', 1, 'activo', '2025-10-31 15:28:16'),
(5, 'Disco duro dañado', 'Fallo en el almacenamiento', 1, 'activo', '2025-10-31 15:28:16'),
(6, 'Sistema operativo lento', 'Rendimiento degradado del OS', 2, 'activo', '2025-10-31 15:28:16'),
(7, 'Aplicación no abre', 'Software que no inicia correctamente', 2, 'activo', '2025-10-31 15:28:16'),
(8, 'Error de actualización', 'Problemas durante actualizaciones', 2, 'activo', '2025-10-31 15:28:16'),
(9, 'Virus o malware', 'Infección detectada en el sistema', 2, 'activo', '2025-10-31 15:28:16'),
(10, 'Pérdida de datos', 'Archivos eliminados o inaccesibles', 2, 'activo', '2025-10-31 15:28:16'),
(11, 'Sin acceso a Internet', 'No hay conexión a la red externa', 3, 'activo', '2025-10-31 15:28:16'),
(12, 'WiFi desconectado', 'Problemas con conexión inalámbrica', 3, 'activo', '2025-10-31 15:28:16'),
(13, 'Red local lenta', 'Velocidad degradada en la red interna', 3, 'activo', '2025-10-31 15:28:16'),
(14, 'No accede a carpetas compartidas', 'Problemas con recursos de red', 3, 'activo', '2025-10-31 15:28:16'),
(15, 'Cable de red dañado', 'Problemas físicos de conectividad', 3, 'activo', '2025-10-31 15:28:16'),
(16, 'Limpieza de equipos', 'Mantenimiento físico programado', 4, 'activo', '2025-10-31 15:28:16'),
(17, 'Actualización de software', 'Instalación de actualizaciones', 4, 'activo', '2025-10-31 15:28:16'),
(18, 'Backup de datos', 'Respaldo de información crítica', 4, 'activo', '2025-10-31 15:28:16'),
(19, 'Revisión de seguridad', 'Auditoría de seguridad informática', 4, 'activo', '2025-10-31 15:28:16'),
(20, 'Optimización de sistema', 'Mejora del rendimiento', 4, 'activo', '2025-10-31 15:28:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_incidencia`
--

CREATE TABLE `tipos_incidencia` (
  `id_tipo_incidencia` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_incidencia`
--

INSERT INTO `tipos_incidencia` (`id_tipo_incidencia`, `nombre`) VALUES
(3, 'Conectividad de Red'),
(1, 'Fallo de Hardware'),
(4, 'Mantenimiento Preventivo'),
(2, 'Problema de Software');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ID_ROL_USUARIO` int(11) NOT NULL,
  `id_area` int(11) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `username`, `password`, `ID_ROL_USUARIO`, `id_area`, `estado`) VALUES
(1, 'Administrador de Sistemas', 'admin', 'admin', 1, 12, 'activo'),
(2, 'Técnico de Soporte', 'tecnico', 'tecnico', 2, 12, 'activo'),
(3, 'Usuario Final', 'usuario', 'usuario', 3, 4, 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `id_tipo_incidencia` (`id_tipo_incidencia`),
  ADD KEY `id_usuario_reporta` (`id_usuario_reporta`),
  ADD KEY `id_usuario_tecnico` (`id_usuario_tecnico`),
  ADD KEY `id_subtipo_incidencia` (`id_subtipo_incidencia`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`),
  ADD UNIQUE KEY `nombre_sede` (`nombre_sede`);

--
-- Indices de la tabla `subtipos_incidencias`
--
ALTER TABLE `subtipos_incidencias`
  ADD PRIMARY KEY (`id_subtipo_incidencia`),
  ADD KEY `id_tipo_incidencia` (`id_tipo_incidencia`);

--
-- Indices de la tabla `tipos_incidencia`
--
ALTER TABLE `tipos_incidencia`
  ADD PRIMARY KEY (`id_tipo_incidencia`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `ID_ROL_USUARIO` (`ID_ROL_USUARIO`),
  ADD KEY `id_area` (`id_area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subtipos_incidencias`
--
ALTER TABLE `subtipos_incidencias`
  MODIFY `id_subtipo_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipos_incidencia`
--
ALTER TABLE `tipos_incidencia`
  MODIFY `id_tipo_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_ibfk_1` FOREIGN KEY (`id_tipo_incidencia`) REFERENCES `tipos_incidencia` (`id_tipo_incidencia`) ON DELETE SET NULL,
  ADD CONSTRAINT `incidencias_ibfk_2` FOREIGN KEY (`id_usuario_reporta`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `incidencias_ibfk_3` FOREIGN KEY (`id_usuario_tecnico`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `incidencias_ibfk_4` FOREIGN KEY (`id_subtipo_incidencia`) REFERENCES `subtipos_incidencias` (`id_subtipo_incidencia`) ON DELETE SET NULL;

--
-- Filtros para la tabla `subtipos_incidencias`
--
ALTER TABLE `subtipos_incidencias`
  ADD CONSTRAINT `subtipos_incidencias_ibfk_1` FOREIGN KEY (`id_tipo_incidencia`) REFERENCES `tipos_incidencia` (`id_tipo_incidencia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_ROL_USUARIO`) REFERENCES `rol_usuario` (`id_rol`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
