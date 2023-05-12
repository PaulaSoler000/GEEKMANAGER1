-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 20:35:58
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
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id_objeto` int(11) NOT NULL,
  `id_objeto_foto` int(11) NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_objeto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_objeto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `año_salida` year(4) NOT NULL,
  `tipo_objeto` set('manga','libro','videojuego','figura') COLLATE utf8_unicode_ci NOT NULL,
  `estado_objeto` set('nuevo','seminuevo','usado') COLLATE utf8_unicode_ci NOT NULL,
  `curso` set('sin_empezar','empezado','terminado') COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `edicion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `volumen` int(50) NOT NULL,
  `autor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `altura` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plataforma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `compañia` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_objeto`, `id_usuario`, `nombre_objeto`, `año_salida`, `tipo_objeto`, `estado_objeto`, `curso`, `tags`, `descripcion`, `foto`, `edicion`, `editorial`, `volumen`, `autor`, `genero`, `altura`, `marca`, `plataforma`, `compañia`) VALUES
(187, 2, '2', 0000, 'libro', 'seminuevo', 'empezado', '', '2', '2', '2', '2', 2, '2', '2', '', '', '', ''),
(222, 1, 'hola 2', 2001, 'figura', 'nuevo', 'sin_empezar', '123, 4, 3, 5, 1, 15', '<p>111</p>', '../fotos/adventure time 1.jpg', 'q', '', 0, 'q', '', 'q', 'q', '', ''),
(223, 1, 'hola1', 0000, 'manga', 'seminuevo', 'sin_empezar', '1, 2, 3, 4', '<p>1111</p>', '../fotos/adventure time 1.jpg', '', '', 0, '', '', '', '', '', ''),
(224, 1, 'ss', 0000, 'libro', 'seminuevo', 'sin_empezar', '1, 2, 3, 4', '<p>2222</p>', '../fotos/adventure time 1.jpg', '', '', 0, '', '', '', '', '', ''),
(225, 1, 'qqq', 0000, 'videojuego', 'seminuevo', 'terminado', '1, 2, 3, 4, 5', '<p>222222</p>', '../fotos/adventure time 1.jpg', '', '', 0, '', '', '', '', '', ''),
(226, 1, '1234', 2000, 'figura', 'seminuevo', 'sin_empezar', '1, 2, 3, 4, 5', '<p>1</p>', '../fotos/adventure time 1.jpg', 'a', '', 0, 'b', '', 'c', 'd', '', ''),
(227, 1, 'La llamada de Cuthulu', 1987, 'libro', 'seminuevo', 'terminado', 'LoveCraft, Mitologia, TerrorCosmico', '<p>Mejor libro de LoveCraft</p>', '../fotos/blueprint seungmin 1.jpg', 'Primera', 'Alfalguardia', 1, 'LoveCraft', 'Terror', '', '', '', ''),
(228, 1, 'w', 1999, 'figura', 'nuevo', 'empezado', '4, 5, 3', '<p>22</p>', '../fotos/1.png', '1', '', 0, '', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tagsrelations`
--

CREATE TABLE `tagsrelations` (
  `id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(12, 'paulasoler', 'hola@hola.com', '$2y$10$nMtG5ChOFJAertnA8hJ6FeWTGOT4gSBX0PKB/se88jXKJUBaYDDam'),
(17, 'Alejandro', 'ale@pruebamail.com', '$2y$10$M0P4LTM3YfOgdA.nMfVfqu5FhESNLPGF80FXcKsITUZa81AJTghSK'),
(20, 'paula@', 'paula@soler.com', '$2y$10$k4pZgiIcN7iw/oAgfsNLLOm1oa5gJUNPIoCGWCbISZSBeyqy3.V4C');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD KEY `id_objeto` (`id_objeto`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_objeto`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tagsrelations`
--
ALTER TABLE `tagsrelations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_id` (`tags_id`),
  ADD KEY `inventario_id` (`inventario_id`);

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
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tagsrelations`
--
ALTER TABLE `tagsrelations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`id_objeto`) REFERENCES `inventario` (`id_objeto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tagsrelations` (`tags_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tagsrelations`
--
ALTER TABLE `tagsrelations`
  ADD CONSTRAINT `tagsrelations_ibfk_1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id_objeto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
