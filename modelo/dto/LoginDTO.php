<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginDTO
 *
 * @author Jorge M. Izquierdo N
 */
class LoginDTO {
    //put your code here
    private $idLogin;
    private $contrasena;
    private $rol;
    
    function getIdLogin() {
        return $this->idLogin;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getRol() {
        return $this->rol;
    }

    function setIdLogin($idLogin) {
        $this->idLogin = $idLogin;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }


}
