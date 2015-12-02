<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FacadeArchivo{
    
    private $conexion=null;
    private $archivoDAO=null;
            
     function __construct() {
        $this->conexion = Conexion::getConexion();
        $this->archivoDAO = new ArchivoDAO();
    }
    function cargarArchivo ($table, $file){
        return $this->archivoDAO->CargarDatos($table, $file, $this->conexion);
        
    }
            
}