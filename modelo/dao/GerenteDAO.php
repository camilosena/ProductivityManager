<?php

class GerenteDAO {

    public function insertarGerenteDeProyecto(GerenteDTO $GerenteDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO gerentesDeProyecto VALUES(?,?)");
            $sentencia->bindParam(1, $GerenteDTO->getIdUsuario());
            $sentencia->bindParam(2, $GerenteDTO->getPerfil());
            $sentencia->execute();
            $mensaje = "Gerente Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    public function obtenerGerenteDeProyecto($idGerente, PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT perfil from gerentesdeproyecto where idGerente=?');
            $query->bindParam(1, $idGerente);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function ModificarGerente(GerenteDTO $GerenteDto, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  gerentesDeProyecto SET perfil=? where idGerente=?");
            $query->bindParam(1, $GerenteDto->getPerfil());
            $query->bindParam(2, $GerenteDto->getIdUsuario());
            $query->execute();
            $mensaje = "Gerente Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    public function cantidadGerentes(PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT count(idGerente) from gerentesdeproyecto');
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

}
