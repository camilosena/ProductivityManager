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

if (isset($_GET['AgregarProducto'])) {
    
    $productosDTO->setIdProducto($_GET['IdProducto']);
    $productosDTO->setNombre($_GET['Producto']);
    $carpeta = "productos";
        $nombreImagen = $_FILES['uploadedfile']['name'];
        $tamano = $_FILES['uploadedfile']['size'];
        $tipo = $_FILES['uploadedfile']['type'];
        $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
        $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
       $cargaFoto = new GestionImagenes();
       $msg =$cargaFoto->subirImagen($dtoImagen);
    $productosDTO->setImagen($msg);
    $productosDTO->setDescripción($_GET['descripcion']);
    
    $facadeProductos->agregarProducto($productosDTO);
    
     header("location: ../vista/agregarProductos.php?".$mensaje);
    
}

