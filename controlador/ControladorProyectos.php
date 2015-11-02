<?php

require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/dto/ProyectosDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProyectos.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/InsumosDAO.php';
require_once '../facades/FacadeInsumos.php';

//Crea Proyecto
if (isset($_POST['crearProyecto'])) {
    session_start();
    $idProyecto = $_POST['idProyecto'];
    $nombreProyecto = $_POST['nombreProyecto'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 'Sin Estudio Costos';
    $observaciones = $_POST['descripcion'];
    $fecha_inicio = new DateTime($_POST['fechaInicio']);
    $fecha_fin = new DateTime($_POST['fechaFin']);
    if ($fecha_fin > $fecha_inicio) {
        $proyectoDTO = new ProyectosDTO($idProyecto, $nombreProyecto, $fechaInicio, $fechaFin, $estado, $observaciones);
        $facadeProyectos = new FacadeProyectos;
        $facadeUsuario = new FacadeUsuarios;
        $mensaje = $facadeProyectos->creacionProyectos($proyectoDTO);
        $mensaje2 = $facadeUsuario->asignarUsuarioProyecto($_POST['cliente'], $_POST['idProyecto']);
        $gerenteEncargado = $facadeUsuario->usuarioEnSesion($_SESSION['id']);
        $mensaje3 = $facadeUsuario->asignarUsuarioProyecto($gerenteEncargado, $_POST['idProyecto']);
        $abrirVentana = true;
        header("location: ../vista/listarProyectos.php?mensaje=" . $mensaje . "&winOpen=" . $abrirVentana . "&mensaje2=" . $mensaje2 . "&projectNum=" . $_POST['idProyecto'] . "&nameProject=" . $_POST['nombreProyecto']);
    } else {
        $fechas = 'La fecha Fin debe ser posterior a la de Inicio';
        header("location: ../vista/crearProyecto.php?mensajeFecha=" . $fechas);
    }
} else if (isset($_POST['modificarProyecto'])) {
    $idProyecto = $_POST['idProyecto'];
    $nombreProyecto = $_POST['nombreProyecto'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 'Ejecucion';
    $observaciones = $_POST['descripcion'];
    $fecha_inicio = new DateTime($_POST['fechaInicio']);
    $fecha_fin = new DateTime($_POST['fechaFin']);
    if ($fecha_fin > $fecha_inicio) {
        $proyectoDTO = new ProyectosDTO($idProyecto, $nombreProyecto, $fechaInicio, $fechaFin, $estado, $observaciones);
        $facadeProyecto = new FacadeProyectos();
        $mensaje = $facadeProyecto->actualizarProyecto($proyectoDTO);
        $facadeUsuario = new FacadeUsuarios;
        $mensaje2 = $facadeUsuario->modificarUsuarioProyecto($_POST['cliente'], $_POST['idProyecto']);
        header("location: ../vista/listarProyectos.php?mensaje=" . $mensaje);
    } else {
        $fechas = 'La fecha fin debe ser posterior a la de Inicio';
        header("location: ../vista/crearProyecto.php?mensajeFecha=" . $fechas);
    }
}//  Consultar
else if (isset($_GET['idProject'])) {
    $facadeProyecto = new FacadeProyectos;
    $proyectos = $facadeProyecto->consultarProyecto($_GET['idProject']);
    header("Location: ../vista/listarProyectos.php?codigoPro=" . $proyectos['idProyecto'] . "&nombrePro=" . $proyectos['nombreProyecto'] . "&fechaInicio=" . $proyectos['fechaInicio'] .
            "&fechaFin=" . $proyectos['fechaFin'] . "&estado=" . $proyectos['estado'] . "&ejecutado=" . $proyectos['ejecutado'] . "&obs=" . $proyectos['observaciones'] . "&#verUsuario");
}
//Implementar Facade Para asignar usuario a tabla usuarioPorProyecto
else if (isset($_GET['codUsuario'])) {
    $facadeProyecto = new FacadeProyectos;
    $mensaje = $facadeProyecto->asignarUsuarioProyecto($_GET['codUsuario'], $_POST['idProjects']);
    header("location: ../vista/listarUsuarios.php?mensajeAsignacion=" . $_GET['rolUser'] . $mensaje);
}
else if (isset($_POST['elementosProyecto'])){
//echo var_dump($_POST);    
  $cantidadTipo = $_POST['cantidadTipo'];
  $idProyecto = $_POST['idProyecto'];
  $totalProductos = 5;
  $fProyecto = new FacadeProyectos;
  for($j = 1; $j <= $totalProductos; $j++) {           
        if(isset($_POST['producto'.$j]) && isset($_POST['cantidad'.$j])){
        $idProducto = $_POST['producto'.$j];
        $cantidad = $_POST['cantidad'.$j];        
        echo $fProyecto->insertarProductoProyecto($idProducto, $idProyecto, $cantidad);       
        }              
    }    
    $produccion = $fProyecto->obtenerProductoProyecto($idProyecto);
    $fMateria = new FacadeInsumos();    
    foreach ($produccion as $todo) {
       $materias= $fMateria->obtenerInsumos($todo['Productos_idProductos']);
       foreach ($materias as $insumo) {             
            $cantidadPorMedida = $fProyecto->obtenerCantidadMateriaProducto($todo['Productos_idProductos'], $insumo['insumos']);
            $total = $cantidadPorMedida*Sigue por precio base lo retornado por cantidad de producto;
//         $fProyecto->insertarMateriaProyecto($insumo['insumos'], $idProyecto, $total, $provision);
       }
        echo 'producto:'.$todo['Productos_idProductos'];        
        echo 'proyecto:'.$todo['proyectosIdProyecto'];
        echo 'cantidad:'.$todo['cantidadProductos'];
    }
}
