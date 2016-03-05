<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>ExportarNovedad</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=InformeNovedades.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <tr>
        <th>Codigo</th>
        <th>Nombre de Proyecto</th>
        <th>Categoria</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php
    foreach ($_SESSION['consultaNovedad'] as $respuesta){
    ?>
    <tr>
        <td><?php echo $respuesta['idNovedad'];?></td>
        <td><?php echo $respuesta['nombreProyecto'];?></td>
        <td><?php echo $respuesta['categoria'];?></td>
        <td><?php echo $respuesta['descripcionNovedad'];?></td>
        <td><?php echo $respuesta['fechaNovedad'];?></td>
        <td><?php echo $respuesta['estadoSolucion'];?></td>
    </tr>
<?php
unset($_SESSION['consultaNovedad']);
}
?>