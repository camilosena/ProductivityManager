<?php
    require_once '../facades/FacadeProductos.php';
    require_once '../modelo/dao/ProductosDAO.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../modelo/dao/estudioCostosDAO.php';
    require_once '../facades/FacadeProyectos.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/utilidades/EstiloPDF.php';
    require_once '../modelo/utilidades/PDF_HTML.php';
     require_once '../modelo/utilidades/grafico.php';
    $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $facadeEstudioCostos = new FacadeEstudioCostos;
    
if(isset($_GET['estudioPDF'])){
    $costosProyecto = $facadeEstudioCostos->verificaExistenciaEstudio($_GET['estudioPDF']);
    

$pdf=new PDF_HTML();
$pdf->AddPage();

$pdf->SetFont('Arial');
$string =  0;
$pdf->WriteHTML(utf8_decode($string));
$pdf->Output();
}

else if(isset($_GET['exportAudita'])){
    $pdf=new Reporte();//creamos el documento pdf
$pdf->AddPage();//agregamos la pagina
// $pdf->Image('../evidencias/combo3.jpg', 80 ,22, 35 , 38,'JPG');
$pdf->SetFont("Arial","B",16);//establecemos propiedades del texto tipo de letra, negrita, tamaño
session_start();
$venta=array(1=>1,1=>1,1=>1,1=>1,1=>1,1=>1);



$pdf->Cell(0,5,"Auditorias Proyectos",0,0,'C');
$pdf->gaficoPDF($venta,'Auditorias',array(60,52,100,50),'Auditorias Generadas en el Mes');
 $pdf->Ln(74);
$pdf->SetFont('Arial');
$string =  'Reporte de Auditorias Generadas Por Mes Discriminadas en Aprobadas, Plan de Mejoramiento y Para Comite Evaluador';
$pdf->MultiCell(190,10,$string);
$pdf->Output();
    }
?>