<?php

require_once '../facades/FacadeProcesos.php';
require_once '../modelo/dao/ProcesosDAO.php';
require_once '../modelo/dto/ProcesosDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProductos.php';
require_once '../modelo/dao/ProductosDAO.php';
$facadeProcesos = new FacadeProcesos();
$facadeProducto = new FacadeProductos();
$pDTO = new ProcesosDTO();

if (isset($_GET['AgregarProceso'])) {
    
    $pDTO->setIdProceso($_GET['IdProceso']);
    $pDTO->setTipo($_GET['NombreProceso']);
    $pDTO->setTiempo($_GET['Tiempo']);
    $pDTO->setEmpleados($_GET['Empleados']);
    $pDTO->setValor($_GET['valor']);
    $producto=$_GET['selectProducto'];
    $estado= "Activo";
    $mensaje = $facadeProcesos->AgregarProceso($pDTO, $producto);
    $facadeProducto->modificarEstadoProducto($estado, $producto);
    header("location: ../vista/agregarProcesos?mensaje= ".$mensaje);
    
}else 
    if (isset($_GET['idProceso'])) {
    $mensaje = $facadeProcesos->eliminarProceso($_GET['idProceso']);
    
    header("location: ../vista/agregarProcesos?mensaje= ".$mensaje);
    
}else
if (isset ($_GET['idConsultaProceso'])) {
    session_start();
    $_SESSION['consultarProcesos']= $facadeProcesos->consultarProcesos($_GET['idConsultaProceso']);
   header("location: ../vista/agregarProcesos?&#ModalProcesos");
    
}else
if (isset ($_POST['ModificarProceso'])) {
    
    $pDTO->setIdProceso($_POST['IdProceso']);
    $pDTO->setTipo($_POST['NombreProceso']);
    $pDTO->setTiempo($_POST['Tiempo']);
    $pDTO->setEmpleados($_POST['Empleados']);
    $pDTO->setValor($_POST['valor']); 
    $estado= "Activo";
    $producto = $_POST['idProducto'];
    $mensaje = $facadeProcesos->ModificarProcesos($pDTO);
    $facadeProducto->modificarEstadoProducto($estado, $producto);
    header("location: ../vista/agregarProcesos?mensaje= ".$mensaje);
}