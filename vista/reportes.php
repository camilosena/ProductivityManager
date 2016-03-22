<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'reportes';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Reportes</title>
        <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/animate.css">
    <script type="text/javascript" src="../js/html2canvas.js"></script>
    <script type="text/javascript" src="../js/jquery.plugin.html2canvas.js"></script>
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
  
  <div class="container">
    <div class="row"> 
    <span class="animationSandbox">
      <h1 style=" font-size:30px;font-weight: bold;
    text-align: center;
    font-family:sans-serif;   
    color: #83AF44;" class="animated zoomIn">Reportes</h1>
    <a href="#" id="exportarPDFimg" style="display:none;float:right;margin-right: 5%;" onclick="capture();"><img  src="../img/pdf.png" title="Exportar a PDF"></a>
    <br>
    <hr>
    <!--Formulario General-->
      <form id="formTypeReport" rol="form" class="animated fadeInDown">
        <div class="form-group">
         <label for="reportType" >Seleccione el tipo de reporte que desea generar:</label>
        <select name="reportType" id="reportType" class="form-control" required>
            <option value="" disabled selected>Seleccione un Reporte</option>
            <option value="Costos">Costos Anuales Diferidos(Mes)</option>
            <!--<option value="Utilidad">Utilidad Anual Diferido(Mes)</option>-->
            <option value="Proyectos">Cantidad Proyectos (Estados/Anual)</option>
            <!--<option value="Retraso">Retrasos reportados Diferido(Mes)</option>-->
        </select>
        </div>
      </form>
    </div>
  <!--Formulario Costos Anuales-->
     <div class="row"> 
      <?php $actualAnio = date ("Y");?>
      <form id="graficoAnio" method="post" action="../controlador/ControladorReportes" style="display: none;" class="animated fadeInDown">
      <div class="form-group">
         <label for="anio" >Seleccione el año a evaluar:</label>
          <select name="anio" id="anio" class="form-control">
          <?php 
            for ($i=2015; $i <=$actualAnio ; $i++) { ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php 
            }
          ?>
          </select>
        </div>
        <div class="row text-center">
          <button type="submit" name="generarAnio" class="btn btn-success animated zoomIn">Generar Reporte</button>
        </div>
      </form>
    </div>
  <!--Formulario Estado de Proyectos-->
     <div class="row"> 
      <?php $actualAnio = date ("Y");?>
      <form id="graficoProyectos" method="post" action="../controlador/ControladorReportes" style="display: none;" class="animated fadeInDown">
      <div class="form-group">
         <label for="anio" >Seleccione el año a evaluar:</label>
          <select name="anio" id="anio" class="form-control">
          <?php 
            for ($i=2015; $i <=$actualAnio ; $i++) { ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php 
            }
          ?>
          </select>
        </div>
        <div class="row text-center">
          <button type="submit" name="generarProyectos" class="btn btn-success animated zoomIn">Generar Reporte</button>
        </div>
      </form>
    </div>
    <script>
      $( "#reportType" ).change(function() {
        if( $( "#reportType" ).val()=='Costos'){
          $( "#graficoProyectos" ).hide();
          $( "#graficoAnio" ).show();
        }else if( $( "#reportType" ).val()=='Proyectos'){
          $( "#graficoAnio" ).hide();
          $( "#graficoProyectos" ).show();
        }
      });
    </script>

    <?php if(isset($_GET['grAnio'])){ ?>
        <script type="text/javascript">
        var datos = $.ajax({
          url:'../controlador/datosgrafica.php?anioSel=<?php echo $_GET["grAnio"];?>',
          type:'post',
          dataType:'json',
          async:false       
        }).responseText;
        
        datos = JSON.parse(datos);
        google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(dibujarGrafico);
        
          function dibujarGrafico() {
            var data = google.visualization.arrayToDataTable(datos);

            var options = {
              title: 'Costos para Proyectos Finalizados Durante el Año <?php echo $_GET['grAnio'];?>',
              hAxis: {title: 'MESES', titleTextStyle: {color: 'black'}},
              vAxis: {title: 'PESOS COLOMBIANOS', titleTextStyle: {color: '#83AF44'}},
              backgroundColor:'#fff',
              legend:{position: 'bottom', textStyle: {color: 'black', fontSize: 13}},
              width:900,
              height:500
            };

            var grafico = new google.visualization.ColumnChart(document.getElementById('grafica'));
            grafico.draw(data, options);
            var chart_div= document.getElementById('my_div2');
           google.visualization.events.addListener(grafico, 'ready', function () {
            chart_div.innerHTML = '<img src="' + grafico.getImageURI() + '">';
          });

          grafico.draw(data, options);
          }
    </script>
      <div class="row" id="forExport">
        <div id="grafica" style="margin-left: 10%;" class="animated zoomIn"></div>
        <script>$( "#exportarPDFimg" ).show();</script>
    </div>
    <?php } 
    if(isset($_SESSION['estadosProyectos'])){ 
      $cants= array();
    $states= array();
      foreach ($_SESSION['estadosProyectos'] as $estado ) {
        $cants[] = $estado['cantidad'];
        $states[] = $estado['estadoProyecto'];
      }
      unset($_SESSION['estadosProyectos']);
      if(empty($cants)){
          ?>
            <div style="margin-top: 10%;" class="alert alert-info animated rotateInDownRight">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Lo Sentimos</strong> No existen datos para analizar.
          </div>
          <?php
      }else{
        ?>
        <div class="row" id="forExport">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['', ''],
                ['<?php echo $states[0];?>s',    <?php echo $cants[0];?>],
                ['<?php echo $states[1];?>s',     <?php echo $cants[1];?>]
              ]);

              var options = {
                title: 'Relación de Proyectos para el Año <?php echo $_GET['a'];?>',
                is3D: true,
              };

              var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
              chart.draw(data, options);
              var chart_div= document.getElementById('my_div3');
           google.visualization.events.addListener(chart, 'ready', function () {
            chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
          });

          var a = $('#tableStates').html();
          jQuery('#my_div4').append(a);
          chart.draw(data, options);
            }
          </script>
          <div class="col-md-8">
          <script>$( "#exportarPDFimg" ).show();</script>
             <br>
            <div id="piechart_3d" style="width: 900px; height: 500px;" class="animated zoomInUp"></div>
          </div>
          <div class="col-md-4" id="tableStates">
             <br>
                <table class="table table-hover animated fadeInRight">
                    <thead>
                      <tr>
                        <th>Estado Proyecto</th>
                        <th>Cantidad Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $states[0];?></td>
                        <td><?php echo $cants[0];?></td>
                      </tr>
                      <tr>
                        <td><?php echo $states[1];?></td>
                        <td><?php echo $cants[1];?></td>
                      </tr>
                    </tbody>
                  </table>
             </div>
        </div>
          <?php
        }
    } 
    ?>
</div>
            <form method="POST" enctype="multipart/form-data" action="../controlador/saveReport.php" id="myForm1">
                <input type="hidden" name="img_val" id="img_val" value="" />
            </form>
             <script type="text/javascript">
                function capture() {
                    $('#exportarPDFimg').remove();
                    $('#my_div2').show();
                    $('#my_div2').html2canvas({
                        onrendered: function (canvas) {
                            //Set hidden field's value to image data (base-64 string)
                            $('#img_val').val(canvas.toDataURL("image/png"));
                            //Submit the form manually
                            document.getElementById("myForm1").submit();
                        }
                    });
                }
            </script>
<div id="my_div2" class="row" style="display: none;">
    <div class="col-md-8" id="my_div3"></div>
    <div class="col-md-4" id="my_div4"></div>
</div>
  </body>
</html>