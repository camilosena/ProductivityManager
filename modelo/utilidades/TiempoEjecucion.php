<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TiempoEjecucion
 *
 * @author Jorge M. Izquierdo N
 */

    require_once '../facades/FacadeProyectos.php';
    require_once '../modelo/dao/ProyectosDAO.php';
class TiempoEjecucion {
    //put your code here
    function ejecucionProyectoss(){

             $facadeProyectos = new FacadeProyectos();
             $datos = $facadeProyectos->listadoProyectos();
             foreach ($datos as $dato){
                 $ejecucion = $dato['ejecutado'];
                 $idProyecto = $dato['idProyecto'];
                 $fechaInicio = $dato['fechaInicio'];
                 $fechaActual= date('Y-m-d');
                 $fechaFin = $dato['fechaFin'];
                 if ($ejecucion < 100){
                    if ($fechaFin != 0){   
                       $datetime1 = new DateTime($fechaInicio);
                       $datetime2 = new DateTime($fechaActual);
                       $datetime3 = new DateTime($fechaFin);
                       $interval1 = $datetime1->diff($datetime2);
                       $interval2 = $datetime1->diff($datetime3);
                    $diasTrasncurridos = $interval1->format('%a');
                    $diasTotales = $interval2->format('%a');
                    $porcentaje = (100*$diasTrasncurridos)/$diasTotales;
                    $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                    }
                 }else{
                     $estado = "Finalizado";
                     $porcentaje = 100;
                     $facadeProyectos->cambiarEstadoProyecto($estado, $idProyecto);  
                     $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                 }
               }
}
}