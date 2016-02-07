<?php


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

