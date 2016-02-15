<?php

require_once '../modelo/dao/CrearRolDAO.php';
require_once '../modelo/dto/CrearRolDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeCreateRol.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeAreas.php';
require_once '../modelo/dao/AreasDAO.php';
require_once '../modelo/dto/AreasDTO.php';

session_start();
$facadeRol = new FacadeCreateRol();
$dto = new CrearRolDTO();
$mod = new CrearRolDAO();



if (isset($_GET['creaRol'])) {
    if($_GET['IdRol']>5){
        $errorRol="No tiene permitido crear más Roles";
         header("location: ../vista/crearRol.php?errorRol=".$errorRol);
    }else{
    $idRol = $_GET['IdRol'];
    $rol = $_GET['NameRol'];
    $dto->setIdRol($idRol);
    $dto->setRol($rol);
    $mensaje=$facadeRol->agregarRol($dto);
    header("location: ../vista/AsignarPermisos.php?mensaje=".$mensaje);
    }
} else
if (isset($_GET['asignarPermiso'])) {
    $idRol = $_GET['selectId'];

    $dto->setIdRol($idRol);

    $cantidad = $_SESSION['cantidad'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dto->setPermiso($_GET[$i]);
            $mensaje = $facadeRol->agregarPermisos($dto);
        }
    }
    header("location: ../vista/ModificarRol.php?id=".$idRol."&mensaje=".$mensaje);
} else
if (isset($_GET['listarRol'])) {
    header("location: ../vista/CrearRol.php#ModalRoles");
} else
if (isset($_GET['ModificarRol'])) {


    $facadeRol->ModificarRol($_GET['selectId']);
    $idRol = $_GET['selectId'];

    $dto->setIdRol($idRol);

    $cantidad = $_SESSION['cantidad'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dto->setPermiso($_GET[$i]);
            $mensaje = $facadeRol->agregarPermisos($dto);
        }
    }
    header("location: ../vista/ModificarRol.php?id=" . $_GET['selectId'] ."&mensaje=". $mensaje);
} else
if (isset($_GET['idElimirarRol'])) {
    $facadeRol->ModificarRol($_GET['idElimirarRol']);
    $facadeRol->EiliminarRol($_GET['idElimirarRol']);
    $mensaje = "Rol Eliminado";
    header("location: ../vista/CrearRol.php?mensaje=" . $mensaje);
} else
    if (isset($_GET['AgregarArea'])) {
        if($_GET['IdArea']>15){
              header("location: ../vista/agregarAreas.php?errorArea=No tiene permitido crear más Áreas");
        }else{
        $idArea = $_GET['IdArea'];
        $NombreArea = $_GET['NombreArea'];
        $idRol = 1;
        $dtoAreas = new AreasDTO();
        $dtoAreas->setIdArea($idArea);
        $dtoAreas->setNombreArea($NombreArea);
        $dtoAreas->setIdRol($idRol);
        $facadeArea= new FacadeAreas();
        $mensaje = $facadeArea->AgregarArea($dtoAreas);

   header("location: ../vista/agregarAreas.php?mensaje".$_GET['selectId'].$mensaje);
    }
} else
    
if (isset($_GET['Areas'])) {
    header("location: ../vista/agregarAreas.php?menasje=" . $mensaje);
} else
if (isset($_GET['atras'])) {
    header("location: ../vista/ModificarRol.php?id=" .$_GET['idAct']);
}else
if (isset($_GET['asignarArea'])) {
    $facadeArea= new FacadeAreas();
    $idRol = $_GET['selectId'];
    $dtoAreas = new AreasDTO();
    $dtoAreas->setIdRol($idRol);
    $cantidad = $facadeArea->ConsecutivoAreas();
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dtoAreas->setIdArea($_GET[$i]);
            $mensaje = $facadeArea->AsignarAreas($dtoAreas);
        }
    }
    header("location: ../vista/asignarAreas.php?mensaje" . $mensaje . " " . $idRol);
}else
if (isset($_GET['ModificarAreas'])) {
    header("location: ../vista/asignarAreas.php?id=" . $_GET['selectId'] . $mensaje);
   
}else
if (isset($_GET['ModificarArea'])) {
    $facadeArea= new FacadeAreas();
    $idRol = $_GET['selectId'];
    $facadeArea->ModificarAreas($idRol);
    $dtoAreas = new AreasDTO();
    $dtoAreas->setIdRol($idRol);
    $cantidad = $facadeArea->ConsecutivoAreas();
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dtoAreas->setIdArea($_GET[$i]);
            $mensaje = $facadeArea->AsignarAreas($dtoAreas);
        }
    }

    header("location: ../vista/asignarAreas.php?id=" . $_GET['selectId'] .'&mensaje='. $mensaje);
}
else
  if (isset ($_GET['idEditarArea'])) {
   $facadeArea= new FacadeAreas();
    $_SESSION['consultarAreas']= $facadeArea->consultarArea($_GET['idEditarArea']);
header("location: ../vista/agregarAreas.php?&#ModalAreas");
    
}else
  if (isset ($_POST['modificarNombreArea'])) {
   $facadeArea= new FacadeAreas();
   $dtoAreas = new AreasDTO();
   $dtoAreas->setIdArea($_POST['idArea']);
    $dtoAreas->setNombreArea($_POST['nombreArea']);
    $mensaje = $facadeArea->actualizarArea($dtoAreas);
header("location: ../vista/agregarAreas.php?mensaje=".$mensaje);
    
}