<?php

class UsuarioDAO {

    public function registrarUsuario(UsuarioDTO $dto, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("call registrarUsuario(?,?,?,?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $dto->getIdentificacion());
            $sentencia->bindParam(2, $dto->getNombre());
            $sentencia->bindParam(3, $dto->getApellido());
            $sentencia->bindParam(4, $dto->getDireccion());
            $sentencia->bindParam(5, $dto->getTelefono());
            $sentencia->bindParam(6, $dto->getFecha());
            $sentencia->bindParam(7, $dto->getEmail());
            $sentencia->bindParam(8, $dto->getEstado());
            $sentencia->bindParam(9, $dto->getFoto());
            $sentencia->bindParam(10, $dto->getArea());
            $sentencia->execute();
            $mensaje = $sentencia->fetchColumn();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    public function insertarLogin(UsuarioDTO $dto, PDO $cnn) {
        $mensaje = '';
        try {
            $sentencia = $cnn->prepare("INSERT INTO usuarios VALUES(?,md5(?),?)");
            $sentencia->bindParam(1, $dto->getIdentificacion());
            $sentencia->bindParam(2, $dto->getContrasena());
            $sentencia->bindParam(3, $dto->getRol());
            $sentencia->execute();
            $mensaje = "Ingresar con:" . $dto->getIdentificacion();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    public function idConsecutivo(PDO $cnn) {
        try {
            $consecutivoId = 'select max(idUsuario) from personas';
            $query = $cnn->prepare($consecutivoId);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }

    public function modificarUsuario(UsuarioDTO $usuarioDto, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  personas SET identificacion=?,nombres=?,apellidos=?,direccion=?,telefono=?, fechaNacimiento=?, email=? where idUsuario=?");
            $query->bindParam(1, $usuarioDto->getIdentificacion());
            $query->bindParam(2, $usuarioDto->getNombre());
            $query->bindParam(3, $usuarioDto->getApellido());
            $query->bindParam(4, $usuarioDto->getDireccion());
            $query->bindParam(5, $usuarioDto->getTelefono());
            $query->bindParam(6, $usuarioDto->getFecha());
            $query->bindParam(7, $usuarioDto->getEmail());
            $query->bindParam(8, $usuarioDto->getIdUsuario());
            $query->execute();
            $mensaje = "Registro Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    public function listarUsuarios(PDO $cnn) {
        try {
            $listarUsuarios = "Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,fechaNacimiento,email,foto,rol, 
                                nombreArea from usuarios, personas, roles, areas
                                where estado='Activo' and identificacion=idLogin and rolesId=idRoles and areas_idAreas=idAreas";
            $query = $cnn->prepare($listarUsuarios);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }

    public function obtenerUsuario($idUsuario, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,fechaNacimiento,
email,foto,rol,nombreArea,areas_idAreas,rolesId, concat(nombres, ' ',apellidos) as nombre from personas, usuarios, roles,areas where estado='Activo' and idUsuario=? and identificacion=idLogin and rolesId=idRoles
and areas_idAreas=idAreas");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }  
   
        public function obtenerUsuarioInactivo($idUsuario, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,fechaNacimiento,
email,foto,rol,nombreArea,areas_idAreas,rolesId from personas, usuarios, roles,areas where estado='Inactivo' and idUsuario=? and identificacion=idLogin and rolesId=idRoles
and areas_idAreas=idAreas");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }  
    public function obtenerRepresentante($idCliente, PDO $cnn) {
        try {
            $query = $cnn->prepare("select * from personas where idUsuario=?");
            $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }  
    
    public function eliminarUsuario($idUsuario, $estado, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare('Update personas set estado=? WHERE idUsuario = ?');
            $query->bindParam(1, $estado);
            $query->bindParam(2, $idUsuario);
            $query->execute();
            $mensaje = 'Usuario ' . $idUsuario . ' Dado de Baja';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
    public function activarUsuario($idUsuario, $estado, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare('Update personas set estado=? WHERE idUsuario = ?');
            $query->bindParam(1, $estado);
            $query->bindParam(2, $idUsuario);
            $query->execute();
            $mensaje = 'Usuario ' . $idUsuario . ' Activado';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
     public function nombreUsuario($idUsuario, PDO $cnn) {
        try {
            $query = $cnn->prepare("select concat(nombres,' ',apellidos) as nombres from personas where identificacion=?");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;      
    }
    
    public function asignarUsuarioProyecto($idUsuario,$idProyecto, PDO $cnn) {
        $mensaje='';
        try {
            $query = $cnn->prepare("INSERT INTO usuarioPorProyecto VALUES(?,?)");
            $query->bindParam(1, $idUsuario);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje='Usuario '.$idUsuario.' Asignado a Proyecto '.$idProyecto;
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;      
    }
    
    public function modificarUsuarioProyecto($idUsuario,$idProyecto, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE usuarioPorProyecto SET usuarioAsignado=? where proyectoAsignado=? and usuarioAsignado=?");
            $query->bindParam(1, $idUsuario);
            $query->bindParam(2, $idProyecto);            
            $query->bindParam(3, $idUsuario);
            $query->execute();
            $mensaje = "Registro Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }
    
    public function usuarioEnSesion($idLogin, PDO $cnn) {
        try {
            $query = $cnn->prepare("call UsuarioEnSesion(?)");
            $query->bindParam(1, $idLogin);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
     public function verFoto($idLogin, PDO $cnn) {
        try {
            $query = $cnn->prepare("call verFoto(?)");
            $query->bindParam(1, $idLogin);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
     public function listarUsuariosInactivos(PDO $cnn) {
        try {
            $listarUsuarios = "Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,fechaNacimiento,email,rol 
                                from usuarios, personas, roles 
                                where estado='Inactivo' and identificacion=idLogin and rolesId=idRoles";
            $query = $cnn->prepare($listarUsuarios);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    
     function listarAreas($idRol = null, PDO $cnn = null) {

        try {
            $sql = "select * from areas";
            if (!is_null($idRol) && !is_null($cnn)) {
                $sql .= " where roles_idRoles=? and idAreas != 0";
                $query = $cnn->prepare($sql);
                $query->bindParam(1, $idRol);
            } else {
                $query = $cnn->prepare($sql);
            }
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function ascenderUsuario($idRol, $identificion, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("update usuarios set rolesId=? where idLogin=?");
            $query->bindParam(1, $idRol);
            $query->bindParam(2, $identificion);

            $query->execute();
            $mensaje = "Rol Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }
        function actualizarArea($idUsuario, $area, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("update personas set areas_idAreas=? where idUsuario=?");
            $query->bindParam(1, $area);
            $query->bindParam(2, $idUsuario);

            $query->execute();
            $mensaje = "Area Actualizada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }
       public function cantidadUsuariosPorRol($rol, PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT count(rolesId) from usuarios, roles where rolesId=idRoles and rol='".$rol."'");
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

       function actualizarFoto($foto,$identificacion, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("update personas set foto=? where identificacion=?");
            $query->bindParam(1, $foto);
            $query->bindParam(2, $identificacion);

            $query->execute();
            $mensaje = "Foto Actualizada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    public function verificarUsuarioRegistrado($identificacion, PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT identificacion from personas where identificacion=?");
            $query->bindParam(1,$identificacion);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function consultarUsuariosPorArchivo(PDO $cnn){
        try {
            $listarUsuarios = "SELECT * FROM personas where areas_idAreas = 0";
            $query = $cnn->prepare($listarUsuarios);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        
    }
    function actualizarLogin(LoginDTO $dto, PDO $cnn) {
        $mensaje = '';
        try {
            $sentencia = $cnn->prepare("INSERT INTO usuarios VALUES(?,md5(?),?)");
            $sentencia->bindParam(1, $dto->getIdLogin());
            $sentencia->bindParam(2, $dto->getContrasena());
            $sentencia->bindParam(3, $dto->getRol());
            $sentencia->execute();
            $mensaje = "Actualización de contraseñas";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    function correosPorProyecto($idProyecto, PDO $cnn){
     try {
            $query = $cnn->prepare('Select email from personas 
join usuarioPorProyecto on usuarioAsignado = idUsuario and proyectoAsignado=?');
             $query->bindParam(1,$idProyecto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    } 
    
}
