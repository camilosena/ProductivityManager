<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'clientesActivos.php';    
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clientes Activos</title>
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
    <link href="../js/toastr.css" rel="stylesheet"/>
    <script src="../js/toastr.js"></script>
    <script src="../js/validaciones.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/fonts.css">    
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
        </header>        
        <div class="wrapper">
          
     <nav class="migas"><br>
    <span itemscope >
        <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
          <span itemprop="child" itemscope>  
          <a href="listarUsuarios.html" title="Ir a Usuarios" itemprop="url">
           <span itemprop="title">Usuarios</span>              
                </a>  > 
            <strong>Lista de Clientes Activos</strong> 
                </span> 
            </span>         
        </nav>
    <br><br>
    <h2 class="h330">Clientes con Proyectos Activos:</h2>
     <?php
        if (isset($_GET['mensaje'])) {
            echo '<script> 
             Command: toastr["success"]("Con el Consecutivo: '.$_GET['consecutivo'].'", "'.$_GET['mensaje'].'")
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
        if (isset($_GET['modificaCliente'])) {
            echo '<script> 
             Command: toastr["success"]("'.$_GET['modificaCliente'].'")
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
    <form name="filtro" class="formRegistro" action="../controlador/ControladorFiltros.php" method="POST">
        <div id="exports" style="float:right;padding-bottom:10px;">
                    <img src="../img/imprimir.png">
                    <img src="../img/email.png">
                    <img src="../img/pdf.png">
                    <a href='../modelo/utilidades/Reportes/ExportarClienteActivo.php'><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
	   <table id="tabla" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>                
                <th>NIT</th>
                <th>Compañia</th> 
                <th>Teléfono</th>
                <th>Sector Económico</th>                
                <th>Sector Empresarial</th> 
                <th>Acciones</th>
            </tr>
        </thead>
        <thead>
            <tr>                    
                <th><input tabindex="1" type="text" class="input11" name="idClient" value=""></th>                
                <th><input tabindex="2" type="text" class="input11" name="nit" value=""></th>
                <th><input tabindex="3" type="text" class="input11" name="names" value=""></th>
                <th><input tabindex="4" type="text" class="input11" name="phone" value=""><br></th> 
                <th><input tabindex="5" type="text" class="input11" name="secEco" value=""></th> 
                <th><input tabindex="6" type="text" class="input11" name="secEmp" value=""></th>                
                <th><button tabindex="6" type="submit" value="buscarActivos" name="buscarActivos" id="buscar" class="boton-verde">Buscar</button></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>                
                <th>NIT</th>
                <th>Compañia</th> 
                <th>Teléfono</th>                                           
                <th>Sector Económico</th>                
                <th>Sector Empresarial</th> 
                <th>Acciones</th>
            </tr>
        </tfoot>
 
        <tbody>
           <script>
                    function confirmacion() {
                        if (confirm('Seguro que desea desactivar este Cliente')) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <?php
                    if (isset($_GET['busquedaActivos'])) {
                        if (empty($_SESSION['filtroActivos'])) {
                            $_SESSION['filtroActivos'] = '';
                        } else {
                            $_SESSION['consultaActivos']=$_SESSION['filtroActivos'];
                            foreach ($_SESSION['filtroActivos'] as $user) {
                                ?>
                <tr><td><?php echo $user['idUsuario']; ?> </td>
                        <td><?php echo $user['nit']; ?> </td>
                        <td> <?php echo $user['nombreCompania']; ?> </td>
                        <td><?php echo $user['telefonoFijo']; ?></td>                      
                        <td><?php echo $user['sectorEconomico']; ?></td>  
                        <td><?php echo $user['sectorEmpresarial']; ?></td>
                        <td>
                            <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorClientes.php?idConsultarCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                            <a class="me" title="Actualizar Cliente" href="modificarCliente.php?idCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                            <a title="Desactivar Cliente" class="me"  href="../controlador/ControladorClientes.php?idDesactivarCliente=<?php echo $user['idUsuario']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/desactivarUsuario.png"></a></td>                   
                    </tr>                         
                    <?php
                    }
                   }
                  }else{
                require_once '../modelo/dto/UsuarioDTO.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                require_once '../modelo/dto/ClienteDTO.php';
                require_once '../modelo/dao/ClienteDAO.php';
                require_once '../facades/FacadeUsuarios.php';
                require_once '../facades/FacadeCliente.php';
                require_once '../modelo/utilidades/Conexion.php';               
                 $FacadeCliente = new FacadeCliente;
                $todos = $FacadeCliente->listadoClientesActivos();
                $_SESSION['consultaActivos']=$todos;
                foreach ($todos as $user) {
                    ?>
                    <tr><td><?php echo $user['idUsuario']; ?> </td>
                        <td><?php echo $user['nit']; ?> </td>
                        <td> <?php echo $user['nombreCompania']; ?> </td>
                        <td><?php echo $user['telefonoFijo']; ?></td>                      
                        <td><?php echo $user['sectorEconomico']; ?></td>  
                        <td><?php echo $user['sectorEmpresarial']; ?></td>
                        <td>
                            <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorClientes.php?idConsultarCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                            <a class="me" title="Actualizar Cliente" href="modificarCliente.php?idCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                            <?php
                            if ($_SESSION['rol']== "Administrador") {
                               echo '<a title="Desactivar Cliente" class="me"  href="../controlador/ControladorClientes.php?idDesactivarCliente='.$user['idUsuario'].'" onclick=" return confirmacion()"><img class="iconos" src="../img/desactivarUsuario.png"></a></td>                   '; 
                            } 
                                ?>
                            <a class="me" title="Asociar a proyecto" href="asociarProyecto.php?id='.$user['idUsuario'].'"><img class="iconos" src="../img/Work.png"></a>
                    </tr>                         
                    <?php
                  }                  
                }               
                ?>                      
                </tbody>
            </table>   
        </form>
            <div id="verUsuario" class="modalDialog" title="Ver Usuario">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                    <?php
                    echo '<table id="muestraDatos"><tr><th colspan="2"><img src="../fotos/'.$_SESSION['dtoUsuario']['foto'].'" class="fotoUsuario"><br>Datos de Cliente</th></tr>';
                    echo '<tr><td>Código:</td><td>' . $_SESSION['dtoUsuario']['idUsuario'] . '</td></tr>';
                    echo '<tr><td>Empresa:</td><td>' . $_SESSION['dtoCliente']['nombreCompania'] . '</td></tr>';
                    echo '<tr><td>NIT:</td><td>' . $_SESSION['dtoCliente']['nit'] . '</td></tr>';
                    echo '<tr><td>Sector Empresarial:</td><td>' . $_SESSION['dtoCliente']['sectorEmpresarial'] . '</td></tr>';
                    echo '<tr><td>Sector Económico:</td><td>' . $_SESSION['dtoCliente']['sectorEconomico'] . '</td></tr>';
                    echo '<tr><td>PBX:</td><td>' . $_SESSION['dtoCliente']['telefonoFijo'] . '</td></tr>';                   
                    echo '<tr><td colspan="2" style="text-align:center">Representante Legal</td></tr>'; 
                    echo '<tr><td>Identificación:</td><td> ' . $_SESSION['dtoUsuario']['identificacion'] . '</td></tr>';
                    echo '<tr><td>Nombres:</td><td>' . $_SESSION['dtoUsuario']['nombres'] . '</td></tr>';
                    echo '<tr><td>Apellidos:</td><td>' . $_SESSION['dtoUsuario']['apellidos'] . '</td></tr>';
                    echo '<tr><td>Dirección:</td><td>' . $_SESSION['dtoUsuario']['direccion'] . '</td></tr>';
                    echo '<tr><td>Teléfono:</td><td>' . $_SESSION['dtoUsuario']['telefono'] . '</td></tr>';
                    echo '<tr><td>Correo Electronico:</td><td>' . $_SESSION['dtoUsuario']['email'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $_SESSION['dtoUsuario']['estado'] . '</td></tr>';
                    echo '<tr><td colspan="2" style="border:none"><button class="boton-verde">';
                    echo '<a style="text-decoration:none;padding:10px 20px 10px 20px;" href="crearProyecto.php?codCliente='.$_SESSION['dtoUsuario']['idUsuario'].'&empresa='.$_SESSION['dtoCliente']['nombreCompania'].'">Crear Nuevo Proyecto</a></button></td></tr>';
                    echo '</table>';
                    ?>                                
                </div>                    
            </div>
    <button class="boton-verde"  onclick="location.href='clientesActivos.php'" >Actualizar Lista</button>    
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
