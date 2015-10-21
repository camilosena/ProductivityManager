<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>ExportarUsuario</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=InformeUsuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <tr>
        <td>Usuario</td>
        <td>Identificación</td>
        <td>Nombres</td>
        <td>Apellidos</td>
        <td>Email</td>
        <td>Rol</td>
    </tr>
    <?php
    foreach ($_SESSION['consultaUsuario'] as $respuesta){
    ?>
    <tr>
        <td><?php echo $respuesta['idUsuario']; ?> </td>
        <td><?php echo $respuesta['identificacion']; ?> </td>
        <td> <?php echo$respuesta['nombres']; ?> </td>
        <td><?php echo $respuesta['apellidos']; ?></td>
        <td><?php echo $respuesta['email']; ?></td>
        <td><?php echo $respuesta['rol']; ?></td>
    </tr>
<?php
unset($_SESSION['consultaUsuario']);
}
?>