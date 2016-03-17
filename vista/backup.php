<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'backup.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Generar BackUp</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    </head>
    <body>
          
            <div id="panelUnico">
                <br>
                <?php 
                require_once '../modelo/utilidades/Conexion.php';
                require_once '../modelo/dao/BackupDAO.php';
                require_once '../facades/FacadeBackup.php';
                $fBack = new FacadeBackup();
                $tablas = $fBack->listarTablas();
                print_r($tablas);
                ?>
                <h2 class="h330">Generar BackUp:</h2><br>               
                <form class="formRegistro"  id="formClientes" method="post" action="../controlador/ControladorBackUp.php" enctype="multipart/form-data"> 
                    <hr>
                    <label class="tag" for="tablas"><span id="lab_valCountry" class="h331">BackUp por tablas:</span></label>
                    <select class="input" name="tablas" id="tablas" class="list_menu" required>                                              
                        <?php
                        echo '<option disabled selected>' . "Seleccione una tabla" . '</option>';
                        foreach ($tablas as $tabla) {
                            
                            echo '<option value="' .$tabla['Tables_in_ges_productivitymanager']. '">' . $tabla['Tables_in_ges_productivitymanager'] . '</option>';                            
                        }
                        ?>
                    </select>
                    <br>
                    <label class="tag" for="tipo"><span id="lab_valCountry" class="h331">Tipo de archivo:</span></label>
                    <select class="input" name="tipo" id="tablas" class="list_menu" required>                                              
                         <option disabled selected>Seleccione un tipo de archivo</option>
                        <option value="sql">sql</option>
                        <option value="cvs">cvs</option>
                        <option value="txt">txt</option>
                    </select>
                    <br>
                    <button type="submit" name="backUpTablas" class="boton-verde">Generar</button><br>
                    
                </form> 
                 <form class="formRegistro"  id="formClientes" method="post" action="../controlador/ControladorBackUp.php" enctype="multipart/form-data"> 
                <button type="submit" name="backUpGeneral" class="boton-verde">BackUp general</button><br>
                </form> 
                <form class="formRegistro"  id="formClientes" method="post" action="../controlador/ControladorBackUp.php" enctype="multipart/form-data"> 
                
                <?php
                $dir = "../BackUp";
$directorio = opendir($dir); 
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if ($archivo == ".." || $archivo == ".")//verificamos si es o no un directorio
    {
        //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
        echo $archivo .'<a title="Descargar" class="me"  href="../controlador/ControladorBackUp.php?idDownload='.$dir."/".$archivo.'" onclick=" return confirmacion()"><img class="iconos" src="../img/desactivarUsuario.png"></a></td><br>';
    }
}

?>
                    
                </form>

            </div>
        </div>      	
    </body>
</html>
