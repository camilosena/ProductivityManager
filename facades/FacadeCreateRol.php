<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeCreateRol
 *
 * @author Jorge M. Izquierdo N
 */
class FacadeCreateRol {
    //put your code here
    
    private $conexionBase = null;
    private $crearRolDAO = null;
    
   function __construct() {
        $this->crearRolDAO = new CrearRolDAO();
        $this->conexionBase = Conexion::getConexion();
    }

    
    function listarPermisos(){
        return $this->crearRolDAO->ListarPermisos($this->conexionBase);
        
    }
    
    function agregarRol(CrearRolDTO $dto){
        
        return $this->crearRolDAO->RegistrarRol($dto, $this->conexionBase);
    }
    
    function agregarPermisos(CrearRolDTO $dto){
        return $this->crearRolDAO->RegistrarPermisos($dto, $this->conexionBase);
        
    }
    
    function ListarIdRoles(){
        
        return $this->crearRolDAO->listarIdRoles($this->conexionBase);
    }
    
    function  ObtenerNombreRol ($idRol){
        
        return $this->crearRolDAO->ObtenerNombreRol($idRol, $this->conexionBase);
    }
    
    function ListarRoles (){
        
        return $this->crearRolDAO->listarRoles($this->conexionBase);
    }
    
    function obtenerID($idRol){
        
       return $this->crearRolDAO->ObtenerId($idRol, $this->conexionBase); 
    }
            
    function ObtenerPermisosPorRol ($idRol){
        
        return $this->crearRolDAO->ObtenerPermisosPorRol($idRol, $this->conexionBase);
    }
            
    function ModificarRol ($idRol){
        
        return $this->crearRolDAO->UpdateRol($idRol, $this->conexionBase);
    }
    function EiliminarRol ($idRol){
        
        return $this->crearRolDAO->ElimiarRol($idRol, $this->conexionBase);
    }
    function consecutivoRoles(){
        
         return $this->crearRolDAO->consecutivoRol( $this->conexionBase);
    }
}
