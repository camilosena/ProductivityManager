<?php

class FacadeGerente {

    private $conexionBase = null;
    private $gerenteDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->gerenteDAO = new GerenteDAO;
    }

    public function insertarGerente(GerenteDTO $gerenteDTO) {
        return $this->gerenteDAO->insertarGerenteDeProyecto($gerenteDTO, $this->conexionBase);
    }

    public function consultarGerente($idGerente) {
        return $this->gerenteDAO->obtenerGerenteDeProyecto($idGerente, $this->conexionBase);
    }

    public function actualizarGerente(GerenteDTO $gerenteDTO) {
        return $this->gerenteDAO->ModificarGerente($gerenteDTO, $this->conexionBase);
    }

    public function totalGerentes() {
        return $this->gerenteDAO->cantidadGerentes($this->conexionBase);
    }

}
