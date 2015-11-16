<?php

class ClienteDAO {
   public function insertarCliente(ClienteDTO $clienteDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO clientes VALUES(?,?,?,?,?,?)");
            $sentencia->bindParam(1, $clienteDTO->getIdUsuario());
            $sentencia->bindParam(2, $clienteDTO->getRazonSocial());
            $sentencia->bindParam(3, $clienteDTO->getNit());
            $sentencia->bindParam(4, $clienteDTO->getSectorEmpresarial());
            $sentencia->bindParam(5, $clienteDTO->getSectorEconomico());
            $sentencia->bindParam(6, $clienteDTO->getTelefonoFijo());
            $sentencia->execute();
            $mensaje = "Cliente Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    public function obtenerCliente($idCliente, PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT nombreCompania, nit, sectorEmpresarial, sectorEconomico, telefonoFijo FROM clientes where idCliente=?');
            $query->bindParam(1, $idCliente);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    
        public function obtenerAreaCliente(PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT idAreas FROM areas where nombreArea="Cliente"');           
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    public function ModificarCliente(ClienteDTO $clienteDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  clientes SET nombreCompania=?, nit=?, sectorEmpresarial=?, sectorEconomico=?, telefonoFijo=? where idCliente=?");
            $query->bindParam(1, $clienteDTO->getRazonSocial());
            $query->bindParam(2, $clienteDTO->getNit());
            $query->bindParam(3, $clienteDTO->getSectorEmpresarial());
            $query->bindParam(4, $clienteDTO->getSectorEconomico());
            $query->bindParam(5, $clienteDTO->getTelefonoFijo());
            $query->bindParam(6, $clienteDTO->getIdUsuario());            
            $query->execute();
            $mensaje = "Cliente Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    public function cantidadClientes(PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT count(idCliente) from clientes');
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
     public function listarClientesActivos(PDO $cnn) {
        try {
            $listarClientesActivos = "Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,email, nombreCompania, nit, sectorEmpresarial, sectorEconomico, telefonoFijo
            from personas, clientes where estado='Activo' and idCliente=idUsuario";
            $query = $cnn->prepare($listarClientesActivos);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
     }
     
      public function listarClientesInactivos(PDO $cnn) {
        try {
            $listarClientesActivos = "Select idUsuario,identificacion,nombres,apellidos,direccion,telefono,email, nombreCompania, nit, sectorEmpresarial, sectorEconomico, telefonoFijo
            from personas, clientes where estado='Inactivo' and idCliente=idUsuario";
            $query = $cnn->prepare($listarClientesActivos);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
     }
    public function verificarClienteRegistrado($nit, PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT nit from clientes where nit=?");
            $query->bindParam(1,$nit);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
}
