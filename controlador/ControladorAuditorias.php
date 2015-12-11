<?php
require_once '../modelo/dao/AuditoriaDAO.php';
require_once '../modelo/dto/AuditoriaDTO.php';
require_once '../facades/FacadeAuditorias.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';

if(isset($_POST['crearAuditoria'])){
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $facadeAdutoria = new FacadeAuditorias();
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $idProyecto=$_POST['idProyecto'];
    $descripcion=$_POST['descripcion'];
    
    $archivoAuditoria=$_FILES['uploadedfile']['name'];
     $ejecucion = $_POST['ejecucion'];
     $presupuesto = $_POST['presupuesto'];
     $insumos = $_POST['insumos'];
     $calidad = $_POST['calidad'];
     $procesos = $_POST['procesos'];
     $empleados = $_POST['empleados'];
     
     $auditoria= ($ejecucion + $presupuesto +  $insumos +  $calidad + $procesos + $empleados)/6;
     if ($auditoria >= 90) {
         $producto = $auditoria."%  Excelente";
     }else
     if ($auditoria < 90 & $auditoria >=47) {
         $producto = $auditoria."% Plan de Mejoramiento";
     }else
     if ($auditoria < 47) {
         $producto = $auditoria."% Comite Evaluador";
     }
    $objetoDTO = new AuditoriaDTO($idAuditoria, $idUsuario, $idProyecto, $descripcion, $producto, $archivoAuditoria, $ejecucion, $presupuesto, $insumos, $calidad, $procesos, $empleados);
    
    //Insertar Evidencia Auditor�a
    if ($_FILES['uploadedfile']['name'] == '') {
        $foto ='auditoria.png';
    } else {
        $foto = $_FILES['uploadedfile']['name'];
    }
    $carpeta = "evidencias";
    $nombreImagen = $_FILES['uploadedfile']['name'];
    $tamano = $_FILES['uploadedfile']['size'];
    $tipo = $_FILES['uploadedfile']['type'];
    $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
    $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
    $cargaFoto = new GestionImagenes();
    $msg =$cargaFoto->subirImagen($dtoImagen);

    $message= $facadeAdutoria->insertarAuditoria($objetoDTO);
    header("location: ../vista/generarAuditoria.php?auditoria=".$message);
    }else if (isset($_GET['idAuditoria'])) {
    $facadeAdutoria = new FacadeAuditorias();
    session_start();
    $_SESSION['datosAuditoria'];
    $_SESSION['datosAuditoria'] = $facadeAdutoria->consultarAuditoria($_GET['idAuditoria']);
    header("Location: ../vista/listarAuditorias.php?&#verAuditoria");
    }