SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fernandobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gorras`
--

CREATE TABLE `gorras` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `stock` int DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `nom_imagen` varchar(100) DEFAULT NULL,
  `imagen` blob DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `gorras`
--

INSERT INTO `gorras` (`cod`, `stock`, `color`, `nom_imagen`, `imagen`) VALUES
(0, 6, 'negro', 'gorra_0.jpg', ''),
(1, 4, 'negro', 'gorra_1.jpg', ''),
(2, 8, 'rojo', 'gorra_2.jpg', ''),
(3, 2, 'amarillo', 'gorra_3.jpg', ''),
(4, 12, 'blanco', 'gorra_4.jpg', ''),
(5, 31, 'gris', 'gorra_5.jpg', ''),
(6, 5, 'blanco', 'gorra_6.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(12) NOT NULL,
  `contasena` varchar(200) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`, `rol`) VALUES
('admin', 'admin123', 'administrador'),
('fernando', 'fernando123', 'limitado');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;