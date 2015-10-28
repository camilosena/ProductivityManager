<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProcesosDTO
 *
 * @author Jorge M. Izquierdo N
 */
class ProcesosDTO {
    //put your code here
    private $idProceso;
    private $tipo;
    private $tiempo;
    private $empleados;
    
//    function __construct($idProceso, $tipo, $tiempo,$empleados) {
//        $this->idProceso = $idProceso;
//        $this->tipo = $tipo;
//        $this->tiempo = $tiempo;
//        $this->empleados= $empleados;
//    }

    
    function getIdProceso() {
        return $this->idProceso;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTiempo() {
        return $this->tiempo;
    }
    function getEmpleados() {
        return $this->empleados;
    }

    function setEmpleados($empleados) {
        $this->empleados = $empleados;
    }

        function setIdProceso($idProceso) {
        $this->idProceso = $idProceso;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }


}
