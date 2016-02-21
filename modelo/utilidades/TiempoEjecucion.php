<?php

require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../PHPMailer/PHPMailerAutoload.php';
require_once '../facades/FacadeCorreos.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/UsuarioDAO.php';

class TiempoEjecucion {
    function dias_transcurridos($fecha_i,$fecha_f) {
        $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias   = abs($dias); $dias = floor($dias);     
        return $dias;
    }
    function ejecucionProyectos(){
            $facadeProyectos = new FacadeProyectos();
            $facadeUsuarios = new FacadeUsuarios();
            $datos = $facadeProyectos->listadoProyectos();
                foreach ($datos as $dato){
                 $ejecucion = $dato['ejecutado'];
                 $idProyecto = $dato['idProyecto'];
                 $nombreProyecto = $dato['nombreProyecto'];
                 $fechaInicio = $dato['fechaInicio'];
                 $fechaActual= date('Y-m-d');
                 $fechaFin = $dato['fechaFin'];
                 $estado = $dato['estadoProyecto'];
                 $transcurrido= $dato['ejecutado'];
                 if ($fechaInicio==$fechaActual && $estado =='Espera') {
                    $totalDias = $this->dias_transcurridos($fechaInicio,$fechaFin);
                    $totalPasado = $this->dias_transcurridos($fechaInicio,$fechaActual);
                    $porcentaje=($totalPasado*100)/$totalDias;
                    $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                    $facadeProyectos->cambiarEstadoProyecto('Ejecucion', $idProyecto);

                }
                elseif ($estado == 'Ejecución' && $transcurrido<100) {
                   $totalDias = $this->dias_transcurridos($fechaInicio,$fechaFin);
                   $totalPasado = $this->dias_transcurridos($fechaInicio,$fechaActual);
                   $porcentaje=($totalPasado*100)/$totalDias;
                   $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
               }
        }
        $datos2 = $facadeProyectos->listadoProyectos();
        foreach ($datos2 as $dato2){
            if ($dato2['ejecutado']==100) {
                $facadeProyectos->cambiarEstadoProyecto('Finalizado', $dato2['idProyecto']);
            }
        }
    }
}