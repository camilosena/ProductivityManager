<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'estudioDeCostos';
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
    <body oncontextmenu="return false" onkeydown="checkData(event)">
    <script>
 function checkData(e) {
      if(e.shiftKey) {
        return false;
      }
      if(e.ctrlKey) {
        return false;
      }
      if(e.altKey) {
        return false;
      }
    };
    </script> 
    <script>
         window.onunload = function(){
            window.opener.location ='listarProyectos';};
    </script>
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
            setTimeout("cierra()",2000)
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
                <h5 style="text-decoration:underline">A continuación visualiza los costos requeridos para la ejecución del proyecto <?php echo $_GET['nameProject'];?>:</h5>                                                        
                <hr>
                <?php
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/EstudioCostosDAO.php';
                require_once '../facades/FacadeEstudioCostos.php';
                require_once'../facades/FacadeProyectos.php';
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../modelo/dao/UtilidadDAO.php';
                require_once '../modelo/utilidades/festivos.php';
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

                $FacadeProyectos = new FacadeProyectos();
                $fechaInicial = $FacadeProyectos->consultarProyecto($_GET['projectNum']); 
                $fechaInicio = date($fechaInicial['fechaInicio']);
                $nuevafecha = new DateTime($fechaInicio);
                $dia = $nuevafecha->format('d');
                $mes = $nuevafecha->format('m');
                $anio = $nuevafecha->format('Y');

                $festivo = new festivos();
                $diasSumar = intval($tiempoEstimado/8)+1;
                for ($i=1; $i <=$diasSumar ; $i++) { 
                    $festivo->festivos($anio);
                    $validaFestivo = $festivo->esFestivo($dia,$mes);
                    if( in_array(strtolower($nuevafecha->format('l')), array('sunday')) ){
                             $nuevafecha->modify('+2  day');
                        }
                    if($validaFestivo=='true'){
                       $nuevafecha->modify('+2  day');
                    }else{
                        $nuevafecha->modify('+1  day'); 
                        $dia = $nuevafecha->format('d');
                        $mes = $nuevafecha->format('m');
                        $anio = $nuevafecha->format('Y');
                        $validaFestivo = $festivo->esFestivo($dia,$mes);
                        if( in_array(strtolower($nuevafecha->format('l')), array('sunday')) ){
                             $nuevafecha->modify('+1  day');
                        }
                        if($validaFestivo=='true'){
                       $nuevafecha->modify('+1 day');
                        $dia = $nuevafecha->format('d');
                        $mes = $nuevafecha->format('m');
                        $anio = $nuevafecha->format('Y');
                        $validaFestivo = $festivo->esFestivo($dia,$mes);
                        if($validaFestivo=='true'){
                       $nuevafecha->modify('+1 day');
                        }
                        }
                    }
                        $dia = $nuevafecha->format('d');
                        $mes = $nuevafecha->format('m');
                        $anio = $nuevafecha->format('Y');
                        $final = $nuevafecha->format('Y-m-d'); 
                }
                ?>
                <script type="text/javascript">
                $(function(){   
                  $('#manoObra').mask('999.999.99')​;  
                });  
                </script>
                <form class="formRegistro" method="post" action="../controlador/ControladorEstudioCostos.php">
                    <div class="modelo">
                            <label class="tag2" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                            <input class="input" name="idProyecto" type="text" maxlength="64" value="0<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1"  readonly required>
                            <label class="tag2" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                            <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelManoObra" for="manoObra"><span id="lab_valCountry" class="h331">Costo Mano de Obra: </span></label>
                        <input class="input" name="manoDeObra" type="text" maxlength="64" value="<?php echo $costoManoObra; ?>" id="manoObra" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelManoObra" for="produccion"><span id="lab_valCountry" class="h331">Costo Materia Prima: </span></label>
                        <input class="input" name="costoProduccion" type="text" maxlength="64" value="<?php echo $costoProducto; ?>" id="produccion" style="text-align: center" class="field1"  readonly required>
                        <label class="tagPeso" id="labelUtilidad" for="util"><span id="lab_valCountry" class="h331">Utilidad: </span></label>
                        <input class="input" name="utilidad" type="text" maxlength="64" value="<?php echo $utilidadT; ?>" id="util" style="text-align: center" class="field1"  readonly required>
                        <label class="tag2" id="labelTiempo" for="time"><span id="lab_valCountry" class="h331">Tiempo Estimado (Horas): </span></label>
                        <input class="input" name="tiempoEstimado" type="text" maxlength="64" value="<?php echo $tiempoEstimado; ?>" id="time" style="text-align: center" class="field1"  readonly required>
                        <label class="tag2" id="labelViab" for="viab"><span id="lab_valCountry" class="h331">Empleados Requeridos: </span></label>
                        <input class="input" name="totalTrabajadores" type="text" maxlength="64" value="<?php echo $empleadosSolicitados; ?>" id="viab" style="text-align: center" class="field1"  readonly required>
    
                        <label class="tag2" id="labelFinal" for="final"><span id="lab_valCountry" class="h331">Fecha Final Estimada: </span></label>
                        <input class="input" name="fechaFinal" type="date" maxlength="64" value="<?php echo $final; ?>" id="final" style="padding-left:60px" class="field1"  readonly required>
                        

                        <label class="tagPeso" id="labelTotal" for="total"><span id="lab_valCountry" class="h331">Costo Total Proyecto: </span></label>
                        <input class="input" name="costoProyecto" type="text" maxlength="64" value="<?php echo $costoProyecto; ?>" id="total" style="text-align: center" class="field1"  readonly required>
                        <br><label class="tag2" style="position:relative;bottom:60px" id="labelObser" for="observa"><span id="lab_valCountry" class="h331">Observaciones: </span></label>
                        <textarea class="input" name="observaciones" style="width: 618px; height: 114px;border:1px solid #a0a0a0" rows="4" cols="50" maxlength="80"  id="observa"></textarea>
                        <button type="submit" name="crearCosto" id="crearCosto">Guardar Costos</button>
                        <hr>
                        <section style="widht:100%;">
                            <div style="float:left;">
                            <p class="obligatoriosD"><font style="font-weight:bold">Nota:</font><br>
                            La fecha final esta determinada en días hábiles laborales de 8 horas diarias.</p>
                            </div>
                            <div style="float:right;">
                            <button type="button" onclick="vDetalle()" id="verDtll">Ver Detalle</button>
                            <button type="button" onclick="oDetalle()" id="ocDtll" style="display:none">Ocultar Detalle</button>
                            </div>
                            <script type="text/javascript">
                                function vDetalle(){
                                    document.getElementById('detallesP').style.display="block";
                                    document.getElementById('ocDtll').style.display="block";
                                    document.getElementById('verDtll').style.display="none";
                                }
                                function oDetalle(){
                                    document.getElementById('detallesP').style.display="none";
                                    document.getElementById('ocDtll').style.display="none";
                                    document.getElementById('verDtll').style.display="block";
                                }
                            </script>
                        </section>
                    </div>   
                </form>
                </div> 
    </div>
         <section class="wrapper" id="detallesP" style="width:100%;float:left;text-align:center;background: #fff;margin-bottom:10px;margin-top:10px;display:none;">
            <?php
             require_once '../facades/FacadeInsumos.php';
             require_once '../modelo/dao/InsumosDAO.php';
            echo '<div id="infoGere" style="width:50%;float:left;">';
                $relacionMateria = new facadeInsumos();
                $relacionMateria = $relacionMateria->relacionMateriaPrimaProyecto($_GET['projectNum']);
                 echo '<table id="muestraDatos" style="margin-left:5%;margin-top:30px;width:90%;"><tr><th colspan="2" style="background:#fff;color:#000;border:none;">Relación de Materia Prima</th></tr>';
                foreach ($relacionMateria as $rMateria) {
                    echo '<tr><th colspan="2">Materia Prima Código 0'. $rMateria['idMateriaPrima'].' </th></tr>';
                   echo '<tr><td class="enunciado">Nombre: </td><td> ' . $rMateria['descripcionMateria'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Unidad / Medida:</td><td> ' . $rMateria['unidadDeMedida'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Costo Total:</td><td> $' . $rMateria['valorTotal'] . '</td></tr>';
                }
                echo '</table>';
                echo '</div>';
            ?>
            <?php
                require_once '../modelo/dao/ProcesosDAO.php';
                require_once '../facades/FacadeProcesos.php';
             echo '<div id="infoGere" style="width:50%;float:left;">';
                $relacionProcesos = new facadeProcesos();
                $relacionProcesos = $relacionProcesos->relacionProcesosProyecto($_GET['projectNum']);
                 echo '<table id="muestraDatos" style="margin-left:5%;margin-top:30px;width:90%;"><tr><th colspan="2" style="background:#fff;color:#000;border:none;">Relación de Procesos</th></tr>';
                foreach ($relacionProcesos as $rProceso) {
                    echo '<tr><th colspan="2">Proceso Código 0'. $rProceso['idProceso'].' </th></tr>';
                   echo '<tr><td class="enunciado">Nombre: </td><td> ' . $rProceso['tipoProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Cantidad Empleados / Medida:</td><td> ' . $rProceso['totalEmpleadosProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Total Horas:</td><td>' . $rProceso['totalTiempoProceso'] . '</td></tr>';
                   echo '<tr><td class="enunciado">Costo Total:</td><td> $' . $rProceso['totalPrecioProceso'] . '</td></tr>';
                }
                echo '</table>';
                echo '</div>';
            ?> 
    </section>          
    <?php }else{
        echo '<h2 class="h330"><br>Debe Seleccionar Un Proyecto.</h2>';
    }  ?>
    </body>
</html>
