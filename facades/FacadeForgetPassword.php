<?php

class FacadeForgetPassword {
    private $conexion=null;
    private $forgetPasswordDAO=null;
    
    function __construct() {
        $this->conexion = Conexion::getConexion(); 
        $this->forgetPasswordDAO= new ForgetPasswordDAO();
    }
    
    public function validateUser($user, $email){
    return $this->forgetPasswordDAO->getUser($user, $email, $this->conexion);
    }
    
    public function updatePassword($passNew, $user){
        
        return $this->forgetPasswordDAO->ModificarContrasena($passNew, $user, $this->conexion);
    }
    function  RamdomCode (){
        
        return $this->forgetPasswordDAO->RandomString();
    }
    
    
}
