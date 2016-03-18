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
    function guardarContacto(ContactenosDTO $clienteDTO,$numero){
        
        return $this->contactenosDAO->guardarContacto($clienteDTO,$numero,$this->conexionBase);
    }
    function cantidadSolicitudes(){
        
        return $this->contactenosDAO->cantidadSolicitudes($this->conexionBase);
    }
}
