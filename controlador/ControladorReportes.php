<?php
   
if(isset($_POST['generarAnio'])){
        header("location: ../vista/reportes.php?grAnio=".$_POST['anio']);
}