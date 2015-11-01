<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../facades/FacadeProductos.php';
require_once '../modelo/dao/ProductosDAO.php';
require_once '../modelo/dto/ProductosDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/dao/InsumosDAO.php';
require_once '../modelo/dto/InsumosDTO.php';
require_once '../facades/FacadeInsumos.php';

$facadeProductos = new FacadeProductos();
$productosDTO = new ProductosDTO();
$insumosDTO = new InsumosDTO;

if (isset($_POST['AgregarProducto'])) {
 
    $productosDTO->setIdProducto($_POST['IdProducto']);
    $productosDTO->setNombre($_POST['Producto']);
    $carpeta = "productos";
        $nombreImagen = $_FILES['Imagen']['name'];
        $tamano = $_FILES['Imagen']['size'];
        $tipo = $_FILES['Imagen']['type'];
        $nombreTemporal = $_FILES['Imagen']['tmp_name'];
        $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
       $cargaFoto = new GestionImagenes();
       $msg =$cargaFoto->subirImagen($dtoImagen);
    $productosDTO->setImagen($nombreImagen);
    $productosDTO->setDescripción($_POST['descripcion']);
    $productosDTO->setEstado('Activo');
    $productosDTO->setPorcentaje($_POST['ganancia']);
    
    $facadeProductos->agregarProducto($productosDTO);
   
     header("location: ../vista/agregarProductos.php?".$mensaje);
    
}else 
if (isset ($_GET['$idInactivar'])) {
 
    $facadeProductos->inactivarProducto($_GET['$idInactivar']);
     header("location: ../vista/agregarProductos.php?".$mensaje);
    
}else
    if (isset ($_GET['$idActivar'])) {
    
 
    $facadeProductos->activarProducto($_GET['$idActivar']);
     header("location: ../vista/agregarProductos.php?".$mensaje);
    
}else
if (isset ($_GET['idVisualizar'])) {
    
     session_start();
    $_SESSION['VisualizarProducto']= $facadeProductos->consultarProducto($_GET['idVisualizar']);
   header("location: ../vista/agregarProductos.php?&#ModalImagen");
    
}else
if (isset ($_GET['$idIParaInsumos'])) {
         session_start();
    $_SESSION['Producto']= $facadeProductos->consultarProducto($_GET['$idIParaInsumos']);
    header("location: ../vista/agregarProductos.php?&#ModalInsumos");
       
}else
if (isset ($_GET['AsociarInsumos'])) {
    $iDTO = $_GET['insumo'];
    $pDTO = $_SESSION['Producto']['idProducto'];
    $cantidad = $_GET['cantidad'];
    
    $facadeProductos->asociarInsumos($iDTO, $pDTO, $cantidad);
     header("location: ../vista/agregarProductos.php");
}

