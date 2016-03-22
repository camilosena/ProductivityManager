<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'insumosPorProducto';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Materia Prima por producto</title>
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
                        <a href="agregarInsumos" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Materia Prima</span>              
                        </a>  > 
                        <strong>Asociar Materia Prima a Producto</strong>
                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Materia Prima a Utilizar en <?php echo $_SESSION['Producto']['nombreProducto']?>:</h2><hr>
                 <p style="font-weight:bold;font-size:13px">Nota:</p><p class="obligatoriosD">Selecione la Materia Prima segun requerimientos y su respectiva cantidad.</p><br>
                        <p class="obligatoriosD">Los campos "Cantidad" son obligatorios por cada Materia Seleccionada.<br></p>  <br><br>
                <form class="formRegistro" id="insuPorProduct" method="post" action="../controlador/ControladorProductos.php"> 
                    <?php
                    require_once '../modelo/dao/InsumosDAO.php';
                    require_once '../facades/FacadeInsumos.php';
                    require_once '../modelo/dao/ProductosDAO.php';
                    require_once '../facades/FacadeProductos.php';
                    // listar insumos
                    $facadeInsumos = new FacadeInsumos();
                    $fProductos = new FacadeProductos();
                    $insumos = $facadeInsumos->listarInsumos();
                    $idProducto= $_SESSION['Producto']['idProductos'];
                    //Obtener insumos por producto
                    $IxP= $facadeInsumos->obtenerInsumos($idProducto);
                    if($insumos==Array ( )){
                        echo "<h2  style='text-align:center';>No Existe Materia Prima Disponible";
                    }else{
                    ?>
                    <input type="hidden" name="idProducto" value="<?php echo $idProducto;?>">
                    
                    <table style="margin-left:30%;" id="muestraDatos">
                    <thead>
                    <tr>
                       <th >Materia Prima</th>
                      <th>Medida</th>
                     <th >Cantidad</th>
                       <th >Seleccionar</th>
                    </tr>
                </thead>
                        <?php
                        $_SESSION['cantInsumos']=0;
                        foreach ($insumos as $insumo) {
                            $_SESSION['cantInsumos']++;
                            $cantidadInsumos = $fProductos->cantidadPorInsumo($insumo['numero'], $idProducto);
                            ?>     
                            <tr>
                               
                                <td><?php echo $insumo['nombre']; ?></td>
                                 <td><?php echo $insumo['unidad']; ?></td>
                                <td><input style="width: 50px; text-align: center" name="cant<?php echo $insumo['numero']; ?>" id="cant<?php echo $insumo['numero']; ?>" type="text" value ="<?php echo $cantidadInsumos; ?>"></td>                               
                                <td><input type="checkbox" id="insumo<?php echo $insumo['numero']; ?>" name="<?php echo $insumo['numero']; ?>" value="<?php echo $insumo['numero']; ?>"<?php 
                                foreach ( $IxP as $IxProducto){
                                        if (($insumo['numero']==$IxProducto["insumos"])) {                           
                                            echo 'checked="checked"';
                                }  } ?> />   </td>         
                               
                            </tr>
                                 <script>
                                 $(document).ready(function(){
                                    $("#cant<?php echo $insumo['numero']; ?>").keyup(function() {
                                         $("#insumo<?php echo $insumo['numero'];  ?>").prop( "checked", true );
                                        });
                                            $("#insumo<?php echo $insumo['numero']; ?>").click(function() {
                                                if($("#insumo<?php echo $insumo['numero'];  ?>").is(':checked')) {
                                                    $("#cant<?php echo $insumo['numero']; ?>").attr("required", true);
                                                } else {
                                                    $("#cant<?php echo $insumo['numero']; ?>").attr("required", false);
                                                }
                                            });

                                        });
                                    </script>
                            <?php
                        }
                        ?>    
                    </table>                    
                    <button type="submit" value="Enviar" name="AsociarInsumos" id="crearRol" class="boton-verde" >Asociar Materia Prima</button>
                    <?php } ?>
                    </form><hr>
                    <script>
                        $("#insuPorProduct").submit(function() {
                            var y=0;
                            for (var i =1; i <=<?php echo $insumo['numero']; ?>; i++) {
                                var x = $("#cant"+i).val();
                                if(x!=''){
                                    y++;
                                }
                            }
                            if (y>0) {      
                                return true;
                            } else 
                            Command: toastr["error"]("Campos Vacios")

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
                            return false;          
                        });
                    </script>
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

