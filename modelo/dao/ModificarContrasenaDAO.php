<?php


class ModificarContrasenaDAO {
    
    function obtenerContrasena($contrasenaAntigua, $sesion, PDO $cnn){
      
        try {
            $query = $cnn->prepare("SELECT contrasena FROM usuarios where contrasena=md5(?) and idLogin=?");
            $query->bindParam(1, $contrasenaAntigua);
            $query->bindParam(2, $sesion);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
        function  ModificarContrasena($contrasenaNueva, $sesion, PDO $cnn){        
      $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  usuarios SET contrasena=md5(?)  where idLogin=?");
            $query->bindParam(1, $contrasenaNueva);
            $query->bindParam(2, $sesion);
                    
            $query->execute();
            $mensaje = "Contraseña Actualizada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
            }
    
}

