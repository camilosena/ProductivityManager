<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorProcesos
 *
 * @author Jorge M. Izquierdo N
 */
require_once '../facades/FacadeProcesos.php';
require_once '../modelo/dao/ProcesosDAO.php';
require_once '../modelo/dto/ProcesosDTO.php';
require_once '../modelo/utilidades/Conexion.php';

$facadeProcesos = new FacadeProcesos();
$pDTO = new ProcesosDTO();

if (isset($_POST['AgregarProceso'])) {
    
    $pDTO->setIdProceso($_GET['IdProceso']);
    $pDTO->setTipo($_GET['NombreProceso']);
    $pDTO->setTiempo($_GET['Tiempo']);
    
}