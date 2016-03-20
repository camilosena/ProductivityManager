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
 
    $productosDTO->setIdProducto('DEFAULT');
    $productosDTO->setNombre($_POST['Producto']);
    $productosDTO->setIva($_POST['iva']);
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
   
     header("location: ../vista/agregarProductos?mensaje=".$mensaje);
    
}else 
if (isset ($_GET['$idInactivar'])) {
 
    $facadeProductos->inactivarProducto($_GET['$idInactivar']);
     header("location: ../vista/agregarProductos?".$mensaje);
    
}else
    if (isset ($_GET['$idActivar'])) {
    
 
    $facadeProductos->activarProducto($_GET['$idActivar']);
     header("location: ../vista/agregarProductos?".$mensaje);
    
}else
if (isset ($_GET['idVisualizar'])) {
    
    
    $_SESSION['VisualizarProducto']= $facadeProductos->consultarProducto($_GET['idVisualizar']);
   header("location: ../vista/agregarProductos?&#ModalImagen");
    
}else
if (isset ($_GET['$idIParaInsumos'])) {
         
    $_SESSION['Producto']= $facadeProductos->consultarProducto($_GET['$idIParaInsumos']);
    header("location: ../vista/insumosPorProducto");
       
}else
if (isset ($_POST['AsociarInsumos'])) {
    $facadeInsumos->eliminarInsumos($_POST['idProducto']);
   $dto->setIdProdcuto($_POST['idProducto']);
$estado = "Sin Procesos";
    $cantidad = $facadeInsumos->consecutivoInsumos();
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_POST[$i])) {
            $dto->setIdInsumo($_POST[$i]);
              $dto->setCantidad($_POST['cant'.$i]);
             $facadeProductos->asociarInsumos($dto);
        }
        $facadeProductos->modificarEstadoProducto($estado, $_POST['idProducto']);
    }    
header("location: ../vista/insumosPorProducto?mensaje=Materia Prima Asociada con Éxito");
}else 
if (isset ($_POST['Atras'])) {
     header("location: ../vista/agregarProductos");
}else
if (isset ($_POST['Change'])) {
   /*  $table = 'productos';
        $file = realpath($_FILES['archivo']['tmp_name']);
        $file = str_replace('\\', '/', $file);
        $facadeArchivo = new FacadeArchivo();
        $mensaje = $facadeArchivo->cargarArchivo($table, $file);
        */
        if($_FILES['archivo']['type']=='application/vnd.ms-excel'){
        $cnn = Conexion::getConexion();
        $script='insert into productos () values ();';
            $archivoleer=$_FILES['archivo']['tmp_name'];
            $abrete=fopen($archivoleer,'rb');
            while(!feof($abrete)){
                $script=fgets($abrete);
                $linea=str_replace(';', ',', $script);
                $todos=(explode(',', $linea));
                  try {
                $sentencia = $cnn->prepare("INSERT INTO productos VALUES(?,?,?,?,?,?,?)");
                $sentencia->bindParam(1, $todos[0]);
                $sentencia->bindParam(2, $todos[1]);
                $sentencia->bindParam(3, $todos[2]);
                $sentencia->bindParam(4, $todos[3]);
                $sentencia->bindParam(5, $todos[4]);
                $sentencia->bindParam(6, $todos[5]);
                $sentencia->bindParam(7, $todos[6]);
                $sentencia->execute();
                    $mensaje = "Productos Cargados con Éxito";
                    } catch (Exception $ex) {
                        $mensaje =' Verifique si los productos ya se han cargado';
                    }
            }
            fclose($abrete);
          /* $sentencia = $cnn->prepare("INSERT INTO productos VALUES(?,?,?,?,?,?,?)");
            $sentencia->execute();*/
        header("location: ../vista/agregarProductos?mensaje=".$mensaje);
    }else{
        header("location: ../vista/agregarProductos?errorPermiso=Debe cargar un archivo con extensión .csv");
    }
}


