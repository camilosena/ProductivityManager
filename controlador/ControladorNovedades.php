<?php
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/NovedadesDAO.php';
require_once '../modelo/dto/NovedadesDTO.php';
require_once '../facades/FacadeNovedades.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';

if(isset($_POST['crearNovedad'])){
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $facadeNovedad = new FacadeNovedades();
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $idProyecto=$_POST['idProyecto'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $archivo=$_FILES['uploadedfile']['name'];
    $objetoDTO = new NovedadesDTO($idUsuario, $idProyecto, $categoria, $descripcion, $archivo);

    //Insertar Evidencia Novedades
    if ($_FILES['uploadedfile']['name'] == '') {
        $foto ='novedad.png';
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
    if($msg!='True'){
         header("location: ../vista/agregarNovedad.php?errorPermiso=Archivo No Valido");
    }else{
    $message= $facadeNovedad->insertarNovedad($objetoDTO);
    header("location: ../vista/agregarNovedad.php?novedad=".$message."&evidencia=".$msg);
    }
}else if (isset($_GET['idNovedad'])) {
    $facadeNovedad = new FacadeNovedades();
    session_start();
    $_SESSION['datoNovedad'] = $facadeNovedad->consultarNovedad($_GET['idNovedad']);

    header("Location: ../vista/listarNovedades.php?&#verUsuario");
}