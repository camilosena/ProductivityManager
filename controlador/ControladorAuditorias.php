<?php
require_once '../modelo/dao/AuditoriaDAO.php';
require_once '../modelo/dto/AuditoriaDTO.php';
require_once '../facades/FacadeAuditorias.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/utilidades/Conexion.php';

if(isset($_POST['crearAuditoria'])){
    session_start();    
    $facadeUsuario = new FacadeUsuarios;
    $facadeAdutoria = new FacadeAuditorias();
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $idProyecto=$_POST['idProyecto'];
    $descripcion=$_POST['descripcion'];
    $objetoDTO = new AuditoriaDTO($idUsuario, $idProyecto, $descripcion);
    $objetoDTO->setProducto($_POST['producto']);
    $message= $facadeAdutoria->insertarAuditoria($objetoDTO);
    header("location: ../vista/generarAuditoria.php?auditoria=".$message);
}
//}else if (isset($_GET['idAuditoria'])) {
//    $facadeAdutoria = new FacadeAuditorias();
//    $novedad= $facadeNovedad->consultarNovedad($_GET['idNovedad']);
//    header("Location: ../vista/listarNovedades.php?idNovedad=" . $novedad['idNovedad'] . "&nombreProyecto=" . $novedad['nombreProyecto'] . "&categoria=" . $novedad['categoria'] .
//            "&descripcion=" . $novedad['descripcion'] . "&fecha=" . $novedad['fecha'] . "&archivo=" . $novedad['archivo']."&#verUsuario");
//}