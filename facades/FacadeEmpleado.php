<?php

class FacadeEmpleado {

    private $conexionBase = null;
    private $empleadoDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->empleadoDAO = new EmpleadoDAO;
    }

    public function insertarEmpleado(EmpleadoDTO $empleadoDTO) {
        return $this->empleadoDAO->ingresarEmpleado($empleadoDTO, $this->conexionBase);
    }

    public function consultarEmpleado($idEmpleado) {
        return $this->empleadoDAO->obtenerEmpleado($idEmpleado, $this->conexionBase);
    }

    function actualizarEmpleado(EmpleadoDTO $empleadoDTO) {

        return $this->empleadoDAO->ModificarEmpleado($empleadoDTO, $this->conexionBase);
    }

    public function totalEmpleados() {
        return $this->empleadoDAO->cantidadEmpleados($this->conexionBase);
    }

}
