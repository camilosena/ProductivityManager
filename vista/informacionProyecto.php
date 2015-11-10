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
    <script src="../js/scriptModales.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/infoProject.css">
</head>
<body onLoad="setTimeout(window.close, 50000)">
<div class="wrapper">
    <?php if (isset($_GET['projectNum'])) { ?>
    <h2 class="h330"><br>Proyecto <?php echo  $_GET['nameProject']; ?>:</h2><br>
        <hr>
    <?php
    require_once '../facades/FacadeProductos.php';
    require_once '../modelo/dao/ProductosDAO.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../facades/FacadeProyectos.php';
    require_once '../modelo/utilidades/Conexion.php';
    $facadeProductos = new FacadeProductos;
    $facadeProyecto = new FacadeProyectos;
    $products = $facadeProyecto->obtenerDatoProductoProyecto($_GET['projectNum']);
    if(count($products)>=1){?>
        <div>
            <strong><h2 class="h331" style="margin-left:14%;">Productos Requeridos:</h2></strong><br>
            <table class="tableSection">
                <thead>
                <tr>
                    <th class="th1"><span class="text">Código</span>
                    </th>
                    <th class="th2"><span class="text">Nombre</span>
                    </th>
                    <th class="th3"><span class="text">Cantidad</span>
                    </th>
                    <th class="th4"><span class="text">Ganancia</span>
                    </th>
                    <th class="th5"><span class="text">Visualizar</span>
                    </th>
                </tr>
                </thead>
                <tbody>
               <?php
                foreach ($products as $productos) {
                    ?>
                    <tr>
                        <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                        <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                        <td class="td3"><?php echo $productos['cantidadProductos']; ?></td>
                        <td class="td4"><?php echo $productos['ganancia']; ?>%</td>
                        <td class="td5"><a class='group1' href="../productos/<?php echo $productos['fotoProducto']; ?>"
                                           title="Click En Siguiente"><img src="../img/products.png" width="20"
                                                                           height="20"></td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
    <?php }?>
        <div>
            <?php

            //  Consultar Proyecto
            if (isset($_GET['projectNum'])) {
                $proyectos = $facadeProyecto->consultarProyecto($_GET['projectNum']);
                echo '<div id="infoPro">';
                echo '<table id="muestraDatos"><tr><th colspan="2">Información de Proyecto</th></tr>';
                echo '<tr><td class="enunciado">Código:</td><td>0' . $proyectos['idProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $proyectos['nombreProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Inicio:</td><td>' . $proyectos['fechaInicio'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Fin:</td><td> ' . $proyectos['fechaFin'] . '</td></tr>';
                echo '<tr><td class="enunciado">Estado:</td><td>' . $proyectos['estadoProyecto'] . '</td></tr>';
                echo '<tr><td class="enunciado">Ejecutado:</td><td>' . $proyectos['ejecutado'] . '%</td></tr>';
                echo '<tr><td class="enunciado">Observaciones:</td><td>' . $proyectos['observaciones'] . '</td></tr>';
                echo '<tr><td class="enunciado">Opciones:</td><td>';
                $comi = "'";
                if ($proyectos['estadoProyecto'] != 'Ejecucion') {
                    echo '<a class="me" title="Modificar Proyecto"href="javascript:modificarProyecto(' . $comi . 'modificarProyecto.php?idProject='. $proyectos['idProyecto'] . $comi . ');"><img class="iconos" src="../img/modify.png"></a>';
                }
                if ($proyectos['estadoProyecto'] == 'Sin Estudio Costos') {
                    echo '<a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos(' . $comi . 'estudioDeCostos.php?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/costos.png"></a>';
                } elseif ($proyectos['estadoProyecto'] == 'Sin Produccion') {
                    echo '<a class="me" title="Incluir Producción" href="javascript:produccionProyecto(' . $comi . 'produccionProyecto.php?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/products.png"></a>';

                }
                require_once '../modelo/utilidades/Conexion.php';
                $facadeProyecto = new FacadeProyectos;
                $clie = $facadeProyecto->clienteAsignado($proyectos['idProyecto']);
                echo '</table>';
                echo '</div><div id="infoClient">';
                echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Cliente</th></tr>';
                echo '<tr><td class="enunciado">Código:</td><td>0' . $clie['idCliente'] . '</td></tr>';
                echo '<tr><td class="enunciado">Empresa:</td><td>' . $clie['nombreCompania'] . '</td></tr>';
                echo '<tr><td class="enunciado">NIT:</td><td>' . $clie['nit'] . '</td></tr>';
                echo '<tr><td class="enunciado">Sector Empresarial:</td><td>' . $clie['sectorEmpresarial'] . '</td></tr>';
                echo '<tr><td class="enunciado">Sector Económico:</td><td>' . $clie['sectorEconomico'] . '</td></tr>';
                echo '<tr><td class="enunciado">PBX:</td><td>' . $clie['telefonoFijo'] . '</td></tr>';
                echo '<tr><td colspan="2" style="text-align:center">Representante Legal</td></tr>';
                echo '<tr><td class="enunciado">Identificación:</td><td> ' . $clie['identificacion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $clie['nombre'] . '</td></tr>';
                echo '<tr><td class="enunciado">Dirección:</td><td>' . $clie['direccion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Teléfono:</td><td>' . $clie['telefono'] . '</td></tr>';
                echo '<tr><td class="enunciado">Correo Electronico:</td><td>' . $clie['email'] . '</td></tr>';
                echo '</table>';
                echo '</div><div id="infoGere">';
                $pro = $facadeProyecto->gerenteDeProyecto($proyectos['idProyecto']);
                echo '<table id="muestraDatos"><tr><th colspan="2">Gerente Encargado</th></tr>';
                echo '<tr><td class="enunciado">Código Gerente:</td><td>0' . $pro['idUsuario'] . '</td></tr>';
                echo '<tr><td class="enunciado">Nombre:</td><td>' . $pro['nombre'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Inicio:</td><td>' . $pro['direccion'] . '</td></tr>';
                echo '<tr><td class="enunciado">Fecha Fin:</td><td> ' . $pro['telefono'] . '</td></tr>';
                echo '<tr><td class="enunciado">Estado:</td><td>' . $pro['email'] . '</td></tr>';
                echo '<tr><td class="enunciado">Ejecutado:</td><td>' . $pro['nombreArea'] . '</td></tr>';
                echo '</table>';
                echo '</div>';
            }
            ?>
        </div>
        <hr>
    <script language=javascript>
        function modificarProyecto(URL) {
            window.open(URL, "modificarProyecto.php", "width=1180,height=645,top=30,left=25,scrollbars=NO");
        }
    </script>
    <script language=javascript>
        function estudioCostos(URL) {
            window.open(URL, "estudioDeCostos.php", "width=1000,height=645,top=30,left=150,scrollbars=NO");
        }
    </script>
    <script language=javascript>
        function produccionProyecto(URL) {
            window.open(URL, "produccionProyecto.php", "width=1000,height=645,top=30,left=150,scrollbars=NO");
        }
    </script>
</div>
<?php }
?>
</body>
</html>
