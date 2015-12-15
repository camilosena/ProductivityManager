<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'agregarProcesos.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Agregar Procesos</title>
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
                            <span itemprop="title">Agregar Procesos</span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Agregar Procesos:</h2><hr>
                <?php
                require_once '../facades/FacadeUsuarios.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                $facadeUsuarios = new FacadeUsuarios();
                $all = $facadeUsuarios->listarAreas();
                ?> 

                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="Get" action="../controlador/ControladorProcesos.php"> 
                 <div id="panelModificaPass">   
                   
                    <label class="tag" id="Permisos" for="Permisos"><span id="permisos" >Procesos: </span></label>
                    <table>
                        <?php
                        require_once '../facades/FacadeProcesos.php';
                        require_once '../modelo/dao/ProcesosDAO.php';
                        require_once '../facades/FacadeProductos.php';
                        require_once '../modelo/dao/ProductosDAO.php';
                        $fProductos = new FacadeProductos();
                        $facadeProcesos = new FacadeProcesos();
                        $all = $facadeProcesos->ListarProcesos();
                        
                            ?> 
                        <thead>
                           <tr>
                               <td>Proceso</td> 
                               <td>Producto</td> 
                                <td>Empleados</td>
                                <td>Tiempo/Horas</td> 
                                 <td>Valor</td> 
<!--                                <td>Borrar</td><ln>-->
                                <td>Modificar</td>
                            
                        </thead>
                        <?php
                        foreach ($all as $unit) {
                        ?>
                            <tr>
                                
                                <td> <input name="proceso" size="10" value ="<?php echo $unit['tipoProceso']; ?>" disabled ></td>
                                <td> <input name="producto" size="10" value ="<?php echo $unit['producto']; ?>" disabled ></td>
                                <td> <input name="Empleados" size="10" value ="<?php echo $unit['empleados']; ?>" disabled ></td>
                                <td> <input name="tiempo" size="10" value ="<?php echo $unit['tiempo']; ?>" disabled ></td>
                                <td> <input name="valor" size="10" value ="<?php echo $unit['precioProceso']; ?>" disabled ></td>
                                
<!--                                 <td><a name="EliminarProceso" title="Eliminar Proceso" class="me"  href="../controlador/ControladorProcesos.php?idProceso=<?php echo $unit['idProceso']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/eliminar.png"></a></td>-->
                                 <td><a name="ModificarProceso"  title="Modificar Proceso" class="me" href="../controlador/ControladorProcesos.php?idConsultaProceso=<?php echo $unit['idProceso']; ?>" ><img class="iconos" src="../img/modify.png"></a>    </td>  

                            </tr>
                        
                            <?php
                        }
                        if (isset($_GET['mensaje3'])) {
                            echo "<script>alert('" . $_GET['mensaje3'] . "')</script>";
                        }
                        ?>    
                    </table>
                    <hr>
                  
                    
                    <?php
                       
                $consecutivo=$facadeProcesos->ConsecutivoProcesos();
                ?>
                    
                <br> 
                   <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Producto: </span></label>
                   <?php if(isset($_GET['idProducto'])){?>
                   <input class="input" name="nombreProducto"  required readonly style="text-align: center" value="<?php echo $_GET['nombreProducto']?>"><br>  
                   <input class="input" name="selectProducto"  required readonly style="text-align: center; display: none" value="<?php echo $_GET['idProducto']?>"><br> 
                   <?php }else{ ?>
                    <select id="selectProducto" class="input" name="selectProducto" > 
                     <?php
                        $productos = $fProductos->listarProductosSinProcesos();
                        echo '<option disabled selected>' . "Seleccione un producto" . '</option>';
                        foreach ($productos as $producto) {
                            echo '<option value="' . $producto['idProductos'] . '">' . $producto['nombreProducto'] . '</option>';                            
                        }
                        ?>
                   </select><?php }?>
                    <label class="tag" id="IdRol" for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Número de Proceso: </span></label>
                    <input class="input" name="IdProceso" type="text" id="IdArea" required readonly style="text-align: center" value="0<?php echo $consecutivo?>" style="display: inline-block"><br> 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Nuevo Proceso: </span></label>
                    <input  class="input" name="NombreProceso" type="text" id="txtName"  placeholder="Ensamble"   style="display: inline-block" required><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Tiempo/horas: </span></label>
                    <input class="input" name="Tiempo" type="number" id="txtName"  placeholder="12 "   style="display: inline-block" required min="1"><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Cantidad de empleados: </span></label>
                    <input class="input" name="Empleados" type="number" id="txtName"  placeholder="12 "   style="display: inline-block" min="1"><br>
                 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Valor sugerido: </span></label>
                    <input class="input" name="valor" type="number" id="txtName"  placeholder="12 "   style="display: inline-block" min="1"><br>
                     
                    <button type="submit" value="Enviar" name="AgregarProceso" id="Areas" class="boton-verde">Agregar Proceso</button>
                   
                 </div>    
                </form><br>
                <hr>
                
                <?php
                if (isset($_GET['mensaje'])) {
                    echo $_GET['mensaje'] . '<br>';
                    echo 'Su nuevo Código es: ' . $_GET['consecutivo'];
                }
                ?>
            </div>
            
            <div id="ModalProcesos" class="modalDialog" title="ModalProcesos">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>					
                        <h2 class="h330">Modificar Procesos:</h2><br>
                        <div id="panelModificaPass">
                            
                                    <form class="formRegistro" method="post" action="../controlador/ControladorProcesos.php"> 
                                     <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Proceso Número: </span></label>
                                     <input name="IdProceso" size="10" value ="<?php echo $_SESSION['consultarProcesos']['idProceso']; ?>" readonly style="display: inline-block"><br>
                                    <label class="tag"  for="Proceso"><span id="NameRol" class="h331" style="display: inline-block">Proceso: </span></label>
                                    <input name="NombreProceso" size="10" value ="<?php echo $_SESSION['consultarProcesos']['tipoProceso']; ?>" readonly style="display: inline-block"><br>
                                    <input name="idProducto" size="10" value ="<?php echo $_SESSION['consultarProcesos']['idProductos']; ?>" readonly style="display: none">                                   
                                    <label class="tag" for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Producto: </span></label>
                                     <input name="producto" size="10" value ="<?php echo $_SESSION['consultarProcesos']['producto']; ?>" readonly style="display: inline-block"><br>
                                      <label class="tag"  for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Cantidad de Empleados: </span></label>
                                 <input name="Empleados" size="10" value ="<?php echo $_SESSION['consultarProcesos']['empleados']; ?>" style="display: inline-block"><br>
                                 <label class="tag"  for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Tiempo/Horas: </span></label>
                                 <input name="Tiempo" size="10" value ="<?php echo $_SESSION['consultarProcesos']['tiempo']; ?>"  style="display: inline-block"><br>
                                 <label class="tag"  for="IdProceso"><span id="NameRol" class="h331" style="display: inline-block">Valor: </span></label>
                                 <input name="valor" size="10" value ="<?php echo $_SESSION['consultarProcesos']['precioProceso']; ?>"  style="display: inline-block"><br>
                                 <input type="submit" value="Modificar" name="ModificarProceso">
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

