<?php

class ProyectosDTO {
    private $idProyecto;
    private $nombreProyecto;
    private $fechaInicio;
    private $fechaFin;    
    private $estado;
    private $observaciones;
    private $ejecucion;
    
    function __construct($idProyecto, $nombreProyecto, $fechaInicio, $fechaFin, $estado, $observaciones) {
        $this->idProyecto = $idProyecto;
        $this->nombreProyecto = $nombreProyecto;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;        
        $this->estado = $estado;
        $this->observaciones = $observaciones;
    }

    function getIdProyecto() {
        return $this->idProyecto;
    }

    function getNombreProyecto() {
        return $this->nombreProyecto;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }
    
    function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    function setNombreProyecto($nombreProyecto) {
        $this->nombreProyecto = $nombreProyecto;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    function getEjecucion() {
        return $this->ejecucion;
    }

    function setEjecucion($ejecucion) {
        $this->ejecucion = $ejecucion;
    }
}
