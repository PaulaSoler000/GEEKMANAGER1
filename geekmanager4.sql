-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2023 a las 20:45:30
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `geekmanager4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_objeto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_objeto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_objeto` set('manga','libro','videojuego','figura') COLLATE utf8_unicode_ci NOT NULL,
  `estado_objeto` set('nuevo','seminuevo','usado') COLLATE utf8_unicode_ci NOT NULL,
  `curso` set('sin_empezar','empezado','terminado') COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `edicion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `volumen` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `altura` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plataforma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `compania` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_objeto`, `id_usuario`, `nombre_objeto`, `tipo_objeto`, `estado_objeto`, `curso`, `descripcion`, `foto`, `edicion`, `editorial`, `volumen`, `autor`, `genero`, `altura`, `marca`, `plataforma`, `compania`) VALUES
(178, 1, '11', 'libro', 'nuevo', 'sin_empezar', '11', '../fotos/1.png', '', '', '', '', '', '', '', '', ''),
(180, 1, '33', 'figura', 'nuevo', 'empezado', '111111', '../fotos/3.png', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `email`, `password`) VALUES
(1, 'Paula', 'paula@paula.com', '$2y$10$gZPeG1ojMTES1BVeLXjpY.fk9RPoOmCAqRZ3wWw4P4W92YSgSkgbq'),
(2, 'prueba', 's@s', '$2y$10$YE9hwIlHkJ78YcGkU37fhOHmcHeAnMnrE4mqSZBOVj2sO88wB60Aq'),
(11, 'prueba2', 'paula@paula.com', '$2y$10$YhdhBjRZyQy9RTIOKNPuP.j38qwIHDSqyVvIDLf4FvDomPe1EChOW'),
(12, 'paulasoler', 'hola@hola.com', '$2y$10$nMtG5ChOFJAertnA8hJ6FeWTGOT4gSBX0PKB/se88jXKJUBaYDDam');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_objeto`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
