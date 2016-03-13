<?php

class EstudioCostosDAO {
      public function generarEstudioCostos(EstudioCostosDTO $estudioDTO,PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO estudioDeCostos VALUES(DEFAULT,?,?,?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $estudioDTO->getIdProyectoSolicitado());
            $sentencia->bindParam(2, $estudioDTO->getIdGerenteCargo());
            $sentencia->bindParam(3, $estudioDTO->getCostoManoDeObra());
            $sentencia->bindParam(4, $estudioDTO->getCostoProduccion());
            $sentencia->bindParam(5, $estudioDTO->getCostoProyecto());
            $sentencia->bindParam(6, $estudioDTO->getUtilidad());
            $sentencia->bindParam(7, $estudioDTO->getTiempoEstimado());
            $sentencia->bindParam(8, $estudioDTO->getTotalTrabajadores());
            $sentencia->bindParam(9, $estudioDTO->getObservaciones());
            $sentencia->execute();
            $mensaje="Estudio de Costos Generado con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function costoManoDeObra($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalPrecioProceso)from procesosPorProyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function costoProduccion($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(valorTotal)from materiaPrimaPorProyecto where proyectos_idProyecto=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function tiempoEstimado($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalTiempoProceso) from procesosPorProyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function empleadosSolicitados($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalEmpleadosProceso) from procesosPorProyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function verificaExistenciaEstudio($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT * FROM estudioDeCostos where idProyectoSolicitado=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetch();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }
}
