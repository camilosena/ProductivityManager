<?php

class FacadeNovedades {
    private $conexionBase=null;
    private $novedadDAO=null;
    
    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->novedadDAO = new NovedadesDAO;
    }
    
    public function insertarNovedad(NovedadesDTO $objetoNov) {
        return $this->novedadDAO->crearNovedad($objetoNov, $this->conexionBase);
    }
    
    public function usuarioCreaNovedad($logueado) {
        return $this->novedadDAO->usuarioCreaNovedad($logueado, $this->conexionBase);
    }
    
    public function numeroNovedad() {
        return $this->novedadDAO->numeroNovedad($this->conexionBase);
    }
     public function listadoNovedades() {
        return $this->novedadDAO->listarNovedades($this->conexionBase);
    }
     public function consultarNovedad($idNovedad) {
        return $this->novedadDAO->consultarNovedad($idNovedad,$this->conexionBase);
    }
}
