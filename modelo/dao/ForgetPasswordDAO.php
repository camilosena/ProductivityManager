<?php

class ForgetPasswordDAO {
   function getUser ($user, $email, PDO $cnn){
      
        try {
            $query = $cnn->prepare("SELECT identificacion, email FROM personas where identificacion=? and email=? ");
            $query->bindParam(1, $user);
            $query->bindParam(2, $email);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function  ModificarContrasena($passNew, $user, PDO $cnn){        
      $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  usuarios SET contrasena=md5(?)  where idLogin=?");
            $query->bindParam(1, $passNew);
            $query->bindParam(2, $user);
                    
            $query->execute();
            $mensaje = "Contraseña Actualizada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
            }
    function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
}
