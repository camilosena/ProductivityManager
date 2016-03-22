<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'agregarInsumos';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Agregar Materia Prima</title>
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
     <link rel="stylesheet" href="../css/cargaPaginas.css">
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
            </div>
        </header>        
        <div class="wrapper">
           
            <nav class="migas"><br>
                <span itemscope >
                    <a href="listarProyectos" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="agregarProductos" title="Productos" itemprop="url">
                            <span itemprop="title">Productos </span>              
                        </a>  > 
                        <strong>Agregar Materia Prima</strong>
                    </span> 
                </span>         
            </nav>
            <div id="panelIzq">
                <br>   
                <?php       
                 require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                        $all = $facadeInsumos->listarInsumos();  
                 if ($all==Array()) {
                      echo "<br><br><br><h2 class='h330'>No Existe Materia Prima</h2>";
                    ?> 
                        <div class="container">
                          <div class="gearbox">
                          <div class="overlay"></div>
                            <div class="gear one">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear two">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear three">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear four large">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php 
                  }else{   ?>                      
                    <table id="muestraDatos" class="tableMateria" style="margin-left:10%;margin-top:50px" >
                        <tr>
                       <th>Materia Prima</th>
                        <th>Unidad de medida</th>
                        <th>Valor unitario</th>
                        <?php if ($_SESSION['rol']=="Administrador"){ ?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                        <?php
                        foreach ($all as $unit) {
                            ?>     
                            <tr>
                                <td hidden> <?php echo $unit['numero']; ?></td>
                                <td> <?php echo $unit['nombre']; ?></td>
                                <td> <?php echo $unit['unidad']; ?></td>
                                <td> <?php echo $unit['precio']; ?></td>
                                <?php if ($_SESSION['rol']=="Administrador"){ ?>
                                <td><a name="editarMateriaPrima" title="Editar Materia" class="me"  href="../controlador/ControladorInsumos.php?idEditarMateria=<?php echo $unit['numero']; ?>"><img class="iconos" src="../img/editar.png"></a></td>
                                <?php } ?>
                            </tr>

                            <?php
                        }
                       ?>    
                    </table>
                    
                    <?php
                }
                         require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                $consecutivo=$facadeInsumos->consecutivoInsumos();
                ?>
        </div>  
         <div id="panelDer">
         <div style="text-align:right;font-weight:bold;padding-right:10px">
                <form method="post" action="../controlador/ControladorInsumos.php" enctype="multipart/form-data">
                    <label  class="obligatoriosD">Cargue un archivo con Materias Primas : </label>
                    <a id="loadArchivo" href="javascript:function()"><img src="../img/subirDatos.png" alt=""></a>
                    <a href="#ModalPregunta" ><img src="../img/question.png" class="iconos" alt="Ayuda"></a>
                    <input type="hidden" name="Change" value="1">  
          <input type="file" id="ArchivoMaterias" class="file" name="archivo" onchange="submit();" style="display:none">                 
            </form></div><hr>
             <script type="text/javascript">
            //bind click
            $('#loadArchivo').click(function(event) {
              $('#ArchivoMaterias').click();
            });
        </script> 
          <h2 class="h330">Agregar Materia Prima:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                     
                <br>  
                  
            <form class="formRegistro" method="Get" action="../controlador/ControladorInsumos.php"> 
                        
                    <label class="tag" id="IdRol" for="IdInsumo"><span id="NameRol" class="h331" style="display: inline-block">Código Materia Prima: </span></label>
                    <input name="numero" class="input" style="text-align:center" type="text" id="IdArea" required readonly value="<?php echo $consecutivo?>" style="display: inline-block"><br> 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block" >Materia Prima: </span></label>
                    <input name="NombreInsumo" class="input" type="text" id="txtName"  placeholder="Madera"   style="display: inline-block" maxlength="40" required autofocus><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Unidad de Medida: </span></label>
                    <input name="unidad" class="input" type="text" id="txtName"  placeholder="Metros"   style="display: inline-block" maxlength="20" required ><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Precio Base: $ </span></label>
                    <input name="precio" class="input" type="number" id="txtName"  placeholder="10000"   style="display: inline-block" required max="5000000" title="No aplica valores superiores a $5.000.000" min="1"><br>
                    
                    <button type="submit" value="Enviar" name="AgregarInsumo" id="Areas" class="boton-verde">Agregar Materia Prima</button>
                    
                    </form><br>
                    <hr>
            </div>
            <div id="ModalMateriaPrima" class="modalDialog" title="ModalProcesos">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>                  
                        <h2 class="h330">Modificar Materia Prima:</h2><br>
                        <div id="panelModificaPass">
                                    <form class="formRegistro" method="post" action="../controlador/ControladorInsumos.php"> 
                                     <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Código Materia Prima: </span></label>
                                     <input name="idMateriaPrima" size="10" value ="<?php echo '0'.$_SESSION['consultarMaterias']['idMateriaPrima']; ?>" readonly style="display: inline-block"><br>
                                    <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Materia Prima: </span></label>
                                    <input name="descripcionMateria" size="10" value ="<?php echo $_SESSION['consultarMaterias']['descripcionMateria']; ?>" maxlength="40" style="display: inline-block"><br>                    
                                    <label class="tag" for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Medida: </span></label>
                                     <input name="unidadDeMedida" size="10" value ="<?php echo $_SESSION['consultarMaterias']['unidadDeMedida']; ?>" maxlength="20" required style="display: inline-block"><br>
                                      <label class="tag"  for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Precio Base: </span></label>
                                 <input name="precioBase" size="10" value ="<?php echo $_SESSION['consultarMaterias']['precioBase']; ?>" style="display: inline-block" required max="5000000" title="No aplica valores superiores a $5.000.000" min="1"><br>
                                 <button type="submit" class="boton-verde" value="Modificar" name="modificarMateria">Modificar Materia Prima</button>
                            </form>       
                        </div>
                    </div>
            </div> 
        </div>    
                  <div id="ModalPregunta" class="modalDialog" title="Roles">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>          
                        <h2 class="h330">Instrucciones:</h2>
                        <div id="panelModificaPass">
                                <div>
                                <strong class="obligatoriosD">Cargue un archivo de extensión (.CSV) delimitado por punto y coma (;) con su Materia Prima de esta manera:</strong><br><br>
                                <img src="../img/instruccionMateria.png" width="360" height="280">
                                </div>

                    </div>
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

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

