<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'asignarPermisos';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Asignar Permisos</title>
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
                    <div><img src="../fotos/<?php echo $_SESSION['foto']; ?>"></div>
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
                        <a href="crearRol?#ModalRoles" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Roles</span>              
                        </a>  > 

                    </span> 
                    <strong>Asignar Permisos</strong>
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Asignar Permisos:</h2><hr>

                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <div id="panelModificaPass">
                    <form class="formRegistro" method="Get" action="../controlador/ControladorRol.php"> 
                       
                        <?php
                        require_once '../modelo/dao/CrearRolDAO.php';
                        require_once '../facades/FacadeCreateRol.php';
                        $facadeCreateRol = new FacadeCreateRol();
                        $all = $facadeCreateRol->ListarPermisos();
                        $todosR = $facadeCreateRol->ListarIdRoles();
                        foreach ($todosR as $rol) {
                                $rolCreado = $rol['idRoles'];
                            }
                        ?>
                        
                        <label class="tag" id="IdRol" for="selectId"><span id="NameRol" class="h331">Número del Rol: </span></label>
                        <input name="selectId" class="input" type="text" id="selectId" required style="text-align: center" readonly value="<?php echo $rolCreado ?>"> 
                        <span id="valCompany"  style="color:Red;visibility:hidden;"></span><br>
                        <?php $nombre = $facadeCreateRol->ObtenerNombreRol($rol['idRoles']); ?>

                        <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre del Rol: </span></label>
                        <input name="NameRol" class="input" type="text" id="txtName"  placeholder="Administrador" readonly  value=" <?php echo $nombre ?> " style="text-align:center"> 


                        <span id="valName" style="color:Red;visibility:hidden;"></span><br>
                        <label class="tag" id="Permisos" for="Permisos"><span id="permisos" class="h331">Seleccione Los Permisos: </span></label>
                        <div id="panelModificaPass">
                            <table id="muestraDatos" style="margin-left:30%">
                                <?php
                                foreach ($all as $unit) {
                                    if($unit['nivel']==1){?>  
                                    <th><?php echo $unit['nombreRuta'].' '; ?><input type="checkbox" id="estado" name="<?php echo $unit['idPermisos']; ?>" value=" <?php echo $unit['idPermisos']; ?>"/></th>
                                    <?php
                                    }else{                                 
                                    ?>  

                                    <tr>
                                     
                                        
                                        <td style="font-size:11px"><?php echo $unit['nombreRuta']; ?></td>
                                       
                                        <td><input type="checkbox" id="estado" name="<?php echo $unit['idPermisos']; ?>" value="<?php echo $unit['idPermisos']; ?>">   </td>         

                                    </tr>
                                    
                                    <?php
                                }
                            }
                               
                                ?>    
                            </table>
                            <button type="submit" value="Enviar" name="asignarPermiso" id="asignarPermiso" class="boton-verde">Asignar Permisos</button><br>

                        </div>
                    </form>
                       
                </div>
                 <hr>
            </div>               
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

