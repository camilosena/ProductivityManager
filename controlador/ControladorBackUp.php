<?php


require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/BackUp.php';
require_once '../modelo/dao/BackupDAO.php';
require_once '../facades/FacadeBackup.php';

//  Generar BackUp por tablas
if (isset($_POST['backUpTablas'])) {
    $fBack = new FacadeBackup();
    $fecha = date('_d-m-Y_h-i-s');
    $table_name = $_POST['tablas'] ;
    $tipo_archivo = $_POST['tipo'];
    $rute = $_SERVER['DOCUMENT_ROOT'];
    $bacup_file = $rute.'/BackUp/'.$table_name.$fecha.'.'.$tipo_archivo;
    $mensaje = $fBack->BackupTablas($table_name);
   header("location: ../vista/backup?mensaje=".$mensaje);
}else 
if (isset($_POST['backUpGeneral'])) {
     $fBack = new FacadeBackup();
    $datos =$fBack->Backup_Database();

    $mensaje = "Backup generado con éxtio";
    header("location: ../vista/backup?mensaje=".$mensaje);

}  else 
    if (isset($_GET['idDownload'])) {
    $enlace = $_SERVER["DOCUMENT_ROOT"].'/BackUp/'.$_GET['idDownload'];
    header ("Content-Disposition: attachment; filename=$enlace ");
    header ("Content-Type: application/force-download");
    header ("Content-Length: ".filesize($enlace));
    readfile($enlace);
    }