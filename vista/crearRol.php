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
    $pagActual = 'crearRol.php';
    $total = count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
    if($total==0){
       header("location: ".$_SESSION['paginaOrigen']. "?errorPermiso=No posee permisos para acceder a este directorio.");       
   }
   $_SESSION['paginaOrigen']=$_SERVER['PHP_SELF'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Crear Rol</title>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
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
                    <div><img src="../fotos/<?php echo $_SESSION['foto']; ?>"></div>
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
                            <span itemprop="title">Crear Rol</span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Crear Nuevo Rol:</h2><hr>
                <?php
                require_once '../modelo/dao/CrearRolDAO.php';
                require_once '../facades/FacadeCreateRol.php';
                $facadeCreateRol = new FacadeCreateRol();
                $all = $facadeCreateRol->ListarPermisos();
                $consecutivo = $facadeCreateRol->consecutivoRoles();
                ?> 

                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <div id="panelModificaPass">
                    <form class="formRegistro" method="Get" action="../controlador/ControladorRol.php"> 
                        <label class="tag" id="IdRol" for="IdRol"><span id="NameRol" class="h331">Número del Rol: </span></label>
                        <input name="IdRol" class="input" type="text" id="IdRol" required style="text-align: center" readonly value="<?php echo $consecutivo ?>"> 
                        <span id="valCompany"  style="color:Red;visibility:hidden;"></span><br>
                        <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre del Rol: </span></label>
                        <input  name="NameRol" class="input" type="text" id="txtName"  placeholder="Empleado"  required  >
                        <span id="valName" style="color:Red;visibility:hidden;"></span><br>
                        <button type="submit" value="Enviar" name="creaRol" id="crearRol" class="boton-verde" >Crear Rol</button>
                    </form>                    
                    <button class="boton-verde" onclick="location.href = 'agregarAreas.php'" style="display:inline">Áreas</button>
                    <button type="submit" value="Enviar" name="listarRol" id="listarRol" class="boton-verde" style="display:inline"><a style="text-decoration: none" href="#ModalRoles">Ver Roles</a></button><br>
                </div>
                <hr>
                <div id="ModalRoles" class="modalDialog" title="Roles">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>					
                        <h2 class="h330">Roles:</h2><br>
                        <div id="panelModificaPass">
                            <table id="muestraDatos" style="margin-left: 15%;">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once '../modelo/dao/CrearRolDAO.php';
                                    require_once '../facades/FacadeCreateRol.php';
                                    require_once '../modelo/dto/CrearRolDTO.php';
                                    require_once '../modelo/utilidades/Conexion.php';


                                    $rolDao = new FacadeCreateRol();

                                    $allRoles = $rolDao->ListarRoles();
                                    foreach ($allRoles as $roles) {
                                        ?>
                                        <tr><td><?php echo $roles['idRoles']; ?> </td>
                                            <td>   <?php echo $roles['rol']; ?> </td>

                                            <td colspan="2"><a href="ModificarRol.php?id=<?php echo $roles['idRoles']; ?>"><img src="../img/editar.png" class="iconos" width="48" height="48" alt="Modificar Registro"/>
                                                </a>  
                                                <a name="EliminarRol" title="Eliminar Rol" class="me" href="../controlador/controladorRol.php?idElimirarRol=<?php echo $roles['idRoles']; ?>" onclick="return confirmar();">
                                                    <img src="../img/desactivarUsuario.png" class="iconos" width="48" height="48" /></a>
                                            </td>
                                        </tr>
                                        <?php }
                                    ?>

                                </tbody>
                            </table>
                            <button class="boton-verde" onclick="location.href = 'crearRol.php'">Regresar</button>
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


                    <?php
                    if (isset($_GET['mensaje'])) {
                        echo $_GET['mensaje'] . '<br>';
                        echo 'Su nuevo Código es: ' . $_GET['consecutivo'];
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

