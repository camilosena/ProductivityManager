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
}
