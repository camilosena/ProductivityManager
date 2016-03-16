<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <body>
  
  <div class="container">
    <div class="row"> 
      <h1 style=" font-size:30px;font-weight: bold;
    text-align: center;
    font-family:sans-serif;   
    color: #83AF44;">Reportes</h1>
      <form id="formTypeReport" rol="form">
        <div class="form-group">
         <label for="reportType" >Seleccione el tipo de reporte que desea generar:</label>
        <select name="reportType" id="reportType" class="form-control" required>
            <option value="" disabled selected>Seleccione un Reporte</option>
            <option value="Costos">Costos Anuales Diferidos(Mes)</option>
            <option value="Utilidad">Utilidad Anual Diferido(Mes)</option>
            <option value="Proyectos">Cantidad Proyectos Diferido(Estado/Mes)</option>
            <option value="Retraso">Retrasos reportados Diferido(Mes)</option>
        </select>
        </div>
      </form>
    </div>

     <div class="row"> 
      <?php $actualAnio = date ("Y");?>
      <form id="graficoAnio" method="post" action="../controlador/ControladorReportes.php" style="display: none;">
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
        <button type="submit" name="generarAnio" class="btn btn-success">Generar Reporte</button>
      </form>
    </div>

    <script>
      $( "#reportType" ).change(function() {
        if( $( "#reportType" ).val()=='Costos'){
          $( "#graficoAnio" ).show();
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
              title: 'Costos Proyectos Finalizados Durante el Año',
              hAxis: {title: 'MESES', titleTextStyle: {color: 'black'}},
              vAxis: {title: 'PESOS COLOMBIANOS', titleTextStyle: {color: '#83AF44'}},
              backgroundColor:'#ffffcc',
              legend:{position: 'bottom', textStyle: {color: 'black', fontSize: 13}},
              width:900,
              height:500
            };

            var grafico = new google.visualization.ColumnChart(document.getElementById('grafica'));
            grafico.draw(data, options);
          }
    </script>
    <div class="row"> 
        <div id="grafica"></div>
    </div>
    <?php } ?>
   <!--   <img src="https://chart.googleapis.com/chart?cht=p3&chs=400x200&chd=t:60,30,10&chl=Cafe|Cigarro|Ron&chco=0072c6|ef3886|ff9900&chtt=Mi+consumo+de+cafe,+cigarro+y+ron" width="400" height="200" alt="">-->
</div>
  </body>
</html>