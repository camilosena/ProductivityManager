<?php
session_start();
if (empty($_SESSION['rol']) && empty($_SESSION['id'])) {
    header("location: ../index.php?error=Debe Iniciar Sesión");
} else {
    require_once '../modelo/dao/LoginDAO.php';
    require_once '../facades/FacadeLogin.php';
    require_once '../modelo/utilidades/Conexion.php';
    $facadeLogueado = new FacadeLogin;
    $paginas = $facadeLogueado->seguridadPaginas($_SESSION['rol']);
    $pagActual = 'generarAuditoria.php';
    $total =count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
   if($total==0){
       header("location: ../index.php?error=No posee permisos para acceder a este directorio.");       
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generar Auditoria</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
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
</head>
<body>
   <header>       
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                    <div id="menu">
                        <ul>
                           <?php
                            require_once './Menu.php';
                            $menu = new Menu;
                            $menu->permisosMenu();
                            ?>                
                        </ul>
                    </div>
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
           <nav style="float: right">            
                <ul id="navUser">                    
                    <li><a id="priOpc" title="Opciones de Usuario"><img id="menuUsuario" src="../img/menuUsuario.png"> Opciones</a>
                        <ul>
                            <li id="secOpc"><a href="modificarContrasena.php">Modificar Contraseña</a>                            
                            <li><a href="../controlador/ControladorLogin.php?idCerrar=HastaLuego">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
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
            <div id="canvas-holder">
            <canvas id="chart-area4" width="600" height="300"></canvas>
            <canvas id="chart-area" width="300" height="300"style="display:none"></canvas>
            <canvas id="chart-area2" width="300" height="300" style="margin-left:150px; margin-top:20px"></canvas>
            <canvas id="chart-area3" width="600" height="300" style="display:none"></canvas>
            <script>
                    var pieData = [{value: 40,color:"#0b82e7",highlight: "#0c62ab",label: "Aprobados"},
                                {
                                    value: 16,
                                    color: "#e3e860",
                                    highlight: "#a9ad47",
                                    label: "Rechazos"
                                },
                                {
                                    value: 11,
                                    color: "#eb5d82",
                                    highlight: "#b74865",
                                    label: "Prorrogas"
                                },
                                {
                                    value: 10,
                                    color: "#5ae85a",
                                    highlight: "#42a642",
                                    label: "Solicitudes"
                                },
                                {
                                    value: 8.6,
                                    color: "#e965db",
                                    highlight: "#a6429b",
                                    label: "Cancelados"
                                }
                            ];

                    var barChartData = {
                        labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"],
                        datasets : [
                            {
                                fillColor : "#6b9dfa",
                                strokeColor : "#ffffff",
                                highlightFill: "#1864f2",
                                highlightStroke: "#ffffff",
                                data : [90,30,10,80,15,5,15]
                            },
                            {
                                fillColor : "#e9e225",
                                strokeColor : "#ffffff",
                                highlightFill : "#ee7f49",
                                highlightStroke : "#ffffff",
                                data : [40,50,70,40,85,55,15]
                            }
                        ]

                    }   
                        var lineChartData = {
                            labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"],
                            datasets : [
                                {
                                    label: "Primera serie de datos",
                                    fillColor : "rgba(220,220,220,0.2)",
                                    strokeColor : "#6b9dfa",
                                    pointColor : "#1e45d7",
                                    pointStrokeColor : "#fff",
                                    pointHighlightFill : "#fff",
                                    pointHighlightStroke : "rgba(220,220,220,1)",
                                    data : [90,30,10,80,15,5,15]
                                },
                                {
                                    label: "Segunda serie de datos",
                                    fillColor : "rgba(151,187,205,0.2)",
                                    strokeColor : "#e9e225",
                                    pointColor : "#faab12",
                                    pointStrokeColor : "#fff",
                                    pointHighlightFill : "#fff",
                                    pointHighlightStroke : "rgba(151,187,205,1)",
                                    data : [40,50,70,40,85,55,15]
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
         <hr>
         <br>
           <h2 class="h330">Auditar Proyecto:</h2> <br>
            <form class="formRegistro" method="post" action="../controlador/ControladorAuditorias.php">
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
                        <?php foreach ($proEjecucion as $enEjecucion) {
                                echo '<option value="'.$enEjecucion['idProyecto'].'">'.$enEjecucion['idProyecto'].'-'.$enEjecucion['nombreProyecto'];}?></option>

                    </select>
                    </select>


                <label class="tag2" for="description"><span id="lab_valName" class="h331">Descripción:</span></label>
                <textarea  class="input6" name="descripcion" required type="text" maxlength="64" id="description" class="field1"></textarea>
                <span id="valName" style="color:Red;visibility:hidden;"></span>
                <br>
                <label class="tag" for="txtName"><span id="lab_valName" class="h331">Estado de Producto:</span></label>
                <input type="radio" name="producto" value="Aprobado">Aprobado                
                <input type="radio" name="producto" value="No Conforme">No Conforme              
                <button type="submit" name="crearAuditoria" class="boton-verde">Generar Auditoría</button><br>

            </form>        
           <hr>
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
