<?php

$idProyecto = $_POST['selectProyecto'];
$accion = $_POST['accion'];

require_once '../facades/FacadeProductos.php';
require_once '../modelo/dao/ProductosDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fProductos = new FacadeProductos();
$result = $fProductos->productosPorProyecto($idProyecto);
if ($accion == "productosPorProyecto") {
    if ($idProyecto==0) {
        $prodcuctos = $fProductos->listarProductos();
    $html = '<option value="0" style="color:gray" readonly selected>Seleccione un Producto</option>';
    foreach ($prodcuctos as $fila) {
        $html .= '<option value="' . $fila['idProducto'] . '">' .  $fila['nombreProducto'] . '</option>';
    }
    }  else {
        
    
    $html = '<option value="0" readonly selected>Seleccione un Producto</option>';
    foreach ($result as $fila) {
        $html .= '<option value="' . $fila['idProducto'] . '">' .  $fila['nombreProducto'] . '</option>';
    }
    }
}
print $html;
