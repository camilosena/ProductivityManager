<?php


require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/BackUp.php';
require_once '../modelo/dao/BackupDAO.php';
require_once '../facades/FacadeBackup.php';
$fBack = new FacadeBackup();
$back = new BackUp();

//  Generar BackUp por tablas
if (isset($_POST['backUpTablas'])) {
//    $dbhost = "localhost";
//    $dbuser = "root";
//    $dbpass = "";
    $fBack = new FacadeBackup();
    $fecha = date('_d-m-Y_h-i-s');
    $table_name = $_POST['tablas'] ;
    $tipo_archivo = $_POST['tipo'];
    $bacup_file = 'C:/xampp/htdocs/ProductivityManager/BackUp/'.$table_name.$fecha.'.'.$tipo_archivo;
    
    $mensaje = $fBack->BackupTablas($bacup_file, $table_name);
    
    header("location: ../vista/backup.php?mensaje=".$mensaje);
}else 
if (isset($_POST['backUpGeneral'])) {
//    $host = "localhost";
//    $username = "root";
//    $pass = "";
//    $dbName= 'productivitymanager';
    $fBack->Backup_Database();

//    $fecha = date('dmYh-i-s');
//    $bacup_file ="C:/xampp/htdocs/ProductivityManager/BackUp/".$dbname.$fecha.'.txt';
//    $comand = " mysqldump --opt  --user=$dbuser $dbname > $bacup_file";
//   $mensaje =  system($comand);
    
    echo "hola";
}