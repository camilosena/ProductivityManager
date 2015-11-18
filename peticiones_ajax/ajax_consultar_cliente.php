<?php

$nit = $_POST['valorCliente'];

require_once '../facades/FacadeCliente.php';
require_once '../modelo/dao/ClienteDAO.php';
require_once '../modelo/utilidades/Conexion.php';

$fCliente= new FacadeCliente();
$result = $fCliente->verificarClienteRegistrado($nit);
if ($result !='') {

    $html = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">Este Cliente Ya Existe</font>';
}else{
    $html = '<font style="color: #0e8e1e;font-size: 14px; font-weight: bolder;">√</font>';
}
print $html;