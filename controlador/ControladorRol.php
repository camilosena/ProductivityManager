<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorRol
 *
 * @author Jorge M. Izquierdo N
 */
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
    $idRol = $_GET['IdRol'];
    $rol = $_GET['NameRol'];
    $dto->setIdRol($idRol);
    $dto->setRol($rol);
    $mensaje=$facadeRol->agregarRol($dto);
    header("location: ../vista/AsignarPermisos.php?mensaje=".$mensaje);
} else
if (isset($_GET['crearRol'])) {
    $idRol = $_GET['selectId'];

    $dto->setIdRol($idRol);

    $cantidad = $_SESSION['cantidad'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dto->setPermiso($_GET[$i]);
            $mensaje = $facadeRol->agregarPermisos($dto);
        }
    }
    header("location: ../vista/ModificarRol.php?id=".$idRol);
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
    header("location: ../vista/ModificarRol.php?id=" . $_GET['selectId'] . $mensaje);
} else
if (isset($_GET['idElimirarRol'])) {
    $facadeRol->ModificarRol($_GET['idElimirarRol']);
    $facadeRol->EiliminarRol($_GET['idElimirarRol']);
    $mensaje = "Rol Eliminado";
    header("location: ../vista/CrearRol.php?" . $mensaje);
} else
    if (isset($_GET['AgregarArea'])) {
$idArea = $_GET['IdArea'];
$NombreArea = $_GET['NombreArea'];
$idRol = 1;
$dtoAreas = new AreasDTO();
$dtoAreas->setIdArea($idArea);
$dtoAreas->setNombreArea($NombreArea);
$dtoAreas->setIdRol($idRol);
$facadeArea= new FacadeAreas();
$mensaje = $facadeArea->AgregarArea($dtoAreas);

   header("location: ../vista/agregarAreas.php?".$_GET['selectId'].$mensaje);
} else
    
if (isset($_GET['Areas'])) {
    header("location: ../vista/agregarAreas.php?" . $mensaje);
} else
if (isset($_GET['Atras'])) {
    header("location: ../vista/CrearRol.php?" . $mensaje);
}else
if (isset($_GET['asignarArea'])) {
    $facadeArea= new FacadeAreas();
    $idRol = $_GET['selectId'];
    $dtoAreas = new AreasDTO();
    $dtoAreas->setIdRol($idRol);

    $cantidad = $_SESSION['cantidad'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dtoAreas->setIdArea($_GET[$i]);
            $mensaje = $facadeArea->AsignarAreas($dtoAreas);
        }
    }
    header("location: ../vista/asignarAreas.php?" . $mensaje . " " . $idRol);
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

    $cantidad = $_SESSION['cantidad'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_GET[$i])) {
            $dtoAreas->setIdArea($_GET[$i]);
            $mensaje = $facadeArea->AsignarAreas($dtoAreas);
        }
    }

    header("location: ../vista/asignarAreas.php?id=" . $_GET['selectId'] . $mensaje);
}
else
if (isset($_GET['idEliminar'])) {
    $facadeArea= new FacadeAreas();
    $idArea = $_GET['idEliminar'];
    $mensaje = $facadeArea->eliminarArea($idArea);

    header("location: ../vista/agregarAreas.php?id=" . $_GET['selectId'] . $mensaje);
}