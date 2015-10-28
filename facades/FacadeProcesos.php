<?php

class FacadeProcesos {
   private $conexionBase = null;
    private $ProcesosDAO = null;
    
   function __construct() {
        $this->ProcesosDAO = new ProcesosDAO();
        $this->conexionBase = Conexion::getConexion();
    }
 
    function AgregarProceso (ProcesosDTO $pDTO){
        
         return $this->ProcesosDAO->AgregarProceso($pDTO, $this->conexionBase);
    }
    
    function ConsecutivoProcesos (){
        
        return $this->ProcesosDAO->consecutivoProceso( $this->conexionBase);
    }
    function AsignarProcesos (ProcesosDTO $pDTO){
        
         return $this->ProcesosDAO->AsignarProcesos($pDTO, $this->conexionBase);
    }
    function ListarProcesos(){
        
        return $this->ProcesosDAO->listarProcesos($this->conexionBase);
    }
    function ModificarProcesos ($idProceso){
        
         return $this->ProcesosDAO->ModificarProcesos($idProceso, $this->conexionBase);
    }
    function obtenerProcesos ($idProceso){
        
         return $this->ProcesosDAO->obtenarProcesos($idProceso, $this->conexionBase);
    }
    function eliminarProceso ($idProceso){
        
         return $this->ProcesosDAO->eliminarProceso($idProceso, $this->conexionBase);
    }
}
