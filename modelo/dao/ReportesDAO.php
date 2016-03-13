<?php

class ReportesDAO {
    //put your code here
    function ProyectosPorCliente($idCliente, PDO $cnn){
        try {
            $query = $cnn->prepare("SELECT idProyecto, nombreProyecto FROM proyectos 
join usuarioPorProyecto on proyectoAsignado = idProyecto and usuarioAsignado=?");
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
join usuarioPorProyecto on proyectoAsignado = idProyecto and usuarioAsignado=?");
             $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
            
        }
        
        function reporteProyectoPorCliente($idCliente, PDO $cnn){
            
            
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos , sum(cantidadProductos) as cantidad from clientes
join  personas on idCliente = idUsuario and idCliente = ?
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto 
LEFT join productoporproyecto on idProyecto = proyectosIdProyecto
LEFT join productos on Productos_idProductos = idProductos");
             $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
          
        }
        function reporteProyectoPorClienteProyecto($idCliente, $idProyecto, PDO $cnn){
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos , sum(cantidadProductos) as cantidad from clientes
join  personas on idCliente = idUsuario and idCliente = ?
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto and idProyecto = ?
LEFT join productoporproyecto on idProyecto = proyectosIdProyecto
LEFT join productos on Productos_idProductos = idProductos");
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
join usuarioPorProyecto on idUsuario = usuarioAsignado
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
        function reporteProyectoPorProyecto($idProyecto, PDO $cnn){
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos , sum(cantidadProductos) as cantidad from clientes
join  personas on idCliente = idUsuario 
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto AND idProyecto = ?
LEFT join productoporproyecto on idProyecto = proyectosIdProyecto
LEFT join productos on Productos_idProductos = idProductos");
             $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
            
        }
        function reporteProyectoPorProducto($idProducto, PDO $cnn){
             try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, nombreProducto as Productos, cantidadProductos as cantidad from clientes
join  personas on idCliente = idUsuario 
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto 
 join productoporproyecto on idProyecto = proyectosIdProyecto
 join productos on Productos_idProductos = idProductos and idProductos = ?");
             $query->bindParam(1, $idProducto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
            
            
        }
        function reporteTodosProyectos(PDO $cnn){
            try {
            $query = $cnn->prepare("Select nombreCompania, nombreProyecto, fechaInicio, estadoProyecto, ejecutado, fechaFin, group_concat( ' ',nombreProducto) as Productos , sum(cantidadProductos) as cantidad from clientes
join  personas on idCliente = idUsuario 
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto
LEFT join productoporproyecto on idProyecto = proyectosIdProyecto
LEFT join productos on Productos_idProductos = idProductos group by  idCliente");

            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
        }

}
