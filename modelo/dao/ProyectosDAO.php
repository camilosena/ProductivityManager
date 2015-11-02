<?php

class ProyectosDAO {
    
    public function crearProyecto(ProyectosDTO $proyectoDTO, PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO proyectos VALUES(?,?,?,?,?,0,?)");
            $sentencia->bindParam(1, $proyectoDTO->getIdProyecto());
            $sentencia->bindParam(2, $proyectoDTO->getNombreProyecto());
            $sentencia->bindParam(3, $proyectoDTO->getFechaInicio());
            $sentencia->bindParam(4, $proyectoDTO->getFechaFin());            
            $sentencia->bindParam(5, $proyectoDTO->getEstado());           
            $sentencia->bindParam(6, $proyectoDTO->getObservaciones());
            $sentencia->execute();
            $mensaje="Proyecto Creado con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
    public function numeroProyecto(PDO $cnn) {
        try{
        $query=$cnn->prepare("SELECT max(idProyecto) FROM proyectos");
        $query->execute();   
        $id = $query->fetchColumn();
        return ('000'.($id+1));
   } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
    
     public function proyectoSinEstudio(PDO $cnn) {
        try{
        $query=$cnn->prepare("SELECT idProyecto, nombreProyecto from proyectos where estado='Sin Estudio Costos'");
        $query->execute();   
        return $query->fetchAll();
   } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }
    
    public function proyectoEnEjecucion(PDO $cnn) {
        try {
            $query=$cnn->prepare('SELECT idProyecto, nombreProyecto from proyectos where estadoProyecto="Ejecucion"');
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }
    
      public function listarProyectos(PDO $cnn) {
        try {            
            $query = $cnn->prepare("Select * from proyectos");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
       public function obtenerProyecto($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select * from proyectos where idProyecto=?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }  
    
     public function obtenerClienteProyecto($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT idCliente,nombreCompania from clientes,usuarios,usuarioporproyecto where  idCliente=idUsuario and idUsuario=usuarioAsignado and proyectoAsignado=?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
     public function ModificarProyecto(ProyectosDTO $proyectoDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  proyectos SET nombreProyecto=?, fechaInicio=?, fechaFin=?, estado=?, observaciones=? where idProyecto=?");            
            $query->bindParam(1, $proyectoDTO->getNombreProyecto());
            $query->bindParam(2, $proyectoDTO->getFechaInicio());
            $query->bindParam(3, $proyectoDTO->getFechaFin());
            $query->bindParam(4, $proyectoDTO->getEstado());            
            $query->bindParam(5, $proyectoDTO->getObservaciones());
            $query->bindParam(6, $proyectoDTO->getIdProyecto());
            $query->execute();
            $mensaje = "Proyecto Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }
    
    public function obtenerGerenteEncargado($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("call GerenteEncargado(?)");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
     public function obtenerClienteAsignado($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("call ClienteProyecto(?)");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    public function cambiarEstadoProyecto($estado, $idProyecto, PDO $cnn) {
        $mensaje='';
     try {
            $query = $cnn->prepare("UPDATE  proyectos SET estado=? where idProyecto=?");
            $query->bindParam(1, $estado);
            $query->bindParam(2, $idProyecto);
            $query->execute();
             $mensaje='Cambio Estado de Proyecto';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    public function progresoProyectos( PDO $cnn) {
        try {
            $query = $cnn->prepare("call ProgresoProyectos()");            
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
     public function asignarUsuarioProyecto($idUsuario, $idProyecto, PDO $cnn) {
         $mensaje='';
        try {
            $query = $cnn->prepare("call asignarUsuarioProyecto(?,?)");
             $query->bindParam(1, $idUsuario);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje=' Asignado a Proyecto: '.$idProyecto;
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    public function insertarProductoProyecto($idProducto, $idProyecto, $cantidad, PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO productoPorProyecto VALUES(?,?,?)");
            $sentencia->bindParam(1, $idProducto);
            $sentencia->bindParam(2, $idProyecto);
            $sentencia->bindParam(3, $cantidad);           
            $sentencia->execute();
            $mensaje="Productos Asociados con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
    
    public function obtenerProductoProyecto($idProyecto,PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("SELECT * FROM productoporproyecto where proyectosIdProyecto=?");
            $sentencia->bindParam(1, $idProyecto);                      
            $sentencia->execute();
            return $sentencia->fetchAll();            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
    
       public function insertarMateriaProyecto($idMateria, $idProyecto, $total,$provision, PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO materiaPrimaPorProyecto VALUES(?,?,?,?)");
            $sentencia->bindParam(1, $idMateria);
            $sentencia->bindParam(2, $idProyecto);
            $sentencia->bindParam(3, $total);           
            $sentencia->bindParam(4, $provision);
            $sentencia->execute();
            $mensaje="Materia Prima Asociada con Exito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
}