-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2024 a las 11:46:04
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
-- Base de datos: `apirest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Categoría1', 'Descripción categoría1'),
(2, 'Categoría2', 'Descripción categoría2'),
(3, 'Categoria3', 'Descripción Categoria3'),
(4, 'Categoria3', 'Descripción Categoria3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `idCategoria`) VALUES
(1, 'Producto1', 'Descripción Producto1', 0, 0),
(3, 'Producto3', 'Descripción Producto3', 0, 0),
(4, '', 'Descripción Producto3', 0, 0),
(5, '', 'Descripción Producto3', 0, 0),
(6, '', 'Descripción Producto3', 0, 0),
(7, 'ProductoTres', 'Descripción Producto3', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`id`, `userID`, `token`, `status`, `datetime`) VALUES
(1, 1, 'ac6564f0148eb3fb4a50626105ed7b85', 'active', '2024-08-29 13:44:26'),
(2, 1, '95ec0bb4dc49e763fe51865950d9ffce', 'active', '2024-08-29 13:45:00'),
(3, 1, 'f1e506045e4710dba64eb3f09dbc6b91', 'active', '2024-08-29 13:46:07'),
(4, 1, '12e1c3090fae4f9de6dd3faecefb65e2', 'active', '2024-08-29 13:50:36'),
(5, 1, '1236b71a5db59d8b84383c7067443882', 'active', '2024-08-29 13:52:38'),
(6, 1, '2cde56c6b965c11307e1d98ba903d2a5', 'active', '2024-08-29 13:53:33'),
(7, 1, 'e4024af48b230d47a15efc7fe0e3fa10', 'active', '2024-08-29 13:53:55'),
(8, 1, 'f27b524cc706a2506d284b33cee7f9ab', 'active', '2024-08-29 13:57:27'),
(9, 1, 'f8a57c7a8291cf264db6ae704e752b1e', 'active', '2024-08-29 13:58:15'),
(10, 1, 'da0ad0b3829a2296e65b542cfe416f3f', 'active', '2024-08-29 14:00:20'),
(11, 1, '8146a21ab8d0e37af6067dc33d6fff39', 'active', '2024-08-29 14:00:50'),
(12, 1, 'f5b26d9eacd1c051b32afb95afc6f4eb', 'active', '2024-08-29 17:03:22'),
(13, 1, '0a24ca525cc0537f71c3b6515e91e391', 'active', '2024-08-29 17:04:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `level`) VALUES
(1, 'sonia', 'sonia1234', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
