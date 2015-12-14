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
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/utilidades/EnvioCorreos.php';
    require_once '../PHPMailer/PHPMailerAutoload.php';
    require_once '../facades/FacadeCorreos.php';
    require_once '../modelo/dto/CorreosDTO.php';
    require_once '../facades/FacadeUsuarios.php';
    require_once '../modelo/dao/UsuarioDAO.php';
    
class TiempoEjecucion {
    //put your code here
    function ejecucionProyectos(){
        $facadeProyectos = new FacadeProyectos();
        $facadeUsuarios = new FacadeUsuarios();

             
             $datos = $facadeProyectos->listadoProyectos();
             foreach ($datos as $dato){
                 $ejecucion = $dato['ejecutado'];
                 $idProyecto = $dato['idProyecto'];
                 $nombreProyecto = ['nombreProyecto'];
                 $fechaInicio = $dato['fechaInicio'];
                 $fechaActual= date('Y-m-d');
                 $fechaFin = $dato['fechaFin'];
                 $estado = "Ejecución";
              if ($fechaInicio<$fechaActual) {

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
                    $facadeProyectos->cambiarEstadoProyecto($estado, $idProyecto);
                    }
                 }elseif ($ejecucion == 100) {
                     $estado = "Finalizado";
                     $porcentaje = $ejecucion;
                     $facadeProyectos->cambiarEstadoProyecto($estado, $idProyecto);  
                     $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                 }  elseif($ejecucion > 100) {
                     $estado = "Finalizado";
                     $porcentaje = 101;
                     $facadeProyectos->cambiarEstadoProyecto($estado, $idProyecto);  
                     $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                 }
               }else{
                   $estado = "Ejecución";
                     $porcentaje = 0;
                     $facadeProyectos->cambiarEstadoProyecto($estado, $idProyecto);  
                     $facadeProyectos->ejecucionProyecto($idProyecto, $porcentaje);
                   
               }
                                    
                 }
               
}
}