<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeForgetPassword
 *
 * @author Jorge M. Izquierdo N
 */
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
    
}
