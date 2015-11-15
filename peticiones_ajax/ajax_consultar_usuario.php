<?php

$identificacion = $_POST['valorBusqueda'];

require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fUsuario = new FacadeUsuarios();
$result = $fUsuario->verificarUsuarioRegistrado($identificacion);
if ($result !='') {

    $html = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">Este Usuario Ya Existe</font>';
}else{
    $html = '<font style="color: #0e8e1e;font-size: 14px; font-weight: bolder;">√</font>';
}
print $html;
