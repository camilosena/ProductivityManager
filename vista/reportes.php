<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
    	var datos = $.ajax({
    		url:'../controlador/datosgrafica.php',
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
  </head>
  <body>
    <div id="grafica"></div>
 <!--   <img src="https://chart.googleapis.com/chart?cht=p3&chs=400x200&chd=t:60,30,10&chl=Cafe|Cigarro|Ron&chco=0072c6|ef3886|ff9900&chtt=Mi+consumo+de+cafe,+cigarro+y+ron" width="400" height="200" alt="">-->

  </body>
</html>