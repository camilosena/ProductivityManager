<?php
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/NovedadesDAO.php';
require_once '../modelo/dto/NovedadesDTO.php';
require_once '../facades/FacadeNovedades.php';
require_once '../modelo/utilidades/Conexion.php';

if(isset($_POST['crearNovedad'])){
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $facadeNovedad = new FacadeNovedades();
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $idProyecto=$_POST['idProyecto'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $archivo=$_POST['uploadedfile'];
    $objetoDTO = new NovedadesDTO($idUsuario, $idProyecto, $categoria, $descripcion, $archivo);

    //insertar Evidencia
        if ($_FILES['uploadedfile']['name'] == '') {
            $objetoDTO->setArchivo('logo.png');
        } else {
            $objetoDTO->setArchivo($_FILES['uploadedfile']['name']);
        }
    $uploadedfileload = "true";
    $uploadedfile_size = $_FILES['uploadedfile']['size'];    
        if ($_FILES['uploadedfile']['size'] > 300000) {
            $msg = $msg . "El archivo es mayor a 300KB, debe reducirlo antes de subirlo<BR>";
            $uploadedfileload = "false";
            $objetoDTO->setArchivo('logo.png');
        }

        if (!($_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png")) {
            $msg = $msg . " Tu archivo tiene que ser JPG / GIF / PNG. Otros archivos no son permitidos<BR>";
            $uploadedfileload = "false";
            $objetoDTO->setArchivo('logo.png');
        }

        $file_name = $_FILES['uploadedfile']['name'];
        $add = "../evidencias/$file_name";
        if ($uploadedfileload == "true") {
            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
                $msg= " Ha sido subido satisfactoriamente";
            } else {
                $msg= "Error al subir el archivo";
            }
    }else{ 
        $msg;        
    }        
    $message= $facadeNovedad->insertarNovedad($objetoDTO);
    header("location: ../vista/agregarNovedad.php?novedad=".$message."&evidencia=".$msg);
}else if (isset($_GET['idNovedad'])) {
    $facadeNovedad = new FacadeNovedades();
    $novedad= $facadeNovedad->consultarNovedad($_GET['idNovedad']);
    header("Location: ../vista/listarNovedades.php?idNovedad=" . $novedad['idNovedad'] . "&nombreProyecto=" . $novedad['nombreProyecto'] . "&categoria=" . $novedad['categoria'] .
            "&descripcion=" . $novedad['descripcion'] . "&fecha=" . $novedad['fecha'] . "&archivo=" . $novedad['archivo']."&#verUsuario");
}