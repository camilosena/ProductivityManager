<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fProyecto = new FacadeProyectos();

if (isset($_POST['reporteProyecto']) ) {
    
    if ($_POST['selectProyectoEstado']!='Seleccione un proyecto') {
        $idProyecto = $_POST['selectProyectoEstado'];
         $proyecto = $fProyecto->consultarProyecto($idProyecto);
        $nombreProyecto = $proyecto['nombreProyecto'];
        $estado = $proyecto['estadoProyecto'];
        $inicio = $proyecto['fechaInicio'];
        $fin = $proyecto['fechaFin'];
        $ejecucion  = $proyecto['ejecutado'];
        header("location: ../vista/Reportes.php?tipoReporte=Proyectos");
    }
}