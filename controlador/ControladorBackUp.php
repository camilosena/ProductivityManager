<?php


require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dao/BackupDAO.php';
require_once '../facades/FacadeBackup.php';


//  Registrar Cliente
if (isset($_POST['backUp'])) {
//    $dbhost = "localhost";
//    $dbuser = "root";
//    $dbpass = "";
    $fBack = new FacadeBackup();
    $fecha = date('dmYh-i-s');
    $table_name = $_POST['tablas'] ;
    $bacup_file = 'C:/xampp/htdocs/ProductivityManager/BackUp/'.$_POST['tablas'].$fecha.'.cvs';
    
    $mensaje = $fBack->BackupTablas($bacup_file, $table_name);
    header("location: ../vista/backup.php?mensaje=".$mensaje);
}