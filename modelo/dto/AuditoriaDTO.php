<?php

class AuditoriaDTO {
    private $idUsuario;
    private $idProyecto;
    private $descripcion;   
    private $producto;
    public function __construct($idUsuario, $idProyecto, $descripcion)
    {
        $this->idUsuario = $idUsuario;
        $this->idProyecto = $idProyecto;
        $this->descripcion = $descripcion;        
    }
    
    function getProducto() {
        return $this->producto;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

        public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    } 

}