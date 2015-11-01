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
    $pagActual = 'produccionProyecto.php';
    $total =count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
   if($total==0){
       header("location: ../index.php?error=No posee permisos para acceder a este directorio.");       
   }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Estudio de Costos</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">                
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
        <link rel="stylesheet" href="../css/colorbox.css">
        <script src="../js/modalJS.min.js"></script>
        <script src="../js/jquery.colorbox.js"></script>
        <script  src="../js/scriptModales.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tablaInModal.css">
    </head>    
    <body>  
         <?php
        if (isset($_GET['mensaje'])) {
            echo '<script> 
                Command: toastr["success"]("'.$_GET['mensaje'].'", "Enhorabuena")
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
        if (isset($_GET['cerrar'])){
            echo '<script>
                function cierra(){
            window.close();
            }
            setTimeout("cierra()",3000)
            </script>';
        }
        ?>     
        <div class="wrapper">                                              
            <h2 class="h330"><br>Producción de Proyecto <?php echo $_GET['projectNum']."-".$_GET['nameProject']; ?>:</h2><br>                
            <form class="formRegistro" method="post" action="../controlador/ControladorEstudioCostos.php">
                <hr>
                    <div class="modelo">
                        <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                         <input class="input" name="idProyecto" type="text" maxlength="64" value="<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1" autofocus readonly required>
                         <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                         <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1" autofocus readonly required>
                   </div>                   
            <br>
            <form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php" style="visibility:visible;display: block;">             
            <div >
                <div id='inline_content' style='padding:10px; background:#fff;'>
                    <br><hr>
                    <strong><h2 class="h330">Productos:</h2></strong><br>                             
                    <p class="obligatoriosD">Selecione los productos segun requerimientos y su respectiva cantidad</p><br>
                    <p class="obligatoriosD">Los campos "Cantidad" son obligatorios al seleccionar Productos.<br></p>                                                               

                    <br><table class="tableSection">
                        <thead>
                            <tr>
                                <th class="th1"><span class="text">Código</span>
                                </th>
                                <th class="th2"><span class="text">Nombre</span>
                                </th>
                                <th class="th3"><span class="text">Ganancia</span>
                                </th>
                                <th class="th4"><span class="text">Seleccionar</span>
                                </th>                                
                                <th class="th5"><span class="text">Cantidad</span>
                                </th>
                            </tr>
                        </thead>                            
                        <tbody>                            
                            <?php
                            require_once '../facades/FacadeProductos.php';
                            require_once '../modelo/dao/ProductosDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeProductos = new FacadeProductos;
                            $products = $facadeProductos->listarProductos();
                            foreach ($products as $productos) {
                                ?>
                                <tr>
                                    <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                    <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                    <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                    <td class="td4"><input type="checkbox" name="producto<?php echo $productos['idProductos']; ?>"></td>
                                    <td class="td5"><input name="cantidad<?php echo $productos['idProductos']; ?>" type="number" maxlength="64" id="cantidadProducto" onchange="valida()"></td>
                                </tr> 
                                <?php }
                            ?>                               
                        </tbody>
                    </table>                               
                    <p><strong><br>Haga Click en la flecha para continuar</strong></p>          
                    <p><br><a class='inline' href="#inline_content2"><img src="../img/flechaDerecha.png" class="flechaDerecha"></a></p>
                </div>
            </div>        
            <div style='display:none'>
                <div id='inline_content2' style='padding:10px; background:#fff;'>
                    <p><strong><h2 class="h330">Materia Prima</h2></strong></p>
                    <p class="obligatoriosD">Selecione la materia prima segun los requerimientos.<br></p>
                    <br><table class="tableSection">
                        <thead>
                            <tr>
                                <th class="th1"><span class="text">Código</span>
                                </th>
                                <th class="th2"><span class="text">Nombre</span>
                                </th>
                                <th class="th3"><span class="text">Consultar</span>
                                </th>
                                <th class="th4"><span class="text">Seleccionar</span>
                                </th>                                
                                <th class="th5"><span class="text">Cantidad</span>
                                </th>
                            </tr>
                        </thead>
                         <tbody>                            
                            <?php
                            require_once '../facades/FacadeProductos.php';
                            require_once '../modelo/dao/ProductosDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeProductos = new FacadeProductos;
                            $products = $facadeProductos->listarProductos();
                            foreach ($products as $productos) {
                                ?>
                                <tr>
                                    <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                    <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                    <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                    <td class="td4"><input type="checkbox" name="producto<?php echo $productos['idProductos']; ?>"></td>
                                    <td class="td5"><input name="cantidad<?php echo $productos['idProductos']; ?>" required type="number" maxlength="64" id="cantidadProducto" onchange="valida()"></td>
                                </tr> 
                                <?php }
                            ?>                               
                        </tbody>
                    </table>

                    <p><br><br><a class='inline' href="#inline_content"><img src="../img/flechaIzquierda.png" class="flechaIzquierda"></a>
                        <br><br><a class='inline' href="#inline_content3"><img src="../img/flechaDerecha.png" class="flechaDerecha"></a></p>
                </div>
            </div>
            <div style='display:none'>
                <div id='inline_content3' style='padding:10px; background:#fff;'>
                    <p><strong><h2 class="h330">Procesos</h2></strong></p>                
                    <p class="obligatoriosD">Procesos implicados en la creación de productos seleccionados<br></p>
                    <br><table class="tableSection">
                        <thead>
                            <tr>
                                <th class="th1"><span class="text">Código</span>
                                </th>
                                <th class="th2"><span class="text">Nombre</span>
                                </th>
                                <th class="th3"><span class="text">Consultar</span>
                                </th>
                                <th class="th4"><span class="text">Seleccionar</span>
                                </th>                                
                                <th class="th5"><span class="text">Cantidad</span>
                                </th>
                            </tr>
                        </thead>
                         <tbody>                            
                            <?php
                            require_once '../facades/FacadeProductos.php';
                            require_once '../modelo/dao/ProductosDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeProductos = new FacadeProductos;
                            $products = $facadeProductos->listarProductos();
                            foreach ($products as $productos) {
                                ?>
                                <tr>
                                    <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                    <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                    <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                    <td class="td4"><input type="checkbox" name="producto<?php echo $productos['idProductos']; ?>"></td>
                                    <td class="td5"><input name="cantidad<?php echo $productos['idProductos']; ?>" required type="number" maxlength="64" id="cantidadProducto" onchange="valida()"></td>
                                </tr> 
                                <?php }
                            ?>                               
                        </tbody>
                    </table>
                    <p><br><br><a class='inline' href="#inline_content2"><img src="../img/flechaIzquierda.png" class="flechaIzquierda"></a>
                        <br><br><button type="submit" class="guardarDerecho" name="elementosProyecto">Guardar</button></p>                
                </div>
            </div>
        </form>
        </div>        
    </body>
</html>
