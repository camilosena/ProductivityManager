<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'listarAuditorias.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lista de Auditorías</title>
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
          <a href="listarProyectos.html" title="Ir a Proyectos" itemprop="url">
           <span itemprop="title">Proyectos</span>              
                </a>  > 
            <strong>Lista de Auditorias</strong> 
                </span> 
            </span>         
        </nav>
    <br><br>
    <h2 class="h330">Lista de Auditorias:</h2>
    <br>

<div id="exports" style="float:right;padding-bottom:10px;">
                    <img src="../img/imprimir.png">
                    <img src="../img/email.png">
                    <img src="../img/pdf.png">
                    <a href='../modelo/utilidades/Reportes/ExportarExcel.php'><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
	   <table id="tabla" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>                
                <th>Auditor</th>
                <th>Nombre de Proyecto</th>
                <th>Fecha / Hora</th>
                <th>Resultado de la auditoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Auditor</th>
                <th>Nombre de Proyecto</th>
                <th>Fecha / Hora</th>
                <th>Resultado de la auditoria</th>
                <th>Acciones</th>
            </tr>
        </tfoot> 
        <tbody>

        <?php

            require_once '../facades/FacadeAuditorias.php';
            require_once '../modelo/dao/AuditoriaDAO.php';
            require_once '../modelo/utilidades/Conexion.php';
            $facadeAuditoria = new FacadeAuditorias();
            $todos = $facadeAuditoria->listarAuditorias();
            foreach ($todos as $auditoria) {
        ?>
            <tr>
                <td><?php echo $auditoria['idAuditoria']; ?></td>
                <td><?php echo $auditoria['nombre']; ?></td>
                <td><?php echo $auditoria['nombreProyecto']; ?></td>
                <td><?php echo $auditoria['fechaAuditoria']; ?></td>
                <td><?php echo $auditoria['productoAuditoria']; ?></td>
                <td>
                <?php 
                if ($_SESSION['rol'] == 'Administrador') { ?>
                    <a name="eliminar" title="Eliminar Auditoría" class="me"  href="../controlador/ControladorUsuarios.php?idEliminar=<?php echo $auditoria['idAuditoria']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a>
                    <?php
                }
                ?>
                    <a class="me" title="Ver resultado de la auditoría" href="../controlador/ControladorAuditorias.php?idAuditoria=<?php echo $auditoria['idAuditoria'];?>"><img class="iconos" src="../img/verBino.png"></a>
                    
                </td>

            </tr>
                <?php
            }
                ?>

        </tbody>
    </table>
</div>

        <div id="verAuditoria" class="modalDialog" title="Ver Auditoria">
            <div><a href="#close" title="Cerrar" class="close">X</a><br>
                <?php
                echo '<table id="muestraDatos"><tr><th colspan="2">Aditoría</th></tr>';
                echo '<tr><td>Código Auditoría:</td><td>' . $_SESSION['datosAuditoria']['idAuditoria'] . '</td></tr>';
                echo '<tr><td>Gerente Auditoría:</td><td>' . $_SESSION['datosAuditoria']['nombre'] . '</td></tr>';
                echo '<tr><td>Nombre Proyecto:</td><td>' . $_SESSION['datosAuditoria']['nombreProyecto'] . '</td></tr>';
                echo '<tr><td>Fecha:</td><td> ' . $_SESSION['datosAuditoria']['fechaAuditoria'] . '</td></tr>';
                echo '<tr><td>Descripción:</td><td>' . $_SESSION['datosAuditoria']['observacionesAuditoria'] . '</td></tr>';
                echo '<tr><td>Producto:</td><td>' . $_SESSION['datosAuditoria']['productoAuditoria'] . '</td></tr>';
                echo '<tr><td>Evidencia:</td><td><img style="width:280px;height:140px;" src="../evidencias/' . $_SESSION['datosAuditoria']['archivoAuditoria'] . '"></td></tr>';
                echo '</table>';
                ?>
            </div>
        </div>


    </div>
        <button class="boton-verde"  onclick="location.href='listarAuditorias.php'" >Actualizar Lista</button>
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
