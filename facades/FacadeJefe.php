<?php

class FacadeJefe {

    private $conexionBase = null;
    private $JefeDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->JefeDAO = new JefeDAO;
    }

    public function insertarJefe(JefeDTO $jefeDTO) {
        return $this->JefeDAO->ingresarJefe($jefeDTO, $this->conexionBase);
    }

    public function consultarJefe($idJefe) {
        return $this->JefeDAO->obtenerJefe($idJefe, $this->conexionBase);
    }

    function actualizarJefe(JefeDTO $jefeDTO) {
        return $this->JefeDAO->ModificarJefe($jefeDTO, $this->conexionBase);
    }

    public function totalJefes() {
        return $this->JefeDAO->cantidadJefes($this->conexionBase);
    }

}
