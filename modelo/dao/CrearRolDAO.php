<?php

class CrearRolDAO {
    
    function ListarPermisos(PDO $cnn){
        
        try {
            $listarPermisos = "select * from permisos";
            $query = $cnn->prepare($listarPermisos);
            $query->execute();
            $_SESSION['cantidad']=$query->rowCount();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
    function consecutivoRol (PDO $cnn){
        
       try {
           
            $query = $cnn->prepare('Call consecutivoRoles');
          
            $query->execute();
            $ultimo= $query->fetchColumn();
            return '0'.($ultimo+1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
            
    function RegistrarRol(CrearRolDTO $dto, PDO $cnn) {
        $mensaje = "";
        try {            
         
            $sentencia = $cnn->prepare("Call RegistrarRol (?,?)");
            $sentencia->bindParam(1, $dto->getIdRol());
            $sentencia->bindParam(2, $dto->getRol());
            $sentencia->execute();
           
            $mensaje = "Rol Registrado Con Éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    function  RegistrarPermisos(CrearRolDTO $dto, PDO $cnn){
         $mensaje = "";
        try {  
        $sentencia2 = $cnn->prepare("Call RegistrarPermisos (?,?)");
            
            $sentencia2->bindParam(1, $dto->getPermiso());
            $sentencia2->bindParam(2, $dto->getIdRol());
                 $sentencia2->execute();
            $mensaje = "Permisos registrados con éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
          
    }
    function obtenerPermisos($idUsuario, PDO $cnn) {
        try {
            $query = $cnn->prepare('Call obtenerPermisos (?)');
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
        
    function listarIdRoles(PDO $cnn){
        try {
            $listarRoles = "Call ListarIdRoles";
            $query = $cnn->prepare($listarRoles);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        
    }
    function ObtenerNombreRol ($idUsuario,PDO $cnn){
        try {
            $query = $cnn->prepare('Call obtenerNombreRol (?)');
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
    
    function listarRoles (PDO $cnn){
        
      try {
            $listarRoles = "Call ListarRoles";
            $query = $cnn->prepare($listarRoles);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
        
    }
    
    function  ObtenerId ($idUsuario, PDO $cnn){
         try {
            $query = $cnn->prepare('Call obtenerId (?)');
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
            
    function ObtenerpermisosPorRol($idRol,PDO $cnn){
        try {
            $sql = 'Call obtenerpermisosPorRol (?)';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idRol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
            
    function UpdateRol ($idRol, PDO $cnn){
        
        $mensaje = "";
        try {
            $query = $cnn->prepare("Call ModificarRol (?)");
            $query->bindParam(1, $idRol);
            
            $query->execute();
            $mensaje = "Registro Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
        
        
    }
    
    function ElimiarRol ($idRol, PDO $cnn){
        
         
        $mensaje = "";
        try {
            $query = $cnn->prepare('delete from permisosPorRol where idRoles_Roles=?'); 
            $query->bindParam(1, $idRol);
            $query2= $cnn->prepare('update areas set roles_idRoles=1 where roles_idRoles=?');
            $query2->bindParam(1, $idRol);
            $query3 = $cnn->prepare("Call eliminarRol (?)");
            $query3->bindParam(1, $idRol);
            $query->execute();
            $query2->execute();
            $query3->execute();
            $mensaje = "Rol Eliminado";
        } catch (Exception $ex) {
           $mensaje = $ex->getMessage();  
        }
        return $mensaje;
    }
    
}
