<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeInsumos
 *
 * @author Jorge M. Izquierdo N
 */
class FacadeInsumos {
    //put your code here
     private $conexionBase = null;
    private $insumoDAO = null;
    
    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->insumoDAO = new InsumosDAO();
    }

    function agregarInsumo(InsumosDTO $Idto){
         
        return $this->insumoDAO->agregarInsumo($Idto, $this->conexionBase);
        
    }
    
    function listarInsumos(){
        
        return $this->insumoDAO->listarInsumos($this->conexionBase);
    }
    function consecutivoInsumos(){
        
         return $this->insumoDAO->consecutivoInsumos($this->conexionBase);
    }
    function eliminarInsumos($idEliminar){
        
        return $this->insumoDAO->eliminarInsumo($idEliminar, $this->conexionBase);
    }
    function consultarAsignacion(){
        
        return $this->insumoDAO->consultarAsignación($this->conexionBase);
    }
    function obtenerInsumos($idProducto){
    
         return $this->insumoDAO->obtenerInsumos($idProducto, $this->conexionBase);   
    }

}
