<?php

class ContactenosDAO {
    //put your code here
    function  listarPaises(PDO $cnn){
        
         try {
            $query = $cnn->prepare("select * from indicativos");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    function consultarIndicativo($idPais, PDO $cnn){
        try {
            $query = $cnn->prepare("select indicativo from indicativos where idPais = ?");
            $query->bindParam(1, $idPais);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        
    }
    function guardarContacto(ContactenosDTO $clienteDTO,$numero, PDO $cnn){
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO contactenos VALUES($numero,?,?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $clienteDTO->getNombres());
            $sentencia->bindParam(2, $clienteDTO->getApellidos());
            $sentencia->bindParam(3, $clienteDTO->getEmpresa());
            $sentencia->bindParam(4, $clienteDTO->getEmail());
            $sentencia->bindParam(5, $clienteDTO->getIdPais());
            $sentencia->bindParam(6, $clienteDTO->getTelefono());
            $sentencia->bindParam(7, $clienteDTO->getModo());
            $sentencia->bindParam(8, $clienteDTO->getRazon());
            $sentencia->execute();
            $mensaje = "Contacto Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
        
    }
    function cantidadSolicitudes(PDO $cnn){

        try {
            $query = $cnn->prepare("SELECT max(idContacto)+1 as numero FROM contactenos");
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
       
}
