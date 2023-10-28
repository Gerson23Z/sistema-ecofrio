-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2023 a las 12:44:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecofrio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierre_caja`
--

CREATE TABLE `cierre_caja` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `monto_inicial` decimal(10,2) NOT NULL,
  `monto_final` decimal(10,2) NOT NULL,
  `fecha_apertura` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `total_ventas` int(11) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cierre_caja`
--

INSERT INTO `cierre_caja` (`id`, `id_usuario`, `monto_inicial`, `monto_final`, `fecha_apertura`, `fecha_cierre`, `total_ventas`, `monto_total`, `estado`) VALUES
(1, 1, 100.00, 3120.00, '2023-06-01 23:07:06', '2023-06-04 20:24:05', 3, 3220.00, 0),
(2, 1, 100.00, 0.00, '2023-06-04 20:28:20', '2023-06-07 00:46:43', 0, 100.00, 0),
(3, 1, 100.00, 3104.00, '2023-06-07 00:46:49', '2023-06-07 00:50:57', 2, 3204.00, 0),
(4, 1, 100.00, 507.00, '2023-06-07 01:00:39', '2023-06-07 01:15:24', 3, 607.00, 0),
(5, 1, 100.00, 67.00, '2023-06-14 07:13:51', '2023-08-25 14:27:22', 2, 167.00, 0),
(6, 1, 500.00, 0.00, '2023-08-26 14:05:05', '0000-00-00 00:00:00', 0, 0.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `dui` varchar(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `color` varchar(20) NOT NULL,
  `completado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `dui`, `telefono`, `direccion`, `tipo`, `fecha`, `color`, `completado`) VALUES
(1, 'jose', '34564645', 34564578, 'sm', 'Mantenimiento Preven', '2023-08-30', '#006400', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dui` int(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dui`, `nombre`, `telefono`, `direccion`) VALUES
(1, 32342356, 'Juan Antonio Mendoza', '65861255', 'san miguel'),
(2, 98543465, 'Santiago', '65861255', 'sm'),
(3, 34564645, 'jose', '34564578', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallescmp`
--

CREATE TABLE `detallescmp` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `producto` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallescmpair`
--

CREATE TABLE `detallescmpair` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `capacidad` varchar(20) NOT NULL,
  `seer` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesvnt`
--

CREATE TABLE `detallesvnt` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `producto` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesvntair`
--

CREATE TABLE `detallesvntair` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `capacidad` varchar(20) NOT NULL,
  `seer` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compras`
--

CREATE TABLE `detalles_compras` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `producto` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_compras`
--

INSERT INTO `detalles_compras` (`id`, `codigo`, `producto`, `precio`, `cantidad`, `subtotal`, `fecha`, `id_proveedor`) VALUES
(1, 12345678, 'qwert', 50.00, 100, 5000.00, '2023-06-04 05:16:26', 1),
(2, 12345678, 'carrito', 1.00, 52, 52.00, '2023-06-07 02:47:55', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_comprasaires`
--

CREATE TABLE `detalles_comprasaires` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `capacidad` varchar(20) NOT NULL,
  `seer` int(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `producto` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_ventas`
--

INSERT INTO `detalles_ventas` (`id`, `codigo`, `producto`, `marca`, `precio`, `cantidad`, `subtotal`, `id_usuario`, `fecha`, `id_venta`) VALUES
(1, 27699095, 'Manguera desagüe', 'Mabe', 12.00, 2, 24.00, 1, '2023-06-14 13:16:06', 1),
(2, 30800509, 'Swit craken', 'Mabe', 22.00, 1, 22.00, 1, '2023-06-14 13:16:06', 1),
(3, 27344314, 'Piñón', 'Mabe', 8.00, 2, 16.00, 1, '2023-06-14 13:18:41', 2),
(4, 41606054, 'Tuerca fina', 'Mabe', 5.00, 1, 5.00, 1, '2023-06-14 13:18:41', 2),
(5, 27344314, 'Piñón', 'Mabe', 8.00, 4, 32.00, 1, '2023-08-26 20:06:10', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventasaires`
--

CREATE TABLE `detalles_ventasaires` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `capacidad` varchar(20) NOT NULL,
  `seer` int(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_ventasaires`
--

INSERT INTO `detalles_ventasaires` (`id`, `codigo`, `marca`, `capacidad`, `seer`, `precio`, `cantidad`, `subtotal`, `fecha`, `id_cliente`, `id_usuario`, `id_venta`) VALUES
(1, 27315228, 'Gair', '36,000btu', 17, 1400.00, 2, 2800.00, '2023-06-07 06:49:50', 1, 1, 1),
(2, 21275162, 'Comfort Star', '12,000btu', 13, 280.00, 1, 280.00, '2023-08-26 20:07:19', 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(5, 13, 1),
(6, 13, 2),
(7, 13, 5),
(8, 13, 9),
(9, 13, 11),
(10, 13, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ncr` varchar(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `dueno` varchar(20) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ncr`, `direccion`, `telefono`, `dueno`, `mensaje`) VALUES
(1, 'ECOFRIO', '239918-4', 'Final 4°ave. Sur, media cuadra después de UMA, frente a liceo adventista, San Miguel, El Salvador.', '7435-2437', 'Leo Escobar ', 'Gracias por su compra!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioaires`
--

CREATE TABLE `inventarioaires` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `capacidad` varchar(20) NOT NULL,
  `seer` int(11) NOT NULL,
  `voltaje` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `caracteristica` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventarioaires`
--

INSERT INTO `inventarioaires` (`id`, `codigo`, `marca`, `capacidad`, `seer`, `voltaje`, `modelo`, `caracteristica`, `precio`, `cantidad`, `estado`) VALUES
(1, 90723884, 'Comfort Star', '12,000btu', 13, '110V', 'Blue Series', 'Inverter', 350.00, 12, 1),
(2, 59490123, 'Comfort Star', '12,000btu', 18, '110V', 'Blue Series', 'Inverter', 460.00, 10, 1),
(3, 21275162, 'Comfort Star', '12,000btu', 13, '220V', 'Blue Series', 'Inverter', 280.00, 5, 1),
(4, 16565617, 'Comfort Star', '12,000btu', 18, '220V', 'Blue Series', 'Inverter', 370.00, 12, 1),
(5, 31703628, 'Comfort Star', '12,000btu', 21, '220V', 'Blue Series', 'Inverter', 420.00, 8, 1),
(6, 95452200, 'Comfort Star', '18,000btu', 13, '220V', 'Blue Series', 'Inverter', 430.00, 7, 1),
(7, 15515833, 'Comfort Star', '18,000btu', 21, '220V', 'Blue Series', 'Inverter', 590.00, 21, 1),
(8, 27315228, 'Gair', '36,000btu', 17, '220V', 'Blue Series', 'Inverter', 1400.00, 5, 1),
(9, 89743941, 'Adina', '12,000btu', 17, '110V', 'Blue Series', 'Inverter', 435.00, 45, 1),
(10, 71797981, 'Adina', '12,000btu', 17, '220V', 'Blue Series', 'Inverter', 435.00, 26, 1),
(11, 67097783, 'Gair', '12,000btu', 17, '220V', 'Blue Series', 'Inverter', 365.00, 30, 1),
(12, 71830135, 'Gair', '18,000btu', 17, '220V', 'Blue Series', 'Inverter', 650.00, 32, 1),
(13, 19368038, 'Gair', '24,000btu', 17, '220V', 'Blue Series', 'Inverter', 750.00, 41, 1),
(14, 95118579, 'Daikin', '12,000btu', 20, '110V', 'Blue Series', 'Inverter', 570.00, 45, 1),
(15, 63868759, 'Daikin', '12,000btu', 13, '220V', 'Blue Series', 'Inverter', 35.00, 40, 1),
(16, 13128909, 'Daikin', '12,000btu', 17, '220V', 'Blue Series', 'Inverter', 465.00, 20, 1),
(17, 30621580, 'Daikin', '12,000btu', 20, '220V', 'Blue Series', 'Inverter', 610.00, 30, 1),
(18, 27677322, 'Daikin', '18,000btu', 17, '220V', 'Blue Series', 'Inverter', 750.00, 27, 1),
(19, 42453433, 'Daikin', '24,000btu', 20, '220V', 'Blue Series', 'Inverter', 880.00, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventariorespuestos`
--

CREATE TABLE `inventariorespuestos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `marca` text NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `unidades` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventariorespuestos`
--

INSERT INTO `inventariorespuestos` (`id`, `codigo`, `producto`, `marca`, `fecha`, `unidades`, `precio`, `estado`) VALUES
(1, '46736125', 'Amortiguador 57cm', 'Mabe', '2023-06-06', 0, 25.00, 1),
(2, '40617062', 'Amortiguador 60 cm ', 'Mabe', '2023-06-06', 50, 25.00, 1),
(3, '58429743', 'Amortiguador 65 cm', 'Mabe', '2023-06-06', 50, 25.00, 1),
(4, '15589953', 'Membrana', 'Mabe', '2023-06-06', 25, 30.00, 1),
(5, '54575057', 'Timer secadora', 'Mabe', '2023-06-06', 40, 45.00, 1),
(6, '64526248', 'Bomba 110v ', 'LG', '2023-06-06', 60, 27.00, 1),
(7, '68142999', 'Faja', 'Whirlpool ', '2023-06-06', 45, 15.00, 1),
(8, '77710078', 'Tarjetas pequeñas', 'LG', '2023-06-06', 22, 125.00, 1),
(9, '62072768', 'Amortiguador 50 cm', 'LG', '2023-06-06', 3, 35.00, 1),
(10, '40377784', 'Amortiguador 60cm', 'LG', '2023-06-06', 30, 35.00, 1),
(11, '36098791', 'Amortiguador 62cm', 'LG', '2023-06-06', 40, 35.00, 1),
(12, '87039563', 'Sello pequeño', 'Whirlpool', '2023-06-06', 50, 12.00, 1),
(13, '61222423', 'Amortiguador 72cm', 'Samsung ', '2023-06-06', 60, 92.00, 1),
(14, '46846762', 'Amortiguador 64cm', 'Samsung', '2023-06-07', 65, 75.00, 1),
(15, '16488327', 'Amortiguador negro', 'Whirlpool ', '2023-06-07', 12, 38.00, 1),
(16, '27344314', 'Piñón', 'Mabe', '2023-06-07', 40, 8.00, 1),
(17, '54717904', 'Piñón chino', 'Mabe', '2023-06-07', 60, 5.00, 1),
(18, '71718779', 'Lágrimas', 'Whirlpool ', '2023-06-07', 70, 5.00, 1),
(19, '44089315', 'Actuador 4 líneas', 'Whirlpool ', '2023-06-07', 15, 38.00, 1),
(20, '54371661', 'Actuador 6 líneas', 'Whirlpool ', '2023-06-07', 13, 40.00, 1),
(21, '24455221', 'Actuador 7 líneas', 'Whirlpool ', '2023-06-07', 30, 45.00, 1),
(22, '62248315', 'Motor evaporador blanco', 'LG', '2023-06-07', 20, 335.00, 1),
(23, '27699095', 'Manguera desagüe', 'Mabe', '2023-06-07', 8, 12.00, 1),
(24, '58732620', 'Actuador cangrejito', 'Mabe', '2023-06-07', 40, 28.00, 1),
(25, '44475450', 'Poleas', 'Mabe', '2023-06-07', 13, 8.00, 1),
(26, '77621887', 'Amortiguador 68 cm', 'Mabe', '2023-06-07', 22, 28.00, 1),
(27, '49217288', 'Amortiguador 70 cm ', 'Mabe', '2023-06-07', 50, 28.00, 1),
(28, '60410025', 'Presostato', 'Samsung', '2023-06-07', 25, 25.00, 1),
(29, '86775347', 'Sello', 'Mabe', '2023-06-07', 9, 6.00, 1),
(30, '76327654', 'Pastilla térmica china', 'Mabe', '2023-06-07', 66, 7.00, 1),
(31, '87425457', 'Manguera', 'Samsung', '2023-06-07', 21, 27.00, 1),
(32, '54431172', 'Resistencia aluminio', 'Mabe', '2023-06-07', 44, 25.00, 1),
(33, '80951239', 'Tarjetas grandes', 'LG', '2023-06-07', 63, 175.00, 1),
(34, '72091883', 'Presostato inverter', 'LG', '2023-06-07', 14, 20.00, 1),
(35, '39577128', 'Agitador', 'LG', '2023-06-07', 58, 57.00, 1),
(36, '15112784', 'Faja secadora', 'Whirlpool ', '2023-06-07', 30, 25.00, 1),
(37, '29543780', 'Motor condensador', 'LG', '2023-06-07', 50, 38.00, 1),
(38, '41606054', 'Tuerca fina', 'Mabe', '2023-06-07', 89, 5.00, 1),
(39, '30800509', 'Swit craken', 'Mabe', '2023-06-07', 90, 22.00, 1),
(40, '58271928', 'Sello chino', 'Mabe', '2023-06-07', 72, 5.00, 1),
(41, '99564245', 'Motor', 'Mabe ', '2023-06-07', 45, 18.00, 1),
(42, '96703620', 'Bomba blanca', 'Mabe ', '2023-06-07', 30, 22.00, 1),
(43, '95118579', 'Manguera de llenado', 'LG', '2023-06-07', 65, 22.00, 1),
(44, '95452200', 'Bombas', 'LG', '2023-06-07', 51, 30.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`) VALUES
(1, 'Usuarios'),
(2, 'Ventas'),
(3, 'Historial de ventas'),
(4, 'Calendario'),
(5, 'Control de citas'),
(6, 'Clientes'),
(7, 'Inventario'),
(8, 'Cierre de caja'),
(9, 'Empresa'),
(10, 'Compras'),
(11, 'Historial de compras'),
(12, 'Proveedores'),
(13, 'Editar Proveedores'),
(14, 'Editar Clientes'),
(15, 'Editar Inventarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `telefono`, `direccion`) VALUES
(1, 'Frio aire', 23456674, 'sm'),
(2, 'Cooper', 65851247, 'sm'),
(3, 'Frio expres', 74589888, 'sm'),
(4, 'Granada', 65525665, 'sm'),
(5, 'La torre', 74585456, 'sm'),
(6, 'Movil Plus', 69856594, 'sm'),
(7, 'Mabe', 71552366, 'sm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `user`, `password`, `estado`) VALUES
(1, 'Administrador', 'administrador', 'admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1),
(13, 'ftg', 'rtgtr', '32rt', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `apertura` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `total`, `id_usuario`, `fecha`, `apertura`) VALUES
(1, 46.00, 1, '2023-06-14 07:16:06', 0),
(2, 21.00, 1, '2023-06-14 07:18:41', 0),
(3, 32.00, 1, '2023-08-26 14:06:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventasaires`
--

CREATE TABLE `ventasaires` (
  `id` int(11) NOT NULL,
  `dui` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `apertura` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventasaires`
--

INSERT INTO `ventasaires` (`id`, `dui`, `total`, `fecha`, `id_usuario`, `id_cliente`, `apertura`) VALUES
(1, 32342356, 2800.00, '2023-06-07 00:49:50', 1, 1, 0),
(2, 98543465, 280.00, '2023-08-26 14:07:19', 1, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallescmp`
--
ALTER TABLE `detallescmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detallescmpair`
--
ALTER TABLE `detallescmpair`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detallesvnt`
--
ALTER TABLE `detallesvnt`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallesvntair`
--
ALTER TABLE `detallesvntair`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalles_comprasaires`
--
ALTER TABLE `detalles_comprasaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `detalles_ventasaires`
--
ALTER TABLE `detalles_ventasaires`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventarioaires`
--
ALTER TABLE `inventarioaires`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventariorespuestos`
--
ALTER TABLE `inventariorespuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ventasaires`
--
ALTER TABLE `ventasaires`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detallescmp`
--
ALTER TABLE `detallescmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallescmpair`
--
ALTER TABLE `detallescmpair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallesvnt`
--
ALTER TABLE `detallesvnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallesvntair`
--
ALTER TABLE `detallesvntair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_comprasaires`
--
ALTER TABLE `detalles_comprasaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalles_ventasaires`
--
ALTER TABLE `detalles_ventasaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventarioaires`
--
ALTER TABLE `inventarioaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inventariorespuestos`
--
ALTER TABLE `inventariorespuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventasaires`
--
ALTER TABLE `ventasaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
