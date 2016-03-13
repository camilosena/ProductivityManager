<?php

class PermisosDAO {
     public function menuGeneral($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta,idpermisos from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles  and idpermisos=permisos_idPermisos and nivel=1 and rol=?");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
    public function permisosProyectos($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=2");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
     public function permisosNovedades($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=3");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
      public function permisosPersonal($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=4");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
      public function permisosAuditorias($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=5");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
    public function permisosClientes($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=6");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    public function permisosRoles($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=7");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
      public function permisosInsumos($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=8");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    public function permisosProcesos($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=9");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    public function permisosProductos($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare( "SELECT URL,nombreRuta from permisosPorRol,permisos, roles 
            where idRoles_Roles=idRoles and rol=? and idpermisos=permisos_idPermisos and nivel=10");
            $query->bindParam(1, $rol);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
}
