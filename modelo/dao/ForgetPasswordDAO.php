<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForgetPasswordDAO
 *
 * @author Jorge M. Izquierdo N
 */
class ForgetPasswordDAO {
   function getUser ($user, $email, PDO $cnn){
      
        try {
            $query = $cnn->prepare("SELECT identificacion, email FROM usuarios where identificacion=? and email=? ");
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
            $query = $cnn->prepare("UPDATE  users SET contrasena=md5(?)  where idLogin=?");
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
}
