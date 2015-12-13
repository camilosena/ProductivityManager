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
}
