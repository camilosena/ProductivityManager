<?php

$idCliente = $_POST['clienteSelected'];
$accion = $_POST['accion'];

require_once '../facades/FacadeProductos.php';
require_once '../modelo/dao/ProductosDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeReportes.php';
require_once '../modelo/dao/ReportesDAO.php';
$fProductos = new FacadeProductos();
$fReportes = new FacadeReportes();
$prodcuctos = $fProductos->listarProductos();
$result = $fReportes->ProductosPorCliente($idCliente);
if ($accion == "producto") {
    if ($idCliente==0) {
        
    $html = '<option value="0" style="color:gray" readonly selected>Seleccione un Producto</option>';
    foreach ($prodcuctos as $prodcucto) {
        $html .= '<option value="' . $prodcucto['idProducto'] . '">' .  $prodcucto['nombreProducto'] . '</option>';
    }
    }  else {
        
    
    $html = '<option value="0" readonly selected>Seleccione un Producto</option>';
    foreach ($result as $fila) {
        $html .= '<option value="' . $fila['idProducto'] . '">' .  $fila['nombreProducto'] . '</option>';
    }
    }
}
print $html;
