<?php
session_start();
if (empty($_SESSION['rol'])) {
    $_SESSION['rol'] = '';
    header("location: ../index.php");
}
if (empty($_SESSION['id'])) {
    $_SESSION['id'] = '';
    header("location: ../index.php");
}
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
    </head>
    <body>
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
                            foreach ($menuGeneral as $general) {
                                echo '<li class="nivel1"><a href="" class="nivel1">' . $general['nombreRuta'] . '<img src="../img/derecha.png"></a>';
                                if ($general['nombreRuta'] == 'Proyectos') {
                                    echo '<ul class="uno">';
                                    foreach ($proyecto as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Novedades') {
                                    echo '<ul class="dos">';
                                    foreach ($novedad as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Personal') {
                                    echo '<ul class="tres">';
                                    foreach ($persona as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Auditorias') {
                                    echo '<ul class="cuatro">';
                                    foreach ($audita as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Clientes') {
                                    echo '<ul class="cinco">';
                                    foreach ($clientes as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Roles') {
                                    echo '<ul class="seis">';
                                    foreach ($roles as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                            }
                            ?>               
                        </ul>
                    </div>
                </nav>
                <ul class="social">
                    <li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
                    <li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
                    <li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
                </ul>
                <p style="text-align:right; font-size:12px; font-family: sans-serif; font-weight:bold; color: white">
                    <?php
                    require_once '../modelo/dao/UsuarioDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../facades/FacadeUsuarios.php';

                    $facadeUsuario = new FacadeUsuarios;
                    $_SESSION['nombre'] = $facadeUsuario->nombreUsuario($_SESSION['id']);
                    echo 'Bienvenido(a) ' . $_SESSION['nombre'];
                    ?>
                </p>
            </div>
        </header>        
        <div class="wrapper">
            <nav style="float: right">            
                <ul id="navUser">                    
                    <li><a id="priOpc" title="Opciones de Usuario"><img id="menuUsuario" src="../img/menuUsuario.png"> Opciones</a>
                        <ul>
                            <li id="secOpc"><a href="modificarContrasena.php">Modificar Contraseña</a>                            
                            <li><a href="../controlador/ControladorLogin.php?idCerrar=HastaLuego">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
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
                <br>
                <br><h2 class="h330">Agregar Insumos:</h2><hr>
                <?php
                require_once '../facades/FacadeUsuarios.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                $facadeUsuarios = new FacadeUsuarios();
                
                ?> 

                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="Get" action="../controlador/ControladorInsumos.php"> 
                                      
                    <label class="tag" id="Permisos" for="Permisos"><span id="permisos" >Insumos: </span></label>
                    <table>
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
                    <input name="numero" type="text" id="IdArea" required readonly value="<?php echo $consecutivo?>" style="display: inline-block"><br> 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Nuevo Insumo: </span></label>
                    <input name="NombreInsumo" type="text" id="txtName"  placeholder="Madera"   style="display: inline-block"><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Unidad de medida: </span></label>
                    <input name="unidad" type="text" id="txtName"  placeholder="m3"   style="display: inline-block"><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Precio base: $ </span></label>
                    <input name="precio" type="text" id="txtName"  placeholder="10000"   style="display: inline-block"><br>
                    
                    <button type="submit" value="Enviar" name="AgregarInsumo" id="Areas" class="boton-verde" style="display: inline-block">Agregar</button>
                    <button type="submit" value="Enviar" name="Atras"  class="boton-verde " style="display: inline">Atras</button>
                    </form><br>
                
                
                <?php
                if (isset($_GET['mensaje'])) {
                    echo $_GET['mensaje'] . '<br>';
                    echo 'Su nuevo Código es: ' . $_GET['consecutivo'];
                }
                ?>
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
