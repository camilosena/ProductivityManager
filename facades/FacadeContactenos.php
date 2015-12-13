<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeContactenos
 *
 * @author Jorge M. Izquierdo N
 */
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
