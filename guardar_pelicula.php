<?php
    
    define('CONTROLADOR', TRUE);
    
    require_once 'modelos/Pelicula.php';
    
    $pelicula_id = (isset($_REQUEST['pelicula_id'])) ? $_REQUEST['pelicula_id'] : null;
    
    if($pelicula_id){        
        $pelicula = Pelicula::buscarPorId($pelicula_id);        
    }else{
        $pelicula = new Pelicula();
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : null;
        $any = (isset($_POST['any'])) ? $_POST['any'] : null;
        $pelicula->setNombre($nombre);
        $pelicula->setAny($any);
        $pelicula->guardar();
        header('Location: index.php');
    }else{
        include 'vistas/guardar_pelicula.php';
    }
    
?>
