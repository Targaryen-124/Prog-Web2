-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2024 a las 23:39:36
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL,
  `identidad` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idProfesion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idempleado`, `identidad`, `nombre`, `direccion`, `telefono`, `idProfesion`) VALUES
(1, '0102-1995-00355', 'Manuel Valladarez', 'Centro de la Ciudad', '99364512', 2),
(67, '0606-1998-00365', 'Carlos Garcia', 'Barrio El Centro', '99336541', 2),
(71, '0302199800365', 'Juan Manuel Paz', 'Barrio San Jorge', '99336541', 6),
(73, '0606200366325', 'Marta Mendoza', 'Barrio EL Centro', '99365412', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `idmesa` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `idempleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`idmesa`, `descripcion`, `idempleado`) VALUES
(4, 'Escritorio 1', 1),
(5, 'Escritorio 2', 67),
(8, 'Escritorio 4', 71),
(10, 'Escritorio 9', NULL),
(11, 'Escritorio 6', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `idprofesion` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `profesion`
--

INSERT INTO `profesion` (`idprofesion`, `descripcion`) VALUES
(1, 'Lic. Mercadotecnia'),
(2, 'Lic. Negocios Internacionales'),
(3, 'Lic. Recursos Humanos'),
(4, 'Lic. Marketing'),
(5, 'Otro'),
(6, 'Ing Financiera'),
(7, 'Ing Produccion Industrial'),
(8, 'Ing. Computacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `idpublicidad` int(11) NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `formato` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado_TV` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`idpublicidad`, `imagen`, `formato`, `idUsuario`, `estado`, `estado_TV`) VALUES
(23, 'imagenes/image1.jpg', 'Imagen', 3, 'Activo', 'Oculto'),
(43, 'imagenes/video2.mp4', 'Video', 3, 'Activo', 'Mostrando'),
(46, 'imagenes/video1.mp4', 'Video', 6, 'Inactivo', 'Mostrando'),
(47, 'imagenes/image2.jpg', 'Imagen', 6, 'Activo', 'Oculto'),
(52, 'imagenes/image3.jpg', 'Imagen', 3, 'Activo', 'Oculto'),
(59, 'imagenes/video4.mp4', 'Video', 3, 'Activo', 'Mostrando'),
(60, 'imagenes/fondo-UTH.png', 'Imagen', 3, 'Activo', 'Oculto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texto`
--

CREATE TABLE `texto` (
  `idtexto` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `texto`
--

INSERT INTO `texto` (`idtexto`, `descripcion`, `idusuario`, `estado`) VALUES
(1, '50% DE DESCUENTO EN LA MATRICULA PARA ESTE PERIODO', 3, 'Activo'),
(2, 'INICIA ESTE NUEVO PERIODO ACADEMICO CON TODA LA ACTITUD', 0, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickect`
--

CREATE TABLE `tickect` (
  `idticket` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idtransaccion` int(11) NOT NULL,
  `Idusuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tickect`
--

INSERT INTO `tickect` (`idticket`, `idmesa`, `idtransaccion`, `Idusuario`) VALUES
(50, 5, 38, 4),
(52, 5, 39, 4),
(53, 5, 40, 4),
(54, 5, 41, 4),
(55, 5, 42, 4),
(56, 5, 43, 4),
(60, 4, 47, 3),
(62, 4, 49, 3),
(63, 4, 50, 3),
(64, 4, 51, 3),
(65, 4, 52, 3),
(66, 4, 53, 3),
(67, 4, 54, 3),
(68, 4, 55, 3),
(69, 4, 56, 3),
(70, 4, 57, 3),
(71, 4, 58, 3),
(72, 4, 48, 3),
(73, 4, 59, 3),
(74, 4, 60, 3),
(75, 4, 61, 3),
(76, 4, 62, 3),
(77, 4, 63, 3),
(78, 4, 64, 3),
(80, 4, 66, 3),
(81, 4, 67, 3),
(82, 4, 68, 3),
(84, 4, 69, 3),
(85, 4, 70, 3),
(86, 4, 71, 3),
(87, 4, 72, 3),
(89, 5, 74, 4),
(90, 5, 75, 4),
(93, 4, 78, 3),
(95, 4, 79, 3),
(96, 4, 80, 3),
(97, 4, 73, 3),
(98, 4, 81, 3),
(99, 4, 65, 3),
(100, 4, 82, 3),
(101, 4, 83, 3),
(102, 4, 84, 3),
(103, 4, 69, 3),
(104, 4, 70, 3),
(105, 4, 71, 3),
(106, 4, 72, 3),
(107, 4, 73, 3),
(108, 4, 74, 3),
(109, 4, 75, 3),
(110, 4, 76, 3),
(111, 4, 77, 3),
(112, 4, 78, 3),
(113, 4, 79, 3),
(114, 4, 80, 3),
(115, 4, 81, 3),
(116, 4, 82, 3),
(117, 4, 83, 3),
(121, 5, 88, 4),
(122, 5, 89, 4),
(123, 5, 90, 4),
(124, 4, 91, 3),
(125, 4, 92, 3),
(126, 4, 93, 3),
(127, 4, 94, 3),
(128, 4, 95, 3),
(129, 5, 96, 4),
(133, 5, 100, 4),
(143, 4, 108, 3),
(144, 4, 110, 3),
(145, 4, 85, 3),
(146, 5, 111, 4),
(147, 5, 112, 4),
(149, 5, 114, 4),
(150, 5, 113, 4),
(151, 5, 115, 4),
(152, 4, 116, 3),
(153, 5, 117, 4),
(154, 5, 118, 4),
(155, 5, 121, 4),
(156, 5, 122, 4),
(157, 5, 123, 4),
(158, 5, 124, 4),
(160, 5, 125, 4),
(161, 5, 86, 4),
(162, 4, 126, 3),
(163, 4, 127, 3),
(164, 4, 128, 3),
(165, 4, 128, 3),
(166, 4, 129, 3),
(167, 4, 130, 3),
(168, 4, 131, 3),
(169, 4, 132, 3),
(170, 4, 133, 3),
(171, 5, 134, 4),
(172, 5, 135, 4),
(173, 4, 136, 3),
(174, 4, 137, 3),
(175, 4, 138, 3),
(176, 5, 139, 4),
(177, 8, 140, 6),
(178, 4, 141, 3),
(179, 8, 142, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotransaccion`
--

CREATE TABLE `tipotransaccion` (
  `idtipotransaccion` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipotransaccion`
--

INSERT INTO `tipotransaccion` (`idtipotransaccion`, `descripcion`) VALUES
(1, 'Matricula'),
(2, 'Consulta general'),
(3, 'Solicitar carnet'),
(4, 'Asuntos Estudiantiles'),
(5, 'Rectoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `idtransaccion` int(11) NOT NULL,
  `codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `idtipotransaccion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `codigo`, `idtipotransaccion`, `fecha`, `estado`) VALUES
(37, 'TK-002', 2, '2024-03-31 22:01:52', 'Finalizado'),
(38, 'TK-003', 4, '2024-03-31 22:01:58', 'Finalizado'),
(39, 'TK-004', 5, '2024-03-31 22:02:02', 'Finalizado'),
(40, 'TK-005', 3, '2024-03-30 22:02:07', 'Finalizado'),
(41, 'TK-006', 4, '2024-03-30 22:02:13', 'Finalizado'),
(42, 'TK-007', 1, '2024-03-30 22:02:18', 'Finalizado'),
(43, 'TK-008', 5, '2024-04-08 22:02:23', 'Finalizado'),
(44, 'TK-009', 1, '2024-04-08 22:02:27', 'Finalizado'),
(45, 'TK-010', 3, '2024-04-08 22:02:32', 'Finalizado'),
(47, 'TK-001', 1, '2024-04-09 14:38:36', 'Finalizado'),
(48, 'TK-002', 1, '2024-04-09 14:38:42', 'Finalizado'),
(49, 'TK-003', 2, '2024-04-09 14:38:48', 'Finalizado'),
(50, 'TK-004', 2, '2024-04-09 14:45:19', 'Finalizado'),
(51, 'TK-005', 1, '2024-04-09 14:45:46', 'Finalizado'),
(52, 'TK-006', 1, '2024-04-09 14:53:46', 'Finalizado'),
(53, 'TK-007', 1, '2024-04-09 14:54:18', 'Finalizado'),
(54, 'TK-008', 1, '2024-04-09 14:55:11', 'Finalizado'),
(55, 'TK-009', 1, '2024-04-09 14:55:27', 'Finalizado'),
(56, 'TK-010', 1, '2024-04-09 15:55:30', 'Finalizado'),
(57, 'TK-011', 1, '2024-04-09 15:56:15', 'Finalizado'),
(58, 'TK-012', 1, '2024-04-09 16:00:50', 'Finalizado'),
(59, 'TK-013', 3, '2024-04-09 16:03:00', 'Finalizado'),
(60, 'TK-014', 3, '2024-04-09 16:07:34', 'Finalizado'),
(61, 'TK-015', 4, '2024-04-09 16:10:17', 'Finalizado'),
(62, 'TK-016', 4, '2024-04-09 16:11:28', 'Finalizado'),
(63, 'TK-017', 1, '2024-04-09 17:51:50', 'Finalizado'),
(64, 'TK-018', 4, '2024-04-09 17:51:57', 'Finalizado'),
(65, 'TK-019', 2, '2024-04-09 17:52:03', 'Finalizado'),
(66, 'TK-020', 3, '2024-04-09 17:56:50', 'Finalizado'),
(67, 'TK-021', 4, '2024-04-09 17:57:00', 'Finalizado'),
(68, 'TK-022', 3, '2024-04-09 17:59:03', 'Finalizado'),
(69, 'TK-023', 4, '2024-04-09 17:59:18', 'Finalizado'),
(70, 'TK-024', 3, '2024-04-09 19:30:20', 'Finalizado'),
(71, 'TK-025', 4, '2024-04-09 19:31:10', 'Finalizado'),
(72, 'TK-026', 3, '2024-04-09 19:36:09', 'Finalizado'),
(73, 'TK-027', 2, '2024-04-09 21:13:03', 'Finalizado'),
(74, 'TK-028', 3, '2024-04-09 21:13:09', 'Finalizado'),
(75, 'TK-029', 4, '2024-04-09 21:13:18', 'Finalizado'),
(76, 'TK-030', 2, '2024-04-09 21:15:04', 'Finalizado'),
(77, 'TK-031', 3, '2024-04-09 21:15:16', 'Finalizado'),
(78, 'TK-032', 3, '2024-04-09 21:17:46', 'Finalizado'),
(79, 'TK-033', 3, '2024-04-09 21:19:17', 'Finalizado'),
(80, 'TK-034', 1, '2024-04-09 21:24:38', 'Finalizado'),
(81, 'TK-035', 4, '2024-04-09 21:33:06', 'Finalizado'),
(82, 'TK-036', 3, '2024-04-09 21:41:49', 'Finalizado'),
(83, 'TK-037', 3, '2024-04-09 21:42:54', 'Finalizado'),
(84, 'TK-038', 2, '2024-04-09 21:44:08', 'Finalizado'),
(85, 'TK-001', 1, '2024-04-10 10:21:40', 'Finalizado'),
(86, 'TK-002', 2, '2024-04-10 10:21:46', 'Finalizado'),
(87, 'TK-003', 4, '2024-04-10 10:21:53', 'Finalizado'),
(88, 'TK-004', 3, '2024-04-10 10:21:59', 'Finalizado'),
(89, 'TK-005', 5, '2024-04-10 10:22:04', 'Finalizado'),
(90, 'TK-006', 1, '2024-04-10 10:22:09', 'Finalizado'),
(91, 'TK-007', 2, '2024-04-10 10:22:15', 'Finalizado'),
(92, 'TK-008', 3, '2024-04-10 10:22:21', 'Finalizado'),
(93, 'TK-009', 4, '2024-04-10 10:22:28', 'Finalizado'),
(94, 'TK-010', 2, '2024-04-10 10:22:33', 'Finalizado'),
(95, 'TK-011', 1, '2024-04-10 10:34:37', 'Finalizado'),
(96, 'TK-012', 2, '2024-04-10 10:39:42', 'Finalizado'),
(97, 'TK-013', 3, '2024-04-10 10:41:01', 'Finalizado'),
(98, 'TK-014', 2, '2024-04-10 10:46:41', 'Finalizado'),
(99, 'TK-015', 3, '2024-04-10 10:51:13', 'Finalizado'),
(100, 'TK-016', 1, '2024-04-10 10:55:18', 'Finalizado'),
(101, 'TK-017', 3, '2024-04-10 10:59:14', 'Finalizado'),
(102, 'TK-018', 2, '2024-04-10 13:10:43', 'Finalizado'),
(103, 'TK-019', 3, '2024-04-10 13:21:25', 'Finalizado'),
(104, 'TK-020', 3, '2024-04-10 13:23:36', 'Finalizado'),
(106, 'TK-021', 1, '2024-04-10 13:24:52', 'Finalizado'),
(107, 'TK-022', 1, '2024-04-10 13:25:51', 'Finalizado'),
(108, 'TK-023', 3, '2024-04-10 13:27:51', 'Finalizado'),
(110, 'TK-025', 3, '2024-04-10 14:26:26', 'Finalizado'),
(111, 'TK-026', 2, '2024-04-10 17:13:39', 'Finalizado'),
(112, 'TK-027', 1, '2024-04-10 17:13:44', 'Finalizado'),
(113, 'TK-028', 4, '2024-04-10 17:13:49', 'Finalizado'),
(114, 'TK-029', 3, '2024-04-10 17:13:53', 'Finalizado'),
(115, 'TK-030', 5, '2024-04-10 17:13:58', 'Finalizado'),
(116, 'TK-031', 2, '2024-04-10 18:25:30', 'Finalizado'),
(117, 'TK-032', 4, '2024-04-10 18:25:51', 'Finalizado'),
(118, 'TK-033', 1, '2024-04-10 18:34:16', 'Finalizado'),
(119, 'TK-034', 3, '2024-04-10 18:35:20', 'Finalizado'),
(120, 'TK-035', 2, '2024-04-10 18:54:01', 'Finalizado'),
(121, 'TK-036', 1, '2024-04-10 21:21:23', 'Finalizado'),
(122, 'TK-037', 1, '2024-04-10 21:22:20', 'Finalizado'),
(123, 'TK-038', 1, '2024-04-10 21:25:30', 'Finalizado'),
(124, 'TK-039', 3, '2024-04-10 21:27:21', 'Finalizado'),
(125, 'TK-040', 3, '2024-04-10 21:28:33', 'Finalizado'),
(126, 'TK-001', 3, '2024-04-11 22:22:37', 'Finalizado'),
(127, 'TK-002', 4, '2024-04-11 22:22:43', 'Finalizado'),
(128, 'TK-003', 4, '2024-04-11 22:23:43', 'Finalizado'),
(129, 'TK-004', 3, '2024-04-11 22:39:09', 'Finalizado'),
(130, 'TK-005', 3, '2024-04-11 22:39:14', 'Finalizado'),
(131, 'TK-006', 1, '2024-04-11 22:39:18', 'Finalizado'),
(132, 'TK-007', 4, '2024-04-11 22:39:23', 'Finalizado'),
(133, 'TK-001', 1, '2024-04-14 13:40:30', 'Finalizado'),
(134, 'TK-002', 2, '2024-04-14 13:40:36', 'Finalizado'),
(135, 'TK-003', 4, '2024-04-14 13:40:45', 'Finalizado'),
(136, 'TK-004', 4, '2024-04-14 13:40:52', 'Finalizado'),
(137, 'TK-005', 4, '2024-04-14 14:28:44', 'Finalizado'),
(138, 'TK-006', 5, '2024-04-14 14:28:56', 'Finalizado'),
(139, 'TK-007', 1, '2024-04-14 14:45:22', 'Finalizado'),
(140, 'TK-008', 2, '2024-04-14 14:45:27', 'Finalizado'),
(141, 'TK-009', 3, '2024-04-14 14:45:34', 'Finalizado'),
(142, 'TK-010', 1, '2024-04-14 15:18:39', 'Finalizado'),
(144, 'TK-011', 1, '2024-04-14 15:20:11', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasenia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idempleado`, `usuario`, `contrasenia`, `idrol`) VALUES
(3, 1, 'Admin', '1234', 1),
(4, 67, 'Recep1', '1234', 2),
(6, 71, 'Admin2', '1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idempleado`),
  ADD KEY `idProfesion` (`idProfesion`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `idempleado` (`idempleado`),
  ADD KEY `idempleado_2` (`idempleado`);

--
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`idprofesion`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`idpublicidad`),
  ADD KEY `idUsuarios` (`estado`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `texto`
--
ALTER TABLE `texto`
  ADD PRIMARY KEY (`idtexto`);

--
-- Indices de la tabla `tickect`
--
ALTER TABLE `tickect`
  ADD PRIMARY KEY (`idticket`),
  ADD KEY `idmesa` (`idmesa`,`idtransaccion`),
  ADD KEY `idtransaccion` (`idtransaccion`),
  ADD KEY `Idusuario` (`Idusuario`) USING BTREE;

--
-- Indices de la tabla `tipotransaccion`
--
ALTER TABLE `tipotransaccion`
  ADD PRIMARY KEY (`idtipotransaccion`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`idtransaccion`),
  ADD KEY `idtipotransaccion` (`idtipotransaccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idempleado` (`idempleado`,`idrol`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `idprofesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `idpublicidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `texto`
--
ALTER TABLE `texto`
  MODIFY `idtexto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tickect`
--
ALTER TABLE `tickect`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `tipotransaccion`
--
ALTER TABLE `tipotransaccion`
  MODIFY `idtipotransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `idtransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idProfesion`) REFERENCES `profesion` (`idprofesion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD CONSTRAINT `publicidad_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickect`
--
ALTER TABLE `tickect`
  ADD CONSTRAINT `tickect_ibfk_1` FOREIGN KEY (`idmesa`) REFERENCES `mesas` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickect_ibfk_2` FOREIGN KEY (`idtransaccion`) REFERENCES `transaccion` (`idtransaccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickect_ibfk_3` FOREIGN KEY (`Idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`idtipotransaccion`) REFERENCES `tipotransaccion` (`idtipotransaccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
