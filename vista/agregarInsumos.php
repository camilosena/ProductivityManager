<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'agregarInsumos.php';
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
        <header>              
            <div class="wrapper">
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
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
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
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="agregarInsumos.php" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Materia Prima </span>              
                        </a>  > 
                        <strong>Agregar Materia Prima</strong>
                    </span> 
                </span>         
            </nav>
            <div id="panelIzq">
                <br>                   
                    <table id="muestraDatos" style="margin-left:20%;">
                        <thead>
                        <th hidden></th>
                        <th>Materia Prima</th>
                        <th>Unidad de medida</th>
                        <th>Valor unitario</th>
                        <th>Acciones</th>
                        </thead>
                        <?php
                        require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                        $all = $facadeInsumos->listarInsumos();
                        foreach ($all as $unit) {
                            ?>     
                            <tr>
                                <td hidden> <?php echo $unit['numero']; ?></td>
                                <td> <?php echo $unit['nombre']; ?></td>
                                <td> <?php echo $unit['unidad']; ?></td>
                                <td> <?php echo $unit['precio']; ?></td>
                                <td><a name="editarMateriaPrima" title="Editar Materia" class="me"  href="../controlador/ControladorInsumos.php?idEditarMateria=<?php echo $unit['numero']; ?>"><img class="iconos" src="../img/editar.png"></a></td>
                            </tr>

                            <?php
                        }
                       ?>    
                    </table>
                    
                    <?php
                         require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                $consecutivo=$facadeInsumos->consecutivoInsumos();
                ?>
        </div>  
         <div id="panelDer">
          <br><h2 class="h330">Agregar Materia Prima:</h2><hr>
          <form method="post" action="../controlador/ControladorInsumos.php" enctype="multipart/form-data">
                    <label>Cargar archivo:</label>
                    <input type="file" name="archivo">
                    <input name="subir" type="submit" value="Subir Archivo">
            </form><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                     
                <br>  
                  
            <form class="formRegistro" method="Get" action="../controlador/ControladorInsumos.php"> 
                        
                    <label class="tag" id="IdRol" for="IdInsumo"><span id="NameRol" class="h331" style="display: inline-block">Número de Insumo: </span></label>
                    <input name="numero" class="input" style="text-align:center" type="text" id="IdArea" required readonly value="<?php echo $consecutivo?>" style="display: inline-block"><br> 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block" >Nuevo Insumo: </span></label>
                    <input name="NombreInsumo" class="input" type="text" id="txtName"  placeholder="Madera"   style="display: inline-block" required><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Unidad de medida: </span></label>
                    <input name="unidad" class="input" type="text" id="txtName"  placeholder="m3"   style="display: inline-block" required ><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Precio base: $ </span></label>
                    <input name="precio" class="input" type="number" id="txtName"  placeholder="10000"   style="display: inline-block" required min="1"><br>
                    
                    <button type="submit" value="Enviar" name="AgregarInsumo" id="Areas" class="boton-verde">Agregar Insumos</button>
                    
                    </form><hr>
            </div>
                        <div id="ModalMateriaPrima" class="modalDialog" title="ModalProcesos">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>                  
                        <h2 class="h330">Modificar Materia Prima:</h2><br>
                        <div id="panelModificaPass">
                                    <form class="formRegistro" method="post" action="../controlador/ControladorInsumos.php"> 
                                     <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Código Materia Prima: </span></label>
                                     <input name="idMateriaPrima" size="10" value ="<?php echo $_SESSION['consultarMaterias']['idMateriaPrima']; ?>" readonly style="display: inline-block"><br>
                                    <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Materia Prima: </span></label>
                                    <input name="descripcionMateria" size="10" value ="<?php echo $_SESSION['consultarMaterias']['descripcionMateria']; ?>"  style="display: inline-block"><br>                    
                                    <label class="tag" for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Medida: </span></label>
                                     <input name="unidadDeMedida" size="10" value ="<?php echo $_SESSION['consultarMaterias']['unidadDeMedida']; ?>"  style="display: inline-block"><br>
                                      <label class="tag"  for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Precio Base: </span></label>
                                 <input name="precioBase" size="10" value ="<?php echo $_SESSION['consultarMaterias']['precioBase']; ?>" style="display: inline-block"><br>
                                 <button type="submit" class="boton-verde" value="Modificar" name="modificarMateria">Modificar Materia Prima</button>
                            </form>       
                        </div>

                        <?php
                        if (isset($_GET['mensaje'])) {
                            ?>
                            <div class="row"><br><br>
                                <div class="col-md-6"></div>
                                <div class="col-md-1 text-center"><h4><?php echo $mensaje = $_GET['mensaje'] ?></h4></div>
                                <div class="col-md-5"></div>
                            </div>
                            <?php
                        }
                        ?>


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

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

