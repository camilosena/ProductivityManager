<?php

$idPais = $_POST['paisSelected'];
$accion = $_POST['accion'];

require_once '../facades/FacadeContactenos.php';
require_once '../modelo/dao/ContactenosDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fContactenos = new FacadeContactenos();
$result = $fContactenos->consultarIndicativo($idPais);
if ($accion == "listarIndicativo") {
    foreach ($result as $fila) {
        $html = '<option value="' . $fila['indicativo'] . '">+' . $fila['indicativo'] . '</option>';
    }
}
print $html;
