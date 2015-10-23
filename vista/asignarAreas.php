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
    $pagActual = 'modificarRol.php';
    $total = count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Asignar Areas</title>
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
                
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                    <div id="menu">
                        <ul>
                            <?php
                            require_once './Menu.php';
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
                            <span itemprop="title">Asignar Areas</span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Asignar Áreas:</h2><hr>
                <?php
                require_once '../facades/FacadeUsuarios.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                $facadeUsuarios = new FacadeUsuarios();
                $all = $facadeUsuarios->listarAreas();
                ?> 

                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="Get" action="../controlador/ControladorRol.php"> 
                    <label class="tag" id="IdRol" for="IdRol"><span id="NameRol" class="h331">Número del Rol: </span></label>

                    <?php
                    require_once '../modelo/dao/CrearRolDAO.php';
                    require_once '../facades/FacadeCreateRol.php';
                    $facadeCreateRol = new FacadeCreateRol();
                    $idRol = $facadeCreateRol->obtenerID($_GET['id']);
                    $todosR = $facadeCreateRol->ListarRoles();
                    ?>
                    <select name="selectId"> 

                         <?php
                            echo '<option value="'. $idRol['idRoles'].'">'.$idRol['idRoles'].'</option>';  
                      ?>
                    </select><br>
                    
                    <?php $nombre = $facadeCreateRol->ObtenerNombreRol($_GET['id']); ?>

                    <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre del Rol: </span></label>
                    <input name="NameRol" type="text" id="txtName"  placeholder="Pedro" readonly  value=" <?php echo $nombre ?> "> 


                    <span id="valName" style="color:Red;visibility:hidden;"></span><br>
                    <label class="tag" id="Permisos" for="Permisos"><span id="permisos" class="h331">Permisos: </span></label>
                    <table>
                        <?php
                        require_once '../facades/FacadeUsuarios.php';
                        require_once '../modelo/dao/UsuarioDAO.php';
                        require_once '../facades/FacadeAreas.php';
                        require_once '../modelo/dao/AreasDAO.php';
                        $facadeUsuarios = new FacadeUsuarios();
                        $all = $facadeUsuarios->listarAreas();
                        $facadeArea=new FacadeAreas();
                        $APRol = $facadeArea->obtenerAreas($_GET['id']);
                        foreach ($all as $unit) {
                            ?>     
                            <tr>
                                <td> <input name="idAreas" value ="<?php echo $unit['idAreas']; ?>" readonly ></td>
                                <td> <input name="permiso" value ="<?php echo $unit['nombreArea']; ?>" disabled ></td>
                                <td></td>
                                <td><input type="checkbox" id="estado" name="<?php echo $unit['idAreas']; ?>" value="<?php echo $unit['idAreas']; ?>"<?php 
                                foreach ( $APRol as $areas){
                                        if (($unit['idAreas']==$areas["areas"])) {                           
                                            echo 'checked="checked"';
                                }  } ?> />   </td>         
                               
                            </tr>

                            <?php
                        }
                        if (isset($_GET['mensaje3'])) {
                            echo "<script>alert('" . $_GET['mensaje3'] . "')</script>";
                        }
                        ?>    
                    </table>
                    <button type="submit" value="Enviar" name="ModificarArea" id="crearRol" class="boton-verde" style="display: inline">Asignar</button>
                    
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

