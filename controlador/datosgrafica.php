<?php
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/dto/ProyectosDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProyectos.php';

	
 $facadeProyectos = new FacadeProyectos;
 $data = $facadeProyectos->graficoCostosAnuales($_GET['anioSel']);	
	$categorias = array('MES');
	$enero = array('ENERO');
	$febrero = array('FEBRERO');
	$marzo = array('MARZO');
	$abril = array('ABRIL');
	$mayo = array('MAYO');
	$junio = array('JUNIO');
	$julio = array('JULIO');
	$agosto = array('AGOSTO');
	$septiembre = array('SEPTIEMBRE');
	$octubre = array('OCTUBRE');
	$noviembre = array('NOVIEMBRE');
	$diciembre = array('DICIEMBRE');

	$enero[] = 0;
	$febrero[] =0;
	$marzo[] = 0;
	$abril[] =0;
	$mayo[] = 0;
	$junio[] =0;
	$julio[] = 0;
	$agosto[] = 0;
	$septiembre[] = 0;
	$octubre[] = 0;
	$noviembre[] = 0;
	$diciembre[] = 0;

	foreach ($data as $dato ) {
			if($dato['mes']==1){
				$enero[1] = $dato['suma'];
			}else if($dato['mes']==2){
				$febrero[1] = $dato['suma'];
			}else if($dato['mes']==3){
				$marzo[1] = $dato['suma'];
			}else if($dato['mes']==4){
				$abril[1] = $dato['suma'];
			}else if($dato['mes']==5){
				$mayo[1] = $dato['suma'];
			}else if($dato['mes']==6){
				$junio[1] = $dato['suma'];
			}else if($dato['mes']==7){
				$julio[1] = $dato['suma'];
			}else if($dato['mes']==8){
				$agosto[1] = $dato['suma'];
			}else if($dato['mes']==9){
				$septiembre[1] = $dato['suma'];
			}else if($dato['mes']==10){
				$octubre[1] = $dato['suma'];
			}else if($dato['mes']==11){
				$noviembre[1] = $dato['suma'];
			}else if($dato['mes']==12){
				$diciembre[1] = $dato['suma'];
			}
	}
	$categorias[] = 'Mes Evaluado';

	echo json_encode( array($categorias,$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre) );
	
