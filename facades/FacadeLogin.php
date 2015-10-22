<?php

class FacadeLogin {
    private $conexion=null;
    private $loginDAO=null;
    
    function __construct() {
        $this->conexion = Conexion::getConexion(); 
        $this->loginDAO= new LoginDAO;
    }
    
    public function validarUser($user,$pass){
    return $this->loginDAO->login($user, $pass, $this->conexion);
    }
    
   public function modificarLogin(UsuarioDTO $usuarioDTO) {
        return $this->loginDAO->modificarLogin($usuarioDTO, $this->conexion);
    }
    
    public function seguridadPaginas($rol){
    return $this->loginDAO->seguridadPaginas($rol, $this->conexion);
    }
}