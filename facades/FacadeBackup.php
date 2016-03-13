<?php

class FacadeBackup {
    //put your code here
    private $conexionBase = null;
    private $BackDAO = null;
    
   function __construct() {
        $this->BackDAO = new BackupDAO();
        $this->conexionBase = Conexion::getConexion();
    }
 
    function BackupTablas($ruta, $tabla){
        
         return $this->BackDAO->BackupTablas($ruta, $tabla, $this->conexionBase);
    }

  
}
