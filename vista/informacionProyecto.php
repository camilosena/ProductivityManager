<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'informacionProyecto.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Información de Proyecto</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">                
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
        <link rel="stylesheet" href="../css/colorbox.css">
        <script src="../js/modalJS.min.js"></script>
        <script src="../js/jquery.colorbox.js"></script>
        <script  src="../js/scriptModales.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tablaInModal.css">
    </head>    
    <body>         
        <div class="wrapper">   
            <div>
                <?php
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                //  Consultar Proyecto
                if (isset($_GET['projectNum'])) {
                    $facadeProyecto = new FacadeProyectos;
                    $proyectos = $facadeProyecto->consultarProyecto($_GET['projectNum']);
                }                
                    echo '<div>';
                    echo '<table id="muestraDatos"><tr><th colspan="2">Información de Proyecto</th></tr>';
                    echo '<tr><td>Código:</td><td>' . $proyectos['idProyecto'] . '</td></tr>';
                    echo '<tr><td>Nombre:</td><td>' . $proyectos['nombreProyecto'] . '</td></tr>';
                    echo '<tr><td>Fecha Inicio:</td><td>' . $proyectos['fechaInicio'] . '</td></tr>';
                    echo '<tr><td>Fecha Fin:</td><td> ' . $proyectos['fechaFin'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $proyectos['estadoProyecto'] . '</td></tr>';
                    echo '<tr><td>Ejecutado:</td><td>' . $proyectos['ejecutado'] . '</td></tr>';
                    echo '<tr><td>Observaciones:</td><td>' . $proyectos['observaciones'] . '</td></tr>';
                    echo '<tr><td>Opciones:</td><td><a class="me" title="Modificar Proyecto" href="modificarProyecto.php?idProject=' . $proyectos['idProyecto'] . '"><img class="iconos" src="../img/modify.png"></a>';
                    $comi = "'";
                    if ($proyectos['estadoProyecto'] == 'Sin Estudio Costos') {
                        echo '<a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos(' . $comi . 'estudioDeCostos.php?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/costos.png"></a>';
                    }elseif ($proyectos['estadoProyecto'] == 'Sin Produccion') {
                        echo '<a class="me" title="Incluir Producción" href="javascript:produccionProyecto('. $comi .'produccionProyecto.php?projectNum='. $proyectos['idProyecto'].'&nameProject='.$proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/products.png"></a>';
                        
                    }
                    require_once '../facades/FacadeProyectos.php';
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    $facadeProyecto = new FacadeProyectos;
                    $clie = $facadeProyecto->clienteAsignado($proyectos['idProyecto']);
                    echo '<tr><td>Logo Compañia:</td><td><img src="../fotos/' . $clie['foto'] . '" class="logoEmpresarial"></td></tr>';
                    echo '</table>';
                    echo '</div><div>';
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
                    echo '</div><div>';
                    $pro = $facadeProyecto->gerenteDeProyecto($proyectos['idProyecto']);
                    echo '<table id="muestraDatos"><tr><th colspan="2">Gerente Encargado</th></tr>';
                    echo '<tr><td>Código Gerente:</td><td>' . $pro['idUsuario'] . '</td></tr>';
                    echo '<tr><td>Nombre:</td><td>' . $pro['nombre'] . '</td></tr>';
                    echo '<tr><td>Fecha Inicio:</td><td>' . $pro['direccion'] . '</td></tr>';
                    echo '<tr><td>Fecha Fin:</td><td> ' . $pro['telefono'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $pro['email'] . '</td></tr>';
                    echo '<tr><td>Ejecutado:</td><td>' . $pro['nombreArea'] . '</td></tr>';
                    echo '</table>';
                    echo '</div>';
                    ?>                                
                </div>                    
            </div>
            <?php if (isset($_GET['projectNum'])) { ?>
                <h2 class="h330"><br>Proyecto <?php echo $_GET['projectNum'] . "-" . $_GET['nameProject']; ?>:</h2><br>                
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php">             
                    <hr>
                    <div class="modelo">
                        <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                        <input class="input" name="idProyecto" type="text" maxlength="64" value="0<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1" autofocus readonly required>
                        <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                        <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1" autofocus readonly required>
                    </div>                   
                    <br>            
                    <div >
                        <div id='inline_content' style='padding:10px; background:#fff;'>
                            <br><hr>
                            <strong><h2 class="h330">Productos:</h2></strong><br>                                
                            <p class="obligatoriosD">Selecione los productos segun requerimientos y su respectiva cantidad.</p><br>
                            <p class="obligatoriosD">Los campos "Cantidad" son obligatorios por cada Producto Seleccionado.<br></p>                                                               
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
                                    $products = $facadeProductos->listarProductosActivos();
                                    foreach ($products as $productos) {
                                        ?>
                                        <tr>
                                            <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                            <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                            <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                            <td class="td4"><input type="checkbox" name="producto<?php echo $productos['idProductos']; ?>" value="<?php echo $productos['idProductos']; ?>" ></td>
                                            <td class="td5"><input name="cantidad<?php echo $productos['idProductos']; ?>" type="number" maxlength="64" id="cantidadProducto"></td>
                                        </tr>                       
                                    <?php }
                                    ?>                               
                                </tbody>
                            </table>                               
                            <p style="text-align: right;margin-right: 5%;"><br>
                                <label class="tag2" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Productos Seleccionados:</span></label>
                                <input id="checkcount1" name="cantidadTipo" type="text" maxlength="64" style="text-align: center" required readonly>
                            </p>                              
                            <script>
                                var contador = function () {
                                    var n = $("input:checked").length;
                                    total = (n + (n === 1 ? " " : ""));
                                    document.getElementById('checkcount1').value = total;
                                };
                                contador();
                                $("input[type=checkbox]").on("click", contador)</script>
                        </div>                
                    </div>                
                    <?php foreach ($products as $imagenes) { ?>
                        <a style="display: none" class="group1" href="../productos/<?php echo $imagenes['fotoProducto']; ?>" title="Código 0<?php echo $imagenes['idProductos']; ?>"></a>
                    <?php } ?>
                    <hr><br><br><br><br><br>
                    <div id="process"><p><a class='group1' href="../img/logo.png" title="Click En Siguiente"><img src="../img/products.png"></a></p>
                        <p class="obligatoriosD">Click Para Visualizar Los Productos</p>
                    </div>               
                </form>
                <div style="display: none">
                    <div id='inline_content2' style='padding:10px; background:#fff;'>
                        <p><strong><h2 class="h330">Materia Prima</h2></strong></p>
                        <p class="obligatoriosD"><br>Selecione la materia prima segun los requerimientos de Cliente.<br></p>
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
                                require_once '../facades/FacadeInsumos.php';
                                require_once '../modelo/dao/InsumosDAO.php';
                                $facadeMateria = new FacadeInsumos();
                                $materias = $facadeMateria->listarInsumos();
                                ?>
                            <label class="tag" id="labelProyecto" for="listaProyecto"><span id="lab_valCountry" class="h331">Seleccione Materia Prima:</span></label>
                            <select class="input" id="listaProyecto" name="idProyecto" id="listaProyecto" autofocus class="list_menu" >                                                                                                                                                               
                                <?php
                                foreach ($materias as $materiaP) {
                                    echo '<option value="' . $materiaP['numero'] . '">' . $materiaP['numero'] . '-' . $materiaP['nombre'];
                                }
                                ?></option>
                            </select>
                            <?php foreach ($products as $productos) { ?>
                                <tr>
                                    <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                    <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                    <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                    <td class="td4"><?php echo $productos['ganancia']; ?>%</td>
                                    <td class="td5"><?php echo $productos['ganancia']; ?>%</td>
                                </tr> 
                            <?php }
                            ?>                               
                            </tbody>
                        </table>                    
                    </div>
                </div>              
            <?php } ?>
        </div>
    </body>
</html>
