<?php

$idProyecto = $_POST['selectProyecto'];
$accion = $_POST['accion'];

require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fProyectos = new FacadeProyectos();
$result = $fProyectos->consultarProyecto($idProyecto);
if ($accion == "estado") {
    if ($idProyecto==0) {
      
    $html = '<option value="0" style="color:gray" readonly selected>Seleccione un Estado</option>';
    $html .= '<option value="Ejecucion" >Ejecución</option>';
    $html .= '<option value="Cancelado" >Cancelado</option>';
    $html .= '<option value="Finalizado" >Finalizado</option>';
    $html .= '<option value="Aplazado" >Aplazado</option>';
    $html .= '<option value="costos" >Sin estudio de costos</option>';
    }  else {
        $html = '<option value="0" style="color:gray" readonly selected>Seleccione un Estado</option>';
        $html .= '<option value="' . $result['idProyecto'] . '">' .  $result['estadoProyecto'] . '</option>';
    }
}
print $html;