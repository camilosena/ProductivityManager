<?php
session_start();
require_once '../modelo/utilidades/Session.php';
require_once '../modelo/utilidades/CorreoFinProyecto.php';
$pagActual = 'listarProyectos';
$session = new Session($pagActual);
$session->Session($pagActual);
$correoFin = new CorreoFinProyecto();
//$correoFin->enviarCorreoFinProyecto();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lista Proyectos</title>
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
            <?php
            require_once '../modelo/dao/LoginDAO.php';
            require_once '../modelo/dao/PermisosDAO.php';
            require_once '../modelo/utilidades/Conexion.php';
            require_once '../facades/FacadeLogin.php';
            require_once '../facades/FacadePermisos.php';
            $facadePermmisos = new FacadePermisos;
            $menuGeneral = $facadePermmisos->menuGeneral($_SESSION['rol']);
            $proyecto = $facadePermmisos->permisoProyecto($_SESSION['rol']);
            $novedad = $facadePermmisos->permisoNovedad($_SESSION['rol']);
            $persona = $facadePermmisos->permisoPersonal($_SESSION['rol']);
            $audita = $facadePermmisos->permisoAuditoria($_SESSION['rol']);
            $clientes = $facadePermmisos->permisoCliente($_SESSION['rol']);
            $roles = $facadePermmisos->permisoRoles($_SESSION['rol']);
            $insumos = $facadePermmisos->permisoInsumos($_SESSION['rol']);
            $procesos = $facadePermmisos->permisoProcesos($_SESSION['rol']);
            $productos = $facadePermmisos->permisoProductos($_SESSION['rol']);
            ?>       
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
                    <?php
                    require_once '../modelo/dao/UsuarioDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../facades/FacadeUsuarios.php';
                    $facadeUsuario = new FacadeUsuarios;
                    $_SESSION['nombre'] = $facadeUsuario->nombreUsuario($_SESSION['id']);
                    $_SESSION['foto'] = $facadeUsuario->verFoto($_SESSION['id']);
                    ?>
                    <div><img src="../fotos/<?php echo $_SESSION['foto']; ?>"></div>
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
                        <strong>Lista de Proyectos</strong> 
                    </span> 
                </span>         
            </nav>    
            <br><br>
            <h2 class="h330">Lista de Proyectos:</h2>
            <?php                  
            if (isset($_GET['mensaje'])) {
                echo '<script> 
                Command: toastr["success"]("' . $_GET['mensaje'] . '", "Enhorabuena")
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
            <?php
            if (isset($_GET['bienvenida'])) {
                echo '<script> 
                Command: toastr["info"]("' . $_GET['bienvenida'] . '")
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
            if (isset($_GET['mensajeFiltro'])) {
                echo '<script> 
                Command: toastr["info"]("' . $_GET['mensajeFiltro'] . '")
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
             if (isset($_GET['mensajeFoto'])) {
                echo '<script> 
                Command: toastr["warning"]("' . $_GET['mensajeFoto'] . '")
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
             <script>
              function printAssessment() {
        window.print();
    }
            </script>
            <form name="filtro" class="formRegistro" action="../controlador/ControladorFiltros.php" method="POST">
                <div id="exports" style="float:right;padding-bottom:10px;">
                    <!--<a href="#" title="Imprimir" onclick="printAssessment()"> <img src="../img/imprimir.png"></a>-->
                    <!-- <a href="#" title="Exportar a PDF" ><img src="../img/pdf.png"></a> -->
                    <a href='../modelo/utilidades/Reportes/ExportarProyecto.php'><img src="../img/excel.png" title="Exportar a Excel"></a></div>
                <table id="tabla" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>                
                            <th>Nombre de Proyecto</th>
                            <th>Inicio</th>                             
                            <th>Entrega</th>
                            <th>Estado</th>
                            <th>Ejecutado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>                    
                            <th><input tabindex="1" type="text" class="input11" name="idProject" value=""></th>                
                            <th><input tabindex="2" type="text" class="input11" name="nameProject" value=""></th>
                            <th><input tabindex="3" type="text" class="input11" name="dateB" value=""></th>
                            <th><input tabindex="4" type="text" class="input11" name="dateE" value=""><br></th> 
                            <th><input tabindex="5" type="text" class="input11" name="state" value=""></th> 
                            <th><input tabindex="6" type="text" class="input11" name="exec" value=""></th>                
                            <th><button tabindex="6" type="submit" value="buscarProyectos" name="buscarProyectos" id="buscar" class="boton-verde">Buscar</button>
                                </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Código</th>                
                            <th>Nombre de Proyecto</th>
                            <th>Inicio</th>                               
                            <th>Entrega</th>
                            <th>Estado</th>
                            <th>Ejecutado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        if (isset($_GET['mensajeFiltro'])) {
                            if (empty($_SESSION['filtroProyectos'])) {
                                $_SESSION['filtroProyectos'] = '';
                            } else {
                                $_SESSION['consultaProyecto']=$_SESSION['filtroProyectos'];
                                foreach ($_SESSION['filtroProyectos'] as $project) {
                                    ?>
                                    <tr><td style="text-align:center">0<?php echo $project['idProyecto']; ?> </td>
                                        <td style="text-align:center"><?php echo $project['nombreProyecto']; ?> </td>
                                        <td style="text-align:center"> <?php echo $project['fechaInicio']; ?> </td>
                                        <td style="text-align:center"><?php  if($project['fechaFin']!='0000-00-00'){echo $project['fechaFin'];} ?></td>                      
                                        <td style="text-align:center"><?php echo $project['estadoProyecto']; ?></td>  
                                        <td style="text-align:center"><?php echo $project['ejecutado']; ?> %</td>
                                       <td><a class="me" title="Consultar Proyecto" href="javascript:produccionProyecto('informacionProyecto?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto']; ?>')"><img class="iconos" src="../img/ojo.png"></a>                
                                            <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador' && $project['estadoProyecto']!='Ejecución' && $project['estadoProyecto']!='Espera' && $project['estadoProyecto']!='Finalizado' && $project['estadoProyecto']!='Cancelado') { ?>
                                                <a class="me" title="Modificar Proyecto" href="modificarProyecto?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/modify.png"></a>
                                                <?php if ($project['estadoProyecto'] == 'Sin Estudio Costos') {
                                                    ?>
                                                    <a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos('estudioDeCostos?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/costos.png"></a>
                                                <?php }if ($project['estadoProyecto'] == 'Sin Producción') { ?>
                                                    <a class="me" title="Incluir Producción" href="javascript:produccionProyecto('produccionProyecto?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/products.png"></a>
                                                <?php } 
                                            }  if ($project['estadoProyecto'] != 'Cancelado' && $project['estadoProyecto'] != 'Finalizado' && $_SESSION['rol'] != 'Empleado') { ?> 
                                            <a name="cancelar" title="Cancelar Proyecto" class="me" href="../controlador/ControladorProyectos.php?proCancel=<?php echo $project['idProyecto'] ?>"><img class="iconos" src="../img/cancel.png"></a>   
                                            <?php } ?>                           
                                        </td>                   
                                    </tr>                         
                                    <?php
                                }
                            }
                        } else {
                            ?>                   
                            <?php
                            require_once '../facades/FacadeProyectos.php';
                            require_once '../modelo/dao/ProyectosDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeProject = new FacadeProyectos();
                            if($_SESSION['rol']!='Empleado'){
                              $todos = $facadeProject->listadoProyectos();
                            }elseif($_SESSION['rol']=='Empleado'){
                             $todos= $facadeProject->listarProyectoPorPersonal2($_SESSION['id']); 
                            }
                            $_SESSION['consultaProyecto']=$todos;
                            foreach ($todos as $project) {
                                ?>
                                <tr><td style="text-align:center">0<?php echo $project['idProyecto']; ?> </td>
                                    <td style="text-align:center"><?php echo $project['nombreProyecto']; ?> </td>
                                    <td style="text-align:center"> <?php echo $project['fechaInicio']; ?> </td>
                                    <td style="text-align:center"><?php if($project['fechaFin']!='0000-00-00'){echo $project['fechaFin'];} ?></td>                      
                                    <td style="text-align:center"><?php echo $project['estadoProyecto']; ?></td>  
                                    <td style="text-align:center"><?php echo $project['ejecutado']; ?> %</td>
                                    <td><a class="me" title="Consultar Proyecto" href="javascript:produccionProyecto('informacionProyecto?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto']; ?>')"><img class="iconos" src="../img/ojo.png"></a>                
                                            <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador' && $project['estadoProyecto']!='Ejecución' && $project['estadoProyecto']!='Espera' && $project['estadoProyecto']!='Finalizado' && $project['estadoProyecto']!='Cancelado') { ?>
                                                <a class="me" title="Modificar Proyecto" href="modificarProyecto?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/modify.png"></a>
                                                <?php if ($project['estadoProyecto'] == 'Sin Estudio Costos') {
                                                    ?>
                                                    <a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos('estudioDeCostos?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/costos.png"></a>
                                                <?php }if ($project['estadoProyecto'] == 'Sin Producción') { ?>
                                                    <a class="me" title="Incluir Producción" href="javascript:produccionProyecto('produccionProyecto?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/products.png"></a>
                                                <?php } 
                                            } if ($project['estadoProyecto'] != 'Cancelado' && $project['estadoProyecto'] != 'Finalizado' && $_SESSION['rol'] != 'Empleado') { ?> 
                                            <a name="cancelar" title="Cancelar Proyecto" class="me" href="../controlador/ControladorProyectos.php?proCancel=<?php echo $project['idProyecto'] ?>"><img class="iconos" src="../img/cancel.png"></a>   
                                            <?php } ?>
                                        </td>                 
                                </tr>                         
        <?php }
}
?>                      

                    </tbody>
                </table>
            </form>            
            <button class="boton-verde"  onclick="location.href = 'listarProyectos'" >Refrescar Lista</button>            
        </div>   
        <script language=javascript>
            function informacionProyecto(URL) {
                window.open(URL, "informacionProyecto", "width=1000,height=645,top=30,left=150,scrollbars=NO");
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
        <?php
        if (empty($_GET['winOpen'])) {
            $_GET['winOpen'] = FALSE;
        }
        if ($_GET['winOpen'] == true) {
            echo' <script language=javascript>                
                        window.open("produccionProyecto?projectNum=' . $_GET['projectNum'] . '&nameProject=' . $_GET['nameProject'] . '",' . '"produccionProyecto","width=1100,height=645,top=30,left=100,scrollbars=NO");
                    </script>';
        }
        ?>

               <div id="cancelarProyecto" class="modalDialog" title="Cancelar Proyecto">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                     
                    <form class="formRegistro" id="formNovedades" method="post" action="../controlador/ControladorProyectos.php" enctype="multipart/form-data">
                    <label for="numberPro" class="tag1"><strong>Código Proyeco</strong></label>
                    <input type="text" name="numberPro" id="numberPro" class="input" value="0<?php echo $_GET['estePro'];?>" style="text-align: center;" readonly>
                        <textarea class="input4" style="margin-left:20px;width:400px" placeholder="Se cancela proyecto porque..." name="cancelar" title="Minimo 5 Caracteres" id="description" required  ></textarea>
                <button type="submit" name="cancelarPro" onclick="return confirmacion()" class="boton-verde">Cancelar Proyecto</button><br>
                         <script>
                        function confirmacion() {
                            if (confirm('¿Seguro que desea cancelar este proyecto?. No podra deshacer esta acción, proceda con precaución.')) {
                                return true;
                            } else {
                                return false;
                            }
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
