<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'backup.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Generar BackUp</title>
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
            
        <div class="wrapper">
          <?php if (isset($_GET['mensajeError'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["error"]("<?php echo $_GET['mensajeError']; ?>")

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
                    <a href="index.html" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="listarUsuarios.html" title="Usuarios" itemprop="url">
                            <span itemprop="title">BackUp</span>              
                        </a>  > 
                        <strong>Generar BackUp</strong> 
                    </span> 
                </span>         
            </nav>
          
            <div id="panelUnico">
                <br>
                <?php 
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/BackupDAO.php';
                require_once '../facades/FacadeBackup.php';
                $fBack = new FacadeBackup();
                $tablas = $fBack->listarTablas();
                ?>
                <h2 class="h330">Generar BackUp:</h2><br>               
                <form class="formRegistro"  id="formClientes" method="post" action="../controlador/ControladorBackUp.php" enctype="multipart/form-data"> 
                    <hr>
                    <label class="tag" for="tablas"><span id="lab_valCountry" class="h331">BackUp por tablas:</span></label>
                    <select class="input" name="tablas" id="tablas" class="list_menu" required>                                              
                        <?php
                        echo '<option disabled selected>' . "Seleccione una tabla" . '</option>';
                        foreach ($tablas as $tabla) {
                            
                            echo '<option value="' .$tabla['Tables_in_productivitymanager']. '">' . $tabla['Tables_in_productivitymanager'] . '</option>';                            
                        }
                        ?>
                    </select>
                    <br>
                    <label class="tag" for="tipo"><span id="lab_valCountry" class="h331">Tipo de archivo:</span></label>
                    <select class="input" name="tipo" id="tablas" class="list_menu" required>                                              
                         <option disabled selected>Seleccione un tipo de archivo</option>
                        <option value="sql">sql</option>
                        <option value="cvs">cvs</option>
                        <option value="txt">txt</option>
                    </select>
                    <br>
                    <button type="submit" name="backUpTablas" class="boton-verde">Generar</button><br>
                    
                </form> 
                 <form class="formRegistro"  id="formClientes" method="post" action="../controlador/ControladorBackUp.php" enctype="multipart/form-data"> 
                <button type="submit" name="backUpGeneral" class="boton-verde">BackUp general</button><br>
                </form> 
                <script src="../js/additional-methods.min.js" type="text/javascript"></script>
                <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../js/validaciones.js"></script>
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
