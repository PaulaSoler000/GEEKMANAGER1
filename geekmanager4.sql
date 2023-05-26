-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2023 a las 20:46:08
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
  `id_foto` int(11) NOT NULL,
  `galeria` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id_objeto`, `id_foto`, `galeria`) VALUES
(237, 18, '../fotos/adventure time 1.jpg'),
(237, 19, '../fotos/genshin_prueba.jpg');

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
(225, 1, 'qqq', 1999, 'videojuego', 'seminuevo', 'terminado', '1, 2, 3, 4, 5', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</span><br></p>', '../fotos/adventure time 1.jpg', '2', '', 0, '', '2', '', '', '2', '2'),
(234, 1, 'hola', 1904, 'videojuego', 'seminuevo', 'terminado', '222, 2, 5, hola, adios, buenas tardes, kill, 2u', '<p>weeeee</p>', '../fotos/3.png', 'limitada', '', 0, '', 'fnatasía', '', '', 'ssss', 'sssss'),
(235, 1, 'adios', 1977, 'libro', 'seminuevo', 'terminado', 'fnatasia, love, weee, adios, hola', '<p>qqqqqqoqoqoqoqq</p>', '../fotos/2.png', 'lol', 'lollll', 1111, 'wwwweee', 'fantasia', '', '', '', ''),
(236, 1, 'Genshin Impact', 2020, 'videojuego', 'nuevo', 'sin_empezar', 'Genshin, traveler, love, kill, hola', '<p><span style=\"text-align: start;\"><em>Genshin Impact</em> es un videojuego de rol de acción de mundo abierto y gratuito, con una mecánica de monetización de gacha para conseguir elementos adicionales como <strong>personajes especiales y armas.</strong></span><br></p>', '../fotos/genshin_prueba.jpg', 'limitada', '', 0, '', 'aventura', '', '', 'andorid', 'Hoyoverse'),
(237, 101, 'genshin impact', 2021, 'videojuego', 'nuevo', 'sin_empezar', 'love, genshin, impact, traveler main', '<p>hola, este es mi juego</p>', '../fotos/genshin_prueba.jpg', 'primera', '', 0, '', 'aventura', '', '', 'pc', 'hoyoverse');

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
(20, 'paula@', 'paula@soler.com', '$2y$10$k4pZgiIcN7iw/oAgfsNLLOm1oa5gJUNPIoCGWCbISZSBeyqy3.V4C'),
(99, 'invitado', '', ''),
(100, 'nuevo', 'nuevo@nuevo', '$2y$10$A8C0pD356XI0RqPtxKH7b.oDJWMxSSkuKmjf3S3W3fWvTbP5vEnrG'),
(101, 'paulasoler', 'hola@paula.com', '$2y$10$Hlbx6y6ZK0jZ1r22iUW0R.lGj1Bx7Se0UKgcLA0kZzQWCjw/aQ3lW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_objeto` (`id_objeto`);

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
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
