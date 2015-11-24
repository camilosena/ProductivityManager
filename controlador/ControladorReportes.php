<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeReportes.php';
require_once '../modelo/dao/ReportesDAO.php';

$fReportes = new FacadeReportes();
$fProyecto = new FacadeProyectos();

if (isset($_POST['reporteProyecto']) ) {
    session_start();
    $idCliente = $_POST['selectCliente'];
    $idProyecto = $_POST['selectProyecto'];
    $estado = $_POST['selectEstado'];
    $idProductos = $_POST['selectProducto'];
    if ($idCliente==0 & $idProyecto ==0 & $estado ==0 & $idProductos ==0 ) {
        $mensaje = 'Debe seleccionar una opción';
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos&mensaje=".$mensaje);
    }
    if ($idCliente!=0 & $idProyecto ==0 & $estado ==0 & $idProductos ==0 ) {
        $_SESSION['reportes'] = $fReportes->reporteProyectoPorCliente($idCliente);
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos&reporte=".$_SESSION['reportes']);
    }
    if ($idCliente!=0 & $idProyecto !=0 & $estado ==0 & $idProductos ==0 ) {
    $_SESSION['reportes'] = $fReportes->reporteProyectoPorClienteProyecto($idCliente, $idProyecto);
    header("location: ../vista/Reportes.php?tipoReporte=Proyectos&reporte=".$_SESSION['reportes']);
    }
    if ($idCliente==0 & $idProyecto ==0 & $estado !=0 & $idProductos ==0 ) {
        $_SESSION['reportes'] = $fReportes->reporteProyectoPorEstado($estado);
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos&reporte=".$_SESSION['reportes']);
    }
    if ($idCliente==0 & $idProyecto !=0 & $estado ==0 & $idProductos ==0 ) {
        $_SESSION['reportes'] = $fReportes->reporteProyectoPorProyecto($idProyecto);
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos&reporte=".$_SESSION['reportes']);
    }
    if ($idCliente==0 & $idProyecto ==0 & $estado ==0 & $idProductos !=0 ) {
        $_SESSION['reportes'] = $fReportes->reporteProyectoPorProducto($idProducto);
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos&reporte=".$_SESSION['reportes']);
    }

}