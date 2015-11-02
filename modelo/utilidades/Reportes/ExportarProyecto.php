<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>ExportarProyecto</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=InformeProyectos.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <tr>
        <th>Codigo</th>
        <th>Nombre de Proyecto</th>
        <th>Inicio</th>
        <th>Entrega</th>
        <th>Estado</th>
        <th>Ejecutado</th>
    </tr>
    <?php
    foreach ($_SESSION['consultaProyecto'] as $respuesta){
    ?>
    <tr>
        <td><?php echo $respuesta['idProyecto'];?></td>
        <td><?php echo $respuesta['nombreProyecto'];?></td>
        <td><?php echo $respuesta['fechaInicio'];?></td>
        <td><?php echo $respuesta['fechaFin'];?></td>
        <td><?php echo $respuesta['estadoProyecto'];?></td>
        <td><?php echo $respuesta['ejecutado'];?>%</td>
    </tr>
<?php
unset($_SESSION['consultaProyecto']);
}
?>