<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>ExportarAuditoria</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=InformeAuditorias.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <tr>
        <td>Codigo</td>
        <td>Gerente Auditoria</td>
        <td>Nombre de Proyecto</td>
        <td>Fecha de Auditoria</td>
        <td>Categoria</td>
        <td>Observaciones</td>
    </tr>
    <?php
    foreach ($_SESSION['consultaAuditoria'] as $respuesta){
        ?>
        <tr>
            <td><?php echo utf8_encode( $respuesta['idAuditoria']) ?></td>
            <td><?php echo utf8_encode( $respuesta['gerenteAuditoria']) ?></td>
            <td><?php echo utf8_encode( $respuesta['nombreProyecto']) ?></td>
            <td><?php echo utf8_encode( $respuesta['fecha']) ?></td>
            <td><?php echo utf8_encode( $respuesta['fecha']); ?></td>
            <td><?php echo utf8_encode( $respuesta['observacionesAuditoria']); ?></td>
        </tr>
    <?php
        unset($_SESSION['consultaAuditoria']);
    }
    ?>

