<?php
    
    define('CONTROLADOR', TRUE);
    
    require_once 'modelos/Pelicula.php';
    
    $peliculas = Pelicula::recuperarTodos();
    
    require_once 'vistas/index.php';
    
?>