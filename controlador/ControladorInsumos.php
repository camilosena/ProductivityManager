<?php
    require_once '../facades/FacadeInsumos.php';
    require_once '../modelo/dao/InsumosDAO.php';
    require_once '../modelo/dto/InsumosDTO.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/dao/ArchivoDAO.php';
    require_once '../facades/FacadeArchivo.php';
    
    if (isset($_GET['AgregarInsumo'])) {
    $facadeInsumos = new FacadeInsumos();
    $InsumosDTO = new InsumosDTO();
    $InsumosDTO->setNombre($_GET['NombreInsumo']);
    $InsumosDTO->setMedida($_GET['unidad']);
    $InsumosDTO->setPrecio($_GET['precio']);
    $InsumosDTO->setId($_GET['numero']);
    $mensaje = $facadeInsumos->agregarInsumo($InsumosDTO);
     
     header("location: ../vista/agregarInsumos.php?".$mensaje);
}
else 
    if (isset ($_GET['idEditarMateria'])) {
    session_start();
    $facadeInsumos = new FacadeInsumos();
    $_SESSION['consultarMaterias']= $facadeInsumos->consultarMateriaPrima($_GET['idEditarMateria']);
   header("location: ../vista/agregarInsumos.php?&#ModalMateriaPrima");
    
}else
if (isset ($_POST['Change'])) {
     $table = 'materiaprima';
        $file = realpath($_FILES['archivo']['tmp_name']);
        $file = str_replace('\\', '/', $file);
        $facadeArchivo = new FacadeArchivo();
        $mensaje = $facadeArchivo->cargarArchivo($table, $file);
         header("location: ../vista/agregarInsumos.php?mensaje=".$mensaje);
}else
if (isset ($_POST['modificarMateria'])) {
     $facadeInsumos = new FacadeInsumos();
    $InsumosDTO = new InsumosDTO();
   $InsumosDTO->setNombre($_POST['descripcionMateria']);
    $InsumosDTO->setMedida($_POST['unidadDeMedida']);
    $InsumosDTO->setPrecio($_POST['precioBase']);
    $InsumosDTO->setId($_POST['idMateriaPrima']);
    $mensaje = $facadeInsumos->modificarMateriaPrima($InsumosDTO);
    header("location: ../vista/agregarInsumos.php? mensaje=".$mensaje);
}