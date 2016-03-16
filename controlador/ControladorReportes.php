<?php

require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/dto/ProyectosDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProyectos.php';

session_start();

if(isset($_POST['generarAnio'])){
        header("location: ../vista/reportes?grAnio=".$_POST['anio']);
}else if(isset($_POST['generarProyectos'])){
 	$facadeProyectos = new FacadeProyectos;
 	$_SESSION['estadosProyectos']= $facadeProyectos->graficoEstadosAnuales($_POST['anio'],$_POST['estadoP']);
 	header("location: ../vista/reportes?a=".$_POST['anio']);
}