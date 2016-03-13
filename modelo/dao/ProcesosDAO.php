<?php

class ProcesosDAO {

    function AgregarProceso(ProcesosDTO $pDTO, $producto, PDO $cnn) {

        try {
            $sentencia = $cnn->prepare("INSERT INTO procesos VALUES(?,?,?)");
            $sentencia->bindParam(1, $pDTO->getIdProceso());
            $sentencia->bindParam(2, $pDTO->getTipo());
            $sentencia->bindParam(3, $pDTO->getValor());
            $sentencia2 = $cnn->prepare("INSERT INTO procesoPorProducto VALUES(?,?,?,?)");
            $sentencia2->bindParam(1, $producto);
            $sentencia2->bindParam(2, $pDTO->getIdProceso());
            $sentencia2->bindParam(3, $pDTO->getEmpleados());
            $sentencia2->bindParam(4, $pDTO->getTiempo());

            $sentencia->execute();
            $sentencia2->execute();
            $mensaje = "Proceso Registrado con Éxito ";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }

        return $mensaje;
    }

    function consultarProcesos($idProceso, PDO $cnn) {

        try {
            $sql = "select idProceso, tipoProceso, precioProceso, idProductos, nombreProducto as producto, cantidadDeEmpleados as empleados, 
tiempoPorProceso as tiempo from procesos
 join procesoPorProducto on  idProceso = procesos_idProceso and idProceso=?
 join productos on idProductos_Productos = idProductos ";

            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProceso);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function listarProcesos(PDO $cnn) {

        try {
            $sql = "select idProceso, tipoProceso, precioProceso, nombreProducto as producto, cantidadDeEmpleados as empleados, 
tiempoPorProceso as tiempo from procesos
 join procesoPorProducto on  idProceso = procesos_idProceso
 join productos on idProductos_Productos = idProductos";

            $query = $cnn->prepare($sql);

            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function consecutivoProceso(PDO $cnn) {

        try {

            $query = $cnn->prepare('select max(idProceso) from procesos');

            $query->execute();
            $ultimo = $query->fetchColumn();
            return ($ultimo + 1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function ModificarProcesos(ProcesosDTO $procesosDTO, PDO $cnn) {

        $mensaje = "";
        try {
            $query = $cnn->prepare("update procesos set precioProceso=? where idProceso=?");
            $query->bindParam(1, $procesosDTO->getValor());
            $query->bindParam(2, $procesosDTO->getIdProceso());
            $query2 = $cnn->prepare("update procesoPorProducto set cantidadDeEmpleados=?, tiempoPorProceso=? where procesos_idProceso=?");
            $query2->bindParam(1, $procesosDTO->getEmpleados());
            $query2->bindParam(2, $procesosDTO->getTiempo());
            $query2->bindParam(3, $procesosDTO->getIdProceso());

            $query->execute();
            $query2->execute();
            $mensaje = "Proceso Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    function eliminarProceso($idProceso, PDO $cnn) {
        try {
            $sql = 'delete from  procesoPorProducto  where procesos_idProceso =?';

            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProceso);
            $sql2 = 'delete from procesos where idProceso=?';
            $query2 = $cnn->prepare($sql2);
            $query2->bindParam(1, $idProceso);
            $query->execute();
            $query2->execute();
            $mensaje = "Proceso eliminado";
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function obtenerProcesoPorProducto($idProducto, PDO $cnn) {
        try {
            $query = $cnn->prepare('select * from procesoPorProducto where idProductos_Productos=?');
            $query->bindParam(1, $idProducto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function obtenerProcesoPorID($idProceso, PDO $cnn) {
        try {
            $query = $cnn->prepare('select precioProceso from procesos where idProceso=?');
            $query->bindParam(1, $idProceso);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
     function relacionProcesosProyecto($idProyecto, PDO $cnn) {

            try {
                $query = $cnn->prepare("select * from procesosPorProyecto, procesos where idProyecto_proyectos = ? and idProceso = procesos_idProceso");
                $query->bindParam(1, $idProyecto);
                    $query->execute();
                 return   $query->fetchAll();
            } catch (Exception $ex) {
                $mensaje = $ex->getMessage();
            }
            $cnn = null;
        }
}
