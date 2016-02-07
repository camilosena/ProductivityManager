<?php

class FacadeContactenos {
    
    private $conexionBase = null;
    private $contactenosDAO = null;
    
     function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->contactenosDAO = new ContactenosDAO();
    }
    function  listarPaises(){
        
        return $this->contactenosDAO->listarPaises($this->conexionBase); 
    }
    function consultarIndicativo($idPais){
        
        return $this->contactenosDAO->consultarIndicativo($idPais, $this->conexionBase);
    }
    function guardarContacto(ContactenosDTO $clienteDTO){
        
        return $this->contactenosDAO->guardarContacto($clienteDTO,$this->conexionBase);
    }
    function cantidadSolicitudes(){
        
        return $this->contactenosDAO->cantidadSolicitudes($this->conexionBase);
    }
}
