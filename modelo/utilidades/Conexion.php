<?php
class Conexion {    
    public static function getConexion(){
        $cnn=null;
        try {
            $cnn= new PDO("mysql:host=localhost; dbname=productivitymanager","Gerente","prueba",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $cnn->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Error:'.$ex->getMessage();            
        }
        return $cnn;
    }
}

