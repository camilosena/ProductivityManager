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
        $costoManoDeObra = $_POST['manoDeObra'];
        $costoProduccion = $_POST['costoProduccion'];
        $costoProyecto = $_POST['costoProyecto'];
        $utilidad=$_POST['utilidad'];
        $tiempoEstimado=$_POST['tiempoEstimado'];
        $totalTrabajadores=$_POST['totalTrabajadores'];
        $observaciones=$_POST['observaciones'];
        $nombreProyecto = $_POST['nombreProyecto'];
        $costoDTO = new EstudioCostosDTO($idProyectoSolicitado,$idGerenteCargo,$costoManoDeObra,$costoProduccion,$costoProyecto,$utilidad,$tiempoEstimado,$totalTrabajadores,$observaciones);
        $facadeCostos = new FacadeEstudioCostos;
        $mensaje=$facadeCostos->generarEstudioCostos($costoDTO);
        $valida = $facadeCostos->verificaExistenciaEstudio($idProyectoSolicitado);
        // actualizar estado de proyecto
            if($valida !=''){
             $facadeProyecto = new FacadeProyectos;
                $facadeProyecto->cambiarEstadoProyecto('Espera', $idProyectoSolicitado);
                $facadeProyecto->cambiarFechaFinProyecto($_POST['fechaFinal'],$idProyectoSolicitado);
            }      
            header("location: ../vista/estudioDeCostos?mensaje=".$mensaje."&projectNum=".$idProyectoSolicitado."&nameProject=".$nombreProyecto);       
    } 