<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'crearProyecto.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Crear Proyecto</title>
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
        <link rel="stylesheet" href="../css/barrasProgreso.css" />
        <script src="../js/animateprogress.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
        <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
    </head>
    <body>
        <div id='cssmenu'>
            <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Change" value="1">  
                <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
            </form>
            <ul>
                <li><a href='reportes.php'><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a></li>
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
                $('#loadImg').click(function (event) {
                    $('#filein').click();
                });
            </script>
        </div>    
        <header>      
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                    <div id="menu">
                        <ul>
                            <?php
                            require_once '../modelo/utilidades/Menu.php';
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
                    <div><img src="../fotos/<?php echo $_SESSION['foto']; ?>"></div>
                    <p style="text-align:right; font-size:12px; font-family: sans-serif; font-weight:bold; color: white"><br><br><br><br><br>
                        <?php
                        echo 'Bienvenido(a) ' . $_SESSION['nombre'];
                        ?>
                    </p>
                </div>
        </header> 
        <?php
        if (isset($_GET['mensajeFecha'])) {
            echo '<script> 
                Command: toastr["warning"]("' . $_GET['mensajeFecha'] . '")
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
        <?php if (isset($_GET['errorPermiso'])) {
            echo '<script> 
                Command: toastr["error"]("' . $_GET['errorPermiso'] . '")
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
         } ?>
        </script>
        <div class="wrapper">            
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="listarProyectos.php" title="Ir a Proyectos" itemprop="url">
                            <span itemprop="title">Proyectos</span>              
                        </a>  >                        
                        <strong>Crear Nuevo Proyecto</strong> 
                    </span> 
                </span>                   
            </nav>          
            <div id="panelIzq"><br>
                <div class="center">                  
                    <h2 class="h330" align="center"><p>Progreso de Proyectos:</p></h2>
                    <?php
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../facades/FacadeProyectos.php';
                    $facadeProyecto = new FacadeProyectos;
                    $progress = $facadeProyecto->progresoProyectos();
                    $cont = 0;
                    foreach ($progress as $progreso) {
                        $cont++;
                        echo '<div class="progress">
                            <font class="h5">' . $progreso['nombreProyecto'] . ':</font> 
                            <progress id="html' . $cont . '" max="100" value=""></progress>
                            <span></span>                            
                        </div>  ';
                    }
                    if ($cont > 0) {
                        ;
                        ?>     
                        <div class="clear"> <br><input type="button" id="boton" value="Recargar" /></div>                                       
                    <?php } ?>
                </div>

                <script type="text/javascript">
                      window.onload = function () {
                        <?php
                        $cont2 = 0;
                        foreach ($progress as $progreso) {
                            $cont2++;
                            echo 'animateprogress("#html' . $cont2 . '", ' . $progreso['ejecutado'] . ');';
                        }
                        ;
                        ?>
                                            }
                                            document.querySelector('#boton').addEventListener('click', function () {
                        <?php
                        $cont2 = 0;
                        foreach ($progress as $progreso) {
                            $cont2++;
                            echo 'animateprogress("#html' . $cont2 . '", ' . $progreso['ejecutado'] . ');';
                        }
                        ;
                        ?>

                    });
                </script>              
            </div>
            <div id="panelDer">
                <span id="fechaActual" style="float:right;font-size:12px;font-family:sans-serif;color:#0900FF">
                    <script>
                        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
                        var f = new Date();
                        document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                    </script>                                      
                </span><br><br>
                <h2 class="h330">Crear Nuevo Proyecto:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br>
                <form class="formRegistro" id="formProject" method="post" action="../controlador/ControladorProyectos.php"> 
                    <?php
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../facades/FacadeProyectos.php';
                    $proyecto = new FacadeProyectos;
                    $idProject = $proyecto->numeroProyecto();
                    ?>                                        
                    <br>                            
                    <?php
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../modelo/dao/ClienteDAO.php';
                    require_once '../facades/FacadeCliente.php';
                    $facadeCliente = new FacadeCliente();
                    $cliente = $facadeCliente->listadoClientesActivos();
                    ?>                           
                    <label class="tag" id="clienteAct" for="clienteAct"><span id="lab_valCountry" class="h331">Seleccione un Cliente:</span></label>
                    <select class="input"  name="cliente" id="clienteAct" autofocus class="list_menu" required>                                                                                                                                         
                        <?php
                        if (isset($_GET['empresa'])) {
                            echo '<optgroup label="Se creara proyecto a:"><option value="' . $_GET['codCliente'] . '" selected>' . $_GET['codCliente'] . '-' . $_GET['empresa'] . '</option></optgroup>';
                        } else {
                        echo '<option value="" disabled selected>Seleccionar</option>';
                        ?>
                        <optgroup label="Clientes Activos">
                          <?php
                            foreach ($cliente as $listado) {
                                echo '<option value="' . $listado['idUsuario'] . '">' . $listado['idUsuario'] . '-' . $listado['nombreCompania'];
                            }
                          }
                            ?></option></optgroup>
                    </select>

                    <label class="tag" for="idProyecto"><span id="lab_valPhone" class="h331">Código Proyecto:</span></label>
                    <input class="input" name="idProyecto" type="text" maxlength="64" value="<?php echo $idProject; ?>" id="idProyecto" style="text-align: center" class="field1" autofocus readonly required>                    	 
                    <span id="valName" style="color:Red;visibility:hidden;"></span>
                    <label class="tag" for="nombreProyecto"><span id="lab_valName" class="h331">Nombre Proyecto:</span></label>
                    <input class="input" name="nombreProyecto" type="text" maxlength="64" placeholder="Oficinas 93" id="nombreProyecto" class="field1" autofocus required>
                    <span id="valName" style="color:Red;visibility:hidden;"></span>
                    <br>                                       
                    <label class="tag" for="fechaInicio"><span id="lab_valSurname" class="h331">Fecha Inicio:</span></label>
                    <input class="input" name="fechaInicio" required type="date" maxlength="64" id="fechaInicio" class="field1">
                    <span id="valSurname" style="color:Red;visibility:hidden;"></span>                    
                    <br>    
                    <label class="tag2" style="position:relative;bottom:50px" for="descripcion"><span id="lab_valName" class="h331">Descripción:</span></label>
                    <textarea  class="input4" name="descripcion" type="text" maxlength="240" id="descripcion" class="field1" ></textarea> 
                    <span id="valName" style="color:Red;visibility:hidden;"></span>
                    <button type="submit" class="inline" name="crearProyecto" class="boton-verde">Crear Proyecto</button><hr>
                    <script language=javascript>
                        function estudioCostos(URL) {
                            window.open(URL, "estudioDeCostos.php", "width=1000,height=640,top=30,left=150,scrollbars=NO");
                        }
                        function produccionProyecto(URL) {
                            window.open(URL, "produccionProyecto.php", "width=1000,height=640,top=30,left=150,scrollbars=NO");
                        }
                    </script>                    
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
