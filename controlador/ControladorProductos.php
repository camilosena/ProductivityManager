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
require_once '../modelo/dto/InsumosPorProductoDTO.php';
require_once '../facades/FacadeArchivo.php';
require_once '../modelo/dao/ArchivoDAO.php';
 session_start();
$facadeProductos = new FacadeProductos();
$facadeInsumos = new FacadeInsumos();

$dto = new InsumosPorProductoDTO();
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
    $productosDTO->setEstado('Inactivo');
    $productosDTO->setPorcentaje($_POST['ganancia']);
    
    $mensaje=$facadeProductos->agregarProducto($productosDTO);
   
     header("location: ../vista/agregarProductos.php?mensaje=".$mensaje);
    
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
    
    
    $_SESSION['VisualizarProducto']= $facadeProductos->consultarProducto($_GET['idVisualizar']);
   header("location: ../vista/agregarProductos.php?&#ModalImagen");
    
}else
if (isset ($_GET['$idIParaInsumos'])) {
         
    $_SESSION['Producto']= $facadeProductos->consultarProducto($_GET['$idIParaInsumos']);
    header("location: ../vista/insumosPorProducto.php");
       
}else
if (isset ($_POST['AsociarInsumos'])) {
    $facadeInsumos->eliminarInsumos($_POST['idProducto']);
   $dto->setIdProdcuto($_POST['idProducto']);
$estado = "Sin Procesos";
    $cantidad = $_SESSION['cantInsumos'];
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_POST[$i])) {
            $dto->setIdInsumo($_POST[$i]);
              $dto->setCantidad($_POST['cant'.$i]);
            echo $mensaje = $facadeProductos->asociarInsumos($dto);
        }
        $facadeProductos->modificarEstadoProducto($estado, $_POST['idProducto']);
    }
    

    
 header("location: ../vista/insumosPorProducto.php?mensaje=Insumos Asociados con Éxito");
}else 
if (isset ($_POST['Atras'])) {
     header("location: ../vista/agregarProductos.php");
}else
if (isset ($_POST['Change'])) {
     $table = 'productos';
        $file = realpath($_FILES['archivo']['tmp_name']);
        $file = str_replace('\\', '/', $file);
        $facadeArchivo = new FacadeArchivo();
        $mensaje = $facadeArchivo->cargarArchivo($table, $file);
         header("location: ../vista/agregarProductos.php?mensaje=".$mensaje);
}


