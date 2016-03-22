<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'agregarNovedad';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agregar Novedad</title>
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
    <link rel="stylesheet" href="../css/barraNovedades.css">
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
          <a href="listarProyectos" title="Ir a Proyectos" itemprop="url">
           <span itemprop="title">Proyectos</span>              
                </a>  > 
            <strong>Crear Novedad</strong> 
                </span> 
            </span>         
        </nav>        
       <div id="panelUnico">
          <span id="fechaActual" style="float:right;font-size:12px;font-family:sans-serif;color:#0f0f0f">
                    <script>
                        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        var f=new Date();
                         document.write('<h3>'+diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()+'</h3>');
                    </script>                                      
                </span><br><br>
           <div id="panelNovedades">
        
           <h2 class="h330">Agregar Novedad de Proyecto:</h2><br><hr>
           <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
          <div id="panelNovedades2">
           <form class="formRegistro" id="formNovedades" method="post" action="../controlador/ControladorNovedades.php" enctype="multipart/form-data">
               <?php 
               require_once '../modelo/utilidades/Conexion.php';
               require_once '../modelo/dao/ProyectosDAO.php';
               require_once '../facades/FacadeProyectos.php';
               require_once '../modelo/dao/NovedadesDAO.php';
               require_once '../facades/FacadeNovedades.php';
               $proyectos = new FacadeProyectos;               
               $proEjecucion=$proyectos->proyectoEnEjecucion();
               $novedad = new FacadeNovedades;
               $numNovedad= $novedad->numeroNovedad();
               ?>
                  <label class="tag1" for="numNovedad"><span id="lab_valSurname" class="h331">Novedad No:</span></label>
                  <input class="input" name="numNovedad" type="text" value="<?php echo $numNovedad;?>" maxlength="64" id="numNovedad" class="field1" style="text-align: center" readonly>
                        <br>
                    <label class="tag" for="idProject"><span id="lab_valPhone" class="h331" >Seleccione Proyecto:</span></label>
                    <select class="input" name="idProyecto" id="idProject"required class="list_menu_small" autofocus >
                        <option value="" selected> - Seleccionar Proyecto - </option>
                    <?php foreach ($proEjecucion as $enEjecucion) {
                                echo '<option value="'.$enEjecucion['idProyecto'].'">'.$enEjecucion['idProyecto'].'-'.$enEjecucion['nombreProyecto'];}?></option>
                    </select>                                        
                    <br>                                       
                    <label class="tag" for="categorias"><span id="lab_valCountry" class="h331">Categoria:</span></label>
                        <select class="input" name="categoria" id="categorias" class="list_menu" >
                                    <option value="0" disabled selected> - Seleccionar - </option>
                                    <option value="Retraso" >Retraso</option>
                                    <option value="Solicitud">Solicitud</option>
                </select>
             <br>
                    <label class="tag" for="image"><span id="lab_valCompany" class="h331">Evidencia:</span></label>
                    <input class="input"  name="uploadedfile" id="image"  type="file" multiple=true class="file"  title="Solo Foto">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <div id="cargueEvidencia">
                        <output id="list"></output>
                    </div>
                <label class="tag" for="description"><span id="lab_valPhone" class="h331">Descripción:</span></label>
                <textarea class="input4" name="descripcion" type="text" title="Minimo 5 Caracteres" id="description" rows="4" cols="50" maxlength="90" required class="field1"></textarea>
                <button type="submit" name="crearNovedad" class="boton-verde">Generar Novedad</button><br>
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
                <?php 
                 if (isset($_GET['novedad'])) {
            echo '<script> 
             Command: toastr["success"]("'.$_GET['novedad'].'")
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
                 }?>
            </form>
            </div>
           <hr>
        </div>
    </div> 
        </div>
        <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../js/validacionesNovedades.js"></script>
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
