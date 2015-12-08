<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeProductos
 *
 * @author Jorge M. Izquierdo N
 */
class FacadeProductos {
    //put your code here
    
    private $productosDAO;
    private $conexion;
    
    function __construct() {
        $this->productosDAO = new ProductosDAO();
        $this->conexion = Conexion::getConexion();
    }
    
    function agregarProducto($productoDTO){
        return $this->productosDAO->agregarProducto($productoDTO, $this->conexion);
        
    }
            
    function listarProductos(){
        
        return $this->productosDAO->listarProductos($this->conexion);
    }
    function listarProductosActivos(){
        
        return $this->productosDAO->listarProductosActivos($this->conexion);
    }
    function maxProductoActivo(){
        
        return $this->productosDAO->productoMaximo($this->conexion);
    }    
    function consecutivoProducto(){
        
        return $this->productosDAO->consecutivoProductos($this->conexion);
    }
    function inactivarProducto($idInactivar){
        
        return $this->productosDAO->inactivarProducto($idInactivar,  $this->conexion);
    }
    function activarProducto($idActivar){
        
        return $this->productosDAO->activarProducto($idActivar,  $this->conexion);
    }
    function consultarProducto($idProducto){
        
        return $this->productosDAO->consultarProductos($idProducto, $this->conexion);
    }
    function asociarInsumos($dto){
        
        return $this->productosDAO->asociarInsumos($dto, $this->conexion);
    }
    function productosPorProyecto($idProyecto){
        
        return $this->productosDAO->producoPorProyecto($idProyecto, $this->conexion);
    }
    function cantidadPorInsumo($idInsumo, $idProducto){
        
        return $this->productosDAO->cantidadPorInsumo($idInsumo, $idProducto, $this->conexion);
    }
    function modificarEstadoProducto($estado,$idProducto){
        
        return $this->productosDAO->modificarEstadoProducto($estado, $idProducto, $this->conexion);
    }
    function listarProductosSinProcesos(){
        
        return $this->productosDAO->listarProductosSinProcesos($this->conexion);
    }

}
