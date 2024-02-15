-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33067
-- Tiempo de generación: 16-02-2024 a las 00:22:11
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
-- Base de datos: `pokedex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id`, `nombre`, `tipo`, `imagen`) VALUES
(1, 'Bulbasaur', '/public/planta.png', '/public/img_pokemons/bulbasaur.png'),
(2, 'Ivysaur', '/public/planta.png', '/public/img_pokemons/ivysaur.png'),
(3, 'Venusaur', '/public/planta.png', '/public/img_pokemons/venusaur.png'),
(4, 'Charmander', '/public/fuego.png', '/public/img_pokemons/charmander.png'),
(5, 'Charmeleon', '/public/fuego.png', '/public/img_pokemons/charmeleon.png'),
(6, 'Charizard', '/public/fuego.png', '/public/img_pokemons/charizard.png'),
(7, 'Squirtle', '/public/agua.png', '/public/img_pokemons/squirtle.png'),
(8, 'Wartortle', '/public/agua.png', '/public/img_pokemons/wartortle.png'),
(9, 'Blastoise', '/public/agua.png', '/public/img_pokemons/blastoise.png'),
(10, 'Caterpie', '/public/bicho.png', '/public/img_pokemons/caterpie.png'),
(11, 'Metapod', '/public/bicho.png', '/public/img_pokemons/metapod.png'),
(12, 'Butterfree', '/public/bicho.png', '/public/img_pokemons/butterfree.png'),
(13, 'Weedle', '/public/bicho.png', '/public/img_pokemons/weedle.png'),
(14, 'Kakuna', '/public/bicho.png', '/public/img_pokemons/kakuna.png'),
(15, 'Beedrill', '/public/bicho.png', '/public/img_pokemons/beedrill.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreUser` varchar(50) NOT NULL,
  `pw` varchar(8) NOT NULL,
  `rol` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreUser`, `pw`, `rol`) VALUES
(1, 'mica', '1234', 'a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
