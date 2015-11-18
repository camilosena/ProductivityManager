<?php

$idCliente = $_POST['ClienteSelected'];
$accion = $_POST['accion'];

require_once '../facades/FacadeReportes.php';
require_once '../modelo/dao/ReportesDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
$facadeProyectos = new FacadeProyectos();
$fReportes = new FacadeReportes();
$proyectos = $facadeProyectos->listadoProyectos();
$result = $fReportes->ProyectoPorCliente($idCliente);
if ($accion == "proyecto") {
    if ($result) {
        
    }

    if ($idCliente==0) {
      
    $html = '<option value="0" style="color:gray" readonly selected>Seleccione un proyecto</option>';
    foreach ($proyectos as $proyecto) {
      $html .= '<option value="' . $proyecto['idProyecto'] . '">' .  $proyecto['nombreProyecto'] . '</option>';  
    }
    

    }  else {
        $html = '<option value="0" style="color:gray" readonly selected>Seleccione un proyecto</option>';
        foreach ($result as $proyect) {
             $html .= '<option value="' . $proyect['idProyecto'] . '">' .  $proyect['nombreProyecto'] . '</option>';
        }
    }
}
print $html;
