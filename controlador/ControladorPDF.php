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
    $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $facadeEstudioCostos = new FacadeEstudioCostos;
    
if(isset($_GET['estudioPDF'])){
    $costosProyecto = $facadeEstudioCostos->verificaExistenciaEstudio($_GET['estudioPDF']);
    

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$string =  '<table border="1">
  <thead>
  <th>c1</th>
  <th>c3 </th>
</thead>  
<tr>
<td width="200" height="30">'.$costosProyecto['costoManoDeObra'].' </td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">acción</td><td width="200" height="30">cell 4</td>
</tr>
</table>';
$pdf->WriteHTML(utf8_decode($string));
$pdf->Output();
}
?>