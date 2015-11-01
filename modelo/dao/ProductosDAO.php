<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductosDAO
 *
 * @author Jorge M. Izquierdo N
 */
class ProductosDAO {
    //put your code here
    
    function agregarProducto(ProductosDTO $productoDTO, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("INSERT INTO productos VALUES(?,?,?,?,?,?)");
            $sentencia->bindParam(1, $productoDTO->getIdProducto());
            $sentencia->bindParam(2, $productoDTO->getNombre());
            $sentencia->bindParam(3, $productoDTO->getImagen());
            $sentencia->bindParam(4, $productoDTO->getDescripción());
            $sentencia->bindParam(5, $productoDTO->getPorcentaje());
            $sentencia->bindParam(6, $productoDTO->getEstado());
            $sentencia->execute();
            $mensaje = "Prodcuto Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;        
    }
    
    function listarProductos(PDO $cnn){
        
         try {
            $sql = "select * from productos" ;
            $query = $cnn->prepare($sql);
           
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function listarProductosActivos(){
        try {
            $sql = "select * from productos where estadoProducto = 'Activo'" ;
            $query = $cnn->prepare($sql);
           
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
            function consecutivoProductos(PDO $cnn){
        
        try {
           
            $query = $cnn->prepare('select max(idProductos) from productos');
          
            $query->execute();
            $ultimo= $query->fetchColumn();
            return ($ultimo+1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function inactivarProducto($idEstado, PDO $cnn){
        
         try {
             
            
            $sql = "update productos set estadoProducto = 'Inactivo' where idProductos=?";
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idEstado);
            $query->execute();
            $mensaje = "Producto Inactivo";
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
       
    }
    function activarProducto($idEstado, PDO $cnn){
        
         try {
             
            
            $sql = "update productos set estadoProducto = 'Activo' where idProductos=?";
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idEstado);
            $query->execute();
            $mensaje = "Producto Habilitado";
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
       
    }
    function consultarProductos($idProducto, PDO $cnn){
        
          try {
            $sql = "select * from productos where idProductos = ?";
            
                $query = $cnn->prepare($sql);
             $query->bindParam(1, $idProducto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    function asociarInsumos(InsumosPorProductoDTO $dto,  PDO $cnn){
        
        try {           
            $sentencia = $cnn->prepare("INSERT INTO materiaprimaporproducto VALUES(?,?,?)");
            $sentencia->bindParam(1, $dto->getIdProdcuto());
            $sentencia->bindParam(2, $dto->getIdInsumo());
            $sentencia->bindParam(3, $dto->getCantidad());
            $sentencia->execute();
            $mensaje = "Prodcuto Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex;
        }
        $cnn = NULL;
        return $mensaje;    
    }
    
    
    
}
