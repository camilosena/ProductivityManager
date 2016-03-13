<?php

class InsumosDAO {

    //put your code here

    function agregarInsumo(InsumosDTO $Idto, PDO $cnn) {

        try {
            $query = $cnn->prepare("Insert into materiaprima values(?,?,?,?)");
            $query->bindParam(1, $Idto->getId());
            $query->bindParam(2, $Idto->getNombre());
            $query->bindParam(3, $Idto->getMedida());
            $query->bindParam(4, $Idto->getPrecio());

            $query->execute();
            $mensaje = "Insumo Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    function listarInsumos(PDO $cnn) {

        try {
            $sql = "select idMateriaPrima as numero, descripcionMateria as nombre, unidadDeMedida as unidad, precioBase as precio from materiaprima";
            $query = $cnn->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function consecutivoInsumos(PDO $cnn) {

        try {

            $query = $cnn->prepare('select max(idMateriaPrima) from materiaprima');

            $query->execute();
            $ultimo = $query->fetchColumn();
            return ($ultimo + 1);
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function eliminarInsumo($idEliminar, PDO $cnn) {
        try {
            $query = $cnn->prepare('delete from materiaPrimaPorProducto where ProductosIdProductos=?');
            $query->bindParam(1, $idEliminar);
            $query->execute();
            $mensaje = "Registro eliminado";
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function obtenerInsumos($idProducto, PDO $cnn) {

        try {

            $sql = 'SELECT idMateriaPrima_materiaPrima insumos,cantidadMateriaPorProducto from materiaPrimaPorProducto where ProductosIdProductos=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProducto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function obtenerInsumoPorID($idMateriaPrima, PDO $cnn) {

        try {

            $sql = 'SELECT precioBase from materiaprima where idMateriaPrima=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idMateriaPrima);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

        function consultarrMateriaPrima($idMateriaPrima, PDO $cnn) {

        try {
            $sql = "SELECT * FROM materiaprima where idMateriaPrima=?";
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idMateriaPrima);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

        function modificarMateriaPrima(InsumosDTO $Idto, PDO $cnn) {

        $mensaje = "";
        try {
            $query = $cnn->prepare("update materiaprima set descripcionMateria=?, unidadDeMedida=?, precioBase=? where idMateriaPrima=?");
            $query->bindParam(1, $Idto->getNombre());
            $query->bindParam(2, $Idto->getMedida());
             $query->bindParam(3, $Idto->getPrecio());
            $query->bindParam(4, $Idto->getId());
            $query->execute();
            $mensaje = "Materia Prima Actualizada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    function relacionMateriaPrimaProyecto($idProyecto, PDO $cnn) {

        try {
            $query = $cnn->prepare("SELECT * FROM materiaPrimaPorProyecto, materiaprima where proyectos_idProyecto = ? and idMateriaPrima = materiaPrima_idMateriaPrima");
            $query->bindParam(1, $idProyecto);
                $query->execute();
             return   $query->fetchAll();
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
    }
}
