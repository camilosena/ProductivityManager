<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AgregarInsumosDAO
 *
 * @author Jorge M. Izquierdo N
 */
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
            $sql = "select idMateriaPrima as numero, descripcionMateria as nombre, unidadDeMedida as unidad, concat('$',' ', precioBase) as precio from materiaprima";
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
            $query = $cnn->prepare('delete from materiaprimaporproducto where ProductosIdProductos=?');
            $query->bindParam(1, $idEliminar);
            $query->execute();
            $mensaje = "Registro eliminado";
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function obtenerInsumos($idProducto, PDO $cnn) {

        try {

            $sql = 'SELECT idMateriaPrima_materiaPrima insumos,cantidadMateriaPorProducto from materiaprimaporproducto where ProductosIdProductos=?';
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

            $sql = 'SELECT * from materiaPrima where idMateriaPrima=?';
            $query = $cnn->prepare($sql);
            $query->bindParam(1, $idProducto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

}
