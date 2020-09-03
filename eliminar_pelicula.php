<?php
    
    define('CONTROLADOR', TRUE);
    
    require_once 'modelos/Pelicula.php';
    
    $pelicula_id = (isset($_REQUEST['pelicula_id'])) ? $_REQUEST['pelicula_id'] : null;
    
    if($pelicula_id){
        $pelicula = Pelicula::buscarPorId($pelicula_id);        
        $pelicula->eliminar();
        header('Location: index.php');
    }
    
?>