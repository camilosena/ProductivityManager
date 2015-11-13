<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reportes</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
        <link rel="stylesheet" type="text/css" href="../css/JorgeCss.css">
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
        <script>
            $(document).ready(function () {
                $("#selectProyectoEstado").on("change", function () {
                    $.ajax({
                        url: "../peticiones_ajax/ajax_listar_estados.php",
                        method: "POST",
                        data: {
                            selectProyecto: $(this).val(),
                            accion: "estado"
                        },
                        success: function (data) {
                            $("#estado").html(data);
                        },
                        error: function (error) {
                            alert(error);
                        }
                    });
                    //alert($(this).val());
                });
            });
        </script>
        
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
            <li><a><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a>
           <ul>
               <li><a href='Reportes.php?tipoReporte=Costos'><span><i class="fa fa-key fa-lg"></i> Estudio de Costos</span></a>       
                 </li>
                 <li><a href='Reportes.php?tipoReporte=Proyectos'><span><i class="fa fa-picture-o fa-lg"></i> Proyectos </span></a>              
                 </li>
              </ul>
           </li>
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
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="CrearRol.php" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Reportes</span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Reporte de <?php echo $_GET['tipoReporte']?>:</h2><hr>
                <div id="exports" style="float:right;padding-bottom:10px;">
                    <img src="../img/imprimir.png">
                    <img src="../img/email.png">
                    <img src="../img/pdf.png">
                    <a href='../modelo/utilidades/Reportes/ExportarProyecto.php'><img src="../img/excel.png" title="Exportar a Exccel"></a>
                </div>
                <p ></p><br><br>
                <?php
                if (isset($_GET['tipoReporte'])) {
                    require_once '../modelo/utilidades/Conexion.php';
                    require_once '../facades/FacadeProyectos.php';
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../facades/FacadeProductos.php';
                    require_once '../modelo/dao/ProductosDAO.php';
                    $facadeProyectos = new FacadeProyectos();
                    $facadeProductos = new FacadeProductos();
                    if ($_GET['tipoReporte']=='Proyectos') {
                        
                        // Reporte de Proyectos
                ?>
                <form name="Reportes" class="formRegistro" method="post" action="../controlador/ControladorReportes.php"> 
                    <div id="panelReportes" style="background-color: background" >    
                 <div id="panelIzqReportes">                                   
                     <label style="display: inline">Proyectos</label> 
                      <select style="width: 60%" id="selectProyectoEstado" name="selectProyectoEstado" class="input"> 
                     <?php
                     $proyectos = $facadeProyectos->listadoProyectos();
                        echo '<option value="0" style="color:gray">' . "Seleccione un proyecto" . '</option>';
                        foreach ($proyectos as $proyecto) {
                            echo '<option value="' . $proyecto['idProyecto'] . '">' . $proyecto['nombreProyecto'] . '</option>';                            
                        }
                        ?>
                    </select><br><br><br>
                    <label style="display: inline">Fecha de Inicio</label>
                    <input type="date" name="fechaInicial" style="display: inline">
                 </div>  
                 <div id="panelDerReportes">                                   
                        <label style="display: inline">Estado</label> 
                        <select style="width: 60%" id="estado" style="display: inline" name="estado" class="input" > 
                       <option value="0" style="color:gray">Seleccione un estado</option>
                       <option value="Ejecucion" >Ejecución</option>
                       <option value="Cancelado" >Cancelado</option>
                       <option value="Finalizado" >Finalizado</option>
                       <option value="Aplazado" >Aplazado</option>
                       <option value="costos" >Sin estudio de costos</option>

                    </select><br><br><br>
                    <label style="display: inline">Fecha de Fin</label>
                    <input type="date" name="fechaFinal" style="display: inline">

                 </div> 
                </div> <br><br><br>
                <div id="panelReportes" > 
                  <button type="submit" value="reporteProyecto" name="reporteProyecto" id="reporteProyecto" class="boton-verde">Ver Reporte</button><br>
                 </div>
                <div id="panelUnico" >     <hr>                               
                        <label style="display: inline">"Mostrar Seleccion" -----></label>
                        <table id="tableReporteProyecto" style="border: #336442">
                            <thead style="border: #336442">
                            <th style="border: #336442">Proyecto</th>
                            <th>estado</th>    
                            </thead>
                            
                        </table>
                     
                 </div> 
                
                </form><br>
                <?php
                    }
                }
                ?>
                
            </div>
        </div>    
        
    </body>
</html>

<!--Para Reporte de productos
<div id="panelDerReportes">                                   
                        <label style="display: inline">Producto</label> 
                        <select style="width: 60%" id="selectProducto" name="selectProducto" class="input" > 
                     <?php
//                     $prodcuctos = $facadeProductos->listarProductos();//
//                        echo '<option value="0" style="color:gray">' . "Seleccione un producto" . '</option>';
//                        foreach ($prodcuctos as $prodcucto) {
//                            echo '<option value="' . $prodcucto['idProducto'] . '">' . $prodcucto['nombreProducto'] . '</option>';                            
//                      }
                        ?>
                    </select><br>


                 </div> -->