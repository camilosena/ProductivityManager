<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactenosDAO
 *
 * @author Jorge M. Izquierdo N
 */
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
    function guardarContacto(ContactenosDTO $clienteDTO, PDO $cnn){
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO contactenos VALUES(default,?,?,?,?,?)");
            $sentencia->bindParam(1, $clienteDTO->getIdPersona());
            $sentencia->bindParam(2, $clienteDTO->getEmpresa());
            $sentencia->bindParam(3, $clienteDTO->getModo());
            $sentencia->bindParam(4, $clienteDTO->getRazon());
            $sentencia->bindParam(5, $clienteDTO->getIdPais());

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
            $query = $cnn->prepare("SELECT count(idContacto) as numero FROM productivitymanager.contactenos");
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
       
}
