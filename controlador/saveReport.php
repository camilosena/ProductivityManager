<?php
   header('Content-Type: text/html; charset=utf-8');
    require_once '../modelo/utilidades/Fpdf/fpdf.php';
    require_once '../modelo/utilidades/Fpdi/fpdi.php';
//Get the base-64 string from data
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);

//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
file_put_contents('img.png', $unencodedData);

//Show the image
//echo '<img src="'.$_POST['img_val'].'" />';
    $pdf = new FPDI();
  $pdf->setSourceFile('TemplateReporte.pdf');
             
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
                 
                 $pdf->Image('img.png', 50, 110, 200);
                 unlink('img.png');
                  $pdf->Ln(155);
                  $pdf->Write(0, utf8_decode("                    Relación de costos anuales sobre proyectos ejecutados con éxito."));
                 $pdf->Output();