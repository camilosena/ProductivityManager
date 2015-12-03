<?php
    require_once '../facades/FacadeProductos.php';
    require_once '../modelo/dao/ProductosDAO.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../modelo/dao/estudioCostosDAO.php';
    require_once '../facades/FacadeProyectos.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/utilidades/EstiloPDF.php';
    $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $facadeEstudioCostos = new FacadeEstudioCostos;
    
if(isset($_GET['estudioPDF'])){
    $costosProyecto = $facadeEstudioCostos->verificaExistenciaEstudio($_GET['estudioPDF']);
    
$pdf = new EstiloPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,30,'Proyecto No: '.$_GET['estudioPDF']);
$pdf->Ln();
$pdf->Cell(40,10,' Empleados Solicitados: '.$costosProyecto['totalTrabajadores']);
$pdf->Ln();
$pdf->Cell(40,10,' Costo Mano de Obra: $'.$costosProyecto['costoManoDeObra']);
$pdf->Ln();
$pdf->Cell(40,10,' Tiempo Estimado: '.$costosProyecto['tiempoEstimado'].' Horas');
$pdf->Ln();
$pdf->Cell(40,10,' Costo Produccion: $'.$costosProyecto['costoProduccion']);
$pdf->Ln();
$pdf->Cell(40,10,' Utilidad Generada: $'.$costosProyecto['utilidad']);
$pdf->Ln();
$pdf->Cell(40,10,' Costo Total Proyecto: $'.$costosProyecto['costoProyecto']);
$pdf->Ln();
$pdf->Cell(40,10,' Observaciones Adicionales: '.$costosProyecto['observaciones']);
$pdf->Output();
}
?>