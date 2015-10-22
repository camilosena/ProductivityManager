<?php

class LoginDAO {

    public function login($user, $pass, PDO $cnn) {        
         try {            
            $query=$cnn->prepare('SELECT idLogin, roles.rol from usuarios, roles where idLogin=? and contrasena=md5(?) and rolesId=roles.idRoles');   
             $query->bindParam(1, $user);
            $query->bindParam(2, $pass);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }        
    }
        public function modificarLogin(UsuarioDTO $usuarioDto, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  usuarios SET idLogin=? where idLogin=?");
            $query->bindParam(1, $usuarioDto->getIdentificacion());
            $query->bindParam(2, $usuarioDto->getIdentificacion());            
            $query->execute();
            $mensaje = "Usuario Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }
     public function seguridadPaginas($rol, PDO $cnn) {        
         try {            
            $query=$cnn->prepare('call seguridadPaginas(?)');   
             $query->bindParam(1, $rol);            
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }        
    } 
}
