<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'backup';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>BackUps</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/animate.css">
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
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
        ?>     
           <div class="container">
                <div class="row"> 
                    <span class="animationSandbox">
                      <h1 style=" font-size:30px;font-weight: bold;
                    text-align: center;
                    font-family:sans-serif;   
                    color: #83AF44;" class="animated zoomIn">Generación de BackUp's</h1>
                    </span>
                <hr>
                <?php 
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/BackupDAO.php';
                require_once '../facades/FacadeBackup.php';
                $fBack = new FacadeBackup();
                $tablas = $fBack->listarTablas();
                ?>  
                <div class="row">
                     <form rol="form" class="animated fadeInDown" method="post" action="../controlador/ControladorBackUp.php" >
                        <div class="form-group">
                             <label for="reportType" >BackUp por tablas:</label>
                                <select name="tablas" class="form-control" required>
                                    <option value="" disabled selected>Seleccione una tabla</option>
                                   <?php   
                                   foreach ($tablas as $tabla) {
                                    echo '<option value="' .$tabla['Tables_in_ges_productivitymanager']. '">' . $tabla['Tables_in_ges_productivitymanager'] . '</option>';                            
                                        }
                                        ?>
                                </select>
                        </div>
                         <div class="form-group">
                            <label for="reportType" >Tipo de archivo (Extensión):</label>
                                <select name="tipo"  class="form-control" required>
                                        <option value="" disabled selected>Seleccione un tipo de archivo</option>
                                        <option value="sql">sql</option>
                                        <option value="cvs">cvs</option>
                                        <option value="txt">txt</option>
                                </select>
                        </div>
                            <div class="row text-center">
                                <button type="submit" name="backUpTablas" class="btn btn-success animated zoomIn">Generar BackUp</button>
                            </div>
                      </form>
                </div>    
                <hr>   
                <div class="row text-center">
                     <form rol="form" class="animated fadeInDown" method="post" action="../controlador/ControladorBackUp.php" >
                            <div class="form-group">
                                 <label for="reportType" >A solo un click puede generar su BackUp General de información</label><br>
                                 <span class="glyphicon glyphicon-chevron-down"></span><br>
                                  <button type="submit" name="backUpGeneral" class="btn btn-success animated zoomIn"> BackUp general</button>
                            </div>
                    </form> 
                </div> 
                <hr>
                <div class="row">
                    <table class="table table-hover animated fadeInRight" id="table-backups" style="display:none;">
                    <thead>
                      <tr>
                        <th class="text-center">BackUp Generado</th>
                        <th class="text-center">Descargar</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                $dir = "../BackUp";
                $directorio = opendir($dir); 
                while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                {
                    if ($archivo == ".." || $archivo == ".")//verificamos si es o no un directorio
                    {
                        
                    }
                    else
                    {
                        ?>
                        <script>
                            $('#table-backups').show();
                        </script>
                        <tr>
                        <td class="text-center"><?php echo $archivo;?></td>
                        <td class="text-center">
                        <a title="Descargar" href="../controlador/ControladorBackUp.php?idDownload=<?php echo $archivo; ?>"><span class="glyphicon glyphicon-circle-arrow-down"></span></a>
                        </td>
                      </tr>
                        <?php
                    }
                }

                ?>     
                    </tbody>
                  </table>
                </div>
            </div>
        </div>  	
    </body>
</html>
