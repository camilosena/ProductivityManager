<?php

class FacadeUsuarios {

    private $conexionBase = null;
    private $objetoDAO = null;

    function __construct() {
        $this->objetoDAO = new UsuarioDAO;
        $this->conexionBase = Conexion::getConexion();
    }

    public function insertarUsuario(UsuarioDTO $usuarioDTO) {
        return $this->objetoDAO->RegistrarUsuario($usuarioDTO, $this->conexionBase);
    }

    public function consecutivoUsuario() {
        return $this->objetoDAO->idConsecutivo($this->conexionBase);
    }

    public function actualizarUsuario(UsuarioDTO $usuarioDTO) {
        return $this->objetoDAO->ModificarUsuario($usuarioDTO, $this->conexionBase);
    }

    public function desactivarUsuario($idUsuario, $estado) {
        return $this->objetoDAO->eliminarUsuario($idUsuario, $estado, $this->conexionBase);
    }
    
    public function activarUsuario($idUsuario, $estado) {
        return $this->objetoDAO->activarUsuario($idUsuario, $estado, $this->conexionBase);
    }

    public function listadoUsuario() {
        return $this->objetoDAO->listarUsuarios($this->conexionBase);
    }

    public function consultarUsuario($idUsuario) {
        return $this->objetoDAO->obtenerUsuario($idUsuario, $this->conexionBase);
    }

    public function consultarRepresentante($idCliente) {
        return $this->objetoDAO->obtenerRepresentante($idCliente, $this->conexionBase);
    }

    public function insertarLogeo(UsuarioDTO $usuarioDTO) {
        return $this->objetoDAO->insertarLogin($usuarioDTO, $this->conexionBase);
    }

    public function nombreUsuario($idUsuario) {
        return $this->objetoDAO->nombreUsuario($idUsuario, $this->conexionBase);
    }
    
    public function asignarUsuarioProyecto($idUsuario,$idProyecto) {
        return $this->objetoDAO->asignarUsuarioProyecto($idUsuario, $idProyecto, $this->conexionBase);
    }
    
     public function modificarUsuarioProyecto($idUsuario, $idProyecto) {
        return $this->objetoDAO->modificarUsuarioProyecto($idUsuario, $idProyecto, $this->conexionBase);
    }
    
     public function usuarioEnSesion($idLogin) {
        return $this->objetoDAO->usuarioEnSesion($idLogin, $this->conexionBase);
    }
    
    public function verFoto($idLogin) {
        return $this->objetoDAO->verFoto($idLogin, $this->conexionBase);
    }
    
    function listarUsuariosInactivos (){        
         return $this->objetoDAO->listarUsuariosInactivos($this->conexionBase);
    }
    
    function listarAreas($idRol = null) {

        return $this->objetoDAO->listarAreas($idRol, $this->conexionBase);
    }

    function ascenderUsuario($idRol, $identificion) {

        return $this->objetoDAO->ascenderUsiario($idRol, $identificion, $this->conexionBase);
    }
    
    public function cantidadUsuariosPorRol($rol) {
        return $this->objetoDAO->cantidadUsuariosPorRol($rol,  $this->conexionBase);
    }
}
