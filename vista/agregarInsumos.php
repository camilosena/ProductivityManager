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
        <title>Asignar Insumos</title>
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
                        <a href="CrearRol.php" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Agregar Insumos </span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <form method="post" action="../controlador/ControladorInsumos.php" enctype="multipart/form-data">
                    <label>Cargar archivo:</label>
                    <input type="file" name="archivo">
                    <input name="subir" type="submit" value="Subir Archivo">
            </form><br>
                <br>
                <br><h2 class="h330">Agregar Insumos:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="Get" action="../controlador/ControladorInsumos.php"> 
                                      
                    <label class="tag" id="Permisos" for="Permisos"><span id="permisos" >Insumos: </span></label>
                    <table style="margin-left:20%;">
                        <?php
                        require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                        $all = $facadeInsumos->listarInsumos();
                        foreach ($all as $unit) {
                            ?>     
                            <tr>
                                <td> <input size="2" name="idInsumo" value ="<?php echo $unit['numero']; ?>" readonly ></td>
                                <td> <input size="10" name="nombres" value ="<?php echo $unit['nombre']; ?>" disabled ></td>
                                <td> <input size="10" name="unidades" value ="<?php echo $unit['unidad']; ?>" readonly ></td>
                                <td> <input size="10" name="precios" value ="<?php echo $unit['precio']; ?>" disabled ></td>
                                <td><a name="eliminarInsumo" title="Eliminar Insumo" class="me"  href="../controlador/ControladorInsumos.php?idEliminar=<?php echo $unit['numero']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a></td>
                                        

                            </tr>

                            <?php
                        }
                        if (isset($_GET['mensaje3'])) {
                            echo "<script>alert('" . $_GET['mensaje3'] . "')</script>";
                        }
                        ?>    
                    </table>
                    
                    <?php
                         require_once '../facades/FacadeInsumos.php';
                        require_once '../modelo/dao/InsumosDAO.php';
                        $facadeInsumos = new FacadeInsumos();
                $consecutivo=$facadeInsumos->consecutivoInsumos();
                ?>
                    
                <br>  
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

