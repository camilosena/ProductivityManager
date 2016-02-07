<?php



class AreasDAO {
    
    function AgregarArea (AreasDTO $aDTO, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("INSERT INTO areas VALUES(?,?,?)");
            $sentencia->bindParam(1, $aDTO->getIdArea());
            $sentencia->bindParam(2, $aDTO->getNombreArea());
            $sentencia->bindParam(3, $aDTO->getIdRol());
          
            $sentencia->execute();
            $mensaje = "Área Registrada con Éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
           
    function consecutivoArea (PDO $cnn){
        
       try {
           
            $query = $cnn->prepare('Call consecutivoAreas');
          
            $query->execute();
            $ultimo= $query->fetchColumn();
            return ($ultimo+1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    function AsignarAreas(AreasDTO $aDTO, PDO $cnn){
        
         $mensaje = "";
        try {  
        $sentencia2 = $cnn->prepare("update areas set Roles_idRoles=? where idAreas=?");
            $sentencia2->bindParam(1, $aDTO->getIdRol());
            $sentencia2->bindParam(2, $aDTO->getIdArea());
          
                 $sentencia2->execute();
            $mensaje = "Áreas Registradas con Éxito";
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
    function elimminarArea ($idArea,PDO $cnn){
         try {
            $sql = 'delete from areas where idAreas=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idArea);
            $query->execute();
            $mensaje = "Área Eliminada";
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
        
    }

    
}    
