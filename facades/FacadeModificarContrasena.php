<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeModificarContrasena
 *
 * @author Jorge M. Izquierdo N
 */
class FacadeModificarContrasena {
   private $conexion=null;
    private $ModificarContrasenaDAO=null;
    
    function __construct() {
        $this->conexion = Conexion::getConexion(); 
        $this->ModificarContrasenaDAO= new ModificarContrasenaDAO;
    }
    
    public function validarContrasena($contrasenaAntigua, $sesion){
    return $this->ModificarContrasenaDAO->obtenerContrasena($contrasenaAntigua, $sesion, $this->conexion);
    }
    
    public function modificaContrasena($contrasenaNueva, $sesion){
    return $this->ModificarContrasenaDAO->ModificarContrasena($contrasenaNueva, $sesion, $this->conexion);
    }
}

