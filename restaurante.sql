-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2022 a las 18:20:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Descrip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Descrip`) VALUES
(1, 'Postres'),
(2, 'Bebidas'),
(3, 'Tacos'),
(4, 'Tostadas'),
(5, 'Caldos'),
(6, 'Quesadillas'),
(7, 'Tamales'),
(8, 'Aperitivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comanda`
--

INSERT INTO `comanda` (`id`, `id_mesa`, `total`, `id_usuario`, `fecha`) VALUES
(1, 1, '350.00', 1, '2022-05-15 01:23:34'),
(2, 2, '100.00', 12, '2022-05-15 01:23:34'),
(27, 3, '220.00', 1, '2022-05-17 14:44:13'),
(28, 5, '225.00', 16, '2022-05-17 15:01:36'),
(29, 1, '140.00', 16, '2022-05-17 15:19:16'),
(30, 9, '80.00', 17, '2022-05-17 15:32:03'),
(31, 5, '225.00', 17, '2022-05-17 15:35:38'),
(32, 4, '100.00', 17, '2022-05-17 15:40:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_detalle`
--

CREATE TABLE `comanda_detalle` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_comanda` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comanda_detalle`
--

INSERT INTO `comanda_detalle` (`id`, `id_menu`, `id_comanda`, `cantidad`, `precio`, `total`) VALUES
(1, 23, 1, 2, '50.00', '100.00'),
(2, 36, 1, 2, '20.00', '40.00'),
(3, 1, 1, 1, '60.00', '60.00'),
(4, 44, 1, 2, '30.00', '60.00'),
(5, 3, 1, 2, '20.00', '40.00'),
(6, 8, 2, 1, '25.00', '25.00'),
(7, 11, 2, 1, '25.00', '25.00'),
(8, 2, 2, 1, '30.00', '30.00'),
(9, 36, 2, 1, '20.00', '20.00'),
(10, 23, 27, 1, '50.00', '50.00'),
(11, 35, 27, 2, '25.00', '50.00'),
(12, 1, 27, 2, '60.00', '120.00'),
(13, 8, 28, 2, '25.00', '50.00'),
(14, 10, 28, 1, '25.00', '25.00'),
(15, 11, 28, 2, '25.00', '50.00'),
(16, 9, 28, 1, '25.00', '25.00'),
(17, 35, 28, 3, '25.00', '75.00'),
(18, 14, 29, 1, '50.00', '50.00'),
(19, 13, 29, 1, '50.00', '50.00'),
(20, 36, 29, 1, '20.00', '20.00'),
(21, 38, 29, 1, '20.00', '20.00'),
(22, 31, 30, 1, '80.00', '80.00'),
(23, 25, 31, 2, '25.00', '50.00'),
(24, 28, 31, 1, '25.00', '25.00'),
(25, 20, 31, 1, '50.00', '50.00'),
(26, 37, 31, 2, '20.00', '40.00'),
(27, 40, 31, 1, '60.00', '60.00'),
(28, 2, 32, 2, '30.00', '60.00'),
(29, 48, 32, 2, '20.00', '40.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_permiso`, `id_usuario`) VALUES
(1, 5, 9),
(2, 6, 9),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 5, 1),
(7, 6, 1),
(8, 7, 1),
(9, 5, 12),
(10, 6, 12),
(11, 5, 13),
(12, 6, 13),
(13, 5, 14),
(14, 5, 15),
(15, 5, 16),
(16, 6, 16),
(17, 5, 17),
(18, 6, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`IdMenu`, `descripcion`, `precio`, `IdCategoria`) VALUES
(1, 'Pastel de Chocolate', '60.00', 1),
(2, 'Pay de Queso', '30.00', 1),
(3, 'Agua', '20.00', 2),
(4, 'Jugo de Naranja', '25.00', 2),
(5, 'Jugo de Manzana', '25.00', 2),
(6, 'Quesadilla de Queso', '25.00', 6),
(7, 'Quesadilla de Picadillo', '25.00', 6),
(8, 'Quesadilla de Calabaza', '25.00', 6),
(9, 'Quesadilla de Chicharron', '25.00', 6),
(10, 'Quesadilla de Huitlacoche', '25.00', 6),
(11, 'Quesadilla de Carne Asada', '25.00', 6),
(12, 'Quesadilla de Chorizo', '25.00', 6),
(13, 'Tamales de Pollo', '50.00', 7),
(14, 'Tamales de Puerco', '50.00', 7),
(15, 'Tamales de Frijoles', '50.00', 7),
(16, 'Tamales de Queso', '50.00', 7),
(17, 'Tacos de Pollo', '50.00', 3),
(18, 'Tacos de Bistec', '50.00', 3),
(19, 'Tacos de Chicarron', '50.00', 3),
(20, 'Tacos de Chochinita', '50.00', 3),
(21, 'Tacos de Picadillo', '50.00', 3),
(22, 'Tacos de Machaca', '50.00', 3),
(23, 'Tacos de Trompo', '50.00', 3),
(24, 'Tacos de Carne Asada', '50.00', 3),
(25, 'Tostada de Tinga', '25.00', 4),
(26, 'Tostada de Frijoles', '25.00', 4),
(27, 'Tostada de Pollo', '25.00', 4),
(28, 'Tostada de Picadillo', '25.00', 4),
(29, 'Tostada de Chicharron', '25.00', 4),
(30, 'Caldo de Pollo', '80.00', 5),
(31, 'Caldo de Res', '80.00', 5),
(32, 'Caldo Tlapeno', '80.00', 5),
(33, 'Caldo de Hongos', '80.00', 5),
(34, 'Jugo de Guayaba', '25.00', 2),
(35, 'Refresco', '25.00', 2),
(36, 'Agua de Limon', '20.00', 2),
(37, 'Agua de Jamaica', '20.00', 2),
(38, 'Agua de Tamarindo', '20.00', 2),
(39, 'Pay de Piña', '30.00', 1),
(40, 'Pastel de Zanahoria', '60.00', 1),
(41, 'Pay de Limon', '30.00', 1),
(42, 'Pay de Nuez', '30.00', 1),
(43, 'Pastel de Vainilla', '60.00', 1),
(44, 'Nachos', '30.00', 8),
(45, 'Guacamole', '30.00', 8),
(46, 'Totopos', '30.00', 8),
(47, 'Coctel de frutas', '30.00', 8),
(48, 'Cafe de Olla', '20.00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `IdMesa` int(11) NOT NULL,
  `Descrip` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`IdMesa`, `Descrip`) VALUES
(1, 'Mesa 1'),
(2, 'Mesa 2'),
(3, 'Mesa 3'),
(4, 'Mesa 4'),
(5, 'Mesa 5'),
(6, 'Mesa 6'),
(7, 'Mesa 7'),
(8, 'Mesa 8'),
(9, 'Mesa 9'),
(10, 'Mesa 10'),
(12, 'Mesa 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(2, 'Usuarios'),
(3, 'Mesas'),
(4, 'Menu'),
(5, 'Comandas'),
(6, 'nuevaComanda'),
(7, 'Categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipoUsuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipoUsuario`, `usuario`, `clave`) VALUES
(1, 'Dan Arzola', 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(9, 'Maria Sanchez', 'Mesero', 'maria', '263bce650e68ab4e23f28263760b9fa5'),
(12, 'Aslan Mendoza', 'Mesero', 'aslan', '656b41abd1bf8eb4bcf8e93e2e056cb8'),
(13, 'Juan Perez', 'Cajero', 'juanp', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'Mario Burgos', 'Cocinero', 'mariob', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'Carolina Garcia', 'Cocinero', 'caro', '81dc9bdb52d04dc20036dbd8313ed055'),
(16, 'Guillermo Ochoa', 'Mesero', 'memo', '81dc9bdb52d04dc20036dbd8313ed055'),
(17, 'Sandra Ibarra', 'Mesero', 'sandra', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_mesa`);

--
-- Indices de la tabla `comanda_detalle`
--
ALTER TABLE `comanda_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_menu`),
  ADD KEY `id_venta` (`id_comanda`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_menu`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`IdMesa`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `comanda_detalle`
--
ALTER TABLE `comanda_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `IdMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`IdMesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comanda_detalle`
--
ALTER TABLE `comanda_detalle`
  ADD CONSTRAINT `comanda_detalle_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`IdMenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_detalle_ibfk_2` FOREIGN KEY (`id_comanda`) REFERENCES `comanda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`IdMenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
