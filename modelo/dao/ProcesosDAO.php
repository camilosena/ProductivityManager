<?php



class ProcesosDAO {
    
    function AgregarProceso (ProcesosDTO $pDTO, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("INSERT INTO procesos VALUES(?,?,?,?)");
            $sentencia->bindParam(1, $pDTO->getIdProceso());
            $sentencia->bindParam(2, $pDTO->getTipo());
            $sentencia->bindParam(3, $pDTO->getTiempo());
            $sentencia->bindParam(4, $pDTO->getEmpleados());
          
            $sentencia->execute();
            $mensaje = "Proceso registrado ";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        
        return $mensaje;
    }
    
    function listarProcesos(PDO $cnn){
        
        try {
            $sql = "select * from procesos";
            
                $query = $cnn->prepare($sql);
            
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }
            
    function consecutivoProceso (PDO $cnn){
        
       try {
           
            $query = $cnn->prepare('select max(idProceso) from procesos');
          
            $query->execute();
            $ultimo= $query->fetchColumn();
            return ($ultimo+1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    function AsignarProcesos(ProcesosDTO $pDTO, PDO $cnn){
        
         $mensaje = "";
        try {  
        $sentencia2 = $cnn->prepare("update areas set Roles_idRoles=? where idAreas=?");
            $sentencia2->bindParam(1, $pDTO->getIdRol());
            $sentencia2->bindParam(2, $aDTO->getIdArea());
          
                 $sentencia2->execute();
            $mensaje = "Areas registradas con éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    function ModificarAreas($idRol, PDO $cnn){
        
          $mensaje = "";
        try {
            $query = $cnn->prepare("update areas set roles_idRoles=1 where Roles_idRoles=?");
            $query->bindParam(1, $idRol);
            
            $query->execute();
            $mensaje = "Registro Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
        
    }
    function obtenarAreas($idRol,PDO $cnn){
        
        try {
            $sql = 'SELECT idAreas areas from areas where roles_idRoles=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idRol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function eliminarProceso ($idProceso,PDO $cnn){
         try {
            $sql = 'delete from procesos where idProceso=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProceso);
            $query->execute();
            $mensaje = "Registro eliminado";
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }

    
}    
