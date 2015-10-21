<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>ExportarClienteActivo</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=InformeClientesActivos.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <tr>
        <th>Codigo</th>
        <th>NIT</th>
        <th>Empresa</th>
        <th>Telefono</th>
        <th>Sector Economico</th>
        <th>Sector Empresarial</th>
    </tr>
    <?php
    foreach ($_SESSION['consultaActivos'] as $respuesta){
    ?>
    <tr>
        <td><?php echo $respuesta['idUsuario'];?></td>
        <td><?php echo $respuesta['nit'];?></td>
        <td><?php echo $respuesta['nombreCompania'];?> </td>
        <td><?php echo $respuesta['telefonoFijo'];?></td>
        <td><?php echo $respuesta['sectorEconomico'];?></td>
        <td><?php echo $respuesta['sectorEmpresarial'];?></td>
    </tr>
<?php
unset($_SESSION['consultaActivos']);
}
?>