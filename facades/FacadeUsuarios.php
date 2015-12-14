<?php

class FacadeUsuarios{

    private $conexionBase = null;
    private $objetoDAO = null;

    function __construct(){
        $this->objetoDAO = new UsuarioDAO;
        $this->conexionBase = Conexion::getConexion();
    }

    public function registrarUsuario(UsuarioDTO $usuarioDTO)
    {
        return $this->objetoDAO->registrarUsuario($usuarioDTO, $this->conexionBase);
    }

    public function consecutivoUsuario()
    {
        return $this->objetoDAO->idConsecutivo($this->conexionBase);
    }

    public function actualizarUsuario(UsuarioDTO $usuarioDTO)
    {
        return $this->objetoDAO->modificarUsuario($usuarioDTO, $this->conexionBase);
    }

    public function desactivarUsuario($idUsuario, $estado)
    {
        return $this->objetoDAO->eliminarUsuario($idUsuario, $estado, $this->conexionBase);
    }

    public function activarUsuario($idUsuario, $estado)
    {
        return $this->objetoDAO->activarUsuario($idUsuario, $estado, $this->conexionBase);
    }

    public function listadoUsuario()
    {
        return $this->objetoDAO->listarUsuarios($this->conexionBase);
    }

    public function consultarUsuario($idUsuario)
    {
        return $this->objetoDAO->obtenerUsuario($idUsuario, $this->conexionBase);
    }

    public function consultarUsuarioInactivo($idUsuario)
    {
        return $this->objetoDAO->obtenerUsuarioInactivo($idUsuario, $this->conexionBase);
    }

    public function consultarRepresentante($idCliente)
    {
        return $this->objetoDAO->obtenerRepresentante($idCliente, $this->conexionBase);
    }

    public function insertarLogeo(UsuarioDTO $usuarioDTO)
    {
        return $this->objetoDAO->insertarLogin($usuarioDTO, $this->conexionBase);
    }

    public function nombreUsuario($idUsuario)
    {
        return $this->objetoDAO->nombreUsuario($idUsuario, $this->conexionBase);
    }

    public function asignarUsuarioProyecto($idUsuario, $idProyecto)
    {
        return $this->objetoDAO->asignarUsuarioProyecto($idUsuario, $idProyecto, $this->conexionBase);
    }

    public function modificarUsuarioProyecto($idUsuario, $idProyecto)
    {
        return $this->objetoDAO->modificarUsuarioProyecto($idUsuario, $idProyecto, $this->conexionBase);
    }

    public function usuarioEnSesion($idLogin)
    {
        return $this->objetoDAO->usuarioEnSesion($idLogin, $this->conexionBase);
    }

    public function verFoto($idLogin)
    {
        return $this->objetoDAO->verFoto($idLogin, $this->conexionBase);
    }

    function listarUsuariosInactivos()
    {
        return $this->objetoDAO->listarUsuariosInactivos($this->conexionBase);
    }

    function listarAreas($idRol = null)
    {

        return $this->objetoDAO->listarAreas($idRol, $this->conexionBase);
    }

    function ascenderUsuario($idRol, $identificion)
    {

        return $this->objetoDAO->ascenderUsuario($idRol, $identificion, $this->conexionBase);
    }

    function actualizarArea($idUsuario, $area)
    {

        return $this->objetoDAO->actualizarArea($idUsuario, $area, $this->conexionBase);
    }

    public function cantidadUsuariosPorRol($rol)
    {
        return $this->objetoDAO->cantidadUsuariosPorRol($rol, $this->conexionBase);
    }

    function actualizarFoto($foto, $identificacion)
    {

        return $this->objetoDAO->actualizarFoto($foto, $identificacion, $this->conexionBase);
    }

    function verificarUsuarioRegistrado($identificacion)
    {

        return $this->objetoDAO->verificarUsuarioRegistrado($identificacion, $this->conexionBase);
    }
    function consultarUsuariosPorArchivo(){
        
        return $this->objetoDAO->consultarUsuariosPorArchivo($this->conexionBase);
    }
    function actualizarLogin($dto){
        
        return $this->objetoDAO->actualizarLogin($dto, $this->conexionBase);
    }
    function correosPorProyecto($idProyecto){
        
        return $this->objetoDAO->correosPorProyecto($idProyecto, $this->conexionBase);
    }
}
