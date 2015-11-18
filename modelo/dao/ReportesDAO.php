<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportesDAO
 *
 * @author Jorge M. Izquierdo N
 */
class ReportesDAO {
    //put your code here
    function ProyectosPorCliente($idCliente, PDO $cnn){
        try {
            $query = $cnn->prepare("SELECT idProyecto, nombreProyecto FROM proyectos 
join usuarioporproyecto on proyectoAsignado = idProyecto and usuarioAsignado=?");
             $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
        
        function ProductosPorCliente ($idCliente, PDO $cnn){
           try {
            $query = $cnn->prepare("select idProductos, nombreProducto from productos
join productoporproyecto on Productos_idProductos = idProductos 
join proyectos on proyectosIdProyecto  = idProyecto
join usuarioporproyecto on proyectoAsignado = idProyecto and usuarioAsignado=?");
             $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
            
        }
    

}
