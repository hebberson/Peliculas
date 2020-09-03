# Peliculas
Website conectada a base de datos con PHP usando PDO para insertar, editar, eliminar y ordenar registros y mostrarlos

SQL para crear la tabla de datos:

CREATE TABLE `pelicules` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `any` int(4) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
