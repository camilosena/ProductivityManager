<?php

$idRol = $_POST['idRolSelected'];
$accion = $_POST['accion'];

require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fUsuario = new FacadeUsuarios();
$result = $fUsuario->listarAreas($idRol);
if ($accion == "listarAreas") {
    if ($result) {
        
    }
    $html = '<option value="" disabled selected>Seleccione un Área</option>';
    foreach ($result as $fila) {
        $html .= '<option value="' . $fila['idAreas'] . '">' . $fila['nombreArea'] . '</option>';
    }
}
print $html;
