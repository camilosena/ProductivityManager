<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'informacionProyecto';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Información de Proyecto</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jspdf.min.js"></script>
    <link href="../js/toastr.css" rel="stylesheet"/>
    <script src="../js/toastr.js"></script>
    <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../css/colorbox.css">
    <script src="../js/modalJS.min.js"></script>
    <script src="../js/jquery.colorbox.js"></script>
    <script src="../js/scriptModales.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/infoProject.css">
      <script type="text/javascript" src="../js/tableexport.js"></script>
    <script type="text/javascript" src="../js/jspdf.plugin.addimage.js"></script>
     <script type="text/javascript" src="../js/jspdf.plugin.cell.js"></script>
      <script type="text/javascript" src="../js/jspdf.plugin.from_html.js"></script>
       <script type="text/javascript" src="../js/jspdf.plugin.split_text_to_size.js"></script>
          <script type="text/javascript" src="../js/jspdf.plugin.standard_fonts_metrics.js"></script>
             <script type="text/javascript" src="../js/FileSaver.js"></script>
</head>
<body oncontextmenu="return false" onkeydown="checkData(event)">
    <script>
 function checkData(e) {
      if(e.shiftKey) {
        return false;
      }
      if(e.ctrlKey) {
        return false;
      }
      if(e.altKey) {
        return false;
      }
    };
    </script>
<script>
     window.onunload = function(){
            window.opener.location = 'listarProyectos';};
