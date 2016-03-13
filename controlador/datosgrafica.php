<?php
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../modelo/dto/ProyectosDTO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeProyectos.php';

	
 $facadeProyectos = new FacadeProyectos;
 $data = $facadeProyectos->graficoCostosAnuales(2016);	
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

	foreach ($data as $dato ) {
	}
	$enero[] = 8888;
	$febrero[] =7500;
	$marzo[] = 6340;
	$abril[] =7500;
	$mayo[] = 6340;
	$junio[] =7500;
	$julio[] = 6340;
	$agosto[] = 6340;
	$septiembre[] = 7500;
	$octubre[] = 6340;
	$noviembre[] = 6340;
	$diciembre[] = 7500;
	
	$categorias[] = 'Mes Evaluado';

	echo json_encode( array($categorias,$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre) );
	
