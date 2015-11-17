<?php

class FacadeEstudioCostos {
    private $conexionBase = null;
    private $estudioDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->estudioDAO = new EstudioCostosDAO;
    }
    public function crearEstudio(EstudioCostosDTO $estudioDTO) {
        return $this->estudioDAO->generarEstudioCostos($estudioDTO, $this->conexionBase);
    }
    public function costoManoDeObra($idProyecto) {
        return $this->estudioDAO->costoManoDeObra($idProyecto,$this->conexionBase);
    }
    public function costoProduccion($idProyecto) {
        return $this->estudioDAO->costoProduccion($idProyecto,$this->conexionBase);
    }
    public function tiempoEstimado($idProyecto) {
        return $this->estudioDAO->tiempoEstimado($idProyecto,$this->conexionBase);
    }
    public function empleadosSolicitados($idProyecto) {
        return $this->estudioDAO->empleadosSolicitados($idProyecto,$this->conexionBase);
    }
}
