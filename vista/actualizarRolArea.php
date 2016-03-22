<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'actualizarRolArea';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Actualizar Rol / Área Usuario</title>
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
        <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
         <script>
            $(document).ready(function () {
                $("#selectrol").on("change", function () {
                    $.ajax({
                        url: "../peticiones_ajax/ajax_listar_areas.php",
                        method: "POST",
                        data: {
                            idRolSelected: $(this).val(),
                            accion: "listarAreas"
                        },
                        success: function (data) {
                            $("#selectArea").html(data);
                        },
                        error: function (error) {
                            alert(error);
                        }
                    });
                    //alert($(this).val());
                });
            });
        </script>
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
     <div id='cssmenu'>
        <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="Change" value="1">  
          <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
      </form>
         <?php 
     require_once '../modelo/utilidades/browser.php';
        $browser = new browser();
        $navegador = $browser->getBrowser($_SERVER['HTTP_USER_AGENT']);
          if($navegador!='Google Chrome' && $navegador!='Safari'){
          ?>
           <script language="JavaScript" type="text/javascript">
                    window.onload = function () {
                        Command: toastr["error"]("<?php echo 'Esta utilizando '.$navegador.'<br> Para una correcta visualización utilice Google Chrome o Safai' ?>")

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
                            "timeOut": "9000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
            </script>
          <?php } ?>      
  
        <ul>

       <?php if ($_SESSION['rol'] == 'Administrador'){ ?>
          <li><a href="javascript:backup('backup')"><span><i class="fa fa-database fa-lg"></i> BackUp</span></a>
            <script language=javascript>
            function backup(URL) {
                window.open(URL, "backup", "width=1190,height=645,top=30,left=30,scrollbars=NO");
            }
           </script> 
           </li> 
      <?php } ?>

    <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador'){ ?>

          <li><a href="javascript:reporte('reportes')"><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a>
            <script language=javascript>
            function reporte(URL) {
                window.open(URL, "reportes", "width=1200,height=645,top=30,left=30,scrollbars=NO");
            }
           </script> 
           </li> 
      <?php } ?>
           <li class='active has-sub'><a id="priOpc"><span><i class="fa fa-cog fa-lg fa-spin"></i> Opciones</span></a>
              <ul>
                 <li><a href='modificarContrasena'><span><i class="fa fa-key fa-lg"></i> Cambiar Contraseña</span></a>       
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
                <a href="listarProyectos"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
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
            <nav class="migas"><br>
                <span itemscope >
                    <a href="listarProyectos" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="listarUsuarios" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Usuarios</span>              
                        </a>  > 
                        <a href="listarUsuarios" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Listar Usuarios</span>              
                        </a>  > 
                        <strong>Actualizar Rol / Área de <?php
                            require_once '../modelo/dto/UsuarioDTO.php';
                            require_once '../modelo/dao/UsuarioDAO.php';
                            require_once '../facades/FacadeUsuarios.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeUsuario = new FacadeUsuarios;
                            $usuario = $facadeUsuario->consultarUsuario($_GET['id']);
                            echo $usuario['rol'];
                            ?>
                        </strong> 
                    </span> 
                </span>         
            </nav>
            <div id="panelIzq">
                <script>
                    // Run the code when the DOM is ready
                    $(pieChart);
                    function pieChart() {

                        // Config settings
                        var chartSizePercent = 55;                        // The chart radius relative to the canvas width/height (in percent)
                        var sliceBorderWidth = 1;                         // Width (in pixels) of the border around each slice
                        var sliceBorderStyle = "#fff";                    // Colour of the border around each slice
                        var sliceGradientColour = "#ddd";                 // Colour to use for one end of the chart gradient
                        var maxPullOutDistance = 25;                      // How far, in pixels, to pull slices out when clicked
                        var pullOutFrameStep = 4;                         // How many pixels to move a slice with each animation frame
                        var pullOutFrameInterval = 40;                    // How long (in ms) between each animation frame
                        var pullOutLabelPadding = 65;                     // Padding between pulled-out slice and its label  
                        var pullOutLabelFont = "bold 16px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice label font
                        var pullOutValueFont = "bold 12px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice value font
                        var pullOutValuePrefix = "";                     // Pull-out slice value prefix
                        var pullOutShadowColour = "rgba( 0, 0, 0, .5 )";  // Colour to use for the pull-out slice shadow
                        var pullOutShadowOffsetX = 5;                     // X-offset (in pixels) of the pull-out slice shadow
                        var pullOutShadowOffsetY = 5;                     // Y-offset (in pixels) of the pull-out slice shadow
                        var pullOutShadowBlur = 5;                        // How much to blur the pull-out slice shadow
                        var pullOutBorderWidth = 2;                       // Width (in pixels) of the pull-out slice border
                        var pullOutBorderStyle = "#333";                  // Colour of the pull-out slice border
                        var chartStartAngle = -.5 * Math.PI;              // Start the chart at 12 o'clock instead of 3 o'clock

                        // Declare some variables for the chart
                        var canvas;                       // The canvas element in the page
                        var currentPullOutSlice = -1;     // The slice currently pulled out (-1 = no slice)
                        var currentPullOutDistance = 0;   // How many pixels the pulled-out slice is currently pulled out in the animation
                        var animationId = 0;              // Tracks the interval ID for the animation created by setInterval()
                        var chartData = [];               // Chart data (labels, values, and angles)
                        var chartColours = [];            // Chart colours (pulled from the HTML table)
                        var totalValue = 0;               // Total of all the values in the chart
                        var canvasWidth;                  // Width of the canvas, in pixels
                        var canvasHeight;                 // Height of the canvas, in pixels
                        var centreX;                      // X-coordinate of centre of the canvas/chart
                        var centreY;                      // Y-coordinate of centre of the canvas/chart
                        var chartRadius;                  // Radius of the pie chart, in pixels

                        // Set things up and draw the chart
                        init();

                        /**
                         * Set up the chart data and colours, as well as the chart and table click handlers,
                         * and draw the initial pie chart
                         */

                        function init() {

                            // Get the canvas element in the page
                            canvas = document.getElementById('chart');

                            // Exit if the browser isn't canvas-capable
                            if (typeof canvas.getContext === 'undefined')
                                return;

                            // Initialise some properties of the canvas and chart
                            canvasWidth = canvas.width;
                            canvasHeight = canvas.height;
                            centreX = canvasWidth / 2;
                            centreY = canvasHeight / 2;
                            chartRadius = Math.min(canvasWidth, canvasHeight) / 2 * (chartSizePercent / 100);

                            // Grab the data from the table,
                            // and assign click handlers to the table data cells

                            var currentRow = -1;
                            var currentCell = 0;

                            $('#chartData td').each(function () {
                                currentCell++;
                                if (currentCell % 2 != 0) {
                                    currentRow++;
                                    chartData[currentRow] = [];
                                    chartData[currentRow]['label'] = $(this).text();
                                } else {
                                    var value = parseFloat($(this).text());
                                    totalValue += value;
                                    value = value.toFixed(2);
                                    chartData[currentRow]['value'] = value;
                                }

                                // Store the slice index in this cell, and attach a click handler to it
                                $(this).data('slice', currentRow);
                                $(this).click(handleTableClick);

                                // Extract and store the cell colour
                                if (rgb = $(this).css('color').match(/rgb\((\d+), (\d+), (\d+)/)) {
                                    chartColours[currentRow] = [rgb[1], rgb[2], rgb[3]];
                                } else if (hex = $(this).css('color').match(/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/)) {
                                    chartColours[currentRow] = [parseInt(hex[1], 16), parseInt(hex[2], 16), parseInt(hex[3], 16)];
                                } else {
                                    alert("Error: Colour could not be determined! Please specify table colours using the format '#xxxxxx'");
                                    return;
                                }

                            });

                            // Now compute and store the start and end angles of each slice in the chart data

                            var currentPos = 0; // The current position of the slice in the pie (from 0 to 1)

                            for (var slice in chartData) {
                                chartData[slice]['startAngle'] = 2 * Math.PI * currentPos;
                                chartData[slice]['endAngle'] = 2 * Math.PI * (currentPos + (chartData[slice]['value'] / totalValue));
                                currentPos += chartData[slice]['value'] / totalValue;
                            }

                            // All ready! Now draw the pie chart, and add the click handler to it
                            drawChart();
                            $('#chart').click(handleChartClick);
                        }

                        /**
                         * Process mouse clicks in the chart area.
                         *
                         * If a slice was clicked, toggle it in or out.
                         * If the user clicked outside the pie, push any slices back in.
                         *
                         * @param Event The click event
                         */

                        function handleChartClick(clickEvent) {

                            // Get the mouse cursor position at the time of the click, relative to the canvas
                            var mouseX = clickEvent.pageX - this.offsetLeft;
                            var mouseY = clickEvent.pageY - this.offsetTop;

                            // Was the click inside the pie chart?
                            var xFromCentre = mouseX - centreX;
                            var yFromCentre = mouseY - centreY;
                            var distanceFromCentre = Math.sqrt(Math.pow(Math.abs(xFromCentre), 2) + Math.pow(Math.abs(yFromCentre), 2));

                            if (distanceFromCentre <= chartRadius) {

                                // Yes, the click was inside the chart.
                                // Find the slice that was clicked by comparing angles relative to the chart centre.

                                var clickAngle = Math.atan2(yFromCentre, xFromCentre) - chartStartAngle;
                                if (clickAngle < 0)
                                    clickAngle = 2 * Math.PI + clickAngle;

                                for (var slice in chartData) {
                                    if (clickAngle >= chartData[slice]['startAngle'] && clickAngle <= chartData[slice]['endAngle']) {

                                        // Slice found. Pull it out or push it in, as required.
                                        toggleSlice(slice);
                                        return;
                                    }
                                }
                            }

                            // User must have clicked outside the pie. Push any pulled-out slice back in.
                            pushIn();
                        }


                        function handleTableClick(clickEvent) {
                            var slice = $(this).data('slice');
                            toggleSlice(slice);
                        }


                        function toggleSlice(slice) {
                            if (slice == currentPullOutSlice) {
                                pushIn();
                            } else {
                                startPullOut(slice);
                            }
                        }


                        function startPullOut(slice) {

                            // Exit if we're already pulling out this slice
                            if (currentPullOutSlice == slice)
                                return;

                            // Record the slice that we're pulling out, clear any previous animation, then start the animation
                            currentPullOutSlice = slice;
                            currentPullOutDistance = 0;
                            clearInterval(animationId);
                            animationId = setInterval(function () {
                                animatePullOut(slice);
                            }, pullOutFrameInterval);

                            // Highlight the corresponding row in the key table
                            $('#chartData td').removeClass('highlight');
                            var labelCell = $('#chartData td:eq(' + (slice * 2) + ')');
                            var valueCell = $('#chartData td:eq(' + (slice * 2 + 1) + ')');
                            labelCell.addClass('highlight');
                            valueCell.addClass('highlight');
                        }



                        function animatePullOut(slice) {

                            // Pull the slice out some more
                            currentPullOutDistance += pullOutFrameStep;

                            // If we've pulled it right out, stop animating
                            if (currentPullOutDistance >= maxPullOutDistance) {
                                clearInterval(animationId);
                                return;
                            }

                            // Draw the frame
                            drawChart();
                        }




                        function pushIn() {
                            currentPullOutSlice = -1;
                            currentPullOutDistance = 0;
                            clearInterval(animationId);
                            drawChart();
                            $('#chartData td').removeClass('highlight');
                        }


                        function drawChart() {

                            // Get a drawing context
                            var context = canvas.getContext('2d');

                            // Clear the canvas, ready for the new frame
                            context.clearRect(0, 0, canvasWidth, canvasHeight);

                            // Draw each slice of the chart, skipping the pull-out slice (if any)
                            for (var slice in chartData) {
                                if (slice != currentPullOutSlice)
                                    drawSlice(context, slice);
                            }

                            // If there's a pull-out slice in effect, draw it.
                            // (We draw the pull-out slice last so its drop shadow doesn't get painted over.)
                            if (currentPullOutSlice != -1)
                                drawSlice(context, currentPullOutSlice);
                        }


                        function drawSlice(context, slice) {

                            // Compute the adjusted start and end angles for the slice
                            var startAngle = chartData[slice]['startAngle'] + chartStartAngle;
                            var endAngle = chartData[slice]['endAngle'] + chartStartAngle;

                            if (slice == currentPullOutSlice) {

                                // We're pulling (or have pulled) this slice out.
                                // Offset it from the pie centre, draw the text label,
                                // and add a drop shadow.

                                var midAngle = (startAngle + endAngle) / 2;
                                var actualPullOutDistance = currentPullOutDistance * easeOut(currentPullOutDistance / maxPullOutDistance, .8);
                                startX = centreX + Math.cos(midAngle) * actualPullOutDistance;
                                startY = centreY + Math.sin(midAngle) * actualPullOutDistance;
                                context.fillStyle = 'rgb(' + chartColours[slice].join(',') + ')';
                                context.textAlign = "center";
                                context.font = pullOutLabelFont;
                                context.fillText(chartData[slice]['label'], centreX + Math.cos(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding), centreY + Math.sin(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding));
                                context.font = pullOutValueFont;
                                context.fillText(pullOutValuePrefix + chartData[slice]['value'] + " (" + (parseInt(chartData[slice]['value'] / totalValue * 100 + .5)) + "%)", centreX + Math.cos(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding), centreY + Math.sin(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding) + 20);
                                context.shadowOffsetX = pullOutShadowOffsetX;
                                context.shadowOffsetY = pullOutShadowOffsetY;
                                context.shadowBlur = pullOutShadowBlur;

                            } else {

                                // This slice isn't pulled out, so draw it from the pie centre
                                startX = centreX;
                                startY = centreY;
                            }

                            // Set up the gradient fill for the slice
                            var sliceGradient = context.createLinearGradient(0, 0, canvasWidth * .75, canvasHeight * .75);
                            sliceGradient.addColorStop(0, sliceGradientColour);
                            sliceGradient.addColorStop(1, 'rgb(' + chartColours[slice].join(',') + ')');

                            // Draw the slice
                            context.beginPath();
                            context.moveTo(startX, startY);
                            context.arc(startX, startY, chartRadius, startAngle, endAngle, false);
                            context.lineTo(startX, startY);
                            context.closePath();
                            context.fillStyle = sliceGradient;
                            context.shadowColor = (slice == currentPullOutSlice) ? pullOutShadowColour : "rgba( 0, 0, 0, 0 )";
                            context.fill();
                            context.shadowColor = "rgba( 0, 0, 0, 0 )";

                            // Style the slice border appropriately
                            if (slice == currentPullOutSlice) {
                                context.lineWidth = pullOutBorderWidth;
                                context.strokeStyle = pullOutBorderStyle;
                            } else {
                                context.lineWidth = sliceBorderWidth;
                                context.strokeStyle = sliceBorderStyle;
                            }

                            // Draw the slice border
                            context.stroke();
                        }


                        function easeOut(ratio, power) {
                            return (Math.pow(1 - ratio, power) + 1);
                        }

                    }
                    ;

                </script>              

                <table id="chartData">

                    <tr>
                        <th>Usuario</th><th>Cantidad</th>
                    </tr>

                    <tr style="color: #0DA068">
                      <td>Clientes</td><td>
                            <?php                           
                            require_once '../modelo/dto/ClienteDTO.php';
                            require_once '../modelo/dao/ClienteDAO.php';                           
                            require_once '../facades/FacadeCliente.php';
                            require_once '../facades/FacadeCreateRol.php';
                            require_once '../modelo/dao/CrearRolDAO.php';
                            require_once '../facades/FacadeUsuarios.php';
                            require_once '../modelo/dao/UsuarioDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeUsuario = new FacadeUsuarios;                                      
                            $FacadeCliente = new FacadeCliente;
                            $facadeRol = new FacadeCreateRol;
                            echo $FacadeCliente->totalClientes();
                            ?></td>
                    </tr>

                    <tr style="color: #194E9C">
                        <td>Administración</td>
                        <td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Administrador"); ?></td>
                    </tr>

                    <tr style="color: #ED9C13">
                        <td>Gerentes</td><td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Gerente"); ?></td>
                    </tr>

                    <tr style="color: #ED5713">
                        <td>Empleados</td><td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Empleado"); ?></td>
                    </tr>                        
                </table>
                <canvas id="chart" width="600" height="500"></canvas>
            </div>
            <div id="panelDer">
                  <br>
                <?php
                require_once '../modelo/dto/UsuarioDTO.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                require_once '../facades/FacadeUsuarios.php';                              
                require_once '../modelo/utilidades/Conexion.php';

                if ($_GET['id'] != NULL) {
                    $facadeUsuario = new FacadeUsuarios;
                    $usuario = $facadeUsuario->consultarUsuario($_GET['id']);                      
                }
                ?> 
                  <br><br><h2 class="h330">Actualizar Rol / Área de <?php echo $usuario['rol']; ?>:</h2><br><hr><br>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorUsuarios.php">                
                    <label class="tag" for="id"><span id="documento" class="h331">Código: </span></label>
                    <input class="input" name="id" value ="<?php echo $usuario['idUsuario']; ?>" required type="number" pattern="[0-9]{1,15}"  title="Dato no modificable" maxlength="128" id="txtEmail" class="field1" style="text-align: center" readonly>
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>                                   
                    <label class="tag" for="documento"><span id="documento" class="h331">Documento: </span></label>
                    <input readonly class="input" name="identificacion" value ="<?php echo $usuario['identificacion']; ?>" required type="text" pattern="[0-9]{5,15}" title="Solo números" maxlength="128" id="txtEmail" class="field1">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>               
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre Completo: </span></label>
                    <input readonly class="input" name="nombre" type="text" id="txtName" value="<?php echo $facadeUsuario->nombreUsuario($usuario['identificacion']); ?>" class="field1"  required pattern= "[A-Za-z]{3,}">
                    <span id="valName" style="color:Red;visibility:hidden;"></span>
                    <br>                                            
                    <label class="tag" id="labelTipoUsuario" for="tipoUsuario"><span id="lab_valCountry" class="h331">Tipo de Usuario:</span></label>
                    <select id="selectrol" name="selectRol" class="input" required> 
                     <?php
                        $roles = $facadeRol->ListarRoles();?>
                       <optgroup label="Cargo Actual :">
                        <?php
                        echo '<option value="' . $usuario['rolesId'] . '">' . $usuario['rol'];
                        $roles = $facadeRol->ListarRoles();                        
                        ?></optgroup>
                       <optgroup label="Mover a :"> <?php
                        foreach ($roles as $rol) {                            
                            echo '<option value="' . $rol['idRoles'] . '">' . $rol['rol']. '</option>';                            
                        }
                        ?></optgroup>
                    </select><br>                    
                     <?php                        
                    $areas = $facadeUsuario->listarAreas($usuario['rolesId']);
                    ?>
                    <label class="tag" id="labelTipoUsuario" for="tipoUsuario"><span id="lab_valCountry" class="h331">Área o Dependencia:</span></label>
                    <select id="selectArea" name="selectArea" class="input" required> 
                        <optgroup label="Área Actual :">
                          <?php
                         echo '<option value="'.$usuario['areas_idAreas'].'">' .$usuario['nombreArea']. '</option>';
                         ?> </optgroup>
                         <optgroup label="Cambiar a :">
                        <?php
                        foreach ($areas as $area) {

                            echo '<option value="' . $area['idAreas'] . '">' . $area['nombreArea'] . '</option>';
                        }
                        ?></optgroup>
                    </select>                    
                    <br> 
                    <button type="submit" value="ascender" name="ascender" id="ascender" class="boton-verde">Ascender Usuario</button><br>
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
                    <a href="../contactecnos">Contacto</a>
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
