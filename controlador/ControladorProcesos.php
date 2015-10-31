<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorProcesos
 *
 * @author Jorge M. Izquierdo N
 */
require_once '../facades/FacadeProcesos.php';
require_once '../modelo/dao/ProcesosDAO.php';
require_once '../modelo/dto/ProcesosDTO.php';
require_once '../modelo/utilidades/Conexion.php';

$facadeProcesos = new FacadeProcesos();
$pDTO = new ProcesosDTO();

if (isset($_GET['AgregarProceso'])) {
    
    $pDTO->setIdProceso($_GET['IdProceso']);
    $pDTO->setTipo($_GET['NombreProceso']);
    $pDTO->setTiempo($_GET['Tiempo']);
    $pDTO->setEmpleados($_GET['Empleados']);
    $pDTO->setValor($_GET['valor']);
    $producto=$_GET['selectProducto'];
    
    $mensaje = $facadeProcesos->AgregarProceso($pDTO, $producto);
    
    header("location: ../vista/agregarProcesos.php? ".$mensaje);
    
}else 
    if (isset($_GET['idProceso'])) {
    $mensaje = $facadeProcesos->eliminarProceso($_GET['idProceso']);
    
    header("location: ../vista/agregarProcesos.php? ".$mensaje);
    
}else
if (isset ($_GET['idConsultaProceso'])) {
    session_start();
    $_SESSION['consultarProcesos']= $facadeProcesos->consultarProcesos($_GET['idConsultaProceso']);
   header("location: ../vista/agregarProcesos.php?&#ModalProcesos");
    
}else
if (isset ($_POST['ModificarProceso'])) {
    
     $pDTO->setIdProceso($_POST['IdProceso']);
    $pDTO->setTipo($_POST['NombreProceso']);
    $pDTO->setTiempo($_POST['Tiempo']);
    $pDTO->setEmpleados($_POST['Empleados']);
    $pDTO->setValor($_POST['valor']); 
    
    $mensaje = $facadeProcesos->ModificarProcesos($pDTO);
    
    header("location: ../vista/agregarProcesos.php? ".$mensaje);
}