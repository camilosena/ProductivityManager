<?php

    header('Content-Type: text/html; charset=utf-8');
    require_once '../modelo/dao/EstudioCostosDAO.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/utilidades/Fpdf/fpdf.php';
    require_once '../modelo/utilidades/Fpdi/fpdi.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../facades/FacadeProyectos.php';
   
    if(isset($_GET['exportInfoPy'])){
        $facadeProyecto = new FacadeProyectos();
        $facadeEstudioCostos = new FacadeEstudioCostos();
        $proBasic = $facadeProyecto->consultarProyecto($_GET['proNum']);
        $clie = $facadeProyecto->clienteAsignado($_GET['proNum']);
        $pdf = new FPDI();
         
           if($proBasic["estadoProyecto"]=='Sin Producción'){

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
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["nombreProyecto"]));
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaInicio"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaFin"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["estadoProyecto"]));
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
          /*  header("Content-Transfer-Encoding", "binary");
            header('Cache-Control: maxage=3600'); 
            header('Pragma: public');*/
             
            //enviamos el documento creado con un nombre nuevo y forzamos su descarga. 'recibos.pdf', 'D'
            $pdf->Output();
            }
            else if($proBasic["estadoProyecto"]=='Sin Estudio Costos'){

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
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["nombreProyecto"]));
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaInicio"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaFin"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["estadoProyecto"]));
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

                $products = $facadeProyecto->obtenerDatoProductoProyecto($_GET['proNum']);
                $pdf->Ln(15);
                 $pdf->SetFontSize(15);
                  $pdf->SetFont('Arial','B');
                  $pdf->write(15,'             Productos Solicitados:');
                   $pdf->SetFontSize(11);
                   if(!empty($products)){
                    $pdf->Ln(12);
                    $pdf->write(15,'                     '.utf8_decode('Código     ').'Nombre Producto      '.'Cantidad      '.'% Ganancia     '.'IVA    ');
                    $j = 200;
                    foreach ($products as $productos) {
                        $pdf->Ln(8);
                            if($productos['cantidadProductos']!=0){
                                $pdf->SetTextColor(97,97,97);
                                $pdf->SetXY(35, $j);
                                $pdf->Write(0, $productos['idProductos']);
                                $pdf->SetXY(53, $j);
                                $pdf->Write(0, $productos['nombreProducto']);
                                $pdf->SetXY(91, $j);
                                $pdf->Write(0, $productos['cantidadProductos'].'/Uni.');
                                $pdf->SetXY(115, $j);
                                $pdf->Write(0, $productos['ganancia'].'%');
                                $pdf->SetXY(141, $j);
                                $pdf->Write(0, $productos['iva']);
                                $j=$j+6;
                                }
                        }
                   }
               
            //enviamos cabezales http para no tener problemas
           /* header("Content-Transfer-Encoding", "binary");
            header('Cache-Control: maxage=3600'); 
            header('Pragma: public');*/
             
            //enviamos el documento creado con un nombre nuevo y forzamos su descarga. 'recibos.pdf', 'D'
            $pdf->Output();
            
            }else if($proBasic["estadoProyecto"]=='Espera' || $proBasic["estadoProyecto"]=='Finalizado' || $proBasic["estadoProyecto"]=='Ejecución'){

            // importamos el documento
            $pdf->setSourceFile('TemplateProduccion.pdf');
             
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
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["nombreProyecto"]));
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaInicio"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.$proBasic["fechaFin"]);
                $pdf->Ln(6);
                $pdf->write(15,'                                                               '.utf8_decode($proBasic["estadoProyecto"]));
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
                $costosProyecto = $facadeEstudioCostos->verificaExistenciaEstudio($_GET['proNum']);

                $pdf->Ln(22);
                 $pdf->write(15,'                                                               $ '.$costosProyecto['costoManoDeObra'] );
                $pdf->Ln(6);
                 $pdf->write(15,'                                                               $ '.$costosProyecto['costoProduccion'] );
                 $pdf->Ln(6);
                 $pdf->write(15,'                                                               $ '.$costosProyecto['utilidad'] );
                 $pdf->Ln(6);
                 $pdf->write(15,'                                                                '.$costosProyecto['totalTrabajadores'] );
                 $pdf->Ln(6);
                 $pdf->write(15,'                                                                '.$costosProyecto['tiempoEstimado'].' Horas' );
                $pdf->SetFont('Arial','B');
                 $pdf->write(15,'                        Costo Total: $ '. $costosProyecto['costoProyecto'] );
               $pdf->SetFont('Arial');
                $pdf->Ln(6);
                 $pdf->write(15,'                                                                '.substr($costosProyecto["observaciones"], 0, 60));
    
                $products = $facadeProyecto->obtenerDatoProductoProyecto($_GET['proNum']);
                $pdf->Ln(10);
                 $pdf->SetFontSize(15);
                  $pdf->SetFont('Arial','B');
                  $pdf->write(15,'             Productos Solicitados:');
                   $pdf->SetFontSize(11);
                   if(!empty($products)){
                    $pdf->Ln(9);
                    $pdf->write(15,'                     '.utf8_decode('Código     ').'Nombre Producto      '.'Cantidad      '.'% Ganancia     '.'IVA    ');
                    $j = 244;
                    foreach ($products as $productos) {
                        $pdf->Ln(8);
                            if($productos['cantidadProductos']!=0){
                                $pdf->SetTextColor(97,97,97);
                                $pdf->SetXY(35, $j);
                                $pdf->Write(0, $productos['idProductos']);
                                $pdf->SetXY(53, $j);
                                $pdf->Write(0, $productos['nombreProducto']);
                                $pdf->SetXY(91, $j);
                                $pdf->Write(0, $productos['cantidadProductos'].'/Uni.');
                                $pdf->SetXY(115, $j);
                                $pdf->Write(0, $productos['ganancia'].'%');
                                $pdf->SetXY(141, $j);
                                $pdf->Write(0, $productos['iva']);
                                $j=$j+6;
                                }
                        }
                   }
               
            //enviamos cabezales http para no tener problemas
          /*  header("Content-Transfer-Encoding", "binary");
            header('Cache-Control: maxage=3600'); 
            header('Pragma: public');*/
             
            //enviamos el documento creado con un nombre nuevo y forzamos su descarga. 'recibos.pdf', 'D'
            $pdf->Output();
            }
        }

?>