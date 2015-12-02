<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorInsumos
 *
 * @author Jorge M. Izquierdo N
 */

    //put your code here

    require_once '../facades/FacadeInsumos.php';
    require_once '../modelo/dao/InsumosDAO.php';
    require_once '../modelo/dto/InsumosDTO.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/dao/ArchivoDAO.php';
    require_once '../facades/FacadeArchivo.php';
    
    if (isset($_GET['AgregarInsumo'])) {
    $facadeInsumos = new FacadeInsumos();
    $InsumosDTO = new InsumosDTO();
    $InsumosDTO->setNombre($_GET['NombreInsumo']);
    $InsumosDTO->setMedida($_GET['unidad']);
    $InsumosDTO->setPrecio($_GET['precio']);
    $InsumosDTO->setId($_GET['numero']);
    $mensaje = $facadeInsumos->agregarInsumo($InsumosDTO);
     
     header("location: ../vista/agregarInsumos.php?".$mensaje);
}
else 
if ($_GET['idEliminar']) {
    $facadeInsumos = new FacadeInsumos();    
   $mensaje= $facadeInsumos->eliminarInsumos($_GET['idEliminar']);
     header("location: ../vista/agregarInsumos.php?".$mensaje);
}else
if (isset ($_POST['subir'])) {
     $table = 'materiaprima';
        $file = realpath($_FILES['archivo']['tmp_name']);
        $file = str_replace('\\', '/', $file);
        $facadeArchivo = new FacadeArchivo();
        $mensaje = $facadeArchivo->cargarArchivo($table, $file);
         header("location: ../vista/agregarInsumos.php?mensaje=".$mensaje);
}