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
            $sentencia = $cnn->prepare("INSERT INTO productos VALUES(?,?,?,?)");
            $sentencia->bindParam(1, $productoDTO->getIdProducto());
            $sentencia->bindParam(2, $productoDTO->getNombre());
            $sentencia->bindParam(3, $productoDTO->getImagen());
            $sentencia->bindParam(4, $productoDTO->getDescripción());
          
            $sentencia->execute();
            $mensaje = "Prodcuto Registrada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;        
    }
    
    function listarProductos(PDO $cnn){
        
         try {
            $sql = "select * from productos";
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
    function eliminarProducto($idEliminar, PDO $cnn){
        
         try {
            $sql = 'delete from productos where idProductos=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idEliminar);
            $query->execute();
            $mensaje = "Registro eliminado";
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
       
    }
}
