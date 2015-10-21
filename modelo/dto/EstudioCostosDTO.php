<?php

class EstudioCostosDTO {
    private $idProyectoSolicitado;
    private $idGerenteCargo;
    private $materiaPrima;
    private $manoObraDirecta;
    private $manoObraIndirecta;
    private $gastos;
    private $costo;
    private $utilidad;
    private $cantidadEmpleados;
    private $observaciones;
    private $viabilidad;
    
    function __construct($idProyectoSolicitado, $idGerenteCargo, $materiaPrima, $manoObraDirecta, $manoObraIndirecta, $gastos, $costo, $utilidad, $cantidadEmpleados, $observaciones, $viabilidad) {      
        $this->idProyectoSolicitado = $idProyectoSolicitado;
        $this->idGerenteCargo = $idGerenteCargo;
        $this->materiaPrima = $materiaPrima;
        $this->manoObraDirecta = $manoObraDirecta;
        $this->manoObraIndirecta = $manoObraIndirecta;
        $this->gastos = $gastos;
        $this->costo = $costo;
        $this->utilidad = $utilidad;
        $this->cantidadEmpleados = $cantidadEmpleados;
        $this->observaciones = $observaciones;
        $this->viabilidad = $viabilidad;
    }
   
    function getIdProyectoSolicitado() {
        return $this->idProyectoSolicitado;
    }

    function getIdGerenteCargo() {
        return $this->idGerenteCargo;
    }

    function getMateriaPrima() {
        return $this->materiaPrima;
    }

    function getManoObraDirecta() {
        return $this->manoObraDirecta;
    }

    function getManoObraIndirecta() {
        return $this->manoObraIndirecta;
    }

    function getGastos() {
        return $this->gastos;
    }

    function getCosto() {
        return $this->costo;
    }

    function getUtilidad() {
        return $this->utilidad;
    }

    function getCantidadEmpleados() {
        return $this->cantidadEmpleados;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getViabilidad() {
        return $this->viabilidad;
    }

    function setIdProyectoSolicitado($idProyectoSolicitado) {
        $this->idProyectoSolicitado = $idProyectoSolicitado;
    }

    function setIdGerenteCargo($idGerenteCargo) {
        $this->idGerenteCargo = $idGerenteCargo;
    }

    function setMateriaPrima($materiaPrima) {
        $this->materiaPrima = $materiaPrima;
    }

    function setManoObraDirecta($manoObraDirecta) {
        $this->manoObraDirecta = $manoObraDirecta;
    }

    function setManoObraIndirecta($manoObraIndirecta) {
        $this->manoObraIndirecta = $manoObraIndirecta;
    }

    function setGastos($gastos) {
        $this->gastos = $gastos;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

    function setUtilidad($utilidad) {
        $this->utilidad = $utilidad;
    }

    function setCantidadEmpleados($cantidadEmpleados) {
        $this->cantidadEmpleados = $cantidadEmpleados;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setViabilidad($viabilidad) {
        $this->viabilidad = $viabilidad;
    }
}

