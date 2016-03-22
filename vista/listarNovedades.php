<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'listarNovedades';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listar Novedades</title>
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
    <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
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
          <?php if (isset($_GET['mensaje'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["success"]("<?php echo $_GET['mensaje']; ?>")

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
    <nav class="migas"><br>
    <span itemscope >
        <a href="listarProyectos" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
          <span itemprop="child" itemscope>  
          <a href="listarProyectos" title="Ir a Proyectos" itemprop="url">
           <span itemprop="title">Proyectos</span>              
                </a>  > 
            <strong>Lista de Novedades</strong> 
                </span> 
            </span>         
        </nav>
    <br><br>
    <h2 class="h330">Novedades de Proyectos:</h2>
    <br>  
      <script>
              function printAssessment() {
        window.print();
    }
            </script>
    <div id="exports" style="float:right;padding-bottom:10px;">
                    <!--<a href="#" title="Imprimir" onclick="printAssessment()"> <img src="../img/imprimir.png"></a>-->
                    <!-- <img src="../img/pdf.png"> -->
                    <a href='../modelo/utilidades/Reportes/ExportarNovedad.php'><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
	   <table id="tabla" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>                
                <th>Nombre de Proyecto</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>    
                <th>Código</th>                
                <th>Nombre de Proyecto</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
 
        <tbody>

        <?php
        if (isset($_GET['busqueda'])) {
            if (empty($_SESSION['filtroBusqueda'])) {
                $_SESSION['filtroBusqueda'] = '';
            } else {
                $_SESSION['consultaUsuario']=$_SESSION['filtroBusqueda'];
                foreach ($_SESSION['filtroBusqueda'] as $user) {
                    ?>
                    <tr>
                        <td><?php echo $project['idNovedad']; ?></td>
                        <td><?php echo $project['nombreProyecto']; ?> </td>
                        <td><?php echo $project['categoria']; ?> </td>
                        <td><?php echo $project['fechaNovedad']; ?></td>
                        <td><?php echo $project['estadoSolucion']; ?></td>

                        <td>
                            <a class="me" title="Consultar Novedad" href="../controlador/ControladorNovedades.php?idNovedad=<?php echo $project['idNovedad']; ?>"><img class="iconos" src="../img/verBino.png"></a>
                            <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador') { ?>
                                <a class="me" title="Solucionar Novedad" href="../vista/listarNovedades?id=<?php echo $project['idNovedad']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                                <?php
                            };
                            ?>
                            <a name="eliminar" title="Eliminar Novedad" class="me" href="../controlador/ControladorUsuarios.php?idEliminar=<?php echo $project['idNovedad']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a>
                        </td>
                    </tr>
                    <?php
                }
            }

        } else {

            require_once '../facades/FacadeNovedades.php';
            require_once '../modelo/dao/NovedadesDAO.php';
            require_once '../modelo/utilidades/Conexion.php';
            $facadeNovedad = new FacadeNovedades();
            $todos = $facadeNovedad->listadoNovedades();
            $_SESSION['consultaNovedad'] = $todos;
            foreach ($todos as $project) {
                ?>
                <tr>
                    <td><?php echo $project['idNovedad']; ?></td>
                    <td><?php echo $project['nombreProyecto']; ?> </td>
                    <td><?php echo $project['categoria']; ?> </td>
                    <td><?php echo $project['fechaNovedad']; ?></td>
                    <td><?php echo $project['estadoSolucion']; ?></td>
                    <td>
                        <a class="me" title="Consultar Novedad" href="../controlador/ControladorNovedades.php?idNovedad=<?php echo $project['idNovedad']; ?>"><img class="iconos" src="../img/verBino.png"></a>
                            <?php if ($_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Gerente' ) { 
                        $estados = $facadeNovedad->estadoNovedad($project['idNovedad']);
                        $estado= $estados['estadoSolucion'];
                        if ($estado == "Solucionado") {
                                 
                        echo '<a name="solucionado" title="Novedad solucionada" class="me" ><img class="iconos" src="../img/bien.png"></a>';
                         
                        }else{
                        
                        echo '<a name="solucionar" title="Solucionar Novedad" class="me" href="../controlador/ControladorNovedades.php?idSolucionar='.$project['idNovedad'].'"><img class="iconos" src="../img/alert.png"></a>';
                         
                            }}
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        }
                ?>
                      
        </tbody>
    </table>
    <div id="verUsuario" class="modalDialog" title="Ver Novedad">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                    <?php
                    echo '<table id="muestraDatos" style="width:400px;"><tr><th colspan="2">Novedad</th></tr>';
                    echo '<tr><td>Código Novedad:</td><td>0' . $_SESSION['datoNovedad']['idNovedad'] . '</td></tr>';
                    echo '<tr><td>Nombre Proyecto:</td><td>' . $_SESSION['datoNovedad']['nombreProyecto'] . '</td></tr>';
                    echo '<tr><td>Categoria:</td><td>' . $_SESSION['datoNovedad']['categoria'] . '</td></tr>';
                    echo '<tr><td>Descripción:</td><td> ' . $_SESSION['datoNovedad']['descripcionNovedad'] . '</td></tr>';
                    echo '<tr><td>Fecha:</td><td>' . $_SESSION['datoNovedad']['fechaNovedad'] . '</td></tr>';
                    echo '<tr><td style="text-align:center;" colspan="2">Evidencia:<br><img style="width:280px;height:140px;" src="../evidencias/' . $_SESSION['datoNovedad']['archivoNovedad'] . '"></td></tr>';
                    echo '</table>';
                    ?>                                
                </div>                    
            </div>
        <div id="solucionarNovedad" class="modalDialog" title="Solucionar Novedad">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                     
                    <form class="formRegistro" id="formNovedades" method="post" action="../controlador/ControladorNovedades.php" enctype="multipart/form-data">
                        <?php
                    echo '<table id="muestraDatos" style="width:400px;"><tr><th colspan="2">Solución</th></tr>';
                    echo '<tr><td>Código Novedad:</td><td>0' . $_SESSION['solucionNovedad']['idNovedad'] . '</td></tr>';
                    echo '<tr><td>Nombre Proyecto:</td><td>' . $_SESSION['solucionNovedad']['nombreProyecto'] . '</td></tr>';
                    echo '</table>';
                    ?>
                        <textarea class="input4" style="margin-left:20px;width:400px" placeholder="Describa la Solución Dada..." name="solucion" title="Minimo 5 Caracteres" id="description" required ></textarea>
                <button type="submit" name="solucionarNovedad" class="boton-verde">Generar Solución</button><br>
                        
                    </form>                         
                </div>                    
            </div>
            <button class="boton-verde"  onclick="location.href='listarNovedades'" >Refrescar Lista</button>
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
