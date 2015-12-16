<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'generarAuditoria.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generar Auditoria</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/carouFredSel.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <link rel="stylesheet" href="../js/jquery.dataTables.css">
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/table.js"></script>
    <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
        <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
</head>
<body>
<div id='cssmenu'>
        <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="Change" value="1">  
          <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
      </form>
        <ul>
            <!--   <li><a href='reportes.php'><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a></li> -->
           <li class='active has-sub'><a id="priOpc"><span><i class="fa fa-cog fa-lg fa-spin"></i> Opciones</span></a>
              <ul>
                 <li><a href='modificarContrasena.php'><span><i class="fa fa-key fa-lg"></i> Cambiar Contraseña</span></a>       
                 </li>
                 <li><a id="loadImg" href="javascript:function()"><span><i class="fa fa-picture-o fa-lg"></i> Actualizar Foto</span></a>              
                 </li>
              </ul>
           </li>  
           <li><a href='../controlador/ControladorLogin.php?idCerrar=HastaLuego'><span><i class="fa fa-power-off fa-lg"></i> Cerrar Sesión</span></a></li>     
        </ul>
          <script type="text/javascript">
            //bind click
            $('#loadImg').click(function(event) {
              $('#filein').click();
            });
        </script>
    </div>    
   <header>       
            <div class="wrapper">
            <?php if (isset($_GET['errorPermiso'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["error"]("<?php echo $_GET['errorPermiso']; ?>")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-full-width",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
        <?php } ?>
        </script>
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                            <?php
                            require_once '../modelo/utilidades/Menu.php';
                            $menu = new Menu;
                            $menu->permisosMenu();
                            ?>               
                </nav>
                <ul class="social">
                    <li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
                    <li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
                    <li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
                </ul>
                <div class="logoFoto">
                    <div><img src="../fotos/<?php echo $_SESSION['foto'];?>"></div>
                <p style="text-align:right; font-size:12px; font-family: sans-serif; font-weight:bold; color: white"><br><br><br><br><br>
                    <?php                  
                    echo 'Bienvenido(a) ' . $_SESSION['nombre'];
                    ?>
                </p>
            </div>
        </header>        
        <div class="wrapper">           
    <nav class="migas"><br>
    <span itemscope >
        <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
          <span itemprop="child" itemscope>  
          <a href="listarProyectos.html" title="Ir a Proyectos" itemprop="url">
           <span itemprop="title">Proyectos</span>              
                </a>  > 
            <strong>Generar Auditoria</strong> 
                </span> 
            </span>         
        </nav>      
        <script src="../js/Chart.js"></script>
        <div id="panelIzq"><br>
            <script>
              function printAssessment() {
        window.print();
    }
            </script>
             <div id="exports" style="float:right;padding-bottom:10px;padding-right: 50px">
                 <a href="#" onclick="printAssessment()"> <img src="../img/imprimir.png"></a>
                   <a href="../controlador/ControladorPDF.php?exportAudita=true"> <img src="../img/pdf.png"></div></a>
            <div id="canvas-holder" style="margin-right:80px">
                <canvas id="chart-area2" width="300" height="300" style="margin-left:150px; margin-top:20px"></canvas>
                <canvas id="chart-area3" width="600" height="300" style="display:none"></canvas><br><br><br>
                <canvas id="chart-area4" width="600" height="300"></canvas>
                <canvas id="chart-area" width="300" height="300" style="display:none"></canvas>
                <?php 
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                require_once '../modelo/dao/AuditoriaDAO.php';
                require_once '../facades/FacadeAuditorias.php';
                $auditoria = new FacadeAuditorias();
                $resultado1= $auditoria->cantidadAuditoriasPorEstado("Excelente");
                $resultado2= $auditoria->cantidadAuditoriasPorEstado("Plan de Mejoramiento");
                $resultado3= $auditoria->cantidadAuditoriasPorEstado("Comité Evaluador"); ?>
                <script>
                    var pieData = [{value: <?php echo $resultado1 ?>,color:"#0b82e7",highlight: "#0c62ab",label: "Aprobados"},
                                {
                                    value: <?php echo $resultado2 ?>,
                                    color: "#e3e860",
                                    highlight: "#a9ad47",
                                    label: "Plan de Mejoramiento"
                                },
                                {
                                    value: <?php echo $resultado3 ?>,
                                    color: "#eb5d82",
                                    highlight: "#b74865",
                                    label: "Comité Evaluador"
                                }
                            ];

                    var barChartData = {
                        labels : ["Enero","Marzo","Junio","Agosto","Octubre","Diciembre"],
                        datasets : [
                            {
                                fillColor : "#6b9dfa",
                                strokeColor : "#ffffff",
                                highlightFill: "#1864f2",
                                highlightStroke: "#ffffff",
                                data : [0,0,0]
                            },
                            {
                                fillColor : "#e9e225",
                                strokeColor : "#ffffff",
                                highlightFill : "#ee7f49",
                                highlightStroke : "#ffffff",
                                data : [0,0,0]
                            }
                        ]

                    }   
                        var lineChartData = {
                            labels : ["Enero","Marzo","Junio","Agosto","Octubre","Diciembre"],
                            datasets : [
                                {
                                    label: "Primera serie de datos",
                                    fillColor : "rgba(220,220,220,0.2)",
                                    strokeColor : "#6b9dfa",
                                    pointColor : "#1e45d7",
                                    pointStrokeColor : "#fff",
                                    pointHighlightFill : "#fff",
                                    pointHighlightStroke : "rgba(220,220,220,1)",
                                    data : [0,0,0,0,0,0]
                                },
                                {
                                    label: "Segunda serie de datos",
                                    fillColor : "rgba(151,187,205,0.2)",
                                    strokeColor : "#e9e225",
                                    pointColor : "#faab12",
                                    pointStrokeColor : "#fff",
                                    pointHighlightFill : "#fff",
                                    pointHighlightStroke : "rgba(151,187,205,1)",
                                    data : [0,0,0,0,0,0]
                                }
                            ]

                        }
                var ctx = document.getElementById("chart-area").getContext("2d");
                var ctx2 = document.getElementById("chart-area2").getContext("2d");
                var ctx3 = document.getElementById("chart-area3").getContext("2d");
                var ctx4 = document.getElementById("chart-area4").getContext("2d");
                window.myPie = new Chart(ctx).Pie(pieData); 
                window.myPie = new Chart(ctx2).Doughnut(pieData);               
                window.myPie = new Chart(ctx3).Bar(barChartData, {responsive:true});
                window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
                </script>
            </div>  
            </div>
        <div id="panelDer">
         <span id="fechaActual" style="float:right; margin-right:20px; font-size:12px;font-family:sans-serif;color:#0900FF">
                    <script>
                        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        var f=new Date();
                        document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                    </script>                                      
                </span><br>
         <br>
         <?php
        if (isset($_GET['auditoria'])) {
            echo '<script> 
                Command: toastr["success"]("'.$_GET['auditoria'].'", "Enhorabuena")
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            </script>';
        };
        ?>          
         <br>
         <br>
           <h2 class="h330">Auditar Proyecto:</h2> <hr>
            <form class="formRegistro" method="post" action="../controlador/ControladorAuditorias.php" enctype="multipart/form-data">
                <?php
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                require_once '../modelo/dao/AuditoriaDAO.php';
                require_once '../facades/FacadeAuditorias.php';
                $proyectos = new FacadeProyectos;
                $proEjecucion=$proyectos->proyectoEnEjecucion();
                $auditoria = new FacadeAuditorias();
                $numAuditoria= $auditoria->numeroAditoria();
                ?>


               <label class="tag1" for="numAuditoria"><span id="lab_valSurname" class="h331">Auditoria No:</span></label>
               <input class="input" name="numAuditoria" type="text" value="<?php echo $numAuditoria;?>" maxlength="64" id="numAuditoria" class="field1" style="text-align: center" readonly><br>



                    <label class="tag" for="idProject"><span id="lab_valPhone" class="h331" >Seleccione Id Proyecto:</span></label>
                    <select class="input" name="idProyecto" id="idProject"required class="list_menu_small" autofocus >
                        <?php foreach ($proEjecucion as $enEjecucion)
                        {
                                echo '<option value="'.$enEjecucion['idProyecto'].'">'.$enEjecucion['idProyecto'].'-'.$enEjecucion['nombreProyecto']. '</option>';
                        }
                        ?>
                    </select>

                    <br><br><br>
                <h3>Cumplimiento del Proyecto:</h3><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Ejecución del proyecto:</span></label>
                Si <input  type="radio" name="ejecucion" value="100"  style="display: inline">
                No <input  type="radio" name="ejecucion" value="20"  style="display: inline"><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Ejecución Presupuestal:</span></label>
                Si <input  type="radio" name="presupuesto" value="100"  style="display: inline">
                No <input  type="radio" name="presupuesto" value="20" style="display: inline"><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Utilización de Insumos:</span></label>
                Si <input  type="radio" name="insumos" value="100"  style="display: inline">
                No <input  type="radio" name="insumos" value="20" style="display: inline"><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Calidad de Insumos:</span></label>
                Alta <input  type="radio" name="calidad" value="100"  style="display: inline">
                Normal <input  type="radio" name="calidad" value="65"  style="display: inline">
                Baja <input  type="radio" name="calidad" value="20" style="display: inline"><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Tiempo por Procesos:</span></label>
                Si <input  type="radio" name="procesos" value="100"  style="display: inline">
                No <input  type="radio" name="procesos" value="20" style="display: inline"><br>
                <label class="tag" for="image"><span id="lab_valCompany" class="h331">Cantidad de Empleados:</span></label>
                Concuerda <input  type="radio" name="empleados" value="100"  style="display: inline">
                Menos <input  type="radio" name="empleados" value="20"  style="display: inline">
                Más <input  type="radio" name="empleados" value="65" style="display: inline"><br>
                <label class="tag2" for="image"><span id="lab_valCompany" class="h331">Evidencia:</span></label>
                <input name="uploadedfile" id="image"  type="file" multiple class="file"  title="Solo Foto">
                <label class="tag" for="description"><span id="lab_valName" class="h331">Observaciones:</span></label>
                <textarea  name="descripcion" required  maxlength="64" id="description" class="field1"></textarea>
                <span id="valName" style="color:Red;visibility:hidden;"></span>
                <br>       
                <button type="submit" name="crearAuditoria" class="boton-verde">Evaluar</button><br>
                <hr>
                <script>
                    function archivo(evt) {
                        var files = evt.target.files; // FileList object

                        // Obtenemos la imagen del campo "file".
                        for (var i = 0, f; f = files[i]; i++) {
                            //Solo admitimos imágenes.
                            if (!f.type.match('image.*')) {
                                continue;
                            }

                            var reader = new FileReader();

                            reader.onload = (function (theFile) {
                                return function (e) {
                                    // Insertamos la imagen
                                    document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '" style="height:100px;width: 200px;"/>'].join('');
                                };
                            })(f);

                            reader.readAsDataURL(f);
                        }
                    }

                    document.getElementById('image').addEventListener('change', archivo, false);
                </script>
<!--                <label class="tag" for="txtName"><span id="lab_valName" class="h331">Resultado de la Auditoria:</span></label>
                <input type="text" name="producto"  readonly="" value=""> -->
            </form>                   
        </div>    
    </div>
	<footer class="footer-distributed">
            <div class="footer-left">
                            <span><img src="../img/logoEscala.png" width="210" height="120"></span>
                <p class="footer-links">
                                    <a href="../index.php">Inicio</a>
                    ·
                                        <a href="../nuestrosClientes.html">Clientes</a>
                                        ·
                                        <a href="../index.php">¿Quienes Somos?</a>                   
                    ·
                                        <a href="../contactecnos.html">Contacto</a>
                </p>
                <p class="footer-company-name">Productivity Manager &copy; 2015</p>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>Calle 65 No 13 - 21</span> Bogotá, Colombia</p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>+57 301 5782659</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:productivitymanagersoftware@gmail.com">productivitymanagersoftware@gmail.com</a></p>
                </div>
            </div>
            <div class="footer-right">
                <p class="footer-company-about">
                    <span>Productivity Manager</span>
                    Para aumentar la Productividad es absolutamente necesario incorporar a los mejores trabajadores
                </p>
                <div class="footer-icons">
                                    <a href="https://www.facebook.com/productivitymanager"><img src="../img/facebookFoot.png"></a>
                                    <a href="https://twitter.com/Productivity_Mg"><img src="../img/twitterFoot.png"></a>                 
                                    <a href="mailto:productivitymanagersoftware@gmail.com"></i><img src="../img/gmailFoot.png"></a>
                </div>
            </div>
        </footer> 	
	</body>
</html>
