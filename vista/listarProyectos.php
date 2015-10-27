<?php
session_start();
if (empty($_SESSION['rol']) && empty($_SESSION['id'])) {
    header("location: ../index.php?error=Debe Iniciar Sesión");
} else {
    require_once '../modelo/dao/LoginDAO.php';
    require_once '../facades/FacadeLogin.php';
    require_once '../modelo/utilidades/Conexion.php';
    $facadeLogueado = new FacadeLogin;
    $paginas = $facadeLogueado->seguridadPaginas($_SESSION['rol']);
    $pagActual = 'listarProyectos.php';
    $total = count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
    if ($total == 0) {
        header("location: ../index.php?error=No posee permisos para acceder a este directorio.");
    }
}
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
    </head>
    <body>   
    <div id='cssmenu'>
        <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="Change" value="1">  
          <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
      </form>
        <ul>
           <li><a href='listarProyectos.php'><span><i class="fa fa-briefcase fa-lg"></i> Proyectos</span></a></li>
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
            ?>       
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                    <div id="menu">
                        <ul>
                            <?php
                            require_once '../modelo/utilidades/Menu.php';
                            $menu = new Menu;
                            $menu->permisosMenu();
                            ?>               
                        </ul>
                    </div>
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
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
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
            <form name="filtro" class="formRegistro" action="../controlador/ControladorFiltros.php" method="POST">
                <div id="exports" style="float:right;padding-bottom:10px;">
                    <img src="../img/imprimir.png">
                    <img src="../img/email.png">
                    <img src="../img/pdf.png">
                    <a href='../ExportarProyecto.php'><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
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
                        if (isset($_GET['busquedaProject'])) {
                            if (empty($_SESSION['filtroProyectos'])) {
                                $_SESSION['filtroProyectos'] = '';
                            } else {
                                $_SESSION['consultaProyecto']=$_SESSION['filtroProyectos'];
                                foreach ($_SESSION['filtroProyectos'] as $project) {
                                    ?>
                                    <tr><td><?php echo $project['idProyecto']; ?> </td>
                                        <td><?php echo $project['nombreProyecto']; ?> </td>
                                        <td> <?php echo $project['fechaInicio']; ?> </td>
                                        <td><?php echo $project['fechaFin']; ?></td>                      
                                        <td><?php echo $project['estadoProyecto']; ?></td>  
                                        <td><?php echo $project['ejecutado']; ?> %</td>
                                        <td><a class="me" title="Consultar Proyecto" href="../controlador/ControladorProyectos.php?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/ojo.png"></a>                
                                            <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador') { ?>
                                                <a class="me" title="Modificar Proyecto" href="modificarProyecto.php?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/modify.png"></a>
                                                <?php if ($project['estado'] == 'Sin Estudio Costos') {
                                                    ?>
                                                    <a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos('estudioDeCostos.php?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/costos.png"></a>
                                                <?php }
                                            }; ?>                            
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
                            $todos = $facadeProject->listadoProyectos();
                            $_SESSION['consultaProyecto']=$todos;
                            foreach ($todos as $project) {
                                ?>
                                <tr><td><?php echo $project['idProyecto']; ?> </td>
                                    <td><?php echo $project['nombreProyecto']; ?> </td>
                                    <td> <?php echo $project['fechaInicio']; ?> </td>
                                    <td><?php echo $project['fechaFin']; ?></td>                      
                                    <td><?php echo $project['estadoProyecto']; ?></td>  
                                    <td><?php echo $project['ejecutado']; ?> %</td>
                                    <td><a class="me" title="Consultar Proyecto" href="../controlador/ControladorProyectos.php?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/ojo.png"></a>                
                                        <?php if ($_SESSION['rol'] == 'Gerente' || $_SESSION['rol'] == 'Administrador') { ?>
                                            <a class="me" title="Modificar Proyecto" href="modificarProyecto.php?idProject=<?php echo $project['idProyecto']; ?>"><img class="iconos" src="../img/modify.png"></a>
                                        <?php if ($project['estadoProyecto'] == 'Sin Estudio Costos') { ?>
                                                   <a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos('estudioDeCostos.php?projectNum=<?php echo $project['idProyecto'] ?>&nameProject=<?php echo $project['nombreProyecto'] ?>');"><img class="iconos" src="../img/costos.png"></a>
                                            <?php
                                            }
                                            };
                                            ?>

                                    </td>                   
                                </tr>                         
        <?php }
}
?>                      

                    </tbody>
                </table>
            </form>
            <div id="verUsuario" class="modalDialog2" title="Ver Usuario">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>                    
                    <?php
                    echo '<div id="datoUno">';
                    echo '<table id="muestraDatos"><tr><th colspan="2">Información de Proyecto</th></tr>';
                    echo '<tr><td>Código Proyecto:</td><td>' . $_GET['codigoPro'] . '</td></tr>';
                    echo '<tr><td>Nombres Proyecto:</td><td>' . $_GET['nombrePro'] . '</td></tr>';
                    echo '<tr><td>Fecha Inicio:</td><td>' . $_GET['fechaInicio'] . '</td></tr>';
                    echo '<tr><td>Fecha Fin:</td><td> ' . $_GET['fechaFin'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $_GET['estado'] . '</td></tr>';
                    echo '<tr><td>Ejecutado:</td><td>' . $_GET['ejecutado'] . '</td></tr>';
                    echo '<tr><td>Observaciones:</td><td>' . $_GET['obs'] . '</td></tr>';
                    echo '<tr><td>Opciones:</td><td><a class="me" title="Modificar Proyecto" href="modificarProyecto.php?idProject=' . $_GET['codigoPro'] . '"><img class="iconos" src="../img/modify.png"></a>';
                    $comi = "'";
                    if ($_GET['estado'] == 'Sin Estudio Costos') {
                        echo '<a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos(' . $comi . 'estudioDeCostos.php?projectNum=' . $_GET['codigoPro'] . '&nameProject=' . $_GET['nombrePro'] . $comi . ');"><img class="iconos" src="../img/costos.png"></a>';
                    }
                    require_once '../facades/FacadeProyectos.php';
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    $facadeProyecto = new FacadeProyectos;
                    $clie = $facadeProyecto->clienteAsignado($_GET['codigoPro']);
                    echo '<tr><td>Logo Compañia:</td><td><img src="../fotos/'.$clie['foto'].'" class="logoEmpresarial"></td></tr>';
                    echo '</table>';
                    echo '</div><div id="datoDos">';                    
                    echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Cliente</th></tr>';
                    echo '<tr><td>Código:</td><td>' . $clie['idCliente'] . '</td></tr>';
                    echo '<tr><td>Empresa:</td><td>' . $clie['nombreCompania'] . '</td></tr>';
                    echo '<tr><td>NIT:</td><td>' . $clie['nit'] . '</td></tr>';
                    echo '<tr><td>Sector Empresarial:</td><td>' . $clie['sectorEmpresarial'] . '</td></tr>';
                    echo '<tr><td>Sector Económico:</td><td>' . $clie['sectorEconomico'] . '</td></tr>';
                    echo '<tr><td>PBX:</td><td>' . $clie['telefonoFijo'] . '</td></tr>';
                    echo '<tr><td colspan="2" style="text-align:center">Representante Legal</td></tr>';
                    echo '<tr><td>Identificación:</td><td> ' . $clie['identificacion'] . '</td></tr>';
                    echo '<tr><td>Nombre:</td><td>' . $clie['nombre'] . '</td></tr>';
                    echo '<tr><td>Dirección:</td><td>' . $clie['direccion'] . '</td></tr>';
                    echo '<tr><td>Teléfono:</td><td>' . $clie['telefono'] . '</td></tr>';
                    echo '<tr><td>Correo Electronico:</td><td>' . $clie['email'] . '</td></tr>';
                    echo '</table>';
                    echo '</div><div id="datoTres">';
                    $pro = $facadeProyecto->gerenteDeProyecto($_GET['codigoPro']);
                    echo '<table id="muestraDatos"><tr><th colspan="2">Gerente Encargado</th></tr>';
                    echo '<tr><td>Código Gerente:</td><td>' . $pro['idUsuario'] . '</td></tr>';
                    echo '<tr><td>Nombre:</td><td>' . $pro['nombre'] . '</td></tr>';
                    echo '<tr><td>Fecha Inicio:</td><td>' . $pro['direccion'] . '</td></tr>';
                    echo '<tr><td>Fecha Fin:</td><td> ' . $pro['telefono'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $pro['email'] . '</td></tr>';
                    echo '<tr><td>Ejecutado:</td><td>' . $pro['perfil'] . '</td></tr>';
                    echo '</table>';
                    echo '</div>';
                    ?>                                
                </div>                    
            </div>
            <button class="boton-verde"  onclick="location.href = 'listarProyectos.php'" >Actualizar Lista</button>            
        </div>        
        <script language=javascript>
            function estudioCostos(URL) {
                window.open(URL, "estudioDeCostos.php", "width=1000,height=640,top=30,left=150,scrollbars=NO");
            }
        </script>    
        <?php
        if (empty($_GET['winOpen'])) {
            $_GET['winOpen'] = FALSE;
        }
        if ($_GET['winOpen'] == true) {
            echo' <script language=javascript>                
                        window.open("estudioDeCostos.php?projectNum=' . $_GET['projectNum'] . '&nameProject=' . $_GET['nameProject'] . '",' . '"estudioDeCostos.php","width=1000,height=640,top=30,left=150,scrollbars=NO");
                    </script>';
        }
        ?>
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
