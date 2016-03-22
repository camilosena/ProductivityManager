<?php

class FacadeBackup {
    //put your code here
    private $conexionBase = null;
    private $BackDAO = null;
            
   function __construct() {
        $this->BackDAO = new BackupDAO();
        $this->conexionBase = Conexion::getConexion();
    }
 
    function BackupTablas( $tabla){
        
         return $this->BackDAO->BackupTablas($tabla, $this->conexionBase);
    }
    function listarTablas(){
        
        return $this->BackDAO->listarTablas($this->conexionBase);
    }
    function Backup_Database(){
        
        return $this->BackDAO->backupTables($this->conexionBase);
    }

  
}
