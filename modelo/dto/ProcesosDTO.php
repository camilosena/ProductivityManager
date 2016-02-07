<?php

class ProcesosDTO {
    //put your code here
    private $idProceso;
    private $tipo;
    private $valor;
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
    function getValor() {
        return $this->valor;
    }

    function setValor($valor) {
        $this->valor = $valor;
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
