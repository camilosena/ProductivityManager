<?php

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
