<?php

class ProductosDAO {
    //put your code here
    
    function agregarProducto(ProductosDTO $productoDTO, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("INSERT INTO productos VALUES(?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $productoDTO->getIdProducto());
            $sentencia->bindParam(2, $productoDTO->getNombre());
            $sentencia->bindParam(3, $productoDTO->getImagen());
            $sentencia->bindParam(4, $productoDTO->getDescripción());
            $sentencia->bindParam(5, $productoDTO->getEstado());
            $sentencia->bindParam(6, $productoDTO->getPorcentaje());
            $sentencia->bindParam(7, $productoDTO->getIva());
            $sentencia->execute();
            $mensaje = "Producto Registrado con Éxito";
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
    function listarProductosActivos(PDO $cnn){
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
        function productoMaximo(PDO $cnn){
        try {
            $sql = "select max(idProductos) from productos where estadoProducto='Activo'" ;
            $query = $cnn->prepare($sql);           
            $query->execute();                       
            return $query->fetchColumn();
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
    function activarProducto($idProducto, PDO $cnn){
        
         try {
             
            
            $sql = "update productos set estadoProducto = 'Activo' where idProductos=?";
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProducto);
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
            $sentencia = $cnn->prepare("INSERT INTO materiaPrimaPorProducto VALUES(?,?,?)");
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
    function producoPorProyecto($idProyecto,  PDO $cnn){
        
         try {
            $sql = "select Productos_idProductos as idProducto, nombreProducto from productoporproyecto 
join productos on Productos_idProductos = idProductos and proyectosIdProyecto=?" ;
            $query = $cnn->prepare($sql);   
            $query->bindParam(1, $idProyecto);
            $query->execute();                       
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function cantidadPorInsumo($idInsumo, $idProducto, PDO $cnn){
        
        
   try {
            $sql = "select cantidadMateriaPorProducto from materiaPrimaPorProducto where idMateriaPrima_materiaPrima=? and ProductosIdProductos=?" ;
            $query = $cnn->prepare($sql);   
            $query->bindParam(1, $idInsumo);
            $query->bindParam(2, $idProducto);
            $query->execute();                       
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
                        }
    function modificarEstadoProducto($estado,$idProducto, PDO $cnn){
             
   try {
            $sql = "update productos set estadoProducto = ? where idProductos=?";
            $query = $cnn->prepare($sql);   
            $query->bindParam(1, $estado);
            $query->bindParam(2, $idProducto);
            $query->execute(); 
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
    function listarProductosSinProcesos(PDO $cnn){
        try {
            $sql = "select * from productos where estadoProducto = 'Sin Procesos' or estadoProducto = 'Activo' " ;
            $query = $cnn->prepare($sql);           
            $query->execute();                       
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
                        
    
    
    
}
