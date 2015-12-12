<?php

class NovedadesDTO {
    private $idNovedad;
    private $idUsuario;
    private $idProyecto;
    private $categoria;
    private $descripcion;    
    private $archivo;
    private $fecha;
    private $solucion;
    private $fechaSolucion;
    private $estadoSolucion;
    
    function __construct($idNovedad, $idUsuario, $idProyecto, $categoria, $descripcion, $archivo, $fecha, $solucion, $fechaSolucion, $estadoSolucion) {
        $this->idNovedad = $idNovedad;
        $this->idUsuario = $idUsuario;
        $this->idProyecto = $idProyecto;
        $this->categoria = $categoria;
        $this->descripcion = $descripcion;
        $this->archivo = $archivo;
        $this->fecha = $fecha;
        $this->solucion = $solucion;
        $this->fechaSolucion = $fechaSolucion;
        $this->estadoSolucion = $estadoSolucion;
    }
    function getIdNovedad() {
        return $this->idNovedad;
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

    function getFecha() {
        return $this->fecha;
    }

    function getSolucion() {
        return $this->solucion;
    }

    function getFechaSolucion() {
        return $this->fechaSolucion;
    }
    function getEstadoSolucion() {
        return $this->estadoSolucion;
    }

    function setEstadoSolucion($estadoSolucion) {
        $this->estadoSolucion = $estadoSolucion;
    }

        function setIdNovedad($idNovedad) {
        $this->idNovedad = $idNovedad;
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

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setSolucion($solucion) {
        $this->solucion = $solucion;
    }

    function setFechaSolucion($fechaSolucion) {
        $this->fechaSolucion = $fechaSolucion;
    }



}
