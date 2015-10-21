<?php

class UsuarioDTO {
    private $idUsuario;
    private $identificacion;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $fecha;    
    private $email;
    private $contrasena;
    private $rol;
    private $foto;
    private $estado;
            
    function __construct($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email) {
        $this->idUsuario = $idUsuario;
        $this->identificacion = $identificacion;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->fecha = $fecha;
        $this->email = $email;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdentificacion() {
        return $this->identificacion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEmail() {
        return $this->email;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getRol() {
        return $this->rol;
    }

    function getFoto() {
        return $this->foto;
    }
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }


    
}
    