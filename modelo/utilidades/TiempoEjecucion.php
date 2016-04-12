<?php

require_once '../utilidades/Conexion.php';
require_once '../dao/ProyectosDAO.php';
require_once '../../facades/FacadeProyectos.php';

class TiempoEjecucion {
    function dias_transcurridos($fecha_i,$fecha_f) {
        $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias   = abs($dias); 
        $dias = floor($dias);     
        return $dias;
    }
    function ejecucionProyectos(){
            $facadeProyectos = new FacadeProyectos();
            $datos = $facadeProyectos->listadoProyectos();
                foreach ($datos as $dato){
                 $ejecucion = $dato['ejecutado'];
                 $idProyecto = $dato['idProyecto'];
                 $nombreProyecto = $dato['nombreProyecto'];
                 $fechaInicio = $dato['fechaInicio'];
                 date_default_timezone_set("America/Bogota");
                 $fechaActual= date('Y-m-d');
                 $fechaFin = $dato['fechaFin'];
                 $estado = $dato['estadoProyecto'];
                 $transcurrido= $dato['ejecutado'];
                 if ($fechaInicio==$fechaActual && $estado =='Espera') {
                    $totalDias = $this->dias_transcurridos($fechaInicio,$fechaFin);
                    $totalPasado = $this->dias_transcurridos($fechaInicio,$fechaActual);
                    $porcentaje=($totalPasado*100)/$totalDias;
                    $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                    $facadeProyectos->cambiarEstadoProyecto('Ejecución', $idProyecto);

                }
                elseif ($estado == 'Ejecución' && $transcurrido<100) {
                   $totalDias = $this->dias_transcurridos($fechaInicio,$fechaFin);
                   $totalPasado = $this->dias_transcurridos($fechaInicio,$fechaActual);
                   $porcentaje=($totalPasado*100)/$totalDias;
                   $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
               }elseif($fechaInicio<$fechaActual && $estado == 'Sin Estudio Costos' || $fechaInicio<$fechaActual && $estado == 'Sin Producción' ){
                   $facadeProyectos->cambiarEstadoProyecto('Cancelado', $idProyecto);
                   $facadeProyectos->cambiarObservacionesProyecto('No se incluyó producción o costos antes de la fecha tentativa de inicio.', $idProyecto);
               }
        }
        $datos2 = $facadeProyectos->listadoProyectos();
        foreach ($datos2 as $dato2){
            if ($dato2['ejecutado']==100) {
                $facadeProyectos->cambiarEstadoProyecto('Finalizado', $dato2['idProyecto']);
            }else if ($dato2['ejecutado']>100) {
                $facadeProyectos->ejecucionProyecto($dato2['idProyecto'], 100);
            }
        }
    }
}


$ejecucionProyectos = new TiempoEjecucion();
$ejecucionProyectos->ejecucionProyectos();