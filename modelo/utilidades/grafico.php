<?php
require_once("fpdf/fpdf.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_pie.php');
require_once ('jpgraph/src/jpgraph_bar.php');
require_once ("jpgraph/src/jpgraph_pie3d.php");
require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                require_once '../modelo/dao/AuditoriaDAO.php';
                require_once '../facades/FacadeAuditorias.php';
               

class Reporte extends FPDF
{
     public function __construct($orientation='P', $unit='mm', $format='A4')
  {
   parent::__construct($orientation, $unit, $format);
 } 
 function Header()
{
    // Logo
    $this->Image('../img/logo.png',20,8,35);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Productivity Manager',0,0,'C');
    // Salto de línea
    $this->Ln(30);
}
public function gaficoPDF($datos = array(),$nombreGrafico = NULL,$ubicacionTamamo = array(),$titulo = NULL)
 { 
  //construccion de los arrays de los ejes x e y
  if(!is_array($datos) || !is_array($ubicacionTamamo)){
   echo "los datos del grafico y la ubicacion deben de ser arreglos";
  }
  elseif($nombreGrafico == NULL){
   echo "debe indicar el nombre del grafico a crear";
  }
  else{ 
   #obtenemos los datos del grafico  
   foreach ($datos as $key => $value){
   $datax[] = $value[0]; 
    $datay[] = $value[1];
    
    
   } 
   $x = $ubicacionTamamo[0];
   $y = $ubicacionTamamo[1]; 
   $ancho = $ubicacionTamamo[2];  
   $altura = $ubicacionTamamo[3];  
   #Creamos un grafico vacio
  /* $graph = new PieGraph(600,400);
  
   #indicamos titulo del grafico si lo indicamos como parametro
   if(!empty($titulo)){
    $graph->title->Set($titulo);
   }   
   //Creamos el plot de tipo tarta
     
   $p1 = new PiePlot3D($data);
   $p1->SetSliceColors($color);
   #indicamos la leyenda para cada porcion de la tarta
 $p1->SetLegends($nombres);
   $p1->ShowBorder();
   $p1->ExplodeSlice(1);
   //Añadirmos el plot al grafico
   $graph->Add($p1);


   require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
*/

 $auditoria = new FacadeAuditorias();
                $resultado1= $auditoria->cantidadAuditoriasPorEstado("Excelente");
                $resultado2= $auditoria->cantidadAuditoriasPorEstado("Plan de Mejoramiento");
                $resultado3= $auditoria->cantidadAuditoriasPorEstado("Comité Evaluador"); 
// Create the graph. These two calls are always required
$datosy=array($resultado1,$resultado2,$resultado3);
 
// Creamos el grafico
$grafico = new Graph(700,350);
$grafico->SetScale('textlin');
 
// Ajustamos los margenes del grafico-----    (left,right,top,bottom)
$grafico->SetMargin(40,30,30,40);
 
// Creamos barras de datos a partir del array de datos
$bplot = new BarPlot($datosy);
 
// Configuramos color de las barras
$bplot->SetFillColor('green');
 
//Añadimos barra de datos al grafico
$grafico->Add($bplot);
 
// Queremos mostrar el valor numerico de la barra
$bplot->value->Show();
 
// Configuracion de los titulos
$grafico->title->Set('Resultado Auditorias');
$grafico->xaxis->title->Set('Auditorias Realizadas en el MES');
$grafico->yaxis->title->Set('Indicador de Calidad');
 
$grafico->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Se muestra el grafico


$bplot->SetColor("white");
$bplot->SetFillGradient("#83AF44","green",GRAD_LEFT_REFLECTION);
$bplot->SetWidth(45);
$grafico->title->Set($titulo);
   //mostramos el grafico en pantalla
   $grafico->Stroke("$nombreGrafico.png"); 
   $this->Image("$nombreGrafico.png",$x,$y,$ancho,$altura);  
   unlink("$nombreGrafico.png");
  } 
 } 
}



?>