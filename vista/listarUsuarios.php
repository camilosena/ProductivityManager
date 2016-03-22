<?php
session_start();
require_once '../modelo/utilidades/Session.php';
require_once '../modelo/utilidades/browser.php';
$pagActual = 'listarUsuarios';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lista de Usuarios</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
        <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script2.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link rel="stylesheet" href="../js/jquery.dataTables.css">
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/table.js"></script>
        <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
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
                <a href="listarProyectos"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#navMenu" class="menu_icon" id="menu_icon"></a>
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
                        <strong>Lista General de Usuarios Activos</strong> 
                    </span> 
                </span>         
            </nav>
            <br><br>
            <h2 class="h330">Lista General de Usuarios:</h2>
            <?php            
            if (isset($_GET['modificado'])) {
                echo '<script> 
                Command: toastr["success"]("' . $_GET['modificado'] . '", "Enhorabuena")
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
            if (isset($_GET['mensajeAsignacion'])) {
                echo '<script> 
               Command: toastr["success"]("' . $_GET['mensajeAsignacion'] . '", "Enhorabuena")
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
            ?>          
            <br>  
             <script>
              function printAssessment() {
        window.print();
    }
            </script>
            <form name="filtro" class="formRegistro" action="../controlador/ControladorFiltros.php" method="POST">
                <div id="exports" style="float:right;padding-bottom:10px;">                 
                    <!--  <a href="#" title="Imprimir" onclick="printAssessment()"> <img src="../img/imprimir.png"></a>-->
                    <!-- <img src="../img/pdf.png"> -->
                    <a href='../modelo/utilidades/Reportes/ExportarUsuario.php'><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
                <table id="tabla" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>                    
                            <th>Código</th>                
                            <th>Identificación</th>
                            <th>Nombres</th>
                            <th>Apellidos</th> 
                            <th>Tipo de Rol</th> 
                            <th>Teléfono</th>                
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>                    
                            <th><input tabindex="1" type="text" class="input11" name="idUser" value=""></th>                
                            <th><input tabindex="2" type="text" class="input11" name="identification" value=""></th>
                            <th><input tabindex="3" type="text" class="input11" name="names" value=""></th>
                            <th><input tabindex="4" type="text" class="input11" name="lastNames" value=""><br></th> 
                            <th><input tabindex="5" type="text" class="input11" name="rol" value=""></th> 
                            <th><input tabindex="6" type="text" class="input11" name="phone" value=""></th>                
                            <th><button tabindex="6" type="submit" value="buscarUsuarios" name="buscarUsuarios" id="buscar" class="boton-verde">Buscar</button></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Código</th>                
                            <th>Identificación</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Tipo de Rol</th> 
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>

                    <tbody>   
    <!--                <script>
                     Command: toastr["warning"]("Desea Eliminar Este Usuario?<br /><br /><button type='button'style='display:inline' class='btn clear'>Si</button><button type='button' style='display:inline' class='btn clear'>No</button>")
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
                    </script>-->
                    <script>
                        function confirmacion() {
                            if (confirm('Seguro que desea eliminar este usuario')) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    </script>
                    <?php
                    if (isset($_GET['busqueda'])) {
                        if (empty($_SESSION['filtroBusqueda'])) {
                            $_SESSION['filtroBusqueda'] = '';
                        } else {
                            $_SESSION['consultaUsuario']=$_SESSION['filtroBusqueda'];
                            foreach ($_SESSION['filtroBusqueda'] as $user) {
                                ?>
                                <tr><td><?php echo $user['idUsuario']; ?> </td>
                                    <td><?php echo $user['identificacion']; ?> </td>
                                    <td> <?php echo $user['nombres']; ?> </td>
                                    <td><?php echo $user['apellidos']; ?></td>                      
                                    <td><?php echo $user['rol']; ?></td>
                                    <td><?php echo $user['telefono']; ?></td> 

                                    <td>
                                        <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorUsuarios.php?idConsultar=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                                        <a class="me" title="Modificar Usuario" href="modificarUsuario?id=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                                        <a name="eliminar" title="Eliminar Usuario" class="me"  href="../controlador/ControladorUsuarios.php?idEliminar=<?php echo $user['idUsuario']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a>                                            
                                        <?php if ($_SESSION['rol']=="Administrador") {
                                    echo '<a class="me" title="Cambiar de Área / Rol" href="actualizarRolArea?id='.$user['idUsuario'].'"><img class="iconos" src="../img/ascenso.png"></a>';
                                    } ?>
                                    </td>
                                </tr>                         
                                <?php
                            }
                        }
                        
                    } else {
                        require_once '../modelo/dto/UsuarioDTO.php';
                        require_once '../modelo/dao/UsuarioDAO.php';                       
                        require_once '../facades/FacadeUsuarios.php';                      
                        require_once '../modelo/utilidades/Conexion.php';
                        $facadeUsuario = new FacadeUsuarios;                       
                        $todos = $facadeUsuario->listadoUsuario();
                        $_SESSION['consultaUsuario']=$todos;
                        foreach ($todos as $user) {
                            ?>
                            <tr><td><?php echo $user['idUsuario']; ?> </td>
                                <td><?php echo $user['identificacion']; ?> </td>
                                <td> <?php echo $user['nombres']; ?> </td>
                                <td><?php echo $user['apellidos']; ?></td>                      
                                <td><?php echo $user['rol']; ?></td>
                                <td><?php echo $user['telefono']; ?></td> 

                                <td>
                                    
                                    <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorUsuarios.php?idConsultar=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                                    <a class="me" title="Modificar Usuario" href="modificarUsuario?id=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                                    <?php if ($_SESSION['rol']=="Administrador") {
                                    echo '<a name="eliminar" title="Eliminar Usuario" class="me"  href="../controlador/ControladorUsuarios.php?idEliminar='.$user['idUsuario'].'" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a>';
                                    }
                                     if ($_SESSION['rol']=="Administrador") {
                                    echo '<a class="me" title="Cambiar de Área / Rol" href="actualizarRolArea?id='.$user['idUsuario'].'"><img class="iconos" src="../img/ascenso.png"></a>';
                                    }
                                    if ($_SESSION['rol']=="Administrador" & $user['rol'] != "Administrador" & $user['rol'] != "Auditor" || $_SESSION['rol']=="Gerente" & $user['rol'] != "Administrador" & $user['rol'] != "Auditor") {
                                    echo '<a class="me" title="Proyectos Asociados" href="../controlador/ControladorUsuarios.php?idAsociados='.$user['idUsuario'].'"><img class="iconos" src="../img/work.png"></a>';
                                    } ?>
                                </td>
                                </tr>                         
                                <?php
                        }
                    }
                    ?>                      
                    </tbody>
                </table>   
            </form>
            <?php
            require_once '../modelo/utilidades/Conexion.php';
            require_once '../modelo/dao/ProyectosDAO.php';
            require_once '../facades/FacadeProyectos.php';
            $proyecto = new FacadeProyectos;
            if(!isset($_SESSION['datosUsuario']['idUsuario'])){
              $_SESSION['datosUsuario']['idUsuario']=0;
            }
            $proyectosEjecucion = $proyecto->proyectoEnEjecucionEmpleado($_SESSION['datosUsuario']['idUsuario']);
            ?>
            <div id="verUsuario" class="modalDialog" title="Ver Usuario">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                    <?php
                    echo '<table id="muestraDatos" style="width:400px;"><tr><th colspan="2"><img class="fotoUsuario" src="../fotos/' . $_SESSION['datosUsuario']['foto']  . '"><br>Datos de Usuario </th></tr>';                    
                    echo '<tr><td>Cargo:</td><td>' . $_SESSION['datosUsuario']['rol']  . '</td></tr>';
                    echo '<tr><td>Área/Sector:</td><td>' . $_SESSION['datosUsuario']['nombreArea']  . '</td></tr>';
                    echo '<tr><td>Código:</td><td>' . $_SESSION['datosUsuario']['idUsuario'] . '</td></tr>';
                    echo '<tr><td>Identificación:</td><td> ' . $_SESSION['datosUsuario']['identificacion']  . '</td></tr>';
                    echo '<tr><td>Nombres:</td><td>' . $_SESSION['datosUsuario']['nombres']  . '</td></tr>';
                    echo '<tr><td>Apellidos:</td><td>' . $_SESSION['datosUsuario']['apellidos']  . '</td></tr>';
                    echo '<tr><td>Dirección:</td><td>' . $_SESSION['datosUsuario']['direccion']  . '</td></tr>';
                    echo '<tr><td>Teléfono:</td><td>' . $_SESSION['datosUsuario']['telefono']  . '</td></tr>';
                    echo '<tr><td>Fecha de Nacimiento:</td><td>' . $_SESSION['datosUsuario']['fechaNacimiento']  . '</td></tr>';
                    echo '<tr><td>Correo Electronico:</td><td ><a id="mails" title="Enviar Correo a:" href="mailto:' . $_SESSION['datosUsuario']['email']  . '">'. $_SESSION['datosUsuario']['email']  .'</td></tr>';
                    if ($_SESSION['rol']== "Administrador") {
                    if($_SESSION['datosUsuario']['rol'] =='Empleado'){
                    echo '<tr><td colspan="2" style="text-align:center">Asignar Usuario a Proyecto</td></tr>';
                    echo '<form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php?codUsuario=' . $_SESSION['datosUsuario']['idUsuario']  . '&rolUser=' . $_SESSION['datosUsuario']['rol']  . '">';
                    echo '<tr><td><label class="tag" id="labelProyecto" for="listaProyecto"><span id="lab_valCountry" class="h331">Seleccione Proyecto:</span></label></td>'
                    . '<td><select class="input" id="listaProyecto" name="idProjects" id="listaProyecto" autofocus class="list_menu" required>';
                    if (empty($_POST['idProjects'])) {
                        $_POST['idProjects'] = '';
                    }
                    echo '<option value="" selected disabled>Seleccionar</option>';
                    foreach ($proyectosEjecucion as $ejecutando) {
                        echo '<option value="' . $ejecutando['idProyecto'] . '">' . $ejecutando['idProyecto'] . '-' . $ejecutando['nombreProyecto'] . '</option>';
                    }
                    echo '</select></td></tr>';
                    echo '<tr><td colspan="2" style="border:none"><button class="boton-verde" type="submit">';
                    echo 'Asignar a Proyecto</button></td></tr>';
                    }}  else 
                    if ($_SESSION['rol']== "Gerente" ) {
                    if($_SESSION['datosUsuario']['rol'] =='Empleado'){
                    echo '<tr><td colspan="2" style="text-align:center">Asignar Usuario a Proyecto</td></tr>';
                    echo '<form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php?codUsuario=' . $_SESSION['datosUsuario']['idUsuario']  . '&rolUser=' . $_SESSION['datosUsuario']['rol']  . '">';
                    echo '<tr><td><label class="tag" id="labelProyecto" for="listaProyecto"><span id="lab_valCountry" class="h331">Seleccione Proyecto:</span></label></td>'
                    . '<td><select class="input" id="listaProyecto" name="idProjects" id="listaProyecto" autofocus class="list_menu" required>';
                    if (empty($_POST['idProjects'])) {
                        $_POST['idProjects'] = '';
                    }
                    echo '<option value="" selected disabled>Seleccionar</option>';
                    foreach ($proyectosEjecucion as $ejecutando) {
                        echo '<option value="' . $ejecutando['idProyecto'] . '">' . $ejecutando['idProyecto'] . '-' . $ejecutando['nombreProyecto'] . '</option>';
                    }
                    echo '</select></td></tr>';
                    
                    echo '<tr><td colspan="2" style="border:none"><button class="boton-verde" type="submit">';
                    echo 'Asignar a Proyecto</button></td></tr>';
                    }}
                    echo '</form>';
                    echo '</table>';
                    ?>                                
                </div>                    
            </div>
            <button class="boton-verde"  onclick="location.href='listarUsuarios'" >Refrescar Lista</button>            
        </div>
        <?php
                    if (isset($_SESSION['datosProyectos'])) {
                        $proyectos = $_SESSION['datosProyectos'];
                    }
            
            ?>
            <div id="verProyectos" class="modalDialog" title="Ver Proyectos">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                  <?php if($proyectos==false){
                      echo "<h1>No Tiene Proyectos Asociados</h1>";
                   }else{ ?>
                    <table id="muestraDatos"><br><br>
                        <img style="float: right"  class="fotoUsuario" src="../fotos/<?php echo $_SESSION['datosUsuario']['foto']?>">
                        <h1 style="display: inline">Proyectos Asociados </h1><br><br>
                        <thead>
                   <tr> <th >Código</th>
                    <th >Proyecto</th>
                    <th >Fecha de inicio</th>
                    <th >Estado</th>
                    </thead>
                    <tbody>
                    <?php
                foreach ($proyectos as $unit){
                                
                                echo '<tr>';
                                echo '<td style="text-align:center;">' . $unit['idProyecto']  . '</td>'; 
                                echo '<td>' . $unit['nombreProyecto']  . '</td>'; 
                                echo '<td>' . $unit['fechaInicio']  . '</td>'; 
                                echo '<td>' . $unit['estadoProyecto']  . '</td>'; 
                                echo '</tr>';
                                echo '<tr>';
                            }
                ?>
                </tbody>
                    </table>
                    <?php } ?>
                    <br>
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
