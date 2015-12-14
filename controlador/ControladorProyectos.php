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
require_once '../modelo/utilidades/festivos.php';

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

        $dia = $fecha_inicio->format('d');
        $mes = $fecha_inicio->format('m');
        $anio = $fecha_inicio->format('Y');
        $festivo = new festivos();
        $festivo->festivos($anio);
        $validaFestivo = $festivo->esFestivo($dia,$mes);
                    if( in_array(strtolower($fecha_inicio->format('l')), array('sunday')) || $validaFestivo=='true' ){
                        $fechas = 'Solo se puede iniciar proyecto un dia hábil';
                        $errorFecha = 'Dia Festivo';
                             header("location: ../vista/crearProyecto.php?mensajeFecha=" . $fechas."&error=".$errorFecha);
                        }
                    else{

        $proyectoDTO = new ProyectosDTO($idProyecto, $nombreProyecto, $fechaInicio, $fechaFin, $estado, $observaciones);
        $facadeProyectos = new FacadeProyectos;
        $facadeUsuario = new FacadeUsuarios;
        $mensaje = $facadeProyectos->creacionProyectos($proyectoDTO);
        $mensaje2 = $facadeUsuario->asignarUsuarioProyecto($_POST['cliente'], $_POST['idProyecto']);
        $gerenteEncargado = $facadeUsuario->usuarioEnSesion($_SESSION['id']);
        $mensaje3 = $facadeUsuario->asignarUsuarioProyecto($gerenteEncargado, $_POST['idProyecto']);
        $abrirVentana = true;
        header("location: ../vista/listarProyectos.php?mensaje=" . $mensaje . "&winOpen=" . $abrirVentana . "&mensaje2=" . $mensaje2 . "&projectNum=" . $_POST['idProyecto'] . "&nameProject=" . $_POST['nombreProyecto']);
        }
    } else {
        $fechas = 'La Fecha de Inicio debe ser Futura';
        header("location: ../vista/crearProyecto.php?mensajeFecha=" . $fechas);
    }
} else if (isset($_POST['modificarProyecto'])) {
    $idProyecto = $_POST['idProyecto'];
    $nombreProyecto = $_POST['nombreProyecto'];
    $fechaInicio = $_POST['fechaInicio'];
    $observaciones = $_POST['descripcion'];
    $fecha_inicio = new DateTime($_POST['fechaInicio']);
    $hoy = date('Y-m-d');
    $fecha_actual = new DateTime($hoy);
    if ($fecha_actual <= $fecha_inicio) {        
        $facadeProyecto = new FacadeProyectos();
        $state = $facadeProyecto->consultarProyecto($idProyecto);
        if ($state['estadoProyecto'] == 'Ejecucion') {
            $mensaje = 'No puede modificar proyectos con estado de Ejecución';
            header("location: ../vista/modificarProyecto.php?idProject=" . $_POST['idProyecto'] . "&errorEstado=" . $mensaje);
        } else {
            $proyectoDTO = new ProyectosDTO($idProyecto, $nombreProyecto, $fechaInicio, $fechaFin, $estado, $observaciones);
            $mensaje = $facadeProyecto->actualizarProyecto($proyectoDTO);
            $facadeUsuario = new FacadeUsuarios;
            $mensaje2 = $facadeUsuario->modificarUsuarioProyecto($_POST['cliente'], $_POST['idProyecto']);
            header("location: ../vista/listarProyectos.php?mensaje=" . $mensaje);
        }
    } else {
        $fechas = 'La Fecha de Inicio debe ser Futura';
        header("location: ../vista/modificarProyecto.php?idProject=" . $_POST['idProyecto'] . "&mensajeFecha=" . $fechas);
    }
}
//Facade Para asignar usuario a tabla usuarioPorProyecto
else if (isset($_GET['codUsuario'])) {
    $facadeProyecto = new FacadeProyectos;
    $cantidadAsignada = $facadeProyecto->cantidadUsuariosPorProyecto($_POST['idProjects']);
    $cantidadTotal = $facadeProyecto->totalUsuariosPorProyecto($_POST['idProjects']);
    $cantidadProyectos = $facadeProyecto->cantidadProyectosAsignados($_GET['codUsuario']);
    if ($cantidadProyectos <2){
    if ($cantidadAsignada <= $cantidadTotal) {
         $mensaje = $facadeProyecto->asignarUsuarioProyecto($_GET['codUsuario'], $_POST['idProjects']);
    header("location: ../vista/listarUsuarios.php?mensajeAsignacion=" . $_GET['rolUser'] . $mensaje);
    }else{
    $mensaje = " Error: No se puede asignar a este proyecto la cantidad de empleados esta completa";
    header("location: ../vista/listarUsuarios.php?mensajeAsignacion=" . $_GET['rolUser'] . $mensaje);
    }}else{
        $mensaje = " Error: No se puede asignar mas de dos proyectos";
    header("location: ../vista/listarUsuarios.php?mensajeAsignacion=" . $_GET['rolUser'] . $mensaje);
    }
} else if (isset($_POST['elementosProyecto'])) {
//echo var_dump($_POST);    
    $fProducto = new FacadeProductos();
    session_start();
    $cantidadTipo = $_POST['cantidadTipo'];
    $idProyecto = $_POST['idProyecto'];
    $totalProductos = $fProducto->maxProductoActivo(); //Productos Activos
    $fProyecto = new FacadeProyectos;
    for ($j = 1; $j <= $totalProductos; $j++) {
        if (isset($_POST['producto' . $j]) && isset($_POST['cantidad' . $j])) {
            $idProducto = $_POST['producto' . $j];
            $cantidad = $_POST['cantidad' . $j];
            $mensaje = $fProyecto->insertarProductoProyecto($idProducto, $idProyecto, $cantidad);
        }
    }
    $produccion = $fProyecto->obtenerProductoProyecto($idProyecto);
    $fMateria = new FacadeInsumos();
    $fProceso = new FacadeProcesos();
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
            $subTotalProceso = $fProceso->obtenerProcesoPorID($proceso['procesos_idProceso']); //Retorna solo costo base
            $totalPrecio = $subTotalProceso * $todo['cantidadProductos'];
            $totalEmp = $proceso['cantidadDeEmpleados'];
            $totalTiempo = $proceso['tiempoPorProceso'] * $todo['cantidadProductos'];
            $fProyecto->insertarProcesoProyecto($idProyecto, $proceso['procesos_idProceso'], $totalTiempo, $totalPrecio, $totalEmp, 0);
        }
    }
    $fProyecto->cambiarEstadoProyecto('Sin Estudio Costos', $_POST['idProyecto']);
    header("location: ../vista/produccionProyecto.php?mensaje=" . $mensaje);
}
