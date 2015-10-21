<?php

class FacadeAuditorias
{

    private $conexionBase=null;
    private $auditoriaDAO=null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->auditoriaDAO = new AuditoriaDAO();
    }

    public function insertarAuditoria(AuditoriaDTO $objetoAud) {
        return $this->auditoriaDAO->crearAuditoria($objetoAud, $this->conexionBase);
    }

    public function numeroAditoria() {
        return $this->auditoriaDAO->numeroAudoria($this->conexionBase);
    }

    public function consultarAuditorias() {
        return $this->auditoriaDAO->listarAuditorias($this->conexionBase);

    }
}