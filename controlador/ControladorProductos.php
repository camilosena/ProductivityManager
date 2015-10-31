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

$facadeProductos = new FacadeProductos();
$productosDTO = new ProductosDTO();

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
    
    $facadeProductos->agregarProducto($productosDTO);
    
     header("location: ../vista/agregarProductos.php?".$mensaje);
    
}

