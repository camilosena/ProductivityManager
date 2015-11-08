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
require_once '../modelo/dao/ProductosDAO.php';
require_once '../facades/FacadeProductos.php';
require_once '../modelo/dao/ProcesosDAO.php';
require_once '../facades/FacadeProcesos.php';

//Crea Proyecto
if (isset($_POST['crearProyecto'])) {
    session_start();
    $idProyecto = $_POST['idProyecto'];
    $nombreProyecto = $_POST['nombreProyecto'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = '';
    $estado = 'Sin Produccion';
    $observaciones = $_POST['descripcion'];    
    $fecha_inicio = new DateTime($_POST['fechaInicio']);
    $hoy = date('Y-m-d');    
     $fecha_actual = new DateTime($hoy);
    if ($fecha_actual <= $fecha_inicio) {
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
        $fechas = 'La Fecha de Inicio debe ser Futura';
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
else if (isset($_POST['elementosProyecto'])) {
//echo var_dump($_POST);    
    $fProducto = new FacadeProductos();
    session_start();
    $cantidadTipo = $_POST['cantidadTipo'];
    $idProyecto = $_POST['idProyecto'];
    $totalProductos =   $fProducto->maxProductoActivo(); //Productos Activos
    $fProyecto = new FacadeProyectos;
    for ($j = 1; $j <= $totalProductos; $j++) {
        if (isset($_POST['producto' . $j]) && isset($_POST['cantidad' . $j])) {
            $idProducto = $_POST['producto' . $j];
            $cantidad = $_POST['cantidad' . $j];
            $mensaje =$fProyecto->insertarProductoProyecto($idProducto, $idProyecto, $cantidad);
        }
    }
    $produccion = $fProyecto->obtenerProductoProyecto($idProyecto);
    $fMateria = new FacadeInsumos();
    $fProceso= new FacadeProcesos();
    foreach ($produccion as $todo) { 
        $materias = $fMateria->obtenerInsumos($todo['Productos_idProductos']);
        //Materia Prima Por Proyecto        
        foreach ($materias as $insumo) {
            $precioBase = $fMateria->obtenerInsumosPorID($insumo['insumos']); //Retona solo precio base
            $subTotal = ($insumo['cantidadMateriaPorProducto'] * $precioBase);
            $total = $subTotal * $todo['cantidadProductos'];
            $fProyecto->insertarMateriaProyecto($insumo['insumos'], $idProyecto, $total, 0);
        }   
        $procesos = $fProceso->obtenerProcesoPorProducto($todo['Productos_idProductos']);
        //Procesos por producto segun solicitud de proyecto
        foreach ($procesos as $proceso) {
            $subTotalProceso = $fProceso->obtenerProcesoPorID($proceso['procesos_idProcesos']); //Retorna solo costo base
            $totalPrecio = ($subTotalProceso * $todo['cantidadProductos']);
            $fProyecto->insertarProcesoProyecto($idProyecto, $proceso['procesos_idProcesos'], $totalTiempo, $totalPrecio, $totalEmp, $prov);
        }
    }
    $fProyecto->cambiarEstadoProyecto('Sin Estudio Costos', $_POST['idProyecto']);
    header("location: ../vista/produccionProyecto.php?mensaje=".$mensaje);
}
