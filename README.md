# Peliculas
Website conectada a base de datos con PHP usando PDO para insertar, editar, eliminar y ordenar registros y mostrarlos

SQL para crear la tabla de datos:

CREATE TABLE `pelicules` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `any` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

Ejemplos:

INSERT INTO `pelicules` (`id`, `nombre`, `any`) VALUES
(2, 'Zodiac', 2007),
(4, 'Regreso al Futuro', 1985),
(5, 'El Padrino', 1972),
(7, 'El Gran Lebowski', 1998),
(9, 'Gladiator', 2000),
(10, 'Tenet', 2020),
(11, 'Apocalise Now', 1979),
(12, 'Blade Runner', 1982),
(13, 'Pulp Fiction', 1994);
