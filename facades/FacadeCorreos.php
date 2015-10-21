<?php

class FacadeCorreos {
    private $conexionBase = null;    
    private $correoDAO = null;

    function __construct() {    
        $this->correoDAO = new EnvioCorreos();
        $this->conexionBase = Conexion::getConexion();
    }  
    
    public function EnvioCorreo(CorreosDTO $correoDTO){
        return $this->correoDAO->EnviarCorreo($correoDTO);
    }
}
