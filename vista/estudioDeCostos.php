<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'estudioDeCostos.php';
$session = new Session($pagActual);
$session->Session($pagActual);
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
            function cierra(){
            window.close();
            }
            setTimeout("cierra()",3000)
            </script>';
        };
        ?>     
        <div class="wrapper">   
        <?php if (isset($_GET['mensajeError'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["error"]("<?php echo $_GET['mensajeError']; ?>")

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
            <div>
                <?php if (isset($_GET['projectNum'])) { ?>
                <h2 class="h330"><br>Estudio de Costos:</h2><br>
                <h5 style="text-decoration:underline">Deslice la barra de cada campo para seleccionar un valor:</h5>                                                        
                <hr>
                <?php
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/EstudioCostosDAO.php';
                require_once '../facades/FacadeEstudioCostos.php';
                require_once'../facades/FacadeProyectos.php';
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../modelo/dao/UtilidadDAO.php';
                $fEstudio = new FacadeEstudioCostos();
                $costoManoObra = $fEstudio->costoManoDeObra($_GET['projectNum']);
                $costoProducto = $fEstudio->costoProduccion($_GET['projectNum']);
                $utilidadDAO = new UtilidadDAO();
                $util= $utilidadDAO->calculoUtilidad($_GET['projectNum']);
                $sub = $costoManoObra + $costoProducto;
                $utilidadT=0;
                foreach($util as $al){
                    $utilidadT =  ($al*$sub/100)+$utilidadT;
                }
                $costoProyecto = $costoProducto+$costoManoObra+$utilidadT;
                $tiempoEstimado = $fEstudio->tiempoEstimado($_GET['projectNum']);
                $empleadosSolicitados = $fEstudio->empleadosSolicitados($_GET['projectNum']);
                ?>
                <form class="formRegistro" method="post" action="../controlador/ControladorEstudioCostos.php">
                    <div class="modelo">
                            <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                            <input class="input" name="idProyecto" type="text" maxlength="64" value="0<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1"  readonly required>
                            <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                            <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelManoObra" for="manoObra"><span id="lab_valCountry" class="h331">Costo Mano de Obra: </span></label>
                        <input class="input" name="manoDeObra" type="text" maxlength="64" value="<?php echo $costoManoObra; ?>" id="manoObra" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelManoObra" for="produccion"><span id="lab_valCountry" class="h331">Costo Productos: </span></label>
                        <input class="input" name="costoProduccion" type="text" maxlength="64" value="<?php echo $costoProducto; ?>" id="produccion" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelUtilidad" for="util"><span id="lab_valCountry" class="h331">Utilidad: </span></label>
                        <input class="input" name="utilidad" type="text" maxlength="64" value="<?php echo $utilidadT; ?>" id="util" style="text-align: center" class="field1"  readonly required>
                        <label class="tag2" id="labelTiempo" for="time"><span id="lab_valCountry" class="h331">Tiempo Estimado (Horas): </span></label>
                        <input class="input" name="tiempoEstimado" type="text" maxlength="64" value="<?php echo $tiempoEstimado; ?>" id="time" style="text-align: center" class="field1"  readonly required>
                        <label class="tag2" id="labelViab" for="viab"><span id="lab_valCountry" class="h331">Empleados Requeridos: </span></label>
                        <input class="input" name="viabilidad" type="text" maxlength="64" value="<?php echo $empleadosSolicitados; ?>" id="viab" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelTotal" for="total"><span id="lab_valCountry" class="h331">Costo Total Proyecto: </span></label>
                        <input class="input" name="costoProyecto" type="text" maxlength="64" value="<?php echo $costoProyecto; ?>" id="total" style="text-align: center" class="field1"  readonly required>
                        <label class="tag2" style="position:relative;bottom:60px" id="labelObser" for="observa"><span id="lab_valCountry" class="h331">Observaciones: </span></label>
                        <textarea class="input" name="observaciones" style="width: 618px; height: 114px; maxlength='180';border:1px solid #f0f0f0"  id="observa"></textarea>
                        <hr>
                        <div><label class="tag1" for="subtotal1">Provisión:</label><input type="range" id="subtotal1" min="1" max="200" value="100" ><span id="n_range1"></span>
                            <button type="button" id="btn_range1" style="display: inline">Calcular - M.O.D.</button><br>                                        
                            <label class="tag1">$</label> <input type="text" class="input9" id="horaDirecta" name="horaDirecta" value="">
                            <hr>
                        </div>
                        <script>
                            $(function () {
                                $(":input").change(function () {
                                    $("#n_range1").html($("#subtotal1").val());
                                });
                                $("#btn_range1").click(function () {
                                    subtotal1 = $("#subtotal1").val() * 6250;
                                    document.getElementById('horaDirecta').value = subtotal1;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#n_range2").html($("#subtotal2").val());
                                });
                                $("#btn_range2").click(function () {
                                    subtotal2 = $("#subtotal2").val() * 8300;
                                    document.getElementById('horaIndirecta').value = subtotal2;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#n_range3").html($("#subtotal3").val());
                                });
                                $("#btn_range3").click(function () {
                                    subtotal3 = $("#subtotal3").val() * 25000;
                                    document.getElementById('horaMaquinas').value = subtotal3;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#n_range4").html($("#subtotal4").val());
                                });

                                $("#btn_range4").click(function () {
                                    subtotal4 = $("#subtotal4").val() * 564;
                                    document.getElementById('costoFabrica').value = subtotal4;
                                });

                                $("#btn_total").click(function () {
                                    if (document.getElementById('horaDirecta').value == '' ||                                             
                                            document.getElementById('horaIndirecta').value == '' ||
                                            document.getElementById('horaMaquinas').value == '' ||
                                            document.getElementById('costoFabrica').value == '' ||
                                            document.getElementById('materias').value == '' ||
                                            document.getElementById('gastos').value == '' ||
                                            document.getElementById('canEmpleados').value == '')
                                    {
                                        if (document.getElementById('horaDirecta').value == '') {
                                            alert('Falta Asignar Horas Directas');
                                        } else if (document.getElementById('horaIndirecta').value == '') {
                                            alert('Falta Asignar Horas Indirectas');
                                        } else if (document.getElementById('horaMaquinas').value == '') {
                                            alert('Falta Asignar Horas Maquinaria');
                                        } else if (document.getElementById('costoFabrica').value == '') {
                                            alert('Falta Asignar Costo Indirecto Fabricacion');
                                        } else if (document.getElementById('materias').value == '') {
                                            alert('Falta Calcular Costo Materia Prima');
                                        }  else if (document.getElementById('gastos').value == '') {
                                            alert('Falta Incluir Gastos de Proyecto');
                                        }else if (document.getElementById('canEmpleados').value == '') {
                                            alert('Asigne Cantidad de Empleados Para el Proyecto');
                                        }                                       
                                    } else {                              
                                        gastos = document.getElementById('gastos').value;
                                        materiales = document.getElementById('materias').value;
                                        total = (subtotal1 + subtotal2 + subtotal3 + subtotal4)+(materiales*1);
                                        utilidad =total*0.10;
                                        document.getElementById('totalCosto').value = total;
                                        document.getElementById('utilidad').value = utilidad;
                                        if(utilidad>gastos){
                                        document.getElementById('viabilidad').value ="Viable";
                                        }else if(utilidad<gastos){
                                            document.getElementById('viabilidad').value ="No Viable";
                                        }
                                    }
                                });
                            });
                        </script>
                        <div><label class="tag1" for="subtotal2">Provisión:</label><input type="range" id="subtotal2" min="1" max="200" value="1" ><span id="n_range2"></span>
                            <button type="button" id="btn_range2" style="display: inline">Calcular - M.O.I.</button><br>
                            <label class="tag1">$</label> <input type="text" class="input9" id="horaIndirecta" name ="horaIndirecta" value="">
                            <hr />
                        </div>
                    </div>   
                </form>
                </div>
            </div>                  
        </div>
    <?php }else{
        echo '<h2 class="h330"><br>Debe Seleccionar Un Proyecto.</h2>';
    }  ?>
    </body>
</html>
