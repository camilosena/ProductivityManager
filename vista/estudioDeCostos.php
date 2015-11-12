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
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                $proyecto = new FacadeProyectos;
                $proyectosSinCostos = $proyecto->proyectoSinEstudio();
                ?>
                <form class="formRegistro" method="post" action="../controlador/ControladorEstudioCostos.php">
                    <div class="modelo">
                            <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                            <input class="input" name="idProyecto" type="text" maxlength="64" value="0<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1" autofocus readonly required>
                            <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                            <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1" autofocus readonly required>
                        <hr>
                        <div><label class="tag1" for="subtotal1">Horas Directas utilizadas:</label><input type="range" id="subtotal1" min="1" max="200" value="1" ><span id="n_range1"></span>
                            <button type="button" id="btn_range1" style="display: inline">Calcular - M.O.D.</button><br>                                        
                            <label class="tag1">$</label> <input type="text" class="input9" id="horaDirecta" name="horaDirecta" value="">
                            <hr />
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
                        <div><label class="tag1" for="subtotal2">Horas Indirectas utilizadas:</label><input type="range" id="subtotal2" min="1" max="200" value="1" ><span id="n_range2"></span>
                            <button type="button" id="btn_range2" style="display: inline">Calcular - M.O.I.</button><br>
                            <label class="tag1">$</label> <input type="text" class="input9" id="horaIndirecta" name ="horaIndirecta" value="">
                            <hr />
                        </div>                                   
                        <div><label class="tag1" for="subtotal3">Horas Maquinaria utilizada:</label><input type="range" id="subtotal3" min="1" max="200" value="1" ><span id="n_range3"></span>
                            <button type="button" id="btn_range3" style="display: inline">Calcular Maquinaria</button><br>
                            <label class="tag1">$</label> <input type="text" class="input9" id="horaMaquinas" name="maquinaria" value="">
                            <hr />
                        </div>                                   
                        <div><label class="tag1" for="subtotal4">Costo Indirecto Fabricación</label><input type="range" id="subtotal4" min="1" max="200" value="1" ><span id="n_range4"></span>
                            <button type="button" id="btn_range4" style="display: inline;">Calcular Costo C.I.F.</button><br>
                            <label class="tag1">$</label><input type="text" class="input9" id="costoFabrica" name="costoFabrica" value="">
                            <hr />
                        </div>                                                                                                     
                        <div> 
                            <label class="tag" for="gastos"><span id="lab_valSurname" class="h331">Gastos:</span></label>
                            <input class="input9" name="gastos" required type="text" maxlength="64" id="gastos" class="field1" value="">                    
                            <br>                                    
                            <label class="tag" for="canEmpleados"><span id="lab_valSurname" class="h331">Empleados Necesarios:</span></label>
                            <input class="input9" name="canEmpleados" required type="text" maxlength="64" id="canEmpleados" class="field1" value="">                                                    
                            <label class="tag1" for="observacion"><span id="lab_valName" class="h331">Observaciones :</span></label>
                            <textarea  class="input10" name="observacion" type="text" maxlength="64" id="observacion" class="field1"></textarea>                                    
                            <hr>
                        </div>                                    
                        <div>   
                            <br>
                            <!--  Materia Prima--> 
                            <button type="button" id="materiaPrima" onclick="document.location.href = '#verMateria';" style="display: inline">Calcular Materia Prima</button><br> 
                            <br>
                            <label class="tag" for="materias"><span id="lab_valSurname" class="h331">Costo Materia Prima:</span></label>
                            <input class="input9" name="materiaPrima" required type="text" maxlength="64" id="materias" value="" class="field1" onfocus="alert('Haga Click en el boton (Calcular Materia Prima) para calcular este campo')" readonly>
                            <br><br><br><hr>
                        </div> 
                        <div>
                            <button type="button" id="btn_total" name="total" class="boton-verde" style="display: inline">Valor Total Proyecto </button><br>
                            <br>
                            <label class="tag1" for="totalCosto">Costo Total: $</label><input type="text" class="input9" name="totalCosto" id="totalCosto" value="" readonly><br>
                            <br><hr>
                        </div>                                    
                        <div>
                            <label class="tag1" for="utilidad"><span id="lab_valSurname" class="h331">Utilidad Generada:</span></label>
                            <input class="input9" name="utilidad" required type="text" maxlength="64" id="utilidad" class="field1" readonly>  
                            <br><label class="tag1" for="viabilidad"><span id="lab_valSurname" class="h331">Viabilidad de Proyecto:</span></label>
                            <input class="input9" name="viabilidad" required type="text" maxlength="64" id="viabilidad" class="field1" readonly>  
                            <button type="submit" id="crearCosto" name="crearCosto"  class="boton-verde">Aceptar</button><hr>
                        </div> 
                    </div>   
                </form>
                <!--        ventana modal-->
                <div id="verMateria" class="modalDialog2" title="Materia Prima"> 
                        <script>
                            $(function () {
                                $(":input").change(function () {
                                    $("#range1").html($("#madera1").val());
                                });
                                $("#btn_1").click(function () {
                                    madera = $("#madera1").val() * 64900;                                    
                                    document.getElementById('maderas1').value = madera;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#range2").html($("#tela1").val());
                                });
                                $("#btn_2").click(function () {
                                    tela= $("#tela1").val() * 25000;                                    
                                    document.getElementById('telas1').value = tela;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#range3").html($("#espuma1").val());
                                });
                                $("#btn_3").click(function () {
                                    espuma = $("#espuma1").val() * 15000;                                    
                                    document.getElementById('espumas1').value = espuma;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#range4").html($("#pintura1").val());
                                });
                                $("#btn_4").click(function () {
                                    pintura = $("#pintura1").val() * 185000;                                    
                                    document.getElementById('pinturas1').value = pintura;
                                });
                            });
                             $(function () {
                                $(":input").change(function () {
                                    $("#range5").html($("#pegante1").val());
                                });
                                $("#btn_5").click(function () {
                                    pegante = $("#pegante1").val() * 23900;                                    
                                    document.getElementById('pegantes1').value = pegante;
                                });
                            });
                            $(function () {
                                $(":input").change(function () {
                                    $("#range6").html($("#clavo1").val());
                                });
                                $("#btn_6").click(function () {
                                    clavo = $("#clavo1").val() * 11900;                                    
                                    document.getElementById('clavos1').value = clavo;
                                });
                            });
                             $(function () {                                
                                $("#totalMaterias").click(function () {
                                   if (document.getElementById('maderas1').value == '' ||
                                            document.getElementById('telas1').value == '' ||
                                            document.getElementById('espumas1').value == '' ||
                                            document.getElementById('pinturas1').value == '' ||
                                            document.getElementById('pegantes1').value == '' ||
                                            document.getElementById('clavos1').value == ''){
                                        if (document.getElementById('maderas1').value == '' ){
                                            alert('Falta Asignar Madera');
                                        } else if (document.getElementById('telas1').value == '') {
                                            alert('Falta Asignar Telas');
                                        } else if (document.getElementById('espumas1').value == '') {
                                            alert('Falta Asignar Espuma');
                                        } else if (document.getElementById('pinturas1').value == '') {
                                            alert('Falta Asignar Pintura');
                                        } else if (document.getElementById('pegantes1').value == '') {
                                            alert('Falta Asignar Pegantes');
                                        } else if (document.getElementById('clavos1').value == '') {
                                            alert('Falta Asignar Clavos / Grapas');
                                        }
                                    } else {
                                    totalMateriales = madera+tela+espuma+pintura+pegante+clavo;                                   
                                    document.getElementById('materias').value = totalMateriales;  
                                    document.getElementById('verMateria').style.display="none";
                                }
                                });
                            });
                        </script>
                        <div><a href="#close" title="Cerrar" class="close">X</a><br>
                            <h2 class="h330"><br>Materia Prima:</h2>
                         <div class="divMaterias"><label class="tag1" for="madera1">Metros de Madera:</label>
                            <input type="range" id="madera1" min="1" max="200" value="1" ><span id="range1"></span>
                            <div >
                                <button type="button" id="btn_1" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="maderas1" name="maderas1" value="">
                            </div>
                        </div>
                        <div class="divMaterias"><label class="tag1" for="tela1">Metros de Tela:</label>
                            <input type="range" id="tela1" min="1" max="200" value="1" ><span id="range2"></span>
                            <div >
                                <button type="button" id="btn_2" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="telas1" name="maderas1" value="">
                            </div>
                        </div>                   
                      <div class="divMaterias"><label class="tag1" for="espuma1">Laminas de Espuma:</label>
                            <input type="range" id="espuma1" min="1" max="200" value="1" ><span id="range3"></span>
                            <div >
                                <button type="button" id="btn_3" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="espumas1" name="espumas1" value="">
                            </div >
                        </div> 
                         <div class="divMaterias"><label class="tag1" for="pintura1">Galones de Pintura:</label>
                            <input type="range" id="pintura1" min="1" max="200" value="1" ><span id="range4"></span>
                            <div >
                                <button type="button" id="btn_4" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="pinturas1" name="pinturas1" value="">
                            </div>
                        </div> 
                        <div class="divMaterias"><label class="tag1" for="pegante1">Litros de Pegante:</label>
                            <input type="range" id="pegante1" min="1" max="200" value="1" ><span id="range5"></span>
                            <div >
                                <button type="button" id="btn_5" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="pegantes1" name="pegantes1" value="">
                            </div >
                        </div>
                        <div class="divMaterias"><label class="tag1" for="clavo1">Cajas Clavos / Grapas:</label>
                            <input type="range" id="clavo1" min="1" max="200" value="1" ><span id="range6"></span>
                            <div >
                            <button type="button" id="btn_6" style="display: inline">Calcular Madera</button>                                       
                            <label class="tag1"> $ </label><input type="text" class="input9" id="clavos1" name="clavos1" value="">                            
                            </div>
                        </div>
                         
                                <button type="button" id="totalMaterias" name="totalMaterias" class="boton-verde">Aceptar</button>
                           
                    </div>                    
                </div>
            </div>                  
        </div>
    <?php }else{
        echo '<h2 class="h330"><br>Debe Seleccionar Un Proyecto.</h2>';
    }  ?>
    </body>
</html>
