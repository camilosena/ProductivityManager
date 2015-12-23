<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ArchivoDAO {
    
    function CargarDatos($table, $file, PDO $cnn){
		$mensaje='';
			try{				
				$sql = "LOAD DATA INFILE '".$file."' INTO TABLE ".$table." FIELDS TERMINATED BY ';' escaped by '/'"; 
				$query=$cnn->prepare($sql);
                                $query->execute();								
				$mensaje = 'Carga de Datos Realizada con Éxito';
			}catch(Exception $ex){
				$mensaje = $ex->getMessage();
			}
			return $mensaje;	
	}
    
}
