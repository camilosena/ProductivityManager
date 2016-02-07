<?php

class FacadeAreas {
   private $conexionBase = null;
    private $AreaDAO = null;
    
   function __construct() {
        $this->AreaDAO = new AreasDAO();
        $this->conexionBase = Conexion::getConexion();
    }
 
    function AgregarArea(AreasDTO $aDTO){
        
         return $this->AreaDAO->AgregarArea($aDTO, $this->conexionBase);
    }
    
    function ConsecutivoAreas(){
        
        return $this->AreaDAO->consecutivoArea( $this->conexionBase);
    }
    function AsignarAreas(AreasDTO $aDTO){
        
         return $this->AreaDAO->AsignarAreas($aDTO, $this->conexionBase);
    }
    function ModificarAreas($idRol){
        
         return $this->AreaDAO->ModificarAreas($idRol, $this->conexionBase);
    }
    function obtenerAreas($idRol){
        
         return $this->AreaDAO->obtenarAreas($idRol, $this->conexionBase);
    }
    function eliminarArea($idArea){
        
         return $this->AreaDAO->elimminarArea($idArea, $this->conexionBase);
    }
        function consultarArea($idArea){
        
         return $this->AreaDAO->consultarArea($idArea, $this->conexionBase);
    }

     function actualizarArea(AreasDTO $aDTO){
        
         return $this->AreaDAO->actualizarArea($aDTO, $this->conexionBase);
    }
}
