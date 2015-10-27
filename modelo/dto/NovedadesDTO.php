<?php

class NovedadesDTO {
    private $idNovedad;
    private $idUsuario;
    private $idProyecto;
    private $categoria;
    private $descripcion;    
    private $archivo;
    private $fecha;
    
    function __construct($idUsuario, $idProyecto, $categoria, $descripcion, $archivo) {
        $this->idUsuario = $idUsuario;
        $this->idProyecto = $idProyecto;
        $this->categoria = $categoria;
        $this->descripcion = $descripcion;
        $this->archivo = $archivo;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdProyecto() {
        return $this->idProyecto;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    /**
     * @return mixed
     */
    public function getIdNovedad()
    {
        return $this->idNovedad;
    }

    /**
     * @param mixed $idNovedad
     */
    public function setIdNovedad($idNovedad)
    {
        $this->idNovedad = $idNovedad;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }





}
