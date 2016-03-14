<?php

class FacadeBackup {
    //put your code here
    private $conexionBase = null;
    private $BackDAO = null;
    
    private $back = null;
            
   function __construct() {
        $this->BackDAO = new BackupDAO();
        $this->conexionBase = Conexion::getConexion();
        $this->back = new BackUp();
    }
 
    function BackupTablas($ruta, $tabla){
        
         return $this->BackDAO->BackupTablas($ruta, $tabla, $this->conexionBase);
    }
    function listarTablas(){
        
        return $this->BackDAO->listarTablas($this->conexionBase);
    }
    function Backup_Database(){
        
        return $this->back->backupTables($this->conexionBase);
    }

  
}
