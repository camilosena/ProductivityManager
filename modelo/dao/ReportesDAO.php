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
        
        function reporteProyectoPorCliente($idCliente, PDO $cnn){
            
            
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos, cantidadProductos from clientes
join  personas on idCliente = ?
join usuarioporproyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto 
left join productoporproyecto on idProyecto = proyectosIdProyecto
left join productos on Productos_idProductos = idProductos");
             $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
          
        }
        function reporteProyectoPorClienteProyecto($idCliente, $idProyecto, PDO $cnn){
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos, cantidadProductos from clientes
join  personas on idCliente = ?
join usuarioporproyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto and idProyecto = ?
left join productoporproyecto on idProyecto = proyectosIdProyecto
left join productos on Productos_idProductos = idProductos");
             $query->bindParam(1, $idCliente);
             $query->bindParam(2, $idProyecto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
          
        }
        function reporteProyectoPorEstado($estado, PDO $cnn){
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, nombreProducto, cantidadProductos from clientes
join  personas on idCliente = idUsuario
join usuarioporproyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto and estadoProyecto = ?
join productoporproyecto on idProyecto = proyectosIdProyecto
join productos on Productos_idProductos = idProductos");
             $query->bindParam(1, $estado);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
          
        }
    

}
