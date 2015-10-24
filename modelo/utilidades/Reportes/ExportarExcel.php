<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<head>
    <meta charset="UTF-8">
    <title>Exportar clientes</title>
</head>
<body>

<?php
session_start();
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=excel-.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<?php
if(isset($_SESSION['consultaAuditoria'])){
?>

<table border="1">
    <tr>
        <td>Código</td>
        <td>Gerente Auditoria</td>
        <td>Nombre de Proyecto</td>
        <td>Fecha de Auditoria</td>
        <td>Descripcion</td>
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
    }
    unset($_SESSION['consultaAuditoria']);
    ?>
    <?php
    }

    else if(isset($_SESSION['consultaUsuario'])){
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
        }
        unset($_SESSION['consultaUsuario']);
        ?>
        <?php
        }
        else if(isset($_SESSION['consultaProyecto'])){
        ?>

        <table border="1">
            <tr>
                <td>Codigo</td>
                <td>Nombre del Proyecto</td>
                <td>Fecha de Inicio</td>
                <td>Entrega</td>
                <td>Estado</td>
                <td>Ejecutado</td>
            </tr>
            <?php
            foreach ($_SESSION['consultaProyecto'] as $respuesta){
                ?>
                <tr>
                <tr><td><?php echo $project['idProyecto']; ?> </td>
                    <td><?php echo $project['nombreProyecto']; ?> </td>
                    <td> <?php echo $project['fechaInicio']; ?> </td>
                    <td><?php echo $project['fechaFin']; ?></td>
                    <td><?php echo $project['estado']; ?></td>
                    <td><?php echo $project['ejecutado']; ?> %</td>
                </tr>

                <?php
            }
            unset($_SESSION['consultaProyecto']);
            ?>
            <?php
            }
            ?>



        </table>
</body>
</html>