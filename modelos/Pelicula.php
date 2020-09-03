<?php

if (!defined('CONTROLADOR'))
    exit;

require 'Conexion.php';

class Pelicula {

    private $id;
    private $nombre;
    private $any;

    const TABLA = 'pelicules';
    
    public function __construct($nombre=null, $any=null, $id=null) {
        $this->nombre = $nombre;
        $this->any = $any; 
       $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getAny() {
        return $this->any;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setAny($any) {
        $this->any = $any;
    }

    public function guardar() {
        $conexion = new Conexion();
        if ($this->id) /* Modifica */ {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET nombre = :nombre, any = :any WHERE id = :id');
            $consulta->bindParam(':nombre', $this->nombre);
            $consulta->bindParam(':any', $this->any);
            $consulta->bindParam(':id', $this->id);
            $consulta->execute();
        } else /* Inserta */ {
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA . ' (nombre, any) VALUES(:nombre, :any)');
            $consulta->bindParam(':nombre', $this->nombre);
            $consulta->bindParam(':any', $this->any);
            $consulta->execute();
            $this->id = $conexion->lastInsertId();
        }
        $conexion = null;
    }
    
    public function eliminar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $this->id);
        $consulta->execute();
        $conexion = null;
    }

    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT nombre, any FROM ' . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        $conexion = null;
        if ($registro) {
            return new self($registro['nombre'], $registro['any'], $id);
        } else {
            return false;
        }
    }

    public static function recuperarTodos() {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT id, nombre, any FROM ' . self::TABLA . ' ORDER BY nombre');
        $consulta->execute();
        $registros = $consulta->fetchAll();
        $conexion = null;
        return $registros;
    }

}
