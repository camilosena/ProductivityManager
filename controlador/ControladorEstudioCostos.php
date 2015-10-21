<?php
    require_once '../modelo/dao/EstudioCostosDAO.php'; 
    require_once '../modelo/dto/EstudioCostosDTO.php'; 
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/dao/UsuarioDAO.php'; 
    require_once '../modelo/dto/UsuarioDTO.php';
    require_once '../facades/FacadeUsuarios.php';
     require_once '../modelo/dao/ProyectosDAO.php'; 
    require_once '../modelo/dto/ProyectosDTO.php';
    require_once '../facades/FacadeProyectos.php';
    
    if(isset($_POST['crearCosto'])){ 
        session_start();
        $facadeUsuario = new FacadeUsuarios();        
        $idProyectoSolicitado=$_POST['idProyecto'];
        $idGerenteCargo=$facadeUsuario->usuarioEnSesion($_SESSION['id']);        
        $materiaPrima = $_POST['materiaPrima'];
        $manoObraDirecta = $_POST['horaDirecta'];
        $manoObraIndirecta = $_POST['horaIndirecta'];
        $gastos=$_POST['gastos'];
        $costo=$_POST['totalCosto'];
        $utilidad=$_POST['utilidad'];
        $cantidadEmpleados=$_POST['canEmpleados'];
        $observaciones=$_POST['observacion'];
        $viabilidad=$_POST['viabilidad'];
        $costoDTO = new EstudioCostosDTO($idProyectoSolicitado, $idGerenteCargo, $materiaPrima, $manoObraDirecta, $manoObraIndirecta, $gastos, $costo, $utilidad, $cantidadEmpleados, $observaciones, $viabilidad);
        $facadeCostos = new FacadeEstudioCostos;
        $mensaje=$facadeCostos->crearEstudio($costoDTO);
        // actualizar estado de proyecto
            if($mensaje=='Genero Estudio de Costos'){          
             $facadeProyecto = new FacadeProyectos;
                if ($viabilidad == 'Viable') {
                    $facadeProyecto->cambiarEstadoProyecto('Ejecucion', $_POST['idProyecto']);
                } else if ($viabilidad == 'No Viable') {
                    $facadeProyecto->cambiarEstadoProyecto('Cancelado', $_POST['idProyecto']);
                } else if ($viabilidad == 'Con Restriccion') {
                    $facadeProyecto->cambiarEstadoProyecto('Con Restriccion', $_POST['idProyecto']);
                }
            }      
            header("location: ../vista/estudiodeCostos.php?mensaje=".$mensaje);       
    } 