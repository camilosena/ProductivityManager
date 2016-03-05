<?php
   /* require_once '../facades/FacadeProductos.php';
    require_once '../modelo/dao/ProductosDAO.php';
    require_once '../modelo/dao/estudioCostosDAO.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/utilidades/EstiloPDF.php';
    require_once '../modelo/utilidades/PDF_HTML.php';*/
    header('Content-Type: text/html; charset=utf-8');
    require_once '../modelo/utilidades/Fpdf/fpdf.php';
    require_once '../modelo/utilidades/Fpdi/fpdi.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../facades/FacadeProyectos.php';
   /* $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $facadeEstudioCostos = new FacadeEstudioCostos;*/
    
/*if(isset($_GET['estudioPDF'])){
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
else */
    if(isset($_GET['exportInfoPy'])){
        $facadeProyecto = new FacadeProyectos();
        $proBasic = $facadeProyecto->consultarProyecto($_GET['proNum']);
        $clie = $facadeProyecto->clienteAsignado($_GET['proNum']);
        $pdf = new FPDI();
         
        // importamos el documento
        $pdf->setSourceFile('TemplateProject.pdf');
         
         // seteamos la fuente, el estilo y el tamano 
        $pdf->SetFont('Times','B',10);
         
        // seteamos la posicion inicial
        $pdf->SetXY(25, 80);
         date_default_timezone_set('America/Bogota');
         setlocale(LC_ALL,"es_ES");
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         //agregamos una pagina
            $pdf->AddPage();
            $pdf->SetFont('Arial');
         // seleccionamos la primera pagina del docuemnto importado
            $tplIdx = $pdf->importPage(1);
         // usamos la pagina importado como template
            $pdf->useTemplate($tplIdx);
         //seteamos la posicion X 
            $pdf->SetX(25);
        //salto de linea
            $pdf->Ln(55.2);
            $pdf->SetFontSize(9);
            $pdf->Write(0, utf8_decode("                                   " . $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')));
            $pdf->Ln(10);
            $pdf->SetFontSize(15);
            $pdf->write(15,'                                                    '.$proBasic["nombreProyecto"]);
            $pdf->Ln(10);
            $pdf->SetFontSize(12);
            $pdf->write(15,'                                                               '.$proBasic["nombreProyecto"]);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$proBasic["fechaInicio"]);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$proBasic["fechaFin"]);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$proBasic["estadoProyecto"]);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$proBasic["ejecutado"].'%');
            $pdf->Ln(5);
            $pdf->write(15,'                                                               '.substr($proBasic["observaciones"], 0, 60));
            $pdf->Ln(12);
            $pdf->SetFontSize(15);
            $pdf->write(15,'                                                  '.$clie['nombreCompania']);
            $pdf->Ln(10);
            $pdf->SetFontSize(12);
            $pdf->write(15,'                                                               '.$clie['nit']);
             $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$clie["telefonoFijo"]);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$clie["telefono"]);
             $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$clie['nombre']);
            $pdf->Ln(6);
            $pdf->write(15,'                                                               '.$clie['email']);
        //enviamos cabezales http para no tener problemas
        header("Content-Transfer-Encoding", "binary");
        header('Cache-Control: maxage=3600'); 
        header('Pragma: public');
         
        //enviamos el documento creado con un nombre nuevo y forzamos su descarga. 'recibos.pdf', 'D'
        $pdf->Output();
        }

?>