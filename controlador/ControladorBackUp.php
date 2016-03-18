<?php


require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/BackUp.php';
require_once '../modelo/dao/BackupDAO.php';
require_once '../facades/FacadeBackup.php';
$fBack = new FacadeBackup();

//  Generar BackUp por tablas
if (isset($_POST['backUpTablas'])) {
//    $dbhost = "localhost";
//    $dbuser = "root";
//    $dbpass = "";
    $fBack = new FacadeBackup();
    $fecha = date('_d-m-Y_h-i-s');
    $table_name = $_POST['tablas'] ;
    $tipo_archivo = $_POST['tipo'];
    $bacup_file = '../BackUp/'.$table_name.$fecha.'.'.$tipo_archivo;
    
    $mensaje = $fBack->BackupTablas($bacup_file, $table_name);
    print_r($mensaje);
   // header("location: ../vista/backup.php?mensaje=".$mensaje);
}/*else 
if (isset($_POST['backUpGeneral'])) {

    $fBack->Backup_Database();
    $mensaje = "Backup generado con extio";
   // header("location: ../vista/backup.php?mensaje=".$mensaje);

}  else 
    if (isset($_GET['idDownload'])) {
   
$enlace = $_GET['idDownload'];
echo $enlace;
header ("Content-Disposition: attachment; filename=$enlace ");
header ("Content-Type: application/force-download");
header ("Content-Length: ".filesize($enlace));
    readfile($enlace);
//    $mensaje = "Archivo descargado con extio";
//    header("location: ../vista/backup.php?mensaje=".$mensaje);
    }*/