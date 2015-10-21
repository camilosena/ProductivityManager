<?php

class FiltrosDAO {
    
      public function busqueda(UsuarioDTO $dto, PDO $cnn) {                
        try {             
            $sentencia = $cnn->prepare("Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,fechaNacimiento,email,rol 
                                from usuarios, users, roles 
                                where estado='Activo' and identificacion=idLogin and rolesId=idRoles 
                                and rol<>'Administrador' and idUsuario like '%".$dto->getIdUsuario()."%' and identificacion like '%".$dto->getIdentificacion()."%'
                                and nombres like '%".$dto->getNombre()."%' and apellidos like '%".$dto->getApellido()."%' and rol like '%".$dto->getRol()."%' and telefono like '%".$dto->getTelefono()."%' ");
            $sentencia->execute();  
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
            return $mensaje;
        }
        $cnn = NULL;      
    }
    
    public function busquedaProyectos(ProyectosDTO $dto, PDO $cnn) {                
        try {             
            $sentencia = $cnn->prepare("Select * from proyectos where idProyecto like '%".$dto->getIdProyecto()."%' and nombreProyecto like '%".$dto->getNombreProyecto()."%'
                                and fechaInicio like '%".$dto->getFechaInicio()."%' and fechaFin like '%".$dto->getFechaFin()."%' and estado like '%".$dto->getEstado()."%' and ejecutado like '%".$dto->getEjecucion()."%' ");
            $sentencia->execute();  
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
            return $mensaje;
        }
        $cnn = NULL;      
    }
    
    public function busquedaClientesActivos(ClienteDTO $dto, PDO $cnn) {                
        try {             
            $sentencia = $cnn->prepare("Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,email, nombreCompania, nit, sectorEmpresarial, sectorEconomico, telefonoFijo
            from usuarios, clientes where estado='Activo' and idCliente=idUsuario and idCliente like '%".$dto->getIdUsuario()."%'
            and nombreCompania like '%".$dto->getRazonSocial()."%' and nit like '%".$dto->getNit()."%' and telefonoFijo like '%".$dto->getTelefonoFijo()."%' and sectorEmpresarial like '%".$dto->getSectorEmpresarial()."%' and sectorEconomico like '%".$dto->getSectorEconomico()."%' ");
            $sentencia->execute();  
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
            return $mensaje;
        }
        $cnn = NULL;      
    }
    
     public function busquedaClientesInactivos(ClienteDTO $dto, PDO $cnn) {                
        try {             
            $sentencia = $cnn->prepare("Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,email, nombreCompania, nit, sectorEmpresarial, sectorEconomico, telefonoFijo
            from usuarios, clientes where estado='Inactivo' and idCliente=idUsuario and idCliente like '%".$dto->getIdUsuario()."%'
            and nombreCompania like '%".$dto->getRazonSocial()."%' and nit like '%".$dto->getNit()."%' and telefonoFijo like '%".$dto->getTelefonoFijo()."%' and sectorEmpresarial like '%".$dto->getSectorEmpresarial()."%' and sectorEconomico like '%".$dto->getSectorEconomico()."%' ");
            $sentencia->execute();  
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
            return $mensaje;
        }
        $cnn = NULL;      
    }
}