</script>
<div id="todoProyecto" class="wrapper">
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
<div id="editor"></div>
    <!--<script type="text/javascript">
               var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            function exportPDF() {
            var doc = new jsPDF();
            doc.setFontSize(30);
            doc.setTextColor(100);
doc.text(35, 25, 'Reporte Proyecto<?php //echo  $_GET["nameProject"]; ?>');

        doc.fromHTML($('#contenidoProyecto').html(), 15, 15, {
            'width': 170,'elementHandlers': specialElementHandlers
        });
        doc.save('ReporteProyecto <?php// echo  $_GET["nameProject"]; ?>.pdf');
            };

            function exportExcel(){
               window.open('data:application/vnd.ms-excel;charset=UTF-8,' + encodeURIComponent($('#contenidoProyecto').html()));
e.preventDefault();
            }
             function printAssessment() {
        window.print();
    }
    </script>-->
    <script type="text/javascript">
        function printAssessment(){
          var objeto=document.getElementById('contenidoProyecto');  //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }
    </script>
    <style type="text/css" media="print">
@media print {
    #contenidoProyecto{
        font-size: 10px;
    }
}
</style>
    <?php if (isset($_GET['projectNum'])) { ?>

    <h2 class="h330"><br>Proyecto <?php echo  $_GET['nameProject']; ?>:</h2><br>
        <hr>
        <div id="exports" style="float:right;padding-bottom:10px;margin-right: 15%">
                    <a href="#" onclick="printAssessment()"><img src="../img/imprimir.png"></a>
                   <!-- <img src="../img/email.png">  -->
                   <!-- <a href="#" onclick="exportExcel()"><img src="../img/excel.png"></a>-->
                    <a href="../controlador/ControladorPDF.php?exportInfoPy=true&proNum=<?php echo $_GET['projectNum']; ?>" onclick="exportPDF()"><img  src="../img/pdf.png" title="Exportar a PDF"></a></div>
            </div>  
            <div id="contenidoProyecto">
        <div>
            <?php
            require_once '../facades/FacadeProductos.php';
    require_once '../modelo/dao/ProductosDAO.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../modelo/dao/EstudioCostosDAO.php';
    require_once '../facades/FacadeProyectos.php';
    require_once '../facades/FacadeEstudioCostos.php';
    require_once '../modelo/utilidades/Conexion.php';
    $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $facadeEstudioCostos = new FacadeEstudioCostos;
            //  Consultar Proyecto
            if (isset($_GET['projectNum'])) {
                $proyectos = $facadeProyecto->consultarProyecto($_GET['projectNum']);
                if($proyectos['fechaFin']!='0000-00-00'){ $finalDefinida = $proyectos['fechaFin'];}else{$finalDefinida='';}
                echo '<div id="infoPro">';
                echo '<table id="muestraDatos"><tr><th colspan="2">Información de Proyecto</th></tr>';
                echo '<tr><td class="enunciado">Código:</td><td>0' . $proyectos['idProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $proyectos['nombreProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Inicio:</td><td>' . $proyectos['fechaInicio'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Fin:</td><td> ' . $finalDefinida . '</td></tr>';
                echo '<tr><td class="enunciado">Estado:</td><td>' . $proyectos['estadoProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Ejecutado:</td><td>' . $proyectos['ejecutado'] . '%</td></tr>';
                echo '<tr><td class="enunciado">Observaciones:</td><td>' . $proyectos['observaciones'] . '</td></tr>';
                $comi = "'";
                if ($proyectos['estadoProyecto'] != 'Ejecución' &&$proyectos['estadoProyecto'] != 'Espera' && $proyectos['ejecutado'] < 100 && $proyectos['estadoProyecto']!='Cancelado') {
                    echo '<tr><td class="enunciado">Opciones:</td><td>';
                    echo '<a class="me" title="Modificar Proyecto"href="javascript:modificarProyecto(' . $comi . 'modificarProyecto?idProject='. $proyectos['idProyecto'] . $comi . ');"><img class="iconos" src="../img/modify.png"></a>';
                }
                if ($proyectos['estadoProyecto'] == 'Sin Estudio Costos') {
                    echo '<a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos(' . $comi . 'estudioDeCostos?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/costos.png"></a>';
                } elseif ($proyectos['estadoProyecto'] == 'Sin Producción') {
                    echo '<a class="me" title="Incluir Producción" href="javascript:produccionProyecto(' . $comi . 'produccionProyecto?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/products.png"></a>';

                }
                require_once '../modelo/utilidades/Conexion.php';
                $facadeProyecto = new FacadeProyectos;
                $clie = $facadeProyecto->clienteAsignado($proyectos['idProyecto']);
                echo '</table>';
                echo '</div><div id="infoClient">';
                echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Cliente</th></tr>';
                echo '<tr><td class="enunciado">Código:</td><td>0' . $clie['idCliente'] . '</td></tr>';
                echo '<tr><td class="enunciado">Empresa:</td><td>' . $clie['nombreCompania'] . '</td></tr>';
                echo '<tr><td class="enunciado">NIT:</td><td>' . $clie['nit'] . '</td></tr>';
                echo '<tr><td class="enunciado">Sector Empresarial:</td><td>' . $clie['sectorEmpresarial'] . '</td></tr>';
                echo '<tr><td class="enunciado">Sector Económico:</td><td>' . $clie['sectorEconomico'] . '</td></tr>';
                echo '<tr><td class="enunciado">PBX:</td><td>' . $clie['telefonoFijo'] . '</td></tr>';
                echo '<tr><th colspan="2">Representante Legal</th></tr>';
                echo '<tr><td class="enunciado">Identificación:</td><td> ' . $clie['identificacion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $clie['nombre'] . '</td></tr>';
                echo '<tr><td class="enunciado">Dirección:</td><td>' . $clie['direccion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Teléfono:</td><td>' . $clie['telefono'] . '</td></tr>';
                echo '<tr><td class="enunciado">Correo Electronico:</td><td>' . $clie['email'] . '</td></tr>';
                echo '</table>';
                echo '</div><div id="infoGere">';
                $pro = $facadeProyecto->gerenteDeProyecto($proyectos['idProyecto']);
                echo '<table id="muestraDatos"><tr><th colspan="2">Gerente Encargado</th></tr>';
                echo '<tr><td class="enunciado">Código Gerente:</td><td>0' . $pro['idUsuario'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $pro['nombre'] . '</td></tr>';
                echo '<tr><td class="enunciado">Dirección:</td><td>' . $pro['direccion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Teléfono:</td><td> ' . $pro['telefono'] . '</td></tr>';
                echo '<tr><td class="enunciado">Email:</td><td>' . $pro['email'] . '</td></tr>';
                echo '<tr><td class="enunciado">Área:</td><td>' . $pro['nombreArea'] . '</td></tr>';
                echo '</table>';
                echo '</div>';
            }
            ?>
        </div>
        </div>
    <?php
    $products = $facadeProyecto->obtenerDatoProductoProyecto($_GET['projectNum']);
    if(count($products)>=1){?>
        <div >
        <br><br>
            <strong><h2 class="h331" style="margin-left:14%;">Productos Requeridos:</h2></strong><br>
            <table class="tableSection">
                <thead>
                <tr>
                    <th class="th1"><span class="text">Código</span>
                    </th>
                    <th class="th2"><span class="text">Nombre</span>
                    </th>
                    <th class="th3"><span class="text">Cantidad</span>
                    </th>
                    <th class="th4"><span class="text">Ganancia</span>
                    </th>
                    <th class="th5"><span class="text">Visualizar</span>
                    </th>
                </tr>
                </thead>
                <tbody>
               <?php
                foreach ($products as $productos) {
                    if($productos['cantidadProductos']!=0){
                    ?>
                    <tr>
                        <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                        <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                        <td class="td3"><?php echo $productos['cantidadProductos']; ?></td>
                        <td class="td4"><?php echo $productos['ganancia']; ?>%</td>
                        <td class="td5"><a class='group1' href="../productos/<?php echo $productos['fotoProducto']; ?>"
                                           title="Click En Siguiente"><img src="../img/products.png" width="20"
                                                                           height="20"></td>
                    </tr>
                <?php } }
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php
             require_once '../facades/FacadeInsumos.php';
             require_once '../modelo/dao/InsumosDAO.php';
            if($proyectos['estadoProyecto']=='Ejecución' || $proyectos['estadoProyecto']=='Espera' || $proyectos['estadoProyecto']=='Finalizado'){
                echo '<div id="infoGere">';
                $relacionMateria = new facadeInsumos();
                $relacionMateria = $relacionMateria->relacionMateriaPrimaProyecto($proyectos['idProyecto']);
                 echo '<table id="muestraDatos"><tr><th colspan="2" style="background:#fff;color:#000;border:none;">Relación de Materia Prima</th></tr>';
                foreach ($relacionMateria as $rMateria) {
                    echo '<tr><th colspan="2">Materia Prima Código 0'. $rMateria['idMateriaPrima'].' </th></tr>';
                   echo '<tr><td class="enunciado">Nombre: </td><td> ' . $rMateria['descripcionMateria'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Unidad / Medida:</td><td> ' . $rMateria['unidadDeMedida'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Costo Total:</td><td> $' . $rMateria['valorTotal'] . '</td></tr>';
                }
                echo '</table>';
                echo '</div>';
                }
            ?>
        </div>
        <div>
            <?php
                require_once '../modelo/dao/ProcesosDAO.php';
                require_once '../facades/FacadeProcesos.php';
            if($proyectos['estadoProyecto']=='Ejecución' || $proyectos['estadoProyecto']=='Espera' || $proyectos['estadoProyecto']=='Finalizado'){
                echo '<div id="infoGere">';
                $relacionProcesos = new facadeProcesos();
                $relacionProcesos = $relacionProcesos->relacionProcesosProyecto($proyectos['idProyecto']);
                 echo '<table id="muestraDatos"><tr><th colspan="2" style="background:#fff;color:#000;border:none;">Relación de Procesos</th></tr>';
                foreach ($relacionProcesos as $rProceso) {
                    echo '<tr><th colspan="2">Proceso Código 0'. $rProceso['idProceso'].' </th></tr>';
                   echo '<tr><td class="enunciado">Nombre: </td><td> ' . $rProceso['tipoProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Cantidad Empleados / Medida:</td><td> ' . $rProceso['totalEmpleadosProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Total Horas:</td><td>' . $rProceso['totalTiempoProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Costo Total:</td><td> $' . $rProceso['totalPrecioProceso'] . '</td></tr>';
                }
                echo '</table>';
                echo '</div>';
                }
            ?>
        </div>
        <div>
            <?php
            if($proyectos['estadoProyecto']=='Ejecución' || $proyectos['estadoProyecto']=='Espera' || $proyectos['estadoProyecto']=='Finalizado'){
                echo '<div id="infoGere">';
                $costosProyecto = $facadeEstudioCostos->verificaExistenciaEstudio($proyectos['idProyecto']);
                echo '<table id="muestraDatos"><tr><th colspan="2">Relación Total de Costos</th></tr>';
                echo '<tr><td class="enunciado">Mano de Obra:</td><td>$ ' . $costosProyecto['costoManoDeObra'] . '</td></tr>';
                echo '<tr><td class="enunciado">Materia Prima :</td><td>$ ' . $costosProyecto['costoProduccion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Utilidad:</td><td>$ ' . $costosProyecto['utilidad'] . '</td></tr>';
                echo '<tr><td class="enunciado">Tiempo Estimado (Horas):</td><td> ' . $costosProyecto['tiempoEstimado'] . '</td></tr>';
                echo '<tr><td class="enunciado">Empleados Solicitados:</td><td> ' . $costosProyecto['totalTrabajadores'] . '</td></tr>';
                echo '<tr><td class="enunciado">Total Proyecto:</td><td>$ ' . $costosProyecto['costoProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Observaciones:</td><td>' . $costosProyecto['observaciones'] . '</td></tr>';
                echo '</table>';
                echo '</div>';
                }
            ?>
            
        </div>
 
    <?php }?>
    <?php 
            $facadeProyecto = new FacadeProyectos;
            $emplea = $facadeProyecto->obtenerEmpleadosPro($_GET['projectNum']);
            if(empty($emplea)){
            ?>
            <div id="infoGere">
                <h4>No existen empleados asociados al proyecto.</h4>
            </div>
            <?php
            }else{
     ?>
        <div id="infoGere">
             <table class="tableSection">
                <thead>
                <tr>
                    <th class="th1"><span class="text">Código</span>
                    </th>
                    <th class="th2"><span class="text">Nombre</span>
                    </th>
                    <th class="th3"><span class="text">E-mail</span>
                    </th>
                    <th class="th5"><span class="text">Área</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($emplea as $empleado) { ?>
                <tr>
                    <td class="td1">0<?php echo $empleado['idUsuario']; ?></td>
                    <td class="td2"><?php echo $empleado['nombre']; ?></td>
                    <td class="td3"><?php echo $empleado['email']; ?></td>
                    <td class="td5"><?php echo $empleado['nombreArea']; ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
        <hr>
    <script language=javascript>
        function modificarProyecto(URL) {
            window.open(URL, "modificarProyecto", "width=1180,height=645,top=30,left=25,scrollbars=NO");
        }
    </script>
    <script language=javascript>
        function estudioCostos(URL) {
            window.open(URL, "estudioDeCostos", "width=1000,height=645,top=30,left=150,scrollbars=NO");
        }
    </script>
    <script language=javascript>
        function produccionProyecto(URL) {
            window.open(URL, "produccionProyecto", "width=1000,height=645,top=30,left=150,scrollbars=NO");
        }
    </script>
</div>
<?php }
?>
</body>
</html>
