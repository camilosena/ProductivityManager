<?php



class BackupDAO {
    
    function BackupTablas ($ruta, $tabla, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("SELECT * into outfile ? from $tabla");
           $sentencia->bindParam(1, $ruta);
//            $sentencia->bindParam(2, $tabla);
          
            $sentencia->execute();
            $mensaje = "BackUp Generado con Éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    function listarTablas(PDO $cnn){
        
        try {
            
            $query = $cnn->prepare("SHOW FULL TABLES  FROM productivitymanager ");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    }
           
    
}    
