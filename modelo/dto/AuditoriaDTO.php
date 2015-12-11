<?php

class AuditoriaDTO {

    private $idAuditoria;
    private $idUsuario;
    private $idProyecto;
    private $descripcion;   
    private $producto;
    private $archivoAuditoria;
    private $ejecucion;
    private $presupuesto;
    private $insumos;
    private $calidad;
    private $procesos;
    private $empleados;



    /**
     * AuditoriaDTO constructor.
     * @param $idUsuario
     * @param $idProyecto
     * @param $descripcion
     * @param $producto
     */
    function __construct($idAuditoria, $idUsuario, $idProyecto, $descripcion, $producto, $archivoAuditoria, $ejecucion, $presupuesto, $insumos, $calidad, $procesos, $empleados) {
        $this->idAuditoria = $idAuditoria;
        $this->idUsuario = $idUsuario;
        $this->idProyecto = $idProyecto;
        $this->descripcion = $descripcion;
        $this->producto = $producto;
        $this->archivoAuditoria = $archivoAuditoria;
        $this->ejecucion = $ejecucion;
        $this->presupuesto = $presupuesto;
        $this->insumos = $insumos;
        $this->calidad = $calidad;
        $this->procesos = $procesos;
        $this->empleados = $empleados;
    }
    function getIdAuditoria() {
        return $this->idAuditoria;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdProyecto() {
        return $this->idProyecto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getProducto() {
        return $this->producto;
    }

    function getArchivoAuditoria() {
        return $this->archivoAuditoria;
    }

    function getEjecucion() {
        return $this->ejecucion;
    }

    function getPresupuesto() {
        return $this->presupuesto;
    }

    function getInsumos() {
        return $this->insumos;
    }

    function getCalidad() {
        return $this->calidad;
    }

    function getProcesos() {
        return $this->procesos;
    }

    function getEmpleados() {
        return $this->empleados;
    }

    function setIdAuditoria($idAuditoria) {
        $this->idAuditoria = $idAuditoria;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setArchivoAuditoria($archivoAuditoria) {
        $this->archivoAuditoria = $archivoAuditoria;
    }

    function setEjecucion($ejecucion) {
        $this->ejecucion = $ejecucion;
    }

    function setPresupuesto($presupuesto) {
        $this->presupuesto = $presupuesto;
    }

    function setInsumos($insumos) {
        $this->insumos = $insumos;
    }

    function setCalidad($calidad) {
        $this->calidad = $calidad;
    }

    function setProcesos($procesos) {
        $this->procesos = $procesos;
    }

    function setEmpleados($empleados) {
        $this->empleados = $empleados;
    }


}