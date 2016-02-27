<?php

class FacadeProcesos {

    private $conexionBase = null;
    private $ProcesosDAO = null;

    function __construct() {
        $this->ProcesosDAO = new ProcesosDAO();
        $this->conexionBase = Conexion::getConexion();
    }

    function AgregarProceso(ProcesosDTO $pDTO, $producto) {

        return $this->ProcesosDAO->AgregarProceso($pDTO, $producto, $this->conexionBase);
    }

    function ConsecutivoProcesos() {

        return $this->ProcesosDAO->consecutivoProceso($this->conexionBase);
    }

    function AsignarProcesos(ProcesosDTO $pDTO) {

        return $this->ProcesosDAO->AsignarProcesos($pDTO, $this->conexionBase);
    }

    function ListarProcesos() {

        return $this->ProcesosDAO->listarProcesos($this->conexionBase);
    }

    function ModificarProcesos($procesoDTO) {

        return $this->ProcesosDAO->ModificarProcesos($procesoDTO, $this->conexionBase);
    }

    function eliminarProceso($idProceso) {

        return $this->ProcesosDAO->eliminarProceso($idProceso, $this->conexionBase);
    }

    function consultarProcesos($idProceso) {

        return $this->ProcesosDAO->consultarProcesos($idProceso, $this->conexionBase);
    }

    function obtenerProcesoPorProducto($idProducto) {

        return $this->ProcesosDAO->obtenerProcesoPorProducto($idProducto, $this->conexionBase);
    }

    function obtenerProcesoPorID($idProceso) {

        return $this->ProcesosDAO->obtenerProcesoPorID($idProceso, $this->conexionBase);
    }
    
    function relacionProcesosProyecto($idProyecto) {

        return $this->ProcesosDAO->relacionProcesosProyecto($idProyecto, $this->conexionBase);
    }
}
